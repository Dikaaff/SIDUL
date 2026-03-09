@extends('layouts.app')

@section('title', 'Bimbingan Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
            Bimbingan Magang
        </h2>
        <p class="text-base-content/60 mt-1">Diskusikan progres magang dan upload dokumen revisi kepada dosen pembimbing.</p>
    </div>
    <div class="flex gap-2">
        <div class="badge badge-lg bg-base-100 shadow-sm border-base-200 py-3 px-4 flex gap-2">
            <div class="avatar placeholder">
                <div class="bg-primary/20 text-primary rounded-full w-6">
                    <span class="text-xs font-bold">DS</span>
                </div>
            </div>
            <span class="font-medium text-sm">Dr. Budi Santoso</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-12rem)] min-h-[600px]">
    <!-- List Bimbingan (Sidebar Area in Page) -->
    <div class="card bg-base-100 shadow-sm border border-base-200 h-full flex flex-col">
        <div class="p-4 border-b border-base-200 flex justify-between items-center bg-base-100 lg:rounded-t-2xl z-10 sticky top-0">
            <h3 class="font-semibold">Riwayat Bimbingan</h3>
            <button class="btn btn-sm btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
            </button>
        </div>
        
        <div class="flex-1 overflow-y-auto p-2 space-y-1">
            <!-- Active Item -->
            <a href="#" class="flex flex-col p-3 rounded-xl bg-primary/10 border border-primary/20 transition-all">
                <div class="flex justify-between items-start mb-1">
                    <span class="font-semibold text-sm text-primary">Revisi Bab 3</span>
                    <span class="text-[10px] text-base-content/50">Hari ini, 10:45</span>
                </div>
                <p class="text-xs text-base-content/70 line-clamp-2">Perbaikan metodologi dan penambahan referensi jurnal tahun 2023 sesuai arahan.</p>
                <div class="mt-2 flex items-center justify-between">
                    <div class="badge badge-warning badge-sm text-[10px]">Revision</div>
                    <div class="flex items-center gap-1 text-[10px] text-primary font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        1 File
                    </div>
                </div>
            </a>
            
            <!-- Item -->
            <a href="#" class="flex flex-col p-3 rounded-xl hover:bg-base-200/50 border border-transparent transition-all opacity-70">
                <div class="flex justify-between items-start mb-1">
                    <span class="font-semibold text-sm">Bimbingan Bab 2</span>
                    <span class="text-[10px] text-base-content/50">12 Mar 2026</span>
                </div>
                <p class="text-xs text-base-content/70 line-clamp-2">Kajian pustaka dan landasan teori sudah selesai disusun.</p>
                <div class="mt-2 flex items-center justify-between">
                    <div class="badge badge-success badge-sm text-[10px]">Approved</div>
                    <div class="flex items-center gap-1 text-[10px] text-base-content/60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        1 File
                    </div>
                </div>
            </a>
            
            <!-- Item -->
            <a href="#" class="flex flex-col p-3 rounded-xl hover:bg-base-200/50 border border-transparent transition-all opacity-70">
                <div class="flex justify-between items-start mb-1">
                    <span class="font-semibold text-sm">Bimbingan Bab 1</span>
                    <span class="text-[10px] text-base-content/50">05 Mar 2026</span>
                </div>
                <p class="text-xs text-base-content/70 line-clamp-2">Latar belakang masalah dan rumusan masalah.</p>
                <div class="mt-2 flex items-center justify-between">
                    <div class="badge badge-success badge-sm text-[10px]">Approved</div>
                    <div class="flex items-center gap-1 text-[10px] text-base-content/60">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        2 Files
                    </div>
                </div>
            </a>
        </div>
        
        <div class="p-4 border-t border-base-200">
            <button class="btn btn-primary btn-block rounded-xl shadow-lg shadow-primary/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Bimbingan Baru
            </button>
        </div>
    </div>

    <!-- Chat / Detail Area -->
    <div class="lg:col-span-2 card bg-base-100 shadow-sm border border-base-200 h-full flex flex-col">
        <!-- Chat Header -->
        <div class="p-4 border-b border-base-200 flex justify-between items-center bg-base-100 lg:rounded-t-2xl z-10 sticky top-0">
            <div>
                <h3 class="font-bold text-lg">Revisi Bab 3</h3>
                <p class="text-xs text-base-content/60">Topik bimbingan saat ini</p>
            </div>
            <div class="badge badge-warning">Status: Revision</div>
        </div>

        <!-- Chat Messages (Scrollable) -->
        <div class="flex-1 overflow-y-auto p-4 md:p-6 space-y-6 bg-base-200/20">
            <!-- Dosen Message -->
            <div class="chat chat-start">
                <div class="chat-image avatar">
                    <div class="w-10 rounded-full border border-base-200">
                        <img alt="Dosen" src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" />
                    </div>
                </div>
                <div class="chat-header text-xs opacity-70 mb-1 ml-1">
                    Dr. Budi Santoso
                    <time class="ml-1 text-[10px]">10:45</time>
                </div>
                <div class="chat-bubble bg-base-100 text-base-content shadow-sm border border-base-200">
                    <p class="text-sm">Halo, untuk Bab 3 metode penelitiannya masih kurang tajam. Tolong tambahkan perbandingan dengan 2 jurnal terbaru (2023 ke atas).</p>
                    
                    <div class="mt-3 p-3 bg-base-200 rounded-xl flex items-center justify-between border border-base-300">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-error/10 text-error flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold leading-tight">Laporan_Bab3_Final(1).pdf</p>
                                <p class="text-[10px] text-base-content/50">Diberi catatan pada halaman 12</p>
                            </div>
                        </div>
                        <button class="btn btn-xs btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-0.5 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="divider text-xs text-base-content/40 my-2">Hari Ini</div>

            <!-- Mahasiswa Message -->
            <div class="chat chat-end">
                <div class="chat-image avatar">
                    <div class="w-10 rounded-full border border-primary/20">
                        <img alt="Mahasiswa" src="https://ui-avatars.com/api/?name=User+Name&background=6B21A8&color=fff" />
                    </div>
                </div>
                <div class="chat-header text-xs opacity-70 mb-1 mr-1">
                    Anda
                    <time class="ml-1 text-[10px]">14:20</time>
                </div>
                <div class="chat-bubble bg-primary text-primary-content shadow-sm shadow-primary/20">
                    <p class="text-sm">Baik Pak Budi, saya sudah merevisi Bab 3 dan menambahkan referensi jurnal sesuai arahan Bapak di halaman 14. Mohon arahannya kembali.</p>
                </div>
                <div class="chat-footer opacity-50 text-[10px] mt-1 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Terkirim
                </div>
            </div>

            <div class="chat chat-end">
                 <div class="chat-bubble bg-base-100 text-base-content shadow-sm border border-base-200">
                    <div class="p-1 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-error/10 text-error flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <p class="text-xs font-semibold leading-tight flex items-center gap-1">
                                    Revisi_Bab3_V2.pdf
                                    <span class="badge badge-xs badge-success text-[8px] px-1">NEW</span>
                                </p>
                                <p class="text-[10px] text-base-content/50">1.2 MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <div class="p-3 border-t border-base-200 bg-base-100 lg:rounded-b-2xl z-10 mt-auto">
            <!-- Active upload preview area -->
            <div class="mb-2 hidden">
                <div class="badge badge-accent badge-outline gap-2 py-3 px-3 shadow-sm rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    <span class="text-xs">Document_Revisi_Final.pdf</span>
                    <button class="btn btn-xs btn-ghost btn-circle text-base-content/50 hover:text-error ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
            
            <div class="flex items-end gap-2 bg-base-200/50 p-1 md:p-2 rounded-2xl border border-base-200 focus-within:border-primary/50 focus-within:bg-base-100 transition-colors">
                <button class="btn btn-circle btn-ghost text-base-content/50 hover:text-secondary hover:bg-secondary/10 shrink-0 mb-0.5">
                    <label class="cursor-pointer flex items-center justify-center w-full h-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                        <input type="file" class="hidden" accept=".pdf" />
                    </label>
                </button>
                <textarea class="textarea w-full bg-transparent border-0 focus:outline-none focus:ring-0 resize-none min-h-[44px] h-[44px] py-3 text-sm" placeholder="Tulis catatan bimbingan Anda..."></textarea>
                <button class="btn btn-circle btn-primary shadow-lg shadow-primary/30 shrink-0 mb-0.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 translate-x-[-1px] translate-y-[1px]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
