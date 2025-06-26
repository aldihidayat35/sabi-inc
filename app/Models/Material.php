<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'abstract',
        'cover_photo',
        'reward_diamond',
        'content',
        'author_id', // Add this field
    ];

    /**
     * Relationship to the Topic model.
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Relationship to the Teacher model.
     */
    public function author()
    {
        return $this->belongsTo(Teacher::class, 'author_id');
    }
}
