@extends('layouts.app')

@section('title', 'Konsultasi Dosen Wali')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Konsultasi Dosen Wali 👨‍🏫
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Download form dan upload surat rekomendasi magang Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Download Section -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0L8 8m4-4v12" /></svg>
                Download Dokumen
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-primary/30 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-gray-800">Form Survey Perusahaan</div>
                            <div class="text-xs text-gray-500">Format: .pdf (245 KB)</div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-ghost text-primary font-bold">Download</button>
                </div>
                
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-primary/30 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002-2z" /></svg>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-gray-800">Surat Rekomendasi Magang</div>
                            <div class="text-xs text-gray-500">Format: .docx (120 KB)</div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-ghost text-primary font-bold">Download</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Section -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                Upload Surat Rekomendasi
            </h3>
            <p class="text-xs text-gray-500 mb-6">Pastikan file sudah ditandatangani dan dalam format PDF.</p>
            
            <form action="#" class="space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">Form Rekomendasi</span></label>
                        <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
                    </div>
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold">File Surat Rekomendasi</span></label>
                        <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
                    </div>
                </div>
                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none w-full mt-4 shadow-lg shadow-orange-100">Upload Dokumen</button>
            </form>
        </div>
    </div>
</div>
@endsection
