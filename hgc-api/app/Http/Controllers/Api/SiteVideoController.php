<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SiteVideo;

class SiteVideoController extends Controller
{
    public function index()
    {
        $video = SiteVideo::where('is_active', true)->first();

        if (!$video) {
            return response()->json(['success' => true, 'data' => null]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $video->id,
                'video_file' => $video->video_file ? asset('storage/' . $video->video_file) : null,
                'video_url' => $video->video_url,
                'is_active' => $video->is_active,
            ],
        ]);
    }
}