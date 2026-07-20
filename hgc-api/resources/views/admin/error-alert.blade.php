@if ($errors->any())
    <div class="flex p-4 mb-5 text-sm rounded-xl bg-gray-800 border border-red-800/80 text-red-400 shadow-lg" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px] text-red-500" aria-hidden="true" xmlns="http://w3.org" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 3 0v5a1.5 1.5 0 0 1-3 0V4Zm1 9a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5Z" />
        </svg>
        <div>
            <span class="font-bold tracking-wide block mb-1 text-red-400">Please correct the following errors:</span>
            <ul class="mt-1.5 list-disc list-inside space-y-1 text-xs text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
