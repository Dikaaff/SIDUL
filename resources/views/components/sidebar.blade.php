<nav class="w-80 h-full bg-white border-r border-gray-100 flex flex-col relative z-[100]">
    <!-- Logo -->
    <div class="h-16 flex items-center px-6 border-b border-gray-50 gap-3 sticky top-0 bg-white z-10">
        <img src="/sidul.png" alt="SIDUL Logo" class="w-10 h-10 object-contain" />
        <span class="text-xl font-bold text-primary">
            SIDUL
        </span>
    </div>

    <!-- Navigation Menu -->
    <div class="p-4 flex-1 overflow-y-auto">
        <ul class="menu menu-md w-full gap-3 text-base-content/70 font-semibold px-4 py-6">
            <li class="menu-title text-[10px] font-extrabold uppercase tracking-[0.15em] text-base-content/40 mb-2 px-2">
                MAIN NAVIGATION
            </li>
            
            @php $userRole = Auth::user()?->role ?? 'mahasiswa'; @endphp

            @if($userRole === 'dosen')
                <!-- DOSEN MENU -->
                <li>
                    <a href="/dashboard/dosen" class="{{ request()->is('dashboard/dosen') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Dosen
                    </a>
                </li>
                <li>
                    <a href="/dosen/rekomendasi" class="{{ request()->is('dosen/rekomendasi') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Rekomendasi Magang
                        <span class="badge badge-sm badge-secondary ml-auto text-xs">3</span>
                    </a>
                </li>
                <li>
                    <a href="/dosen/monitoring" class="{{ request()->is('dosen/monitoring') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Monitoring Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="/dosen/logbook" class="{{ request()->is('dosen/logbook') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        Review Logbook
                    </a>
                </li>
                <li>
                    <a href="/dosen/bimbingan" class="{{ request()->is('dosen/bimbingan') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z"/></svg>
                        Bimbingan Laporan
                        <span class="badge badge-sm badge-warning ml-auto text-xs">5</span>
                    </a>
                </li>
            @elseif($userRole === 'operator')
                <!-- OPERATOR MENU -->
                <li>
                    <a href="/dashboard/operator" class="{{ request()->is('dashboard/operator') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Operator
                    </a>
                </li>
                <li>
                    <a href="/operator/verifikasi" class="{{ request()->is('operator/verifikasi') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Verifikasi Dokumen
                        <span class="badge badge-sm badge-secondary ml-auto text-xs">12</span>
                    </a>
                </li>
                <li>
                    <a href="/operator/id-magang" class="{{ request()->is('operator/id-magang') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        Kelola ID Magang
                    </a>
                </li>
                <li>
                    <a href="/operator/surat-pengantar" class="{{ request()->is('operator/surat-pengantar') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Surat Pengantar Magang
                    </a>
                </li>
                <li>
                    <a href="/operator/dosen-pembimbing" class="{{ request()->is('operator/dosen-pembimbing') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Dosen Pembimbing
                    </a>
                </li>
                <li>
                    <a href="/operator/monitoring" class="{{ request()->is('operator/monitoring') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Monitoring Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="/operator/laporan" class="{{ request()->is('operator/laporan') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Laporan Magang
                    </a>
                </li>
                <li>
                    <a href="/operator/arsip" class="{{ request()->is('operator/arsip') ? 'active bg-primary text-white rounded-xl py-3 px-4' : 'hover:bg-primary/5 hover:text-primary transition-all duration-300 rounded-xl py-3 px-4' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        Arsip Magang
                    </a>
                </li>
            @else
                <!-- MAHASISWA MENU -->
                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md' : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 transition-all duration-300 rounded-xl py-3 px-4 font-bold' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/pendaftaran" class="{{ request()->is('mahasiswa/pendaftaran') ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md' : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 transition-all duration-300 rounded-xl py-3 px-4 font-bold' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Pendaftaran Magang
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/progress" class="{{ request()->is('mahasiswa/progress') ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md' : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 transition-all duration-300 rounded-xl py-3 px-4 font-bold' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        Progress Magang
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/logbook" class="{{ request()->is('mahasiswa/logbook') ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md' : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 transition-all duration-300 rounded-xl py-3 px-4 font-bold' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Logbook Harian
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/bimbingan" class="{{ request()->is('mahasiswa/bimbingan') ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md' : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 transition-all duration-300 rounded-xl py-3 px-4 font-bold' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>
                        Bimbingan Dosen
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/laporan" class="{{ request()->is('mahasiswa/laporan') ? 'active bg-[#6B21A8] text-white rounded-xl py-3 px-4 font-bold shadow-md' : 'hover:bg-purple-50 hover:text-[#6B21A8] text-gray-600 transition-all duration-300 rounded-xl py-3 px-4 font-bold' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Unggah Laporan
                    </a>
                </li>



            @endif
        </ul>
    </div>
    
    <!-- User summary at bottom of sidebar with Popup Menu -->
    <div class="p-6 border-t border-gray-50 bg-gray-50/30">
        <div class="dropdown dropdown-top dropdown-end w-full">
            <div tabindex="0" role="button" class="flex items-center gap-4 p-3 rounded-2xl bg-white border border-gray-100 hover:bg-gray-50 transition-all cursor-pointer group shadow-sm w-full">
                <div class="avatar online">
                    <div class="w-11 rounded-xl ring ring-primary/10 ring-offset-base-100 ring-offset-2">
                        <img id="sidebar-avatar" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()?->name ?? 'User') }}&background={{ Auth::user()?->role === 'dosen' ? 'F49E0A' : (Auth::user()?->role === 'operator' ? '2563EB' : '6B21A8') }}&color=fff&rounded=true&bold=true" alt="User" />
                    </div>
                </div>
                <div class="flex flex-col flex-1 min-w-0">
                    <span class="text-sm font-bold text-gray-800 truncate group-hover:text-primary transition-colors text-left">
                        {{ Auth::user()?->name ?? 'User' }}
                    </span>
                    <span class="text-[10px] font-medium text-gray-500 uppercase tracking-wider text-left">
                        @php $role = Auth::user()?->role ?? 'mahasiswa'; @endphp
                        @if($role === 'dosen') Dosen Pembimbing
                        @elseif($role === 'operator') Administrator
                        @else Mahasiswa
                        @endif
                    </span>
                </div>
                <div class="text-gray-300 group-hover:text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                </div>
            </div>
            
            <ul tabindex="0" class="dropdown-content z-[1] menu p-3 shadow-2xl bg-white rounded-[2rem] w-64 mb-4 border border-gray-100 gap-1 animate-in fade-in slide-in-from-bottom-2 duration-200">
                <li class="menu-title px-4 py-2 border-b border-gray-50 mb-1">
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Manage Account</span>
                </li>
                <li>
                    <a href="/mahasiswa/profile" class="flex items-center gap-3 py-3 px-4 hover:bg-purple-50 text-gray-700 hover:text-[#6B21A8] rounded-xl transition-all group/item">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover/item:bg-white shadow-sm transition-colors text-gray-500 group-hover/item:text-[#6B21A8]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <span class="font-bold text-sm">Profil Saya</span>
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/settings" class="flex items-center gap-3 py-3 px-4 hover:bg-purple-50 text-gray-700 hover:text-[#6B21A8] rounded-xl transition-all group/item">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover/item:bg-white shadow-sm transition-colors text-gray-500 group-hover/item:text-[#6B21A8]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <span class="font-bold text-sm">Pengaturan</span>
                    </a>
                </li>
                <div class="divider my-1 opacity-50"></div>
                <li>
                    <a href="/logout" class="flex items-center gap-3 py-3 px-4 hover:bg-red-50 text-red-500 rounded-xl transition-all group/item">
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center group-hover/item:bg-white shadow-sm transition-colors text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </div>
                        <span class="font-black uppercase tracking-widest text-[10px]">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
