@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10 hidden sm:flex lg:flex">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">
                Halo, Bapak/Ibu {{ explode(' ', Auth::user()->name)[0] }} 👋
            </h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Selamat datang di SIDUL. Pantau progres magang dan pengajuan mahasiswa perwalian Anda hari ini.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">{{ now()->format('d M Y') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Mobile Header -->
    <div class="flex flex-col justify-between gap-4 relative z-10 sm:hidden">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black">Halo, {{ explode(' ', Auth::user()->name)[0] }} 👋</h2>
            <div class="bg-white/10 backdrop-blur-md px-3 py-1.5 rounded-xl border border-white/20 text-white flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>
                <span class="text-[10px] font-bold uppercase tracking-wider">Aktif</span>
            </div>
        </div>
        <p class="text-white/90 font-medium text-sm leading-relaxed">Pantau progres magang mahasiswa.</p>
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
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Anak Wali</p>
                    <h3 class="text-4xl font-black text-[#6B21A8]">{{ $mhsWaliCount }}</h3>
                </div>
                <div class="p-3 rounded-2xl bg-purple-50 text-[#6B21A8]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat: Pengajuan Pending -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pengajuan Wali Pending</p>
                    <h3 class="text-4xl font-black text-[#F49E0A]">{{ $pendingRekomendasiCount }}</h3>
                </div>
                <div class="p-3 rounded-2xl bg-orange-50 text-[#F49E0A]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Stat: Progress Rata-rata -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Anak Bimbingan Selesai</p>
                    <h3 class="text-4xl font-black text-green-600">{{ $lulusCount }} / {{ $mhsBimbinganCount }}</h3>
                </div>
                <div class="p-3 rounded-2xl bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="space-y-6">
    <!-- Header Bimbingan -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white p-6 rounded-[2rem] border border-base-200 shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8] shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
            </div>
            <h3 class="text-xl font-black text-gray-900 tracking-tight">Daftar Mahasiswa Magang</h3>
        </div>
        <div class="flex items-center gap-3">
            <div class="join shadow-sm border border-gray-100 rounded-2xl overflow-hidden">
                <input class="input input-bordered join-item bg-gray-50 border-none text-xs font-semibold w-48 lg:w-64 focus:bg-white transition-all" placeholder="Cari nama atau NIM..." />
                <button class="btn join-item bg-white border-none hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
            <select class="select select-bordered rounded-2xl bg-white border-gray-100 text-xs font-bold uppercase tracking-wider">
                <option disabled selected>Semua Status</option>
                <option>Aktif Magang</option>
                <option>Tahap Pendaftaran</option>
                <option>Selesai</option>
            </select>
        </div>
    </div>

    <!-- Minimalistic List Header -->
    <div class="px-8 grid grid-cols-12 gap-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">
        <div class="col-span-4 lg:col-span-4">Mahasiswa</div>
        <div class="col-span-4 lg:col-span-4">Instansi Magang</div>
        <div class="col-span-3 lg:col-span-3">Status & Progress</div>
        <div class="col-span-1 lg:col-span-1 text-right">Detail</div>
    </div>

    <!-- Student List -->
    <div class="space-y-4">
        @forelse($mhsBimbinganList as $magang)
        <div class="bg-white hover:bg-gray-50/50 border border-base-200 rounded-[2rem] p-6 transition-all group shadow-sm grid grid-cols-12 gap-4 items-center">
            <div class="col-span-4 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-purple-50 text-[#6B21A8] flex items-center justify-center font-black text-lg group-hover:rotate-3 transition-transform">
                    {{ substr($magang->peserta->first()->mahasiswa->nama ?? 'M', 0, 2) }}
                </div>
                <div>
                    <h4 class="font-black text-gray-900 text-lg leading-tight tracking-tight">{{ $magang->peserta->first()->mahasiswa->nama ?? 'Mahasiswa' }}</h4>
                    <p class="text-[11px] text-gray-400 font-bold tracking-wide mt-1">{{ $magang->nim }} • {{ $magang->konsentrasi }}</p>
                </div>
            </div>
            
            <div class="col-span-4">
                <h5 class="font-black text-gray-800 text-sm tracking-tight">{{ $magang->perusahaan }}</h5>
                <p class="text-[10px] text-gray-400 font-bold tracking-wide mt-1">{{ $magang->tipe_magang }}</p>
            </div>

            <div class="col-span-3">
                @php
                    $targetLogbooks = 30; // Target hari magang
                    $progress = $magang->status_magang === 'Selesai' ? 100 : min(100, round(($magang->logbooks_count / $targetLogbooks) * 100));
                @endphp
                <div class="flex items-center justify-between mb-2">
                    <div class="badge {{ $magang->status_magang === 'Selesai' ? 'bg-purple-50 text-[#6B21A8] border-purple-100' : ($magang->status_magang === 'Pending' ? 'bg-orange-50 text-[#F49E0A] border-orange-100' : 'bg-green-50 text-green-600 border-green-100') }} font-black text-[8px] px-3 py-3 uppercase tracking-widest rounded-lg italic border-2">
                        {{ strtoupper($magang->status_magang) }}
                    </div>
                    <span class="text-xs font-black italic text-gray-800">{{ $progress }}%</span>
                </div>
                <progress class="progress [&::-webkit-progress-value]:bg-[#6B21A8] w-full h-[0.4rem] bg-gray-100 [&::-webkit-progress-value]:transition-all [&::-webkit-progress-value]:duration-500 rounded-full" value="{{ $progress }}" max="100"></progress>
            </div>

            <div class="col-span-1 flex justify-end">
                <button onclick="showStudentDetail('{{ $magang->peserta->first()->mahasiswa->nama ?? '' }}', '{{ $magang->nim }}', '{{ $magang->perusahaan }}', {{ $progress }}, '{{ $magang->konsentrasi }}', '{{ $magang->status_magang }}')" class="w-10 h-10 rounded-full flex items-center justify-center text-gray-300 hover:text-[#6B21A8] hover:bg-purple-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </button>
            </div>
        </div>
        @empty
        <div class="bg-gray-50 rounded-[2rem] p-8 text-center text-gray-400 border border-gray-100 border-dashed">
            <h4 class="font-black text-lg">Belum Ada Mahasiswa Bimbingan</h4>
            <p class="text-sm mt-1">Saat ini Anda tidak membimbing mahasiswa magang satupun.</p>
        </div>
        @endforelse
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
        <div id="notificationList" class="p-4 space-y-4">
            {{-- Notifikasi Rekomendasi pending --}}
            @if($pendingRekomendasiCount > 0)
            <div id="notif-1" class="relative group flex gap-4 p-4 rounded-2xl bg-orange-50/50 border border-orange-100 hover:shadow-md transition-all cursor-pointer" onclick="window.location.href='{{ route('dosen.rekomendasi') }}'">
                <div class="w-10 h-10 rounded-xl bg-white border border-orange-100 flex items-center justify-center text-[#F49E0A] shadow-sm shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-extrabold text-[#F49E0A] uppercase tracking-wider">Perlu Rekomendasi</span>
                        <span class="text-[10px] text-gray-400">Baru</span>
                    </div>
                    <p class="text-sm font-bold text-gray-800 group-hover:text-[#F49E0A] transition-colors">Terdapat {{ $pendingRekomendasiCount }} mahasiswa menunggu rekomendasi Wali.</p>
                </div>
            </div>
            @endif

            {{-- Notifikasi Laporan pending review --}}
            @php 
                $pendingLaporanCount = $mhsBimbinganList->filter(fn($m) => $m->laporan && $m->laporan->status_laporan === 'Pending')->count();
            @endphp
            @if($pendingLaporanCount > 0)
            <div id="notif-2" class="relative group flex gap-4 p-4 rounded-2xl bg-purple-50/50 border border-purple-100 hover:shadow-md transition-all cursor-pointer" onclick="window.location.href='{{ route('dosen.laporan') }}'">
                <div class="w-10 h-10 rounded-xl bg-white border border-purple-100 flex items-center justify-center text-[#6B21A8] shadow-sm shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-extrabold text-[#6B21A8] uppercase tracking-wider">Review Laporan</span>
                        <span class="text-[10px] text-gray-400">Penting</span>
                    </div>
                    <p class="text-sm font-bold text-gray-800 group-hover:text-[#6B21A8] transition-colors">{{ $pendingLaporanCount }} laporan mahasiswa bimbingan menunggu review.</p>
                </div>
            </div>
            @endif

            @if($pendingRekomendasiCount == 0 && $pendingLaporanCount == 0)
            <div class="p-8 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">Semua pekerjaan sudah selesai ✨</p>
            </div>
            @endif
        </div>
        <div id="clearNotifAction" class="p-4 border-t border-base-100 bg-gray-50/30 text-center">
            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest italic">Terakhir diperbarui: {{ now()->format('H:i') }} WIB</p>
        </div>
    </div>
</div>

<!-- Modal Detail Mahasiswa -->
<dialog id="student_detail_modal" class="modal">
    <div class="modal-box bg-white max-w-2xl rounded-[2.5rem] p-0 overflow-hidden">
        <div class="bg-[#6B21A8] p-8 pb-12 relative">
            <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-white hover:bg-white/10">✕</button>
            <div class="flex items-center gap-6">
                <div id="modal_avatar" class="w-20 h-20 rounded-3xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-3xl font-black text-white shadow-xl">
                    AS
                </div>
                <div class="text-white">
                    <h3 id="modal_name" class="text-2xl font-black tracking-tight italic">Andi Saputra</h3>
                    <p id="modal_nim" class="text-white/70 font-bold tracking-[0.2em] text-xs uppercase mt-1">210401001 • TEKNIK INFORMATIKA</p>
                </div>
            </div>
        </div>
        
        <div class="p-8 -mt-6 bg-white rounded-[2.5rem] relative">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Perusahaan</p>
                        <p id="modal_company" class="font-bold text-gray-800 italic">PT. Teknologi Maju Persada</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Bidang Usaha</p>
                        <p id="modal_field" class="font-bold text-gray-700 text-sm">Software Development</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Magang</p>
                        <span id="modal_status" class="badge badge-success badge-outline font-black text-[9px] uppercase tracking-widest px-3 py-3 border-2">Aktif Magang</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Progress</p>
                        <div class="flex items-center gap-3">
                            <span id="modal_progress_text" class="text-xl font-black text-gray-800">85%</span>
                            <progress id="modal_progress_bar" class="progress progress-primary h-2 flex-1" value="85" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-100 flex gap-3">
                <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-ghost flex-1 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl">Tutup</button>
            </div>
        </div>
    </div>
</dialog>

<script>
function showStudentDetail(name, nim, company, progress, field, status) {
    document.getElementById('modal_name').innerText = name;
    document.getElementById('modal_company').innerText = company;
    document.getElementById('modal_progress_text').innerText = progress + '%';
    document.getElementById('modal_progress_bar').value = progress;
    document.getElementById('modal_avatar').innerText = name.split(' ').map(n => n[0]).join('').toUpperCase();

    document.getElementById('student_detail_modal').showModal();
}
</script>
@endsection
