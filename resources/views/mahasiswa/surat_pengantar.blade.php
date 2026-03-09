@extends('layouts.app')

@section('title', 'Pengajuan Surat Pengantar')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Pengajuan Surat Pengantar ✉️
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Sistem membuat surat pengantar magang otomatis untuk Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Detail Surat Pengantar
            </h3>
            
            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                    <div>
                        <div class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Nomor Surat</div>
                        <div class="text-sm font-semibold text-gray-800 italic">Otomatis Tergenerate</div>
                    </div>
                    <div>
                        <div class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Tanggal Terbit</div>
                        <div class="text-sm font-semibold text-gray-800">09 Maret 2026</div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Tujuan Perusahaan</div>
                        <div class="text-sm font-semibold text-gray-800">PT. Teknologi Inovasi Group</div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                <button class="btn btn-primary btn-md px-10 gap-2 shadow-lg shadow-purple-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    Preview Surat
                </button>
                <button class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none px-10 gap-2 shadow-lg shadow-orange-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0L8 8m4-4v12" /></svg>
                    Download PDF
                </button>
            </div>

            <div class="mt-12 p-4 bg-orange-50 border border-orange-100 rounded-xl">
                <p class="text-xs text-orange-800 flex items-start gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span><strong>Catatan:</strong> Surat ini sudah sah secara sistem dan tidak memerlukan tanda tangan basah untuk keperluan administrasi awal.</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
