@extends('layouts.app')

@section('title', 'Monitoring Mahasiswa Magang')

@section('header')
<div class="bg-[#6B21A8] text-white p-6 md:p-8 rounded-[2rem] relative overflow-hidden border-none shadow-2xl mt-2">
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
        <div>
            <h2 class="text-2xl md:text-3xl font-black mb-2">Monitoring Mahasiswa 📊</h2>
            <p class="text-white/90 font-medium text-sm md:text-base max-w-2xl leading-relaxed">Pantau progres kegiatan, status magang, dan informasi perusahaan mahasiswa bimbingan Anda.</p>
        </div>
        <div class="flex gap-3 self-start md:self-center shrink-0">
            <div class="bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-2xl border border-white/20 text-white flex items-center gap-3 shadow-xl">
                <div class="w-2.5 h-2.5 rounded-full bg-green-400 animate-pulse shadow-[0_0_10px_rgba(74,222,128,0.8)]"></div>
                <span class="text-xs font-bold uppercase tracking-wider">Dosen Pembimbing</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
    <div class="px-8 py-6 border-b border-base-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
        <div class="flex items-center gap-4">
            <div class="bg-white p-2 rounded-xl border border-base-200 shadow-sm">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <h3 class="font-bold text-xl text-gray-800 tracking-tight">Daftar Mahasiswa Bimbingan</h3>
        </div>
        <div class="flex gap-2">
            <div class="join shadow-sm border border-base-200">
                <input id="searchInput" onkeyup="filterTable()" class="input input-sm join-item bg-white text-gray-800 focus:outline-none w-48 lg:w-64" placeholder="Cari nama atau NIM..." />
                <button class="btn btn-sm join-item bg-white border-l-base-200 text-gray-500 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table table-lg w-full" id="monitoringTable">
            <thead>
                <tr class="text-gray-400 font-extrabold text-xs uppercase tracking-[0.2em] bg-gray-50/30">
                    <th class="py-6">Mahasiswa</th>
                    <th>Kode Magang</th>
                    <th>Status & Progress</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Data akan dirender oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <div class="p-8 bg-gray-50/50 border-t border-base-100 flex flex-col md:flex-row items-center justify-between gap-4">
         <p id="paginationInfo" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] italic">Menampilkan 0 dari 0 Mahasiswa</p>
         <div class="join" id="paginationBtns"></div>
    </div>
</div>

@push('scripts')
<script>
// Perbaikan penulisan data agar tidak menyebabkan ParseError
const students = {!! json_encode($mhsBimbingan->map(function($magang) {
    $mhs = $magang->peserta->first() ? $magang->peserta->first()->mahasiswa : null;
    return [
        'name' => $mhs ? $mhs->nama : 'N/A',
        'nim' => $mhs ? $mhs->nim : 'N/A',
        'kode_magang' => $magang->kode_magang,
        'status' => $magang->status_magang,
        'progress' => ($magang->status_magang === 'Selesai') ? 100 : 60,
    ];
})->toArray()) !!};

let currentPage = 1;
const itemsPerPage = 5;
let filteredStudents = [...students];

function renderTable() {
    const tableBody = document.getElementById('studentTableBody');
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = filteredStudents.slice(start, end);
    
    tableBody.innerHTML = '';
    
    paginatedItems.forEach((student, index) => {
        const colors = [ 'bg-purple-100 text-[#6B21A8]', 'bg-orange-100 text-[#F49E0A]', 'bg-blue-100 text-blue-600' ];
        const avatarColor = colors[index % colors.length];
        
        const badgeClass = (student.status === 'Aktif' || student.status === 'berjalan') ? 'badge-success' : 'badge-warning';
                           
        const row = `
            <tr class="hover:bg-gray-50/50 transition-all border-b border-base-100 group">
                <td class="py-6">
                    <div class="flex items-center gap-5">
                        <div class="avatar">
                            <div class="w-14 h-14 rounded-2xl ${avatarColor} flex items-center justify-center font-black text-lg group-hover:rotate-3 transition-transform">${student.name[0]}</div>
                        </div>
                        <div>
                            <div class="font-bold text-gray-900 text-lg tracking-tight leading-tight">${student.name}</div>
                            <div class="text-[11px] font-medium text-gray-400 tracking-wide mt-1 uppercase">${student.nim}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="font-bold text-gray-800 text-sm tracking-tight">${student.kode_magang}</span>
                </td>
                <td>
                    <div class="w-full max-w-[200px] space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="badge ${badgeClass} badge-outline font-black text-[9px] py-3 px-4 uppercase tracking-widest border-2 rounded-xl italic">${student.status}</span>
                            <span class="text-xs font-black text-gray-800 italic">${student.progress}%</span>
                        </div>
                        <div class="relative h-2 w-full bg-gray-100 rounded-full overflow-hidden shadow-inner">
                            <div class="absolute top-0 left-0 h-full bg-[#6B21A8] rounded-full transition-all duration-700" style="width: ${student.progress}%"></div>
                        </div>
                    </div>
                </td>
            </tr>
        `;
        tableBody.innerHTML += row;
    });
    updatePagination();
}

function filterTable() {
    const searchVal = document.getElementById('searchInput').value.toLowerCase();
    filteredStudents = students.filter(s => s.name.toLowerCase().includes(searchVal) || s.nim.includes(searchVal));
    currentPage = 1;
    renderTable();
}

function updatePagination() {
    const totalItems = filteredStudents.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage) || 1;
    const startItem = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
    const endItem = Math.min(currentPage * itemsPerPage, totalItems);
    document.getElementById('paginationInfo').innerText = `Menampilkan ${startItem}-${endItem} dari ${totalItems} Mahasiswa`;
    const btnsContainer = document.getElementById('paginationBtns');
    btnsContainer.innerHTML = '';
    for(let i = 1; i <= totalPages; i++) {
        const pageBtn = document.createElement('button');
        pageBtn.className = `join-item btn btn-xs ${currentPage === i ? 'bg-[#6B21A8] text-white' : 'bg-white'} px-3`;
        pageBtn.innerText = i;
        pageBtn.onclick = () => { currentPage = i; renderTable(); };
        btnsContainer.appendChild(pageBtn);
    }
}

renderTable();
</script>
@endpush
