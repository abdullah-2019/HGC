@extends('admin.layouts.app')

@section('title', 'Edit Hero Slide')
@section('page-title', 'Edit Hero Slide')

@section('content')

    <div class="max-w-5xl mx-auto">

        @include('admin.error-alert')

        <div class="mb-4">
            <a href="{{ route('admin.hero-slides.index') }}"
                class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Hero Slides
            </a>
        </div>

        {{-- enctype added for file upload --}}
        <form action="{{ route('admin.hero-slides.update', $heroSlide) }}" method="POST" enctype="multipart/form-data"
            class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            @csrf
            @method('PUT')

            <div class="p-4 sm:p-6 space-y-6">
                <!-- Image & Ken Burns -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Hero Image</label>

                        {{-- Current image preview --}}
                        @if ($heroSlide->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $heroSlide->image) }}" alt="Current hero image"
                                    class="h-24 w-auto rounded-lg border border-gray-600 object-cover">
                                <p class="mt-1 text-xs text-gray-500">Current: {{ $heroSlide->image }}</p>
                            </div>
                        @endif

                        <input type="file" name="image_file" accept="image/webp,image/jpeg,image/png"
                            class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-700 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            >
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep current image. Accepted: webp, jpg, png.
                            Max 2MB.</p>
                        @error('image_file')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Ken Burns Effect</label>
                        <select name="ken_burns"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                            <option value="zoom-in"
                                {{ old('ken_burns', $heroSlide->ken_burns) == 'zoom-in' ? 'selected' : '' }}>Zoom In
                            </option>
                            <option value="zoom-out"
                                {{ old('ken_burns', $heroSlide->ken_burns) == 'zoom-out' ? 'selected' : '' }}>Zoom Out
                            </option>
                            <option value="pan-right"
                                {{ old('ken_burns', $heroSlide->ken_burns) == 'pan-right' ? 'selected' : '' }}>Pan Right
                            </option>
                            <option value="pan-left"
                                {{ old('ken_burns', $heroSlide->ken_burns) == 'pan-left' ? 'selected' : '' }}>Pan Left
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Badges -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Badge (English)</label>
                        <input type="text" name="badge_en" value="{{ old('badge_en', $heroSlide->badge_en) }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        @error('badge_en')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Badge (Dari)</label>
                        <input type="text" name="badge_dari" value="{{ old('badge_dari', $heroSlide->badge_dari) }}"
                            dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Badge (Pashto)</label>
                        <input type="text" name="badge_pashto"
                            value="{{ old('badge_pashto', $heroSlide->badge_pashto) }}" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                </div>

                <!-- Titles -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (English)</label>
                        <textarea name="title_en" rows="3"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            required>{{ old('title_en', is_array($heroSlide->title_en) ? implode("\n", $heroSlide->title_en) : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">One line = one text part.</p>
                        @error('title_en')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (Dari)</label>
                        <textarea name="title_dari" rows="3" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            required>{{ old('title_dari', is_array($heroSlide->title_dari) ? implode("\n", $heroSlide->title_dari) : '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (Pashto)</label>
                        <textarea name="title_pashto" rows="3" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            required>{{ old('title_pashto', is_array($heroSlide->title_pashto) ? implode("\n", $heroSlide->title_pashto) : '') }}</textarea>
                    </div>
                </div>

                <!-- Highlights -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Highlights (English)</label>
                        <input type="text" name="highlights_en"
                            value="{{ old('highlights_en', is_array($heroSlide->highlights_en) ? implode(',', $heroSlide->highlights_en) : '') }}"
                            placeholder="e.g. 1"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        <p class="mt-1 text-xs text-gray-500">Comma-separated index numbers.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Highlights (Dari)</label>
                        <input type="text" name="highlights_dari"
                            value="{{ old('highlights_dari', is_array($heroSlide->highlights_dari) ? implode(',', $heroSlide->highlights_dari) : '') }}"
                            placeholder="e.g. 1" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Highlights (Pashto)</label>
                        <input type="text" name="highlights_pashto"
                            value="{{ old('highlights_pashto', is_array($heroSlide->highlights_pashto) ? implode(',', $heroSlide->highlights_pashto) : '') }}"
                            placeholder="e.g. 1" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                </div>

                <!-- Subtitles -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Subtitle (English)</label>
                        <textarea name="subtitle_en" rows="2"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            required>{{ old('subtitle_en', $heroSlide->subtitle_en) }}</textarea>
                        @error('subtitle_en')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Subtitle (Dari)</label>
                        <textarea name="subtitle_dari" rows="2" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            required>{{ old('subtitle_dari', $heroSlide->subtitle_dari) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Subtitle (Pashto)</label>
                        <textarea name="subtitle_pashto" rows="2" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors"
                            required>{{ old('subtitle_pashto', $heroSlide->subtitle_pashto) }}</textarea>
                    </div>
                </div>

                <!-- Sort Order & Active -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-700">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $heroSlide->sort_order) }}"
                            min="0"
                            class="w-full md:w-32 bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $heroSlide->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                        <label for="is_active" class="ml-2 text-sm text-gray-300">Active</label>
                    </div>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4 bg-gray-800/50 border-t border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.hero-slides.index') }}"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-lg transition-colors">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Update
                    Slide</button>
            </div>
        </form>
    </div>
@endsection
