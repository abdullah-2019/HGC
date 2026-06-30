<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug', 'name_en', 'name_dari', 'name_pashto',
        'short_name_en', 'short_name_dari', 'short_name_pashto',
        'description_en', 'description_dari', 'description_pashto',
        'sector_en', 'sector_dari', 'sector_pashto',
        'accent_color', 'icon_name', 'logo_path', 'hero_image_path',
        'email', 'phone', 'website',
        'address_en', 'address_dari', 'address_pashto',
        'latitude', 'longitude',
        'facebook_url', 'linkedin_url', 'twitter_url', 'instagram_url',
        'founded_year', 'registration_number', 'tax_id', 'employee_count',
        'is_active', 'display_order', 'is_featured',
        'meta_title_en', 'meta_title_dari', 'meta_title_pashto',
        'meta_description_en', 'meta_description_dari', 'meta_description_pashto',
        'about_en', 'about_dari', 'about_pashto',
        'mission_en', 'mission_dari', 'mission_pashto',
        'vision_en', 'vision_dari', 'vision_pashto',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'founded_year' => 'integer',
        'employee_count' => 'integer',
        'display_order' => 'integer',
    ];

    /**
     * Scope: active companies only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: order by display_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    /**
     * Scope: featured companies
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get localized name based on language
     */
    public function getNameAttribute($lang = 'en'): string
    {
        return match($lang) {
            'dari' => $this->name_dari ?? $this->name_en,
            'pashto' => $this->name_pashto ?? $this->name_en,
            default => $this->name_en,
        };
    }

    /**
     * Get localized description
     */
    public function getDescriptionAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->description_dari ?? $this->description_en,
            'pashto' => $this->description_pashto ?? $this->description_en,
            default => $this->description_en,
        };
    }

    /**
     * Get localized sector
     */
    public function getSectorAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->sector_dari ?? $this->sector_en,
            'pashto' => $this->sector_pashto ?? $this->sector_en,
            default => $this->sector_en,
        };
    }

    /**
     * Get localized about
     */
    public function getAboutAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->about_dari ?? $this->about_en,
            'pashto' => $this->about_pashto ?? $this->about_en,
            default => $this->about_en,
        };
    }

    /**
     * Get localized mission
     */
    public function getMissionAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->mission_dari ?? $this->mission_en,
            'pashto' => $this->mission_pashto ?? $this->mission_en,
            default => $this->mission_en,
        };
    }

    /**
     * Get localized vision
     */
    public function getVisionAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->vision_dari ?? $this->vision_en,
            'pashto' => $this->vision_pashto ?? $this->vision_en,
            default => $this->vision_en,
        };
    }

    /**
     * Get localized address
     */
    public function getAddressAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->address_dari ?? $this->address_en,
            'pashto' => $this->address_pashto ?? $this->address_en,
            default => $this->address_en,
        };
    }

    /**
     * Get localized meta title
     */
    public function getMetaTitleAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->meta_title_dari ?? $this->meta_title_en,
            'pashto' => $this->meta_title_pashto ?? $this->meta_title_en,
            default => $this->meta_title_en,
        };
    }

    /**
     * Get localized meta description
     */
    public function getMetaDescriptionAttribute($lang = 'en'): ?string
    {
        return match($lang) {
            'dari' => $this->meta_description_dari ?? $this->meta_description_en,
            'pashto' => $this->meta_description_pashto ?? $this->meta_description_en,
            default => $this->meta_description_en,
        };
    }
}