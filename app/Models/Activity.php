<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'cover_image',
        'gallery',
    ];

    protected $casts = [
        'gallery' => 'array',
        'date' => 'date', 
    ];
}
