<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseFeature extends Model
{
    use HasFactory;

    protected $table = 'why_choose_features';

    protected $fillable = [
        'icon_name',
        'title_en',
        'title_dari',
        'title_pashto',
        'description_en',
        'description_dari',
        'description_pashto',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}