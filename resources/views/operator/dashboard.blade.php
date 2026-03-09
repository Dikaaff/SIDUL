@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-8 rounded-3xl shadow-xl mt-2 relative overflow-hidden">
    <!-- Abstract pattern -->
    <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -mr-32 -mt-32"></div>
    
    <div class="relative z-10">
        <div class="flex items-center gap-3 mb-2">
            <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-extrabold rounded-full uppercase tracking-widest border border-white/30">System Administrator</span>
        </div>
        <h2 class="text-3xl font-extrabold text-white tracking-tight">
            Dashboard Operator 🚀
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base font-medium">Selamat datang, Admin. Berikut adalah ringkasan sistem magang hari ini.</p>
    </div>
    <div class="flex gap-3 relative z-10">
        <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20 text-white flex items-center gap-4">
            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
            <span class="text-xs font-bold tracking-widest uppercase">{{ now()->format('l, d F Y') }}</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat 1: Antrean Verifikasi -->
    <div class="card bg-white shadow-sm border border-base-200 hover:shadow-md transition-all">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Antrean Verifikasi</p>
                    <h3 class="text-3xl font-black text-gray-800 tracking-tight">12</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-orange-600 px-2 py-0.5 bg-orange-50 rounded-lg">+4 baru hari ini</span>
            </div>
        </div>
    </div>

    <!-- Stat 2: ID Magang -->
    <div class="card bg-white shadow-sm border border-base-200 hover:shadow-md transition-all">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Pengajuan ID Magang</p>
                    <h3 class="text-3xl font-black text-gray-800 tracking-tight">45</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-blue-600 px-2 py-0.5 bg-blue-50 rounded-lg">85% Disetujui</span>
            </div>
        </div>
    </div>

    <!-- Stat 3: Mahasiswa Aktif -->
    <div class="card bg-white shadow-sm border border-base-200 hover:shadow-md transition-all">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Mahasiswa Aktif</p>
                    <h3 class="text-3xl font-black text-gray-800 tracking-tight">128</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-green-600 px-2 py-0.5 bg-green-50 rounded-lg">Tersebar di 24 Kota</span>
            </div>
        </div>
    </div>

    <!-- Stat 4: Laporan Masuk -->
    <div class="card bg-[#6B21A8] shadow-sm border border-none shadow-purple-200">
        <div class="card-body p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-extrabold text-white/60 uppercase tracking-widest mb-1 text-white">Laporan Selesai</p>
                    <h3 class="text-3xl font-black text-white tracking-tight">56</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-white/20 text-white flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2">
                <span class="text-[10px] font-bold text-white px-2 py-0.5 bg-white/10 rounded-lg">Siap Diarsipkan</span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Actions / Latest Tasks -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Section: Pengajuan Mendesak -->
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="px-8 py-6 border-b border-base-100 flex items-center justify-between bg-gray-50/30">
                <h3 class="text-lg font-extrabold text-gray-800 flex items-center gap-3">
                    <span class="w-2 h-6 bg-[#6B21A8] rounded-full"></span>
                    Antrean Verifikasi Terbaru
                </h3>
                <a href="/operator/verifikasi" class="text-xs font-bold text-[#6B21A8] hover:underline uppercase tracking-widest">Detail</a>
            </div>
            <div class="p-4 space-y-4">
                <!-- Task 1 -->
                <div class="flex items-center justify-between p-5 rounded-2xl bg-gray-50 border border-gray-100 items-center hover:bg-white hover:shadow-md transition-all cursor-pointer group">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-[#6B21A8] font-black tracking-tighter group-hover:bg-[#6B21A8] group-hover:text-white transition-colors uppercase">SA</div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-[#6B21A8] transition-colors">Siti Aminah</h4>
                            <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-widest">210401089 • Surat Diterima</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                         <span class="text-[10px] font-bold text-gray-400 italic">2 Jam lalu</span>
                         <button class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 border-none text-white px-4 rounded-xl shadow-sm text-[10px] font-bold uppercase tracking-widest">Periksa</button>
                    </div>
                </div>

                <!-- Task 2 -->
                <div class="flex items-center justify-between p-5 rounded-2xl bg-gray-50 border border-gray-100 items-center hover:bg-white hover:shadow-md transition-all cursor-pointer group">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-white border border-gray-100 shadow-sm flex items-center justify-center text-[#6B21A8] font-black tracking-tighter group-hover:bg-[#6B21A8] group-hover:text-white transition-colors uppercase">BR</div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-[#6B21A8] transition-colors">Budi Ramadhan</h4>
                            <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase tracking-widest">210401045 • Pra Survey</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                         <span class="text-[10px] font-bold text-gray-400 italic">5 Jam lalu</span>
                         <button class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 border-none text-white px-4 rounded-xl shadow-sm text-[10px] font-bold uppercase tracking-widest">Periksa</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Monitoring Ringkas -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card bg-white shadow-sm border border-base-200">
                <div class="card-body p-6">
                    <h4 class="font-bold text-gray-800 mb-4 text-xs uppercase tracking-[0.2em] flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        Penetapan Dosen Pembimbing
                    </h4>
                    <p class="text-xs text-gray-500 leading-relaxed mb-6 font-medium">Terdapat <span class="text-[#6B21A8] font-extrabold text-sm mx-1">8</span> mahasiswa yang baru divalidasi dan memerlukan penugasan Dosen Pembimbing.</p>
                    <a href="/operator/dosen-pembimbing" class="btn btn-sm btn-outline border-[#6B21A8] text-[#6B21A8] hover:bg-[#6B21A8] hover:border-none w-full font-bold uppercase tracking-widest text-[10px] h-10 min-h-0">Kelola Penugasan</a>
                </div>
            </div>

            <div class="card bg-white shadow-sm border border-base-200">
                <div class="card-body p-6">
                    <h4 class="font-bold text-gray-800 mb-4 text-xs uppercase tracking-[0.2em] flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Surat Pengantar
                    </h4>
                    <p class="text-xs text-gray-500 leading-relaxed mb-6 font-medium">Sistem telah menyiapkan <span class="text-orange-600 font-extrabold text-sm mx-1">15</span> draf surat pengantar internasional/nasional untuk digenerate.</p>
                    <a href="/operator/surat-pengantar" class="btn btn-sm bg-[#F49E0A] hover:bg-orange-600 border-none text-white w-full font-bold uppercase tracking-widest text-[10px] h-10 min-h-0">Generate Semua</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Items -->
    <div class="space-y-6">
        <!-- Quick Stats / Goals -->
        <div class="card bg-gray-50 border border-gray-100">
            <div class="card-body p-8">
                <h4 class="font-extrabold text-gray-400 text-[10px] uppercase tracking-[0.2em] mb-6">Status Progres Magang (Smt Ganjil)</h4>
                <div class="space-y-6">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-600 tracking-tight">Persiapan & Verifikasi</span>
                            <span class="text-xs font-extrabold text-gray-800 tracking-tight">82%</span>
                        </div>
                        <progress class="progress progress-primary w-full h-1.5" value="82" max="100"></progress>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-600 tracking-tight">Aktif Magang</span>
                            <span class="text-xs font-extrabold text-gray-800 tracking-tight">45%</span>
                        </div>
                        <progress class="progress progress-warning w-full h-1.5" value="45" max="100"></progress>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-gray-600 tracking-tight">Laporan & Penilaian</span>
                            <span class="text-xs font-extrabold text-gray-800 tracking-tight">12%</span>
                        </div>
                        <progress class="progress progress-success w-full h-1.5" value="12" max="100"></progress>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <button class="btn btn-sm btn-ghost w-full text-gray-400 font-bold uppercase text-[10px] tracking-widest hover:text-[#6B21A8]">Lihat Laporan Lengkap</button>
                </div>
            </div>
        </div>

        <!-- Help / Admin Guide -->
        <div class="card bg-purple-50 border border-purple-100">
            <div class="card-body p-6">
                <h4 class="font-bold text-[#6B21A8] text-sm flex items-center gap-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    Panduan Operator
                </h4>
                <p class="text-xs text-purple-900/60 leading-relaxed font-medium">Gunakan fitur <span class="font-black">Arsip</span> untuk mengekspor data magang mahasiswa ke format Excel/PDF sebagai lampiran borang akreditasi.</p>
            </div>
        </div>
    </div>
</div>
@endsection
