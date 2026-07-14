<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-white">{{ $title }}</h1>
        @if($subtitle)
            <p class="mt-1 text-sm text-gray-400">{{ $subtitle }}</p>
        @endif
    </div>
    @if($createRoute)
        <a href="{{ $createRoute }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            {{ $createLabel ?? 'Add New' }}
        </a>
    @endif
</div>