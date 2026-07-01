<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * List all active sectors
     * GET /api/sectors
     */
    public function index(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $sectors = Sector::active()
            ->ordered()
            ->select([
                'id', 'slug', 'icon_name', 'projects_count', 'image_url',
                'name_en', 'name_dari', 'name_pashto',
                'description_en', 'description_dari', 'description_pashto',
            ])
            ->get()
            ->map(function ($sector) use ($lang) {
                return [
                    'id' => $sector->id,
                    'slug' => $sector->slug,
                    'name' => $sector->getLocalizedName($lang),
                    'description' => $sector->getLocalizedDescription($lang),
                    'icon_name' => $sector->icon_name,
                    'projects_count' => $sector->projects_count,
                    'image_url' => $sector->image_url,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $sectors,
        ]);
    }

    /**
     * Get single sector
     * GET /api/sectors/{slug}
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $sector = Sector::active()
            ->where('slug', $slug)
            ->first();

        if (!$sector) {
            return response()->json([
                'success' => false,
                'message' => 'Sector not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $sector->id,
                'slug' => $sector->slug,
                'name' => $sector->getLocalizedName($lang),
                'description' => $sector->getLocalizedDescription($lang),
                'icon_name' => $sector->icon_name,
                'projects_count' => $sector->projects_count,
                'image_url' => $sector->image_url,
            ],
        ]);
    }
}