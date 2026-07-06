<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'image_url' => $this->image_url,
            'caption' => $this->getLocalized('caption', $lang),
            'sort_order' => $this->sort_order,
            'is_primary' => $this->is_primary,
        ];
    }

    private function getLocalized(string $field, string $lang): ?string
    {
        $key = "{$field}_{$lang}";
        return $this->$key ?? $this->{"{$field}_en"};
    }
}