@extends('layouts.app')

@section('title', 'Dashboard Dosen - SIDUL')

@section('header')
<x-page-header 
    title="Halo, {{ Auth::user()->display_name }} 👋" 
    subtitle="Selamat datang di pusat kendali pembimbing magang SIDUL. Pantau bimbingan dan laporan Anda di sini."
>
    <div class="hidden lg:flex items-center gap-4 bg-white/5 backdrop-blur-xl p-4 rounded-2xl border border-white/10 shadow-2xl">
        <div class="text-right">
            <p class="text-[9px] font-black uppercase tracking-[0.2em] text-white/40 mb-1">Status Sesi</p>
            <p class="text-sm font-black italic">{{ now()->format('d M Y') }}</p>
        </div>
        <div class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center border border-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
        </div>
    </div>
</x-page-header>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/dosen" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Dashboard</li>
  </ul>
</div>
@endsection

@section('content')
<div class="px-2 space-y-10 pb-20">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <x-stat-card value="{{ $mhsWaliCount }}" label="Total Anak Wali" color="purple">
            <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></x-slot>
        </x-stat-card>

        <x-stat-card value="{{ $pendingRekomendasiCount }}" label="Pending Rekomendasi" color="amber">
            <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></x-slot>
        </x-stat-card>

        <x-stat-card value="{{ $lulusCount }}/{{ $mhsBimbinganCount }}" label="Anak Bimbingan Lulus" color="green">
            <x-slot name="icon"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></x-slot>
        </x-stat-card>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Main Content: Student List -->
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between mb-2 px-2">
                <div>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tighter italic">Progres Aktivitas Terbaru</h3>
                    <p class="text-[10px] font-medium text-gray-400 mt-0.5">Menampilkan 5 aktivitas aktif</p>
                </div>
                <a href="{{ route('dosen.monitoring') }}" class="text-[10px] font-black uppercase tracking-widest text-[#6B21A8] hover:underline italic">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto custom-scrollbar rounded-2xl border border-gray-100 shadow-sm">
                <table class="table w-full">
                    <thead>
                        <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                            <th class="pl-8 py-5 w-16">No</th>
                            <th class="min-w-[200px]">Mahasiswa</th>
                            <th class="min-w-[140px]">Konsentrasi</th>
                            <th class="min-w-[160px]">Progress</th>
                            <th class="pr-8 text-right w-20">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($mhsBimbinganList as $index => $magang)
                        @php
                            $progress = 0;
                            if($magang) $progress += 20;
                            if($magang->logbooks_count > 0) $progress += 40;
                            if($magang->laporan) {
                                if($magang->laporan->status === 'approved') {
                                    $progress += 40;
                                } else {
                                    $progress += 10;
                                }
                            }
                            if($magang->status_magang === 'Selesai') $progress = 100;

                            $barColor = match(true) {
                                $progress <= 20 => 'bg-[#F49E0A]',
                                $progress <= 60 => 'bg-blue-500',
                                default => 'bg-[#6B21A8]',
                            };

                            $nameParts = explode(' ', $magang->peserta->first()->mahasiswa->nama ?? 'Mahasiswa');
                            $initials = count($nameParts) > 1
                                ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                                : strtoupper(substr($nameParts[0], 0, 2));
                        @endphp
                        <tr class="hover:bg-gray-50 transition-all group">
                            <td class="pl-8 py-5 text-[10px] font-medium text-gray-400">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[8px] shadow-inner group-hover:rotate-3 transition-transform shrink-0">{{ $initials }}</div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-semibold text-gray-800 text-sm tracking-tight leading-tight truncate">{{ $magang->peserta->first()->mahasiswa->nama ?? 'Mahasiswa' }}</span>
                                        <span class="text-[10px] font-medium text-gray-400 tracking-widest uppercase">{{ $magang->peserta->first()?->mahasiswa->nim }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-[10px] font-semibold text-[#6B21A8] uppercase tracking-widest">{{ $magang->konsentrasi }}</span>
                            </td>
                            <td>
                                <div class="flex items-center gap-3 max-w-[140px]">
                                    <div class="flex-1 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                        <div class="h-full {{ $barColor }} rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <span class="text-[10px] font-black text-gray-800 italic whitespace-nowrap">{{ $progress }}%</span>
                                </div>
                            </td>
                            <td class="pr-8 text-right">
                                <x-button variant="ghost" size="sm" aria-label="Lihat detail mahasiswa" onclick="showStudentDetail('{{ addslashes($magang->peserta->first()->mahasiswa->nama ?? '') }}', '{{ $magang->peserta->first()?->mahasiswa->nim }}', '{{ addslashes($magang->perusahaan) }}', {{ $progress }}, '{{ $magang->konsentrasi }}', '{{ $magang->status_magang }}')" class="!w-9 !h-9 !p-0 text-gray-300 hover:!text-[#6B21A8] hover:!bg-purple-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </x-button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Belum ada bimbingan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar: Notifications & Actions -->
        <div class="lg:col-span-4 space-y-10">
            <div class="space-y-6">
                <h3 class="text-2xl font-black text-gray-800 tracking-tighter italic px-2">Aktivitas Penting 🔔</h3>
                
                <div class="space-y-4">
                    @if($pendingRekomendasiCount > 0)
                    <x-card padding="none" class="p-6 group relative border-orange-100 !shadow-2xl !shadow-orange-100/20 hover:scale-[1.03] transition-all cursor-pointer" border onclick="window.location.href='{{ route('dosen.rekomendasi') }}'">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#F49E0A] flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-[#F49E0A] uppercase tracking-widest italic">Rekomendasi Wali</span>
                                <p class="text-sm font-black text-gray-800 mt-1 italic leading-snug">{{ $pendingRekomendasiCount }} Mahasiswa Menunggu</p>
                            </div>
                        </div>
                    </x-card>
                    @endif

                    @php 
                        $pendingLaporanCount = $mhsBimbinganList->filter(fn($m) => $m->laporan && $m->laporan->status === 'review')->count();
                    @endphp
                    @if($pendingLaporanCount > 0)
                    <x-card padding="none" class="p-6 group relative border-purple-100 !shadow-2xl !shadow-purple-100/20 hover:scale-[1.03] transition-all cursor-pointer" border onclick="window.location.href='{{ route('dosen.laporan') }}'">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-[#6B21A8] flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-[#6B21A8] uppercase tracking-widest italic">Review Laporan</span>
                                <p class="text-sm font-black text-gray-800 mt-1 italic leading-snug">{{ $pendingLaporanCount }} Laporan Perlu Review</p>
                            </div>
                        </div>
                    </x-card>
                    @endif

                    @if($pendingRekomendasiCount == 0 && $pendingLaporanCount == 0)
                    <x-card padding="none" border class="p-10 bg-gray-50/50 text-center border-dashed">
                        <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic leading-relaxed">Semua tugas bimbingan<br>telah selesai diproses ✨</p>
                    </x-card>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <x-card padding="none" shadow="none" border="false" class="p-10 bg-[#F49E0A] text-white relative !shadow-2xl !shadow-amber-900/30">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
                <h4 class="text-xl font-black tracking-tighter italic mb-4 relative z-10">Pusat Layanan 🚀</h4>
                <div class="space-y-3 relative z-10">
                    <a href="{{ route('dosen.logbook') }}" class="flex items-center justify-between p-4 bg-white/10 hover:bg-white/20 rounded-2xl border border-white/10 transition-all group">
                        <span class="text-xs font-black uppercase tracking-widest italic">Monitoring Logbook</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                    </a>
                    <a href="{{ route('dosen.monitoring') }}" class="flex items-center justify-between p-4 bg-white/10 hover:bg-white/20 rounded-2xl border border-white/10 transition-all group">
                        <span class="text-xs font-black uppercase tracking-widest italic">Data Mahasiswa</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" /></svg>
                    </a>
                </div>
            </x-card>
        </div>
    </div>
</div>

<!-- Modal Detail Mahasiswa -->
<dialog id="student_detail_modal" class="modal">
    <div class="modal-box bg-white max-w-2xl rounded-2xl p-0 overflow-hidden border-none shadow-2xl">
        <div class="bg-[#6B21A8] p-10 pb-16 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <x-button variant="ghost" size="sm" onclick="document.getElementById('student_detail_modal').close()" class="absolute right-6 top-6 !text-white hover:!bg-white/10 !rounded-full !w-9 !h-9 !p-0">✕</x-button>
            <div class="flex items-center gap-8 relative z-10">
                <div id="modal_avatar" class="w-24 h-24 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-4xl font-black text-white shadow-2xl italic">
                    AS
                </div>
                <div class="text-white">
                    <h3 id="modal_name" class="text-3xl font-black tracking-tighter italic">Andi Saputra</h3>
                    <p id="modal_nim" class="text-white/70 font-black tracking-[0.2em] text-[10px] uppercase mt-2 italic">210401001 • TEKNIK INFORMATIKA</p>
                </div>
            </div>
        </div>
        
        <div class="p-10 -mt-10 bg-white rounded-2xl relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-2 italic">Perusahaan Magang</p>
                        <p id="modal_company" class="font-black text-gray-800 italic text-lg leading-tight">PT. Teknologi Maju Persada</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-2 italic">Program Studi</p>
                        <p id="modal_field" class="font-bold text-gray-600 text-sm italic uppercase tracking-wider">Software Development</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-2 italic">Status Saat Ini</p>
                        <span id="modal_status" class="bg-emerald-50 text-emerald-600 border-emerald-100 px-4 py-2 rounded-2xl font-black text-[9px] uppercase tracking-widest italic border-2 inline-block">Aktif Magang</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-2 italic">Pencapaian Progres</p>
                        <div class="flex items-center gap-4">
                            <span id="modal_progress_text" class="text-3xl font-black text-gray-800 italic tracking-tighter">85%</span>
                            <progress id="modal_progress_bar" class="progress [&::-webkit-progress-value]:bg-[#6B21A8] h-3 flex-1 bg-gray-100 rounded-full" value="85" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100 flex gap-4">
                <x-button variant="secondary" size="lg" onclick="document.getElementById('student_detail_modal').close()" class="flex-1 italic">Tutup Jendela</x-button>
                <x-button variant="primary" size="lg" id="modal_logbook_btn" onclick="window.location.href='{{ route('dosen.logbook') }}'" class="flex-[1.5] italic !shadow-xl !shadow-purple-100">Lihat Detail Logbook</x-button>
            </div>
        </div>
    </div>
</dialog>

<script>
// fungsi untuk menampilkan detail mahasiswa pada modal berdasarkan data yang diberikan
function showStudentDetail(name, nim, company, progress, field, status) {
    document.getElementById('modal_name').innerText = name;
    document.getElementById('modal_company').innerText = company || 'Belum Menentukan Instansi';
    document.getElementById('modal_progress_text').innerText = progress + '%';
    document.getElementById('modal_progress_bar').value = progress;
    document.getElementById('modal_nim').innerText = nim + ' • ' + (field || 'PROGRAM STUDI');
    document.getElementById('modal_field').innerText = field || 'N/A';
    document.getElementById('modal_status').innerText = status.toUpperCase();
    var parts = name.split(' '); document.getElementById('modal_avatar').innerText = parts.length > 1 ? (parts[0][0] + parts[1][0]).toUpperCase() : name.substring(0, 2).toUpperCase();

    document.getElementById('student_detail_modal').showModal();
}
</script>
@endsection
