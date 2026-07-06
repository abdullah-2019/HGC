<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index(): JsonResponse
    {
        $contactInfo = ContactInfo::first();

        if (!$contactInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Contact information not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $contactInfo,
        ]);
    }

    public function storeOrUpdate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            // English
            'address' => 'nullable|string|max:500',
            'phones' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'office_hours' => 'nullable|string|max:255',
            // Dari
            'address_dari' => 'nullable|string|max:500',
            'phones_dari' => 'nullable|string|max:255',
            'email_dari' => 'nullable|email|max:255',
            'office_hours_dari' => 'nullable|string|max:255',
            // Pashto
            'address_pashto' => 'nullable|string|max:500',
            'phones_pashto' => 'nullable|string|max:255',
            'email_pashto' => 'nullable|email|max:255',
            'office_hours_pashto' => 'nullable|string|max:255',
            // Social
            'facebook' => 'nullable|url|max:255',
            'x' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'telegram' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'whatsapp' => 'nullable|string|max:255',
            // Map
            'map_embed_url' => 'nullable|url|max:1000',
            'map_lat' => 'nullable|numeric|between:-90,90',
            'map_lng' => 'nullable|numeric|between:-180,180',
        ]);

        $contactInfo = ContactInfo::first();

        if ($contactInfo) {
            $contactInfo->update($validated);
        } else {
            $contactInfo = ContactInfo::create($validated);
        }

        return response()->json([
            'success' => true,
            'message' => 'Contact information saved successfully',
            'data' => $contactInfo,
        ]);
    }

    public function show(): JsonResponse
    {
        $contactInfo = ContactInfo::first();

        return response()->json([
            'success' => true,
            'data' => $contactInfo,
        ]);
    }
}