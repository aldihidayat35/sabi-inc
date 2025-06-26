<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkScore extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'teacher_id',
        'score',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    public function teacher()
    {
        return $this->belongsTo(\App\Models\Teacher::class);
    }
}
