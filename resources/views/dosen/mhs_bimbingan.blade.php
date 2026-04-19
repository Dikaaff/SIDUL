@extends('layouts.app')

@section('title', 'Daftar Mahasiswa Bimbingan')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#F49E0A] p-8 rounded-[2.5rem] shadow-lg mt-2 relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl transition-all duration-1000"></div>
    <div class="z-10 relative">
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">Mahasiswa Bimbingan</h2>
        <p class="text-white/80 mt-1 text-sm font-bold uppercase tracking-widest text-[10px]">Pantau progres harian dan logbook mahasiswa bimbingan Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-base-200 shadow-sm">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">
                    <th class="py-6 px-4">Nama Tim / Mahasiswa</th>
                    <th class="py-6 px-4">Instansi</th>
                    <th class="py-6 px-4 text-center">Logbook</th>
                    <th class="py-6 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($bimbingans as $magang)
                <tr class="hover:bg-orange-50/30 transition-colors group">
                    <td class="py-6 px-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs font-black text-orange-600 uppercase tracking-widest mb-1 italic">KODE: {{ $magang->kode_magang }}</span>
                            @foreach($magang->peserta as $p)
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-6 h-6 rounded-lg bg-gray-100 flex items-center justify-center text-[8px] font-black">{{ $loop->iteration }}</div>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-tight">{{ $p->mahasiswa->user->name }}</span>
                                    <span class="text-[9px] text-gray-400 font-bold tracking-widest uppercase">({{ $p->mahasiswa->nim }})</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-6 px-4">
                        <h4 class="font-black text-gray-800 text-sm uppercase tracking-tight leading-none mb-1">{{ $magang->instansi_nama }}</h4>
                        <p class="text-[10px] text-gray-400 font-bold tracking-wide leading-tight truncate max-w-xs">{{ $magang->instansi_alamat }}</p>
                    </td>
                    <td class="py-6 px-4 text-center">
                        <div class="flex flex-col items-center gap-1">
                            <span class="text-xl font-black text-gray-800">{{ $magang->logbooks()->count() }}</span>
                            <span class="text-[9px] font-black uppercase tracking-widest text-gray-400">Entri</span>
                        </div>
                    </td>
                    <td class="py-6 px-4 text-right">
                        <a href="#" class="btn btn-sm bg-[#F49E0A] hover:bg-orange-600 text-white rounded-xl font-black uppercase tracking-widest text-[9px] px-5 py-2 h-auto min-h-0 border-none shadow-lg shadow-orange-900/10 active:scale-95 transition-all">Lihat Logbook</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center font-bold text-gray-300 uppercase tracking-widest text-xs">Belum ada kelompok magang yang dibimbing.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
