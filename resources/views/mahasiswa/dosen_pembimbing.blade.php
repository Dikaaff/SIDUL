@extends('layouts.app')

@section('title', 'Pengajuan Dosen Pembimbing')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Pengajuan Dosen Pembimbing 🎓
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Upload surat diterima magang untuk penetapan Dosen Pembimbing.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Upload Surat Diterima Magang
            </h3>
            
            <form action="#" class="space-y-6">
                <div class="form-control">
                    <label class="label"><span class="label-text font-bold text-gray-700">Pilih File Surat</span></label>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-8 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 hover:border-primary/50 transition-all cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        <p class="text-sm text-gray-500 font-medium">Klik atau drop file surat di sini</p>
                        <p class="text-xs text-gray-400 mt-1">Format: PDF (Max. 2MB)</p>
                        <input type="file" class="hidden" />
                    </div>
                </div>

                <div class="flex items-center gap-2 bg-blue-50 p-4 rounded-xl text-blue-800 border-l-4 border-blue-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-xs italic">Sistem akan memproses penetapan Dosen Pembimbing setelah surat ini divalidasi oleh Operator.</p>
                </div>

                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none w-full shadow-lg shadow-orange-100">Kirim Surat Pengajuan</button>
            </form>
        </div>
    </div>
</div>
@endsection
