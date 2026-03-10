@extends('layouts.app')

@section('title', 'Pengajuan Dosen Pembimbing')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Pengajuan Dosen Pembimbing 🎓
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Upload surat diterima magang untuk penetapan Dosen Pembimbing.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card bg-white shadow-sm border border-base-200">
        <div class="card-body">
            <h3 class="font-bold text-lg text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Upload Surat Diterima Magang
            </h3>
            
            <form id="dosenPembimbingForm" onsubmit="handleUpload(event)" class="space-y-6">
                <div class="form-control">
                    <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest pl-1">Pilih File Surat</span></label>
                    <div onclick="document.getElementById('fileInput').click()" class="group border-2 border-dashed border-gray-200 rounded-3xl p-10 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-white hover:border-[#6B21A8] hover:shadow-2xl hover:shadow-purple-100/50 transition-all cursor-pointer relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-gray-300 group-hover:text-[#6B21A8] group-hover:scale-110 transition-all mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        <p id="fileName" class="text-sm text-gray-500 font-bold group-hover:text-gray-700 transition-colors">Klik atau drop file surat di sini</p>
                        <div class="mt-3 flex items-center gap-3">
                            <span class="text-[10px] bg-white px-3 py-1 rounded-full border border-gray-200 font-black text-gray-400 uppercase tracking-widest group-hover:border-purple-200 group-hover:text-purple-600 transition-all">Format: PDF</span>
                            <span class="text-[10px] bg-white px-3 py-1 rounded-full border border-gray-200 font-black text-gray-400 uppercase tracking-widest group-hover:border-purple-200 group-hover:text-purple-600 transition-all">Max: 5MB</span>
                        </div>
                        <input type="file" id="fileInput" name="surat" accept=".pdf" class="hidden" onchange="updateFileName(this)" required />
                    </div>
                </div>

                <div class="flex items-start gap-4 bg-blue-50/50 p-5 rounded-3xl text-blue-900 border border-blue-100/50">
                    <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-blue-500 shadow-sm shrink-0 border border-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-[11px] font-bold leading-relaxed opacity-80">Sistem akan memproses penetapan Dosen Pembimbing secara otomatis setelah surat ini divalidasi oleh Operator/Prodi.</p>
                </div>

                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-600 text-white border-none w-full h-14 min-h-0 font-black uppercase tracking-widest text-[11px] shadow-xl shadow-orange-100 hover:scale-[1.02] active:scale-95 transition-all">Kirim Surat Pengajuan</button>
            </form>
        </div>
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
                <p class="font-black text-sm uppercase tracking-widest">Berhasil!</p>
                <p class="text-xs text-gray-400 font-bold mt-0.5">Dokumen berhasil dikirim ke system.</p>
            </div>
        </div>
    </div>

    <!-- Error Notif -->
    <div id="errorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2rem] shadow-2xl border border-white/10 min-w-[340px]">
            <div class="w-12 h-12 rounded-2xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2-0 1 1 0 012 0zm-1-10a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest">Gagal!</p>
                <p id="errorMessage" class="text-xs text-gray-400 font-bold mt-0.5">Terjadi kesalahan pada upload.</p>
            </div>
        </div>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileNameDisplay = document.getElementById('fileName');
    if (input.files && input.files.length > 0) {
        fileNameDisplay.innerText = "File Terpilih: " + input.files[0].name;
        fileNameDisplay.classList.add('text-[#6B21A8]');
    } else {
        fileNameDisplay.innerText = "Klik atau drop file surat di sini";
        fileNameDisplay.classList.remove('text-[#6B21A8]');
    }
}

function handleUpload(event) {
    event.preventDefault();
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    
    if (file) {
        // Validasi Ukuran (5MB = 5 * 1024 * 1024 bytes)
        const maxSize = 5 * 1024 * 1024;
        
        if (file.size > maxSize) {
            showNotif('error', 'Ukuran file melebihi 5MB.');
            return;
        }

        // Validasi Format (PDF)
        if (file.type !== 'application/pdf') {
            showNotif('error', 'Format file harus berupa PDF.');
            return;
        }

        showNotif('success');
        event.target.reset(); // Reset form
        document.getElementById('fileName').innerText = "Klik atau drop file surat di sini";
        document.getElementById('fileName').classList.remove('text-[#6B21A8]');
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
