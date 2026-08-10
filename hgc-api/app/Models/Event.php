<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title_en', 'title_dari', 'title_pashto',
        'description_en', 'description_dari', 'description_pashto',
        'location_en', 'location_dari', 'location_pashto',
        'event_date', 'event_time',
        'cover_image', 'is_published', 'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'event_date' => 'date',
    ];
}