@extends('layouts.app')

@section('title', 'Review Logbook Mahasiswa')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2 italic">Logbook Monitor 📑</h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Pantau aktivitas harian dan progres pekerjaan mahasiswa bimbingan Anda secara real-time.</p>
        </div>
        <div class="flex gap-3 shrink-0">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-[10px] font-black uppercase tracking-widest">Aktivitas Terkini</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    
    {{-- Sidebar: List Mahasiswa --}}
    <div class="lg:col-span-1 space-y-4">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 bg-gray-50/50 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-black text-gray-800 text-xs uppercase tracking-widest">Daftar Bimbingan</h3>
                <span class="badge badge-primary font-black text-[10px] py-3 px-3">{{ $mhsBimbingan->count() }}</span>
            </div>
            <div class="p-4 space-y-3 max-h-[600px] overflow-y-auto custom-scrollbar" id="studentSelector">
                {{-- Diisi via JS --}}
            </div>
        </div>
    </div>

    {{-- Main: Logbook Timeline --}}
    <div class="lg:col-span-3">
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden min-h-[600px]">
            <div id="logHeader" class="p-8 md:p-10 border-b border-gray-100 bg-gray-50/30 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div id="activeAvatar" class="w-20 h-20 rounded-3xl bg-primary text-white flex items-center justify-center font-black text-3xl shadow-2xl shadow-purple-200">?</div>
                    <div>
                        <h3 id="activeStudentName" class="text-2xl font-black text-gray-800 italic leading-tight tracking-tighter">Memuat...</h3>
                        <p id="activeStudentNim" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mt-1 italic">NIM: -</p>
                    </div>
                </div>
            </div>

            <div class="p-0">
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
    </div>
</div>

{{-- Detail Modal --}}
<dialog id="log_detail_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box p-0 max-w-2xl bg-white rounded-[2.5rem] overflow-hidden border-none shadow-2xl">
        <div class="bg-gray-900 p-8 text-white flex items-center justify-between relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black text-white/50 uppercase tracking-[0.3em] mb-1 italic">Detail Aktivitas Harian</p>
                <h3 id="detailDate" class="text-2xl font-black italic tracking-tighter uppercase">25 MEI 2024</h3>
            </div>
            <form method="dialog" class="relative z-10">
                <button class="btn btn-sm btn-circle btn-ghost bg-white/10 hover:bg-white/20 border-none text-white">✕</button>
            </form>
        </div>
        <div class="p-10 -mt-8 bg-white rounded-[3rem] relative z-20 space-y-8">
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 italic px-1">Isi Kegiatan / Pekerjaan</p>
                <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 shadow-inner">
                    <p id="detailDesc" class="text-base font-bold text-gray-700 leading-relaxed italic whitespace-pre-wrap">Konten kegiatan...</p>
                </div>
            </div>
            <div class="flex gap-4">
                <button onclick="document.getElementById('log_detail_modal').close()" class="btn btn-ghost flex-1 h-14 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl hover:bg-gray-50">Tutup Jendela</button>
            </div>
        </div>
    </div>
</dialog>
@endsection

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
</style>
@endpush

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

function renderStudents() {
    const container = document.getElementById('studentSelector');
    container.innerHTML = '';
    students.forEach(s => {
        const isActive = s.id === currentStudentId;
        const colors = [ 'bg-purple-100 text-[#6B21A8]', 'bg-orange-100 text-[#F49E0A]', 'bg-blue-100 text-blue-600' ];
        const avatarStyle = colors[s.id % colors.length];

        container.innerHTML += `
            <div onclick="selectStudent(${s.id})" class="p-5 rounded-[2rem] flex items-center gap-4 cursor-pointer transition-all border-2 ${isActive ? 'bg-purple-50 border-primary shadow-lg shadow-purple-100' : 'bg-white border-transparent hover:border-gray-100 hover:bg-gray-50 group'}">
                <div class="w-12 h-12 rounded-2xl ${avatarStyle} flex items-center justify-center font-black text-xs group-hover:rotate-6 transition-all shrink-0">${s.name[0]}</div>
                <div class="overflow-hidden">
                    <p class="text-sm font-bold text-gray-900 truncate tracking-tight ${isActive ? 'text-primary' : ''}">${s.name}</p>
                    <p class="text-[9px] font-medium text-gray-400 tracking-wide mt-1 uppercase">${s.nim}</p>
                </div>
            </div>
        `;
    });
}

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
                    <button onclick="showDetail(${currentStudentId}, ${idx})" class="btn btn-ghost btn-sm text-[#6B21A8] font-black uppercase text-[9px] tracking-widest hover:bg-purple-50 rounded-xl">Lihat Detail →</button>
                </td>
            </tr>
        `;
    });
}

function showDetail(studentId, logIndex) {
    const log = mockLogs[studentId][logIndex];
    document.getElementById('detailDate').innerText = log.date.toUpperCase();
    document.getElementById('detailDesc').innerText = log.desc;
    document.getElementById('log_detail_modal').showModal();
}

// Init
if(currentStudentId) selectStudent(currentStudentId);
</script>
@endpush
