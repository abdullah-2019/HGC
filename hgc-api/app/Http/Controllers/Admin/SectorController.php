<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectorController extends Controller
{
    public function index(Request $request)
    {
        $query = Sector::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_dari', 'like', "%{$search}%")
                    ->orWhere('name_pashto', 'like', "%{$search}%");
            });
        }

        $sectors = $query->ordered()->paginate(10);

        return view('admin.sectors.index', compact('sectors'));
    }


    public function create()
    {
        return view('admin.sectors.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_dari' => 'nullable|string|max:255',
            'name_pashto' => 'nullable|string|max:255',

            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',

            'icon_name' => 'nullable|string|max:100',

            'image_url' => 'nullable|image|max:2048',

            'projects_count' => 'nullable|integer',
            'sort_order' => 'nullable|integer',

            'is_active' => 'nullable|boolean',
        ]);


        if ($request->hasFile('image_url')) {
            $validated['image_url'] =
                $request->file('image_url')
                ->store('sectors', 'public');
        }


        $validated['slug'] = Str::slug($validated['name_en']);

        Sector::create($validated);


        return redirect()
            ->route('admin.sectors.index')
            ->with('success', 'Sector created successfully.');
    }


    public function edit(Sector $sector)
    {
        return view('admin.sectors.edit', compact('sector'));
    }


    public function update(Request $request, Sector $sector)
    {
        $validated = $request->validate([
            'name_en' => 'required|string|max:255',
            'name_dari' => 'nullable|string|max:255',
            'name_pashto' => 'nullable|string|max:255',

            'description_en' => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',

            'icon_name' => 'nullable|string|max:100',

            'image_url' => 'nullable|image|max:2048',

            'projects_count' => 'nullable|integer',
            'sort_order' => 'nullable|integer',

            'is_active' => 'nullable|boolean',
        ]);


        if ($request->hasFile('image_url')) {

            $validated['image_url'] =
                $request->file('image_url')
                ->store('sectors', 'public');
        }


        $validated['slug'] = Str::slug($validated['name_en']);


        $sector->update($validated);


        return redirect()
            ->route('admin.sectors.index')
            ->with('success', 'Sector updated successfully.');
    }


    public function destroy(Sector $sector)
    {
        $sector->delete();


        return redirect()
            ->route('admin.sectors.index')
            ->with('success', 'Sector deleted successfully.');
    }
}