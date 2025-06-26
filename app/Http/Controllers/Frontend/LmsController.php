<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Material;

class LmsController extends Controller
{
    public function topics()
    {
        $topics = Topic::latest()->get();
        return view('frontend.lms.topics', compact('topics'));
    }

    public function materials(Topic $topic)
    {
        $materials = $topic->materials()->latest()->get();
        return view('frontend.lms.materials', compact('topic', 'materials'));
    }

    public function showMaterial($materialId)
    {
        $material = \App\Models\Material::findOrFail($materialId);
        $student = auth('student')->user();

        if ($student && !$student->viewedMaterials->contains($material->id)) {
            $student->viewedMaterials()->attach($material->id);
            $student->diamond_points += $material->reward_diamond;
            $student->save();
        }

        return view('frontend.lms.material-show', compact('material'));
    }
}
