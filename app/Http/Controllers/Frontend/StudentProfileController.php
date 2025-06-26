<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentProfileController extends Controller
{
    public function show(Student $student)
    {
        $auth = auth('student')->user();
        $isFollowing = $auth ? $auth->followings()->where('followed_id', $student->id)->exists() : false;
        $followersCount = $student->followers()->count();
        $followingsCount = $student->followings()->count();
        $followersList = $student->followers()->get();
        $followingsList = $student->followings()->get();

        // Total karya
        $totalWorks = $student->works()->count();

        // Total diamond
        $totalDiamond = $student->diamond_points ?? 0;

        // Total like dari semua karya
        $totalLikes = $student->works()->withCount(['ratings as likes_count' => function($q) {
            $q->where('type', 'like');
        }])->get()->sum('likes_count');

        // Rata-rata rating kumulatif (1-5)
        $works = $student->works()->with('ratings')->get();
        $totalRating = 0;
        $ratingCount = 0;
        foreach ($works as $work) {
            $avg = $work->ratings()->avg('rating');
            if ($avg) {
                $totalRating += $avg;
                $ratingCount++;
            }
        }
        // Gunakan 2 angka di belakang koma untuk akurasi
        $avgRating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : 0;

        // List karya terbaru dan terlama
        $worksLatest = $student->works()->latest()->get();
        $worksOldest = $student->works()->oldest()->get();

        return view('frontend.students.profile', compact(
            'student',
            'isFollowing',
            'followersCount',
            'followingsCount',
            'followersList',
            'followingsList',
            'totalWorks',
            'totalDiamond',
            'totalLikes',
            'avgRating',
            'worksLatest',
            'worksOldest'
        ));
    }

    public function follow(Student $student)
    {
        $auth = auth('student')->user();
        if ($auth && $auth->id !== $student->id && !$auth->followings()->where('followed_id', $student->id)->exists()) {
            $auth->followings()->attach($student->id);
        }
        return redirect()->back();
    }

    public function unfollow(Student $student)
    {
        $auth = auth('student')->user();
        if ($auth && $auth->id !== $student->id && $auth->followings()->where('followed_id', $student->id)->exists()) {
            $auth->followings()->detach($student->id);
        }
        return redirect()->back();
    }

    public function followers(Student $student)
    {
        $followers = $student->followers()->select('id', 'nama', 'photo_profil')->get();
        return response()->json($followers);
    }

    public function followings(Student $student)
    {
        $followings = $student->followings()->select('id', 'nama', 'photo_profil')->get();
        return response()->json($followings);
    }

    // Tampilkan profil siswa yang login
    public function myProfile()
    {
        $student = auth('student')->user();
        return view('frontend.profil-detail', compact('student'));
    }

    // Update profil siswa yang login
    public function updateProfile(Request $request)
    {
        $student = auth('student')->user();

        $validated = $request->validate([
            'nisn' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'asal_sekolah' => 'nullable|string|max:255',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6',
        ]);

        $student->nisn = $validated['nisn'];
        $student->nama = $validated['nama'];
        $student->email = $validated['email'];
        $student->asal_sekolah = $validated['asal_sekolah'] ?? null;

        if ($request->hasFile('photo_profil')) {
            $file = $request->file('photo_profil');
            $filename = 'student_' . $student->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $student->photo_profil = 'uploads/' . $filename;
        }

        if (!empty($validated['password'])) {
            $student->password = Hash::make($validated['password']);
        }

        $student->save();

        return redirect()->route('frontend.profil')->with('success', 'Profil berhasil diperbarui.');
    }
}
