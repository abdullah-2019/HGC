<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $companyId = $this->route('company')?->id;

        return [
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique('companies', 'slug')->ignore($companyId),
            ],
            'icon_name' => 'required|string|max:255',

            // Translatable: EN required, Dari/Pashto optional
            'name_en' => 'required|string|max:100',
            'name_dari' => 'nullable|string|max:100',
            'name_pashto' => 'nullable|string|max:100',

            'short_name_en' => 'required|string|max:255',
            'short_name_dari' => 'nullable|string|max:255',
            'short_name_pashto' => 'nullable|string|max:255',

            'tagline_en' => 'nullable|string|max:255',
            'tagline_dari' => 'nullable|string|max:255',
            'tagline_pashto' => 'nullable|string|max:255',

            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',

            'sector_en' => 'required|string|max:255',
            'sector_dari' => 'nullable|string|max:255',
            'sector_pashto' => 'nullable|string|max:255',

            'email' => 'nullable|email|max:100',
            'phone' => 'nullable|string|max:50',

            'address_en' => 'nullable|string|max:255',
            'address_dari' => 'nullable|string|max:255',
            'address_pashto' => 'nullable|string|max:255',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'website_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',

            'about_en' => 'nullable|string',
            'about_dari' => 'nullable|string',
            'about_pashto' => 'nullable|string',

            'mission_en' => 'nullable|string',
            'mission_dari' => 'nullable|string',
            'mission_pashto' => 'nullable|string',

            'vision_en' => 'nullable|string',
            'vision_dari' => 'nullable|string',
            'vision_pashto' => 'nullable|string',

            'value_en' => 'nullable|string',
            'value_dari' => 'nullable|string',
            'value_pashto' => 'nullable|string',

            'accent_color' => 'required|string|max:7',
            'secondary_color' => 'nullable|string|max:7',
            'established_year' => 'nullable|integer|min:1800|max:' . date('Y'),
            'employee_count' => 'nullable|integer|min:0',
            'project_count' => 'nullable|integer|min:0',
            'province_count' => 'nullable|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',

            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ];
    }

    public function attributes(): array
    {
        return [
            'name_en' => 'Company Name (English)',
            'short_name_en' => 'Short Name (English)',
            'sector_en' => 'Sector (English)',
            'slug' => 'Slug',
            'icon_name' => 'Icon Name',
            'accent_color' => 'Accent Color',
        ];
    }
}