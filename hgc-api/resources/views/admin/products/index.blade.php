@extends('admin.layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
    <div class="space-y-6">

        <!-- Header & Add Button -->
        <div class="flex flex-col sm:flex-row sm:justify-between gap-4">
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-900 transition-colors flex-shrink-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Product
            </a>
        </div>

        <!-- Filters Card -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
            <form method="GET" action="{{ route('admin.products.index') }}"
                class="flex flex-row items-center gap-3 w-full flex-nowrap">

                <!-- Search Input -->
                <div class="flex-1 min-w-[150px]">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative flex items-center h-10 w-full">
                        <div class="absolute top-1/2 -translate-y-1/2 left-3 flex items-center justify-center pointer-events-none z-10">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-10 pl-9 pr-3 placeholder-gray-400 focus:outline-none"
                            placeholder="Search products by name or slug...">
                    </div>
                </div>

                <!-- Categories Dropdown -->
                <div class="w-auto h-10 shrink-0">
                    <select name="category"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-full pl-3 pr-8 cursor-pointer focus:outline-none appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%20%22%20stroke%3D%22%239ca3af%22%20stroke-width%3D%222%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20d%3D%22M19.5%208.25l-7.5%207.5-7.5-7.5%22%2F%3E%3C%2Fsvg%3E')] bg-[length:0.85rem_0.85rem] bg-[right_0.5rem_center] bg-no-repeat">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Dropdown -->
                <div class="w-auto h-10 shrink-0">
                    <select name="status"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-full pl-3 pr-8 cursor-pointer focus:outline-none appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%20%22%20stroke%3D%22%239ca3af%22%20stroke-width%3D%222%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20d%3D%22M19.5%208.25l-7.5%207.5-7.5-7.5%22%2F%3E%3C%2Fsvg%3E')] bg-[length:0.85rem_0.85rem] bg-[right_0.5rem_center] bg-no-repeat">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Availability Dropdown -->
                <div class="w-auto h-10 shrink-0">
                    <select name="availability"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-full pl-3 pr-8 cursor-pointer focus:outline-none appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%20%22%20stroke%3D%22%239ca3af%22%20stroke-width%3D%222%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20d%3D%22M19.5%208.25l-7.5%207.5-7.5-7.5%22%2F%3E%3C%2Fsvg%3E')] bg-[length:0.85rem_0.85rem] bg-[right_0.5rem_center] bg-no-repeat">
                        <option value="">All Availability</option>
                        <option value="in_stock" {{ request('availability') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="limited" {{ request('availability') == 'limited' ? 'selected' : '' }}>Limited</option>
                        <option value="pre_order" {{ request('availability') == 'pre_order' ? 'selected' : '' }}>Pre-Order</option>
                        <option value="out_of_stock" {{ request('availability') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex gap-2 h-10 shrink-0 w-auto">
                    <button type="submit"
                        class="px-4 h-full inline-flex items-center justify-center text-sm font-medium text-white bg-gray-700 rounded-lg border border-gray-600 hover:bg-gray-600 focus:ring-4 focus:ring-gray-700 transition-colors cursor-pointer whitespace-nowrap">
                        Filter
                    </button>
                    @if (request()->hasAny(['search', 'category', 'status', 'availability']))
                        <a href="{{ route('admin.products.index') }}"
                            class="px-4 h-full inline-flex items-center justify-center text-sm font-medium text-gray-300 bg-gray-800 rounded-lg border border-gray-600 hover:bg-gray-700 hover:text-white transition-colors whitespace-nowrap">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Products Table -->
        <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
                        <tr>
                            <th scope="col" class="px-6 py-4">Product</th>
                            <th scope="col" class="px-6 py-4">Category</th>
                            <th scope="col" class="px-6 py-4">Availability</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4">Featured</th>
                            <th scope="col" class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gray-700 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                            @if ($product->thumbnail_url || $product->hero_image_url)
                                                <img src="{{ $product->thumbnail_url ?? $product->hero_image_url }}"
                                                    alt="" class="w-full h-full object-cover">
                                            @else
                                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-white truncate">{{ $product->name_en }}</p>
                                            <p class="text-xs text-gray-500 truncate">{{ $product->slug }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                        {{ $product->category?->name_en ?? 'N/A' }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $availabilityColors[$product->availability] ?? 'bg-gray-700 text-gray-300' }}">
                                        {{ $availabilityLabels[$product->availability] ?? $product->availability }}
                                    </span>
                                </td>

                                <!-- FIXED Status Toggle: Using two separate complete button elements -->
                               <td class="px-6 py-4">
    <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}" class="flex items-center justify-start w-full">
        @csrf
        @method('PATCH')
        
        <!-- FIX: Ultra-compact micro sizing (Width: 1.75rem / Height: 1rem) -->
        <button type="submit"
            style="background-color: {{ $product->is_active ? '#2563eb' : '#4b5563' }}; width: 1.75rem; height: 1rem; flex-shrink: 0;"
            class="relative inline-flex items-center rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-blue-500/40 cursor-pointer">
            
            <span class="sr-only">Toggle status</span>
            
            <!-- Micro White Slider Dot (Width/Height: 0.7rem with perfectly tight edge offsets) -->
            <span style="width: 0.7rem; height: 0.7rem; flex-shrink: 0;"
                class="inline-block transform rounded-full bg-white shadow-sm transition-transform duration-200 ease-in-out {{ $product->is_active ? 'translate-x-[0.9rem]' : 'translate-x-[0.15rem]' }}"></span>
        </button>
    </form>
</td>


                                <!-- Featured Star -->
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('admin.products.toggle-featured', $product) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="transition-colors hover:scale-110 transform duration-150">
                                            @if($product->is_featured)
                                                <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                </svg>
                                            @else
                                                <svg class="w-6 h-6 text-gray-500 hover:text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                                </svg>
                                            @endif
                                        </button>
                                    </form>
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.show', $product) }}"
                                            class="p-2 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white transition-colors" title="View">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="p-2 text-blue-400 rounded-lg hover:bg-blue-900/30 hover:text-blue-300 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline"
                                            onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-400 rounded-lg hover:bg-red-900/30 hover:text-red-300 transition-colors" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <p class="text-gray-400 text-sm">No products found.</p>
                                    <p class="text-gray-500 text-xs mt-1">Try adjusting your filters or add a new product.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="px-6 py-4 border-t border-gray-700">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection