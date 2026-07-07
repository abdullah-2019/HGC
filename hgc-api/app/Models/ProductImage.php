<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'image_url',
        'caption_en', 'caption_dari', 'caption_pashto',
        'sort_order', 'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute($value): ?string
    {
        return $value ? asset('storage/' . $value) : null;
    }

    public function getLocalizedCaption(string $lang = 'en'): ?string
    {
        return match ($lang) {
            'dari' => $this->caption_dari ?? $this->caption_en,
            'pashto' => $this->caption_pashto ?? $this->caption_en,
            default => $this->caption_en,
        };
    }
}