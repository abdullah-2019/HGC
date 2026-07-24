<div class="p-5 bg-gray-800 border border-gray-700 rounded-xl">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-white">Company Awards</h3>
        <a href="{{ route('admin.companies.awards.create', $company) }}"
           class="px-3 py-1.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
            + Add Award
        </a>
    </div>

    @if($company->awards->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-400">
                <thead class="text-xs text-gray-300 uppercase bg-gray-700">
                    <tr>
                        <th class="px-4 py-3">Icon</th>
                        <th class="px-4 py-3">Year</th>
                        <th class="px-4 py-3">Title (EN)</th>
                        <th class="px-4 py-3">Organization</th>
                        <th class="px-4 py-3">Active</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->awards as $award)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50">
                            <td class="px-4 py-3 font-mono text-xs">{{ $award->icon_name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $award->award_year ?? '-' }}</td>
                            <td class="px-4 py-3 text-white font-medium">{{ $award->title_en }}</td>
                            <td class="px-4 py-3">{{ $award->organization_en ?? '-' }}</td>
                            <td class="px-4 py-3">
                                @if($award->is_active)
                                    <span class="px-2 py-1 text-xs rounded bg-green-900 text-green-300">Yes</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-red-900 text-red-300">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right space-x-3">
                                <a href="{{ route('admin.companies.awards.edit', [$company, $award]) }}"
                                   class="text-primary-400 hover:text-primary-300 text-sm">Edit</a>
                                <form action="{{ route('admin.companies.awards.destroy', [$company, $award]) }}"
                                      method="POST" class="inline"
                                      onsubmit="return confirm('Delete this award?');">
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
        <p class="text-gray-500 text-sm">No awards found for this company.</p>
    @endif
</div>