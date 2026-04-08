@extends('layouts.auth')

@section('title', 'Login Mahasiswa - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 min-h-[600px] relative z-10 m-4">
    
    <!-- Left Side: Branding / Illustration -->
    <div class="lg:w-1/2 bg-[#6B21A8] p-12 text-white flex flex-col justify-between relative overflow-hidden group hidden lg:flex rounded-[2rem] m-2">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-all duration-1000"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#F49E0A]/20 rounded-full blur-3xl group-hover:scale-150 transition-all duration-1000"></div>
        
        <div class="z-10 relative">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-2xl bg-white text-[#6B21A8] flex items-center justify-center font-black text-2xl shadow-xl shadow-purple-900/50">
                    S
                </div>
                <span class="text-2xl font-black tracking-tighter uppercase">SIDUL</span>
            </div>
                
            <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter leading-none mb-6">Portal Mahasiswa<br>Magang Terpadu</h1>
            <p class="text-white/80 font-bold text-sm max-w-sm tracking-wide leading-relaxed">Kelola ID Magang, Logbook, Bimbingan Akademik, hingga Laporan Akhir. Semuanya dalam satu genggaman cepat.</p>
        </div>
        
        <div class="z-10 relative">
            <div class="flex -space-x-4 mb-4">
                <img class="w-12 h-12 border-4 border-[#6B21A8] rounded-full bg-white object-cover shadow-lg" src="https://ui-avatars.com/api/?name=Ali&background=F49E0A&color=fff&bold=true" alt="Mahasiswa 1">
                <img class="w-12 h-12 border-4 border-[#6B21A8] rounded-full bg-white object-cover shadow-lg" src="https://ui-avatars.com/api/?name=Budi&background=white&color=6B21A8&bold=true" alt="Mahasiswa 2">
                <img class="w-12 h-12 border-4 border-[#6B21A8] rounded-full bg-white object-cover shadow-lg" src="https://ui-avatars.com/api/?name=Siti&background=F49E0A&color=fff&bold=true" alt="Mahasiswa 3">
                <div class="w-12 h-12 border-4 border-[#6B21A8] rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-[10px] font-black shadow-lg">+2K</div>
            </div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-white/80">Bergabung dengan ribuan mahasiswa lainnya.</p>
        </div>
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-8 lg:p-14 flex flex-col justify-center bg-white relative">
        <div class="w-full max-w-sm mx-auto relative z-10">
            <!-- Mobile Logo -->
            <div class="flex items-center gap-2 mb-10 lg:hidden justify-center">
                <div class="w-10 h-10 rounded-xl bg-[#6B21A8] text-white flex items-center justify-center font-black text-xl shadow-lg">S</div>
                <span class="text-2xl font-black tracking-tighter uppercase text-[#6B21A8]">SIDUL</span>
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-black tracking-tighter uppercase text-gray-800 mb-2">Selamat Datang 👋</h2>
                <p class="text-[11px] font-bold uppercase tracking-widest text-gray-600">Silakan login untuk memantau progress magangmu.</p>
            </div>

            <!-- Enhanced Alert/Notification -->
            @if ($errors->any() || session('error'))
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl flex items-start gap-3 animate-in fade-in slide-in-from-top duration-300">
                    <div class="p-1 bg-red-100 rounded-lg text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-widest text-red-600 mb-1">Gagal Masuk</p>
                        <p class="text-[10px] font-bold text-red-500/80 leading-relaxed">
                            {{ $errors->first('login') ?: session('error') ?: 'Kredensial tidak valid. Silakan cek kembali data Anda.' }}
                        </p>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-2xl flex items-start gap-3 animate-in fade-in slide-in-from-top duration-300">
                    <div class="p-1 bg-green-100 rounded-lg text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-widest text-green-600 mb-1">Berhasil</p>
                        <p class="text-[10px] font-bold text-green-500/80 leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Username/Email Field -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-2">Email / NIM</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="text" name="login" value="{{ old('login') }}" placeholder="Masukkan NIM atau Email" class="w-full bg-gray-50 border-none rounded-2xl py-4 pl-12 pr-4 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-purple-100 transition-all outline-none placeholder:text-gray-300" required />
                    </div>
                    @error('login')
                        <p class="text-[10px] font-bold text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-gray-600">Password</label>
                        <a href="#" class="text-[10px] font-black uppercase tracking-widest text-[#F49E0A] hover:underline transition-all">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full bg-gray-50 border-none rounded-2xl py-4 pl-12 pr-12 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-purple-100 transition-all outline-none placeholder:text-gray-300" required />
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#6B21A8] transition-colors">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center gap-3 pt-2">
                    <input type="checkbox" name="remember" id="remember" class="w-5 h-5 rounded-md border-gray-300 text-[#6B21A8] focus:ring-[#6B21A8] bg-gray-50 cursor-pointer" />
                    <label for="remember" class="text-[11px] font-bold text-gray-700 cursor-pointer select-none">Biarkan saya tetap masuk</label>
                </div>
                
                <button type="submit" class="w-full bg-[#6B21A8] hover:bg-purple-800 text-white rounded-2xl py-4 font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-purple-900/20 hover:scale-[1.02] active:scale-95 transition-all">
                    Login Platform
                </button>
            </form>
            
            <div class="mt-10 text-center">
                <span class="text-[11px] font-bold text-gray-600">Mahasiswa baru?</span> 
                <a href="/register" class="text-[10px] font-black uppercase tracking-widest text-[#6B21A8] hover:underline ml-1">Buat Akun Sekarang</a>
            </div>
        </div>
    </div>
</div>

<!-- Background Elements for Auth Layout -->
<div class="fixed inset-0 z-0 bg-gray-50 pointer-events-none">
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
