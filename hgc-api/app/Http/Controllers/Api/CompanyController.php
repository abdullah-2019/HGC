<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * GET /api/companies
     * List all active companies (for grid/list view)
     */
    public function index(Request $request): JsonResponse
    {
        $lang = $request->header('Accept-Language', 'en');
        $lang = in_array($lang, ['en', 'dari', 'pashto']) ? $lang : 'en';

        $companies = Company::active()
            ->ordered()
            ->select([
                'id', 'slug', 'accent_color', 'icon_name', 'logo_path',
                'name_en', 'name_dari', 'name_pashto',
                'short_name_en', 'short_name_dari', 'short_name_pashto',
                'description_en', 'description_dari', 'description_pashto',
                'sector_en', 'sector_dari', 'sector_pashto',
                'founded_year', 'employee_count',
            ])
            ->get()
            ->map(function ($company) use ($lang) {
                return [
                    'id' => $company->id,
                    'slug' => $company->slug,
                    'name' => $company->getNameAttribute($lang),
                    'short_name' => match($lang) {
                        'dari' => $company->short_name_dari ?? $company->short_name_en,
                        'pashto' => $company->short_name_pashto ?? $company->short_name_en,
                        default => $company->short_name_en,
                    },
                    'description' => $company->getDescriptionAttribute($lang),
                    'sector' => $company->getSectorAttribute($lang),
                    'accent_color' => $company->accent_color,
                    'icon_name' => $company->icon_name,
                    'logo_path' => $company->logo_path,
                    'founded_year' => $company->founded_year,
                    'employee_count' => $company->employee_count,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $companies,
        ]);
    }

    /**
     * GET /api/companies/featured
     * List featured companies only
     */
    public function featured(Request $request): JsonResponse
    {
        $lang = $request->header('Accept-Language', 'en');
        $lang = in_array($lang, ['en', 'dari', 'pashto']) ? $lang : 'en';

        $companies = Company::active()
            ->featured()
            ->ordered()
            ->select([
                'id', 'slug', 'accent_color', 'icon_name', 'logo_path',
                'name_en', 'name_dari', 'name_pashto',
                'short_name_en', 'short_name_dari', 'short_name_pashto',
                'description_en', 'description_dari', 'description_pashto',
                'sector_en', 'sector_dari', 'sector_pashto',
            ])
            ->get()
            ->map(function ($company) use ($lang) {
                return [
                    'id' => $company->id,
                    'slug' => $company->slug,
                    'name' => $company->getNameAttribute($lang),
                    'short_name' => match($lang) {
                        'dari' => $company->short_name_dari ?? $company->short_name_en,
                        'pashto' => $company->short_name_pashto ?? $company->short_name_en,
                        default => $company->short_name_en,
                    },
                    'description' => $company->getDescriptionAttribute($lang),
                    'sector' => $company->getSectorAttribute($lang),
                    'accent_color' => $company->accent_color,
                    'icon_name' => $company->icon_name,
                    'logo_path' => $company->logo_path,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $companies,
        ]);
    }

    /**
     * GET /api/companies/{slug}
     * Get single company detail (for company profile page)
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $lang = $request->header('Accept-Language', 'en');
        $lang = in_array($lang, ['en', 'dari', 'pashto']) ? $lang : 'en';

        $company = Company::active()
            ->where('slug', $slug)
            ->first();

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $company->id,
                'slug' => $company->slug,
                'name' => $company->getNameAttribute($lang),
                'short_name' => match($lang) {
                    'dari' => $company->short_name_dari ?? $company->short_name_en,
                    'pashto' => $company->short_name_pashto ?? $company->short_name_en,
                    default => $company->short_name_en,
                },
                'description' => $company->getDescriptionAttribute($lang),
                'sector' => $company->getSectorAttribute($lang),
                'about' => $company->getAboutAttribute($lang),
                'mission' => $company->getMissionAttribute($lang),
                'vision' => $company->getVisionAttribute($lang),
                'accent_color' => $company->accent_color,
                'icon_name' => $company->icon_name,
                'logo_path' => $company->logo_path,
                'hero_image_path' => $company->hero_image_path,
                'email' => $company->email,
                'phone' => $company->phone,
                'website' => $company->website,
                'address' => $company->getAddressAttribute($lang),
                'latitude' => $company->latitude,
                'longitude' => $company->longitude,
                'facebook_url' => $company->facebook_url,
                'linkedin_url' => $company->linkedin_url,
                'twitter_url' => $company->twitter_url,
                'instagram_url' => $company->instagram_url,
                'founded_year' => $company->founded_year,
                'registration_number' => $company->registration_number,
                'tax_id' => $company->tax_id,
                'employee_count' => $company->employee_count,
                'meta_title' => $company->getMetaTitleAttribute($lang),
                'meta_description' => $company->getMetaDescriptionAttribute($lang),
            ],
        ]);
    }
}