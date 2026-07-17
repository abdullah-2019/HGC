<!-- Mobile overlay: z-30, behind sidebar -->
<div class="fixed inset-0 z-30 bg-gray-900/70 backdrop-blur-sm sm:hidden" x-show="sidebarOpen" @click="sidebarOpen = false"
    x-transition:enter="transition-opacity ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak></div>

<!-- Sidebar: z-40, fixed position -->
<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen bg-gray-900 border-r border-gray-700 transition-transform duration-300 ease-in-out"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full sm:translate-x-0'" id="sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto flex flex-col">

        <!-- Logo -->
        <a href="{{ route('admin.dashboard') }}" class="flex items-center mb-6 ps-2.5">
            <div class="w-10 h-10 rounded-xl bg-primary-500 flex items-center justify-center mr-3 flex-shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div class="min-w-0">
                <span class="self-center text-xl font-bold whitespace-nowrap text-white">HGC Admin</span>
                <p class="text-xs text-gray-500">Management Panel</p>
            </div>
        </a>

        <!-- Navigation -->
        <ul class="space-y-1 font-medium flex-1">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    <span class="ms-3 truncate">Dashboard</span>
                </a>
            </li>

            <!-- Contacts Dropdown -->
            <li x-data="{ open: {{ request()->routeIs('admin.contacts.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.contacts.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap truncate">Contacts</span>
                    @php
                        $unreadCount = \App\Models\ContactSubmission::where('status', 'new')->count();
                    @endphp
                    @if ($unreadCount > 0)
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 ms-2 text-xs font-medium bg-red-900 text-red-300 rounded-full flex-shrink-0">{{ $unreadCount }}</span>
                    @endif
                    <svg class="w-3 h-3 transition-transform duration-200 flex-shrink-0 ml-2"
                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul x-show="open" x-collapse class="py-2 space-y-1">
                    <li>
                        <a href="{{ route('admin.contacts.submissions') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.submissions') ? 'bg-gray-700 text-white' : '' }}">
                            Submissions
                            @if ($unreadCount > 0)
                                <span
                                    class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium bg-red-900 text-red-300 rounded-full">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.info') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.info') ? 'bg-gray-700 text-white' : '' }}">
                            Contact Info
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Testimonials -->
            <li>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span class="ms-3 truncate">Testimonials</span>
                </a>
            </li>

            <!-- ─── PRODUCTS ─── -->
            <li>
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span class="ms-3 truncate">Products</span>
                </a>
            </li>

            <!-- About Dropdown -->
            <li x-data="{ open: {{ request()->routeIs('admin.about.*') ? 'true' : 'false' }} }">
                <button @click="open = !open" type="button"
                    class="flex items-center w-full p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.contacts.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="flex-1 ms-3 text-left whitespace-nowrap truncate">About</span>
                    <svg class="w-3 h-3 transition-transform duration-200 flex-shrink-0 ml-2"
                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul x-show="open" x-collapse class="py-2 space-y-1">
                    <li>
                        <a href="{{ route('admin.about.carousel.index') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.submissions') ? 'bg-gray-700 text-white' : '' }}">
                            Carousel
                        </a>
                    </li>

                    {{-- admin.about.carousel.index
admin.about.carousel.create
admin.about.carousel.store
admin.about.carousel.edit
admin.about.carousel.update
admin.about.carousel.destroy --}}

                    <li>
                        <a href="{{ route('admin.contacts.info') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.info') ? 'bg-gray-700 text-white' : '' }}">
                            Mission
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.info') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.info') ? 'bg-gray-700 text-white' : '' }}">
                            Vision
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.info') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.info') ? 'bg-gray-700 text-white' : '' }}">
                            Value
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.contacts.info') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.info') ? 'bg-gray-700 text-white' : '' }}">
                            Story Highlight
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Sectors -->
            <li>
                <a href="{{ route('admin.sectors.index') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.sectors.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span class="ms-3 truncate">Sectors</span>
                </a>
            </li>

            <!-- Stats -->
            <li>
                <a href="{{ route('admin.stats.index') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.stats.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span class="ms-3 truncate">Stats</span>
                </a>
            </li>

            <!-- Settings -->
            <li>
                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="ms-3 truncate">Settings</span>
                </a>
            </li>

            <!-- About Page -->
            <li>
                <a href="{{ route('admin.about.edit') }}"
                    class="flex items-center p-2.5 text-white rounded-lg hover:bg-gray-700 group transition-colors {{ request()->routeIs('admin.about.*') ? 'bg-gray-700' : '' }}">
                    <svg class="w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white flex-shrink-0"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="ms-3 truncate">About Page</span>
                </a>
            </li>

        </ul>

        <!-- Logout -->
        <div class="pt-4 mt-auto border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center w-full p-2.5 text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white group transition-colors">
                    <svg class="w-5 h-5 transition duration-75 group-hover:text-white flex-shrink-0" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="ms-3 truncate">Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</aside>
