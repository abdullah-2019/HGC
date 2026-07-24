<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
            <h3 class="text-lg font-semibold text-white mb-4">Value Details</h3>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-300">Icon Name <span class="text-red-500">*</span></label>
                <input type="text" name="icon_name" required
                       value="{{ old('icon_name', $value->icon_name ?? 'Shield') }}"
                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                <p class="mt-1 text-xs text-gray-500">Lucide icon name, e.g. Shield, Heart, Lightbulb, Handshake</p>
            </div>

            <x-admin.translatable-input name="title" label="Title" :values="$value ?? null" required="true" />
            <x-admin.translatable-input name="description" label="Description" type="textarea" :values="$value ?? null" required="true" />

            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-300">Sort Order</label>
                <input type="number" name="sort_order"
                       value="{{ old('sort_order', $value->sort_order ?? 0) }}"
                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
            </div>
        </div>
    </div>
</div>

<x-admin.form-actions :back-route="route('admin.companies.edit', $company)" />