@extends('layouts.app')

@section('title', 'Monitoring Magang')

@section('content')
<div class="px-4 lg:px-6 py-6 space-y-6 overflow-x-hidden">

    <!-- HERO BANNER -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-[#6B21A8] to-[#7E22CE] p-6 md:p-8 shadow-xl">

        <!-- Blur Decoration -->
        <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <!-- Left Content -->
            <div class="max-w-2xl">

                <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 px-4 py-2 rounded-full mb-4">
                    <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div>

                    <span class="text-xs uppercase tracking-[0.2em] font-bold text-white">
                        Monitoring System
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-black italic leading-tight text-white">
                    Monitoring Mahasiswa
                </h1>

                <p class="mt-3 text-sm md:text-base text-white/80 max-w-xl">
                    Pantau aktivitas magang mahasiswa secara realtime dengan sistem monitoring SIDUL.
                </p>

            </div>

            <!-- Right Counter -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-3xl px-8 py-6 text-center min-w-[180px]">

                <p class="text-xs uppercase tracking-[0.3em] text-white/60 font-bold mb-2">
                    Total Aktif
                </p>

                <h2 class="text-5xl font-black italic text-white">
                    {{ $mhsBimbingan->count() }}
                </h2>

            </div>

        </div>
    </div>

    <!-- SEARCH SECTION -->
    <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">

        <div class="flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

            <!-- Search -->
            <div class="relative w-full lg:max-w-2xl">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>

                <input
                    id="searchInput"
                    onkeyup="filterGrid()"
                    type="text"
                    placeholder="Cari mahasiswa atau instansi..."
                    class="w-full h-14 pl-14 pr-5 rounded-2xl border border-gray-200 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-purple-100 focus:border-[#6B21A8] outline-none transition">

            </div>



        </div>
    </div>

    <!-- GRID MAHASISWA -->
    <div id="studentGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Render by JavaScript -->
    </div>

    <!-- EMPTY STATE -->
    <div id="emptyState"
        class="hidden py-24 text-center bg-white rounded-3xl border border-dashed border-gray-200 shadow-sm">

        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-5">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-10 w-10 text-gray-300"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>

        </div>

        <h4 class="text-lg font-bold text-gray-500">
            Tidak Ada Hasil
        </h4>

        <p class="text-sm text-gray-400 mt-2">
            Gunakan kata kunci pencarian yang lain.
        </p>

    </div>

    <!-- PAGINATION -->
    <div id="paginationContainer"
        class="flex flex-col md:flex-row items-center justify-between gap-5 pt-4">

        <p id="paginationInfo"
            class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
        </p>

        <div class="join rounded-2xl overflow-hidden shadow-sm"
            id="paginationBtns">
        </div>

    </div>

</div>

@push('scripts')
<script>
// Data Mahasiswa dari Controller
const students = {!! json_encode($mhsBimbingan->map(function($magang) {

    $mhs = $magang->peserta->first()
        ? $magang->peserta->first()->mahasiswa
        : null;

    $logCount = $magang->logbooks_count ?? 0;
    $laporan = $magang->laporan;

    // Milestone logic consistent with Mahasiswa Dashboard
    $progress = 0;
    if($magang) $progress += 20; // Registered: 20%
    if($logCount > 0) $progress += 40; // Has logbooks: 40% (Total 60%)
    
    if($laporan) {
        if($laporan->status === 'approved') {
            $progress += 40; // Approved: +40% (Total 100%)
        } else {
            $progress += 10; // Uploaded: +10% (Total 70%)
        }
    }
    
    // Override if status is explicitly 'Selesai'
    if($magang->status_magang === 'Selesai') $progress = 100;

    return [
        'name' => $mhs ? $mhs->nama : 'N/A',
        'nim' => $mhs ? $mhs->nim : 'N/A',
        'kode' => $magang->kode_magang ?? 'PENDING',
        'instansi' => $magang->perusahaan ?? 'Belum Menentukan Instansi',
        'status' => $magang->status_magang,
        'progress' => $progress,
        'logs' => $logCount,
        'prodi' => $magang->konsentrasi ?? 'Teknik Informatika'
    ];

})->toArray()) !!};

let currentPage = 1;
const itemsPerPage = 6;
let filteredStudents = [...students];

function renderGrid() {

    const grid = document.getElementById('studentGrid');
    const empty = document.getElementById('emptyState');
    const pagination = document.getElementById('paginationContainer');

    const start = (currentPage - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    const items = filteredStudents.slice(start, end);

    grid.innerHTML = '';

    if (filteredStudents.length === 0) {

        empty.classList.remove('hidden');
        grid.classList.add('hidden');
        pagination.classList.add('hidden');

    } else {

        empty.classList.add('hidden');
        grid.classList.remove('hidden');
        pagination.classList.remove('hidden');
    }

    items.forEach((s, i) => {

        const colors = [
            'bg-purple-100 text-[#6B21A8]',
            'bg-blue-100 text-blue-600',
            'bg-emerald-100 text-emerald-600',
            'bg-orange-100 text-orange-600'
        ];

        const avatarStyle = colors[i % colors.length];

        const badgeColor =
            s.status === 'Selesai'
                ? 'bg-blue-50 text-blue-600'
                : (['Aktif', 'berjalan'].includes(s.status)
                    ? 'bg-emerald-50 text-emerald-600'
                    : 'bg-orange-50 text-orange-600');

        const card = `
            <div class="group bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 p-7 flex flex-col justify-between min-h-[360px] relative overflow-hidden">

                <div class="absolute -right-10 -top-10 w-40 h-40 bg-gray-50 rounded-full opacity-60"></div>

                <div class="relative z-10">

                    <div class="flex items-start justify-between mb-6">

                        <div class="w-14 h-14 rounded-2xl ${avatarStyle} flex items-center justify-center font-black text-xl">
                            ${s.name[0]}
                        </div>

                        <div class="text-right">

                            <span class="text-[10px] uppercase font-bold tracking-wider ${badgeColor} px-3 py-1 rounded-xl inline-block mb-2">
                                ${s.status}
                            </span>

                            <p class="text-[10px] text-gray-400 font-semibold uppercase">
                                ${s.kode}
                            </p>

                        </div>

                    </div>

                    <h3 class="text-2xl font-black text-gray-800 leading-tight mb-1">
                        ${s.name}
                    </h3>

                    <p class="text-xs text-gray-400 uppercase tracking-widest mb-8">
                        ${s.nim} • ${s.prodi}
                    </p>

                    <div class="space-y-5">

                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">
                                Instansi Magang
                            </p>

                            <p class="font-semibold text-gray-700 line-clamp-1">
                                ${s.instansi}
                            </p>
                        </div>

                        <div>

                            <div class="flex items-center justify-between mb-2">

                                <p class="text-[10px] text-gray-400 uppercase tracking-wider">
                                    Progress
                                </p>

                                <p class="text-sm font-bold text-[#6B21A8]">
                                    ${s.progress}%
                                </p>

                            </div>

                            <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">

                                <div class="h-full bg-gradient-to-r from-[#6B21A8] to-[#9333EA] rounded-full"
                                    style="width:${s.progress}%">
                                </div>

                            </div>

                            <p class="text-[10px] text-gray-400 mt-2 text-right">
                                ${s.logs} / 30 Hari
                            </p>

                        </div>

                    </div>

                </div>

                <div class="pt-7 relative z-10">

                    <a href="{{ route('dosen.logbook') }}"
                        class="block w-full text-center bg-gray-100 hover:bg-[#6B21A8] hover:text-white text-[#6B21A8] rounded-2xl py-4 text-xs font-bold uppercase tracking-[0.2em] transition-all">

                        Buka Logbook →

                    </a>

                </div>

            </div>
        `;

        grid.innerHTML += card;

    });

    updatePagination();
}

function filterGrid() {

    const q = document.getElementById('searchInput')
        .value
        .toLowerCase();

    filteredStudents = students.filter(s =>
        s.name.toLowerCase().includes(q) ||
        s.nim.includes(q) ||
        s.kode.toLowerCase().includes(q) ||
        s.instansi.toLowerCase().includes(q)
    );

    currentPage = 1;

    renderGrid();
}

function updatePagination() {

    const total = filteredStudents.length;

    const pages = Math.ceil(total / itemsPerPage) || 1;

    const start = total === 0
        ? 0
        : (currentPage - 1) * itemsPerPage + 1;

    const end = Math.min(currentPage * itemsPerPage, total);

    document.getElementById('paginationInfo').innerText =
        `Menampilkan ${start}-${end} dari ${total} Mahasiswa`;

    const container = document.getElementById('paginationBtns');

    container.innerHTML = '';

    if (pages > 1) {

        for (let i = 1; i <= pages; i++) {

            const btn = document.createElement('button');

            btn.className =
                `px-5 h-11 text-sm font-bold transition ${
                    currentPage === i
                    ? 'bg-[#6B21A8] text-white'
                    : 'bg-white text-gray-500 hover:bg-gray-100'
                }`;

            btn.innerText = i;

            btn.onclick = () => {

                currentPage = i;

                renderGrid();

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };

            container.appendChild(btn);
        }
    }
}

// Initial Render
renderGrid();
</script>
@endpush
@endsection