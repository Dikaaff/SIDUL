@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('header')
<x-page-header 
    title="Sistem Utama SIDUL 🛡️" 
    subtitle="Selamat datang, Super Admin. Pantau keseluruhan ekosistem pendaftaran magang dan ketersediaan SDM dengan mudah."
>
    <div class="flex gap-3 self-start md:self-center">
        <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded border border-white/20 text-white flex items-center gap-3 shadow-xl">
            <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
            <span class="text-xs font-bold uppercase tracking-wider">Layanan Normal</span>
        </div>
    </div>
</x-page-header>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/admin" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li> 
    <li>Admin Dashboard</li>
  </ul>
</div>
@endsection

@section('content')
<div class="space-y-6 md:space-y-8">

    {{-- Quick Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100 fill-mode-both">

        <x-stat-card value="{{ $totalMahasiswa }}" label="Total Mahasiswa" color="purple">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card value="{{ $totalMagangAktif }}" label="Magang Aktif" color="green">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card value="{{ $totalDosen }}" label="Total Dosen" color="amber">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </x-slot>
        </x-stat-card>

        <x-stat-card value="{{ $totalOperator }}" label="Total Operator" color="blue">
            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </x-slot>
        </x-stat-card>

    </div>

    {{-- Sistem Info Block --}}
    <x-card padding="large" shadow="none" border="false" class="bg-[#F49E0A] text-white group !shadow-xl !shadow-orange-900/10 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-300 fill-mode-both w-full lg:w-1/2 relative overflow-hidden">
        <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12 group-hover:scale-110 transition-transform duration-700 pointer-events-none">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div class="relative z-10">
            <h3 class="text-xl font-bold mb-2 italic uppercase tracking-tighter">Status Layanan Normal 🟢</h3>
            <p class="text-white/90 text-[11px] leading-relaxed font-bold mb-6 italic opacity-80">Server web dan database beroperasi tanpa adanya kendala atau penumpukan antrean verifikasi.</p>
            <a href="/admin/users" class="inline-block w-full sm:w-auto text-center bg-white hover:bg-gray-50 text-[#F49E0A] px-6 py-3.5 rounded font-black uppercase tracking-widest transition-colors text-[10px] shadow-sm italic relative z-20">
                Kelola Staf Sekarang
            </a>
        </div>
    </x-card>

</div>
@endsection
