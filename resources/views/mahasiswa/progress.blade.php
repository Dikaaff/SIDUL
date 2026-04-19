@extends('layouts.app')

@section('title', 'Progress Magang')

@section('header')
<div class="bg-white border border-gray-100 p-6 md:p-8 rounded-[2rem] shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4 relative overflow-hidden">
    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-blue-50 rounded-full blur-2xl"></div>
    <div class="relative z-10">
        <h2 class="text-2xl md:text-3xl font-black text-gray-800 mb-1">
            Progress Magang 🚀
        </h2>
        <p class="text-gray-500 font-medium text-sm">Lacak setiap tahapan perjalanan magangmu secara real-time.</p>
    </div>
    
    <div class="relative z-10 bg-green-50 text-green-600 px-4 py-2 rounded-xl text-xs font-bold border border-green-200 self-start md:self-center flex items-center gap-2">
        <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
        MAGANG AKTIF
    </div>
</div>
@endsection

@section('breadcrumbs')
<div class="text-sm breadcrumbs text-gray-400 font-bold italic px-2">
  <ul>
    <li><a href="/dashboard" class="hover:text-primary transition-colors">Dashboard</a></li> 
    <li>Progress</li>
  </ul>
</div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto space-y-6 md:space-y-8">

    <!-- Timeline Wrapper -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-6 md:p-8 relative">
        <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" /></svg>
        </div>

        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2 border-b border-gray-100 pb-4 mb-8">
            <span class="w-1.5 h-6 bg-[#6B21A8] rounded-full inline-block"></span>
            Linimasa Kegiatan
        </h3>

        <div id="timeline-container" class="relative">
            <!-- Steps will be injected here via JavaScript -->
            <div class="flex items-center justify-center py-20">
                <span class="loading loading-spinner loading-lg text-purple-600"></span>
            </div>
        </div>
    </div>

    <!-- Info Bantuan State -->
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left justify-between">
        <div>
            <h4 class="font-bold text-blue-900 text-sm mb-1">Ada Kendala Seputar Timeline?</h4>
            <p class="text-xs font-medium text-blue-800/80">Jika progress Anda nyangkut/terhenti pada suatu tahapan dalam waktu yang lama, hubungi Operator.</p>
        </div>
        <button class="bg-white border text-blue-600 border-blue-200 hover:bg-blue-100 rounded-xl px-5 py-2.5 font-bold text-xs shadow-sm w-full sm:w-auto">Bantuan Operator</button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Membaca data riil dari backend
        const hasPendaftaran = @json($pendaftaran ? true : false);
        const pendaftaranData = @json($pendaftaran);
        const logbooksCount = @json($logbooks->count());
        const hasLaporanAkhir = @json($laporan && $laporan->laporan_akhir_path ? true : false);
        const hasPengesahan = @json($laporan && $laporan->pengesahan_path ? true : false);

        // Determine Current Step
        let currentStep = 1;
        if (hasPendaftaran) {
            currentStep = 2; // Menunggu Verifikasi
            if (pendaftaranData && pendaftaranData.status_magang === 'Approve') {
                currentStep = 3; // Pelaksanaan
            }
        }
        if (logbooksCount > 0) currentStep = 3;
        if (hasLaporanAkhir) currentStep = 4;

        const steps = [
            { id: 1, title: 'Pendaftaran Magang', desc: 'Lengkapi biodata dan pilih instansi tujuan magang Anda.' },
            { id: 2, title: 'Verifikasi & Plotting', desc: 'Menunggu persetujuan Operator dan ploting Dosen Pembimbing.' },
            { id: 3, title: 'Pelaksanaan & Logbook', desc: 'Bekerja di instansi dan mencatat aktivitas harian di logbook.' },
            { id: 4, title: 'Submit Laporan Akhir', desc: 'Unggah laporan final dan lembar pengesahan yang sudah ditanda tangani.' }
        ];

        const container = document.getElementById('timeline-container');
        container.innerHTML = ''; // Clear loader

        steps.forEach((step, index) => {
            const isDone = currentStep > step.id;
            const isActive = currentStep === step.id;
            const isLocked = currentStep < step.id;

            let extraContent = '';
            
            // Custom content for Step 1 (Pendaftaran) when done
            if (step.id === 1 && hasPendaftaran) {
                extraContent = `
                    <div class="mt-4 flex flex-wrap gap-2">
                        <a href="${pendaftaranData.link_bukti_magang}" target="_blank" class="bg-white border border-purple-100 text-[#6B21A8] px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-purple-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                            Bukti Magang
                        </a>
                        <a href="${pendaftaranData.link_survey_perusahaan}" target="_blank" class="bg-white border border-purple-100 text-[#6B21A8] px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest flex items-center gap-2 hover:bg-purple-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            Survey Form
                        </a>
                    </div>
                `;
            }

            const stepHtml = `
                <div class="flex gap-4 md:gap-6 mb-8 relative group ${isLocked ? 'opacity-50' : ''}">
                    <div class="flex flex-col items-center">
                        <div class="w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center z-10 shrink-0 transition-all duration-500
                            ${isDone ? 'bg-green-500 text-white shadow-lg shadow-green-100' : ''}
                            ${isActive ? 'bg-[#6B21A8] text-white shadow-xl shadow-purple-200 scale-110' : ''}
                            ${isLocked ? 'bg-gray-100 text-gray-400 border-2 border-gray-200' : ''}">
                            
                            ${isDone ? `
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                            ` : isActive ? `
                                <div class="absolute inset-0 rounded-full border-4 border-purple-100 animate-ping opacity-20"></div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            ` : `
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            `}
                        </div>
                        ${index !== steps.length - 1 ? `
                            <div class="w-px h-full my-2 transition-colors duration-500 ${isDone ? 'bg-green-500' : 'bg-gray-200 border-r-2 border-dashed'}"></div>
                        ` : ''}
                    </div>

                    <div class="pb-10 pt-1 w-full animate-in fade-in slide-in-from-left-4 duration-500" style="animation-delay: ${index * 100}ms">
                        <span class="text-[10px] font-bold uppercase tracking-widest mb-1 block
                            ${isActive ? 'text-[#6B21A8] bg-purple-50 inline-block px-2 py-1 rounded-md' : 'text-gray-400'}">
                            ${isDone ? 'Selesai' : isActive ? 'Sedang Berjalan' : 'Belum Mulai'}
                        </span>
                        
                        <h4 class="text-lg font-black mb-2 ${isActive ? 'text-[#6B21A8] text-xl' : 'text-gray-800'} italic">
                            ${step.title}
                        </h4>

                        ${isActive ? `
                            <div class="bg-purple-50 p-5 rounded-2xl border border-purple-100 w-full space-y-4">
                                <p class="text-xs sm:text-sm text-purple-900/80 font-bold leading-relaxed">${step.desc}</p>
                                ${extraContent}
                                <div class="bg-white p-4 rounded-xl border border-purple-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1">Status Tahapan</p>
                                        <p class="text-xs font-black text-gray-800 italic uppercase tracking-tighter">Dalam Progress...</p>
                                    </div>
                                    <a href="/dashboard" class="px-5 py-2.5 bg-[#6B21A8] text-white hover:bg-purple-800 transition-all rounded-xl text-xs font-black uppercase tracking-widest text-center block w-full md:w-auto shadow-lg shadow-purple-900/20">Dashboard Utama</a>
                                </div>
                            </div>
                        ` : `
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 w-full">
                                <p class="text-xs ${isLocked ? 'text-gray-400' : 'text-gray-500'} font-bold leading-relaxed">${step.desc}</p>
                                ${extraContent}
                            </div>
                        `}
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', stepHtml);
        });
    });
</script>

@endsection
