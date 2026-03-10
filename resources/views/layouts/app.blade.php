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
<body class="bg-[#F9FAFB] font-sans antialiased text-base-content">
    <div class="drawer lg:drawer-open">
        <input id="main-drawer" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content flex flex-col min-h-screen bg-[#F9FAFB]">
            <!-- Navbar -->
            @include('components.navbar')
            
            <!-- Main Content -->
            <main class="flex-1 p-4 lg:p-8 space-y-6">
                @hasSection('header')
                    <header class="mb-8">
                        @yield('header')
                    </header>
                @endif
                
                @yield('content')
            </main>
        </div>
        
        <!-- Sidebar -->
        <div class="drawer-side z-50 shadow-xl">
            <label for="main-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            @include('components.sidebar')
        </div>
    </div>
</body>
</html>
