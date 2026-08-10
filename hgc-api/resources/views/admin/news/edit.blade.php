@extends('admin.layouts.app')

@section('title', 'Edit News Article')
@section('page-title', 'Edit News Article')

@section('content')
    <div class="max-w-5xl mx-auto">
        @include('admin.error-alert')

        <div class="mb-4">
            <a href="{{ route('admin.news.index') }}"
                class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to News
            </a>
        </div>

        <form action="{{ route('admin.news.update', $article) }}" method="POST" enctype="multipart/form-data"
            class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            @csrf
            @method('PUT')

            <div class="p-4 sm:p-6 space-y-6">
                <!-- Slug & Category -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        @error('slug')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <input name="category"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors" />
                    </div>
                </div>

                <!-- Titles -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (English) *</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $article->title_en) }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        @error('title_en')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (Dari)</label>
                        <input type="text" name="title_dari" value="{{ old('title_dari', $article->title_dari) }}"
                            dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title (Pashto)</label>
                        <input type="text" name="title_pashto" value="{{ old('title_pashto', $article->title_pashto) }}"
                            dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                    </div>
                </div>

                <!-- Excerpts -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Excerpt (English)</label>
                        <textarea name="excerpt_en" rows="3"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('excerpt_en', $article->excerpt_en) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Excerpt (Dari)</label>
                        <textarea name="excerpt_dari" rows="3" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('excerpt_dari', $article->excerpt_dari) }}</textarea>
                    </div>
                </div>

                <!-- Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Content (English)</label>
                        <textarea name="content_en" rows="6"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('content_en', $article->content_en) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Content (Dari)</label>
                        <textarea name="content_dari" rows="6" dir="rtl"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">{{ old('content_dari', $article->content_dari) }}</textarea>
                    </div>
                </div>

                <!-- Image & Published At -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Cover Image</label>

                        @if ($article->cover_image_url)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $article->cover_image_url) }}" alt="Current cover"
                                    class="h-24 w-auto rounded-lg border border-gray-600 object-cover">
                                <p class="mt-1 text-xs text-gray-500">Current: {{ $article->cover_image_url }}</p>
                            </div>
                        @endif

                        <input type="file" name="cover_image_file" accept="image/webp,image/jpeg,image/png"
                            class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-700 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        <p class="mt-1 text-xs text-gray-500">Leave empty to keep current. Accepted: webp, jpg, png. Max
                            2MB.</p>
                        @error('cover_image_file')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Published At *</label>
                        <input type="datetime-local" name="published_at"
                            value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                            class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                        @error('published_at')
                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Published checkbox -->
                <div class="flex items-center pt-2">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                    <label for="is_published" class="ml-2 text-sm text-gray-300">Published</label>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4 bg-gray-800/50 border-t border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.news.index') }}"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-lg transition-colors">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">Update
                    Article</button>
            </div>
        </form>
    </div>
@endsection
