<?php
// app/Models/AboutMissionPoint.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutMissionPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_mission_id',
        'text_en',
        'text_dari',
        'text_pashto',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function aboutMission(): BelongsTo
    {
        return $this->belongsTo(AboutMission::class, 'about_mission_id');
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