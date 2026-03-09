@extends('layouts.app')

@section('title', 'Monitoring Mahasiswa Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Monitoring Mahasiswa 📊
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Pantau progres kegiatan, status magang, dan informasi perusahaan mahasiswa bimbingan Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
    <div class="px-8 py-6 border-b border-base-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-gray-50/50">
        <div class="flex items-center gap-4">
            <div class="bg-white p-2 rounded-xl border border-base-200 shadow-sm">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <h3 class="font-bold text-xl text-gray-800 tracking-tight">Daftar Mahasiswa Bimbingan</h3>
        </div>
        <div class="flex gap-2">
            <div class="join shadow-sm border border-base-200">
                <input class="input input-sm join-item bg-white text-gray-800 focus:outline-none w-48 lg:w-64" placeholder="Cari nama atau NIM..." />
                <button class="btn btn-sm join-item bg-white border-l-base-200 text-gray-500 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </button>
            </div>
            <select class="select select-sm select-bordered bg-white text-gray-700 font-bold max-w-xs focus:border-[#6B21A8]">
                <option disabled selected>Filter Status</option>
                <option>Semua</option>
                <option>Aktif Magang</option>
                <option>Pendaftaran</option>
                <option>Selesai</option>
            </select>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table table-lg w-full">
            <thead>
                <tr class="text-gray-400 font-extrabold text-xs uppercase tracking-[0.2em] bg-gray-50/30">
                    <th class="py-6">Mahasiswa</th>
                    <th>Instansi Magang</th>
                    <th>Status & Progress</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <!-- Student Row 1 -->
                <tr class="hover:bg-gray-50/50 transition-colors border-b border-base-100 group">
                    <td class="py-8">
                        <div class="flex items-center gap-4">
                            <div class="avatar">
                                <div class="w-14 h-14 rounded-2xl bg-purple-100 text-[#6B21A8] flex items-center justify-center font-bold text-xl shadow-inner">AS</div>
                            </div>
                            <div>
                                <div class="font-extrabold text-gray-800 text-lg group-hover:text-[#6B21A8] transition-colors">Andi Saputra</div>
                                <div class="text-xs font-bold text-gray-400 tracking-widest mt-1">210401001 • Teknik Informatika</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700 text-sm">PT. Teknologi Maju Persada</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Software Development</span>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-[10px] font-extrabold text-green-600 uppercase tracking-[0.1em]">Verified</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="w-full max-w-xs space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="badge badge-success badge-outline font-bold text-[10px] py-3 px-4 uppercase tracking-[0.1em] border-2">Aktif Magang</span>
                                <span class="text-sm font-extrabold text-gray-800">85%</span>
                            </div>
                            <div class="relative h-2.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="absolute top-0 left-0 h-full bg-[#6B21A8] rounded-full shadow-[0_0_8px_rgba(107,33,168,0.4)] transition-all duration-1000" style="width: 85%"></div>
                            </div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">Pengerjaan Draft Laporan Akhir</p>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-circle btn-ghost hover:bg-[#6B21A8]/5 text-gray-300 hover:text-[#6B21A8] transition-all">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    </td>
                </tr>

                <!-- Student Row 2 -->
                <tr class="hover:bg-gray-50/50 transition-colors border-b border-base-100 group">
                    <td class="py-8">
                        <div class="flex items-center gap-4">
                            <div class="avatar">
                                <div class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center font-bold text-xl shadow-inner">BR</div>
                            </div>
                            <div>
                                <div class="font-extrabold text-gray-800 text-lg group-hover:text-orange-600 transition-colors">Budi Ramadhan</div>
                                <div class="text-xs font-bold text-gray-400 tracking-widest mt-1">210401045 • Teknik Informatika</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-700 text-sm">Bank Nasional Nusantara</span>
                            <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Financial Technology</span>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-2 h-2 rounded-full bg-orange-400"></div>
                                <span class="text-[10px] font-extrabold text-orange-500 uppercase tracking-[0.1em]">Verification Pending</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="w-full max-w-xs space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="badge badge-warning badge-outline font-bold text-[10px] py-3 px-4 uppercase tracking-[0.1em] border-2 text-orange-600 border-orange-200">Tahap Pendaftaran</span>
                                <span class="text-sm font-extrabold text-gray-400">15%</span>
                            </div>
                            <div class="relative h-2.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="absolute top-0 left-0 h-full bg-orange-400 rounded-full shadow-[0_0_8px_rgba(244,158,10,0.4)] transition-all duration-1000" style="width: 15%"></div>
                            </div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">Menunggu Surat Pengantar Magang</p>
                        </div>
                    </td>
                    <td>
                        <button class="btn btn-circle btn-ghost hover:bg-orange-50 text-gray-300 hover:text-orange-600 transition-all">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="p-8 bg-gray-50/50 border-t border-base-100 flex items-center justify-between">
         <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Menampilkan 2 dari 24 Mahasiswa</p>
         <div class="join">
            <button class="join-item btn btn-sm bg-white border-base-200 hover:bg-gray-100">«</button>
            <button class="join-item btn btn-sm bg-[#6B21A8] text-white border-none px-4">1</button>
            <button class="join-item btn btn-sm bg-white border-base-200 hover:bg-gray-100">2</button>
            <button class="join-item btn btn-sm bg-white border-base-200 hover:bg-gray-100">3</button>
            <button class="join-item btn btn-sm bg-white border-base-200 hover:bg-gray-100">»</button>
         </div>
    </div>
</div>
@endsection
