<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'company', 'images'])
            ->orderBy('sort_order')
            ->latest();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                  ->orWhere('name_dari', 'like', "%{$search}%")
                  ->orWhere('name_pashto', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        // Availability filter
        if ($request->filled('availability')) {
            $query->where('availability', $request->input('availability'));
        }

        $products = $query->paginate(15)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('name_en')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::where('is_active', true)
            ->whereIn('type', ['product', 'both'])
            ->orderBy('name_en')
            ->get();

        $companies = Company::orderBy('name_en')->get();

        return view('admin.products.create', compact('categories', 'companies'));
    }

    /**
     * Store a newly created product.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $request) {
            // Handle hero image upload
            if ($request->hasFile('hero_image')) {
                $data['hero_image_url'] = $request->file('hero_image')->store('products/hero', 'public');
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail_url'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
            }

            // Remove file inputs from data array before creation
            unset($data['hero_image'], $data['thumbnail']);

            // Create product
            $product = Product::create($data);

            // Sync additional categories via pivot table
            if (!empty($data['additional_category_ids'])) {
                $product->categories()->sync($data['additional_category_ids']);
            }

            // Handle product images
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $imageData) {
                    if (!empty($imageData['image_url'])) {
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_url' => $imageData['image_url'],
                            'caption_en' => $imageData['caption_en'] ?? null,
                            'caption_dari' => $imageData['caption_dari'] ?? null,
                            'caption_pashto' => $imageData['caption_pashto'] ?? null,
                            'sort_order' => $imageData['sort_order'] ?? $index,
                            'is_primary' => $imageData['is_primary'] ?? false,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product): View
    {
        $product->load(['category', 'company', 'images']);

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $product->load(['category', 'company', 'images', 'categories']);

        $categories = Category::where('is_active', true)
            ->whereIn('type', ['product', 'both'])
            ->orderBy('name_en')
            ->get();

        $companies = Company::orderBy('name_en')->get();

        return view('admin.products.edit', compact('product', 'categories', 'companies'));
    }

    /**
     * Update the specified product.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $request, $product) {
            // Handle hero image replacement
            if ($request->hasFile('hero_image')) {
                if ($product->hero_image_url) {
                    $oldPath = str_replace(asset('storage/') . '/', '', $product->hero_image_url);
                    Storage::disk('public')->delete($oldPath);
                }
                $data['hero_image_url'] = $request->file('hero_image')->store('products/hero', 'public');
            }

            // Handle hero image deletion
            if (!empty($data['delete_hero_image']) && $product->hero_image_url) {
                $oldPath = str_replace(asset('storage/') . '/', '', $product->hero_image_url);
                Storage::disk('public')->delete($oldPath);
                $data['hero_image_url'] = null;
            }

            // Handle thumbnail replacement
            if ($request->hasFile('thumbnail')) {
                if ($product->thumbnail_url) {
                    $oldPath = str_replace(asset('storage/') . '/', '', $product->thumbnail_url);
                    Storage::disk('public')->delete($oldPath);
                }
                $data['thumbnail_url'] = $request->file('thumbnail')->store('products/thumbnails', 'public');
            }

            // Handle thumbnail deletion
            if (!empty($data['delete_thumbnail']) && $product->thumbnail_url) {
                $oldPath = str_replace(asset('storage/') . '/', '', $product->thumbnail_url);
                Storage::disk('public')->delete($oldPath);
                $data['thumbnail_url'] = null;
            }

            // Remove file inputs and deletion flags from data array
            unset($data['hero_image'], $data['thumbnail'], $data['delete_hero_image'], $data['delete_thumbnail']);

            // Update product
            $product->update($data);

            // Sync additional categories
            if (isset($data['additional_category_ids'])) {
                $product->categories()->sync($data['additional_category_ids'] ?? []);
            }

            // Delete removed images
            if (!empty($data['deleted_image_ids'])) {
                $imagesToDelete = ProductImage::whereIn('id', $data['deleted_image_ids'])
                    ->where('product_id', $product->id)
                    ->get();

                foreach ($imagesToDelete as $img) {
                    $imagePath = str_replace(asset('storage/') . '/', '', $img->getRawOriginal('image_url') ?? $img->image_url);
                    Storage::disk('public')->delete($imagePath);
                    $img->delete();
                }
            }

            // Update existing images and add new ones
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $imageData) {
                    if (!empty($imageData['id'])) {
                        // Update existing image
                        $image = ProductImage::find($imageData['id']);
                        if ($image && $image->product_id === $product->id) {
                            $image->update([
                                'image_url' => $imageData['image_url'],
                                'caption_en' => $imageData['caption_en'] ?? null,
                                'caption_dari' => $imageData['caption_dari'] ?? null,
                                'caption_pashto' => $imageData['caption_pashto'] ?? null,
                                'sort_order' => $imageData['sort_order'] ?? $index,
                                'is_primary' => $imageData['is_primary'] ?? false,
                            ]);
                        }
                    } elseif (!empty($imageData['image_url'])) {
                        // Create new image
                        ProductImage::create([
                            'product_id' => $product->id,
                            'image_url' => $imageData['image_url'],
                            'caption_en' => $imageData['caption_en'] ?? null,
                            'caption_dari' => $imageData['caption_dari'] ?? null,
                            'caption_pashto' => $imageData['caption_pashto'] ?? null,
                            'sort_order' => $imageData['sort_order'] ?? $index,
                            'is_primary' => $imageData['is_primary'] ?? false,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {
            // Delete associated images from storage
            foreach ($product->images as $image) {
                $imagePath = str_replace(asset('storage/') . '/', '', $image->getRawOriginal('image_url') ?? $image->image_url);
                Storage::disk('public')->delete($imagePath);
                $image->delete();
            }

            // Delete hero image
            if ($product->hero_image_url) {
                $heroPath = str_replace(asset('storage/') . '/', '', $product->getRawOriginal('hero_image_url') ?? $product->hero_image_url);
                Storage::disk('public')->delete($heroPath);
            }

            // Delete thumbnail
            if ($product->thumbnail_url) {
                $thumbPath = str_replace(asset('storage/') . '/', '', $product->getRawOriginal('thumbnail_url') ?? $product->thumbnail_url);
                Storage::disk('public')->delete($thumbPath);
            }

            // Detach from pivot table
            $product->categories()->detach();

            $product->delete();
        });

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Toggle product active status.
     */
    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->update(['is_active' => !$product->is_active]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Product {$status} successfully.");
    }

    /**
     * Toggle product featured status.
     */
    public function toggleFeatured(Product $product): RedirectResponse
    {
        $product->update(['is_featured' => !$product->is_featured]);

        $status = $product->is_featured ? 'featured' : 'unfeatured';
        return redirect()->back()
            ->with('success', "Product {$status} successfully.");
    }
}