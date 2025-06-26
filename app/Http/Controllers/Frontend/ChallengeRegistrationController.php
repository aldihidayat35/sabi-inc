<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\ChallengeRegistration;
use Illuminate\Support\Facades\Auth;

class ChallengeRegistrationController extends Controller
{
    public function store(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        $request->validate([
            'submission' => 'required|string',
        ]);

        $studentId = Auth::guard('student')->id();

        // Cegah double register
        $exists = ChallengeRegistration::where('challenge_id', $challenge->id)
            ->where('student_id', $studentId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Anda sudah mendaftar challenge ini.');
        }

        ChallengeRegistration::create([
            'challenge_id' => $challenge->id,
            'student_id' => $studentId,
            'submission' => $request->submission,
        ]);

        return back()->with('success', 'Berhasil mendaftar challenge!');
    }
}
