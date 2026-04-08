@extends('layouts.app')

@section('title', 'Rekomendasi Magang')

@section('header')
<x-card class="bg-[#6B21A8] text-white p-8 mt-2 relative overflow-hidden border-none shadow-2xl">
    <!-- Decorative elements -->
    <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>

    <div class="flex flex-col md:flex-row md:items-center justify-between relative z-10">
        <div>
            <h2 class="text-3xl font-black italic tracking-tighter uppercase mb-2">
                Rekomendasi Magang ✍️
            </h2>
            <p class="text-white opacity-90 font-medium text-sm md:text-base max-w-2xl">Sebagai Dosen Wali, Anda dapat memberikan persetujuan dan tanda tangan rekomendasi magang mahasiswa dengan cepat.</p>
        </div>
    </div>
</x-card>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main List Section -->
    <div class="lg:col-span-3 space-y-6">
        <div class="flex items-center justify-between bg-white p-8 rounded-[2.5rem] border border-base-200 shadow-xl shadow-gray-100/50 mb-4 transition-all hover:shadow-2xl">
            <div>
                <h3 class="font-black text-gray-800 flex items-center gap-4 italic uppercase tracking-tighter text-xl">
                    <div class="w-2 h-8 bg-primary rounded-full"></div>
                    Antrean Rekomendasi
                </h3>
            </div>
            <div class="flex gap-2">
                <input class="input input-md bg-gray-50 border-gray-100 rounded-2xl text-xs font-bold w-64 focus:ring-4 focus:ring-primary/10 focus:bg-white transition-all" placeholder="Cari Mahasiswa Berdasarkan Nama..." />
            </div>
        </div>

        <!-- Responsive Container for the list -->
        <div class="overflow-x-auto pb-4 -mx-4 px-4 lg:mx-0 lg:px-0">
            <div class="min-w-[700px]">
                <!-- Compact List Header -->
                <div class="px-8 grid grid-cols-12 gap-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] italic mb-2">
                    <div class="col-span-4">Mahasiswa & Instansi</div>
                    <div class="col-span-2 text-center">STATUS</div>
                    <div class="col-span-3">Dokumen Draft</div>
                    <div class="col-span-3 text-right">Tindakan</div>
                </div>

                <div id="recommendationList" class="space-y-3">
                    <!-- Items will be rendered by JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Side Panel Section -->
    <div class="lg:col-span-1 space-y-6">
        <x-card class="bg-[#F49E0A] text-white shadow-2xl shadow-orange-900/10 italic relative overflow-hidden group border-none">
            <x-slot name="header">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-2 h-6 bg-white rounded-full shadow-lg shadow-white/50"></div>
                    <h4 class="font-black text-xs uppercase tracking-[0.25em] italic text-white">Panduan Cepat</h4>
                </div>
            </x-slot>
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/10 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="space-y-5 relative z-10">
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white">1</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Download PDF dari mahasiswa.</p>
                </div>
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white">2</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Bubuhkan tanda tangan digital Anda.</p>
                </div>
                <div class="flex gap-4 items-center">
                    <div class="w-8 h-8 rounded-xl bg-white/20 border border-white/20 flex items-center justify-center text-xs font-black italic shadow-xl backdrop-blur-md text-white">3</div>
                    <p class="text-[10px] font-bold leading-relaxed uppercase tracking-wider text-white">Upload kembali file yang sudah di TTD.</p>
                </div>
            </div>
        </x-card>

        <x-card class="bg-[#F49E0A] text-white shadow-2xl shadow-orange-900/10 italic relative overflow-hidden group border-none">
            <p class="text-[10px] font-black text-white border-b border-white/20 pb-2 flex items-center gap-2 mb-3 lowercase tracking-widest italic">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                PENTING
            </p>
            <p class="text-[9px] font-bold text-white leading-relaxed uppercase italic">Tanda tangan harus menggunakan stempel/ttd resmi instansi universitas.</p>
        </x-card>
    </div>
</div>

<!-- Upload TTD Modal -->
<x-modal id="upload_ttd_modal" title="Upload Rekomendasi TTD">
    <div class="p-10 space-y-8">
        <div onclick="document.getElementById('ttdInput').click()" class="border-4 border-dashed border-gray-100 rounded-[2.5rem] p-12 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-white hover:border-[#6B21A8] hover:shadow-2xl hover:shadow-purple-100/50 transition-all cursor-pointer group">
            <div class="p-4 bg-white rounded-3xl shadow-sm text-gray-300 group-hover:text-[#6B21A8] transition-all mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg></div>
            <p id="fileName" class="text-[10px] font-black text-gray-500 group-hover:text-[#6B21A8] uppercase tracking-widest text-center">Bubuhkan File PDF Yang Telah Di TTD</p>
            <input type="file" id="ttdInput" accept=".pdf" class="hidden" onchange="updateUploadName(this)" />
        </div>
        <textarea class="textarea bg-gray-50 border-none h-24 rounded-2xl w-full p-6 text-xs font-bold text-gray-700 focus:ring-4 focus:ring-purple-100 transition-all" placeholder="Catatan untuk mahasiswa..."></textarea>
        <x-button variant="primary" class="w-full" onclick="handleTTDUpload()">
            Kirim Ke Mahasiswa
        </x-button>
    </div>
</x-modal>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999]">
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-5 bg-gray-900 text-white p-6 rounded-[2.5rem] shadow-2xl border border-white/10 min-w-[350px]">
            <div id="notifIcon" class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/40"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></div>
            <p id="notifText" class="font-black text-xs uppercase tracking-widest italic">Dokumen Berhasil Terkirim!</p>
        </div>
    </div>
</div>

<script>
let recommendations = [
    { id: 1, name: 'Siti Aminah', initial: 'SA', company: 'PT. Teknologi Maju Persada', status: 'Menunggu TTD' },
    { id: 2, name: 'Andi Saputra', initial: 'AS', company: 'Bank Nasional Nusantara', status: 'Menunggu TTD' },
    { id: 3, name: 'Budi Ramadhan', initial: 'BR', company: 'Pertamina IT Division', status: 'Menunggu TTD' },
    { id: 4, name: 'Dewi Lestari', initial: 'DL', company: 'Shopee Indonesia', status: 'Menunggu TTD' }
];

let filteredRecommendations = [...recommendations];
let currentStudentId = null;

function renderRecommendations() {
    const container = document.getElementById('recommendationList');
    container.innerHTML = '';
    
    if (filteredRecommendations.length === 0) {
        container.innerHTML = `
            <div class="bg-white p-12 rounded-[2rem] border border-base-200 text-center">
                <p class="text-gray-400 font-black uppercase text-xs tracking-widest italic">Mahasiswa tidak ditemukan</p>
            </div>
        `;
        return;
    }

    filteredRecommendations.forEach(item => {
        const isSigned = item.status === 'SUDAH DI TTD';
        // Color palette for avatars
        const colors = [
            'bg-purple-100 text-[#6B21A8]',
            'bg-orange-100 text-[#F49E0A]',
            'bg-blue-100 text-blue-600',
            'bg-green-100 text-green-600',
            'bg-pink-100 text-pink-600'
        ];
        const avatarStyle = isSigned ? 'bg-green-500 text-white' : colors[item.id % colors.length];

        container.innerHTML += `
            <div class="bg-white hover:bg-gray-50/50 border border-base-200 rounded-[2rem] p-6 transition-all group shadow-sm grid grid-cols-12 gap-4 items-center">
                <div class="col-span-4 flex items-center gap-5">
                    <div class="w-14 h-14 rounded-2xl ${avatarStyle} flex items-center justify-center font-black text-sm group-hover:rotate-6 transition-all duration-500">${item.initial}</div>
                    <div class="overflow-hidden">
                        <h4 class="font-bold text-gray-900 text-lg leading-tight truncate tracking-tight">${item.name}</h4>
                        <p class="text-[11px] text-primary font-semibold tracking-wide mt-1 truncate opacity-70">${item.company}</p>
                    </div>
                </div>
                
                <div class="col-span-2 flex justify-center">
                    <div class="badge ${isSigned ? 'bg-green-50 text-green-600 border-green-100' : 'bg-orange-50 text-secondary border-orange-100'} font-black text-[9px] px-5 py-4 uppercase tracking-[0.2em] rounded-xl italic border-2">
                        ${item.status}
                    </div>
                </div>

                <div class="col-span-3 flex items-center">
                    <button onclick="downloadDraft('${item.name}')" class="group/dl flex items-center gap-4 px-6 py-4 bg-red-50 text-red-600 rounded-[1.5rem] border border-red-100 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover/dl:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] italic">Download PDF</span>
                    </button>
                </div>

                <div class="col-span-3 flex justify-end items-center">
                    ${isSigned ? `
                        <button class="btn btn-sm btn-ghost text-green-600 font-black uppercase text-[10px] cursor-default pointer-events-none gap-2">
                            <div class="w-8 h-8 bg-green-100 text-green-600 rounded-xl flex items-center justify-center shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            </div>
                            <span class="italic">Selesai</span>
                        </button>
                    ` : `
                        <button onclick="openUploadModal(${item.id})" class="btn h-14 min-h-0 bg-[#6B21A8] hover:bg-purple-800 text-white border-none rounded-[1.5rem] px-10 font-black uppercase tracking-[0.2em] text-[10px] shadow-xl shadow-purple-900/20 transition-all hover:scale-105 active:scale-95 group">
                            <span>Upload TTD</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 group-hover:translate-y-[-2px] transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9m-4-2v6m-4-6l4-4 4 4" /></svg>
                        </button>
                    `}
                </div>
            </div>
        `;
    });
}

// Search Logic
const searchInput = document.querySelector('input[placeholder="Cari Mahasiswa..."]');
if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const val = e.target.value.toLowerCase();
        filteredRecommendations = recommendations.filter(r => 
            r.name.toLowerCase().includes(val) || 
            r.company.toLowerCase().includes(val)
        );
        renderRecommendations();
    });
}

function openUploadModal(id) {
    currentStudentId = id;
    document.getElementById('upload_ttd_modal').showModal();
}

function downloadDraft(name) {
    showNotif("Downloading Draft: " + name + "...", "bg-gray-900", "bg-red-500");
    setTimeout(() => {
        console.log("Downloading PDF for " + name);
    }, 2000);
}

function updateUploadName(input) {
    const fileNameDisplay = document.getElementById('fileName');
    if (input.files && input.files.length > 0) {
        fileNameDisplay.innerHTML = "SIAP: <span class='text-primary underline font-black'>" + input.files[0].name + "</span>";
    }
}

function handleTTDUpload() {
    const input = document.getElementById('ttdInput');
    if (!input.files || input.files.length === 0) {
        alert('Pilih file PDF yang sudah di TTD!');
        return;
    }

    // Update status logic
    const index = recommendations.findIndex(r => r.id === currentStudentId);
    if (index !== -1) {
        recommendations[index].status = 'SUDAH DI TTD';
        filteredRecommendations = [...recommendations]; // Reset filter after update or keep it? Let's reset for simplicity
        renderRecommendations();
    }

    document.getElementById('upload_ttd_modal').close();
    showNotif("Dokumen Berhasil Terkirim!", "bg-gray-900", "bg-green-500");
    
    // Clear input
    input.value = '';
    document.getElementById('fileName').innerText = 'Bubuhkan File PDF Yang Telah Di TTD';
}

function showNotif(text, bgClass, iconBgClass) {
    const container = document.getElementById('successNotif');
    const notifText = document.getElementById('notifText');
    const notifIcon = document.getElementById('notifIcon');
    
    notifText.innerText = text;
    // We could swap classes here if needed, but the current UI uses fixed colors for success.
    // For "Downloading", we keep it neutral or specific.
    
    container.classList.remove('hidden');
    setTimeout(() => container.classList.add('hidden'), 3500);
}

// Initial render
renderRecommendations();
</script>
@endsection
