<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
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

        $applications = Application::all();
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Applications', 'url' => '']
        ];
        $title = 'Applications';
        $description = 'Manage all applications in the system.';

        return view('applications.index', compact('applications', 'breadcrumbs', 'title', 'description'));
    }

    public function create()
    {
        $this->authorizeAdmin();

        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Applications', 'url' => route('applications.index')],
            ['label' => 'Add Application', 'url' => '']
        ];
        $title = 'Add Application';
        $description = 'Fill in the details to add a new application.';

        return view('applications.create', compact('breadcrumbs', 'title', 'description'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama_institusi' => 'required|string|max:255',
            'nama_pengelola' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ]);

        Application::create($request->all());
        return redirect()->route('applications.index')->with('success', 'Application created successfully.');
    }

    public function edit($id)
    {
        $this->authorizeAdmin();

        $application = Application::findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Dashboard', 'url' => route('dashboard')],
            ['label' => 'Applications', 'url' => route('applications.index')],
            ['label' => 'Edit Application', 'url' => '']
        ];
        $title = 'Edit Application';
        $description = 'Update the details of the selected application.';

        return view('applications.edit', compact('application', 'breadcrumbs', 'title', 'description'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama_institusi' => 'required|string|max:255',
            'nama_pengelola' => 'required|string|max:255',
            'tahun' => 'required|integer',
        ]);

        $application = Application::findOrFail($id);
        $application->update($request->all());
        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        $application = Application::findOrFail($id);
        $application->delete();
        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
}
