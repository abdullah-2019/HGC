<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseFeature;
use Illuminate\Http\JsonResponse;

class WhyChooseController extends Controller
{
    /**
     * GET /api/why-choose
     * Returns active why-choose features ordered by sort_order
     */
    public function index(): JsonResponse
    {
        $features = WhyChooseFeature::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get([
                'id',
                'icon_name',
                'title_en',
                'title_dari',
                'title_pashto',
                'description_en',
                'description_dari',
                'description_pashto',
            ]);

        $mapped = $features->map(function ($f) {
            return [
                'id' => $f->id,
                'icon' => $f->icon_name ?? 'Award',
                'titleEn' => $f->title_en,
                'titleDari' => $f->title_dari,
                'titlePashto' => $f->title_pashto,
                'descEn' => $f->description_en,
                'descDari' => $f->description_dari,
                'descPashto' => $f->description_pashto,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $mapped,
        ]);
    }
}