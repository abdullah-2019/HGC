<?php
// app/Http/Controllers/Api/Admin/AboutPageAdminController.php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponseTrait;
use App\Models\AboutCarouselSlide;
use App\Models\AboutCoreValue;
use App\Models\AboutMission;
use App\Models\AboutMissionPoint;
use App\Models\AboutPageSetting;
use App\Models\AboutStory;
use App\Models\AboutStoryHighlight;
use App\Models\AboutVision;
use App\Models\AboutVisionPillar;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class AboutPageAdminController extends Controller
{
    use ApiResponseTrait;

    // ─── Settings ─────────────────────────────────────────

    public function updateSettings(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'hero_background_image' => 'nullable|string|max:500',
            'hero_label_en' => 'nullable|string|max:100',
            'hero_label_dari' => 'nullable|string|max:100',
            'hero_label_pashto' => 'nullable|string|max:100',
            'hero_title_en' => 'nullable|string|max:200',
            'hero_title_dari' => 'nullable|string|max:200',
            'hero_title_pashto' => 'nullable|string|max:200',
            'hero_subtitle_en' => 'nullable|string',
            'hero_subtitle_dari' => 'nullable|string',
            'hero_subtitle_pashto' => 'nullable|string',
            'meta_title_en' => 'nullable|string|max:200',
            'meta_title_dari' => 'nullable|string|max:200',
            'meta_title_pashto' => 'nullable|string|max:200',
            'meta_description_en' => 'nullable|string',
            'meta_description_dari' => 'nullable|string',
            'meta_description_pashto' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $settings = AboutPageSetting::firstOrCreate(['id' => 1]);
        $settings->update($validator->validated());

        Cache::forget('about_page_data');

        return $this->successResponse($settings, 'Settings updated successfully');
    }

    // ─── Story ────────────────────────────────────────────

    public function updateStory(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'section_label_en' => 'nullable|string|max:100',
            'section_label_dari' => 'nullable|string|max:100',
            'section_label_pashto' => 'nullable|string|max:100',
            'title_en' => 'nullable|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'founded_year' => 'nullable|integer|min:1900|max:2100',
            'paragraph_1_en' => 'nullable|string',
            'paragraph_1_dari' => 'nullable|string',
            'paragraph_1_pashto' => 'nullable|string',
            'paragraph_2_en' => 'nullable|string',
            'paragraph_2_dari' => 'nullable|string',
            'paragraph_2_pashto' => 'nullable|string',
            'paragraph_3_en' => 'nullable|string',
            'paragraph_3_dari' => 'nullable|string',
            'paragraph_3_pashto' => 'nullable|string',
            'main_image' => 'nullable|string|max:500',
            'floating_card_value' => 'nullable|string|max:20',
            'floating_card_label_en' => 'nullable|string|max:100',
            'floating_card_label_dari' => 'nullable|string|max:100',
            'floating_card_label_pashto' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $story = AboutStory::firstOrCreate(
            ['id' => $request->input('id', 1)],
            ['sort_order' => 0]
        );
        $story->update($validator->validated());

        Cache::forget('about_page_data');

        return $this->successResponse($story, 'Story updated successfully');
    }

    public function updateStoryHighlights(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'highlights' => 'required|array',
            'highlights.*.id' => 'nullable|integer',
            'highlights.*.icon_name' => 'required|string|max:50',
            'highlights.*.label_en' => 'nullable|string|max:100',
            'highlights.*.label_dari' => 'nullable|string|max:100',
            'highlights.*.label_pashto' => 'nullable|string|max:100',
            'highlights.*.value_text' => 'nullable|string|max:50',
            'highlights.*.sort_order' => 'integer',
            'highlights.*.is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $story = AboutStory::firstOrFail();

        foreach ($request->input('highlights') as $index => $highlightData) {
            $highlightData['sort_order'] = $index;
            $highlightData['about_story_id'] = $story->id;

            AboutStoryHighlight::updateOrCreate(
                ['id' => $highlightData['id'] ?? null],
                $highlightData
            );
        }

        Cache::forget('about_page_data');

        return $this->successResponse(null, 'Highlights updated successfully');
    }

    // ─── Carousel ─────────────────────────────────────────

    public function storeCarouselSlide(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'image_url' => 'required|string|max:500',
            'title_en' => 'nullable|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'location_en' => 'nullable|string|max:100',
            'location_dari' => 'nullable|string|max:100',
            'location_pashto' => 'nullable|string|max:100',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $slide = AboutCarouselSlide::create($validator->validated());

        Cache::forget('about_page_data');

        return $this->successResponse($slide, 'Slide created successfully', 201);
    }

    public function updateCarouselSlide(Request $request, int $id): JsonResponse
    {
        $slide = AboutCarouselSlide::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_url' => 'nullable|string|max:500',
            'title_en' => 'nullable|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'location_en' => 'nullable|string|max:100',
            'location_dari' => 'nullable|string|max:100',
            'location_pashto' => 'nullable|string|max:100',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $slide->update($validator->validated());

        Cache::forget('about_page_data');

        return $this->successResponse($slide, 'Slide updated successfully');
    }

    public function destroyCarouselSlide(int $id): JsonResponse
    {
        AboutCarouselSlide::findOrFail($id)->delete();

        Cache::forget('about_page_data');

        return $this->successResponse(null, 'Slide deleted successfully');
    }

    // ─── Mission ──────────────────────────────────────────

    public function updateMission(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'section_label_en' => 'nullable|string|max:100',
            'section_label_dari' => 'nullable|string|max:100',
            'section_label_pashto' => 'nullable|string|max:100',
            'title_en' => 'nullable|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'quote_text_en' => 'nullable|string|max:300',
            'quote_text_dari' => 'nullable|string|max:300',
            'quote_text_pashto' => 'nullable|string|max:300',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $mission = AboutMission::firstOrCreate(
            ['id' => $request->input('id', 1)],
            ['sort_order' => 0]
        );
        $mission->update($validator->validated());

        Cache::forget('about_page_data');

        return $this->successResponse($mission, 'Mission updated successfully');
    }

    public function updateMissionPoints(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'points' => 'required|array',
            'points.*.id' => 'nullable|integer',
            'points.*.text_en' => 'nullable|string',
            'points.*.text_dari' => 'nullable|string',
            'points.*.text_pashto' => 'nullable|string',
            'points.*.sort_order' => 'integer',
            'points.*.is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $mission = AboutMission::firstOrFail();

        foreach ($request->input('points') as $index => $pointData) {
            $pointData['sort_order'] = $index;
            $pointData['about_mission_id'] = $mission->id;

            AboutMissionPoint::updateOrCreate(
                ['id' => $pointData['id'] ?? null],
                $pointData
            );
        }

        Cache::forget('about_page_data');

        return $this->successResponse(null, 'Mission points updated successfully');
    }

    // ─── Vision ───────────────────────────────────────────

    public function updateVision(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'section_label_en' => 'nullable|string|max:100',
            'section_label_dari' => 'nullable|string|max:100',
            'section_label_pashto' => 'nullable|string|max:100',
            'title_en' => 'nullable|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',
            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'image_url' => 'nullable|string|max:500',
            'badge_value' => 'nullable|string|max:20',
            'badge_label_en' => 'nullable|string|max:100',
            'badge_label_dari' => 'nullable|string|max:100',
            'badge_label_pashto' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $vision = AboutVision::firstOrCreate(
            ['id' => $request->input('id', 1)],
            ['sort_order' => 0]
        );
        $vision->update($validator->validated());

        Cache::forget('about_page_data');

        return $this->successResponse($vision, 'Vision updated successfully');
    }

    public function updateVisionPillars(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pillars' => 'required|array',
            'pillars.*.id' => 'nullable|integer',
            'pillars.*.icon_name' => 'required|string|max:50',
            'pillars.*.title_en' => 'nullable|string|max:100',
            'pillars.*.title_dari' => 'nullable|string|max:100',
            'pillars.*.title_pashto' => 'nullable|string|max:100',
            'pillars.*.description_en' => 'nullable|string',
            'pillars.*.description_dari' => 'nullable|string',
            'pillars.*.description_pashto' => 'nullable|string',
            'pillars.*.sort_order' => 'integer',
            'pillars.*.is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        $vision = AboutVision::firstOrFail();

        foreach ($request->input('pillars') as $index => $pillarData) {
            $pillarData['sort_order'] = $index;
            $pillarData['about_vision_id'] = $vision->id;

            AboutVisionPillar::updateOrCreate(
                ['id' => $pillarData['id'] ?? null],
                $pillarData
            );
        }

        Cache::forget('about_page_data');

        return $this->successResponse(null, 'Vision pillars updated successfully');
    }

    // ─── Core Values ──────────────────────────────────────

    public function updateCoreValues(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'section_label_en' => 'nullable|string|max:100',
            'section_label_dari' => 'nullable|string|max:100',
            'section_label_pashto' => 'nullable|string|max:100',
            'section_title_en' => 'nullable|string|max:200',
            'section_title_dari' => 'nullable|string|max:200',
            'section_title_pashto' => 'nullable|string|max:200',
            'section_description_en' => 'nullable|string',
            'section_description_dari' => 'nullable|string',
            'section_description_pashto' => 'nullable|string',
            'values' => 'required|array',
            'values.*.id' => 'nullable|integer',
            'values.*.icon_name' => 'required|string|max:50',
            'values.*.title_en' => 'nullable|string|max:100',
            'values.*.title_dari' => 'nullable|string|max:100',
            'values.*.title_pashto' => 'nullable|string|max:100',
            'values.*.description_en' => 'nullable|string',
            'values.*.description_dari' => 'nullable|string',
            'values.*.description_pashto' => 'nullable|string',
            'values.*.sort_order' => 'integer',
            'values.*.is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation failed', 422, $validator->errors());
        }

        // Update section header on all rows (first value carries header)
        $headerData = [
            'section_label_en' => $request->input('section_label_en'),
            'section_label_dari' => $request->input('section_label_dari'),
            'section_label_pashto' => $request->input('section_label_pashto'),
            'section_title_en' => $request->input('section_title_en'),
            'section_title_dari' => $request->input('section_title_dari'),
            'section_title_pashto' => $request->input('section_title_pashto'),
            'section_description_en' => $request->input('section_description_en'),
            'section_description_dari' => $request->input('section_description_dari'),
            'section_description_pashto' => $request->input('section_description_pashto'),
        ];

        foreach ($request->input('values') as $index => $valueData) {
            $valueData['sort_order'] = $index;
            $valueData = array_merge($valueData, $headerData);

            AboutCoreValue::updateOrCreate(
                ['id' => $valueData['id'] ?? null],
                $valueData
            );
        }

        Cache::forget('about_page_data');

        return $this->successResponse(null, 'Core values updated successfully');
    }

    public function destroyCoreValue(int $id): JsonResponse
    {
        AboutCoreValue::findOrFail($id)->delete();

        Cache::forget('about_page_data');

        return $this->successResponse(null, 'Core value deleted successfully');
    }

    // ─── Cache Management ─────────────────────────────────

    public function clearCache(): JsonResponse
    {
        Cache::forget('about_page_data');

        return $this->successResponse(null, 'About page cache cleared');
    }
}