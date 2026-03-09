@extends('layouts.app')

@section('title', 'Penentuan Dosen Pembimbing')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Penugasan Pembimbing 🧑‍🏫
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Tetapkan dosen pembimbing magang bagi mahasiswa yang telah divalidasi berkas pendaftarannya.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- List Mahasiswa Belum Berpembimbing -->
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between px-2">
             <h3 class="text-lg font-black text-gray-800 tracking-tight flex items-center gap-2">
                 <span class="w-2 h-6 bg-[#F49E0A] rounded-full"></span>
                 Mahasiswa Menunggu Pembimbing
             </h3>
        </div>

        <!-- Student Assignment Item -->
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center font-black text-xl text-gray-300">AS</div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-lg tracking-tight">Andi Saputra</h4>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mt-1">210401001 • Teknik Informatika</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 w-full md:w-64">
                         <label class="text-[9px] font-black uppercase text-gray-400 tracking-widest px-1">Pilih Dosen</label>
                         <select class="select select-bordered select-sm w-full bg-white text-gray-700 font-bold focus:border-[#6B21A8]">
                             <option disabled selected>-- Pilih Dosen --</option>
                             <option>Dr. Budi Santoso, M.Kom</option>
                             <option>Anita Wijaya, Ph.D</option>
                             <option>Siti Aminah, M.T</option>
                         </select>
                    </div>
                    <button class="btn bg-[#6B21A8] hover:bg-purple-800 text-white border-none px-8 font-black uppercase tracking-widest text-[10px] h-11 min-h-0">Tetapkan</button>
                </div>
                
                <div class="mt-6 pt-6 border-t border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-4">
                     <div class="bg-gray-50 p-4 rounded-2xl flex items-center gap-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                         <div>
                             <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Perusahaan Magang</p>
                             <p class="text-xs font-bold text-gray-800">PT. Teknologi Maju Persada</p>
                         </div>
                     </div>
                     <div class="bg-gray-50 p-4 rounded-2xl flex items-center gap-3">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                         <div>
                             <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Dosen Wali</p>
                             <p class="text-xs font-bold text-gray-800">Drs. M. Ali, M.Si</p>
                         </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Info Box -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h4 class="font-black text-gray-400 text-[10px] uppercase tracking-[0.2em] mb-4">Statistik Beban Dosen</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between group cursor-pointer p-2 hover:bg-gray-50 rounded-xl transition-all">
                        <span class="text-xs font-bold text-gray-600">Dr. Budi Santoso</span>
                        <span class="badge badge-error text-white font-black text-[10px]">12/12</span>
                    </div>
                    <div class="flex items-center justify-between group cursor-pointer p-2 hover:bg-gray-50 rounded-xl transition-all">
                        <span class="text-xs font-bold text-gray-600">Anita Wijaya, Ph.D</span>
                        <span class="badge badge-success text-white font-black text-[10px]">5/12</span>
                    </div>
                    <div class="flex items-center justify-between group cursor-pointer p-2 hover:bg-gray-50 rounded-xl transition-all">
                         <span class="text-xs font-bold text-gray-600">Siti Aminah, M.T</span>
                         <span class="badge badge-warning text-white font-black text-[10px]">8/12</span>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-orange-50 border border-orange-100 rounded-2xl">
                     <p class="text-[10px] text-orange-800 leading-relaxed font-bold italic">"Patuhi kuota maksimal bimbingan (12 mahasiswa) sesuai SK Dekan."</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
