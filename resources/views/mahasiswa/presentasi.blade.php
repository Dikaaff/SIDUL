@extends('layouts.app')

@section('title', 'Upload Presentasi')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Upload Presentasi 📹
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Upload video presentasi magang Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto pb-12">
    <div class="card bg-white shadow-sm border border-base-200 rounded-[2.5rem] overflow-hidden transition-all hover:shadow-2xl hover:shadow-purple-100/20 group">
        <div class="card-body p-10">
            <div class="w-20 h-20 rounded-[2rem] bg-purple-50 flex items-center justify-center text-[#6B21A8] mb-8 group-hover:scale-110 transition-transform duration-500 shadow-sm border border-purple-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
            </div>
            
            <h3 class="font-black text-2xl text-gray-800 mb-2 italic">Upload Video Presentasi</h3>
            <p class="text-xs text-gray-400 font-bold mb-10 leading-relaxed uppercase tracking-widest pl-1">Bagikan hasil kerja keras Anda melalui video presentasi.</p>
            
            <form id="presentasiForm" onsubmit="handleVideoUpload(event)" class="space-y-8">
                <div class="form-control">
                    <label class="label"><span class="label-text font-black text-gray-600 text-[10px] uppercase tracking-widest pl-1">Berkas Video</span></label>
                    <div onclick="document.getElementById('fileInput').click()" class="relative group/zone border-2 border-dashed border-gray-200 rounded-[2rem] p-12 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-white hover:border-[#6B21A8] hover:shadow-2xl hover:shadow-purple-100/50 transition-all cursor-pointer overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-purple-500/5 to-transparent opacity-0 group-hover/zone:opacity-100 transition-opacity"></div>
                        <div class="p-4 bg-white rounded-2xl shadow-sm text-gray-400 group-hover/zone:text-[#6B21A8] group-hover/zone:scale-110 transition-all mb-4 relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        </div>
                        <p id="fileName" class="text-sm font-black text-gray-500 group-hover/zone:text-[#6B21A8] transition-colors relative z-10 text-center">Pilih atau Seret Video Presentasi</p>
                        <div class="mt-4 flex items-center gap-3 relative z-10">
                            <span class="text-[9px] bg-white px-3 py-1 rounded-full border border-gray-200 font-black text-gray-400 uppercase tracking-widest group-hover/zone:border-purple-200 group-hover/zone:text-purple-600 transition-all">MP4 / MOV</span>
                            <span class="text-[9px] bg-white px-3 py-1 rounded-full border border-gray-200 font-black text-gray-400 uppercase tracking-widest group-hover/zone:border-purple-200 group-hover/zone:text-purple-600 transition-all">MAKS 100MB</span>
                        </div>
                        <input type="file" id="fileInput" accept=".mp4,.mov" class="hidden" onchange="updateFileName(this)" required />
                    </div>
                </div>

                <div class="p-6 bg-orange-50/50 border border-orange-100/50 rounded-[2rem] flex items-start gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-white flex items-center justify-center text-[#F49E0A] shadow-sm shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-orange-900 leading-relaxed uppercase tracking-tight mb-1">Ketentuan Presentasi 💡</p>
                        <p class="text-[10px] text-orange-900/60 font-bold leading-relaxed italic">Video presentasi mencakup poin utama kegiatan magang, pencapaian, serta demo pekerjaan. Durasi maksimal 10 menit guna efektivitas review dosen.</p>
                    </div>
                </div>

                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-600 border-none text-white w-full h-16 min-h-0 font-black uppercase tracking-[0.2em] text-[11px] shadow-2xl shadow-orange-100 hover:scale-[1.02] active:scale-95 transition-all">
                    Submit Video Presentasi
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 animate-bounce-horizontal" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999] space-y-4">
    <!-- Success Notif -->
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2.5rem] shadow-2xl border border-white/10 min-w-[360px]">
            <div class="w-14 h-14 rounded-3xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-white italic">Berhasil diupload!</p>
                <p class="text-xs text-gray-400 font-bold mt-1">Video presentasi Anda telah terkirim.</p>
            </div>
        </div>
    </div>

    <!-- Error Notif -->
    <div id="errorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-5 rounded-[2.5rem] shadow-2xl border border-white/10 min-w-[360px]">
            <div class="w-14 h-14 rounded-3xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-10a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest text-white italic">Gagal!</p>
                <p id="errorMessage" class="text-xs text-gray-400 font-bold mt-1">Terjadi kesalahan pada video.</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes bounce-horizontal {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(4px); }
}
.animate-bounce-horizontal {
    animation: bounce-horizontal 2s infinite;
}
</style>

<script>
function updateFileName(input) {
    const fileNameDisplay = document.getElementById('fileName');
    if (input.files && input.files.length > 0) {
        fileNameDisplay.innerHTML = "VIDEO SIAP: <span class='text-[#6B21A8] underline'>" + input.files[0].name + "</span>";
    } else {
        fileNameDisplay.innerText = "Pilih atau Seret Video Presentasi";
    }
}

function handleVideoUpload(event) {
    event.preventDefault();
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];
    
    if (file) {
        // Validasi Ukuran (100MB = 100 * 1024 * 1024 bytes)
        const maxSize = 100 * 1024 * 1024;
        
        if (file.size > maxSize) {
            showNotif('error', 'Ukuran video melebihi 100MB.');
            return;
        }

        // Validasi Format (MP4, MOV)
        const allowedTypes = ['video/mp4', 'video/quicktime'];
        if (!allowedTypes.includes(file.type) && !file.name.toLowerCase().endsWith('.mov')) {
            showNotif('error', 'Format harus MP4 atau MOV.');
            return;
        }

        showNotif('success');
        event.target.reset(); // Reset form
        document.getElementById('fileName').innerText = "Pilih atau Seret Video Presentasi";
    }
}

function showNotif(type, message = '') {
    const success = document.getElementById('successNotif');
    const error = document.getElementById('errorNotif');
    
    if (type === 'success') {
        success.classList.remove('hidden');
        setTimeout(() => success.classList.add('hidden'), 3500);
    } else {
        document.getElementById('errorMessage').innerText = message;
        error.classList.remove('hidden');
        setTimeout(() => error.classList.add('hidden'), 3500);
    }
}
</script>
@endsection
