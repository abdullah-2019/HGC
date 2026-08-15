@extends('admin.layouts.app')

@section('title', 'Edit Feature')
@section('page-title', 'Why Choose Us')

@section('content')

    @include('admin.error-alert')


    <x-admin.page-header title="Edit Feature" subtitle="Update why choose us feature" :back-route="route('admin.why-us.index')"
        back-label="Back to List" />

    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 max-w-5xl">
        <form action="{{ route('admin.why-us.update', $feature) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Icon --}}
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Lucide Icon Name
                    </label>
                    <input type="text" name="icon_name"
                        value="{{ old('icon_name') !== null ? old('icon_name') : $feature->icon_name }}"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="e.g. ShieldCheck, Users, Zap, HeartHandshake">
                    <p class="mt-1 text-xs text-gray-500">Find valid names at lucide.dev</p>
                    @error('icon_name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Titles --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Title (English) <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title_en"
                        value="{{ old('title_en') !== null ? old('title_en') : $feature->title_en }}"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Enter English title" required>
                    @error('title_en')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Title (Dari)
                    </label>
                    <input type="text" name="title_dari"
                        value="{{ old('title_dari') !== null ? old('title_dari') : $feature->title_dari }}" dir="rtl"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="عنوان به دری">
                    @error('title_dari')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Title (Pashto)
                    </label>
                    <input type="text" name="title_pashto"
                        value="{{ old('title_pashto') !== null ? old('title_pashto') : $feature->title_pashto }}"
                        dir="rtl"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="عنوان په پښتو">
                    @error('title_pashto')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Descriptions --}}
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Description (English) <span class="text-red-400">*</span>
                    </label>
                    <textarea name="description_en" rows="4"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"
                        placeholder="Enter English description" required>{{ old('description_en') !== null ? old('description_en') : $feature->description_en }}</textarea>
                    @error('description_en')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Description (Dari)
                    </label>
                    <textarea name="description_dari" rows="4" dir="rtl"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"
                        placeholder="توضیحات به دری">{{ old('description_dari') !== null ? old('description_dari') : $feature->description_dari }}</textarea>
                    @error('description_dari')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Description (Pashto)
                    </label>
                    <textarea name="description_pashto" rows="4" dir="rtl"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none"
                        placeholder="توضیحات په پښتو">{{ old('description_pashto') !== null ? old('description_pashto') : $feature->description_pashto }}</textarea>
                    @error('description_pashto')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Settings --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-300 mb-2">
                        Sort Order <span class="text-red-400">*</span>
                    </label>
                    <input type="number" name="sort_order"
                        value="{{ old('sort_order') !== null ? old('sort_order') : $feature->sort_order }}" min="0"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required>
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-1 flex items-end pb-3">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                            {{ (old('is_active') !== null ? old('is_active') : $feature->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-800">
                        <span class="text-sm font-medium text-gray-300">Active</span>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-700">
                <a href="{{ route('admin.why-us.index') }}"
                    class="px-6 py-2.5 rounded-lg border border-gray-600 text-gray-300 hover:bg-gray-700 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-medium hover:bg-blue-500 transition">
                    Update Feature
                </button>
            </div>
        </form>
    </div>
@endsection
