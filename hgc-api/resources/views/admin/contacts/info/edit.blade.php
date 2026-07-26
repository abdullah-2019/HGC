@extends('admin.layouts.app')

@section('title', 'Contact Information')
@section('page-title', 'Contact Information')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         FLASH MESSAGES — for initial page load only
         ═══════════════════════════════════════════════════════════════ --}}
    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20">
            <ul class="list-disc list-inside text-red-400 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div x-data="{
        activeTab: 'en',
        saving: false,
        message: null,
        messageType: null, // 'success' | 'error'
    
        data: {{ Js::from([
            'address' => $contactInfo->address ?? '',
            'phones' => $contactInfo->phones ?? '',
            'email' => $contactInfo->email ?? '',
            'office_hours' => $contactInfo->office_hours ?? '',
            'address_dari' => $contactInfo->address_dari ?? '',
            'phones_dari' => $contactInfo->phones_dari ?? '',
            'email_dari' => $contactInfo->email_dari ?? '',
            'office_hours_dari' => $contactInfo->office_hours_dari ?? '',
            'address_pashto' => $contactInfo->address_pashto ?? '',
            'phones_pashto' => $contactInfo->phones_pashto ?? '',
            'email_pashto' => $contactInfo->email_pashto ?? '',
            'office_hours_pashto' => $contactInfo->office_hours_pashto ?? '',
            'facebook' => $contactInfo->facebook ?? '',
            'x' => $contactInfo->x ?? '',
            'linkedin' => $contactInfo->linkedin ?? '',
            'telegram' => $contactInfo->telegram ?? '',
            'instagram' => $contactInfo->instagram ?? '',
            'youtube' => $contactInfo->youtube ?? '',
            'whatsapp' => $contactInfo->whatsapp ?? '',
            'map_embed_url' => $contactInfo->map_embed_url ?? '',
            'map_lat' => $contactInfo->map_lat ?? '',
            'map_lng' => $contactInfo->map_lng ?? '',
        ]) }},
    
        showMessage(text, type) {
            this.message = text;
            this.messageType = type;
            setTimeout(() => { this.message = null; }, 5000);
        },
    
        async save() {
            this.saving = true;
            this.message = null;
    
            try {
                const res = await fetch('{{ route('admin.contacts.info.update') }}', {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(this.data)
                });
    
                const result = await res.json();
    
                if (!res.ok) {
                    // Laravel validation errors come back as 422 with { message, errors }
                    const msg = result.message ||
                        (result.errors ? Object.values(result.errors).flat().join(' ') : 'Failed to save');
                    throw new Error(msg);
                }
    
                this.showMessage('Contact information saved successfully.', 'success');
            } catch (e) {
                this.showMessage(e.message || 'Failed to save contact information.', 'error');
            } finally {
                this.saving = false;
            }
        }
    }" class="space-y-6">

        {{-- ═══════════════════════════════════════════════════════════════
             INLINE AJAX MESSAGES — shown after clicking Save
             ═══════════════════════════════════════════════════════════════ --}}
        <template x-if="message">
            <div x-transition
                :class="messageType === 'success'
                    ?
                    'bg-green-500/10 border-green-500/20 text-green-400' :
                    'bg-red-500/10 border-red-500/20 text-red-400'"
                class="mb-6 p-4 rounded-xl border flex items-start gap-3">
                <svg x-show="messageType === 'success'" class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <svg x-show="messageType === 'error'" class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium" x-text="message"></span>
                <button @click="message = null" class="ml-auto shrink-0 opacity-60 hover:opacity-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </template>

        <!-- Header -->
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">Contact Information</h1>
                <p class="text-gray-400 mt-1">Manage contact details displayed on the website</p>
            </div>
            <button @click="save" :disabled="saving"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-colors shrink-0">
                <svg x-show="!saving" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                <svg x-show="saving" class="w-4 h-4 mr-2 animate-spin" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span x-text="saving ? 'Saving...' : 'Save Changes'"></span>
            </button>
        </div>

        <!-- Language Tabs -->
        <div class="border-b border-gray-700">
            <nav class="flex gap-1" aria-label="Tabs">
                <button @click="activeTab = 'en'"
                    :class="activeTab === 'en' ? 'border-primary-500 text-primary-400' :
                        'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600'"
                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors">
                    English
                </button>
                <button @click="activeTab = 'dari'"
                    :class="activeTab === 'dari' ? 'border-primary-500 text-primary-400' :
                        'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600'"
                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors" dir="rtl">
                    دری
                </button>
                <button @click="activeTab = 'pashto'"
                    :class="activeTab === 'pashto' ? 'border-primary-500 text-primary-400' :
                        'border-transparent text-gray-400 hover:text-gray-300 hover:border-gray-600'"
                    class="px-4 py-2.5 text-sm font-medium border-b-2 transition-colors" dir="rtl">
                    پښتو
                </button>
            </nav>
        </div>

        <!-- English Tab -->
        <div x-show="activeTab === 'en'" x-cloak class="space-y-6">
            <div class="rounded-lg border border-gray-700 bg-gray-800 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                    <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Basic Information (English)
                    </h3>
                </div>
                <div class="p-4 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Address</label>
                        <textarea x-model="data.address" rows="2" placeholder="Enter office address"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Phone Numbers</label>
                        <input type="text" x-model="data.phones" placeholder="+93 700 123 456"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Email</label>
                        <input type="email" x-model="data.email" placeholder="info@hgc.af"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Office Hours</label>
                        <input type="text" x-model="data.office_hours"
                            placeholder="Saturday - Thursday, 8:00 AM - 5:00 PM"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Dari Tab -->
        <div x-show="activeTab === 'dari'" x-cloak class="space-y-6">
            <div class="rounded-lg border border-gray-700 bg-gray-800 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                    <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Basic Information (Dari)
                    </h3>
                </div>
                <div class="p-4 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Address (Dari)</label>
                        <textarea x-model="data.address_dari" rows="2" placeholder="Enter address in Dari" dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Phone Numbers (Dari)</label>
                        <input type="text" x-model="data.phones_dari" placeholder="Enter phones in Dari"
                            dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Email (Dari)</label>
                        <input type="email" x-model="data.email_dari" placeholder="Enter email in Dari" dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Office Hours (Dari)</label>
                        <input type="text" x-model="data.office_hours_dari" placeholder="Enter office hours in Dari"
                            dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Pashto Tab -->
        <div x-show="activeTab === 'pashto'" x-cloak class="space-y-6">
            <div class="rounded-lg border border-gray-700 bg-gray-800 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                    <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Basic Information (Pashto)
                    </h3>
                </div>
                <div class="p-4 grid gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Address (Pashto)</label>
                        <textarea x-model="data.address_pashto" rows="2" placeholder="Enter address in Pashto" dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"></textarea>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Phone Numbers (Pashto)</label>
                        <input type="text" x-model="data.phones_pashto" placeholder="Enter phones in Pashto"
                            dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Email (Pashto)</label>
                        <input type="email" x-model="data.email_pashto" placeholder="Enter email in Pashto"
                            dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="sm:col-span-2 space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Office Hours (Pashto)</label>
                        <input type="text" x-model="data.office_hours_pashto"
                            placeholder="Enter office hours in Pashto" dir="rtl"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="rounded-lg border border-gray-700 bg-gray-800 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    Social Media & Links
                </h3>
            </div>
            <div class="p-4 grid gap-4 sm:grid-cols-2">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                        Facebook
                    </label>
                    <input type="text" x-model="data.facebook" placeholder="https://facebook.com/hgc"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                        </svg>
                        X (Twitter)
                    </label>
                    <input type="text" x-model="data.x" placeholder="https://x.com/hgc"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                        </svg>
                        LinkedIn
                    </label>
                    <input type="text" x-model="data.linkedin" placeholder="https://linkedin.com/company/hgc"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Instagram
                    </label>
                    <input type="text" x-model="data.instagram" placeholder="https://instagram.com/hgc"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                        YouTube
                    </label>
                    <input type="text" x-model="data.youtube" placeholder="https://youtube.com/@hgc"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                        </svg>
                        Telegram
                    </label>
                    <input type="text" x-model="data.telegram" placeholder="https://t.me/hgc"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300 flex items-center gap-2">
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                        </svg>
                        WhatsApp
                    </label>
                    <input type="text" x-model="data.whatsapp" placeholder="https://wa.me/93700123456"
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Map Settings -->
        <div class="rounded-lg border border-gray-700 bg-gray-800 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.553-.894L15 7m0 13V7" />
                    </svg>
                    Map Settings
                </h3>
            </div>
            <div class="p-4 space-y-4">
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300">Google Maps Embed URL</label>
                    <textarea x-model="data.map_embed_url" rows="3" placeholder="Paste Google Maps embed iframe URL here..."
                        class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none"></textarea>
                    <p class="text-xs text-gray-500">Paste the embed URL from Google Maps (iframe src attribute)</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Latitude</label>
                        <input type="text" x-model="data.map_lat" placeholder="34.5320"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">Longitude</label>
                        <input type="text" x-model="data.map_lng" placeholder="69.1760"
                            class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded-lg text-sm text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="rounded-lg border border-gray-700 bg-gray-800/50 overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-700 bg-gray-800/50">
                <h3 class="text-sm font-semibold text-white flex items-center gap-2">
                    <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Preview
                </h3>
            </div>
            <div class="p-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <template x-if="data.address">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-white">Address</p>
                            <p class="text-sm text-gray-400" x-text="data.address"></p>
                        </div>
                    </div>
                </template>
                <template x-if="data.phones">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-white">Phone</p>
                            <p class="text-sm text-gray-400" x-text="data.phones"></p>
                        </div>
                    </div>
                </template>
                <template x-if="data.email">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-white">Email</p>
                            <p class="text-sm text-gray-400" x-text="data.email"></p>
                        </div>
                    </div>
                </template>
                <template x-if="data.office_hours">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-500 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-white">Office Hours</p>
                            <p class="text-sm text-gray-400" x-text="data.office_hours"></p>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Bottom Save -->
        <div class="flex justify-end">
            <button @click="save" :disabled="saving"
                class="inline-flex items-center px-6 py-2.5 bg-primary-600 hover:bg-primary-700 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-medium rounded-lg transition-colors">
                <svg x-show="!saving" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                <svg x-show="saving" class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <span x-text="saving ? 'Saving...' : 'Save All Changes'"></span>
            </button>
        </div>
    </div>
@endsection
