@extends('admin.layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="p-6">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold text-white">Categories</h1>
                <p class="text-sm text-gray-400 mt-0.5">Manage product and project categories</p>
            </div>
            <a href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Category
            </a>
        </div>

        {{-- Table Card --}}
        <div class="bg-slate-800/50 border border-slate-100 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table id="categoriesTable" class="w-full text-left text-sm">
                    <thead class="bg-slate-900/80 text-slate-400 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-5 py-3.5 font-semibold">ID</th>
                            <th class="px-5 py-3.5 font-semibold">Image</th>
                            <th class="px-5 py-3.5 font-semibold">Name</th>
                            <th class="px-5 py-3.5 font-semibold">Type</th>
                            <th class="px-5 py-3.5 font-semibold">Icon</th>
                            <th class="px-5 py-3.5 font-semibold">Order</th>
                            <th class="px-5 py-3.5 font-semibold">Status</th>
                            <th class="px-5 py-3.5 font-semibold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-slate-700/30 transition-colors">
                                <td class="px-5 py-4 text-slate-400">{{ $category->id }}</td>
                                <td class="px-5 py-4">
                                    @if ($category->image_url)
                                        <img src="{{ asset('storage/' . $category->image_url) }}" alt=""
                                            class="w-11 h-11 rounded-lg object-cover bg-slate-700">
                                    @else
                                        <div class="w-11 h-11 rounded-lg bg-slate-700 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="font-medium text-white">{{ $category->name_en }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5" dir="rtl">
                                        {{ $category->name_dari ?: '-' }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5" dir="rtl">
                                        {{ $category->name_pashto ?: '-' }}</div>
                                </td>
                                <td class="px-5 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        {{ ucfirst($category->type) }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    @if ($category->icon_name)
                                        <code
                                            class="text-xs bg-slate-700 text-blue-300 px-2 py-1 rounded">{{ $category->icon_name }}</code>
                                    @else
                                        <span class="text-slate-500">-</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-slate-400">{{ $category->sort_order }}</td>
                                <td class="px-5 py-4">
                                    @if ($category->is_active)
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-500/10 text-green-400 border border-green-500/20">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-500/10 text-red-400 border border-red-500/20">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}"
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-600 text-slate-400 hover:text-blue-400 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all"
                                            title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-600 text-slate-400 hover:text-red-400 hover:border-red-500/50 hover:bg-red-500/10 transition-all"
                                                title="Delete">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                pageLength: 25,
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    orderable: false,
                    targets: [1, 7]
                }],
                language: {
                    search: '',
                    searchPlaceholder: 'Search...'
                }
            });
        });
    </script>
@endpush
