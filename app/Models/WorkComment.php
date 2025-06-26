<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'student_id',
        'comment',
        'parent_id',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi parent
    public function parent()
    {
        return $this->belongsTo(WorkComment::class, 'parent_id');
    }

    // Relasi children
    public function replies()
    {
        return $this->hasMany(WorkComment::class, 'parent_id');
    }
}
