<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;

class NewsArticleController extends Controller
{
    private function resolveField($article, string $field, string $lang)
    {
        // Try requested language
        $val = $article->{"{$field}_{$lang}"};
        if (!empty($val)) return $val;

        // Fallback to English
        $val = $article->{"{$field}_en"};
        if (!empty($val)) return $val;

        // Fallback to any available language
        foreach (['en', 'dari', 'pashto'] as $l) {
            $val = $article->{"{$field}_{$l}"};
            if (!empty($val)) return $val;
        }

        return null;
    }

    private function resolveImage($article)
    {
        if (empty($article->cover_image_url)) {
            return null;
        }

        // If already a full URL, return as-is
        if (str_starts_with($article->cover_image_url, 'http')) {
            return $article->cover_image_url;
        }

        // Otherwise treat as storage path
        return asset('storage/' . ltrim($article->cover_image_url, '/'));
    }

    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'dari', 'pashto'])) {
            $lang = 'en';
        }

        $articles = NewsArticle::where('is_published', true)
            ->orderByDesc('published_at')
            ->get()
            ->map(function ($article) use ($lang) {
                return [
                    'id' => $article->id,
                    'slug' => $article->slug,
                    'title' => $this->resolveField($article, 'title', $lang),
                    'excerpt' => $this->resolveField($article, 'excerpt', $lang) ?? '',
                    'category' => $article->category,
                    'cover_image' => $this->resolveImage($article),
                    'published_at' => $article->published_at,
                ];
            });

        return response()->json(['success' => true, 'data' => $articles]);
    }

    public function show(Request $request, $slug)
    {
        $lang = $request->query('lang', 'en');
        if (!in_array($lang, ['en', 'dari', 'pashto'])) {
            $lang = 'en';
        }

        $article = NewsArticle::where('slug', $slug)
            ->where('is_published', true)
            ->first();

        if (!$article) {
            return response()->json(['success' => false, 'message' => 'Not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $article->id,
                'slug' => $article->slug,
                'title' => $this->resolveField($article, 'title', $lang),
                'excerpt' => $this->resolveField($article, 'excerpt', $lang) ?? '',
                'content' => $this->resolveField($article, 'content', $lang) ?? '',
                'category' => $article->category,
                'cover_image' => $this->resolveImage($article),
                'published_at' => $article->published_at,
            ]
        ]);
    }
}