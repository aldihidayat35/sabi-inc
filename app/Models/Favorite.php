<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = ['student_id', 'work_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
