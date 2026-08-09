<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->get();
        return view('admin.hero-slides.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero-slides.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|string|max:255',
            'ken_burns' => 'required|in:zoom-in,zoom-out,pan-right,pan-left',
            'badge_en' => 'required|string|max:255',
            'badge_dari' => 'required|string|max:255',
            'badge_pashto' => 'required|string|max:255',
            'title_en' => 'required|string',
            'title_dari' => 'required|string',
            'title_pashto' => 'required|string',
            'highlights_en' => 'nullable|string|max:255',
            'highlights_dari' => 'nullable|string|max:255',
            'highlights_pashto' => 'nullable|string|max:255',
            'subtitle_en' => 'required|string',
            'subtitle_dari' => 'required|string',
            'subtitle_pashto' => 'required|string',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        // Convert newlines to arrays for titles
        foreach (['en', 'dari', 'pashto'] as $lang) {
            $validated["title_{$lang}"] = array_values(array_filter(array_map('trim', explode("\n", $validated["title_{$lang}"]))));
            $validated["highlights_{$lang}"] = $validated["highlights_{$lang}"]
                ? array_values(array_map('intval', array_filter(array_map('trim', explode(',', $validated["highlights_{$lang}"])))))
                : [];
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        HeroSlide::create($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide created successfully.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero-slides.edit', compact('heroSlide'));
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $validated = $request->validate([
            'image' => 'required|string|max:255',
            'ken_burns' => 'required|in:zoom-in,zoom-out,pan-right,pan-left',
            'badge_en' => 'required|string|max:255',
            'badge_dari' => 'required|string|max:255',
            'badge_pashto' => 'required|string|max:255',
            'title_en' => 'required|string',
            'title_dari' => 'required|string',
            'title_pashto' => 'required|string',
            'highlights_en' => 'nullable|string|max:255',
            'highlights_dari' => 'nullable|string|max:255',
            'highlights_pashto' => 'nullable|string|max:255',
            'subtitle_en' => 'required|string',
            'subtitle_dari' => 'required|string',
            'subtitle_pashto' => 'required|string',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        foreach (['en', 'dari', 'pashto'] as $lang) {
            $validated["title_{$lang}"] = array_values(array_filter(array_map('trim', explode("\n", $validated["title_{$lang}"]))));
            $validated["highlights_{$lang}"] = $validated["highlights_{$lang}"]
                ? array_values(array_map('intval', array_filter(array_map('trim', explode(',', $validated["highlights_{$lang}"])))))
                : [];
        }

        $validated['is_active'] = $request->boolean('is_active', false);

        $heroSlide->update($validated);

        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $heroSlide->delete();
        return redirect()->route('admin.hero-slides.index')->with('success', 'Hero slide deleted successfully.');
    }
}