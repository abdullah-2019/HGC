<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * List products (with optional filters)
     * GET /api/products
     */
    public function index(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $query = Product::active()
            ->with(['category', 'company', 'images'])
            ->ordered();

        // Filter by category (checks both main category & pivot table)
        if ($request->has('category')) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('category', fn($sq) => $sq->where('slug', $request->category));
                $q->orWhereHas('categories', fn($sq) => $sq->where('slug', $request->category));
            });
        }

        // Filter by company
        if ($request->has('company')) {
            $query->whereHas('company', fn($q) => $q->where('slug', $request->company));
        }

        // Featured only
        if ($request->boolean('featured')) {
            $query->featured();
        }

        $products = $query->get()->map(function ($product) use ($lang) {
            return $this->formatProduct($product, $lang);
        });

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Get single product
     * GET /api/products/{slug}
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $product = Product::active()
            ->with(['category', 'company', 'images'])
            ->where('slug', $slug)
            ->first();

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatProductDetail($product, $lang),
        ]);
    }

    /**
     * Get featured products (for homepage)
     * GET /api/products/featured
     */
    public function featured(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $products = Product::active()
            ->featured()
            ->with(['category', 'company'])
            ->ordered()
            ->limit(6)
            ->get()
            ->map(function ($product) use ($lang) {
                return $this->formatProduct($product, $lang);
            });

        return response()->json([
            'success' => true,
            'data' => $products,
        ]);
    }

    /**
     * Format product for list/card view
     */
    private function formatProduct(Product $product, string $lang): array
    {
        $primaryImage = $product->primaryImage();

        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->getLocalizedName($lang),
            'tagline' => $product->getLocalizedTagline($lang),
            'description' => $product->getLocalizedOverview($lang),
            'category' => $product->category ? [
                'slug' => $product->category->slug,
                'name' => $product->category->getLocalizedName($lang),
                'icon_name' => $product->category->icon_name,
            ] : null,
            'company' => $product->company ? [
                'slug' => $product->company->slug,
                'name' => $product->company->getLocalizedName($lang),
                'accent_color' => $product->company->accent_color,
            ] : null,
            'origin' => $product->origin,
            'grade' => $product->grade,
            'purity' => $product->purity,
            'specifications' => $product->specifications,
            'price_range' => $product->price_range,
            'currency' => $product->currency,
            'unit' => $product->unit,
            'availability' => $product->availability,
            'availability_label' => $product->getAvailabilityLabel($lang),
            'hero_image_url' => $product->hero_image_url,
            'thumbnail_url' => $product->thumbnail_url,
            'primary_image' => $primaryImage ? [
                'url' => $primaryImage->image_url,
                'caption' => $primaryImage->getLocalizedCaption($lang),
            ] : null,
            'is_featured' => $product->is_featured,
        ];
    }

    /**
     * Format product for detail view
     */
    private function formatProductDetail(Product $product, string $lang): array
    {
        return [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->getLocalizedName($lang),
            'tagline' => $product->getLocalizedTagline($lang),
            'overview' => $product->getLocalizedOverview($lang),
            'category' => $product->category ? [
                'slug' => $product->category->slug,
                'name' => $product->category->getLocalizedName($lang),
                'icon_name' => $product->category->icon_name,
            ] : null,
            'company' => $product->company ? [
                'slug' => $product->company->slug,
                'name' => $product->company->getLocalizedName($lang),
                'accent_color' => $product->company->accent_color,
            ] : null,
            'origin' => $product->origin,
            'grade' => $product->grade,
            'purity' => $product->purity,
            'specifications' => $product->specifications,
            'applications' => $product->applications,
            'packaging' => $product->packaging,
            'delivery_info' => $product->delivery_info,
            'price_range' => $product->price_range,
            'currency' => $product->currency,
            'unit' => $product->unit,
            'availability' => $product->availability,
            'availability_label' => $product->getAvailabilityLabel($lang),
            'hero_image_url' => $product->hero_image_url,
            'thumbnail_url' => $product->thumbnail_url,
            'images' => $product->images->map(fn($img) => [
                'url' => $img->image_url,
                'caption' => $img->getLocalizedCaption($lang),
                'is_primary' => $img->is_primary,
            ]),
            'meta' => [
                'title' => $product->meta_title_en,
                'description' => $product->meta_desc_en,
            ],
        ];
    }
}


/////////////////
