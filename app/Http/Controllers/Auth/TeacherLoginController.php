<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.teacher-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('teacher')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Retrieve the authenticated teacher
            $teacher = Auth::guard('teacher')->user();

            // Store all teacher data in the session
            $request->session()->put('id', $teacher->id);
            $request->session()->put('nip', $teacher->nip);
            $request->session()->put('email', $teacher->email);
            $request->session()->put('nama', $teacher->nama);
            $request->session()->put('tempat_lahir', $teacher->tempat_lahir);
            $request->session()->put('tanggal_lahir', $teacher->tanggal_lahir);
            $request->session()->put('alamat', $teacher->alamat);
            $request->session()->put('photo_profil', $teacher->photo_profil ?? 'default.png');
            $request->session()->put('level', $teacher->level);

            // Redirect based on level
            if ($teacher->level === 'admin') {
                return redirect()->route('dashboard')->with('success', 'Welcome, Admin!');
            }

            return redirect()->route('dashboard')->with('success', 'Welcome, Teacher!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('teacher')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}
