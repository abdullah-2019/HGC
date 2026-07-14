@props(['type' => 'info', 'message', 'dismissible' => true])

@php
$classes = match($type) {
    'success' => 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400',
    'error'   => 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400',
    'warning' => 'text-yellow-800 bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400',
    'info'    => 'text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400',
    default   => 'text-gray-800 bg-gray-50 dark:bg-gray-800 dark:text-gray-400',
};

$btnClasses = match($type) {
    'success' => 'bg-green-50 text-green-500 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700',
    'error'   => 'bg-red-50 text-red-500 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700',
    'warning' => 'bg-yellow-50 text-yellow-500 hover:bg-yellow-200 dark:bg-gray-800 dark:text-yellow-400 dark:hover:bg-gray-700',
    'info'    => 'bg-blue-50 text-blue-500 hover:bg-blue-200 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700',
    default   => 'bg-gray-50 text-gray-500 hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700',
};

$iconColors = match($type) {
    'success' => 'text-green-500',
    'error'   => 'text-red-500',
    'warning' => 'text-yellow-500',
    'info'    => 'text-blue-500',
    default   => 'text-gray-500',
};
@endphp

<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-4"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-4"
    class="flex items-center p-4 mb-4 rounded-lg {{ $classes }} {{ $attributes->get('class') }}"
    role="alert"
>
    {{-- Icon --}}
    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg {{ $iconColors }}">
        @switch($type)
            @case('success')
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                </svg>
                @break
            @case('error')
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                </svg>
                @break
            @case('warning')
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                </svg>
                @break
            @default
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
        @endswitch
    </div>

    {{-- Message --}}
    <div class="ml-3 text-sm font-medium">{{ $message }}</div>

    {{-- Dismiss Button --}}
    @if($dismissible)
        <button 
            @click="show = false" 
            type="button" 
            class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 p-1.5 inline-flex items-center justify-center h-8 w-8 {{ $btnClasses }}"
            aria-label="Close"
        >
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    @endif
</div>