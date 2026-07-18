<?php
// app/Models/AboutMission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutMission extends Model
{
    use HasFactory;

    protected $table = 'about_missions';

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
        'quote_text_en',
        'quote_text_dari',
        'quote_text_pashto',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function points(): HasMany
    {
        return $this->hasMany(AboutMissionPoint::class, 'about_mission_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * All points including inactive — for admin use
     */
    public function allPoints(): HasMany
    {
        return $this->hasMany(AboutMissionPoint::class, 'about_mission_id')
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