@php use App\Services\EditRequestService; @endphp

@extends('layouts.app')

@section('title', 'Permintaan Edit Data Mahasiswa')

@section('header')
<x-page-header 
    title="Permintaan Edit Data ✏️" 
    subtitle="Kelola permintaan perubahan data mahasiswa yang membutuhkan persetujuan Anda."
/>
@endsection

@section('content')
<div class="space-y-8 font-sans">

    {{-- Permintaan Pending --}}
    <x-card padding="none" border>
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-2 h-8 bg-amber-400 rounded-full"></div>
                <h3 class="font-black text-gray-800 text-lg tracking-tight">Permintaan Baru</h3>
            </div>
            <span class="badge bg-amber-50 text-amber-600 border-none text-[10px] font-black px-4 py-2">{{ $permintaan->count() }} menunggu</span>
        </div>

        @if($permintaan->isEmpty())
            <div class="p-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">Tidak ada permintaan pending</p>
            </div>
        @else
            <div class="divide-y divide-gray-100">
                @foreach($permintaan as $item)
                @php $label = $item->field === 'anggota_kelompok' ? 'Anggota Kelompok' : EditRequestService::getFieldLabel($item->field); @endphp
                <div class="p-8 hover:bg-gray-50/50 transition-all">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div class="flex items-start gap-5 flex-1 min-w-0">
                            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-primary font-black flex items-center justify-center text-sm shrink-0">
                                {{ strtoupper(substr($item->mahasiswa->nama ?? '--', 0, 2)) }}
                            </div>
                            <div class="flex-1 min-w-0 space-y-1">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <h4 class="font-black text-gray-800 text-sm">{{ $item->mahasiswa->nama ?? 'Unknown' }}</h4>
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">{{ $item->mahasiswa->nim ?? '-' }}</span>
                                    @if($item->target_type === 'magang')
                                        <span class="badge bg-blue-50 text-blue-600 border-none text-[7px] font-black uppercase tracking-widest px-2 py-1">Data Perusahaan</span>
                                    @endif
                                </div>

                                @if($item->field === 'anggota_kelompok')
                                    @php $meta = json_decode($item->metadata, true); @endphp
                                    <div class="text-xs font-bold text-gray-700 space-y-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] text-gray-400 uppercase tracking-wider">Anggota Saat Ini:</span>
                                            <span class="text-gray-500">
                                                @if($meta && isset($meta['old_anggota']))
                                                    @foreach($meta['old_anggota'] as $a)
                                                        <span class="inline-block bg-gray-100 rounded-lg px-2 py-0.5 text-[10px]">{{ $a['nim'] }} ({{ $a['nama'] }})</span>
                                                    @endforeach
                                                @else
                                                    -
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] text-gray-400 uppercase tracking-wider">Diminta:</span>
                                            <span class="text-primary font-black">
                                                @if($meta && isset($meta['new_nims']))
                                                    @foreach($meta['new_nims'] as $nim)
                                                        <span class="inline-block bg-purple-50 rounded-lg px-2 py-0.5 text-[10px] text-primary">{{ $nim }}</span>
                                                    @endforeach
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center gap-4 text-xs font-bold">
                                        <span class="text-gray-400 uppercase tracking-wider text-[10px]">{{ $label }}</span>
                                        <span class="text-gray-400">→</span>
                                        <span class="text-primary">{{ $item->new_value }}</span>
                                    </div>
                                @endif

                                <p class="text-[10px] text-gray-400 italic font-medium">
                                    Alasan: {{ $item->alasan }}
                                </p>
                                <p class="text-[9px] text-gray-300 font-bold">
                                    Diajukan: {{ $item->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-2 shrink-0">
                            <button onclick="openModalApprove{{ $item->id }}()" class="btn h-11 px-5 bg-green-50 hover:bg-green-100 text-green-600 border border-green-100 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all active:scale-95">
                                Setujui
                            </button>
                            <button onclick="openModalReject{{ $item->id }}()" class="btn h-11 px-5 bg-red-50 hover:bg-red-100 text-red-600 border border-red-100 rounded-xl text-[9px] font-black uppercase tracking-widest transition-all active:scale-95">
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Modal Approve --}}
                <x-modal id="approve_{{ $item->id }}" title="Setujui Perubahan Data" subtitle="VERIFIKASI OPERATOR" color="purple" size="md">
                    <div class="space-y-6">
                        <div class="bg-green-50 border-2 border-green-200 rounded-2xl p-5">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-green-100 text-green-600 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-black text-green-800 text-sm">Konfirmasi Persetujuan</h4>
                                    @if($item->field === 'anggota_kelompok')
                                        @php $meta = json_decode($item->metadata, true); @endphp
                                        <p class="text-xs font-medium text-green-700 mt-1">
                                            Anda akan menyetujui perubahan <strong>Anggota Kelompok</strong> 
                                            mahasiswa <strong>{{ $item->mahasiswa->nama ?? '-' }}</strong>.
                                            Anggota baru: <strong>{{ $meta ? implode(', ', $meta['new_nims']) : $item->new_value }}</strong>
                                        </p>
                                    @else
                                        <p class="text-xs font-medium text-green-700 mt-1">
                                            Anda akan mengubah <strong>{{ $label }}</strong> 
                                            @if($item->target_type === 'magang')
                                                pada data perusahaan magang
                                            @endif
                                            mahasiswa <strong>{{ $item->mahasiswa->nama ?? '-' }}</strong> 
                                            dari <strong>{{ $item->old_value }}</strong> menjadi <strong>{{ $item->new_value }}</strong>.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('operator.edit_requests.approve', $item) }}" method="POST">
                            @csrf
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Catatan (opsional)</label>
                                <textarea name="catatan" rows="2" class="textarea w-full bg-gray-50 border-gray-100 rounded-xl text-sm font-bold" placeholder="Tambahkan catatan jika perlu..."></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <button type="button" onclick="closeModalApprove{{ $item->id }}()" class="btn h-14 px-8 bg-white border-2 border-gray-100 text-gray-700 hover:bg-gray-50 rounded-2xl text-[10px] font-black uppercase tracking-widest w-full">
                                    Batal
                                </button>
                                <button type="submit" class="btn h-14 px-8 bg-green-600 hover:bg-green-700 text-white border-none rounded-2xl text-[10px] font-black uppercase tracking-widest w-full shadow-lg transition-all active:scale-95">
                                    Ya, Setujui
                                </button>
                            </div>
                        </form>
                    </div>
                </x-modal>

                {{-- Modal Reject --}}
                <x-modal id="reject_{{ $item->id }}" title="Tolak Perubahan Data" subtitle="VERIFIKASI OPERATOR" color="dark" size="md">
                    <div class="space-y-6">
                        <div class="bg-red-50 border-2 border-red-200 rounded-2xl p-5">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </div>
                                <div>
                                    <h4 class="font-black text-red-800 text-sm">Konfirmasi Penolakan</h4>
                                    <p class="text-xs font-medium text-red-700 mt-1">
                                        Anda akan menolak permintaan perubahan <strong>{{ $label }}</strong> 
                                        oleh <strong>{{ $item->mahasiswa->nama ?? '-' }}</strong>.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('operator.edit_requests.reject', $item) }}" method="POST">
                            @csrf
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Catatan <span class="text-red-500">*</span></label>
                                <textarea name="catatan" rows="2" class="textarea w-full bg-gray-50 border-gray-100 rounded-xl text-sm font-bold" placeholder="Berikan alasan penolakan..." required></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-6">
                                <button type="button" onclick="closeModalReject{{ $item->id }}()" class="btn h-14 px-8 bg-white border-2 border-gray-100 text-gray-700 hover:bg-gray-50 rounded-2xl text-[10px] font-black uppercase tracking-widest w-full">
                                    Batal
                                </button>
                                <button type="submit" class="btn h-14 px-8 bg-red-500 hover:bg-red-600 text-white border-none rounded-2xl text-[10px] font-black uppercase tracking-widest w-full shadow-lg transition-all active:scale-95">
                                    Ya, Tolak
                                </button>
                            </div>
                        </form>
                    </div>
                </x-modal>
                @endforeach
            </div>
        @endif
    </x-card>

    {{-- Riwayat Diproses --}}
    <x-card padding="none" border>
        <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-2 h-8 bg-gray-400 rounded-full"></div>
                <h3 class="font-black text-gray-800 text-lg tracking-tight">Riwayat Diproses</h3>
            </div>
        </div>

        @if($riwayat->isEmpty())
            <div class="p-12 text-center">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">Belum ada riwayat</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="table w-full border-collapse">
                    <thead>
                        <tr class="text-gray-400 text-[9px] font-black uppercase tracking-widest bg-gray-50/30 border-b border-gray-100">
                            <th class="pl-8 py-4">Mahasiswa</th>
                            <th>Field</th>
                            <th>Nilai Lama</th>
                            <th>Nilai Baru</th>
                            <th>Status</th>
                            <th class="pr-8">Diproses</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($riwayat as $item)
                        @php $label = $item->field === 'anggota_kelompok' ? 'Anggota Kelompok' : EditRequestService::getFieldLabel($item->field); @endphp
                        <tr class="hover:bg-gray-50 transition-all">
                            <td class="pl-8 py-4">
                                <div class="font-bold text-gray-800 text-sm">{{ $item->mahasiswa->nama ?? '-' }}</div>
                                <div class="text-[10px] text-gray-400">{{ $item->mahasiswa->nim ?? '-' }}</div>
                            </td>
                            <td class="text-xs font-bold text-gray-700">{{ $label }}</td>
                            <td class="text-xs font-medium text-gray-400">
                                @if($item->field === 'anggota_kelompok')
                                    @php $oldNims = json_decode($item->old_value, true); @endphp
                                    {{ is_array($oldNims) ? implode(', ', $oldNims) : $item->old_value }}
                                @else
                                    {{ $item->old_value }}
                                @endif
                            </td>
                            <td class="text-xs font-bold text-primary">
                                @if($item->field === 'anggota_kelompok')
                                    @php $newNims = json_decode($item->new_value, true); @endphp
                                    {{ is_array($newNims) ? implode(', ', $newNims) : $item->new_value }}
                                @else
                                    {{ $item->new_value }}
                                @endif
                            </td>
                            <td>
                                @if($item->status === 'approved')
                                    <span class="badge bg-green-50 text-green-600 border-none text-[8px] font-black uppercase tracking-widest px-3 py-2">Disetujui</span>
                                @else
                                    <span class="badge bg-red-50 text-red-600 border-none text-[8px] font-black uppercase tracking-widest px-3 py-2">Ditolak</span>
                                @endif
                            </td>
                            <td class="pr-8">
                                <div class="text-[10px] font-bold text-gray-500">{{ $item->processor->name ?? '-' }}</div>
                                <div class="text-[9px] text-gray-400">{{ $item->processed_at ? $item->processed_at->format('d M Y, H:i') : '-' }}</div>
                                @if($item->catatan_operator)
                                    <div class="text-[9px] text-gray-400 italic mt-1">"{{ $item->catatan_operator }}"</div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-8 py-4 border-t border-gray-100 bg-gray-50/30">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Menampilkan 20 riwayat terakhir</p>
            </div>
        @endif
    </x-card>

</div>
@endsection
