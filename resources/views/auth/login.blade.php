@extends('layouts.auth')

@section('title', 'Masuk Mahasiswa - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-2xl overflow-hidden shadow-2xl border border-gray-100 min-h-[500px] md:min-h-[650px] relative z-10 m-4">
    
    <!-- Left Side: Branding / Illustration with Amikom Image -->
    <div class="w-full lg:w-1/2 p-5 lg:p-16 text-white flex flex-col justify-between relative overflow-hidden group rounded-2xl lg:m-2 bg-cover bg-center shadow-inner min-h-[130px] lg:min-h-auto" style="background-image: url('{{ asset('images/amikom.png') }}');">
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
        
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-5 lg:p-16 flex flex-col justify-center bg-white relative">
        <div class="w-full max-w-md mx-auto relative z-10">
            <div class="mb-5 lg:mb-12 text-center lg:text-left">
                <h2 class="hidden lg:block text-4xl font-black tracking-tighter text-gray-900 mb-3">Selamat Datang 👋</h2>
                <p class="text-[14px] lg:text-[15px] font-medium text-gray-400 leading-relaxed max-w-xs mx-auto lg:mx-0">Masuk ke Portal Akademik Magang Terpadu Universitas Amikom Yogyakarta.</p>
            </div>

            <!-- Floating Validation Error -->
            @if ($errors->any())
            <div class="fixed top-8 right-8 z-[9999] max-w-xs pointer-events-auto">
                <div class="bg-white/95 backdrop-blur-md border-l-4 border-red-500 shadow-2xl rounded-2xl p-5 flex items-center gap-4 animate-in fade-in slide-in-from-right-8 duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center shadow-lg shadow-red-500/10 text-red-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-widest leading-tight text-gray-800">Terjadi Kesalahan!</p>
                        <p class="text-xs text-gray-500 font-bold mt-0.5">{{ $errors->first() }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4 lg:space-y-6">
                @csrf
                <!-- Username/NIM/NIK Field -->
                <div>
                    <label for="username" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">NIM / NIK / Nama Pengguna</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan NIM Anda" class="w-full bg-white border-2 border-gray-100 rounded-2xl py-3 lg:py-4 pl-14 pr-4 text-sm font-semibold text-gray-800 hover:border-purple-200 focus:border-[#6B21A8] focus:ring-4 focus:ring-purple-100/50 transition-all outline-none placeholder:text-gray-400 shadow-sm" required />
                    </div>
                    @error('username')
                        <p class="text-xs font-bold text-red-500 mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <div class="mb-2">
                        <label for="password" class="text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full bg-white border-2 border-gray-100 rounded-2xl py-3 lg:py-4 pl-14 pr-12 text-sm font-semibold text-gray-800 hover:border-purple-200 focus:border-[#6B21A8] focus:ring-4 focus:ring-purple-100/50 transition-all outline-none placeholder:text-gray-400 shadow-sm" required />
                        <button type="button" id="togglePassword" aria-label="Toggle password visibility" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6B21A8] transition-colors p-2 rounded-2xl hover:bg-purple-50">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center gap-3 pb-3">
                    <label class="flex items-center gap-3 cursor-pointer group/cb">
                        <div class="relative flex items-center justify-center w-5 h-5">
                            <input type="checkbox" name="remember" id="remember" class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-2xl bg-white checked:bg-[#6B21A8] checked:border-[#6B21A8] focus:ring-2 focus:ring-purple-200 focus:ring-offset-2 transition-all cursor-pointer shadow-sm" />
                            <svg class="absolute w-3 h-3 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-600 group-hover/cb:text-gray-900 transition-colors select-none">Biarkan saya tetap masuk</span>
                    </label>
                </div>
                
                <x-button type="submit" variant="primary" size="lg" full>
                    <span>Masuk ke SIDUL</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </x-button>
            </form>
            
            <div class="mt-6 lg:mt-10 text-center">
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
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('text-[#6B21A8]');
    });
</script>
@endpush
