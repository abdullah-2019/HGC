<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutCoreValue extends Model
{
    use HasFactory;

    protected $table = 'about_core_values';

    protected $fillable = [
        'section_label_en',
        'section_label_dari',
        'section_label_pashto',
        'section_title_en',
        'section_title_dari',
        'section_title_pashto',
        'section_description_en',
        'section_description_dari',
        'section_description_pashto',
        'icon_name',
        'title_en',
        'title_dari',
        'title_pashto',
        'description_en',
        'description_dari',
        'description_pashto',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Frontend: active values only, ordered
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Get the first record's section header (shared across all values)
     */
    public static function getSectionHeader()
    {
        return static::first(['section_label_en', 'section_label_dari', 'section_label_pashto', 'section_title_en', 'section_title_dari', 'section_title_pashto', 'section_description_en', 'section_description_dari', 'section_description_pashto']);
    }
}