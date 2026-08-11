@extends('admin.layouts.app')

@section('title', 'Videos')
@section('page-title', 'Site Video')

@section('content')
    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-xl font-semibold text-white">Site Videos</h2>
        <a href="{{ route('admin.videos.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Video
        </a>
    </div>

    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Source</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($videos as $video)
                        <tr class="hover:bg-gray-700/30 transition-colors">
                            <td class="px-4 py-3 text-sm text-gray-300">{{ $video->id }}</td>
                            <td class="px-4 py-3 text-sm text-gray-300">
                                @if($video->video_file)
                                    <span class="text-primary-400">Local: {{ $video->video_file }}</span>
                                @elseif($video->video_url)
                                    <span class="text-blue-400 truncate max-w-xs inline-block">{{ $video->video_url }}</span>
                                @else
                                    <span class="text-gray-500">No source</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($video->is_active)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-900/50 text-green-400 border border-green-800">Active</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-400 border border-gray-600">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right text-sm">
                                <a href="{{ route('admin.videos.edit', $video) }}" class="text-primary-400 hover:text-primary-300 mr-3">Edit</a>
                                <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline" onsubmit="return confirm('Delete?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-gray-500 text-sm">
                                No videos. <a href="{{ route('admin.videos.create') }}" class="text-primary-400 hover:underline">Add one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection