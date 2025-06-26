<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function index()
    {
        $categories = Category::with(['works' => function($query) {
            $query->with(['categories', 'ratings'])->latest()->take(12);
        }])->get();

        $latestWorks = Work::with(['categories', 'ratings'])->where('status', 'Publish')->orderBy('created_at', 'desc')->take(10)->get();

        // Search works by title if search_work is present
        $searchWorks = null;
        if (request()->has('search_work') && trim(request('search_work')) !== '') {
            $searchWorks = Work::with(['categories', 'ratings', 'author'])
                ->where('title', 'like', '%' . request('search_work') . '%')
                ->take(10)
                ->get();
        }

        return view('frontend.works.index', compact('categories', 'latestWorks', 'searchWorks'));
    }

    public function show($id)
    {
        $work = Work::with(['categories'])->findOrFail($id);
        $work->increment('views');
        $work = $work->loadCount('comments');
        return view('frontend.works.show', compact('work'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('frontend.works.create', compact('categories'));
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

        // Award diamond points
        $student = Auth::guard('student')->user();
        $student->diamond_points += 100;
        $student->save();

        return redirect()->route('frontend.works.index')->with('success', 'Work created and diamond points awarded!');
    }

    public function byCategory($categoryId)
    {
        $category = \App\Models\Category::with(['works' => function($query) {
            $query->with(['categories', 'ratings'])->latest();
        }])->findOrFail($categoryId);

        $works = $category->works;

        return view('frontend.works.by-category', compact('category', 'works'));
    }
}
