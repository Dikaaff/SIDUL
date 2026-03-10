@extends('layouts.app')

@section('title', 'Logbook Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Logbook Magang 📝
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Catat aktivitas harian, kendala, dan pekerjaan magang Anda.</p>
    </div>
    <button onclick="document.getElementById('logbook_modal').showModal()" class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none px-6 shadow-lg shadow-orange-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Logbook
    </button>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200">
    <div class="card-body p-0">
        <div class="overflow-x-auto">
            <table class="table w-full text-black">
                <thead>
                    <tr class="text-gray-400 font-black text-[10px] uppercase tracking-[0.2em] bg-gray-50/50 border-b border-gray-100">
                        <th class="py-5 pl-8">Tanggal</th>
                        <th>Aktivitas Harian</th>
                        <th>Kendala</th>
                        <th>Pekerjaan</th>
                        <th class="text-center pr-8">Aksi</th>
                    </tr>
                </thead>
                <tbody id="logbookTableBody">
                    <!-- Data loaded via JS -->
                </tbody>
            </table>
        </div>
        <div id="emptyState" class="hidden py-20 flex flex-col items-center justify-center text-center">
            <div class="w-20 h-20 rounded-3xl bg-gray-50 flex items-center justify-center text-gray-300 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <p class="text-gray-400 font-bold text-sm">Belum ada catatan logbook.</p>
        </div>
    </div>
</div>

<!-- Modal: Form Logbook -->
<dialog id="logbook_modal" class="modal">
  <div class="modal-box bg-white w-11/12 max-w-2xl rounded-[2rem] p-8">
    <div class="flex items-center justify-between mb-8">
        <h3 id="modalTitle" class="font-black text-xl text-gray-800 flex items-center gap-3">
            <span class="w-2 h-6 bg-[#6B21A8] rounded-full"></span>
            Tambah Catatan Logbook
        </h3>
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost">✕</button>
        </form>
    </div>
    
    <form id="logbookForm" onsubmit="saveLogbook(event)" class="space-y-6">
        <input type="hidden" id="editId" value="">
        <div class="form-control">
            <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest pl-1">Tanggal Kegiatan</span></label>
            <input type="date" id="logDate" class="input input-bordered w-full bg-gray-50 border-gray-200 text-gray-800 font-bold focus:border-[#6B21A8] h-12" required />
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest pl-1">Aktivitas Harian</span></label>
            <textarea id="logActivity" placeholder="Ceritakan detail aktivitas Anda hari ini..." class="textarea textarea-bordered h-32 bg-gray-50 border-gray-200 text-gray-800 font-bold focus:border-[#6B21A8] p-4 resize-none" required></textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-control">
                <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest pl-1">Kendala Magang</span></label>
                <input type="text" id="logTrouble" placeholder="e.g. Tidak ada" class="input input-bordered w-full bg-gray-50 border-gray-200 text-gray-800 font-bold focus:border-[#6B21A8] h-12" required />
            </div>
            <div class="form-control">
                <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest pl-1">Pekerjaan / Output</span></label>
                <input type="text" id="logOutput" placeholder="e.g. Desain UI" class="input input-bordered w-full bg-gray-50 border-gray-200 text-gray-800 font-bold focus:border-[#6B21A8] h-12" required />
            </div>
        </div>
        
        <div class="flex flex-col-reverse md:flex-row items-center justify-end gap-3 pt-8 border-t border-gray-100 mt-8">
            <button type="button" onclick="document.getElementById('logbook_modal').close()" class="btn btn-ghost w-full md:w-32 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] text-gray-400 hover:text-gray-600 hover:bg-gray-100/50 rounded-2xl">
                Batal
            </button>
            <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-600 border-none text-white w-full md:w-56 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-orange-100 rounded-2xl group transition-all">
                <span id="submitBtnText">Simpan Logbook</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </button>
        </div>
    </form>
  </div>
</dialog>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999] space-y-4">
    <!-- Success Notif -->
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2rem] shadow-2xl border border-white/10 min-w-[340px]">
            <div class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest">Berhasil!</p>
                <p id="successMessage" class="text-xs text-gray-400 font-bold mt-0.5">Catatan telah disimpan.</p>
            </div>
        </div>
    </div>
</div>

<script>
let logbooks = JSON.parse(localStorage.getItem('sidul_logbooks')) || [
    { id: 1, date: '2026-03-09', activity: 'Mempelajari framework Laravel untuk pengembangan sistem...', trouble: 'Konfigurasi DB Error', output: 'Setup Environment' },
    { id: 2, date: '2026-03-08', activity: 'Membuat desain UI untuk dashboard mahasiswa menggunakan...', trouble: 'Tidak ada', output: 'Frontend Design' }
];

function renderTable() {
    const tbody = document.getElementById('logbookTableBody');
    const emptyState = document.getElementById('emptyState');
    tbody.innerHTML = '';
    
    if (logbooks.length === 0) {
        emptyState.classList.remove('hidden');
        return;
    }
    emptyState.classList.add('hidden');

    logbooks.sort((a, b) => new Date(b.date) - new Date(a.date)).forEach(log => {
        const tr = document.createElement('tr');
        tr.className = "hover:bg-gray-50/50 transition-colors border-b border-gray-100 group";
        tr.innerHTML = `
            <td class="py-5 pl-8">
                <div class="flex flex-col">
                    <span class="font-black text-gray-800 text-sm italic">${formatDate(log.date)}</span>
                </div>
            </td>
            <td class="max-w-[300px]">
                <p class="text-xs font-bold text-gray-500 truncate group-hover:text-gray-800 transition-colors">${log.activity}</p>
            </td>
            <td>
                <span class="text-[10px] font-black uppercase tracking-widest ${log.trouble.toLowerCase() === 'tidak ada' ? 'text-green-500' : 'text-red-500'} bg-gray-50 px-3 py-1 rounded-full border border-gray-100">
                    ${log.trouble}
                </span>
            </td>
            <td>
                <span class="text-xs font-bold text-gray-700">${log.output}</span>
            </td>
            <td class="text-center pr-8">
                <div class="flex items-center justify-center gap-2">
                    <button onclick="editLogbook(${log.id})" class="btn btn-square btn-ghost btn-xs text-blue-500 hover:bg-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </button>
                    <button onclick="deleteLogbook(${log.id})" class="btn btn-square btn-ghost btn-xs text-red-500 hover:bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function formatDate(dateStr) {
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    return new Date(dateStr).toLocaleDateString('id-ID', options);
}

function saveLogbook(event) {
    event.preventDefault();
    const id = document.getElementById('editId').value;
    const date = document.getElementById('logDate').value;
    const activity = document.getElementById('logActivity').value;
    const trouble = document.getElementById('logTrouble').value;
    const output = document.getElementById('logOutput').value;

    if (id) {
        const index = logbooks.findIndex(l => l.id == id);
        logbooks[index] = { id: parseInt(id), date, activity, trouble, output };
        showNotif('Catatan logbook diperbarui');
    } else {
        const newLog = {
            id: Date.now(),
            date,
            activity,
            trouble,
            output
        };
        logbooks.push(newLog);
        showNotif('Logbook berhasil disimpan');
    }

    localStorage.setItem('sidul_logbooks', JSON.stringify(logbooks));
    document.getElementById('logbook_modal').close();
    event.target.reset();
    document.getElementById('editId').value = '';
    renderTable();
}

function editLogbook(id) {
    const log = logbooks.find(l => l.id == id);
    if (log) {
        document.getElementById('modalTitle').innerHTML = '<span class="w-2 h-6 bg-[#6B21A8] rounded-full"></span> Edit Catatan Logbook';
        document.getElementById('editId').value = log.id;
        document.getElementById('logDate').value = log.date;
        document.getElementById('logActivity').value = log.activity;
        document.getElementById('logTrouble').value = log.trouble;
        document.getElementById('logOutput').value = log.output;
        document.getElementById('logbook_modal').showModal();
    }
}

function deleteLogbook(id) {
    if (confirm('Apakah Anda yakin ingin menghapus catatan ini?')) {
        logbooks = logbooks.filter(l => l.id != id);
        localStorage.setItem('sidul_logbooks', JSON.stringify(logbooks));
        renderTable();
        showNotif('Catatan logbook dihapus');
    }
}

function showNotif(message) {
    const notif = document.getElementById('successNotif');
    document.getElementById('successMessage').innerText = message;
    notif.classList.remove('hidden');
    setTimeout(() => notif.classList.add('hidden'), 2000);
}

// Reset title when opening modal for adding
document.querySelector('button[onclick*="showModal"]').addEventListener('click', () => {
    document.getElementById('modalTitle').innerHTML = '<span class="w-2 h-6 bg-[#6B21A8] rounded-full"></span> Tambah Catatan Logbook';
    document.getElementById('editId').value = '';
    document.getElementById('logbookForm').reset();
});

// Initial Render
renderTable();
</script>
@endsection
