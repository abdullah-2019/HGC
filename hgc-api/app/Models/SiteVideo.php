<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteVideo extends Model
{
    use HasFactory;

    protected $fillable = ['video_file', 'video_url', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}