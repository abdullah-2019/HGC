@extends('admin.layouts.app')

@section('content')

    <div class="p-6">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-white">
                Create Carousel Slide
            </h1>

            <p class="mt-1 text-sm text-gray-400">
                Add a new slide to the About page carousel.
            </p>
        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="p-4 mb-6 text-sm text-red-300 border border-red-800 rounded-lg bg-red-900/40">
                <ul class="space-y-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('admin.about.carousel.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg shadow">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                    {{-- English Title --}}
                    <div>
                        <label for="title_en" class="block mb-2 text-sm font-medium text-white">
                            Title (English)
                        </label>

                        <input type="text" id="title_en" name="title_en" value="{{ old('title_en') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>


                    {{-- Dari Title --}}
                    <div>
                        <label for="title_dari" class="block mb-2 text-sm font-medium text-white">

                            Title (Dari)
                        </label>

                        <input type="text" id="title_dari" name="title_dari" value="{{ old('title_dari') }}"
                            dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>


                    {{-- Pashto Title --}}
                    <div class="md:col-span-2">
                        <label for="title_pashto" class="block mb-2 text-sm font-medium text-white">

                            Title (Pashto)
                        </label>

                        <input type="text" id="title_pashto" name="title_pashto" value="{{ old('title_pashto') }}"
                            dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required>
                    </div>


                    {{-- English Location --}}
                    <div>
                        <label for="location_en" class="block mb-2 text-sm font-medium text-white">

                            Location (English)
                        </label>

                        <input type="text" id="location_en" name="location_en" value="{{ old('location_en') }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>


                    {{-- Dari Location --}}
                    <div>
                        <label for="location_dari" class="block mb-2 text-sm font-medium text-white">

                            Location (Dari)
                        </label>

                        <input type="text" id="location_dari" name="location_dari" value="{{ old('location_dari') }}"
                            dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>


                    {{-- Pashto Location --}}
                    <div class="md:col-span-2">
                        <label for="location_pashto" class="block mb-2 text-sm font-medium text-white">

                            Location (Pashto)
                        </label>

                        <input type="text" id="location_pashto" name="location_pashto"
                            value="{{ old('location_pashto') }}" dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    {{-- Sort Order --}}
                    <div>
                        <label for="sort_order" class="block mb-2 text-sm font-medium text-white">

                            Sort Order
                        </label>

                        <input type="number" id="sort_order" name="sort_order"
                            value="{{ old('sort_order', $lastSortOrder) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                               focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    </div>

                    {{-- Image URL --}}
                    <div class="md:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-white">
                            Image <span class="text-red-500 font-bold">*</span>
                        </label>

                        <div class="flex gap-2">
                            <input type="text" id="image_url" name="image_url" value="{{ old('image_url') }}" readonly
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                                required>
                            <button type="button" onclick="openMediaBrowser()"
                                style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color:#fff;"
                                class="px-3 py-2 text-sm font-medium rounded-lg">
                                Browse
                            </button>
                        </div>

                        {{-- Image Preview --}}
                        <div class="mt-4">
                            <div class="text-sm text-gray-400 mb-2">
                                Preview
                            </div>
                            <img id="image_preview" src=""
                                class="hidden w-64 h-40 object-cover rounded-lg border border-gray-700" alt="Preview">
                        </div>
                    </div>

                    {{-- Active --}}
                    <div class="flex items-end">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" checked
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded focus:ring-blue-500">

                            <span class="text-sm font-medium text-white ms-2">
                                Active Slide
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center gap-3">

                <button type="submit"
                    style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; display: inline-flex;"
                    class="px-3 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                    Save
                </button>

                <a href="{{ route('admin.about.carousel.index') }}">
                    <button type="button"
                        style="background-color: #ef2c4d !important; border: 1px solid #f4183c !important; color: #ffffff !important; display: inline-flex;"
                        class="px-3 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                        Cancel
                    </button>
                </a>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/form-required-markers.js') }}"></script>

    <script>
        function openMediaBrowser() {
            window.open(
                "{{ route('admin.media.browser') }}",
                "MediaBrowser",
                "width=1200,height=800"
            );
        }

        function normalizeImagePath() {
            const input = document.getElementById('image_url');
            const preview = document.getElementById('image_preview');

            if (!input.value) {
                return;
            }

            // Remove storage prefix
            input.value = input.value
                .replace(/^\/storage\/+/, '')
                .replace(/^\/+/, '');

            // Create preview
            preview.src = "/storage/" + input.value;
            preview.classList.remove('hidden');
        }

        window.addEventListener('focus', function() {
            setTimeout(function() {
                normalizeImagePath();
            }, 300);
        });
    </script>


@endsection
