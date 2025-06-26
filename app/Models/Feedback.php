<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'student_id',
        'type',
        'comment',
    ];

    /**
     * Relationship to the Work model.
     */
    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    /**
     * Relationship to the Student model.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
