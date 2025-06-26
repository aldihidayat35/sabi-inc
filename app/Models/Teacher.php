<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'email',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'photo_profil',
        'password',
        'level', // Add level to fillable attributes
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
