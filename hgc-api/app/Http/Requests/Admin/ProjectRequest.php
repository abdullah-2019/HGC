<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            // Basic Info
            'slug' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('projects', 'slug')->ignore($projectId),
            ],
            'name_en' => ['required', 'string', 'max:200'],
            'name_dari' => ['nullable', 'string', 'max:200'],
            'name_pashto' => ['nullable', 'string', 'max:200'],

            // Location
            'location_en' => ['nullable', 'string', 'max:100'],
            'location_dari' => ['nullable', 'string', 'max:100'],
            'location_pashto' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:50'],

            // Client
            'client_name_en' => ['nullable', 'string', 'max:150'],
            'client_name_dari' => ['nullable', 'string', 'max:150'],
            'client_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],

            // Budget & Dates
            'budget_amount' => ['nullable', 'numeric', 'min:0'],
            'budget_currency' => ['required', 'string', 'max:10'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'duration_text' => ['nullable', 'string', 'max:100'],

            // Relations
            'category_id' => ['required', 'exists:categories,id'],
            'company_id' => ['nullable', 'exists:companies,id'],

            // Descriptions
            'description_en' => ['nullable', 'string'],
            'description_dari' => ['nullable', 'string'],
            'description_pashto' => ['nullable', 'string'],

            // Status & Progress
            'status' => ['required', 'in:ongoing,completed,planned,on_hold'],
            'completion_percent' => ['nullable', 'integer', 'min:0', 'max:100'],

            // Images
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery_files' => ['nullable', 'array'],
            'gallery_files.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery_captions_en.*' => ['nullable', 'string', 'max:255'],
            'gallery_captions_dari.*' => ['nullable', 'string', 'max:255'],
            'gallery_urls' => ['nullable', 'array'],
            'gallery_urls.*' => ['nullable', 'url', 'max:500'],
            'gallery_url_captions_en.*' => ['nullable', 'string', 'max:255'],
            'gallery_url_captions_dari.*' => ['nullable', 'string', 'max:255'],

            // SEO
            'meta_title_en' => ['nullable', 'string', 'max:150'],
            'meta_desc_en' => ['nullable', 'string', 'max:300'],

            // Settings
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name_en' => 'Project Name (English)',
            'name_dari' => 'Project Name (Dari)',
            'name_pashto' => 'Project Name (Pashto)',
            'category_id' => 'Category',
            'company_id' => 'Company',
            'cover_image' => 'Cover Image',
            'client_logo' => 'Client Logo',
            'gallery_files' => 'Gallery Images',
            'budget_amount' => 'Budget Amount',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
            'completion_percent' => $this->input('completion_percent', 0),
            'sort_order' => $this->input('sort_order', 0),
        ]);
    }
}