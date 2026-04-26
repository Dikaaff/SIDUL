@extends('layouts.app')

@section('title', 'Rekomendasi Magang')

@section('header')
<x-card class="bg-[#6B21A8] text-white p-8 mt-2 relative overflow-hidden border-none shadow-2xl">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
        <div>
            <h2 class="text-3xl font-black italic tracking-tighter uppercase mb-2">
                Rekomendasi Magang ✍️
            </h2>
            <p class="text-white opacity-90 font-medium text-sm md:text-base max-w-2xl">Sebagai Dosen Wali, Anda dapat memberikan persetujuan dan tanda tangan rekomendasi magang mahasiswa dengan cepat.</p>
        </div>
    </div>
</x-card>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main List Section -->
    <div class="lg:col-span-3 space-y-6">
        <div class="flex items-center justify-between bg-white p-8 rounded-[2.5rem] border border-base-200 shadow-xl shadow-gray-100/50 mb-4 transition-all hover:shadow-2xl">
            <div>
                <h3 class="font-black text-gray-800 flex items-center gap-4 italic uppercase tracking-tighter text-xl">
                    <div class="w-2 h-8 bg-primary rounded-full"></div>
                    Antrean Rekomendasi
                </h3>
            </div>
            <div class="flex gap-2">
                <input class="input input-md bg-gray-50 border-gray-100 rounded-2xl text-xs font-bold w-64 focus:ring-4 focus:ring-primary/10 focus:bg-white transition-all" placeholder="Cari Mahasiswa Berdasarkan Nama..." />
            </div>
        </div>

        <!-- Responsive Container for the list -->
        <div class="overflow-x-auto pb-4 -mx-4 px-4 lg:mx-0 lg:px-0">
            <div class="min-w-[700px]">
                <!-- Compact List Header -->
                <div class="px-8 grid grid-cols-12 gap-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] italic mb-2">
                    <div class="col-span-4">Mahasiswa & Instansi</div>
                    <div class="col-span-2 text-center">STATUS</div>
                    <div class="col-span-3">Dokumen Draft</div>
                    <div class="col-span-3 text-right">Tindakan</div>
                </div>

                <div id="recommendationList" class="space-y-3">
                    @forelse($mhsWali as $mhs)
                    <div class="bg-white hover:bg-gray-50/50 border border-base-200 rounded-[2rem] p-6 transition-all group shadow-sm grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-4 flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-[#6B21A8] flex items-center justify-center font-black text-sm group-hover:rotate-6 transition-all duration-500">
                                {{ substr($mhs->nama, 0, 2) }}
                            </div>
                            <div class="overflow-hidden">
                                <h4 class="font-bold text-gray-900 text-lg leading-tight truncate tracking-tight">{{ $mhs->nama }}</h4>
                                <p class="text-[11px] text-[#6B21A8] font-semibold tracking-wide mt-1 truncate opacity-70">{{ $mhs->nim }}</p>
                            </div>
                        </div>
                        
                        <div class="col-span-2 flex justify-center">
                            <div class="badge {{ $mhs->status_magang === 'Approve' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-orange-50 text-[#F49E0A] border-orange-100' }} font-black text-[9px] px-5 py-4 uppercase tracking-[0.2em] rounded-xl italic border-2">
                                {{ strtoupper($mhs->status_magang) }}
                            </div>
                        </div>

                        <div class="col-span-3 flex items-center">
                            <span class="text-[10px] font-bold text-gray-400">Pengajuan Pendaftaran Akun</span>
                        </div>

                        <div class="col-span-3 flex justify-end items-center">
                            @if($mhs->status_magang === 'Approve')
                                <button class="btn btn-sm btn-ghost text-green-600 font-black uppercase text-[10px] cursor-default pointer-events-none gap-2">
                                    <div class="w-8 h-8 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <span class="italic">Direkomendasikan</span>
                                </button>
                            @else
                                <form action="{{ route('dosen.rekomendasi.approve', $mhs->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="btn h-14 min-h-0 bg-[#6B21A8] hover:bg-purple-800 text-white border-none rounded-[1.5rem] px-10 font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-purple-900/20 transition-all hover:scale-105 active:scale-95 group">
                                        <span>Approve</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="bg-gray-50 rounded-[2rem] p-12 text-center text-gray-400 border border-gray-100 border-dashed">
                        <h4 class="font-extrabold text-lg">Belum Ada Mahasiswa Perwalian</h4>
                        <p class="text-sm mt-1">Saat ini belum ada mahasiswa yang mengajukan persetujuan akun.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Side Panel Section -->
    <div class="lg:col-span-1 space-y-6">
        <x-card class="bg-[#F49E0A] text-white shadow-2xl shadow-orange-900/10 italic relative overflow-hidden group border-none">
            <x-slot name="header">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-2 h-6 bg-white rounded-full shadow-lg shadow-white/50"></div>
                    <h4 class="font-black text-xs uppercase tracking-[0.25em] italic text-white">Panduan Cepat</h4>
                </div>
            </x-slot>
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/10 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="space-y-5 relative z-10">
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white">1</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Periksa identitas pendaftar.</p>
                </div>
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white">2</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Klik tombol APPROVE.</p>
                </div>
            </div>
        </x-card>
    </div>
</div>

@if(session('success'))
<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999]">
    <div id="successNotif" class="animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-5 bg-gray-900 text-white p-6 rounded-[2.5rem] shadow-2xl border border-white/10 min-w-[350px]">
            <div id="notifIcon" class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/40"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></div>
            <p class="font-black text-xs uppercase tracking-widest italic">{{ session('success') }}</p>
        </div>
    </div>
</div>
<script>
    setTimeout(() => document.getElementById('notifContainer').style.display = 'none', 3500);
</script>
@endif
@endsection
