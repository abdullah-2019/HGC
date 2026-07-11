<?php
// app/Models/AboutPageSetting.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_background_image',
        'hero_label_en',
        'hero_label_dari',
        'hero_label_pashto',
        'hero_title_en',
        'hero_title_dari',
        'hero_title_pashto',
        'hero_subtitle_en',
        'hero_subtitle_dari',
        'hero_subtitle_pashto',
        'meta_title_en',
        'meta_title_dari',
        'meta_title_pashto',
        'meta_description_en',
        'meta_description_dari',
        'meta_description_pashto',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getLocalizedAttribute(string $field, string $lang): ?string
    {
        $column = "{$field}_{$lang}";
        return $this->{$column} ?? $this->{"{$field}_en"};
    }
}