@extends('admin.layouts.app')

@section('title', 'Edit Core Value')
@section('page-title', 'Edit Core Value')

@section('content')

    <div class="min-h-screen bg-gray-950 p-6">
        <div class="max-w-5xl mx-auto">
            {{-- HEADER --}}
            <div class="mb-2">
                <a href="{{ route('admin.about.values.index') }}"
                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-300 text-sm font-medium transition-colors border border-gray-700 whitespace-nowrap">
                    <svg class="w-4 h-10 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to values
                </a>
            </div>

            <form action="{{ route('admin.about.values.update', $value) }}" method="POST" id="valueForm">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-6 bg-red-900/30 border border-red-800 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-red-300 text-sm font-medium">Please fix the following errors:</p>
                                <ul class="mt-1 text-red-400 text-sm list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- BASIC INFO --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">Basic information</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Icon
                                Name</label>
                            <input type="text" name="icon_name" value="{{ old('icon_name', $value->icon_name) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-500">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Sort
                                Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $value->sort_order) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
                        </div>
                        <div class="flex items-end pb-3">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="is_active" id="is_active" value="1"
                                    {{ old('is_active', $value->is_active) ? 'checked' : '' }}
                                    class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-900">
                                <label for="is_active" class="text-gray-300 text-sm cursor-pointer select-none">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- VALUE CONTENT --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-green-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">Value Content</h2>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Title
                                (EN)</label>
                            <input type="text" name="title_en" value="{{ old('title_en', $value->title_en) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-500 mb-4">
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Description
                                (EN)</label>
                            <textarea name="description_en" rows="4"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-y placeholder-gray-500">{{ old('description_en', $value->description_en) }}</textarea>
                        </div>
                        <div dir="rtl">
                            <label
                                class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">عنوان</label>
                            <input type="text" name="title_dari" value="{{ old('title_dari', $value->title_dari) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors placeholder-gray-500 text-right mb-4">
                            <label
                                class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">توضیحات</label>
                            <textarea name="description_dari" rows="4"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors resize-y placeholder-gray-500 text-right">{{ old('description_dari', $value->description_dari) }}</textarea>
                        </div>
                        <div dir="rtl">
                            <label
                                class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">سرلیک</label>
                            <input type="text" name="title_pashto"
                                value="{{ old('title_pashto', $value->title_pashto) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors placeholder-gray-500 text-right mb-4">
                            <label
                                class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">تشریح</label>
                            <textarea name="description_pashto" rows="4"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors resize-y placeholder-gray-500 text-right">{{ old('description_pashto', $value->description_pashto) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center justify-end gap-4 pb-8">
                    <a href="{{ route('admin.about.values.index') }}"
                        class="px-6 py-3 rounded-xl bg-gray-800 hover:bg-gray-700 text-gray-300 text-sm font-medium transition-colors border border-gray-700">
                        Cancel
                    </a>
                    <button type="submit"
                        style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; min-width: 140px; display: inline-flex;"
                        class="px-5 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
