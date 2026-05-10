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
    
    <div class="flex flex-col xl:flex-row gap-6 items-stretch xl:items-center justify-between bg-white p-6 md:p-8 rounded-[2.5rem] border border-gray-100 shadow-sm transition-all hover:shadow-md">
            {{-- Unified Real-time Filter Form --}}
            <div class="flex flex-col md:flex-row flex-1 gap-4">
                <div class="relative flex-1 group">
                    <input type="text" id="realTimeSearch" placeholder="Cari Nama, NIM, atau Perusahaan secara instan..." class="input w-full pl-12 pr-4 h-12 bg-gray-50 border-gray-100 rounded-2xl text-xs font-bold focus:ring-4 focus:ring-primary/10 focus:bg-white transition-all group-hover:border-primary/30" />
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                </div>

                <div class="flex gap-3">
                    <select id="statusFilter" class="select select-md bg-gray-50 border-gray-100 rounded-xl text-[10px] font-black uppercase tracking-widest focus:ring-4 focus:ring-primary/10 transition-all w-full md:w-[180px]">
                        <option value="">Semua Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Ditolak">Ditolak</option>
                    </select>
                </div>
            </div>
        
        <div class="flex gap-3">
             <button onclick="exportToExcel()" class="btn h-12 flex-1 md:flex-none px-6 rounded-2xl border border-emerald-200 bg-emerald-50 text-emerald-600 font-black text-[10px] uppercase tracking-[0.2em] hover:bg-emerald-100 transition-all active:scale-95 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                Export Excel
             </button>
        </div>
    </div>

    {{-- Tabel Monitoring Global --}}
    {{-- Container Monitoring --}}
    <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
        {{-- Desktop View (Table) --}}
        <div class="hidden md:block overflow-x-auto custom-scrollbar">
            <table id="monitoringTable" class="table w-full border-collapse">
                <thead>
                    <tr class="text-gray-900 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/30 border-b border-gray-100 italic">
                        <th class="pl-8 py-6 w-16">No</th>
                        <th class="min-w-[220px]">Mahasiswa</th>
                        <th class="min-w-[180px]">Perusahaan</th>
                        <th class="min-w-[180px]">Pembimbing</th>
                        <th class="min-w-[140px]">ID Magang</th>
                        <th class="min-w-[120px]">Status</th>
                        <th class="pr-8 text-right min-w-[150px]">Progress</th>
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
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-[10px] shadow-inner group-hover:rotate-3 transition-transform">
                                    {{ strtoupper(substr($mhs->nama ?? 'MH', 0, 2)) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-black text-gray-800 text-sm tracking-tight leading-tight">{{ $mhs->nama }}</span>
                                    <span class="text-[10px] font-bold text-gray-400 mt-1 tracking-widest uppercase">{{ $mhs->nim }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-700 text-xs">{{ $magang->perusahaan }}</span>
                                <span class="badge badge-ghost border-gray-100 text-[8px] font-black uppercase tracking-widest px-2 py-2 mt-1 h-fit">{{ $magang->tipe_magang }}</span>
                            </div>
                        </td>
                        <td>
                            @if($magang->pembimbing)
                                <div class="font-black text-xs text-[#6B21A8] leading-tight">{{ $magang->pembimbing->nama }}</div>
                                <div class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">{{ $magang->pembimbing->nik ?? '-' }}</div>
                            @else
                                <span class="text-[9px] font-black text-red-400 uppercase tracking-widest italic">Belum Diplot</span>
                            @endif
                        </td>
                        <td>
                            <div class="px-3 py-1.5 bg-[#6B21A8] text-white rounded-xl text-[9px] font-black tracking-[0.1em] inline-block shadow-lg shadow-purple-200 border border-purple-800 group-hover:scale-105 transition-transform">
                                {{ $magang->kode_magang ?? 'UNASSIGNED' }}
                            </div>
                        </td>
                        <td>
                            @if($magang->status_magang === 'Aktif')
                                <span class="status-badge px-3 py-1.5 rounded-xl bg-green-50 text-green-600 text-[9px] font-black uppercase tracking-wider border border-green-100">Aktif</span>
                            @elseif($magang->status_magang === 'Pending')
                                <span class="status-badge px-3 py-1.5 rounded-xl bg-orange-50 text-[#F49E0A] text-[9px] font-black uppercase tracking-wider border border-orange-100">Pending</span>
                            @elseif($magang->status_magang === 'Selesai')
                                <span class="status-badge px-3 py-1.5 rounded-xl bg-purple-50 text-[#6B21A8] text-[9px] font-black uppercase tracking-wider border border-purple-100">Selesai</span>
                            @else
                                <span class="status-badge px-3 py-1.5 rounded-xl bg-gray-50 text-gray-500 text-[9px] font-black uppercase tracking-wider border border-gray-200">{{ $magang->status_magang }}</span>
                            @endif
                        </td>
                        <td class="pr-8 text-right">
                             @php
                                $mProgress = 20; // Start with 20% for having Magang record
                                if ($magang->logbooks_count > 0) $mProgress += 40;
                                if ($magang->laporan) {
                                    if ($magang->laporan->status === 'approved') {
                                        $mProgress += 40;
                                    } else {
                                        $mProgress += 10;
                                    }
                                }
                             @endphp
                             <div class="flex flex-col items-end gap-1.5">
                                 <div class="w-24 bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                     <div class="h-full @if($mProgress >= 100) bg-purple-600 @elseif($mProgress >= 60) bg-green-500 @else bg-orange-400 @endif rounded-full transition-all duration-1000" 
                                          style="width: {{ $mProgress }}%"></div>
                                 </div>
                                 <span class="text-[9px] font-black text-gray-400">
                                     {{ $mProgress }}%
                                 </span>
                             </div>
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="7" class="py-24 text-center">
                            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">Tidak ada data yang cocok dengan kriteria pencarian</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile View (Card List) --}}
        <div class="md:hidden space-y-3 p-4">
            @forelse($magangs as $index => $magang)
            @php $mhs = $magang->peserta->first()?->mahasiswa; @endphp
            @if($mhs)
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 shadow-sm active:bg-gray-50 transition-all flex flex-col gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-purple-50 text-[#6B21A8] font-black flex items-center justify-center text-xs shadow-inner">
                        {{ strtoupper(substr($mhs->nama ?? 'MH', 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="font-black text-gray-800 text-sm truncate">{{ $mhs->nama }}</h4>
                        <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase">{{ $mhs->nim }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 py-4 border-y border-gray-50">
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">ID Magang</p>
                        <p class="text-[10px] font-black text-gray-800 tracking-wider">{{ $magang->kode_magang ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                        <span class="text-[9px] font-black uppercase text-primary italic">{{ $magang->status_magang }}</span>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                    <div class="flex flex-col">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Perusahaan</p>
                        <p class="text-[10px] font-bold text-gray-700 leading-tight">{{ $magang->perusahaan }}</p>
                    </div>
                    <div class="w-16 bg-gray-100 rounded-full h-1 overflow-hidden">
                        <div class="h-full bg-primary" style="width: 65%"></div>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <div class="py-20 text-center">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic">Data tidak ditemukan</p>
            </div>
            @endforelse
        </div>
        
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/30 flex items-center justify-between">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.15em]">Menampilkan {{ $magangs->count() }} hasil pemantauan</p>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('realTimeSearch');
    const statusFilter = document.getElementById('statusFilter');

    function applyFilters() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusTerm = statusFilter.value.toLowerCase();
        const table = document.getElementById('monitoringTable');
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty row

            const text = row.innerText.toLowerCase();
            const statusBadge = row.querySelector('.status-badge');
            const status = statusBadge ? statusBadge.innerText.toLowerCase() : '';
            
            const matchesSearch = text.includes(searchTerm);
            const matchesStatus = statusTerm === '' || status.trim() === statusTerm.trim();

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    window.resetFilters = function() {
        searchInput.value = '';
        statusFilter.value = '';
        applyFilters();
    };

    window.exportToExcel = function() {
        const table = document.getElementById('monitoringTable');
        const rows = table.querySelectorAll('tr');
        let csv = [];
        
        // Header Khusus yang Rapi
        csv.push(["No", "Nama Mahasiswa", "NIM", "Perusahaan", "Dosen Pembimbing", "ID Magang", "Status", "Progress"].join(","));

        const dataRows = table.querySelectorAll('tbody tr');
        dataRows.forEach((tr, index) => {
            if (tr.style.display === 'none' || tr.querySelector('td[colspan]')) return;

            const cells = tr.querySelectorAll('td');
            const no = index + 1;
            const nama = cells[1].querySelector('.font-black').innerText.trim();
            const nim = cells[1].querySelector('.text-\\[10px\\]').innerText.trim();
            const perusahaan = cells[2].querySelector('.font-bold').innerText.trim();
            const pembimbing = cells[3].innerText.replace(/(\r\n|\n|\r)/gm, " ").trim();
            const idMagang = cells[4].innerText.trim();
            const status = cells[5].innerText.trim();
            const progress = cells[6].querySelector('.text-\\[9px\\]').innerText.trim();

            const rowData = [
                `"${no}"`,
                `"${nama}"`,
                `"${nim}"`,
                `"${perusahaan}"`,
                `"${pembimbing}"`,
                `"${idMagang}"`,
                `"${status}"`,
                `"${progress}"`
            ];
            csv.push(rowData.join(","));
        });
        
        const csvContent = "\uFEFF" + csv.join("\n"); // Add BOM for Excel UTF-8 support
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement("a");
        const url = URL.createObjectURL(blob);
        
        link.setAttribute("href", url);
        link.setAttribute("download", "Monitoring_Magang_" + new Date().toISOString().slice(0,10) + ".csv");
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    };

    searchInput.addEventListener('input', applyFilters);
    statusFilter.addEventListener('change', applyFilters);
});
</script>
@endsection
