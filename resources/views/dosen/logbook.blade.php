@extends('layouts.app')

@section('title', 'Review Logbook Mahasiswa')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Review Logbook 📖
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Baca aktivitas harian mahasiswa bimbingan dan berikan komentar atau arahan.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Student List Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white p-6 rounded-[2rem] border border-base-200 shadow-sm">
            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2 italic">
                <div class="w-1.5 h-1.5 rounded-full bg-[#6B21A8]"></div>
                Mahasiswa Bimbingan
            </h3>
            
            <div id="studentSelector" class="space-y-3">
                <!-- Students will be rendered by JS -->
            </div>
        </div>
    </div>

    <!-- Logbook Main Section -->
    <div class="lg:col-span-3 space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-[2rem] border border-base-200 shadow-sm">
            <div>
                <h3 id="activeStudentName" class="text-xl font-black text-gray-800 italic uppercase tracking-tighter">Memuat...</h3>
                <p id="activeStudentNim" class="text-[10px] text-[#6B21A8] font-black uppercase tracking-widest mt-1">NIM: --</p>
            </div>
            <div class="flex gap-2">
                <button onclick="setView('weekly')" id="btnWeekly" class="btn btn-sm rounded-xl border-none font-black text-[9px] uppercase tracking-widest px-6 h-10 shadow-lg transition-all">Mingguan</button>
                <button onclick="setView('all')" id="btnAll" class="btn btn-sm rounded-xl border-none font-black text-[9px] uppercase tracking-widest px-6 h-10 shadow-lg transition-all">Lihat Semua</button>
            </div>
        </div>

        <!-- Weekly View -->
        <div id="weeklyContainer" class="space-y-4">
            <!-- Weekly items will be rendered by JS -->
        </div>

        <!-- All Logs List View (Minimalist) -->
        <div id="allLogsContainer" class="hidden space-y-3">
             <div class="bg-white p-2 rounded-[2rem] overflow-hidden border border-base-200 shadow-sm">
                <table class="table w-full">
                    <thead>
                        <tr class="text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-50">
                            <th class="py-4">Tanggal</th>
                            <th>Aktivitas</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="allLogsTableBody">
                        <!-- All logs will be rendered here -->
                    </tbody>
                </table>
             </div>
        </div>
    </div>
</div>

<!-- Log Detail Modal -->
<dialog id="log_detail_modal" class="modal">
    <div class="modal-box p-0 overflow-hidden bg-white max-w-xl rounded-[2.5rem] shadow-2xl">
        <div class="bg-[#6B21A8] p-10 pb-14 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <button onclick="document.getElementById('log_detail_modal').close()" class="btn btn-sm btn-circle btn-ghost absolute right-6 top-6 text-white hover:bg-white/10">✕</button>
            <div class="relative z-10">
                <span id="detailDate" class="text-[9px] font-black text-purple-200 uppercase tracking-[0.3em] bg-white/10 px-4 py-2 rounded-full border border-white/20 italic">09 MARET 2026</span>
                <h3 id="detailTitle" class="text-2xl font-black text-white italic uppercase tracking-tighter mt-6 pr-12 leading-tight">Pengembangan Fitur Dashboad Admin</h3>
            </div>
        </div>
        <div class="p-10 -mt-8 bg-white rounded-[3rem] relative z-20 space-y-8">
            <div>
                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 italic">Deskripsi Aktivitas</p>
                <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100 shadow-inner">
                    <p id="detailDesc" class="text-sm font-bold text-gray-700 leading-relaxed italic">Melanjutkan pengerjaan modul dashboard admin menggunakan Laravel dan Tailwind CSS.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="p-5 bg-orange-50/50 rounded-2xl border border-orange-100">
                    <p class="text-[8px] font-black text-orange-600 uppercase tracking-widest mb-2 italic">Kendala</p>
                    <p id="detailObstacle" class="text-[11px] font-black text-orange-800 italic uppercase">Responsivitas Grafik Mobile</p>
                </div>
                <div class="p-5 bg-blue-50/50 rounded-2xl border border-blue-100">
                    <p class="text-[8px] font-black text-blue-600 uppercase tracking-widest mb-2 italic">Pekerjaan</p>
                    <p id="detailWork" class="text-[11px] font-black text-blue-800 italic uppercase">Frontend, API Integration</p>
                </div>
            </div>

            <button onclick="document.getElementById('log_detail_modal').close()" class="btn btn-ghost w-full h-14 min-h-0 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl">Tutup</button>
        </div>
    </div>
</dialog>

<script>
const students = [
    { id: 1, name: 'Andi Saputra', nim: '210401001', color: 'purple' },
    { id: 2, name: 'Budi Ramadhan', nim: '210401045', color: 'orange' },
    { id: 3, name: 'Siti Maryam', nim: '210401089', color: 'blue' },
    { id: 4, name: 'Rahmat Hidayat', nim: '210401022', color: 'green' },
    { id: 5, name: 'Dewi Lestari', nim: '210401011', color: 'pink' },
    { id: 6, name: 'Fajar Nugraha', nim: '210401077', color: 'indigo' }
];

const mockLogs = {
    1: [
        { date: '09 Mar 2026', title: 'Integrasi API Chart', desc: 'Menghubungkan frontend ke backend untuk data grafik.', obstacle: 'Delay data fetching', work: 'API, JavaScript', week: 4 },
        { date: '08 Mar 2026', title: 'Slicing UI Dashboard', desc: 'Melakukan slicing desain figma ke HTML.', obstacle: 'None', work: 'HTML, CSS', week: 4 },
        { date: '01 Mar 2026', title: 'Setup Database', desc: 'Membuat migrasi dan seeder awal.', obstacle: 'DB Connection', work: 'Database', week: 3 }
    ],
    2: [
        { date: '10 Mar 2026', title: 'Audit Keamanan', desc: 'Mengecek celah keamanan pada form login.', obstacle: 'None', work: 'Security', week: 4 }
    ]
};

let currentView = 'weekly';
let currentStudentId = 1;

function renderStudents() {
    const container = document.getElementById('studentSelector');
    container.innerHTML = '';
    students.forEach(s => {
        const isActive = s.id === currentStudentId;
        container.innerHTML += `
            <div onclick="selectStudent(${s.id})" class="p-4 rounded-2xl flex items-center gap-3 cursor-pointer transition-all border-2 ${isActive ? 'bg-[#6B21A8]/5 border-[#6B21A8]' : 'bg-white border-transparent hover:border-gray-100 hover:bg-gray-50 group'}">
                <div class="w-10 h-10 rounded-xl bg-gray-900 text-white flex items-center justify-center font-black text-xs shadow-lg group-hover:rotate-6 transition-all">${s.name.split(' ').map(n=>n[0]).join('')}</div>
                <div class="overflow-hidden">
                    <p class="text-xs font-black text-gray-800 truncate italic ${isActive ? 'text-[#6B21A8]' : ''}">${s.name}</p>
                    <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mt-0.5">${s.nim}</p>
                </div>
            </div>
        `;
    });
}

function selectStudent(id) {
    currentStudentId = id;
    const student = students.find(s => s.id === id);
    document.getElementById('activeStudentName').innerText = student.name;
    document.getElementById('activeStudentNim').innerText = 'NIM: ' + student.nim;
    renderStudents();
    renderLogs();
}

function setView(view) {
    currentView = view;
    document.getElementById('btnWeekly').className = view === 'weekly' ? 'btn btn-sm rounded-xl border-none font-black text-[9px] uppercase tracking-widest px-6 h-10 shadow-lg bg-[#6B21A8] text-white shadow-purple-100' : 'btn btn-sm rounded-xl border-none font-black text-[9px] uppercase tracking-widest px-6 h-10 shadow-lg bg-white text-gray-400 hover:bg-gray-50';
    document.getElementById('btnAll').className = view === 'all' ? 'btn btn-sm rounded-xl border-none font-black text-[9px] uppercase tracking-widest px-6 h-10 shadow-lg bg-[#6B21A8] text-white shadow-purple-100' : 'btn btn-sm rounded-xl border-none font-black text-[9px] uppercase tracking-widest px-6 h-10 shadow-lg bg-white text-gray-400 hover:bg-gray-50';
    
    document.getElementById('weeklyContainer').classList.toggle('hidden', view !== 'weekly');
    document.getElementById('allLogsContainer').classList.toggle('hidden', view !== 'all');
    renderLogs();
}

function renderLogs() {
    const logs = mockLogs[currentStudentId] || [];
    
    if (currentView === 'weekly') {
        const weeklyContainer = document.getElementById('weeklyContainer');
        weeklyContainer.innerHTML = '';
        
        // Group by week
        const weeks = [...new Set(logs.map(l => l.week))].sort((a,b) => b-a);
        
        if(weeks.length === 0) {
            weeklyContainer.innerHTML = '<div class="p-12 text-center bg-white rounded-[2rem] border border-gray-100"><p class="text-[10px] font-black text-gray-300 uppercase italic">Belum ada logbook minggu ini</p></div>';
            return;
        }

        weeks.forEach(w => {
            const weekLogs = logs.filter(l => l.week === w);
            weeklyContainer.innerHTML += `
                <div class="bg-white p-8 rounded-[2rem] border border-base-200 shadow-sm group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-4">
                            <span class="text-[10px] font-black text-[#6B21A8] uppercase tracking-[0.3em] bg-[#6B21A8]/5 px-5 py-2 rounded-xl italic">Minggu ke-${w}</span>
                            <span class="text-[10px] font-black text-gray-300 uppercase italic">${weekLogs.length} Aktivitas</span>
                        </div>
                    </div>
                    <div class="space-y-3">
                        ${weekLogs.map((l, idx) => `
                            <div onclick="showDetail(${currentStudentId}, ${logs.indexOf(l)})" class="flex items-center justify-between p-4 bg-gray-50/50 rounded-2xl border border-gray-100 hover:bg-white hover:border-[#6B21A8] hover:shadow-xl hover:shadow-purple-100/30 transition-all cursor-pointer group/item">
                                <div class="flex items-center gap-4">
                                    <div class="w-2 h-2 rounded-full bg-purple-200 group-hover/item:bg-[#6B21A8] transition-colors"></div>
                                    <p class="text-xs font-bold text-gray-700 italic uppercase tracking-tight">${l.title}</p>
                                </div>
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">${l.date}</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `;
        });
    } else {
        const allLogsTableBody = document.getElementById('allLogsTableBody');
        allLogsTableBody.innerHTML = '';
        if(logs.length === 0) {
            allLogsTableBody.innerHTML = '<tr><td colspan="3" class="text-center py-12 text-[10px] font-black text-gray-300 uppercase italic">Belum ada aktivitas</td></tr>';
            return;
        }
        logs.forEach((l, idx) => {
            allLogsTableBody.innerHTML += `
                <tr class="hover:bg-gray-50/50 transition-all group">
                    <td class="font-black text-[9px] text-gray-400 uppercase tracking-widest py-4 border-b border-gray-50">${l.date}</td>
                    <td class="font-bold text-xs text-gray-700 italic border-b border-gray-50">${l.title}</td>
                    <td class="text-right border-b border-gray-50">
                        <button onclick="showDetail(${currentStudentId}, ${idx})" class="btn btn-ghost btn-xs text-[#6B21A8] font-black uppercase text-[8px] tracking-widest">Detail</button>
                    </td>
                </tr>
            `;
        });
    }
}

function showDetail(studentId, logIndex) {
    const log = mockLogs[studentId][logIndex];
    document.getElementById('detailDate').innerText = log.date.toUpperCase();
    document.getElementById('detailTitle').innerText = log.title;
    document.getElementById('detailDesc').innerText = log.desc;
    document.getElementById('detailObstacle').innerText = log.obstacle;
    document.getElementById('detailWork').innerText = log.work;
    document.getElementById('log_detail_modal').showModal();
}

// Init
selectStudent(1);
setView('weekly');
</script>
@endsection
