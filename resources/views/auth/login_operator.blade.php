@extends('layouts.auth')

@section('title', 'Login Operator - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-3xl overflow-hidden shadow-2xl border border-gray-100 min-h-[600px]">
    
    <!-- Left Side: Branding / Illustration (Operator Focus) -->
    <div class="lg:w-1/2 bg-[#6B21A8] p-12 text-white flex flex-col justify-between relative overflow-hidden group hidden lg:flex">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl group-hover:bg-blue-500/20 transition-all duration-700"></div>
        
        <div class="z-10 relative">
            <div class="flex items-center gap-3 mb-10">
                <img src="/sidul.png" alt="SIDUL Logo" class="w-10 h-10 object-contain brightness-0 invert" />
                <span class="text-2xl font-bold tracking-tight">SIDUL</span>
            </div>
            
            <h1 class="text-4xl font-bold leading-tight mb-4 text-white">Central Console<br>Admin Prodi<br>Management Magang</h1>
            <p class="text-white/80 text-lg max-w-sm">Kelola seluruh administrasi, verifikasi berkas, dan monitoring progres magang untuk seluruh mahasiswa program studi.</p>
        </div>
        
        <div class="z-10 relative bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/20">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-10 h-10 rounded-full bg-[#F49E0A] flex items-center justify-center font-bold">OP</div>
                <div>
                    <div class="font-bold text-sm">Operator System</div>
                    <div class="text-xs text-white/60">Verified Admin Control</div>
                </div>
            </div>
            <p class="text-[11px] text-white/70 italic font-medium leading-relaxed">"Akses terpusat untuk efisiensi birokrasi dan peningkata kualitas layanan kemahasiswaan."</p>
        </div>
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-8 lg:p-14 flex flex-col justify-center bg-white relative">
        <div class="w-full max-w-md mx-auto relative z-10">
            <!-- Mobile Logo -->
            <div class="flex items-center gap-3 mb-8 lg:hidden justify-center">
                <img src="/sidul.png" alt="SIDUL Logo" class="w-10 h-10 object-contain" />
                <span class="text-xl font-bold text-[#6B21A8]">SIDUL</span>
            </div>

            <div class="mb-8">
                <span class="px-3 py-1 bg-purple-50 text-[#6B21A8] text-[10px] font-extrabold rounded-full uppercase tracking-widest border border-purple-100 mb-4 inline-block">Admin Access</span>
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang, Admin 👋</h2>
                <p class="text-gray-500">Silakan masuk untuk mengelola sistem magang.</p>
            </div>
            
            <form action="/dashboard/operator" class="space-y-5">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-bold text-gray-700">Username / Staff ID</span>
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <input type="text" placeholder="Masukkan ID Login Operator" class="input input-bordered w-full pl-11 focus:border-[#6B21A8] transition-colors bg-gray-50 text-gray-800 font-medium" />
                    </div>
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-bold text-gray-700">Password</span>
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <input type="password" placeholder="••••••••" class="input input-bordered w-full pl-11 pr-11 focus:border-[#6B21A8] transition-colors bg-gray-50 text-gray-800" />
                    </div>
                </div>
                
                <div class="form-control mt-2">
                    <label class="cursor-pointer label justify-start gap-4 p-0">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-sm checkbox-primary border-gray-300" style="--bc: 273 67% 39%" />
                        <span class="label-text text-gray-500 font-bold text-xs uppercase tracking-widest">Ingat sesi ini</span>
                    </label>
                </div>
                
                <button type="submit" class="btn bg-[#6B21A8] hover:bg-purple-800 text-white btn-block shadow-lg shadow-purple-100 mt-6 relative group overflow-hidden border-none h-14">
                    <span class="relative z-10 font-bold uppercase tracking-widest text-sm">Masuk Sistem</span>
                </button>
            </form>
            
            <div class="mt-12 text-center">
                 <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em]">Versi 2.1.0-beta • Proccessed by SIDUL</p>
            </div>
        </div>
    </div>
</div>
@endsection
