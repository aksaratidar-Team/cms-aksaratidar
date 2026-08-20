<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'photo',
        'bio',
        'social_links',
    ];
    protected $casts = [
        'social_links' => 'array',
    ];
}
