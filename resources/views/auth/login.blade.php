@extends('layouts.auth')

@section('title', 'Login - SIDUL')

@section('content')
<div class="flex flex-col lg:flex-row w-full max-w-5xl bg-base-100 rounded-3xl overflow-hidden shadow-2xl border border-base-200 min-h-[600px]">
    
    <!-- Left Side: Branding / Illustration -->
    <div class="lg:w-1/2 bg-gradient-to-br from-primary to-accent p-12 text-primary-content flex flex-col justify-between relative overflow-hidden group hidden lg:flex">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all duration-700"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 bg-secondary/20 rounded-full blur-3xl group-hover:bg-secondary/30 transition-all duration-700"></div>
        
        <div class="z-10 relative">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 rounded-xl bg-white text-primary flex items-center justify-center font-bold text-xl shadow-lg">
                    S
                </div>
                <span class="text-2xl font-bold tracking-tight">SIDUL</span>
            </div>
            
            <h1 class="text-4xl font-bold leading-tight mb-4">Sistem Informasi<br>Management<br>Magang Mahasiswa</h1>
            <p class="text-white/80 text-lg max-w-sm">Kelola proses magang Anda dari pendaftaran hingga penilaian dalam satu platform terintegrasi.</p>
        </div>
        
        <div class="z-10 relative">
            <div class="flex -space-x-4 mb-4">
                <img class="w-10 h-10 border-2 border-primary rounded-full bg-base-100" src="https://ui-avatars.com/api/?name=Ali&background=F49E0A&color=fff" alt="">
                <img class="w-10 h-10 border-2 border-primary rounded-full bg-base-100" src="https://ui-avatars.com/api/?name=Budi&background=2563EB&color=fff" alt="">
                <img class="w-10 h-10 border-2 border-primary rounded-full bg-base-100" src="https://ui-avatars.com/api/?name=Siti&background=16A34A&color=fff" alt="">
                <div class="w-10 h-10 border-2 border-primary rounded-full bg-white/20 backdrop-blur flex items-center justify-center text-xs font-bold">+2k</div>
            </div>
            <p class="text-white/70 text-sm">Bergabung dengan ribuan mahasiswa lainnya.</p>
        </div>
    </div>
    
    <!-- Right Side: Login Form -->
    <div class="lg:w-1/2 p-8 lg:p-14 flex flex-col justify-center bg-base-100 relative">
        <div class="w-full max-w-md mx-auto relative z-10">
            <!-- Mobile Logo -->
            <div class="flex items-center gap-2 mb-8 lg:hidden justify-center">
                <div class="w-8 h-8 rounded-lg bg-primary text-white flex items-center justify-center font-bold text-lg shadow-sm">S</div>
                <span class="text-xl font-bold text-primary">SIDUL</span>
            </div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold text-base-content mb-2">Selamat Datang 👋</h2>
                <p class="text-base-content/60">Silakan login ke akun Anda untuk melanjutkan.</p>
            </div>
            
            <form action="#" class="space-y-5">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium text-base-content/80">Email / NIM / NIDN</span>
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <input type="text" placeholder="Masukkan ID Login Anda" class="input input-bordered w-full pl-11 focus:border-primary transition-colors bg-base-200/30" />
                    </div>
                </div>
                
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium text-base-content/80">Password</span>
                        <a href="#" class="label-text-alt text-primary hover:underline font-medium">Lupa password?</a>
                    </label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        <input type="password" placeholder="••••••••" class="input input-bordered w-full pl-11 pr-11 focus:border-primary transition-colors bg-base-200/30" />
                        <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-base-content/40 hover:text-base-content">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                
                <div class="form-control mt-2">
                    <label class="cursor-pointer label justify-start gap-3">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-sm checkbox-primary" />
                        <span class="label-text text-base-content/70">Ingat saya</span>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block shadow-lg shadow-primary/30 mt-6 relative group overflow-hidden">
                    <span class="relative z-10 font-bold">Masuk</span>
                    <div class="absolute inset-0 h-full w-full scale-0 rounded-2xl transition-all duration-300 group-hover:scale-100 group-hover:bg-white/20"></div>
                </button>
            </form>
            
            <div class="mt-8 text-center text-sm text-base-content/60">
                Belum punya akun? <a href="/register" class="text-primary font-bold hover:underline">Daftar sebagai Mahasiswa</a>
            </div>
        </div>
    </div>
</div>
@endsection
