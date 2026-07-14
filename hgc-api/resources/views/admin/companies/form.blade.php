{{-- resources/views/admin/companies/_form.blade.php --}}

@csrf
@if(isset($company))
    @method('PUT')
@endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    
    {{-- Left Column: Basic Info --}}
    <div class="lg:col-span-2 space-y-6">
        
        {{-- Basic Information --}}
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Basic Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Slug <span class="text-red-500">*</span></label>
                    <input type="text" name="slug" value="{{ old('slug', $company->slug ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        required>
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Icon Name <span class="text-red-500">*</span></label>
                    <input type="text" name="icon_name" value="{{ old('icon_name', $company->icon_name ?? 'Building2') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                        required>
                </div>
            </div>

            <x-admin.translatable-input name="name" label="Company Name" :values="$company ?? null" required="true" />
            <x-admin.translatable-input name="short_name" label="Short Name" :values="$company ?? null" required="true" />
            <x-admin.translatable-input name="tagline" label="Tagline" :values="$company ?? null" />
            <x-admin.translatable-input name="description" label="Description" type="textarea" :values="$company ?? null" />
        </div>

        {{-- Sector & Contact --}}
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Sector & Contact</h3>
            
            <x-admin.translatable-input name="sector" label="Sector" :values="$company ?? null" required="true" />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Email</label>
                    <input type="email" name="email" value="{{ old('email', $company->email ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $company->phone ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
            </div>

            <x-admin.translatable-input name="address" label="Address" :values="$company ?? null" />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Latitude</label>
                    <input type="number" step="any" name="latitude" value="{{ old('latitude', $company->latitude ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Longitude</label>
                    <input type="number" step="any" name="longitude" value="{{ old('longitude', $company->longitude ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
            </div>
        </div>

        {{-- Social Links --}}
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Social Links</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Website URL</label>
                    <input type="url" name="website_url" value="{{ old('website_url', $company->website_url ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Facebook</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', $company->facebook_url ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">LinkedIn</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $company->linkedin_url ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Twitter</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', $company->twitter_url ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Instagram</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', $company->instagram_url ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
            </div>
        </div>

        {{-- About, Mission, Vision, Values --}}
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">About, Mission, Vision & Values</h3>
            
            <x-admin.translatable-input name="about" label="About" type="textarea" :values="$company ?? null" />
            <x-admin.translatable-input name="mission" label="Mission" type="textarea" :values="$company ?? null" />
            <x-admin.translatable-input name="vision" label="Vision" type="textarea" :values="$company ?? null" />
            <x-admin.translatable-input name="value" label="Values" type="textarea" :values="$company ?? null" />
        </div>

    </div>

    {{-- Right Column: Settings & Images --}}
    <div class="space-y-6">
        
        {{-- Status & Settings --}}
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Settings</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Accent Color <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-2">
                        <input type="color" id="accent_color_picker" 
                            value="{{ old('accent_color', $company->accent_color ?? '#C9A227') }}" 
                            class="w-12 h-10 rounded-lg cursor-pointer bg-gray-700 border border-gray-600">
                        <input type="text" name="accent_color" 
                            value="{{ old('accent_color', $company->accent_color ?? '#C9A227') }}" 
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                </div>
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Secondary Color</label>
                    <div class="flex items-center gap-2">
                        <input type="color" id="secondary_color_picker" 
                            value="{{ old('secondary_color', $company->secondary_color ?? '') }}" 
                            class="w-12 h-10 rounded-lg cursor-pointer bg-gray-700 border border-gray-600">
                        <input type="text" name="secondary_color" 
                            value="{{ old('secondary_color', $company->secondary_color ?? '') }}" 
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Established Year</label>
                    <input type="number" name="established_year" 
                        value="{{ old('established_year', $company->established_year ?? '') }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">Employees</label>
                        <input type="number" name="employee_count" 
                            value="{{ old('employee_count', $company->employee_count ?? 0) }}" 
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">Projects</label>
                        <input type="number" name="project_count" 
                            value="{{ old('project_count', $company->project_count ?? 0) }}" 
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-300">Provinces</label>
                        <input type="number" name="province_count" 
                            value="{{ old('province_count', $company->province_count ?? 0) }}" 
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Sort Order</label>
                    <input type="number" name="sort_order" 
                        value="{{ old('sort_order', $company->sort_order ?? 0) }}" 
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" 
                            {{ old('is_active', $company->is_active ?? true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                        <span class="ms-2 text-sm text-gray-300">Active</span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" 
                            {{ old('is_featured', $company->is_featured ?? false) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                        <span class="ms-2 text-sm text-gray-300">Featured</span>
                    </label>
                </div>
            </div>
        </div>

        {{-- Images --}}
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Images</h3>
            
            {{-- Use admin model's getAdminImagePreviews() for correct preview URLs --}}
            @php
                $logoPreview = isset($company) ? $company->getLogoPreviewUrl() : null;
                $heroPreview = isset($company) ? $company->getHeroPreviewUrl() : null;
            @endphp
            
            <x-admin.image-upload name="logo" label="Company Logo" :current="$logoPreview" />
            <x-admin.image-upload name="hero_image" label="Hero Image" :current="$heroPreview" />
        </div>

    </div>
</div>

<x-admin.form-actions :back-route="route('admin.companies.index')" />

<script>
    // Sync color pickers with text inputs
    document.getElementById('accent_color_picker').addEventListener('input', function() {
        document.querySelector('input[name="accent_color"]').value = this.value;
    });
    document.querySelector('input[name="accent_color"]').addEventListener('input', function() {
        document.getElementById('accent_color_picker').value = this.value;
    });
    
    document.getElementById('secondary_color_picker').addEventListener('input', function() {
        document.querySelector('input[name="secondary_color"]').value = this.value;
    });
    document.querySelector('input[name="secondary_color"]').addEventListener('input', function() {
        document.getElementById('secondary_color_picker').value = this.value;
    });
</script>