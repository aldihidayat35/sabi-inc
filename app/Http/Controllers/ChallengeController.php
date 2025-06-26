<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\ChallengeRegistration;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
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
        $challenges = Challenge::all();
        return view('challenges.index', compact('challenges'));
    }

    public function create()
    {

        $this->authorizeAdmin();
        return view('challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'reward_diamond_points' => 'required|integer|min:0',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'reward' => 'nullable|string|max:255',
            'details' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $data = $request->except('cover_photo');
        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('challenge_covers'), $photoName);
            $data['cover_photo'] = 'challenge_covers/' . $photoName;
        }

        Challenge::create($data);

        return redirect()->route('challenges.index')->with('success', 'Challenge created successfully.');
    }

    public function edit($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('challenges.edit', compact('challenge'));
    }

    public function update(Request $request, $id)
    {
        $challenge = Challenge::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'reward_diamond_points' => 'required|integer|min:0',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'reward' => 'nullable|string|max:255',
            'details' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $data = $request->except('cover_photo');
        if ($request->hasFile('cover_photo')) {
            $photo = $request->file('cover_photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('challenge_covers'), $photoName);
            $data['cover_photo'] = 'challenge_covers/' . $photoName;
        }

        $challenge->update($data);

        return redirect()->route('challenges.index')->with('success', 'Challenge updated successfully.');
    }

    public function destroy($id)
    {
        $challenge = Challenge::findOrFail($id);
        $challenge->delete();

        return redirect()->route('challenges.index')->with('success', 'Challenge deleted successfully.');
    }

    public function registrations($id)
    {
        $challenge = Challenge::findOrFail($id);
        $registrations = \App\Models\ChallengeRegistration::with('student')->where('challenge_id', $id)->get();
        return view('challenges.registrations', compact('challenge', 'registrations'));
    }

    public function evaluateRegistration(Request $request, $id)
    {
        $registration = \App\Models\ChallengeRegistration::findOrFail($id);
        $challenge = $registration->challenge;
        $student = $registration->student;

        $request->validate([
            'score' => 'required|numeric',
            'notes' => 'nullable|string|max:1000',
        ]);

        $registration->score = $request->score;
        $registration->notes = $request->notes ?? null;

        // Award diamond points only once
        if (!$registration->diamond_awarded) {
            $student->diamond_points += $challenge->reward_diamond_points;
            $student->save();
            $registration->diamond_awarded = true;
        }

        $registration->save();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'score' => $registration->score]);
        }

        return back()->with('success', 'Penilaian berhasil disimpan.');
    }
}
