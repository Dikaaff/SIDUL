<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIDUL - @yield('title', 'Sistem Informasi Management Magang')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-[#F9FAFB] font-sans antialiased text-base-content min-h-screen">
    <div class="flex">
        <!-- Sidebar container -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-80 bg-white border-r border-gray-100 z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            @include('components.sidebar')
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-80">
            <!-- Navbar -->
            @include('components.navbar')
            
            <!-- Content -->
            <main class="p-4 lg:p-8 flex-1">
                @hasSection('header')
                    <header class="mb-6">
                        @yield('header')
                    </header>
                @endif
                
                @yield('breadcrumbs')
                
                <div class="mt-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }
        }

        // Robust Global Toast Logic
        function showToast(type, message) {
            const successNotif = document.getElementById('globalSuccessNotif');
            const errorNotif = document.getElementById('globalErrorNotif');
            
            // Hide all first
            successNotif.classList.add('hidden');
            errorNotif.classList.add('hidden');

            if (type === 'success' || type === 'info') {
                const titleText = successNotif.querySelector('p.font-black');
                const iconContainer = successNotif.querySelector('.icon-container');
                
                if (type === 'info') {
                    iconContainer.className = 'icon-container w-12 h-12 rounded-2xl bg-blue-500 flex items-center justify-center shadow-lg shadow-blue-500/20';
                    titleText.innerText = 'Informasi';
                } else {
                    iconContainer.className = 'icon-container w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20';
                    titleText.innerText = 'Berhasil!';
                }

                document.getElementById('globalSuccessMsg').innerText = message;
                successNotif.classList.remove('hidden');
                setTimeout(() => successNotif.classList.add('hidden'), 5000);
            } else if (type === 'error') {
                document.getElementById('globalErrorMsg').innerText = message;
                errorNotif.classList.remove('hidden');
                setTimeout(() => errorNotif.classList.add('hidden'), 5000);
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            @if(session('success')) showToast('success', "{{ session('success') }}"); @endif
            @if(session('error')) showToast('error', "{{ session('error') }}"); @endif
            @if(session('info')) showToast('info', "{{ session('info') }}"); @endif
        });
    </script>

    <!-- Global Notification Toast -->
    <div id="globalNotifContainer" class="fixed top-8 right-8 z-[9999] space-y-4 pointer-events-none">
        <!-- Success/Info Notif -->
        <div id="globalSuccessNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300 pointer-events-auto">
            <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2rem] shadow-2xl border border-white/10 min-w-[340px]">
                <div class="icon-container w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <p class="font-black text-sm uppercase tracking-widest text-white">Berhasil!</p>
                    <p id="globalSuccessMsg" class="text-xs text-gray-400 font-bold mt-0.5"></p>
                </div>
            </div>
        </div>

        <!-- Error Notif -->
        <div id="globalErrorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300 pointer-events-auto">
            <div class="flex items-center gap-4 bg-red-50 text-red-800 p-5 rounded-[2rem] shadow-2xl border border-red-100 min-w-[340px]">
                <div class="w-12 h-12 rounded-2xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <p class="font-black text-sm uppercase tracking-widest leading-tight">Terjadi Kesalahan!</p>
                    <p id="globalErrorMsg" class="text-xs font-bold mt-0.5"></p>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
