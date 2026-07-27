<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * List categories
     * GET /api/categories
     */
    public function index(Request $request): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $query = Category::active()->ordered();

        if ($request->has('type')) {
            $query->type($request->type);
        }

        $categories = $query->get()->map(function ($category) use ($lang) {
            return [
                'id' => $category->id,
                'slug' => $category->slug,
                'name' => $category->getLocalizedName($lang),
                'description' => $category->getLocalizedDescription($lang),
                'icon_name' => $category->icon_name,
                'image_url' => $category->image_url,
                'type' => $category->type,
                'parent_id' => $category->parent_id,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    /**
     * Get single category with products
     * GET /api/categories/{slug}
     */
    public function show(Request $request, string $slug): JsonResponse
    {
        $lang = $request->get('lang', 'en');

        $category = Category::active()
            ->where('slug', $slug)
            ->with(['products' => fn($q) => $q->active()->ordered()])
            ->first();

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $category->id,
                'slug' => $category->slug,
                'name' => $category->getLocalizedName($lang),
                'description' => $category->getLocalizedDescription($lang),
                'icon_name' => $category->icon_name,
                'image_url' => $category->image_url,
                'type' => $category->type,
                'products' => $category->products->map(fn($p) => [
                    'slug' => $p->slug,
                    'name' => $p->getLocalizedName($lang),
                    'thumbnail_url' => $p->thumbnail_url,
                    'price_range' => $p->price_range,
                ]),
            ],
        ]);
    }
}