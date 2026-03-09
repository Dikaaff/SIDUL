@extends('layouts.app')

@section('title', 'Penilaian Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-xl font-bold text-white">
            Penilaian Magang
        </h2>
        <p class="text-white/80 mt-1 text-sm">Berikan nilai akhir berdasarkan laporan, bimbingan, dan presentasi mahasiswa.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
    <div class="overflow-x-auto w-full text-black">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-500 text-sm border-b" style="background-color: #F9FAFB; border-color: #e5e7eb;">
                    <th class="py-4">Mahasiswa</th>
                    <th class="py-4">Komponen Penilaian</th>
                    <th class="py-4 text-center">Nilai Akhir</th>
                    <th class="py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color: #e5e7eb;">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 w-1/3">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold" style="background-color: #F49E0A;">
                                    AF
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-[#6B21A8]">Ahmad Fauzi</div>
                                <div class="text-xs text-gray-500">210103001 • PT. Teknologi Cerdas</div>
                                <span class="badge badge-sm mt-1 bg-blue-100 text-blue-700 border-none">Laporan Disetujui</span>
                            </div>
                        </div>
                    </td>
                    <td class="w-1/3">
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Nilai Bimbingan (30%)</span>
                                <span class="badge badge-sm badge-outline border-gray-300">-</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Nilai Laporan (40%)</span>
                                <span class="badge badge-sm badge-outline border-gray-300">-</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Nilai Presentasi (30%)</span>
                                <span class="badge badge-sm badge-outline border-gray-300">-</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <span class="text-2xl font-bold text-gray-300">-</span>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm bg-[#F49E0A] hover:bg-opacity-90 border-none text-white whitespace-nowrap">Input Nilai</button>
                    </td>
                </tr>

                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 w-1/3">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold" style="background-color: #6B21A8;">
                                    SA
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-[#6B21A8]">Siti Aminah</div>
                                <div class="text-xs text-gray-500">210103002 • Bank Nasional Nusantara</div>
                                <span class="badge badge-sm mt-1 bg-green-100 text-green-700 border-none">Selesai</span>
                            </div>
                        </div>
                    </td>
                    <td class="w-1/3">
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Nilai Bimbingan (30%)</span>
                                <span class="font-semibold text-gray-800">85</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Nilai Laporan (40%)</span>
                                <span class="font-semibold text-gray-800">90</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Nilai Presentasi (30%)</span>
                                <span class="font-semibold text-gray-800">88</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-2xl font-bold" style="color: #6B21A8;">87.9</span>
                            <span class="text-xs font-bold text-green-600 mt-1">LULUS (A)</span>
                        </div>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-ghost text-gray-500 font-medium hover:text-[#6B21A8] hover:bg-purple-50">Edit Nilai</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
