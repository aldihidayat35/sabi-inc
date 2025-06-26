<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $request->validate([
            'name' => 'required|string|unique:categories',
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name']);
        if ($request->hasFile('logo')) {
            // Pastikan folder ada
            if (!Storage::disk('public')->exists('category_logos')) {
                Storage::disk('public')->makeDirectory('category_logos');
            }
            $path = $request->file('logo')->store('category_logos', 'public');
            $data['logo'] = $path; // Simpan path relatif dari storage/app/public
        }

        Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $this->authorizeAdmin();
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'logo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name']);
        if ($request->hasFile('logo')) {
            // Pastikan folder ada
            if (!Storage::disk('public')->exists('category_logos')) {
                Storage::disk('public')->makeDirectory('category_logos');
            }
            // Hapus logo lama jika ada
            if ($category->logo && Storage::disk('public')->exists($category->logo)) {
                Storage::disk('public')->delete($category->logo);
            }
            $path = $request->file('logo')->store('category_logos', 'public');
            $data['logo'] = $path; // Simpan path relatif dari storage/app/public
        }

        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    public function getWorkCategories($work)
    {
        $this->authorizeAdmin();
        $categories = $work->categories; // Access all categories for a work
        return $categories;
    }
}
