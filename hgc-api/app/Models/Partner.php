<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';

    protected $fillable = [
        'name',
        'full_name',
        'slug',
        'type',
        'type_label_en',
        'type_label_dari',
        'logo_url',
        'website_url',
        'projects_count',
        'partnership_since',
        'description_en',
        'description_dari',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'projects_count' => 'integer',
        'partnership_since' => 'integer',
        'is_active' => 'boolean',
    ];
}