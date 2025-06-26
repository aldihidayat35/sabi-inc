<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'work_id' => 'required|exists:works,id',
            'type' => 'required|in:Like,Dislike,Comment',
            'comment' => 'nullable|string',
        ]);

        Feedback::create($request->all());
        return response()->json(['success' => true]);
    }

    public function count($workId)
    {
        $likes = Feedback::where('work_id', $workId)->where('type', 'Like')->count();
        $dislikes = Feedback::where('work_id', $workId)->where('type', 'Dislike')->count();
        $comments = Feedback::where('work_id', $workId)->where('type', 'Comment')->count();

        return response()->json(compact('likes', 'dislikes', 'comments'));
    }
}
