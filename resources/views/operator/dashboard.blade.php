@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('header')
<x-page-header 
    title="Dashboard Operator 🚀" 
    subtitle="Selamat datang. Berikut ringkasan sistem magang yang perlu Anda tindaklanjuti hari ini." 
/>
@endsection

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 font-sans">

    <a href="{{ route('operator.dosen_pembimbing') }}" class="block">
        <x-stat-card value="{{ $pendingPlottingCount }}" label="Perlu Plotting" color="amber" class="hover:shadow-lg hover:-translate-y-1">
            <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></x-slot>
        </x-stat-card>
    </a>

    <x-stat-card value="{{ $pendingPendaftaranCount }}" label="Disetujui Wali" color="blue">
        <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></x-slot>
    </x-stat-card>

    <x-stat-card value="{{ $aktifCount }}" label="Aktif Magang" color="green">
        <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg></x-slot>
    </x-stat-card>

    <x-stat-card value="{{ $selesaiCount }}" label="Magang Selesai" color="purple">
        <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></x-slot>
    </x-stat-card>

    <a href="{{ route('operator.edit_requests') }}" class="block">
        <x-stat-card value="{{ $pendingEditCount }}" label="Permintaan Edit" color="amber" class="hover:shadow-lg hover:-translate-y-1">
            <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg></x-slot>
        </x-stat-card>
    </a>

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
        {{-- BRAND CONSISTENT CONTROL CENTER --}}
        <x-card padding="large" border class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex flex-col md:flex-row items-center gap-6">
                {{-- Status Indicator Icon --}}
                <div class="w-16 h-16 rounded-2xl {{ $isPeriodeOpen ? 'bg-emerald-50 text-emerald-500' : 'bg-red-50 text-red-500' }} flex items-center justify-center shrink-0">
                    @if($isPeriodeOpen)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    @endif
                </div>

                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                        <span class="w-2 h-2 rounded-full {{ $isPeriodeOpen ? 'bg-emerald-500 animate-pulse' : 'bg-red-500' }}"></span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-[#6B21A8]">Status Sistem Utama</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 tracking-tight">
                        Pendaftaran: 
                        <span class="{{ $isPeriodeOpen ? 'text-emerald-600' : 'text-red-600' }}">
                            {{ $isPeriodeOpen ? 'Diterima & Terbuka' : 'Ditolak & Tertutup' }}
                        </span>
                    </h4>
                    <p class="text-xs font-medium text-gray-500 mt-1 max-w-sm leading-relaxed">
                        {{ $isPeriodeOpen ? 'Sistem sedang menerima berkas pendaftaran mahasiswa baru.' : 'Sistem sedang menolak seluruh akses pendaftaran mahasiswa.' }}
                    </p>
                </div>
            </div>
            
            <div class="w-full md:w-auto">
                {{-- Toggle Form --}}
                <form id="toggleSystemForm" action="{{ route('operator.periode.toggle') }}" method="POST" class="hidden">
                    @csrf
                </form>

                <button type="button" 
                        onclick="document.getElementById('toggle_confirm_modal').showModal()"
                        class="btn {{ $isPeriodeOpen ? 'bg-red-500 hover:bg-red-600 shadow-red-200' : 'bg-emerald-500 hover:bg-emerald-600 shadow-emerald-200' }} text-white border-none px-10 rounded font-bold uppercase tracking-widest text-[10px] h-14 w-full md:w-auto shadow-xl transition-all active:scale-95">
                    @if($isPeriodeOpen)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Tutup Pendaftaran
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Buka Pendaftaran
                    @endif
                </button>
            </div>
        </x-card>


        <x-card padding="none" border>
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
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Tidak ada antrean pendaftaran saat ini</p>
                </div>
                @endforelse
            </div>
        </x-card>
    </div>

    {{-- Panel Aksi Cepat --}}
    <div class="space-y-4">
        <x-card border class="space-y-4">
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

            <a href="{{ route('operator.edit_requests') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-amber-50 hover:bg-amber-100 transition-all group">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <div>
                    <p class="font-black text-gray-800 text-sm">Permintaan Edit</p>
                    <p class="text-[10px] font-bold text-gray-900">{{ $pendingEditCount }} menunggu</p>
                </div>
            </a>
        </x-card>
    </div>
</div>


{{-- Toggle System Confirmation Modal --}}
<x-modal id="toggle_confirm_modal" size="md">
    <div class="flex flex-col items-center text-center">
        {{-- Status Icon --}}
        <div class="w-20 h-20 rounded-3xl {{ $isPeriodeOpen ? 'bg-red-50 text-red-500' : 'bg-emerald-50 text-emerald-500' }} flex items-center justify-center mb-6">
            @if($isPeriodeOpen)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            @endif
        </div>

        <h3 class="text-2xl font-bold text-gray-800 mb-2">Konfirmasi Akses Sistem</h3>
        <p class="text-sm font-medium text-gray-500 leading-relaxed max-w-xs">
            Apakah Anda yakin ingin <strong>{{ $isPeriodeOpen ? 'MENUTUP' : 'MEMBUKA' }}</strong> akses pendaftaran magang untuk mahasiswa?
        </p>

        <div class="grid grid-cols-2 gap-4 w-full mt-10">
            <form method="dialog">
                <x-button variant="ghost" size="lg" :full="true">Batal</x-button>
            </form>
            <x-button
                variant="{{ $isPeriodeOpen ? 'red' : 'green' }}"
                size="lg"
                :full="true"
                onclick="document.getElementById('toggleSystemForm').submit()"
            >
                Ya, {{ $isPeriodeOpen ? 'Tutup' : 'Buka' }} Akses
            </x-button>
        </div>
    </div>
</x-modal>

@endsection
