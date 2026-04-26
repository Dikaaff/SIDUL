@extends('layouts.app')

@section('title', 'Draft Laporan Akhir')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1 italic">
            Digital Report Editor 📄
        </h2>
        <p class="text-gray-500 font-medium text-sm">Susun laporan akhir Anda bab demi bab sesuai standar.</p>
    </div>
    <div class="flex gap-2">
        <div class="px-4 py-2 bg-gray-50 border border-gray-100 rounded-xl flex items-center gap-3">
            @php
                $statusClass = [
                    'approved' => 'bg-green-500',
                    'revisi' => 'bg-red-500 animate-bounce',
                    'review' => 'bg-blue-500 animate-pulse'
                ][$laporan->status ?? ''] ?? 'bg-gray-300';
            @endphp
            <div class="w-2.5 h-2.5 rounded-full {{ $statusClass }}"></div>
            <span class="text-[10px] font-black uppercase tracking-widest text-gray-500">
                Status: {{ $laporan ? ucfirst($laporan->status) : 'New Document' }}
            </span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto pb-20 px-4 sm:px-6">
    
    {{-- Notifikasi Revisi --}}
    @if($laporan && $laporan->status === 'revisi')
    <div class="mb-8 bg-orange-50 border-2 border-orange-100 rounded-[2.5rem] p-8 md:p-10 relative overflow-hidden group">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full blur-3xl opacity-50"></div>
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-start gap-6">
                <div class="w-16 h-16 rounded-3xl bg-[#F49E0A] text-white flex items-center justify-center shadow-xl shadow-orange-200 shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-orange-800 mb-2 italic uppercase tracking-tighter">Perlu Revisi Laporan ✍️</h3>
                    <div class="p-5 bg-white/60 backdrop-blur-md rounded-2xl border border-orange-100 text-sm font-bold text-orange-900 leading-relaxed italic max-h-48 overflow-y-auto custom-scrollbar">
                        "{!! nl2br(e($laporan->catatan_dosen ?? 'Mohon perbaiki laporan sesuai arahan pembimbing.')) !!}"
                    </div>
                </div>
            </div>
            <button type="button" onclick="document.getElementById('judulInput').focus()" class="btn bg-orange-500 hover:bg-orange-600 border-none text-white px-8 h-14 rounded-2xl font-black uppercase tracking-widest text-xs shadow-xl shadow-orange-200 shrink-0">
                Mulai Revisi Sekarang
            </button>
        </div>
    </div>
    @endif

    <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" id="docForm">
        @csrf
        <input type="hidden" name="magang_id" value="{{ Auth::user()->mahasiswa->pesertaMagang->magang->id }}">
        
        <div class="flex flex-col gap-8">
            <!-- Judul Section -->
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-gray-100 transition-all hover:shadow-md">
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1 italic">Judul Laporan</label>
                <input type="text" name="judul" id="judulInput" value="{{ old('judul', $laporan->judul ?? '') }}" 
                    placeholder="Contoh: LAPORAN AKHIR MAGANG PT. GOJEK INDONESIA..."
                    class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 text-xl font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 transition-all outline-none placeholder:text-gray-300"
                    {{ $laporan && $laporan->status === 'approved' ? 'readonly' : '' }} required>
            </div>

            <!-- Tab Navigation -->
            <div class="flex flex-wrap gap-2 mb-[-1.5rem] px-4">
                @foreach(['bab1' => 'Bab I: Pendahuluan', 'bab2' => 'Bab II: Profil Instansi', 'bab3' => 'Bab III: Pelaksanaan', 'bab4' => 'Bab IV: Penutup'] as $key => $label)
                    <button type="button" onclick="switchTab('{{ $key }}')" id="tab-btn-{{ $key }}" 
                        class="tab-btn px-6 py-4 rounded-t-2xl font-black text-[11px] uppercase tracking-wider transition-all border-b-4 {{ $loop->first ? 'bg-white border-primary text-primary shadow-sm' : 'bg-gray-100 border-transparent text-gray-400 hover:bg-gray-200' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <!-- Editor Workspace -->
            <div class="flex flex-col shadow-2xl rounded-[2rem] overflow-hidden border border-gray-200 bg-white">
                @foreach(['bab1', 'bab2', 'bab3', 'bab4'] as $key)
                    <div id="pane-{{ $key }}" class="tab-pane {{ $loop->first ? '' : 'hidden' }}">
                        <div class="p-8 md:p-12 min-h-[600px]">
                            <textarea name="{{ $key }}" id="editor-{{ $key }}" class="editor-instance">
                                {!! old($key, $laporan->$key ?? '') !!}
                            </textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Status & Actions -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center justify-between gap-6">
                 <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center text-primary shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <div class="text-[11px] text-gray-400 font-bold leading-tight">
                        Pastikan semua Bab telah terisi sebelum mengirim laporan untuk direview.
                    </div>
                 </div>

                 <div class="flex gap-4 w-full md:w-auto">
                    @if(!$laporan || $laporan->status !== 'approved')
                    <button type="submit" class="btn h-14 px-10 bg-primary hover:bg-purple-700 text-white border-none rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-2xl shadow-purple-200 flex-1 md:flex-none transition-all">
                        {{ ($laporan && $laporan->status === 'revisi') ? 'Kirim Ulang Revisi' : 'Simpan & Kirim Laporan' }}
                    </button>
                    @else
                    <div class="h-14 px-10 bg-green-50 text-green-600 rounded-2xl font-black uppercase tracking-widest text-[10px] flex items-center gap-3 border border-green-100">
                        Laporan Disetujui ✓
                    </div>
                    @endif
                 </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e5e7eb;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #d1d5db;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    let editors = {};

    function switchTab(tabKey) {
        // Hide all panes
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        // Show selected pane
        document.getElementById('pane-' + tabKey).classList.remove('hidden');

        // Reset all buttons
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('bg-white', 'border-primary', 'text-primary', 'shadow-sm');
            b.classList.add('bg-gray-100', 'border-transparent', 'text-gray-400');
        });
        // Style active button
        const btn = document.getElementById('tab-btn-' + tabKey);
        btn.classList.add('bg-white', 'border-primary', 'text-primary', 'shadow-sm');
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
</script>
@endpush
