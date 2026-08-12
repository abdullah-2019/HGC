@extends('admin.layouts.app')

@section('title', 'News')
@section('page-title', 'News Articles')

@section('content')
    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-xl font-semibold text-white">News Articles</h2>
        <a href="{{ route('admin.news.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Article
        </a>
    </div>

    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Image</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Category</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Published</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-700/30 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($article->cover_image_url)
                                    <img src="{{ asset('storage/' . $article->cover_image_url) }}" alt="" class="h-10 w-16 object-cover rounded border border-gray-600">
                                @else
                                    <div class="h-10 w-16 rounded border border-gray-600 bg-gray-700 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300 max-w-xs">
                                <div class="truncate font-medium">{{ $article->title_en }}</div>
                                @if($article->title_dari)
                                    <div class="truncate text-xs text-gray-500 mt-0.5" dir="rtl">{{ $article->title_dari }}</div>
                                @endif
                                @if($article->title_pashto)
                                    <div class="truncate text-xs text-gray-500 mt-0.5" dir="rtl">{{ $article->title_pashto }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-700 text-gray-300 border border-gray-600 capitalize">
                                    {{ str_replace('_', ' ', $article->category) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                                {{ $article->published_at ? $article->published_at->format('Y-m-d H:i') : '-' }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($article->is_published)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-900/50 text-green-400 border border-green-800">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-400 border border-gray-600">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.news.edit', $article) }}"
                                   class="text-primary-400 hover:text-primary-300 mr-3 transition-colors">Edit</a>
                                <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this article?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500 text-sm">
                                No articles found. <a href="{{ route('admin.news.create') }}" class="text-primary-400 hover:underline">Create one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection