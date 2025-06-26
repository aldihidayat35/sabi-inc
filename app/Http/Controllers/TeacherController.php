<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    private function authorizeAdmin()
    {
        if (!Auth::guard('teacher')->check()) {
            // Redirect ke halaman login jika belum login
            abort(redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']));
        }
        $user = Auth::guard('teacher')->user();
        if ($user->level !== 'admin') {
            // Redirect ke halaman sebelumnya jika level tidak sesuai
            redirect()->back()->withErrors(['message' => 'Access denied.'])->send();
            exit;
        }
    }

    public function index()
    {
        $this->authorizeAdmin();

        $teachers = Teacher::all();
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => '']
        ];
        $title = 'Teachers';
        $description = 'Manage all teachers in the system.';

        return view('teachers.index', compact('teachers', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => route('teachers.index')],
            ['label' => 'Add Teacher', 'url' => '']
        ];
        $title = 'Add Teacher';
        $description = 'Fill in the details to add a new teacher.';

        return view('teachers.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nip' => 'required|string|max:255|unique:teachers',
            'email' => 'required|email|max:255|unique:teachers',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:8',
        ]);

        try {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);

            // Handle photo upload
            if ($request->hasFile('photo_profil')) {
                $photo = $request->file('photo_profil');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('profile_photos'), $photoName);
                $data['photo_profil'] = 'profile_photos/' . $photoName;
            }
            Teacher::create($data);

            return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create teacher: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $teacher = Teacher::findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => route('teachers.index')],
            ['label' => 'Edit Teacher', 'url' => '']
        ];
        $title = 'Edit Teacher';
        $description = 'Update the details of the selected teacher.';

        return view('teachers.edit', compact('teacher', 'breadcrumbs', 'title', 'description'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $teacher = Teacher::findOrFail($id);

        $request->validate([
            'nip' => 'required|string|max:255|unique:teachers,nip,' . $teacher->id,
            'email' => 'required|email|max:255|unique:teachers,email,' . $teacher->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'level' => 'required|in:admin,teacher',
            'password' => 'nullable|string|min:8',
        ]);

        try {
            $data = $request->all();

            // Handle photo upload
            if ($request->hasFile('photo_profil')) {
                $photo = $request->file('photo_profil');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('profile_photos'), $photoName);
                $data['photo_profil'] = 'profile_photos/' . $photoName;
            }

            // Update password jika diisi
            if (!empty($request->password)) {
                $data['password'] = \Hash::make($request->password);
            } else {
                unset($data['password']);
            }

            $teacher->update($data);

            return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('teachers.edit', $teacher->id)->with('error', 'Failed to update teacher: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->delete();

            return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.')
                ->with('sweetalert', true);
        } catch (\Exception $e) {
            return redirect()->route('teachers.index')->with('error', 'Failed to delete teacher: ' . $e->getMessage())
                ->with('sweetalert', true);
        }
    }

    public function show($id)
    {
        $this->authorizeAdmin();

        $teacher = Teacher::findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Teachers', 'url' => route('teachers.index')],
            ['label' => 'Teacher Details', 'url' => '']
        ];
        $title = 'Teacher Details';
        $description = 'View all details of the selected teacher.';

        return view('teachers.show', compact('teacher', 'breadcrumbs', 'title', 'description'));
    }
}
