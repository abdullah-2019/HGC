<?php
// app/Http/Controllers/Admin/About/AboutStoryHighlightController.php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\AboutStory;
use App\Models\AboutStoryHighlight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutStoryHighlightController extends Controller
{
    public function index()
    {
        $story = AboutStory::first();
        $highlights = AboutStoryHighlight::with('aboutStory')
            ->where('about_story_id', $story?->id)
            ->ordered()
            ->get();

        return view('admin.about.story.highlights.index', compact('highlights', 'story'));
    }

    public function create()
    {
        $story = AboutStory::first();
        return view('admin.about.story.highlights.create', compact('story'));
    }

    public function store(Request $request)
    {
        $story = AboutStory::first();
        
        $validator = Validator::make($request->all(), [
            'icon_name' => 'required|string|max:50',
            'label_en' => 'required|string|max:100',
            'label_dari' => 'nullable|string|max:100',
            'label_pashto' => 'nullable|string|max:100',
            'value_text' => 'required|string|max:50',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        AboutStoryHighlight::create([
            'about_story_id' => $story->id,
            'icon_name' => $request->icon_name,
            'label_en' => $request->label_en,
            'label_dari' => $request->label_dari,
            'label_pashto' => $request->label_pashto,
            'value_text' => $request->value_text,
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.about.story.highlights.index')
            ->with('success', 'Highlight created successfully.');
    }

    public function edit(AboutStoryHighlight $highlight)
    {
        return view('admin.about.story.highlights.edit', compact('highlight'));
    }

    public function update(Request $request, AboutStoryHighlight $highlight)
    {
        $validator = Validator::make($request->all(), [
            'icon_name' => 'required|string|max:50',
            'label_en' => 'required|string|max:100',
            'label_dari' => 'nullable|string|max:100',
            'label_pashto' => 'nullable|string|max:100',
            'value_text' => 'required|string|max:50',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $highlight->update([
            'icon_name' => $request->icon_name,
            'label_en' => $request->label_en,
            'label_dari' => $request->label_dari,
            'label_pashto' => $request->label_pashto,
            'value_text' => $request->value_text,
            'sort_order' => $request->input('sort_order', $highlight->sort_order),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.about.story.highlights.index')
            ->with('success', 'Highlight updated successfully.');
    }

    public function destroy(AboutStoryHighlight $highlight)
    {
        $highlight->delete();
        return redirect()->route('admin.about.story.highlights.index')
            ->with('success', 'Highlight deleted successfully.');
    }
}