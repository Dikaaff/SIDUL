@extends('layouts.app')

@section('title', 'Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-xl font-bold text-white">
            Laporan Magang
        </h2>
        <p class="text-white/80 mt-1 text-sm">Review dan berikan persetujuan untuk laporan akhir magang mahasiswa.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
    <div class="overflow-x-auto w-full text-black">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-500 text-sm border-b" style="background-color: #F9FAFB; border-color: #e5e7eb;">
                    <th class="py-4">Dokumen Laporan</th>
                    <th class="py-4">Mahasiswa</th>
                    <th class="py-4">Status & Waktu</th>
                    <th class="py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color: #e5e7eb;">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded bg-blue-50 text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#6B21A8] text-sm">Laporan_Akhir_Ahmad_v1.pdf</p>
                                <p class="text-xs text-gray-500">Revisi ke: 0</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="font-medium text-sm">Ahmad Fauzi</p>
                        <p class="text-xs text-gray-500">Informatika</p>
                    </td>
                    <td>
                        <span class="badge mb-1" style="background-color: #fef3c7; border:none; color: #F49E0A;">Pending Review</span>
                        <p class="text-xs text-gray-500">2 hari yang lalu</p>
                    </td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <button class="btn btn-sm btn-outline border-gray-300 text-gray-700 hover:bg-gray-50 outline-none">Revisi</button>
                            <button class="btn btn-sm bg-[#6B21A8] hover:bg-opacity-90 border-none text-white whitespace-nowrap">Setujui</button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded bg-blue-50 text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#6B21A8] text-sm">Laporan_Akhir_Siti_Final.pdf</p>
                                <p class="text-xs text-gray-500">Revisi ke: 2</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="font-medium text-sm">Siti Aminah</p>
                        <p class="text-xs text-gray-500">Sistem Informasi</p>
                    </td>
                    <td>
                        <span class="badge bg-green-100 text-green-700 border-none mb-1">Disetujui</span>
                        <p class="text-xs text-gray-500">10 Nov 2026</p>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-ghost text-gray-500 font-medium hover:text-[#6B21A8] hover:bg-purple-50">Unduh PDF</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
