@extends('admin.layouts.app')

@section('title', 'Sectors')
@section('page-title', 'Sectors')


@section('content')
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <form method="GET" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                    class="bg-gray-700 border-gray-600 rounded-lg text-white">
                <button
                    style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; min-width: 50px; display: inline-flex;"
                    class="px-2 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                    Search
                </button>
            </form>
            <a href="{{ route('admin.sectors.create') }}" class="bg-green-600 px-4 py-2 rounded-lg">
                <button
                    style="background-color: #2563eb !important; border: 1px solid #1d4ed8 !important; color: #ffffff !important; min-width: 50px; display: inline-flex;"
                    class="px-2 py-2 text-sm font-medium rounded-lg hover:bg-blue-700 active:bg-blue-800 transition-all duration-150 items-center justify-center text-center cursor-pointer shadow-md focus:outline-none">
                    Add Sector
                </button>
            </a>
        </div>
        <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
            <table class="w-full text-white">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="p-3 text-left">Image</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3">Projects</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sectors as $sector)
                        <tr class="border-t border-gray-700">
                            <td class="p-3">
                                @if ($sector->image_url)
                                    <img src="{{ $sector->image_url }}" width="60" class="rounded">
                                @endif
                            </td>
                            <td class="p-3">
                                {{ $sector->name_en }}
                            </td>
                            <td class="p-3 text-center">
                                {{ $sector->projects_count }}
                            </td>
                            <td class="p-3 text-center">
                                @if ($sector->is_active)
                                    <span class="text-green-400">
                                        Active
                                    </span>
                                @else
                                    <span class="text-red-400">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 whitespace-nowrap text-center">
                                <!-- Reduced space between icons using tight gap-1.5 -->
                                <div class="flex items-center justify-center gap-1.5">

                                    <!-- Edit Action (Small Pencil Icon Only) -->
                                    <a href="{{ route('admin.sectors.edit', $sector) }}"
                                        class="text-yellow-400 hover:text-yellow-300 transition-colors duration-150 block"
                                        title="Edit Sector">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>

                                    <!-- Delete Action (Small Trash Icon Only) -->
                                    <form method="POST" action="{{ route('admin.sectors.destroy', $sector) }}"
                                        class="inline-flex">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete sector?')"
                                            class="text-red-400 hover:text-red-300 transition-colors duration-150 focus:outline-none"
                                            title="Delete Sector">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $sectors->links() }}
    </div>
@endsection
