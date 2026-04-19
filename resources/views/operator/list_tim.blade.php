@extends('layouts.app')

@section('title', 'Daftar Tim Magang')

@section('header')
<div class="bg-[#1E293B] text-white p-8 rounded-[2.5rem] shadow-lg mt-2 relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-64 h-64 bg-primary/20 rounded-full blur-3xl transition-all duration-1000"></div>
    <div class="z-10 relative">
        <h2 class="text-3xl font-black italic uppercase tracking-tighter">Database Tim Magang</h2>
        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em] mt-1">Seluruh Data Pendaftaran Terintegrasi.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">
                    <th class="py-6 px-4">KODE / TIM</th>
                    <th class="py-6 px-4">Instansi & Alamat</th>
                    <th class="py-6 px-4 text-center">Periode</th>
                    <th class="py-6 px-4 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($tims as $magang)
                <tr class="hover:bg-slate-50 transition-colors group border-b border-gray-50 last:border-0">
                    <td class="py-6 px-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-black text-primary uppercase tracking-widest italic mb-1">{{ $magang->kode_magang }}</span>
                            @foreach($magang->peserta as $p)
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-tight">{{ $p->mahasiswa->user->name }}</span>
                                    <span class="text-[9px] text-gray-400 font-black tracking-widest uppercase">({{ $p->mahasiswa->nim }})</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-6 px-4">
                        <h4 class="font-black text-gray-800 text-sm uppercase tracking-tight leading-none mb-2">{{ $magang->instansi_nama }}</h4>
                        <p class="text-[10px] text-gray-400 font-bold leading-tight max-w-xs">{{ $magang->instansi_alamat }}</p>
                    </td>
                    <td class="py-6 px-4 text-center">
                        <p class="text-[10px] font-black text-gray-800 uppercase tracking-widest">{{ \Carbon\Carbon::parse($magang->tanggal_mulai)->format('d M Y') }}</p>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] my-1">- SAMPAI -</p>
                        <p class="text-[10px] font-black text-gray-800 uppercase tracking-widest">{{ \Carbon\Carbon::parse($magang->tanggal_selesai)->format('d M Y') }}</p>
                    </td>
                    <td class="py-6 px-4 text-right">
                        <span class="badge py-3 px-4 {{ $magang->status_magang === 'Active' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-orange-50 text-orange-600 border-orange-100' }} font-black text-[9px] uppercase tracking-widest rounded-lg border-2">
                            {{ $magang->status_magang }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center font-bold text-gray-300 uppercase tracking-widest text-xs italic">Belum ada data pendaftaran magang.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
