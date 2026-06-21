@extends('layouts.app')

@section('title', 'Edit Data Profil')

@section('header')
<x-page-header 
    title="Edit Data Profil ✏️" 
    subtitle="Ajukan perubahan data diri, data perusahaan magang, atau anggota kelompok Anda."
/>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2 mb-6">
    <ul>
        <li><a href="/dashboard" class="hover:text-[#6B21A8] transition-colors">SIDUL</a></li> 
        <li><a href="{{ route('mahasiswa.dashboard') }}" class="hover:text-[#6B21A8] transition-colors">Dashboard</a></li>
        <li>Edit Data</li>
    </ul>
</div>
@endsection

@section('content')
@php
    $existingAnggotaCount = $magang ? $magang->peserta->filter(fn($p) => !$p->is_ketua)->count() : 0;
    $maxAdditionalAnggota = 2 - $existingAnggotaCount;
@endphp
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    {{-- Kolom Kiri: Form Pengajuan --}}
    <div class="lg:col-span-7 space-y-6">
        <x-card padding="large" border>
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-[#6B21A8] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                </div>
                <div>
                    <h3 class="font-black text-gray-800 text-lg">Ajukan Perubahan Data</h3>
                    <p class="text-xs font-medium text-gray-400">Pilih field yang ingin diubah dan isi nilai baru</p>
                </div>
            </div>

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

            @if($hasPending)
                <div class="bg-amber-50 border-2 border-amber-200 p-6 rounded-2xl flex items-start gap-4">
                    <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <div>
                        <h4 class="font-black text-amber-500 text-sm uppercase tracking-wider">Permintaan Sedang Diproses</h4>
                        <p class="text-xs font-medium text-amber-600 mt-1">Anda masih memiliki permintaan perubahan data yang menunggu persetujuan Operator. Silakan tunggu hingga diproses.</p>
                    </div>
                </div>
            @else
                <form action="{{ route('mahasiswa.edit_data.store') }}" method="POST" id="editForm" data-no-loading>
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Field yang Ingin Diubah</label>
                            <select name="field" id="fieldSelect" class="select select-md w-full bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10" required>
                                <option value="">-- Pilih Field --</option>
                                @foreach($editableFields as $key => $label)
                                <option value="{{ $key }}" data-current="{{ $currentValues[$key] ?? '' }}" data-target="{{ \App\Services\EditRequestService::getFieldTarget($key) }}">
                                    {{ $label }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Nilai Saat Ini</label>
                            <div id="currentValueDisplay" class="w-full bg-gray-100 text-gray-500 rounded-2xl px-5 py-3 text-sm font-bold">
                                Pilih field terlebih dahulu
                            </div>
                        </div>

                        <div id="textInputGroup">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Nilai Baru <span class="text-red-500">*</span></label>
                            <input type="text" name="new_value" id="newValueInput" class="input input-md w-full bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10" placeholder="Masukkan nilai baru">
                        </div>

                        <div id="selectInputGroup" class="hidden">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Nilai Baru <span class="text-red-500">*</span></label>
                            <select name="new_value" id="selectInput" class="select select-md w-full bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10">
                                <option value="">-- Pilih Konsentrasi --</option>
                                <option value="Web Development">Web Development</option>
                                <option value="Networking">Networking</option>
                                <option value="2D Animation">2D Animation</option>
                            </select>
                        </div>

                        <div id="dateRangeGroup" class="hidden">
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Nilai Baru <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 block">Tanggal Mulai</label>
                                    <input type="date" name="new_value_start" id="dateStartInput" class="input input-md w-full bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10">
                                </div>
                                <div>
                                    <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5 block">Tanggal Selesai</label>
                                    <input type="date" name="new_value_end" id="dateEndInput" class="input input-md w-full bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10">
                                </div>
                            </div>
                        </div>


                        <div id="anggotaInputGroup" class="hidden space-y-4">
                            <div>
                                <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Anggota Kelompok Baru <span class="text-red-500">*</span></label>
                                <p class="text-xs font-medium text-gray-400 mb-4">
                                    @if($maxAdditionalAnggota <= 0)
                                        Kelompok Anda sudah mencapai maksimal 3 orang. Tidak dapat menambahkan anggota lagi.
                                    @else
                                        Masukkan NIM anggota kelompok baru (maksimal {{ $maxAdditionalAnggota }} orang). Ketua kelompok (Anda) tidak perlu dimasukkan.
                                    @endif
                                </p>
                            </div>
                            <div id="anggotaContainer">
                                @if($maxAdditionalAnggota > 0)
                                <div class="flex items-center gap-3 anggota-row">
                                    <input type="text" name="nim_anggota[]" class="input input-md flex-1 bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10" placeholder="NIM Anggota 1" required>
                                    <x-button type="button" variant="ghost" aria-label="Hapus anggota" onclick="hapusAnggota(this)" class="h-11 w-11 !bg-red-50 !text-red-500 border !border-red-100 hover:!bg-red-100 hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </x-button>
                                </div>
                                @endif
                            </div>
                            @if($maxAdditionalAnggota > 0)
                            <x-button type="button" variant="secondary" size="sm" onclick="tambahAnggota()" class="bg-gray-50 border-gray-100 text-gray-500 hover:bg-gray-100">
                                + Tambah Anggota
                            </x-button>
                            @endif
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-gray-500 uppercase tracking-widest mb-2 block">Alasan Pengajuan <span class="text-red-500">*</span></label>
                            <textarea name="alasan" rows="3" class="textarea w-full bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10" placeholder="Jelaskan alasan Anda ingin mengubah data ini (min. 10 karakter)" required></textarea>
                        </div>

                        <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('mahasiswa.dashboard') }}">
                                <x-button variant="secondary">
                                    Batal
                                </x-button>
                            </a>
                            <x-button variant="primary" onclick="showConfirmModal()">
                                Ajukan Perubahan
                            </x-button>
                        </div>
                    </div>
                </form>
            @endif
        </x-card>
    </div>

    {{-- Kolom Kanan: Riwayat Permintaan + Info --}}
    <div class="lg:col-span-5 space-y-6">
        @if($hasMagang)
        <x-card padding="large" border class="bg-blue-50/30 !border-blue-100">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h4 class="font-black text-blue-800 text-sm">Data Perusahaan Aktif</h4>
                    <p class="text-xs font-bold text-blue-700 mt-1">{{ $magang->perusahaan }}</p>
                    <p class="text-[10px] text-blue-600/70 italic mt-0.5">{{ $magang->alamat }}</p>
                    @if($magang->tipe_magang === 'kelompok')
                        <div class="mt-2 text-[10px] font-bold text-blue-700">
                            Tipe: Kelompok
                            @if($magang->peserta->count() > 1)
                                ({{ $magang->peserta->count() - 1 }} anggota)
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </x-card>
        @endif

        <x-card padding="large" border>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-10 h-10 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 text-sm uppercase tracking-wider">Riwayat Permintaan</h3>
                    <p class="text-[10px] font-medium text-gray-400">Daftar pengajuan perubahan data Anda</p>
                </div>
            </div>

            @if($riwayat->isEmpty())
                <div class="text-center py-10">
                    <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest italic">Belum ada riwayat permintaan</p>
                </div>
            @else
                <div class="space-y-3 max-h-[400px] overflow-y-auto">
                    @foreach($riwayat as $item)
                    <div class="p-4 rounded-2xl border border-gray-100 bg-gray-50/50 space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black uppercase tracking-wider text-gray-400">{{ $item->field === 'anggota_kelompok' ? 'Anggota Kelompok' : ($editableFields[$item->field] ?? $item->field) }}</span>
                            @if($item->status === 'approved')
                                <span class="badge bg-green-50 text-green-600 border-none text-[8px] font-black uppercase tracking-widest px-3 py-2">Disetujui</span>
                            @elseif($item->status === 'rejected')
                                <span class="badge bg-red-50 text-red-600 border-none text-[8px] font-black uppercase tracking-widest px-3 py-2">Ditolak</span>
                            @else
                                <span class="badge bg-amber-50 text-amber-600 border-none text-[8px] font-black uppercase tracking-widest px-3 py-2">Pending</span>
                            @endif
                        </div>
                        <div class="text-xs font-bold text-gray-700">
                            @if($item->field === 'anggota_kelompok')
                                @php
                                    $oldNims = json_decode($item->old_value, true);
                                    $newNims = json_decode($item->new_value, true);
                                @endphp
                                <span class="text-gray-400">{{ is_array($oldNims) ? implode(', ', $oldNims) : $item->old_value }}</span>
                                → <span class="text-[#6B21A8]">{{ is_array($newNims) ? implode(', ', $newNims) : $item->new_value }}</span>
                            @else
                                {{ $item->old_value }} → <span class="text-[#6B21A8]">{{ str_replace('|', ' s/d ', $item->new_value) }}</span>
                            @endif
                        </div>
                        @if($item->catatan_operator)
                            <p class="text-[10px] text-gray-400 italic">Catatan: {{ $item->catatan_operator }}</p>
                        @endif
                        <p class="text-[9px] text-gray-400 font-medium">{{ $item->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    @endforeach
                </div>
            @endif
        </x-card>
    </div>

</div>

{{-- Modal Konfirmasi --}}
<x-modal id="confirmEditModal" title="Konfirmasi Pengajuan" subtitle="PASTIKAN DATA ANDA SUDAH SESUAI" color="purple" size="md">
    <div class="space-y-6">
        <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-5 flex items-start gap-4">
            <div class="w-10 h-10 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <div>
                <h4 class="font-black text-amber-800 text-sm">Apakah Anda Yakin Data Ini Sudah Sesuai?</h4>
                <p class="text-xs font-medium text-amber-700 mt-1">Setelah diajukan, perubahan akan diverifikasi oleh Operator. Pastikan data yang Anda masukkan sudah benar.</p>
            </div>
        </div>

        <div class="bg-gray-50 rounded-2xl p-5 space-y-3">
            <div class="flex justify-between items-center">
                <span class="text-[10px] font-medium text-gray-400 uppercase tracking-wider">Field</span>
                <span id="confirmField" class="text-sm font-bold text-gray-800">-</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[10px] font-medium text-gray-400 uppercase tracking-wider">Nilai Lama</span>
                <span id="confirmOld" class="text-sm font-bold text-gray-500">-</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[10px] font-medium text-gray-400 uppercase tracking-wider">Nilai Baru</span>
                <span id="confirmNew" class="text-sm font-bold text-[#6B21A8]">-</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[10px] font-medium text-gray-400 uppercase tracking-wider">Alasan</span>
                <span id="confirmAlasan" class="text-sm font-bold text-gray-700 text-right max-w-[200px]">-</span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 pt-2">
            <form method="dialog" data-no-loading>
                <x-button type="submit" variant="ghost" size="lg" :full="true">Batal</x-button>
            </form>
            <x-button variant="primary" size="lg" :full="true" onclick="submitEditForm(this)">
                Ya, Ajukan!
            </x-button>
        </div>
    </div>
</x-modal>
@endsection

@push('scripts')
<script>
const maxAnggotaTambahan = {{ $maxAdditionalAnggota }};
let anggotaCount = {{ $maxAdditionalAnggota > 0 ? 1 : 0 }};

document.addEventListener('DOMContentLoaded', function() {
    const fieldSelect = document.getElementById('fieldSelect');
    const currentDisplay = document.getElementById('currentValueDisplay');
    const newValueInput = document.getElementById('newValueInput');
    const selectInput = document.getElementById('selectInput');
    const dateStartInput = document.getElementById('dateStartInput');
    const dateEndInput = document.getElementById('dateEndInput');
    const textGroup = document.getElementById('textInputGroup');
    const selectGroup = document.getElementById('selectInputGroup');
    const dateRangeGroup = document.getElementById('dateRangeGroup');
    const anggotaGroup = document.getElementById('anggotaInputGroup');
    const confirmField = document.getElementById('confirmField');
    const confirmOld = document.getElementById('confirmOld');
    const confirmNew = document.getElementById('confirmNew');
    const confirmAlasan = document.getElementById('confirmAlasan');

    const fieldLabels = @json($editableFields);

    function disableAllInputs() {
        newValueInput.disabled = true;
        dateStartInput.disabled = true;
        dateEndInput.disabled = true;
        selectInput.disabled = true;
    }

    function toggleInputGroup(field) {
        textGroup.classList.add('hidden');
        selectGroup.classList.add('hidden');
        dateRangeGroup.classList.add('hidden');
        anggotaGroup.classList.add('hidden');
        newValueInput.removeAttribute('required');
        dateStartInput.removeAttribute('required');
        dateEndInput.removeAttribute('required');
        selectInput.removeAttribute('required');
        disableAllInputs();

        if (!field) return;

        if (field === 'periode_magang') {
            dateRangeGroup.classList.remove('hidden');
            dateStartInput.disabled = false;
            dateEndInput.disabled = false;
            dateStartInput.setAttribute('required', 'required');
            dateEndInput.setAttribute('required', 'required');
        } else if (field === 'anggota_kelompok') {
            anggotaGroup.classList.remove('hidden');
        } else if (field === 'konsentrasi') {
            selectGroup.classList.remove('hidden');
            selectInput.disabled = false;
            selectInput.setAttribute('required', 'required');
        } else {
            textGroup.classList.remove('hidden');
            newValueInput.disabled = false;
            newValueInput.setAttribute('required', 'required');
        }
    }

    fieldSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const field = selected.value;
        const current = selected.dataset.current || '';

        currentDisplay.textContent = current || 'Pilih field terlebih dahulu';
        toggleInputGroup(field);

        if (field && fieldLabels[field]) {
            confirmField.textContent = fieldLabels[field];
        } else {
            confirmField.textContent = '-';
        }
        confirmOld.textContent = current || '-';
    });

    window.showConfirmModal = function() {
        const selected = fieldSelect.options[fieldSelect.selectedIndex];
        const field = selected.value;

        if (!field) { showToast('error', 'Silakan pilih field terlebih dahulu.'); return; }

        const alasan = document.querySelector('textarea[name="alasan"]').value.trim();
        if (!alasan || alasan.length < 10) { showToast('error', 'Alasan pengajuan minimal 10 karakter.'); return; }

        if (field === 'anggota_kelompok') {
            const nims = document.querySelectorAll('input[name="nim_anggota[]"]');
            let valid = true;
            let vals = [];
            nims.forEach(inp => {
                if (inp.value.trim()) vals.push(inp.value.trim());
                else valid = false;
            });
            if (!valid || vals.length < 1) { showToast('error', 'Isi minimal 1 NIM anggota kelompok.'); return; }
            confirmNew.textContent = vals.join(', ');
        } else if (field === 'periode_magang') {
            const start = dateStartInput.value.trim();
            const end = dateEndInput.value.trim();
            if (!start || !end) { showToast('error', 'Isi tanggal mulai dan selesai terlebih dahulu.'); return; }
            confirmNew.textContent = start + ' s/d ' + end;
        } else {
            const isSelect = field === 'konsentrasi';
            const val = isSelect ? selectInput.value.trim() : newValueInput.value.trim();
            if (!val) { showToast('error', 'Isi nilai baru terlebih dahulu.'); return; }
            confirmNew.textContent = val;
        }

        confirmField.textContent = fieldLabels[field] || field;
        confirmOld.textContent = selected.dataset.current || '-';
        confirmAlasan.textContent = alasan;
        document.getElementById('confirmEditModal').showModal();
    };

    toggleInputGroup('');
});

function tambahAnggota() {
    if (anggotaCount >= maxAnggotaTambahan) { showToast('error', 'Maksimal ' + maxAnggotaTambahan + ' anggota tambahan.'); return; }
    anggotaCount++;
    const container = document.getElementById('anggotaContainer');
    const row = document.createElement('div');
    row.className = 'flex items-center gap-3 anggota-row mt-3';
    row.innerHTML = `
        <input type="text" name="nim_anggota[]" class="input input-md flex-1 bg-gray-50 border-gray-100 rounded-2xl text-sm font-bold focus:ring-4 focus:ring-[#6B21A8]/10" placeholder="NIM Anggota ${anggotaCount}" required>
        <button type="button" aria-label="Hapus anggota" onclick="hapusAnggota(this)" class="btn h-11 w-11 bg-red-50 text-red-500 border border-red-100 hover:bg-red-100 font-black uppercase tracking-widest rounded-2xl transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    `;
    container.appendChild(row);
}

function hapusAnggota(btn) {
    const row = btn.closest('.anggota-row');
    if (document.querySelectorAll('.anggota-row').length <= 1) return;
    row.remove();
    anggotaCount--;
}

function submitEditForm(btn) {
    btn.disabled = true;
    var s = document.createElement('span');
    s.className = 'spinner-loading';
    s.innerHTML = '<svg class="animate-spin h-4 w-4 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg>';
    btn.prepend(s);
    document.getElementById('editForm').submit();
}
</script>
@endpush
