@extends('layouts.app')

@section('title', 'Logbook Magang')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1 italic">
            Logbook Harian 📝
        </h2>
        <p class="text-gray-500 font-medium text-sm">Catat aktivitas harian dan progres pekerjaan magang Anda.</p>
    </div>
    <button onclick="document.getElementById('logbook_modal').showModal()" class="w-full md:w-auto btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none px-8 rounded-xl shadow-xl shadow-purple-900/20 font-black uppercase tracking-widest text-[10px] h-14 transition-all hover:scale-[1.02] active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
        Isi Logbook Hari Ini
    </button>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto pb-20">
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
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
                            <button onclick="showLogDetail('{{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}', '{{ e($log->kegiatan) }}')" class="btn btn-ghost btn-sm text-[#6B21A8] font-black uppercase text-[9px] tracking-widest rounded-xl hover:bg-purple-50">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-32 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 rounded-3xl bg-gray-50 flex items-center justify-center text-gray-300 mb-4 border-2 border-dashed border-gray-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <h4 class="text-lg font-black text-gray-400 italic">Belum Ada Catatan Logbook</h4>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-2">Silakan mulai isi logbook harian Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Tambah Logbook -->
<dialog id="logbook_modal" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box bg-white max-w-2xl rounded-[2.5rem] p-0 overflow-hidden border-none shadow-2xl">
    <div class="bg-[#6B21A8] p-8 text-white relative">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        <h3 class="font-black text-2xl italic tracking-tighter relative z-10">Tambah Catatan Baru ✍️</h3>
        <p class="text-white/70 text-[10px] font-black uppercase tracking-widest mt-1 relative z-10 italic">Pastikan informasi yang Anda masukkan akurat.</p>
    </div>
    
    <div class="p-10 -mt-6 bg-white rounded-[2.5rem] relative z-20">
        <form action="{{ route('mahasiswa.logbook.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="form-control">
                <label class="label"><span class="label-text font-black text-gray-400 text-[10px] uppercase tracking-widest px-1">Isi Kegiatan / Pekerjaan Hari Ini</span></label>
                <textarea name="logbook" placeholder="Tuliskan detail pekerjaan Anda hari ini..." class="textarea textarea-bordered h-48 bg-gray-50 border-none rounded-[1.5rem] text-sm font-bold text-gray-800 p-6 focus:bg-white focus:ring-4 focus:ring-primary/5 transition-all outline-none resize-none" required></textarea>
            </div>
            
            <div class="flex gap-4 pt-6">
                <button type="button" onclick="document.getElementById('logbook_modal').close()" class="btn btn-ghost flex-1 h-14 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl">Batal</button>
                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-600 border-none text-white flex-[2] h-14 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-orange-100 rounded-2xl transition-all">Simpan Logbook</button>
            </div>
        </form>
    </div>
  </div>
</dialog>

<!-- Modal: Detail Logbook -->
<dialog id="log_detail_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box p-0 max-w-2xl bg-white rounded-[2.5rem] overflow-hidden border-none shadow-2xl">
        <div class="bg-gray-900 p-8 text-white flex items-center justify-between relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-white/50 uppercase tracking-[0.3em] mb-1 italic">Detail Aktivitas Magang</p>
                <h3 id="detailDate" class="text-2xl font-black italic tracking-tighter uppercase">TANGGAL</h3>
            </div>
            <form method="dialog" class="relative z-10">
                <button class="btn btn-sm btn-circle btn-ghost bg-white/10 hover:bg-white/20 border-none text-white">✕</button>
            </form>
        </div>
        <div class="p-10 -mt-8 bg-white rounded-[3rem] relative z-20 space-y-8">
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 italic px-1">Isi Kegiatan / Pekerjaan</p>
                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-inner">
                    <p id="detailDesc" class="text-base font-bold text-gray-700 leading-relaxed italic whitespace-pre-wrap">Konten kegiatan...</p>
                </div>
            </div>
            <button onclick="document.getElementById('log_detail_modal').close()" class="btn btn-ghost w-full h-14 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl">Tutup Jendela</button>
        </div>
    </div>
</dialog>
@endsection

@push('scripts')
<script>
    function showLogDetail(date, desc) {
        document.getElementById('detailDate').innerText = date.toUpperCase();
        document.getElementById('detailDesc').innerText = desc;
        document.getElementById('log_detail_modal').showModal();
    }
</script>
@endpush
