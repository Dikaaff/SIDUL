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
    
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr class="text-gray-900 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/10 border-b border-gray-100">
                    <th class="pl-8 py-4 w-12">No</th>
                    <th>Mahasiswa</th>
                    <th>Subjek Laporan</th>
                    <th>Status Laporan</th>
                    <th class="text-center">Waktu Unggah</th>
                    <th class="pr-8 text-right">Berkas</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($magangs as $index => $magang)
                @php $mhs = $magang->peserta->first()->mahasiswa; @endphp
                <tr class="hover:bg-gray-50 transition-all">
                    <td class="pl-8 py-6 text-[10px] font-black text-gray-600 italic">
                        {{ $index + 1 }}
                    </td>
                    <td>
                        <div class="font-black text-gray-800 text-sm tracking-tight">{{ $mhs->nama ?? '-' }}</div>
                        <div class="text-[10px] font-bold text-gray-900 mt-0.5 tracking-widest">{{ $magang->nim }}</div>
                    </td>
                    <td>
                        <div class="font-bold text-gray-700 text-xs">{{ $magang->perusahaan }}</div>
                        <div class="text-[9px] font-black text-gray-900 uppercase tracking-widest mt-1">Laporan Akhir Magang</div>
                    </td>
                    <td>
                        @php $statusLaporan = $magang->laporan->status_laporan ?? 'Pending'; @endphp
                        @if($statusLaporan === 'Approve')
                            <span class="px-2.5 py-1.5 rounded-lg bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-200">Disetujui</span>
                        @elseif($statusLaporan === 'Revisi')
                            <span class="px-2.5 py-1.5 rounded-lg bg-orange-50 text-orange-500 text-[9px] font-black uppercase tracking-wider border border-orange-200">Revisi</span>
                        @else
                            <span class="px-2.5 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-wider border border-blue-200">Menunggu Review</span>
                        @endif
                    </td>
                    <td class="text-center text-xs font-medium text-gray-900 tracking-tight">
                        {{ $magang->laporan->created_at->diffForHumans() ?? '-' }}
                    </td>
                    <td class="pr-8 text-right">
                        @if($magang->laporan && $magang->laporan->laporan)
                        <a href="{{ $magang->laporan->laporan }}" target="_blank" class="btn btn-sm min-h-0 h-9 rounded-xl bg-white border border-gray-200 text-gray-500 hover:text-[#6B21A8] hover:bg-purple-50 hover:border-purple-100 font-black text-[10px] uppercase tracking-wider px-4 transition-all">
                            Buka PDF
                        </a>
                        @else
                        <span class="text-[10px] font-black text-black-strong font-black italic font-bold tracking-tight uppercase tracking-widest">Belum Ada File</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center">
                        <p class="text-[10px] font-black text-black-strong font-black italic font-bold tracking-tight uppercase tracking-widest">Belum ada laporan yang diunggah mahasiswa</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
