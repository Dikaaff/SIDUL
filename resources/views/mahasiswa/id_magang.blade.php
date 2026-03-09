@extends('layouts.app')

@section('title', 'Pengajuan ID Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Pengajuan ID Magang 🆔
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Ajukan data perusahaan dan form pra-survey untuk mendapatkan ID Magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Section -->
    <div class="lg:col-span-2">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body">
                <h3 class="font-bold text-lg text-gray-800 mb-6 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    Form Data Perusahaan
                </h3>
                
                <form action="#" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-gray-700">Nama Perusahaan</span></label>
                            <input type="text" placeholder="e.g. PT. Teknologi Maju" class="input input-bordered w-full bg-white text-black" />
                        </div>
                        <div class="form-control">
                            <label class="label"><span class="label-text font-bold text-gray-700">Bidang Usaha</span></label>
                            <input type="text" placeholder="e.g. Software Development" class="input input-bordered w-full bg-white text-black" />
                        </div>
                    </div>
                    
                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold text-gray-700">Alamat Perusahaan</span></label>
                        <textarea placeholder="Alamat lengkap perusahaan..." class="textarea textarea-bordered h-24 bg-white text-black"></textarea>
                    </div>

                    <div class="divider">Pra-Survey Perusahaan</div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-bold text-gray-700">Upload Form Pra-Survey</span></label>
                        <input type="file" class="file-input file-input-bordered w-full bg-white text-black" />
                        <label class="label">
                            <span class="label-text-alt text-gray-500 italic">Pastikan data pra-survey sudah lengkap.</span>
                        </label>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none px-8 shadow-lg shadow-orange-100">Submit Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Status Section -->
    <div class="space-y-6">
        <div class="card bg-white shadow-sm border border-base-200">
            <div class="card-body">
                <h3 class="font-bold text-gray-800 mb-4">Status Pengajuan</h3>
                <div class="flex flex-col items-center text-center py-6">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002-2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <div class="text-xl font-bold text-gray-400">ID MAGANG</div>
                    <div class="badge badge-outline mt-2 text-gray-400">Belum Ada</div>
                    <p class="text-xs text-gray-500 mt-4 px-4">ID Magang akan muncul di sini setelah pengajuan di-ACC oleh Operator/Prodi.</p>
                </div>
            </div>
        </div>

        <div class="card bg-blue-50 border border-blue-100">
            <div class="card-body p-5">
                <h4 class="font-bold text-blue-800 flex items-center gap-2 mb-2 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Informasi
                </h4>
                <ul class="text-xs text-blue-700 space-y-2 list-disc pl-4 italic">
                    <li>Gunakan form survey resmi dari fakultas.</li>
                    <li>Proses verifikasi membutuhkan waktu 1-3 hari kerja.</li>
                    <li>Anda akan mendapatkan notifikasi jika ID sudah diterbitkan.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
