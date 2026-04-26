@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10 hidden sm:flex lg:flex">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">
                Halo, {{ Auth::user()->name }} 👋
            </h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Selamat datang di Sistem Informasi Management Magang (SIDUL). Mari kelola progress magangmu hari ini.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">Akun Aktif</span>
            </div>
        </div>
    </div>
    
    <!-- Mobile Header -->
    <div class="flex flex-col justify-between gap-4 relative z-10 sm:hidden">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black">Halo, {{ explode(' ', Auth::user()->name)[0] }} 👋</h2>
            <div class="bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/20 text-white flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                <span class="text-[10px] font-bold uppercase tracking-wider">Aktif</span>
            </div>
        </div>
        <p class="text-white/90 font-medium text-sm leading-relaxed">Selamat datang di SIDUL.</p>
    </div>
</div>
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
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 w-full items-start">
    
    <!-- Kolom Kiri: Statistik & Konten Utama (8 Kolom) -->
    <div class="lg:col-span-8 space-y-8 min-w-0">
        
        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-orange-50 flex items-center justify-center text-[#F49E0A] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
                <span class="text-3xl font-black text-gray-800 tracking-tighter">{{ $logbookCount ?? 0 }}</span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Logbook Terisi</span>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                </div>
                <span class="text-[10px] font-black {{ $laporan ? 'text-blue-600 bg-blue-50 border-blue-100' : 'text-gray-300 bg-gray-50 border-gray-100' }} px-4 py-2 rounded-xl mb-1 uppercase tracking-widest border">
                    {{ $laporan ? 'TERUNGGAH' : 'BELUM ADA' }}
                </span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Laporan Akhir</span>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:shadow-md transition-all">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <span class="text-3xl font-black text-gray-800 tracking-tighter">
                        @php
                            $progress = 0;
                            if($pendaftaran) $progress += 30;
                            if($logbookCount > 0) $progress += 30;
                            if($laporan) $progress += 40;
                        @endphp
                    {{ $progress }}%
                </span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Total Progres</span>
            </div>
        </div>

        <!-- Main Action Section -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-12 min-h-[300px] flex items-center justify-center">
            @if(!$pendaftaran)
                <div class="text-center max-w-md">
                    <div class="w-20 h-20 bg-purple-50 text-primary rounded-3xl flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-4">Belum Ada Pendaftaran</h3>
                    <p class="text-gray-500 mb-8 font-medium">Segera lengkapi data magang Anda untuk memulai proses verifikasi.</p>
                    @if($mahasiswa->status_magang === 'Approve')
                        <a href="{{ route('mahasiswa.pendaftaran') }}" class="btn bg-primary hover:bg-primary/90 text-white border-none rounded-2xl px-8 h-14 font-bold uppercase tracking-widest text-xs">
                            Daftar Magang Sekarang
                        </a>
                    @else
                        <div class="bg-orange-50 text-orange-700 p-4 rounded-2xl border border-orange-100 text-sm font-bold">
                            Menunggu Rekomendasi Dosen Wali
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
                            <div class="flex gap-2">
                                <a href="{{ route('mahasiswa.logbook') }}" class="btn h-11 px-6 bg-primary hover:bg-purple-700 text-white border-none rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-purple-100 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                    Logbook
                                </a>
                                <a href="{{ route('mahasiswa.laporan') }}" class="btn h-11 px-6 bg-amber-50 hover:bg-amber-100 text-amber-600 border border-amber-100 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                    Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Kolom Kanan: Status & Info (4 Kolom) -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Status Magang -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
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

                        @if($pendaftaran && in_array($pendaftaran->status_magang, ['Aktif', 'Selesai']))
                        <a href="{{ route('mahasiswa.surat_pengantar') }}" target="_blank" class="btn btn-outline btn-primary w-full rounded-2xl h-14 font-black uppercase tracking-widest text-[10px] border-2">
                             Cetak Surat Pengantar
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Panduan Card -->
        <div class="bg-[#F49E0A] text-white p-8 rounded-[2rem] relative overflow-hidden group shadow-lg shadow-orange-900/10">
            <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12 group-hover:scale-110 transition-transform duration-700">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2 italic uppercase">Buku Panduan 📖</h3>
                <p class="text-white/80 text-[10px] font-bold mb-6 italic">Pelajari prosedur magang terbaru & format laporan.</p>
                <a href="#" class="btn bg-white hover:bg-gray-50 text-[#F49E0A] border-none w-full rounded-xl h-12 text-[10px] font-black uppercase tracking-widest italic shadow-sm">Unduh PDF</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Logic for frontend interactivity if any
</script>
@endsection

@section('scripts')
<script>
    // Frontend dynamic components if needed
</script>
@endsection
