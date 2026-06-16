{{-- daisyui: navbar --}}
<div class="navbar bg-base-100/90 backdrop-blur sticky top-0 z-40 border-b border-base-200 lg:px-8">
    <div class="flex-none lg:hidden">
        {{-- daisyui: btn --}}
        <button onclick="toggleSidebar()" aria-label="Toggle sidebar menu" class="btn btn-square btn-ghost text-base-content/70 hover:text-[#6B21A8]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>
    <div class="flex-1 px-2 mx-2">
        <a class="text-xl font-bold lg:hidden text-[#6B21A8]">SIDUL</a>
        <h1 class="text-xl font-semibold hidden lg:block text-base-content/80">@yield('title', 'Dashboard')</h1>
    </div>
    <div class="flex-none gap-4">
        <!-- User Profile Dropdown -->
        {{-- daisyui: dropdown --}}
        <div class="dropdown dropdown-end">
            {{-- daisyui: btn + avatar --}}
            <label tabindex="0" class="btn btn-ghost btn-circle avatar ring ring-transparent hover:ring-primary/30 transition-all cursor-pointer">
                <div class="w-10 rounded-full border border-gray-100">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()?->display_name ?? 'User') }}&background=6B21A8&color=fff&rounded=true&bold=true" alt="User Avatar" />
                </div>
            </label>
            {{-- dropdown menu (non-daisyui, full tailwind) --}}
            <ul tabindex="0" class="mt-3 z-[1] p-3 shadow-xl dropdown-content bg-base-100 rounded-box w-64 border border-base-200 animate-in fade-in slide-in-from-top-2 duration-200">
                <li class="px-2 pb-2 list-none">
                    <span class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-0.5">Signed in as</span>
                    <span class="block text-sm font-black text-gray-800 truncate">{{ Auth::user()?->display_name ?? 'Guest' }}</span>
                    <span class="block text-[10px] font-bold text-gray-400 truncate">{{ Auth::user()?->username }}</span>
                </li>
                <div class="h-px bg-gray-100 my-2"></div>
                <li class="list-none">
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-3 hover:bg-red-50 focus:bg-red-50 active:bg-red-50 text-red-500 transition-colors rounded-2xl outline-none">
                            <div class="w-8 h-8 rounded-2xl bg-red-50 flex items-center justify-center group-hover:bg-white shadow-sm text-red-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            </div>
                            <span class="font-black uppercase tracking-widest text-[11px]">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
