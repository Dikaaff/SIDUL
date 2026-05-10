<div class="navbar bg-base-100/90 backdrop-blur sticky top-0 z-40 border-b border-base-200 lg:px-8">
    <div class="flex-none lg:hidden">
        <button onclick="toggleSidebar()" class="btn btn-square btn-ghost text-base-content/70 hover:text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
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
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()?->name ?? 'User') }}&background=6B21A8&color=fff&rounded=true&bold=true" alt="User Avatar" />
                </div>
            </label>
            <ul tabindex="0" class="mt-3 z-[1] p-3 shadow-xl menu menu-sm dropdown-content bg-base-100 rounded-box w-64 border border-base-200 gap-1 animate-in fade-in slide-in-from-top-2 duration-200">
                <li class="menu-title px-2 pb-2">
                    <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-0.5">Signed in as</span>
                    <span class="block text-sm font-black text-gray-800 truncate">{{ Auth::user()?->name ?? 'Guest' }}</span>
                    <span class="block text-[10px] font-bold text-gray-400 truncate">{{ Auth::user()?->username }}</span>
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
