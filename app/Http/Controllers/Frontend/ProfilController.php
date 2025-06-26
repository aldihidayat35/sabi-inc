<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\WorkScore;

class ProfilController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Siapkan path foto profil (gunakan default jika kosong)
        $photo = $student && $student->photo_profil
            ? asset('uploads/' . $student->photo_profil)
            : asset('uploads/default.png');

        return view('frontend.profil', compact('student', 'photo'));
    }

    public function detail()
    {
        $student = Auth::guard('student')->user();
        $photo = $student && $student->photo_profil
            ? asset('uploads/' . $student->photo_profil)
            : asset('uploads/default.png');
        return view('frontend.profil-detail', compact('student', 'photo'));
    }

    public function karyaSaya()
    {
        $student = Auth::guard('student')->user();
        $works = $student ? $student->hasMany(\App\Models\Work::class, 'author_id')->get() : collect();
        return view('frontend.karya-saya', compact('works', 'student'));
    }

    public function penilaianGuru()
    {
        $student = Auth::guard('student')->user();

        // Ganti 'student_id' menjadi 'author_id'
        $works = \App\Models\Work::where('author_id', $student->id)
            ->with(['scores.teacher', 'categories'])
            ->get();

        $worksWithScores = $works->map(function ($work) {
            $averageScore = $work->scores->avg('score');
            $teacherCount = $work->scores->unique('teacher_id')->count();
            return [
                'work' => $work,
                'average_score' => $averageScore ? round($averageScore, 2) : 0,
                'teacher_count' => $teacherCount,
            ];
        });

        return view('frontend.penilaian-guru', compact('worksWithScores'));
    }
}
