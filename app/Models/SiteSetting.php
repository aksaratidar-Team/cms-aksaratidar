<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'company_logo',
        'contact_email',
        'contact_phone',
        'address',
        'social_media',
        'about_us_text',
    ];

    protected $casts = [
        'social_media' => 'array', 
    ];
}
