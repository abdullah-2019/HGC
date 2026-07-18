@extends('admin.layouts.app')

@section('title', 'Edit Vision')
@section('page-title', 'Edit Vision')

@section('content')

    <div class="min-h-screen bg-gray-950 p-6">
        <div class="max-w-5xl mx-auto">
            {{-- HEADER --}}
            <a href="{{ route('admin.about.vision.index') }}"
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-300 text-sm font-medium transition-colors border border-gray-700 whitespace-nowrap">
                <svg class="w-4 h-10 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to preview
            </a>

            <form action="{{ route('admin.about.vision.update', $vision) }}" method="POST" enctype="multipart/form-data"
                id="visionForm">
                @csrf
                @method('PUT')

                {{-- VALIDATION ERRORS --}}
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

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Section
                                label (EN)</label>
                            <input type="text" name="section_label_en"
                                value="{{ old('section_label_en', $vision->section_label_en) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-500">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Sort
                                order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $vision->sort_order) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors">
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-4 bg-gray-800/50 rounded-xl border border-gray-700/50">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $vision->is_active) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-600 bg-gray-700 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-900">
                        <label for="is_active" class="text-gray-300 text-sm cursor-pointer select-none">
                            Active — display this vision on the public site
                        </label>
                    </div>
                </div>

                {{-- BADGE --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">Vision Badge</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Badge
                                Value</label>
                            <input type="text" name="badge_value" value="{{ old('badge_value', $vision->badge_value) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition-colors placeholder-gray-500">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Label
                                (EN)</label>
                            <input type="text" name="badge_label_en"
                                value="{{ old('badge_label_en', $vision->badge_label_en) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-500">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Label
                                (Dari)</label>
                            <input type="text" name="badge_label_dari"
                                value="{{ old('badge_label_dari', $vision->badge_label_dari) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors placeholder-gray-500 text-right"
                                dir="rtl">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Label
                                (Pashto)</label>
                            <input type="text" name="badge_label_pashto"
                                value="{{ old('badge_label_pashto', $vision->badge_label_pashto) }}"
                                class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors placeholder-gray-500 text-right"
                                dir="rtl">
                        </div>
                    </div>
                </div>

                {{-- HERO IMAGE --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">Hero image</h2>
                    </div>

                    @if ($vision->image_url)
                        <div class="mb-5">
                            <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-3">Current
                                image</label>
                            <div class="relative rounded-xl overflow-hidden border border-gray-700 max-w-md">
                                <img src="{{ asset('storage/' . ltrim($vision->image_url, '/')) }}"
                                    class="w-full h-48 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-3">
                            {{ $vision->image_url ? 'Replace image' : 'Upload image' }}
                        </label>
                        <div class="border-2 border-dashed border-gray-700 hover:border-gray-500 rounded-xl p-8 text-center bg-gray-800/30 transition-colors cursor-pointer"
                            onclick="document.getElementById('imageInput').click()">
                            <svg class="w-10 h-10 text-gray-500 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <p class="text-gray-400 text-sm">Click to upload or drag and drop</p>
                            <p class="text-gray-500 text-xs mt-1">WebP, JPG, PNG up to 2MB</p>
                        </div>
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden"
                            onchange="handleImagePreview(this)">
                        <div id="imagePreview" class="hidden mt-4"></div>
                    </div>

                    @if ($vision->image_url)
                        <div class="mt-4 flex items-center gap-3">
                            <input type="checkbox" name="remove_image" id="remove_image" value="1"
                                class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-red-500 focus:ring-red-500 focus:ring-offset-gray-900">
                            <label for="remove_image" class="text-red-400 text-sm cursor-pointer select-none">Remove
                                current image</label>
                        </div>
                    @endif
                </div>

                {{-- ENGLISH CONTENT --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">English content</h2>
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Title</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $vision->title_en) }}"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-500">
                    </div>

                    <div>
                        <label
                            class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">Description</label>
                        <textarea name="description_en" rows="4"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-y placeholder-gray-500">{{ old('description_en', $vision->description_en) }}</textarea>
                    </div>
                </div>

                {{-- DARI CONTENT --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6" dir="rtl">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-green-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">محتوای دری</h2>
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">عنوان</label>
                        <input type="text" name="title_dari" value="{{ old('title_dari', $vision->title_dari) }}"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors placeholder-gray-500 text-right">
                    </div>

                    <div>
                        <label
                            class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">توضیحات</label>
                        <textarea name="description_dari" rows="4"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors resize-y placeholder-gray-500 text-right">{{ old('description_dari', $vision->description_dari) }}</textarea>
                    </div>
                </div>

                {{-- PASHTO CONTENT --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6" dir="rtl">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-purple-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">پښتو محتوا</h2>
                    </div>

                    <div class="mb-5">
                        <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">سرلیک</label>
                        <input type="text" name="title_pashto"
                            value="{{ old('title_pashto', $vision->title_pashto) }}"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors placeholder-gray-500 text-right">
                    </div>

                    <div>
                        <label class="block text-gray-400 text-xs uppercase tracking-wider font-medium mb-2">تشریح</label>
                        <textarea name="description_pashto" rows="4"
                            class="w-full px-4 py-3 rounded-xl bg-gray-800 border border-gray-700 text-white text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors resize-y placeholder-gray-500 text-right">{{ old('description_pashto', $vision->description_pashto) }}</textarea>
                    </div>
                </div>

                {{-- VISION PILLARS --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-6 bg-green-500 rounded-full"></span>
                            <h2 class="text-lg font-semibold text-white">Vision pillars</h2>
                        </div>
                        <button type="button" onclick="addPillar()"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-800 hover:bg-gray-700 text-gray-300 text-sm font-medium transition-colors border border-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add pillar
                        </button>
                    </div>

                    <div id="pillarsContainer" class="space-y-4">
                        @php
                            $pillars = old('pillars', $vision->allPillars->toArray());
                            if (empty($pillars)) {
                                $pillars = [
                                    [
                                        'id' => '',
                                        'icon_name' => 'Compass',
                                        'title_en' => '',
                                        'title_dari' => '',
                                        'title_pashto' => '',
                                        'description_en' => '',
                                        'description_dari' => '',
                                        'description_pashto' => '',
                                        'is_active' => 1,
                                    ],
                                ];
                            }
                        @endphp

                        @foreach ($pillars as $index => $pillar)
                            <div class="pillar-card bg-gray-800/50 border border-gray-700/50 rounded-xl p-5"
                                data-index="{{ $index }}">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="pillar-number flex items-center justify-center w-8 h-8 rounded-lg bg-gray-700 text-white text-sm font-semibold">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-gray-400 text-sm font-medium">Pillar #<span
                                                class="pillar-label">{{ $index + 1 }}</span></span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center gap-2">
                                            <input type="checkbox" name="pillars[{{ $index }}][is_active]"
                                                id="pillar_{{ $index }}_active" value="1"
                                                @if (is_array($pillar) && array_key_exists('is_active', $pillar)) {{ $pillar['is_active'] ? 'checked' : '' }}
                                                @else
                                                    checked @endif
                                                class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-green-500 focus:ring-green-500 focus:ring-offset-gray-900">
                                            <label for="pillar_{{ $index }}_active"
                                                class="text-gray-400 text-xs cursor-pointer select-none">Active</label>
                                        </div>
                                        <button type="button" onclick="removePillar(this)"
                                            class="p-2 rounded-lg text-gray-500 hover:text-red-400 hover:bg-red-900/20 transition-colors"
                                            title="Remove pillar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <input type="hidden" name="pillars[{{ $index }}][id]"
                                    value="{{ $pillar['id'] ?? '' }}">

                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                                    <div>
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">Icon
                                            Name</label>
                                        <input type="text" name="pillars[{{ $index }}][icon_name]"
                                            value="{{ $pillar['icon_name'] ?? 'Compass' }}"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-600">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                    <div>
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">Title
                                            (EN)
                                        </label>
                                        <input type="text" name="pillars[{{ $index }}][title_en]"
                                            value="{{ $pillar['title_en'] ?? '' }}"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-600 mb-2">
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">Description
                                            (EN)</label>
                                        <textarea name="pillars[{{ $index }}][description_en]" rows="3"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-y placeholder-gray-600">{{ $pillar['description_en'] ?? '' }}</textarea>
                                    </div>
                                    <div dir="rtl">
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">عنوان</label>
                                        <input type="text" name="pillars[{{ $index }}][title_dari]"
                                            value="{{ $pillar['title_dari'] ?? '' }}"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors placeholder-gray-600 text-right mb-2">
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">توضیحات</label>
                                        <textarea name="pillars[{{ $index }}][description_dari]" rows="3"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors resize-y placeholder-gray-600 text-right">{{ $pillar['description_dari'] ?? '' }}</textarea>
                                    </div>
                                    <div dir="rtl">
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">سرلیک</label>
                                        <input type="text" name="pillars[{{ $index }}][title_pashto]"
                                            value="{{ $pillar['title_pashto'] ?? '' }}"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors placeholder-gray-600 text-right mb-2">
                                        <label
                                            class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">تشریح</label>
                                        <textarea name="pillars[{{ $index }}][description_pashto]" rows="3"
                                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors resize-y placeholder-gray-600 text-right">{{ $pillar['description_pashto'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center justify-end gap-4 pb-8">
                    <a href="{{ route('admin.about.vision.index') }}"
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

    <script>
        let pillarCounter = {{ count($pillars) }};

        function addPillar() {
            const container = document.getElementById('pillarsContainer');
            const index = pillarCounter++;
            const html = `
            <div class="pillar-card bg-gray-800/50 border border-gray-700/50 rounded-xl p-5" data-index="${index}">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <span class="pillar-number flex items-center justify-center w-8 h-8 rounded-lg bg-gray-700 text-white text-sm font-semibold">
                            ${index + 1}
                        </span>
                        <span class="text-gray-400 text-sm font-medium">Pillar #<span class="pillar-label">${index + 1}</span></span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <input type="checkbox"
                                name="pillars[${index}][is_active]"
                                id="pillar_${index}_active"
                                value="1"
                                checked
                                class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-green-500 focus:ring-green-500 focus:ring-offset-gray-900">
                            <label for="pillar_${index}_active" class="text-gray-400 text-xs cursor-pointer select-none">Active</label>
                        </div>
                        <button type="button" onclick="removePillar(this)"
                            class="p-2 rounded-lg text-gray-500 hover:text-red-400 hover:bg-red-900/20 transition-colors"
                            title="Remove pillar">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <input type="hidden" name="pillars[${index}][id]" value="">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">Icon Name</label>
                        <input type="text" name="pillars[${index}][icon_name]" value="Compass"
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-600">
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">Title (EN)</label>
                        <input type="text" name="pillars[${index}][title_en]" value=""
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors placeholder-gray-600 mb-2">
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">Description (EN)</label>
                        <textarea name="pillars[${index}][description_en]" rows="3"
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors resize-y placeholder-gray-600"></textarea>
                    </div>
                    <div dir="rtl">
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">عنوان</label>
                        <input type="text" name="pillars[${index}][title_dari]" value=""
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors placeholder-gray-600 text-right mb-2">
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">توضیحات</label>
                        <textarea name="pillars[${index}][description_dari]" rows="3"
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-colors resize-y placeholder-gray-600 text-right"></textarea>
                    </div>
                    <div dir="rtl">
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">سرلیک</label>
                        <input type="text" name="pillars[${index}][title_pashto]" value=""
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors placeholder-gray-600 text-right mb-2">
                        <label class="block text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1.5">تشریح</label>
                        <textarea name="pillars[${index}][description_pashto]" rows="3"
                            class="w-full px-3 py-2.5 rounded-lg bg-gray-800 border border-gray-700 text-gray-200 text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors resize-y placeholder-gray-600 text-right"></textarea>
                    </div>
                </div>
            </div>
        `;
            container.insertAdjacentHTML('beforeend', html);
            renumberPillars();
        }

        function removePillar(btn) {
            const card = btn.closest('.pillar-card');
            const container = document.getElementById('pillarsContainer');
            if (container.querySelectorAll('.pillar-card').length <= 1) {
                alert('You must keep at least one vision pillar.');
                return;
            }
            card.remove();
            renumberPillars();
        }

        function renumberPillars() {
            const cards = document.querySelectorAll('.pillar-card');
            cards.forEach((card, i) => {
                const newIndex = i;
                card.dataset.index = newIndex;
                card.querySelector('.pillar-number').textContent = newIndex + 1;
                card.querySelector('.pillar-label').textContent = newIndex + 1;

                const inputs = card.querySelectorAll('input, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        const newName = name.replace(/pillars\\[\\d+\\]/, `pillars[${newIndex}]`);
                        input.setAttribute('name', newName);
                    }
                    const id = input.getAttribute('id');
                    if (id && id.startsWith('pillar_')) {
                        input.setAttribute('id', `pillar_${newIndex}_active`);
                    }
                });

                const label = card.querySelector('label[for^=\"pillar_\"]');
                if (label) {
                    label.setAttribute('for', `pillar_${newIndex}_active`);
                }
            });
        }

        function handleImagePreview(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `
                    <div class="relative rounded-xl overflow-hidden border border-gray-700 max-w-md">
                        <img src="${e.target.result}" class="w-full h-48 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-gray-900 to-transparent">
                            <p class="text-gray-300 text-sm font-medium">${input.files[0].name}</p>
                            <p class="text-gray-500 text-xs">${(input.files[0].size / 1024).toFixed(1)} KB</p>
                        </div>
                    </div>
                `;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
