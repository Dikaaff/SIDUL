@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('header')
<x-page-header
    title="Halo, {{ Auth::user()->name }} 👋"
    subtitle="Selamat datang di SIDUL. Mari kelola progress magangmu hari ini."
>
    <div class="flex flex-col md:flex-row items-center gap-4">
        <div class="{{ $pendaftaran ? 'bg-white/10 border-white/20' : 'bg-red-500/10 border-red-500/20' }} backdrop-blur-md px-5 py-2.5 rounded-2xl border text-white flex items-center gap-3 shadow-xl">
            <div class="w-2.5 h-2.5 rounded-full {{ $pendaftaran ? 'bg-green-400 shadow-[0_0_10px_rgba(74,222,128,0.8)]' : 'bg-red-400 shadow-[0_0_10px_rgba(248,113,113,0.8)]' }} animate-pulse"></div>
            <span class="text-xs font-bold uppercase tracking-wider">
                {{ $pendaftaran ? 'Akun Aktif' : 'Belum Aktif' }}
            </span>
        </div>
    </div>
</x-page-header>
@endsection

@section('breadcrumbs')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 px-2">
    <div class="text-sm breadcrumbs text-gray-400 font-bold italic">
        <ul>
            <li><a href="/dashboard" class="hover:text-primary transition-colors">SIDUL</a></li>
            <li>Dashboard Utama</li>
        </ul>
    </div>
    @if(!$isPeriodeOpen)
    <div class="bg-red-50 text-red-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] border border-red-100 flex items-center gap-2 animate-pulse">
        <div class="w-2 h-2 rounded-full bg-red-500"></div>
        PERIODE MAGANG TUTUP
    </div>
    @endif
</div>
@endsection

@section('content')
<div class="space-y-8">

    @if(!$isPeriodeOpen)
    <!-- Global Period Closure Alert -->
    <x-card padding="large" border class="bg-red-50 !border-red-100 relative group transition-all">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-red-100 rounded-full blur-3xl opacity-50"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
            <div class="w-16 h-16 rounded-2xl bg-red-500 text-white flex items-center justify-center shadow-xl shadow-red-200 shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            </div>
            <div>
                <h3 class="text-xl font-bold text-red-800 mb-1">Periode Magang Telah Berakhir</h3>
                <p class="text-sm font-medium text-red-600/80 leading-relaxed max-w-3xl">
                    Mohon maaf, saat ini sistem magang SIDUL sedang ditutup untuk pemeliharaan atau pergantian periode. Pendaftaran baru, pengisian logbook, dan pengiriman laporan tidak tersedia hingga periode berikutnya dibuka kembali.
                </p>
            </div>
        </div>
    </x-card>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 w-full items-start">

    <!-- Kolom Kiri: Statistik & Konten Utama (8 Kolom) -->
    <div class="lg:col-span-8 space-y-8 min-w-0">

        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <x-card padding="none" border class="p-6 flex flex-col items-center text-center group hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#F49E0A] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
                <span class="text-3xl font-black text-gray-800 tracking-tighter">{{ $logbookCount ?? 0 }}</span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Logbook Terisi</span>
            </x-card>

            <x-card padding="none" border class="p-6 flex flex-col items-center text-center group hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                </div>
                <span class="text-[10px] font-black {{ $laporan ? 'text-blue-600 bg-blue-50 border-blue-100' : 'text-gray-300 bg-gray-50 border-gray-100' }} px-4 py-2 rounded-xl mb-1 uppercase tracking-widest border">
                    {{ $laporan ? 'TERUNGGAH' : 'BELUM ADA' }}
                </span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Laporan Akhir</span>
            </x-card>

            <x-card padding="none" border class="p-6 flex flex-col items-center text-center group hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <span class="text-3xl font-black text-gray-800 tracking-tighter">
                        @php
                            $progress = 0;
                            if($pendaftaran) $progress += 20; // Daftar: 20%
                            if($logbookCount > 0) $progress += 40; // Logbook: 40% (Total 60%)

                            if($laporan) {
                                if($laporan->status === 'approved') {
                                    $progress += 40; // Approved: +40% (Total 100%)
                                } else {
                                    $progress += 10; // Uploaded but pending: +10% (Total 70%)
                                }
                            }
                        @endphp
                    {{ $progress }}%
                </span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Total Progres</span>
            </x-card>
        </div>

        <!-- Main Action Section -->
        <x-card padding="none" border class="p-8 md:p-12 min-h-[300px] flex items-center justify-center">
            @if(!$pendaftaran)
                <div class="text-center max-w-md">
                    <div class="w-20 h-20 bg-purple-50 text-primary rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-4">Belum Ada Pendaftaran</h3>
                    <p class="text-gray-500 mb-8 font-medium">Segera lengkapi data magang Anda untuk memulai proses verifikasi.</p>
                    @if($mahasiswa->status_magang === 'Approve')
                        <a href="{{ route('mahasiswa.pendaftaran') }}" class="btn bg-amber-400 hover:bg-amber-500 text-white border-none rounded px-8 h-14 font-bold uppercase tracking-widest text-xs">
                            Daftar Magang Sekarang
                        </a>
                    @elseif($mahasiswa->status_magang === 'Rejected')
                        <div class="bg-red-50 text-red-700 p-6 rounded-2xl border border-red-100 flex flex-col items-center gap-3">
                            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center text-red-600 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <h4 class="font-black uppercase tracking-widest text-xs">Rekomendasi Ditolak ⚠️</h4>
                            <p class="text-sm font-bold opacity-80 italic text-center">Mohon maaf, pengajuan rekomendasi Anda ditolak. Silahkan konsultasi ke dosen wali untuk informasi lebih lanjut.</p>
                        </div>
                    @else
                        <div class="bg-orange-50 text-orange-700 p-6 rounded-2xl border border-orange-100 flex flex-col items-center gap-3">
                            <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 animate-pulse">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h4 class="font-black uppercase tracking-widest text-[10px]">Sedang Diproses</h4>
                            <p class="text-sm font-bold opacity-80 italic">Menunggu Rekomendasi Dosen Wali</p>
                        </div>
                    @endif
                </div>
            @else
                <div class="w-full">
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        <div class="w-40 h-40 bg-gray-50 rounded-[2.5rem] flex items-center justify-center text-gray-400 shrink-0 border border-gray-100">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div class="text-center md:text-left flex-1">
                            <span class="text-[10px] font-black text-primary uppercase tracking-[0.3em] mb-3 block">Info Perusahaan</span>
                            <h3 class="text-3xl font-black text-gray-800 mb-2">{{ $pendaftaran->perusahaan }}</h3>
                            <p class="text-gray-500 font-bold mb-8 italic">{{ $pendaftaran->alamat }}</p>
                            <div class="flex gap-2 justify-center md:justify-start">
                                <a href="{{ route('mahasiswa.logbook') }}" class="btn h-11 px-6 bg-amber-400 hover:bg-amber-500 text-white border-none rounded text-[10px] font-black uppercase tracking-widest shadow-lg shadow-amber-100 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    Logbook
                                </a>
                                <a href="{{ route('mahasiswa.laporan') }}" class="btn h-11 px-6 bg-[#422AD5]/10 hover:bg-[#422AD5]/20 text-[#422AD5] border border-[#422AD5]/20 rounded text-[10px] font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </x-card>
    </div>
 
    <!-- Kolom Kanan: Status & Info (4 Kolom) -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Status Magang -->
        <x-card padding="none" border class="overflow-hidden">
            <div class="p-8 space-y-8">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg mb-6">Status Magang</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Status Saat Ini</p>
                            @if(!$pendaftaran)
                                <div class="badge badge-lg bg-gray-100 text-gray-500 border-none font-bold py-4 px-6 rounded-xl uppercase tracking-widest text-[10px]">No Data</div>
                            @else
                                @php
                                    $statusColor = [
                                        'Pending' => 'bg-orange-50 text-orange-600',
                                        'Aktif' => 'bg-green-50 text-green-600',
                                        'Selesai' => 'bg-purple-50 text-primary',
                                        'Ditolak' => 'bg-red-50 text-red-600'
                                    ][$pendaftaran->status_magang] ?? 'bg-gray-50 text-gray-600';
                                @endphp
                                <div class="badge badge-lg {{ $statusColor }} border-none font-black py-5 px-8 rounded-xl uppercase tracking-widest text-xs">
                                    {{ $pendaftaran->status_magang }}
                                </div>
                            @endif
                        </div>
 
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-2">Dosen Pembimbing</p>
                            <div class="flex items-center gap-3 bg-gray-50 p-3 rounded-2xl border border-gray-100">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-primary shadow-sm">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <span class="font-bold text-gray-700 text-xs truncate">
                                    {{ $pendaftaran->pembimbing->nama ?? 'Menunggu Plotting' }}
                                </span>
                            </div>
                        </div>
 
                        @if($pendaftaran && in_array($pendaftaran->status_magang, ['Pending', 'Aktif', 'Selesai']))
                        <a href="{{ route('mahasiswa.surat_pengantar') }}" target="_blank" class="btn bg-[#422AD5] hover:bg-[#311eb3] text-white border-none w-full rounded h-14 font-black uppercase tracking-widest text-[10px] shadow-lg shadow-[#422AD5]/20">
                             Cetak Surat Pengantar
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </x-card>

        <!-- Panduan Card -->
        <x-card padding="large" border="false" shadow="none" class="bg-[#F49E0A] text-white relative group !shadow-lg !shadow-orange-900/10">
            <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12 group-hover:scale-110 transition-transform duration-700">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2 italic uppercase">Panduan Magang 📖</h3>
                <p class="text-white/80 text-[10px] font-bold mb-6 italic">Pelajari prosedur magang terbaru & format laporan.</p>
                <a href="https://d3ti.amikom.ac.id/page/magang#" class="btn bg-white hover:bg-gray-50 text-[#F49E0A] border-none w-full rounded h-12 text-[10px] font-black uppercase tracking-widest italic shadow-sm">Lihat</a>
            </div>
        </x-card>
    </div>
</div>
@endsection
