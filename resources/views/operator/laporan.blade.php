@extends('layouts.app')

@section('title', 'Laporan Magang Mahasiswa')

@section('header')
<x-page-header 
    title="Daftar Laporan Magang 📝" 
    subtitle="Lihat semua laporan akhir yang telah diunggah mahasiswa. Approval dilakukan oleh Dosen Pembimbing masing-masing."
/>
@endsection

@section('content')
<x-card padding="none" border class="overflow-hidden font-sans">
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
                    <th class="min-w-[150px] text-center pr-8">Waktu Unggah</th>
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
                            <span class="text-[9px] font-black text-[#6B21A8] uppercase tracking-widest mt-1 italic">Laporan Akhir Magang</span>
                        </div>
                    </td>
                    <td>
                        @php $statusLaporan = $magang->laporan->status ?? 'review'; @endphp
                        @if($statusLaporan === 'approved')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-100">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                Disetujui
                            </span>
                        @elseif($statusLaporan === 'revisi')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl bg-orange-50 text-orange-500 text-[9px] font-black uppercase tracking-wider border border-orange-100">
                                <span class="w-1.5 h-1.5 bg-orange-500 rounded-full animate-pulse"></span>
                                Revisi
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-2xl bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-wider border border-blue-100">
                                <span class="w-1.5 h-1.5 bg-blue-500 rounded-full animate-pulse"></span>
                                Review
                            </span>
                        @endif
                    </td>
                    <td class="text-center">
                        <span class="text-[10px] font-black text-gray-700 tracking-tight bg-gray-50 px-3 py-1 rounded-2xl border border-gray-100">
                            {{ optional($magang->laporan)->created_at ? $magang->laporan->created_at->format('d M Y') : '-' }}
                        </span>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="5" class="py-32 text-center">
                        <div class="w-20 h-20 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-6 text-gray-300">
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
</x-card>
@endsection
