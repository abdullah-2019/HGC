<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'ken_burns',
        'badge_en',
        'badge_dari',
        'badge_pashto',
        'title_en',
        'title_dari',
        'title_pashto',
        'highlights_en',
        'highlights_dari',
        'highlights_pashto',
        'subtitle_en',
        'subtitle_dari',
        'subtitle_pashto',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'title_en' => 'array',
        'title_dari' => 'array',
        'title_pashto' => 'array',
        'highlights_en' => 'array',
        'highlights_dari' => 'array',
        'highlights_pashto' => 'array',
        'is_active' => 'boolean',
    ];
}