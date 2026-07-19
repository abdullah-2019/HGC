@extends('admin.layouts.app')

@section('title', 'Core Values')
@section('page-title', 'Core Values')

@section('content')

    <div class="min-h-screen bg-gray-950 p-6">
        @if ($values->count() > 0)
            <div class="max-w-7xl mx-auto">
                {{-- HEADER --}}
                <div class="flex flex-row items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white">Core Values</h1>
                        <p class="text-gray-400 mt-2">Manage what drives HGC</p>
                    </div>
                    <a href="{{ route('admin.about.values.create') }}"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium whitespace-nowrap">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add Value
                    </a>
                </div>

                {{-- SECTION HEADER CARD (read-only) --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-6 sm:p-8 mb-6">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-1.5 h-6 bg-amber-500 rounded-full"></span>
                        <h2 class="text-lg font-semibold text-white">Section Header</h2>
                        <span class="text-gray-500 text-xs ml-2">(from first record)</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <p class="text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1">Label</p>
                            <p class="text-gray-200 text-sm">{{ $section->section_label_en }}</p>
                        </div>
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <p class="text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1">Title</p>
                            <p class="text-white font-semibold">{{ $section->section_title_en }}</p>
                        </div>
                        <div class="bg-gray-800/50 rounded-xl p-4">
                            <p class="text-gray-500 text-[10px] uppercase tracking-widest font-semibold mb-1">Description</p>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $section->section_description_en }}</p>
                        </div>
                    </div>
                </div>

                {{-- VALUES GRID --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($values as $index => $value)
                        <div class="group bg-gray-900 border border-gray-800 hover:border-gray-600 rounded-2xl p-6 transition-all hover:bg-gray-800/60">
                            <div class="flex justify-between items-start mb-5">
                                <div class="flex items-center gap-3">
                                    <span class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 text-white font-bold text-sm shadow-lg shadow-blue-900/20">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="text-gray-400 text-xs font-medium">{{ $value->icon_name }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    @if ($value->is_active)
                                        <span class="text-xs px-2 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 font-medium">Active</span>
                                    @else
                                        <span class="text-xs px-2 py-1 rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/20 font-medium">Inactive</span>
                                    @endif
                                    <a href="{{ route('admin.about.values.edit', $value) }}"
                                        class="p-2 rounded-lg text-gray-500 hover:text-blue-400 hover:bg-blue-900/20 transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.about.values.destroy', $value) }}" method="POST" class="inline" onsubmit="return confirm('Delete this value?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-lg text-gray-500 hover:text-red-400 hover:bg-red-900/20 transition-colors"
                                            title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <p class="text-white text-lg font-bold">{{ $value->title_en }}</p>
                                    <p class="text-gray-300 text-sm leading-relaxed mt-1">{{ $value->description_en }}</p>
                                </div>
                                <div class="border-t border-gray-700/50 pt-3" dir="rtl">
                                    <p class="text-white font-semibold">{{ $value->title_dari }}</p>
                                    <p class="text-gray-300 text-sm leading-relaxed mt-1">{{ $value->description_dari }}</p>
                                </div>
                                <div class="border-t border-gray-700/50 pt-3" dir="rtl">
                                    <p class="text-white font-semibold">{{ $value->title_pashto }}</p>
                                    <p class="text-gray-300 text-sm leading-relaxed mt-1">{{ $value->description_pashto }}</p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-700/50 flex items-center justify-between">
                                <span class="text-gray-500 text-xs">Sort: {{ $value->sort_order }}</span>
                                <a href="{{ route('admin.about.values.edit', $value) }}"
                                    class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">
                                    Edit value →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="max-w-xl mx-auto mt-20 bg-gray-900 border border-gray-800 rounded-2xl p-10 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-xl text-white font-semibold">No Core Values Found</h2>
                <p class="text-gray-400 mt-3 text-sm">Create your first core value to get started.</p>
                <a href="{{ route('admin.about.values.create') }}"
                    class="inline-flex items-center justify-center mt-6 px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-colors">
                    Create Value
                </a>
            </div>
        @endif
    </div>

@endsection