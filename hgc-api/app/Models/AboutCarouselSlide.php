<?php
// app/Models/AboutCarouselSlide.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCarouselSlide extends Model
{
    use HasFactory;

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
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}