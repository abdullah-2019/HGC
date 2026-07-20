<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $projectId = $this->route('project')?->id;

        return [
            // Basic
            'slug' => 'nullable|string|max:100|unique:projects,slug' . ($projectId ? "," . $projectId : ""),
            'name_en' => 'required|string|max:200',
            'name_dari' => 'nullable|string|max:200',
            'name_pashto' => 'nullable|string|max:200',

            // Categorization
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'nullable|exists:companies,id',

            // Location
            'location_en' => 'nullable|string|max:100',
            'location_dari' => 'nullable|string|max:100',
            'location_pashto' => 'nullable|string|max:100',
            'province_en' => 'nullable|string|max:50',
            'province_dari' => 'nullable|string|max:50',
            'province_pashto' => 'nullable|string|max:50',

            // Client
            'client_name_en' => 'nullable|string|max:150',
            'client_name_dari' => 'nullable|string|max:150',
            'client_name_pashto' => 'nullable|string|max:150',
            'client_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',

            // Financial & Timeline
            'budget_amount' => 'nullable|numeric|min:0',
            'budget_currency' => 'required|string|max:10|in:USD,AFN,EUR',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'duration_text' => 'nullable|string|max:100',

            // Content
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',

            // Status
            'status' => 'required|in:ongoing,completed,planned,on_hold',
            'completion_percent' => 'nullable|integer|min:0|max:100',

            // Media
            'cover_image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'gallery_files' => 'nullable|array',
            'gallery_files.*' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5120',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|url|max:500',

            // Gallery captions
            'gallery_captions_en' => 'nullable|array',
            'gallery_captions_en.*' => 'nullable|string|max:255',
            'gallery_captions_dari' => 'nullable|array',
            'gallery_captions_dari.*' => 'nullable|string|max:255',
            'gallery_captions_pashto' => 'nullable|array',
            'gallery_captions_pashto.*' => 'nullable|string|max:255',
            'gallery_url_captions_en' => 'nullable|array',
            'gallery_url_captions_en.*' => 'nullable|string|max:255',
            'gallery_url_captions_dari' => 'nullable|array',
            'gallery_url_captions_dari.*' => 'nullable|string|max:255',
            'gallery_url_captions_pashto' => 'nullable|array',
            'gallery_url_captions_pashto.*' => 'nullable|string|max:255',

            // SEO
            'meta_title_en' => 'nullable|string|max:150',
            'meta_desc_en' => 'nullable|string|max:300',
            'meta_title_dari' => 'nullable|string|max:150',
            'meta_desc_dari' => 'nullable|string|max:300',
            'meta_title_pashto' => 'nullable|string|max:150',
            'meta_desc_pashto' => 'nullable|string|max:300',

            // Settings
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert checkbox values to boolean
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}