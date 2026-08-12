<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsArticle extends Model
{
    use HasFactory;

    protected $table = 'news_articles';

    protected $fillable = [
        'slug',
        'title_en',
        'title_dari',
        'title_pashto',
        'excerpt_en',
        'excerpt_dari',
        'excerpt_pashto',
        'content_en',
        'content_dari',
        'content_pashto',
        'cover_image_url',
        'author_name',
        'category',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];
}