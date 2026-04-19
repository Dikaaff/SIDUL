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

                <!-- 3. Konsentrasi -->
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span class="w-1.5 h-5 bg-indigo-500 rounded-full inline-block"></span>
                        Konsentrasi
                    </h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Bidang Konsentrasi <span class="text-red-500">*</span></label>
                            <select name="konsentrasi" class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3 px-4 text-sm font-bold text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all cursor-pointer" required>
                                <option value="" disabled selected>-- Pilih Konsentrasi Anda --</option>
                                <option value="Web Development">1. Web Development</option>
                                <option value="Networking">2. Networking</option>
                                <option value="2D Animation">3. 2D Animation</option>
                            </select>
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

                <!-- 6. Tautan Dokumen Berkas -->
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-2">
                        <span class="w-1.5 h-5 bg-green-500 rounded-full inline-block"></span>
                        Tautan Dokumen Berkas <span class="text-red-500">*</span>
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Link Bukti Keterima Magang <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.172 13.828a4 4 0 015.656 0l4-4a4 4 0 11-5.656 5.656l-1.102 1.101" /></svg>
                                </div>
                                <input type="url" name="link_bukti_magang" placeholder="https://drive.google.com/..." class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 pl-11 pr-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" required />
                            </div>
                        </div>
                        <div>
                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-2">Link Form Survey Perusahaan <span class="text-red-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-[#6B21A8] transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <input type="url" name="link_survey_perusahaan" placeholder="https://forms.gle/..." class="w-full bg-gray-50 border border-gray-200 rounded-xl py-3.5 pl-11 pr-4 text-sm font-medium text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#6B21A8] outline-none transition-all" required />
                            </div>
                        </div>
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

<!-- Notification Toast removed (Now handled globally in layout) -->


<script>
    function toggleKelompok(isKelompok) {
        const container = document.getElementById('kelompokContainer');
        if (isKelompok) {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    // File handling functions removed as per UI revision (Link based now)

    const form = document.getElementById('formPendaftaran');
    const btnSubmit = document.getElementById('btnSubmit');
    const btnReset = document.getElementById('btnReset');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');
    const btnLoading = document.getElementById('btnLoading');


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
                
                showToast('error', "Data Anggota Kelompok 1 wajib diisi!");
            } else {
                nimAnggota1.classList.remove('border-red-500', 'bg-red-50');
                namaAnggota1.classList.remove('border-red-500', 'bg-red-50');
            }
        }


        if (!isFormValid) {
            return;
        }

        
        // Start Loading State (Semua Valid)
        btnSubmit.disabled = true;
        btnText.innerText = "Mengirim...";
        btnIcon.classList.add('hidden');
        btnLoading.classList.remove('hidden');

        // Submit real data to Laravel backend
        setTimeout(() => {
            form.submit();
        }, 500);
    });

    form.addEventListener('reset', function() {
        toggleKelompok(false);
    });

</script>
@endsection
