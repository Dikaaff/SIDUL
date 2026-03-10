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
<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main List Section -->
    <div class="lg:col-span-3 space-y-4">
        <div class="flex items-center justify-between bg-white p-6 rounded-[2rem] border border-base-200 shadow-sm mb-2">
            <div>
                <h3 class="font-black text-gray-800 flex items-center gap-3 italic">
                    Antrean Rekomendasi
                </h3>
            </div>
            <div class="flex gap-2">
                <input class="input input-sm bg-gray-50 border-none rounded-xl text-xs font-bold w-48 focus:ring-2 focus:ring-purple-100" placeholder="Cari Mahasiswa..." />
            </div>
        </div>

        <!-- Responsive Container for the list -->
        <div class="overflow-x-auto pb-4 -mx-4 px-4 lg:mx-0 lg:px-0">
            <div class="min-w-[700px]">
                <!-- Compact List Header -->
                <div class="px-8 grid grid-cols-12 gap-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] italic mb-2">
                    <div class="col-span-4">Mahasiswa & Instansi</div>
                    <div class="col-span-3">Dokumen Draft</div>
                    <div class="col-span-5 text-right">Tindakan</div>
                </div>

                <div class="space-y-3">
                    <!-- Item 1 -->
                    <div class="bg-white hover:bg-gray-50/50 border border-base-200 rounded-[1.5rem] p-4 pl-6 transition-all group shadow-sm flex items-center grid grid-cols-12 gap-4">
                        <div class="col-span-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-[#6B21A8] text-white flex items-center justify-center font-black text-xs shadow-lg group-hover:rotate-3 transition-transform">SA</div>
                            <div>
                                <h4 class="font-black text-gray-800 text-sm italic leading-tight">Siti Aminah</h4>
                                <p class="text-[9px] text-[#6B21A8] font-bold uppercase tracking-widest mt-0.5 truncate max-w-[150px]">PT. Teknologi Maju Persada</p>
                            </div>
                        </div>
                        
                        <div class="col-span-3 flex items-center">
                            <button onclick="downloadDraft('Siti Aminah')" class="group/dl flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl border border-red-100 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">Download PDF</span>
                            </button>
                        </div>

                        <div class="col-span-5 flex justify-end items-center gap-3">
                            <div class="badge bg-orange-50 text-orange-600 border-none font-black text-[8px] px-3 py-3 uppercase tracking-widest rounded-lg italic">Menunggu TTD</div>
                            <button onclick="document.getElementById('upload_ttd_modal').showModal()" class="btn btn-sm bg-[#6B21A8] hover:bg-purple-700 text-white border-none rounded-xl px-6 font-black uppercase tracking-widest text-[9px] h-10 min-h-0 shadow-lg shadow-purple-100/50">
                                Upload TTD
                            </button>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-white hover:bg-gray-50/50 border border-base-200 rounded-[1.5rem] p-4 pl-6 transition-all group shadow-sm flex items-center grid grid-cols-12 gap-4">
                        <div class="col-span-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-[#F49E0A] text-white flex items-center justify-center font-black text-xs shadow-lg group-hover:rotate-3 transition-transform">AS</div>
                            <div>
                                <h4 class="font-black text-gray-800 text-sm italic leading-tight">Andi Saputra</h4>
                                <p class="text-[9px] text-[#6B21A8] font-bold uppercase tracking-widest mt-0.5 truncate max-w-[150px]">Bank Nasional Nusantara</p>
                            </div>
                        </div>
                        
                        <div class="col-span-3 flex items-center">
                            <button onclick="downloadDraft('Andi Saputra')" class="group/dl flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-xl border border-red-100 hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                <span class="text-[9px] font-black uppercase tracking-widest">Download PDF</span>
                            </button>
                        </div>

                        <div class="col-span-5 flex justify-end items-center gap-3">
                            <div class="badge bg-orange-50 text-orange-600 border-none font-black text-[8px] px-3 py-3 uppercase tracking-widest rounded-lg italic">Menunggu TTD</div>
                            <button onclick="document.getElementById('upload_ttd_modal').showModal()" class="btn btn-sm bg-[#6B21A8] hover:bg-purple-700 text-white border-none rounded-xl px-6 font-black uppercase tracking-widest text-[9px] h-10 min-h-0 shadow-lg shadow-purple-100/50">
                                Upload TTD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Minimal Side Info -->
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-[#6B21A8] p-8 rounded-[2rem] text-white shadow-xl italic relative overflow-hidden group">
            <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-white/10 rounded-full group-hover:scale-150 transition-transform duration-1000"></div>
            <h4 class="font-black text-xs uppercase tracking-[0.2em] mb-4 italic opacity-80">Panduan Cepat</h4>
            <div class="space-y-4">
                <div class="flex gap-3">
                    <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center text-[10px] font-black italic shadow-inner">1</div>
                    <p class="text-[10px] font-bold leading-relaxed">Download PDF dari mahasiswa.</p>
                </div>
                <div class="flex gap-3">
                    <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center text-[10px] font-black italic shadow-inner">2</div>
                    <p class="text-[10px] font-bold leading-relaxed">Bubuhkan tanda tangan digital Anda.</p>
                </div>
                <div class="flex gap-3">
                    <div class="w-6 h-6 rounded-lg bg-white/20 flex items-center justify-center text-[10px] font-black italic shadow-inner">3</div>
                    <p class="text-[10px] font-bold leading-relaxed">Upload kembali file yang sudah di TTD.</p>
                </div>
            </div>
        </div>

        <div class="bg-orange-50 p-6 rounded-[2rem] border border-orange-100 shadow-inner">
            <p class="text-[10px] font-black text-orange-900 border-b border-orange-200 pb-2 flex items-center gap-2 mb-3 grayscale opacity-70">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                PENTING
            </p>
            <p class="text-[9px] font-bold text-orange-900/60 leading-relaxed uppercase italic">Tanda tangan harus menggunakan stempel/ttd resmi instansi universitas.</p>
        </div>
    </div>
</div>

<!-- Modal Upload TTD (Same as before but refined) -->
<dialog id="upload_ttd_modal" class="modal">
    <div class="modal-box p-0 overflow-hidden bg-white max-w-xl rounded-[2.5rem] shadow-2xl">
        <div class="bg-gray-50 border-b border-gray-100 p-8 flex items-center justify-between">
            <div>
                <h3 class="font-black text-xl text-gray-800 italic uppercase">Upload Rekomendasi TTD</h3>
            </div>
            <form method="dialog"><button class="btn btn-circle btn-ghost btn-sm text-gray-400">✕</button></form>
        </div>
        <div class="p-10 space-y-8">
            <div onclick="document.getElementById('ttdInput').click()" class="border-4 border-dashed border-gray-100 rounded-[2.5rem] p-12 flex flex-col items-center justify-center bg-gray-50/50 hover:bg-white hover:border-[#6B21A8] hover:shadow-2xl hover:shadow-purple-100/50 transition-all cursor-pointer group">
                <div class="p-4 bg-white rounded-3xl shadow-sm text-gray-300 group-hover:text-[#6B21A8] transition-all mb-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg></div>
                <p id="fileName" class="text-[10px] font-black text-gray-500 group-hover:text-[#6B21A8] uppercase tracking-widest text-center">Bubuhkan File PDF Yang Telah Di TTD</p>
                <input type="file" id="ttdInput" accept=".pdf" class="hidden" onchange="updateUploadName(this)" />
            </div>
            <textarea class="textarea bg-gray-50 border-none h-24 rounded-2xl w-full p-6 text-xs font-bold text-gray-700 focus:ring-4 focus:ring-purple-100 transition-all" placeholder="Catatan untuk mahasiswa..."></textarea>
            <button onclick="handleTTDUpload()" class="btn bg-[#6B21A8] hover:bg-purple-700 text-white border-none shadow-2xl shadow-purple-100 w-full h-14 rounded-2xl font-black uppercase tracking-widest text-[11px]">Kirim Ke Mahasiswa</button>
        </div>
    </div>
</dialog>

<!-- Notification Toast -->
<div id="notifContainer" class="fixed top-8 right-8 z-[9999]">
    <div id="successNotif" class="hidden animate-in fade-in slide-in-from-right-8 duration-300">
        <div class="flex items-center gap-5 bg-gray-900 text-white p-6 rounded-[2.5rem] shadow-2xl border border-white/10 min-w-[350px]">
            <div class="w-12 h-12 rounded-2xl bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/40"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></div>
            <p class="font-black text-xs uppercase tracking-widest italic">Dokumen Berhasil Terkirim!</p>
        </div>
    </div>
</div>

<script>
function downloadDraft(name) {
    // Logic Simulasi Download
    const successNotif = document.getElementById('successNotif');
    const toastText = successNotif.querySelector('p');
    const originalText = toastText.innerText;
    
    toastText.innerText = "Downloading Draft: " + name + "...";
    successNotif.classList.remove('hidden');
    
    setTimeout(() => {
        successNotif.classList.add('hidden');
        toastText.innerText = originalText;
        // Simulasi trigger download file asli di sini nnti
        console.log("Downloading PDF for " + name);
    }, 2000);
}

function updateUploadName(input) {
    const fileNameDisplay = document.getElementById('fileName');
    if (input.files && input.files.length > 0) {
        fileNameDisplay.innerHTML = "SIAP: <span class='text-[#6B21A8] underline'>" + input.files[0].name + "</span>";
    }
}

function handleTTDUpload() {
    const input = document.getElementById('ttdInput');
    if (!input.files || input.files.length === 0) {
        alert('Pilih file PDF yang sudah di TTD!');
        return;
    }
    document.getElementById('upload_ttd_modal').close();
    const success = document.getElementById('successNotif');
    success.classList.remove('hidden');
    setTimeout(() => success.classList.add('hidden'), 3500);
}
</script>
@endsection
