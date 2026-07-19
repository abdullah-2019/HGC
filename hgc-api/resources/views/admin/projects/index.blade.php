@extends('admin.layouts.app')

@section('title', 'Projects')
@section('page-title', 'Projects')


@section('content')
    <div class="p-4">
        <!-- Header & Actions -->
        <div class="flex w-full mb-6">
            <a href="{{ route('admin.projects.create') }}"
                class="ml-auto inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Project
            </a>
        </div>



        <!-- Filters Bar -->
        <div class="mb-6 p-4 bg-gray-800 rounded-lg border border-gray-700">
            <form method="GET" action="{{ route('admin.projects.index') }}" class="flex flex-wrap items-end gap-3 w-full">

                <!-- Search Input -->
                <div class="flex-1 min-w-[150px]">
                    <label for="search" class="block mb-2 text-sm font-medium text-gray-300">Search</label>
                    <div class="relative flex items-center h-10 w-full">
                        <div
                            class="absolute top-1/2 -translate-y-1/2 left-3 px-2 flex items-center justify-center pointer-events-none z-10">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full h-10 pl-11 pr-3 placeholder-gray-400 focus:outline-none"
                            placeholder="Search by name, slug, or location...">
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="w-44 flex-shrink-0">
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-300">Status</label>
                    <select id="status" name="status"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-11 px-3 focus:outline-none"
                        style="min-width: 110px">
                        <option value="" class="bg-gray-700">All Status</option>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}
                                class="bg-gray-700">
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Filter -->
                <div class="w-52 flex-shrink-0">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">Category</label>
                    <select id="category_id" name="category_id"
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full h-11 px-3 focus:outline-none"
                        style="min-width: 125px">
                        <option value="" class="bg-gray-700">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category_id') == $category->id ? 'selected' : '' }} class="bg-gray-700">
                                {{ $category->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex-shrink-0">
                    <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">&nbsp;</label>
                    <button type="submit"
                        style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; display: inline-flex;"
                        class="px-2 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        <span>Filter</span>
                    </button>
                </div>

                <!-- Clear Button -->
                @if (request()->hasAny(['search', 'status', 'category_id', 'is_featured', 'is_active']))
                    <div class="w-52 flex-shrink-0">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-300">&nbsp;</label>
                        <a href="{{ route('admin.projects.index') }}">
                            <button type="button"
                                style="background-color: #eb5325 !important; border: 1px solid #c63b10 !important; color: #ffffff !important; display: inline-flex;"
                                class="px-1 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                <span>Clear</span>
                            </button>
                        </a>
                    </div>
                @endif
            </form>
        </div>



        <!-- Projects Table -->
        <div class="relative overflow-x-auto rounded-lg border border-gray-700">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                    <tr>
                        <th scope="col" class="px-4 py-3">Project</th>
                        <th scope="col" class="px-4 py-3">Category</th>
                        <th scope="col" class="px-4 py-3">Location</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                        <th scope="col" class="px-4 py-3">Progress</th>
                        <th scope="col" class="px-4 py-3 text-center">Featured</th>
                        <th scope="col" class="px-4 py-3 text-center">Active</th>
                        <th scope="col" class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/50 transition-colors">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if ($project->cover_image_url)
                                        <img src="{{ asset('storage/' . $project->cover_image_url) }}" alt=""
                                            class="w-10 h-10 rounded-lg object-cover border border-gray-600">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gray-700 border border-gray-600 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="font-medium text-white truncate max-w-[180px]">{{ $project->name_en }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="bg-blue-900 text-blue-300 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $project->category?->name_en ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="text-white">{{ $project->location_en ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-500">{{ $project->province ?? '' }}</div>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusColors = [
                                        'ongoing' => 'bg-yellow-900 text-yellow-300',
                                        'completed' => 'bg-green-900 text-green-300',
                                        'planned' => 'bg-purple-900 text-purple-300',
                                        'on_hold' => 'bg-red-900 text-red-300',
                                    ];
                                @endphp
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded {{ $statusColors[$project->status] ?? 'bg-gray-700 text-gray-300' }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-16 bg-gray-700 rounded-full h-1.5">
                                        <div class="bg-blue-500 h-1.5 rounded-full"
                                            style="width: {{ $project->completion_percent }}%"></div>
                                    </div>
                                    <span
                                        class="text-xs font-medium text-white">{{ $project->completion_percent }}%</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form method="POST" action="{{ route('admin.projects.toggle-featured', $project) }}"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="focus:outline-none transition-transform hover:scale-110">
                                        @if ($project->is_featured)
                                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 text-gray-500 hover:text-yellow-400 transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            {{-- <td class="px-4 py-3 text-center">
                                <form method="POST" action="{{ route('admin.projects.toggle-active', $project) }}"
                                    class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="focus:outline-none">
                                        @if ($project->is_active)
                                            <div
                                                class="flex items-center justify-center w-10 h-6 bg-green-500 rounded-full cursor-pointer">
                                                <div
                                                    class="w-4 h-4 bg-white rounded-full shadow-md transform translate-x-2">
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="flex items-center justify-center w-10 h-6 bg-gray-600 rounded-full cursor-pointer">
                                                <div
                                                    class="w-4 h-4 bg-white rounded-full shadow-md transform -translate-x-2">
                                                </div>
                                            </div>
                                        @endif
                                    </button>
                                </form>
                            </td> --}}

                            <td class="px-4 py-3 text-center whitespace-nowrap">
    <!-- Centered form flex block matching your micro-toggle blueprint layout exactly -->
    <form method="POST" action="{{ route('admin.projects.toggle-active', $project) }}" class="flex items-center justify-center w-full">
        @csrf
        @method('PATCH')

        <!-- Micro Toggle Button Interface Track -->
        <button type="submit"
            style="background-color: {{ $project->is_active ? '#2563eb' : '#4b5563' }}; width: 1.75rem; height: 1rem; flex-shrink: 0;"
            class="relative inline-flex items-center rounded-full transition-colors duration-200 ease-in-out focus:outline-none focus:ring-1 focus:ring-blue-500/40 cursor-pointer">

            <span class="sr-only">Toggle active status</span>

            <!-- Micro White Slider Dot (Width/Height: 0.7rem with perfectly tight edge offsets) -->
            <span style="width: 0.7rem; height: 0.7rem; flex-shrink: 0;"
                class="inline-block transform rounded-full bg-white shadow-sm transition-transform duration-200 ease-in-out {{ $project->is_active ? 'translate-x-[0.9rem]' : 'translate-x-[0.15rem]' }}">
            </span>
        </button>
    </form>
</td>



                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.projects.show', $project) }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
                                        title="View">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-white focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
                                        title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button type="button" data-modal-target="delete-modal-{{ $project->id }}"
                                        data-modal-toggle="delete-modal-{{ $project->id }}"
                                        class="inline-flex items-center p-2 text-sm font-medium text-red-400 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 hover:text-red-300 focus:z-10 focus:ring-2 focus:ring-red-500 transition-colors"
                                        title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Delete Modal -->
                        <div id="delete-modal-{{ $project->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-gray-800 rounded-lg shadow border border-gray-700">
                                    <button type="button" data-modal-hide="delete-modal-{{ $project->id }}"
                                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-700 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                                        <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                                            fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-400">
                                            Are you sure you want to delete <strong
                                                class="text-white">{{ $project->name_en }}</strong>?
                                        </h3>
                                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Yes, delete it
                                            </button>
                                        </form>
                                        <button data-modal-hide="delete-modal-{{ $project->id }}" type="button"
                                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-300 focus:outline-none bg-gray-700 rounded-lg border border-gray-600 hover:bg-gray-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-700">
                                            No, cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                <svg class="mx-auto w-12 h-12 text-gray-600 mb-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <p class="text-lg font-medium text-white">No projects found</p>
                                <p class="text-sm mt-1">Try adjusting your filters or add a new project.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($projects->hasPages())
            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        @endif
    </div>
@endsection
