@extends('layouts.auth')

@section('title', 'Login Dosen - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-base-100 rounded-3xl overflow-hidden shadow-2xl border border-base-200 min-h-[600px]">
    
    <!-- Left Side: Branding / Illustration (Dosen Focus) -->
    <div class="lg:w-1/2 bg-[#6B21A8] p-12 text-white flex flex-col justify-between relative overflow-hidden group hidden lg:flex">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-orange-500/10 rounded-full blur-3xl group-hover:bg-orange-500/20 transition-all duration-700"></div>
        
        <div class="z-10 relative">
            <div class="flex items-center gap-3 mb-10">
                <img src="/sidul.png" alt="SIDUL Logo" class="w-10 h-10 object-contain brightness-0 invert" />
                <span class="text-2xl font-bold tracking-tight">SIDUL</span>
            </div>
            
            <h1 class="text-4xl font-bold leading-tight mb-4">Portal Dosen<br>Management<br>Magang Terpadu</h1>
            <p class="text-white/80 text-lg max-w-sm">Pantau kemajuan mahasiswa bimbingan, berikan bimbingan laporan, dan lakukan penilaian secara efisien.</p>
        </div>
        
        <div class="z-10 relative bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-10 h-10 rounded-full bg-orange-500 flex items-center justify-center font-bold">DP</div>
                <div>
                    <div class="font-bold text-sm">Dashboard Pembimbing</div>
                    <div class="text-xs text-white/60">Monitoring Real-time</div>
                </div>
            </div>
            <p class="text-xs text-white/70 italic font-medium leading-relaxed">"Sistem ini memudahkan koordinasi antara dosen wali dan pembimbing lapangan."</p>
        </div>
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-8 lg:p-14 flex flex-col justify-center bg-base-100 relative">
        <div class="w-full max-w-md mx-auto relative z-10">
            <!-- Mobile Logo -->
            <div class="flex items-center gap-3 mb-8 lg:hidden justify-center">
                <img src="/sidul.png" alt="SIDUL Logo" class="w-10 h-10 object-contain" />
                <span class="text-xl font-bold text-[#6B21A8]">SIDUL</span>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang, Bapak/Ibu 👋</h2>
                <p class="text-gray-500">Silakan login dengan NIDN atau Email Institusi Anda.</p>
            </div>
            
            <form action="/dashboard/dosen" class="space-y-5">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-bold text-gray-700">NIDN / Email Institusi</span>
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <input type="text" placeholder="Masukkan NIDN atau Email" class="input input-bordered w-full pl-11 focus:border-[#6B21A8] transition-colors bg-gray-50 text-gray-800" />
                    </div>
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-bold text-gray-700">Password</span>
                        <a href="#" class="label-text-alt text-[#6B21A8] hover:underline font-bold">Lupa password?</a>
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <input type="password" placeholder="••••••••" class="input input-bordered w-full pl-11 pr-11 focus:border-[#6B21A8] transition-colors bg-gray-50 text-gray-800" />
                    </div>
                </div>
                
                <div class="form-control mt-2">
                    <label class="cursor-pointer label justify-start gap-3">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-sm checkbox-primary border-gray-300" style="--bc: 273 67% 39%" />
                        <span class="label-text text-gray-600 font-medium">Ingat saya</span>
                    </label>
                </div>
                
                <button type="submit" class="btn bg-[#6B21A8] hover:bg-purple-800 text-white btn-block shadow-lg shadow-purple-100 mt-6 relative group overflow-hidden border-none h-12">
                    <span class="relative z-10 font-bold">Masuk ke Dashboard</span>
                </button>
            </form>
            
            <div class="mt-10 p-4 rounded-xl bg-orange-50 border border-orange-100 text-center">
                <p class="text-xs text-orange-800 leading-relaxed font-medium">
                    <span class="font-bold">Butuh bantuan?</span> Hubungi Admin Prodi atau Operator Sistem jika Anda mengalami kendala saat login.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
