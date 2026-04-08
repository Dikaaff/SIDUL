@extends('layouts.app')

@section('title', 'Unggah Laporan Akhir')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Unggah Laporan 📂
        </h2>
        <p class="text-gray-500 font-medium text-sm">Upload laporan akhir dan lembar pengesahan yang sudah ditandatangani.</p>
    </div>
    <div class="flex gap-2">
        <a href="#" class="bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-100 transition-colors py-3 px-5 rounded-2xl flex items-center gap-3 shadow-sm group">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
            </div>
            <div>
                <span class="text-[10px] font-bold uppercase tracking-widest text-blue-400 block mb-0.5">Template</span>
                <span class="font-black text-sm">Download Format</span>
            </div>
        </a>
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Laporan</li>
  </ul>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Final Report Card -->
    <div class="card bg-white shadow-sm border border-base-200 rounded-[2.5rem] overflow-hidden transition-all hover:shadow-xl hover:shadow-purple-100/20 group">
        <div class="card-body p-8">
            <div class="w-16 h-16 rounded-[2rem] bg-purple-50 flex items-center justify-center text-[#6B21A8] mb-6 group-hover:scale-110 transition-transform duration-500 shadow-sm border border-purple-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
            </div>
            
            <h3 class="font-black text-xl text-gray-800 mb-2">Laporan Akhir</h3>
            <p class="text-[11px] text-gray-400 font-bold mb-8 leading-relaxed">File laporan lengkap hasil magang Anda dalam format PDF.</p>
            
            <form onsubmit="handleReportUpload(event, 'laporan_akhir', 'Laporan Akhir')" class="space-y-6">
                <div class="form-control">
                    <label class="block text-[10px] font-black text-gray-900 uppercase tracking-widest mb-3 pl-1">Unggah Dokumen (PDF)</label>
                    <label for="file-laporan" id="dropzone-laporan" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer bg-gray-50 hover:bg-purple-50 hover:border-[#6B21A8] transition-all group/drop px-4 text-center">
                        <div class="flex flex-col items-center justify-center gap-2 text-gray-400 group-hover/drop:text-[#6B21A8]" id="content-laporan">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Klik atau Seret PDF</span>
                        </div>
                        <input id="file-laporan" type="file" accept=".pdf" class="hidden" onchange="handleFileSelect(this, 'laporan')" required />
                    </label>
                </div>
                <button type="submit" id="btn-laporan" class="btn bg-[#F49E0A] hover:bg-orange-600 border-none text-white w-full h-12 min-h-0 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-orange-100 group flex items-center justify-center gap-2">
                    <span class="btn-label">Upload Laporan</span>
                    <span class="loading loading-spinner loading-xs hidden"></span>
                </button>
            </form>
        </div>
    </div>

    <!-- Signed Report Card -->
    <div class="card bg-white shadow-sm border border-base-200 rounded-[2.5rem] overflow-hidden transition-all hover:shadow-xl hover:shadow-purple-100/20 group text-black">
        <div class="card-body p-8">
            <div class="w-16 h-16 rounded-[2rem] bg-green-50 flex items-center justify-center text-green-600 mb-6 group-hover:scale-110 transition-transform duration-500 shadow-sm border border-green-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
            </div>
            
            <h3 class="font-black text-xl text-gray-800 mb-2">Laporan Ditandatangani</h3>
            <p class="text-[11px] text-gray-400 font-bold mb-8 leading-relaxed">Lembar pengesahan yang sudah ditandatangani basah/digital.</p>
            
            <form onsubmit="handleReportUpload(event, 'laporan_pengesahan', 'Laporan Pengesahan')" class="space-y-6">
                <div class="form-control">
                    <label class="block text-[10px] font-black text-gray-900 uppercase tracking-widest mb-3 pl-1">Unggah Pengesahan (PDF)</label>
                    <label for="file-pengesahan" id="dropzone-pengesahan" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer bg-gray-50 hover:bg-green-50 hover:border-green-500 transition-all group/drop px-4 text-center">
                        <div class="flex flex-col items-center justify-center gap-2 text-gray-400 group-hover/drop:text-green-600" id="content-pengesahan">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Klik atau Seret PDF</span>
                        </div>
                        <input id="file-pengesahan" type="file" accept=".pdf" class="hidden" onchange="handleFileSelect(this, 'pengesahan')" required />
                    </label>
                </div>
                <button type="submit" id="btn-pengesahan" class="btn bg-[#F49E0A] hover:bg-orange-600 border-none text-white w-full h-12 min-h-0 font-black uppercase tracking-widest text-[10px] shadow-xl shadow-orange-100 group flex items-center justify-center gap-2">
                    <span class="btn-label">Upload Dokumen</span>
                    <span class="loading loading-spinner loading-xs hidden"></span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Info Alert -->
<div class="mt-12 bg-purple-50 p-6 rounded-[2rem] border border-purple-100 flex items-start gap-5 max-w-4xl mx-auto shadow-sm animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="w-12 h-12 rounded-2xl bg-white border border-purple-100 flex items-center justify-center text-[#6B21A8] shadow-sm shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    </div>
    <div>
        <h4 class="font-extrabold text-[#6B21A8] text-sm uppercase tracking-wider mb-1 px-1">Informasi Penting 💡</h4>
        <p class="text-[11px] text-purple-900/70 font-bold leading-relaxed px-1">
            Harap periksa kembali isi laporan sebelum mengunggah. Laporan yang sudah diunggah akan masuk ke tahap review Dosen Pembimbing untuk mendapatkan persetujuan akhir. Pastikan kualitas scan pada lembar pengesahan terlihat jelas.
        </p>
    </div>
</div>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999] space-y-4">
    <!-- Success Notif -->
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2rem] shadow-2xl border border-white/10 min-w-[340px]">
            <div class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-white">Berhasil!</p>
                <p id="successMessage" class="text-xs text-gray-400 font-bold mt-0.5">Laporan berhasil diunggah.</p>
            </div>
        </div>
    </div>

    <!-- Error Notif -->
    <div id="errorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2rem] shadow-2xl border border-white/10 min-w-[340px]">
            <div class="w-12 h-12 rounded-2xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-10a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-white">Gagal!</p>
                <p id="errorMessage" class="text-xs text-gray-400 font-bold mt-0.5">Terjadi kesalahan pada file.</p>
            </div>
        </div>
    </div>
</div>

<script>
function handleFileSelect(input, type) {
    const dropzone = document.getElementById('dropzone-' + type);
    const content = document.getElementById('content-' + type);
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Show selected file state
        dropzone.classList.add(type === 'laporan' ? 'border-[#6B21A8]' : 'border-green-500');
        dropzone.classList.add(type === 'laporan' ? 'bg-purple-50' : 'bg-green-50');
        
        content.innerHTML = `
            <svg class="w-6 h-6 ${type === 'laporan' ? 'text-[#6B21A8]' : 'text-green-600'}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <div class="flex flex-col items-center">
                <span class="text-[10px] font-bold text-gray-800 truncate max-w-[200px]">${file.name}</span>
                <span class="text-[8px] font-black ${type === 'laporan' ? 'text-purple-600' : 'text-green-600'} uppercase">Terpilih</span>
            </div>
        `;
    }
}

function handleReportUpload(event, key, title) {
    event.preventDefault();
    const form = event.target;
    const btn = form.querySelector('button[type="submit"]');
    const label = btn.querySelector('.btn-label');
    const loader = btn.querySelector('.loading');
    const fileInput = form.querySelector('input[type="file"]');
    const file = fileInput.files[0];
    
    if (file) {
        // Validasi
        const maxSize = 20 * 1024 * 1024;
        if (file.size > maxSize) {
            showNotif('error', 'Ukuran file melebihi 20MB.');
            return;
        }
        if (file.type !== 'application/pdf') {
            showNotif('error', 'Format file harus berupa PDF.');
            return;
        }

        // Start Loading Logic
        btn.disabled = true;
        label.innerText = 'Mengunggah...';
        loader.classList.remove('hidden');

        setTimeout(() => {
            // Success Logic
            showNotif('success', title + ' berhasil diunggah.');
            
            // Save status to LocalStorage
            let reportsStatus = JSON.parse(localStorage.getItem('sidul_reports')) || {};
            reportsStatus[key] = true;
            localStorage.setItem('sidul_reports', JSON.stringify(reportsStatus));

            // End Loading
            btn.disabled = false;
            label.innerText = key === 'laporan_akhir' ? 'Upload Laporan' : 'Upload Dokumen';
            loader.classList.add('hidden');
            
            form.reset();
            resetDropzone(key === 'laporan_akhir' ? 'laporan' : 'pengesahan');
        }, 800);
    }
}

function resetDropzone(type) {
    const dropzone = document.getElementById('dropzone-' + type);
    const content = document.getElementById('content-' + type);
    dropzone.className = `flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer bg-gray-50 hover:bg-${type === 'laporan' ? 'purple' : 'green'}-50 hover:border-${type === 'laporan' ? '[#6B21A8]' : 'green-500'} transition-all group/drop px-4 text-center`;
    content.innerHTML = `
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
        <span class="text-[10px] font-bold uppercase tracking-widest">Klik atau Seret PDF</span>
    `;
}

function showNotif(type, message = '') {
    const success = document.getElementById('successNotif');
    const error = document.getElementById('errorNotif');
    
    if (type === 'success') {
        document.getElementById('successMessage').innerText = message;
        success.classList.remove('hidden');
        setTimeout(() => success.classList.add('hidden'), 2000);
    } else {
        document.getElementById('errorMessage').innerText = message;
        error.classList.remove('hidden');
        setTimeout(() => error.classList.add('hidden'), 2000);
    }
}
</script>
@endsection
