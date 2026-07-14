@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Grid: 1 col mobile, 2 col tablet, 4 col desktop -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-4 mb-4 sm:mb-6">

        <!-- Stat Card 1: Companies -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Companies</p>
                    <p class="text-2xl font-bold text-white">6</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-primary-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 2: Products -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Products</p>
                    <p class="text-2xl font-bold text-white">6</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 3: Projects -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Projects</p>
                    <p class="text-2xl font-bold text-white">4</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Stat Card 4: Contact Messages -->
        <div class="p-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
            <div class="flex items-center justify-between">
                <div class="min-w-0">
                    <p class="text-sm text-gray-400 truncate">Contact Messages</p>
                    <p class="text-2xl font-bold text-white">1</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-500/10 flex items-center justify-center flex-shrink-0 ml-3">
                    <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="p-4 sm:p-6 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
        <h3 class="text-lg font-semibold text-white mb-2">Welcome to HGC Admin</h3>
        <p class="text-gray-400 text-sm sm:text-base">Manage your companies, products, projects, news, and more from this dashboard.</p>
    </div>
@endsection