@extends('layouts.app')

@section('title', 'List Mahasiswa Wali')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-8 rounded-[2.5rem] shadow-lg mt-2 relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl transition-all duration-1000"></div>
    <div class="z-10 relative">
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">Mahasiswa Wali</h2>
        <p class="text-white/80 mt-1 text-sm font-bold uppercase tracking-widest text-[10px]">Berikan rekomendasi kepada mahasiswa yang akan mendaftar magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-base-200 shadow-sm">
    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">
                    <th class="py-6 px-4">Nama Mahasiswa</th>
                    <th class="py-6 px-4 text-center">NIM</th>
                    <th class="py-6 px-4 text-center">Status Rekomendasi</th>
                    <th class="py-6 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($mhsWali as $mhs)
                <tr class="hover:bg-purple-50/50 transition-colors group">
                    <td class="py-6 px-4">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 text-[#6B21A8] flex items-center justify-center font-black text-xs">
                                {{ collect(explode(' ', $mhs->user->name))->map(fn($n) => $n[0])->take(2)->join('') }}
                            </div>
                            <div>
                                <h4 class="font-black text-gray-900 leading-tight uppercase tracking-tight">{{ $mhs->user->name }}</h4>
                                <p class="text-[10px] text-gray-400 font-bold tracking-widest uppercase mt-0.5">{{ $mhs->prodi }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-6 px-4 text-center font-bold text-gray-500 text-sm tracking-widest">{{ $mhs->nim }}</td>
                    <td class="py-6 px-4 text-center">
                        @if($mhs->status_rekomendasi === 'Approved' || $mhs->status_rekomendasi === 'Sudah Direkomendasikan')
                            <span class="badge py-3 px-4 bg-green-50 text-green-600 border-green-100 font-black text-[9px] uppercase tracking-widest rounded-lg">Approved</span>
                        @else
                            <span class="badge py-3 px-4 bg-orange-50 text-orange-600 border-orange-100 font-black text-[9px] uppercase tracking-widest rounded-lg italic">Pending</span>
                        @endif
                    </td>
                    <td class="py-6 px-4 text-right">
                        @if($mhs->status_rekomendasi !== 'Approved' && $mhs->status_rekomendasi !== 'Sudah Direkomendasikan')
                            <form action="{{ route('dosen.rekomendasikan', $mhs->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 text-white rounded-xl font-black uppercase tracking-widest text-[9px] px-5 py-2 h-auto min-h-0 border-none shadow-lg shadow-purple-900/10 active:scale-95 transition-all">Berikan Rekomendasi</button>
                            </form>
                        @else
                            <button disabled class="btn btn-sm bg-gray-50 text-gray-300 rounded-xl font-black uppercase tracking-widest text-[9px] px-5 py-2 h-auto min-h-0 border-none cursor-default">Sudah Diproses</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center font-bold text-gray-300 uppercase tracking-widest text-xs">Belum ada mahasiswa wali yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
