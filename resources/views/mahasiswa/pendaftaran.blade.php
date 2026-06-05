@extends('layouts.app')

@section('title', 'Pendaftaran Magang')

@section('header')
<x-page-header
    title="Pendaftaran Magang 📝"
    subtitle="Lengkapi data pendaftaran perusahaan dan lengkapi anggota kelompokmu (jika ada)."
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-[#6B21A8] transition-colors">Dashboard</a></li>
    <li>Pendaftaran</li>
  </ul>
</div>
@endsection

@section('content')
@php
    $mahasiswa = Auth::user()->mahasiswa;
    $peserta = $mahasiswa->pesertaMagang;
    $magang = $peserta ? $peserta->magang : null;
    $isLocked = $magang !== null;
    $ketua = $magang ? $magang->peserta->firstWhere('is_ketua', true)?->mahasiswa : null;
    $anggotaList = $magang ? $magang->peserta->filter(fn($p) => !$p->is_ketua)->values() : collect();
@endphp
<div class="max-w-5xl mx-auto pb-10">
    <x-card padding="large">
        <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="formPendaftaran">
            @csrf

            {{-- Session Success Banner --}}
            @if(session('success'))
            <div class="bg-green-50 border-2 border-green-200 p-5 rounded-2xl flex items-start gap-4 mb-6">
                <div class="w-10 h-10 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <h4 class="font-black text-green-800 text-sm uppercase tracking-wider">Berhasil!</h4>
                    <p class="text-xs font-medium text-green-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            {{-- Session Error Banner --}}
            @if(session('error'))
            <div class="bg-red-50 border-2 border-red-200 p-5 rounded-2xl flex items-start gap-4 mb-6">
                <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h4 class="font-black text-red-800 text-sm uppercase tracking-wider">Gagal!</h4>
                    <p class="text-xs font-medium text-red-700 mt-1">{{ session('error') }}</p>
                </div>
            </div>
            @endif

            {{-- Validation Errors --}}
            @if($errors->any())
            <div class="bg-red-50 border-2 border-red-200 p-5 rounded-2xl flex items-start gap-4 mb-6">
                <div class="w-10 h-10 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <h4 class="font-black text-red-800 text-sm uppercase tracking-wider">Terjadi Kesalahan!</h4>
                    <ul class="text-xs font-medium text-red-700 mt-1 list-disc list-inside">
                        @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            <!-- 1. Pemilihan Tipe Magang -->
            <div class="space-y-4">
                <x-section-title color="purple" title="Tipe Pendaftaran" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative cursor-pointer">
                        <input type="radio" name="tipe_magang" value="individu" class="peer sr-only"
                            {{ (!$magang || $magang->tipe_magang == 'individu') ? 'checked' : '' }}
                            {{ $isLocked ? 'disabled' : '' }} onchange="toggleKelompok(false)">
                        <div class="w-full p-6 rounded-2xl border-2 border-gray-50 hover:bg-gray-50 peer-checked:border-[#6B21A8] peer-checked:bg-purple-50/50 transition-all text-center group">
                            <div class="w-14 h-14 mx-auto bg-gray-50 group-hover:bg-white peer-checked:bg-white rounded-2xl flex items-center justify-center mb-4 transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400 peer-checked:text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <h4 class="font-black text-gray-800 mb-1">Individu</h4>
                            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Mandiri</p>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input type="radio" name="tipe_magang" value="kelompok" class="peer sr-only"
                            {{ ($magang && $magang->tipe_magang == 'kelompok') ? 'checked' : '' }}
                            {{ $isLocked ? 'disabled' : '' }} onchange="toggleKelompok(true)">
                        <div class="w-full p-6 rounded-2xl border-2 border-gray-50 hover:bg-gray-50 peer-checked:border-[#6B21A8] peer-checked:bg-purple-50/50 transition-all text-center group">
                            <div class="w-14 h-14 mx-auto bg-gray-50 group-hover:bg-white peer-checked:bg-white rounded-2xl flex items-center justify-center mb-4 transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-400 peer-checked:text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            </div>
                            <h4 class="font-black text-gray-800 mb-1">Berkelompok</h4>
                            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Tim (Max 3)</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- 2. Data Mahasiswa Pengaju -->
            <div class="space-y-4">
                <x-section-title color="amber" title="Data Pengaju" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Nama Lengkap" value="{{ $ketua->nama ?? $mahasiswa->nama }}" readonly />
                    <x-input label="NIM / Identitas" value="{{ $ketua->nim ?? $mahasiswa->nim }}" readonly />
                </div>
                @if($ketua && $ketua->id !== $mahasiswa->id)
                <div class="bg-blue-50 border border-blue-100 p-4 rounded-2xl flex items-start gap-3">
                    <div class="w-8 h-8 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p class="text-[10px] font-bold text-blue-700">Anda terdaftar sebagai <strong>Anggota Kelompok</strong>. Pengajuan magang diajukan oleh Ketua Kelompok.</p>
                </div>
                @endif
            </div>

            <!-- 3. Konsentrasi -->
            <div class="space-y-4">
                <x-section-title color="indigo" title="Konsentrasi" />
                <div class="grid grid-cols-1 gap-6">
                    <x-select name="konsentrasi" label="Bidang Konsentrasi" required :disabled="$isLocked">
                        <option value="" disabled {{ !$magang ? 'selected' : '' }}>-- Pilih Konsentrasi Anda --</option>
                        <option value="Web Development" {{ ($magang && $magang->konsentrasi == 'Web Development') ? 'selected' : '' }}>1. Web Development</option>
                        <option value="Networking" {{ ($magang && $magang->konsentrasi == 'Networking') ? 'selected' : '' }}>2. Networking</option>
                        <option value="2D Animation" {{ ($magang && $magang->konsentrasi == '2D Animation') ? 'selected' : '' }}>3. 2D Animation</option>
                    </x-select>
                </div>
            </div>

            <!-- 3. Form Dynamic Group -->
            <div id="kelompokContainer" class="space-y-4 {{ ($magang && $magang->tipe_magang == 'kelompok') ? '' : 'hidden' }} animate-in fade-in slide-in-from-top-4 duration-300">
                <x-section-title color="purple" title="Anggota Kelompok" />

                <div class="bg-purple-50/50 rounded-2xl p-8 border border-purple-100 space-y-8" id="anggotaWrapper">
                    <p class="text-[11px] text-purple-600 font-black uppercase tracking-widest italic mb-2">* Kelompok minimal 2 orang dan maksimal 3 orang (termasuk Ketua).</p>

                    <!-- Anggota 1 (Wajib jika kelompok) -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="badge badge-primary badge-sm font-black italic">Anggota 1 (Wajib)</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative">
                            <x-input label="NIM Anggota 1" name="nim_anggota[]" id="nimAnggota1" value="{{ $anggotaList[0]->mahasiswa->nim ?? '' }}" placeholder="Masukkan NIM" :readonly="$isLocked" class="bg-white border-purple-100 text-purple-900" />
                            <x-input label="Nama Anggota 1" name="nama_anggota[]" id="namaAnggota1" value="{{ $anggotaList[0]->mahasiswa->nama ?? '' }}" placeholder="Masukkan Nama Lengkap" :readonly="$isLocked" class="bg-white border-purple-100 text-purple-900" />
                        </div>
                    </div>

                    <hr class="border-purple-100 border-dashed">

                    <!-- Anggota 2 (Opsional) -->
                    <div class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="badge bg-purple-200 text-purple-700 border-none badge-sm font-black italic">Anggota 2 (Opsional)</span>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 relative">
                            <x-input label="NIM Anggota 2" name="nim_anggota[]" id="nimAnggota2" value="{{ $anggotaList[1]->mahasiswa->nim ?? '' }}" placeholder="Masukkan NIM (Opsional)" :readonly="$isLocked" class="bg-white border-purple-100 text-purple-900" />
                            <x-input label="Nama Anggota 2" name="nama_anggota[]" id="namaAnggota2" value="{{ $anggotaList[1]->mahasiswa->nama ?? '' }}" placeholder="Masukkan Nama Lengkap" :readonly="$isLocked" class="bg-white border-purple-100 text-purple-900" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Data Perusahaan & Periode -->
            <div class="space-y-4">
                <x-section-title color="blue" title="Data Perusahaan & Waktu" />

                <div class="grid grid-cols-1 gap-6">
                    <x-input label="Nama Perusahaan" name="perusahaan" value="{{ $magang->perusahaan ?? '' }}" placeholder="Contoh: PT. Sumber Maju Jaya" required :readonly="$isLocked" />

                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1 italic">Alamat Lengkap Perusahaan <span class="text-red-500">*</span></label>
                        <textarea name="alamat" placeholder="Jl. Sudirman No. 123, Jakarta Raya..." class="w-full bg-gray-50 border border-gray-100 rounded-2xl py-4 px-6 text-sm font-black text-gray-800 focus:bg-white focus:ring-4 focus:ring-[#6B21A8]/5 outline-none transition-all min-h-[120px]" required {{ $isLocked ? 'readonly' : '' }}>{{ $magang->alamat ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                    <x-input type="date" label="Periode Mulai" name="tanggal_mulai" value="{{ $magang->tanggal_mulai ?? '' }}" required :readonly="$isLocked" />
                    <x-input type="date" label="Periode Selesai" name="tanggal_selesai" value="{{ $magang->tanggal_selesai ?? '' }}" required :readonly="$isLocked" />
                </div>
            </div>

            <!-- CTA Navigation -->
            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-10 border-t border-gray-50">
                @if(!$isLocked)
                <button type="reset" class="w-full sm:w-auto px-8 py-4 bg-white-500 hover:bg-gray-200 text-gray border-none rounded-2xl font-black uppercase tracking-widest text-[11px] transition-all italic" id="btnReset">
                    Reset Data
                </button>
                <button type="submit" class="w-full sm:w-auto bg-amber-400 hover:bg-amber-500 text-white rounded-2xl py-4 px-10 font-black uppercase tracking-widest text-[11px] shadow-2xl shadow-purple-200 hover:scale-[1.02] active:scale-95 transition-all flex items-center justify-center gap-3" id="btnSubmit">
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
    </x-card>
</div>

<!-- Confirmation Modal -->
<dialog id="confirmModal" class="modal modal-bottom sm:modal-middle">
  <div class="modal-box bg-white rounded-2xl p-8 text-center">
    <div class="w-16 h-16 mx-auto bg-amber-50 rounded-2xl flex items-center justify-center mb-6">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
    </div>
    <h3 class="font-black text-gray-800 text-lg mb-2">Apakah data anda sudah benar?</h3>
    <p class="text-sm text-gray-400 font-bold mb-8">Pastikan semua data yang anda masukkan sudah sesuai sebelum dikirim.</p>
    <div class="flex gap-3 justify-center">
      <button type="button" onclick="document.getElementById('confirmModal').close()" class="btn px-8 bg-gray-100 hover:bg-gray-200 text-gray-600 border-none rounded-2xl font-black uppercase tracking-widest text-[10px] h-12">
        Tidak
      </button>
      <button type="button" id="btnConfirmYa" class="btn px-8 bg-amber-400 hover:bg-amber-500 text-white border-none rounded-2xl font-black uppercase tracking-widest text-[10px] h-12 shadow-lg shadow-amber-100">
        Ya, Kirim
      </button>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>

<script>
    // fungsi untuk menampilkan atau menyembunyikan formulir kelompok berdasarkan pilihan pendaftaran
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

        document.getElementById('confirmModal').showModal();
    });

    form.addEventListener('reset', function() {
        toggleKelompok(false);
    });

    document.getElementById('btnConfirmYa').addEventListener('click', function() {
        document.getElementById('confirmModal').close();

        btnSubmit.disabled = true;
        btnText.innerText = "Mengirim...";
        btnIcon.classList.add('hidden');
        btnLoading.classList.remove('hidden');

        setTimeout(() => {
            form.submit();
        }, 500);
    });

</script>
@endsection
