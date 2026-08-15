<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseFeature;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WhyChooseController extends Controller
{
    public function index(): View
    {
        $features = WhyChooseFeature::orderBy('sort_order')->get();

        return view('admin.why-us.index', compact('features'));
    }

    public function create(): View
    {
        return view('admin.why-us.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'icon_name'        => 'required|string|max:50',
            'title_en'         => 'required|string|max:255',
            'title_dari'       => 'nullable|string|max:255',
            'title_pashto'     => 'nullable|string|max:255',
            'description_en'   => 'required|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'sort_order'       => 'required|integer|min:0',
            'is_active'        => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);

        WhyChooseFeature::create($validated);

        return redirect()->route('admin.why-us.index')
            ->with('success', 'Feature created successfully.');
    }

    public function edit(WhyChooseFeature $feature): View
    {
        return view('admin.why-us.edit', compact('feature'));
    }

    public function update(Request $request, WhyChooseFeature $feature): RedirectResponse
    {
        $validated = $request->validate([
            'icon_name'        => 'required|string|max:50',
            'title_en'         => 'required|string|max:255',
            'title_dari'       => 'nullable|string|max:255',
            'title_pashto'     => 'nullable|string|max:255',
            'description_en'   => 'required|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',
            'sort_order'       => 'required|integer|min:0',
            'is_active'        => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', false);

        $feature->update($validated);

        return redirect()->route('admin.why-us.index')
            ->with('success', 'Feature updated successfully.');
    }

    public function destroy(WhyChooseFeature $feature): RedirectResponse
    {
        $feature->delete();

        return redirect()->route('admin.why-us.index')
            ->with('success', 'Feature deleted successfully.');
    }
}