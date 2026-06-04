@extends('layouts.app')

@section('title', 'Review Logbook Mahasiswa')

@section('header')
<x-page-header 
    title="Logbook Monitor 📑" 
    subtitle="Pantau aktivitas harian dan progres pekerjaan mahasiswa bimbingan Anda secara real-time."
/>
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
            <div class="p-4 space-y-3 max-h-[600px] overflow-y-auto custom-scrollbar" id="studentSelector">
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
                    <table class="table table-lg w-full">
                        <thead>
                            <tr class="text-gray-400 font-extrabold text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                                <th class="py-6 pl-10">Tanggal</th>
                                <th>Aktivitas / Kegiatan</th>
                                <th class="text-right pr-10">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="allLogsTableBody" class="divide-y divide-gray-50">
                            {{-- Diisi via JS --}}
                        </tbody>
                    </table>
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

let currentStudentId = students.length > 0 ? students[0].id : null;

// fungsi untuk menampilkan daftar mahasiswa pada panel pemilih mahasiswa
function renderStudents() {
    const container = document.getElementById('studentSelector');
    container.innerHTML = '';
    students.forEach(s => {
        const isActive = s.id === currentStudentId;
        const colors = [ 'bg-purple-100 text-[#6B21A8]', 'bg-orange-100 text-[#F49E0A]', 'bg-blue-100 text-blue-600' ];
        const avatarStyle = colors[s.id % colors.length];

        container.innerHTML += `
            <div onclick="selectStudent(${s.id})" class="p-5 rounded-2xl flex items-center gap-4 cursor-pointer transition-all border-2 ${isActive ? 'bg-purple-50 border-[#6B21A8] shadow-lg shadow-purple-100' : 'bg-white border-transparent hover:border-gray-100 hover:bg-gray-50 group'}">
                <div class="w-12 h-12 rounded-2xl ${avatarStyle} flex items-center justify-center font-black text-xs group-hover:rotate-6 transition-all shrink-0">${s.name[0]}</div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-900 truncate tracking-tight ${isActive ? 'text-[#6B21A8]' : ''}">${s.name}</p>
                    <p class="text-[9px] font-medium text-gray-400 tracking-wide mt-1 uppercase">${s.nim}</p>
                </div>
            </div>
        `;
    });
}

// fungsi untuk memilih mahasiswa dan menampilkan logbook yang sesuai
function selectStudent(id) {
    currentStudentId = id;
    const student = students.find(s => s.id === id);
    if(student) {
        document.getElementById('activeStudentName').innerText = student.name;
        document.getElementById('activeStudentNim').innerText = 'NIM: ' + student.nim;
        document.getElementById('activeAvatar').innerText = student.name[0];
        renderStudents();
        renderLogs();
    }
}

// fungsi untuk menampilkan daftar logbook dari mahasiswa yang sedang dipilih
function renderLogs() {
    const logs = mockLogs[currentStudentId] || [];
    const allLogsTableBody = document.getElementById('allLogsTableBody');
    allLogsTableBody.innerHTML = '';
    
    if(logs.length === 0) {
        allLogsTableBody.innerHTML = '<tr><td colspan="3" class="text-center py-20 text-[10px] font-black text-gray-300 uppercase italic tracking-widest">Belum ada aktivitas yang dicatat</td></tr>';
        return;
    }
    
    logs.forEach((l, idx) => {
        allLogsTableBody.innerHTML += `
            <tr class="hover:bg-gray-50/50 transition-all group">
                <td class="font-black text-[10px] text-gray-400 uppercase tracking-[0.2em] py-6 pl-10 border-b border-gray-50">${l.date}</td>
                <td class="font-bold text-sm text-gray-700 italic border-b border-gray-50">
                    <div class="max-w-md truncate group-hover:text-gray-900 transition-colors">${l.desc}</div>
                </td>
                <td class="text-right pr-10 border-b border-gray-50">
                    <button onclick="showDetail(${currentStudentId}, ${idx})" class="btn btn-ghost btn-sm text-[#6B21A8] font-black uppercase text-[9px] tracking-widest hover:bg-purple-50 rounded-2xl">Lihat Detail →</button>
                </td>
            </tr>
        `;
    });
}

// fungsi untuk menampilkan detail logbook pada modal berdasarkan indeks log yang dipilih
function showDetail(studentId, logIndex) {
    const log = mockLogs[studentId][logIndex];
    document.querySelector('#log_detail_modal h3').innerText = log.date.toUpperCase();
    document.getElementById('detailDesc').innerText = log.desc;
    document.getElementById('log_detail_modal').showModal();
}

// Init
if(currentStudentId) selectStudent(currentStudentId);
</script>
@endpush
