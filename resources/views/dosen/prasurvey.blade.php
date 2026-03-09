@extends('layouts.app')

@section('title', 'Persetujuan Prasurvey')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-xl font-bold text-white">
            Persetujuan Prasurvey
        </h2>
        <p class="text-white/80 mt-1 text-sm">Evaluasi proposal dan cetak lembar pengesahan prasurvey magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
    <div class="overflow-x-auto w-full text-black">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-500 text-sm border-b" style="background-color: #F9FAFB; border-color: #e5e7eb;">
                    <th class="py-4">Dokumen Proposal</th>
                    <th class="py-4">Mahasiswa</th>
                    <th class="py-4">Status</th>
                    <th class="py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color: #e5e7eb;">
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded bg-red-50 text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#6B21A8] text-sm">Proposal_Magang_Ahmad.pdf</p>
                                <p class="text-xs text-gray-500">Diupload: 12 Nov 2026</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="font-medium text-sm">Ahmad Fauzi</p>
                        <p class="text-xs text-gray-500">PT. Teknologi Cerdas</p>
                    </td>
                    <td><span class="badge" style="background-color: #fef3c7; border:none; color: #F49E0A;">Menunggu Review</span></td>
                    <td class="text-right">
                        <div class="flex justify-end gap-2">
                            <button class="btn btn-sm btn-ghost text-blue-600 hover:bg-blue-50">Lihat</button>
                            <button class="btn btn-sm border-none text-white hover:bg-opacity-90" style="background-color: #6B21A8;">Setujui</button>
                        </div>
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4">
                        <div class="flex items-start gap-3">
                            <div class="p-2 rounded bg-red-50 text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-[#6B21A8] text-sm">Proposal_Magang_Budi.pdf</p>
                                <p class="text-xs text-gray-500">Diupload: 10 Nov 2026</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="font-medium text-sm">Budi Santoso</p>
                        <p class="text-xs text-gray-500">Dinas Kominfo</p>
                    </td>
                    <td><span class="badge bg-green-100 text-green-700 border-none">Disetujui</span></td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-outline border-gray-300 text-gray-600 hover:bg-gray-50">
                            Cetak Surat.pdf
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
