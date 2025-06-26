<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'nama',
        'asal_sekolah',
        'email',
        'photo_profil',
        'password',
        'diamond_points', // add this
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Accessor for 'name' to map to 'nama'
    public function getNameAttribute()
    {
        return $this->nama;
    }

    // Tambahkan relasi komentar karya
    public function workComments()
    {
        return $this->hasMany(WorkComment::class);
    }

    // Tambahkan relasi favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    // Relasi materi yang sudah dilihat
    public function viewedMaterials()
    {
        return $this->belongsToMany(Material::class, 'material_student')->withTimestamps();
    }

    // Relasi karya yang dibuat
    public function works()
    {
        return $this->hasMany(Work::class, 'author_id');
    }

    // Relasi followers (student yang mengikuti saya)
    public function followers()
    {
        return $this->belongsToMany(Student::class, 'student_follows', 'followed_id', 'follower_id');
    }

    // Relasi followings (student yang saya ikuti)
    public function followings()
    {
        return $this->belongsToMany(Student::class, 'student_follows', 'follower_id', 'followed_id');
    }

    // Relasi challenge yang diikuti
    public function challengeRegistrations()
    {
        return $this->hasMany(\App\Models\ChallengeRegistration::class);
    }

    // Cek apakah sudah di-follow oleh student tertentu
    public function isFollowedBy($student)
    {
        if (!$student) return false;
        return $this->followers()->where('follower_id', $student->id)->exists();
    }
}
