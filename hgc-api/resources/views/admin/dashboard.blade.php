@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')


    <!-- Welcome Card -->
    <div class="p-4 sm:p-6 bg-gray-800 border border-gray-700 rounded-lg shadow-sm gap-3 sm:gap-4 mb-4 sm:mb-6">
        <h3 class="text-lg font-semibold text-white mb-2">Welcome to HGC Admin</h3>
        <p class="text-gray-400 text-sm sm:text-base">Manage your companies, products, projects, news, and more from this
            dashboard.</p>
    </div>


    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">

        <!-- Stat Card 1: Companies -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Companies</p>
                    <p class="text-2xl font-bold text-white">{{ $companiesCount }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-primary-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 2: Products -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Products</p>
                    <p class="text-2xl font-bold text-white">{{ $productsCount }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 3: Projects -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Projects</p>
                    <p class="text-2xl font-bold text-white">{{ $projectsCount }}</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 4: Contact Messages -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Contact Messages</p>
                    <div class="flex items-baseline gap-2">
                        <p class="text-2xl font-bold text-white">{{ $contactMessagesCount }}</p>
                        @if ($unreadContacts > 0)
                            <span
                                class="text-xs font-medium text-red-400 bg-red-400/10 px-2 py-0.5 rounded-full">{{ $unreadContacts }}
                                new</span>
                        @endif
                    </div>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access -->
    <div class="mb-4 sm:mb-6">
        <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3">Quick Access</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">

            <!-- Companies -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-primary-500 transition-all group">
                <a href="{{ route('admin.companies.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-primary-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary-500/20">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Companies</span>
                </a>
                <a href="{{ route('admin.companies.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-primary-400 bg-primary-500/5 border-t border-gray-700 rounded-b-lg hover:bg-primary-500/10 hover:text-primary-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Company
                </a>
            </div>

            <!-- Products -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-blue-500 transition-all group">
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-blue-500/20">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Products</span>
                </a>
                <a href="{{ route('admin.products.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-blue-400 bg-blue-500/5 border-t border-gray-700 rounded-b-lg hover:bg-blue-500/10 hover:text-blue-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Product
                </a>
            </div>

            <!-- Projects -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-green-500 transition-all group">
                <a href="{{ route('admin.projects.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-green-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-green-500/20">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Projects</span>
                </a>
                <a href="{{ route('admin.projects.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-green-400 bg-green-500/5 border-t border-gray-700 rounded-b-lg hover:bg-green-500/10 hover:text-green-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Project
                </a>
            </div>

            <!-- Contact Submissions -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-purple-500 transition-all group">
                <a href="{{ route('admin.contacts.submissions') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-purple-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-purple-500/20">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <span
                            class="text-sm font-medium text-gray-300 group-hover:text-white block truncate">Submissions</span>
                        @if ($unreadContacts > 0)
                            <span class="text-xs text-red-400">{{ $unreadContacts }} unread</span>
                        @endif
                    </div>
                </a>
                <div
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-gray-500 bg-gray-800/50 border-t border-gray-700 rounded-b-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View
                </div>
            </div>

            <!-- Categories -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-yellow-500 transition-all group">
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-yellow-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-yellow-500/20">
                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Categories</span>
                </a>
                <a href="{{ route('admin.categories.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-yellow-400 bg-yellow-500/5 border-t border-gray-700 rounded-b-lg hover:bg-yellow-500/10 hover:text-yellow-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Category
                </a>
            </div>

            <!-- Sectors -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-orange-500 transition-all group">
                <a href="{{ route('admin.sectors.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-orange-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-orange-500/20">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Sectors</span>
                </a>
                <a href="{{ route('admin.sectors.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-orange-400 bg-orange-500/5 border-t border-gray-700 rounded-b-lg hover:bg-orange-500/10 hover:text-orange-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Sector
                </a>
            </div>

            <!-- Settings -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-gray-500 transition-all group">
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-gray-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-gray-500/20">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Settings</span>
                </a>
                <div
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-gray-500 bg-gray-800/50 border-t border-gray-700 rounded-b-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Manage
                </div>
            </div>

            <!-- About -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-pink-500 transition-all group">
                <a href="{{ route('admin.about.story.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-pink-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-pink-500/20">
                        <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">About Page</span>
                </a>
                <div
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-gray-500 bg-gray-800/50 border-t border-gray-700 rounded-b-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Content
                </div>
            </div>

            <!-- Hero Slides -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-primary-500 transition-all group">
                <a href="{{ route('admin.hero-slides.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-primary-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-primary-500/20">
                        <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Hero Slides</span>
                </a>
                <a href="{{ route('admin.hero-slides.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-primary-400 bg-primary-500/5 border-t border-gray-700 rounded-b-lg hover:bg-primary-500/10 hover:text-primary-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Slide
                </a>
            </div>

            <!-- News -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-red-500 transition-all group">
                <a href="{{ route('admin.news.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-red-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-red-500/20">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">News</span>
                </a>
                <a href="{{ route('admin.news.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-red-400 bg-red-500/5 border-t border-gray-700 rounded-b-lg hover:bg-red-500/10 hover:text-red-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Article
                </a>
            </div>


            <!-- Events -->
            <div
                class="flex flex-col bg-gray-800 border border-gray-700 rounded-lg hover:border-teal-500 transition-all group">
                <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 p-3 flex-1">
                    <div
                        class="w-9 h-9 rounded-lg bg-teal-500/10 flex items-center justify-center flex-shrink-0 group-hover:bg-teal-500/20">
                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium text-gray-300 group-hover:text-white">Events</span>
                </a>
                <a href="{{ route('admin.events.create') }}"
                    class="flex items-center justify-center gap-1.5 py-2 text-xs font-medium text-teal-400 bg-teal-500/5 border-t border-gray-700 rounded-b-lg hover:bg-teal-500/10 hover:text-teal-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Event
                </a>
            </div>

        </div>
    </div>

@endsection
