@extends('layouts.app')

@section('title', 'Dashboard Dosen - SIDUL')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden shadow-2xl mt-4 mx-2">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 mb-4">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Sistem Informasi Magang</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-black tracking-tighter leading-tight italic mb-2">
                Halo, Bapak/Ibu<br>{{ explode(' ', Auth::user()->name)[0] }} 👋
            </h2>
            <p class="text-white/80 font-medium text-xs md:text-sm max-w-xl leading-relaxed italic">Pantau progres magang dan kelola persetujuan bimbingan mahasiswa Anda dengan lebih mudah.</p>
        </div>
        <div class="flex flex-col gap-3 shrink-0">
            <div class="bg-white/10 backdrop-blur-xl px-6 py-4 rounded-2xl border border-white/20 text-white flex flex-col items-center gap-1 shadow-2xl min-w-[140px]">
                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-white/60">Hari Ini</span>
                <span class="text-xl font-black italic">{{ now()->format('d M Y') }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-2 space-y-10 pb-20">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Stat: Total Mahasiswa -->
        <div class="group card bg-white shadow-2xl shadow-gray-100/50 border border-gray-100 rounded-[2.5rem] overflow-hidden hover:scale-[1.02] transition-all duration-500">
            <div class="card-body p-8 relative">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-purple-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Total Anak Wali</p>
                        <h3 class="text-5xl font-black text-[#6B21A8] italic tracking-tighter">{{ $mhsWaliCount }}</h3>
                    </div>
                    <div class="w-16 h-16 rounded-[1.5rem] bg-purple-50 text-[#6B21A8] flex items-center justify-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat: Pengajuan Pending -->
        <div class="group card bg-white shadow-2xl shadow-gray-100/50 border border-gray-100 rounded-[2.5rem] overflow-hidden hover:scale-[1.02] transition-all duration-500">
            <div class="card-body p-8 relative">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-orange-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Pending Rekomendasi</p>
                        <h3 class="text-5xl font-black text-[#F49E0A] italic tracking-tighter">{{ $pendingRekomendasiCount }}</h3>
                    </div>
                    <div class="w-16 h-16 rounded-[1.5rem] bg-orange-50 text-[#F49E0A] flex items-center justify-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stat: Progress Rata-rata -->
        <div class="group card bg-white shadow-2xl shadow-gray-100/50 border border-gray-100 rounded-[2.5rem] overflow-hidden hover:scale-[1.02] transition-all duration-500">
            <div class="card-body p-8 relative">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                <div class="flex items-center justify-between relative z-10">
                    <div class="space-y-1">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Anak Bimbingan Lulus</p>
                        <h3 class="text-5xl font-black text-emerald-600 italic tracking-tighter">{{ $lulusCount }}<span class="text-xl text-gray-300">/{{ $mhsBimbinganCount }}</span></h3>
                    </div>
                    <div class="w-16 h-16 rounded-[1.5rem] bg-emerald-50 text-emerald-600 flex items-center justify-center shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <!-- Main Content: Student List -->
        <div class="lg:col-span-8 space-y-6">
            <div class="flex items-center justify-between mb-2 px-2">
                <div>
                    <h3 class="text-2xl font-black text-gray-800 tracking-tighter italic">Progres Bimbingan Terbaru</h3>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mt-0.5 italic">Menampilkan 5 aktivitas bimbingan aktif</p>
                </div>
                <a href="{{ route('dosen.monitoring') }}" class="text-[10px] font-black uppercase tracking-widest text-[#6B21A8] hover:underline italic">Lihat Semua</a>
            </div>

            <div class="space-y-4">
                @forelse($mhsBimbinganList as $magang)
                <div class="group bg-white hover:bg-gray-50/80 border border-gray-100 rounded-[2.5rem] p-8 transition-all duration-300 shadow-2xl shadow-gray-100/50 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 rounded-[1.5rem] bg-purple-50 text-[#6B21A8] flex items-center justify-center font-black text-xl shadow-inner group-hover:rotate-6 transition-transform">
                            {{ substr($magang->peserta->first()->mahasiswa->nama ?? 'M', 0, 2) }}
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 text-xl leading-tight tracking-tighter italic group-hover:text-[#6B21A8] transition-colors">{{ $magang->peserta->first()->mahasiswa->nama ?? 'Mahasiswa' }}</h4>
                            <div class="flex items-center gap-3 mt-1.5">
                                <span class="text-[10px] text-gray-400 font-black tracking-[0.2em] uppercase italic">{{ $magang->nim }}</span>
                                <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                <span class="text-[10px] text-[#6B21A8] font-black tracking-[0.2em] uppercase italic">{{ $magang->konsentrasi }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-10">
                        <div class="hidden md:block w-48">
                            <div class="flex items-center justify-between mb-2 px-1">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em] italic">Progress</span>
                                @php
                                    $targetLogbooks = 30;
                                    $progress = $magang->status_magang === 'Selesai' ? 100 : min(100, round(($magang->logbooks_count / $targetLogbooks) * 100));
                                @endphp
                                <span class="text-[11px] font-black text-gray-800 italic">{{ $progress }}%</span>
                            </div>
                            <div class="relative h-2 w-full bg-gray-100 rounded-full overflow-hidden shadow-inner">
                                <div class="absolute top-0 left-0 h-full bg-[#6B21A8] rounded-full transition-all duration-1000 ease-out" style="width: {{ $progress }}%"></div>
                            </div>
                        </div>

                        <button onclick="showStudentDetail('{{ $magang->peserta->first()->mahasiswa->nama ?? '' }}', '{{ $magang->nim }}', '{{ $magang->perusahaan }}', {{ $progress }}, '{{ $magang->konsentrasi }}', '{{ $magang->status_magang }}')" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-300 hover:text-[#6B21A8] hover:bg-white hover:shadow-lg transition-all border border-transparent hover:border-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    </div>
                </div>
                @empty
                <div class="bg-gray-50/50 rounded-[2.5rem] p-20 text-center border-2 border-dashed border-gray-200">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-gray-200 mx-auto mb-6 shadow-sm">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h4 class="font-black text-xl text-gray-400 italic uppercase tracking-widest">Belum Ada Bimbingan</h4>
                    <p class="text-sm font-medium text-gray-400 mt-2">Daftar bimbingan bimbingan Anda akan muncul di sini.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar: Notifications & Actions -->
        <div class="lg:col-span-4 space-y-10">
            <div class="space-y-6">
                <h3 class="text-2xl font-black text-gray-800 tracking-tighter italic px-2">Aktivitas Penting 🔔</h3>
                
                <div class="space-y-4">
                    @if($pendingRekomendasiCount > 0)
                    <div class="group relative bg-white p-6 rounded-[2.5rem] border border-orange-100 shadow-2xl shadow-orange-100/20 hover:scale-[1.03] transition-all cursor-pointer" onclick="window.location.href='{{ route('dosen.rekomendasi') }}'">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-orange-50 text-[#F49E0A] flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-[#F49E0A] uppercase tracking-widest italic">Rekomendasi Wali</span>
                                <p class="text-sm font-black text-gray-800 mt-1 italic leading-snug">{{ $pendingRekomendasiCount }} Mahasiswa Menunggu</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @php 
                        $pendingLaporanCount = $mhsBimbinganList->filter(fn($m) => $m->laporan && $m->laporan->status === 'review')->count();
                    @endphp
                    @if($pendingLaporanCount > 0)
                    <div class="group relative bg-white p-6 rounded-[2.5rem] border border-purple-100 shadow-2xl shadow-purple-100/20 hover:scale-[1.03] transition-all cursor-pointer" onclick="window.location.href='{{ route('dosen.laporan') }}'">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-[#6B21A8] flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <div>
                                <span class="text-[9px] font-black text-[#6B21A8] uppercase tracking-widest italic">Review Laporan</span>
                                <p class="text-sm font-black text-gray-800 mt-1 italic leading-snug">{{ $pendingLaporanCount }} Laporan Perlu Review</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($pendingRekomendasiCount == 0 && $pendingLaporanCount == 0)
                    <div class="bg-gray-50/50 p-10 rounded-[2.5rem] text-center border border-gray-100 border-dashed">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic leading-relaxed">Semua tugas bimbingan<br>telah selesai diproses ✨</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-[#6B21A8] rounded-[2.5rem] p-10 text-white relative overflow-hidden shadow-2xl shadow-purple-900/30">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Mahasiswa -->
<dialog id="student_detail_modal" class="modal">
    <div class="modal-box bg-white max-w-2xl rounded-[3rem] p-0 overflow-hidden border-none shadow-2xl">
        <div class="bg-[#6B21A8] p-10 pb-16 relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-sm btn-circle btn-ghost absolute right-6 top-6 text-white hover:bg-white/10 border-none">✕</button>
            <div class="flex items-center gap-8 relative z-10">
                <div id="modal_avatar" class="w-24 h-24 rounded-[2rem] bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center text-4xl font-black text-white shadow-2xl italic">
                    AS
                </div>
                <div class="text-white">
                    <h3 id="modal_name" class="text-3xl font-black tracking-tighter italic">Andi Saputra</h3>
                    <p id="modal_nim" class="text-white/70 font-black tracking-[0.2em] text-[10px] uppercase mt-2 italic">210401001 • TEKNIK INFORMATIKA</p>
                </div>
            </div>
        </div>
        
        <div class="p-10 -mt-10 bg-white rounded-[3rem] relative z-20">
            <div class="grid grid-cols-2 gap-10">
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Perusahaan Magang</p>
                        <p id="modal_company" class="font-black text-gray-800 italic text-lg leading-tight">PT. Teknologi Maju Persada</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Program Studi</p>
                        <p id="modal_field" class="font-bold text-gray-600 text-sm italic uppercase tracking-wider">Software Development</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Status Saat Ini</p>
                        <span id="modal_status" class="bg-emerald-50 text-emerald-600 border-emerald-100 px-4 py-2 rounded-xl font-black text-[9px] uppercase tracking-widest italic border-2 inline-block">Aktif Magang</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Pencapaian Progres</p>
                        <div class="flex items-center gap-4">
                            <span id="modal_progress_text" class="text-3xl font-black text-gray-800 italic tracking-tighter">85%</span>
                            <progress id="modal_progress_bar" class="progress [&::-webkit-progress-value]:bg-[#6B21A8] h-3 flex-1 bg-gray-100 rounded-full" value="85" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-100 flex gap-4">
                <button onclick="document.getElementById('student_detail_modal').close()" class="btn bg-gray-50 hover:bg-gray-100 border-none flex-1 h-14 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl transition-all italic">Tutup Jendela</button>
                <a id="modal_logbook_btn" href="{{ route('dosen.logbook') }}" class="btn bg-[#6B21A8] hover:bg-purple-800 border-none text-white flex-[1.5] h-14 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-purple-100 rounded-2xl transition-all italic">Lihat Detail Logbook</a>
            </div>
        </div>
    </div>
</dialog>

<script>
function showStudentDetail(name, nim, company, progress, field, status) {
    document.getElementById('modal_name').innerText = name;
    document.getElementById('modal_company').innerText = company || 'Belum Menentukan Instansi';
    document.getElementById('modal_progress_text').innerText = progress + '%';
    document.getElementById('modal_progress_bar').value = progress;
    document.getElementById('modal_nim').innerText = nim + ' • ' + (field || 'PROGRAM STUDI');
    document.getElementById('modal_field').innerText = field || 'N/A';
    document.getElementById('modal_status').innerText = status.toUpperCase();
    document.getElementById('modal_avatar').innerText = name.split(' ').map(n => n[0]).join('').toUpperCase();

    document.getElementById('student_detail_modal').showModal();
}
</script>
@endsection
