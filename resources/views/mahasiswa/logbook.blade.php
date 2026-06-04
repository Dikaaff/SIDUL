@extends('layouts.app')

@section('title', 'Logbook Magang')

@section('header')
<x-page-header 
    title="Logbook Harian 📝" 
    subtitle="Catat aktivitas harian dan progres pekerjaan magang Anda."
>
    <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto relative z-10">
        <a href="{{ route('mahasiswa.logbook.pdf') }}" class="btn bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 rounded-2xl font-bold uppercase tracking-widest text-[10px] h-14 flex items-center justify-center gap-2 backdrop-blur-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            Cetak Logbook
        </a>
        @if($isPeriodeOpen)
        <x-button variant="amber" size="lg" onclick="document.getElementById('logbook_modal').showModal()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
            Isi Logbook Hari Ini
        </x-button>
        @else
        <x-button variant="disabled" size="lg">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
            Periode Tutup
        </x-button>
        @endif
    </div>
</x-page-header>
@endsection

@section('content')
<div class="max-w-7xl mx-auto pb-20">
    @if(!$isPeriodeOpen)
    <div class="mb-6 bg-red-50 border border-red-100 rounded-2xl p-4 flex items-center gap-4 text-red-600">
        <div class="w-10 h-10 rounded-2xl bg-red-100 flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
        </div>
        <div>
            <p class="text-sm font-bold">Periode Magang Telah Ditutup</p>
            <p class="text-xs opacity-80 font-medium">Anda tidak dapat menambahkan catatan logbook baru karena periode magang semester ini telah berakhir.</p>
        </div>
    </div>
    @endif

    <x-card padding="none" border class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                        <th class="py-6 pl-10">Tanggal</th>
                        <th>Aktivitas & Kegiatan</th>
                        <th class="text-center pr-10 w-40">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logbooks as $log)
                    <tr class="hover:bg-gray-50/50 transition-all border-b border-gray-50 group">
                        <td class="py-6 pl-10">
                            <div class="flex flex-col">
                                <span class="font-black text-gray-800 text-sm italic">{{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}</span>
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-1">Hari Ke-{{ $logbooks->count() - $loop->index }}</span>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-bold text-gray-700 leading-relaxed italic truncate max-w-xl group-hover:text-gray-900 transition-colors">
                                {{ $log->kegiatan }}
                            </p>
                        </td>
                        <td class="text-center pr-10">
                            <button onclick="showLogDetail('{{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}', '{{ e($log->kegiatan) }}')" class="btn btn-ghost btn-sm text-[#422AD5] font-black uppercase text-[9px] tracking-widest rounded-2xl hover:bg-[#422AD5]/10">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <x-empty-state colspan="3" title="Belum Ada Catatan Logbook" subtitle="Silakan mulai isi logbook harian Anda."/>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</div>

{{-- Modal: Tambah Logbook --}}
<x-modal id="logbook_modal" title="Tambah Catatan Baru ✍️" subtitle="Pastikan informasi yang Anda masukkan akurat." color="purple">
    <form action="{{ route('mahasiswa.logbook.store') }}" method="POST" class="space-y-6">
        @csrf
        <div class="form-control">
            <label class="label"><span class="label-text font-black text-gray-400 text-[10px] uppercase tracking-widest px-1">Isi Kegiatan / Pekerjaan Hari Ini</span></label>
            <textarea name="logbook" placeholder="Tuliskan detail pekerjaan Anda hari ini..." class="textarea textarea-bordered h-48 bg-gray-50 border-none rounded-2xl text-sm font-bold text-gray-800 p-6 focus:bg-white focus:ring-4 focus:ring-[#6B21A8]/5 transition-all outline-none resize-none" required></textarea>
        </div>
        <div class="flex gap-4 pt-2">
            <x-button type="button" variant="ghost" size="lg" class="flex-1" onclick="document.getElementById('logbook_modal').close()">Batal</x-button>
            <x-button type="submit" variant="amber" size="lg" class="flex-[2]">Simpan Logbook</x-button>
        </div>
    </form>
</x-modal>

{{-- Modal: Detail Logbook --}}
<x-modal id="log_detail_modal" color="purple" subtitle="Detail Aktivitas Magang" title="TANGGAL">
    <div>
        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 italic px-1">Isi Kegiatan / Pekerjaan</p>
        <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-inner">
            <p id="detailDesc" class="text-base font-bold text-gray-700 leading-relaxed italic whitespace-pre-wrap">Konten kegiatan...</p>
        </div>
    </div>
    <x-button variant="ghost" size="lg" :full="true" onclick="document.getElementById('log_detail_modal').close()">Tutup Jendela</x-button>
</x-modal>

@endsection

@push('scripts')
<script>
    // fungsi untuk menampilkan detail logbook pada modal berdasarkan tanggal dan deskripsi
    function showLogDetail(date, desc) {
        // Update the title dynamically since x-modal renders it server-side
        document.querySelector('#log_detail_modal h3').innerText = date.toUpperCase();
        document.getElementById('detailDesc').innerText = desc;
        document.getElementById('log_detail_modal').showModal();
    }
</script>
@endpush
