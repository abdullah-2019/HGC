@extends('admin.layouts.app')

@section('title', 'Edit Project: ' . $project->name_en)
@section('page-title', 'Edit Project')

@section('content')
    <div class="p-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                @if ($project->cover_image_url)
                    <img src="{{ asset('storage/' . $project->cover_image_url) }}" alt=""
                        class="w-16 h-16 rounded-lg object-cover border border-gray-600">
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-white">Edit Project</h2>
                    <p class="text-sm text-gray-400 mt-1">{{ $project->name_en }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.projects.show', $project) }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-800">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    View
                </a>
                <a href="{{ route('admin.projects.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- ===== SECTION 1: BASIC INFORMATION ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Basic Information</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-300">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $project->slug) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 @error('slug') border-red-500 bg-red-900/20 @enderror">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name_en" class="block mb-2 text-sm font-medium text-gray-300">Project Name (English)
                            <span class="text-red-400">*</span></label>
                        <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $project->name_en) }}"
                            required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 @error('name_en') border-red-500 bg-red-900/20 @enderror">
                        @error('name_en')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name_dari" class="block mb-2 text-sm font-medium text-gray-300">Project Name
                            (Dari)</label>
                        <input type="text" id="name_dari" name="name_dari"
                            value="{{ old('name_dari', $project->name_dari) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            dir="rtl">
                    </div>

                    <div class="md:col-span-2">
                        <label for="name_pashto" class="block mb-2 text-sm font-medium text-gray-300">Project Name
                            (Pashto)</label>
                        <input type="text" id="name_pashto" name="name_pashto"
                            value="{{ old('name_pashto', $project->name_pashto) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            dir="rtl">
                    </div>

                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">Category <span
                                class="text-red-400">*</span></label>
                        <select id="category_id" name="category_id" required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('category_id') border-red-500 bg-red-900/20 @enderror">
                            <option value="" class="bg-gray-700">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="bg-gray-700"
                                    {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_en }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="company_id" class="block mb-2 text-sm font-medium text-gray-300">Company</label>
                        <select id="company_id" name="company_id"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="" class="bg-gray-700">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" class="bg-gray-700"
                                    {{ old('company_id', $project->company_id) == $company->id ? 'selected' : '' }}>
                                    {{ $company->name_en }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 2: LOCATION ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Location</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="location_en" class="block mb-2 text-sm font-medium text-gray-300">Location
                            (English)</label>
                        <input type="text" id="location_en" name="location_en"
                            value="{{ old('location_en', $project->location_en) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    <div>
                        <label for="province" class="block mb-2 text-sm font-medium text-gray-300">Province</label>
                        <input type="text" id="province" name="province"
                            value="{{ old('province', $project->province) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    <div>
                        <label for="location_dari" class="block mb-2 text-sm font-medium text-gray-300">Location
                            (Dari)</label>
                        <input type="text" id="location_dari" name="location_dari"
                            value="{{ old('location_dari', $project->location_dari) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            dir="rtl">
                    </div>
                    <div>
                        <label for="location_pashto" class="block mb-2 text-sm font-medium text-gray-300">Location
                            (Pashto)</label>
                        <input type="text" id="location_pashto" name="location_pashto"
                            value="{{ old('location_pashto', $project->location_pashto) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            dir="rtl">
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 3: CLIENT INFORMATION ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Client Information</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="client_name_en" class="block mb-2 text-sm font-medium text-gray-300">Client Name
                            (English)</label>
                        <input type="text" id="client_name_en" name="client_name_en"
                            value="{{ old('client_name_en', $project->client_name_en) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    <div>
                        <label for="client_name_dari" class="block mb-2 text-sm font-medium text-gray-300">Client Name
                            (Dari)</label>
                        <input type="text" id="client_name_dari" name="client_name_dari"
                            value="{{ old('client_name_dari', $project->client_name_dari) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            dir="rtl">
                    </div>
                    <div class="md:col-span-2">
                        <label for="client_logo" class="block mb-2 text-sm font-medium text-gray-300">Client Logo</label>
                        <div class="flex items-center gap-4">
                            @if ($project->client_logo_url)
                                <div class="w-16 h-16 rounded-lg bg-gray-700 overflow-hidden border border-gray-600">
                                    <img src="{{ asset('storage/' . $project->client_logo_url) }}" alt="Client Logo"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="flex-1">
                                <input type="file" id="client_logo" name="client_logo" accept="image/*"
                                    class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500">
                                <p class="mt-1 text-xs text-gray-500">Upload new to replace existing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 4: BUDGET & DATES ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Budget & Timeline</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="budget_amount" class="block mb-2 text-sm font-medium text-gray-300">Budget
                            Amount</label>
                        <input type="number" id="budget_amount" name="budget_amount"
                            value="{{ old('budget_amount', $project->budget_amount) }}" step="0.01" min="0"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    <div>
                        <label for="budget_currency" class="block mb-2 text-sm font-medium text-gray-300">Currency <span
                                class="text-red-400">*</span></label>
                        <select id="budget_currency" name="budget_currency" required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="USD" class="bg-gray-700"
                                {{ old('budget_currency', $project->budget_currency) == 'USD' ? 'selected' : '' }}>USD
                            </option>
                            <option value="AFN" class="bg-gray-700"
                                {{ old('budget_currency', $project->budget_currency) == 'AFN' ? 'selected' : '' }}>AFN
                            </option>
                            <option value="EUR" class="bg-gray-700"
                                {{ old('budget_currency', $project->budget_currency) == 'EUR' ? 'selected' : '' }}>EUR
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="duration_text" class="block mb-2 text-sm font-medium text-gray-300">Duration
                            Text</label>
                        <input type="text" id="duration_text" name="duration_text"
                            value="{{ old('duration_text', $project->duration_text) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-300">Start Date</label>
                        <input type="date" id="start_date" name="start_date"
                            value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-300">End Date</label>
                        <input type="date" id="end_date" name="end_date"
                            value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="completion_percent" class="block mb-2 text-sm font-medium text-gray-300">Completion
                            %</label>
                        <input type="number" id="completion_percent" name="completion_percent"
                            value="{{ old('completion_percent', $project->completion_percent) }}" min="0"
                            max="100"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 5: DESCRIPTIONS ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Descriptions</h3>
                </div>
                <div class="p-6 space-y-6">
                    <div>
                        <label for="description_en" class="block mb-2 text-sm font-medium text-gray-300">Description
                            (English)</label>
                        <textarea id="description_en" name="description_en" rows="5"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 tinymce">{{ old('description_en', strip_tags($project->description_en)) }}</textarea>
                    </div>
                    <div>
                        <label for="description_dari" class="block mb-2 text-sm font-medium text-gray-300">Description
                            (Dari)</label>
                        <textarea id="description_dari" name="description_dari" rows="5" dir="rtl"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 tinymce">{{ old('description_dari', strip_tags($project->description_dari)) }}</textarea>
                    </div>
                    <div>
                        <label for="description_pashto" class="block mb-2 text-sm font-medium text-gray-300">Description
                            (Pashto)</label>
                        <textarea id="description_pashto" name="description_pashto" rows="5" dir="rtl"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 tinymce">{{ old('description_pashto', strip_tags($project->description_pashto)) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 6: STATUS & SETTINGS ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Status & Settings</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-300">Project Status <span
                                class="text-red-400">*</span></label>
                        <select id="status" name="status" required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" class="bg-gray-700"
                                    {{ old('status', $project->status) == $value ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="sort_order" class="block mb-2 text-sm font-medium text-gray-300">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order"
                            value="{{ old('sort_order', $project->sort_order) }}" min="0"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    <div class="flex items-center gap-6 pt-7">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured', $project->is_featured) ? 'checked' : '' }} class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-500 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-300">Featured</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $project->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-800 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-500 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-300">Active</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 7: IMAGES & GALLERY (CARD STYLE) ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Images & Gallery</h3>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Cover Image -->
                    <div>
                        <label for="cover_image" class="block mb-2 text-sm font-medium text-gray-300">Cover Image</label>
                        <div class="flex items-center gap-4">
                            @if ($project->cover_image_url)
                                <div class="w-32 h-24 rounded-lg bg-gray-700 overflow-hidden border border-gray-600">
                                    <img src="{{ asset('storage/' . $project->cover_image_url) }}" alt="Cover"
                                        class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="flex-1">
                                <input type="file" id="cover_image" name="cover_image" accept="image/*"
                                    class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500"
                                    onchange="previewCoverImage(this)">
                                <p class="mt-1 text-xs text-gray-500">Upload new to replace existing</p>
                            </div>
                        </div>
                        @error('cover_image')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Existing Gallery -->
                    @php $gallery = $project->gallery_images ?? []; @endphp
                    @if (count($gallery) > 0)
                        <div>
                            <label class="block mb-3 text-sm font-medium text-gray-300">Existing Gallery Images</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
                                id="existing-gallery">
                                @foreach ($gallery as $index => $image)
                                    <div class="gallery-card group bg-gray-700/50 rounded-xl border border-gray-600 overflow-hidden hover:border-gray-500 transition-all"
                                        data-image-url="{{ $image['image_url'] ?? '' }}">
                                        <!-- Image -->
                                        <div class="relative aspect-[4/3] bg-gray-800 overflow-hidden">
                                            <img src="{{ str_starts_with($image['image_url'] ?? '', 'http') ? $image['image_url'] : asset('storage/' . $image['image_url']) }}"
                                                alt="{{ $image['caption_en'] ?? '' }}"
                                                class="w-full h-full object-cover">
                                            <!-- Remove Button Overlay -->
                                            <button type="button"
                                                onclick="deleteGalleryImage(this, '{{ $image['image_url'] ?? '' }}')"
                                                class="absolute top-2 right-2 bg-red-500/90 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-lg backdrop-blur-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Captions -->
                                        <div class="p-3 space-y-2">
                                            <div>
                                                <label
                                                    class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Caption
                                                    (EN)</label>
                                                <input type="text"
                                                    name="gallery_existing_captions_en[{{ $index }}]"
                                                    value="{{ $image['caption_en'] ?? '' }}"
                                                    class="mt-0.5 block w-full text-xs bg-gray-700 border border-gray-600 rounded-md px-2 py-1 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                    placeholder="English caption...">
                                            </div>
                                            <div>
                                                <label
                                                    class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Caption
                                                    (Dari)</label>
                                                <input type="text"
                                                    name="gallery_existing_captions_dari[{{ $index }}]"
                                                    value="{{ $image['caption_dari'] ?? '' }}"
                                                    class="mt-0.5 block w-full text-xs bg-gray-700 border border-gray-600 rounded-md px-2 py-1 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                    placeholder="شرح دری..." dir="rtl">
                                            </div>
                                            <div>
                                                <label
                                                    class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">Caption
                                                    (Pashto)</label>
                                                <input type="text"
                                                    name="gallery_existing_captions_pashto[{{ $index }}]"
                                                    value="{{ $image['caption_pashto'] ?? '' }}"
                                                    class="mt-0.5 block w-full text-xs bg-gray-700 border border-gray-600 rounded-md px-2 py-1 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                    placeholder="پښتو شرح..." dir="rtl">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Add New Gallery Images -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium text-gray-300">Add New Gallery Images</label>
                            <button type="button" onclick="addGalleryRow()"
                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-300 bg-blue-900/50 rounded-lg hover:bg-blue-900 border border-blue-800 transition-colors">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Image
                            </button>
                        </div>
                        <div id="gallery-container"
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"></div>
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 8: PROJECT MILESTONES ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Project Milestones</h3>
                </div>
                <div class="p-6 space-y-4">
                    <!-- Existing Milestones -->
                    @php $milestones = $project->milestones ?? collect(); @endphp
                    @if ($milestones->count() > 0)
                        <div id="existing-milestones" class="space-y-3">
                            @foreach ($milestones as $milestone)
                                <div class="milestone-row p-4 bg-gray-700/50 rounded-lg border border-gray-600"
                                    data-milestone-id="{{ $milestone->id }}">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                                        <!-- Title EN -->
                                        <div class="md:col-span-3">
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Title (EN)</label>
                                            <input type="text" name="milestones[{{ $milestone->id }}][title_en]"
                                                value="{{ old('milestones.' . $milestone->id . '.title_en', $milestone->title_en) }}"
                                                class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Milestone title...">
                                        </div>
                                        <!-- Title Dari -->
                                        <div class="md:col-span-3">
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Title
                                                (Dari)</label>
                                            <input type="text" name="milestones[{{ $milestone->id }}][title_dari]"
                                                value="{{ old('milestones.' . $milestone->id . '.title_dari', $milestone->title_dari) }}"
                                                class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="عنوان دری..." dir="rtl">
                                        </div>
                                        <!-- Title Pashto -->
                                        <div class="md:col-span-3">
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Title
                                                (Pashto)</label>
                                            <input type="text" name="milestones[{{ $milestone->id }}][title_pashto]"
                                                value="{{ old('milestones.' . $milestone->id . '.title_pashto', $milestone->title_pashto) }}"
                                                class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="پښتو عنوان..." dir="rtl">
                                        </div>
                                        <!-- Date & Actions -->
                                        <div class="md:col-span-3 flex gap-3 items-end">
                                            <div class="flex-1">
                                                <label class="block mb-1 text-xs font-medium text-gray-400">Date</label>
                                                <input type="date"
                                                    name="milestones[{{ $milestone->id }}][milestone_date]"
                                                    value="{{ old('milestones.' . $milestone->id . '.milestone_date', $milestone->milestone_date?->format('Y-m-d')) }}"
                                                    class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:ring-blue-500 focus:border-blue-500">
                                            </div>
                                            <button type="button" onclick="removeMilestoneRow(this)"
                                                class="mb-0.5 text-red-400 hover:text-red-300 transition-colors p-2 rounded-lg hover:bg-red-900/30"
                                                title="Remove milestone">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Description -->
                                        <div class="md:col-span-12">
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Description</label>
                                            <textarea name="milestones[{{ $milestone->id }}][description]" rows="2"
                                                class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="Milestone description...">{{ old('milestones.' . $milestone->id . '.description', $milestone->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="existing-milestones" class="space-y-3"></div>
                        <p id="no-milestones-msg" class="text-sm text-gray-500 italic">No milestones yet. Click below to
                            add one.</p>
                    @endif

                    <!-- Add New Milestone Button -->
                    <button type="button" onclick="addMilestoneRow()"
                        class="w-full py-3 border-2 border-dashed border-gray-600 rounded-lg text-gray-400 hover:text-blue-400 hover:border-blue-500/50 hover:bg-blue-900/20 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New Milestone
                    </button>
                </div>
            </div>

            <!-- ===== SECTION 9: SEO ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    <h3 class="text-lg font-semibold text-white">SEO Meta Tags</h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="meta_title_en" class="block mb-2 text-sm font-medium text-gray-300">Meta Title
                            (English)</label>
                        <input type="text" id="meta_title_en" name="meta_title_en"
                            value="{{ old('meta_title_en', $project->meta_title_en) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            maxlength="150">
                        <p class="mt-1 text-xs text-gray-500">Max 150 characters</p>
                    </div>
                    <div>
                        <label for="meta_desc_en" class="block mb-2 text-sm font-medium text-gray-300">Meta Description
                            (English)</label>
                        <textarea id="meta_desc_en" name="meta_desc_en" rows="3" maxlength="300"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400">{{ old('meta_desc_en', $project->meta_desc_en) }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Max 300 characters</p>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-4 pt-4">
                <a href="{{ route('admin.projects.index') }}"
                    class="px-6 py-3 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-700">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-800">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Project
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        let galleryIndex = 0;
        let milestoneIndex = 0;

        // ===== GALLERY FUNCTIONS =====
        function addGalleryRow() {
            const container = document.getElementById('gallery-container');
            const row = document.createElement('div');
            row.className =
                'gallery-card bg-gray-700/50 rounded-xl border border-gray-600 overflow-hidden hover:border-gray-500 transition-all';
            row.dataset.index = galleryIndex;

            row.innerHTML = `
                <!-- Image Preview -->
                <div class="relative aspect-[4/3] bg-gray-800 overflow-hidden group">
                    <div id="gallery-preview-${galleryIndex}" class="w-full h-full flex items-center justify-center text-gray-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <img id="gallery-preview-img-${galleryIndex}" src="" alt="" class="w-full h-full object-cover hidden">
                    <!-- Remove Button -->
                    <button type="button" onclick="removeGalleryRow(this)"
                        class="absolute top-2 right-2 bg-red-500/90 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all cursor-pointer shadow-lg backdrop-blur-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- File Input -->
                <div class="p-3">
                    <label class="block mb-1.5 text-[10px] font-medium text-gray-500 uppercase tracking-wider">Image File</label>
                    <input type="file" name="gallery_files[${galleryIndex}]" accept="image/*"
                        class="block w-full text-xs text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-3 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500"
                        onchange="previewGalleryImage(this, ${galleryIndex})">
                </div>
                <!-- Captions -->
                <div class="px-3 pb-3 space-y-2">
                    <div>
                        <label class="block mb-0.5 text-[10px] font-medium text-gray-500 uppercase tracking-wider">Caption (EN)</label>
                        <input type="text" name="gallery_captions_en[${galleryIndex}]"
                            class="block w-full text-xs bg-gray-700 border border-gray-600 rounded-md px-2 py-1 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="English caption...">
                    </div>
                    <div>
                        <label class="block mb-0.5 text-[10px] font-medium text-gray-500 uppercase tracking-wider">Caption (Dari)</label>
                        <input type="text" name="gallery_captions_dari[${galleryIndex}]"
                            class="block w-full text-xs bg-gray-700 border border-gray-600 rounded-md px-2 py-1 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="شرح دری..." dir="rtl">
                    </div>
                    <div>
                        <label class="block mb-0.5 text-[10px] font-medium text-gray-500 uppercase tracking-wider">Caption (Pashto)</label>
                        <input type="text" name="gallery_captions_pashto[${galleryIndex}]"
                            class="block w-full text-xs bg-gray-700 border border-gray-600 rounded-md px-2 py-1 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="پښتو شرح..." dir="rtl">
                    </div>
                </div>
            `;

            container.appendChild(row);
            galleryIndex++;
        }

        function previewGalleryImage(input, index) {
            const placeholder = document.getElementById(`gallery-preview-${index}`);
            const img = document.getElementById(`gallery-preview-img-${index}`);
            if (input.files && input.files[0]) {
                img.src = URL.createObjectURL(input.files[0]);
                img.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
        }

        function removeGalleryRow(btn) {
            btn.closest('.gallery-card').remove();
        }

        function previewCoverImage(input) {
            const container = input.closest('.flex');
            let previewDiv = container.querySelector('.cover-preview-new');
            if (!previewDiv) {
                previewDiv = document.createElement('div');
                previewDiv.className =
                    'cover-preview-new w-32 h-24 rounded-lg bg-gray-700 overflow-hidden border border-gray-600';
                container.insertBefore(previewDiv, container.firstChild);
            }
            if (input.files && input.files[0]) {
                previewDiv.innerHTML =
                    `<img src="${URL.createObjectURL(input.files[0])}" alt="Preview" class="w-full h-full object-cover">`;
            }
        }

        function deleteGalleryImage(btn, imageUrl) {
            if (!confirm('Are you sure you want to delete this gallery image?')) return;

            const card = btn.closest('.gallery-card');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('admin.projects.gallery.delete', $project) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        image_url: imageUrl
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        card.remove();
                        const gallery = document.getElementById('existing-gallery');
                        if (gallery && gallery.children.length === 0) {
                            gallery.innerHTML = '<p class="text-sm text-gray-500 col-span-full">No gallery images</p>';
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to delete image. Please try again.');
                });
        }

        // ===== MILESTONE FUNCTIONS =====
        function addMilestoneRow() {
            const container = document.getElementById('existing-milestones');
            const noMsg = document.getElementById('no-milestones-msg');
            if (noMsg) noMsg.remove();

            const row = document.createElement('div');
            row.className = 'milestone-row p-4 bg-gray-700/50 rounded-lg border border-gray-600';
            row.dataset.newIndex = milestoneIndex;

            row.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                    <!-- Title EN -->
                    <div class="md:col-span-3">
                        <label class="block mb-1 text-xs font-medium text-gray-400">Title (EN)</label>
                        <input type="text" name="milestones_new[${milestoneIndex}][title_en]"
                            class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Milestone title...">
                    </div>
                    <!-- Title Dari -->
                    <div class="md:col-span-3">
                        <label class="block mb-1 text-xs font-medium text-gray-400">Title (Dari)</label>
                        <input type="text" name="milestones_new[${milestoneIndex}][title_dari]"
                            class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="عنوان دری..." dir="rtl">
                    </div>
                    <!-- Title Pashto -->
                    <div class="md:col-span-3">
                        <label class="block mb-1 text-xs font-medium text-gray-400">Title (Pashto)</label>
                        <input type="text" name="milestones_new[${milestoneIndex}][title_pashto]"
                            class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="پښتو عنوان..." dir="rtl">
                    </div>
                    <!-- Date & Actions -->
                    <div class="md:col-span-3 flex gap-3 items-end">
                        <div class="flex-1">
                            <label class="block mb-1 text-xs font-medium text-gray-400">Date</label>
                            <input type="date" name="milestones_new[${milestoneIndex}][milestone_date]"
                                class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <button type="button" onclick="removeMilestoneRow(this)"
                            class="mb-0.5 text-red-400 hover:text-red-300 transition-colors p-2 rounded-lg hover:bg-red-900/30"
                            title="Remove milestone">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Description -->
                    <div class="md:col-span-12">
                        <label class="block mb-1 text-xs font-medium text-gray-400">Description</label>
                        <textarea name="milestones_new[${milestoneIndex}][description]" rows="2"
                            class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Milestone description..."></textarea>
                    </div>
                </div>
            `;

            container.appendChild(row);
            milestoneIndex++;
        }

        function removeMilestoneRow(btn) {
            const row = btn.closest('.milestone-row');
            const container = document.getElementById('existing-milestones');

            // If it's an existing milestone, mark it for deletion
            const milestoneId = row.dataset.milestoneId;
            if (milestoneId) {
                // Add hidden input to mark for deletion
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'milestones_delete[]';
                deleteInput.value = milestoneId;
                document.querySelector('form').appendChild(deleteInput);
            }

            row.remove();

            // Show "no milestones" message if empty
            if (container.children.length === 0) {
                const noMsg = document.createElement('p');
                noMsg.id = 'no-milestones-msg';
                noMsg.className = 'text-sm text-gray-500 italic';
                noMsg.textContent = 'No milestones yet. Click below to add one.';
                container.parentNode.insertBefore(noMsg, container.nextSibling);
            }
        }
    </script>
@endsection
