<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_photo',
        'content',
        'status',
        'suspend_note',
        'author_id', // Add this field
        'views',
    ];

    /**
     * Many-to-Many relationship with Category.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_work');
    }

    /**
     * Relationship to the Feedback model.
     */

    /**
     * Relationship to the Student model.
     */
    public function author()
    {
        return $this->belongsTo(Student::class, 'author_id');
    }

    /**
     * Relationship to the WorkComment model.
     */
    public function comments()
    {
        return $this->hasMany(WorkComment::class);
    }

    /**
     * Relationship to the WorkRating model.
     */
    public function ratings()
    {
        return $this->hasMany(\App\Models\WorkRating::class);
    }

    /**
     * Relationship to the Favorite model.
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Relationship to the WorkScore model (teacher scores).
     */
    public function teacherScores()
    {
        return $this->hasMany(\App\Models\WorkScore::class);
    }

    /**
     * Relationship to the WorkScore model.
     */
    public function scores()
    {
        return $this->hasMany(\App\Models\WorkScore::class);
    }

    /**
     * Calculate the average score from teachers.
     */
    public function averageTeacherScore()
    {
        return round($this->teacherScores()->avg('score'), 2) ?? null;
    }

    /**
     * Check if the work is favorited by a specific student.
     */
    public function isFavoritedBy($student)
    {
        if (!$student) return false;
        return $this->favorites()->where('student_id', $student->id)->exists();
    }

    /**
     * Count the number of likes.
     */
    public function likesCount()
    {
        return $this->ratings()->where('type', 'like')->count();
    }

    /**
     * Count the number of dislikes.
     */
    public function dislikesCount()
    {
        return $this->ratings()->where('type', 'dislike')->count();
    }

    /**
     * Calculate the average rating.
     */
    public function averageRating()
    {
        return $this->ratings()->whereNotNull('rating')->avg('rating') ?? 0;
    }
}
