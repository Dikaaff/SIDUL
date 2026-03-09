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
        <!-- Notifications -->
        <button class="btn btn-ghost btn-circle text-base-content/70 hover:text-primary hover:bg-primary/10 transition-colors">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                <span class="badge badge-xs badge-secondary indicator-item shadow-sm"></span>
            </div>
        </button>
        <!-- User Profile Dropdown -->
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar ring ring-transparent hover:ring-primary/30 transition-all cursor-pointer">
                <div class="w-10 rounded-full">
                    <img src="https://ui-avatars.com/api/?name=User+Name&background=6B21A8&color=fff&rounded=true&bold=true" alt="User Avatar" />
                </div>
            </label>
            <ul tabindex="0" class="mt-3 z-[1] p-3 shadow-xl menu menu-sm dropdown-content bg-base-100 rounded-box w-56 border border-base-200 gap-1">
                <li class="menu-title px-2 pb-2">
                    <span class="block text-xs font-semibold">Signed in as</span>
                    <span class="block text-sm font-bold text-base-content truncate">student@example.com</span>
                </li>
                <div class="divider my-0"></div>
                <li><a class="py-2 hover:bg-base-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>Profile</a></li>
                <li><a class="py-2 hover:bg-base-200"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>Settings</a></li>
                <div class="divider my-0"></div>
                <li class="mt-1 text-error">
                    <a class="py-2 hover:bg-error/10 hover:text-error focus:text-error"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
