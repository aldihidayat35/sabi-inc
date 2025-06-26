<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    private function authorizeAdmin()
    {
        if (!Auth::guard('teacher')->check()) {
            abort(redirect()->route('teacher.login')->withErrors(['message' => 'Please login first.']));
        }
        $user = Auth::guard('teacher')->user();
        if ($user->level !== 'admin') {
            redirect()->back()->withErrors(['message' => 'Access denied.'])->send();
            exit;
        }
    }

    public function index()
    {
        $this->authorizeAdmin();

        $students = Student::orderByDesc('diamond_points')->get();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => '']
        ];
        $title = 'Students';
        $description = 'Manage all students in the system.';

        return view('students.index', compact('students', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => route('students.index')],
            ['label' => 'Add Student', 'url' => '']
        ];
        $title = 'Add Student';
        $description = 'Fill in the details to add a new student.';

        return view('students.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nisn' => 'required|string|max:255|unique:students',
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|string|min:8',
        ]);

        try {
            $data = $request->except('photo_profil');
            $data['password'] = Hash::make($request->password);

            // Handle photo upload
            if ($request->hasFile('photo_profil')) {
                $photo = $request->file('photo_profil');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('student_photos'), $photoName);
                $data['photo_profil'] = 'student_photos/' . $photoName;
            }

            Student::create($data);

            return redirect()->route('students.index')->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create student: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $student = Student::findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => route('students.index')],
            ['label' => 'Edit Student', 'url' => '']
        ];
        $title = 'Edit Student';
        $description = 'Update the details of the selected student.';

        return view('students.edit', compact('student', 'breadcrumbs', 'title', 'description'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $student = Student::findOrFail($id);

        $request->validate([
            'nisn' => 'required|string|max:255|unique:students,nisn,' . $student->id,
            'nama' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:students,email,' . $student->id,
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $data = $request->except('photo_profil');

            // Handle photo upload
            if ($request->hasFile('photo_profil')) {
                $photo = $request->file('photo_profil');
                $photoName = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('student_photos'), $photoName);
                $data['photo_profil'] = 'student_photos/' . $photoName;
            }

            $student->update($data);

            return redirect()->route('students.index')->with('success', 'Student updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.edit', $student->id)->with('error', 'Failed to update student: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        try {
            $student = Student::findOrFail($id);
            $student->delete();

            return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')->with('error', 'Failed to delete student: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $this->authorizeAdmin();

        $student = Student::findOrFail($id);
        // Statistik tambahan
        $totalWorks = $student->works()->count();
        $totalLikes = $student->works()->withCount(['ratings as likes_count' => function($q) {
            $q->where('type', 'like');
        }])->get()->sum('likes_count');
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
        $avgRating = $ratingCount > 0 ? round($totalRating / $ratingCount, 2) : 0;
        $totalDiamond = $student->diamond_points ?? 0;
        $followersCount = $student->followers()->count();
        $followingsCount = $student->followings()->count();
        $totalChallenges = $student->challengeRegistrations()->count();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Students', 'url' => route('students.index')],
            ['label' => 'Student Details', 'url' => '']
        ];
        $title = 'Student Details';
        $description = 'View all details of the selected student.';

        return view('students.show', compact(
            'student',
            'breadcrumbs',
            'title',
            'description',
            'totalWorks',
            'totalLikes',
            'avgRating',
            'totalDiamond',
            'followersCount',
            'followingsCount',
            'totalChallenges'
        ));
    }
}
