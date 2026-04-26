@extends('layouts.app')

@section('title', 'Monitoring Global Magang')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex items-center justify-between relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">Monitoring Global Magang 📊</h2>
            <p class="text-white/90 font-medium text-sm">Pantau perkembangan seluruh mahasiswa magang, penugasan dosen, dan status akhir proses di seluruh fakultas.</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="space-y-6 font-sans">
    
    {{-- Filter & Tools --}}
    <div class="flex flex-col md:flex-row gap-4 items-center justify-between bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
        <div class="flex flex-wrap gap-3">
            <select class="select select-sm select-bordered rounded-xl bg-white text-gray-700 font-bold border-gray-200 focus:border-[#6B21A8]">
                <option selected>Semua Angkatan</option>
                <option>2021</option>
                <option>2022</option>
            </select>
            <select class="select select-sm select-bordered rounded-xl bg-white text-gray-700 font-bold border-gray-200 focus:border-[#6B21A8]">
                <option selected>Semua Konsentrasi</option>
                <option>Software Engineering</option>
                <option>Data Science</option>
                <option>Cyber Security</option>
            </select>
            <select class="select select-sm select-bordered rounded-xl bg-white text-gray-700 font-bold border-gray-200 focus:border-[#6B21A8]">
                <option selected>Semua Status</option>
                <option>Pending</option>
                <option>Aktif</option>
                <option>Selesai</option>
            </select>
        </div>
        <div class="flex gap-2">
             <button class="btn btn-sm min-h-0 h-10 px-4 rounded-xl border border-gray-200 bg-white text-gray-600 font-black text-[10px] uppercase tracking-widest hover:bg-gray-50 transition-all">Export Excel</button>
        </div>
    </div>

    {{-- Tabel Monitoring Global --}}
    <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="text-gray-900 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/30 border-b border-gray-100">
                        <th class="pl-8 py-5 w-12">No</th>
                        <th>Mahasiswa & NIM</th>
                        <th>Perusahaan & Tipe</th>
                        <th>Dosen Pembimbing</th>
                        <th>ID Magang</th>
                        <th>Status</th>
                        <th class="pr-8 text-right">Progress</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($magangs as $index => $magang)
                    @php $mhs = $magang->peserta->first()->mahasiswa; @endphp
                    <tr class="hover:bg-gray-50 transition-all">
                        <td class="pl-8 py-6 text-[10px] font-black text-gray-600 italic">
                            {{ $index + 1 }}
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs">
                                    {{ strtoupper(substr($mhs->nama ?? 'MH', 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-black text-gray-800 text-sm tracking-tight">{{ $mhs->nama ?? '-' }}</div>
                                    <div class="text-[10px] font-bold text-gray-900 mt-0.5 tracking-widest uppercase">{{ $magang->nim }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="font-bold text-gray-700 text-xs">{{ $magang->perusahaan }}</div>
                            <div class="badge badge-outline border-gray-200 text-[8px] font-black uppercase tracking-widest px-2 py-2 mt-1">{{ $magang->tipe_magang }}</div>
                        </td>
                        <td>
                            @if($magang->pembimbing)
                                <div class="font-bold text-sm text-[#6B21A8]">{{ $magang->pembimbing->nama }}</div>
                                <div class="text-[9px] font-black text-gray-900 uppercase tracking-widest">{{ $magang->pembimbing->nik ?? '-' }}</div>
                            @else
                                <span class="text-[10px] font-black text-red-400 uppercase tracking-widest italic">Belum Diatur</span>
                            @endif
                        </td>
                        <td>
                            @if($magang->kode_magang)
                                <div class="px-3 py-1 bg-gray-900 text-white rounded-lg text-[9px] font-black tracking-widest inline-block border border-gray-800 shadow-sm">
                                    {{ $magang->kode_magang }}
                                </div>
                            @else
                                <span class="text-[10px] font-black text-black font-black font-bold italic uppercase tracking-widest italic">—</span>
                            @endif
                        </td>
                        <td>
                            @if($magang->status_magang === 'Aktif')
                                <span class="px-2.5 py-1.5 rounded-lg bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-200">Aktif</span>
                            @elseif($magang->status_magang === 'Pending')
                                <span class="px-2.5 py-1.5 rounded-lg bg-orange-50 text-[#F49E0A] text-[9px] font-black uppercase tracking-wider border border-orange-200">Pending</span>
                            @elseif($magang->status_magang === 'Terverifikasi')
                                <span class="px-2.5 py-1.5 rounded-lg bg-blue-50 text-blue-600 text-[9px] font-black uppercase tracking-wider border border-blue-200">Verifikasi</span>
                            @elseif($magang->status_magang === 'Selesai')
                                <span class="px-2.5 py-1.5 rounded-lg bg-purple-50 text-[#6B21A8] text-[9px] font-black uppercase tracking-wider border border-purple-200">Selesai</span>
                            @elseif($magang->status_magang === 'Ditolak')
                                <span class="px-2.5 py-1.5 rounded-lg bg-red-50 text-red-600 text-[9px] font-black uppercase tracking-wider border border-red-200">Ditolak</span>
                            @else
                                <span class="px-2.5 py-1.5 rounded-lg bg-gray-50 text-gray-500 text-[9px] font-black uppercase tracking-wider border border-gray-200">{{ $magang->status_magang }}</span>
                            @endif
                        </td>
                        <td class="pr-8 text-right">
                             <div class="flex flex-col items-end gap-1.5">
                                 <div class="flex items-center justify-between w-24">
                                     <span class="text-[9px] font-black text-gray-900 uppercase tracking-widest">Progress</span>
                                     <span class="text-[10px] font-black text-gray-700">
                                         @if($magang->status_magang === 'Selesai') 100%
                                         @elseif($magang->status_magang === 'Aktif') 65%
                                         @elseif($magang->status_magang === 'Terverifikasi') 25%
                                         @else 5% @endif
                                     </span>
                                 </div>
                                 <div class="w-24 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                     <div class="h-full @if($magang->status_magang === 'Selesai') bg-[#6B21A8] @elseif($magang->status_magang === 'Aktif') bg-green-500 @else bg-orange-400 @endif rounded-full" 
                                          style="width: @if($magang->status_magang === 'Selesai') 100% @elseif($magang->status_magang === 'Aktif') 65% @elseif($magang->status_magang === 'Terverifikasi') 25% @else 5% @endif"></div>
                                 </div>
                             </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <p class="text-[10px] font-black text-gray-900 uppercase tracking-[0.15em]">Menampilkan {{ $magangs->count() }} entri pendaftaran magang</p>
        </div>
    </div>

</div>
@endsection
