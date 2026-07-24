<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Award Details</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Icon Name</label>
                    <input type="text" name="icon_name" value="{{ old('icon_name', $award->icon_name ?? 'Trophy') }}"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                    <p class="mt-1 text-xs text-gray-500">Lucide icon name, e.g. Trophy, Star, Medal, Award</p>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Award Year</label>
                    <input type="number" name="award_year"
                        value="{{ old('award_year', $award->award_year ?? date('Y')) }}"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
            </div>

            <x-admin.translatable-input name="title" label="Title" :values="$award ?? null" required="true" />
            <x-admin.translatable-input name="description" label="Description" type="textarea" :values="$award ?? null" />
            <x-admin.translatable-input name="organization" label="Organization" :values="$award ?? null" />

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-300">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $award->sort_order ?? 0) }}"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                </div>
                <div class="flex items-end pb-3">
                    <label class="flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $award->is_active ?? true) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                        <span class="ms-2 text-sm text-gray-300">Active</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Image</h3>
            @php
                $imagePreview = isset($award) && $award->image_url ? asset('storage/' . $award->image_url) : null;
            @endphp
            <x-admin.image-upload name="image" label="Award Image" :current="$imagePreview" />
        </div>
    </div>
</div>

<x-admin.form-actions :back-route="route('admin.companies.edit', $company)" />
