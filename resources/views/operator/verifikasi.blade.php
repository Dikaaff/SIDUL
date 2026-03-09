@extends('layouts.app')

@section('title', 'Verifikasi Dokumen Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Verifikasi Dokumen 🔍
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Periksa dan berikan status pada dokumen-dokumen pengajuan magang mahasiswa.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
    <div class="px-8 py-6 border-b border-base-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
        <h3 class="font-bold text-xl text-gray-800 flex items-center gap-3">
             <span class="w-2 h-6 bg-[#F49E0A] rounded-full"></span>
             Antrean Verifikasi
        </h3>
        <div class="flex gap-2">
            <select class="select select-sm select-bordered bg-white text-gray-700 font-bold focus:border-[#6B21A8]">
                <option selected>Semua Jenis Dokumen</option>
                <option>Surat Rekomendasi</option>
                <option>Pra Survey</option>
                <option>Surat Diterima</option>
            </select>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table table-lg w-full">
            <thead>
                <tr class="text-gray-400 font-extrabold text-[10px] uppercase tracking-[0.2em] bg-gray-50/30">
                    <th class="py-6">Mahasiswa</th>
                    <th>Dokumen</th>
                    <th>Instansi</th>
                    <th>Tgl Unggah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Entry 1 -->
                <tr class="hover:bg-gray-50 transition-colors border-b border-base-100 group">
                    <td class="py-8">
                        <div class="font-extrabold text-gray-800 text-sm">Andi Saputra</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">210401001</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 bg-purple-50 text-[#6B21A8] text-[9px] font-black rounded-lg border border-purple-100 uppercase tracking-widest">Surat Diterima</span>
                        </div>
                    </td>
                    <td class="text-xs font-bold text-gray-600 uppercase tracking-tight">PT. Solusi Digital Indonesia</td>
                    <td class="text-xs font-medium text-gray-400">09 Mar 2026</td>
                    <td>
                        <span class="badge badge-warning badge-outline font-extrabold text-[9px] py-3 px-3 uppercase tracking-[0.1em] border-2">Pending Review</span>
                    </td>
                    <td>
                        <div class="flex gap-1">
                             <button class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 text-white border-none text-[10px] font-black uppercase tracking-widest px-4">Verifikasi</button>
                        </div>
                    </td>
                </tr>

                <!-- Entry 2 -->
                <tr class="hover:bg-gray-50 transition-colors border-b border-base-100 group">
                    <td class="py-8">
                        <div class="font-extrabold text-gray-800 text-sm">Budi Ramadhan</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">210401045</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[9px] font-black rounded-lg border border-blue-100 uppercase tracking-widest">Pra Survey</span>
                        </div>
                    </td>
                    <td class="text-xs font-bold text-gray-600 uppercase tracking-tight">Bank Mandiri (Persero)</td>
                    <td class="text-xs font-medium text-gray-400">08 Mar 2026</td>
                    <td>
                        <span class="badge badge-warning badge-outline font-extrabold text-[9px] py-3 px-3 uppercase tracking-[0.1em] border-2">Pending Review</span>
                    </td>
                    <td>
                        <div class="flex gap-1">
                             <button class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 text-white border-none text-[10px] font-black uppercase tracking-widest px-4">Verifikasi</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Simple Verification Modal Placeholder -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="card bg-green-50/50 border border-green-100 p-6 rounded-3xl">
        <h4 class="font-black text-green-700 text-xs uppercase tracking-widest mb-2">Persetujuan</h4>
        <p class="text-[10px] text-green-800/70 leading-relaxed font-bold">Dokumen yang disetujui akan meluncurkan tahap magang berikutnya secara otomatis di sisi mahasiswa.</p>
    </div>
    <div class="card bg-red-50/50 border border-red-100 p-6 rounded-3xl">
        <h4 class="font-black text-red-700 text-xs uppercase tracking-widest mb-2">Penolakan</h4>
        <p class="text-[10px] text-red-800/70 leading-relaxed font-bold">Pastikan memberikan alasan yang jelas jika menolak dokumen agar mahasiswa dapat memperbaikinya.</p>
    </div>
    <div class="card bg-orange-50/50 border border-orange-100 p-6 rounded-3xl">
        <h4 class="font-black text-orange-700 text-xs uppercase tracking-widest mb-2">Revisi Berkas</h4>
        <p class="text-[10px] text-orange-800/70 leading-relaxed font-bold">Gunakan status revisi jika dokumen sudah benar namun memerlukan penyesuaian kecil.</p>
    </div>
</div>
@endsection
