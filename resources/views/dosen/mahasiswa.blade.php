@extends('layouts.app')

@section('title', 'Mahasiswa Bimbingan')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-xl font-bold text-white">
            Mahasiswa Bimbingan
        </h2>
        <p class="text-white/80 mt-1 text-sm">Daftar mahasiswa yang sedang Anda bimbing dalam program magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
    <div class="p-5 border-b flex flex-col md:flex-row md:items-center justify-between gap-4" style="background-color: #F9FAFB; border-color: #e5e7eb;">
        <div class="flex items-center gap-2">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" placeholder="Cari nama, NIM, instansi..." class="input input-sm input-bordered w-full md:w-64 pl-9 bg-white text-black focus:border-[#6B21A8] focus:outline-none" />
            </div>
            <button class="btn btn-sm bg-white border-gray-300 text-gray-700 hover:bg-gray-50">Filter</button>
        </div>
        <div class="text-sm text-gray-500 font-medium">Total: 12 Mahasiswa</div>
    </div>
    
    <div class="overflow-x-auto w-full text-black">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-500 text-sm border-b" style="border-color: #e5e7eb; background-color: #F9FAFB;">
                    <th class="font-semibold py-4">Mahasiswa</th>
                    <th class="font-semibold py-4">Instansi & Judul Magang</th>
                    <th class="font-semibold py-4">Status Magang</th>
                    <th class="font-semibold py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color: #e5e7eb;">
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold" style="background-color: #F49E0A;">
                                    AF
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-[#6B21A8]">Ahmad Fauzi</div>
                                <div class="text-xs text-gray-500">210103001 • Informatika</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">PT. Teknologi Cerdas</span>
                            <span class="text-xs text-gray-500">Pengembangan API Mobile...</span>
                        </div>
                    </td>
                    <td>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background-color: #fef3c7; color: #F49E0A;">Prasurvey</span>
                    </td>
                    <th class="text-right">
                        <button class="btn btn-sm btn-ghost hover:bg-[#f3e8ff] hover:text-[#6B21A8] text-gray-500 font-medium">Detail</button>
                    </th>
                </tr>
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold" style="background-color: #6B21A8;">
                                    SA
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-[#6B21A8]">Siti Aminah</div>
                                <div class="text-xs text-gray-500">210103002 • Sistem Informasi</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">Bank Nasional Nusantara</span>
                            <span class="text-xs text-gray-500">Analisis Risiko Keamanan...</span>
                        </div>
                    </td>
                    <td>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Magang Aktif</span>
                    </td>
                    <th class="text-right">
                        <button class="btn btn-sm btn-ghost hover:bg-[#f3e8ff] hover:text-[#6B21A8] text-gray-500 font-medium">Detail</button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.table th { text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; padding-top: 1rem; padding-bottom: 1rem; }
.table td, .table th { border-bottom: none; }
</style>
@endsection
