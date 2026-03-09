@extends('layouts.app')

@section('title', 'Pendaftaran Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
            Form Pendaftaran Magang
        </h2>
        <p class="text-base-content/60 mt-1">Lengkapi data di bawah ini untuk mengajukan kegiatan magang.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-4xl">
    <div class="card bg-base-100 shadow-sm border border-base-200">
        <div class="card-body p-6 lg:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-base-200">
                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                    <h3 class="card-title text-lg">Informasi Pendaftaran</h3>
                    <p class="text-sm text-base-content/60">Pastikan data yang dimasukkan sudah benar dan valid.</p>
                </div>
            </div>

            <form action="#" method="POST" class="space-y-6">
                <!-- Data Mahasiswa (Read-only or auto-filled) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text font-medium">Nama Mahasiswa</span>
                        </label>
                        <input type="text" value="User Name" class="input input-bordered w-full bg-base-200/50" readonly />
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-medium">NIM</span>
                            </label>
                            <input type="text" value="12345678" class="input input-bordered w-full bg-base-200/50" readonly />
                        </div>
                        <div class="form-control w-full">
                            <label class="label">
                                <span class="label-text font-medium">Program Studi</span>
                            </label>
                            <input type="text" value="Informatika" class="input input-bordered w-full bg-base-200/50" readonly />
                        </div>
                    </div>
                </div>

                <div class="divider">Data Instansi Magang</div>

                <!-- Formulir Instansi -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Nama Instansi Magang <span class="text-error">*</span></span>
                    </label>
                    <input type="text" placeholder="Contoh: PT. Teknologi Masa Depan" class="input input-bordered w-full focus:input-primary transition-colors" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Alamat Instansi <span class="text-error">*</span></span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24 focus:textarea-primary transition-colors" placeholder="Masukkan alamat lengkap instansi beserta kode pos..." required></textarea>
                </div>

                <div class="divider">Detail Kegiatan Magang</div>

                <!-- Formulir Kegiatan -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Judul Magang (Topik Utama) <span class="text-error">*</span></span>
                    </label>
                    <input type="text" placeholder="Contoh: Pengembangan Sistem Informasi berbasis Web" class="input input-bordered w-full focus:input-primary transition-colors" required />
                </div>

                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text font-medium">Deskripsi Kegiatan Singkat <span class="text-error">*</span></span>
                        <span class="label-text-alt text-base-content/50">Maks. 500 karakter</span>
                    </label>
                    <textarea class="textarea textarea-bordered h-32 focus:textarea-primary transition-colors" placeholder="Deskripsikan secara singkat kegiatan atau proyek yang akan dilakukan..." required></textarea>
                </div>

                <!-- Upload File Proposal -->
                <div class="form-control w-full mt-4">
                    <label class="label">
                        <span class="label-text font-medium">Upload File Proposal <span class="text-error">*</span></span>
                    </label>
                    
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-base-300 border-dashed rounded-xl cursor-pointer bg-base-200/30 hover:bg-base-200/70 hover:border-primary/50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-3 text-base-content/40" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-base-content/60"><span class="font-semibold text-primary">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-xs text-base-content/50">PDF (Max. 5MB)</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" accept=".pdf" required />
                        </label>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3 pt-6 border-t border-base-200">
                    <button type="button" class="btn btn-ghost">Batal</button>
                    <button type="submit" class="btn btn-primary px-8 shadow-lg shadow-primary/30">
                        Kirim Pendaftaran
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
