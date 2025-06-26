<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    private function authorizeAdmin()
    {
        if (!auth()->guard('teacher')->check()) {
            abort(redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']));
        }

    }
    public function index()
    {
        $this->authorizeAdmin();
        $topics = Topic::all();
        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('topics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'reward_diamond' => 'required|integer|min:0',
        ]);

        $data = $request->except('cover_photo');
        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('topic_covers'), $photoName);
            $data['cover_photo'] = 'topic_covers/' . $photoName;
        }

        Topic::create($data);

        return redirect()->route('topics.index')->with('success', 'Topic created successfully.');
    }

    public function show($id)
    {
        $this->authorizeAdmin();
        $topic = Topic::with('materials')->findOrFail($id);
        return view('topics.show', compact('topic'));
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        return view('topics.edit', compact('topic'));
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'reward_diamond' => 'required|integer|min:0',
        ]);

        $data = $request->except('cover_photo');
        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('topic_covers'), $photoName);
            $data['cover_photo'] = 'topic_covers/' . $photoName;
        }

        $topic->update($data);

        return redirect()->route('topics.index')->with('success', 'Topic updated successfully.');
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully.');
    }
}
