<div class="navbar bg-base-100/90 backdrop-blur sticky top-0 z-40 border-b border-base-200 lg:px-8">
    <div class="flex-none lg:hidden">
        <label for="main-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost text-base-content/70 hover:text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </label>
    </div>
    <div class="flex-1 px-2 mx-2">
        <a class="text-xl font-bold lg:hidden text-primary">SIDUL</a>
        <h1 class="text-xl font-semibold hidden lg:block text-base-content/80">@yield('title', 'Dashboard')</h1>
    </div>
    <div class="flex-none gap-4">
        <!-- User Profile Dropdown -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar ring ring-transparent hover:ring-primary/30 transition-all cursor-pointer">
                <div class="w-10 rounded-full border border-gray-100">
                    <img src="https://ui-avatars.com/api/?name=Mahasiswa+SIDUL&background=6B21A8&color=fff&rounded=true&bold=true" alt="User Avatar" />
                </div>
            </label>
            <ul tabindex="0" class="mt-3 z-[1] p-3 shadow-xl menu menu-sm dropdown-content bg-base-100 rounded-box w-64 border border-base-200 gap-1 animate-in fade-in slide-in-from-top-2 duration-200">
                <li class="menu-title px-2 pb-2">
                    <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-0.5">Signed in as</span>
                    <span class="block text-sm font-black text-gray-800 truncate">{{ Auth::user()->email }}</span>
                </li>
                <div class="divider my-0 opacity-50"></div>
                <li>
                    <a href="/mahasiswa/profile" class="py-3 flex items-center gap-3 hover:bg-purple-50 hover:text-[#6B21A8] group transition-colors rounded-xl">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-white shadow-sm transition-colors text-gray-600 group-hover:text-[#6B21A8]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <span class="font-bold text-gray-700">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="/mahasiswa/settings" class="py-3 flex items-center gap-3 hover:bg-purple-50 hover:text-[#6B21A8] group transition-colors rounded-xl">
                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover:bg-white shadow-sm transition-colors text-gray-600 group-hover:text-[#6B21A8]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <span class="font-bold text-gray-700">Settings</span>
                    </a>
                </li>
                <div class="divider my-0 opacity-50"></div>
                <li class="mt-1">
                    <a href="/logout" class="py-3 flex items-center gap-3 hover:bg-red-50 text-red-500 group transition-colors rounded-xl">
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center group-hover:bg-white shadow-sm transition-colors text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                        </div>
                        <span class="font-black uppercase tracking-widest text-[11px]">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
