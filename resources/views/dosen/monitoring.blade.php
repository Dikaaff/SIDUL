@extends('layouts.app')

@section('title', 'Monitoring Magang')

@section('header')
<div class="px-4 lg:px-12">
    <div class="bg-gradient-to-r from-[#6B21A8] to-[#9333EA] text-white p-12 md:p-16 rounded-[4rem] shadow-2xl relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-10">
            <div class="space-y-5">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-5 py-2.5 rounded-full border border-white/20">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-[11px] font-black uppercase tracking-[0.2em]">Monitoring System</span>
                </div>
                <h2 class="text-4xl md:text-7xl font-black italic tracking-tighter uppercase leading-tight">Monitoring<br>Mahasiswa 📊</h2>
                <p class="text-white/70 font-medium italic text-xl max-w-2xl leading-relaxed">Kelola dan pantau seluruh aktivitas magang mahasiswa bimbingan Anda secara real-time.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-xl p-10 rounded-[3.5rem] border border-white/20 shadow-2xl flex flex-col items-center min-w-[200px] text-center">
                <span class="text-[12px] font-black uppercase tracking-[0.3em] text-white/50 mb-3">Total Aktif</span>
                <span class="text-6xl font-black italic">{{ $mhsBimbingan->count() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 lg:px-12 space-y-16 pb-40">
    <!-- Search & Filters -->
    <div class="flex flex-col lg:flex-row items-center justify-between gap-10 bg-white p-10 rounded-[3rem] border border-gray-100 shadow-sm">
        <div class="relative w-full lg:w-[600px] group">
            <div class="absolute inset-y-0 left-0 pl-8 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <input id="searchInput" onkeyup="filterGrid()" type="text" placeholder="Cari Nama, NIM, atau Instansi Magang..." class="w-full bg-gray-50 border-none rounded-[2rem] py-6 pl-20 pr-10 text-base font-bold text-gray-800 focus:bg-white focus:ring-8 focus:ring-purple-50 transition-all outline-none italic shadow-inner" />
        </div>
        
        <div class="flex items-center gap-6">
             <div class="bg-emerald-50 px-8 py-4 rounded-2xl border border-emerald-100 flex items-center gap-4">
                <div class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                <span class="text-[12px] font-black text-emerald-600 uppercase tracking-[0.2em] italic">Server Connected</span>
             </div>
        </div>
    </div>

    <!-- Student Cards Grid -->
    <div id="studentGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-12">
        <!-- Rendered via JS -->
    </div>

    <!-- Empty State -->
    <div id="emptyState" class="hidden py-52 text-center bg-white rounded-[4rem] border-2 border-dashed border-gray-100">
        <div class="w-28 h-28 bg-gray-50 rounded-full flex items-center justify-center text-gray-200 mx-auto mb-8">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </div>
        <h4 class="text-2xl font-black text-gray-400 italic uppercase tracking-widest">Tidak Ada Hasil</h4>
        <p class="text-base font-bold text-gray-300 mt-3 italic">Gunakan kata kunci pencarian yang lain.</p>
    </div>

    <!-- Pagination Footer -->
    <div id="paginationContainer" class="flex flex-col md:flex-row items-center justify-between gap-10 pt-16 border-t border-gray-100">
        <p id="paginationInfo" class="text-[12px] font-black text-gray-400 uppercase tracking-[0.4em] italic"></p>
        <div class="join shadow-2xl rounded-3xl overflow-hidden" id="paginationBtns"></div>
    </div>
</div>

@push('scripts')
<script>
const students = {!! json_encode($mhsBimbingan->map(function($magang) {
    $mhs = $magang->peserta->first() ? $magang->peserta->first()->mahasiswa : null;
    $logCount = $magang->logbooks_count ?? 0;
    $progress = ($magang->status_magang === 'Selesai') ? 100 : min(100, round(($logCount / 30) * 100));
    
    return [
        'name' => $mhs ? $mhs->nama : 'N/A',
        'nim' => $mhs ? $mhs->nim : 'N/A',
        'kode' => $magang->kode_magang ?? 'PENDING',
        'instansi' => $magang->perusahaan ?? 'Belum Menentukan Instansi',
        'status' => $magang->status_magang,
        'progress' => $progress,
        'logs' => $logCount,
        'prodi' => $magang->konsentrasi ?? 'Teknik Informatika'
    ];
})->toArray()) !!};

let currentPage = 1;
const itemsPerPage = 6;
let filteredStudents = [...students];

function renderGrid() {
    const grid = document.getElementById('studentGrid');
    const empty = document.getElementById('emptyState');
    const pagination = document.getElementById('paginationContainer');
    
    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const items = filteredStudents.slice(start, end);
    
    grid.innerHTML = '';
    
    if (filteredStudents.length === 0) {
        empty.classList.remove('hidden');
        grid.classList.add('hidden');
        pagination.classList.add('hidden');
    } else {
        empty.classList.add('hidden');
        grid.classList.remove('hidden');
        pagination.classList.remove('hidden');
    }
    
    items.forEach((s, i) => {
        const colors = ['bg-purple-100 text-[#6B21A8]', 'bg-blue-100 text-blue-600', 'bg-emerald-100 text-emerald-600', 'bg-orange-100 text-orange-600'];
        const avatarStyle = colors[i % colors.length];
        const badgeColor = s.status === 'Selesai' ? 'bg-blue-50 text-blue-600' : (['Aktif', 'berjalan'].includes(s.status) ? 'bg-emerald-50 text-emerald-600' : 'bg-orange-50 text-orange-600');
        
        const card = `
            <div class="group bg-white rounded-[4rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:scale-[1.03] transition-all duration-500 p-12 flex flex-col justify-between min-h-[480px] relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-56 h-56 bg-gray-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="relative z-10">
                    <div class="flex items-start justify-between gap-6 mb-10">
                        <div class="w-20 h-20 rounded-[2rem] ${avatarStyle} flex items-center justify-center font-black text-3xl shadow-inner group-hover:rotate-6 transition-transform">
                            ${s.name[0]}
                        </div>
                        <div class="text-right">
                             <span class="text-[10px] font-black uppercase tracking-widest italic ${badgeColor} px-4 py-2 rounded-2xl border border-current opacity-80 inline-block mb-3">${s.status}</span>
                             <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest italic">${s.kode}</p>
                        </div>
                    </div>
                    
                    <h4 class="text-3xl font-black text-gray-800 italic tracking-tighter leading-tight mb-3 group-hover:text-[#6B21A8] transition-colors line-clamp-2">${s.name}</h4>
                    <p class="text-[12px] font-black text-gray-400 uppercase tracking-[0.25em] italic mb-10">${s.nim} • ${s.prodi}</p>
                    
                    <div class="space-y-7">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic mb-3">Instansi Magang</p>
                            <p class="text-base font-black text-gray-700 italic line-clamp-1">${s.instansi}</p>
                        </div>
                        
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Progress Magang</p>
                                <p class="text-sm font-black text-[#6B21A8] italic">${s.progress}%</p>
                            </div>
                            <div class="h-4 w-full bg-gray-100 rounded-full overflow-hidden shadow-inner border border-gray-50">
                                <div class="h-full bg-gradient-to-r from-[#6B21A8] to-[#9333EA] rounded-full transition-all duration-1000 ease-out shadow-[0_0_15px_rgba(107,33,168,0.4)]" style="width: ${s.progress}%"></div>
                            </div>
                            <p class="text-[10px] font-black text-gray-400 mt-3 italic text-right uppercase tracking-tighter">${s.logs} / 30 Hari Terisi</p>
                        </div>
                    </div>
                </div>

                <div class="pt-12 relative z-10">
                    <a href="{{ route('dosen.logbook') }}" class="w-full bg-gray-50 hover:bg-[#6B21A8] text-[#6B21A8] hover:text-white py-6 rounded-[2rem] font-black text-[12px] uppercase tracking-[0.25em] italic transition-all block text-center shadow-sm hover:shadow-xl active:scale-95">
                        Buka Logbook →
                    </a>
                </div>
            </div>
        `;
        grid.innerHTML += card;
    });
    
    updatePagination();
}

function filterGrid() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    filteredStudents = students.filter(s => 
        s.name.toLowerCase().includes(q) || 
        s.nim.includes(q) || 
        s.kode.toLowerCase().includes(q) ||
        s.instansi.toLowerCase().includes(q)
    );
    currentPage = 1;
    renderGrid();
}

function updatePagination() {
    const total = filteredStudents.length;
    const pages = Math.ceil(total / itemsPerPage) || 1;
    const start = total === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
    const end = Math.min(currentPage * itemsPerPage, total);
    
    document.getElementById('paginationInfo').innerText = `Menampilkan ${start}-${end} dari ${total} Mahasiswa`;
    
    const container = document.getElementById('paginationBtns');
    container.innerHTML = '';
    
    if (pages > 1) {
        for(let i = 1; i <= pages; i++) {
            const btn = document.createElement('button');
            btn.className = `join-item btn btn-md h-14 px-8 font-black text-[11px] uppercase border-none ${currentPage === i ? 'bg-[#6B21A8] text-white shadow-2xl shadow-purple-200' : 'bg-white text-gray-400 hover:bg-gray-50'}`;
            btn.innerText = i;
            btn.onclick = () => { 
                currentPage = i; 
                renderGrid(); 
                window.scrollTo({top: 0, behavior: 'smooth'}); 
            };
            container.appendChild(btn);
        }
    }
}

renderGrid();
</script>
@endpush
