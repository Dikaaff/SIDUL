@extends('layouts.app')

@section('title', 'Laporan Magang')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">Review Laporan Akhir 📄</h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Review dan berikan persetujuan untuk laporan akhir magang mahasiswa bimbingan Anda.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center shrink-0">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">Dosen Pembimbing</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden font-sans">

    {{-- Table Header --}}
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="font-black text-gray-800 text-lg tracking-tight">Daftar Laporan Akhir</h3>
        </div>
        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Menampilkan 2 laporan</span>
    </div>

    {{-- Column Headers --}}
    <div class="px-8 py-3 grid grid-cols-12 gap-4 border-b border-gray-100">
        <div class="col-span-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Dokumen Laporan</div>
        <div class="col-span-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Mahasiswa</div>
        <div class="col-span-3 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status & Waktu</div>
        <div class="col-span-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</div>
    </div>

    {{-- Row 1: Pending --}}
    <div class="px-8 py-5 grid grid-cols-12 gap-4 items-center hover:bg-gray-50/50 transition-all border-b border-gray-100 group">
        <div class="col-span-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <p class="font-black text-[#6B21A8] text-sm tracking-tight group-hover:underline">Laporan_Akhir_Ahmad_v1.pdf</p>
                <p class="text-[11px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider">Revisi ke: 0</p>
            </div>
        </div>
        <div class="col-span-2">
            <p class="font-black text-gray-800 text-sm">Ahmad Fauzi</p>
            <p class="text-[11px] font-bold text-gray-400 mt-0.5">Informatika</p>
        </div>
        <div class="col-span-3">
            <span class="inline-block text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-lg bg-orange-50 text-[#F49E0A] mb-1">Pending Review</span>
            <p class="text-[11px] font-bold text-gray-400">2 hari yang lalu</p>
        </div>
        <div class="col-span-2 flex justify-end gap-2">
            <button class="btn btn-sm rounded-xl border border-gray-200 bg-white text-gray-600 hover:bg-gray-50 font-black text-[10px] uppercase tracking-wider">Revisi</button>
            <button class="btn btn-sm rounded-xl bg-[#6B21A8] hover:bg-purple-800 border-none text-white font-black text-[10px] uppercase tracking-wider">Setujui</button>
        </div>
    </div>

    {{-- Row 2: Approved --}}
    <div class="px-8 py-5 grid grid-cols-12 gap-4 items-center hover:bg-gray-50/50 transition-all group">
        <div class="col-span-5 flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div>
                <p class="font-black text-[#6B21A8] text-sm tracking-tight group-hover:underline">Laporan_Akhir_Siti_Final.pdf</p>
                <p class="text-[11px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider">Revisi ke: 2</p>
            </div>
        </div>
        <div class="col-span-2">
            <p class="font-black text-gray-800 text-sm">Siti Aminah</p>
            <p class="text-[11px] font-bold text-gray-400 mt-0.5">Sistem Informasi</p>
        </div>
        <div class="col-span-3">
            <span class="inline-block text-[10px] font-black uppercase tracking-wider px-3 py-1.5 rounded-lg bg-green-50 text-green-600 mb-1">Disetujui</span>
            <p class="text-[11px] font-bold text-gray-400">10 Nov 2026</p>
        </div>
        <div class="col-span-2 flex justify-end">
            <button class="btn btn-sm rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-[#6B21A8] hover:bg-purple-50 hover:border-purple-100 font-black text-[10px] uppercase tracking-wider transition-all">Unduh PDF</button>
        </div>
    </div>

</div>
@endsection

