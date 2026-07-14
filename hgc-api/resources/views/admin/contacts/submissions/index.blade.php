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
            month: 'short', day: 'numeric', year: 'numeric',
            hour: '2-digit', minute: '2-digit'
        });
    },

    getStatusConfig(status) {
        const configs = {
            new: { label: 'New', bg: 'bg-blue-500/10', text: 'text-blue-400', border: 'border-blue-500/20', dot: 'bg-blue-500' },
            read: { label: 'Read', bg: 'bg-amber-500/10', text: 'text-amber-400', border: 'border-amber-500/20', dot: 'bg-amber-500' },
            replied: { label: 'Replied', bg: 'bg-green-500/10', text: 'text-green-400', border: 'border-green-500/20', dot: 'bg-green-500' },
            archived: { label: 'Archived', bg: 'bg-gray-500/10', text: 'text-gray-400', border: 'border-gray-500/20', dot: 'bg-gray-500' },
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
}" class="space-y-6">

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
        <template x-for="s in ['all','new','read','replied','archived']" :key="s">
            <a :href="`/admin/contacts/submissions?status=${s === 'all' ? '' : s}&search=${search}`"
               class="flex items-center gap-3 rounded-lg border p-3 transition-all hover:shadow-md"
               :class="status === (s === 'all' ? 'all' : s) 
                   ? 'border-primary-500 bg-primary-500/10 ring-1 ring-primary-500' 
                   : 'border-gray-700 bg-gray-800 hover:bg-gray-700'">
                <div class="rounded-md p-2"
                     :class="s === 'all' ? 'bg-gray-700' : getStatusConfig(s).bg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         :class="s === 'all' ? 'text-gray-300' : getStatusConfig(s).text">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-white leading-none" x-text="counts[s] || 0"></p>
                    <p class="text-xs text-gray-400 mt-1 capitalize" x-text="s"></p>
                </div>
            </a>
        </template>
    </div>

    <!-- Filters -->
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
        <form method="GET" action="{{ route('admin.contacts.submissions') }}" class="relative flex-1 max-w-md">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="search" x-model="search"
                   placeholder="Search by name, email, subject..."
                   class="w-full pl-10 pr-10 py-2 bg-gray-800 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
            <button type="button" x-show="search" x-cloak @click="search = ''; $el.closest('form').submit()"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </form>
        <form method="GET" action="{{ route('admin.contacts.submissions') }}" class="flex items-center gap-2">
            <input type="hidden" name="search" x-model="search">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
            </svg>
            <select name="status" x-model="status" @change="$el.closest('form').submit()"
                    class="py-2 px-3 bg-gray-800 border border-gray-700 rounded-lg text-sm text-white focus:outline-none focus:ring-2 focus:ring-primary-500">
                <option value="all">All Status</option>
                <option value="new">New</option>
                <option value="read">Read</option>
                <option value="replied">Replied</option>
                <option value="archived">Archived</option>
            </select>
        </form>
    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block rounded-lg border border-gray-700 bg-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-700 bg-gray-800/50">
                        <th class="px-4 py-3 text-left font-medium text-gray-400">Status</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-400">Name</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-400">Email</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-400">Subject</th>
                        <th class="px-4 py-3 text-left font-medium text-gray-400">Date</th>
                        <th class="px-4 py-3 text-right font-medium text-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="submissions.length === 0">
                        <tr>
                            <td colspan="6" class="px-4 py-12 text-center text-gray-500">
                                <svg class="h-10 w-10 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <p>No submissions found</p>
                            </td>
                        </tr>
                    </template>
                    <template x-for="submission in submissions" :key="submission.id">
                        <tr @click="openDetail(submission)"
                            class="border-b border-gray-700/50 transition-colors cursor-pointer"
                            :class="submission.status === 'new' ? 'bg-blue-500/5 hover:bg-blue-500/10' : 'hover:bg-gray-700/30'">
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border"
                                      :class="[getStatusConfig(submission.status).bg, getStatusConfig(submission.status).text, getStatusConfig(submission.status).border]">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="getStatusConfig(submission.status).dot"></span>
                                    <span x-text="getStatusConfig(submission.status).label"></span>
                                </span>
                            </td>
                            <td class="px-4 py-3 font-medium text-white" x-text="submission.name"></td>
                            <td class="px-4 py-3 text-gray-400" x-text="submission.email"></td>
                            <td class="px-4 py-3 text-gray-300 max-w-xs truncate" x-text="submission.subject"></td>
                            <td class="px-4 py-3 text-gray-500 whitespace-nowrap text-xs" x-text="formatDate(submission.created_at)"></td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button x-show="submission.status === 'new'" x-cloak
                                            @click.stop="markAsRead(submission.id)"
                                            class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-400 hover:text-blue-300 hover:bg-blue-500/10 rounded transition-colors">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                                        </svg>
                                        Mark read
                                    </button>
                                    <button class="p-1.5 text-gray-400 hover:text-white hover:bg-gray-700 rounded transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
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

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-3">
        <template x-if="submissions.length === 0">
            <div class="rounded-lg border border-gray-700 bg-gray-800 p-8 text-center text-gray-500">
                <svg class="h-10 w-10 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <p>No submissions found</p>
            </div>
        </template>
        <template x-for="submission in submissions" :key="submission.id">
            <div @click="openDetail(submission)"
                 class="rounded-lg border bg-gray-800 p-4 cursor-pointer transition-all active:scale-[0.99]"
                 :class="submission.status === 'new' ? 'border-blue-500/30 bg-blue-500/5' : 'border-gray-700 hover:border-gray-600'">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-2 min-w-0">
                        <div class="rounded-full p-1.5 shrink-0"
                             :class="getStatusConfig(submission.status).bg">
                            <span class="w-2 h-2 rounded-full block" :class="getStatusConfig(submission.status).dot"></span>
                        </div>
                        <div class="min-w-0">
                            <p class="font-medium text-sm text-white truncate" x-text="submission.name"></p>
                            <p class="text-xs text-gray-500 truncate" x-text="submission.email"></p>
                        </div>
                    </div>
                    <span class="text-xs text-gray-500 whitespace-nowrap shrink-0" x-text="formatDate(submission.created_at)"></span>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-200 truncate" x-text="submission.subject"></p>
                <p class="mt-1 text-xs text-gray-500 line-clamp-2" x-text="submission.message"></p>
                <div x-show="submission.status === 'new'" x-cloak class="mt-3 flex gap-2">
                    <button @click.stop="markAsRead(submission.id)"
                            class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-400 bg-blue-500/10 border border-blue-500/20 rounded hover:bg-blue-500/20 transition-colors">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/>
                        </svg>
                        Mark read
                    </button>
                </div>
            </div>
        </template>
    </div>

    <!-- Pagination -->
    <div x-show="pagination.last_page > 1" class="flex items-center justify-between">
        <p class="text-sm text-gray-500">
            Showing <span x-text="pagination.from || 0"></span> to <span x-text="pagination.to || 0"></span> of <span x-text="pagination.total"></span>
        </p>
        <div class="flex items-center gap-2">
            <a :href="`/admin/contacts/submissions?page=${pagination.current_page - 1}&status=${status === 'all' ? '' : status}&search=${search}`"
               :class="pagination.current_page <= 1 ? 'pointer-events-none opacity-50' : ''"
               class="inline-flex items-center p-2 text-sm text-gray-400 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <span class="text-sm text-gray-500 px-2">
                Page <span x-text="pagination.current_page"></span> of <span x-text="pagination.last_page"></span>
            </span>
            <a :href="`/admin/contacts/submissions?page=${pagination.current_page + 1}&status=${status === 'all' ? '' : status}&search=${search}`"
               :class="pagination.current_page >= pagination.last_page ? 'pointer-events-none opacity-50' : ''"
               class="inline-flex items-center p-2 text-sm text-gray-400 bg-gray-800 border border-gray-700 rounded-lg hover:bg-gray-700 hover:text-white transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    <!-- Detail Modal -->
    <div x-show="detailOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm" @click="detailOpen = false"></div>

        <!-- Modal Content -->
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
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium border"
                                      :class="[getStatusConfig(selected.status).bg, getStatusConfig(selected.status).text, getStatusConfig(selected.status).border]">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="getStatusConfig(selected.status).dot"></span>
                                    <span x-text="getStatusConfig(selected.status).label"></span>
                                </span>
                                <span class="text-xs text-gray-500" x-text="'#' + selected.id"></span>
                            </div>
                            <h3 class="text-lg font-semibold text-white" x-text="selected.subject"></h3>
                            <p class="text-sm text-gray-500 mt-1" x-text="'Received on ' + formatDate(selected.created_at)"></p>
                        </div>
                        <button @click="detailOpen = false" class="p-1.5 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Sender Info -->
                    <div class="rounded-lg border border-gray-700 bg-gray-700/30 p-4 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-primary-500/20 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white" x-text="selected.name"></p>
                                <p class="text-sm text-gray-400" x-text="selected.email"></p>
                            </div>
                        </div>
                        <div x-show="selected.phone" class="flex items-center gap-2 text-sm text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span x-text="selected.phone"></span>
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                            </svg>
                            Message
                        </h4>
                        <div class="rounded-lg border border-gray-700 bg-gray-900/50 p-4">
                            <p class="text-sm text-gray-300 whitespace-pre-wrap" x-text="selected.message"></p>
                        </div>
                    </div>

                    <!-- Admin Notes -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Admin Notes
                        </h4>
                        <textarea x-model="adminNotes" rows="3"
                                  placeholder="Add internal notes about this submission..."
                                  class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"></textarea>
                    </div>

                    <!-- Status Actions -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-300 mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Update Status
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            <template x-for="s in ['new','read','replied','archived']" :key="s">
                                <button @click="updateStatus(selected.id, s)"
                                        :disabled="updating || selected.status === s"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg border transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                                        :class="selected.status === s 
                                            ? 'bg-primary-500 text-white border-primary-500' 
                                            : [getStatusConfig(s).bg, getStatusConfig(s).text, getStatusConfig(s).border, 'hover:bg-gray-700']">
                                    <span x-show="updating && selected.status !== s" class="w-3 h-3 border-2 border-current border-t-transparent rounded-full animate-spin"></span>
                                    <span x-text="getStatusConfig(s).label"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <div x-show="selected.read_at" class="text-xs text-gray-500">
                        Read at <span x-text="formatDate(selected.read_at)"></span>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection
