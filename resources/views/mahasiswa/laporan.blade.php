@extends('layouts.app')

@section('title', 'Upload Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Upload Laporan Magang 📂
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Upload laporan akhir dan laporan yang sudah ditandatangani.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Final Report -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Laporan Akhir
            </h3>
            <p class="text-xs text-gray-500 mb-6 font-medium italic">File laporan lengkap dalam format PDF.</p>
            
            <form action="#" class="space-y-4">
                <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
                <button type="submit" class="btn btn-primary bg-[#F49E0A] hover:bg-orange-500 border-none text-white w-full shadow-lg shadow-orange-100 mt-2">Upload Laporan Akhir</button>
            </form>
        </div>
    </div>

    <!-- Signed Report -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Laporan Ditandatangani
            </h3>
            <p class="text-xs text-gray-500 mb-6 font-medium italic">Lembar pengesahan yang sudah ditandatangani basah/digital.</p>
            
            <form action="#" class="space-y-4">
                <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
                <button type="submit" class="btn btn-primary bg-[#F49E0A] hover:bg-orange-500 border-none text-white w-full shadow-lg shadow-orange-100 mt-2">Upload Laporan TTD</button>
            </form>
        </div>
    </div>
</div>

<div class="card bg-orange-50 border border-orange-100 mt-6 max-w-4xl mx-auto">
    <div class="card-body p-4 flex flex-row items-center gap-4">
        <div class="p-2 bg-orange-100 rounded-full text-orange-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        </div>
        <div class="text-xs text-orange-800 font-medium">
             Harap periksa kembali isi laporan sebelum mengunggah. Laporan yang sudah diunggah akan masuk ke tahap review Dosen Pembimbing untuk mendapatkan persetujuan akhir.
        </div>
    </div>
</div>
@endsection
