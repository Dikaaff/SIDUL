@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Halo, Dr. Budi Santoso 👋
        </h2>
        <p class="text-white/80 mt-1">Kelola proses bimbingan dan pengawasan kegiatan magang mahasiswa Anda.</p>
    </div>
    <div class="flex gap-3">
        <button class="btn border-none hover:bg-opacity-90 bg-[#F49E0A] text-white btn-sm rounded-full px-6 shadow-lg shadow-[#F49E0A]/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Berikan Rekomendasi
        </button>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 text-black">
    <!-- Stat 1: Total Mahasiswa Bimbingan -->
    <a href="#" class="card bg-white shadow-sm hover:shadow-md transition-shadow group cursor-pointer" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1 group-hover:text-[#6B21A8] transition-colors">Mahasiswa Bimbingan</div>
                    <div class="text-3xl font-bold">
                        12 
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: #f3e8ff; color: #6B21A8;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
            <div class="text-xs text-gray-400 mt-4 flex items-center gap-1 group-hover:text-[#6B21A8]">
                Lihat Detail Mahasiswa &rarr;
            </div>
        </div>
    </a>

    <!-- Stat 2: Sedang Magang -->
    <div class="card bg-white shadow-sm transition-shadow" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1">Sedang Magang</div>
                    <div class="text-3xl font-bold text-green-600">
                        8
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                </div>
            </div>
            <div class="text-xs text-gray-400 mt-4 w-full">
                <progress class="progress w-full" value="66" max="100" style="color: #16a34a; --progress-color: #16a34a;"></progress>
                <div class="mt-1 text-right">66% dari total</div>
            </div>
        </div>
    </div>

    <!-- Stat 3: Laporan Pending -->
    <a href="#" class="card bg-white shadow-sm hover:shadow-md transition-shadow group cursor-pointer" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1 group-hover:text-[#F49E0A] transition-colors">Laporan Pending</div>
                    <div class="text-3xl font-bold" style="color: #F49E0A;">
                        5
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background-color: #fef3c7; color: #F49E0A;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
            </div>
            <div class="text-xs mt-4 flex items-center gap-1 font-medium group-hover:text-[#F49E0A]" style="color: #F49E0A;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Perlu Direview Segera
            </div>
        </div>
    </a>

    <!-- Stat 4: Penilaian Selesai -->
    <a href="#" class="card bg-white shadow-sm hover:shadow-md transition-shadow group cursor-pointer" style="border: 1px solid #e5e7eb;">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-gray-500 mb-1 group-hover:text-[#6B21A8] transition-colors">Laporan Dinilai</div>
                    <div class="text-3xl font-bold text-gray-800">
                        3
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-gray-100 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="text-xs text-gray-400 mt-4 flex items-center gap-1 group-hover:text-[#6B21A8]">
                Lanjutkan Penilaian &rarr;
            </div>
        </div>
    </a>
</div>

<div class="card bg-white shadow-sm" style="border: 1px solid #e5e7eb;">
    <div class="p-5 border-b flex flex-col md:flex-row md:items-center justify-between gap-4" style="background-color: #F9FAFB; border-color: #e5e7eb;">
        <div>
            <h3 class="font-bold text-lg" style="color: #6B21A8;">Daftar Mahasiswa Bimbingan Terkini</h3>
            <p class="text-sm text-gray-500 mt-1">Kelola dan pantau seluruh progres magang mahasiswa bimbingan Anda secara detail.</p>
        </div>
        
        <div class="flex items-center gap-2">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input type="text" placeholder="Cari mahasiswa, NIM, dll..." class="input input-sm input-bordered w-full md:w-64 pl-9 bg-white text-black focus:border-[#6B21A8] focus:outline-none" />
            </div>
            <button class="btn btn-sm bg-white border-gray-300 text-gray-700 hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                Filter
            </button>
        </div>
    </div>
    
    <div class="overflow-x-auto w-full text-black">
        <table class="table w-full">
            <!-- head -->
            <thead>
                <tr class="text-gray-500 text-sm border-b" style="border-color: #e5e7eb; background-color: #F9FAFB;">
                    <th class="font-semibold py-4">Mahasiswa</th>
                    <th class="font-semibold py-4">Instansi & Judul Magang</th>
                    <th class="font-semibold py-4">Status Progres</th>
                    <th class="font-semibold py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y" style="border-color: #e5e7eb;">
                <!-- row 1: Menunggu Prasurvey -->
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
                            <span class="text-xs text-gray-500 truncate w-48" title="Pengembangan API Mobile App Terintegrasi">Pengembangan API Mobile...</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="text-xs font-semibold mb-1 w-full text-center py-1 rounded-md" style="background-color: #fef3c7; color: #F49E0A;">
                                Menunggu Persetujuan Prasurvey
                            </div>
                            <progress class="progress w-full" value="25" max="100" style="color: #F49E0A; --progress-color: #F49E0A; height: 0.25rem;"></progress>
                        </div>
                    </td>
                    <th class="text-right">
                        <button class="btn btn-sm btn-ghost hover:bg-[#f3e8ff] hover:text-[#6B21A8] text-gray-500 font-medium">Lihat Detail</button>
                    </th>
                </tr>

                <!-- row 2: Bimbingan Aktif -->
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
                            <span class="text-xs text-gray-500 truncate w-48" title="Analisis Risiko Keamanan Siber pada Transaksi M-Banking">Analisis Risiko Keamanan Sib...</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="text-xs font-semibold mb-1 w-full flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Progres Kegiatan (6/8 Logbook)
                            </div>
                            <progress class="progress w-full text-blue-500" value="75" max="100" style="--progress-color: #3b82f6; height: 0.25rem;"></progress>
                        </div>
                    </td>
                    <th class="text-right">
                        <button class="btn btn-sm btn-ghost hover:bg-[#f3e8ff] hover:text-[#6B21A8] text-gray-500 font-medium">Lihat Detail</button>
                    </th>
                </tr>
                
                <!-- row 3: Menunggu Penilaian -->
                <tr class="hover:bg-gray-50 transition-colors group">
                    <td class="px-4 py-4">
                        <div class="flex items-center gap-3">
                            <div class="avatar placeholder">
                                <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold bg-green-600">
                                    RP
                                </div>
                            </div>
                            <div>
                                <div class="font-bold text-[#6B21A8]">Rizky Pratama</div>
                                <div class="text-xs text-gray-500">210103003 • Informatika</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="text-sm font-medium">Kementerian Kominfo</span>
                            <span class="text-xs text-gray-500 truncate w-48" title="Desain UI/UX Portal Layanan Publik Terpadu">Desain UI/UX Portal La...</span>
                        </div>
                    </td>
                    <td>
                        <div>
                            <div class="text-xs font-semibold mb-1 w-full text-center py-1 rounded-md bg-green-100 text-green-700">
                                Laporan Menunggu Penilaian
                            </div>
                            <progress class="progress w-full text-green-500" value="95" max="100" style="--progress-color: #22c55e; height: 0.25rem;"></progress>
                        </div>
                    </td>
                    <th class="text-right">
                        <button class="btn btn-sm bg-[#F49E0A] hover:bg-opacity-90 border-none text-white whitespace-nowrap">Input Nilai</button>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <div class="p-4 border-t flex flex-col sm:flex-row items-center justify-between text-sm text-gray-600" style="border-color: #e5e7eb; background-color: #F9FAFB;">
        <div>
            Menampilkan <span class="font-medium text-black">1</span> ke <span class="font-medium text-black">3</span> dari <span class="font-medium text-black">12</span> mahasiswa
        </div>
        <div class="join mt-4 sm:mt-0">
            <button class="join-item btn btn-sm bg-white border-gray-300 text-gray-500" disabled>Sebelumnya</button>
            <button class="join-item btn btn-sm border-none text-white" style="background-color: #6B21A8;">1</button>
            <button class="join-item btn btn-sm bg-white border-gray-300 text-gray-700 hover:bg-gray-50">2</button>
            <button class="join-item btn btn-sm bg-white border-gray-300 text-gray-700 hover:bg-gray-50">3</button>
            <button class="join-item btn btn-sm bg-white border-gray-300 text-gray-700 hover:bg-gray-50">Selanjutnya</button>
        </div>
    </div>
</div>

<style>
/* Custom Table overrides for cleaner UI */
.table th {
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
    padding-top: 1rem;
    padding-bottom: 1rem;
}
.table td, .table th {
    border-bottom: none;
}
</style>
@endsection
