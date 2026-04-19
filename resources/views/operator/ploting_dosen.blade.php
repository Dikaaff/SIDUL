@extends('layouts.app')

@section('title', 'Ploting Dosen Pembimbing')

@section('header')
<div class="bg-orange-500 text-white p-8 rounded-[2.5rem] shadow-lg mt-2 relative overflow-hidden">
    <div class="absolute -right-24 -top-24 w-64 h-64 bg-white/10 rounded-full blur-3xl transition-all duration-1000"></div>
    <div class="z-10 relative text-center md:text-left">
        <h2 class="text-3xl font-black italic uppercase tracking-tighter">Ploting Dosen Pembimbing 🎓</h2>
        <p class="text-[10px] text-orange-100 font-bold uppercase tracking-[0.3em] mt-1">Tentukan dosen pembimbing untuk tim magang yang masih pending.</p>
    </div>
</div>
@endsection

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 border-b border-gray-100">
                    <th class="py-6 px-4">TIM / MAHASISWA</th>
                    <th class="py-6 px-4">Instansi</th>
                    <th class="py-6 px-4 text-right">Aksi Ploting</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse($tims as $magang)
                <tr class="hover:bg-orange-50/30 transition-colors border-b border-gray-50 last:border-0">
                    <td class="py-6 px-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-black text-orange-600 uppercase tracking-widest italic mb-2">{{ $magang->kode_magang }}</span>
                            @foreach($magang->peserta as $p)
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-tight">{{ $p->mahasiswa->user->name }}</span>
                                    <span class="text-[9px] text-gray-400 font-black tracking-widest uppercase">({{ $p->mahasiswa->nim }})</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-6 px-4">
                        <h4 class="font-black text-gray-800 text-sm uppercase tracking-tight leading-none mb-1">{{ $magang->instansi_nama }}</h4>
                        <p class="text-[10px] text-gray-400 font-bold leading-tight">{{ $magang->instansi_alamat }}</p>
                    </td>
                    <td class="py-6 px-4 text-right">
                        <form action="{{ route('operator.ploting.store', $magang->id) }}" method="POST" class="flex flex-col sm:flex-row items-end sm:items-center justify-end gap-3">
                            @csrf
                            <select name="dosen_id" class="select select-bordered select-sm rounded-xl text-[10px] font-black uppercase tracking-widest bg-gray-50 border-gray-200 focus:bg-white focus:ring-2 focus:ring-orange-200 outline-none h-10 transition-all min-w-[200px]" required>
                                <option value="" disabled selected>Pilih Dosen</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->user->name }} (Kuota: {{ $dosen->kuota_bimbingan }})</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-sm bg-orange-600 hover:bg-orange-700 text-white rounded-xl font-black uppercase tracking-widest text-[9px] px-6 h-10 min-h-0 border-none shadow-lg shadow-orange-900/10 active:scale-95 transition-all">Plotting</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-20 text-center font-bold text-gray-300 uppercase tracking-widest text-xs italic">Semua tim sudah memiliki dosen pembimbing.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
