@extends('admin.layouts.app')

@section('title', 'Create Project')
@section('page-title', 'Create Project')

@section('content')

    @include('admin.error-alert')
    <div class="p-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-white">Create New Project</h2>
                <p class="text-sm text-gray-400 mt-1">Add a new construction or development project</p>
            </div>
            <a href="{{ route('admin.projects.index') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-white focus:ring-4 focus:ring-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Back to Projects
            </a>
        </div>

        <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

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
                    <div>
                        <label for="name_en" class="block mb-2 text-sm font-medium text-gray-300">Project Name (English)
                            <span class="text-red-400">*</span></label>
                        <input type="text" id="name_en" name="name_en" value="{{ old('name_en') }}" required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 @error('name_en') border-red-500 bg-red-900/20 @enderror"
                            placeholder="e.g., Kabul-Kandahar Highway Rehabilitation">
                        @error('name_en')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="slug" class="block mb-2 text-sm font-medium text-gray-300">Slug <span
                                class="text-gray-500 text-xs">(Auto-generated if empty)</span></label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 @error('slug') border-red-500 bg-red-900/20 @enderror"
                            placeholder="e.g., kabul-kandahar-highway">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="name_dari" class="block mb-2 text-sm font-medium text-gray-300">Project Name
                            (Dari)</label>
                        <input type="text" id="name_dari" name="name_dari" value="{{ old('name_dari') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="بازسازی شاهراه کابل-قندهار" dir="rtl">
                    </div>

                    <div class="md:col-span-2">
                        <label for="name_pashto" class="block mb-2 text-sm font-medium text-gray-300">Project Name
                            (Pashto)</label>
                        <input type="text" id="name_pashto" name="name_pashto" value="{{ old('name_pashto') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="د کابل-کندهار لویې لارې بیا رغونه" dir="rtl">
                    </div>

                    <div>
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">Category <span
                                class="text-red-400">*</span></label>
                        <select id="category_id" name="category_id" required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('category_id') border-red-500 bg-red-900/20 @enderror">
                            <option value="" class="bg-gray-700">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }} class="bg-gray-700">
                                    {{ $category->name_en }}
                                </option>
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
                                <option value="{{ $company->id }}"
                                    {{ old('company_id') == $company->id ? 'selected' : '' }} class="bg-gray-700">
                                    {{ $company->name_en }}
                                </option>
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
                        <input type="text" id="location_en" name="location_en" value="{{ old('location_en') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="e.g., Kabul to Kandahar">
                    </div>
                    <div>
                        <label for="location_dari" class="block mb-2 text-sm font-medium text-gray-300">Location
                            (Dari)</label>
                        <input type="text" id="location_dari" name="location_dari"
                            value="{{ old('location_dari') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="کابل تا قندهار" dir="rtl">
                    </div>
                    <div>
                        <label for="location_pashto" class="block mb-2 text-sm font-medium text-gray-300">Location
                            (Pashto)</label>
                        <input type="text" id="location_pashto" name="location_pashto"
                            value="{{ old('location_pashto') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="کابل تر کندهار" dir="rtl">
                    </div>
                    <div>
                        <label for="province_en" class="block mb-2 text-sm font-medium text-gray-300">Province
                            (English)</label>
                        <input type="text" id="province_en" name="province_en" value="{{ old('province_en') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="e.g., Multi-Province">
                    </div>
                    <div>
                        <label for="province_dari" class="block mb-2 text-sm font-medium text-gray-300">Province
                            (Dari)</label>
                        <input type="text" id="province_dari" name="province_dari"
                            value="{{ old('province_dari') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="ولایت" dir="rtl">
                    </div>
                    <div>
                        <label for="province_pashto" class="block mb-2 text-sm font-medium text-gray-300">Province
                            (Pashto)</label>
                        <input type="text" id="province_pashto" name="province_pashto"
                            value="{{ old('province_pashto') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="ولایت" dir="rtl">
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
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="client_name_en" class="block mb-2 text-sm font-medium text-gray-300">Client Name
                            (English)</label>
                        <input type="text" id="client_name_en" name="client_name_en"
                            value="{{ old('client_name_en') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="e.g., Ministry of Public Works">
                    </div>
                    <div>
                        <label for="client_name_dari" class="block mb-2 text-sm font-medium text-gray-300">Client Name
                            (Dari)</label>
                        <input type="text" id="client_name_dari" name="client_name_dari"
                            value="{{ old('client_name_dari') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="وزارت کارهای عامه" dir="rtl">
                    </div>
                    <div>
                        <label for="client_name_pashto" class="block mb-2 text-sm font-medium text-gray-300">Client Name
                            (Pashto)</label>
                        <input type="text" id="client_name_pashto" name="client_name_pashto"
                            value="{{ old('client_name_pashto') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="د عامه کارونو وزارت" dir="rtl">
                    </div>
                    <div class="md:col-span-3">
                        <label for="client_logo" class="block mb-2 text-sm font-medium text-gray-300">Client Logo</label>
                        <input type="file" id="client_logo" name="client_logo" accept="image/*"
                            class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500">
                        <p class="mt-1 text-xs text-gray-500">PNG, JPG, WEBP (max 2MB)</p>
                        @error('client_logo')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
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
                            value="{{ old('budget_amount') }}" step="0.01" min="0"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="45000000">
                    </div>
                    <div>
                        <label for="budget_currency" class="block mb-2 text-sm font-medium text-gray-300">Currency <span
                                class="text-red-400">*</span></label>
                        <select id="budget_currency" name="budget_currency" required
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="AFN" class="bg-gray-700"
                                {{ old('budget_currency', 'AFN') == 'AFN' ? 'selected' : '' }}>AFN</option>
                            <option value="USD" class="bg-gray-700"
                                {{ old('budget_currency') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" class="bg-gray-700"
                                {{ old('budget_currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                        </select>
                    </div>
                    <div>
                        <label for="duration_text" class="block mb-2 text-sm font-medium text-gray-300">Duration
                            Text</label>
                        <input type="text" id="duration_text" name="duration_text"
                            value="{{ old('duration_text') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="e.g., 18 months">
                    </div>
                    <div>
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-300">Start Date</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-300">End Date</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="completion_percent" class="block mb-2 text-sm font-medium text-gray-300">Completion
                            %</label>
                        <input type="number" id="completion_percent" name="completion_percent"
                            value="{{ old('completion_percent', 0) }}" min="0" max="100"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="0">
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
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 tinymce">{{ old('description_en') }}</textarea>
                    </div>
                    <div>
                        <label for="description_dari" class="block mb-2 text-sm font-medium text-gray-300">Description
                            (Dari)</label>
                        <textarea id="description_dari" name="description_dari" rows="5" dir="rtl"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 tinymce">{{ old('description_dari') }}</textarea>
                    </div>
                    <div>
                        <label for="description_pashto" class="block mb-2 text-sm font-medium text-gray-300">Description
                            (Pashto)</label>
                        <textarea id="description_pashto" name="description_pashto" rows="5" dir="rtl"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 tinymce">{{ old('description_pashto') }}</textarea>
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
                                    {{ old('status', 'ongoing') == $value ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="sort_order" class="block mb-2 text-sm font-medium text-gray-300">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="0">
                    </div>
                    <div class="flex items-center gap-6 pt-7">

                        <!-- 1. FEATURED CHECKBOX -->
                        <div>
                            <input type="hidden" name="is_featured" value="0">
                            <label class="inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="is_featured" value="1"
                                    {{ old('is_featured') ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2 focus:outline-none cursor-pointer">
                                <span
                                    class="ms-2.5 text-sm font-medium text-gray-300 hover:text-white transition-colors">&nbsp;Featured</span>
                            </label>
                        </div>

                        <!-- 2. ACTIVE CHECKBOX -->
                        <div>
                            <input type="hidden" name="is_active" value="0">
                            <label class="inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500 focus:ring-2 focus:outline-none cursor-pointer">
                                <span
                                    class="ms-2.5 text-sm font-medium text-gray-300 hover:text-white transition-colors">&nbsp;Active</span>
                            </label>
                        </div>

                    </div>

                </div>
            </div>

            <!-- ===== SECTION 7: IMAGES ===== -->
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
                            <div id="cover-preview"
                                class="hidden w-32 h-24 rounded-lg bg-gray-700 overflow-hidden border border-gray-600">
                                <img src="" alt="Preview" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <input type="file" id="cover_image" name="cover_image" accept="image/*"
                                    class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500"
                                    onchange="previewCover(this)">
                                <p class="mt-1 text-xs text-gray-500">Recommended: 1200x800px, max 5MB</p>
                            </div>
                        </div>
                        @error('cover_image')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gallery Images -->
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="block mb-2 text-sm font-medium text-gray-300 mb-0">Gallery Images</label>
                            <div class="flex gap-2">
                                <button type="button" onclick="addGalleryRow('file')"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-300 bg-blue-900/50 rounded-lg hover:bg-blue-900 border border-blue-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Upload File
                                </button>
                                <button type="button" onclick="addGalleryRow('url')"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-purple-300 bg-purple-900/50 rounded-lg hover:bg-purple-900 border border-purple-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                        </path>
                                    </svg>
                                    External URL
                                </button>
                            </div>
                        </div>
                        <div id="gallery-container" class="space-y-3" style="margin-top: 10px;"></div>
                        <p class="mt-2 text-xs text-gray-500">You can upload files or paste external image URLs</p>
                        @error('gallery_files')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        @error('gallery_files.*')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- ===== SECTION 8: PROJECT MILESTONES ===== -->
            <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                <div class="flex items-center gap-2 px-6 py-4 border-b border-gray-700 bg-gray-700/50 rounded-t-lg">
                    <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <h3 class="text-lg font-semibold text-white">Project Milestones</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div id="milestones-wrapper" class="space-y-3">
                        <p id="no-milestones-msg" class="text-sm text-gray-500 italic py-2">No milestones yet. Click below
                            to add one.</p>
                    </div>
                    <button type="button" onclick="addMilestone()"
                        class="w-full py-3 border-2 border-dashed border-gray-600 rounded-lg text-gray-400 hover:text-blue-400 hover:border-blue-500/50 hover:bg-blue-900/20 transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
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
                            value="{{ old('meta_title_en') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="SEO title..." maxlength="150">
                        <p class="mt-1 text-xs text-gray-500">Max 150 characters</p>
                    </div>
                    <div>
                        <label for="meta_desc_en" class="block mb-2 text-sm font-medium text-gray-300">Meta Description
                            (English)</label>
                        <textarea id="meta_desc_en" name="meta_desc_en" rows="3" maxlength="300"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                            placeholder="SEO description...">{{ old('meta_desc_en') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Max 300 characters</p>
                    </div>
                    <div>
                        <label for="meta_title_dari" class="block mb-2 text-sm font-medium text-gray-300">Meta Title
                            (Dari)</label>
                        <input type="text" id="meta_title_dari" name="meta_title_dari"
                            value="{{ old('meta_title_dari') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="عنوان سئو..." maxlength="150" dir="rtl">
                        <p class="mt-1 text-xs text-gray-500">Max 150 characters</p>
                    </div>
                    <div>
                        <label for="meta_desc_dari" class="block mb-2 text-sm font-medium text-gray-300">Meta Description
                            (Dari)</label>
                        <textarea id="meta_desc_dari" name="meta_desc_dari" rows="3" maxlength="300"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                            placeholder="توضیحات سئو..." dir="rtl">{{ old('meta_desc_dari') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Max 300 characters</p>
                    </div>
                    <div>
                        <label for="meta_title_pashto" class="block mb-2 text-sm font-medium text-gray-300">Meta Title
                            (Pashto)</label>
                        <input type="text" id="meta_title_pashto" name="meta_title_pashto"
                            value="{{ old('meta_title_pashto') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                            placeholder="د سئو سرلیک..." maxlength="150" dir="rtl">
                        <p class="mt-1 text-xs text-gray-500">Max 150 characters</p>
                    </div>
                    <div>
                        <label for="meta_desc_pashto" class="block mb-2 text-sm font-medium text-gray-300">Meta
                            Description
                            (Pashto)</label>
                        <textarea id="meta_desc_pashto" name="meta_desc_pashto" rows="3" maxlength="300"
                            class="block p-2.5 w-full text-sm text-white bg-gray-700 rounded-lg border border-gray-600 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400"
                            placeholder="د سئو تشریح..." dir="rtl">{{ old('meta_desc_pashto') }}</textarea>
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
                    Create Project
                </button>
            </div>
        </form>


        <script>
            // Real-time slug generation from name_en
            (function() {
                const nameInput = document.getElementById('name_en');
                const slugInput = document.getElementById('slug');

                if (!nameInput || !slugInput) return;

                nameInput.addEventListener('input', function() {
                    const slug = this.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^\w\s-]/g, '') // remove symbols (keep letters, numbers, spaces, hyphens)
                        .replace(/[\s_]+/g, '-') // replace spaces/underscores with single hyphen
                        .replace(/^-+|-+$/g, '') // trim leading/trailing hyphens
                        .replace(/-+/g, '-'); // collapse multiple hyphens into one

                    slugInput.value = slug;
                });
            })();
        </script>

        <script>
            // Auto-generate slug from name
            // document.getElementById('name_en').addEventListener('blur', function() {
            //     const slugField = document.getElementById('slug');
            //     if (!slugField.value) {
            //         slugField.value = this.value.toLowerCase()
            //             .replace(/[^\w\s-]/g, '')
            //             .replace(/[\s_]+/g, '-')
            //             .replace(/^-+|-+$/g, '');
            //     }
            // });

            // Cover image preview
            function previewCover(input) {
                const preview = document.getElementById('cover-preview');
                const img = preview.querySelector('img');
                if (input.files && input.files[0]) {
                    img.src = URL.createObjectURL(input.files[0]);
                    preview.classList.remove('hidden');
                }
            }

            // Gallery management
            let galleryIndex = 0;

            function addGalleryRow(type = 'file') {
                const container = document.getElementById('gallery-container');
                if (!container) return;
                const row = document.createElement('div');
                row.className = 'gallery-row p-4 bg-gray-700/50 rounded-lg border border-gray-600';
                row.dataset.index = galleryIndex;

                if (type === 'file') {
                    row.innerHTML = `
                <div class="flex items-start gap-4">
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-xs font-medium text-gray-400">Image File</label>
                            <input type="file" name="gallery_files[${galleryIndex}]" accept="image/*"
                                   class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-500"
                                   onchange="previewGalleryImage(this, ${galleryIndex})">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-medium text-gray-400">Caption (EN)</label>
                            <input type="text" name="gallery_captions_en[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="English caption...">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-medium text-gray-400">Caption (Dari)</label>
                            <input type="text" name="gallery_captions_dari[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="شرح دری..." dir="rtl">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-medium text-gray-400">Caption (Pashto)</label>
                            <input type="text" name="gallery_captions_pashto[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="پښتو شرح..." dir="rtl">
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div id="gallery-preview-${galleryIndex}" class="w-20 h-16 rounded-lg bg-gray-600 overflow-hidden hidden">
                            <img src="" alt="" class="w-full h-full object-cover">
                        </div>
                        <button type="button" onclick="removeGalleryRow(this)"
                                class="text-red-400 hover:text-red-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
                } else {
                    row.innerHTML = `
                <div class="flex items-start gap-4">
                    <div class="flex-1 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-1">
                            <label class="block mb-2 text-xs font-medium text-gray-400">Image URL</label>
                            <input type="url" name="gallery_urls[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="https://example.com/image.jpg">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-medium text-gray-400">Caption (EN)</label>
                            <input type="text" name="gallery_url_captions_en[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="English caption...">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-medium text-gray-400">Caption (Dari)</label>
                            <input type="text" name="gallery_url_captions_dari[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="شرح دری..." dir="rtl">
                        </div>
                        <div>
                            <label class="block mb-2 text-xs font-medium text-gray-400">Caption (Pashto)</label>
                            <input type="text" name="gallery_url_captions_pashto[${galleryIndex}]"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 placeholder-gray-400"
                                   placeholder="پښتو شرح..." dir="rtl">
                        </div>
                    </div>
                    <button type="button" onclick="removeGalleryRow(this)"
                            class="mt-6 text-red-400 hover:text-red-300 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            `;
                }

                container.appendChild(row);
                galleryIndex++;
            }

            function previewGalleryImage(input, index) {
                const preview = document.getElementById(`gallery-preview-${index}`);
                const img = preview.querySelector('img');
                if (input.files && input.files[0]) {
                    img.src = URL.createObjectURL(input.files[0]);
                    preview.classList.remove('hidden');
                }
            }

            function removeGalleryRow(btn) {
                btn.closest('.gallery-row').remove();
            }

            // Add initial gallery row
            document.addEventListener('DOMContentLoaded', function() {
                addGalleryRow('file');
            });

            // Milestone management
            let milestoneIndex = 0;

            function addMilestone() {
                const container = document.getElementById('milestones-wrapper');
                if (!container) return;
                const noMsg = document.getElementById('no-milestones-msg');
                if (noMsg) noMsg.remove();
                const idx = milestoneIndex++;
                const row = document.createElement('div');
                row.className = 'milestone-row relative p-4 bg-gray-700/50 rounded-lg border border-gray-600 mb-2';
                row.innerHTML =
                    '<button type="button" onclick="removeMilestone(this)" title="Remove milestone" style="position: absolute; top: 2px; right: 2px; color: red;"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg></button><div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start pr-8"><div class="md:col-span-3"><label class="block mb-1 text-xs font-medium text-gray-400">Title (EN)</label><input type="text" name="milestones_new[' +
                    idx +
                    '][title_en]" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500" placeholder="Milestone title..."></div><div class="md:col-span-3"><label class="block mb-1 text-xs font-medium text-gray-400">Title (Dari)</label><input type="text" name="milestones_new[' +
                    idx +
                    '][title_dari]" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500" placeholder="عنوان دری..." dir="rtl"></div><div class="md:col-span-3"><label class="block mb-1 text-xs font-medium text-gray-400">Title (Pashto)</label><input type="text" name="milestones_new[' +
                    idx +
                    '][title_pashto]" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500" placeholder="پښتو عنوان..." dir="rtl"></div><div class="md:col-span-3"><label class="block mb-1 text-xs font-medium text-gray-400">Date</label><input type="date" name="milestones_new[' +
                    idx +
                    '][milestone_date]" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white focus:ring-blue-500 focus:border-blue-500"></div><div class="md:col-span-12"><label class="block mb-1 text-xs font-medium text-gray-400">Description (EN)</label><textarea name="milestones_new[' +
                    idx +
                    '][description_en]" rows="2" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500" placeholder="Milestone description..."></textarea></div><div class="md:col-span-6"><label class="block mb-1 text-xs font-medium text-gray-400">Description (Dari)</label><textarea name="milestones_new[' +
                    idx +
                    '][description_dari]" rows="2" dir="rtl" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500" placeholder="توضیحات دری..."></textarea></div><div class="md:col-span-6"><label class="block mb-1 text-xs font-medium text-gray-400">Description (Pashto)</label><textarea name="milestones_new[' +
                    idx +
                    '][description_pashto]" rows="2" dir="rtl" class="block w-full text-sm bg-gray-700 border border-gray-600 rounded-lg px-3 py-2 text-white placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500" placeholder="پښتو تشریح..."></textarea></div></div>';
                container.appendChild(row);
            }

            function removeMilestone(btn) {
                const row = btn.closest('.milestone-row');
                if (!row) return;
                const container = document.getElementById('milestones-wrapper');
                row.remove();
                if (container && container.children.length === 0) {
                    const msg = document.createElement('p');
                    msg.id = 'no-milestones-msg';
                    msg.className = 'text-sm text-gray-500 italic py-2';
                    msg.textContent = 'No milestones yet. Click below to add one.';
                    container.appendChild(msg);
                }
            }
        </script>
    </div>
@endsection
