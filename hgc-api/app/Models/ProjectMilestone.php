<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMilestone extends Model
{
    use HasFactory;

    protected $table = 'project_milestones';

    protected $fillable = [
        'project_id',
        'title_en',
        'title_dari',
        'description_en',
        'description_dari',
        'milestone_date',
        'completion_percent',
        'image_url',
    ];

    protected $casts = [
        'milestone_date' => 'date',
        'completion_percent' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}