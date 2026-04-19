@extends('layouts.auth')

@section('title', 'Daftar Akun Baru - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 min-h-[600px] relative z-10 m-4">
    
    <!-- Left Side: Branding / Illustration -->
    <div class="lg:w-1/2 bg-[#F49E0A] p-12 text-white flex flex-col justify-between relative overflow-hidden group hidden lg:flex rounded-[2rem] m-2 shadow-xl shadow-orange-200">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/20 rounded-full blur-3xl group-hover:scale-150 transition-all duration-1000"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-[#6B21A8]/20 rounded-full blur-3xl group-hover:scale-150 transition-all duration-1000"></div>
        
        <div class="z-10 relative">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-12 h-12 rounded-2xl bg-white text-[#F49E0A] flex items-center justify-center font-black text-2xl shadow-xl shadow-orange-900/10">
                    S
                </div>
                <span class="text-2xl font-black tracking-tighter uppercase">SIDUL</span>
            </div>
            
            <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tighter leading-none mb-6">Mulai Perjalanan<br>Magang Anda</h1>
            <p class="text-white/90 font-bold text-sm max-w-sm tracking-wide leading-relaxed">Daftarkan diri Anda untuk mengakses ribuan lowongan magang berkualitas dan pantau progress bimbingan secara real-time.</p>
        </div>
        
        <div class="z-10 relative">
            <div class="bg-white/20 backdrop-blur-md p-6 rounded-3xl border border-white/30">
                <p class="text-xs font-bold leading-relaxed italic">"SIDUL memudahkan saya mengelola semua administrasi magang hanya dari satu aplikasi. Sangat membantu!"</p>
                <div class="flex items-center gap-3 mt-4">
                    <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-[#F49E0A] font-black text-[10px]">DA</div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest">Dika Afif</p>
                        <p class="text-[8px] font-bold text-white/70 tracking-widest uppercase">Mahasiswa Informatika</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Side: Register Form -->
    <div class="lg:w-1/2 p-8 lg:p-14 flex flex-col justify-center bg-white relative">
        <div class="w-full max-w-sm mx-auto relative z-10">
            <!-- Mobile Logo -->
            <div class="flex items-center gap-2 mb-10 lg:hidden justify-center">
                <div class="w-10 h-10 rounded-xl bg-[#F49E0A] text-white flex items-center justify-center font-black text-xl shadow-lg">S</div>
                <span class="text-2xl font-black tracking-tighter uppercase text-[#F49E0A]">SIDUL</span>
            </div>

            <div class="mb-10 text-center lg:text-left">
                <h2 class="text-3xl font-black tracking-tighter uppercase text-gray-800 mb-2">Buat Akun 🚀</h2>
                <p class="text-[11px] font-bold uppercase tracking-widest text-gray-600">Lengkapi data diri Anda untuk memulai.</p>
            </div>

            <!-- Enhanced Alert/Notification -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl flex items-start gap-3 animate-in fade-in slide-in-from-top duration-300">
                    <div class="p-1 bg-red-100 rounded-lg text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-black uppercase tracking-widest text-red-600 mb-1">Pendaftaran Gagal</p>
                        <p class="text-[10px] font-bold text-red-500/80 leading-relaxed text-left">
                            {{ $errors->first() }}
                        </p>
                    </div>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Full Name -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-1.5 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Contoh: Dika Afif" class="w-full bg-gray-50 border-none rounded-2xl py-3.5 px-6 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-orange-50 transition-all outline-none" required />
                </div>

                <!-- NIM -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-1.5 ml-1">NIM (Nomor Induk Mahasiswa)</label>
                    <input type="text" name="username" placeholder="Contoh: 2105..." class="w-full bg-gray-50 border-none rounded-2xl py-3.5 px-6 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-orange-50 transition-all outline-none" required />
                </div>
                
                <!-- Password -->
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-600 mb-1.5 ml-1">Buat Password</label>
                    <div class="relative group">
                        <input type="password" id="password" name="password" placeholder="••••••••" class="w-full bg-gray-50 border-none rounded-2xl py-3.5 px-6 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-orange-50 transition-all outline-none pr-12" required />
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#F49E0A] transition-colors">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                
                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#F49E0A] hover:bg-orange-600 text-white rounded-2xl py-4 font-black uppercase tracking-[0.2em] text-xs shadow-xl shadow-orange-900/20 hover:scale-[1.02] active:scale-95 transition-all">
                        Daftar Akun
                    </button>
                </div>
            </form>
            
            <div class="mt-10 text-center">
                <span class="text-[11px] font-bold text-gray-600">Sudah punya akun?</span> 
                <a href="/login" class="text-[10px] font-black uppercase tracking-widest text-[#F49E0A] hover:underline ml-1">Login di sini</a>
            </div>
        </div>
    </div>
</div>

<!-- Background Elements -->
<div class="fixed inset-0 z-0 bg-gray-50 pointer-events-none">
    <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-[#F49E0A]/5 rounded-full blur-3xl translate-x-1/3 -translate-y-1/3"></div>
    <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-[#6B21A8]/5 rounded-full blur-3xl -translate-x-1/3 translate-y-1/3"></div>
</div>
@endsection

@push('scripts')
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('text-[#F49E0A]');
    });
</script>
@endpush
