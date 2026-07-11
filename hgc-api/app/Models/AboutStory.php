<?php
// app/Models/AboutStory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AboutStory extends Model
{
    use HasFactory;

    protected $table = 'about_stories';

    protected $fillable = [
        'section_label_en',
        'section_label_dari',
        'section_label_pashto',
        'title_en',
        'title_dari',
        'title_pashto',
        'founded_year',
        'paragraph_1_en',
        'paragraph_1_dari',
        'paragraph_1_pashto',
        'paragraph_2_en',
        'paragraph_2_dari',
        'paragraph_2_pashto',
        'paragraph_3_en',
        'paragraph_3_dari',
        'paragraph_3_pashto',
        'main_image',
        'floating_card_value',
        'floating_card_label_en',
        'floating_card_label_dari',
        'floating_card_label_pashto',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'founded_year' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function highlights(): HasMany
    {
        return $this->hasMany(AboutStoryHighlight::class, 'about_story_id')
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