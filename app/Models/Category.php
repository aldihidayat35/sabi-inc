<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];

    /**
     * Many-to-Many relationship with Work.
     */
    public function works()
    {
        return $this->belongsToMany(Work::class, 'category_work');
    }
}
