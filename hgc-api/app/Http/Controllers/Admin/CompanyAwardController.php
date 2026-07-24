<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyAwards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyAwardController extends Controller
{
    public function create(Company $company)
    {
        return view('admin.companies.awards.create', compact('company'));
    }

    public function store(Request $request, Company $company)
    {
        $data = $this->validateAward($request);

        if ($request->hasFile('image')) {
            $data['image_url'] = $request->file('image')->store(
                'uploads/companies/' . $company->slug . '/awards',
                'public'
            );
        }

        $company->awards()->create($data);

        return redirect()->route('admin.companies.edit', $company)
            ->with('success', 'Award created successfully.');
    }

    public function edit(Company $company, CompanyAwards $award)
    {
        return view('admin.companies.awards.edit', compact('company', 'award'));
    }

    public function update(Request $request, Company $company, CompanyAwards $award)
    {
        $data = $this->validateAward($request);

        if ($request->hasFile('image')) {
            if ($award->image_url) {
                Storage::disk('public')->delete($award->image_url);
            }
            $data['image_url'] = $request->file('image')->store(
                'uploads/companies/' . $company->slug . '/awards',
                'public'
            );
        }

        $award->update($data);

        return redirect()->route('admin.companies.edit', $company)
            ->with('success', 'Award updated successfully.');
    }

    public function destroy(Company $company, CompanyAwards $award)
    {
        if ($award->image_url) {
            Storage::disk('public')->delete($award->image_url);
        }
        $award->delete();

        return redirect()->route('admin.companies.edit', $company)
            ->with('success', 'Award deleted successfully.');
    }

    private function validateAward(Request $request): array
    {
        return $request->validate([
            'icon_name'       => 'nullable|string|max:50',
            'award_year'        => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'title_en'          => 'required|string|max:255',
            'title_dari'        => 'nullable|string|max:255',
            'title_pashto'      => 'nullable|string|max:255',
            'description_en'    => 'nullable|string',
            'description_dari'  => 'nullable|string',
            'description_pashto'=> 'nullable|string',
            'organization_en'   => 'nullable|string|max:255',
            'organization_dari' => 'nullable|string|max:255',
            'organization_pashto'=> 'nullable|string|max:255',
            'sort_order'        => 'nullable|integer',
            'is_active'         => 'boolean',
            'image'             => 'nullable|image|max:2048',
        ]);
    }
}