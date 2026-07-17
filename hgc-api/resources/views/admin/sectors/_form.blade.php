<div class="space-y-5 bg-gray-800 border border-gray-700 p-5 rounded-xl text-gray-200">

    <!-- Sector Name: English -->
    <div>
        <label for="name_en" class="block mb-2 text-sm font-medium text-white">Sector Name (English)</label>
        <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $sector->name_en ?? '') }}"
            placeholder="e.g. Infrastructure & Development"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none">
    </div>

    <!-- Sector Name: Dari -->
    <div>
        <label for="name_dari" class="block mb-2 text-sm font-medium text-white">Sector Name (Dari / دری)</label>
        <input type="text" id="name_dari" name="name_dari" value="{{ old('name_dari', $sector->name_dari ?? '') }}"
            placeholder="نام بخش به دری" dir="rtl"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none text-right font-serif">
    </div>

    <!-- Sector Name: Pashto -->
    <div>
        <label for="name_pashto" class="block mb-2 text-sm font-medium text-white">Sector Name (Pashto / پښتو)</label>
        <input type="text" id="name_pashto" name="name_pashto"
            value="{{ old('name_pashto', $sector->name_pashto ?? '') }}" placeholder="د سکټور نوم په پښتو"
            dir="rtl"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none text-right font-serif">
    </div>

    <!-- Sector Description: English -->
    <div>
        <label for="description_en" class="block mb-2 text-sm font-medium text-white">Description (English)</label>
        <textarea id="description_en" name="description_en" rows="3"
            placeholder="Provide a brief descriptive overview in English..."
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none">{{ old('description_en', $sector->description_en ?? '') }}</textarea>
    </div>

    <!-- Sector Description: Dari -->
    <div>
        <label for="description_dari" class="block mb-2 text-sm font-medium text-white">Description (Dari / دری)</label>
        <textarea id="description_dari" name="description_dari" rows="3" placeholder="توضیحات مربوطه به زبان دری..."
            dir="rtl"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none text-right font-serif">{{ old('description_dari', $sector->description_dari ?? '') }}</textarea>
    </div>

    <!-- Sector Description: Pashto -->
    <div>
        <label for="description_pashto" class="block mb-2 text-sm font-medium text-white">Description (Pashto /
            پښتو)</label>
        <textarea id="description_pashto" name="description_pashto" rows="3"
            placeholder="په پښتو ژبه اړوند معلومات او توضیحات..." dir="rtl"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none text-right font-serif">{{ old('description_pashto', $sector->description_pashto ?? '') }}</textarea>
    </div>

    <!-- Grid Segment for Utility Metas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Lucide UI Icon Key Reference -->
        <div>
            <label for="icon_name" class="block mb-2 text-sm font-medium text-white">Lucide Icon Class</label>
            <input type="text" id="icon_name" name="icon_name"
                value="{{ old('icon_name', $sector->icon_name ?? '') }}" placeholder="e.g. Briefcase, Hammer"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none font-mono">
        </div>

        <!-- Metric Counter Value -->
        <div>
            <label for="projects_count" class="block mb-2 text-sm font-medium text-white">Projects Counter Value</label>
            <input type="number" id="projects_count" name="projects_count"
                value="{{ old('projects_count', $sector->projects_count ?? 0) }}" placeholder="0" min="0"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none">
        </div>

        <!-- Sorting Priority Index -->
        <div>
            <label for="sort_order" class="block mb-2 text-sm font-medium text-white">Sorting Sequence Priority</label>
            <input type="number" id="sort_order" name="sort_order"
                value="{{ old('sort_order', $sector->sort_order ?? 0) }}" placeholder="0"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 focus:outline-none">
        </div>
    </div>

    <!-- Media File Attachment stream -->
    <div>
        <label for="image_url" class="block mb-2 text-sm font-medium text-white">Upload Promotional Cover Image</label>
        <input type="file" id="image_url" name="image_url"
            class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 file:bg-gray-600 file:border-0 file:me-4 file:py-2.5 file:px-4 file:text-sm file:font-medium file:text-white hover:file:bg-gray-500 focus:outline-none">
        @if (!empty($sector->image_url))
            <p class="mt-2 text-xs text-gray-400">Current file anchor path: <code
                    class="text-purple-400 font-mono">{{ basename($sector->image_url) }}</code></p>
        @endif
    </div>

    <!-- Custom System Toggle Switch -->
    <div class="flex items-center pt-2">
        <input type="hidden" name="is_active" value="0">
        <input id="is_active" type="checkbox" name="is_active" value="1"
            {{ old('is_active', $sector->is_active ?? true) ? 'checked' : '' }}
            class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
        <label for="is_active" class="ms-2 text-sm font-medium text-gray-300">Set sector visibility to Active</label>
    </div>

    <!-- Submissions Controller Trigger -->
    <div class="flex justify-end pt-2 border-t border-gray-700">
        <button type="submit"
            style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; min-width: 140px; display: inline-flex;"
            class="px-5 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
            Save Changes
        </button>
    </div>

</div>
