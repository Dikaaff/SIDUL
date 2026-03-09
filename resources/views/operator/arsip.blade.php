@extends('layouts.app')

@section('title', 'Arsip & Riwayat Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Arsip & Riwayat 🏛️
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Kelola data historis magang, database perusahaan, dan arsip laporan mahasiswa.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Archive Sections -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Section: Laporan Kolektif -->
        <div class="card bg-white shadow-sm border border-base-200">
             <div class="px-8 py-6 border-b border-base-100 flex items-center justify-between bg-gray-50/30">
                <h3 class="font-bold text-gray-800 flex items-center gap-3">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                     Arsip Laporan Mahasiswa
                </h3>
                <div class="flex gap-2">
                     <button class="btn btn-xs bg-gray-100 border-none text-gray-600 font-bold uppercase tracking-widest px-3">Filter Tahun</button>
                </div>
            </div>
            <div class="p-6">
                 <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div class="p-5 border-2 border-gray-100 rounded-3xl hover:border-[#6B21A8]/20 hover:bg-purple-50/30 transition-all cursor-pointer group flex items-center justify-between">
                           <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-[#6B21A8] group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                </div>
                                <div>
                                     <h4 class="font-black text-gray-800 text-sm">Angkatan 2021</h4>
                                     <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">124 Laporan Tersimpan</p>
                                </div>
                           </div>
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300 group-hover:text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                      </div>

                      <div class="p-5 border-2 border-gray-100 rounded-3xl hover:border-[#6B21A8]/20 hover:bg-purple-50/30 transition-all cursor-pointer group flex items-center justify-between">
                           <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-[#6B21A8] group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                </div>
                                <div>
                                     <h4 class="font-black text-gray-800 text-sm">Angkatan 2022</h4>
                                     <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">89 Laporan Tersimpan</p>
                                </div>
                           </div>
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300 group-hover:text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                      </div>
                 </div>
            </div>
        </div>

        <!-- Section: Database Perusahaan -->
        <div class="card bg-white shadow-sm border border-base-200">
             <div class="px-8 py-6 border-b border-base-100 flex items-center justify-between bg-gray-50/30">
                <h3 class="font-bold text-gray-800 flex items-center gap-3">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#F49E0A]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                     Database Perusahaan Magang
                </h3>
            </div>
            <div class="p-4 overflow-x-auto">
                 <table class="table table-compact w-full">
                      <thead>
                           <tr class="text-gray-400 font-extrabold text-[9px] uppercase tracking-widest">
                                <th>Nama Perusahaan</th>
                                <th>Lokasi</th>
                                <th>Total Alumni</th>
                                <th>Rating</th>
                           </tr>
                      </thead>
                      <tbody>
                           <tr class="border-b border-gray-50 hover:bg-gray-50/50">
                                <td class="font-bold text-gray-800 text-xs">PT. Solusi Digital Group</td>
                                <td class="text-[10px] text-gray-400 uppercase font-black tracking-widest">Jakarta</td>
                                <td class="text-center font-bold text-gray-500">24</td>
                                <td>⭐⭐⭐⭐⭐</td>
                           </tr>
                      </tbody>
                 </table>
            </div>
        </div>
    </div>

    <!-- Sidebar Export Actions -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-8">
                <h4 class="font-black text-gray-400 text-[10px] uppercase tracking-[0.2em] mb-6">Ekspor Data Kolektif</h4>
                <div class="space-y-3">
                     <button class="btn btn-sm bg-red-500 hover:bg-red-600 border-none text-white w-full font-black uppercase tracking-widest text-[9px] h-11 flex items-center gap-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                         Export PDF (Laporan)
                     </button>
                     <button class="btn btn-sm bg-green-500 hover:bg-green-600 border-none text-white w-full font-black uppercase tracking-widest text-[9px] h-11 flex items-center gap-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                         Export Excel (Database)
                     </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
