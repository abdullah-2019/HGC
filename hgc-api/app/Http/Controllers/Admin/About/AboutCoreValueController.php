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
        $value->delete();

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
            'sort_order' => 'integer',
        ]);
    }
}