@extends('layouts.app')

@section('title', 'Konsultasi Dosen Wali')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Konsultasi Dosen Wali 👨‍🏫
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Download form dan upload surat rekomendasi magang Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Download Section -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0L8 8m4-4v12" /></svg>
                Download Dokumen
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-primary/30 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-gray-800">Form Survey Perusahaan</div>
                            <div class="text-xs text-gray-500">Format: .docx</div>
                        </div>
                    </div>
                    <a href="https://docs.google.com/document/d/1NzpB2SLPeRInsCCx5zH593a0pbOzWaMl/edit" target="_blank" class="btn btn-sm btn-ghost text-[#6B21A8] font-bold">Download</a>
                </div>
                
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-primary/30 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002-2z" /></svg>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-gray-800">Surat Rekomendasi Magang</div>
                            <div class="text-xs text-gray-500">Format: .docx (120 KB)</div>
                        </div>
                    </div>
                    <a href="https://docs.google.com/document/d/1EBIvB9hwSv1JcDbIaM51K4xUCgmtkFJz/edit" target="_blank" class="btn btn-sm btn-ghost text-[#6B21A8] font-bold">Download</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Section -->
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                Upload Surat Rekomendasi
            </h3>
            <p class="text-xs text-gray-500 mb-6">Pastikan file sudah ditandatangani dan dalam format PDF.</p>
            
            <form id="uploadForm" onsubmit="handleUpload(event)" class="space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold text-gray-700 text-xs uppercase tracking-widest">File Surat Rekomendasi</span></label>
                        <input type="file" id="fileInput" accept=".pdf" class="file-input file-input-bordered w-full bg-white text-gray-800 border-gray-200 focus:border-[#6B21A8]" required />
                        <label class="label">
                            <span class="label-text-alt text-gray-400 font-medium">Format: PDF • Maks: 10MB</span>
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-600 text-white border-none w-full mt-4 shadow-xl shadow-orange-100 font-black uppercase tracking-widest text-[10px] h-12 min-h-0">Upload Dokumen</button>
            </form>
        </div>
    </div>
</div>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999] space-y-4">
    <!-- Success Notif -->
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-4 rounded-2xl shadow-2xl border border-white/10 min-w-[300px]">
            <div class="w-10 h-10 rounded-xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-bold text-sm">Berhasil!</p>
                <p class="text-xs text-gray-400">Dokumen telah terkirim ke sistem.</p>
            </div>
        </div>
    </div>

    <!-- Error Notif -->
    <div id="errorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-4 rounded-2xl shadow-2xl border border-white/10 min-w-[300px]">
            <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-bold text-sm">Gagal!</p>
                <p id="errorMessage" class="text-xs text-gray-400">Terjadi kesalahan pada file.</p>
            </div>
        </div>
    </div>
</div>

<script>
function handleUpload(event) {
    event.preventDefault();
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    
    if (file) {
        // Validasi Ukuran (10MB = 10 * 1024 * 1024 bytes)
        const maxSize = 10 * 1024 * 1024;
        
        if (file.size > maxSize) {
            showNotif('error', 'Ukuran file melebihi 10MB.');
            return;
        }

        // Validasi Format (PDF)
        if (file.type !== 'application/pdf') {
            showNotif('error', 'Format file harus berupa PDF.');
            return;
        }

        showNotif('success');
        fileInput.value = ''; // Reset input
    }
}

function showNotif(type, message = '') {
    const success = document.getElementById('successNotif');
    const error = document.getElementById('errorNotif');
    
    if (type === 'success') {
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
