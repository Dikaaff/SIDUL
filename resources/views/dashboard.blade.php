@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Halo, Mahasiswa 👋
        </h2>
        <p class="text-white/80 mt-1">Pantau progres magang dan selesaikan tahapan administrasi Anda.</p>
    </div>
    <div class="flex gap-3">
        <button onclick="document.getElementById('dokumen_modal').showModal()" class="btn border-none hover:bg-opacity-90 bg-[#F49E0A] text-white btn-sm rounded-full px-6 shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
            Upload Laporan
        </button>
        <button onclick="document.getElementById('registration_modal').showModal()" class="btn border-none hover:bg-opacity-90 bg-[#F49E0A] text-white btn-sm rounded-full px-6 shadow-lg shadow-[#F49E0A]/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Pendaftaran Magang
        </button>
    </div>
</div>

<!-- Modal: Upload Laporan -->
<dialog id="dokumen_modal" class="modal">
  <div class="modal-box bg-[#F9FAFB]">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg text-[#6B21A8]">Upload Laporan Magang</h3>
    <p class="py-4 text-gray-700">Pilih file laporan akhir magang Anda untuk diunggah.</p>
    <div class="flex flex-col gap-4 mt-2">
        <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
        <button class="btn bg-[#F49E0A] hover:bg-opacity-90 border-none text-white w-full">Kirim Laporan</button>
    </div>
  </div>
</dialog>

<!-- Modal: New Registration -->
<dialog id="registration_modal" class="modal">
  <div class="modal-box bg-[#F9FAFB] w-11/12 max-w-2xl">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg text-[#6B21A8] mb-4">Form Pendaftaran Magang</h3>
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Instansi</label>
            <input type="text" placeholder="Masukkan nama instansi" class="input input-bordered w-full bg-white text-black" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Magang</label>
            <input type="text" placeholder="e.g. Frontend Developer" class="input input-bordered w-full bg-white text-black" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Proposal Magang</label>
            <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
        </div>
        <div class="flex justify-end gap-2 mt-6">
            <form method="dialog">
                <button class="btn bg-gray-200 text-gray-800 border-none">Batal</button>
            </form>
            <button class="btn bg-[#F49E0A] hover:bg-opacity-90 border-none text-white">Submit Pendaftaran</button>
        </div>
    </div>
  </div>
</dialog>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8 text-black">
    <!-- Stat 1: Pendaftaran -->
    <div class="card bg-white shadow-sm hover:shadow-md transition-shadow" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <div class="text-sm font-medium text-gray-500">Pendaftaran</div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="text-lg font-bold">Diverifikasi</div>
            <div class="text-xs text-green-600 mt-1 flex items-center gap-1">
                Disetujui Operator
            </div>
        </div>
    </div>

    <!-- Stat 2: Dokumen -->
    <div class="card bg-white shadow-sm hover:shadow-md transition-shadow" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <div class="text-sm font-medium text-gray-500">Dokumen</div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="text-lg font-bold">Lengkap</div>
            <div class="text-xs text-green-600 mt-1 flex items-center gap-1">
                Persyaratan Terpenuhi
            </div>
        </div>
    </div>

    <!-- Stat 3: Logbook -->
    <div class="card bg-white shadow-sm hover:shadow-md transition-shadow" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <div class="text-sm font-medium text-gray-500">Logbook</div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fef3c7; color: #F49E0A;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
            </div>
            <div class="text-lg font-bold">5 <span class="text-sm font-normal text-gray-400">/ 8</span></div>
            <progress class="progress w-full mt-2" value="62" max="100" style="color: #F49E0A; --progress-color: #F49E0A; height: 0.4rem;"></progress>
        </div>
    </div>

    <!-- Stat 4: Laporan -->
    <div class="card bg-white shadow-sm hover:shadow-md transition-shadow" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <div class="text-sm font-medium text-gray-500">Laporan Magang</div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-red-50 text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="text-lg font-bold text-red-500">Status Revisi</div>
            <div class="text-xs text-red-500 mt-1 flex items-center gap-1">
                Perlu Perbaikan
            </div>
        </div>
    </div>

    <!-- Stat 5: Surat Akhir -->
    <div class="card bg-white shadow-sm hover:shadow-md transition-shadow" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <div class="text-sm font-medium text-gray-500">Surat Akhir</div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-gray-100 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" /></svg>
                </div>
            </div>
            <div class="text-lg font-bold text-gray-500">Terkunci</div>
            <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                Laporan belum selesai
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 text-black">
    <!-- Main Panel -->
    <div class="lg:col-span-2 space-y-6">
        <div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-lg" style="color: #6B21A8;">Progres Tahapan Magang</h3>
                </div>
                
                <div class="w-full overflow-x-auto pb-4">
                    <ul class="steps steps-horizontal w-full font-medium text-sm min-w-[600px]">
                        <li class="step">Pendaftaran</li>
                        <li class="step">Verifikasi</li>
                        <li class="step">Dokumen Upload</li>
                        <li class="step">Kegiatan Magang</li>
                        <li class="step" data-content="✕">Laporan Revisi</li>
                        <li class="step step-neutral">Surat Akhir</li>
                        <li class="step step-neutral">Selesai</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-bold text-lg" style="color: #6B21A8;">Informasi Instansi Magang</h3>
                    <div class="badge bg-gray-100 text-gray-600 border-none p-3">PT. Teknologi Inovasi Group</div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-[#F9FAFB] p-4 rounded-xl flex items-start gap-4 hover:shadow-sm transition-shadow">
                            <div class="p-2 rounded-lg" style="background-color: #f3e8ff; color: #6B21A8;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Judul Magang</h4>
                                <p class="text-sm font-semibold">Pengembangan Sistem Monitoring Jaringan IoT berbasis Web</p>
                            </div>
                        </div>
                        
                        <div class="bg-[#F9FAFB] p-4 rounded-xl flex items-start gap-4 hover:shadow-sm transition-shadow">
                            <div class="p-2 rounded-lg" style="background-color: #fef3c7; color: #F49E0A;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Alamat Instansi</h4>
                                <p class="text-sm font-semibold">Jl. Jend. Sudirman Kav. 21, Jakarta Selatan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Panel -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
            <div class="card-body p-5">
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <h3 class="font-bold text-base" style="color: #6B21A8;">Dosen Pembimbing</h3>
                    <div class="badge bg-green-100 text-green-700 border-none">Aktif</div>
                </div>
                
                <div class="flex items-center gap-3 mb-4">
                    <div class="avatar placeholder">
                      <div class="rounded-full w-12 text-white flex items-center justify-center font-bold text-lg" style="background-color: #6B21A8;">
                        BS
                      </div>
                    </div>
                    <div>
                        <div class="font-bold text-sm">Dr. Budi Santoso, M.Kom</div>
                        <div class="text-xs text-gray-500 mt-1">NIDN: 0812345678</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-[#F9FAFB] p-3 rounded-xl border border-gray-200">
                        <div class="text-xs text-gray-500 mb-1">Catatan Terakhir (2 Jam yang lalu)</div>
                        <div class="text-sm">
                            Harap perbaiki metodologi di Bab 3, tambahkan referensi jurnal tahun 2023 di laporan.
                        </div>
                    </div>
                    <button class="btn btn-sm text-white border-none w-full hover:bg-opacity-90" style="background-color: #F49E0A;">Balas Pesan / Chat Dosen</button>
                </div>
            </div>
        </div>

        <div class="card shadow-lg" style="background-color: #6B21A8; color: white;">
            <div class="card-body p-6 relative overflow-hidden">
                <div class="absolute -right-6 -top-6 opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h3 class="card-title text-white z-10 font-bold">Buku Panduan Magang</h3>
                <p class="text-white/80 text-sm z-10">Unduh PDF panduan lengkap penyusunan laporan magang.</p>
                <div class="card-actions justify-end mt-4 z-10">
                    <button class="btn btn-sm bg-[#F49E0A] text-white border-none hover:bg-opacity-90">Unduh PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom progress color via inline style injection */
progress::-webkit-progress-value { background-color: #F49E0A; }
progress::-moz-progress-bar { background-color: #F49E0A; }
.step::before, .step::after {
    background-color: #6B21A8 !important;
    color: white !important;
}
.step[data-content="✕"]::before {
    background-color: #F49E0A !important;
}
.step.step-neutral::before, .step.step-neutral::after {
    background-color: #e5e7eb !important;
    color: #6b7280 !important;
}
</style>
@endsection
