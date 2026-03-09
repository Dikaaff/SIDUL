@extends('layouts.app')

@section('title', 'Kelola ID Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Kelola ID Magang 🆔
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Setujui pengajuan ID magang dan generate kode identitas magang mahasiswa secara otomatis.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="px-8 py-6 border-b border-base-100 flex items-center justify-between bg-gray-100/30">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-8 h-8 rounded-lg bg-purple-100 text-[#6B21A8] flex items-center justify-center text-xs font-black">5</span>
                    Menunggu Approval ID
                </h3>
            </div>
            
            <div class="p-6 space-y-4">
                <!-- Request 1 -->
                <div class="p-6 rounded-3xl bg-gray-50 border border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 hover:shadow-md transition-all group">
                    <div class="flex gap-5 items-center">
                         <div class="w-14 h-14 rounded-2xl bg-white border border-gray-200 flex items-center justify-center shadow-sm">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#6B21A8]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                         </div>
                         <div>
                             <h4 class="font-extrabold text-gray-800 text-base">Andi Saputra</h4>
                             <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">210401001 • Teknik Informatika</p>
                             <div class="mt-2 flex items-center gap-2">
                                 <span class="text-xs font-bold text-gray-700">PT. Teknologi Maju</span>
                                 <span class="text-[9px] px-2 py-0.5 bg-green-50 text-green-600 rounded-full font-black border border-green-100 uppercase tracking-widest">Verified Co</span>
                             </div>
                         </div>
                    </div>
                    <div class="flex gap-2">
                         <button class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 text-white border-none px-6 font-black uppercase tracking-widest text-[10px] h-10 min-h-0">Setujui & Generate ID</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar Items -->
    <div class="space-y-6">
        <div class="card bg-[#6B21A8] shadow-xl shadow-purple-100">
            <div class="card-body p-8 text-white">
                <h3 class="font-extrabold text-lg mb-2">Auto-Generate System</h3>
                <p class="text-white/70 text-xs leading-relaxed font-bold mb-6 italic">"ID Magang akan dibuat berdasarkan pola tahun akademik + prodi + nomor urut otomatis."</p>
                <div class="p-4 bg-white/10 rounded-2xl border border-white/20">
                     <p class="text-[9px] font-black uppercase tracking-[0.2em] text-white/50 mb-2">Preview ID Format:</p>
                     <p class="text-xl font-black tracking-widest">2026-IF-001</p>
                </div>
            </div>
        </div>

        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body p-6">
                <h4 class="font-black text-gray-400 text-[10px] uppercase tracking-widest mb-4">Statistik ID</h4>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-tight">Total ID Diterbitkan</span>
                        <span class="text-sm font-black text-gray-800">142</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-gray-600 uppercase tracking-tight">Menunggu Proses</span>
                        <span class="badge badge-warning font-black text-[10px]">5</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
