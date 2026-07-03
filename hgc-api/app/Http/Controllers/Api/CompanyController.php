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
            ->with('values', 'awards')  // ← Eager load values and awards relationships
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
     * Format company for profile view
     */
    private function formatCompanyProfile(Company $company, string $lang): array
    {
        $getLocalized = function(?string $en, ?string $dari, ?string $pashto) use ($lang): ?string {
            if ($lang === 'dari' && $dari) return $dari;
            if ($lang === 'pashto' && $pashto) return $pashto;
            return $en;
        };

        return [
            'id' => $company->id,
            'slug' => $company->slug,
            'name' => $getLocalized($company->name_en, $company->name_dari, $company->name_pashto),
            'name_dari' => $company->name_dari,
            'name_pashto' => $company->name_pashto,
            'short_name' => $getLocalized($company->short_name_en, $company->short_name_dari, $company->short_name_pashto),
            'tagline' => $getLocalized($company->tagline_en, $company->tagline_dari, $company->tagline_pashto),
            'description' => $getLocalized($company->description_en, $company->description_dari, $company->description_pashto),
            'sector' => $getLocalized($company->sector_en, $company->sector_dari, $company->sector_pashto),
            'about' => $getLocalized($company->about_en, $company->about_dari, $company->about_pashto),
            'about_dari' => $company->about_dari,
            'about_pashto' => $company->about_pashto,
            'mission' => $getLocalized($company->mission_en, $company->mission_dari, $company->mission_pashto),
            'mission_en' => $company->mission_en,
            'mission_dari' => $company->mission_dari,
            'mission_pashto' => $company->mission_pashto,
            'vision' => $getLocalized($company->vision_en, $company->vision_dari, $company->vision_pashto),
            'vision_en' => $company->vision_en,
            'vision_dari' => $company->vision_dari,
            'vision_pashto' => $company->vision_pashto,
            
            // Single value field (legacy - keep for backward compatibility)
            'value' => $getLocalized($company->value_en, $company->value_dari, $company->value_pashto),
            'value_en' => $company->value_en,
            'value_dari' => $company->value_dari,
            'value_pashto' => $company->value_pashto,
            
            'accent_color' => $company->accent_color,
            'secondary_color' => $company->secondary_color,
            'icon_name' => $company->icon_name,
            'logo_url' => $company->logo_url,
            'hero_image_url' => $company->hero_image_url,
            
            'contact' => [
                'email' => $company->email,
                'phone' => $company->phone,
                'address' => $company->address,
                'latitude' => $company->latitude,
                'longitude' => $company->longitude,
            ],
            'web' => [
                'website' => $company->website,
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
                'project_count' => $company->project_count ?? 0,
                'province_count' => $company->province_count ?? 0,
            ],
            'seo' => [
                'title' => $company->meta_title_en,
                'description' => $company->meta_description_en,
            ],
            
            // ← CORRECT: values as nested array
            'values' => $company->values->map(function ($value) use ($lang) {
                return [
                    'icon_name' => $value->icon_name,
                    'title' => $value->getLocalizedTitle($lang),
                    'title_en' => $value->title_en,
                    'title_dari' => $value->title_dari,
                    'title_pashto' => $value->title_pashto,
                    'description' => $value->getLocalizedDescription($lang),
                    'description_en' => $value->description_en,
                    'description_dari' => $value->description_dari,
                    'description_pashto' => $value->description_pashto,
                    'sort_order' => $value->sort_order,
                ];
            })->toArray(),

            'awards' => $company->awards->map(function ($award) use ($lang) {
                return [
                    'id' => $award->id,
                    'icon_name' => $award->icon_name,
                    'year' => $award->award_year,
                    'title' => $award->getLocalizedTitle($lang),
                    'title_en' => $award->title_en,
                    'title_dari' => $award->title_dari,
                    'title_pashto' => $award->title_pashto,
                    'description' => $award->getLocalizedDescription($lang),
                    'description_en' => $award->description_en,
                    'description_dari' => $award->description_dari,
                    'description_pashto' => $award->description_pashto,
                    'organization' => $award->getLocalizedOrganization($lang),
                    'organization_en' => $award->organization_en,
                    'organization_dari' => $award->organization_dari,
                    'organization_pashto' => $award->organization_pashto,
                    'image_url' => $award->image_url ? asset('storage/' . $award->image_url) : null,
                    'sort_order' => $award->sort_order,
                ];
            })->toArray(),

        ];
    }

}