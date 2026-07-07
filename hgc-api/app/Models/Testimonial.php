<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'text_en',
        'text_dari',
        'text_pashto',
        'author_name_en',
        'author_name_dari',
        'author_role_en',
        'author_role_dari',
        'author_image_url',
        'company_logo_url',
        'rating',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];
}