<?php
// app/Models/AboutVision.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutVision extends Model
{
    use HasFactory;

    protected $table = 'about_visions';

    protected $fillable = [
        'section_label_en',
        'section_label_dari',
        'section_label_pashto',
        'title_en',
        'title_dari',
        'title_pashto',
        'description_en',
        'description_dari',
        'description_pashto',
        'image_url',
        'badge_value',
        'badge_label_en',
        'badge_label_dari',
        'badge_label_pashto',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function pillars(): HasMany
    {
        return $this->hasMany(AboutVisionPillar::class, 'about_vision_id')
            ->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}