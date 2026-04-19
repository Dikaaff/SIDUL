@extends('layouts.app')

@section('title', 'Review Laporan Akhir')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#2563EB] p-8 rounded-[2.5rem] shadow-lg mt-2 relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl transition-all duration-1000"></div>
    <div class="z-10 relative">
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">Laporan Akhir</h2>
        <p class="text-white/80 mt-1 text-sm font-bold uppercase tracking-widest text-[10px]">Validasi dan setujui laporan akhir magang kelompok bimbingan Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-base-200 shadow-sm text-center py-20">
    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-blue-100 shadow-inner">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
    </div>
    <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter italic">Fitur Review Segera Hadir</h3>
    <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">Dosen akan dapat mengunduh dan memberikan penilaian <br> setelah mahasiswa mengunggah draf laporan akhir.</p>
</div>
@endsection
