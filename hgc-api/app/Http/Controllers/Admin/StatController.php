<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::ordered()->paginate(15);

        return view('admin.stats.index', compact('stats'));
    }

    public function edit(Stat $stat)
    {
        return view('admin.stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        $validated = $request->validate([
            'value' => ['required', 'integer', 'min:0'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'label_en' => ['required', 'string', 'max:100'],
            'label_dari' => ['nullable', 'string', 'max:100'],
            'label_pashto' => ['nullable', 'string', 'max:100'],
            'icon_name' => ['required', 'string', 'max:50'],
            'sort_order' => ['required', 'integer'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $stat->update($validated);

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Statistic updated successfully.');
    }
}