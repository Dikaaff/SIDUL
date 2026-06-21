@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('header')
<x-page-header 
    title="Dashboard Operator 🚀" 
    subtitle="Selamat datang. Berikut ringkasan sistem magang yang perlu Anda tindaklanjuti hari ini." 
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/operator" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Dashboard</li>
  </ul>
</div>
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

</div>

{{-- Main Content --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 font-sans">

    {{-- Antrean Terbaru --}}
    <div class="lg:col-span-2 space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500 delay-400 fill-mode-both">
        
        @if(!\App\Models\Setting::isReady())
            <div class="bg-red-50 border-2 border-red-200 p-6 rounded-2xl flex items-center gap-6 animate-pulse">
                <div class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h5 class="text-red-900 font-black uppercase tracking-tight text-sm">Database Belum Siap!</h5>
                    <p class="text-red-700 text-xs font-medium">Fitur Buka/Tutup tidak akan berfungsi. Harap jalankan <strong>php artisan migrate</strong> di terminal anda segera.</p>
                </div>
            </div>
        @endif
        {{-- BRAND CONSISTENT CONTROL CENTER --}}
        <x-card padding="large" border class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl {{ $isPeriodeOpen ? 'bg-gradient-to-br from-emerald-50 to-emerald-100 text-emerald-500' : 'bg-gradient-to-br from-slate-100 to-slate-200 text-slate-400' }} flex items-center justify-center shrink-0 shadow-sm">
                    @if($isPeriodeOpen)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    @endif
                </div>

                <div>
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="w-1.5 h-1.5 rounded-full {{ $isPeriodeOpen ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                        <span class="text-[9px] font-bold uppercase tracking-[0.2em] text-[#6B21A8]">Sistem Pendaftaran</span>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 tracking-tight">
                        Status: <span class="{{ $isPeriodeOpen ? 'text-emerald-600' : 'text-slate-500' }}">{{ $isPeriodeOpen ? 'Terbuka' : 'Ditutup' }}</span>
                    </h4>
                    <p class="text-sm text-gray-400 mt-0.5 leading-relaxed">
                        {{ $isPeriodeOpen ? 'Mahasiswa dapat mendaftar dan mengunggah berkas magang melalui sistem.' : 'Saat ini sistem tidak menerima pendaftaran magang baru.' }}
                    </p>
                </div>
            </div>
            
            <div class="w-full md:w-auto">
                <form id="toggleSystemForm" action="{{ route('operator.periode.toggle') }}" method="POST" class="hidden">
                    @csrf
                </form>

                <x-button type="button"
                    variant="{{ $isPeriodeOpen ? 'danger' : 'success' }}"
                    size="lg"
                    onclick="document.getElementById('toggle_confirm_modal').showModal()"
                    class="shadow-xl w-full md:w-auto">
                    @if($isPeriodeOpen)
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Tutup Pendaftaran
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        Buka Pendaftaran
                    @endif
                </x-button>
            </div>
        </x-card>


        <x-card padding="none" border class="overflow-hidden">
            <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-2 h-8 bg-[#F49E0A] rounded-full"></div>
                    <h3 class="font-black text-gray-800 text-lg tracking-tight">Antrean Plotting (Baru Daftar)</h3>
                </div>
                <a href="{{ route('operator.dosen_pembimbing') }}" class="text-[10px] font-black text-[#6B21A8] hover:underline uppercase tracking-widest">Lihat Semua →</a>
            </div>

            <div class="overflow-x-auto custom-scrollbar">
                <table class="table w-full">
                    <thead>
                        <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                            <th class="pl-8 py-5 w-16">No</th>
                            <th class="min-w-[200px]">Mahasiswa</th>
                            <th class="min-w-[180px]">Perusahaan</th>
                            <th class="pr-8 text-right w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPending as $index => $magang)
                        @php $mhs = $magang->peserta->first()?->mahasiswa; @endphp
                        <tr class="hover:bg-gray-50 transition-all group">
                            <td class="pl-8 py-5 text-[10px] font-medium text-gray-400">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    @php $nameParts = explode(' ', $mhs->nama ?? 'Mahasiswa'); $initials = count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2)); @endphp
                                    <div class="w-8 h-8 rounded-2xl bg-orange-50 text-orange-500 font-black flex items-center justify-center text-[8px] shadow-inner group-hover:rotate-3 transition-transform shrink-0">{{ $initials }}</div>
                                    <span class="font-semibold text-gray-800 text-sm tracking-tight truncate">{{ $mhs->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="text-[10px] font-bold text-gray-600 uppercase tracking-wider">{{ $magang->perusahaan }}</span>
                            </td>
                            <td class="pr-8 text-right">
                                <a href="{{ route('operator.dosen_pembimbing') }}">
                                    <x-button variant="ghost" size="sm" class="!text-[#6B21A8] text-[9px]">Plotting →</x-button>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-16 text-center">
                                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Tidak ada antrean pendaftaran saat ini</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>

    {{-- Panel Aksi Cepat --}}
    <div class="space-y-4">
        <x-card border class="space-y-4">
            <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-widest mb-2">Aksi Cepat</h4>

            <a href="{{ route('operator.dosen_pembimbing') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-blue-50 hover:bg-blue-100 transition-all group">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Plotting Dosen</p>
                    <p class="text-[10px] font-bold text-gray-900">{{ $pendingPlottingCount }} menunggu</p>
                </div>
            </a>

            <a href="{{ route('operator.monitoring') }}" class="flex items-center gap-4 p-4 rounded-2xl bg-green-50 hover:bg-green-100 transition-all group">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">Monitoring</p>
                    <p class="text-[10px] font-bold text-gray-900">{{ $aktifCount }} aktif magang</p>
                </div>
            </a>

        </x-card>
    </div>
</div>


{{-- Toggle System Confirmation Modal --}}
<x-modal id="toggle_confirm_modal" title="Konfirmasi Akses Sistem" color="purple" size="md">
    <div class="flex flex-col items-center text-center">
        <div class="w-20 h-20 rounded-2xl {{ $isPeriodeOpen ? 'bg-red-50 text-red-500' : 'bg-emerald-50 text-emerald-500' }} flex items-center justify-center mb-6">
            @if($isPeriodeOpen)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            @endif
        </div>

        <p class="text-sm font-medium text-gray-500 leading-relaxed max-w-xs">
            Tindakan ini akan <strong>{{ $isPeriodeOpen ? 'menutup' : 'membuka' }}</strong> akses pendaftaran magang bagi mahasiswa. Yakin ingin melanjutkan?
        </p>

        <div class="grid grid-cols-2 gap-4 w-full mt-10">
            <form method="dialog" data-no-loading>
                <x-button type="submit" variant="ghost" size="lg" :full="true">Batal</x-button>
            </form>
            <x-button
                variant="{{ $isPeriodeOpen ? 'danger' : 'success' }}"
                size="lg"
                :full="true"
                onclick="document.getElementById('toggleSystemForm').submit()"
            >
                Ya, {{ $isPeriodeOpen ? 'Tutup' : 'Buka' }} Pendaftaran
            </x-button>
        </div>
    </div>
</x-modal>

@endsection
