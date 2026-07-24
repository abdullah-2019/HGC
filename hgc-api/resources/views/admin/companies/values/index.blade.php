<div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-white">Company Values</h3>
        <a href="{{ route('admin.companies.values.create', $company) }}"
           class="px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            + Add Value
        </a>
    </div>

    @if($company->values->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                    <tr>
                        <th class="px-4 py-3">Icon</th>
                        <th class="px-4 py-3">Title (EN)</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Order</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->values as $value)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                            <td class="px-4 py-3 font-mono text-xs">{{ $value->icon_name }}</td>
                            <td class="px-4 py-3 text-white font-medium">{{ $value->title_en }}</td>
                            <td class="px-4 py-3 truncate max-w-xs">{{ Str::limit($value->description_en, 60) }}</td>
                            <td class="px-4 py-3">{{ $value->sort_order }}</td>
                            <td class="px-4 py-3 text-right space-x-3">
                                <a href="{{ route('admin.companies.values.edit', [$company, $value]) }}"
                                   class="text-primary-400 hover:text-primary-300 text-sm">Edit</a>
                                <form action="{{ route('admin.companies.values.destroy', [$company, $value]) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Delete this value?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500 text-sm">No values found for this company.</p>
    @endif
</div>