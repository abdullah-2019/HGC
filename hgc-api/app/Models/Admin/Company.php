<?php

namespace App\Models\Admin;

use App\Models\Company as BaseCompany;
use Illuminate\Support\Facades\Storage;

/**
 * Admin Company Model
 * 
 * Extends the frontend Company model for admin CRUD operations.
 * Works with raw database paths (uploads/companies/{slug}/...).
 */
class Company extends BaseCompany
{
    protected $table = 'companies';

    // ============================================================
    // RAW PATH ACCESS (bypass frontend accessors)
    // ============================================================

    /**
     * Get raw logo path from database.
     * Returns: uploads/companies/{slug}/logos/logo.jpg
     */
    public function getRawLogoPath(): ?string
    {
        return $this->getAttributes()['logo_url'] ?? null;
    }

    /**
     * Get raw hero image path from database.
     * Returns: uploads/companies/{slug}/heroes/hero.webp
     */
    public function getRawHeroImagePath(): ?string
    {
        return $this->getAttributes()['hero_image_path'] ?? null;
    }

    // ============================================================
    // URL GENERATION (for admin previews)
    // ============================================================

    /**
     * Get full URL for logo preview.
     * Returns: http://localhost:8000/storage/uploads/companies/{slug}/logos/logo.jpg
     */
    public function getLogoPreviewUrl(): ?string
    {
        $path = $this->getRawLogoPath();
        return $path ? asset('storage/' . $path) : null;
    }

    /**
     * Get full URL for hero image preview.
     * Returns: http://localhost:8000/storage/uploads/companies/{slug}/heroes/hero.webp
     */
    public function getHeroPreviewUrl(): ?string
    {
        $path = $this->getRawHeroImagePath();
        return $path ? asset('storage/' . $path) : null;
    }

    /**
     * Get both preview URLs as array.
     */
    public function getAdminImagePreviews(): array
    {
        return [
            'logo_preview' => $this->getLogoPreviewUrl(),
            'hero_preview' => $this->getHeroPreviewUrl(),
        ];
    }

    // ============================================================
    // FILE STORAGE (store to public/storage/uploads/...)
    // ============================================================

    /**
     * Store logo file and return DB path.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $slug Company slug for folder naming
     * @return string Path stored in DB: uploads/companies/{slug}/logos/{filename}
     */
    public function storeLogo($file, string $slug): string
    {
        // Store returns: companies/{slug}/logos/{hash}.jpg
        $storedPath = $file->store("uploads/companies/{$slug}/logos", 'public');
        
        // $storedPath is already: uploads/companies/{slug}/logos/{hash}.jpg
        return $storedPath;
    }

    /**
     * Store hero image file and return DB path.
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $slug Company slug for folder naming
     * @return string Path stored in DB: uploads/companies/{slug}/heroes/{filename}
     */
    public function storeHeroImage($file, string $slug): string
    {
        $storedPath = $file->store("uploads/companies/{$slug}/heroes", 'public');
        
        return $storedPath;
    }

    // ============================================================
    // FILE DELETION
    // ============================================================

    /**
     * Delete logo file from storage.
     */
    public function deleteLogoFile(): bool
    {
        $path = $this->getRawLogoPath();
        return $path ? Storage::disk('public')->delete($path) : false;
    }

    /**
     * Delete hero image file from storage.
     */
    public function deleteHeroImageFile(): bool
    {
        $path = $this->getRawHeroImagePath();
        return $path ? Storage::disk('public')->delete($path) : false;
    }

    /**
     * Delete both image files.
     */
    public function deleteAllImageFiles(): void
    {
        $this->deleteLogoFile();
        $this->deleteHeroImageFile();
    }

    // ============================================================
    // REPLACE HELPERS (delete old + store new)
    // ============================================================

    /**
     * Replace logo: delete old file, store new one.
     */
    public function replaceLogo($file, string $slug): string
    {
        $this->deleteLogoFile();
        return $this->storeLogo($file, $slug);
    }

    /**
     * Replace hero image: delete old file, store new one.
     */
    public function replaceHeroImage($file, string $slug): string
    {
        $this->deleteHeroImageFile();
        return $this->storeHeroImage($file, $slug);
    }

    // ============================================================
    // ADMIN LISTING HELPERS
    // ============================================================

    /**
     * Get all companies for admin index.
     */
    public static function getAdminList()
    {
        return static::orderBy('sort_order', 'asc')
                     ->orderBy('name_en', 'asc')
                     ->get();
    }

    /**
     * Get paginated companies for admin.
     */
    public static function getAdminPaginated(int $perPage = 20)
    {
        return static::orderBy('sort_order', 'asc')
                     ->orderBy('name_en', 'asc')
                     ->paginate($perPage);
    }

    /**
     * Find company including trashed.
     */
    public static function findForAdmin(int $id): ?self
    {
        return static::withTrashed()->find($id);
    }
}