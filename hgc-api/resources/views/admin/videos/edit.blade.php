@extends('admin.layouts.app')

@section('title', 'Edit Video')
@section('page-title', 'Edit Video')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="mb-4">
            <a href="{{ route('admin.videos.index') }}" class="inline-flex items-center gap-1 text-sm text-gray-400 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back
            </a>
        </div>

        <form action="{{ route('admin.videos.update', $video) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            @csrf
            @method('PUT')
            <div class="p-4 sm:p-6 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Upload Video File</label>
                    @if($video->video_file)
                        <p class="mb-2 text-xs text-gray-400">Current: {{ $video->video_file }}</p>
                    @endif
                    <input type="file" name="video_file" accept="video/mp4,video/webm,video/ogg"
                           class="block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-700 bg-gray-700 border border-gray-600 rounded-lg cursor-pointer">
                    <p class="mt-1 text-xs text-gray-500">Leave empty to keep current. mp4, webm, ogg. Max 50MB.</p>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-600"></div></div>
                    <div class="relative flex justify-center text-xs"><span class="px-2 bg-gray-800 text-gray-400">OR</span></div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">YouTube / Embed URL</label>
                    <input type="text" name="video_url" value="{{ old('video_url', $video->video_url) }}"
                           class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2.5 text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 outline-none transition-colors">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $video->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-primary-600 focus:ring-primary-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-300">Active</label>
                </div>
            </div>

            <div class="px-4 sm:px-6 py-4 bg-gray-800/50 border-t border-gray-700 flex items-center justify-end gap-3">
                <a href="{{ route('admin.videos.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-lg">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">Update</button>
            </div>
        </form>
    </div>
@endsection