<?php
// app/Models/AboutStoryHighlight.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AboutStoryHighlight extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_story_id',
        'icon_name',
        'label_en',
        'label_dari',
        'label_pashto',
        'value_text',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function aboutStory(): BelongsTo
    {
        return $this->belongsTo(AboutStory::class, 'about_story_id');
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