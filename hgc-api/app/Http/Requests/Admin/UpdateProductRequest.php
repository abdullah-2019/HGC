<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product');

        return [
            'name_en' => ['required', 'string', 'max:150'],
            'name_dari' => ['nullable', 'string', 'max:150'],
            'name_pashto' => ['nullable', 'string', 'max:150'],
            'slug' => ['required', 'string', 'max:100', Rule::unique('products', 'slug')->ignore($productId)],
            'tagline_en' => ['nullable', 'string', 'max:255'],
            'tagline_dari' => ['nullable', 'string', 'max:255'],
            'tagline_pashto' => ['nullable', 'string', 'max:255'],
            'overview_en' => ['nullable', 'string'],
            'overview_dari' => ['nullable', 'string'],
            'overview_pashto' => ['nullable', 'string'],
            'hero_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:1024'],
            'category_id' => ['required', 'exists:categories,id'],
            'company_id' => ['nullable', 'exists:companies,id'],
            'origin' => ['nullable', 'string', 'max:100'],
            'grade' => ['nullable', 'string', 'max:100'],
            'purity' => ['nullable', 'string', 'max:50'],
            'price_range' => ['nullable', 'string', 'max:100'],
            'currency' => ['required', 'string', 'max:10'],
            'unit' => ['nullable', 'string', 'max:50'],
            'availability' => ['required', Rule::in(['in_stock', 'limited', 'pre_order', 'out_of_stock'])],
            'delivery_info' => ['nullable', 'string'],
            'meta_title_en' => ['nullable', 'string', 'max:150'],
            'meta_desc_en' => ['nullable', 'string', 'max:300'],
            'is_featured' => ['boolean'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'specifications' => ['nullable', 'array'],
            'specifications.*.label' => ['required_with:specifications', 'string', 'max:100'],
            'specifications.*.value' => ['required_with:specifications', 'string', 'max:255'],
            'applications' => ['nullable', 'array'],
            'applications.*' => ['string', 'max:255'],
            'packaging' => ['nullable', 'array'],
            'packaging.*' => ['string', 'max:255'],
            'images' => ['nullable', 'array'],
            'images.*.id' => ['nullable', 'integer', 'exists:product_images,id'],
            'images.*.image_url' => ['required_with:images', 'string', 'max:255'],
            'images.*.caption_en' => ['nullable', 'string', 'max:255'],
            'images.*.caption_dari' => ['nullable', 'string', 'max:255'],
            'images.*.caption_pashto' => ['nullable', 'string', 'max:255'],
            'images.*.sort_order' => ['integer', 'min:0'],
            'images.*.is_primary' => ['boolean'],
            'deleted_image_ids' => ['nullable', 'array'],
            'deleted_image_ids.*' => ['integer', 'exists:product_images,id'],
            'delete_hero_image' => ['nullable', 'boolean'],
            'delete_thumbnail' => ['nullable', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name_en' => 'Product Name (English)',
            'name_dari' => 'Product Name (Dari)',
            'name_pashto' => 'Product Name (Pashto)',
            'category_id' => 'Category',
            'company_id' => 'Company',
            'hero_image' => 'Hero Image',
            'thumbnail' => 'Thumbnail',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active'),
            'sort_order' => (int) $this->input('sort_order', 0),
            'delete_hero_image' => $this->boolean('delete_hero_image'),
            'delete_thumbnail' => $this->boolean('delete_thumbnail'),
        ]);
    }
}