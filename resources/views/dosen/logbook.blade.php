@extends('layouts.app')

@section('title', 'Review Logbook Mahasiswa')

@section('header')
<x-page-header 
    title="Logbook Monitor 📑" 
    subtitle="Pantau aktivitas harian dan progres pekerjaan mahasiswa bimbingan Anda secara real-time."
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard/dosen" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li>
    <li>Review Logbook</li>
  </ul>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    
    {{-- Sidebar: List Mahasiswa --}}
    <div class="lg:col-span-1 space-y-4">
        <x-card padding="none" border class="overflow-hidden">
            <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-xs uppercase tracking-widest">Daftar Bimbingan</h3>
                <span class="badge badge-primary font-bold text-[10px] py-3 px-3">{{ $mhsBimbingan->count() }}</span>
            </div>
            <div class="px-4 pb-3">
                <x-search-input id="searchStudent" name="searchStudent" placeholder="Cari nama atau NIM..." class="w-full" />
            </div>
            <div class="p-4 pt-0 space-y-3 max-h-[600px] overflow-y-auto custom-scrollbar" id="studentSelector">
                {{-- Diisi via JS --}}
            </div>
        </x-card>
    </div>

    {{-- Main: Logbook Timeline --}}
    <div class="lg:col-span-3">
        <x-card padding="none" border class="overflow-hidden min-h-[600px]">
            <div id="logHeader" class="p-8 md:p-10 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div id="activeAvatar" class="w-20 h-20 rounded-2xl bg-[#6B21A8] text-white flex items-center justify-center font-black text-3xl shadow-2xl shadow-purple-200">?</div>
                    <div>
                        <h3 id="activeStudentName" class="text-2xl font-bold text-gray-800 leading-tight">Memuat...</h3>
                        <p id="activeStudentNim" class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mt-1">NIM: -</p>
                    </div>
                </div>
            </div>

            <div class="p-0 overflow-x-auto custom-scrollbar">
                <div class="min-w-[800px] md:min-w-full">
                    <table class="table w-full">
                        <thead>
                            <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                                <th class="py-5 pl-8">Tanggal</th>
                                <th>Aktivitas / Kegiatan</th>
                                <th class="text-right pr-8">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="allLogsTableBody" class="divide-y divide-gray-100">
                            {{-- Diisi via JS --}}
                        </tbody>
                    </table>
                    <div id="logPagination" class="flex items-center justify-end px-10 py-5 border-t border-gray-100 bg-gray-50/30">
                    </div>
                </div>
            </div>
        </x-card>
    </div>
</div>

{{-- Detail Modal --}}
<x-modal id="log_detail_modal" color="purple" subtitle="Detail Aktivitas Harian" title="TANGGAL" size="2xl">
    <div>
        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 italic px-1">Isi Kegiatan / Pekerjaan</p>
        <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-inner">
            <p id="detailDesc" class="text-base font-bold text-gray-700 leading-relaxed italic whitespace-pre-wrap">Konten kegiatan...</p>
        </div>
    </div>
    <x-button variant="ghost" size="lg" :full="true" onclick="document.getElementById('log_detail_modal').close()">Tutup Jendela</x-button>
</x-modal>
@endsection



@push('scripts')
<script>
const students = @json($mhsBimbingan->map(function($magang) {
    $mhs = $magang->peserta->first() ? $magang->peserta->first()->mahasiswa : null;
    return [
        'id' => $magang->id,
        'name' => $mhs ? $mhs->nama : 'N/A',
        'nim' => $mhs ? $mhs->nim : 'N/A'
    ];
}));

const mockLogs = @json($mhsBimbingan->mapWithKeys(function($magang) {
    return [
        $magang->id => $magang->logbooks->map(function($log) {
            return [
                'date' => \Carbon\Carbon::parse($log->tanggal)->format('d M Y'),
                'desc' => $log->kegiatan
            ];
        })
    ];
}));

function getInitials(name) {
    var parts = name.split(' ');
    if (parts.length > 1) return (parts[0][0] + parts[1][0]).toUpperCase();
    return name.substring(0, 2).toUpperCase();
}

let currentStudentId = students.length > 0 ? students[0].id : null;
let currentLogPage = 1;
const logsPerPage = 10;

function getFilteredStudents() {
    var q = document.getElementById('searchStudent');
    if (!q || !q.value) return students;
    var filter = q.value.toLowerCase();
    return students.filter(function(s) {
        return s.name.toLowerCase().includes(filter) || s.nim.toLowerCase().includes(filter);
    });
}

function renderStudents() {
    var filtered = getFilteredStudents();
    const container = document.getElementById('studentSelector');
    container.innerHTML = '';
    if (filtered.length === 0) {
        container.innerHTML = '<div class="p-6 text-center"><p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Tidak ditemukan</p></div>';
        return;
    }
    filtered.forEach(s => {
        const isActive = s.id === currentStudentId;
        const colors = [ 'bg-purple-100 text-[#6B21A8]', 'bg-orange-100 text-[#F49E0A]', 'bg-blue-100 text-blue-600' ];
        const avatarStyle = colors[s.id % colors.length];

        container.innerHTML += `
            <div onclick="selectStudent(${s.id})" class="p-5 rounded-2xl flex items-center gap-4 cursor-pointer transition-all border-2 ${isActive ? 'bg-purple-50 border-[#6B21A8] shadow-lg shadow-purple-100' : 'bg-white border-transparent hover:border-gray-100 hover:bg-gray-50 group'}">
                <div class="w-12 h-12 rounded-2xl ${avatarStyle} flex items-center justify-center font-black text-xs group-hover:rotate-6 transition-all shrink-0">${getInitials(s.name)}</div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-900 truncate tracking-tight ${isActive ? 'text-[#6B21A8]' : ''}">${s.name}</p>
                    <p class="text-[9px] font-medium text-gray-400 tracking-wide mt-1 uppercase">${s.nim}</p>
                </div>
            </div>
        `;
    });
}

function selectStudent(id) {
    currentStudentId = id;
    currentLogPage = 1;
    const student = students.find(s => s.id === id);
    if(student) {
        document.getElementById('activeStudentName').innerText = student.name;
        document.getElementById('activeStudentNim').innerText = 'NIM: ' + student.nim;
        document.getElementById('activeAvatar').innerText = student.name[0];
        renderStudents();
        renderLogs();
    }
}

function renderLogs() {
    const logs = mockLogs[currentStudentId] || [];
    const allLogsTableBody = document.getElementById('allLogsTableBody');
    allLogsTableBody.innerHTML = '';
    
    if(logs.length === 0) {
        allLogsTableBody.innerHTML = '<tr><td colspan="3" class="text-center py-20 text-[10px] font-medium text-gray-400 uppercase italic tracking-widest">Belum ada aktivitas yang dicatat</td></tr>';
        renderLogPagination(0);
        return;
    }

    const totalPages = Math.ceil(logs.length / logsPerPage) || 1;
    const start = (currentLogPage - 1) * logsPerPage;
    const end = start + logsPerPage;
    const pageLogs = logs.slice(start, end);
    
    pageLogs.forEach((l, idx) => {
        const globalIdx = start + idx;
        allLogsTableBody.innerHTML += `
            <tr class="hover:bg-gray-50 transition-all group">
                <td class="font-black text-[10px] text-gray-400 uppercase tracking-[0.2em] py-5 pl-8">${l.date}</td>
                <td class="font-bold text-sm text-gray-700 italic">
                    <div class="max-w-md truncate group-hover:text-gray-900 transition-colors">${l.desc}</div>
                </td>
                <td class="text-right pr-8">
                    <button onclick="showDetail(${currentStudentId}, ${globalIdx})" class="btn btn-ghost border-none h-9 px-4 text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95 !text-[#6B21A8] hover:!bg-purple-50">Lihat Detail →</button>
                </td>
            </tr>
        `;
    });
    
    renderLogPagination(logs.length);
}

function renderLogPagination(total) {
    const container = document.getElementById('logPagination');
    if (!container) return;
    container.innerHTML = '';

    if (total === 0) return;

    const totalPages = Math.ceil(total / logsPerPage) || 1;
    if (totalPages <= 1) return;

    const info = document.createElement('span');
    info.className = 'text-[11px] font-bold text-gray-400 tracking-wide mr-3';
    const start = (currentLogPage - 1) * logsPerPage + 1;
    const end = Math.min(currentLogPage * logsPerPage, total);
    info.innerText = `${start}-${end} dari ${total}`;
    container.appendChild(info);

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement('button');
        const isActive = i === currentLogPage;
        btn.className = `btn btn-sm h-9 min-w-[2.25rem] rounded-2xl px-3 font-black text-xs transition-all active:scale-95 ${
            isActive
            ? 'bg-[#6B21A8] text-white shadow-lg shadow-purple-200 cursor-default'
            : 'bg-white border border-gray-100 text-gray-600 hover:text-[#6B21A8] hover:bg-gray-50 shadow-sm hover:shadow-md hover:shadow-purple-200/30 cursor-pointer'
        }`;
        btn.innerText = i;
        if (!isActive) {
            btn.onclick = () => {
                currentLogPage = i;
                renderLogs();
            };
        }
        container.appendChild(btn);
    }
}

function showDetail(studentId, logIndex) {
    const log = mockLogs[studentId][logIndex];
    document.querySelector('#log_detail_modal h3').innerText = log.date.toUpperCase();
    document.getElementById('detailDesc').innerText = log.desc;
    document.getElementById('log_detail_modal').showModal();
}

if(currentStudentId) selectStudent(currentStudentId);

document.getElementById('searchStudent')?.addEventListener('input', renderStudents);
</script>
@endpush
