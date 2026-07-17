<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index(Request $request)
    {
        $query = SiteSetting::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('setting_key', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%')
                    ->orWhere('setting_value', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('type')) {
            $query->where('setting_type', $request->type);
        }

        $settings = $query
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.settings.index', compact('settings'));
    }


    public function show(SiteSetting $siteSetting)
    {
        return view('admin.settings.show', compact('siteSetting'));
    }


    public function edit(SiteSetting $siteSetting)
    {
        return view('admin.settings.edit', compact('siteSetting'));
    }


    public function update(Request $request, SiteSetting $siteSetting)
    {
        $request->validate([
            'setting_value' => 'nullable',
        ]);

        $siteSetting->update([
            'setting_value' => $request->setting_value,
            'updated_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Setting updated successfully.');
    }


    public function destroy(SiteSetting $siteSetting)
    {
        $siteSetting->delete();

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}