<?php
// app/Models/CompanyValues.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyValues extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'icon_name',
        'sort_order',
        'title_en',
        'title_dari',
        'title_pashto',
        'description_en',
        'description_dari',
        'description_pashto',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    
    public function getLocalizedTitle(string $lang): ?string
    {
        return match($lang) {
            'dari' => $this->title_dari ?? $this->title_en,
            'pashto' => $this->title_pashto ?? $this->title_en,
            default => $this->title_en,
        };
    }

    public function getLocalizedDescription(string $lang): ?string
    {
        return match($lang) {
            'dari' => $this->description_dari ?? $this->description_en,
            'pashto' => $this->description_pashto ?? $this->description_en,
            default => $this->description_en,
        };
    }
}
