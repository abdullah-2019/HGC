<?php

namespace App\Http\Controllers\Admin\About;

use App\Http\Controllers\Controller;
use App\Models\AboutCoreValue;
use Illuminate\Http\Request;

class AboutCoreValueController extends Controller
{

    public function index()
    {
        $values = AboutCoreValue::orderBy('sort_order')->get();
        $section = $values->first();

        return view('admin.about.values.index', compact('values', 'section'));
    }

    public function create()
    {
        return view('admin.about.values.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateValueData($request);

        // Copy section header from first existing record
        $first = AboutCoreValue::first();
        if ($first) {
            $data['section_label_en']   = $first->section_label_en;
            $data['section_label_dari'] = $first->section_label_dari;
            $data['section_label_pashto'] = $first->section_label_pashto;
            $data['section_title_en']   = $first->section_title_en;
            $data['section_title_dari'] = $first->section_title_dari;
            $data['section_title_pashto'] = $first->section_title_pashto;
            $data['section_description_en']   = $first->section_description_en;
            $data['section_description_dari'] = $first->section_description_dari;
            $data['section_description_pashto'] = $first->section_description_pashto;
        }

        AboutCoreValue::create($data);

        return redirect()
            ->route('admin.about.values.index')
            ->with('success', 'Core value created successfully');
    }

    public function edit(AboutCoreValue $value)
    {
        return view('admin.about.values.edit', compact('value'));
    }

    public function update(Request $request, AboutCoreValue $value)
    {
        $data = $this->validateValueData($request);
        $value->update($data);

        return redirect()
            ->route('admin.about.values.index')
            ->with('success', 'Core value updated successfully');
    }

    public function destroy(AboutCoreValue $value)
    {
        $deletedSortOrder = $value->sort_order;

        $value->delete();

        // Shift all values with higher sort_order down by 1
        AboutCoreValue::where('sort_order', '>', $deletedSortOrder)
            ->decrement('sort_order');

        return back()
            ->with('success', 'Core value deleted successfully');
    }

    private function validateValueData(Request $request)
    {
        return $request->validate([
            'icon_name' => 'nullable|string|max:50',

            'title_en'   => 'nullable|string|max:100',
            'title_dari' => 'nullable|string|max:100',
            'title_pashto' => 'nullable|string|max:100',

            'description_en'   => 'nullable|string',
            'description_dari' => 'nullable|string',
            'description_pashto' => 'nullable|string',

            'is_active'  => 'boolean',
            'sort_order' => 'required|integer|unique:about_core_values,sort_order',
        ]);
    }
}