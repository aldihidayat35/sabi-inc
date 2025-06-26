<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\WorkComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkCommentController extends Controller
{
    public function store(Request $request, $workId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:work_comments,id',
        ]);

        $work = Work::findOrFail($workId);

        WorkComment::create([
            'work_id' => $work->id,
            'student_id' => Auth::guard('student')->id(),
            'comment' => $request->comment,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
