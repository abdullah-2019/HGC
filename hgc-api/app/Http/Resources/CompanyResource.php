<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $lang = $request->header('Accept-Language', 'en');

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->getLocalized('name', $lang),
            'tagline' => $this->getLocalized('tagline', $lang),
            'description' => $this->getLocalized('description', $lang),
            'accent_color' => $this->accent_color,
            'secondary_color' => $this->secondary_color,
            'logo_url' => $this->logo_url,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'website_url' => $this->website_url,
            'established_year' => $this->established_year,
        ];
    }

    private function getLocalized(string $field, string $lang): ?string
    {
        $key = "{$field}_{$lang}";
        return $this->$key ?? $this->{"{$field}_en"};
    }
}