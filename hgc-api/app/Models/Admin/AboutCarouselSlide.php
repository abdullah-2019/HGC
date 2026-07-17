<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCarouselSlide extends Model
{
    protected $table = 'about_carousel_slides';

    protected $fillable = [
        'image_url',

        'title_en',
        'title_dari',
        'title_pashto',

        'location_en',
        'location_dari',
        'location_pashto',

        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}