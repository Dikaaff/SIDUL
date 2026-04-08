<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIDUL - @yield('title', 'Sistem Informasi Management Magang')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F9FAFB] font-sans antialiased text-base-content overflow-x-hidden min-h-screen">
    <div class="drawer lg:drawer-open">
        <input id="main-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Main Content Area -->
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- Navbar -->
            @include('components.navbar')
            
            <!-- Content -->
            <main class="p-4 lg:p-8 flex-1">
                @hasSection('header')
                    <header class="mb-6 px-4 lg:px-0">
                        @yield('header')
                    </header>
                @endif
                
                <div class="px-4 lg:px-0 mb-6">
                    @yield('breadcrumbs')
                </div>
                
                <div class="px-4 lg:px-0">
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Sidebar Panel -->
        <div class="drawer-side z-[100]">
            <label for="main-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="w-80 min-h-screen bg-white border-r border-gray-100">
                @include('components.sidebar')
            </div>
        </div>
    </div>
</body>
</html>
