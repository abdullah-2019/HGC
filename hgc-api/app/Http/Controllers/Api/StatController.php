<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StatController extends Controller
{
    /**
     * Get global stats (for homepage stats bar)
     * GET /api/stats
     */
    public function index(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $stats = Stat::active()
            ->global()
            ->ordered()
            ->get()
            ->map(function ($stat) use ($lang) {
                return [
                    'id' => $stat->id,
                    'key' => $stat->key,
                    'value' => $stat->value,
                    'suffix' => $stat->suffix,
                    'label' => $stat->getLocalizedLabel($lang),
                    'icon_name' => $stat->icon_name,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }

    /**
     * Get stats for a specific company
     * GET /api/companies/{slug}/stats
     */
    public function byCompany(Request $request, string $companySlug): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $company = \App\Models\Company::active()->where('slug', $companySlug)->first();

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found',
            ], 404);
        }

        $stats = Stat::active()
            ->forCompany($company->id)
            ->ordered()
            ->get()
            ->map(function ($stat) use ($lang) {
                return [
                    'id' => $stat->id,
                    'key' => $stat->key,
                    'value' => $stat->value,
                    'suffix' => $stat->suffix,
                    'label' => $stat->getLocalizedLabel($lang),
                    'icon_name' => $stat->icon_name,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $stats,
        ]);
    }
}