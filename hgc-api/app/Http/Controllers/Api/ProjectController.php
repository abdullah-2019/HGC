<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * GET /api/projects
     * Returns list of all active projects with company info for filtering
     */
    public function index(Request $request): JsonResponse
    {
        $companySlug = $request->query('company');

        $query = Project::with(['company:id,slug,name_en,name_dari,accent_color,icon_name', 'category:id,name_en,name_dari'])
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc');

        if ($request->query('featured')) {
            $query->where('is_featured', true);
        }

        if ($companySlug && $companySlug !== 'all') {
            $query->whereHas('company', function ($q) use ($companySlug) {
                $q->where('slug', $companySlug);
            });
        }

        $projects = $query->get([
            'id',
            'slug',
            'name_en',
            'name_dari',
            'location_en',
            'location_dari',
            'client_name_en',
            'client_name_dari',
            'duration_text',
            'status',
            'description_en',
            'description_dari',
            'cover_image_url',
            'completion_percent',
            'category_id',
            'company_id',
        ]);

        $mapped = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'slug' => $project->slug,
                'nameEn' => $project->name_en,
                'nameDari' => $project->name_dari,
                'locationEn' => $project->location_en,
                'locationDari' => $project->location_dari,
                'clientEn' => $project->client_name_en,
                'clientDari' => $project->client_name_dari,
                'duration' => $project->duration_text,
                'status' => $project->status,
                'category' => $project->category?->name_en ?? 'General',
                'descriptionEn' => strip_tags($project->description_en ?? ''),
                'descriptionDari' => $project->description_dari,
                'coverImage' => $project->cover_image_url ? $this->storageUrl($project->cover_image_url) : '/images/placeholder.png',
                'completionPercent' => $project->completion_percent,
                'companyColor' => $project->company?->accent_color ?? '#C9A227',
                'companySlug' => $project->company?->slug ?? 'hcrc',
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $mapped,
        ]);
    }

    /**
     * GET /api/projects/{slug}
     * Returns single project with gallery and milestones
     */
    public function show(string $slug): JsonResponse
    {
        $project = Project::with([
                'company:id,slug,name_en,name_dari,accent_color,icon_name',
                'milestones' => function ($q) {
                    $q->orderBy('milestone_date', 'asc');
                }
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first([
                'id',
                'slug',
                'name_en',
                'name_dari',
                'location_en',
                'location_dari',
                'client_name_en',
                'client_name_dari',
                'description_en',
                'description_dari',
                'cover_image_url',
                'gallery_images',
                'status',
                'completion_percent',
                'start_date',
                'end_date',
                'duration_text',
                'company_id',
                'category_id',
            ]);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found',
            ], 404);
        }

        // Build gallery from JSON field
        $gallery = [];
        if ($project->gallery_images) {
            $galleryImages = is_string($project->gallery_images) 
                ? json_decode($project->gallery_images, true) 
                : $project->gallery_images;
            
            foreach ($galleryImages as $idx => $img) {
                $gallery[] = [
                    'src' => $this->storageUrl($img['image_url'] ?? $img['url'] ?? $img ?? ''),
                    'captionEn' => $img['caption_en'] ?? $img['captionEn'] ?? 'Project Image ' . ($idx + 1),
                    'captionDari' => $img['caption_dari'] ?? $img['captionDari'] ?? '',
                ];
            }
        }

        // Fallback: if no gallery JSON, use cover image as single gallery item
        if (empty($gallery) && $project->cover_image_url) {
            $gallery[] = [
                'src' => $this->storageUrl($project->cover_image_url),
                'captionEn' => $project->name_en,
                'captionDari' => $project->name_dari,
            ];
        }

        // Build milestones
        $milestones = $project->milestones->map(function ($m) {
            return [
                'date' => $m->milestone_date?->format('Y-m-d'),
                'titleEn' => $m->title_en,
                'titleDari' => $m->title_dari,
                'descEn' => strip_tags($m->description_en ?? ''),
                'descDari' => $m->description_dari,
            ];
        })->values();

        $data = [
            'slug' => $project->slug,
            'nameEn' => $project->name_en,
            'nameDari' => $project->name_dari,
            'taglineEn' => $project->company?->tagline_en ?? '',
            'taglineDari' => $project->company?->tagline_dari ?? '',
            'heroImage' => $project->cover_image_url ? $this->storageUrl($project->cover_image_url) : '/images/placeholder.png',
            'overviewEn' => strip_tags($project->description_en ?? ''),
            'overviewDari' => $project->description_dari,
            'location' => $project->location_en,
            'locationDari' => $project->location_dari,
            'client' => $project->client_name_en,
            'clientDari' => $project->client_name_dari,
            'contractor' => $project->company?->name_en ?? 'Hafez Group',
            'contractorDari' => $project->company?->name_dari ?? 'گروپ حافظ',
            'duration' => $project->duration_text,
            'durationDari' => $project->duration_text,
            'status' => $project->status,
            'completionDate' => $project->end_date?->format('F Y') ?? '',
            'category' => $project->category?->name_en ?? 'Infrastructure',
            'categoryDari' => $project->category?->name_dari ?? 'زیرساخت',
            'companyColor' => $project->company?->accent_color ?? '#C9A227',
            'companySlug' => $project->company?->slug ?? 'hcrc',
            'gallery' => $gallery,
            'milestones' => $milestones,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * GET /api/companies/for-filter
     * Returns ONLY companies that have at least one active project
     */
    public function companiesForFilter(): JsonResponse
    {
        // Get distinct company IDs from active projects
        $companyIds = Project::where('is_active', true)
            ->whereNotNull('company_id')
            ->distinct()
            ->pluck('company_id');

        $companies = Company::where('is_active', true)
            ->whereIn('id', $companyIds)
            ->orderBy('sort_order', 'asc')
            ->get([
                'id',
                'slug',
                'short_name_en',
                'short_name_dari',
                'short_name_pashto',
                'accent_color',
                'icon_name'
            ]);

        $mapped = $companies->map(function ($company) {
            return [
                'id' => (string) $company->id,
                'slug' => $company->slug,
                'short_name_en' => $company->short_name_en,
                'short_name_dari' => $company->short_name_dari,
                'short_name_pashto' => $company->short_name_pashto,
                'icon' => $company->icon_name ?? 'Building2',
                'color' => $company->accent_color ?? '#C9A227',
                'logo' => $company->logo_url ? $this->storageUrl($company->logo_url) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $mapped->values(),
        ]);
    }

    /**
     * Helper: prepend storage URL if path is relative
     */
    private function storageUrl(string $path): string
    {
        if (str_starts_with($path, 'http')) {
            return $path;
        }
        // Force the correct URL with port 8000
        // return 'http://localhost:8000/storage/' . ltrim($path, '/');
        return 'https://api.hgc.af/storage/' . ltrim($path, '/');
    }
}