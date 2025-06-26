<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkScore;
use App\Models\Teacher;

class WorkController extends Controller
{
    public function index()
    {
        $works = Work::with('categories')->get(); // Use 'categories' relationship
        return view('works.index', compact('works'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('works.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string',
            'status' => 'required|in:Publish,Draft,Suspend',
            'suspend_note' => 'nullable|string',
        ]);

        $data = $request->except('cover_photo', 'category_ids');
        $data['author_id'] = Auth::guard('student')->id(); // Automatically set the author to the logged-in student

        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('work_covers'), $photoName);
            $data['cover_photo'] = 'work_covers/' . $photoName;
        }

        $work = Work::create($data);
        $work->categories()->sync($request->category_ids);

        return redirect()->route('works.index')->with('success', 'Work created successfully.');
    }

    public function show($id)
    {
        $work = Work::with('categories')->findOrFail($id); // Use 'categories' relationship
        return view('works.show', compact('work'));
    }

    public function edit($id)
    {
        $work = Work::findOrFail($id);
        $categories = Category::all();
        return view('works.edit', compact('work', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'content' => 'required|string',
            'status' => 'required|in:Publish,Draft,Suspend',
            'suspend_note' => 'nullable|string',
        ]);

        $data = $request->except('cover_photo', 'category_ids');
        $data['author_id'] = $work->author_id; // Preserve the original author

        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('work_covers'), $photoName);
            $data['cover_photo'] = 'work_covers/' . $photoName;
        }

        $work->update($data);
        $work->categories()->sync($request->category_ids);

        return redirect()->route('works.index')->with('success', 'Work updated successfully.');
    }

    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return redirect()->route('works.index')->with('success', 'Work deleted successfully.');
    }

    public function score(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|numeric|min:0|max:10',
        ]);

        $work = Work::findOrFail($id);
        $teacher = Auth::guard('teacher')->user();

        // Update or create score
        WorkScore::updateOrCreate(
            ['work_id' => $work->id, 'teacher_id' => $teacher->id],
            ['score' => $request->score]
        );

        return back()->with('success', 'Score submitted.');
    }

    public function scorePage(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();

        // Ambil semua karya beserta skor guru login
        $works = Work::with([
            'categories',
            'teacherScores' => function($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            }
        ])->get();

        // Pisahkan karya yang belum dinilai dan sudah dinilai
        $unscored = $works->filter(function($work) {
            return $work->teacherScores->isEmpty();
        });
        $scored = $works->filter(function($work) {
            return $work->teacherScores->isNotEmpty();
        });

        // Gabungkan: yang belum dinilai dulu, lalu yang sudah dinilai
        $sortedWorks = $unscored->concat($scored);

        // Hitung jumlah karya yang belum dinilai
        $unscoredCount = $unscored->count();

        return view('works.score', [
            'works' => $sortedWorks,
            'teacher' => $teacher,
            'unscoredCount' => $unscoredCount
        ]);
    }
}
