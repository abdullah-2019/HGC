<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyValues;
use Illuminate\Http\Request;

class CompanyValueController extends Controller
{
    public function create(Company $company)
    {
        return view('admin.companies.values.create', compact('company'));
    }

    public function store(Request $request, Company $company)
    {
        $data = $this->validateValue($request);
        $company->values()->create($data);

        return redirect()->route('admin.companies.edit', $company)
            ->with('success', 'Value created successfully.');
    }

    public function edit(Company $company, CompanyValues $value)
    {
        return view('admin.companies.values.edit', compact('company', 'value'));
    }

    public function update(Request $request, Company $company, CompanyValues $value)
    {
        $value->update($this->validateValue($request));

        return redirect()->route('admin.companies.edit', $company)
            ->with('success', 'Value updated successfully.');
    }

    public function destroy(Company $company, CompanyValues $value)
    {
        $value->delete();

        return redirect()->route('admin.companies.edit', $company)
            ->with('success', 'Value deleted successfully.');
    }

    private function validateValue(Request $request): array
    {
        return $request->validate([
            'icon_name'         => 'required|string|max:50',
            'title_en'          => 'required|string|max:100',
            'title_dari'        => 'nullable|string|max:100',
            'title_pashto'      => 'nullable|string|max:100',
            'description_en'    => 'required|string',
            'description_dari'  => 'nullable|string',
            'description_pashto'=> 'nullable|string',
            'sort_order'        => 'nullable|integer',
        ]);
    }
}