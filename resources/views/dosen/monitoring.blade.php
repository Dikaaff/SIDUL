@extends('layouts.app')

@section('title', 'Monitoring Magang')

@section('header')
<x-page-header 
    title="Monitoring Mahasiswa 📊" 
    subtitle="Pantau aktivitas magang mahasiswa bimbingan Anda secara realtime."
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/dosen" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Monitoring</li>
  </ul>
</div>
@endsection

@section('content')
<div class="space-y-6 font-sans">

    {{-- Search Card --}}
    <x-card padding="large" border class="flex flex-col xl:flex-row gap-6 items-stretch xl:items-center justify-between transition-all hover:shadow-md">
        <div class="flex flex-col md:flex-row flex-1 gap-4">
            <x-search-input 
                id="realTimeSearch"
                placeholder="Cari Nama, NIM, atau Perusahaan..."
                class="flex-1 h-12 bg-gray-50 border-gray-100 text-xs font-bold"
            />
            <div class="flex gap-3">
                <select id="statusFilter" class="select select-md bg-gray-50 border-gray-100 rounded-2xl text-[10px] font-black uppercase tracking-widest focus:ring-4 focus:ring-[#6B21A8]/10 transition-all w-full md:w-[180px]">
                    <option value="">Semua Status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Pending">Pending</option>
                    <option value="Selesai">Selesai</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
            </div>
        </div>
    </x-card>

    {{-- Table --}}
    <x-card padding="none" border class="overflow-hidden">
        {{-- Desktop --}}
        <div class="hidden md:block overflow-x-auto custom-scrollbar">
            <table id="monitoringTable" class="table w-full">
                <thead>
                    <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                        <th class="pl-8 py-5 w-16">No</th>
                        <th class="min-w-[220px]">Mahasiswa</th>
                        <th class="min-w-[180px]">Perusahaan</th>
                        <th class="min-w-[140px]">ID Magang</th>
                        <th class="min-w-[120px]">Status</th>
                        <th class="pr-8 text-right min-w-[150px]">Progress</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($mhsBimbingan as $index => $magang)
                    @php
                        $mhs = $magang->peserta->first()?->mahasiswa;
                        $progress = 0;
                        if ($magang) $progress += 20;
                        if ($magang->logbooks_count > 0) $progress += 40;
                        if ($magang->laporan) {
                            if ($magang->laporan->status === 'approved') {
                                $progress += 40;
                            } else {
                                $progress += 10;
                            }
                        }
                        if ($magang->status_magang === 'Selesai') $progress = 100;

                        $barColor = match(true) {
                            $progress >= 100 => 'bg-purple-600',
                            $progress >= 60 => 'bg-green-500',
                            default => 'bg-orange-400',
                        };

                        $nameParts = explode(' ', $mhs->nama ?? 'Mhs');
                        $initials = count($nameParts) > 1
                            ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                            : strtoupper(substr($nameParts[0], 0, 2));
                    @endphp
                    <tr class="hover:bg-gray-50 transition-all group">
                        <td class="pl-8 py-5 text-[10px] font-medium text-gray-400">
                            {{ str_pad($mhsBimbingan->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[8px] shadow-inner group-hover:rotate-3 transition-transform shrink-0">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col min-w-0">
                                    <span class="font-semibold text-gray-800 text-sm tracking-tight leading-tight truncate">{{ $mhs->nama ?? 'N/A' }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $mhs->nim ?? '-' }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-bold text-gray-700 text-xs">{{ $magang->perusahaan }}</span>
                        </td>
                        <td>
                            <div class="px-3 py-1.5 bg-[#6B21A8] text-white rounded-2xl text-[9px] font-black tracking-[0.1em] inline-block shadow-lg shadow-purple-200 border border-purple-800 group-hover:scale-105 transition-transform">
                                {{ $magang->kode_magang ?? 'UNASSIGNED' }}
                            </div>
                        </td>
                        <td>
                            @if($magang->status_magang === 'Aktif')
                                <span class="px-3 py-1.5 rounded-2xl bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-100">Aktif</span>
                            @elseif($magang->status_magang === 'Pending')
                                <span class="px-3 py-1.5 rounded-2xl bg-orange-50 text-[#F49E0A] text-[9px] font-black uppercase tracking-wider border border-orange-100">Pending</span>
                            @elseif($magang->status_magang === 'Selesai')
                                <span class="px-3 py-1.5 rounded-2xl bg-purple-50 text-[#6B21A8] text-[9px] font-black uppercase tracking-wider border border-purple-100">Selesai</span>
                            @elseif($magang->status_magang === 'Ditolak')
                                <span class="px-3 py-1.5 rounded-2xl bg-red-50 text-red-600 text-[9px] font-black uppercase tracking-wider border border-red-100">Ditolak</span>
                            @else
                                <span class="px-3 py-1.5 rounded-2xl bg-gray-50 text-gray-500 text-[9px] font-black uppercase tracking-wider border border-gray-200">{{ $magang->status_magang }}</span>
                            @endif
                        </td>
                        <td class="pr-8 text-right">
                            <div class="flex flex-col items-end gap-1.5">
                                <div class="w-24 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                    <div class="h-full {{ $barColor }} rounded-full transition-all duration-1000" style="width: {{ $progress }}%"></div>
                                </div>
                                <span class="text-[9px] font-black text-gray-400">{{ $progress }}%</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-24 text-center">
                            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Tidak ada data mahasiswa bimbingan</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile --}}
        <div class="md:hidden space-y-3 p-4">
            @forelse($mhsBimbingan as $magang)
            @php
                $mhs = $magang->peserta->first()?->mahasiswa;
                $progress = 0;
                if ($magang) $progress += 20;
                if ($magang->logbooks_count > 0) $progress += 40;
                if ($magang->laporan) {
                    if ($magang->laporan->status === 'approved') {
                        $progress += 40;
                    } else {
                        $progress += 10;
                    }
                }
                if ($magang->status_magang === 'Selesai') $progress = 100;

                $barColor = match(true) {
                    $progress >= 100 => 'bg-purple-600',
                    $progress >= 60 => 'bg-green-500',
                    default => 'bg-orange-400',
                };

                $nameParts = explode(' ', $mhs->nama ?? 'Mhs');
                $initials = count($nameParts) > 1
                    ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1))
                    : strtoupper(substr($nameParts[0], 0, 2));
            @endphp
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm active:bg-gray-50 transition-all flex flex-col gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs shadow-inner shrink-0">
                        {{ $initials }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $mhs->nama ?? 'N/A' }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $mhs->nim ?? '-' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 py-4 border-y border-gray-50">
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">ID Magang</p>
                        <p class="text-[10px] font-black text-gray-800 tracking-wider">{{ $magang->kode_magang ?? '-' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                        @if($magang->status_magang === 'Aktif')
                            <span class="inline-block px-2 py-1 rounded-2xl bg-green-50 text-green-600 text-[8px] font-black uppercase tracking-wider border border-green-100">Aktif</span>
                        @elseif($magang->status_magang === 'Pending')
                            <span class="inline-block px-2 py-1 rounded-2xl bg-orange-50 text-[#F49E0A] text-[8px] font-black uppercase tracking-wider border border-orange-100">Pending</span>
                        @elseif($magang->status_magang === 'Selesai')
                            <span class="inline-block px-2 py-1 rounded-2xl bg-purple-50 text-[#6B21A8] text-[8px] font-black uppercase tracking-wider border border-purple-100">Selesai</span>
                        @elseif($magang->status_magang === 'Ditolak')
                            <span class="inline-block px-2 py-1 rounded-2xl bg-red-50 text-red-600 text-[8px] font-black uppercase tracking-wider border border-red-100">Ditolak</span>
                        @else
                            <span class="inline-block px-2 py-1 rounded-2xl bg-gray-50 text-gray-500 text-[8px] font-black uppercase tracking-wider border border-gray-200">{{ $magang->status_magang }}</span>
                        @endif
                    </div>
                </div>

                <div>
                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Perusahaan</p>
                    <p class="text-xs font-bold text-gray-700">{{ $magang->perusahaan }}</p>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Progress</p>
                        <span class="text-[10px] font-black text-gray-700">{{ $progress }}%</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                        <div class="h-full {{ $barColor }} rounded-full" style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                <a href="{{ route('dosen.logbook') }}" class="block w-full text-center bg-amber-500 hover:bg-amber-600 text-white rounded-2xl py-3.5 text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-lg shadow-amber-200">
                    Buka Logbook →
                </a>
            </div>
            @empty
            <div class="py-16 text-center">
                <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Tidak ada data mahasiswa bimbingan</p>
            </div>
            @endforelse
        </div>
    </x-card>

    {{-- Pagination --}}
    <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/30">
        {{ $mhsBimbingan->appends(request()->query())->links('vendor.pagination.sidul') }}
    </div>

</div>

@push('scripts')
<script>
    // Client-side filter (works within current page)
    const searchInput = document.getElementById('realTimeSearch');
    const statusFilter = document.getElementById('statusFilter');
    const table = document.getElementById('monitoringTable');
    const rows = table?.querySelectorAll('tbody tr');

    function filterTable() {
        const q = searchInput?.value.toLowerCase() || '';
        const status = statusFilter?.value || '';
        rows?.forEach(row => {
            const text = row.textContent.toLowerCase();
            const matchSearch = !q || text.includes(q);
            const matchStatus = !status || text.includes(status.toLowerCase());
            row.style.display = (matchSearch && matchStatus) ? '' : 'none';
        });
    }

    searchInput?.addEventListener('keyup', filterTable);
    statusFilter?.addEventListener('change', filterTable);
</script>
@endpush
@endsection
