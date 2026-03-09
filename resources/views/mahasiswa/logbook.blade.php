@extends('layouts.app')

@section('title', 'Logbook Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Logbook Magang 📝
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Catat aktivitas harian, kendala, dan pekerjaan magang Anda.</p>
    </div>
    <button onclick="document.getElementById('add_logbook_modal').showModal()" class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none px-6 shadow-lg shadow-orange-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
        Tambah Logbook
    </button>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200">
    <div class="card-body">
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full text-black">
                <thead>
                    <tr class="text-gray-700 font-bold border-b-2">
                        <th class="bg-gray-50">Tanggal</th>
                        <th class="bg-gray-50">Aktivitas Harian</th>
                        <th class="bg-gray-50">Kendala</th>
                        <th class="bg-gray-50">Pekerjaan</th>
                        <th class="bg-gray-50">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-medium">09 Maret 2026</td>
                        <td class="max-w-xs truncate">Mempelajari framework Laravel untuk pengembangan sistem...</td>
                        <td class="text-red-500 italic">Konfigurasi DB Error</td>
                        <td>Setup Environment</td>
                        <td>
                            <button class="btn btn-xs btn-ghost text-primary font-bold">Detail</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-medium">08 Maret 2026</td>
                        <td class="max-w-xs truncate">Membuat desain UI untuk dashboard mahasiswa menggunakan...</td>
                        <td class="text-green-600 italic">Tidak ada</td>
                        <td>Frontend Design</td>
                        <td>
                            <button class="btn btn-xs btn-ghost text-primary font-bold">Detail</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Tambah Logbook -->
<dialog id="add_logbook_modal" class="modal">
  <div class="modal-box bg-white w-11/12 max-w-2xl">
    <form method="dialog">
      <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
    </form>
    <h3 class="font-bold text-lg text-primary mb-6">Tambah Catatan Logbook</h3>
    
    <div class="space-y-4">
        <div class="form-control">
            <label class="label"><span class="label-text font-bold text-gray-700">Tanggal Kegiatan</span></label>
            <input type="date" class="input input-bordered w-full bg-white text-black" />
        </div>
        <div class="form-control">
            <label class="label"><span class="label-text font-bold text-gray-700">Aktivitas Harian</span></label>
            <textarea placeholder="Ceritakan aktivitas Anda..." class="textarea textarea-bordered h-24 bg-white text-black"></textarea>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-control">
                <label class="label"><span class="label-text font-bold text-gray-700">Kendala Magang</span></label>
                <input type="text" placeholder="e.g. Tidak ada" class="input input-bordered w-full bg-white text-black" />
            </div>
            <div class="form-control">
                <label class="label"><span class="label-text font-bold text-gray-700">Pekerjaan / Output</span></label>
                <input type="text" placeholder="e.g. Dokumentasi API" class="input input-bordered w-full bg-white text-black" />
            </div>
        </div>
        
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-ghost">Batal</button>
            </form>
            <button class="btn btn-primary bg-[#F49E0A] hover:bg-orange-500 border-none text-white px-8">Simpan Logbook</button>
        </div>
    </div>
  </div>
</dialog>
@endsection
