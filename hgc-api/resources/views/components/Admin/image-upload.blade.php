<div class="mt-4">
    <label class="block mb-2 text-sm font-medium text-gray-300">{{ $label }}</label>

    @if($current)
        <div class="mb-3">
            <img src="{{ $current }}" alt="{{ $label }}" class="w-32 h-32 rounded-lg object-cover border border-gray-600">
            <p class="mt-1 text-xs text-gray-500">Current image</p>
        </div>
    @endif

    <input type="file" name="{{ $name }}" accept="image/*"
        class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none focus:ring-primary-500 focus:border-primary-500"
    >
    <p class="mt-1 text-xs text-gray-500">PNG, JPG, WEBP up to 2MB</p>
</div>