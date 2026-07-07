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
        'slug',
        'name_en',
        'name_dari',
        'name_pashto',
        'location_en',
        'location_dari',
        'location_pashto',
        'province',
        'client_name_en',
        'client_name_dari',
        'client_logo_url',
        'budget_amount',
        'budget_currency',
        'start_date',
        'end_date',
        'duration_text',
        'category_id',
        'company_id',
        'description_en',
        'description_dari',
        'description_pashto',
        'status',
        'completion_percent',
        'cover_image_url',
        'gallery_images',
        'meta_title_en',
        'meta_desc_en',
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