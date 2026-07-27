@extends('admin.layouts.app')

@section('title', 'Edit Category')
@section('page-title', 'Edit Category')


@section('content')
    <div class="max-w-5xl mx-auto p-6">
        <div class="mb-6">
            <h1 class="text-xl font-semibold text-white">Edit Category</h1>
            <p class="text-sm text-gray-400 mt-1">Update category: <span
                    class="text-white font-medium">{{ $category->name_en }}</span></p>
        </div>

        @if (session('error'))
            <div
                class="mb-4 flex items-center gap-3 bg-red-900/30 border border-red-800 text-red-300 px-4 py-3 rounded-lg text-sm">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-900/30 border border-red-800 text-red-300 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-gray-900 border border-gray-800 rounded-xl">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">
                            Name (English) <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" required
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name (Dari)</label>
                        <input type="text" name="name_dari" value="{{ old('name_dari', $category->name_dari) }}"
                            dir="rtl"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Name (Pashto)</label>
                        <input type="text" name="name_pashto" value="{{ old('name_pashto', $category->name_pashto) }}"
                            dir="rtl"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Slug</label>
                        <input type="text" name="slug" value="{{ old('slug', $category->slug) }}"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                        <p class="text-xs text-gray-500 mt-1.5">Leave empty to auto-generate from English name.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">
                            Type <span class="text-red-400">*</span>
                        </label>
                        <select name="type" required
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                            <option value="product" {{ old('type', $category->type) == 'product' ? 'selected' : '' }}>
                                Product</option>
                            <option value="project" {{ old('type', $category->type) == 'project' ? 'selected' : '' }}>
                                Project</option>
                            <option value="both" {{ old('type', $category->type) == 'both' ? 'selected' : '' }}>Both
                            </option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description (English)</label>
                        <textarea name="description_en" rows="4"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all resize-none">{{ old('description_en', $category->description_en) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description (Dari)</label>
                        <textarea name="description_dari" rows="4" dir="rtl"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all resize-none">{{ old('description_dari', $category->description_dari) }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Description (Pashto)</label>
                        <textarea name="description_pashto" rows="4" dir="rtl"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all resize-none">{{ old('description_pashto', $category->description_pashto) }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Parent Category</label>
                        <select name="parent_id"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                            <option value="">None (Root)</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name_en }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Icon Name</label>
                        <input type="text" name="icon_name" value="{{ old('icon_name', $category->icon_name) }}"
                            placeholder="e.g. Building2"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                        <p class="text-xs text-gray-500 mt-1.5">Lucide icon name for UI display.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                            min="0"
                            class="w-full bg-gray-950 border border-gray-700 rounded-lg px-4 py-2.5 text-white text-sm placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1.5">Category Image</label>
                        <input type="file" name="image" accept="image/*"
                            class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-700 file:text-white hover:file:bg-blue-600 file:transition-colors bg-gray-950 border border-gray-700 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600">

                        @if ($category->image_url)
                            <div class="mt-3 flex items-center gap-4">
                                <img src="{{ asset('storage/' . $category->image_url) }}" alt="Current"
                                    class="w-20 h-20 rounded-lg object-cover border border-gray-700">
                                <span class="text-xs text-gray-500">Current image. Upload new to replace.</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-end">
                        <label class="inline-flex items-center gap-3 cursor-pointer select-none">
                            <div class="relative">
                                <input type="checkbox" name="is_active" value="1"
                                    {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="peer sr-only">
                                <div
                                    class="w-11 h-6 bg-gray-700 peer-focus:ring-2 peer-focus:ring-blue-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-600 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                            </div>
                            <span class="text-sm font-medium text-gray-300">Active</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-800">
                    <a href="{{ route('admin.categories.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-gray-800 hover:bg-gray-700 rounded-lg transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-700 hover:bg-blue-600 rounded-lg transition-colors">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
