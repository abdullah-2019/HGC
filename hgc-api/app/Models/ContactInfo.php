<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        // English
        'address',
        'phones',
        'email',
        'office_hours',
        // Dari
        'address_dari',
        'phones_dari',
        'email_dari',
        'office_hours_dari',
        // Pashto
        'address_pashto',
        'phones_pashto',
        'email_pashto',
        'office_hours_pashto',
        // Social
        'facebook',
        'x',
        'linkedin',
        'telegram',
        'instagram',
        'youtube',
        'whatsapp',
        // Map
        'map_embed_url',
        'map_lat',
        'map_lng',
    ];

    protected $casts = [
        'map_lat' => 'decimal:8',
        'map_lng' => 'decimal:8',
    ];
}