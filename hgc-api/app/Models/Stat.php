<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value', 'suffix',
        'label_en', 'label_dari', 'label_pashto',
        'icon_name', 'company_id',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'value' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGlobal($query)
    {
        return $query->whereNull('company_id');
    }

    public function scopeForCompany($query, int $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getLocalizedLabel(string $lang = 'en'): string
    {
        return match ($lang) {
            'dari' => $this->label_dari ?? $this->label_en,
            'pashto' => $this->label_pashto ?? $this->label_en,
            default => $this->label_en,
        };
    }
}
