<!DOCTYPE html>
<html>

<head>
    <title>Media Browser</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-900 text-white p-6">

    <h1 class="text-2xl font-bold mb-6">
        Media Browser
    </h1>

    @if ($relativePath)
        @php
            $parent = dirname($relativePath);

            if ($parent === '.') {
                $parent = '';
            }
        @endphp

        <a href="{{ route('admin.media.browser', ['path' => $parent]) }}"
            class="inline-block mb-6 px-4 py-2 bg-gray-700 rounded hover:bg-gray-600">
            ← Back
        </a>
    @endif


    <h2 class="text-lg font-semibold mb-4">
        Folders
    </h2>

    <div class="grid grid-cols-4 gap-4 mb-8">

        @foreach ($folders as $folder)
            <a href="{{ route('admin.media.browser', ['path' => $folder['path']]) }}"
                class="p-4 bg-gray-800 rounded border border-gray-700 hover:bg-gray-700">
                📁 {{ $folder['name'] }}
            </a>
        @endforeach

    </div>


    <h2 class="text-lg font-semibold mb-4">
        Images
    </h2>

    <div class="grid grid-cols-4 gap-4">

        @foreach ($images as $image)
            <div class="bg-gray-800 border border-gray-700 rounded overflow-hidden cursor-pointer hover:border-blue-500"
                onclick="selectImage('{{ $image['url'] }}')">
                <img src="{{ $image['url'] }}" class="w-full h-40 object-cover">

                <div class="p-2 text-xs">
                    {{ $image['name'] }}
                </div>
            </div>
        @endforeach

    </div>


    <script>
        function selectImage(path) {
            if (window.opener) {

                window.opener.document
                    .getElementById('image_url')
                    .value = path;

                window.close();
            }
        }
    </script>

</body>

</html>
