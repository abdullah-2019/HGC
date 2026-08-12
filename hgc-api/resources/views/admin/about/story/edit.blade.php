{{-- resources/views/admin/about/story/edit.blade.php --}}

@extends('admin.layouts.app')

@section('title', 'Edit Our Story')
@section('page-title', 'Edit Our Story')

@section('content')
    {{-- Force dark background wrapper to match admin panel --}}
    <div class="bg-gray-900 min-h-screen -m-4 p-4">
        {{-- Page Header --}}
        <div class="mb-4 border-b border-gray-700">
            <div class="sm:flex sm:items-center sm:justify-between mb-4">
                <div>
                    <h1 class="text-xl font-semibold text-white sm:text-2xl flex items-center gap-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Our Story
                    </h1>
                    <p class="mt-1 text-sm text-gray-400">
                        Manage your company story content, translations, and highlights.
                    </p>
                </div>
                <a href="{{ route('admin.about.story.index') }}"
                    class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-300 bg-gray-800 border border-gray-600 rounded-lg hover:bg-gray-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-white">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Story
                </a>
            </div>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="flex p-4 mb-4 text-sm text-red-400 rounded-lg bg-gray-800" role="alert">
                <svg class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd" />
                </svg>
                <div>
                    <span class="font-medium">Please fix the following errors:</span>
                    <ul class="mt-1.5 ml-4 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.about.story.update') }}" method="POST" enctype="multipart/form-data" id="storyForm">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

                {{-- LEFT COLUMN: Main Content --}}
                <div class="xl:col-span-2 space-y-4">

                    {{-- English Content Card --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-700">
                            <span
                                class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-blue-600 rounded-full">EN</span>
                            <h3 class="text-base font-semibold text-white">English Content</h3>
                        </div>

                        <div class="space-y-4">
                            {{-- Section Label --}}
                            <div>
                                <label for="section_label_en" class="block mb-2 text-sm font-medium text-white">
                                    Section Label <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="section_label_en" id="section_label_en"
                                    value="{{ old('section_label_en', $story->section_label_en) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="e.g. Our Story" required>
                            </div>

                            {{-- Title --}}
                            <div>
                                <label for="title_en" class="block mb-2 text-sm font-medium text-white">
                                    Title <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="title_en" id="title_en"
                                    value="{{ old('title_en', $story->title_en) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="e.g. Leading Afghan Conglomerate Since 2001" required>
                            </div>

                            {{-- Paragraph (WYSIWYG) --}}
                            <div>
                                <label class="block mb-2 text-sm font-medium text-white">
                                    Story Content <span class="text-red-400">*</span>
                                    <span class="ml-2 text-xs font-normal text-gray-400">(Supports formatting, lists,
                                        links)</span>
                                </label>

                                {{-- TipTap WYSIWYG Editor Container --}}
                                <div class="border border-gray-600 rounded-lg overflow-hidden">
                                    {{-- Toolbar --}}
                                    <div class="flex flex-wrap items-center gap-1 px-3 py-2 bg-gray-700 border-b border-gray-600"
                                        id="toolbar-en">
                                        {{-- Text Style --}}
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="bold" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Bold">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 12h8a4 4 0 100-8H6v8zm0 0v8m0-8h8a4 4 0 110 8H6v-8z" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="italic" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Italic">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="underline" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Underline">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16m-7 6h7" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="strike" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"
                                                title="Strikethrough">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Headings --}}
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="h2" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Heading 2">
                                                <span class="text-xs font-bold">H2</span>
                                            </button>
                                            <button type="button" data-action="h3" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Heading 3">
                                                <span class="text-xs font-bold">H3</span>
                                            </button>
                                        </div>

                                        {{-- Lists --}}
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="bulletList" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Bullet List">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="orderedList" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"
                                                title="Numbered List">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 7h12M7 12h12M7 17h12M3 7h.01M3 12h.01M3 17h.01" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Alignment --}}
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="alignLeft" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Align Left">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h10M4 18h16" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="alignCenter" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"
                                                title="Align Center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M7 12h10M4 18h16" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="alignRight" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Align Right">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M10 12h10M4 18h16" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Insert --}}
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="link" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Add Link">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="blockquote" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Quote">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="horizontalRule" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Divider">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M20 12H4" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Undo/Redo --}}
                                        <div class="flex items-center gap-1">
                                            <button type="button" data-action="undo" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Undo">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg>
                                            </button>
                                            <button type="button" data-action="redo" data-editor="en"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600" title="Redo">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Editor Area --}}
                                    <div id="editor-en" class="min-h-[200px] p-4 bg-gray-800 focus:outline-none"></div>
                                </div>

                                <input type="hidden" name="paragraph_1_en" id="paragraph_1_en"
                                    value="{{ old('paragraph_1_en', $story->paragraph_1_en) }}">
                                <p class="mt-1 text-xs text-gray-400">All story paragraphs go here. Use the toolbar to
                                    format your text.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Dari Content Card --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-700">
                            <span
                                class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-emerald-600 rounded-full">DR</span>
                            <h3 class="text-base font-semibold text-white">Dari Content</h3>
                            <span class="ml-auto text-xs text-gray-400">RTL Language</span>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="section_label_dari" class="block mb-2 text-sm font-medium text-white">Section
                                    Label</label>
                                <input type="text" name="section_label_dari" id="section_label_dari" dir="rtl"
                                    value="{{ old('section_label_dari', $story->section_label_dari) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="مثال: داستان ما">
                            </div>

                            <div>
                                <label for="title_dari" class="block mb-2 text-sm font-medium text-white">Title</label>
                                <input type="text" name="title_dari" id="title_dari" dir="rtl"
                                    value="{{ old('title_dari', $story->title_dari) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="عنوان به دری">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-white">Story Content</label>
                                <div class="border border-gray-600 rounded-lg overflow-hidden">
                                    <div class="flex flex-wrap items-center gap-1 px-3 py-2 bg-gray-700 border-b border-gray-600"
                                        id="toolbar-dari">
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="bold" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 12h8a4 4 0 100-8H6v8zm0 0v8m0-8h8a4 4 0 110 8H6v-8z" />
                                                </svg></button>
                                            <button type="button" data-action="italic" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                </svg></button>
                                        </div>
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="h2" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><span
                                                    class="text-xs font-bold">H2</span></button>
                                            <button type="button" data-action="h3" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><span
                                                    class="text-xs font-bold">H3</span></button>
                                        </div>
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="bulletList" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16M4 18h16" />
                                                </svg></button>
                                            <button type="button" data-action="orderedList" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 7h12M7 12h12M7 17h12M3 7h.01M3 12h.01M3 17h.01" />
                                                </svg></button>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <button type="button" data-action="undo" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg></button>
                                            <button type="button" data-action="redo" data-editor="dari"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6" />
                                                </svg></button>
                                        </div>
                                    </div>
                                    <div id="editor-dari" class="min-h-[160px] p-4 bg-gray-800 focus:outline-none"
                                        dir="rtl"></div>
                                </div>
                                <input type="hidden" name="paragraph_1_dari" id="paragraph_1_dari"
                                    value="{{ old('paragraph_1_dari', $story->paragraph_1_dari) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Pashto Content Card --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-gray-700">
                            <span
                                class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-amber-600 rounded-full">PS</span>
                            <h3 class="text-base font-semibold text-white">Pashto Content</h3>
                            <span class="ml-auto text-xs text-gray-400">RTL Language</span>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label for="section_label_pashto"
                                    class="block mb-2 text-sm font-medium text-white">Section Label</label>
                                <input type="text" name="section_label_pashto" id="section_label_pashto"
                                    dir="rtl" value="{{ old('section_label_pashto', $story->section_label_pashto) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="مثال: زموږ کیسه">
                            </div>

                            <div>
                                <label for="title_pashto" class="block mb-2 text-sm font-medium text-white">Title</label>
                                <input type="text" name="title_pashto" id="title_pashto" dir="rtl"
                                    value="{{ old('title_pashto', $story->title_pashto) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="عنوان په پښتو">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-white">Story Content</label>
                                <div class="border border-gray-600 rounded-lg overflow-hidden">
                                    <div class="flex flex-wrap items-center gap-1 px-3 py-2 bg-gray-700 border-b border-gray-600"
                                        id="toolbar-pashto">
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="bold" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 12h8a4 4 0 100-8H6v8zm0 0v8m0-8h8a4 4 0 110 8H6v-8z" />
                                                </svg></button>
                                            <button type="button" data-action="italic" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                </svg></button>
                                        </div>
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="h2" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><span
                                                    class="text-xs font-bold">H2</span></button>
                                            <button type="button" data-action="h3" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><span
                                                    class="text-xs font-bold">H3</span></button>
                                        </div>
                                        <div class="flex items-center gap-1 mr-2 pr-2 border-r border-gray-600">
                                            <button type="button" data-action="bulletList" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 6h16M4 12h16M4 18h16" />
                                                </svg></button>
                                            <button type="button" data-action="orderedList" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 7h12M7 12h12M7 17h12M3 7h.01M3 12h.01M3 17h.01" />
                                                </svg></button>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <button type="button" data-action="undo" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                                                </svg></button>
                                            <button type="button" data-action="redo" data-editor="pashto"
                                                class="p-1.5 text-gray-300 rounded hover:bg-gray-600"><svg class="w-4 h-4"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 10h-10a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6" />
                                                </svg></button>
                                        </div>
                                    </div>
                                    <div id="editor-pashto" class="min-h-[160px] p-4 bg-gray-800 focus:outline-none"
                                        dir="rtl"></div>
                                </div>
                                <input type="hidden" name="paragraph_1_pashto" id="paragraph_1_pashto"
                                    value="{{ old('paragraph_1_pashto', $story->paragraph_1_pashto) }}">
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Story Highlights Card --}}
                <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                    <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-700">
                        <div class="flex items-center gap-2">
                            <span
                                class="flex items-center justify-center w-7 h-7 text-xs font-bold text-white bg-yellow-500 rounded-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </span>
                            <h3 class="text-base font-semibold text-white">Story Highlights</h3>
                        </div>
                    </div>

                    <div id="highlights-container" class="space-y-3">
                        @php
                            $highlights = old('highlights', $story->highlights->toArray());
                            if (empty($highlights)) {
                                $highlights = [[]]; // at least one empty row
                            }
                        @endphp

                        @foreach ($highlights as $index => $highlight)
                            <div class="highlight-row p-4 bg-gray-700 rounded-lg border border-gray-600"
                                data-index="{{ $index }}">
                                <input type="hidden" name="highlights[{{ $index }}][id]"
                                    value="{{ $highlight['id'] ?? '' }}">

                                <div class="grid grid-cols-1 gap-3">
                                    {{-- Icon --}}
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Icon</label>
                                        <select name="highlights[{{ $index }}][icon_name]"
                                            class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                                            <option value="Building2"
                                                {{ ($highlight['icon_name'] ?? '') == 'Building2' ? 'selected' : '' }}>
                                                Building</option>
                                            <option value="Globe"
                                                {{ ($highlight['icon_name'] ?? '') == 'Globe' ? 'selected' : '' }}>Globe
                                            </option>
                                            <option value="TrendingUp"
                                                {{ ($highlight['icon_name'] ?? '') == 'TrendingUp' ? 'selected' : '' }}>
                                                Trending Up</option>
                                            <option value="Users"
                                                {{ ($highlight['icon_name'] ?? '') == 'Users' ? 'selected' : '' }}>Users
                                            </option>
                                            <option value="Award"
                                                {{ ($highlight['icon_name'] ?? '') == 'Award' ? 'selected' : '' }}>Award
                                            </option>
                                            <option value="Star"
                                                {{ ($highlight['icon_name'] ?? '') == 'Star' ? 'selected' : '' }}>Star
                                            </option>
                                            <option value="Heart"
                                                {{ ($highlight['icon_name'] ?? '') == 'Heart' ? 'selected' : '' }}>Heart
                                            </option>
                                            <option value="Zap"
                                                {{ ($highlight['icon_name'] ?? '') == 'Zap' ? 'selected' : '' }}>Zap
                                            </option>
                                        </select>
                                    </div>

                                    {{-- Value Text --}}
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Value</label>
                                        <input type="text" name="highlights[{{ $index }}][value_text]"
                                            value="{{ $highlight['value_text'] ?? '' }}"
                                            class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 placeholder-gray-500"
                                            placeholder="e.g. 60">
                                    </div>

                                    {{-- Label EN --}}
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Label (EN)</label>
                                        <input type="text" name="highlights[{{ $index }}][label_en]"
                                            value="{{ $highlight['label_en'] ?? '' }}"
                                            class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 placeholder-gray-500"
                                            placeholder="e.g. 6 Companies">
                                    </div>

                                    {{-- Label Dari --}}
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Label (Dari)</label>
                                        <input type="text" name="highlights[{{ $index }}][label_dari]"
                                            dir="rtl" value="{{ $highlight['label_dari'] ?? '' }}"
                                            class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 placeholder-gray-500"
                                            placeholder="به دری">
                                    </div>

                                    {{-- Label Pashto --}}
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Label (Pashto)</label>
                                        <input type="text" name="highlights[{{ $index }}][label_pashto]"
                                            dir="rtl" value="{{ $highlight['label_pashto'] ?? '' }}"
                                            class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 placeholder-gray-500"
                                            placeholder="په پښتو">
                                    </div>

                                    {{-- Sort + Active + Delete --}}
                                    <div class="flex items-end gap-3 pt-1">
                                        <div class="flex-1">
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Sort Order</label>
                                            <input type="number" name="highlights[{{ $index }}][sort_order]"
                                                value="{{ $highlight['sort_order'] ?? $index }}"
                                                class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                                        </div>

                                        <div class="flex flex-col items-center gap-1">
                                            <label class="block text-xs font-medium text-gray-400">Active</label>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="hidden" name="highlights[{{ $index }}][is_active]"
                                                    value="0">
                                                <input type="checkbox" name="highlights[{{ $index }}][is_active]"
                                                    value="1" {{ $highlight['is_active'] ?? true ? 'checked' : '' }}
                                                    class="sr-only peer">
                                                <div
                                                    class="w-9 h-5 bg-gray-600 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-600 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-yellow-500 relative">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Empty state (hidden when rows exist) --}}
                    <div id="highlights-empty" class="hidden text-center py-8">
                        <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                        <p class="text-gray-400 text-sm mb-3">No highlights yet.</p>
                        <button type="button" onclick="addHighlightRow()"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-800">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Add First Highlight
                        </button>
                    </div>
                </div>

                {{-- RIGHT COLUMN: Settings & Meta --}}
                <div class="space-y-4">

                    {{-- Publish Settings Card --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <h3 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </h3>

                        <div class="space-y-4">
                            {{-- Status Toggle --}}
                            <div class="flex items-center justify-between p-3 bg-gray-700 rounded-lg">
                                <div>
                                    <label class="text-sm font-medium text-white">Active Status</label>
                                    <p class="text-xs text-gray-400">Show this story on the website</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                        {{ old('is_active', $story->is_active) ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-600 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>

                            {{-- Founded Year --}}
                            <div>
                                <label for="founded_year" class="block mb-2 text-sm font-medium text-white">
                                    Founded Year <span class="text-red-400">*</span>
                                </label>
                                <input type="number" name="founded_year" id="founded_year"
                                    value="{{ old('founded_year', $story->founded_year) }}" min="1900"
                                    max="{{ date('Y') }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                                    required>
                            </div>

                            {{-- Sort Order --}}
                            <div>
                                <label for="sort_order" class="block mb-2 text-sm font-medium text-white">Sort
                                    Order</label>
                                <input type="number" name="sort_order" id="sort_order"
                                    value="{{ old('sort_order', $story->sort_order) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                            </div>
                        </div>
                    </div>

                    {{-- Floating Card Card --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <h3 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Floating Card
                        </h3>

                        <div class="space-y-4">
                            <div>
                                <label for="floating_card_value" class="block mb-2 text-sm font-medium text-white">
                                    Value <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="floating_card_value" id="floating_card_value"
                                    value="{{ old('floating_card_value', $story->floating_card_value) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="e.g. 24+" required>
                            </div>

                            <div>
                                <label for="floating_card_label_en" class="block mb-2 text-sm font-medium text-white">
                                    Label (EN) <span class="text-red-400">*</span>
                                </label>
                                <input type="text" name="floating_card_label_en" id="floating_card_label_en"
                                    value="{{ old('floating_card_label_en', $story->floating_card_label_en) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="e.g. Years of Excellence" required>
                            </div>

                            <div>
                                <label for="floating_card_label_dari"
                                    class="block mb-2 text-sm font-medium text-white">Label (Dari)</label>
                                <input type="text" name="floating_card_label_dari" id="floating_card_label_dari"
                                    dir="rtl"
                                    value="{{ old('floating_card_label_dari', $story->floating_card_label_dari) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="برچسب به دری">
                            </div>

                            <div>
                                <label for="floating_card_label_pashto"
                                    class="block mb-2 text-sm font-medium text-white">Label (Pashto)</label>
                                <input type="text" name="floating_card_label_pashto" id="floating_card_label_pashto"
                                    dir="rtl"
                                    value="{{ old('floating_card_label_pashto', $story->floating_card_label_pashto) }}"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 placeholder-gray-400"
                                    placeholder="لیبل په پښتو">
                            </div>
                        </div>
                    </div>

                    {{-- Main Image Card --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <h3 class="text-base font-semibold text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Main Image
                        </h3>

                        <div class="space-y-4">
                            {{-- Current Image Preview --}}
                            @if ($story->main_image)
                                <div class="relative group">
                                    <img src="{{ asset('storage/' . $story->main_image) }}" alt="Current story image"
                                        class="w-full h-40 object-cover rounded-lg border border-gray-600">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all rounded-lg flex items-center justify-center">
                                        <span
                                            class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity">Current
                                            Image</span>
                                    </div>
                                </div>
                            @else
                                <div
                                    class="w-full h-28 bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 flex items-center justify-center">
                                    <span class="text-gray-500 text-sm">No image uploaded</span>
                                </div>
                            @endif

                            {{-- File Upload --}}
                            <div>
                                <label class="block mb-2 text-sm font-medium text-white" for="main_image">
                                    {{ $story->main_image ? 'Replace Image' : 'Upload Image' }}
                                </label>
                                <input type="file" name="main_image" id="main_image" accept="image/*"
                                    class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none"
                                    onchange="previewImage(this)">
                                <p class="mt-1 text-xs text-gray-400">JPEG, PNG, JPG, WEBP (max 2MB)</p>

                                {{-- New Image Preview --}}
                                <div id="imagePreview" class="hidden mt-3">
                                    <p class="text-xs text-gray-400 mb-1">New image preview:</p>
                                    <img id="previewImg" src="" alt="Preview"
                                        class="w-full h-28 object-cover rounded-lg border border-gray-600">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Save Button --}}
                    <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <div class="flex flex-col gap-3">
                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Save Changes
                            </button>
                            <a href="{{ route('admin.about.story.index') }}"
                                class="w-full text-white bg-gray-700 border border-gray-600 focus:outline-none hover:bg-gray-600 focus:ring-4 focus:ring-gray-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Cancel
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('styles')
    <style>
        /* TipTap Editor Content Styles - Dark Mode Only */
        .ProseMirror {
            min-height: 160px;
            outline: none;
            color: #e5e7eb;
        }

        .ProseMirror p {
            margin-bottom: 0.75em;
            line-height: 1.6;
            color: #e5e7eb;
        }

        .ProseMirror p:last-child {
            margin-bottom: 0;
        }

        .ProseMirror h2 {
            font-size: 1.5em;
            font-weight: 700;
            margin-bottom: 0.5em;
            margin-top: 0.5em;
            color: #f3f4f6;
        }

        .ProseMirror h3 {
            font-size: 1.25em;
            font-weight: 600;
            margin-bottom: 0.5em;
            margin-top: 0.5em;
            color: #f3f4f6;
        }

        .ProseMirror ul {
            list-style-type: disc;
            padding-left: 1.5em;
            margin-bottom: 0.75em;
            color: #e5e7eb;
        }

        .ProseMirror ol {
            list-style-type: decimal;
            padding-left: 1.5em;
            margin-bottom: 0.75em;
            color: #e5e7eb;
        }

        .ProseMirror blockquote {
            border-left: 4px solid #4b5563;
            padding-left: 1em;
            font-style: italic;
            color: #9ca3af;
        }

        .ProseMirror a {
            color: #60a5fa;
            text-decoration: underline;
        }

        .ProseMirror hr {
            border: none;
            border-top: 2px solid #4b5563;
            margin: 1em 0;
        }

        .ProseMirror img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }

        /* RTL support */
        [dir="rtl"] .ProseMirror ul,
        [dir="rtl"] .ProseMirror ol {
            padding-left: 0;
            padding-right: 1.5em;
        }

        [dir="rtl"] .ProseMirror blockquote {
            border-left: none;
            border-right: 4px solid #4b5563;
            padding-left: 0;
            padding-right: 1em;
        }

        /* Toolbar active state - Dark Mode */
        .toolbar-btn-active {
            background-color: #1e3a5f !important;
            color: #60a5fa !important;
        }
    </style>
@endpush

@push('scripts')
    {{-- TipTap via CDN --}}
    <script type="module">
        import {
            Editor
        } from 'https://esm.sh/@tiptap/core@2.6.6';
        import StarterKit from 'https://esm.sh/@tiptap/starter-kit@2.6.6';
        import Underline from 'https://esm.sh/@tiptap/extension-underline@2.6.6';
        import Link from 'https://esm.sh/@tiptap/extension-link@2.6.6';
        import TextAlign from 'https://esm.sh/@tiptap/extension-text-align@2.6.6';

        const editors = {};

        function createEditor(elementId, content, lang) {
            const editor = new Editor({
                element: document.querySelector(`#editor-${lang}`),
                extensions: [
                    StarterKit,
                    Underline,
                    Link.configure({
                        openOnClick: false,
                        autolink: true,
                        defaultProtocol: 'https',
                    }),
                    TextAlign.configure({
                        types: ['heading', 'paragraph'],
                    }),
                ],
                content: content || '<p></p>',
                editorProps: {
                    attributes: {
                        class: 'ProseMirror focus:outline-none',
                    },
                },
                onUpdate: ({
                    editor
                }) => {
                    const html = editor.getHTML();
                    document.querySelector(`#paragraph_1_${lang}`).value = html;
                },
            });

            editors[lang] = editor;
            return editor;
        }

        // Initialize editors
        const enContent = document.querySelector('#paragraph_1_en').value;
        const dariContent = document.querySelector('#paragraph_1_dari').value;
        const pashtoContent = document.querySelector('#paragraph_1_pashto').value;

        createEditor('editor-en', enContent, 'en');
        createEditor('editor-dari', dariContent, 'dari');
        createEditor('editor-pashto', pashtoContent, 'pashto');

        // Toolbar button handlers
        document.querySelectorAll('[data-action]').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const action = btn.dataset.action;
                const lang = btn.dataset.editor;
                const editor = editors[lang];

                if (!editor) return;

                const chain = editor.chain().focus();

                switch (action) {
                    case 'bold':
                        chain.toggleBold().run();
                        break;
                    case 'italic':
                        chain.toggleItalic().run();
                        break;
                    case 'underline':
                        chain.toggleUnderline().run();
                        break;
                    case 'strike':
                        chain.toggleStrike().run();
                        break;
                    case 'h2':
                        chain.toggleHeading({
                            level: 2
                        }).run();
                        break;
                    case 'h3':
                        chain.toggleHeading({
                            level: 3
                        }).run();
                        break;
                    case 'bulletList':
                        chain.toggleBulletList().run();
                        break;
                    case 'orderedList':
                        chain.toggleOrderedList().run();
                        break;
                    case 'alignLeft':
                        chain.setTextAlign('left').run();
                        break;
                    case 'alignCenter':
                        chain.setTextAlign('center').run();
                        break;
                    case 'alignRight':
                        chain.setTextAlign('right').run();
                        break;
                    case 'alignJustify':
                        chain.setTextAlign('justify').run();
                        break;
                    case 'link':
                        const url = prompt('Enter URL:');
                        if (url) chain.setLink({
                            href: url
                        }).run();
                        break;
                    case 'blockquote':
                        chain.toggleBlockquote().run();
                        break;
                    case 'horizontalRule':
                        chain.setHorizontalRule().run();
                        break;
                    case 'undo':
                        chain.undo().run();
                        break;
                    case 'redo':
                        chain.redo().run();
                        break;
                }

                updateToolbarState(lang);
            });
        });

        function updateToolbarState(lang) {
            const editor = editors[lang];
            if (!editor) return;

            document.querySelectorAll(`[data-editor="${lang}"]`).forEach(btn => {
                const action = btn.dataset.action;
                let isActive = false;

                switch (action) {
                    case 'bold':
                        isActive = editor.isActive('bold');
                        break;
                    case 'italic':
                        isActive = editor.isActive('italic');
                        break;
                    case 'underline':
                        isActive = editor.isActive('underline');
                        break;
                    case 'strike':
                        isActive = editor.isActive('strike');
                        break;
                    case 'h2':
                        isActive = editor.isActive('heading', {
                            level: 2
                        });
                        break;
                    case 'h3':
                        isActive = editor.isActive('heading', {
                            level: 3
                        });
                        break;
                    case 'bulletList':
                        isActive = editor.isActive('bulletList');
                        break;
                    case 'orderedList':
                        isActive = editor.isActive('orderedList');
                        break;
                    case 'alignLeft':
                        isActive = editor.isActive({
                            textAlign: 'left'
                        });
                        break;
                    case 'alignCenter':
                        isActive = editor.isActive({
                            textAlign: 'center'
                        });
                        break;
                    case 'alignRight':
                        isActive = editor.isActive({
                            textAlign: 'right'
                        });
                        break;
                    case 'blockquote':
                        isActive = editor.isActive('blockquote');
                        break;
                }

                if (isActive) {
                    btn.classList.add('toolbar-btn-active');
                } else {
                    btn.classList.remove('toolbar-btn-active');
                }
            });
        }

        // Update toolbar on selection change
        ['en', 'dari', 'pashto'].forEach(lang => {
            if (editors[lang]) {
                editors[lang].on('selectionUpdate', () => updateToolbarState(lang));
            }
        });

        // Image preview
        window.previewImage = function(input) {
            const preview = document.getElementById('imagePreview');
            const img = document.getElementById('previewImg');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        // Form submission - sync editors
        document.getElementById('storyForm').addEventListener('submit', function() {
            ['en', 'dari', 'pashto'].forEach(lang => {
                if (editors[lang]) {
                    document.querySelector(`#paragraph_1_${lang}`).value = editors[lang].getHTML();
                }
            });
        });

        // Highlights management
        let highlightIndex = {{ count($highlights) }};

        function addHighlightRow() {
            const container = document.getElementById('highlights-container');
            const emptyState = document.getElementById('highlights-empty');

            emptyState.classList.add('hidden');

            const row = document.createElement('div');
            row.className = 'highlight-row p-3 bg-gray-700 rounded-lg border border-gray-600';
            row.dataset.index = highlightIndex;

            row.innerHTML = `
            <input type="hidden" name="highlights[${highlightIndex}][id]" value="">
            
            <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-400">Icon</label>
                    <select name="highlights[${highlightIndex}][icon_name]" 
                        class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2">
                        <option value="Building2">Building</option>
                        <option value="Globe">Globe</option>
                        <option value="TrendingUp">Trending Up</option>
                        <option value="Users">Users</option>
                        <option value="Award">Award</option>
                        <option value="Star">Star</option>
                        <option value="Heart">Heart</option>
                        <option value="Zap">Zap</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-400">Value</label>
                    <input type="text" name="highlights[${highlightIndex}][value_text]" 
                        class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2 placeholder-gray-500"
                        placeholder="e.g. 60">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-400">Label (EN)</label>
                    <input type="text" name="highlights[${highlightIndex}][label_en]" 
                        class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2 placeholder-gray-500"
                        placeholder="e.g. 6 Companies">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-400">Label (DR)</label>
                    <input type="text" name="highlights[${highlightIndex}][label_dari]" dir="rtl"
                        class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2 placeholder-gray-500"
                        placeholder="به دری">
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-1 text-xs font-medium text-gray-400">Label (PS)</label>
                    <input type="text" name="highlights[${highlightIndex}][label_pashto]" dir="rtl"
                        class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2 placeholder-gray-500"
                        placeholder="په پښتو">
                </div>

                <div class="md:col-span-2 flex items-end gap-2">
                    <div class="flex-1">
                        <label class="block mb-1 text-xs font-medium text-gray-400">Order</label>
                        <input type="number" name="highlights[${highlightIndex}][sort_order]" value="${highlightIndex}"
                            class="bg-gray-800 border border-gray-600 text-white text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2">
                    </div>
                    
                    <label class="flex items-center cursor-pointer mb-1">
                        <input type="hidden" name="highlights[${highlightIndex}][is_active]" value="0">
                        <input type="checkbox" name="highlights[${highlightIndex}][is_active]" value="1" checked
                            class="sr-only peer">
                        <div class="w-9 h-5 bg-gray-600 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-yellow-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-600 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-yellow-500 relative"></div>
                    </label>

                    <button type="button" onclick="removeHighlightRow(this)" 
                        class="p-2 text-red-400 bg-gray-800 border border-gray-600 rounded-lg hover:bg-red-900 hover:text-red-300"
                        title="Remove">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        `;

            container.appendChild(row);
            highlightIndex++;
        }

        function removeHighlightRow(btn) {
            const row = btn.closest('.highlight-row');
            row.remove();

            const container = document.getElementById('highlights-container');
            const emptyState = document.getElementById('highlights-empty');

            if (container.children.length === 0) {
                emptyState.classList.remove('hidden');
            }

            // Re-index remaining rows
            Array.from(container.children).forEach((child, idx) => {
                child.dataset.index = idx;
                child.querySelectorAll('[name]').forEach(input => {
                    const name = input.getAttribute('name');
                    const newName = name.replace(/highlights\[\d+\]/, `highlights[${idx}]`);
                    input.setAttribute('name', newName);
                });
            });

            highlightIndex = container.children.length;
        }
    </script>
@endpush