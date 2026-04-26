@extends('layouts.app')

@section('title', 'Laporan Magang')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">Review Laporan Akhir 📄</h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Review dan berikan persetujuan untuk laporan akhir magang mahasiswa bimbingan Anda.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center shrink-0">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">Dosen Pembimbing</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden font-sans">

    {{-- Table Header --}}
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="font-black text-gray-800 text-lg tracking-tight">Daftar Laporan Akhir</h3>
        </div>
        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total {{ $mhsBimbingan->count() }} Mahasiswa</span>
    </div>

    {{-- Column Headers --}}
    <div class="px-8 py-3 grid grid-cols-12 gap-4 border-b border-gray-100 bg-white">
        <div class="col-span-5 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Judul Laporan</div>
        <div class="col-span-3 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Mahasiswa</div>
        <div class="col-span-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Status</div>
        <div class="col-span-2 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</div>
    </div>

    <div class="divide-y divide-gray-50">
        @forelse($mhsBimbingan as $magang)
            @php $laporan = $magang->laporan; @endphp
            <div class="px-8 py-5 grid grid-cols-12 gap-4 items-center hover:bg-gray-50/50 transition-all group">
                <div class="col-span-5 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl {{ $laporan ? 'bg-blue-50 text-blue-500' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-black text-[#6B21A8] text-sm tracking-tight truncate max-w-xs">
                            {{ $laporan->judul ?? 'Belum Menulis Laporan' }}
                        </p>
                        @if($laporan)
                            <p class="text-[10px] font-bold text-gray-400 mt-0.5 uppercase tracking-wider">
                                Terakhir update: {{ $laporan->updated_at->diffForHumans() }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="col-span-3">
                    <p class="font-black text-gray-800 text-sm">{{ $magang->peserta->mahasiswa->nama }}</p>
                    <p class="text-[11px] font-bold text-gray-400 mt-0.5">{{ $magang->peserta->mahasiswa->nim }}</p>
                </div>
                <div class="col-span-2">
                    @if(!$laporan)
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded-lg bg-gray-100 text-gray-400">Kosong</span>
                    @elseif($laporan->is_draft)
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded-lg bg-orange-50 text-orange-600">Drafting</span>
                    @else
                        @php
                            $color = [
                                'Pending' => 'bg-blue-50 text-blue-600',
                                'Revisi' => 'bg-red-50 text-red-600',
                                'Approve' => 'bg-green-50 text-green-600'
                            ][$laporan->status_laporan] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded-lg {{ $color }}">
                            {{ $laporan->status_laporan === 'Pending' ? 'Perlu Review' : $laporan->status_laporan }}
                        </span>
                    @endif
                </div>
                <div class="col-span-2 flex justify-end">
                    @if($laporan && !$laporan->is_draft)
                        <button onclick="openReviewModal('{{ $magang->id_magang }}', '{{ addslashes($laporan->judul) }}', '{{ base64_encode($laporan->konten) }}')" 
                            class="btn btn-sm rounded-xl bg-[#6B21A8] hover:bg-purple-800 border-none text-white font-black text-[10px] uppercase tracking-wider h-10 px-6">
                            Review
                        </button>
                    @else
                        <button class="btn btn-sm rounded-xl bg-gray-100 text-gray-400 border-none cursor-not-allowed font-black text-[10px] uppercase tracking-wider h-10 px-6" disabled>Review</button>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-20 text-center">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
                <h3 class="text-gray-400 font-bold">Belum ada mahasiswa bimbingan.</h3>
            </div>
        @endforelse
    </div>
</div>

{{-- Review Modal --}}
<dialog id="reviewModal" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box p-0 max-w-4xl bg-white overflow-hidden rounded-[2.5rem]">
    <div class="p-8 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
        <div>
            <h3 class="font-black text-xl text-gray-800 italic" id="modalTitle">Judul Laporan</h3>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Laporan Akhir Mahasiswa</p>
        </div>
        <form method="dialog">
            <button class="btn btn-circle btn-ghost btn-sm">✕</button>
        </form>
    </div>
    
    <div class="p-8 md:p-10 max-h-[60vh] overflow-y-auto bg-gray-100/50 shadow-inner">
        {{-- Paper Look for Dosen --}}
        <div class="max-w-[750px] mx-auto bg-white shadow-xl p-12 md:p-16 min-h-[500px] rounded-sm prose prose-sm max-w-none text-gray-800" id="modalContent">
            {{-- Konten Laporan akan di-inject di sini --}}
        </div>
    </div>

    <div class="p-8 border-t border-gray-100 bg-gray-50/30">
        <form action="" method="POST" id="approvalForm">
            @csrf
            <div class="mb-6">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 italic">Catatan Pembimbing / Revisi</label>
                <textarea name="feedback" rows="3" class="textarea textarea-bordered w-full rounded-2xl bg-white border-gray-200 focus:border-primary/20 text-sm font-medium" placeholder="Tulis catatan atau alasan revisi di sini..." required></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" name="status" value="Revisi" class="btn flex-1 bg-white hover:bg-red-50 text-red-600 border-2 border-red-100 rounded-xl font-black uppercase tracking-widest text-[10px] h-12">Berikan Revisi</button>
                <button type="submit" name="status" value="Approve" class="btn flex-1 bg-green-600 hover:bg-green-700 text-white border-none rounded-xl font-black uppercase tracking-widest text-[10px] h-12 shadow-xl shadow-green-100">Setujui Laporan</button>
            </div>
        </form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

@endsection

@section('scripts')
<script>
    function openReviewModal(idMagang, judul, kontenBase64) {
        const modal = document.getElementById('reviewModal');
        const title = document.getElementById('modalTitle');
        const content = document.getElementById('modalContent');
        const form = document.getElementById('approvalForm');

        title.innerText = judul;
        // Decode base64 back to HTML
        content.innerHTML = atob(kontenBase64);
        form.action = `/dosen/laporan/${idMagang}/approve`;

        modal.showModal();
    }
</script>
@endsection

