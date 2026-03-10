@extends('layouts.app')

@section('title', 'Pengajuan ID Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Pengajuan ID Magang 🆔
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Ajukan data perusahaan dan form pra-survey untuk mendapatkan ID Magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Section -->
    <div class="lg:col-span-2">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body">
                <h3 class="font-bold text-lg text-gray-800 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    Form Data Perusahaan
                </h3>
                
                <form id="idMagangForm" onsubmit="handleUpload(event)" class="space-y-8">
                    <!-- Company Info Section -->
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="form-control">
                                <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest">Nama Perusahaan</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    </div>
                                    <input type="text" placeholder="e.g. PT. Teknologi Nusantara" class="input input-bordered w-full bg-gray-50/50 border-gray-300 text-gray-800 font-bold focus:bg-white focus:border-[#6B21A8] focus:ring-2 focus:ring-[#6B21A8]/10 transition-all pl-11" required />
                                </div>
                            </div>
                            <div class="form-control">
                                <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest">Bidang Usaha</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    </div>
                                    <input type="text" placeholder="e.g. Digital Solutions" class="input input-bordered w-full bg-gray-50/50 border-gray-300 text-gray-800 font-bold focus:bg-white focus:border-[#6B21A8] focus:ring-2 focus:ring-[#6B21A8]/10 transition-all pl-11" required />
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-control">
                            <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest">Alamat Perusahaan</span></label>
                            <textarea placeholder="Tuliskan alamat lengkap lokasi magang..." class="textarea textarea-bordered h-24 bg-gray-50/50 border-gray-300 text-gray-800 font-bold focus:bg-white focus:border-[#6B21A8] focus:ring-2 focus:ring-[#6B21A8]/10 transition-all resize-none p-4" required></textarea>
                        </div>
                    </div>

                    <!-- Members Section -->
                    <div class="pt-4">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-[1px] flex-1 bg-gray-200"></div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Anggota Kelompok (Opsional)</span>
                            <div class="h-[1px] flex-1 bg-gray-200"></div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Member 2 -->
                            <div class="p-6 rounded-3xl border border-gray-100 bg-gray-50/30 space-y-4">
                                <p class="text-[10px] font-black text-[#6B21A8] uppercase tracking-widest pl-1 mb-2">Anggota Kelompok 2</p>
                                <div class="form-control">
                                    <label class="label pt-0"><span class="label-text text-gray-500 text-xs">Nama Anggota 2</span></label>
                                    <input type="text" placeholder="Masukkan nama lengkap" class="input input-bordered input-sm w-full bg-white border-gray-300 text-gray-800 font-bold focus:border-[#6B21A8] h-11" />
                                </div>
                                <div class="form-control">
                                    <label class="label pt-0"><span class="label-text text-gray-500 text-xs">NIM Anggota 2</span></label>
                                    <input type="text" placeholder="Masukkan NIM" class="input input-bordered input-sm w-full bg-white border-gray-300 text-gray-800 font-bold focus:border-[#6B21A8] h-11" />
                                </div>
                            </div>
                            <!-- Member 3 -->
                            <div class="p-6 rounded-3xl border border-gray-100 bg-gray-50/30 space-y-4">
                                <p class="text-[10px] font-black text-[#6B21A8] uppercase tracking-widest pl-1 mb-2">Anggota Kelompok 3</p>
                                <div class="form-control">
                                    <label class="label pt-0"><span class="label-text text-gray-500 text-xs">Nama Anggota 3</span></label>
                                    <input type="text" placeholder="Masukkan nama lengkap" class="input input-bordered input-sm w-full bg-white border-gray-300 text-gray-800 font-bold focus:border-[#6B21A8] h-11" />
                                </div>
                                <div class="form-control">
                                    <label class="label pt-0"><span class="label-text text-gray-500 text-xs">NIM Anggota 3</span></label>
                                    <input type="text" placeholder="Masukkan NIM" class="input input-bordered input-sm w-full bg-white border-gray-300 text-gray-800 font-bold focus:border-[#6B21A8] h-11" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pra-Survey Section -->
                    <div class="pt-4">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-[1px] flex-1 bg-gray-200"></div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em]">Pra-Survey</span>
                            <div class="h-[1px] flex-1 bg-gray-200"></div>
                        </div>

                        <div class="form-control">
                            <label class="label"><span class="label-text font-extrabold text-gray-600 text-[10px] uppercase tracking-widest">Upload Form Pra-Survey</span></label>
                            <div class="group relative">
                                <input type="file" id="fileInput" accept=".pdf" class="file-input file-input-bordered w-full bg-gray-50 border-gray-300 text-gray-800 focus:border-[#6B21A8] transition-all cursor-pointer" required />
                                <div class="mt-2 flex items-center justify-between px-1">
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Format: PDF (Maks 5MB)</span>
                                    <span class="text-[9px] font-black text-[#6B21A8] uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity italic">Wajib PDF*</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center md:justify-end pt-6">
                        <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-600 text-white border-none px-12 font-black uppercase tracking-widest text-[11px] h-14 min-h-0 shadow-xl shadow-orange-100 hover:scale-[1.02] active:scale-95 transition-all">
                            Submit Pengajuan ID
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Section -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body">
                <h3 class="font-bold text-gray-800 mb-4">Status Pengajuan</h3>
                <div class="flex flex-col items-center text-center py-6">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-400">ID MAGANG</div>
                    <div class="badge badge-outline mt-2 text-gray-400">Belum Ada</div>
                    <p class="text-xs text-gray-500 mt-4 px-4">ID Magang akan muncul di sini setelah pengajuan di-ACC oleh Operator/Prodi.</p>
                </div>
            </div>
        </div>

        <div class="card bg-blue-50 border border-blue-100">
            <div class="card-body p-5">
                <h4 class="font-bold text-blue-800 flex items-center gap-2 mb-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Informasi
                </h4>
                <ul class="text-xs text-blue-700 space-y-2 list-disc pl-4 italic">
                    <li>Gunakan form survey resmi dari fakultas.</li>
                    <li>Proses verifikasi membutuhkan waktu 1-3 hari kerja.</li>
                    <li>Anda akan mendapatkan notifikasi jika ID sudah diterbitkan.</li>
                </ul>
            </div>
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
                <p class="text-xs text-gray-400">Pengajuan berhasil terkirim.</p>
            </div>
        </div>
    </div>

    <!-- Error Notif -->
    <div id="errorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-4 bg-gray-900 text-white p-4 rounded-2xl shadow-2xl border border-white/10 min-w-[300px]">
            <div class="w-10 h-10 rounded-xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-10a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
            </div>
            <div>
                <p class="font-bold text-sm">Gagal!</p>
                <p id="errorMessage" class="text-xs text-gray-400">Terjadi kesalahan pada upload.</p>
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
