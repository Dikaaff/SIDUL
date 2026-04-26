@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10 hidden sm:flex lg:flex">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">
                Sistem Utama SIDUL 🛡️
            </h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Selamat datang, Super Admin. Pantau keseluruhan ekosistem pendaftaran magang dan ketersediaan SDM dengan mudah.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">Layanan Normal</span>
            </div>
        </div>
    </div>
    
    <!-- Mobile Header -->
    <div class="flex flex-col justify-between gap-4 relative z-10 sm:hidden">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black">SIDUL Admin 🛡️</h2>
            <div class="bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/20 text-white flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
            </div>
        </div>
        <p class="text-white/90 font-medium text-sm leading-relaxed">Pantau ketersediaan SDM.</p>
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/admin" class="hover:text-primary transition-colors">SIDUL</a></li> 
    <li>Admin Dashboard</li>
  </ul>
</div>
@endsection

@section('content')
<div class="space-y-6 md:space-y-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100 fill-mode-both">
        <!-- Stat 1: Mahasiswa -->
        <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-purple-50 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-[#6B21A8] mb-3 relative z-10 border border-purple-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="text-2xl font-black text-gray-800 relative z-10">{{ $totalMahasiswa }}</span>
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1 relative z-10">Total Mahasiswa</span>
        </div>

        <!-- Stat 2: Magang Aktif -->
        <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-green-50 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mb-3 relative z-10 border border-green-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <span class="text-2xl font-black text-gray-800 relative z-10">{{ $totalMagangAktif }}</span>
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1 relative z-10">Magang Aktif</span>
        </div>

        <!-- Stat 3: Total Dosen -->
        <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-50 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-[#F49E0A] mb-3 relative z-10 border border-amber-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
            <span class="text-2xl font-black text-gray-800 relative z-10">{{ $totalDosen }}</span>
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1 relative z-10">Total Dosen</span>
        </div>

        <!-- Stat 4: Total Operator -->
        <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-blue-50 rounded-full blur-xl group-hover:scale-150 transition-transform duration-500"></div>
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-3 relative z-10 border border-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-2xl font-black text-gray-800 relative z-10">{{ $totalOperator }}</span>
            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1 relative z-10">Total Operator</span>
        </div>
    </div>

    <!-- Sistem Info Block (Mirroring Panduan Magang shape but for Admin) -->
    <div class="bg-[#F49E0A] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden group shadow-xl shadow-orange-900/10 border-none animate-in fade-in slide-in-from-bottom-4 duration-500 delay-300 fill-mode-both w-full lg:w-1/2">
        <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12 group-hover:scale-110 transition-transform duration-700">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
        </div>
        <div class="relative z-10">
            <h3 class="text-xl font-bold mb-2 italic uppercase tracking-tighter">Status Layanan Normal 🟢</h3>
            <p class="text-white/90 text-[11px] leading-relaxed font-bold mb-6 italic opacity-80">Server web dan database beroperasi tanpa adanya kendala atau penumpukan antrean verifikasi.</p>
            <a href="/admin/users" class="inline-block w-full sm:w-auto text-center bg-white hover:bg-gray-50 text-[#F49E0A] px-6 py-3.5 rounded-xl font-black uppercase tracking-widest transition-colors text-[10px] shadow-sm italic">
                Kelola Staf Sekarang
            </a>
        </div>
    </div>
</div>
@endsection
