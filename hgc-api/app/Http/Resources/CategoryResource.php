<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->getLocalized('name', $lang),
            'description' => $this->getLocalized('description', $lang),
            'icon_name' => $this->icon_name,
            'image_url' => $this->image_url,
            'type' => $this->type,
            'sort_order' => $this->sort_order,
            'children' => CategoryResource::collection($this->whenLoaded('children')),
        ];
    }

    private function getLocalized(string $field, string $lang): ?string
    {
        $key = "{$field}_{$lang}";
        return $this->$key ?? $this->{"{$field}_en"};
    }
}