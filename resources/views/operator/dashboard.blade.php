@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">Dashboard Operator 🚀</h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Selamat datang. Berikut ringkasan sistem magang yang perlu Anda tindaklanjuti hari ini.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center shrink-0">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">{{ now()->format('d F Y') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 font-sans">

    {{-- Stat 1: Menunggu Verifikasi --}}
    <a href="{{ route('operator.verifikasi') }}" class="card bg-white shadow-sm border border-base-200 hover:shadow-lg hover:-translate-y-1 transition-all cursor-pointer group">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Menunggu Verifikasi</p>
                    <h3 class="text-4xl font-black text-[#F49E0A]">{{ $pendingCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#F49E0A] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-orange-500 mt-3 uppercase tracking-wider">→ Periksa sekarang</p>
        </div>
    </a>

    {{-- Stat 2: Belum Dapat Dosen --}}
    <a href="{{ route('operator.dosen_pembimbing') }}" class="card bg-white shadow-sm border border-base-200 hover:shadow-lg hover:-translate-y-1 transition-all cursor-pointer group">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Belum Ada Dosen</p>
                    <h3 class="text-4xl font-black text-blue-600">{{ $belumDosenCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-blue-500 mt-3 uppercase tracking-wider">→ Assign dosen</p>
        </div>
    </a>

    {{-- Stat 3: Aktif Magang --}}
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Aktif Magang</p>
                    <h3 class="text-4xl font-black text-green-600">{{ $aktifCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 mt-3 uppercase tracking-wider">Sedang berjalan</p>
        </div>
    </div>

    {{-- Stat 4: Selesai --}}
    <div class="card bg-[#6B21A8] shadow-sm border-none shadow-purple-200">
        <div class="card-body p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-white/60 uppercase tracking-widest mb-1">Magang Selesai</p>
                    <h3 class="text-4xl font-black text-white">{{ $selesaiCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white/20 text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-white/60 mt-3 uppercase tracking-wider">Total terselesaikan</p>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 font-sans">

    {{-- Antrean Terbaru --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-[#F49E0A] rounded-full"></div>
                    <h3 class="font-black text-gray-800 text-lg tracking-tight">Pendaftaran Terbaru (Pending)</h3>
                </div>
                <a href="{{ route('operator.verifikasi') }}" class="text-[10px] font-black text-[#6B21A8] hover:underline uppercase tracking-widest">Lihat Semua →</a>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($recentPending as $magang)
                <div class="px-8 py-5 flex items-center justify-between hover:bg-gray-50/50 transition-all group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-sm group-hover:bg-[#6B21A8] group-hover:text-white transition-colors">
                            {{ strtoupper(substr($magang->peserta->first()->mahasiswa->nama ?? 'MH', 0, 2)) }}
                        </div>
                        <div>
                            <h4 class="font-black text-gray-800 text-sm">{{ $magang->peserta->first()->mahasiswa->nama ?? '-' }}</h4>
                            <p class="text-[11px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider">{{ $magang->nim }} • {{ $magang->perusahaan }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-[10px] font-bold text-gray-400">{{ $magang->created_at->diffForHumans() }}</span>
                        <a href="{{ route('operator.verifikasi') }}" class="btn btn-sm rounded-xl bg-[#6B21A8] hover:bg-purple-800 border-none text-white font-black text-[10px] uppercase tracking-wider">Periksa</a>
                    </div>
                </div>
                @empty
                <div class="px-8 py-12 text-center">
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">Tidak ada pendaftaran pending</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Panel Aksi Cepat --}}
    <div class="space-y-4">
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-6 space-y-4">
            <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Aksi Cepat</h4>

            <a href="{{ route('operator.verifikasi') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-orange-50 hover:bg-orange-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-[#F49E0A]/10 text-[#F49E0A] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Verifikasi Dokumen</p>
                    <p class="text-[10px] font-bold text-gray-400">{{ $pendingCount }} menunggu</p>
                </div>
            </a>

            <a href="{{ route('operator.dosen_pembimbing') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Plotting Dosen</p>
                    <p class="text-[10px] font-bold text-gray-400">{{ $belumDosenCount }} belum di-assign</p>
                </div>
            </a>

            <a href="{{ route('operator.id_magang') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-purple-50 hover:bg-purple-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-purple-100 text-[#6B21A8] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Generate ID Magang</p>
                    <p class="text-[10px] font-bold text-gray-400">Buat kode unik magang</p>
                </div>
            </a>

            <a href="{{ route('operator.monitoring') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-green-50 hover:bg-green-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Monitoring</p>
                    <p class="text-[10px] font-bold text-gray-400">{{ $aktifCount }} aktif magang</p>
                </div>
            </a>
        </div>
    </div>
</div>

@if(session('success'))
<div id="notifContainer" class="fixed top-8 right-8 z-[9999]">
    <div class="flex items-center gap-5 bg-gray-900 text-white p-6 rounded-[2.5rem] shadow-2xl border border-white/10 min-w-[350px] font-sans">
        <div class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/40">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
        </div>
        <p class="font-black text-xs uppercase tracking-widest">{{ session('success') }}</p>
    </div>
</div>
<script>setTimeout(() => document.getElementById('notifContainer').style.display = 'none', 3500);</script>
@endif
@endsection
