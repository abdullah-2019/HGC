@extends('admin.layouts.app')

@section('title', 'Hero Slides')
@section('page-title', 'Hero Slides')

@section('content')
    <div class="mb-4 sm:mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h2 class="text-xl font-semibold text-white">Hero Slides</h2>
        <a href="{{ route('admin.hero-slides.create') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Slide
        </a>
    </div>

    <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Image</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Badge (EN)</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Ken Burns</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($slides as $slide)
                        <tr class="hover:bg-gray-700/30 transition-colors">
                            <td class="px-4 py-3 whitespace-nowrap">
                                <img src="{{ $slide->image }}" alt="" class="h-10 w-16 object-cover rounded border border-gray-600">
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300 max-w-xs truncate">
                                {{ $slide->badge_en }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-700 text-gray-300 border border-gray-600">
                                    {{ $slide->ken_burns }}
                                </span>
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                                {{ $slide->sort_order }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                @if($slide->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-900/50 text-green-400 border border-green-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-400 border border-gray-600">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.hero-slides.edit', $slide) }}"
                                   class="text-primary-400 hover:text-primary-300 mr-3 transition-colors">Edit</a>
                                <form action="{{ route('admin.hero-slides.destroy', $slide) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this slide?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-gray-500 text-sm">
                                No hero slides found. <a href="{{ route('admin.hero-slides.create') }}" class="text-primary-400 hover:underline">Create one</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection