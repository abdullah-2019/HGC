<?php
// app/Models/CompanyAwards.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAwards extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'icon_name',
        'sort_order',
        'award_year',
        'title_en',
        'title_dari',
        'title_pashto',
        'description_en',
        'description_dari',
        'description_pashto',
        'organization_en',
        'organization_dari',
        'organization_pashto',
        'image_url',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'award_year' => 'integer',
        'sort_order' => 'integer',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getLocalizedTitle(string $lang): string
    {
        return match ($lang) {
            'dari' => $this->title_dari ?? $this->title_en,
            'pashto' => $this->title_pashto ?? $this->title_en,
            default => $this->title_en,
        };
    }

    public function getLocalizedDescription(string $lang): ?string
    {
        return match ($lang) {
            'dari' => $this->description_dari ?? $this->description_en,
            'pashto' => $this->description_pashto ?? $this->description_en,
            default => $this->description_en,
        };
    }

    public function getLocalizedOrganization(string $lang): ?string
    {
        return match ($lang) {
            'dari' => $this->organization_dari ?? $this->organization_en,
            'pashto' => $this->organization_pashto ?? $this->organization_en,
            default => $this->organization_en,
        };
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('award_year', 'desc');
    }
}