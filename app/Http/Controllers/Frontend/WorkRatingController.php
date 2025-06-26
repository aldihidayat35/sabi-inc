<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\WorkRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkRatingController extends Controller
{
    public function store(Request $request, $workId)
    {
        $request->validate([
            'type' => 'nullable|in:like,dislike',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        if (!$request->type && !$request->rating) {
            return redirect()->back()->withErrors(['feedback' => 'Pilih Like/Dislike atau Rating bintang!'])->withInput();
        }

        $studentId = auth('student')->id();

        \App\Models\WorkRating::updateOrCreate(
            ['work_id' => $workId, 'student_id' => $studentId],
            [
                'type' => $request->type,
                'rating' => $request->rating,
            ]
        );

        return redirect()->back()->with('feedback_success', 'Feedback berhasil dikirim!');
    }

    public function get($workId)
    {
        $work = Work::findOrFail($workId);
        $studentId = Auth::guard('student')->id();

        $userRating = null;
        if ($studentId) {
            $userRating = WorkRating::where('work_id', $workId)
                ->where('student_id', $studentId)
                ->first();
        }

        return response()->json([
            'likes' => $work->likesCount(),
            'dislikes' => $work->dislikesCount(),
            'avg_rating' => round($work->averageRating(), 2),
            'user' => $userRating,
        ]);
    }
}
