<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->query('lang', 'en');
        $allowedLangs = ['en', 'dari', 'pashto'];

        if (!in_array($lang, $allowedLangs)) {
            $lang = 'en';
        }

        $slides = HeroSlide::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($slide) use ($lang) {
                return [
                    'id' => $slide->id,
                    'image' => $slide->image,
                    'ken_burns' => $slide->ken_burns,
                    'badge' => $slide->{"badge_{$lang}"},
                    'title' => $slide->{"title_{$lang}"} ?? [],
                    'highlights' => $slide->{"highlights_{$lang}"} ?? [],
                    'subtitle' => $slide->{"subtitle_{$lang}"},
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $slides,
        ]);
    }
}