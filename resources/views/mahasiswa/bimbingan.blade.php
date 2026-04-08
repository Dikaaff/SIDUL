@extends('layouts.app')

@section('title', 'Bimbingan Akademik')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Bimbingan Dosen 🎓
        </h2>
        <p class="text-gray-700 font-medium text-sm">Ajukan jadwal pertemuan dan unggah file revisi laporan Anda kepada Dosen Pembimbing.</p>
    </div>
    <div class="flex gap-2">
        <div class="bg-purple-50 text-[#6B21A8] py-3 px-5 rounded-2xl flex items-center gap-3 border border-purple-100 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm">
                <span class="text-xs font-black">BS</span>
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-purple-400 block mb-0.5">Dosen Wali</span>
                <span class="font-black text-sm">Dr. Budi Santoso</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Bimbingan</li>
  </ul>
</div>
@endsection

@section('content')
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
    
    <!-- Left Column: Form Pengajuan Jadwal -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 md:p-8 flex flex-col h-fit">
        <h3 class="font-black text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-4 mb-6">
            <span class="w-1.5 h-6 bg-[#F49E0A] rounded-full inline-block"></span>
            Ajukan Jadwal Pertemuan
        </h3>

        <form action="#" method="POST" class="space-y-6" onsubmit="submitJadwal(event)">
            <div>
                <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Topik Bimbingan <span class="text-red-500">*</span></label>
                <input type="text" id="topik" placeholder="Contoh: Revisi Bab 1 & 2" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#F49E0A] outline-none transition-all" required />
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Tanggal Pengajuan <span class="text-red-500">*</span></label>
                <input type="date" id="tanggal" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#F49E0A] outline-none transition-all" required />
            </div>

            <div>
                <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">Waktu (Jam) <span class="text-red-500">*</span></label>
                <input type="time" id="waktu" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#F49E0A] outline-none transition-all" required />
            </div>

            <div class="pt-2">
                <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-widest mb-2">File Laporan (Opsional)</label>
                <div class="flex items-center justify-center w-full">
                    <label for="bimbingan-file" id="dropzone-label" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-orange-50 hover:border-[#F49E0A] transition-colors group px-4 text-center">
                        <div class="flex items-center justify-center text-gray-600 group-hover:text-[#F49E0A] gap-2" id="dropzone-content">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <span class="text-xs font-bold uppercase tracking-widest">Upload PDF</span>
                        </div>
                        <input id="bimbingan-file" type="file" class="hidden" accept=".pdf" onchange="handleFileSelect(this)" />
                    </label>
                </div>
            </div>

            <button type="submit" id="btnSubmitBimbingan" class="w-full bg-[#F49E0A] hover:bg-orange-600 text-white rounded-xl py-3.5 px-8 font-black text-xs uppercase tracking-widest shadow-xl shadow-orange-900/20 hover:scale-[1.02] active:scale-95 transition-all mt-4 disabled:bg-orange-300 flex items-center justify-center gap-2">
                <span id="labelBtn">Kirim Pengajuan</span>
                <span id="loaderBtn" class="loading loading-spinner loading-xs hidden"></span>
            </button>
        </form>
    </div>

    <!-- Right Column: Riwayat Bimbingan -->
    <div class="lg:col-span-2 bg-white rounded-[2rem] shadow-sm border border-gray-100 p-0 overflow-hidden flex flex-col">
        <div class="p-6 md:p-8 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-black text-gray-800 text-lg flex items-center gap-2">
                <span class="w-1.5 h-6 bg-[#6B21A8] rounded-full inline-block"></span>
                Riwayat & Jadwal Pertemuan
            </h3>
        </div>

        <div class="flex-1 overflow-x-auto p-6 md:p-8">
            <table class="w-full text-left border-collapse min-w-[500px]">
                <thead>
                    <tr>
                        <th class="pb-4 text-[10px] font-black uppercase tracking-widest text-gray-600 border-b border-gray-100">Topik</th>
                        <th class="pb-4 text-[10px] font-black uppercase tracking-widest text-gray-600 border-b border-gray-100">Jadwal</th>
                        <th class="pb-4 text-[10px] font-black uppercase tracking-widest text-gray-600 border-b border-gray-100">Status</th>
                        <th class="pb-4 text-[10px] font-black uppercase tracking-widest text-gray-600 border-b border-gray-100 text-right">Lampiran</th>
                    </tr>
                </thead>
                <tbody id="bimbinganList">
                    <tr id="emptyBimbingan" class="group">
                        <td colspan="4" class="py-16 text-center animate-in fade-in slide-in-from-bottom-4 duration-500">
                            <div class="w-20 h-20 rounded-[1.5rem] bg-orange-50 flex items-center justify-center text-[#F49E0A] mx-auto mb-6 border border-orange-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            
                            <h3 class="text-xl font-black text-gray-800 mb-2">Belum Ada Jadwal</h3>
                            <p class="text-gray-500 font-bold text-sm max-w-sm mx-auto mb-4">Silakan ajukan jadwal pertemuan dengan Dosen Wali melalui form di sebelah kiri.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999] space-y-4">
    <!-- Success Notif -->
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300 transition-all">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2rem] shadow-2xl border border-white/10 min-w-[340px]">
            <div class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest">Berhasil!</p>
                <p class="text-xs text-gray-400 font-bold mt-0.5">Pengajuan bimbingan telah dikirim.</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Inisialisasi data dari Local Storage
    let bimbingans = JSON.parse(localStorage.getItem('sidul_bimbingans')) || [];

    function renderBimbinganTable() {
        const tbody = document.getElementById('bimbinganList');
        tbody.innerHTML = '';
        
        if (bimbingans.length === 0) {
            tbody.innerHTML = `
                <tr id="emptyBimbingan" class="group">
                    <td colspan="4" class="py-16 text-center animate-in fade-in slide-in-from-bottom-4 duration-500">
                        <div class="w-20 h-20 rounded-[1.5rem] bg-orange-50 flex items-center justify-center text-[#F49E0A] mx-auto mb-6 border border-orange-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-xl font-black text-gray-800 mb-2">Belum Ada Jadwal</h3>
                        <p class="text-gray-500 font-bold text-sm max-w-sm mx-auto mb-4">Silakan ajukan jadwal pertemuan dengan Dosen Wali melalui form di sebelah kiri.</p>
                    </td>
                </tr>
            `;
            return;
        }

        // Urutkan dari yang terbaru
        [...bimbingans].reverse().forEach(item => {
            const tr = document.createElement('tr');
            tr.className = "group hover:bg-gray-50 transition-colors animate-in fade-in slide-in-from-left-4";
            tr.innerHTML = `
                <td class="py-5 border-b border-gray-50 px-4">
                    <p class="font-bold text-gray-800 text-sm">${item.topik}</p>
                    <p class="text-[10px] text-gray-500 font-medium italic">${item.createdAt}</p>
                </td>
                <td class="py-5 border-b border-gray-50">
                    <div class="flex items-center gap-2 text-sm font-bold text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        ${formatDateDisplay(item.tanggal)}, ${item.waktu}
                    </div>
                </td>
                <td class="py-5 border-b border-gray-50">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest bg-yellow-50 text-yellow-600 border border-yellow-200">
                        ${item.status}
                    </span>
                </td>
                <td class="py-5 border-b border-gray-50 text-right px-4">
                    ${item.fileName ? `
                        <button onclick="viewFile('${item.fileName}', '${item.fileSize}')" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest bg-purple-50 text-[#6B21A8] border border-purple-100 hover:bg-[#6B21A8] hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Lihat PDF
                        </button>
                    ` : '<span class="text-[10px] text-gray-400 font-bold">TIDAK ADA FILE</span>'}
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function formatDateDisplay(dateStr) {
        const dateObj = new Date(dateStr);
        return dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
    }

    function submitJadwal(event) {
        event.preventDefault();
        
        const btn = document.getElementById('btnSubmitBimbingan');
        const label = document.getElementById('labelBtn');
        const loader = document.getElementById('loaderBtn');
        const notif = document.getElementById('successNotif');

        // Start Loading
        btn.disabled = true;
        label.innerText = "Mengirim...";
        loader.classList.remove('hidden');

        const topik = document.getElementById('topik').value;
        const tanggal = document.getElementById('tanggal').value;
        const waktu = document.getElementById('waktu').value;
        const fileInput = document.getElementById('bimbingan-file');
        
        let fileName = null;
        let fileSize = null;
        if (fileInput.files.length > 0) {
            fileName = fileInput.files[0].name;
            fileSize = (fileInput.files[0].size / 1024 / 1024).toFixed(2) + ' MB';
        }

        setTimeout(() => {
            const newBimbingan = {
                id: Date.now(),
                topik,
                tanggal,
                waktu,
                fileName,
                fileSize,
                status: 'Menunggu ACC',
                createdAt: 'Baru Saja'
            };

            bimbingans.push(newBimbingan);
            localStorage.setItem('sidul_bimbingans', JSON.stringify(bimbingans));
            
            renderBimbinganTable();
            
            // End Loading
            btn.disabled = false;
            label.innerText = "Kirim Pengajuan";
            loader.classList.add('hidden');

            notif.classList.remove('hidden');
            setTimeout(() => notif.classList.add('hidden'), 3000);

            event.target.reset();
            resetFile();
        }, 800);
    }

    function viewFile(name, size) {
        alert(`📂 Simulasi Membuka File:\nNama: ${name}\nUkuran: ${size}\n\n(File akan benar-benar bisa dibuka setelah ditarik dari Cloud Storage Backend)`);
    }

    function handleFileSelect(input) {
        const dropzone = document.getElementById('dropzone-label');
        const content = document.getElementById('dropzone-content');
        
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            dropzone.classList.add('border-[#F49E0A]', 'bg-orange-50');
            content.innerHTML = `
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <div class="flex flex-col text-left">
                    <span class="text-[10px] font-bold text-gray-800 truncate max-w-[150px]">${fileName}</span>
                    <span class="text-[8px] font-black text-green-600 uppercase tracking-widest">Attached</span>
                </div>
            `;
        }
    }

    function resetFile() {
        const dropzone = document.getElementById('dropzone-label');
        const content = document.getElementById('dropzone-content');
        dropzone.classList.remove('border-[#F49E0A]', 'bg-orange-50');
        content.innerHTML = `
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
            <span class="text-xs font-bold uppercase tracking-widest">Upload PDF</span>
        `;
    }

    // Initial Render
    renderBimbinganTable();
</script>
@endsection
