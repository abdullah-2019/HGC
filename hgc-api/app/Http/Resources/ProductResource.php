<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->getLocalized('name', $lang),
            'tagline' => $this->getLocalized('tagline', $lang),
            'overview' => $this->getLocalized('overview', $lang),
            'hero_image_url' => $this->hero_image_url,
            'thumbnail_url' => $this->thumbnail_url,
            'origin' => $this->origin,
            'grade' => $this->grade,
            'purity' => $this->purity,
            'specifications' => $this->specifications,
            'price_range' => $this->price_range,
            'currency' => $this->currency,
            'unit' => $this->unit,
            'availability' => $this->availability,
            'applications' => $this->applications,
            'packaging' => $this->packaging,
            'delivery_info' => $this->delivery_info,
            'is_featured' => $this->is_featured,
            'sort_order' => $this->sort_order,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'company' => new CompanyResource($this->whenLoaded('company')),
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'primary_image' => new ProductImageResource($this->whenLoaded('primaryImage')->first()),
        ];
    }

    private function getLocalized(string $field, string $lang): ?string
    {
        $key = "{$field}_{$lang}";
        return $this->$key ?? $this->{"{$field}_en"};
    }
}