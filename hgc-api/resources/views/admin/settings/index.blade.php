@extends('admin.layouts.app')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')
    <div class="space-y-6">
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-4">
            <form method="GET" action="{{ route('admin.settings.index') }}" class="flex flex-wrap gap-3">
                <div class="flex-1 min-w-[250px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search settings..."
                        class="w-full rounded-lg border border-gray-600 bg-gray-700 text-white">
                </div>
            </form>
        </div>
        <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="bg-gray-700 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Value</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings as $setting)
                            <tr class="border-b border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $setting->description }}
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">
                                    {{ Str::limit($setting->setting_value, 80) }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <!-- Reduced space between icons using gap-1.5 -->
                                    <div class="flex items-center justify-center gap-1.5">

                                        <!-- View Action (Small Eye Icon Only) -->
                                        <a href="{{ route('admin.settings.show', $setting) }}"
                                            class="text-blue-400 hover:text-blue-300 transition-colors duration-150 block"
                                            title="View Details">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        <!-- Edit Action (Small Pencil Icon Only) -->
                                        <a href="{{ route('admin.settings.edit', $setting) }}"
                                            class="text-yellow-400 hover:text-yellow-300 transition-colors duration-150 block"
                                            title="Edit Properties">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <!-- Delete Action (Small Trash Icon Only) -->
                                        <form method="POST" action="{{ route('admin.settings.destroy', $setting) }}"
                                            onsubmit="return confirm('Delete this setting?')" class="inline-flex">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-400 hover:text-red-300 transition-colors duration-150 focus:outline-none"
                                                title="Remove Parameter">
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
                            <tr>
                                <td colspan="3" class="text-center py-6 text-gray-400">
                                    No settings found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $settings->links() }}
            </div>
        </div>
    </div>
@endsection
