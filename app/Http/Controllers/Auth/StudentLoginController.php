<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('student')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            // Retrieve the authenticated student
            $student = Auth::guard('student')->user();

            // Store all student data in the session
            $request->session()->put('id', $student->id);
            $request->session()->put('email', $student->email);
            $request->session()->put('nama', $student->nama);
            $request->session()->put('tempat_lahir', $student->tempat_lahir);
            $request->session()->put('tanggal_lahir', $student->tanggal_lahir);
            $request->session()->put('alamat', $student->alamat);
            $request->session()->put('photo_profil', $student->photo_profil ?? 'default.png');

            return redirect()->route('frontend.home')->with('success', 'Welcome, Student!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student.login');
    }

    public function showRegisterForm()
    {
        return view('auth.student-register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:255|unique:students',
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $data = $request->except('photo_profil', 'password_confirmation');
            $data['password'] = Hash::make($request->password);

            if ($request->hasFile('photo_profil')) {
                $photo = $request->file('photo_profil');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('student_photos'), $photoName);
                $data['photo_profil'] = 'student_photos/' . $photoName;
            }

            $student = Student::create($data);

            // Auto-login after registration
            Auth::guard('student')->login($student);

            // Store all student data in the session
            $request->session()->regenerate();
            $request->session()->put('id', $student->id);
            $request->session()->put('email', $student->email);
            $request->session()->put('nama', $student->nama);
            $request->session()->put('tempat_lahir', $student->tempat_lahir ?? '');
            $request->session()->put('tanggal_lahir', $student->tanggal_lahir ?? '');
            $request->session()->put('alamat', $student->alamat ?? '');
            $request->session()->put('photo_profil', $student->photo_profil ?? 'default.png');

            return redirect()->route('frontend.works.index')->with('success', 'Registration successful. Welcome!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['register' => 'Registration failed: ' . $e->getMessage()]);
        }
    }
}
