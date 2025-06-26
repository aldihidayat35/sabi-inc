<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::guard('teacher')->check()) {
            abort(redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']));
        }

    }
    public function index(Request $request, $topicId = null)
    {

        $this->authorizeAdmin();
        if ($topicId) {
            $topic = Topic::with('materials')->findOrFail($topicId);
            return view('materials.index', compact('topic'));
        }

        $topics = Topic::with('materials')->get();
        return view('materials.index', compact('topics'));
    }

    public function create($topicId)
    {
        $this->authorizeAdmin();
        $topic = Topic::findOrFail($topicId);
        return view('materials.create', compact('topic'));
    }

    public function store(Request $request, $topicId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'reward_diamond' => 'required|integer|min:0',
            'content' => 'required|string',
        ]);

        $data = $request->except('cover_photo');
        $data['topic_id'] = $topicId;
        $data['author_id'] = Auth::guard('teacher')->id(); // Automatically set the author to the logged-in teacher

        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('material_covers'), $photoName);
            $data['cover_photo'] = 'material_covers/' . $photoName;
        }

        Material::create($data);

        return redirect()->route('topics.show', $topicId)->with('success', 'Material created successfully.');
    }

    public function show($id)
    {
        $material = Material::with('topic')->findOrFail($id);
        return view('materials.show', compact('material'));
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('materials.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'reward_diamond' => 'required|integer|min:0',
            'content' => 'required|string',
        ]);

        $data = $request->except('cover_photo');

        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('material_covers'), $photoName);
            $data['cover_photo'] = 'material_covers/' . $photoName;
        }

        $material->update($data);

        return redirect()->route('topics.show', $material->topic_id)->with('success', 'Material updated successfully.');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $topicId = $material->topic_id;
        $material->delete();

        return redirect()->route('materials.index', $topicId)->with('success', 'Material deleted successfully.');
    }
}
