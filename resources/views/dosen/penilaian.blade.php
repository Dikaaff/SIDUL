@extends('layouts.app')

@section('title', 'Penilaian Laporan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Penilaian Magang ⭐
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Berikan nilai akhir dan status kelulusan mahasiswa berdasarkan laporan dan kinerja magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Grade Input Form Card -->
    <div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
        <div class="px-8 py-6 border-b border-base-100 flex items-center justify-between bg-gray-50/50">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" /></svg>
                Formulir Penilaian Akhir
            </h3>
            <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest bg-white px-3 py-1 rounded-full border border-gray-100 shadow-sm">Akademik • 2025/2026</span>
        </div>
        
        <div class="card-body p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <!-- Select Student -->
                <div class="form-control">
                    <label class="label"><span class="label-text font-extrabold text-gray-700 uppercase tracking-wider text-xs">Pilih Mahasiswa</span></label>
                    <select class="select select-bordered w-full bg-white text-gray-800 font-bold focus:border-[#6B21A8]">
                        <option disabled selected>Pilih Mahasiswa Bimbingan</option>
                        <option>Andi Saputra (210401001)</option>
                        <option>Budi Ramadhan (210401045)</option>
                        <option>Siti Maryam (210401090)</option>
                    </select>
                </div>

                <!-- Input Grade -->
                <div class="form-control">
                    <label class="label"><span class="label-text font-extrabold text-gray-700 uppercase tracking-wider text-xs">Nilai Akhir (0-100)</span></label>
                    <div class="relative">
                         <input type="number" placeholder="85" class="input input-bordered w-full bg-white text-gray-800 font-extrabold text-lg focus:border-[#6B21A8] pl-10 h-12" />
                         <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">#</span>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                 <!-- Select Status -->
                <div class="form-control">
                    <label class="label"><span class="label-text font-extrabold text-gray-700 uppercase tracking-wider text-xs">Status Kelulusan Magang</span></label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <label class="p-5 border-2 border-green-100 rounded-3xl bg-green-50/30 flex items-center justify-between cursor-pointer hover:bg-green-50 transition-all group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-white border border-green-100 flex items-center justify-center text-green-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <span class="font-extrabold text-green-700 tracking-tight">LULUS !!</span>
                            </div>
                            <input type="radio" name="status" class="radio radio-success border-green-300" checked />
                        </label>
                        <label class="p-5 border-2 border-red-100 rounded-3xl bg-red-50/30 flex items-center justify-between cursor-pointer hover:bg-red-50 transition-all group">
                             <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-2xl bg-white border border-red-100 flex items-center justify-center text-red-600 shadow-sm group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                </div>
                                <span class="font-extrabold text-red-700 tracking-tight">REVISI / TIDAK LULUS</span>
                            </div>
                            <input type="radio" name="status" class="radio radio-error border-red-300" />
                        </label>
                    </div>
                </div>

                <!-- Feedback -->
                <div class="form-control">
                    <label class="label"><span class="label-text font-extrabold text-gray-700 uppercase tracking-wider text-xs">Umpan Balik & Evaluasi</span></label>
                    <textarea class="textarea textarea-bordered h-32 bg-white text-gray-800 text-sm focus:border-[#6B21A8] leading-relaxed p-4" placeholder="Berikan evaluasi singkat mengenai performa mahasiswa selama magang..."></textarea>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex justify-end gap-3">
                 <button class="btn btn-ghost text-gray-400 font-bold px-8">Reset</button>
                 <button class="btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none shadow-xl shadow-purple-100 px-12 h-12">Submit Penilaian</button>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-6 bg-purple-50 rounded-3xl border border-purple-100 flex items-start gap-4">
             <div class="w-12 h-12 rounded-2xl bg-white border border-purple-100 flex items-center justify-center text-[#6B21A8] shadow-sm shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
             </div>
             <div>
                 <h4 class="font-extrabold text-[#6B21A8] text-sm uppercase tracking-wider mb-2">Penting</h4>
                 <p class="text-xs text-purple-900/70 font-medium leading-relaxed">Nilai yang sudah disubmit akan diteruskan ke Operator Prodi dan tidak dapat diubah secara mandiri. Pastikan data sudah benar.</p>
             </div>
        </div>
        <div class="p-6 bg-gray-50 rounded-3xl border border-gray-100 flex items-start gap-4">
             <div class="w-12 h-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 shadow-sm shrink-0">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
             </div>
             <div>
                 <h4 class="font-extrabold text-gray-600 text-sm uppercase tracking-wider mb-2">Bantuan</h4>
                 <p class="text-xs text-gray-500 font-medium leading-relaxed">Jika mahasiswa tidak muncul dalam daftar, pastikan status magang mereka sudah mencapai tahap "Selesai Magang".</p>
             </div>
        </div>
    </div>
</div>
@endsection
