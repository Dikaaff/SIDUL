@extends('layouts.app')

@section('title', 'Bimbingan Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-8 rounded-2xl shadow-xl mt-2 relative overflow-hidden">
    <!-- Decorative items -->
    <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
    <div class="relative z-10">
        <h2 class="text-3xl font-black italic tracking-tighter uppercase text-white">
            Bimbingan Laporan 📝
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base font-medium">Review draft laporan mahasiswa, berikan revisi, atau berikan persetujuan akhir.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Student Selector Sidebar -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white p-8 rounded-[2.5rem] border border-base-200 shadow-sm">
            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-8 flex items-center gap-2 italic">
                <div class="w-2 h-2 rounded-full bg-[#6B21A8]"></div>
                Antrean Bimbingan
            </h3>

            <div id="studentSelector" class="space-y-4">
                <!-- Students will be rendered by JS -->
            </div>
        </div>

        <div class="bg-[#F49E0A] p-8 rounded-[2.5rem] text-white shadow-2xl shadow-orange-900/10 relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/20 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
            <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-4 opacity-80 italic">Deadline Target</h4>
            <p class="text-3xl font-black italic tracking-tighter leading-none mb-4 uppercase">20 Mar 2026</p>
            <p class="text-[10px] font-black opacity-70 leading-relaxed italic uppercase tracking-widest">Segera berikan persetujuan untuk draft yang sudah final.</p>
        </div>
    </div>

    <!-- Review Section -->
    <div class="lg:col-span-3">
        <div id="reviewContent" class="space-y-6">
            <!-- Selected student bimbingan data will be rendered here -->
            <div class="bg-white p-12 rounded-[2.5rem] animate-pulse border border-gray-100 shadow-sm">
                <div class="h-8 bg-gray-100 rounded-xl w-48 mb-6"></div>
                <div class="h-4 bg-gray-50 rounded-lg w-32 mb-10"></div>
                <div class="h-40 bg-gray-50 rounded-[2.5rem] w-full mb-10"></div>
                <div class="flex gap-6">
                    <div class="h-16 bg-gray-50 rounded-[1.5rem] flex-1"></div>
                    <div class="h-16 bg-gray-50 rounded-[1.5rem] flex-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Revisi Modal -->
<dialog id="revisi_modal" class="modal">
    <div class="modal-box p-0 overflow-hidden bg-white max-w-xl rounded-[2.5rem] shadow-2xl">
        <div class="bg-[#F49E0A] p-10 pb-14 relative overflow-hidden">
             <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full"></div>
             <button onclick="document.getElementById('revisi_modal').close()" class="btn btn-sm btn-circle btn-ghost absolute right-6 top-6 text-white hover:bg-white/10">✕</button>
             <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter relative z-10">Berikan Catatan Revisi ✍️</h3>
        </div>
        <div class="p-10 -mt-8 bg-white rounded-[3rem] relative z-20 space-y-8">
            <div class="space-y-3">
                <label class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] ml-2 italic">Pesan Untuk Mahasiswa</label>
                <textarea id="revisiMessage" class="textarea bg-gray-50 border-none h-48 rounded-[2rem] w-full p-8 text-sm font-bold text-gray-700 focus:ring-4 focus:ring-orange-100 transition-all italic" placeholder="Tuliskan bagian mana yang perlu diperbaiki secara mendalam..."></textarea>
            </div>
            <button onclick="submitRevision()" class="btn w-full h-16 min-h-0 bg-[#F49E0A] hover:bg-orange-600 border-none text-white font-black uppercase tracking-[0.2em] text-[11px] rounded-[1.5rem] shadow-xl shadow-orange-100 transition-all hover:scale-[1.02] active:scale-95">
                Kirim Catatan Revisi
            </button>
        </div>
    </div>
</dialog>

<script>
const students = [
    { id: 1, name: 'Andi Saputra', nim: '210401001', draft: 'V2.0', file: 'Laporan_Magang_Andi_V2.pdf', size: '4.2 MB', time: '1 jam yang lalu', status: 'Perlu Review' },
    { id: 2, name: 'Budi Ramadhan', nim: '210401045', draft: 'V1.1', file: 'Draft_Laporan_Budi_V1.1.pdf', size: '2.8 MB', time: '3 jam yang lalu', status: 'Perlu Review' },
    { id: 3, name: 'Siti Maryam', nim: '210401089', draft: 'V3.0 (Final)', file: 'LAPORAN_AKHIR_SITI_FINAL.pdf', size: '5.1 MB', time: 'Kemarin', status: 'Perlu Review' },
    { id: 4, name: 'Rahmat Hidayat', nim: '210401022', draft: 'V2.1', file: 'Rahmat_H_Laporan_V2.1.pdf', size: '3.9 MB', time: '2 hari lalu', status: 'Perlu Review' },
    { id: 5, name: 'Dewi Lestari', nim: '210401011', draft: 'V1.0', file: 'DewiL_Draft1.pdf', size: '2.1 MB', time: '3 hari lalu', status: 'Perlu Revisi' },
    { id: 6, name: 'Fajar Nugraha', nim: '210401077', draft: 'V2.5', file: 'Fajar_Draft_Laporan_V2.5.pdf', size: '4.5 MB', time: '5 hari lalu', status: 'Perlu Review' }
];

let currentStudentId = 1;

function renderSelector() {
    const container = document.getElementById('studentSelector');
    container.innerHTML = '';
    students.forEach(s => {
        const isActive = s.id === currentStudentId;
        const isApproved = s.status === 'Disetujui';
        const isRevision = s.status === 'Perlu Revisi';

        let statusDot = 'bg-gray-300';
        if (isApproved) statusDot = 'bg-green-500';
        else if (isActive) statusDot = 'bg-[#6B21A8]';
        else if (isRevision) statusDot = 'bg-[#F49E0A]';

        // Color palette for avatars
        const colors = [
            'bg-purple-100 text-[#6B21A8]',
            'bg-orange-100 text-[#F49E0A]',
            'bg-blue-100 text-blue-600',
            'bg-green-100 text-green-600',
            'bg-pink-100 text-pink-600'
        ];
        const avatarStyle = isApproved ? 'bg-green-500 text-white' : colors[s.id % colors.length];

        container.innerHTML += `
            <div onclick="selectStudent(${s.id})" class="p-5 rounded-[2rem] flex items-center justify-between cursor-pointer transition-all border-2 ${isActive ? 'bg-purple-50 border-[#6B21A8] shadow-lg shadow-purple-100' : 'bg-white border-transparent hover:border-gray-100 hover:bg-gray-50 group'}">
                <div class="flex items-center gap-4 overflow-hidden">
                    <div class="w-12 h-12 rounded-2xl ${avatarStyle} flex items-center justify-center font-black text-xs group-hover:rotate-6 transition-all shrink-0">${s.name.split(' ').map(n=>n[0]).join('')}</div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-gray-900 truncate tracking-tight ${isActive ? 'text-[#6B21A8]' : ''}">${s.name}</p>
                        <p class="text-[9px] font-medium text-gray-400 tracking-wide mt-1 uppercase">${s.nim}</p>
                    </div>
                </div>
                <div class="w-1.5 h-1.5 rounded-full ${statusDot}"></div>
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
    const isApproved = s.status === 'Disetujui';
    const isRevision = s.status === 'Perlu Revisi';
    
    container.innerHTML = `
        <div class="space-y-6 animate-in fade-in slide-in-from-bottom-2 duration-500">
            <!-- Header Draft -->
            <div class="bg-white p-12 rounded-[2.5rem] border border-base-200 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-[10px] font-black text-[#6B21A8] uppercase tracking-[0.3em] bg-purple-50 px-5 py-2 rounded-xl border border-purple-100 italic">Versi ${s.draft}</span>
                        <span class="text-[10px] font-black ${isApproved ? 'text-green-600 bg-green-50 border-green-100' : (isRevision ? 'text-[#F49E0A] bg-orange-50 border-orange-100' : 'text-orange-600 bg-orange-50 border-orange-100')} uppercase tracking-[0.3em] px-5 py-2 rounded-xl border-2 italic">${s.status}</span>
                    </div>
                    <h3 class="text-3xl font-black text-gray-800 italic uppercase tracking-tighter">${s.name}</h3>
                    <p class="text-[11px] text-gray-400 font-bold uppercase tracking-widest mt-1 italic">${s.nim} • Teknik Informatika</p>
                </div>
                <button onclick="downloadDraft('${s.file}')" class="btn bg-red-50 hover:bg-red-500 text-red-600 hover:text-white border border-red-100 hover:border-red-500 rounded-[1.5rem] h-16 min-h-0 px-10 flex items-center gap-4 transition-all shadow-sm group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    <div class="text-left">
                        <p class="text-[11px] font-black uppercase tracking-widest leading-none italic">Download Draft</p>
                        <p class="text-[9px] font-bold opacity-70 mt-1 uppercase tracking-widest">${s.size}</p>
                    </div>
                </button>
            </div>

            <!-- Review Actions Card -->
            <div class="bg-white p-12 rounded-[2.5rem] border-2 border-dashed border-gray-100 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#6B21A8]/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                
                <div class="relative z-10">
                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-10 italic">Keputusan Review & Penilaian</h4>
                    
                    ${isApproved ? `
                        <div class="flex flex-col items-center justify-center py-10 text-center animate-in zoom-in duration-500">
                            <div class="w-24 h-24 bg-green-50 rounded-[2rem] flex items-center justify-center text-green-500 mb-8 border-2 border-green-100 shadow-xl shadow-green-100/50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                            </div>
                            <h5 class="text-gray-800 font-black text-2xl italic uppercase tracking-tighter">Laporan Telah Disetujui</h5>
                            <p class="text-gray-400 text-[10px] font-bold uppercase tracking-[0.2em] mt-3 italic">Draf ini telah sah sebagai laporan akhir mahasiswa.</p>
                        </div>
                    ` : `
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <button onclick="openRevisiModal()" class="btn h-20 bg-orange-50 hover:bg-[#F49E0A] text-[#F49E0A] hover:text-white border-none rounded-[1.8rem] font-black uppercase tracking-[0.2em] text-[11px] transition-all flex items-center justify-between px-10 shadow-lg shadow-orange-100 group/btn">
                                <span>Tandai Perlu Revisi</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover/btn:rotate-[20deg] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>
                            <button onclick="takeAction('setujui')" class="btn h-20 bg-[#6B21A8] hover:bg-[#4c1d95] text-white border-none rounded-[1.8rem] font-black uppercase tracking-[0.2em] text-[11px] shadow-2xl shadow-purple-200 transition-all flex items-center justify-between px-10 group/btn">
                                <span>Berikan Persetujuan</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover/btn:scale-125 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </button>
                        </div>
                    `}
                </div>
            </div>
        </div>
    `;
}

function downloadDraft(filename) {
    showToast('Downloading Report', filename, 'bg-gray-900', 'bg-red-500');
}

function openRevisiModal() {
    document.getElementById('revisi_modal').showModal();
}

function submitRevision() {
    const msg = document.getElementById('revisiMessage').value;
    if (!msg) {
        alert('Mohon isi catatan revisi untuk mahasiswa!');
        return;
    }
    
    // Update data locally
    const s = students.find(item => item.id === currentStudentId);
    s.status = 'Perlu Revisi';
    
    document.getElementById('revisi_modal').close();
    document.getElementById('revisiMessage').value = '';
    
    renderSelector();
    renderReview();
    showToast('Revisi Diminta', 'Mahasiswa akan menerima notifikasi revisi.', 'bg-secondary');
}

function takeAction(type) {
    if (type === 'setujui') {
        const s = students.find(item => item.id === currentStudentId);
        s.status = 'Disetujui';
        
        renderSelector();
        renderReview();
        showToast('Persetujuan Berhasil', 'Laporan akhir telah disetujui.', 'bg-green-600');
    }
}

function showToast(title, msg, colorClass, iconColorClass = 'bg-white/20') {
    const toast = document.createElement('div');
    toast.className = 'fixed top-6 right-6 z-[100] animate-in slide-in-from-top-4 duration-300';
    toast.innerHTML = `
        <div class="${colorClass} text-white px-8 py-4 rounded-[1.5rem] shadow-2xl flex items-center gap-4 border border-white/10">
            <div class="w-10 h-10 rounded-xl ${iconColorClass} flex items-center justify-center">
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
