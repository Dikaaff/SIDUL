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
@php
    $mahasiswa = Auth::user()->mahasiswa;
    $peserta = $mahasiswa->pesertaMagang;
    $magang = $peserta ? $peserta->magang : null;
    $isLocked = $magang && in_array($magang->status_magang, ['Approve', 'Aktif', 'Selesai']);
@endphp
<div class="max-w-5xl mx-auto pb-10">
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 md:p-8">
            <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="formPendaftaran">
                @csrf
                
                @if($magang)
                <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100 flex items-center justify-between gap-4 mb-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center text-primary shadow-sm border border-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-primary uppercase tracking-widest mb-1 italic">Status Pendaftaran</p>
                            <h4 class="text-lg font-black text-gray-800">Magang Anda Saat Ini: <span class="text-purple-700">{{ $magang->status_magang }}</span></h4>
                        </div>
                    </div>
                    @if($isLocked)
                    <div class="px-6 py-2 bg-white rounded-xl border border-purple-100 text-[10px] font-black uppercase text-purple-600 tracking-widest">
                        ReadOnly Mode
                    </div>
                    @endif
                </div>
                @endif

                <!-- 1. Pemilihan Tipe Magang -->
                <div class="space-y-4">
                    <h3 class="font-black text-gray-800 text-lg flex items-center gap-3 border-b border-gray-50 pb-3 italic">
                        <span class="w-2 h-6 bg-[#6B21A8] rounded-full inline-block shadow-lg shadow-purple-200"></span>
                        Tipe Pendaftaran
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="tipe_magang" value="individu" class="peer sr-only" 
                                {{ (!$magang || $magang->tipe_magang == 'individu') ? 'checked' : '' }} 
                                {{ $isLocked ? 'disabled' : '' }} onchange="toggleKelompok(false)">
                            <div class="w-full p-6 rounded-2xl border-2 border-gray-50 hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-purple-50/50 transition-all text-center group">
                                <div class="w-14 h-14 mx-auto bg-gray-50 group-hover:bg-white peer-checked:bg-white rounded-2xl flex items-center justify-center mb-4 transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400 peer-checked:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <h4 class="font-black text-gray-800 mb-1">Individu</h4>
                                <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Mandiri</p>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" name="tipe_magang" value="kelompok" class="peer sr-only" 
                                {{ ($magang && $magang->tipe_magang == 'kelompok') ? 'checked' : '' }}
                                {{ $isLocked ? 'disabled' : '' }} onchange="toggleKelompok(true)">
                            <div class="w-full p-6 rounded-2xl border-2 border-gray-50 hover:bg-gray-50 peer-checked:border-primary peer-checked:bg-purple-50/50 transition-all text-center group">
                                <div class="w-14 h-14 mx-auto bg-gray-50 group-hover:bg-white peer-checked:bg-white rounded-2xl flex items-center justify-center mb-4 transition-all shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400 peer-checked:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                </div>
                                <h4 class="font-black text-gray-800 mb-1">Berkelompok</h4>
                                <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Tim (Max 3)</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- 2. Data Mahasiswa Pengaju -->
                <div class="space-y-4">
                    <h3 class="font-black text-gray-800 text-lg flex items-center gap-3 border-b border-gray-50 pb-3 italic">
                        <span class="w-2 h-6 bg-[#F49E0A] rounded-full inline-block shadow-lg shadow-amber-200"></span>
                        Data Pengaju
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Lengkap</label>
                            <input type="text" value="{{ $mahasiswa->nama }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:outline-none cursor-not-allowed italic" readonly />
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">NIM / Identitas</label>
                            <input type="text" value="{{ $mahasiswa->nim }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:outline-none cursor-not-allowed italic" readonly />
                        </div>
                    </div>
                </div>

                <!-- 3. Konsentrasi -->
                <div class="space-y-4">
                    <h3 class="font-black text-gray-800 text-lg flex items-center gap-3 border-b border-gray-50 pb-3 italic">
                        <span class="w-2 h-6 bg-indigo-500 rounded-full inline-block shadow-lg shadow-indigo-200"></span>
                        Konsentrasi
                    </h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic">Bidang Konsentrasi <span class="text-red-500">*</span></label>
                            <select name="konsentrasi" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 outline-none transition-all cursor-pointer" required {{ $isLocked ? 'disabled' : '' }}>
                                <option value="" disabled {{ !$magang ? 'selected' : '' }}>-- Pilih Konsentrasi Anda --</option>
                                <option value="Web Development" {{ ($magang && $magang->konsentrasi == 'Web Development') ? 'selected' : '' }}>1. Web Development</option>
                                <option value="Networking" {{ ($magang && $magang->konsentrasi == 'Networking') ? 'selected' : '' }}>2. Networking</option>
                                <option value="2D Animation" {{ ($magang && $magang->konsentrasi == '2D Animation') ? 'selected' : '' }}>3. 2D Animation</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 3. Form Dynamic Group -->
                <div id="kelompokContainer" class="space-y-4 {{ ($magang && $magang->tipe_magang == 'kelompok') ? '' : 'hidden' }} animate-in fade-in slide-in-from-top-4 duration-300">
                    <div class="flex items-center justify-between border-b border-gray-50 pb-3">
                        <h3 class="font-black text-primary text-lg flex items-center gap-3 italic">
                            <span class="w-2 h-6 bg-primary rounded-full inline-block shadow-lg shadow-purple-200"></span>
                            Anggota Kelompok
                        </h3>
                    </div>

                    <div class="bg-purple-50/50 rounded-[2rem] p-8 border border-purple-100 space-y-8" id="anggotaWrapper">
                        <p class="text-[11px] text-purple-600 font-black uppercase tracking-widest italic mb-2">* Kelompok minimal 2 orang dan maksimal 3 orang (termasuk Ketua).</p>
                        
                        <!-- Anggota 1 (Wajib jika kelompok) -->
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="badge badge-primary badge-sm font-black italic">Anggota 1 (Wajib)</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative">
                                <div>
                                    <label class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2 ml-1">NIM Anggota 1</label>
                                    <input type="text" name="nim_anggota[]" id="nimAnggota1" placeholder="Masukkan NIM" class="w-full bg-white border border-purple-100 rounded-2xl py-4 px-6 text-sm font-black text-purple-900 focus:ring-4 focus:ring-primary/5 outline-none transition-all" {{ $isLocked ? 'readonly' : '' }} />
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2 ml-1">Nama Anggota 1</label>
                                    <input type="text" name="nama_anggota[]" id="namaAnggota1" placeholder="Masukkan Nama Lengkap" class="w-full bg-white border border-purple-100 rounded-2xl py-4 px-6 text-sm font-black text-purple-900 focus:ring-4 focus:ring-primary/5 outline-none transition-all" {{ $isLocked ? 'readonly' : '' }} />
                                </div>
                            </div>
                        </div>

                        <hr class="border-purple-100 border-dashed">

                        <!-- Anggota 2 (Opsional) -->
                        <div class="space-y-4">
                            <div class="flex items-center gap-2">
                                <span class="badge bg-purple-200 text-purple-700 border-none badge-sm font-black italic">Anggota 2 (Opsional)</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative">
                                <div>
                                    <label class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2 ml-1">NIM Anggota 2</label>
                                    <input type="text" name="nim_anggota[]" id="nimAnggota2" placeholder="Masukkan NIM (Opsional)" class="w-full bg-white border border-purple-100 rounded-2xl py-4 px-6 text-sm font-black text-purple-900 focus:ring-4 focus:ring-primary/5 outline-none transition-all" {{ $isLocked ? 'readonly' : '' }} />
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-purple-400 uppercase tracking-widest mb-2 ml-1">Nama Anggota 2</label>
                                    <input type="text" name="nama_anggota[]" id="namaAnggota2" placeholder="Masukkan Nama Lengkap" class="w-full bg-white border border-purple-100 rounded-2xl py-4 px-6 text-sm font-black text-purple-900 focus:ring-4 focus:ring-primary/5 outline-none transition-all" {{ $isLocked ? 'readonly' : '' }} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Data Perusahaan & Periode -->
                <div class="space-y-4">
                    <h3 class="font-black text-gray-800 text-lg flex items-center gap-3 border-b border-gray-50 pb-3 italic">
                        <span class="w-2 h-6 bg-blue-500 rounded-full inline-block shadow-lg shadow-blue-200"></span>
                        Data Perusahaan & Waktu
                    </h3>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic">Nama Perusahaan <span class="text-red-500">*</span></label>
                            <input type="text" name="perusahaan" value="{{ $magang->perusahaan ?? '' }}" placeholder="Contoh: PT. Sumber Maju Jaya" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 outline-none transition-all" required {{ $isLocked ? 'readonly' : '' }} />
                        </div>
                        
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic">Alamat Lengkap Perusahaan <span class="text-red-500">*</span></label>
                            <textarea name="alamat" placeholder="Jl. Sudirman No. 123, Jakarta Raya..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 outline-none transition-all min-h-[120px]" required {{ $isLocked ? 'readonly' : '' }}>{{ $magang->alamat ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic">Periode Mulai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_mulai" value="{{ $magang->tanggal_mulai ?? '' }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 outline-none transition-all" required {{ $isLocked ? 'readonly' : '' }} />
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic">Periode Selesai <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_selesai" value="{{ $magang->tanggal_selesai ?? '' }}" class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-primary/5 outline-none transition-all" required {{ $isLocked ? 'readonly' : '' }} />
                        </div>
                    </div>
                </div>

                <!-- CTA Navigation -->
                <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-10 border-t border-gray-50">
                    @if(!$isLocked)
                    <button type="reset" class="w-full sm:w-auto px-8 py-4 rounded-2xl text-gray-500 font-black uppercase tracking-widest text-[11px] hover:bg-gray-50 transition-all italic" id="btnReset">
                        Reset Data
                    </button>
                    <button type="submit" class="w-full sm:w-auto bg-primary hover:bg-purple-800 text-white rounded-2xl py-4 px-10 font-black uppercase tracking-widest text-[11px] shadow-2xl shadow-purple-200 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3" id="btnSubmit">
                        <span id="btnText">{{ $magang ? 'Update Pendaftaran' : 'Kirim Pendaftaran' }}</span>
                        <svg id="btnIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                        <span id="btnLoading" class="loading loading-spinner hidden"></span>
                    </button>
                    @else
                    <div class="flex items-center gap-3 bg-green-50 text-green-600 px-8 py-4 rounded-2xl border border-green-100 font-black uppercase tracking-widest text-[10px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        Pendaftaran Selesai & Terkunci
                    </div>
                    @endif
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
            const nim1 = nimAnggota1.value.trim();
            const nama1 = namaAnggota1.value.trim();
            const nim2 = document.getElementById('nimAnggota2').value.trim();
            const nama2 = document.getElementById('namaAnggota2').value.trim();

            if (!nim1 || !nama1) {
                nimAnggota1.classList.add('border-red-500', 'bg-red-50');
                namaAnggota1.classList.add('border-red-500', 'bg-red-50');
                isFormValid = false;
                showToast('error', "Minimal harus ada 1 anggota tambahan untuk pendaftaran kelompok (Total 2 orang).");
            } else {
                nimAnggota1.classList.remove('border-red-500', 'bg-red-50');
                namaAnggota1.classList.remove('border-red-500', 'bg-red-50');
            }
            
            // Validasi jika Anggota 2 diisi separuh
            if ((nim2 && !nama2) || (!nim2 && nama2)) {
                document.getElementById('nimAnggota2').classList.add('border-red-500', 'bg-red-50');
                document.getElementById('namaAnggota2').classList.add('border-red-500', 'bg-red-50');
                isFormValid = false;
                showToast('error', "Data Anggota 2 harus lengkap (NIM & Nama).");
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
