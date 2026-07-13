<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\AboutStory;
use App\Models\AboutCarouselSlide;
use App\Models\AboutStoryHighlight;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        $cacheKey = "about_page_data_{$lang}";

        // Skip cache in local dev for instant DB changes
        if (app()->environment('local')) {
            Cache::forget($cacheKey);
        }

        $data = Cache::remember($cacheKey, 3600, function () use ($lang) {
            
            // ─── Story ─────────────────────────────────────────────
            $story = AboutStory::where('is_active', 1)
                ->orderBy('sort_order')
                ->first();

            $storyData = null;
            if ($story) {
                $highlights = AboutStoryHighlight::where('about_story_id', $story->id)
                    ->where('is_active', 1)
                    ->orderBy('sort_order')
                    ->get()
                    ->map(fn ($h) => [
                        'icon' => $h->icon_name,
                        'label' => $h->{"label_{$lang}"} ?? $h->label_en,
                        'value' => $h->value_text,
                    ]);

                $storyData = [
                    'sectionLabel' => $story->{"section_label_{$lang}"} ?? $story->section_label_en,
                    'title' => $story->{"title_{$lang}"} ?? $story->title_en,
                    'foundedYear' => (int) $story->founded_year,
                    'paragraphs' => array_values(array_filter([
                        $story->{"paragraph_1_{$lang}"} ?? $story->paragraph_1_en,
                        $story->{"paragraph_2_{$lang}"} ?? $story->paragraph_2_en,
                        $story->{"paragraph_3_{$lang}"} ?? $story->paragraph_3_en,
                    ])),
                    'mainImage' => $story->main_image 
                        ? (str_starts_with($story->main_image, 'http') 
                            ? $story->main_image 
                            : url('storage/' . $story->main_image)) 
                        : null,
                    'highlights' => $highlights->values()->all(),
                ];
            }

            // ─── Carousel Slides ───────────────────────────────────
            $slides = AboutCarouselSlide::where('is_active', 1)
                ->orderBy('sort_order')
                ->get()
                ->map(fn ($s) => [
                    'image' => $s->image_url 
                        ? (str_starts_with($s->image_url, 'http') 
                            ? $s->image_url 
                            : url('storage/' . $s->image_url)) 
                        : null,
                    'title' => $s->{"title_{$lang}"} ?? $s->title_en,
                    'location' => $s->{"location_{$lang}"} ?? $s->location_en,
                ]);

            return [
                'story' => $storyData,
                'carousel' => $slides->values()->all(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}