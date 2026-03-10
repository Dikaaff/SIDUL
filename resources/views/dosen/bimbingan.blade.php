@extends('layouts.app')

@section('title', 'Bimbingan Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Bimbingan Laporan 📝
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Review draft laporan mahasiswa, berikan revisi, atau berikan persetujuan akhir.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Student Selector Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white p-6 rounded-[2rem] border border-base-200 shadow-sm">
            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2 italic">
                <div class="w-1.5 h-1.5 rounded-full bg-[#6B21A8]"></div>
                Antrean Bimbingan
            </h3>
            
            <div id="studentSelector" class="space-y-3">
                <!-- Students will be rendered by JS -->
            </div>
        </div>

        <div class="bg-[#F49E0A] p-6 rounded-[2rem] shadow-xl shadow-orange-100 text-white relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/20 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-2 opacity-80">Deadline Target</h4>
            <p class="text-2xl font-black italic tracking-tighter leading-none mb-4">20 MARET 2026</p>
            <p class="text-[10px] font-bold opacity-70 leading-relaxed italic">Segera berikan persetujuan untuk draft yang sudah final.</p>
        </div>
    </div>

    <!-- Review Section -->
    <div class="lg:col-span-3">
        <div id="reviewContent" class="space-y-6">
            <!-- Selected student bimbingan data will be rendered here -->
            <div class="card bg-white p-8 rounded-[2rem] border border-base-200 shadow-sm animate-pulse">
                <div class="h-8 bg-gray-100 rounded-xl w-48 mb-4"></div>
                <div class="h-4 bg-gray-50 rounded-lg w-32 mb-8"></div>
                <div class="h-32 bg-gray-50 rounded-[2rem] w-full mb-8"></div>
                <div class="flex gap-4">
                    <div class="h-14 bg-gray-50 rounded-[1.5rem] flex-1"></div>
                    <div class="h-14 bg-gray-50 rounded-[1.5rem] flex-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const students = [
    { id: 1, name: 'Andi Saputra', nim: '210401001', draft: 'V2.0', file: 'Laporan_Magang_Andi_V2.pdf', size: '4.2 MB', time: '1 jam yang lalu', note: 'Sudah memperbaiki bagian Bab 3 sesuai arahan sebelumnya. Mohon review untuk bagian integrasi API yang sudah saya tambahkan.', status: 'Perlu Review' },
    { id: 2, name: 'Budi Ramadhan', nim: '210401045', draft: 'V1.1', file: 'Draft_Laporan_Budi_V1.1.pdf', size: '2.8 MB', time: '3 jam yang lalu', note: 'Revisi Bab 1 (Latar Belakang) sudah saya update pak.', status: 'Perlu Review' },
    { id: 3, name: 'Siti Maryam', nim: '210401089', draft: 'V3.0 (Final)', file: 'LAPORAN_AKHIR_SITI_FINAL.pdf', size: '5.1 MB', time: 'Kemarin', note: 'Mohon ACC untuk laporan akhir saya agar bisa lanjut ke tahap sidang.', status: 'Perlu Review' },
    { id: 4, name: 'Rahmat Hidayat', nim: '210401022', draft: 'V2.1', file: 'Rahmat_H_Laporan_V2.1.pdf', size: '3.9 MB', time: '2 hari lalu', note: 'Penambahan data statistik di Bab 4.', status: 'Perlu Review' },
    { id: 5, name: 'Dewi Lestari', nim: '210401011', draft: 'V1.0', file: 'DewiL_Draft1.pdf', size: '2.1 MB', time: '3 hari lalu', note: 'Draft awal untuk Bab 1 dan 2.', status: 'Ditunda' },
    { id: 6, name: 'Fajar Nugraha', nim: '210401077', draft: 'V2.5', file: 'Fajar_Draft_Laporan_V2.5.pdf', size: '4.5 MB', time: '5 hari lalu', note: 'Update analisis sistem di Bab 3.', status: 'Perlu Review' }
];

let currentStudentId = 1;

function renderSelector() {
    const container = document.getElementById('studentSelector');
    container.innerHTML = '';
    students.forEach(s => {
        const isActive = s.id === currentStudentId;
        container.innerHTML += `
            <div onclick="selectStudent(${s.id})" class="p-4 rounded-2xl flex items-center justify-between cursor-pointer transition-all border-2 ${isActive ? 'bg-[#6B21A8]/5 border-[#6B21A8]' : 'bg-white border-transparent hover:border-gray-100 hover:bg-gray-50 group'}">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-10 h-10 rounded-xl bg-gray-900 text-white flex items-center justify-center font-black text-xs shadow-lg group-hover:rotate-6 transition-all shrink-0">${s.name.split(' ').map(n=>n[0]).join('')}</div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-black text-gray-800 truncate italic ${isActive ? 'text-[#6B21A8]' : ''}">${s.name}</p>
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mt-0.5">${s.nim}</p>
                    </div>
                </div>
                ${isActive ? '<div class="w-1.5 h-1.5 rounded-full bg-[#6B21A8]"></div>' : ''}
            </div>
        `;
    });
}

function selectStudent(id) {
    currentStudentId = id;
    renderSelector();
    renderReview();
}

function renderReview() {
    const s = students.find(item => item.id === currentStudentId);
    const container = document.getElementById('reviewContent');
    
    container.innerHTML = `
        <div class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-500">
            <!-- Header Draft -->
            <div class="bg-white p-8 rounded-[2rem] border border-base-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <span class="text-[9px] font-black text-[#6B21A8] uppercase tracking-[0.3em] bg-[#6B21A8]/5 px-4 py-1.5 rounded-full border border-purple-100">Versi ${s.draft}</span>
                        <span class="text-[9px] font-black text-orange-600 uppercase tracking-[0.3em] bg-orange-50 px-4 py-1.5 rounded-full border border-orange-100">${s.status}</span>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 italic uppercase tracking-tighter">${s.name}</h3>
                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest mt-1 italic">${s.nim} • Teknik Informatika</p>
                </div>
                <button onclick="downloadDraft('${s.file}')" class="btn bg-red-50 hover:bg-red-500 text-red-600 hover:text-white border border-red-100 hover:border-red-500 rounded-2xl h-14 min-h-0 px-8 flex items-center gap-3 transition-all shadow-sm group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    <div class="text-left">
                        <p class="text-[10px] font-black uppercase tracking-widest leading-none">Download Draft</p>
                        <p class="text-[8px] font-bold opacity-70 mt-1 uppercase tracking-widest">${s.size}</p>
                    </div>
                </button>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Notes -->
                <div class="bg-white p-8 rounded-[2rem] border border-base-200 shadow-sm">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-6 italic flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" /></svg>
                        Pesan Mahasiswa
                    </h4>
                    <div class="p-6 bg-purple-50/50 rounded-3xl border border-purple-100 italic relative group">
                        <div class="absolute -top-3 -left-3 w-8 h-8 bg-purple-100 rounded-xl flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6B21A8]" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H15.017C14.4647 8 14.017 8.44772 14.017 9V11C14.017 11.5523 13.5693 12 13.017 12H12.017V4H22.017V15C22.017 18.3137 19.3307 21 16.017 21H14.017ZM3.01697 21L3.01697 18C3.01697 16.8954 3.9124 16 5.01697 16H8.01697C8.56925 16 9.01697 15.5523 9.01697 15V9C9.01697 8.44772 8.56925 8 8.01697 8H4.01697C3.46468 8 3.01697 8.44772 3.01697 9V11C3.01697 11.5523 2.56925 12 2.01697 12H1.01697V4H11.017V15C11.017 18.3137 8.3307 21 5.01697 21H3.01697Z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-gray-700 leading-relaxed pl-4">"${s.note}"</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-[#111827] p-8 rounded-[2rem] border border-gray-800 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-20 -top-20 w-48 h-48 bg-[#6B21A8]/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-6 italic relative z-10">Keputusan Review</h4>
                    
                    <div class="space-y-3 relative z-10">
                        <button onclick="takeAction('revisi')" class="btn w-full h-14 min-h-0 bg-white/5 hover:bg-orange-600/20 text-orange-500 hover:text-orange-400 border border-white/10 hover:border-orange-500/50 rounded-2xl font-black uppercase tracking-widest text-[10px] transition-all flex items-center justify-between px-6">
                            <span>Tandai Perlu Revisi</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        </button>
                        <button onclick="takeAction('setujui')" class="btn w-full h-14 min-h-0 bg-[#6B21A8] hover:bg-purple-700 text-white border-none rounded-2xl font-black uppercase tracking-widest text-[10px] shadow-lg shadow-purple-900/50 transition-all flex items-center justify-between px-6">
                            <span>Berikan Persetujuan</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

function downloadDraft(filename) {
    // UI Feedback for download
    const toast = document.createElement('div');
    toast.className = 'fixed top-6 right-6 z-[100] animate-in slide-in-from-top-4 duration-300';
    toast.innerHTML = `
        <div class="bg-gray-900 text-white px-8 py-4 rounded-[1.5rem] shadow-2xl flex items-center gap-4 border border-white/10">
            <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-white/50">Downloading Report</p>
                <p class="text-xs font-bold italic">${filename}</p>
            </div>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => { toast.classList.add('animate-out', 'fade-out', 'slide-out-to-top-4'); setTimeout(() => toast.remove(), 300); }, 3000);
}

function takeAction(type) {
    const s = students.find(item => item.id === currentStudentId);
    let title = type === 'revisi' ? 'Revisi Diminta' : 'Persetujuan Berhasil';
    let msg = type === 'revisi' ? 'Mahasiswa akan menerima notifikasi revisi.' : 'Laporan akhir telah disetujui.';
    let color = type === 'revisi' ? 'bg-[#F49E0A]' : 'bg-green-600';
    
    // UI Feedback
    const toast = document.createElement('div');
    toast.className = 'fixed top-6 right-6 z-[100] animate-in slide-in-from-top-4 duration-300';
    toast.innerHTML = `
        <div class="${color} text-white px-8 py-4 rounded-[1.5rem] shadow-2xl flex items-center gap-4 border border-white/10">
            <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-widest text-white/70">${title}</p>
                <p class="text-xs font-bold italic">${msg}</p>
            </div>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => { toast.classList.add('animate-out', 'fade-out', 'slide-out-to-top-4'); setTimeout(() => toast.remove(), 300); }, 3000);
}

// Initialize
selectStudent(1);
</script>
@endsection
