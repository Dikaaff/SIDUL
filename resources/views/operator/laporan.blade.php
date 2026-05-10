@extends('layouts.app')

@section('title', 'Laporan Magang Mahasiswa')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex items-center justify-between relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">Daftar Laporan Magang 📝</h2>
            <p class="text-white/90 font-medium text-sm">Lihat semua laporan akhir yang telah diunggah mahasiswa. Approval dilakukan oleh Dosen Pembimbing masing-masing.</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden font-sans">
    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/10">
        <h3 class="font-black text-gray-800 text-lg tracking-tight flex items-center gap-3">
            <span class="w-2 h-8 bg-[#6B21A8] rounded-full"></span>
            Pantauan Laporan Masuk
        </h3>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="table w-full border-collapse">
            <thead>
                <tr class="text-gray-900 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/10 border-b border-gray-100">
                    <th class="pl-8 py-6 w-16">No</th>
                    <th class="min-w-[200px]">Mahasiswa</th>
                    <th class="min-w-[200px]">Subjek Laporan</th>
                    <th class="min-w-[150px]">Status Laporan</th>
                    <th class="min-w-[150px] text-center">Waktu Unggah</th>
                    <th class="pr-8 py-6 text-right min-w-[120px]">Berkas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($magangs as $index => $magang)
                @php $mhs = $magang->peserta->first()?->mahasiswa; @endphp
                @if($mhs)
                <tr class="hover:bg-gray-50 transition-all group">
                    <td class="pl-8 py-6 text-[10px] font-black text-gray-400 italic">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-black text-gray-800 text-sm tracking-tight leading-tight">{{ $mhs->nama }}</span>
                            <span class="text-[10px] font-bold text-gray-400 mt-1 tracking-widest uppercase">{{ $magang->nim }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700 text-xs">{{ $magang->perusahaan }}</span>
                            <span class="text-[9px] font-black text-primary uppercase tracking-widest mt-1 italic">Laporan Akhir Magang</span>
                        </div>
                    </td>
                    <td>
                        @php $statusLaporan = $magang->laporan->status_laporan ?? 'Pending'; @endphp
                        @if($statusLaporan === 'Approve')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-100">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                Disetujui
                            </span>
                        @elseif($statusLaporan === 'Revisi')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-orange-50 text-orange-500 text-[9px] font-black uppercase tracking-wider border border-orange-100">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                                Revisi
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-wider border border-blue-100">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                Review
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="text-[10px] font-black text-gray-700 tracking-tight bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">
                            {{ $magang->laporan->created_at->format('d M Y') }}
                        </span>
                    </td>
                    <td class="pr-8 text-right">
                        @if($magang->laporan && $magang->laporan->laporan)
                        <a href="{{ $magang->laporan->laporan }}" target="_blank" class="btn btn-sm h-10 rounded-xl bg-gray-900 border-none text-white hover:bg-black font-black text-[9px] uppercase tracking-widest px-5 shadow-lg shadow-black/10 transition-all active:scale-95 flex items-center gap-2 ml-auto w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            PDF
                        </a>
                        @else
                        <span class="text-[9px] font-black text-gray-300 uppercase italic tracking-widest">No File</span>
                        @endif
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="6" class="py-32 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-[2rem] flex items-center justify-center mx-auto mb-6 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <h4 class="text-lg font-black text-gray-800 uppercase italic tracking-tighter">Belum Ada Laporan</h4>
                        <p class="text-gray-500 font-medium text-xs mt-2 leading-relaxed">Saat ini belum ada mahasiswa yang mengunggah laporan akhir magang mereka.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
