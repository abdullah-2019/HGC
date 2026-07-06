<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name_en', 'name_dari', 'name_pashto',
        'tagline_en', 'tagline_dari', 'tagline_pashto',
        'overview_en', 'overview_dari', 'overview_pashto',
        'hero_image_url', 'thumbnail_url',
        'category_id', 'company_id',
        'origin', 'grade', 'purity', 'specifications',
        'price_range', 'currency', 'unit', 'availability',
        'applications', 'packaging', 'delivery_info',
        'meta_title_en', 'meta_desc_en',
        'is_featured', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'specifications' => 'array',
        'applications' => 'array',
        'packaging' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function primaryImage(): ?ProductImage
    {
        return $this->images()->where('is_primary', true)->first()
            ?? $this->images()->first();
    }

    public function getLocalizedName(string $lang = 'en'): string
    {
        return match ($lang) {
            'dari' => $this->name_dari ?? $this->name_en,
            'pashto' => $this->name_pashto ?? $this->name_en,
            default => $this->name_en,
        };
    }

    public function getLocalizedTagline(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->tagline_dari ?? $this->tagline_en,
            'pashto' => $this->tagline_pashto ?? $this->tagline_en,
            default => $this->tagline_en,
        };
    }

    public function getLocalizedOverview(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->overview_dari ?? $this->overview_en,
            'pashto' => $this->overview_pashto ?? $this->overview_en,
            default => $this->overview_en,
        };
    }

    public function getHeroImageUrlAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getThumbnailUrlAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getAvailabilityLabel(string $lang = 'en'): string
    {
        $labels = [
            'in_stock' => [
                'en' => 'In Stock',
                'dari' => 'موجود',
                'pashto' => 'شته',
            ],
            'limited' => [
                'en' => 'Limited',
                'dari' => 'محدود',
                'pashto' => 'محدود',
            ],
            'pre_order' => [
                'en' => 'Pre-Order',
                'dari' => 'پیش‌سفارش',
                'pashto' => 'مخکې سفارش',
            ],
            'out_of_stock' => [
                'en' => 'Out of Stock',
                'dari' => 'ناموجود',
                'pashto' => 'نشته',
            ],
        ];

        return $labels[$this->availability][$lang] ?? $labels[$this->availability]['en'];
    }

    // used in product page.
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('availability', 'in_stock');
    }
}