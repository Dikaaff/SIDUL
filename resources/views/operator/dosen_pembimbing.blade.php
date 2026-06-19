@extends('layouts.app')

@section('title', 'Plotting Dosen Pembimbing')

@section('header')
<x-page-header 
    title="Plotting Dosen Pembimbing 🤝" 
    subtitle="Tetapkan Dosen Pembimbing untuk mahasiswa yang telah divalidasi dokumen pendaftarannya."
/>
@endsection

@section('content')
<div id="operator-plotting-container">
<div class="grid grid-cols-1 gap-8 font-sans">
    
    {{-- Bagian: Perlu Penugasan --}}
    <x-card padding="none" border class="overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-2 h-8 bg-[#6B21A8] rounded-full"></div>
                <h3 class="font-black text-gray-800 text-lg tracking-tight">Perlu Penugasan Dosen</h3>
            </div>
            <span class="px-3 py-1 bg-purple-50 text-[#6B21A8] text-[10px] font-black rounded-2xl border border-purple-100 uppercase tracking-widest">{{ $belumAssign->total() }} Mahasiswa</span>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="text-gray-900 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/10">
                        <th class="pl-8 py-4 w-12">No</th>
                        <th>Mahasiswa & NIM</th>
                        <th>Perusahaan</th>
                        <th>Plotting Dosen</th>
                        <th class="pr-8 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($belumAssign as $index => $magang)
                    @php $mhs = $magang->peserta->first()?->mahasiswa; @endphp
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="pl-8 py-6 text-[10px] font-black text-gray-600 italic">
                            {{ $belumAssign->firstItem() + $index }}
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs">
                                    {{ strtoupper(substr($mhs->nama ?? 'M', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-black text-gray-800 text-sm tracking-tight">{{ $mhs->nama ?? '-' }}</div>
                                    <div class="text-[10px] font-bold text-gray-900 uppercase tracking-widest">{{ $magang->nim }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-xs font-bold text-gray-600">{{ $magang->perusahaan }}</td>
                        <td>
                            <form id="assign-form-{{ $magang->id }}" action="{{ route('operator.assign_dosen', $magang->id) }}" method="POST">
                                @csrf
                                <select name="dosen_id" class="select select-sm select-bordered w-full max-w-xs rounded-2xl bg-white border-gray-200 text-gray-700 font-bold focus:border-[#6B21A8]" required>
                                    <option value="" disabled selected>Pilih Dosen Pembimbing...</option>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="pr-8 text-right">
                            <button form="assign-form-{{ $magang->id }}" type="submit" class="btn btn-sm min-h-0 h-9 rounded-2xl bg-amber-500 hover:bg-amber-600 border-none text-white font-black text-[10px] uppercase tracking-wider px-6 shadow-sm shadow-amber-200 transition-all active:scale-95">Simpan Plotting</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-24 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-300 mb-2 border-2 border-dashed border-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <h4 class="text-lg font-black text-gray-400 italic">Antrean Plotting Kosong</h4>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic font-bold">Semua mahasiswa yang terverifikasi sudah memiliki pembimbing</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 border-t border-gray-100 bg-gray-50/30 flex items-center justify-center" id="belum-assign-pagination">
            {{ $belumAssign->links('vendor.pagination.sidul') }}
        </div>
    </x-card>

    {{-- Bagian: Riwayat Plotting Terbaru --}}
    <x-card padding="none" border class="overflow-hidden">
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-black text-gray-800 text-lg tracking-tight flex items-center gap-3">
                <span class="w-2 h-8 bg-green-500 rounded-full"></span>
                Sudah Terplotting
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="text-gray-900 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/10">
                        <th class="pl-8 py-4 w-12">No</th>
                        <th>ID Magang</th>
                        <th>Mahasiswa</th>
                        <th>Perusahaan</th>
                        <th>Dosen Pembimbing</th>
                        <th>Status</th>
                        <th class="pr-8 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($sudahAssign as $index => $magang)
                    @php $mhs = $magang->peserta->first()?->mahasiswa; @endphp
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="pl-8 py-4 text-[10px] font-black text-gray-600 italic">
                            {{ $sudahAssign->firstItem() + $index }}
                        </td>
                        <td>
                            <span class="px-2 py-1 rounded-2xl bg-gray-900 text-white font-black text-[9px] border border-gray-800 shadow-sm tracking-widest">{{ $magang->kode_magang }}</span>
                        </td>
                        <td>
                            <div class="font-black text-gray-800 text-sm tracking-tight">{{ $mhs->nama ?? '-' }}</div>
                            <div class="text-[10px] font-bold text-gray-900 tracking-widest">{{ $magang->nim }}</div>
                        </td>
                        <td class="text-xs font-medium text-black">{{ $magang->perusahaan }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black text-[#6B21A8]">{{ $magang->pembimbing->nama ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="pr-8 text-right flex items-center justify-end gap-2">
                             <span class="px-3 py-1.5 rounded-2xl bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-100">Plotting Aktif</span>
                             <form action="{{ route('operator.magang.destroy', $magang->id) }}" method="POST" onsubmit="return confirm('Hapus data magang ini?')">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" aria-label="Hapus plotting" class="btn btn-ghost btn-xs text-red-500 hover:bg-red-50 rounded-2xl p-1">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                 </button>
                             </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-12 text-center">
                            <p class="text-[10px] font-black text-gray-600 uppercase tracking-widest">Belum ada riwayat plotting</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-8 py-4 border-t border-gray-100 bg-gray-50/30 flex items-center justify-center" id="sudah-assign-pagination">
            {{ $sudahAssign->links('vendor.pagination.sidul') }}
        </div>
    </x-card>

</div>
</div>

@push('scripts')
<script>
(function() {
    var container = document.getElementById('operator-plotting-container');
    if (!container) return;

    function loadPage(url) {
        if (!container) return;
        fetch(url)
            .then(function(r) { return r.text(); })
            .then(function(html) {
                var doc = new DOMParser().parseFromString(html, 'text/html');
                var nc = doc.getElementById('operator-plotting-container');
                if (nc) container.innerHTML = nc.innerHTML;
                history.pushState({ plot: url }, '', url);
            })
            .catch(function() { window.location.href = url; });
    }

    container.addEventListener('click', function(e) {
        var link = e.target.closest('#belum-assign-pagination a, #sudah-assign-pagination a');
        if (link) { e.preventDefault(); loadPage(link.href); }
    });

    window.addEventListener('popstate', function(e) {
        if (e.state && e.state.plot) loadPage(e.state.plot);
    });
})();
</script>
@endpush

@endsection
