@extends('layouts.app')

@section('title', 'Review Logbook Mahasiswa')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Review Logbook 📖
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Baca aktivitas harian mahasiswa bimbingan dan berikan komentar atau arahan.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Student List Sidebar -->
    <div class="lg:col-span-1 space-y-4">
        <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2 px-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            Mahasiswa
        </h3>
        
        <div class="space-y-2">
            <!-- Active Student -->
            <div class="p-4 rounded-2xl bg-white border-2 border-[#6B21A8] shadow-sm cursor-pointer group transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#6B21A8] text-white flex items-center justify-center font-bold shadow-lg shadow-purple-100">AS</div>
                    <div>
                        <div class="text-sm font-bold text-gray-800">Andi Saputra</div>
                        <div class="text-[10px] font-bold text-[#6B21A8] uppercase tracking-wider">Aktif</div>
                    </div>
                </div>
            </div>

            <!-- Inactive Students -->
            <div class="p-4 rounded-2xl bg-white border border-transparent hover:border-gray-200 hover:bg-gray-50 cursor-pointer transition-all">
                <div class="flex items-center gap-3 opacity-60 grayscale group-hover:opacity-100 group-hover:grayscale-0 transition-all">
                    <div class="w-10 h-10 rounded-xl bg-gray-200 text-gray-500 flex items-center justify-center font-bold">BR</div>
                    <div>
                        <div class="text-sm font-bold text-gray-800">Budi Ramadhan</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Aktif</div>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-2xl bg-white border border-transparent hover:border-gray-200 hover:bg-gray-50 cursor-pointer transition-all">
                <div class="flex items-center gap-3 opacity-60 grayscale group-hover:opacity-100 group-hover:grayscale-0 transition-all">
                    <div class="w-10 h-10 rounded-xl bg-gray-200 text-gray-500 flex items-center justify-center font-bold">SM</div>
                    <div>
                        <div class="text-sm font-bold text-gray-800">Siti Maryam</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Aktif</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logbook Timeline -->
    <div class="lg:col-span-3 space-y-6">
        <div class="flex items-center justify-between mb-2">
            <h3 class="text-lg font-bold text-gray-800">Logbook: Andi Saputra</h3>
            <div class="join shadow-sm border border-base-200">
                <button class="btn btn-sm join-item bg-white border-none text-[#6B21A8] font-bold">Minggu Ini</button>
                <button class="btn btn-sm join-item bg-gray-50 border-none text-gray-400 font-bold">Semua</button>
            </div>
        </div>

        <!-- Entry 1 -->
        <div class="card bg-white shadow-sm border border-base-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-[#6B21A8]"></div>
            <div class="card-body p-6 md:p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                         <span class="text-[10px] font-extrabold text-[#6B21A8] uppercase tracking-[0.2em] bg-purple-50 px-3 py-1 rounded-full border border-purple-100">09 Maret 2026</span>
                         <h4 class="text-xl font-extrabold text-gray-800 mt-3 tracking-tight">Pengembangan Fitur Dashboad Admin</h4>
                    </div>
                    <div class="flex items-center gap-2 bg-green-50 text-green-600 px-4 py-2 rounded-xl border border-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <span class="text-[10px] font-bold tracking-widest uppercase">Terselesaikan</span>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#6B21A8]"></span> Aktivitas
                        </p>
                        <p class="text-gray-700 leading-relaxed text-sm">Melanjutkan pengerjaan modul dashboard admin menggunakan Laravel dan Tailwind CSS. Fokus pada integrasi Chart.js untuk menampilkan data statistik magang secara real-time.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-orange-50 border border-orange-100 rounded-2xl">
                             <p class="text-[10px] font-extrabold text-orange-600 uppercase tracking-widest mb-1 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                Kendala
                             </p>
                             <p class="text-xs text-orange-800 font-medium italic">Responsivitas grafik pada layar perangkat mobile (layar di bawah 640px).</p>
                        </div>
                        <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl">
                             <p class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest mb-1 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                Pekerjaan
                             </p>
                             <p class="text-xs text-blue-800 font-medium">Coding Frontend, API Integration.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col md:flex-row gap-6">
                    <div class="flex-1">
                        <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-3 flex items-center gap-2">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                             Beri Komentar / Arahan
                        </label>
                        <div class="flex gap-2">
                            <input type="text" placeholder="Tulis masukan Anda di sini..." class="input input-bordered flex-1 bg-white text-gray-800 text-sm focus:border-[#6B21A8]" />
                            <button class="btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none shadow-sm px-6">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
