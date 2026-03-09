<aside class="w-80 h-full bg-base-100 border-r border-base-200 flex flex-col shadow-xl">
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-base-200 gap-3 sticky top-0 bg-base-100 z-10">
        <img src="/sidul.png" alt="SIDUL Logo" class="w-10 h-10 object-contain" />
        <span class="text-xl font-bold text-[#6B21A8]">
            SIDUL
        </span>
    </div>

    <!-- Navigation Menu -->
    <div class="p-4 flex-1 overflow-y-auto">
        <ul class="menu menu-md w-full gap-3 text-base-content/70 font-semibold px-4 py-6">
            <li class="menu-title text-[10px] font-extrabold uppercase tracking-[0.15em] text-base-content/40 mb-2 px-2">
                MAIN NAVIGATION
            </li>
            
            @if(request()->is('dashboard/dosen', 'dosen/*'))
                <!-- DOSEN MENU -->
                <li>
                    <a href="/dashboard/dosen" class="{{ request()->is('dashboard/dosen') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Dosen
                    </a>
                </li>
                <li>
                    <a href="/dosen/rekomendasi" class="{{ request()->is('dosen/rekomendasi') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Rekomendasi Magang
                        <span class="badge badge-sm badge-secondary ml-auto text-xs">3</span>
                    </a>
                </li>
                <li>
                    <a href="/dosen/monitoring" class="{{ request()->is('dosen/monitoring') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Monitoring Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="/dosen/logbook" class="{{ request()->is('dosen/logbook') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Review Logbook
                    </a>
                </li>
                <li>
                    <a href="/dosen/bimbingan" class="{{ request()->is('dosen/bimbingan') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                        Bimbingan Laporan
                        <span class="badge badge-sm badge-warning ml-auto text-xs">5</span>
                    </a>
                </li>
                <li>
                    <a href="/dosen/penilaian" class="{{ request()->is('dosen/penilaian') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Penilaian Magang
                    </a>
                </li>
            @elseif(request()->is('dashboard/operator', 'operator/*'))
                <!-- OPERATOR MENU -->
                <li>
                    <a href="/dashboard/operator" class="{{ request()->is('dashboard/operator') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Operator
                    </a>
                </li>
                <li>
                    <a href="/operator/verifikasi" class="{{ request()->is('operator/verifikasi') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Verifikasi Dokumen
                        <span class="badge badge-sm badge-secondary ml-auto text-xs">12</span>
                    </a>
                </li>
                <li>
                    <a href="/operator/id-magang" class="{{ request()->is('operator/id-magang') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        Kelola ID Magang
                    </a>
                </li>
                <li>
                    <a href="/operator/surat-pengantar" class="{{ request()->is('operator/surat-pengantar') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Surat Pengantar Magang
                    </a>
                </li>
                <li>
                    <a href="/operator/dosen-pembimbing" class="{{ request()->is('operator/dosen-pembimbing') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Dosen Pembimbing
                    </a>
                </li>
                <li>
                    <a href="/operator/monitoring" class="{{ request()->is('operator/monitoring') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Monitoring Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="/operator/laporan" class="{{ request()->is('operator/laporan') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Laporan Magang
                    </a>
                </li>
                <li>
                    <a href="/operator/arsip" class="{{ request()->is('operator/arsip') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        Arsip Magang
                    </a>
                </li>
            @else
                <!-- MAHASISWA MENU -->
                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/konsultasi" class="{{ request()->is('konsultasi') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2m12-10a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        Konsultasi Dosen Wali
                    </a>
                </li>
                <li>
                    <a href="/id-magang" class="{{ request()->is('id-magang') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                        Pengajuan ID Magang
                    </a>
                </li>
                <li>
                    <a href="/surat-pengantar" class="{{ request()->is('surat-pengantar') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Pengajuan Surat Pengantar
                    </a>
                </li>
                <li>
                    <a href="/dosen-pembimbing" class="{{ request()->is('dosen-pembimbing') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        Pengajuan Dosen Pembimbing
                    </a>
                </li>
                <li>
                    <a href="/logbook" class="{{ request()->is('logbook') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                        Logbook Magang
                    </a>
                </li>
                <li>
                    <a href="/laporan" class="{{ request()->is('laporan') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        Upload Laporan Magang
                    </a>
                </li>
                <li>
                    <a href="/presentasi" class="{{ request()->is('presentasi') ? 'active bg-[#6B21A8] text-white shadow-lg shadow-[#6B21A8]/30 rounded-xl py-3 px-4' : 'hover:bg-[#6B21A8]/5 hover:text-[#6B21A8] transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                        Upload Presentasi
                    </a>
                </li>

            @endif
        </ul>
    </div>
    
    <!-- User summary at bottom of sidebar -->
    <div class="p-6 border-t border-base-200 bg-gray-50/50">
        <div class="flex items-center gap-4 p-3 rounded-2xl bg-white border border-base-200 shadow-sm hover:shadow-md transition-all cursor-pointer group">
            <div class="avatar online">
                <div class="w-11 rounded-xl ring ring-[#6B21A8]/10 ring-offset-base-100 ring-offset-2">
                    <img src="https://ui-avatars.com/api/?name={{ request()->is('dashboard/dosen', 'dosen/*') ? 'Dr.+Budi' : (request()->is('operator*') ? 'Operator' : 'User+Name') }}&background=6B21A8&color=fff&rounded=true&bold=true" alt="User" />
                </div>
            </div>
            <div class="flex flex-col flex-1 min-w-0">
                <span class="text-sm font-bold text-gray-800 truncate group-hover:text-[#6B21A8] transition-colors">
                    @if(request()->is('dashboard/dosen', 'dosen/*'))
                        Dr. Budi Santoso
                    @elseif(request()->is('operator*'))
                        Operator Sistem
                    @else
                        Mahasiswa SIDUL
                    @endif
                </span>
                <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider">
                    @if(request()->is('dashboard/dosen', 'dosen/*'))
                        Dosen Pembimbing
                    @elseif(request()->is('operator*'))
                        Administrator
                    @else
                        Mahasiswa
                    @endif
                </span>
            </div>
            <div class="text-gray-300 group-hover:text-[#6B21A8] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            </div>
        </div>
    </div>
</aside>
