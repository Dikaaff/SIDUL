@extends('layouts.app')

@section('title', 'Profil Mahasiswa')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Profil Saya 👤
        </h2>
        <p class="text-gray-700 font-medium text-sm">Informasi pribadi dan data akademik mahasiswa.</p>
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Profil</li>
  </ul>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
    <!-- Left Column: Avatar & Basic Info -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm text-center relative overflow-hidden group">
            <div class="absolute top-0 left-0 w-full h-2 bg-[#6B21A8]"></div>
            
            <div class="relative inline-block mb-6">
                <div class="w-32 h-32 rounded-[2.5rem] bg-purple-50 flex items-center justify-center border-4 border-white shadow-xl ring-1 ring-purple-100 overflow-hidden">
                    <img id="avatar-preview" src="https://ui-avatars.com/api/?name=Dika+Afif&background=6B21A8&color=fff&size=256&bold=true" alt="Avatar" class="w-full h-full object-cover" />
                </div>
                <label for="avatar-input" class="absolute bottom-0 right-0 w-10 h-10 bg-[#F49E0A] rounded-2xl flex items-center justify-center text-white shadow-lg border-2 border-white hover:scale-110 transition-transform cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    <input type="file" id="avatar-input" class="hidden" accept="image/*" onchange="previewAvatar(this)" />
                </label>
            </div>
            
            <h3 class="text-xl font-black text-gray-800 uppercase tracking-tighter italic">Dika Afif</h3>
            <p class="text-sm font-bold text-[#6B21A8] uppercase tracking-widest mt-1">23.01.5029</p>
            
            <div class="mt-8 pt-8 border-t border-gray-50">
                <div class="flex items-center justify-between p-3 rounded-xl bg-purple-50 border border-purple-100">
                    <span class="text-[10px] font-black text-purple-700 uppercase">Program Magang</span>
                    <span id="magang-badge" class="badge bg-gray-300 border-none text-[10px] font-black text-white px-3">BELUM</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-gray-100 p-6 shadow-sm">
            <h4 class="text-xs font-black text-gray-800 uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-[#F49E0A]"></span>
                Status Akademik
            </h4>
            <div class="space-y-4">
                <div class="flex items-center justify-between p-3 rounded-xl bg-green-50 border border-green-100">
                    <span class="text-xs font-bold text-green-700">Status Mahasiswa</span>
                    <span class="badge badge-success text-[10px] font-black text-white px-3">AKTIF</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Detail Info Form -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm">
            <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="font-black text-gray-800 uppercase tracking-widest text-sm italic">Informasi Personal</h3>
                    <p class="text-xs text-gray-600 font-bold mt-1">Data akademik dan informasi instansi magang Anda.</p>
                </div>
                <button onclick="simulateEdit()" class="btn btn-sm bg-[#6B21A8] hover:bg-purple-800 border-none text-white px-6 rounded-xl text-[10px] font-black uppercase tracking-widest">Edit Profil</button>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest block ml-1">Email Kampus</label>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-transparent font-bold text-sm text-gray-800">
                        dika.afif@sidul.ac.id
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest block ml-1">Program Studi</label>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-transparent font-bold text-sm text-gray-800">
                        D3 Teknik Informatika
                    </div>
                </div>
                <div class="md:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-gray-600 uppercase tracking-widest block ml-1">Nama Instansi Magang</label>
                    <div id="company-name" class="p-4 bg-gray-50 rounded-2xl border border-transparent font-bold text-sm text-gray-400 italic">
                        Belum Mendaftar Magang
                    </div>
                </div>
            </div>
        </div>

        <!-- Motivation Card -->
        <div class="bg-[#6B21A8] rounded-[2.5rem] p-8 text-white relative overflow-hidden group shadow-xl transition-all hover:shadow-purple-900/40">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
            <div class="z-10 relative">
                <h3 class="text-2xl font-black uppercase tracking-tighter italic">Semangat Magang, Dika! 🚀</h3>
                <p class="text-white/70 font-bold text-sm mt-1 leading-relaxed">Teruslah belajar dan berikan kontribusi terbaik di instansi tempatmu bertugas. Perjalanan karir dimulai dari sini.</p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const pendaftaran = @json($pendaftaran);
        if (pendaftaran) {
            document.getElementById('company-name').innerText = pendaftaran.perusahaan;
            document.getElementById('company-name').classList.remove('italic', 'text-gray-400');
            
            const badge = document.getElementById('magang-badge');
            badge.innerText = 'TERDAFTAR';
            badge.classList.remove('bg-gray-300');
            badge.classList.add('bg-[#6B21A8]');
        }
    });

    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
                showNotif("Foto profil diperbarui!");
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function simulateEdit() {
        showNotif("Mode edit diaktifkan! (Simulasi)");
    }

    function showNotif(msg) {
        showToast('success', msg);
    }
</script>

@endsection
