@extends('layouts.app')

@section('title', 'Laporan Magang')

@section('header')
<x-page-header 
    title="Review Laporan Akhir 📄" 
    subtitle="Review dan berikan persetujuan untuk laporan akhir magang mahasiswa bimbingan Anda."
/>
@endsection

@section('content')
<x-card padding="none" border class="font-sans w-full overflow-hidden">

    {{-- Table Header --}}
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="font-bold text-gray-800 text-lg tracking-tight">Daftar Laporan Akhir</h3>
        </div>
        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total {{ $mhsBimbingan->count() }} Mahasiswa</span>
    </div>

    {{-- Scrollable Wrapper for Mobile --}}
    <div class="w-full overflow-x-auto pb-4 custom-scrollbar">
        <div class="min-w-[850px] lg:min-w-full">
            {{-- Column Headers --}}
            <div class="px-8 py-3 grid grid-cols-12 gap-4 border-b border-gray-100 bg-white">
                <div class="col-span-5 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Judul Laporan</div>
                <div class="col-span-3 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Mahasiswa</div>
                <div class="col-span-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Status</div>
                <div class="col-span-2 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-right">Aksi</div>
            </div>

            <div class="divide-y divide-gray-50">
        @forelse($mhsBimbingan as $magang)
            @php 
                $laporan = $magang->laporan;
                $pesertaUtama = $magang->peserta->first();
            @endphp
            <div class="px-8 py-5 grid grid-cols-12 gap-4 items-center hover:bg-gray-50/50 transition-all group">
                <div class="col-span-5 flex items-center gap-4">
                    <div class="w-10 h-10 rounded-2xl {{ $laporan ? 'bg-blue-50 text-blue-500' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-black text-[#6B21A8] text-sm tracking-tight truncate max-w-xs">
                            {{ $laporan->judul ?? 'Belum Menulis Laporan' }}
                        </p>
                    </div>
                </div>
                <div class="col-span-3">
                    <p class="font-black text-gray-800 text-sm">{{ $pesertaUtama->mahasiswa->nama ?? 'N/A' }}</p>
                    <p class="text-[11px] font-bold text-gray-400 mt-0.5">{{ $pesertaUtama->mahasiswa->nim ?? 'N/A' }}</p>
                </div>
                <div class="col-span-2">
                    @if(!$laporan)
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded-2xl bg-gray-100 text-gray-400">Kosong</span>
                    @else
                        @php
                            $color = [
                                'review' => 'bg-blue-50 text-blue-600',
                                'revisi' => 'bg-red-50 text-red-600',
                                'approved' => 'bg-green-50 text-green-600'
                            ][$laporan->status] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2 py-1 rounded-2xl {{ $color }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    @endif
                </div>
                <div class="col-span-2 flex justify-end">
                    @if($laporan)
                        <button type="button" 
                            class="btn-review btn btn-sm rounded-2xl bg-amber-400 hover:bg-amber-500 border-none text-white font-black text-[10px] uppercase tracking-wider h-10 px-6 shadow-lg shadow-amber-100"
                            data-id="{{ $magang->id }}"
                            data-judul="{{ addslashes($laporan->judul) }}"
                            data-bab1="{{ base64_encode($laporan->bab1) }}"
                            data-bab2="{{ base64_encode($laporan->bab2) }}"
                            data-bab3="{{ base64_encode($laporan->bab3) }}"
                            data-bab4="{{ base64_encode($laporan->bab4) }}">
                            Review
                        </button>
                    @else
                        <button class="btn btn-sm rounded-2xl bg-gray-100 text-gray-400 border-none cursor-not-allowed font-black text-[10px] uppercase tracking-wider h-10 px-6" disabled>Review</button>
                    @endif
                </div>
            </div>
        @empty
            <div class="p-20 text-center">
                <h3 class="text-gray-400 font-bold">Belum ada laporan mahasiswa.</h3>
            </div>
        @endforelse
        </div>
    </div>
</x-card>

{{-- Review Modal --}}
<dialog id="reviewModal" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box p-0 max-w-5xl bg-white rounded-2xl flex flex-col max-h-[90vh]">
    <div class="p-8 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
        <div>
            <h3 class="font-black text-xl text-gray-800 italic" id="modalTitle">Judul Laporan</h3>
        </div>
        <form method="dialog">
            <button class="btn btn-circle btn-ghost btn-sm">✕</button>
        </form>
    </div>
    
    <div class="p-8 md:p-10 flex-1 overflow-y-auto bg-gray-50 custom-scrollbar">
        <div class="flex gap-2 mb-6">
            @foreach(['bab1' => 'Bab I', 'bab2' => 'Bab II', 'bab3' => 'Bab III', 'bab4' => 'Bab IV'] as $key => $label)
                <button type="button" onclick="switchView('{{ $key }}')" id="view-btn-{{ $key }}" class="view-btn px-4 py-2 rounded-2xl font-bold text-[10px] uppercase tracking-wider transition-all {{ $loop->first ? 'bg-amber-400 text-white' : 'bg-white text-gray-400 border border-gray-100' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
        <div class="max-w-none bg-white shadow-sm p-8 md:p-10 min-h-[400px] rounded-2xl prose prose-slate text-gray-800 border border-gray-100" id="modalContent"></div>
    </div>

    <div class="p-8 border-t border-gray-100 bg-gray-50/30">
        <form action="" method="POST" id="approvalForm">
            @csrf
            <div class="mb-6">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3 italic">Catatan Pembimbing / Revisi</label>
                <textarea name="feedback" rows="3" class="textarea textarea-bordered w-full rounded-2xl bg-white border-gray-200 text-sm" placeholder="Tulis catatan..." required></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" name="status" value="revisi" class="btn flex-1 bg-red-500 hover:bg-red-600 text-white border-none rounded-2xl font-black uppercase text-[10px] h-12 shadow-lg shadow-red-100">Berikan Revisi</button>
                <button type="submit" name="status" value="approved" class="btn flex-1 bg-green-500 hover:bg-green-600 text-white border-none rounded-2xl font-black uppercase text-[10px] h-12 shadow-lg shadow-green-100">Setujui Laporan</button>
            </div>
        </form>
    </div>
  </div>
</dialog>

@endsection



@push('scripts')
<script>
    let currentBabs = {};

    // fungsi untuk mengganti tampilan konten laporan berdasarkan bab yang dipilih
    function switchView(babKey) {
        const content = document.getElementById('modalContent');
        content.innerHTML = atob(currentBabs[babKey] || '');
        document.querySelectorAll('.view-btn').forEach(b => {
            b.classList.remove('bg-amber-400', 'text-white');
            b.classList.add('bg-white', 'text-gray-400', 'border', 'border-gray-100');
        });
        document.getElementById('view-btn-' + babKey).classList.add('bg-amber-400', 'text-white');
    }

    document.querySelectorAll('.btn-review').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const judul = this.dataset.judul;
            currentBabs = {
                bab1: this.dataset.bab1,
                bab2: this.dataset.bab2,
                bab3: this.dataset.bab3,
                bab4: this.dataset.bab4
            };
            
            document.getElementById('modalTitle').innerText = judul;
            document.getElementById('approvalForm').action = `/dosen/laporan/${id}/approve`;
            switchView('bab1');
            document.getElementById('reviewModal').showModal();
        });
    });
</script>
@endpush
