@extends('admin.layouts.app')

@section('content')
    <div class="p-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between mb-6">

            <div>
                <h1 class="text-2xl font-semibold text-white">
                    About Carousel Slides
                </h1>

                <p class="mt-1 text-sm text-gray-400">
                    Manage about page carousel slides.
                </p>
            </div>


            <a href="{{ route('admin.about.carousel.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white 
                  bg-blue-600 rounded-lg hover:bg-blue-700 
                  focus:ring-4 focus:ring-blue-800">

                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>

                Add Slide

            </a>

        </div>

        {{-- Table Card --}}
        <div class="relative overflow-hidden bg-gray-800 
                border border-gray-700 rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-400">
                    <thead class="text-xs uppercase bg-gray-700 text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Order
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($slides as $slide)
                            <tr
                                class="border-b bg-gray-800 
                               border-gray-700 
                               hover:bg-gray-700">

                                {{-- Image --}}
                                <td class="px-6 py-4">

                                    @if ($slide->image_url)
                                        <img src="{{ asset('storage/' . ltrim($slide->image_url, '/')) }}" alt="{{ $slide->title_en }}"
                                            class="w-32 h-20 object-cover rounded-lg border border-gray-700">
                                    @else
                                        <div
                                            class="flex items-center justify-center 
                                            w-32 h-20 
                                            bg-gray-700 rounded-lg">

                                            <span class="text-xs text-gray-400">
                                                No Image
                                            </span>

                                        </div>
                                    @endif
                                </td>
                                {{-- Title --}}
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">
                                        {{ $slide->title_en }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $slide->title_dari }}
                                    </div>
                                </td>
                                {{-- Location --}}
                                <td class="px-6 py-4 text-gray-300">
                                    <div>
                                        {{ $slide->location_en }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $slide->location_dari }}
                                    </div>
                                </td>
                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    @if ($slide->is_active)
                                        <span
                                            class="inline-flex items-center 
                                             px-2.5 py-0.5 
                                             rounded-full 
                                             text-xs font-medium
                                             bg-green-900 
                                             text-green-300">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center 
                                             px-2.5 py-0.5 
                                             rounded-full 
                                             text-xs font-medium
                                             bg-gray-700 
                                             text-gray-300">
                                            Disabled
                                        </span>
                                    @endif
                                </td>
                                {{-- Sort --}}
                                <td class="px-6 py-4 text-gray-300">
                                    {{ $slide->sort_order }}
                                </td>
                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center gap-2">

                                        <!-- Edit Action (Small Pencil Icon Only) -->
                                        <a href="{{ route('admin.about.carousel.edit', $slide) }}"
                                            class="text-yellow-400 hover:text-yellow-300 transition-colors duration-150 block"
                                            title="Edit Slide">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Action (Small Trash Icon Only) -->
                                        <form action="{{ route('admin.about.carousel.destroy', $slide) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this slide?')"
                                            class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-400 hover:text-red-300 transition-colors duration-150 focus:outline-none"
                                                title="Delete Slide">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr class="bg-gray-800">
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    No carousel slides found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
