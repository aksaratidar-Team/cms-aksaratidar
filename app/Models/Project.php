<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'technologies',
        'cover_image',
        'gallery',
        'start_date',
        'completion_date',
        'project_url',
    ];

    protected $casts = [
        'technologies' => 'array', 
        'gallery' => 'array',      
        'start_date' => 'date',
        'completion_date' => 'date',
    ];
}