<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use App\Models\ChallengeRegistration;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChallengeController extends Controller
{
    public function show($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('frontend.challenges.show', compact('challenge'));
    }

    public function list()
    {
        $studentId = Auth::guard('student')->id();

        // Tantangan yang diikuti oleh student (jika login)
        $joinedChallenges = [];
        $joinedChallengeIds = [];
        if ($studentId) {
            $joinedChallenges = Challenge::whereIn('id', function($q) use ($studentId) {
                $q->select('challenge_id')
                  ->from('challenge_registrations')
                  ->where('student_id', $studentId);
            })
            ->withCount('registrations')
            ->get();
            $joinedChallengeIds = $joinedChallenges->pluck('id')->toArray();
        }

        // Semua tantangan yang masih berlaku (end_time >= hari ini) dan belum diikuti
        $activeChallenges = Challenge::whereDate('end_time', '>=', Carbon::today())
            ->when($studentId, function($query) use ($joinedChallengeIds) {
                if (!empty($joinedChallengeIds)) {
                    $query->whereNotIn('id', $joinedChallengeIds);
                }
            })
            ->withCount('registrations')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.challenges.list', compact('joinedChallenges', 'activeChallenges'));
    }
}
