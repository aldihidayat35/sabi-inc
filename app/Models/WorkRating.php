<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkRating extends Model
{
    protected $fillable = [
        'work_id',
        'student_id',
        'type', // 'like' atau 'dislike'
        'rating', // 1-5
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
