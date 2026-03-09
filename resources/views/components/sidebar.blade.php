<aside class="w-80 h-full bg-base-100/95 backdrop-blur border-r border-base-200 flex flex-col">
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-base-200 gap-3 sticky top-0 bg-base-100 z-10">
        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary to-accent text-white flex items-center justify-center font-bold text-lg shadow-lg shadow-primary/20">
            S
        </div>
        <span class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
            SIDUL
        </span>
    </div>

    <!-- Navigation Menu -->
    <div class="p-4 flex-1 overflow-y-auto">
        <ul class="menu menu-md w-full gap-2 text-base-content/80 font-medium">
            <li class="menu-title text-xs font-semibold uppercase tracking-wider text-base-content/50 mt-2 mb-1">
                Main Menu
            </li>
            
            @if(request()->is('dosen*'))
                <!-- DOSEN MENU -->
                <li>
                    <a href="/dosen" class="{{ request()->is('dosen') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Dosen
                    </a>
                </li>
                <li>
                    <a href="/dosen/mahasiswa" class="{{ request()->is('dosen/mahasiswa') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Mahasiswa Bimbingan
                    </a>
                </li>
                <li>
                    <a href="/dosen/rekomendasi" class="{{ request()->is('dosen/rekomendasi') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Rekomendasi Magang
                        <span class="badge badge-sm badge-secondary ml-auto text-xs">3</span>
                    </a>
                </li>
                <li>
                    <a href="/dosen/prasurvey" class="{{ request()->is('dosen/prasurvey') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                        Persetujuan Prasurvey
                    </a>
                </li>
                <li>
                    <a href="/dosen/laporan" class="{{ request()->is('dosen/laporan') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Laporan Magang
                        <span class="badge badge-sm badge-warning ml-auto text-xs">5</span>
                    </a>
                </li>
                <li>
                    <a href="/dosen/penilaian" class="{{ request()->is('dosen/penilaian') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Penilaian Magang
                    </a>
                </li>
            @elseif(request()->is('operator*'))
                <!-- OPERATOR MENU -->
                <li>
                    <a href="/operator" class="{{ request()->is('operator') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Operator
                    </a>
                </li>
                <li>
                    <a href="/operator/verifikasi" class="hover:text-primary transition-colors hover:bg-base-200/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Verifikasi Pendaftaran
                    </a>
                </li>
            @else
                <!-- MAHASISWA MENU -->
                <li>
                    <a href="/" class="{{ request()->is('/') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/pendaftaran" class="{{ request()->is('pendaftaran') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Pendaftaran Magang
                    </a>
                </li>
                <li>
                    <a href="/dokumen" class="{{ request()->is('dokumen') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                        Dokumen Persyaratan
                    </a>
                </li>
                <li>
                    <a href="/logbook" class="{{ request()->is('logbook') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Logbook Magang
                        <span class="badge badge-sm badge-secondary ml-auto text-xs">2</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan" class="{{ request()->is('laporan') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Laporan Magang
                    </a>
                </li>
                <li>
                    <a href="/surat-akhir" class="{{ request()->is('surat-akhir') ? 'active bg-primary/10 text-primary font-semibold' : 'hover:text-primary transition-colors hover:bg-base-200/50' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"/></svg>
                        Surat Akhir Magang
                    </a>
                </li>
            @endif
        </ul>
    </div>
    
    <!-- User summary at bottom of sidebar -->
    <div class="p-4 border-t border-base-200 bg-base-50">
        <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-base-200/50 cursor-pointer transition-colors">
            <div class="avatar">
                <div class="w-10 rounded-full border-2 border-primary/20 bg-base-100">
                    <img src="https://ui-avatars.com/api/?name={{ request()->is('dosen*') ? 'Dr.+Budi' : (request()->is('operator*') ? 'Operator' : 'User+Name') }}&background=6B21A8&color=fff&rounded=true" alt="User" />
                </div>
            </div>
            <div class="flex flex-col flex-1 truncate">
                <span class="text-sm font-bold text-base-content truncate">
                    @if(request()->is('dosen*'))
                        Dr. Budi Santoso
                    @elseif(request()->is('operator*'))
                        Operator Sistem
                    @else
                        Mahasiswa SIDUL
                    @endif
                </span>
                <span class="text-xs text-base-content/60 truncate">
                    @if(request()->is('dosen*'))
                        Dosen Pembimbing
                    @elseif(request()->is('operator*'))
                        Administrator
                    @else
                        Mahasiswa
                    @endif
                </span>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </div>
    </div>
</aside>
