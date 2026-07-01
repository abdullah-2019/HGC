<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * List all active companies (for the grid section)
     * GET /api/companies
     */
    public function index(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $companies = Company::active()
            ->ordered()
            ->select([
                'id', 'slug', 'accent_color', 'icon_name',
                'name_en', 'name_dari', 'name_pashto',
                'description_en', 'description_dari', 'description_pashto',
                'short_name_en', 'short_name_dari', 'short_name_pashto',
                'logo_url', 'hero_image_path',
            ])
            ->get()
            ->map(function ($company) use ($lang) {
                return [
                    'id' => $company->id,
                    'slug' => $company->slug,
                    'name' => $company->getLocalizedName($lang),
                    'short_name' => $company->getLocalizedShortName($lang),
                    'description' => $company->getLocalizedDescription($lang),
                    'accent_color' => $company->accent_color,
                    'icon_name' => $company->icon_name,
                    'logo_url' => $company->logo_url,
                    'hero_image_url' => $company->hero_image_url,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $companies,
        ]);
    }

    /**
     * Get single company by slug (for detail page)
     * GET /api/companies/{slug}
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $lang = $request->get('lang', 'en');

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
            'data' => $this->formatCompanyDetail($company, $lang),
        ]);
    }

    /**
     * Get featured companies
     * GET /api/companies/featured
     */
    public function featured(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $companies = Company::active()
            ->featured()
            ->ordered()
            ->select([
                'id', 'slug', 'accent_color', 'icon_name',
                'name_en', 'name_dari', 'name_pashto',
                'description_en', 'description_dari', 'description_pashto',
                'tagline_en', 'tagline_dari', 'tagline_pashto',
                'logo_url', 'hero_image_path',
            ])
            ->get()
            ->map(function ($company) use ($lang) {
                return [
                    'id' => $company->id,
                    'slug' => $company->slug,
                    'name' => $company->getLocalizedName($lang),
                    'tagline' => $company->getLocalizedTagline($lang),
                    'description' => $company->getLocalizedDescription($lang),
                    'accent_color' => $company->accent_color,
                    'icon_name' => $company->icon_name,
                    'logo_url' => $company->logo_url,
                    'hero_image_url' => $company->hero_image_url,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $companies,
        ]);
    }

    /**
     * Get company profile page data (full detail)
     * GET /api/companies/{slug}/profile
     */
    public function profile(Request $request, string $slug): JsonResponse
    {
        $lang = $request->get('lang', 'en');

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
            'data' => $this->formatCompanyProfile($company, $lang),
        ]);
    }

    /**
     * Format company for detail view
     */
    private function formatCompanyDetail(Company $company, string $lang): array
    {
        return [
            'id' => $company->id,
            'slug' => $company->slug,
            'name' => $company->getLocalizedName($lang),
            'short_name' => $company->getLocalizedShortName($lang),
            'description' => $company->getLocalizedDescription($lang),
            'sector' => $company->getLocalizedSector($lang),
            'accent_color' => $company->accent_color,
            'secondary_color' => $company->secondary_color,
            'icon_name' => $company->icon_name,
            'logo_url' => $company->logo_url,
            'hero_image_url' => $company->hero_image_url,
            'email' => $company->email,
            'phone' => $company->phone,
            'address' => $company->getLocalizedAddress($lang),
            'website' => $company->website ?? $company->website_url,
            'social' => [
                'facebook' => $company->facebook_url,
                'linkedin' => $company->linkedin_url,
                'twitter' => $company->twitter_url,
                'instagram' => $company->instagram_url,
            ],
            'meta' => [
                'title' => $company->getLocalizedMetaTitle($lang),
                'description' => $company->getLocalizedMetaDescription($lang),
            ],
        ];
    }

    /**
     * Format company for full profile view
     */
    private function formatCompanyProfile(Company $company, string $lang): array
    {
        return [
            'id' => $company->id,
            'slug' => $company->slug,
            'name' => $company->getLocalizedName($lang),
            'short_name' => $company->getLocalizedShortName($lang),
            'tagline' => $company->getLocalizedTagline($lang),
            'description' => $company->getLocalizedDescription($lang),
            'sector' => $company->getLocalizedSector($lang),
            'about' => $company->getLocalizedAbout($lang),
            'mission' => $company->getLocalizedMission($lang),
            'vision' => $company->getLocalizedVision($lang),
            'accent_color' => $company->accent_color,
            'secondary_color' => $company->secondary_color,
            'icon_name' => $company->icon_name,
            'logo_url' => $company->logo_url,
            'hero_image_url' => $company->hero_image_url,
            'contact' => [
                'email' => $company->email,
                'phone' => $company->phone,
                'address' => $company->getLocalizedAddress($lang),
                'latitude' => $company->latitude,
                'longitude' => $company->longitude,
            ],
            'web' => [
                'website' => $company->website ?? $company->website_url,
                'facebook' => $company->facebook_url,
                'linkedin' => $company->linkedin_url,
                'twitter' => $company->twitter_url,
                'instagram' => $company->instagram_url,
            ],
            'details' => [
                'established_year' => $company->established_year,
                'founded_year' => $company->founded_year,
                'registration_number' => $company->registration_number,
                'tax_id' => $company->tax_id,
                'employee_count' => $company->employee_count,
            ],
            'seo' => [
                'title' => $company->getLocalizedMetaTitle($lang),
                'description' => $company->getLocalizedMetaDescription($lang),
            ],
        ];
    }
}