@extends('layouts.auth')

@section('title', 'Login Mahasiswa - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 min-h-[650px] relative z-10 m-4">
    
    <!-- Left Side: Branding / Illustration with Amikom Image -->
    <div class="lg:w-1/2 p-12 text-white flex flex-col justify-between relative overflow-hidden group hidden lg:flex rounded-[2rem] m-2 bg-cover bg-center shadow-inner" style="background-image: url('/images/amikom.jpg');">
        <!-- Overlay to ensure text readability -->
        <div class="absolute inset-0 bg-gradient-to-b from-purple-900/90 via-[#6B21A8]/70 to-[#1e0a2e]/95 z-0 mix-blend-multiply transition-opacity duration-500 group-hover:opacity-90"></div>
        <div class="absolute inset-0 bg-black/20 z-0"></div>
        
        <div class="z-10 relative">
            <div class="flex items-center gap-4 mb-10">
                <div class="w-14 h-14 rounded-[1.2rem] bg-white/10 backdrop-blur-md border border-white/30 text-white flex items-center justify-center font-black text-3xl shadow-2xl">
                    S
                </div>
                <span class="text-3xl font-black tracking-widest uppercase drop-shadow-md">SIDUL</span>
            </div>
                
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter leading-tight mb-6 drop-shadow-lg text-transparent bg-clip-text bg-gradient-to-br from-white via-purple-100 to-[#d8b4fe]">
                Portal Mahasiswa<br>Magang Terpadu
            </h1>
            <p class="text-white/95 font-medium text-[15px] max-w-md tracking-wide leading-relaxed drop-shadow-md backdrop-blur-sm bg-black/20 p-5 rounded-2xl border border-white/10 shadow-inner">
                Sistem Informasi Manajemen Magang <strong class="font-black text-white">Universitas Amikom Yogyakarta</strong>. Kelola Pendaftaran, Logbook, Bimbingan, hingga Laporan Akhir dengan mudah dan terstruktur.
            </p>
        </div>
        
        <div class="z-10 relative mt-12 bg-white/10 backdrop-blur-md border border-white/20 p-5 rounded-[1.5rem] inline-block shadow-xl">
            <div class="flex items-center gap-4">
                <div class="flex -space-x-3">
                    <img class="w-11 h-11 border-2 border-[#6B21A8] rounded-full object-cover shadow-lg" src="https://ui-avatars.com/api/?name=Fauzi&background=F49E0A&color=fff&bold=true" alt="Mahasiswa 1">
                    <img class="w-11 h-11 border-2 border-[#6B21A8] rounded-full object-cover shadow-lg" src="https://ui-avatars.com/api/?name=Dika&background=white&color=6B21A8&bold=true" alt="Mahasiswa 2">
                    <img class="w-11 h-11 border-2 border-[#6B21A8] rounded-full object-cover shadow-lg" src="https://ui-avatars.com/api/?name=Arby&background=F49E0A&color=fff&bold=true" alt="Mahasiswa 3">
                </div>
                <div>
                    <div class="flex items-center gap-1 text-yellow-400 mb-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 drop-shadow" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 drop-shadow" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 drop-shadow" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 drop-shadow" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 drop-shadow opacity-50" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                    </div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-white/90">Dipercaya 2K+ Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-8 lg:p-16 flex flex-col justify-center bg-white relative">
        <div class="w-full max-w-md mx-auto relative z-10">
            <!-- Mobile Logo -->
            <div class="flex items-center gap-3 mb-10 lg:hidden justify-center">
                <div class="w-12 h-12 rounded-[1rem] bg-gradient-to-br from-[#6B21A8] to-purple-900 text-white flex items-center justify-center font-black text-2xl shadow-xl shadow-purple-900/30">S</div>
                <span class="text-3xl font-black tracking-tighter uppercase text-[#6B21A8]">SIDUL</span>
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl md:text-4xl font-black tracking-tighter text-gray-900 mb-3">Welcome Back! 👋</h2>
                <p class="text-sm font-medium text-gray-500 leading-relaxed">Masuk dengan akun akademik Anda untuk melanjutkan progres magang hari ini.</p>
            </div>

            <!-- Enhanced Alert/Notification -->
            @if ($errors->any() || session('error'))
                <div class="mb-8 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-4 animate-in fade-in slide-in-from-top duration-300 shadow-sm">
                    <div class="p-2 bg-red-100 rounded-xl text-red-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-red-700 mb-1">Login Gagal</p>
                        <p class="text-[11px] font-bold text-red-600/80 leading-relaxed">
                            {{ $errors->first('username') ?: session('error') ?: 'Kredensial tidak valid. Silakan cek kembali data Anda.' }}
                        </p>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-start gap-4 animate-in fade-in slide-in-from-top duration-300 shadow-sm">
                    <div class="p-2 bg-green-100 rounded-xl text-green-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-black uppercase tracking-widest text-green-700 mb-1">Berhasil</p>
                        <p class="text-[11px] font-bold text-green-600/80 leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Username/NIM/NIK Field -->
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wider">Username / NIM</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="text" name="username" value="{{ old('username') }}" placeholder="Masukkan NIM Anda" class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 pl-14 pr-4 text-sm font-semibold text-gray-800 hover:border-purple-200 focus:border-[#6B21A8] focus:ring-4 focus:ring-purple-100/50 transition-all outline-none placeholder:text-gray-400 shadow-sm" required />
                    </div>
                    @error('username')
                        <p class="text-xs font-bold text-red-500 mt-2 ml-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs font-bold text-[#6B21A8] hover:text-purple-800 hover:underline transition-all">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full bg-white border-2 border-gray-100 rounded-2xl py-4 pl-14 pr-12 text-sm font-semibold text-gray-800 hover:border-purple-200 focus:border-[#6B21A8] focus:ring-4 focus:ring-purple-100/50 transition-all outline-none placeholder:text-gray-400 shadow-sm" required />
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6B21A8] transition-colors p-2 rounded-xl hover:bg-purple-50">
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
                
                <button type="submit" class="w-full relative group/btn overflow-hidden rounded-2xl p-[1px] shadow-lg shadow-purple-900/10">
                    <span class="absolute inset-0 bg-gradient-to-r from-purple-500 via-[#6B21A8] to-purple-800 rounded-2xl opacity-90 group-hover/btn:opacity-100 transition-opacity duration-300"></span>
                    <div class="relative bg-gradient-to-r from-purple-500 via-[#6B21A8] to-purple-800 px-8 py-4 rounded-[15px] flex items-center justify-center gap-2 transition-all duration-300 group-hover/btn:shadow-[0_0_2.5rem_-0.5rem_#6B21A8]">
                        <span class="font-black text-white uppercase tracking-widest text-[13px] relative z-10 drop-shadow-md">Masuk ke SIDUL</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white group-hover/btn:translate-x-1 transition-transform relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </div>
                </button>
            </form>
            
            <div class="mt-10 text-center">
                <span class="text-[11px] font-bold text-gray-400">Pastikan Anda menggunakan akun dari<br>Universitas Amikom Yogyakarta.</span> 
            </div>
        </div>
    </div>
</div>

<!-- Background Elements for Auth Layout -->
<div class="fixed inset-0 z-0 bg-slate-50 pointer-events-none">
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-[#6B21A8]/5 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-[#F49E0A]/5 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3"></div>
</div>
@endsection

@push('scripts')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // toggle the eye icon (optional: you could change the SVG path here)
        this.classList.toggle('text-[#6B21A8]');
    });
</script>
@endpush
