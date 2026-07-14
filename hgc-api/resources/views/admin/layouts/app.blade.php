<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | HGC Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #111827; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 3px; }

        /* Prevent any horizontal overflow */
        html, body { 
            overflow-x: hidden; 
            max-width: 100%;
        }

        /* Desktop: push main content to the right of sidebar */
        @media (min-width: 640px) {
            .main-wrapper {
                margin-left: 16rem !important; /* w-64 = 16rem = 256px */
            }
        }

        /* Mobile: no margin, sidebar overlays */
        @media (max-width: 639px) {
            .main-wrapper {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-gray-900 text-white antialiased" x-data="{ sidebarOpen: false }">

    <!-- Sidebar: fixed, always on top -->
    @include('admin.components.sidebar')

    <!-- Main Content: offset by sidebar width on desktop -->
    <div class="main-wrapper min-h-screen bg-gray-900 transition-all duration-300">

        <!-- Navbar -->
        @include('admin.components.navbar')

        <!-- Page Content -->
        <main class="p-4 lg:p-6">
            @if(session('success'))
                <div class="mb-4 flex items-start p-4 text-sm text-green-400 rounded-lg bg-green-900/50 border border-green-800" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                    </svg>
                    <span class="break-words">{{ session('success') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>