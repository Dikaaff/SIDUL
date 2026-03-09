@extends('layouts.app')

@section('title', 'Rekomendasi Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Rekomendasi Magang ✍️
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Sebagai Dosen Wali, Anda dapat menyetujui dan memberikan tanda tangan rekomendasi magang mahasiswa.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- List Pengajuan -->
    <div class="lg:col-span-2 space-y-6">
        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2 mb-4">
            <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#6B21A8] flex items-center justify-center text-sm">3</span>
            Pengajuan Menunggu Persetujuan
        </h3>

        <!-- Card Pengajuan 1 -->
        <div class="card bg-white shadow-sm border border-base-200 hover:border-[#6B21A8]/30 transition-all">
            <div class="card-body p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 border-b border-gray-100 pb-4 mb-4">
                    <div class="flex items-center gap-4">
                        <div class="avatar placeholder">
                            <div class="bg-[#6B21A8] text-white rounded-xl w-12 h-12 flex items-center justify-center font-bold shadow-lg shadow-purple-100">SA</div>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Siti Aminah</h4>
                            <p class="text-xs text-gray-500 font-medium tracking-wide uppercase">210401089 • Teknik Informatika</p>
                        </div>
                    </div>
                    <div class="badge badge-warning badge-outline font-bold text-[10px] py-3 px-4 uppercase tracking-[0.1em]">Menunggu Tanda Tangan</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Instansi Tujuan</p>
                        <p class="text-sm font-bold text-gray-800">PT. Teknologi Maju Persada</p>
                        <p class="text-xs text-gray-500 mt-1 italic">Software Development House</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Kelengkapan Berkas</p>
                        <div class="flex items-center gap-2 text-green-600 font-bold text-xs bg-white w-fit px-3 py-1 rounded-lg border border-green-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Form Survey Terisi
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                    <button class="btn btn-ghost text-gray-400 hover:bg-red-50 hover:text-red-600 font-bold transition-all px-6">Lihat Berkas</button>
                    <button class="btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none shadow-lg shadow-purple-100 px-8 transition-all h-10 min-h-0" onclick="signature_modal.showModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Tanda Tangani
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-6">
        <div class="card bg-[#6B21A8] text-white shadow-xl shadow-purple-100 overflow-hidden">
            <div class="card-body p-6 relative">
                <div class="absolute -right-6 -bottom-6 opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                </div>
                <h3 class="text-lg font-bold mb-2">Tanda Tangan Digital</h3>
                <p class="text-white/80 text-xs leading-relaxed mb-6">Pastikan profil Anda sudah terunggah tanda tangan digital (PNG transparan) untuk mempercepat proses rekomendasi mahasiswa.</p>
                <button class="btn btn-sm bg-white hover:bg-gray-100 text-[#6B21A8] border-none px-6 shadow-lg">Upload Signature</button>
            </div>
        </div>

        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-sm uppercase tracking-wider">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Informasi Penting
                </h4>
                <div class="space-y-3">
                    <div class="p-3 bg-gray-50 rounded-xl">
                        <p class="text-xs text-gray-600 leading-relaxed font-medium">Bapak/Ibu Dosen Wali berhak <span class="text-red-500 font-bold">menolak</span> lokasi magang jika dinilai tidak relevan dengan kurikulum program studi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Signature -->
<dialog id="signature_modal" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box p-0 overflow-hidden bg-white max-w-lg">
        <div class="p-6 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-lg text-gray-800">Review & Tanda Tangan</h3>
            <form method="dialog">
                <button class="btn btn-circle btn-ghost btn-sm text-gray-400">✕</button>
            </form>
        </div>
        <div class="p-8 space-y-6">
            <div class="p-6 border-2 border-dashed border-gray-200 rounded-3xl flex flex-col items-center justify-center bg-gray-50 min-h-[200px] relative group overflow-hidden">
                <div class="text-center group-hover:scale-95 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Klik untuk Upload PNG signature</p>
                </div>
                <!-- Preview Placeholder (Simulated) -->
                <div class="absolute inset-0 bg-white items-center justify-center p-8 hidden group-hover:flex">
                     <p class="text-xs italic text-gray-400">Preview tanda tangan akan muncul di sini</p>
                </div>
            </div>

            <div class="form-control">
                <label class="label"><span class="label-text font-bold text-gray-700">Catatan Rekomendasi (Opsional)</span></label>
                <textarea class="textarea textarea-bordered h-24 bg-white text-gray-800 focus:border-[#6B21A8]" placeholder="e.g. Lokasi disetujui, pastikan mempelajari dasar-dasar cloud computing..."></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <form method="dialog">
                    <button class="btn btn-ghost text-gray-500 font-bold px-6">Batal</button>
                </form>
                <button class="btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none shadow-lg shadow-purple-100 px-8 h-12">Simpan & Setujui</button>
            </div>
        </div>
    </div>
</dialog>
@endsection
