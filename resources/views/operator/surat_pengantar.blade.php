@extends('layouts.app')

@section('title', 'Kelola Surat Pengantar')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Surat Pengantar Magang 📄
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Generate draf surat pengantar dan lakukan verifikasi tanda tangan digital dekanat/prodi.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Filters & Stats (Left) -->
    <div class="lg:col-span-1 space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h4 class="font-extrabold text-gray-400 text-[10px] uppercase tracking-widest mb-4">Statistik Keaslian</h4>
                <div class="space-y-4">
                    <div class="p-4 bg-purple-50 rounded-2xl border border-purple-100">
                         <h5 class="text-2xl font-black text-[#6B21A8]">45</h5>
                         <p class="text-[9px] font-bold text-purple-900/60 uppercase tracking-widest">Surat Digenerate</p>
                    </div>
                    <div class="p-4 bg-orange-50 rounded-2xl border border-orange-100">
                         <h5 class="text-2xl font-black text-orange-600">8</h5>
                         <p class="text-[9px] font-bold text-orange-900/60 uppercase tracking-widest">Menunggu Verifikasi</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-gray-50 border border-gray-100">
            <div class="card-body p-6">
                 <h4 class="font-bold text-gray-800 text-xs mb-3">Tindakan Cepat</h4>
                 <button class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 border-none text-white w-full font-black uppercase tracking-widest text-[9px] mb-2 h-10 min-h-0">Generate Semua Draf</button>
                 <button class="btn btn-sm btn-outline border-gray-300 text-gray-400 w-full font-black uppercase tracking-widest text-[9px] h-10 min-h-0">Cetak Arsip Kolektif</button>
            </div>
        </div>
    </div>

    <!-- Main List (Center/Right) -->
    <div class="lg:col-span-3 space-y-6">
        <div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
            <div class="px-8 py-5 border-b border-base-100 bg-gray-50/30 flex items-center justify-between">
                <h3 class="font-black text-gray-800 text-base uppercase tracking-tight">Daftar Penerbitan Surat</h3>
                 <div class="join">
                    <button class="btn btn-xs join-item bg-white border-base-200 text-gray-500 font-bold uppercase tracking-widest active">Semua</button>
                    <button class="btn btn-xs join-item bg-white border-base-200 text-gray-300 font-bold uppercase tracking-widest">Minggu Ini</button>
                 </div>
            </div>
            
            <table class="table w-full">
                <thead>
                    <tr class="text-gray-400 font-extrabold text-[9px] uppercase tracking-[0.2em] bg-gray-50/20">
                        <th class="py-5">Mahasiswa</th>
                        <th>No. Surat</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr class="hover:bg-gray-50/50 border-b border-gray-100 transition-colors">
                        <td class="py-6">
                            <div class="font-extrabold text-gray-800 text-sm">Andi Saputra</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">TI / Ganjil 2026</div>
                        </td>
                        <td class="text-xs font-black text-gray-500 tracking-tighter">102/UN.1/TI/MAGANG/2026</td>
                        <td>
                            <span class="text-[9px] font-black uppercase px-2 py-0.5 bg-gray-100 rounded-lg text-gray-400 border border-gray-200 uppercase tracking-widest">Nasional</span>
                        </td>
                        <td>
                             <span class="badge badge-success text-[9px] font-black uppercase tracking-widest text-white border-none py-2 px-3">Terverifikasi</span>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-xs text-[#6B21A8] font-black uppercase tracking-widest hover:bg-purple-50">Unduh</button>
                        </td>
                    </tr>

                    <!-- Row 2 -->
                    <tr class="hover:bg-gray-50/50 border-b border-gray-100 transition-colors">
                        <td class="py-6">
                            <div class="font-extrabold text-gray-800 text-sm">Budi Ramadhan</div>
                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">TI / Ganjil 2026</div>
                        </td>
                        <td class="text-xs font-black text-gray-300 tracking-tighter">(Draf Belum Dibuat)</td>
                        <td>
                            <span class="text-[9px] font-black uppercase px-2 py-0.5 bg-gray-100 rounded-lg text-gray-400 border border-gray-200 uppercase tracking-widest">Nasional</span>
                        </td>
                        <td>
                             <span class="badge badge-warning text-[9px] font-black uppercase tracking-widest text-white border-none py-2 px-3">Menunggu Draf</span>
                        </td>
                        <td>
                            <button class="btn bg-[#6B21A8] text-white btn-xs font-black uppercase tracking-widest border-none px-3 hover:bg-purple-800">Generate</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
