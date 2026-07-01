@extends('layouts.app')

@section('title', 'Rekomendasi Magang')

@section('header')
<x-page-header 
    title="Rekomendasi Magang ✍️" 
    subtitle="Sebagai Dosen Wali, Anda dapat memberikan persetujuan dan tanda tangan rekomendasi magang mahasiswa dengan cepat."
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/dosen" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Rekomendasi</li>
  </ul>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <div class="lg:col-span-3 space-y-6 max-w-full overflow-hidden">

        <form method="GET" action="{{ url()->current() }}">
        <x-card padding="large" border class="flex flex-col xl:flex-row gap-6 items-stretch xl:items-center justify-between transition-all hover:shadow-md">
            <x-section-title color="primary" title="Antrean Rekomendasi" />
            <div class="w-full xl:w-72">
                <x-search-input 
                    id="searchInput"
                    name="search"
                    placeholder="Cari nama atau NIM..."
                    value="{{ request('search') }}"
                />
            </div>
        </x-card>
        </form>

        <x-card padding="none" border class="overflow-hidden">
            {{-- Desktop --}}
            <div class="hidden md:block overflow-x-auto custom-scrollbar">
                <table class="table w-full">
                    <thead>
                        <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                            <th class="pl-8 py-5 w-16">No</th>
                            <th class="min-w-[220px]">Mahasiswa</th>
                            <th class="min-w-[140px] text-center">Status</th>
                            <th class="pr-8 text-right min-w-[200px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($mhsWali as $index => $mhs)
                        <tr class="hover:bg-gray-50 transition-all group">
                            <td class="pl-8 py-5 text-[10px] font-medium text-gray-400">
                                {{ $mhsWali->firstItem() + $index }}
                            </td>
                            <td>
                                @php $nameParts = explode(' ', $mhs->nama ?? 'Mhs'); $initials = count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2)); @endphp
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[8px] shadow-inner group-hover:rotate-3 transition-transform shrink-0">
                                        {{ $initials }}
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-semibold text-gray-800 text-sm tracking-tight leading-tight truncate">{{ $mhs->nama }}</span>
                                        <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $mhs->nim }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <x-status-badge :status="$mhs->status_daftar" />
                            </td>
                            <td class="pr-8 text-right">
                                @if($mhs->status_daftar === 'Approve')
                                    <x-button variant="ghost" size="sm" class="!text-green-600 cursor-default pointer-events-none gap-2 !font-black">
                                        <div class="w-7 h-7 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center shadow-inner">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                        </div>
                                        <span class="italic text-[9px]">Direkomendasikan</span>
                                    </x-button>
                                @elseif($mhs->status_daftar === 'Rejected')
                                    <form action="{{ route('dosen.rekomendasi.approve', $mhs->id) }}" method="POST" class="inline approve-form">
                                        @csrf
                                        <x-button type="submit" variant="ghost" size="sm" class="!text-red-600 hover:!bg-red-50 gap-2">
                                            <div class="w-7 h-7 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center shadow-inner">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                            </div>
                                            <span class="italic text-[9px]">Setujui Mahasiswa?</span>
                                        </x-button>
                                    </form>
                                @else
                                    <div class="flex items-center justify-end gap-2">
                                        <x-button type="button" variant="danger" data-id="{{ $mhs->id }}" data-name="{{ $mhs->nama }}" class="reject-btn px-4 text-[9px]">
Tolak
                                        </x-button>
                                        <form action="{{ route('dosen.rekomendasi.approve', $mhs->id) }}" method="POST" class="inline approve-form">
                                            @csrf
                                            <x-button type="submit" variant="success" class="px-6 text-[9px] group hover:scale-105">
Setujui
                                            </x-button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-24 text-center">
                                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Belum ada mahasiswa perwalian</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Mobile --}}
            <div class="md:hidden space-y-3 p-4">
                @forelse($mhsWali as $mhs)
                @php $nameParts = explode(' ', $mhs->nama ?? 'Mhs'); $initials = count($nameParts) > 1 ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1)) : strtoupper(substr($nameParts[0], 0, 2)); @endphp
                <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm active:bg-gray-50 transition-all flex flex-col gap-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs shadow-inner shrink-0">
                            {{ $initials }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $mhs->nama }}</h4>
                            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $mhs->nim }}</p>
                        </div>
                        <x-status-badge :status="$mhs->status_daftar" />
                    </div>
                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-50">
                        @if($mhs->status_daftar === 'Approve')
                            <span class="text-[9px] font-black text-green-600 italic">✓ Direkomendasikan</span>
                        @elseif($mhs->status_daftar === 'Rejected')
                            <form action="{{ route('dosen.rekomendasi.approve', $mhs->id) }}" method="POST" class="inline approve-form">
                                @csrf
                                <x-button type="submit" variant="ghost" size="sm" class="!text-red-600 hover:!bg-red-50">Setujui Mahasiswa?</x-button>
                            </form>
                        @else
                            <x-button type="button" variant="danger" data-id="{{ $mhs->id }}" data-name="{{ $mhs->nama }}" class="reject-btn px-4 text-[9px]">Tolak</x-button>
                            <form action="{{ route('dosen.rekomendasi.approve', $mhs->id) }}" method="POST" class="inline approve-form">
                                @csrf
                                <x-button type="submit" variant="success" class="px-6 text-[9px]">Setujui</x-button>
                            </form>
                        @endif
                    </div>
                </div>
                @empty
                <div class="py-16 text-center">
                    <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Belum ada mahasiswa perwalian</p>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/30">
                {{ $mhsWali->appends(request()->query())->links('vendor.pagination.sidul') }}
            </div>
        </x-card>
    </div>

    {{-- Side Panel --}}
    <div class="lg:col-span-1 space-y-6">
        <x-card padding="large" border="false" shadow="none" class="bg-[#F49E0A] text-white !shadow-2xl !shadow-orange-900/10 italic relative group">
            <x-slot name="header">
                <div class="flex items-center gap-2 mb-6 relative z-10">
                    <div class="w-2 h-6 bg-white rounded-full shadow-lg shadow-white/50"></div>
                    <h4 class="font-black text-xs uppercase tracking-[0.25em] italic text-white">Panduan Cepat</h4>
                </div>
            </x-slot>
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/10 rounded-full group-hover:scale-150 transition-transform duration-1000 pointer-events-none"></div>
            <div class="space-y-5 relative z-10">
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-2xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white shrink-0">1</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Periksa identitas pendaftar.</p>
                </div>
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-2xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white shrink-0">2</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Klik tombol SETUJUI.</p>
                </div>
            </div>
        </x-card>
    </div>
</div>

{{-- Rejection Modal --}}
<x-modal id="reject_confirmation_modal" title="Konfirmasi Penolakan" color="red" size="md">
    <div class="text-center space-y-6">
        <div class="w-20 h-20 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center mx-auto shadow-xl shadow-red-500/10 border border-red-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        </div>
        <div>
            <h4 class="text-xl font-black text-gray-800 uppercase italic tracking-tight">Yakin Menolak?</h4>
            <p class="text-gray-500 font-medium text-sm mt-2 leading-relaxed">Anda akan menolak pengajuan rekomendasi mahasiswa <span id="mhs_name_modal" class="text-red-500 font-black"></span>. Tindakan ini tidak dapat dibatalkan dengan mudah.</p>
        </div>
        
        <div class="grid grid-cols-2 gap-4 pt-2">
            <form method="dialog" data-no-loading>
                <x-button type="submit" variant="ghost" size="lg" :full="true">Batal</x-button>
            </form>
            <form id="reject_form" method="POST" action="">
                @csrf
                <x-button type="submit" variant="danger" size="lg" :full="true">Ya, Tolak Sekarang</x-button>
            </form>
        </div>
    </div>
</x-modal>

@push('scripts')
<script>
(function() {
    function openRejectModal(id, name) {
        document.getElementById('reject_form').action = '/dosen/rekomendasi/' + id + '/reject';
        document.getElementById('mhs_name_modal').innerText = name;
        document.getElementById('reject_confirmation_modal').showModal();
    }

    function handleDelayedSubmit(e) {
        e.preventDefault();
        var form = e.target;
        var btn = form.querySelector('button[type="submit"]');
        if (btn) {
            btn.classList.add('loading');
            btn.setAttribute('disabled', 'true');
            btn.innerHTML = '<span class="loading loading-spinner loading-xs"></span> Memproses...';
        }
        setTimeout(function() { form.submit(); }, 800);
    }

    function bindEvents() {
        document.querySelectorAll('.reject-btn').forEach(function(btn) {
            btn.onclick = function() {
                openRejectModal(this.getAttribute('data-id'), this.getAttribute('data-name'));
            };
        });
        document.querySelectorAll('form.approve-form').forEach(function(form) {
            form.onsubmit = handleDelayedSubmit;
        });
        document.getElementById('reject_form').onsubmit = handleDelayedSubmit;
    }

    // Auto-submit search after debounce
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        var searchTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() { searchInput.form.submit(); }, 400);
        });
    }

    bindEvents();
})();
</script>
@endpush
@endsection
