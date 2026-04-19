@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Pengaturan ⚙️
        </h2>
        <p class="text-gray-700 font-medium text-sm">Kelola keamanan akun dan preferensi aplikasi Anda.</p>
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Pengaturan</li>
  </ul>
</div>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Security Section -->
    <div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
        <div class="p-8 border-b border-gray-50 bg-gray-50/30">
            <h3 class="font-black text-gray-800 uppercase tracking-widest text-sm italic flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-purple-100 text-[#6B21A8] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                Keamanan Akun
            </h3>
        </div>
        
        <form onsubmit="handleSaveSecurity(event)" class="p-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest block ml-1">Password Saat Ini</label>
                    <input type="password" required placeholder="••••••••" class="w-full bg-gray-50 border border-transparent rounded-2xl py-4 px-5 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-purple-100 transition-all outline-none" />
                </div>
                <div class="hidden md:block"></div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest block ml-1">Password Baru</label>
                    <input type="password" id="new-password" required placeholder="••••••••" class="w-full bg-gray-50 border border-transparent rounded-2xl py-4 px-5 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-purple-100 transition-all outline-none" />
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest block ml-1">Konfirmasi Password</label>
                    <input type="password" required placeholder="••••••••" class="w-full bg-gray-50 border border-transparent rounded-2xl py-4 px-5 text-sm font-bold text-gray-800 focus:bg-white focus:ring-4 focus:ring-purple-100 transition-all outline-none" />
                </div>
            </div>
            
            <div class="flex justify-end pt-4">
                <button type="submit" id="btn-save-security" class="btn bg-[#6B21A8] hover:bg-purple-800 border-none text-white px-10 h-14 min-h-0 rounded-2xl font-black uppercase tracking-widest text-[11px] shadow-lg shadow-purple-900/20 active:scale-95 transition-all flex items-center justify-center gap-2">
                    <span class="btn-label">Simpan Perubahan</span>
                    <span class="loading loading-spinner loading-xs hidden"></span>
                </button>
            </div>
        </form>
    </div>

    <!-- Danger Zone -->
    <div class="bg-red-50/30 rounded-[2.5rem] border border-red-100 overflow-hidden">
        <div class="p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="font-black text-red-600 uppercase tracking-widest text-sm italic">Hapus Sesi Akun</h3>
                <p class="text-xs text-red-800/60 font-medium mt-1">Ini akan mengeluarkan Anda dari semua perangkat yang terhubung.</p>
            </div>
            <a href="/logout" class="btn bg-red-600 hover:bg-red-700 border-none text-white px-8 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-red-200 transition-all active:scale-95">Logout Semua Sesi</a>
        </div>
    </div>
</div>

<script>
    function handleSaveSecurity(event) {
        event.preventDefault();
        const btn = document.getElementById('btn-save-security');
        const label = btn.querySelector('.btn-label');
        const loader = btn.querySelector('.loading');

        // Start Loading
        btn.disabled = true;
        label.innerText = 'Menyimpan...';
        loader.classList.remove('hidden');

        setTimeout(() => {
            showToast('success', "Kata sandi berhasil diubah!");
            btn.disabled = false;
            label.innerText = 'Simpan Perubahan';
            loader.classList.add('hidden');
            event.target.reset();
        }, 800);
    }
</script>

@endsection
