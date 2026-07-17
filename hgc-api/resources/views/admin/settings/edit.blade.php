@extends('admin.layouts.app')

@section('title', 'Edit Setting')
@section('page-title', 'Edit Setting')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>

.ql-editor {

    min-height: 250px;

    font-size: 16px;

}


/* RTL support */
.ql-editor[dir="rtl"] {

    text-align:right;

}


/* Default toolbar direction button */
.ql-direction-rtl::before {

    content:"RTL";

    font-size:12px;

}


</style>
@section('content')

    <div class="max-w-4xl">
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
            <form action="{{ route('admin.settings.update', $siteSetting) }}" method="POST">
                @csrf
                @method('PUT')
                {{-- Description --}}
                <div class="mb-5">

                    <label class="block mb-2 text-sm text-gray-300">
                        Description
                    </label>

                    <input type="text" id="description" name="description"
                        value="{{ old('description', $siteSetting->description) }}"
                        placeholder="Example: Brand Description Dari"
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg text-white focus:ring-blue-500 focus:border-blue-500">

                    @error('description')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Setting Key --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm text-gray-300">
                        Setting Key
                    </label>
                    <input type="text" id="setting_key" name="setting_key"
                        value="{{ old('setting_key', $siteSetting->setting_key) }}" readonly
                        class="w-full bg-gray-700 border border-gray-600 rounded-lg text-gray-400 cursor-not-allowed">
                    <p class="mt-1 text-xs text-gray-500">
                        Automatically generated from description
                    </p>
                    @error('setting_key')
                        <p class="mt-1 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Type --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm text-gray-300">
                        Setting Type
                    </label>
                    <select name="setting_type" class="w-full bg-gray-700 border border-gray-600 rounded-lg text-white">
                        <option value="string" @selected($siteSetting->setting_type == 'string')>
                            String
                        </option>
                        <option value="number" @selected($siteSetting->setting_type == 'number')>
                            Number
                        </option>
                        <option value="boolean" @selected($siteSetting->setting_type == 'boolean')>
                            Boolean
                        </option>
                        <option value="json" @selected($siteSetting->setting_type == 'json')>
                            JSON
                        </option>
                        <option value="image" @selected($siteSetting->setting_type == 'image')>
                            Image
                        </option>
                    </select>
                </div>

                {{-- Value --}}
                <div class="mb-5">
                    <label class="block mb-2 text-sm text-gray-300">
                        Value
                    </label>
                    <div class="mb-5">

    <label class="block mb-2 text-sm text-gray-300">
        Value
    </label>


    {{-- Hidden field stores editor content --}}
    <input 
        type="hidden"
        name="setting_value"
        id="setting_value"
        value="{{ old('setting_value', $siteSetting->setting_value) }}"
    >


    {{-- Quill Editor --}}
    <div 
        id="editor"
        class="bg-white text-black rounded-lg"
        style="min-height:250px;"
    >
    </div>


    @error('setting_value')
        <p class="mt-1 text-sm text-red-400">
            {{ $message }}
        </p>
    @enderror

</div>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; min-width: 140px; display: inline-flex;"
                        class="px-5 py-3 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                        Update Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionInput = document.getElementById('description');
            const keyInput = document.getElementById('setting_key');

            function generateKey(value) {
                return value
                    .replace(/[^A-Za-z\s]/g, '') // only English letters
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, '_');

            }
            descriptionInput.addEventListener('input', function() {
                // clean description
                this.value = this.value.replace(/[^A-Za-z\s]/g, '');
                // generate key
                keyInput.value = generateKey(this.value);
            });
            // Run once when page loads
            keyInput.value = generateKey(descriptionInput.value);
        });
    </script>

    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    const hiddenInput = document.getElementById('setting_value');


    const quill = new Quill('#editor', {

        theme: 'snow',


        modules: {

            toolbar: [

                [
                    {
                        header: [1,2,3,false]
                    }
                ],

                [
                    'bold',
                    'italic',
                    'underline'
                ],


                [
                    {
                        align: []
                    }
                ],


                [
                    {
                        direction: 'rtl'
                    }
                ],


                [
                    'link'
                ],


                [
                    'clean'
                ]

            ]

        }


    });



    // Load existing HTML
    if(hiddenInput.value)
    {
        quill.root.innerHTML = hiddenInput.value;
    }



    // Save editor content before submit
    document.querySelector('form')
        .addEventListener('submit', function(){

            hiddenInput.value = quill.root.innerHTML;

        });


});

</script>


@endsection
