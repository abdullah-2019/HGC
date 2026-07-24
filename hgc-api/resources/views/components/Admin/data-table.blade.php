<div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-400">
        <thead class="text-xs text-gray-400 uppercase bg-gray-700/50">
            <tr>
                @foreach ($headers as $header)
                    <th scope="col" class="px-6 py-3">{{ $header }}</th>
                @endforeach
                <th scope="col" class="px-6 py-3 text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr class="bg-gray-800 border-b border-gray-700 hover:bg-gray-700/50">
                    @foreach ($columns as $column)
                        <td class="px-6 py-4">
                            @if ($column === 'logo_url' || $column === 'logo_path')
                                @php
                                    $logoPath = $item->getRawOriginal('logo_url') ?? $item->getRawOriginal('logo_path');
                                @endphp
                                @if ($logoPath)
                                    @if (str_starts_with($logoPath, 'http'))
                                        <img src="{{ $logoPath }}" alt="Logo"
                                            class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo"
                                            class="w-10 h-10 rounded-lg object-cover">
                                    @endif
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-gray-700 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            @elseif($column === 'is_active')
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $item->$column ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                                    {{ $item->$column ? 'Active' : 'Inactive' }}
                                </span>
                            @elseif($column === 'name_en')
                                <div>
                                    <div class="font-medium text-white">{{ $item->$column }}</div>
                                    @if ($item->name_dari)
                                        <div class="text-xs text-gray-500 mt-0.5" dir="rtl">{{ $item->name_dari }}
                                        </div>
                                    @endif
                                    @if ($item->name_pashto)
                                        <div class="text-xs text-gray-500 mt-0.5" dir="rtl">
                                            {{ $item->name_pashto }}</div>
                                    @endif
                                </div>
                            @elseif($column === 'sector_en')
                                <div>
                                    <div>{{ $item->$column }}</div>
                                    @if ($item->sector_dari)
                                        <div class="text-xs text-gray-500 mt-0.5" dir="rtl">
                                            {{ $item->sector_dari }}</div>
                                    @endif
                                    @if ($item->sector_pashto)
                                        <div class="text-xs text-gray-500 mt-0.5" dir="rtl">
                                            {{ $item->sector_pashto }}</div>
                                    @endif
                                </div>
                            @else
                                {{ $item->$column }}
                            @endif
                        </td>
                    @endforeach
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-0">
                            <a href="{{ route($editRoute, $item) }}"
                                class="p-2 text-blue-400 hover:text-blue-300 hover:bg-blue-900/30 rounded-lg transition-colors"
                                title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route($deleteRoute, $item) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 text-red-400 hover:text-red-300 hover:bg-red-900/30 rounded-lg transition-colors"
                                    title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($headers) + 1 }}" class="px-6 py-8 text-center text-gray-500">
                        No records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
