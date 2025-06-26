<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_id',
        'student_id',
        'submission',
        'score',
        'notes',
        'diamond_awarded', // add this
    ];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
