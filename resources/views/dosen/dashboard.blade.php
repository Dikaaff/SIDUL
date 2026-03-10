@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Dashboard Dosen 👋
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Halo, Bapak/Ibu Dosen. Pantau progres magang mahasiswa Anda hari ini.</p>
    </div>
    <div class="flex gap-3">
        <div class="bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 text-white flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <span class="text-xs font-medium">{{ now()->format('d M Y') }}</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Stat: Total Mahasiswa -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Mahasiswa Bimbingan</p>
                    <h3 class="text-3xl font-extrabold text-gray-800">24</h3>
                </div>
                <div class="p-3 rounded-2xl bg-purple-50 text-[#6B21A8]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-lg w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                <span>3 Mahasiswa baru</span>
            </div>
        </div>
    </div>

    <!-- Stat: Pengajuan Pending -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Pengajuan Pending</p>
                    <h3 class="text-3xl font-extrabold text-gray-800">8</h3>
                </div>
                <div class="p-3 rounded-2xl bg-orange-50 text-[#F49E0A]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center gap-2 text-xs font-medium text-[#F49E0A] bg-orange-50 px-2 py-1 rounded-lg w-fit">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Butuh review segera</span>
            </div>
        </div>
    </div>

    <!-- Stat: Progress Rata-rata -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Lulus Magang</p>
                    <h3 class="text-3xl font-extrabold text-gray-800">12</h3>
                </div>
                <div class="p-3 rounded-2xl bg-green-50 text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <progress class="progress progress-primary w-full h-2" value="65" max="100"></progress>
                <p class="text-[10px] text-gray-400 mt-1 font-medium">65% Target Semester Ini Terpenuhi</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Section: Daftar Mahasiswa Bimbingan -->
    <div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-base-100 flex items-center justify-between bg-gray-50/50">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                Mahasiswa Bimbingan Terbaru
            </h3>
            <a href="/dosen/monitoring" class="text-xs font-bold text-[#6B21A8] hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="table table-zebra">
                <thead>
                    <tr class="text-gray-400 uppercase text-[10px] tracking-wider">
                        <th>Mahasiswa</th>
                        <th>Perusahaan</th>
                        <th>Progress</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-gray-100 text-gray-500 rounded-lg w-10">AS</div>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">Andi Saputra</div>
                                    <div class="text-[10px] text-gray-400">210401001</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm font-medium text-gray-600">PT. Tech Solutions</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold">75%</span>
                                <progress class="progress progress-success w-16 h-1.5" value="75" max="100"></progress>
                            </div>
                        </td>
                        <td>
                            <button onclick="showStudentDetail('Andi Saputra', '210401001', 'PT. Tech Solutions', 75, 'Software Development', 'Aktif Magang')" class="btn btn-ghost btn-xs text-[#6B21A8] font-bold">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar placeholder">
                                    <div class="bg-gray-100 text-gray-500 rounded-lg w-10">BR</div>
                                </div>
                                <div>
                                    <div class="font-bold text-sm">Budi Ramadhan</div>
                                    <div class="text-[10px] text-gray-400">210401045</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm font-medium text-gray-600">Bank Mandiri</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-bold">30%</span>
                                <progress class="progress progress-warning w-16 h-1.5" value="30" max="100"></progress>
                            </div>
                        </td>
                        <td>
                            <button onclick="showStudentDetail('Budi Ramadhan', '210401045', 'Bank Mandiri', 30, 'Financial Technology', 'Pendaftaran')" class="btn btn-ghost btn-xs text-[#6B21A8] font-bold">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section: Notifikasi Pengajuan -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="px-6 py-5 border-b border-base-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                Notifikasi Pengajuan
            </h3>
        </div>
        <div id="notificationList" class="p-4 space-y-4">
            <!-- Notif 1 -->
            <div id="notif-1" class="relative group flex gap-4 p-4 rounded-2xl bg-purple-50/50 border border-purple-100 hover:shadow-md transition-all cursor-pointer">
                <div onclick="window.location.href='/dosen/rekomendasi'" class="w-10 h-10 rounded-xl bg-white border border-purple-100 flex items-center justify-center text-[#6B21A8] shadow-sm shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div onclick="window.location.href='/dosen/rekomendasi'" class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-extrabold text-[#6B21A8] uppercase tracking-wider">Rekomendasi</span>
                        <span class="text-[10px] text-gray-400">10 Menit lalu</span>
                    </div>
                    <p class="text-sm font-bold text-gray-800 group-hover:text-[#6B21A8] transition-colors">Siti Aminah mengajukan Rekomendasi Magang</p>
                    <p class="text-xs text-gray-500 mt-1">NIM: 210401089 • Dosen Wali</p>
                </div>
                <button onclick="deleteNotif('notif-1')" class="btn btn-circle btn-xs btn-ghost text-gray-400 hover:text-red-500 hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Notif 2 -->
            <div id="notif-2" class="relative group flex gap-4 p-4 rounded-2xl bg-orange-50/50 border border-orange-100 hover:shadow-md transition-all cursor-pointer">
                <div onclick="window.location.href='/dosen/monitoring'" class="w-10 h-10 rounded-xl bg-white border border-orange-100 flex items-center justify-center text-[#F49E0A] shadow-sm shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                </div>
                <div onclick="window.location.href='/dosen/monitoring'" class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs font-extrabold text-[#F49E0A] uppercase tracking-wider">Laporan</span>
                        <span class="text-[10px] text-gray-400">2 Jam lalu</span>
                    </div>
                    <p class="text-sm font-bold text-gray-800 group-hover:text-[#F49E0A] transition-colors">Andi Saputra mengunggah Draft Laporan</p>
                    <p class="text-xs text-gray-500 mt-1">NIM: 210401001 • Pembimbing</p>
                </div>
                <button onclick="deleteNotif('notif-2')" class="btn btn-circle btn-xs btn-ghost text-gray-400 hover:text-red-500 hover:bg-red-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        </div>
        <div id="clearNotifAction" class="p-4 border-t border-base-100 bg-gray-50/30 text-center">
            <button onclick="clearAllNotif()" class="btn btn-sm btn-ghost text-gray-400 font-bold uppercase text-[10px] tracking-[0.1em]">Bersihkan Semua</button>
        </div>
    </div>
</div>

<!-- Modal Detail Mahasiswa -->
<dialog id="student_detail_modal" class="modal">
    <div class="modal-box bg-white max-w-2xl rounded-[2.5rem] p-0 overflow-hidden">
        <div class="bg-[#6B21A8] p-8 pb-12 relative">
            <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-sm btn-circle btn-ghost absolute right-4 top-4 text-white hover:bg-white/10">✕</button>
            <div class="flex items-center gap-6">
                <div id="modal_avatar" class="w-20 h-20 rounded-3xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-3xl font-black text-white shadow-xl">
                    AS
                </div>
                <div class="text-white">
                    <h3 id="modal_name" class="text-2xl font-black tracking-tight italic">Andi Saputra</h3>
                    <p id="modal_nim" class="text-white/70 font-bold tracking-[0.2em] text-xs uppercase mt-1">210401001 • TEKNIK INFORMATIKA</p>
                </div>
            </div>
        </div>
        
        <div class="p-8 -mt-6 bg-white rounded-[2.5rem] relative">
            <div class="grid grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Perusahaan</p>
                        <p id="modal_company" class="font-bold text-gray-800 italic">PT. Teknologi Maju Persada</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Bidang Usaha</p>
                        <p id="modal_field" class="font-bold text-gray-700 text-sm">Software Development</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Status Magang</p>
                        <span id="modal_status" class="badge badge-success badge-outline font-black text-[9px] uppercase tracking-widest px-3 py-3 border-2">Aktif Magang</span>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Progress</p>
                        <div class="flex items-center gap-3">
                            <span id="modal_progress_text" class="text-xl font-black text-gray-800">85%</span>
                            <progress id="modal_progress_bar" class="progress progress-primary h-2 flex-1" value="85" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-100 flex gap-3">
                <button onclick="window.location.href='/dosen/monitoring'" class="btn bg-[#6B21A8] hover:bg-purple-700 border-none text-white flex-1 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] rounded-2xl shadow-lg shadow-purple-100">Monitoring Progress</button>
                <button onclick="document.getElementById('student_detail_modal').close()" class="btn btn-ghost flex-1 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] text-gray-400 rounded-2xl">Tutup</button>
            </div>
        </div>
    </div>
</dialog>

<script>
function showStudentDetail(name, nim, company, progress, field, status) {
    document.getElementById('modal_name').innerText = name;
    document.getElementById('modal_nim').innerText = nim + ' • TEKNIK INFORMATIKA';
    document.getElementById('modal_company').innerText = company;
    document.getElementById('modal_field').innerText = field;
    document.getElementById('modal_progress_text').innerText = progress + '%';
    document.getElementById('modal_progress_bar').value = progress;
    document.getElementById('modal_avatar').innerText = name.split(' ').map(n => n[0]).join('').toUpperCase();
    
    const statusBadge = document.getElementById('modal_status');
    statusBadge.innerText = status;
    if (status.toLowerCase().includes('aktif')) {
        statusBadge.className = 'badge badge-success badge-outline font-black text-[9px] uppercase tracking-widest px-3 py-3 border-2';
    } else {
        statusBadge.className = 'badge badge-warning badge-outline font-black text-[9px] uppercase tracking-widest px-3 py-3 border-2 text-orange-600 border-orange-200';
    }

    document.getElementById('student_detail_modal').showModal();
}

function deleteNotif(id) {
    const notif = document.getElementById(id);
    if (notif) {
        notif.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            notif.remove();
            checkEmptyNotif();
        }, 300);
    }
}

function clearAllNotif() {
    if (confirm('Bersihkan semua notifikasi?')) {
        const list = document.getElementById('notificationList');
        list.innerHTML = `
            <div class="py-12 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Tidak ada notifikasi baru</p>
            </div>
        `;
        document.getElementById('clearNotifAction').classList.add('hidden');
    }
}

function checkEmptyNotif() {
    const list = document.getElementById('notificationList');
    if (list.children.length === 0) {
        list.innerHTML = `
            <div class="py-12 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-300 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" /></svg>
                </div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-widest">Tidak ada notifikasi baru</p>
            </div>
        `;
        document.getElementById('clearNotifAction').classList.add('hidden');
    }
}
</script>
@endsection
