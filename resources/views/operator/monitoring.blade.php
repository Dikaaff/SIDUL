@extends('layouts.app')

@section('title', 'Monitoring Seluruh Mahasiswa Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Monitoring Global 🌍
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Pantau seluruh mahasiswa magang di berbagai instansi dan berbagai tahap proses.</p>
    </div>
</div>
@endsection

@section('content')
<div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
    <div class="p-8 border-b border-base-100 bg-gray-50/50 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="flex items-center gap-6">
             <div class="bg-white p-3 rounded-2xl border border-gray-100 shadow-sm">
                  <h3 class="text-2xl font-black text-gray-800 tracking-tight">128</h3>
                  <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mt-0.5">Total Mahasiswa</p>
             </div>
             <div class="h-10 w-[1px] bg-gray-200 hidden md:block"></div>
             <div class="flex gap-4">
                 <div class="flex flex-col">
                      <span class="text-[10px] font-black text-green-600 uppercase tracking-widest mb-1">Aktif Magang</span>
                      <span class="text-lg font-black text-gray-800">84</span>
                 </div>
                 <div class="flex flex-col">
                      <span class="text-[10px] font-black text-orange-500 uppercase tracking-widest mb-1">Pendaftaran</span>
                      <span class="text-lg font-black text-gray-800">44</span>
                 </div>
             </div>
        </div>
        <div class="join shadow-sm border border-base-200">
             <input class="input input-sm join-item bg-white text-gray-800 focus:outline-none w-64 lg:w-80" placeholder="Cari Nama, NIM, atau Perusahaan..." />
             <button class="btn btn-sm join-item bg-white border-l-base-200 text-[#6B21A8] hover:bg-gray-100">Cari</button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="table table-lg w-full">
            <thead>
                <tr class="text-gray-400 font-extrabold text-[10px] uppercase tracking-[0.2em] bg-gray-50/30">
                    <th class="py-6">Mahasiswa & NIM</th>
                    <th>Instansi Tujuan</th>
                    <th>Status Saat Ini</th>
                    <th>Pembimbing</th>
                    <th>Progres</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
                <tr class="hover:bg-gray-50/50 border-b border-base-100 transition-colors">
                    <td class="py-8">
                         <div class="font-black text-gray-800">Andi Saputra</div>
                         <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">210401001</div>
                    </td>
                    <td>
                         <div class="font-bold text-gray-700 text-sm">PT. Teknologi Maju Persada</div>
                         <span class="text-[9px] text-gray-400 uppercase font-black tracking-widest">Jakarta Pusat</span>
                    </td>
                    <td>
                         <div class="flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-green-500"></div>
                             <span class="text-[10px] font-black text-green-600 uppercase tracking-widest">Aktif Magang</span>
                         </div>
                    </td>
                    <td class="text-xs font-bold text-gray-500">Dr. Budi Santoso</td>
                    <td>
                         <div class="flex items-center gap-3">
                             <div class="flex-1 h-3 bg-gray-100 rounded-full overflow-hidden w-24">
                                 <div class="h-full bg-[#6B21A8] w-[75%] rounded-full shadow-[0_0_8px_rgba(107,33,168,0.3)]"></div>
                             </div>
                             <span class="text-xs font-black text-gray-800">75%</span>
                         </div>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="hover:bg-gray-50/50 border-b border-base-100 transition-colors">
                    <td class="py-8">
                         <div class="font-black text-gray-800">Budi Ramadhan</div>
                         <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">210401045</div>
                    </td>
                    <td>
                         <div class="font-bold text-gray-700 text-sm">Bank Nasional Nusantara</div>
                         <span class="text-[9px] text-gray-400 uppercase font-black tracking-widest">Medan</span>
                    </td>
                    <td>
                         <div class="flex items-center gap-2">
                             <div class="w-2 h-2 rounded-full bg-orange-500"></div>
                             <span class="text-[10px] font-black text-orange-600 uppercase tracking-widest">Verifikasi Pra Survey</span>
                         </div>
                    </td>
                    <td class="text-xs font-bold text-gray-300 italic">Belum Ditugaskan</td>
                    <td>
                         <div class="flex items-center gap-3">
                             <div class="flex-1 h-3 bg-gray-100 rounded-full overflow-hidden w-24">
                                 <div class="h-full bg-orange-400 w-[15%] rounded-full shadow-[0_0_8px_rgba(244,158,10,0.3)]"></div>
                             </div>
                             <span class="text-xs font-black text-gray-800">15%</span>
                         </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
