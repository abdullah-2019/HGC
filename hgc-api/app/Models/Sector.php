<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name_en', 'name_dari', 'name_pashto',
        'icon_name', 'description_en', 'description_dari', 'description_pashto',
        'projects_count', 'image_url', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'projects_count' => 'integer',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    public function getLocalizedName(string $lang = 'en'): string
    {
        return match ($lang) {
            'dari' => $this->name_dari ?? $this->name_en,
            'pashto' => $this->name_pashto ?? $this->name_en,
            default => $this->name_en,
        };
    }

    public function getLocalizedDescription(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->description_dari ?? $this->description_en,
            'pashto' => $this->description_pashto ?? $this->description_en,
            default => $this->description_en,
        };
    }

    public function getImageUrlAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }
}