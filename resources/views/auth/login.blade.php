@extends('layouts.auth')

@section('title', 'Login Mahasiswa - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded overflow-hidden shadow-2xl border border-gray-100 min-h-[500px] md:min-h-[650px] relative z-10 m-4">
    
    <!-- Left Side: Branding / Illustration with Amikom Image -->
    <div class="w-full lg:w-1/2 p-8 lg:p-16 text-white flex flex-col justify-between relative overflow-hidden group rounded m-2 bg-cover bg-center shadow-inner min-h-[400px] lg:min-h-auto" style="background-image: url('{{ asset('images/amikom.png') }}');">
        <!-- Overlay: Sophisticated gradient for depth -->
        <div class="absolute inset-0 bg-gradient-to-tr from-[#1e0a2e] via-purple-900/60 to-transparent z-0"></div>
        <div class="absolute inset-0 bg-black/10 z-0"></div>
        
        <!-- Top: Brand Identity -->
        <div class="z-10 relative">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-purple-500 rounded-full"></div>
                <span class="text-xl font-black tracking-[0.3em] uppercase opacity-90 text-white">SIDUL</span>
            </div>
        </div>

        <!-- Bottom: Main Inspirational Message -->
        <div class="z-10 relative">
            
            <div class="flex items-center gap-3 pt-8 mt-4 border-t border-white/10">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-white/50">Digital System</span>
                <div class="w-1.5 h-1.5 rounded-full bg-purple-500/50"></div>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-purple-200/70">Amikom Yogyakarta</span>
            </div>
        </div>
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-8 lg:p-16 flex flex-col justify-center bg-white relative">
        <div class="w-full max-w-md mx-auto relative z-10">
            <!-- Mobile Logo Identity -->
            <div class="flex items-center gap-3 mb-12 lg:hidden justify-center">
                <div class="w-1.5 h-10 bg-[#6B21A8] rounded-full"></div>
                <span class="text-4xl font-black tracking-tighter uppercase text-[#6B21A8]">SIDUL</span>
            </div>

            <div class="mb-12 text-center lg:text-left">
                <h2 class="text-4xl font-black tracking-tighter text-gray-900 mb-3">Selamat Datang 👋</h2>
                <p class="text-[15px] font-medium text-gray-400 leading-relaxed max-w-xs mx-auto lg:mx-0">Masuk ke Portal Akademik Magang Terpadu Universitas Amikom Yogyakarta.</p>
            </div>

            <!-- Floating Toast Notification (Kanan Atas) -->
            <div class="fixed top-6 right-6 z-[100] flex flex-col gap-3 w-full max-w-xs pointer-events-none">
                @if ($errors->any())
                    {{-- daisyui: alert --}}
                    <div class="alert bg-white/95 backdrop-blur-md border-l-4 border-red-500 shadow-2xl rounded p-4 flex items-center gap-4 animate-in slide-in-from-right fade-in duration-500 pointer-events-auto">
                        <div class="bg-red-100 p-2 rounded text-red-600 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-800">{{ $errors->first() }}</span>
                    </div>
                @endif

                @if (session('success'))
                    {{-- daisyui: alert --}}
                    <div class="alert bg-white/95 backdrop-blur-md border-l-4 border-green-500 shadow-2xl rounded p-4 flex items-center gap-4 animate-in slide-in-from-right fade-in duration-500 pointer-events-auto">
                        <div class="bg-green-100 p-2 rounded text-green-600 shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-800">{{ session('success') }}</span>
                    </div>
                @endif
            </div>
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Username/NIM/NIK Field -->
                <div>
                    <label for="username" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">Username / NIM</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan NIM Anda" class="w-full bg-white border-2 border-gray-100 rounded py-4 pl-14 pr-4 text-sm font-semibold text-gray-800 hover:border-purple-200 focus:border-[#6B21A8] focus:ring-4 focus:ring-purple-100/50 transition-all outline-none placeholder:text-gray-400 shadow-sm" required />
                    </div>
                    @error('username')
                        <p class="text-xs font-bold text-red-500 mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <div class="mb-2">
                        <label for="password" class="text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full bg-white border-2 border-gray-100 rounded py-4 pl-14 pr-12 text-sm font-semibold text-gray-800 hover:border-purple-200 focus:border-[#6B21A8] focus:ring-4 focus:ring-purple-100/50 transition-all outline-none placeholder:text-gray-400 shadow-sm" required />
                        <button type="button" id="togglePassword" aria-label="Toggle password visibility" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6B21A8] transition-colors p-2 rounded hover:bg-purple-50">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center gap-3 pt-1 pb-3">
                    <label class="flex items-center gap-3 cursor-pointer group/cb">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="checkbox" name="remember" id="remember" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-lg bg-white checked:bg-[#6B21A8] checked:border-[#6B21A8] focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all cursor-pointer shadow-sm" />
                            <svg class="absolute w-3 h-3 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-600 group-hover/cb:text-gray-900 transition-colors select-none">Biarkan saya tetap masuk</span>
                    </label>
                </div>
                
                <button type="submit" class="w-full bg-amber-400 hover:bg-amber-500 text-white rounded py-4 px-8 font-black uppercase tracking-widest text-[13px] transition-all duration-300 shadow-lg shadow-amber-900/20 active:scale-95 flex items-center justify-center gap-2">
                    <span>Masuk ke SIDUL</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </form>
            
            <div class="mt-10 text-center">
                <span class="text-[11px] font-bold text-gray-400">Pastikan Anda menggunakan akun dari<br>Universitas Amikom Yogyakarta.</span> 
            </div>
        </div>
    </div>
</div>

<!-- Background Elements for Auth Layout -->
<div class="fixed inset-0 z-0 bg-[#6B21A8] pointer-events-none">
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-white/10 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3"></div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-hide login toasts after 2 seconds
    document.addEventListener('DOMContentLoaded', () => {
        const toasts = document.querySelectorAll('.alert');
        toasts.forEach(toast => {
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-x-full');
                toast.classList.add('transition-all', 'duration-500');
                setTimeout(() => toast.remove(), 500);
            }, 2000);
        });
    });

    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('text-[#6B21A8]');
    });
</script>
@endpush
