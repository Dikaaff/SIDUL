@extends('layouts.app')

@section('title', 'Logbook Magang')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Logbook Harian 📝
        </h2>
        <p class="text-gray-700 font-medium text-sm">Catat aktivitas harian, kendala, dan pekerjaan magang Anda.</p>
    </div>
    <button onclick="document.getElementById('logbook_modal').showModal()" class="w-full md:w-auto btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none px-8 rounded-xl shadow-xl shadow-purple-900/20 font-bold uppercase tracking-wider text-xs h-12 h-min-0 transition-transform hover:scale-[1.02]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Logbook
    </button>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Logbook</li>
  </ul>
</div>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full text-black min-w-[700px]">
                <thead>
                    <tr class="text-gray-600 font-black text-[10px] uppercase tracking-widest bg-gray-50/80 border-b border-gray-100">
                        <th class="py-5 pl-8">Tanggal</th>
                        <th>Aktivitas Harian</th>
                        <th>Kendala</th>
                        <th>Pekerjaan</th>
                        <th class="text-center pr-8 w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody id="logbookTableBody">
                    <!-- Data loaded via JS -->
                </tbody>
            </table>
        </div>
        <div id="emptyState" class="hidden py-32 flex flex-col items-center justify-center text-center animate-in fade-in slide-in-from-bottom-4 duration-500">
            <div class="w-20 h-20 rounded-[1.5rem] bg-purple-50 flex items-center justify-center text-[#6B21A8] mb-6 border border-purple-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            <h3 class="text-xl font-black text-gray-800 mb-2">Logbook Kosong</h3>
            <p class="text-gray-500 font-bold text-sm mb-8 max-w-md">Anda belum memiliki catatan aktivitas apapun.</p>
            
            <button onclick="document.getElementById('logbook_modal').showModal()" class="btn bg-purple-100 hover:bg-purple-200 text-[#6B21A8] border-none px-6 rounded-xl font-black uppercase tracking-widest text-xs h-12">
                Buat Logbook Pertama
            </button>
        </div>
    </div>
</div>

<!-- Modal: Form Logbook -->
<dialog id="logbook_modal" class="modal">
  <div class="modal-box bg-white w-11/12 max-w-2xl rounded-[2rem] p-8">
    <div class="flex items-center justify-between mb-8">
        <h3 id="modalTitle" class="font-black text-xl text-gray-900 flex items-center gap-3">
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
            <label class="label"><span class="label-text font-black text-gray-900 text-[10px] uppercase tracking-widest pl-1">Tanggal Kegiatan</span></label>
            <input type="date" id="logDate" class="input input-bordered w-full bg-gray-50 border-gray-200 text-gray-900 font-bold focus:border-[#6B21A8] h-12" required />
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-black text-gray-900 text-[10px] uppercase tracking-widest pl-1">Aktivitas Harian</span></label>
            <textarea id="logActivity" placeholder="Ceritakan detail aktivitas Anda hari ini..." class="textarea textarea-bordered h-32 bg-gray-50 border-gray-200 text-gray-900 font-bold focus:border-[#6B21A8] p-4 resize-none" required></textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="form-control">
                <label class="label"><span class="label-text font-black text-gray-900 text-[10px] uppercase tracking-widest pl-1">Kendala Magang</span></label>
                <input type="text" id="logTrouble" placeholder="e.g. Tidak ada" class="input input-bordered w-full bg-gray-50 border-gray-200 text-gray-900 font-bold focus:border-[#6B21A8] h-12" required />
            </div>
            <div class="form-control">
                <label class="label"><span class="label-text font-black text-gray-900 text-[10px] uppercase tracking-widest pl-1">Pekerjaan / Output</span></label>
                <input type="text" id="logOutput" placeholder="e.g. Desain UI" class="input input-bordered w-full bg-gray-50 border-gray-200 text-gray-900 font-bold focus:border-[#6B21A8] h-12" required />
            </div>
        </div>
        
        <div class="flex flex-col-reverse md:flex-row items-center justify-end gap-3 pt-8 border-t border-gray-100 mt-8">
            <button type="button" onclick="document.getElementById('logbook_modal').close()" class="btn btn-ghost w-full md:w-32 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] text-gray-700 hover:text-gray-900 hover:bg-gray-100/50 rounded-2xl">
                Batal
            </button>
            <button type="submit" id="btnSaveLogbook" class="btn bg-[#F49E0A] hover:bg-orange-600 border-none text-white w-full md:w-56 h-12 min-h-0 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-orange-100 rounded-2xl group transition-all disabled:bg-orange-300">
                <span id="labelBtnLogbook" class="flex items-center gap-2">
                    Simpan Logbook
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </span>
                <span id="loadingBtnLogbook" class="hidden loading loading-spinner loading-xs"></span>
            </button>
        </div>
    </form>
  </div>
</dialog>

<!-- Notification Toast removed (Now handled globally in layout) -->


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
                <p class="text-xs font-bold text-gray-700 truncate group-hover:text-gray-800 transition-colors">${log.activity}</p>
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
                    <button onclick="deleteLogbook(${log.id}, this)" class="btn btn-square btn-ghost btn-xs text-red-500 hover:bg-red-50 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 icon-trash" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16" /></svg>
                        <span class="loading loading-spinner loading-xs hidden loader-delete"></span>
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
    const btn = document.getElementById('btnSaveLogbook');
    const label = document.getElementById('labelBtnLogbook');
    const loading = document.getElementById('loadingBtnLogbook');
    
    // Start Loading
    btn.disabled = true;
    label.classList.add('hidden');
    loading.classList.remove('hidden');

    const id = document.getElementById('editId').value;
    const date = document.getElementById('logDate').value;
    const activity = document.getElementById('logActivity').value;
    const trouble = document.getElementById('logTrouble').value;
    const output = document.getElementById('logOutput').value;

    setTimeout(() => {
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
        
        // Reset Button
        btn.disabled = false;
        label.classList.remove('hidden');
        loading.classList.add('hidden');
        
        document.getElementById('logbook_modal').close();
        event.target.reset();
        document.getElementById('editId').value = '';
        renderTable();
    }, 800);
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

function deleteLogbook(id, btn) {
    if (confirm('Apakah Anda yakin ingin menghapus catatan ini?')) {
        const icon = btn.querySelector('.icon-trash');
        const loader = btn.querySelector('.loader-delete');
        
        // Start Loading
        btn.disabled = true;
        icon.classList.add('hidden');
        loader.classList.remove('hidden');

        setTimeout(() => {
            logbooks = logbooks.filter(l => l.id != id);
            localStorage.setItem('sidul_logbooks', JSON.stringify(logbooks));
            renderTable();
            showNotif('Catatan logbook dihapus');
        }, 800);
    }
}

function showNotif(message) {
    showToast('success', message);
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
