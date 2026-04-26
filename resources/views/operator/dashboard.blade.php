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
    </div>
</div>
@endsection

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 font-sans">

    {{-- Stat 1: Tunggu Plotting --}}
    <a href="{{ route('operator.dosen_pembimbing') }}" class="card bg-white shadow-sm border border-base-200 hover:shadow-lg hover:-translate-y-1 transition-all cursor-pointer group">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-900 uppercase tracking-widest mb-1">Perlu Plotting</p>
                    <h3 class="text-4xl font-black text-[#F49E0A]">{{ $pendingPlottingCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-[#F49E0A] flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-orange-500 mt-3 uppercase tracking-wider">→ Plotting Dosen</p>
        </div>
    </a>

    {{-- Stat 2: Ready to Register (Approved Wali) --}}
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-900 uppercase tracking-widest mb-1">Disetujui Wali</p>
                    <h3 class="text-4xl font-black text-blue-600">{{ $pendingPendaftaranCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-blue-500 mt-3 uppercase tracking-wider">Siap Mendaftar</p>
        </div>
    </div>

    {{-- Stat 3: Aktif Magang --}}
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black text-gray-900 uppercase tracking-widest mb-1">Aktif Magang</p>
                    <h3 class="text-4xl font-black text-green-600">{{ $aktifCount }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-900 mt-3 uppercase tracking-wider">Sedang berjalan</p>
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
    <div class="lg:col-span-2 space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-400 fill-mode-both">
        
        @if(!\App\Models\Setting::isReady())
            <div class="bg-red-50 border-2 border-red-200 p-6 rounded-[2rem] flex items-center gap-6 animate-pulse">
                <div class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h5 class="text-red-900 font-black uppercase tracking-tight text-sm">Database Belum Siap!</h5>
                    <p class="text-red-700 text-xs font-medium">Fitur Buka/Tutup tidak akan berfungsi. Harap jalankan <strong>php artisan migrate</strong> di terminal anda segera.</p>
                </div>
            </div>
        @endif
        {{-- PREMIUM CONTROL CENTER --}}
        <div class="relative group">
            <div class="absolute -inset-1 bg-gradient-to-r {{ $isPeriodeOpen ? 'from-green-500 to-emerald-600' : 'from-amber-400 to-orange-500' }} rounded-[2.5rem] blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
            <div class="relative bg-white rounded-[2.3rem] p-8 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-8 border border-gray-50">
                
                <div class="flex flex-col md:flex-row items-center gap-8">
                    {{-- Animated Status Icon --}}
                    <div class="relative">
                        <div class="absolute inset-0 {{ $isPeriodeOpen ? 'bg-green-400' : 'bg-amber-400' }} rounded-3xl blur-xl opacity-20 animate-pulse"></div>
                        <div class="w-20 h-20 rounded-3xl {{ $isPeriodeOpen ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600' }} flex items-center justify-center shadow-inner relative z-10 border border-white/50">
                            @if($isPeriodeOpen)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 9.9-1"></path></svg>
                            @endif
                        </div>
                    </div>

                    <div class="text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                            <span class="w-2 h-2 rounded-full {{ $isPeriodeOpen ? 'bg-green-500 animate-ping' : 'bg-amber-500' }}"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Main System Status</span>
                        </div>
                        <h4 class="text-2xl font-black text-gray-900 tracking-tight leading-tight">
                            Pendaftaran Mahasiswa: 
                            <span class="{{ $isPeriodeOpen ? 'text-green-600' : 'text-amber-600' }} uppercase underline decoration-4 underline-offset-4">
                                {{ $isPeriodeOpen ? 'DIBUKA' : 'DITUTUP' }}
                            </span>
                        </h4>
                        <p class="text-sm font-medium text-gray-500 mt-2 max-w-sm">
                            {{ $isPeriodeOpen ? 'Sistem saat ini menerima berkas pendaftaran. Pantau antrean secara berkala.' : 'Akses pendaftaran dikunci. Mahasiswa hanya dapat melihat dashboard tanpa mendaftar.' }}
                        </p>
                    </div>
                </div>
                
                <div class="flex flex-col gap-3 min-w-[240px]">
                    <form action="{{ route('operator.periode.toggle') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin ' + ('{{ $isPeriodeOpen }}' == '1' ? 'MENUTUP' : 'MEMBUKA') + ' pendaftaran?')">
                        @csrf
                        <button type="submit" 
                                class="w-full group relative px-8 py-5 rounded-2xl {{ $isPeriodeOpen ? 'bg-gray-900 shadow-gray-900/10' : 'bg-amber-500 shadow-amber-500/20' }} text-white font-black overflow-hidden transition-all hover:scale-[1.02] active:scale-95 border-none shadow-2xl">
                            <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <span class="relative flex items-center justify-center gap-3 text-xs uppercase tracking-[0.2em]">
                                @if($isPeriodeOpen)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    Tutup Pendaftaran
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 11V7a5 5 0 0110 0v4M8 11v-4a4 4 0 0110 0" /></svg>
                                    Buka Pendaftaran
                                @endif
                            </span>
                        </button>
                    </form>
                    <p class="text-[9px] font-bold text-center text-gray-400 uppercase tracking-widest italic">Otoritas akses penuh Operator SIDUL</p>
                </div>
            </div>
        </div>


        <div class="bg-white rounded-[2rem] border border-base-200 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-[#F49E0A] rounded-full"></div>
                    <h3 class="font-black text-gray-800 text-lg tracking-tight">Antrean Plotting (Baru Daftar)</h3>
                </div>
                <a href="{{ route('operator.dosen_pembimbing') }}" class="text-[10px] font-black text-[#6B21A8] hover:underline uppercase tracking-widest">Lihat Semua →</a>
            </div>

            <div class="divide-y divide-gray-100">
                @forelse($recentPending as $index => $magang)
                @php $mhs = $magang->peserta->first()->mahasiswa; @endphp
                <div class="flex items-center justify-between p-6 hover:bg-gray-50/50 transition-all">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-black text-black font-black w-4">{{ $index + 1 }}</span>
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($mhs->nama, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm">{{ $mhs->nama }}</p>
                            <p class="text-[10px] text-gray-900 font-medium uppercase tracking-wider">{{ $magang->perusahaan }}</p>
                        </div>
                    </div>
                    <a href="{{ route('operator.dosen_pembimbing') }}" class="btn btn-ghost btn-sm rounded-lg text-[9px] font-black text-[#6B21A8] uppercase tracking-widest hover:bg-purple-50 shrink-0">Plotting →</a>
                </div>
                @empty
                <div class="p-12 text-center">
                    <p class="text-[10px] font-black text-black font-black uppercase tracking-widest italic">Tidak ada antrean pendaftaran saat ini</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Panel Aksi Cepat --}}
    <div class="space-y-4">
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm p-6 space-y-4">
            <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-widest mb-2">Aksi Cepat</h4>

            <a href="{{ route('operator.dosen_pembimbing') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Plotting Dosen</p>
                    <p class="text-[10px] font-bold text-gray-900">{{ $pendingPlottingCount }} menunggu</p>
                </div>
            </a>

            <a href="{{ route('operator.monitoring') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-green-50 hover:bg-green-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Monitoring</p>
                    <p class="text-[10px] font-bold text-gray-900">{{ $aktifCount }} aktif magang</p>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
