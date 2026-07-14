<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyRequest;
use App\Models\Admin\Company;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::getAdminList();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(CompanyRequest $request)
    {
        $data = $this->prepareData($request);

        // Create company first to get the ID (optional, slug is enough for path)
        // Actually we can use slug for path before saving

        if ($request->hasFile('logo')) {
            $data['logo_url'] = $request->file('logo')->store(
                'uploads/companies/' . $data['slug'] . '/logos',
                'public'
            );
        }

        if ($request->hasFile('hero_image')) {
            $data['hero_image_path'] = $request->file('hero_image')->store(
                'uploads/companies/' . $data['slug'] . '/heroes',
                'public'
            );
        }

        Company::create($data);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company)
    {
        $data = $this->prepareData($request);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo_url'] = $company->replaceLogo(
                $request->file('logo'), 
                $data['slug']
            );
        }

        // Handle hero image upload
        if ($request->hasFile('hero_image')) {
            $data['hero_image_path'] = $company->replaceHeroImage(
                $request->file('hero_image'), 
                $data['slug']
            );
        }

        $company->update($data);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->deleteAllImageFiles();
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function restore(int $id)
    {
        $company = Company::findForAdmin($id);

        if ($company && $company->trashed()) {
            $company->restore();
            return redirect()->route('admin.companies.index')
                ->with('success', 'Company restored successfully.');
        }

        return redirect()->route('admin.companies.index')
            ->with('error', 'Company not found or not deleted.');
    }

    public function forceDelete(int $id)
    {
        $company = Company::findForAdmin($id);

        if ($company) {
            $company->deleteAllImageFiles();
            $company->forceDelete();
            return redirect()->route('admin.companies.index')
                ->with('success', 'Company permanently deleted.');
        }

        return redirect()->route('admin.companies.index')
            ->with('error', 'Company not found.');
    }

    private function prepareData(CompanyRequest $request): array
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name_en'] ?? 'company');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_featured'] = $request->boolean('is_featured', false);

        $data['employee_count'] = $request->input('employee_count', 0);
        $data['project_count'] = $request->input('project_count', 0);
        $data['province_count'] = $request->input('province_count', 0);
        $data['sort_order'] = $request->input('sort_order', 0);
        $data['display_order'] = $request->input('sort_order', 0);

        unset($data['logo'], $data['hero_image']);

        return $data;
    }
}