<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        // Basic
        'slug',
        'name_en',
        'name_dari',
        'name_pashto',

        // Categorization
        'category_id',
        'company_id',

        // Location
        'location_en',
        'location_dari',
        'location_pashto',
        'province_en',
        'province_dari',
        'province_pashto',

        // Client
        'client_name_en',
        'client_name_dari',
        'client_name_pashto',
        'client_logo_url',

        // Financial & Timeline
        'budget_amount',
        'budget_currency',
        'start_date',
        'end_date',
        'duration_text',

        // Content
        'description_en',
        'description_dari',
        'description_pashto',

        // Status
        'status',
        'completion_percent',

        // Media
        'cover_image_url',
        'gallery_images',

        // SEO
        'meta_title_en',
        'meta_desc_en',
        'meta_title_dari',
        'meta_desc_dari',
        'meta_title_pashto',
        'meta_desc_pashto',

        // Settings
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget_amount' => 'decimal:2',
        'completion_percent' => 'integer',
        'gallery_images' => 'json',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'gallery_images' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(ProjectMilestone::class, 'project_id');
    }
}