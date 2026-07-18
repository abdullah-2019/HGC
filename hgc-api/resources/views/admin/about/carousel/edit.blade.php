@extends('admin.layouts.app')

@section('content')

    <div class="p-6">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-white">
                Edit Carousel Slide
            </h1>

            <p class="mt-1 text-sm text-gray-400">
                Update About page carousel slide.
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



        <form action="{{ route('admin.about.carousel.update', $slide->id) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')


            <div class="p-6 bg-gray-800 border border-gray-700 rounded-lg shadow">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- English Title --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium text-white">

                            Title (English)

                        </label>


                        <input type="text" name="title_en" value="{{ old('title_en', $slide->title_en) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>

                    </div>



                    {{-- Dari Title --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium text-white">

                            Title (Dari)

                        </label>


                        <input type="text" name="title_dari" value="{{ old('title_dari', $slide->title_dari) }}"
                            dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>

                    </div>



                    {{-- Pashto Title --}}
                    <div class="md:col-span-2">

                        <label class="block mb-2 text-sm font-medium text-white">

                            Title (Pashto)

                        </label>


                        <input type="text" name="title_pashto" value="{{ old('title_pashto', $slide->title_pashto) }}"
                            dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                            required>

                    </div>



                    {{-- English Location --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium text-white">

                            Location (English)

                        </label>


                        <input type="text" name="location_en" value="{{ old('location_en', $slide->location_en) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">

                    </div>



                    {{-- Dari Location --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium text-white">

                            Location (Dari)

                        </label>


                        <input type="text" name="location_dari" value="{{ old('location_dari', $slide->location_dari) }}"
                            dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">

                    </div>



                    {{-- Pashto Location --}}
                    <div class="md:col-span-2">

                        <label class="block mb-2 text-sm font-medium text-white">

                            Location (Pashto)

                        </label>


                        <input type="text" name="location_pashto"
                            value="{{ old('location_pashto', $slide->location_pashto) }}" dir="rtl"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">

                    </div>



                    {{-- Sort Order --}}
                    <div>

                        <label class="block mb-2 text-sm font-medium text-white">

                            Sort Order

                        </label>


                        <input type="number" name="sort_order" value="{{ old('sort_order', $slide->sort_order) }}"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5">

                    </div>


                    {{-- Image --}}
                    <div class="md:col-span-2">

                        <label class="block mb-2 text-sm font-medium text-white">

                            Image <span class="text-red-500 font-bold">*</span>

                        </label>


                        <div class="flex gap-2">

                            <input type="text" id="image_url" name="image_url"
                                value="{{ old('image_url', $slide->image_url) }}" readonly
                                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg block w-full p-2.5"
                                required>


                            <button type="button" onclick="openMediaBrowser()"
                                style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important;"
                                class="px-3 py-2 text-sm font-medium rounded-lg hover:bg-blue-700">

                                Browse

                            </button>

                        </div>


                        <div class="mt-4">

                            <img id="image_preview" src="{{ asset('storage/' . ltrim($slide->image_url, '/')) }}"
                                class="w-64 h-40 object-cover rounded-lg border border-gray-700">

                        </div>

                    </div>


                    {{-- Active --}}
                    <div class="flex items-end">
                        <label class="inline-flex items-center cursor-pointer">
                            <!-- Sends '0' if the checkbox is unchecked -->
                            <input type="hidden" name="is_active" value="0">

                            <!-- Sends '1' if the checkbox is checked -->
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $slide->is_active) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 bg-gray-700 border-gray-600 rounded">

                            <span class="text-sm font-medium text-white ms-2">
                                Active Slide
                            </span>
                        </label>
                    </div>



                </div>

            </div>



            {{-- Actions --}}
            <div class="flex items-center gap-3">


                <button type="submit" style="background-color: #2563eb !important; color:white;"
                    class="px-3 py-2 text-sm font-medium rounded-lg">

                    Update

                </button>



                <a href="{{ route('admin.about.carousel.index') }}">

                    <button type="button" style="background-color:#ef2c4d !important;color:white;"
                        class="px-3 py-2 text-sm font-medium rounded-lg">

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
            if (!input.value) {
                return;
            }
            input.value = input.value
                .replace(/^\/storage\/+/, '')
                .replace(/^\/+/, '');
        }
        window.addEventListener('focus', normalizeImagePath);

        window.addEventListener('focus', function() {
            let input = document.getElementById('image_url');
            let preview = document.getElementById('image_preview');
            if (input.value) {
                preview.src =
                    '/storage/' + input.value.replace(/^\/+/, '');
            }
        });
    </script>


@endsection
