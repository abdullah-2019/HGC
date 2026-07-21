<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutCarouselSlide;
use App\Models\AboutCoreValue;
use App\Models\AboutMission;
use App\Models\AboutPageSetting;
use App\Models\AboutStory;
use App\Models\AboutVision;
use App\Models\Stat;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    use ApiResponseTrait;

    private const CACHE_KEY = 'about_page_data';
    private const CACHE_TTL = 3600;

    /**
     * GET /api/about
     */
    public function index(): JsonResponse
    {
        // 🔧 FIX: Check both environment AND request header for cache skip
        $skipCache = app()->environment('local') || request()->header('X-Skip-Cache') === 'true';
        
        if ($skipCache) {
            Cache::forget(self::CACHE_KEY);
        }

        $data = Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return [
                'settings' => $this->getSettings(),
                'story' => $this->getStory(),
                'stats' => $this->getStats(),
                'carousel' => $this->getCarousel(),
                'mission' => $this->getMission(),
                'vision' => $this->getVision(),
                'coreValues' => $this->getCoreValues(),
            ];
        });

        return $this->successResponse($data);
    }

    /**
     * GET /api/about/settings
     */
    public function settings(): JsonResponse
    {
        $settings = AboutPageSetting::active()->first();

        if (!$settings) {
            return $this->errorResponse('About page settings not found', 404);
        }

        return $this->successResponse([
            'hero' => [
                'backgroundImage' => $this->resolveImageUrl($settings->hero_background_image),
                'label' => [
                    'en' => $settings->hero_label_en,
                    'dari' => $settings->hero_label_dari,
                    'pashto' => $settings->hero_label_pashto,
                ],
                'title' => [
                    'en' => $settings->hero_title_en,
                    'dari' => $settings->hero_title_dari,
                    'pashto' => $settings->hero_title_pashto,
                ],
                'subtitle' => [
                    'en' => $settings->hero_subtitle_en,
                    'dari' => $settings->hero_subtitle_dari,
                    'pashto' => $settings->hero_subtitle_pashto,
                ],
            ],
            'meta' => [
                'title' => [
                    'en' => $settings->meta_title_en,
                    'dari' => $settings->meta_title_dari,
                    'pashto' => $settings->meta_title_pashto,
                ],
                'description' => [
                    'en' => $settings->meta_description_en,
                    'dari' => $settings->meta_description_dari,
                    'pashto' => $settings->meta_description_pashto,
                ],
            ],
        ]);
    }

    /**
     * GET /api/about/story
     */
    public function story(): JsonResponse
    {
        $story = AboutStory::with(['highlights' => function ($query) {
            $query->active()->ordered();
        }])
            ->active()
            ->ordered()
            ->first();

        if (!$story) {
            return $this->errorResponse('About story not found', 404);
        }

        return $this->successResponse([
            'sectionLabel' => [
                'en' => $story->section_label_en,
                'dari' => $story->section_label_dari,
                'pashto' => $story->section_label_pashto,
            ],
            'title' => [
                'en' => $story->title_en,
                'dari' => $story->title_dari,
                'pashto' => $story->title_pashto,
            ],
            'foundedYear' => $story->founded_year,
            'paragraphs' => [
                [
                    'en' => $story->paragraph_1_en,
                    'dari' => $story->paragraph_1_dari,
                    'pashto' => $story->paragraph_1_pashto,
                ],
                [
                    'en' => $story->paragraph_2_en,
                    'dari' => $story->paragraph_2_dari,
                    'pashto' => $story->paragraph_2_pashto,
                ],
                [
                    'en' => $story->paragraph_3_en,
                    'dari' => $story->paragraph_3_dari,
                    'pashto' => $story->paragraph_3_pashto,
                ],
            ],
            'mainImage' => $this->resolveImageUrl($story->main_image),
            'floatingCard' => [
                'value' => $story->floating_card_value,
                'label' => [
                    'en' => $story->floating_card_label_en,
                    'dari' => $story->floating_card_label_dari,
                    'pashto' => $story->floating_card_label_pashto,
                ],
            ],
            'highlights' => $story->highlights->map(function ($highlight) {
                return [
                    'icon' => $highlight->icon_name,
                    'label' => [
                        'en' => $highlight->label_en,
                        'dari' => $highlight->label_dari,
                        'pashto' => $highlight->label_pashto,
                    ],
                    'value' => $highlight->value_text,
                ];
            })->values()->all(), // <-- FIX: convert Collection to array
        ]);
    }

    /**
     * GET /api/about/stats
     */
    public function stats(): JsonResponse
    {
        $stats = Stat::active()
            ->ordered()
            ->get();

        return $this->successResponse(
            $stats->map(function ($stat) {
                return [
                    'key' => $stat->key,
                    'value' => $stat->value,
                    'suffix' => $stat->suffix,
                    'label' => [
                        'en' => $stat->label_en,
                        'dari' => $stat->label_dari,
                        'pashto' => $stat->label_pashto,
                    ],
                    'icon' => $stat->icon_name,
                ];
            })->values()->all() // <-- FIX
        );
    }

    /**
     * GET /api/about/carousel
     */
    public function carousel(): JsonResponse
    {
        $slides = AboutCarouselSlide::active()
            ->ordered()
            ->get();

        return $this->successResponse(
            $slides->map(function ($slide) {
                return [
                    'image' => $this->resolveImageUrl($slide->image_url),
                    'title' => [
                        'en' => $slide->title_en,
                        'dari' => $slide->title_dari,
                        'pashto' => $slide->title_pashto,
                    ],
                    'location' => [
                        'en' => $slide->location_en,
                        'dari' => $slide->location_dari,
                        'pashto' => $slide->location_pashto,
                    ],
                ];
            })->values()->all() // <-- FIX
        );
    }

    /**
     * GET /api/about/mission
     */
    public function mission(): JsonResponse
    {
        $mission = AboutMission::with(['points' => function ($query) {
            $query->active()->ordered();
        }])
            ->active()
            ->ordered()
            ->first();

        if (!$mission) {
            return $this->errorResponse('Mission data not found', 404);
        }

        return $this->successResponse([
            'sectionLabel' => [
                'en' => $mission->section_label_en,
                'dari' => $mission->section_label_dari,
                'pashto' => $mission->section_label_pashto,
            ],
            'title' => [
                'en' => $mission->title_en,
                'dari' => $mission->title_dari,
                'pashto' => $mission->title_pashto,
            ],
            'description' => [
                'en' => $mission->description_en,
                'dari' => $mission->description_dari,
                'pashto' => $mission->description_pashto,
            ],
            'image' => $this->resolveImageUrl($mission->image_url),
            'quote' => [
                'en' => $mission->quote_text_en,
                'dari' => $mission->quote_text_dari,
                'pashto' => $mission->quote_text_pashto,
            ],
            'points' => $mission->points->map(function ($point) {
                return [
                    'text' => [
                        'en' => $point->text_en,
                        'dari' => $point->text_dari,
                        'pashto' => $point->text_pashto,
                    ],
                ];
            })->values()->all(), // <-- FIX
        ]);
    }

    /**
     * GET /api/about/vision
     */
    public function vision(): JsonResponse
    {
        $vision = AboutVision::with(['pillars' => function ($query) {
            $query->active()->ordered();
        }])
            ->active()
            ->ordered()
            ->first();

        if (!$vision) {
            return $this->errorResponse('Vision data not found', 404);
        }

        return $this->successResponse([
            'sectionLabel' => [
                'en' => $vision->section_label_en,
                'dari' => $vision->section_label_dari,
                'pashto' => $vision->section_label_pashto,
            ],
            'title' => [
                'en' => $vision->title_en,
                'dari' => $vision->title_dari,
                'pashto' => $vision->title_pashto,
            ],
            'description' => [
                'en' => $vision->description_en,
                'dari' => $vision->description_dari,
                'pashto' => $vision->description_pashto,
            ],
            'image' => $this->resolveImageUrl($vision->image_url),
            'badge' => [
                'value' => $vision->badge_value,
                'label' => [
                    'en' => $vision->badge_label_en,
                    'dari' => $vision->badge_label_dari,
                    'pashto' => $vision->badge_label_pashto,
                ],
            ],
            'pillars' => $vision->pillars->map(function ($pillar) {
                return [
                    'icon' => $pillar->icon_name,
                    'title' => [
                        'en' => $pillar->title_en,
                        'dari' => $pillar->title_dari,
                        'pashto' => $pillar->title_pashto,
                    ],
                    'description' => [
                        'en' => $pillar->description_en,
                        'dari' => $pillar->description_dari,
                        'pashto' => $pillar->description_pashto,
                    ],
                ];
            })->values()->all(), // <-- FIX
        ]);
    }

    /**
     * GET /api/about/core-values
     */
    public function coreValues(): JsonResponse
    {
        $values = AboutCoreValue::active()
            ->ordered()
            ->get();

        $header = $values->first();

        return $this->successResponse([
            'sectionLabel' => [
                'en' => $header?->section_label_en,
                'dari' => $header?->section_label_dari,
                'pashto' => $header?->section_label_pashto,
            ],
            'sectionTitle' => [
                'en' => $header?->section_title_en,
                'dari' => $header?->section_title_dari,
                'pashto' => $header?->section_title_pashto,
            ],
            'sectionDescription' => [
                'en' => $header?->section_description_en,
                'dari' => $header?->section_description_dari,
                'pashto' => $header?->section_description_pashto,
            ],
            'values' => $values->map(function ($value) {
                return [
                    'icon' => $value->icon_name,
                    'title' => [
                        'en' => $value->title_en,
                        'dari' => $value->title_dari,
                        'pashto' => $value->title_pashto,
                    ],
                    'description' => [
                        'en' => $value->description_en,
                        'dari' => $value->description_dari,
                        'pashto' => $value->description_pashto,
                    ],
                ];
            })->values()->all(), // <-- FIX
        ]);
    }

    // ─── Private helpers ───

    private function getSettings(): ?array
    {
        $settings = AboutPageSetting::active()->first();
        if (!$settings) return null;

        return [
            'hero' => [
                'backgroundImage' => $this->resolveImageUrl($settings->hero_background_image),
                'label' => [
                    'en' => $settings->hero_label_en,
                    'dari' => $settings->hero_label_dari,
                    'pashto' => $settings->hero_label_pashto,
                ],
                'title' => [
                    'en' => $settings->hero_title_en,
                    'dari' => $settings->hero_title_dari,
                    'pashto' => $settings->hero_title_pashto,
                ],
                'subtitle' => [
                    'en' => $settings->hero_subtitle_en,
                    'dari' => $settings->hero_subtitle_dari,
                    'pashto' => $settings->hero_subtitle_pashto,
                ],
            ],
            'meta' => [
                'title' => [
                    'en' => $settings->meta_title_en,
                    'dari' => $settings->meta_title_dari,
                    'pashto' => $settings->meta_title_pashto,
                ],
                'description' => [
                    'en' => $settings->meta_description_en,
                    'dari' => $settings->meta_description_dari,
                    'pashto' => $settings->meta_description_pashto,
                ],
            ],
        ];
    }

    private function getStory(): ?array
    {
        $story = AboutStory::with(['highlights' => fn($q) => $q->active()->ordered()])
            ->active()
            ->ordered()
            ->first();

        if (!$story) return null;

        return [
            'sectionLabel' => [
                'en' => $story->section_label_en,
                'dari' => $story->section_label_dari,
                'pashto' => $story->section_label_pashto,
            ],
            'title' => [
                'en' => $story->title_en,
                'dari' => $story->title_dari,
                'pashto' => $story->title_pashto,
            ],
            'foundedYear' => $story->founded_year,
            'paragraphs' => [
                ['en' => $story->paragraph_1_en, 'dari' => $story->paragraph_1_dari, 'pashto' => $story->paragraph_1_pashto],
                // ['en' => $story->paragraph_2_en, 'dari' => $story->paragraph_2_dari, 'pashto' => $story->paragraph_2_pashto],
                // ['en' => $story->paragraph_3_en, 'dari' => $story->paragraph_3_dari, 'pashto' => $story->paragraph_3_pashto],
            ],
            'mainImage' => $this->resolveImageUrl($story->main_image),
            'floatingCard' => [
                'value' => $story->floating_card_value,
                'label' => [
                    'en' => $story->floating_card_label_en,
                    'dari' => $story->floating_card_label_dari,
                    'pashto' => $story->floating_card_label_pashto,
                ],
            ],
            // FIX: Added ->values()->all() to convert Collection to array
            'highlights' => $story->highlights->map(fn($h) => [
                'icon' => $h->icon_name,
                'label' => ['en' => $h->label_en, 'dari' => $h->label_dari, 'pashto' => $h->label_pashto],
                'value' => $h->value_text,
            ])->values()->all(),
        ];
    }

    private function getStats(): array
    {
        return Stat::active()
            ->ordered()
            ->get()
            ->map(fn($s) => [
                'key' => $s->key,
                'value' => $s->value,
                'suffix' => $s->suffix,
                'label' => ['en' => $s->label_en, 'dari' => $s->label_dari, 'pashto' => $s->label_pashto],
                'icon' => $s->icon_name,
            ])
            ->values()->all(); // Already had ->toArray() in original, but ->values()->all() is safer
    }

    private function getCarousel(): array
    {
        return AboutCarouselSlide::active()
            ->ordered()
            ->get()
            ->map(fn($s) => [
                'image' => $this->resolveImageUrl($s->image_url),
                'title' => ['en' => $s->title_en, 'dari' => $s->title_dari, 'pashto' => $s->title_pashto],
                'location' => ['en' => $s->location_en, 'dari' => $s->location_dari, 'pashto' => $s->location_pashto],
            ])
            ->values()->all();
    }

    private function getMission(): ?array
    {
        $mission = AboutMission::with(['points' => fn($q) => $q->active()->ordered()])
            ->active()
            ->ordered()
            ->first();

        if (!$mission) return null;

        return [
            'sectionLabel' => [
                'en' => $mission->section_label_en,
                'dari' => $mission->section_label_dari,
                'pashto' => $mission->section_label_pashto,
            ],
            'title' => [
                'en' => $mission->title_en,
                'dari' => $mission->title_dari,
                'pashto' => $mission->title_pashto,
            ],
            'description' => [
                'en' => $mission->description_en,
                'dari' => $mission->description_dari,
                'pashto' => $mission->description_pashto,
            ],
            'image' => $this->resolveImageUrl($mission->image_url),
            'quote' => [
                'en' => $mission->quote_text_en,
                'dari' => $mission->quote_text_dari,
                'pashto' => $mission->quote_text_pashto,
            ],
            // FIX: Added ->values()->all()
            'points' => $mission->points->map(fn($p) => [
                'text' => ['en' => $p->text_en, 'dari' => $p->text_dari, 'pashto' => $p->text_pashto],
            ])->values()->all(),
        ];
    }

    private function getVision(): ?array
    {
        $vision = AboutVision::with(['pillars' => fn($q) => $q->active()->ordered()])
            ->active()
            ->ordered()
            ->first();

        if (!$vision) return null;

        return [
            'sectionLabel' => [
                'en' => $vision->section_label_en,
                'dari' => $vision->section_label_dari,
                'pashto' => $vision->section_label_pashto,
            ],
            'title' => [
                'en' => $vision->title_en,
                'dari' => $vision->title_dari,
                'pashto' => $vision->title_pashto,
            ],
            'description' => [
                'en' => $vision->description_en,
                'dari' => $vision->description_dari,
                'pashto' => $vision->description_pashto,
            ],
            'image' => $this->resolveImageUrl($vision->image_url),
            'badge' => [
                'value' => $vision->badge_value,
                'label' => [
                    'en' => $vision->badge_label_en,
                    'dari' => $vision->badge_label_dari,
                    'pashto' => $vision->badge_label_pashto,
                ],
            ],
            // FIX: Added ->values()->all()
            'pillars' => $vision->pillars->map(fn($p) => [
                'icon' => $p->icon_name,
                'title' => ['en' => $p->title_en, 'dari' => $p->title_dari, 'pashto' => $p->title_pashto],
                'description' => ['en' => $p->description_en, 'dari' => $p->description_dari, 'pashto' => $p->description_pashto],
            ])->values()->all(),
        ];
    }

    private function getCoreValues(): ?array
    {
        $values = AboutCoreValue::active()->ordered()->get();
        if ($values->isEmpty()) return null;

        $header = $values->first();

        return [
            'sectionLabel' => [
                'en' => $header->section_label_en,
                'dari' => $header->section_label_dari,
                'pashto' => $header->section_label_pashto,
            ],
            'sectionTitle' => [
                'en' => $header->section_title_en,
                'dari' => $header->section_title_dari,
                'pashto' => $header->section_title_pashto,
            ],
            'sectionDescription' => [
                'en' => $header->section_description_en,
                'dari' => $header->section_description_dari,
                'pashto' => $header->section_description_pashto,
            ],
            // FIX: Added ->values()->all()
            'values' => $values->map(fn($v) => [
                'icon' => $v->icon_name,
                'title' => ['en' => $v->title_en, 'dari' => $v->title_dari, 'pashto' => $v->title_pashto],
                'description' => ['en' => $v->description_en, 'dari' => $v->description_dari, 'pashto' => $v->description_pashto],
            ])->values()->all(),
        ];
    }

    /**
     * Resolves image paths to full URLs.
     * Handles: full URLs, /absolute/paths, uploads/relative/paths, and nulls.
     */
    // In your AboutPageController, add this private method:
    private function resolveImageUrl(?string $path): string
    {
        if (empty($path)) {
            return asset('images/placeholder.png');
        }

        // Already a full URL
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Already starts with /
        if (str_starts_with($path, '/')) {
            return asset(ltrim($path, '/'));
        }

        // Relative path like "uploads/hero-construction.webp"
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->url($path);
        }

        return asset('storage/' . $path);
    }
    
}