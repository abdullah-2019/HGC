@extends('admin.layouts.app')

@section('title', 'Edit: ' . $product->name_en)
@section('page-title', 'Edit Product')

@section('content')
<div class="space-y-6" x-data="productForm()">

    <!-- Header -->
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.products.index') }}" class="p-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-white">Edit Product</h1>
            <p class="text-sm text-gray-400 mt-1">{{ $product->name_en }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Tabs Navigation -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
            <div class="border-b border-gray-700">
                <nav class="flex space-x-1 p-1 overflow-x-auto" aria-label="Tabs">
                    <button type="button" @click="activeTab = 'basic'"
                            :class="activeTab === 'basic' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Basic Info
                    </button>
                    <button type="button" @click="activeTab = 'content'"
                            :class="activeTab === 'content' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Content
                    </button>
                    <button type="button" @click="activeTab = 'pricing'"
                            :class="activeTab === 'pricing' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Pricing & Availability
                    </button>
                    <button type="button" @click="activeTab = 'specs'"
                            :class="activeTab === 'specs' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Specifications
                    </button>
                    <button type="button" @click="activeTab = 'images'"
                            :class="activeTab === 'images' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Images
                    </button>
                    <button type="button" @click="activeTab = 'seo'"
                            :class="activeTab === 'seo' ? 'bg-gray-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        SEO & Settings
                    </button>
                </nav>
            </div>

            <div class="p-6 space-y-6">

                <!-- Basic Info Tab -->
                <div x-show="activeTab === 'basic'" x-cloak>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Slug -->
                        <div class="lg:col-span-2">
                            <label for="slug" class="block mb-2 text-sm font-medium text-white">Slug <span class="text-red-400">*</span></label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="product-slug">
                            @error('slug')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Name EN -->
                        <div>
                            <label for="name_en" class="block mb-2 text-sm font-medium text-white">Name (English) <span class="text-red-400">*</span></label>
                            <input type="text" id="name_en" name="name_en" value="{{ old('name_en', $product->name_en) }}" required
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="Product name in English">
                            @error('name_en')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Name Dari -->
                        <div>
                            <label for="name_dari" class="block mb-2 text-sm font-medium text-white">Name (Dari)</label>
                            <input type="text" id="name_dari" name="name_dari" value="{{ old('name_dari', $product->name_dari) }}" dir="rtl"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="نام محصول به دری">
                            @error('name_dari')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Name Pashto -->
                        <div>
                            <label for="name_pashto" class="block mb-2 text-sm font-medium text-white">Name (Pashto)</label>
                            <input type="text" id="name_pashto" name="name_pashto" value="{{ old('name_pashto', $product->name_pashto) }}" dir="rtl"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="د محصول نوم په پښتو">
                            @error('name_pashto')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block mb-2 text-sm font-medium text-white">Category <span class="text-red-400">*</span></label>
                            <select id="category_id" name="category_id" required
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Company -->
                        <div>
                            <label for="company_id" class="block mb-2 text-sm font-medium text-white">Company</label>
                            <select id="company_id" name="company_id"
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                                        {{ $company->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Origin -->
                        <div>
                            <label for="origin" class="block mb-2 text-sm font-medium text-white">Origin</label>
                            <input type="text" id="origin" name="origin" value="{{ old('origin', $product->origin) }}"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="e.g. Afghanistan, China">
                            @error('origin')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Grade -->
                        <div>
                            <label for="grade" class="block mb-2 text-sm font-medium text-white">Grade</label>
                            <input type="text" id="grade" name="grade" value="{{ old('grade', $product->grade) }}"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="e.g. A Grade, M25">
                            @error('grade')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Purity -->
                        <div>
                            <label for="purity" class="block mb-2 text-sm font-medium text-white">Purity</label>
                            <input type="text" id="purity" name="purity" value="{{ old('purity', $product->purity) }}"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="e.g. 98%, 99.5%">
                            @error('purity')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                <!-- Content Tab -->
                <div x-show="activeTab === 'content'" x-cloak>
                    <div class="space-y-6">
                        <!-- Taglines -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                            <div>
                                <label for="tagline_en" class="block mb-2 text-sm font-medium text-white">Tagline (English)</label>
                                <input type="text" id="tagline_en" name="tagline_en" value="{{ old('tagline_en', $product->tagline_en) }}"
                                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                       placeholder="Short tagline in English">
                            </div>
                            <div>
                                <label for="tagline_dari" class="block mb-2 text-sm font-medium text-white">Tagline (Dari)</label>
                                <input type="text" id="tagline_dari" name="tagline_dari" value="{{ old('tagline_dari', $product->tagline_dari) }}" dir="rtl"
                                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                       placeholder="شعار کوتاه به دری">
                            </div>
                            <div>
                                <label for="tagline_pashto" class="block mb-2 text-sm font-medium text-white">Tagline (Pashto)</label>
                                <input type="text" id="tagline_pashto" name="tagline_pashto" value="{{ old('tagline_pashto', $product->tagline_pashto) }}" dir="rtl"
                                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                       placeholder="لنډ شعار په پښتو">
                            </div>
                        </div>

                        <!-- Overviews -->
                        <div class="space-y-4">
                            <div>
                                <label for="overview_en" class="block mb-2 text-sm font-medium text-white">Overview (English)</label>
                                <textarea id="overview_en" name="overview_en" rows="5"
                                          class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                          placeholder="Detailed product description in English">{{ old('overview_en', $product->overview_en) }}</textarea>
                            </div>
                            <div>
                                <label for="overview_dari" class="block mb-2 text-sm font-medium text-white">Overview (Dari)</label>
                                <textarea id="overview_dari" name="overview_dari" rows="5" dir="rtl"
                                          class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                          placeholder="توضیحات محصول به دری">{{ old('overview_dari', $product->overview_dari) }}</textarea>
                            </div>
                            <div>
                                <label for="overview_pashto" class="block mb-2 text-sm font-medium text-white">Overview (Pashto)</label>
                                <textarea id="overview_pashto" name="overview_pashto" rows="5" dir="rtl"
                                          class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                          placeholder="د محصول توضیحات په پښتو">{{ old('overview_pashto', $product->overview_pashto) }}</textarea>
                            </div>
                        </div>

                        <!-- Delivery Info -->
                        <div>
                            <label for="delivery_info" class="block mb-2 text-sm font-medium text-white">Delivery Information</label>
                            <textarea id="delivery_info" name="delivery_info" rows="3"
                                      class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                      placeholder="Delivery terms, timelines, coverage area...">{{ old('delivery_info', $product->delivery_info) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing Tab -->
                <div x-show="activeTab === 'pricing'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Price Range -->
                        <div>
                            <label for="price_range" class="block mb-2 text-sm font-medium text-white">Price Range</label>
                            <input type="text" id="price_range" name="price_range" value="{{ old('price_range', $product->price_range) }}"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="e.g. 2,500 - 4,500">
                        </div>

                        <!-- Currency -->
                        <div>
                            <label for="currency" class="block mb-2 text-sm font-medium text-white">Currency <span class="text-red-400">*</span></label>
                            <select id="currency" name="currency" required
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="AFN" {{ old('currency', $product->currency) == 'AFN' ? 'selected' : '' }}>AFN (Afghan Afghani)</option>
                                <option value="USD" {{ old('currency', $product->currency) == 'USD' ? 'selected' : '' }}>USD (US Dollar)</option>
                                <option value="EUR" {{ old('currency', $product->currency) == 'EUR' ? 'selected' : '' }}>EUR (Euro)</option>
                            </select>
                        </div>

                        <!-- Unit -->
                        <div>
                            <label for="unit" class="block mb-2 text-sm font-medium text-white">Unit</label>
                            <input type="text" id="unit" name="unit" value="{{ old('unit', $product->unit) }}"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="e.g. per ton, per m³, per system">
                        </div>

                        <!-- Availability -->
                        <div>
                            <label for="availability" class="block mb-2 text-sm font-medium text-white">Availability <span class="text-red-400">*</span></label>
                            <select id="availability" name="availability" required
                                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="in_stock" {{ old('availability', $product->availability) == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                                <option value="limited" {{ old('availability', $product->availability) == 'limited' ? 'selected' : '' }}>Limited</option>
                                <option value="pre_order" {{ old('availability', $product->availability) == 'pre_order' ? 'selected' : '' }}>Pre-Order</option>
                                <option value="out_of_stock" {{ old('availability', $product->availability) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <!-- Applications -->
                    <div class="mt-6">
                        <label class="block mb-2 text-sm font-medium text-white">Applications</label>
                        <div class="space-y-2">
                            <template x-for="(app, index) in applications" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" :name="`applications[${index}]`" x-model="applications[index]"
                                           class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                           placeholder="e.g. Concrete production">
                                    <button type="button" @click="removeApplication(index)"
                                            class="p-2.5 text-red-400 rounded-lg hover:bg-red-900/30 hover:text-red-300 transition-colors flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                            <button type="button" @click="addApplication()"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-primary-400 bg-primary-900/20 border border-primary-800 rounded-lg hover:bg-primary-900/40 transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Application
                            </button>
                        </div>
                    </div>

                    <!-- Packaging -->
                    <div class="mt-6">
                        <label class="block mb-2 text-sm font-medium text-white">Packaging Options</label>
                        <div class="space-y-2">
                            <template x-for="(pkg, index) in packaging" :key="index">
                                <div class="flex gap-2">
                                    <input type="text" :name="`packaging[${index}]`" x-model="packaging[index]"
                                           class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                           placeholder="e.g. 50kg bags">
                                    <button type="button" @click="removePackaging(index)"
                                            class="p-2.5 text-red-400 rounded-lg hover:bg-red-900/30 hover:text-red-300 transition-colors flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                            <button type="button" @click="addPackaging()"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-primary-400 bg-primary-900/20 border border-primary-800 rounded-lg hover:bg-primary-900/40 transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Packaging Option
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specs'" x-cloak>
                    <div class="space-y-4">
                        <template x-for="(spec, index) in specifications" :key="index">
                            <div class="flex gap-3 items-start bg-gray-700/30 rounded-lg p-4">
                                <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Label</label>
                                        <input type="text" :name="`specifications[${index}][label]`" x-model="spec.label"
                                               class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                               placeholder="e.g. Size Range">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-xs font-medium text-gray-400">Value</label>
                                        <input type="text" :name="`specifications[${index}][value]`" x-model="spec.value"
                                               class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                               placeholder="e.g. 0-5mm, 5-10mm">
                                    </div>
                                </div>
                                <button type="button" @click="removeSpecification(index)"
                                        class="mt-6 p-2 text-red-400 rounded-lg hover:bg-red-900/30 hover:text-red-300 transition-colors flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                        <button type="button" @click="addSpecification()"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-primary-400 bg-primary-900/20 border border-primary-800 rounded-lg hover:bg-primary-900/40 transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Add Specification
                        </button>
                    </div>
                </div>

                <!-- Images Tab -->
                <div x-show="activeTab === 'images'" x-cloak>
                    <!-- Current Hero Image -->
                    @if($product->hero_image_url)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-white mb-2">Current Hero Image</p>
                        <div class="w-48 h-24 rounded-lg overflow-hidden bg-gray-700 border border-gray-600">
                            <img src="{{ $product->hero_image_url }}" alt="Hero" class="w-full h-full object-cover">
                        </div>
                        <label class="flex items-center mt-2">
                            <input type="checkbox" name="delete_hero_image" value="1" class="w-4 h-4 text-red-600 bg-gray-700 border-gray-600 rounded focus:ring-red-600">
                            <span class="ml-2 text-sm text-red-400">Remove hero image</span>
                        </label>
                    </div>
                    @endif

                    <!-- Current Thumbnail -->
                    @if($product->thumbnail_url)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-white mb-2">Current Thumbnail</p>
                        <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-700 border border-gray-600">
                            <img src="{{ $product->thumbnail_url }}" alt="Thumbnail" class="w-full h-full object-cover">
                        </div>
                        <label class="flex items-center mt-2">
                            <input type="checkbox" name="delete_thumbnail" value="1" class="w-4 h-4 text-red-600 bg-gray-700 border-gray-600 rounded focus:ring-red-600">
                            <span class="ml-2 text-sm text-red-400">Remove thumbnail</span>
                        </label>
                    </div>
                    @endif

                    <!-- Current Product Images -->
                    @if($product->images->count() > 0)
                    <div class="mb-6">
                        <p class="text-sm font-medium text-white mb-3">Current Product Images</p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach($product->images as $image)
                            <div class="relative group">
                                <div class="aspect-square rounded-lg overflow-hidden bg-gray-700 border border-gray-600">
                                    <img src="{{ $image->image_url }}" alt="{{ $image->caption_en }}" class="w-full h-full object-cover">
                                </div>
                                @if($image->is_primary)
                                    <span class="absolute top-2 left-2 px-2 py-0.5 text-xs font-medium bg-yellow-600 text-white rounded">Primary</span>
                                @endif
                                <label class="absolute top-2 right-2">
                                    <input type="checkbox" name="deleted_image_ids[]" value="{{ $image->id }}" class="w-4 h-4 text-red-600 bg-gray-700 border-gray-600 rounded focus:ring-red-600">
                                    <span class="sr-only">Delete</span>
                                </label>
                                @if($image->caption_en)
                                    <div class="absolute bottom-0 left-0 right-0 bg-gray-900/80 p-2">
                                        <p class="text-xs text-white truncate">{{ $image->caption_en }}</p>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-400 mt-2">Check images to delete them</p>
                    </div>
                    @endif

                    <!-- New Image Uploads -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Hero Image -->
                        <div>
                            <label for="hero_image" class="block mb-2 text-sm font-medium text-white">Replace Hero Image</label>
                            <input type="file" id="hero_image" name="hero_image" accept="image/*"
                                   class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-700">
                            <p class="mt-1 text-xs text-gray-500">Recommended: 1200x600px, max 2MB</p>
                            @error('hero_image')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>

                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block mb-2 text-sm font-medium text-white">Replace Thumbnail</label>
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                   class="block w-full text-sm text-gray-400 border border-gray-600 rounded-lg cursor-pointer bg-gray-700 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-700">
                            <p class="mt-1 text-xs text-gray-500">Recommended: 400x400px, max 1MB</p>
                            @error('thumbnail')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- New Product Images -->
                    <div class="mt-6">
                        <label class="block mb-2 text-sm font-medium text-white">Add New Product Images</label>
                        <div class="space-y-4">
                            <template x-for="(image, index) in images" :key="index">
                                <div class="bg-gray-700/30 rounded-lg p-4 space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-300" x-text="`New Image #${index + 1}`"></span>
                                        <button type="button" @click="removeImage(index)"
                                                class="p-1.5 text-red-400 rounded-lg hover:bg-red-900/30 hover:text-red-300 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div>
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Image URL</label>
                                            <input type="text" :name="`images[${index}][image_url]`" x-model="image.image_url"
                                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                                   placeholder="/uploads/product-image.jpg">
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" :name="`images[${index}][is_primary]`" x-model="image.is_primary" :value="image.is_primary ? '1' : '0'"
                                                       class="sr-only peer">
                                                <div class="relative w-9 h-5 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-900 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary-600"></div>
                                                <span class="ms-3 text-sm font-medium text-gray-300">Primary</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div>
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Caption (EN)</label>
                                            <input type="text" :name="`images[${index}][caption_en]`" x-model="image.caption_en"
                                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                                   placeholder="Caption in English">
                                        </div>
                                        <div>
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Caption (Dari)</label>
                                            <input type="text" :name="`images[${index}][caption_dari]`" x-model="image.caption_dari" dir="rtl"
                                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                                   placeholder="شرح به دری">
                                        </div>
                                        <div>
                                            <label class="block mb-1 text-xs font-medium text-gray-400">Caption (Pashto)</label>
                                            <input type="text" :name="`images[${index}][caption_pashto]`" x-model="image.caption_pashto" dir="rtl"
                                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                                   placeholder="په پښتو شرح">
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <button type="button" @click="addImage()"
                                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-primary-400 bg-primary-900/20 border border-primary-800 rounded-lg hover:bg-primary-900/40 transition-colors">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Add Product Image
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SEO & Settings Tab -->
                <div x-show="activeTab === 'seo'" x-cloak>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Meta Title -->
                        <div>
                            <label for="meta_title_en" class="block mb-2 text-sm font-medium text-white">Meta Title</label>
                            <input type="text" id="meta_title_en" name="meta_title_en" value="{{ old('meta_title_en', $product->meta_title_en) }}" maxlength="150"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="SEO title (max 150 chars)">
                            <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label for="meta_desc_en" class="block mb-2 text-sm font-medium text-white">Meta Description</label>
                            <input type="text" id="meta_desc_en" name="meta_desc_en" value="{{ old('meta_desc_en', $product->meta_desc_en) }}" maxlength="300"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500"
                                   placeholder="SEO description (max 300 chars)">
                            <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label for="sort_order" class="block mb-2 text-sm font-medium text-white">Sort Order</label>
                            <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order) }}" min="0"
                                   class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 placeholder-gray-500">
                        </div>
                    </div>

                    <!-- Toggles -->
                    <div class="mt-6 flex flex-wrap gap-6">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-900 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-300">Featured Product</span>
                        </label>

                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                                   class="sr-only peer">
                            <div class="relative w-11 h-6 bg-gray-600 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-900 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-300">Active</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.products.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-gray-800 rounded-lg border border-gray-600 hover:bg-gray-700 hover:text-white transition-colors">
                Cancel
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-900 transition-colors">
                Update Product
            </button>
        </div>
    </form>
</div>

<script>
function productForm() {
    return {
        activeTab: 'basic',
        specifications: @json(old('specifications', $product->specifications ?? [])),
        applications: @json(old('applications', $product->applications ?? [])),
        packaging: @json(old('packaging', $product->packaging ?? [])),
        images: @json(old('images', [])),

        addSpecification() {
            this.specifications.push({ label: '', value: '' });
        },
        removeSpecification(index) {
            this.specifications.splice(index, 1);
        },
        addApplication() {
            this.applications.push('');
        },
        removeApplication(index) {
            this.applications.splice(index, 1);
        },
        addPackaging() {
            this.packaging.push('');
        },
        removePackaging(index) {
            this.packaging.splice(index, 1);
        },
        addImage() {
            this.images.push({
                image_url: '',
                caption_en: '',
                caption_dari: '',
                caption_pashto: '',
                sort_order: this.images.length,
                is_primary: false
            });
        },
        removeImage(index) {
            this.images.splice(index, 1);
        }
    }
}
</script>
@endsection