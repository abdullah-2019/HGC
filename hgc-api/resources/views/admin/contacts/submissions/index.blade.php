@extends('admin.layouts.app')

@section('title', 'Contact Submissions')
@section('page-title', 'Contact Submissions')

@section('content')
    <div x-data="{
        status: '{{ request('status', 'all') }}',
        search: '{{ request('search', '') }}',
        page: {{ request('page', 1) }},
        detailOpen: false,
        selected: null,
        adminNotes: '',
        updating: false,
    
        openDetail(submission) {
            this.selected = submission;
            this.adminNotes = submission.admin_notes || '';
            this.detailOpen = true;
            if (submission.status === 'new') {
                this.markAsRead(submission.id);
            }
        },
    
        async markAsRead(id) {
            try {
                const res = await fetch(`/admin/contacts/submissions/${id}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Accept': 'application/json',
                    }
                });
                if (!res.ok) throw new Error('Failed');
                const data = await res.json();
                this.updateSubmissionInList(data.submission);
                if (this.selected && this.selected.id === id) {
                    this.selected = data.submission;
                }
                this.showToast('Marked as read', 'success');
            } catch (e) {
                this.showToast('Failed to mark as read', 'error');
            }
        },
    
        async updateStatus(id, status) {
            this.updating = true;
            try {
                const res = await fetch(`/admin/contacts/submissions/${id}`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ status: status, admin_notes: this.adminNotes })
                });
                if (!res.ok) throw new Error('Failed');
                const data = await res.json();
                this.updateSubmissionInList(data.submission);
                this.selected = data.submission;
                this.showToast(`Status updated to ${status}`, 'success');
            } catch (e) {
                this.showToast('Failed to update status', 'error');
            } finally {
                this.updating = false;
            }
        },
    
        updateSubmissionInList(updated) {
            const idx = this.submissions.findIndex(s => s.id === updated.id);
            if (idx !== -1) {
                this.submissions[idx] = updated;
            }
        },
    
        showToast(message, type) {
            window.dispatchEvent(new CustomEvent('toast', { detail: { message, type } }));
        },
    
        formatDate(dateStr) {
            return new Date(dateStr).toLocaleString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        },
    
        getStatusConfig(status) {
            const configs = {
                new: {
                    label: 'New',
                    bg: 'bg-blue-500/10',
                    text: 'text-blue-400',
                    border: 'border-blue-500/20',
                    dot: 'bg-blue-500',
                    activeBg: 'bg-blue-500/15',
                    activeBorder: 'border-blue-500/40',
                    activeRing: 'ring-1 ring-blue-500/30'
                },
                read: {
                    label: 'Read',
                    bg: 'bg-amber-500/10',
                    text: 'text-amber-400',
                    border: 'border-amber-500/20',
                    dot: 'bg-amber-500',
                    activeBg: 'bg-amber-500/15',
                    activeBorder: 'border-amber-500/40',
                    activeRing: 'ring-1 ring-amber-500/30'
                },
                replied: {
                    label: 'Replied',
                    bg: 'bg-green-500/10',
                    text: 'text-green-400',
                    border: 'border-green-500/20',
                    dot: 'bg-green-500',
                    activeBg: 'bg-green-500/15',
                    activeBorder: 'border-green-500/40',
                    activeRing: 'ring-1 ring-green-500/30'
                },
                archived: {
                    label: 'Archived',
                    bg: 'bg-gray-500/10',
                    text: 'text-gray-400',
                    border: 'border-gray-500/20',
                    dot: 'bg-gray-400',
                    activeBg: 'bg-gray-500/15',
                    activeBorder: 'border-gray-500/40',
                    activeRing: 'ring-1 ring-gray-500/30'
                },
            };
            return configs[status] || configs.new;
        },
    
        submissions: {{ Js::from($submissions->items()) }},
        pagination: {{ Js::from([
            'current_page' => $submissions->currentPage(),
            'last_page' => $submissions->lastPage(),
            'total' => $submissions->total(),
            'per_page' => $submissions->perPage(),
            'from' => $submissions->firstItem(),
            'to' => $submissions->lastItem(),
        ]) }},
        counts: {{ Js::from($counts) }},
    }" class="space-y-5">

        <!-- ===== STATUS TABS ===== -->
        <div class="flex items-center justify-between">
            <div class="inline-flex items-center p-1 rounded-xl bg-gray-800 border border-gray-700">
                <!-- All -->
                <a :href="`/admin/contacts/submissions?search=${search}`"
                    class="group flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
                    :class="status === 'all'
                        ?
                        'bg-gray-700 text-white shadow-sm' :
                        'text-gray-400 hover:text-white hover:bg-gray-700/50'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <span>All</span>
                    <span class="min-w-[22px] h-5 px-1.5 rounded-md flex items-center justify-center text-xs font-semibold"
                        :class="status === 'all' ? 'bg-gray-600 text-white' : 'bg-gray-700 text-gray-300'"
                        x-text="counts.all">
                    </span>
                </a>
                <!-- New -->
                <a :href="`/admin/contacts/submissions?status=new&search=${search}`"
                    class="group flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
                    :class="status === 'new'
                        ?
                        'bg-blue-500/15 text-blue-300' :
                        'text-gray-400 hover:text-white hover:bg-gray-700/50'">
                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M22 13V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h9" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        <path d="M19 16v6M16 19h6" />
                    </svg>
                    <span>New</span>
                    <span class="min-w-[22px] h-5 px-1.5 rounded-md flex items-center justify-center text-xs font-semibold"
                        :class="status === 'new' ? 'bg-blue-500/20 text-blue-300' : 'bg-gray-700 text-gray-300'"
                        x-text="counts.new">
                    </span>
                </a>
                <!-- Read -->
                <a :href="`/admin/contacts/submissions?status=read&search=${search}`"
                    class="group flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
                    :class="status === 'read'
                        ?
                        'bg-amber-500/15 text-amber-300' :
                        'text-gray-400 hover:text-white hover:bg-gray-700/50'">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M2 10v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V10" />
                        <path d="m22 10-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 10" />
                        <path d="m2 10 10-8 10 8" />
                    </svg>
                    <span>Read</span>
                    <span class="min-w-[22px] h-5 px-1.5 rounded-md flex items-center justify-center text-xs font-semibold"
                        :class="status === 'read' ? 'bg-amber-500/20 text-amber-300' : 'bg-gray-700 text-gray-300'"
                        x-text="counts.read">
                    </span>
                </a>
                <!-- Replied -->
                <a :href="`/admin/contacts/submissions?status=replied&search=${search}`"
                    class="group flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
                    :class="status === 'replied'
                        ?
                        'bg-green-500/15 text-green-300' :
                        'text-gray-400 hover:text-white hover:bg-gray-700/50'">
                    <span class="w-2 h-2 rounded-full bg-green-500"></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M10 20H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v6" />
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        <path d="M13 18h6a3 3 0 0 0 3-3v-1M13 18l3-3m-3 3l3 3" />
                    </svg>
                    <span>Replied</span>
                    <span class="min-w-[22px] h-5 px-1.5 rounded-md flex items-center justify-center text-xs font-semibold"
                        :class="status === 'replied' ? 'bg-green-500/20 text-green-300' : 'bg-gray-700 text-gray-300'"
                        x-text="counts.replied">
                    </span>
                </a>
                <!-- Archived -->
                <a :href="`/admin/contacts/submissions?status=archived&search=${search}`"
                    class="group flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all"
                    :class="status === 'archived'
                        ?
                        'bg-gray-600/30 text-gray-200' :
                        'text-gray-400 hover:text-white hover:bg-gray-700/50'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M21 8H3V4h18v4z" />
                        <path d="M10 12h4" />
                        <path d="M4 8v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8" />
                    </svg>
                    <span>Archived</span>
                    <span class="min-w-[22px] h-5 px-1.5 rounded-md flex items-center justify-center text-xs font-semibold"
                        :class="status === 'archived' ? 'bg-gray-600 text-white' : 'bg-gray-700 text-gray-300'"
                        x-text="counts.archived">
                    </span>
                </a>
            </div>
        </div>

        <br>

        <!-- ====== FILTERS BAR - FIXED ICON POSITIONING ====== -->
        <div class="flex flex-row items-center gap-3 w-full">

            <!-- Status Dropdown -->
            <form method="GET" action="{{ route('admin.contacts.submissions') }}" class="shrink-0">
                <input type="hidden" name="search" x-model="search">

                <div class="relative flex items-center">
                    <!-- FIX: Added bg-no-repeat, bg-right, and pr-8 to natively position ONE clean dropdown arrow -->
                    <select name="status" x-model="status" @change="$el.closest('form').submit()"
                        class="appearance-none w-40 h-10 pl-3 pr-8 bg-gray-800 border border-gray-700 rounded-lg text-sm text-white focus:outline-none focus:ring-2 focus:ring-blue-500/40 cursor-pointer bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20fill%3D%22none%22%20viewBox%3D%220%200%2024%2024%20%22%20stroke%3D%22%236b7280%22%20stroke-width%3D%222%22%3E%3Cpath%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%20d%3D%22M19.5%208.25l-7.5%207.5-7.5-7.5%22%2F%3E%3C%2Fsvg%3E')] bg-[length:1rem_1rem] bg-[right_0.75rem_center] bg-no-repeat">
                        <option value="all">All Status</option>
                        <option value="new">New</option>
                        <option value="read">Read</option>
                        <option value="replied">Replied</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
            </form>

            <!-- Search Bar -->
            <form method="GET" action="{{ route('admin.contacts.submissions') }}"
                class="flex-1 relative flex items-center">
                <input type="hidden" name="status" x-model="status">

                <!-- Search Icon (Perfectly padded and click-through) -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.65 6.65a7.5 7.5 0 0 0 10 10Z" />
                    </svg>
                </div>

                <!-- FIX: Padded to pl-9 and pr-9 to eliminate massive empty spaces -->
                <input type="text" name="search" x-model="search" placeholder="Search by name, email, subject..."
                    class="block w-full h-10 pl-9 pr-9 bg-gray-800 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/40">

                <!-- Clear Button -->
                <button type="button" x-show="search" x-cloak @click="search=''; $el.closest('form').submit()"
                    class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <svg class="w-4 h-4 text-gray-500 hover:text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </form>
        </div>


        <br>

        <!-- ====== DESKTOP TABLE (Datatable Style) ====== -->
        <div class="hidden md:block rounded-lg border border-gray-700/50 bg-gray-800/40 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-800/80 border-b border-gray-700/50">
                        <tr>
                            <th scope="col" class="px-5 py-3 font-semibold">Status</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Name</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Email</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Subject</th>
                            <th scope="col" class="px-5 py-3 font-semibold">Date</th>
                            <th scope="col" class="px-5 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        <template x-if="submissions.length === 0">
                            <tr>
                                <td colspan="6" class="px-5 py-14 text-center">
                                    <p class="text-gray-500 font-medium">No submissions found</p>
                                    <p class="text-gray-600 text-xs mt-1">Try adjusting your filters</p>
                                </td>
                            </tr>
                        </template>
                        <template x-for="submission in submissions" :key="submission.id">
                            <tr @click="openDetail(submission)" class="transition-colors cursor-pointer"
                                :class="submission.status === 'new' ?
                                    'bg-blue-500/[0.02] hover:bg-blue-500/[0.05]' :
                                    'hover:bg-gray-700/20'">
                                <td class="px-5 py-3.5">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border"
                                        :class="[getStatusConfig(submission.status).bg, getStatusConfig(submission.status).text,
                                            getStatusConfig(submission.status).border
                                        ]">
                                        <span class="w-1.5 h-1.5 rounded-full"
                                            :class="getStatusConfig(submission.status).dot"></span>
                                        <span x-text="getStatusConfig(submission.status).label"></span>
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 font-medium text-white" x-text="submission.name"></td>
                                <td class="px-5 py-3.5 text-gray-400" x-text="submission.email"></td>
                                <td class="px-5 py-3.5 text-gray-300 max-w-xs truncate" x-text="submission.subject"></td>
                                <td class="px-5 py-3.5 text-gray-500 whitespace-nowrap text-xs"
                                    x-text="formatDate(submission.created_at)"></td>
                                <td class="px-5 py-3.5 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <button x-show="submission.status === 'new'" x-cloak
                                            @click.stop="markAsRead(submission.id)"
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 rounded transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                            Mark read
                                        </button>
                                        <button
                                            class="p-1.5 text-gray-500 hover:text-white hover:bg-gray-700 rounded transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ====== MOBILE CARDS ====== -->
        <div class="md:hidden space-y-3">
            <template x-if="submissions.length === 0">
                <div class="rounded-lg border border-gray-700/50 bg-gray-800/40 p-8 text-center">
                    <p class="text-gray-500 font-medium">No submissions found</p>
                    <p class="text-gray-600 text-xs mt-1">Try adjusting your filters</p>
                </div>
            </template>
            <template x-for="submission in submissions" :key="submission.id">
                <div @click="openDetail(submission)"
                    class="rounded-lg border p-4 cursor-pointer transition-all duration-200 hover:shadow-md active:scale-[0.99]"
                    :class="submission.status === 'new' ?
                        'border-blue-500/20 bg-blue-500/[0.02]' :
                        'border-gray-700/50 bg-gray-800/40 hover:bg-gray-800/60'">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="w-2 h-2 rounded-full flex-shrink-0 mt-1.5"
                                :class="getStatusConfig(submission.status).dot"></span>
                            <div class="min-w-0">
                                <p class="font-medium text-sm text-white truncate" x-text="submission.name"></p>
                                <p class="text-xs text-gray-500 truncate" x-text="submission.email"></p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-500 whitespace-nowrap flex-shrink-0"
                            x-text="formatDate(submission.created_at)"></span>
                    </div>
                    <p class="mt-2.5 text-sm font-medium text-gray-200" x-text="submission.subject"></p>
                    <p class="mt-1 text-xs text-gray-500 line-clamp-2 leading-relaxed" x-text="submission.message"></p>
                    <div x-show="submission.status === 'new'" x-cloak class="mt-3 flex gap-2">
                        <button @click.stop="markAsRead(submission.id)"
                            class="inline-flex items-center px-2.5 py-1 text-xs font-medium text-blue-400 bg-blue-500/10 border border-blue-500/20 rounded hover:bg-blue-500/20 transition-colors">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            Mark read
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- ====== PAGINATION ====== -->
        <div x-show="pagination.last_page > 1" class="flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Showing <span class="text-gray-300 font-medium" x-text="pagination.from || 0"></span> to <span
                    class="text-gray-300 font-medium" x-text="pagination.to || 0"></span> of <span
                    class="text-gray-300 font-medium" x-text="pagination.total"></span>
            </p>
            <div class="flex items-center gap-1.5">
                <a :href="`/admin/contacts/submissions?page=${pagination.current_page - 1}&status=${status === 'all' ? '' : status}&search=${search}`"
                    :class="pagination.current_page <= 1 ? 'pointer-events-none opacity-40' : ''"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Prev
                </a>
                <span
                    class="text-sm text-gray-400 px-3 py-2 bg-gray-800/50 rounded-lg border border-gray-700/50 font-medium">
                    <span x-text="pagination.current_page"></span> / <span x-text="pagination.last_page"></span>
                </span>
                <a :href="`/admin/contacts/submissions?page=${pagination.current_page + 1}&status=${status === 'all' ? '' : status}&search=${search}`"
                    :class="pagination.current_page >= pagination.last_page ? 'pointer-events-none opacity-40' : ''"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
                    Next
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- ====== DETAIL MODAL ====== -->
        <div x-show="detailOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" @click="detailOpen = false"></div>

            <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-gray-800 border border-gray-700 rounded-xl shadow-2xl"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                <template x-if="selected">
                    <div class="p-6 space-y-5">
                        <!-- Header -->
                        <div class="flex items-start justify-between pb-4 border-b border-gray-700/50">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 mb-2 flex-wrap">
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border"
                                        :class="[getStatusConfig(selected.status).bg, getStatusConfig(selected.status).text,
                                            getStatusConfig(selected.status).border
                                        ]">
                                        <span class="w-1.5 h-1.5 rounded-full"
                                            :class="getStatusConfig(selected.status).dot"></span>
                                        <span x-text="getStatusConfig(selected.status).label"></span>
                                    </span>
                                    <span class="text-xs text-gray-500 font-mono bg-gray-700/50 px-2 py-0.5 rounded"
                                        x-text="'#' + selected.id"></span>
                                </div>
                                <h3 class="text-lg font-bold text-white" x-text="selected.subject"></h3>
                                <p class="text-sm text-gray-500 mt-1"
                                    x-text="'Received on ' + formatDate(selected.created_at)"></p>
                            </div>
                            <button @click="detailOpen = false"
                                class="flex-shrink-0 p-2 text-gray-500 hover:text-white hover:bg-gray-700 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- Sender Info -->
                        <div class="rounded-lg border border-gray-700/50 bg-gray-700/20 p-4 space-y-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-white" x-text="selected.name"></p>
                                    <p class="text-sm text-gray-400" x-text="selected.email"></p>
                                </div>
                            </div>
                            <div x-show="selected.phone" class="flex items-center gap-2 text-sm text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                <span x-text="selected.phone"></span>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-300 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                </svg>
                                Message
                            </h4>
                            <div class="rounded-lg border border-gray-700/50 bg-gray-900/30 p-4">
                                <p class="text-sm text-gray-300 whitespace-pre-wrap leading-relaxed"
                                    x-text="selected.message"></p>
                            </div>
                        </div>

                        <!-- Admin Notes -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-300 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                Admin Notes
                            </h4>
                            <textarea x-model="adminNotes" rows="3" placeholder="Add internal notes about this submission..."
                                class="block w-full px-4 py-3 bg-gray-900/30 border border-gray-700/50 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500/40 resize-none transition-all"></textarea>
                        </div>

                        <!-- Status Actions -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-300 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Update Status
                            </h4>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="s in ['new','read','replied','archived']" :key="s">
                                    <button @click="updateStatus(selected.id, s)"
                                        :disabled="updating || selected.status === s"
                                        class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium rounded-lg border transition-all disabled:opacity-40 disabled:cursor-not-allowed"
                                        :class="selected.status === s ?
                                            'bg-blue-600 text-white border-blue-500' : [getStatusConfig(s).bg,
                                                getStatusConfig(s).text, getStatusConfig(s).border,
                                                'hover:bg-gray-700/50'
                                            ]">
                                        <span x-show="updating && selected.status !== s"
                                            class="w-3.5 h-3.5 border-2 border-current border-t-transparent rounded-full animate-spin"></span>
                                        <span x-text="getStatusConfig(s).label"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        <div x-show="selected.read_at"
                            class="text-xs text-gray-500 flex items-center gap-1.5 pt-2 border-t border-gray-700/50">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            Read at <span x-text="formatDate(selected.read_at)"></span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
@endsection
