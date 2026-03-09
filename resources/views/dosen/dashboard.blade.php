@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Dashboard Dosen 👋
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Halo, Bapak/Ibu Dosen. Pantau progres magang mahasiswa Anda hari ini.</p>
    </div>
    <div class="flex gap-3">
        <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 text-white flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-xs font-medium">{{ now()->format('d M Y') }}</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat: Total Mahasiswa -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Mahasiswa Bimbingan</p>
                    <h3 class="text-3xl font-extrabold text-gray-800">24</h3>
                </div>
                <div class="p-3 rounded-2xl bg-purple-50 text-[#6B21A8]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-lg w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                <span>3 Mahasiswa baru</span>
            </div>
        </div>
    </div>

    <!-- Stat: Pengajuan Pending -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pengajuan Pending</p>
                    <h3 class="text-3xl font-extrabold text-gray-800">8</h3>
                </div>
                <div class="p-3 rounded-2xl bg-orange-50 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs font-medium text-orange-600 bg-orange-50 px-2 py-1 rounded-lg w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Butuh review segera</span>
            </div>
        </div>
    </div>

    <!-- Stat: Progress Rata-rata -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Lulus Magang</p>
                    <h3 class="text-3xl font-extrabold text-gray-800">12</h3>
                </div>
                <div class="p-3 rounded-2xl bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <progress class="progress progress-primary w-full h-2" value="65" max="100"></progress>
                <p class="text-[10px] text-gray-400 mt-1 font-medium">65% Target Semester Ini Terpenuhi</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Section: Daftar Mahasiswa Bimbingan -->
    <div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-base-100 flex items-center justify-between bg-gray-50/50">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Mahasiswa Bimbingan Terbaru
            </h3>
            <a href="/dosen/monitoring" class="text-xs font-bold text-[#6B21A8] hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr class="text-gray-400 uppercase text-[10px] tracking-wider">
                        <th>Mahasiswa</th>
                        <th>Perusahaan</th>
                        <th>Progress</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-gray-100 text-gray-500 rounded-lg w-10">AS</div>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">Andi Saputra</div>
                                    <div class="text-[10px] text-gray-400">210401001</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm font-medium text-gray-600">PT. Tech Solutions</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold">75%</span>
                                <progress class="progress progress-success w-16 h-1.5" value="75" max="100"></progress>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-xs text-[#6B21A8] font-bold">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-gray-100 text-gray-500 rounded-lg w-10">BR</div>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">Budi Ramadhan</div>
                                    <div class="text-[10px] text-gray-400">210401045</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm font-medium text-gray-600">Bank Mandiri</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold">30%</span>
                                <progress class="progress progress-warning w-16 h-1.5" value="30" max="100"></progress>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-ghost btn-xs text-[#6B21A8] font-bold">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section: Notifikasi Pengajuan -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="px-6 py-5 border-b border-base-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                Notifikasi Pengajuan
            </h3>
        </div>
        <div class="p-4 space-y-4">
            <!-- Notif 1 -->
            <div class="flex gap-4 p-4 rounded-2xl bg-purple-50/50 border border-purple-100 hover:shadow-md transition-all cursor-pointer group">
                <div class="w-10 h-10 rounded-xl bg-white border border-purple-100 flex items-center justify-center text-[#6B21A8] shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-extrabold text-[#6B21A8] uppercase tracking-wider">Rekomendasi</span>
                        <span class="text-[10px] text-gray-400">10 Menit lalu</span>
                    </div>
                    <p class="text-sm font-bold text-gray-800 group-hover:text-[#6B21A8] transition-colors">Siti Aminah mengajukan Rekomendasi Magang</p>
                    <p class="text-xs text-gray-500 mt-1">NIM: 210401089 • Dosen Wali</p>
                </div>
            </div>

            <!-- Notif 2 -->
            <div class="flex gap-4 p-4 rounded-2xl bg-orange-50/50 border border-orange-100 hover:shadow-md transition-all cursor-pointer group">
                <div class="w-10 h-10 rounded-xl bg-white border border-orange-100 flex items-center justify-center text-orange-600 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-extrabold text-orange-600 uppercase tracking-wider">Laporan</span>
                        <span class="text-[10px] text-gray-400">2 Jam lalu</span>
                    </div>
                    <p class="text-sm font-bold text-gray-800 group-hover:text-orange-600 transition-colors">Andi Saputra mengunggah Draft Laporan</p>
                    <p class="text-xs text-gray-500 mt-1">NIM: 210401001 • Pembimbing</p>
                </div>
            </div>
        </div>
        <div class="p-4 border-t border-base-100 bg-gray-50/30 text-center">
            <button class="btn btn-sm btn-ghost text-gray-400 font-bold uppercase text-[10px] tracking-[0.1em]">Bersihkan Semua</button>
        </div>
    </div>
</div>
@endsection
