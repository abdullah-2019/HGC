<div class="mt-4">
    <label class="block mb-2 text-sm font-medium text-gray-300">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="space-y-3">
        {{-- English --}}
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-medium text-gray-500 uppercase">EN</span>
            </div>
            @if($type === 'textarea')
                <textarea name="{{ $name }}_en" rows="3"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    {{ $required ? 'required' : '' }}>{{ old($name . '_en', $values?->{$name . '_en'} ?? '') }}</textarea>
            @else
                <input type="text" name="{{ $name }}_en" value="{{ old($name . '_en', $values?->{$name . '_en'} ?? '') }}"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                    {{ $required ? 'required' : '' }}>
            @endif
        </div>

        {{-- Dari --}}
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-medium text-gray-500 uppercase">Dari</span>
            </div>
            @if($type === 'textarea')
                <textarea name="{{ $name }}_dari" rows="3" dir="rtl"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old($name . '_dari', $values?->{$name . '_dari'} ?? '') }}</textarea>
            @else
                <input type="text" name="{{ $name }}_dari" value="{{ old($name . '_dari', $values?->{$name . '_dari'} ?? '') }}" dir="rtl"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
            @endif
        </div>

        {{-- Pashto --}}
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-medium text-gray-500 uppercase">Pashto</span>
            </div>
            @if($type === 'textarea')
                <textarea name="{{ $name }}_pashto" rows="3" dir="rtl"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">{{ old($name . '_pashto', $values?->{$name . '_pashto'} ?? '') }}</textarea>
            @else
                <input type="text" name="{{ $name }}_pashto" value="{{ old($name . '_pashto', $values?->{$name . '_pashto'} ?? '') }}" dir="rtl"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
            @endif
        </div>
    </div>
</div>