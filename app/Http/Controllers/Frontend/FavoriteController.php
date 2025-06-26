<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle($workId)
    {
        $student = auth('student')->user();
        $favorite = Favorite::where('student_id', $student->id)->where('work_id', $workId)->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'Berhasil dihapus dari favorit.')->with('swal', true);
        } else {
            Favorite::create([
                'student_id' => $student->id,
                'work_id' => $workId
            ]);
            return redirect()->back()->with('success', 'Berhasil ditambahkan ke favorit.')->with('swal', true);
        }
    }

    public function index()
    {
        $student = auth('student')->user();
        $favorites = Favorite::with('work')->where('student_id', $student->id)->latest()->get();
        return view('frontend.favorit_saya', compact('favorites'));
    }
}
