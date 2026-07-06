<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug', 'name_en', 'name_dari', 'name_pashto',
        'short_name_en', 'short_name_dari', 'short_name_pashto',
        'accent_color', 'secondary_color', 'icon_name', 'logo_url', 'hero_image_path',
        'tagline_en', 'tagline_dari', 'tagline_pashto',
        'description_en', 'description_dari', 'description_pashto',
        'sector_en', 'sector_dari', 'sector_pashto',
        'about_en', 'about_dari', 'about_pashto',
        'mission_en', 'mission_dari', 'mission_pashto',
        'vision_en', 'vision_dari', 'vision_pashto',
        'value_en', 'value_dari', 'value_pashto',
        'project_count', 'province_count',
        'email', 'phone',
        'address', 'address_en', 'address_dari', 'address_pashto',
        'latitude', 'longitude',
        'website_url', 'website', 'facebook_url', 'linkedin_url', 'twitter_url', 'instagram_url',
        'established_year', 'founded_year', 'registration_number', 'tax_id', 'employee_count',
        'is_active', 'sort_order', 'display_order', 'is_featured',
        'meta_title_en', 'meta_title_dari', 'meta_title_pashto',
        'meta_description_en', 'meta_description_dari', 'meta_description_pashto',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'established_year' => 'integer',
        'founded_year' => 'integer',
        'employee_count' => 'integer',
        'sort_order' => 'integer',
        'display_order' => 'integer',
    ];

    /**
     * Scope: active companies
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: featured companies
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope: ordered by display_order, then sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order', 'asc')
                     ->orderBy('sort_order', 'asc')
                     ->orderBy('id', 'asc');
    }

    /**
     * Get localized name based on language
     */
    public function getLocalizedName(string $lang = 'en'): string
    {
        return match ($lang) {
            'dari' => $this->name_dari ?? $this->name_en,
            'pashto' => $this->name_pashto ?? $this->name_en,
            default => $this->name_en,
        };
    }

    /**
     * Get localized short name
     */
    public function getLocalizedShortName(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->short_name_dari ?? $this->short_name_en,
            'pashto' => $this->short_name_pashto ?? $this->short_name_en,
            default => $this->short_name_en,
        };
    }

    /**
     * Get localized tagline
     */
    public function getLocalizedTagline(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->tagline_dari ?? $this->tagline_en,
            'pashto' => $this->tagline_pashto ?? $this->tagline_en,
            default => $this->tagline_en,
        };
    }

    /**
     * Get localized description
     */
    public function getLocalizedDescription(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->description_dari ?? $this->description_en,
            'pashto' => $this->description_pashto ?? $this->description_en,
            default => $this->description_en,
        };
    }

    /**
     * Get localized sector
     */
    public function getLocalizedSector(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->sector_dari ?? $this->sector_en,
            'pashto' => $this->sector_pashto ?? $this->sector_en,
            default => $this->sector_en,
        };
    }

    /**
     * Get localized about
     */
    public function getLocalizedAbout(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->about_dari ?? $this->about_en,
            'pashto' => $this->about_pashto ?? $this->about_en,
            default => $this->about_en,
        };
    }

    /**
     * Get localized mission
     */
    public function getLocalizedMission(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->mission_dari ?? $this->mission_en,
            'pashto' => $this->mission_pashto ?? $this->mission_en,
            default => $this->mission_en,
        };
    }

    /**
     * Get localized vision
     */
    public function getLocalizedVision(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->vision_dari ?? $this->vision_en,
            'pashto' => $this->vision_pashto ?? $this->vision_en,
            default => $this->vision_en,
        };
    }

    /**
     * Get localized address
     */
    public function getLocalizedAddress(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->address_dari ?? $this->address_en ?? $this->address,
            'pashto' => $this->address_pashto ?? $this->address_en ?? $this->address,
            default => $this->address_en ?? $this->address,
        };
    }

    /**
     * Get localized meta title
     */
    public function getLocalizedMetaTitle(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->meta_title_dari ?? $this->meta_title_en,
            'pashto' => $this->meta_title_pashto ?? $this->meta_title_en,
            default => $this->meta_title_en,
        };
    }

    /**
     * Get localized meta description
     */
    public function getLocalizedMetaDescription(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->meta_description_dari ?? $this->meta_description_en,
            'pashto' => $this->meta_description_pashto ?? $this->meta_description_en,
            default => $this->meta_description_en,
        };
    }

    /**
     * Get full logo URL
     */
    public function getLogoUrlAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }

    /**
     * Get full hero image URL
     */
    public function getHeroImageUrlAttribute(): ?string
    {
        return $this->hero_image_path ? asset('storage/' . $this->hero_image_path) : null;
    }

    public function getLocalizedValue(string $lang): ?string
    {
        return match($lang) {
            'dari' => $this->value_dari,
            'pashto' => $this->value_pashto,
            default => $this->value_en ?? $this->value,
        };
    }

    // Relationship between Company and CompanyValues
    public function values(): HasMany
    {
        return $this->hasMany(CompanyValues::class)->orderBy('sort_order');
    }

    // Relationship between Company and CompanyAwards
    public function awards(): HasMany
    {
        return $this->hasMany(CompanyAwards::class)->ordered();
    }

     // === Relationships ===
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
