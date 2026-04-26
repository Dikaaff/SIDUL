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
            <select id="statusFilter" onchange="filterTable()" class="select select-sm select-bordered bg-white text-gray-700 font-bold max-w-xs focus:border-[#6B21A8]">
                <option value="Semua" selected>Semua Status</option>
                <option value="Aktif Magang">Aktif Magang</option>
                <option value="Tahap Pendaftaran">Pendaftaran</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table table-lg w-full" id="monitoringTable">
            <thead>
                <tr class="text-gray-400 font-extrabold text-xs uppercase tracking-[0.2em] bg-gray-50/30">
                    <th class="py-6">Mahasiswa</th>
                    <th>Instansi Magang</th>
                    <th>Status & Progress</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
                <!-- Data akan dirender oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden py-24 flex flex-col items-center justify-center text-center">
        <div class="w-20 h-20 rounded-3xl bg-gray-50 flex items-center justify-center text-gray-300 mb-4 border-4 border-dashed border-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </div>
        <p class="text-gray-400 font-black text-xs uppercase tracking-widest italic">Mahasiswa tidak ditemukan</p>
    </div>

    <div class="p-8 bg-gray-50/50 border-t border-base-100 flex flex-col md:flex-row items-center justify-between gap-4">
         <p id="paginationInfo" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] italic">Menampilkan 0 dari 0 Mahasiswa</p>
         <div class="join" id="paginationBtns">
            <!-- Tombol pagination akan dirender di sini -->
         </div>
    </div>
</div>

<!-- Modal Detail Mahasiswa -->
<dialog id="student_detail_modal" class="modal">
    <div class="modal-box p-0 overflow-hidden bg-white max-w-2xl rounded-[2.5rem] shadow-2xl">
        <div class="bg-[#6B21A8] p-10 pb-14 relative overflow-hidden">
            <!-- Glassmorphism Ornaments -->
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute right-20 bottom-0 w-20 h-20 bg-purple-400/20 rounded-full blur-2xl"></div>
            
            <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-sm btn-circle btn-ghost absolute right-6 top-6 text-white hover:bg-white/10">✕</button>
            <div class="flex items-center gap-8 relative z-10">
                <div id="modal_avatar" class="w-24 h-24 rounded-[2rem] bg-white/20 backdrop-blur-xl border border-white/30 flex items-center justify-center text-4xl font-black text-white shadow-2xl rotate-3">
                    AS
                </div>
                <div class="text-white">
                    <h3 id="modal_name" class="text-3xl font-black tracking-tight italic">Andi Saputra</h3>
                    <p id="modal_nim" class="text-white/60 font-black tracking-[0.3em] text-[10px] uppercase mt-2">210401001 • TEKNIK INFORMATIKA</p>
                    <div class="flex items-center gap-2 mt-4">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-white/80">Online Profile Verified</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-10 -mt-8 bg-white rounded-[3rem] relative z-20">
            <div class="grid grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="p-5 bg-gray-50 rounded-3xl border border-gray-100 shadow-inner">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2 italic">Perusahaan</p>
                        <p id="modal_company" class="font-black text-gray-800 text-lg italic">PT. Teknologi Maju Persada</p>
                        <p id="modal_field" class="text-[10px] font-bold text-[#6B21A8] mt-1 uppercase tracking-wider">Software Development</p>
                    </div>
                </div>
                <div class="space-y-6">
                    <div>
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-3 italic">Status & Progress</p>
                        <span id="modal_status" class="badge badge-success badge-outline font-black text-[10px] uppercase tracking-widest px-4 py-4 border-2 rounded-xl italic mb-4">Aktif Magang</span>
                        <div class="space-y-2 mt-4">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Completion</span>
                                <span id="modal_progress_text" class="text-lg font-black text-[#6B21A8] italic">85%</span>
                            </div>
                            <div class="relative h-3 w-full bg-gray-100 rounded-full overflow-hidden shadow-inner">
                                <div id="modal_progress_bar_div" class="absolute top-0 left-0 h-full bg-[#6B21A8] rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(107,33,168,0.4)]" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex gap-4">
                <button onclick="document.getElementById('student_detail_modal').close()" class="btn bg-[#6B21A8] hover:bg-purple-700 border-none text-white flex-[2] h-14 min-h-0 font-black uppercase tracking-widest text-[11px] rounded-[1.5rem] shadow-2xl shadow-purple-100 group">
                    Hubungi Mahasiswa
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                </button>
                <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-ghost flex-1 h-14 min-h-0 font-black uppercase tracking-widest text-[11px] text-gray-400 rounded-[1.5rem]">Tutup</button>
            </div>
        </div>
    </div>
</dialog>

<script>
// Data Mahasiswa dari Database
const students = @json($mhsBimbingan->map(function($magang) {
    return [
        'name' => $magang->peserta->mahasiswa->nama,
        'nim' => $magang->peserta->mahasiswa->nim,
        'company' => $magang->perusahaan,
        'field' => $magang->konsentrasi ?? 'Bidang Belum Diisi',
        'status' => $magang->status_magang,
        'progress' => ($magang->status_magang === 'Selesai') ? 100 : 
                      (($magang->status_magang === 'Terverifikasi') ? 20 : 60),
        'color' => ($magang->status_magang === 'Selesai') ? 'green' : 
                   (($magang->status_magang === 'Pending') ? 'orange' : 'purple')
    ];
}));

let currentPage = 1;
const itemsPerPage = 5;
let filteredStudents = [...students];

function renderTable() {
    const tableBody = document.getElementById('studentTableBody');
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const paginatedItems = filteredStudents.slice(start, end);
    
    tableBody.innerHTML = '';
    
    if (paginatedItems.length === 0) {
        document.getElementById('emptyState').classList.remove('hidden');
        document.getElementById('monitoringTable').classList.add('hidden');
    } else {
        document.getElementById('emptyState').classList.add('hidden');
        document.getElementById('monitoringTable').classList.remove('hidden');
        
        paginatedItems.forEach((student, index) => {
            // Color palette for avatars
            const colors = [
                'bg-purple-100 text-[#6B21A8]',
                'bg-orange-100 text-[#F49E0A]',
                'bg-blue-100 text-blue-600',
                'bg-green-100 text-green-600',
                'bg-pink-100 text-pink-600'
            ];
            
            // Use index + current page to keep colors consistent
            const colorIndex = ( (currentPage - 1) * itemsPerPage + index ) % colors.length;
            const avatarColor = colors[colorIndex];
            
            const badgeClass = student.status === 'Aktif Magang' ? 'badge-success' : 
                               (student.status === 'Selesai' ? 'badge-info' : 'badge-warning');
                               
            const row = `
                <tr class="hover:bg-gray-50/50 transition-all border-b border-base-100 group">
                    <td class="py-6">
                        <div class="flex items-center gap-5">
                            <div class="avatar">
                                <div class="w-14 h-14 rounded-2xl ${avatarColor} flex items-center justify-center font-black text-lg group-hover:rotate-3 transition-transform">${student.name.split(' ').map(n => n[0]).join('')}</div>
                            </div>
                            <div>
                                <div class="font-bold text-gray-900 text-lg group-hover:text-[#6B21A8] transition-colors tracking-tight leading-tight">${student.name}</div>
                                <div class="text-[11px] font-medium text-gray-400 tracking-wide mt-1 uppercase">${student.nim} • Teknik Informatika</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-800 text-sm tracking-tight">${student.company}</span>
                            <span class="text-[10px] font-medium text-gray-400 tracking-wide mt-1">${student.field}</span>
                        </div>
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
                    <td>
                        <button onclick="showStudentDetail('${student.name}', '${student.nim}', '${student.company}', ${student.progress}, '${student.field}', '${student.status}')" class="btn btn-circle btn-ghost hover:bg-[#6B21A8]/10 text-gray-300 hover:text-[#6B21A8] transition-all">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    </td>
                </tr>
            `;
            tableBody.innerHTML += row;
        });
    }
    
    updatePagination();
}

function filterTable() {
    const searchVal = document.getElementById('searchInput').value.toLowerCase();
    const statusVal = document.getElementById('statusFilter').value;
    
    filteredStudents = students.filter(s => {
        const matchesSearch = s.name.toLowerCase().includes(searchVal) || s.nim.includes(searchVal);
        const matchesStatus = statusVal === 'Semua' || s.status === statusVal;
        return matchesSearch && matchesStatus;
    });
    
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
    
    // Prev Button
    const prevBtn = document.createElement('button');
    prevBtn.className = `join-item btn btn-xs bg-white border-base-200 hover:bg-gray-100 ${currentPage === 1 ? 'btn-disabled opacity-50' : ''}`;
    prevBtn.innerHTML = '«';
    prevBtn.onclick = () => { if(currentPage > 1) { currentPage--; renderTable(); } };
    btnsContainer.appendChild(prevBtn);
    
    // Page Numbers (Limited)
    for(let i = 1; i <= totalPages; i++) {
        if(i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
            const pageBtn = document.createElement('button');
            pageBtn.className = `join-item btn btn-xs ${currentPage === i ? 'bg-[#6B21A8] text-white border-none' : 'bg-white border-base-200'} px-3`;
            pageBtn.innerText = i;
            pageBtn.onclick = () => { currentPage = i; renderTable(); };
            btnsContainer.appendChild(pageBtn);
        } else if (i === currentPage - 2 || i === currentPage + 2) {
            const dots = document.createElement('button');
            dots.className = 'join-item btn btn-xs bg-white border-base-200 btn-disabled';
            dots.innerText = '...';
            btnsContainer.appendChild(dots);
        }
    }
    
    // Next Button
    const nextBtn = document.createElement('button');
    nextBtn.className = `join-item btn btn-xs bg-white border-base-200 hover:bg-gray-100 ${currentPage === totalPages ? 'btn-disabled opacity-50' : ''}`;
    nextBtn.innerHTML = '»';
    nextBtn.onclick = () => { if(currentPage < totalPages) { currentPage++; renderTable(); } };
    btnsContainer.appendChild(nextBtn);
}

function showStudentDetail(name, nim, company, progress, field, status) {
    document.getElementById('modal_name').innerText = name;
    document.getElementById('modal_nim').innerText = nim + ' • TEKNIK INFORMATIKA';
    document.getElementById('modal_company').innerText = company;
    document.getElementById('modal_field').innerText = field;
    document.getElementById('modal_progress_text').innerText = progress + '%';
    document.getElementById('modal_progress_bar_div').style.width = progress + '%';
    document.getElementById('modal_avatar').innerText = name.split(' ').map(n => n[0]).join('').toUpperCase();
    
    const statusBadge = document.getElementById('modal_status');
    statusBadge.innerText = status;
    if (status.toLowerCase().includes('aktif')) {
        statusBadge.className = 'badge badge-success badge-outline font-black text-[10px] uppercase tracking-widest px-4 py-4 border-2 rounded-xl italic';
    } else if (status.toLowerCase().includes('selesai')) {
        statusBadge.className = 'badge badge-info badge-outline font-black text-[10px] uppercase tracking-widest px-4 py-4 border-2 rounded-xl italic';
    } else {
        statusBadge.className = 'badge badge-warning badge-outline font-black text-[10px] uppercase tracking-widest px-4 py-4 border-2 rounded-xl italic text-[#F49E0A] border-orange-200';
    }

    document.getElementById('student_detail_modal').showModal();
}

// Initial Render
renderTable();
</script>
@endsection
