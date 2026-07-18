<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\AboutMission;
use App\Models\AboutMissionPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutMissionController extends Controller
{

    public function index()
    {
        $mission = AboutMission::with('allPoints')->first();

        return view('admin.about.mission.index', compact('mission'));
    }

    public function create()
    {
        return view('admin.about.mission.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateMissionData($request);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('uploads', 'public');
        }

        $mission = AboutMission::create($data);

        if ($request->has('points')) {
            foreach ($request->input('points') as $pointData) {
                $mission->allPoints()->create($pointData);
            }
        }

        return redirect()
            ->route('admin.about.mission.index')
            ->with('success', 'Mission created successfully');
    }

    public function edit(AboutMission $mission)
    {
        $mission = $mission->load('allPoints');

        return view('admin.about.mission.edit', compact('mission'));
    }

    public function update(Request $request, AboutMission $mission)
    {
        $data = $this->validateMissionData($request);

        if ($request->hasFile('image')) {
            if ($mission->image_url && Storage::disk('public')->exists($mission->image_url)) {
                Storage::disk('public')->delete($mission->image_url);
            }
            $data['image_url'] = $request->file('image')->store('uploads', 'public');
        } elseif ($request->input('remove_image') === '1') {
            if ($mission->image_url && Storage::disk('public')->exists($mission->image_url)) {
                Storage::disk('public')->delete($mission->image_url);
            }
            $data['image_url'] = null;
        }

        $mission->update($data);

        $this->syncPoints($request, $mission);

        return redirect()
            ->route('admin.about.mission.index')
            ->with('success', 'Mission updated successfully');
    }

    public function destroy(AboutMission $mission)
    {
        if ($mission->image_url && Storage::disk('public')->exists($mission->image_url)) {
            Storage::disk('public')->delete($mission->image_url);
        }

        $mission->delete();

        return back()
            ->with('success', 'Mission deleted successfully');
    }

    private function validateMissionData(Request $request)
    {
        return $request->validate([
            'section_label_en'   => 'nullable|string|max:100',
            'section_label_dari' => 'nullable|string|max:100',
            'section_label_pashto' => 'nullable|string|max:100',

            'title_en'   => 'nullable|string|max:200',
            'title_dari' => 'nullable|string|max:200',
            'title_pashto' => 'nullable|string|max:200',

            'description_en'   => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',

            'quote_text_en'   => 'nullable|string|max:300',
            'quote_text_dari' => 'nullable|string|max:300',
            'quote_text_pashto' => 'nullable|string|max:300',

            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ]);
    }

    private function syncPoints(Request $request, AboutMission $mission)
    {
        // FIX #1: Use allPoints() instead of points() to include inactive points
        $existingIds = $mission->allPoints()->pluck('id')->toArray();
        $submittedIds = [];

        if ($request->has('points')) {
            foreach ($request->input('points') as $index => $pointData) {
                $pointId = $pointData['id'] ?? null;

                $payload = [
                    'text_en'     => $pointData['text_en'] ?? null,
                    'text_dari'   => $pointData['text_dari'] ?? null,
                    'text_pashto' => $pointData['text_pashto'] ?? null,
                    'is_active'   => isset($pointData['is_active']) ? 1 : 0,
                    'sort_order'  => $index,
                ];

                if ($pointId && in_array((int)$pointId, $existingIds)) {
                    // FIX #2: Use allPoints() for update too
                    $mission->allPoints()->where('id', $pointId)->update($payload);
                    $submittedIds[] = (int)$pointId;
                } else {
                    $newPoint = $mission->allPoints()->create($payload);
                    $submittedIds[] = $newPoint->id;
                }
            }
        }

        // FIX #3: Use allPoints() for delete too
        $toDelete = array_diff($existingIds, $submittedIds);
        if (!empty($toDelete)) {
            $mission->allPoints()->whereIn('id', $toDelete)->delete();
        }
    }
}