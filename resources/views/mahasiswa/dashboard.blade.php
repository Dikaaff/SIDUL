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
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">SIDUL</a></li> 
    <li>Dashboard Utama</li>
  </ul>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
    <!-- Kolom Kiri: Statistik & Pengumuman -->
    <div class="lg:col-span-2 space-y-6 md:space-y-8">
        
        <!-- Quick Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-100 fill-mode-both">
            <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1">
                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-[#F49E0A] mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" /><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" /></svg>
                </div>
                <span class="text-2xl font-black text-gray-800">{{ $logbookCount ?? 0 }}</span>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1">Logbook</span>
            </div>

            <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1">
                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" /><path fill-rule="evenodd" d="M4 5h12v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" /></svg>
                </div>
                <span class="text-[10px] font-black {{ $laporan ? 'text-blue-600 bg-blue-50' : 'text-gray-400 bg-gray-50' }} px-2 py-0.5 rounded-md mb-1 uppercase tracking-widest">
                    {{ $laporan ? 'Sudah Unggah' : 'Belum Unggah' }}
                </span>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Laporan Akhir</span>
            </div>
            <div class="bg-white p-5 rounded-[1.5rem] shadow-sm border border-gray-100 flex flex-col justify-center items-center text-center transition-all hover:shadow-md hover:-translate-y-1">
                <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-600 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                </div>
                <span class="text-2xl font-black text-gray-800" id="display-progress">
                        @php
                            $progress = 0;
                            if($pendaftaran) $progress += 30;
                            if($logbookCount > 0) $progress += 30; // Increased from 20 to 30
                            if($laporan) $progress += 40;
                        @endphp
                    {{ $progress }}%
                </span>
                <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mt-1">Progress</span>
            </div>
        </div>

        <!-- 1. Alur Kerja Magang -->
        <div class="bg-white rounded-[2rem] p-6 md:p-8 shadow-sm border border-gray-100 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-200 fill-mode-both">
            <h3 class="font-bold text-gray-800 text-lg mb-8 flex items-center gap-3">
                <span class="w-1.5 h-6 bg-[#6B21A8] rounded-full"></span>
                Alur Kerja Magang
            </h3>
            
            <div class="overflow-x-auto pb-4">
                <ul class="steps steps-vertical md:steps-horizontal w-full font-bold text-xs">
                    <li class="step {{ $pendaftaran ? 'step-primary' : '' }}" data-content="{{ $pendaftaran ? '✓' : '1' }}">Pendaftaran</li>
                    <li class="step {{ $pendaftaran && $pendaftaran->status_magang == 'Approve' ? 'step-primary' : '' }}" data-content="{{ $pendaftaran && $pendaftaran->status_magang == 'Approve' ? '✓' : '2' }}">Plotting</li>
                    <li class="step {{ ($logbookCount ?? 0) > 0 ? 'step-primary' : '' }}" data-content="{{ ($logbookCount ?? 0) > 0 ? '✓' : '3' }}">Logbook</li>
                    <li class="step {{ $laporan ? 'step-primary' : '' }}" data-content="{{ $laporan ? '✓' : '4' }}">Laporan</li>
                </ul>
            </div>

            <!-- Informasi Penting -->
            <div class="mt-8 p-6 bg-orange-50 rounded-3xl border border-orange-100 flex flex-col sm:flex-row items-start sm:items-center gap-4 md:gap-6 relative overflow-hidden text-black">
                <div class="w-12 h-12 rounded-2xl bg-white border border-orange-200 flex items-center justify-center text-[#F49E0A] shadow-sm shrink-0 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="relative z-10">
                    <h4 class="font-bold text-[#F49E0A] text-sm mb-1 px-1 italic">Informasi Penting & Quick Action 💡</h4>
                    <p class="text-[11px] font-bold leading-relaxed px-1">
                        @if(!$pendaftaran)
                            Halo! Kamu belum mendaftarkan perusahaan. Silakan ajukan <a href="{{ route('mahasiswa.pendaftaran') }}" class="text-[#6B21A8] underline font-black">Pendaftaran Magang</a> segera.
                        @elseif($pendaftaran->status_magang == 'Pending')
                            Pendaftaran di <strong>{{ $pendaftaran->perusahaan }}</strong> sedang menunggu verifikasi Operator.
                        @else
                            Kamu sedang magang di <strong>{{ $pendaftaran->perusahaan }}</strong>. Jangan lupa isi <a href="{{ route('mahasiswa.logbook') }}" class="text-[#6B21A8] underline font-black">Logbook</a> harianmu.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Status & CTA -->
    <div class="space-y-6 md:space-y-8">
        <!-- Status Magang -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500 delay-300 fill-mode-both">
            <div class="px-6 py-5 border-b border-gray-50 bg-gray-50/50">
                <h3 class="font-bold text-gray-800 text-sm">Status Magang</h3>
            </div>
            <div class="p-6 md:p-8 space-y-6">
                <div>
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Instansi & Konsentrasi</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-500 border border-gray-100">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div>
                            <span class="font-bold text-gray-800 text-sm block {{ !$pendaftaran ? 'italic text-gray-400' : '' }}">
                                {{ $pendaftaran->perusahaan ?? 'Belum Mendaftar' }}
                            </span>
                            @if($pendaftaran)
                                <span class="text-[10px] font-bold text-[#6B21A8] bg-purple-50 px-2 py-0.5 rounded-md mt-1 inline-block">{{ $pendaftaran->konsentrasi }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Dosen Pembimbing</p>
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 border border-blue-100">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <span class="font-bold text-gray-800 text-sm italic text-gray-400">
                            {{ $pendaftaran->pembimbing->nama ?? 'Menunggu Plotting' }}
                        </span>
                    </div>
                </div>

                <div class="pt-5 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Status</span>
                    @if(!$pendaftaran)
                        <div class="px-3 py-1.5 bg-gray-100 text-gray-500 rounded-lg text-[10px] font-black tracking-widest uppercase border border-gray-200 italic">No Data</div>
                    @else
                        @php
                            $statusColor = [
                                'Pending' => 'bg-orange-50 text-orange-600 border-orange-100',
                                'Approve' => 'bg-green-50 text-green-600 border-green-100',
                                'Rejected' => 'bg-red-50 text-red-600 border-red-100'
                            ][$pendaftaran->status_magang] ?? 'bg-gray-50 text-gray-600 border-gray-100';
                        @endphp
                        <div class="px-3 py-1.5 {{ $statusColor }} rounded-lg text-[10px] font-black tracking-widest uppercase border">
                            {{ $pendaftaran->status_magang }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Panduan CTA -->
        <div class="bg-[#F49E0A] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden group shadow-xl shadow-orange-900/10 border-none animate-in fade-in slide-in-from-bottom-4 duration-500 delay-500 fill-mode-both">
            <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12 group-hover:scale-110 transition-transform duration-700">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-bold mb-2 italic uppercase tracking-tighter">Buku Panduan Magang 📖</h3>
                <p class="text-white/90 text-[11px] leading-relaxed font-bold mb-6 italic opacity-80">Pelajari prosedur pelaksanaan magang terbaru serta format laporan akhir.</p>
                <a href="#" class="inline-block w-full text-center bg-white hover:bg-gray-50 text-[#F49E0A] py-3.5 rounded-xl font-black uppercase tracking-widest transition-colors text-[10px] shadow-sm italic">
                    Unduh PDF (v1.2)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Frontend dynamic components if needed
</script>
@endsection

