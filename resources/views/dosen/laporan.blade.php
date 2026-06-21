@extends('layouts.app')

@section('title', 'Laporan Magang')

@section('header')
<x-page-header 
    title="Review Laporan Akhir 📄" 
    subtitle="Review dan berikan persetujuan untuk laporan akhir magang mahasiswa bimbingan Anda."
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/dosen" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Review Laporan</li>
  </ul>
</div>
@endsection

@section('content')
<x-card padding="none" border class="font-sans overflow-hidden">

    {{-- Header --}}
    <form method="GET" action="{{ url()->current() }}">
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3 class="font-bold text-gray-800 text-lg tracking-tight">Daftar Laporan Akhir</h3>
        </div>
        <div class="flex items-center gap-4">
            <x-search-input
                id="searchInput"
                name="search"
                placeholder="Cari nama atau NIM..."
                value="{{ request('search') }}"
                class="w-64 h-10 text-xs"
            />
            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Total {{ $mhsBimbingan->count() }} Mahasiswa</span>
        </div>
    </div>
    </form>

    <div id="laporan-container">
    <div class="hidden md:block overflow-x-auto custom-scrollbar">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                    <th class="pl-8 py-5 w-16">No</th>
                    <th class="min-w-[280px]">Judul Laporan</th>
                    <th class="min-w-[200px]">Mahasiswa</th>
                    <th class="min-w-[120px]">Status</th>
                    <th class="pr-8 text-right min-w-[120px]">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
        @forelse($mhsBimbingan as $magang)
            @php 
                $laporan = $magang->laporan && $magang->laporan->status !== 'draft' ? $magang->laporan : null;
                $pesertaUtama = $magang->peserta->first();
            @endphp
            <tr class="hover:bg-gray-50 transition-all group">
                <td class="pl-8 py-5 text-[10px] font-medium text-gray-400 italic">{{ $mhsBimbingan->firstItem() + $loop->index }}</td>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-2xl {{ $laporan ? 'bg-blue-50 text-blue-500' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <span class="font-black text-[#6B21A8] text-sm tracking-tight truncate max-w-xs">{{ $laporan->judul ?? 'Belum Menulis Laporan' }}</span>
                    </div>
                </td>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[8px] shadow-inner group-hover:rotate-3 transition-transform shrink-0">
                            @php $nameParts = explode(' ', $pesertaUtama->mahasiswa->nama ?? 'Mhs'); @endphp
                            {{ count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2)) }}
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-semibold text-gray-800 text-sm tracking-tight leading-tight truncate">{{ $pesertaUtama->mahasiswa->nama ?? 'N/A' }}</span>
                            <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $pesertaUtama->mahasiswa->nim ?? 'N/A' }}</span>
                        </div>
                    </div>
                </td>
                <td>
                    @if(!$laporan)
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2.5 py-1.5 rounded-2xl bg-gray-100 text-gray-400">Kosong</span>
                    @else
                        @php
                            $color = [
                                'review' => 'bg-blue-50 text-blue-600',
                                'revisi' => 'bg-red-50 text-red-600',
                                'approved' => 'bg-green-50 text-green-600'
                            ][$laporan->status] ?? 'bg-gray-100 text-gray-600';
                        @endphp
                        <span class="inline-block text-[9px] font-black uppercase tracking-wider px-2.5 py-1.5 rounded-2xl {{ $color }}">{{ ucfirst($laporan->status) }}</span>
                    @endif
                </td>
                <td class="pr-8 text-right">
                    @if($laporan)
                        <x-button type="button" variant="primary" size="sm"
                            class="btn-review h-9 px-5 text-[9px]"
                            data-id="{{ $magang->id }}"
                            data-judul="{{ addslashes($laporan->judul) }}"
                            data-bab1="{{ base64_encode($laporan->bab1) }}"
                            data-bab2="{{ base64_encode($laporan->bab2) }}"
                            data-bab3="{{ base64_encode($laporan->bab3) }}"
                            data-bab4="{{ base64_encode($laporan->bab4) }}">
                            Review
                        </x-button>
                    @else
                        <x-button variant="disabled" size="sm" class="h-9 px-5 text-[9px]">Review</x-button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-24 text-center">
                    <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Belum ada laporan mahasiswa</p>
                </td>
            </tr>
        @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile --}}
    <div class="md:hidden space-y-3 p-4">
        @forelse($mhsBimbingan as $magang)
            @php 
                $laporan = $magang->laporan && $magang->laporan->status !== 'draft' ? $magang->laporan : null;
                $pesertaUtama = $magang->peserta->first();
                $color = $laporan ? ([
                    'review' => 'bg-blue-50 text-blue-600',
                    'revisi' => 'bg-red-50 text-red-600',
                    'approved' => 'bg-green-50 text-green-600'
                ][$laporan->status] ?? 'bg-gray-100 text-gray-600') : '';
            @endphp
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm active:bg-gray-50 transition-all flex flex-col gap-3">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-2xl {{ $laporan ? 'bg-blue-50 text-blue-500' : 'bg-gray-50 text-gray-300' }} flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-black text-[#6B21A8] text-sm truncate">{{ $laporan->judul ?? 'Belum Menulis Laporan' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[8px] shadow-inner shrink-0">
                    @php $nameParts = explode(' ', $pesertaUtama->mahasiswa->nama ?? 'Mhs'); @endphp
                    {{ count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $pesertaUtama->mahasiswa->nama ?? 'N/A' }}</h4>
                    <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $pesertaUtama->mahasiswa->nim ?? 'N/A' }}</p>
                </div>
                @if($laporan)
                    <span class="inline-block text-[8px] font-black uppercase tracking-wider px-2 py-1 rounded-2xl {{ $color }} shrink-0">{{ ucfirst($laporan->status) }}</span>
                @else
                    <span class="inline-block text-[8px] font-black uppercase tracking-wider px-2 py-1 rounded-2xl bg-gray-100 text-gray-400 shrink-0">Kosong</span>
                @endif
            </div>
            @if($laporan)
                <x-button type="button" variant="primary" size="sm"
                    class="btn-review w-full h-10 text-[10px]"
                    data-id="{{ $magang->id }}"
                    data-judul="{{ addslashes($laporan->judul) }}"
                    data-bab1="{{ base64_encode($laporan->bab1) }}"
                    data-bab2="{{ base64_encode($laporan->bab2) }}"
                    data-bab3="{{ base64_encode($laporan->bab3) }}"
                    data-bab4="{{ base64_encode($laporan->bab4) }}">
                    Review
                </x-button>
            @else
                <x-button variant="disabled" size="sm" class="w-full h-10 text-[10px]">Review</x-button>
            @endif
        </div>
        @empty
        <div class="py-16 text-center">
            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Belum ada laporan mahasiswa</p>
        </div>
        @endforelse
    </div>

        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/30" id="laporan-pagination">
            {{ $mhsBimbingan->appends(request()->query())->links('vendor.pagination.sidul') }}
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
        <form method="dialog" data-no-loading>
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
                <label class="block text-[10px] font-medium text-gray-400 uppercase tracking-widest mb-3 italic">Catatan Pembimbing / Revisi</label>
                <textarea name="feedback" rows="3" class="textarea textarea-bordered w-full rounded-2xl bg-white border-gray-200 text-sm" placeholder="Tulis catatan..."></textarea>
            </div>
            <div class="flex gap-3">
                <x-button type="submit" variant="danger" name="status" value="revisi" onclick="toggleFeedbackRequired('revisi')" class="flex-1 text-[10px]">Berikan Revisi</x-button>
                <x-button type="submit" variant="success" name="status" value="approved" onclick="toggleFeedbackRequired('approved')" class="flex-1 text-[10px]">Setujui Laporan</x-button>
            </div>
        </form>
    </div>
  </div>
</dialog>

@endsection



@push('scripts')
<script>
    let currentBabs = {};

    function switchView(babKey) {
        const content = document.getElementById('modalContent');
        content.innerHTML = atob(currentBabs[babKey] || '');
        document.querySelectorAll('.view-btn').forEach(b => {
            b.classList.remove('bg-amber-400', 'text-white');
            b.classList.add('bg-white', 'text-gray-400', 'border', 'border-gray-100');
        });
        document.getElementById('view-btn-' + babKey).classList.add('bg-amber-400', 'text-white');
    }

    function toggleFeedbackRequired(status) {
        document.querySelector('textarea[name="feedback"]').required = (status === 'revisi');
    }

    function bindLaporanEvents() {
        document.querySelectorAll('.btn-review').forEach(btn => {
            btn.removeEventListener('click', reviewHandler);
            btn.addEventListener('click', reviewHandler);
        });
        document.querySelectorAll('#laporan-pagination a').forEach(link => {
            link.removeEventListener('click', laporanPagHandler);
            link.addEventListener('click', laporanPagHandler);
        });
        var si = document.getElementById('searchInput');
        if (si) {
            si.removeEventListener('input', si._searchHandler);
            si._searchHandler = function() {
                clearTimeout(window.laporanSearchTimer);
                window.laporanSearchTimer = setTimeout(function() { si.form.submit(); }, 400);
            };
            si.addEventListener('input', si._searchHandler);
        }
    }

    function reviewHandler() {
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
    }

    function laporanPagHandler(e) {
        e.preventDefault();
        var container = document.getElementById('laporan-container');
        if (!container) return;
        fetch(this.href)
            .then(function(res) { return res.text(); })
            .then(function(html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, 'text/html');
                var newContent = doc.getElementById('laporan-container');
                if (newContent) {
                    container.innerHTML = newContent.innerHTML;
                }
                history.pushState({ laporanPage: this.href }, '', this.href);
                bindLaporanEvents();
            }.bind(this))
            .catch(function() {
                window.location.href = this.href;
            }.bind(this));
    }

    bindLaporanEvents();

    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.laporanPage) {
            var container = document.getElementById('laporan-container');
            if (!container) return;
            fetch(e.state.laporanPage)
                .then(function(res) { return res.text(); })
                .then(function(html) {
                    var parser = new DOMParser();
                    var doc = parser.parseFromString(html, 'text/html');
                    var newContent = doc.getElementById('laporan-container');
                    if (newContent) {
                        container.innerHTML = newContent.innerHTML;
                    }
                    bindLaporanEvents();
                });
        }
    });
</script>
@endpush
