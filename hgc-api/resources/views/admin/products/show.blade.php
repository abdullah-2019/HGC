@extends('admin.layouts.app')

@section('title', $product->name_en)
@section('page-title', $product->name_en)

@section('content')
    <div class="space-y-6" x-data="{ activeTab: 'overview' }">

        <!-- Header -->
        <div class="flex flex-row items-start justify-between gap-4 w-full">

            <!-- Title Section (Stays Left) -->
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.products.index') }}"
                    class="p-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div class="min-w-0"> <!-- min-w-0 prevents text overflow breaking the layout -->
                    <h1 class="text-xl sm:text-2xl font-bold text-white truncate">{{ $product->name_en }}</h1>
                    <p class="text-xs sm:text-sm text-gray-400 mt-1 truncate">{{ $product->slug }}</p>
                </div>
            </div>

            <!-- Edit Button Section (Pushed to the Right) -->
            <!-- FIX: Added shrink-0 so long titles can never shrink or squish this button layout -->
            <div class="flex items-center gap-2 shrink-0">
                <!-- style background color fallback handled for primary color configurations -->
                <a href="{{ route('admin.products.edit', $product) }}" style="background-color: #2563eb;"
                    class="inline-flex items-center px-3 sm:px-4 py-2 text-sm font-medium text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-900/40 transition-colors whitespace-nowrap">
                    <svg class="w-4 h-4 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="hidden xs:inline">Edit Product</span>
                    <span class="inline xs:hidden">Edit</span>
                </a>
            </div>
        </div>


        <!-- Status Bar -->
        @php
            $availabilityColors = [
                'in_stock' => 'bg-green-900/50 text-green-400 border-green-800',
                'limited' => 'bg-yellow-900/50 text-yellow-400 border-yellow-800',
                'pre_order' => 'bg-blue-900/50 text-blue-400 border-blue-800',
                'out_of_stock' => 'bg-red-900/50 text-red-400 border-red-800',
            ];
            $availabilityLabels = [
                'in_stock' => 'In Stock',
                'limited' => 'Limited',
                'pre_order' => 'Pre-Order',
                'out_of_stock' => 'Out of Stock',
            ];
        @endphp
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 flex flex-wrap items-center gap-3">
            <span
                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $availabilityColors[$product->availability] ?? 'bg-gray-700 text-gray-300' }}">
                {{ $availabilityLabels[$product->availability] ?? $product->availability }}
            </span>
            @if ($product->is_active)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-900/50 text-green-400 border border-green-800">Active</span>
            @else
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-900/50 text-red-400 border border-red-800">Inactive</span>
            @endif
            @if ($product->is_featured)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-900/50 text-yellow-400 border border-yellow-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    Featured
                </span>
            @endif
            <span class="text-sm text-gray-400 ml-auto">Sort Order: {{ $product->sort_order }}</span>
        </div>

        <!-- Images Gallery -->
        @if ($product->hero_image_url || $product->thumbnail_url || $product->images->count() > 0)
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-white mb-4">Images</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @if ($product->hero_image_url)
                        <div class="relative group">
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-700 border border-gray-600">
                                <img src="{{ $product->hero_image_url }}" alt="Hero" class="w-full h-full object-cover">
                            </div>
                            <span
                                class="absolute top-2 left-2 px-2 py-0.5 text-xs font-medium bg-primary-600 text-white rounded">Hero</span>
                        </div>
                    @endif
                    @if ($product->thumbnail_url)
                        <div class="relative group">
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-700 border border-gray-600">
                                <img src="{{ $product->thumbnail_url }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </div>
                            <span
                                class="absolute top-2 left-2 px-2 py-0.5 text-xs font-medium bg-gray-600 text-white rounded">Thumb</span>
                        </div>
                    @endif
                    @foreach ($product->images as $image)
                        <div class="relative group">
                            <div class="aspect-square rounded-lg overflow-hidden bg-gray-700 border border-gray-600">
                                <img src="{{ $image->image_url }}" alt="{{ $image->caption_en }}"
                                    class="w-full h-full object-cover">
                            </div>
                            @if ($image->is_primary)
                                <span
                                    class="absolute top-2 left-2 px-2 py-0.5 text-xs font-medium bg-yellow-600 text-white rounded">Primary</span>
                            @endif
                            @if ($image->caption_en)
                                <div class="absolute bottom-0 left-0 right-0 bg-gray-900/80 p-2">
                                    <p class="text-xs text-white truncate">{{ $image->caption_en }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Tabs -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg">
            <div class="border-b border-gray-700">
                <nav class="flex space-x-1 p-2 overflow-x-auto" aria-label="Tabs">
                    <button @click="activeTab = 'overview'"
                        :class="activeTab === 'overview' ? 'bg-gray-700 text-white' :
                            'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                        class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Overview
                    </button>
                    <button @click="activeTab = 'details'"
                        :class="activeTab === 'details' ? 'bg-gray-700 text-white' :
                            'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                        class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Details
                    </button>
                    <button @click="activeTab = 'specifications'"
                        :class="activeTab === 'specifications' ? 'bg-gray-700 text-white' :
                            'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                        class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        Specifications
                    </button>
                    <button @click="activeTab = 'seo'"
                        :class="activeTab === 'seo' ? 'bg-gray-700 text-white' :
                            'text-gray-400 hover:text-white hover:bg-gray-700/50'"
                        class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap">
                        SEO
                    </button>
                </nav>
            </div>

            <div class="p-6">
                <!-- Overview Tab -->
                <div x-show="activeTab === 'overview'" x-cloak>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">Names</h4>
                            <div class="space-y-3">
                                <div class="bg-gray-700/50 rounded-lg p-3">
                                    <p class="text-xs text-gray-500 mb-1">English</p>
                                    <p class="text-white font-medium">{{ $product->name_en }}</p>
                                </div>
                                @if ($product->name_dari)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">Dari</p>
                                        <p class="text-white font-medium" dir="rtl">{{ $product->name_dari }}</p>
                                    </div>
                                @endif
                                @if ($product->name_pashto)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">Pashto</p>
                                        <p class="text-white font-medium" dir="rtl">{{ $product->name_pashto }}</p>
                                    </div>
                                @endif
                            </div>

                            <h4 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3 mt-6">Taglines</h4>
                            <div class="space-y-3">
                                @if ($product->tagline_en)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">English</p>
                                        <p class="text-white">{{ $product->tagline_en }}</p>
                                    </div>
                                @endif
                                @if ($product->tagline_dari)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">Dari</p>
                                        <p class="text-white" dir="rtl">{{ $product->tagline_dari }}</p>
                                    </div>
                                @endif
                                @if ($product->tagline_pashto)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">Pashto</p>
                                        <p class="text-white" dir="rtl">{{ $product->tagline_pashto }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h4 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">Overviews</h4>
                            <div class="space-y-3">
                                @if ($product->overview_en)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">English</p>
                                        <div class="text-white text-sm prose prose-invert max-w-none">
                                            {!! $product->overview_en !!}</div>
                                    </div>
                                @endif
                                @if ($product->overview_dari)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">Dari</p>
                                        <div class="text-white text-sm" dir="rtl">{!! $product->overview_dari !!}</div>
                                    </div>
                                @endif
                                @if ($product->overview_pashto)
                                    <div class="bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-xs text-gray-500 mb-1">Pashto</p>
                                        <div class="text-white text-sm" dir="rtl">{!! $product->overview_pashto !!}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details Tab -->
                <div x-show="activeTab === 'details'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Category</p>
                            <p class="text-white font-medium">{{ $product->category?->name_en ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Company</p>
                            <p class="text-white font-medium">{{ $product->company?->name_en ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Origin</p>
                            <p class="text-white font-medium">{{ $product->origin ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Grade</p>
                            <p class="text-white font-medium">{{ $product->grade ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Purity</p>
                            <p class="text-white font-medium">{{ $product->purity ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Availability</p>
                            <p class="text-white font-medium">
                                {{ $availabilityLabels[$product->availability] ?? $product->availability }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-1">Sort Order</p>
                            <p class="text-white font-medium">{{ $product->sort_order }}</p>
                        </div>
                    </div>

                    @if ($product->delivery_info)
                        <div class="mt-6 bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Delivery Info</p>
                            <p class="text-white text-sm">{{ $product->delivery_info }}</p>
                        </div>
                    @endif

                    @if ($product->applications && count($product->applications) > 0)
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">Applications</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($product->applications as $app)
                                    <span
                                        class="px-3 py-1.5 text-sm bg-gray-700 text-gray-300 rounded-lg border border-gray-600">{{ $app }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($product->packaging && count($product->packaging) > 0)
                        <div class="mt-6">
                            <h4 class="text-sm font-medium text-gray-400 uppercase tracking-wider mb-3">Packaging</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($product->packaging as $pkg)
                                    <span
                                        class="px-3 py-1.5 text-sm bg-gray-700 text-gray-300 rounded-lg border border-gray-600">{{ $pkg }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specifications'" x-cloak>
                    @if ($product->specifications && count($product->specifications) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 rounded-l-lg">Label</th>
                                        <th scope="col" class="px-6 py-3 rounded-r-lg">Value</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-700">
                                    @foreach ($product->specifications as $spec)
                                        <tr class="hover:bg-gray-700/30 transition-colors">
                                            <td class="px-6 py-4 text-white font-medium">{{ $spec['label'] }}</td>
                                            <td class="px-6 py-4">{{ $spec['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-gray-400 text-sm">No specifications available.</p>
                        </div>
                    @endif
                </div>

                <!-- SEO Tab -->
                <div x-show="activeTab === 'seo'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Meta Title</p>
                            <p class="text-white">{{ $product->meta_title_en ?? 'Not set' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Meta Description</p>
                            <p class="text-white">{{ $product->meta_desc_en ?? 'Not set' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Slug</p>
                            <p class="text-white font-mono text-sm">{{ $product->slug }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Created At</p>
                            <p class="text-white">{{ $product->created_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Updated At</p>
                            <p class="text-white">{{ $product->updated_at?->format('M d, Y H:i') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
