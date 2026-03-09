@extends('layouts.app')

@section('title', 'Verifikasi Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Verifikasi Laporan 📓
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Periksa kesesuaian laporan akhir mahasiswa yang telah disetujui oleh dosen pembimbing.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
     <div class="px-8 py-5 border-b border-base-100 bg-gray-50/50">
        <h3 class="font-extrabold text-gray-800 text-base uppercase tracking-tight">Antrean Verifikasi Laporan Akhir</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-400 font-extrabold text-[9px] uppercase tracking-[0.2em] bg-gray-50/20">
                    <th class="py-5">Mahasiswa</th>
                    <th>Berkas Laporan</th>
                    <th>Persetujuan Dosen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50/50 border-b border-gray-100 transition-colors">
                    <td class="py-6">
                        <div class="font-extrabold text-gray-800 text-sm">Andi Saputra</div>
                        <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">210401001 • Teknik Informatika</div>
                    </td>
                    <td>
                         <div class="flex items-center gap-2 text-[#6B21A8] font-bold text-xs group cursor-pointer">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                              <span class="group-hover:underline">Laporan_Full.pdf</span>
                         </div>
                    </td>
                    <td>
                         <div class="flex items-center gap-2 text-green-600">
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                              <span class="text-[10px] font-black uppercase tracking-widest">Disetujui Pembimbing</span>
                         </div>
                    </td>
                    <td>
                         <span class="badge badge-warning text-[9px] font-black uppercase tracking-widest text-white border-none py-2 px-3">Menunggu Validasi</span>
                    </td>
                    <td>
                        <button class="btn bg-[#6B21A8] text-white btn-xs font-black uppercase tracking-widest border-none px-4 hover:bg-purple-800">Validasi</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
