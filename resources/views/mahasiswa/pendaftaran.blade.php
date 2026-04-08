@extends('layouts.app')

@section('title', 'Pendaftaran Magang')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Pendaftaran Magang 📝
        </h2>
        <p class="text-gray-700 font-medium text-sm">Lengkapi data pendaftaran perusahaan dan lengkapi anggota kelompokmu (jika ada).</p>
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Pendaftaran</li>
  </ul>
</div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 md:p-8">
            <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="formPendaftaran">
                @csrf
                
                <!-- 1. Pemilihan Tipe Magang -->
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span class="w-1.5 h-5 bg-[#6B21A8] rounded-full inline-block"></span>
                        Tipe Pendaftaran
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="tipe_magang" value="individu" class="peer sr-only" checked onchange="toggleKelompok(false)">
                            <div class="w-full p-5 rounded-2xl border-2 border-gray-100 hover:bg-gray-50 peer-checked:border-[#6B21A8] peer-checked:bg-purple-50 transition-all text-center">
                                <div class="w-12 h-12 mx-auto bg-gray-100 peer-checked:bg-white rounded-full flex items-center justify-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 peer-checked:text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-1">Individu</h4>
                                <p class="text-xs text-gray-700 font-medium">Bekerja mandiri secara penuh.</p>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" name="tipe_magang" value="kelompok" class="peer sr-only" onchange="toggleKelompok(true)">
                            <div class="w-full p-5 rounded-2xl border-2 border-gray-100 hover:bg-gray-50 peer-checked:border-[#6B21A8] peer-checked:bg-purple-50 transition-all text-center">
                                <div class="w-12 h-12 mx-auto bg-gray-100 peer-checked:bg-white rounded-full flex items-center justify-center mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 peer-checked:text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                </div>
                                <h4 class="font-bold text-gray-800 mb-1">Berkelompok</h4>
                                <p class="text-xs text-gray-700 font-medium">Maksimal 3 orang dalam satu tim.</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- 2. Data Mahasiswa Pengaju -->
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span class="w-1.5 h-5 bg-[#F49E0A] rounded-full inline-block"></span>
                        Data Pengaju (Ketua/Individu)
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" value="User Nama Mahasiswa" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-bold text-gray-800 focus:outline-none cursor-not-allowed" readonly />
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">NIM</label>
                            <input type="text" value="123456789" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-bold text-gray-800 focus:outline-none cursor-not-allowed" readonly />
                        </div>
                    </div>
                </div>

                <!-- 3. Form Dynamic Group -->
                <div id="kelompokContainer" class="space-y-4 hidden animate-in fade-in slide-in-from-top-4 duration-300">
                    <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                        <h3 class="font-bold text-[#6B21A8] text-lg flex items-center gap-2">
                            <span class="w-1.5 h-5 bg-[#6B21A8] rounded-full inline-block"></span>
                            Anggota Kelompok
                        </h3>
                        <span class="text-xs font-bold text-gray-600 bg-gray-100 px-3 py-1 rounded-lg">Anggota 1-2 Orang</span>
                    </div>

                    <div class="bg-purple-50/50 rounded-2xl p-6 border border-purple-100 space-y-6" id="anggotaWrapper">
                        <!-- Anggota 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative anggota-item">
                            <div>
                                <label class="block text-[11px] font-bold text-purple-800 uppercase tracking-wider mb-2">NIM Anggota 1</label>
                                <input type="text" id="nimAnggota1" placeholder="Masukkan NIM" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" class="w-full bg-white border border-purple-200 rounded-xl py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-purple-800 uppercase tracking-wider mb-2">Nama Anggota 1</label>
                                <input type="text" id="namaAnggota1" placeholder="Masukkan Nama Lengkap" class="w-full bg-white border border-purple-200 rounded-xl py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" />
                            </div>
                        </div>

                        <!-- Anggota 2 (opsional) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative anggota-item">
                            <div>
                                <label class="block text-[11px] font-bold text-purple-800 uppercase tracking-wider mb-2">NIM Anggota 2 <span class="text-gray-600">(Opsional)</span></label>
                                <input type="text" id="nimAnggota2" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" placeholder="Kosongkan jika hanya berdua" class="w-full bg-white border border-purple-200 rounded-xl py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-purple-800 uppercase tracking-wider mb-2">Nama Anggota 2 <span class="text-gray-600">(Opsional)</span></label>
                                <input type="text" id="namaAnggota2" placeholder="Kosongkan jika hanya berdua" class="w-full bg-white border border-purple-200 rounded-xl py-3 px-4 text-sm font-medium focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Data Perusahaan & Periode -->
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span class="w-1.5 h-5 bg-blue-500 rounded-full inline-block"></span>
                        Data Perusahaan & Waktu Magang
                    </h3>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Nama Perusahaan <span class="text-red-500">*</span></label>
                            <input type="text" name="perusahaan" placeholder="Contoh: PT. Sumber Maju Jaya" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" required />
                        </div>
                        
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Alamat Lengkap Perusahaan <span class="text-red-500">*</span></label>
                            <textarea name="alamat" placeholder="Jl. Sudirman No. 123, Jakarta Raya..." class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all min-h-[100px]" required></textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Periode Mulai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_mulai" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" required />
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Periode Selesai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_selesai" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" required />
                        </div>
                    </div>
                </div>

                <!-- 5. Upload Berkas -->
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span class="w-1.5 h-5 bg-green-500 rounded-full inline-block"></span>
                        Lampiran Proposal <span class="text-red-500">*</span>
                    </h3>
                    
                    <div class="w-full">
                        <label for="proposal-upload" id="dropzone-label" class="flex flex-col items-center justify-center w-full min-h-[12rem] border-2 border-gray-300 border-dashed rounded-3xl cursor-pointer bg-gray-50 hover:bg-purple-50 hover:border-[#6B21A8] transition-colors group p-4 sm:p-6 text-center">
                            <div class="flex flex-col items-center justify-center" id="dropzone-content">
                                <div class="w-12 h-12 md:w-14 md:h-14 bg-white shadow-sm rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5 md:w-6 md:h-6 text-gray-600 group-hover:text-[#6B21A8]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                </div>
                                <p class="mb-2 text-xs md:text-sm text-gray-700 max-w-xs md:max-w-none"><span class="font-bold text-[#6B21A8]">Klik untuk mengunggah</span> atau seret dokumen ke sini</p>
                                <p class="text-[10px] md:text-xs font-bold text-gray-600 uppercase tracking-widest">Hanya PDF (Maks. 5MB)</p>
                            </div>
                            <input id="proposal-upload" name="proposal" type="file" class="hidden" accept=".pdf" required onchange="handleFileSelect(this)" />
                        </label>
                    </div>
                </div>

                <!-- CTA Navigation -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-8 border-t border-gray-100">
                    <button type="reset" class="w-full sm:w-auto px-8 py-3.5 rounded-xl text-gray-700 font-bold hover:bg-gray-100 transition-colors text-sm" id="btnReset">
                        Reset Formulir
                    </button>
                    <button type="submit" class="w-full sm:w-auto bg-[#6B21A8] hover:bg-purple-800 text-white rounded-xl py-3.5 px-8 font-bold text-sm shadow-xl shadow-purple-900/20 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-2 disabled:bg-purple-300" id="btnSubmit">
                        <span id="btnText">Kirim Pendaftaran</span>
                        <svg id="btnIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        <span id="btnLoading" class="loading loading-spinner hidden"></span>
                    </button>
                </div>
            </form>
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
                <p class="font-black text-sm uppercase tracking-widest text-white">Berhasil!</p>
                <p class="text-xs text-gray-400 font-bold mt-0.5">Pendaftaran telah dikirim ke sistem.</p>
            </div>
        </div>
    </div>

    <!-- Error Notif -->
    <div id="errorNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300 transition-all">
        <div class="flex items-center gap-4 bg-red-50 text-red-800 p-5 rounded-[2rem] shadow-2xl border border-red-100 min-w-[340px]">
            <div class="w-12 h-12 rounded-2xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/20 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <div>
                <p class="font-black text-sm uppercase tracking-widest leading-tight">Peringatan!</p>
                <p class="text-xs font-bold mt-0.5" id="errorMsg">Lampiran Proposal wajib diunggah.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleKelompok(isKelompok) {
        const container = document.getElementById('kelompokContainer');
        if (isKelompok) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    function handleFileSelect(input) {
        const dropzone = document.getElementById('dropzone-label');
        const content = document.getElementById('dropzone-content');
        
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            dropzone.classList.add('border-[#6B21A8]', 'bg-purple-50');
            content.innerHTML = `
                <div class="w-12 h-12 md:w-14 md:h-14 bg-white shadow-sm rounded-full flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 md:w-6 md:h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="mb-1 text-xs md:text-sm text-gray-800 font-bold max-w-xs md:max-w-none">${fileName}</p>
                <p class="text-[10px] md:text-xs font-bold text-green-600 uppercase tracking-widest">File Berhasil Terunggah</p>
                <button type="button" onclick="resetFile()" class="mt-4 text-[10px] font-black text-red-500 uppercase hover:underline">Hapus File</button>
            `;
        }
    }

    function resetFile() {
        const input = document.getElementById('proposal-upload');
        const dropzone = document.getElementById('dropzone-label');
        const content = document.getElementById('dropzone-content');
        
        input.value = '';
        dropzone.classList.remove('border-[#6B21A8]', 'bg-purple-50');
        content.innerHTML = `
            <div class="w-12 h-12 md:w-14 md:h-14 bg-white shadow-sm rounded-full flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-gray-600 group-hover:text-[#6B21A8]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
            </div>
            <p class="mb-2 text-xs md:text-sm text-gray-700 max-w-xs md:max-w-none"><span class="font-bold text-[#6B21A8]">Klik untuk mengunggah</span> atau seret dokumen ke sini</p>
            <p class="text-[10px] md:text-xs font-bold text-gray-600 uppercase tracking-widest">Hanya PDF (Maks. 5MB)</p>
        `;
    }

    const form = document.getElementById('formPendaftaran');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnReset = document.getElementById('btnReset');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnLoading = document.getElementById('btnLoading');
    const successNotif = document.getElementById('successNotif');
    const errorNotif = document.getElementById('errorNotif');
    const errorMsg = document.getElementById('errorMsg');
    const fileInput = document.getElementById('proposal-upload');
    const dropzone = document.getElementById('dropzone-label');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Ambil tipe magang yang dipilih
        const tipeMagang = document.querySelector('input[name="tipe_magang"]:checked').value;
        const nimAnggota1 = document.getElementById('nimAnggota1');
        const namaAnggota1 = document.getElementById('namaAnggota1');

        let isFormValid = true;

        // 1. Validasi Input Dasar
        const requiredInputs = form.querySelectorAll('input[required]:not([type="file"]), textarea[required]');
        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('border-red-500', 'bg-red-50');
                isFormValid = false;
            } else {
                input.classList.remove('border-red-500', 'bg-red-50');
            }
        });

        // 2. Validasi Anggota Kelompok (Jika Kelompok)
        if (tipeMagang === 'kelompok') {
            if (!nimAnggota1.value.trim() || !namaAnggota1.value.trim()) {
                nimAnggota1.classList.add('border-red-500', 'bg-red-50');
                namaAnggota1.classList.add('border-red-500', 'bg-red-50');
                isFormValid = false;
                
                errorMsg.innerText = "Data Anggota Kelompok 1 wajib diisi!";
                errorNotif.classList.remove('hidden');
            } else {
                nimAnggota1.classList.remove('border-red-500', 'bg-red-50');
                namaAnggota1.classList.remove('border-red-500', 'bg-red-50');
            }
        }

        // 3. Validasi File Proposal
        if (!fileInput.files || fileInput.files.length === 0) {
            dropzone.classList.add('border-red-500', 'bg-red-50', 'animate-shake');
            isFormValid = false;
            
            errorMsg.innerText = "Lampiran Proposal wajib diunggah!";
            errorNotif.classList.remove('hidden');
        }

        if (!isFormValid) {
            setTimeout(() => {
                errorNotif.classList.add('hidden');
                dropzone.classList.remove('animate-shake');
            }, 3000);
            return;
        }
        
        // Start Loading State (Semua Valid)
        btnSubmit.disabled = true;
        btnText.innerText = "Mengirim...";
        btnIcon.classList.add('hidden');
        btnLoading.classList.remove('hidden');
        errorNotif.classList.add('hidden'); 

        // Submit real data to Laravel backend
        setTimeout(() => {
            form.submit();
        }, 500);
    });

    form.addEventListener('reset', function() {
        toggleKelompok(false);
        resetFile(); // Custom reset to clear the visual dropzone
        successNotif.classList.add('hidden');
        errorNotif.classList.add('hidden');
    });
</script>
@endsection
