<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'description',
        'updated_by',
    ];

    protected $casts = [
        'setting_value' => 'string',
    ];

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getDecodedValueAttribute()
    {
        if ($this->setting_type === 'json') {
            return json_decode($this->setting_value, true);
        }

        if ($this->setting_type === 'boolean') {
            return filter_var($this->setting_value, FILTER_VALIDATE_BOOLEAN);
        }

        return $this->setting_value;
    }
}