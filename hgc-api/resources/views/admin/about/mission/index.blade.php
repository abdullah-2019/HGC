@extends('admin.layouts.app')

@section('title', 'Mission')
@section('page-title', 'Mission')

@section('content')

    <div class="min-h-screen bg-gray-950 p-6">
        @if ($mission)
            <div class="max-w-7xl mx-auto">
                {{-- HEADER --}}
                <!-- Swapped flex-col with flex-row and forced items-center -->
                <div class="flex flex-row items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-white">
                            About Mission
                        </h1>
                        <p class="text-gray-400 mt-2">
                            Complete mission content preview
                        </p>
                    </div>

                    <!-- Pinned button safely to the right side -->
                    <a href="{{ route('admin.about.mission.edit', $mission) }}"
                        class="inline-flex items-center justify-center px-5 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium whitespace-nowrap">
                        Edit Mission
                    </a>
                </div>


                {{-- MAIN CARD --}}
                <div class="bg-gray-900 border border-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                    {{-- HERO IMAGE --}}
                    @if ($mission->image_url)
                        <div class="relative">
                            <img src="{{ asset('storage/' . ltrim($mission->image_url)) }}"
                                class="w-full h-[320px] sm:h-[420px] object-cover" alt="Mission">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent">
                            </div>
                            <div class="absolute bottom-6 left-6 flex items-center gap-3">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold {{ $mission->is_active ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-red-500/20 text-red-400 border border-red-500/30' }} backdrop-blur-sm">
                                    {{ $mission->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-500/20 text-gray-300 border border-gray-500/30 backdrop-blur-sm">
                                    Public
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="p-6 sm:p-8">
                        {{-- META INFO GRID --}}
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-10">
                            <div
                                class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-5 hover:border-gray-600 transition-colors">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium">Section Label</p>
                                </div>
                                <p class="text-white font-semibold text-lg">{{ $mission->section_label_en }}</p>
                            </div>
                            <div
                                class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-5 hover:border-gray-600 transition-colors">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                    </svg>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium">Sort Order</p>
                                </div>
                                <p class="text-white font-semibold text-lg">{{ $mission->sort_order }}</p>
                            </div>
                            <div
                                class="bg-gray-800/60 border border-gray-700/50 rounded-xl p-5 hover:border-gray-600 transition-colors">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-gray-400 text-xs uppercase tracking-wider font-medium">Created At</p>
                                </div>
                                <p class="text-white font-semibold text-lg">{{ $mission->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        {{-- LANGUAGE TABS --}}
                        <div class="mb-8">
                            <div class="flex items-center gap-2 mb-5">
                                <span class="w-1.5 h-8 bg-gradient-to-b from-blue-500 to-blue-700 rounded-full"></span>
                                <h2 class="text-xl font-bold text-white">Content Preview</h2>
                            </div>

                            {{-- Tab Navigation --}}
                            <div class="flex gap-1 bg-gray-800/50 p-1 rounded-xl w-fit mb-6 border border-gray-700/50">
                                <button onclick="switchTab('en')" id="tab-en"
                                    class="px-5 py-2.5 rounded-lg text-sm font-medium transition-all bg-blue-600 text-white shadow-lg shadow-blue-900/30">English</button>
                                <button onclick="switchTab('dari')" id="tab-dari"
                                    class="px-5 py-2.5 rounded-lg text-sm font-medium transition-all text-gray-400 hover:text-white hover:bg-gray-700/50">دری</button>
                                <button onclick="switchTab('pashto')" id="tab-pashto"
                                    class="px-5 py-2.5 rounded-lg text-sm font-medium transition-all text-gray-400 hover:text-white hover:bg-gray-700/50">پښتو</button>
                            </div>

                            {{-- English Content --}}
                            <div id="content-en"
                                class="bg-gray-800/40 border border-gray-700/40 rounded-2xl p-6 sm:p-8 space-y-6">
                                <div>
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">Title</label>
                                    <p class="text-white text-2xl sm:text-3xl font-bold leading-tight">
                                        {{ $mission->title_en }}</p>
                                </div>
                                <div>
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">Description</label>
                                    <p class="text-gray-300 leading-relaxed text-base">{{ $mission->description_en }}</p>
                                </div>
                                <div class="bg-gray-900/60 border-l-4 border-blue-500 rounded-r-xl p-5">
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">Quote</label>
                                    <p class="italic text-gray-300 text-lg leading-relaxed">"{{ $mission->quote_text_en }}"
                                    </p>
                                </div>
                            </div>

                            {{-- Dari Content --}}
                            <div id="content-dari"
                                class="hidden bg-gray-800/40 border border-gray-700/40 rounded-2xl p-6 sm:p-8 space-y-6"
                                dir="rtl">
                                <div>
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">عنوان</label>
                                    <p class="text-white text-2xl sm:text-3xl font-bold leading-tight">
                                        {{ $mission->title_dari }}</p>
                                </div>
                                <div>
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">توضیحات</label>
                                    <p class="text-gray-300 leading-relaxed text-base">{{ $mission->description_dari }}</p>
                                </div>
                                <div class="bg-gray-900/60 border-r-4 border-blue-500 rounded-l-xl p-5">
                                    <label class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">نقل
                                        قول</label>
                                    <p class="italic text-gray-300 text-lg leading-relaxed">
                                        "{{ $mission->quote_text_dari }}"</p>
                                </div>
                            </div>

                            {{-- Pashto Content --}}
                            <div id="content-pashto"
                                class="hidden bg-gray-800/40 border border-gray-700/40 rounded-2xl p-6 sm:p-8 space-y-6"
                                dir="rtl">
                                <div>
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">سرلیک</label>
                                    <p class="text-white text-2xl sm:text-3xl font-bold leading-tight">
                                        {{ $mission->title_pashto }}</p>
                                </div>
                                <div>
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">تشریح</label>
                                    <p class="text-gray-300 leading-relaxed text-base">{{ $mission->description_pashto }}
                                    </p>
                                </div>
                                <div class="bg-gray-900/60 border-r-4 border-blue-500 rounded-l-xl p-5">
                                    <label
                                        class="text-gray-400 text-xs uppercase tracking-wider font-medium mb-2 block">اقتباس</label>
                                    <p class="italic text-gray-300 text-lg leading-relaxed">
                                        "{{ $mission->quote_text_pashto }}"</p>
                                </div>
                            </div>
                        </div>

                        {{-- MISSION POINTS --}}
                        @if ($mission->points && $mission->points->count() > 0)
                            <div class="mt-12">
                                <div class="flex items-center gap-3 mb-6">
                                    <span
                                        class="w-1.5 h-8 bg-gradient-to-b from-green-500 to-green-700 rounded-full"></span>
                                    <h2 class="text-2xl font-bold text-white">Mission Points</h2>
                                    <span
                                        class="ml-auto px-3 py-1 rounded-full text-xs font-medium bg-gray-800 text-gray-400 border border-gray-700">{{ $mission->points->count() }}
                                        items</span>
                                </div>

                                <div class="grid md:grid-cols-2 gap-5">
                                    @foreach ($mission->points as $index => $point)
                                        <div
                                            class="group bg-gray-800/40 border border-gray-700/40 hover:border-gray-600 rounded-2xl p-6 transition-all hover:bg-gray-800/60">
                                            <div class="flex justify-between items-start mb-5">
                                                <span
                                                    class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 text-white font-bold text-sm shadow-lg shadow-blue-900/20">
                                                    {{ $index + 1 }}
                                                </span>
                                                @if ($point->is_active)
                                                    <span
                                                        class="text-xs px-3 py-1 rounded-full bg-green-500/10 text-green-400 border border-green-500/20 font-medium">Active</span>
                                                @else
                                                    <span
                                                        class="text-xs px-3 py-1 rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/20 font-medium">Inactive</span>
                                                @endif
                                            </div>
                                            <div class="space-y-4">
                                                <div>
                                                    <p
                                                        class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1">
                                                        English</p>
                                                    <p class="text-gray-200 text-sm leading-relaxed">{{ $point->text_en }}
                                                    </p>
                                                </div>
                                                <div class="border-t border-gray-700/50 pt-4" dir="rtl">
                                                    <p
                                                        class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1">
                                                        دری</p>
                                                    <p class="text-gray-200 text-sm leading-relaxed">
                                                        {{ $point->text_dari }}</p>
                                                </div>
                                                <div class="border-t border-gray-700/50 pt-4" dir="rtl">
                                                    <p
                                                        class="text-[10px] text-gray-500 uppercase tracking-widest font-semibold mb-1">
                                                        پښتو</p>
                                                    <p class="text-gray-200 text-sm leading-relaxed">
                                                        {{ $point->text_pashto }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            {{-- EMPTY STATE --}}
            <div class="max-w-xl mx-auto mt-20 bg-gray-900 border border-gray-800 rounded-2xl p-10 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-800 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-xl text-white font-semibold">No Mission Found</h2>
                <p class="text-gray-400 mt-3 text-sm">Create your mission content first to see it here.</p>
                <a href="{{ route('admin.about.mission.create') }}"
                    class="inline-flex items-center justify-center mt-6 px-5 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium transition-colors">
                    Create Mission
                </a>
            </div>
        @endif
    </div>

    <script>
        function switchTab(lang) {
            // Hide all content
            document.getElementById('content-en').classList.add('hidden');
            document.getElementById('content-dari').classList.add('hidden');
            document.getElementById('content-pashto').classList.add('hidden');

            // Reset all tabs
            const tabs = ['en', 'dari', 'pashto'];
            tabs.forEach(t => {
                const btn = document.getElementById('tab-' + t);
                btn.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-900/30');
                btn.classList.add('text-gray-400');
            });

            // Show selected content
            document.getElementById('content-' + lang).classList.remove('hidden');

            // Highlight selected tab
            const activeBtn = document.getElementById('tab-' + lang);
            activeBtn.classList.remove('text-gray-400');
            activeBtn.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-900/30');
        }
    </script>

@endsection
