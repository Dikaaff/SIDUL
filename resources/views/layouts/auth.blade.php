<!DOCTYPE html>
{{-- daisyui: theme --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIDUL - @yield('title', 'Autentikasi')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- AKSES: BG LOGIN — ubah bg-base-200 untuk ganti background halaman login (jangan sentuh kelas lain) --}}
<body class="bg-base-200 font-sans antialiased text-base-content min-h-screen flex items-center justify-center p-4 lg:p-8">
    
    @yield('content')

    {{-- Global Notification Toast --}}
    <div id="globalNotifContainer" class="fixed top-8 right-8 z-[9999] space-y-4 pointer-events-none">
        {{-- Success/Info Notif --}}
        <div id="globalSuccessNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300 pointer-events-auto">
            <div class="flex items-center gap-4 bg-white/95 backdrop-blur-md border-l-4 border-green-500 shadow-2xl rounded-2xl p-5 min-w-[340px] max-w-[calc(100vw-2rem)]">
                <div class="icon-container w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center shadow-lg shadow-green-500/10 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </div>
                <div>
                    <p class="font-black text-sm uppercase tracking-widest text-gray-800">Berhasil!</p>
                    <p id="globalSuccessMsg" class="text-xs text-gray-500 font-bold mt-0.5"></p>
                </div>
            </div>
        </div>

        {{-- Error Notif --}}
        <div id="globalErrorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300 pointer-events-auto">
            <div class="flex items-center gap-4 bg-white/95 backdrop-blur-md border-l-4 border-red-500 shadow-2xl rounded-2xl p-5 min-w-[340px] max-w-[calc(100vw-2rem)]">
                <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center shadow-lg shadow-red-500/10 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <p class="font-black text-sm uppercase tracking-widest leading-tight text-gray-800">Terjadi Kesalahan!</p>
                    <p id="globalErrorMsg" class="text-xs text-gray-500 font-bold mt-0.5"></p>
                </div>
            </div>
        </div>
    </div>

    {{-- AKSES: BG OVERLAY loading — ganti bg-white untuk warna overlay loading --}}
    <div id="loadingOverlay" class="fixed inset-0 z-[99999] bg-white flex items-center justify-center transition-all duration-300 opacity-0 pointer-events-none">
        <div class="text-center">
            <svg class="animate-spin h-10 w-10 text-[#6B21A8] mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-4 text-sm font-bold text-gray-400 tracking-wider">Memuat halaman...</p>
        </div>
    </div>
    
    @stack('scripts')

<script>
    function showToast(type, message) {
        const successNotif = document.getElementById('globalSuccessNotif');
        const errorNotif = document.getElementById('globalErrorNotif');
        
        if (!successNotif || !errorNotif) return;

        successNotif.classList.add('hidden');
        errorNotif.classList.add('hidden');

        if (type === 'success' || type === 'info') {
            const titleText = successNotif.querySelector('p.font-black');
            const iconContainer = successNotif.querySelector('.icon-container');
            
            if (type === 'info') {
                if(iconContainer) iconContainer.className = 'icon-container w-12 h-12 rounded-2xl bg-blue-100 flex items-center justify-center shadow-lg shadow-blue-500/10 text-blue-600';
                if(titleText) titleText.innerText = 'Informasi';
            } else {
                if(iconContainer) iconContainer.className = 'icon-container w-12 h-12 rounded-2xl bg-green-100 flex items-center justify-center shadow-lg shadow-green-500/10 text-green-600';
                if(titleText) titleText.innerText = 'Berhasil!';
            }

            const msgEl = document.getElementById('globalSuccessMsg');
            if(msgEl) msgEl.innerText = message;
            
            successNotif.classList.remove('hidden');
            setTimeout(() => {
                successNotif.classList.add('opacity-0');
                setTimeout(() => {
                    successNotif.classList.add('hidden');
                    successNotif.classList.remove('opacity-0');
                }, 500);
            }, 2000);
        } else if (type === 'error') {
            const msgEl = document.getElementById('globalErrorMsg');
            if(msgEl) msgEl.innerText = message;
            
            errorNotif.classList.remove('hidden');
            setTimeout(() => {
                errorNotif.classList.add('opacity-0');
                setTimeout(() => {
                    errorNotif.classList.add('hidden');
                    errorNotif.classList.remove('opacity-0');
                }, 500);
            }, 2000);
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        @if(session('success')) showToast('success', @json(session('success'))); @endif
        @if(session('error')) showToast('error', @json(session('error'))); @endif
        @if(session('info')) showToast('info', @json(session('info'))); @endif
    });

    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form.dataset.noLoading !== undefined) return;
        const btn = e.submitter || form.querySelector('button[type="submit"]');
        if (btn && btn.dataset.noLoading === undefined) {
            if (btn.name) {
                const h = document.createElement('input');
                h.type = 'hidden';
                h.name = btn.name;
                h.value = btn.value;
                form.appendChild(h);
            }
            btn.disabled = true;
            if (!btn.querySelector('.spinner-loading')) {
                const s = document.createElement('span');
                s.className = 'spinner-loading';
                s.innerHTML = '<svg class="animate-spin h-4 w-4 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>';
                btn.prepend(s);
            }
            // Show fullscreen loading overlay
            const overlay = document.getElementById('loadingOverlay');
            if (overlay) {
                overlay.classList.remove('pointer-events-none', 'opacity-0');
            }
        }
    });
    // Memaksa halaman memuat ulang jika diakses dari Cache Back/Forward
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });

</script>



</body>
</html>
