<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_photo',
        'reward_diamond',
    ];

    /**
     * Relationship to the Material model.
     */
    public function materials()
    {
        return $this->hasMany(Material::class);
    }
}
