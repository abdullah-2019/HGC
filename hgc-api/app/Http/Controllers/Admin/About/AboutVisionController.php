<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\AboutVision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutVisionController extends Controller
{

    public function index()
    {
        $vision = AboutVision::with('allPillars')->first();

        return view('admin.about.vision.index', compact('vision'));
    }

    public function create()
    {
        return view('admin.about.vision.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateVisionData($request);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store('uploads', 'public');
        }

        $vision = AboutVision::create($data);

        if ($request->has('pillars')) {
            foreach ($request->input('pillars') as $pillarData) {
                $vision->allPillars()->create($pillarData);
            }
        }

        return redirect()
            ->route('admin.about.vision.index')
            ->with('success', 'Vision created successfully');
    }

    public function edit(AboutVision $vision)
    {
        $vision = $vision->load('allPillars');

        return view('admin.about.vision.edit', compact('vision'));
    }

    public function update(Request $request, AboutVision $vision)
    {
        $data = $this->validateVisionData($request);

        if ($request->hasFile('image')) {
            if ($vision->image_url && Storage::disk('public')->exists($vision->image_url)) {
                Storage::disk('public')->delete($vision->image_url);
            }
            $data['image_url'] = $request->file('image')->store('uploads', 'public');
        } elseif ($request->input('remove_image') === '1') {
            if ($vision->image_url && Storage::disk('public')->exists($vision->image_url)) {
                Storage::disk('public')->delete($vision->image_url);
            }
            $data['image_url'] = null;
        }

        $vision->update($data);

        $this->syncPillars($request, $vision);

        return redirect()
            ->route('admin.about.vision.index')
            ->with('success', 'Vision updated successfully');
    }

    public function destroy(AboutVision $vision)
    {
        if ($vision->image_url && Storage::disk('public')->exists($vision->image_url)) {
            Storage::disk('public')->delete($vision->image_url);
        }

        $vision->delete();

        return back()
            ->with('success', 'Vision deleted successfully');
    }

    private function validateVisionData(Request $request)
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

            'badge_value' => 'nullable|string|max:20',
            'badge_label_en'   => 'nullable|string|max:100',
            'badge_label_dari' => 'nullable|string|max:100',
            'badge_label_pashto' => 'nullable|string|max:100',

            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ]);
    }

    private function syncPillars(Request $request, AboutVision $vision)
    {
        $existingIds = $vision->allPillars()->pluck('id')->toArray();
        $submittedIds = [];

        if ($request->has('pillars')) {
            foreach ($request->input('pillars') as $index => $pillarData) {
                $pillarId = $pillarData['id'] ?? null;

                $payload = [
                    'icon_name'     => $pillarData['icon_name'] ?? 'Compass',
                    'title_en'      => $pillarData['title_en'] ?? null,
                    'title_dari'    => $pillarData['title_dari'] ?? null,
                    'title_pashto'  => $pillarData['title_pashto'] ?? null,
                    'description_en'   => $pillarData['description_en'] ?? null,
                    'description_dari' => $pillarData['description_dari'] ?? null,
                    'description_pashto' => $pillarData['description_pashto'] ?? null,
                    'is_active'     => isset($pillarData['is_active']) ? 1 : 0,
                    'sort_order'    => $index,
                ];

                if ($pillarId && in_array((int)$pillarId, $existingIds)) {
                    $vision->allPillars()->where('id', $pillarId)->update($payload);
                    $submittedIds[] = (int)$pillarId;
                } else {
                    $newPillar = $vision->allPillars()->create($payload);
                    $submittedIds[] = $newPillar->id;
                }
            }
        }

        $toDelete = array_diff($existingIds, $submittedIds);
        if (!empty($toDelete)) {
            $vision->allPillars()->whereIn('id', $toDelete)->delete();
        }
    }
}