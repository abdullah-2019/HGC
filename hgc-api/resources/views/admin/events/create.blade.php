@extends('admin.layouts.app')

@section('title', 'Add Event')
@section('page-title', 'Add Event')

@section('content')
    <div class="max-w-5xl mx-auto">

        @include('admin.error-alert')


        <div class="mb-4">
            <a href="{{ route('admin.events.index') }}"
                class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Events
            </a>
        </div>

        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            @csrf

            <div class="p-4 sm:p-6 space-y-6">
                <!-- Titles -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (English) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        @error('title_en')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (Dari)</label>
                        <input type="text" name="title_dari" value="{{ old('title_dari') }}" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (Pashto)</label>
                        <input type="text" name="title_pashto" value="{{ old('title_pashto') }}" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Description (English)</label>
                        <textarea name="description_en" rows="3"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('description_en') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Description (Dari)</label>
                        <textarea name="description_dari" rows="3" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('description_dari') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Description (Pashto)</label>
                        <textarea name="description_pashto" rows="3" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('description_pashto') }}</textarea>
                    </div>
                </div>

                <!-- Locations -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Location (English)</label>
                        <input type="text" name="location_en" value="{{ old('location_en') }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Location (Dari)</label>
                        <input type="text" name="location_dari" value="{{ old('location_dari') }}" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Location (Pashto)</label>
                        <input type="text" name="location_pashto" value="{{ old('location_pashto') }}" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                </div>

                <!-- Date, Time, Image -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Event Date *</label>
                        <input type="date" name="event_date" value="{{ old('event_date') }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        @error('event_date')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Event Time</label>
                        <input type="text" name="event_time" value="{{ old('event_time') }}"
                            placeholder="09:00 AM - 05:00 PM"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Cover Image</label>
                        <input type="file" name="cover_image_file" accept="image/webp,image/jpeg,image/png"
                            class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-700 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        <p class="mt-1 text-xs text-gray-500">Accepted: webp, jpg, png. Max 2MB.</p>
                        @error('cover_image_file')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Published checkbox -->
                <div class="flex items-center pt-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1" checked
                        class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                    <label for="is_published" class="ml-2 text-sm text-gray-300">Published</label>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4 bg-gray-800/50 border-t border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.events.index') }}"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-lg transition-colors">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Create
                    Event</button>
            </div>
        </form>
    </div>
@endsection
