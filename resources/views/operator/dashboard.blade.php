@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
            Sistem Administrasi Magang
        </h2>
        <p class="text-base-content/60 mt-1">Kelola pendaftaran, penugasan dosen, dan konversi nilai.</p>
    </div>
    <div class="flex gap-2">
        <button class="btn btn-outline btn-sm rounded-full px-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
            Pengaturan
        </button>
        <button class="btn btn-primary btn-sm rounded-full px-6 shadow-lg shadow-primary/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
            Export Rekapitulasi
        </button>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat 1 -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-base-content/60 text-sm font-medium mb-1">Total Mahasiswa Magang</div>
                    <div class="text-3xl font-bold text-base-content">
                        245
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-base-content/60 text-sm font-medium mb-1">Pendaftaran Baru</div>
                    <div class="text-3xl font-bold text-warning">
                        12
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-warning/10 text-warning flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-base-content/60 text-sm font-medium mb-1">Laporan Selesai</div>
                    <div class="text-3xl font-bold text-base-content">
                        84
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-success/10 text-success flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-base-content/60 text-sm font-medium mb-1">Dosen Aktif</div>
                    <div class="text-3xl font-bold text-base-content">
                        32
                    </div>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Table -->
<div class="card bg-base-100 shadow-sm border border-base-200">
    <div class="p-5 border-b border-base-200 bg-base-100/50">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="tabs tabs-boxed bg-base-200/50 p-1">
                <a class="tab tab-active bg-base-100 shadow-sm font-medium rounded-lg">Menunggu Verifikasi (12)</a>
                <a class="tab font-medium hover:text-base-content">Sedang Berjalan (168)</a>
                <a class="tab font-medium hover:text-base-content">Selesai (84)</a>
            </div>
            
            <div class="flex gap-2">
                <select class="select select-sm select-bordered w-full max-w-xs focus:border-primary">
                    <option disabled selected>Filter Program Studi</option>
                    <option>Informatika</option>
                    <option>Sistem Informasi</option>
                    <option>Teknik Komputer</option>
                </select>
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="text" placeholder="Cari by NIM/Nama..." class="input input-sm input-bordered pl-9 focus:border-primary w-full md:w-48" />
                </div>
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto w-full">
        <table class="table w-full">
            <thead class="bg-base-200/50 text-base-content/70">
                <tr>
                    <th class="py-4">
                        <label>
                            <input type="checkbox" class="checkbox checkbox-sm checkbox-primary" />
                        </label>
                    </th>
                    <th class="font-semibold text-xs py-4">Mahasiswa</th>
                    <th class="font-semibold text-xs py-4">Instansi Tujuan</th>
                    <th class="font-semibold text-xs py-4">Pengajuan</th>
                    <th class="font-semibold text-xs py-4">Status</th>
                    <th class="font-semibold text-xs py-4 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-base-200">
                <!-- row 1 -->
                <tr class="hover:bg-base-200/30 transition-colors">
                    <th>
                        <label>
                            <input type="checkbox" class="checkbox checkbox-sm checkbox-primary" />
                        </label>
                    </th>
                    <td>
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="font-bold">Bintang Naufal</div>
                                <div class="text-xs text-base-content/50">210103045 • Informatika</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="font-medium text-sm">PT. Bukalapak.com</div>
                        <div class="text-[10px] text-base-content/50">Jakarta Selatan</div>
                    </td>
                    <td>
                        <div class="text-sm">08 Mar 2026</div>
                        <div class="text-[10px] text-primary hover:underline cursor-pointer flex items-center gap-1 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                            Lihat Proposal
                        </div>
                    </td>
                    <td>
                        <div class="badge badge-warning gap-1 badge-outline text-xs border-warning text-warning">Pending</div>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-primary">Verifikasi</button>
                    </td>
                </tr>
                
                <!-- row 2 -->
                <tr class="hover:bg-base-200/30 transition-colors">
                    <th>
                        <label>
                            <input type="checkbox" class="checkbox checkbox-sm checkbox-primary" />
                        </label>
                    </th>
                    <td>
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="font-bold">Nabila Putri</div>
                                <div class="text-xs text-base-content/50">210103046 • Sistem Informasi</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="font-medium text-sm">Telkom Indonesia</div>
                        <div class="text-[10px] text-base-content/50">Bandung</div>
                    </td>
                    <td>
                        <div class="text-sm">07 Mar 2026</div>
                        <div class="text-[10px] text-primary hover:underline cursor-pointer flex items-center gap-1 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                            Lihat Proposal
                        </div>
                    </td>
                    <td>
                        <div class="badge badge-error gap-1 badge-outline text-xs">Ditolak</div>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-outline">Detail</button>
                    </td>
                </tr>
                
                <!-- row 3 -->
                <tr class="hover:bg-base-200/30 transition-colors">
                    <th>
                        <label>
                            <input type="checkbox" class="checkbox checkbox-sm checkbox-primary" />
                        </label>
                    </th>
                    <td>
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="font-bold">Dimas Anggara</div>
                                <div class="text-xs text-base-content/50">210103047 • Teknik Komputer</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="font-medium text-sm">PT. Ruangguru</div>
                        <div class="text-[10px] text-base-content/50">Jakarta Pusat</div>
                    </td>
                    <td>
                        <div class="text-sm">06 Mar 2026</div>
                        <div class="text-[10px] text-primary hover:underline cursor-pointer flex items-center gap-1 mt-0.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                            Lihat Proposal
                        </div>
                    </td>
                    <td>
                        <div class="badge badge-success gap-1 badge-outline text-xs font-medium">Verified</div>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-secondary text-secondary-content">Pilih Dosen</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
