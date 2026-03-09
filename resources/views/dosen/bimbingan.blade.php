@extends('layouts.app')

@section('title', 'Bimbingan Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Bimbingan Laporan 📝
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Review draft laporan mahasiswa, berikan revisi, atau berikan persetujuan akhir.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- List Draft Laporan -->
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between px-2">
            <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                 <span class="w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center text-sm">5</span>
                 Draft Laporan Masuk
            </h3>
        </div>

        <!-- Draft Item 1 -->
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-4">
                        <div class="avatar placeholder">
                            <div class="bg-gray-100 text-[#6B21A8] rounded-xl w-14 h-14 flex items-center justify-center font-bold text-xl">AS</div>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-gray-800 text-lg">Andi Saputra</h4>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">NIM: 210401001 • Versi Draft: 2.0</p>
                        </div>
                    </div>
                    <div class="badge badge-warning badge-outline font-extrabold text-[10px] py-3 px-4 uppercase tracking-[0.1em] border-2">Perlu Review</div>
                </div>

                <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100 mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-white rounded-xl shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Laporan_Magang_V2_Andi.pdf</p>
                            <p class="text-[10px] text-gray-400 font-medium">PDF • 4.2 MB • Diunggah 1 jam yang lalu</p>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-ghost text-[#6B21A8] font-extrabold underline decoration-2 underline-offset-4">Download</button>
                </div>

                <div class="collapse collapse-arrow bg-purple-50/30 border border-purple-100 rounded-2xl mb-6">
                    <input type="checkbox" /> 
                    <div class="collapse-title text-sm font-bold text-[#6B21A8] flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                        Catatan Mahasiswa
                    </div>
                    <div class="collapse-content"> 
                        <p class="text-xs text-purple-900 leading-relaxed font-medium">"Sudah memperbaiki bagian Bab 3 sesuai arahan sebelumnya. Mohon review untuk bagian integrasi API yang sudah saya tambahkan."</p>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-3">
                    <button class="btn btn-outline border-base-200 text-gray-500 hover:bg-gray-50 flex-1 font-bold">Tandai Perlu Revisi</button>
                    <button class="btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none shadow-lg shadow-purple-100 flex-1 font-bold">Berikan Persetujuan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Stats -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h4 class="text-xs font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-4">Statistik Bimbingan</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-600">Total Draft</span>
                        <span class="text-sm font-extrabold text-[#6B21A8]">24</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-600">Belum Direview</span>
                        <span class="badge badge-warning font-bold text-[10px]">5</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-bold text-gray-600">Telah Disetujui</span>
                        <span class="badge badge-success text-white font-bold text-[10px]">12</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-orange-500 text-white shadow-xl shadow-orange-100 overflow-hidden">
            <div class="card-body p-6 relative">
                 <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-lg font-extrabold mb-1">Deadline Review</h3>
                <p class="text-white/80 text-xs leading-relaxed font-medium mb-4">Pastikan semua draft laporan diselesaikan sebelum masa penilaian akhir semester ini.</p>
                <div class="bg-white/10 backdrop-blur-sm p-3 rounded-xl border border-white/20">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-white/60 mb-1">Target Selesai:</p>
                    <p class="text-sm font-extrabold">20 Maret 2026</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
