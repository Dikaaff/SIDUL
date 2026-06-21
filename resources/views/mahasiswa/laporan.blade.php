@extends('layouts.app')

@section('title', 'Draft Laporan Akhir')

@section('header')
<x-page-header
    title="Digital Report Editor 📄"
    subtitle="Susun laporan akhir Anda bab demi bab sesuai standar."
>
    <div class="flex gap-2 relative z-10">
        <div class="px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center gap-3">
            @php
                $statusClass = [
                    'approved' => 'bg-green-400 shadow-[0_0_8px_rgba(74,222,128,0.6)]',
                    'revisi' => 'bg-red-400 animate-bounce shadow-[0_0_8px_rgba(248,113,113,0.6)]',
                    'review' => 'bg-blue-400 animate-pulse shadow-[0_0_8px_rgba(96,165,250,0.6)]'
                ][$laporan->status ?? ''] ?? 'bg-white/30';
            @endphp
            <div class="w-2.5 h-2.5 rounded-full {{ $statusClass }}"></div>
            @if($laporan && $laporan->status === 'approved')
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-white/90" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            @endif
            <span class="text-[10px] font-bold uppercase tracking-widest text-white/90">
                Status: {{ $laporan ? ucfirst($laporan->status) : 'New Document' }}
            </span>
        </div>
    </div>
</x-page-header>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/mahasiswa/dashboard" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Laporan Akhir</li>
  </ul>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto pb-20 px-4 sm:px-6">
    @if(!$isPeriodeOpen)
    <div class="mb-8 bg-red-50 border border-red-100 rounded-2xl p-6 flex items-center gap-5 text-red-600">
        <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center shadow-sm shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
        </div>
        <div>
            <h4 class="text-base font-bold">Akses Pengiriman Laporan Ditutup</h4>
            <p class="text-xs font-medium opacity-80">Anda masih dapat mengedit draf laporan Anda secara lokal, namun tombol pengiriman ke pembimbing telah dinonaktifkan karena periode magang telah berakhir.</p>
        </div>
    </div>
    @endif
    
    {{-- Notifikasi Revisi --}}
    @if($laporan && $laporan->status === 'revisi')
    <div class="mb-8 bg-orange-50 border-2 border-orange-100 rounded-2xl p-8 md:p-10 relative overflow-hidden group">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full blur-3xl opacity-50"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 rounded-2xl bg-[#F49E0A] text-white flex items-center justify-center shadow-xl shadow-orange-200 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-orange-800 mb-2 italic uppercase tracking-tighter">Perlu Revisi Laporan ✍️</h3>
                    <div class="p-5 bg-white/60 backdrop-blur-md rounded-2xl border border-orange-100 text-sm font-bold text-orange-900 leading-relaxed italic max-h-48 overflow-y-auto custom-scrollbar">
                        "{!! nl2br(e($laporan->catatan_dosen ?? 'Mohon perbaiki laporan sesuai arahan pembimbing.')) !!}"
                    </div>
                </div>
            </div>
            <x-button variant="primary" size="lg" onclick="document.getElementById('judulInput').focus()" class="bg-orange-500 hover:bg-orange-600 shadow-xl shadow-orange-200 shrink-0">
                Mulai Revisi Sekarang
            </x-button>
        </div>
    </div>
    @endif

    <form action="{{ $laporan && $laporan->status === 'approved' ? '#' : route('mahasiswa.laporan.store') }}" method="POST" id="docForm" {{ $laporan && $laporan->status === 'approved' ? 'onsubmit="return false;"' : '' }}>
        @csrf
        <input type="hidden" name="magang_id" value="{{ Auth::user()?->mahasiswa?->pesertaMagang?->magang?->id }}">

        <div class="flex flex-col gap-8">
            <!-- Judul Section -->
            <x-card padding="large" border class="transition-all hover:shadow-md">
                <label class="block text-[10px] font-medium text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1 italic">Judul Laporan</label>
                <input type="text" name="judul" id="judulInput" value="{{ old('judul', $laporan->judul ?? '') }}"
                    placeholder="Contoh: LAPORAN AKHIR MAGANG PT. GOJEK INDONESIA..."
                    class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xl font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-[#6B21A8]/5 transition-all outline-none placeholder:text-gray-300"
                    {{ $laporan && $laporan->status === 'approved' ? 'readonly' : '' }} required>
            </x-card>

            <!-- Tab Navigation -->
            <div class="flex flex-wrap gap-2 mb-[-1.5rem] px-4">
                @foreach(['bab1' => 'Bab I: Pendahuluan', 'bab2' => 'Bab II: Profil Instansi', 'bab3' => 'Bab III: Pelaksanaan', 'bab4' => 'Bab IV: Penutup'] as $key => $label)
                    <button type="button" onclick="switchTab('{{ $key }}')" id="tab-btn-{{ $key }}"
                        class="tab-btn px-6 py-4 rounded-t font-black text-[11px] uppercase tracking-wider transition-all border-b-4 {{ $loop->first ? 'bg-white border-[#6B21A8] text-[#6B21A8] shadow-sm' : 'bg-gray-100 border-transparent text-gray-400 hover:bg-gray-200' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- Editor Workspace -->
            <x-card padding="none" border class="overflow-hidden bg-white !shadow-2xl">
                @foreach(['bab1', 'bab2', 'bab3', 'bab4'] as $key)
                    <div id="pane-{{ $key }}" class="tab-pane {{ $loop->first ? '' : 'hidden' }}">
                        <div class="p-8 md:p-10 min-h-[600px]">
                            <textarea name="{{ $key }}" id="editor-{{ $key }}" class="editor-instance">
                                {!! old($key, $laporan->$key ?? '') !!}
                            </textarea>
                        </div>
                    </div>
                @endforeach
            </x-card>

            <!-- Status & Actions -->
            <x-card padding="large" border class="flex flex-col md:flex-row items-center justify-between gap-6">
                 <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-[#6B21A8] shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div class="text-[11px] text-gray-400 font-bold leading-tight">
                        Pastikan semua Bab telah terisi sebelum mengirim laporan untuk direview.
                    </div>
                 </div>

                   <div class="flex flex-wrap gap-4 w-full md:w-auto">
                    @if($laporan)
                    <a href="{{ route('mahasiswa.laporan.pdf') }}">
                        <x-button variant="ghost" size="lg" class="!bg-[#422AD5] hover:!bg-[#311eb3] !text-white !shadow-lg !shadow-[#422AD5]/20 gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Cetak PDF
                        </x-button>
                    </a>
                    @endif

                    @if($laporan && $laporan->status === 'approved')
                    <div class="h-14 px-10 bg-green-50 text-green-600 rounded-2xl font-bold uppercase tracking-widest text-[10px] flex items-center gap-3 border border-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Laporan Disetujui ✓
                    </div>
                    @elseif(!$isPeriodeOpen)
                    <x-button variant="disabled" size="lg" class="flex-1 md:flex-none">
                        Periode Berakhir
                    </x-button>
                    @else
                        <x-button type="submit" variant="ghost" size="lg" name="action" value="save" class="!bg-gray-200 hover:!bg-gray-300 !text-gray-700">
                            Simpan Draft
                        </x-button>
                        @if($laporan && $laporan->status === 'review')
                        <x-button variant="ghost" size="lg" class="!bg-blue-100 !text-blue-600 !border-blue-200 cursor-default pointer-events-none hover:!bg-blue-100">
                            Sedang Direview
                        </x-button>
                        @else
                        <x-button type="submit" variant="primary" size="lg" name="action" value="submit">
                            {{ $laporan && $laporan->status === 'revisi' ? 'Kirim Ulang Revisi' : 'Kirim Laporan' }}
                        </x-button>
                        @endif
                    @endif
                  </div>
            </x-card>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    let editors = {};

    // fungsi untuk mengganti tab laporan yang aktif dan memperbarui tampilan tombol tab
    function switchTab(tabKey) {
        // Hide all panes
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        // Show selected pane
        document.getElementById('pane-' + tabKey).classList.remove('hidden');

        // Reset all buttons
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('bg-white', 'border-[#6B21A8]', 'text-[#6B21A8]', 'shadow-sm');
            b.classList.add('bg-gray-100', 'border-transparent', 'text-gray-400');
        });
        // Style active button
        const btn = document.getElementById('tab-btn-' + tabKey);
        btn.classList.add('bg-white', 'border-[#6B21A8]', 'text-[#6B21A8]', 'shadow-sm');
        btn.classList.remove('bg-gray-100', 'border-transparent', 'text-gray-400');
    }

    document.querySelectorAll('.editor-instance').forEach(el => {
        ClassicEditor
            .create(el, {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo' ],
                placeholder: 'Tulis isi bab di sini...'
            })
            .then(editor => {
                editors[el.name] = editor;
                @if($laporan && $laporan->status === 'approved')
                    editor.enableReadOnlyMode('view-only');
                @endif
            })
            .catch(error => { console.error(error); });
    });

    // Sync CKEditor content ke textarea sebelum form dikirim
    document.getElementById('docForm')?.addEventListener('submit', function() {
        for (const [name, editor] of Object.entries(editors)) {
            editor.updateSourceElement();
        }
    });
</script>
@endpush
