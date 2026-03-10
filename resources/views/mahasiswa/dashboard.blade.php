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
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column: Alur & Info -->
    <div class="lg:col-span-2 space-y-8">
        <!-- 1. Alur Kerja Magang -->
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-8">
                <h3 class="font-black text-gray-800 text-xl mb-8 flex items-center gap-3">
                    <span class="w-2 h-6 bg-[#6B21A8] rounded-full"></span>
                    Alur Kerja Magang
                </h3>
                
                <div class="overflow-x-auto py-6">
                    <ul class="steps steps-vertical lg:steps-horizontal w-full font-bold text-xs uppercase tracking-widest">
                        <li class="step step-primary" data-content="✓">Pendaftaran</li>
                        <li class="step step-primary" data-content="2">ID Magang</li>
                        <li class="step" data-content="3">Dosen Wali</li>
                        <li class="step" data-content="4">Logbook</li>
                        <li class="step" data-content="5">Laporan</li>
                        <li class="step" data-content="6">Presentasi</li>
                    </ul>
                </div>

                <!-- 4. Informasi Penting -->
                <div class="mt-8 p-6 bg-purple-50 rounded-3xl border border-purple-100 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-white border border-purple-100 flex items-center justify-center text-[#6B21A8] shadow-sm shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-[#6B21A8] text-sm uppercase tracking-wider mb-2">Informasi Penting 💡</h4>
                        <p class="text-xs text-purple-900/70 font-medium leading-relaxed">
                            Pastikan Anda telah mengisi <strong>Semua Data Perusahaan</strong> pada menu Pengajuan ID Magang sebelum melanjutkan ke tahap Konsultasi Dosen Wali. Selalu periksa notifikasi untuk pembaruan status pengajuan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Status & CTA -->
    <div class="space-y-6">
        <!-- 2. Status Magang (Ringkasan Informasi) -->
        <div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-base-100 bg-gray-50/50">
                <h3 class="font-bold text-gray-800 text-sm uppercase tracking-widest">Status Magang</h3>
            </div>
            <div class="card-body p-6 space-y-6">
                <div>
                    <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-2">Perusahaan Magang</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <span class="font-bold text-gray-800">PT Teknologi Nusantara</span>
                    </div>
                </div>

                <div>
                    <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-[0.2em] mb-2">Dosen Pembimbing</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-[#6B21A8]">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <span class="font-bold text-gray-800 text-sm">Dr. Ahmad Rizki</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-[0.2em]">Status</span>
                        <span class="badge badge-success text-white font-black text-[10px] uppercase tracking-widest py-3 px-4">Disetujui</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Card CTA: Panduan Magang -->
        <div class="card bg-gradient-to-br from-[#6B21A8] to-[#9333EA] text-white shadow-xl shadow-purple-100 overflow-hidden">
            <div class="card-body p-8 relative">
                <div class="absolute -right-8 -bottom-8 opacity-20 transform -rotate-12">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                </div>
                <h3 class="text-2xl font-black mb-2 text-white">Panduan Magang</h3>
                <p class="text-white/80 text-xs leading-relaxed font-bold mb-8">Pelajari aturan dan tata cara pelaksanaan pendaftaran magang terbaru.</p>
                <a href="https://drive.google.com/file/d/1RCtyvmpQUfoEAXO7eCargK5EU4uPYG0r/view?usp=sharing" target="_blank" class="btn bg-[#F49E0A] hover:bg-orange-600 text-white border-none shadow-sm px-8 font-black uppercase tracking-widest text-[10px] h-11 min-h-0 inline-flex items-center justify-center">Buka Panduan</a>
            </div>
        </div>
    </div>
</div>
@endsection
