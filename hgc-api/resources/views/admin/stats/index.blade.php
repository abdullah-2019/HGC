@extends('admin.layouts.app')

@section('title', 'Statistics')

@section('page-title', 'Statistics')

@section('content')
    <div class="p-4">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-300 dark:text-white">
                    Statistics
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Manage website statistics and counters.
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Key
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Value
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>

                            <th scope="col" class="px-6 py-3 text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($stats as $stat)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">

                                {{-- Key --}}
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ Str::headline($stat->key) }}
                                </td>

                                {{-- value --}}
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $stat->value . ' ' . $stat->suffix }}
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    @if ($stat->is_active)
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-md">
                                            Active
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-md">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex items-center justify-center">
                                        <!-- Edit Action Icon Only -->
                                        <a href="{{ route('admin.stats.edit', $stat) }}"
                                            class="text-yellow-400 hover:text-yellow-300 transition-colors duration-150 block"
                                            title="Edit Stat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>


                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                    No statistics found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($stats->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $stats->links() }}
                </div>
            @endif

        </div>
    </div>
@endsection
