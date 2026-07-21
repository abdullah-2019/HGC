<?php
// app/Http/Controllers/Admin/About/AboutStoryController.php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\AboutStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\AboutStoryHighlight; 

class AboutStoryController extends Controller
{
    /**
     * Display the story (show page style - single story).
     */
    public function index()
    {
        $story = AboutStory::with(['highlights' => function ($query) {
            $query->active()->ordered();
        }])->first();

        if (!$story) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'No story found. Please seed the database first.');
        }

        return view('admin.about.story.index', compact('story'));
    }

    /**
     * Show the form for editing the story.
     */
    public function edit()
    {
        $story = AboutStory::with(['highlights' => function ($query) {
            $query->ordered();
        }])->first();

        if (!$story) {
            return redirect()->route('admin.dashboard')
                ->with('error', 'No story found. Please seed the database first.');
        }

        return view('admin.about.story.edit', compact('story'));
    }

    /**
     * Update the story.
     */
        public function update(Request $request)
    {
        $story = AboutStory::first();

        if (!$story) {
            return redirect()->route('admin.about.story.index')
                ->with('error', 'No story found.');
        }

        $validator = Validator::make($request->all(), [
            'section_label_en' => 'required|string|max:100',
            'section_label_dari' => 'nullable|string|max:100',
            'section_label_pashto' => 'nullable|string|max:100',
            'title_en' => 'required|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'founded_year' => 'required|integer|min:1900|max:' . date('Y'),
            'paragraph_1_en' => 'required|string',
            'paragraph_1_dari' => 'nullable|string',
            'paragraph_1_pashto' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'floating_card_value' => 'required|string|max:20',
            'floating_card_label_en' => 'required|string|max:100',
            'floating_card_label_dari' => 'nullable|string|max:100',
            'floating_card_label_pashto' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'highlights' => 'nullable|array',
            'highlights.*.icon_name' => 'required_with:highlights|string|max:50',
            'highlights.*.label_en' => 'required_with:highlights|string|max:100',
            'highlights.*.value_text' => 'required_with:highlights|string|max:50',
            'highlights.*.sort_order' => 'nullable|integer',
            'highlights.*.is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except(['main_image', '_token', '_method', 'highlights']);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            if ($story->main_image && Storage::disk('public')->exists($story->main_image)) {
                Storage::disk('public')->delete($story->main_image);
            }

            $imagePath = $request->file('main_image')->store('about-story', 'public');
            $data['main_image'] = $imagePath;
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $story->update($data);

        // Sync highlights
        $this->syncHighlights($story, $request->input('highlights', []));

        return redirect()->route('admin.about.story.index')
            ->with('success', 'Story updated successfully.');
    }

    /**
     * Sync highlights for the story.
     */
    private function syncHighlights(AboutStory $story, array $highlightsData): void
    {
        $existingIds = [];
        
        foreach ($highlightsData as $highlightData) {
            // Skip empty rows
            if (empty($highlightData['label_en']) || empty($highlightData['value_text'])) {
                continue;
            }

            $id = $highlightData['id'] ?? null;
            
            $data = [
                'about_story_id' => $story->id,
                'icon_name' => $highlightData['icon_name'] ?? 'Building2',
                'label_en' => $highlightData['label_en'],
                'label_dari' => $highlightData['label_dari'] ?? null,
                'label_pashto' => $highlightData['label_pashto'] ?? null,
                'value_text' => $highlightData['value_text'],
                'sort_order' => $highlightData['sort_order'] ?? 0,
                'is_active' => isset($highlightData['is_active']) ? (bool) $highlightData['is_active'] : true,
            ];

            if ($id) {
                $highlight = AboutStoryHighlight::find($id);
                if ($highlight) {
                    $highlight->update($data);
                    $existingIds[] = $highlight->id;
                }
            } else {
                $newHighlight = AboutStoryHighlight::create($data);
                $existingIds[] = $newHighlight->id;
            }
        }

        // Delete highlights that were removed
        $story->highlights()->whereNotIn('id', $existingIds)->delete();
    }
}