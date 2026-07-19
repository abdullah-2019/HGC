<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Project;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::with(['category', 'company']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                  ->orWhere('name_dari', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('location_en', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by featured
        if ($request->has('is_featured')) {
            $query->where('is_featured', $request->boolean('is_featured'));
        }

        // Filter by active
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $projects = $query->orderBy('sort_order', 'asc')
                          ->orderBy('created_at', 'desc')
                          ->paginate(50)
                          ->withQueryString();

        $categories = Category::orderBy('name_en')->get();
        $statuses = ['ongoing', 'completed', 'planned', 'on_hold'];

        return view('admin.projects.index', compact('projects', 'categories', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name_en')->get();
        $companies = Company::where('is_active', true)->orderBy('name_en')->get();
        $statuses = ['ongoing' => 'Ongoing', 'completed' => 'Completed', 'planned' => 'Planned', 'on_hold' => 'On Hold'];

        return view('admin.projects.create', compact('categories', 'companies', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->validated();

        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name_en']);
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $data['cover_image_url'] = $this->uploadImage($request->file('cover_image'), 'projects/covers');
        }

        // Handle client logo upload
        if ($request->hasFile('client_logo')) {
            $data['client_logo_url'] = $this->uploadImage($request->file('client_logo'), 'projects/clients');
        }

        // Handle gallery images
        $data['gallery_images'] = $this->processGalleryImages($request);

        $project = Project::create($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load(['category', 'company', 'milestones']);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = Category::where('is_active', true)->orderBy('name_en')->get();
        $companies = Company::where('is_active', true)->orderBy('name_en')->get();
        $statuses = ['ongoing' => 'Ongoing', 'completed' => 'Completed', 'planned' => 'Planned', 'on_hold' => 'On Hold'];

        return view('admin.projects.edit', compact('project', 'categories', 'companies', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $data = $request->validated();

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image
            if ($project->cover_image_url) {
                $this->deleteImage($project->cover_image_url);
            }
            $data['cover_image_url'] = $this->uploadImage($request->file('cover_image'), 'projects/covers');
        }

        // Handle client logo upload
        if ($request->hasFile('client_logo')) {
            if ($project->client_logo_url) {
                $this->deleteImage($project->client_logo_url);
            }
            $data['client_logo_url'] = $this->uploadImage($request->file('client_logo'), 'projects/clients');
        }

        // Handle gallery images
        $existingGallery = $project->gallery_images ?? [];
        $data['gallery_images'] = $this->processGalleryImages($request, $existingGallery);

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete cover image
        if ($project->cover_image_url) {
            $this->deleteImage($project->cover_image_url);
        }

        // Delete client logo
        if ($project->client_logo_url) {
            $this->deleteImage($project->client_logo_url);
        }

        // Delete gallery images
        if (!empty($project->gallery_images)) {
            foreach ($project->gallery_images as $image) {
                if (isset($image['image_url'])) {
                    $this->deleteImage($image['image_url']);
                }
            }
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    /**
     * Delete a gallery image via AJAX
     */
    public function deleteGalleryImage(Request $request, Project $project)
    {
        $imageUrl = $request->input('image_url');
        $gallery = $project->gallery_images ?? [];

        $updatedGallery = array_filter($gallery, function ($item) use ($imageUrl) {
            return ($item['image_url'] ?? '') !== $imageUrl;
        });

        $project->update(['gallery_images' => array_values($updatedGallery)]);

        $this->deleteImage($imageUrl);

        return response()->json(['success' => true]);
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Project $project)
    {
        $project->update(['is_featured' => !$project->is_featured]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project featured status updated.');
    }

    /**
     * Toggle active status
     */
    public function toggleActive(Project $project)
    {
        $project->update(['is_active' => !$project->is_active]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project active status updated.');
    }

    /**
     * Upload image helper
     */
    private function uploadImage($file, $directory)
    {
        $filename = Str::uuid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs("uploads/{$directory}", $filename, 'public');
        return str_replace('uploads/', '', $path);
    }

    /**
     * Delete image helper
     */
    private function deleteImage($path)
    {
        if (empty($path)) return;

        // Only delete local files, not external URLs
        if (!str_starts_with($path, 'http')) {
            Storage::disk('public')->delete('uploads/' . $path);
        }
    }

    /**
     * Process gallery images
     */
    private function processGalleryImages(Request $request, array $existingGallery = [])
    {
        $gallery = $existingGallery;

        // Handle new file uploads
        if ($request->hasFile('gallery_files')) {
            foreach ($request->file('gallery_files') as $index => $file) {
                $imageUrl = $this->uploadImage($file, 'projects/gallery');
                $gallery[] = [
                    'image_url' => $imageUrl,
                    'caption_en' => $request->input("gallery_captions_en.{$index}", ''),
                    'caption_dari' => $request->input("gallery_captions_dari.{$index}", ''),
                ];
            }
        }

        // Handle external URLs
        if ($request->has('gallery_urls')) {
            foreach ($request->input('gallery_urls') as $index => $url) {
                if (!empty($url)) {
                    $gallery[] = [
                        'image_url' => $url,
                        'caption_en' => $request->input("gallery_url_captions_en.{$index}", ''),
                        'caption_dari' => $request->input("gallery_url_captions_dari.{$index}", ''),
                    ];
                }
            }
        }

        return $gallery;
    }
}