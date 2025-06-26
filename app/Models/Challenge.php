<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'reward_diamond_points',
        'cover_photo',
        'reward',
        'details',
        'start_time',
        'end_time',
    ];

    public function registrations()
    {
        return $this->hasMany(\App\Models\ChallengeRegistration::class);
    }
}
