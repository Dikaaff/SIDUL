@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Halo, Mahasiswa 👋
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Selamat datang di Sistem Informasi Management Magang (SIDUL).</p>
    </div>
    <div class="flex gap-3">
        <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 text-white flex items-center gap-3">
            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
            <span class="text-xs font-medium">Status: Aktif</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <!-- Status Magang -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Status Magang</span>
                <div class="p-2 rounded-lg bg-blue-50 text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="text-xl font-bold text-gray-800">Tahap Pendaftaran</div>
            <p class="text-xs text-blue-600 mt-1 font-medium">Sedang diproses</p>
        </div>
    </div>

    <!-- Progress -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Progress Tahapan</span>
                <div class="p-2 rounded-lg bg-orange-50 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                </div>
            </div>
            <div class="text-xl font-bold text-gray-800">15%</div>
            <progress class="progress progress-warning w-full mt-2" value="15" max="100"></progress>
        </div>
    </div>

    <!-- Notifikasi -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Notifikasi</span>
                <div class="p-2 rounded-lg bg-purple-50 text-purple-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                </div>
            </div>
            <div class="text-xl font-bold text-gray-800">3 Pesan Baru</div>
            <p class="text-xs text-purple-600 mt-1 font-medium italic">Klik untuk melihat detail</p>
        </div>
    </div>

    <!-- Deadline -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-5">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-500">Deadline Terdekat</span>
                <div class="p-2 rounded-lg bg-red-50 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="text-xl font-bold text-gray-800">20 Maret 2026</div>
            <p class="text-xs text-red-600 mt-1 font-medium">Upload Laporan Awal</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Alur Kerja -->
    <div class="lg:col-span-2">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body">
                <h3 class="font-bold text-lg text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                    Alur Kerja Magang
                </h3>
                
                <div class="overflow-x-auto py-4">
                    <ul class="steps steps-vertical lg:steps-horizontal w-full font-medium text-sm">
                        <li class="step step-primary">Pendaftaran</li>
                        <li class="step step-primary">ID Magang</li>
                        <li class="step">Dosen Wali</li>
                        <li class="step">Logbook</li>
                        <li class="step">Laporan</li>
                        <li class="step">Presentasi</li>
                    </ul>
                </div>

                <div class="mt-6 bg-[#6B21A8]/5 p-6 rounded-2xl border border-[#6B21A8]/10">
                    <h4 class="font-bold text-[#6B21A8] mb-2 flex items-center gap-2">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                         Informasi Penting
                    </h4>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Pastikan Anda telah mengisi <strong>Semua Data Perusahaan</strong> pada menu Pengajuan ID Magang sebelum melanjutkan ke tahap Konsultasi Dosen Wali. Selalu periksa notifikasi untuk pembaruan status pengajuan Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Dosen & Quick Links -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    Dosen Wali
                </h3>
                <div class="flex items-center gap-4 mb-4">
                    <div class="avatar placeholder">
                        <div class="bg-primary text-white rounded-full w-12 flex items-center justify-center font-bold">DW</div>
                    </div>
                    <div>
                        <div class="font-bold text-sm text-gray-800">Drs. Ahmad Yani, M.T.</div>
                        <div class="text-xs text-gray-500">NIP. 197503122003121002</div>
                    </div>
                </div>
                <button class="btn btn-sm btn-outline btn-primary w-full">Hubungi Dosen Wali</button>
            </div>
        </div>

        <div class="card bg-gradient-to-br from-[#6B21A8] to-[#9333EA] text-white shadow-lg shadow-purple-200">
            <div class="card-body p-6 relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h3 class="font-bold text-lg mb-1">Panduan Magang</h3>
                <p class="text-white/80 text-xs mb-4">Pelajari aturan dan tata cara pelaksanaan pendaftaran magang terbaru.</p>
                <button class="btn btn-sm bg-[#F49E0A] hover:bg-orange-500 text-white border-none px-6">Buka Panduan</button>
            </div>
        </div>
    </div>
</div>
@endsection
