@extends('layouts.app')

@section('title', 'Rekomendasi Magang')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-xl font-bold text-white">
            Rekomendasi Magang
        </h2>
        <p class="text-white/80 mt-1 text-sm">Berikan persetujuan lokasi atau rekomendasikan instansi yang sesuai.</p>
    </div>
</div>
@endsection

@section('content')
<div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    <!-- Card Rekomendasi Menunggu -->
    <div class="card bg-white shadow-sm border border-gray-200">
        <div class="card-body p-5">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                        <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold" style="background-color: #F49E0A;">
                            AF
                        </div>
                    </div>
                    <div>
                        <div class="font-bold text-[#6B21A8]">Ahmad Fauzi</div>
                        <div class="text-xs text-gray-500">210103001</div>
                    </div>
                </div>
                <span class="badge" style="background-color: #fef3c7; border:none; color: #F49E0A;">Menunggu</span>
            </div>
            
            <div class="bg-gray-50 p-3 rounded-lg mb-4 text-sm">
                <p class="text-gray-500 mb-1">Usulan Instansi:</p>
                <p class="font-semibold text-gray-800">PT. Teknologi Cerdas</p>
                <p class="text-xs text-gray-500 mt-1 truncate">Posisi: Backend Developer</p>
            </div>

            <div class="flex gap-2 w-full mt-auto">
                <button class="btn btn-sm flex-1 bg-white border-gray-300 text-gray-700 hover:bg-gray-50">Tolak/Ubah</button>
                <button class="btn btn-sm flex-1 border-none text-white hover:bg-opacity-90" style="background-color: #6B21A8;">Setujui</button>
            </div>
        </div>
    </div>
    
    <!-- Card Rekomendasi Disetujui -->
    <div class="card bg-white shadow-sm border border-gray-200">
        <div class="card-body p-5 opacity-75">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                        <div class="w-10 h-10 rounded-full text-white flex items-center justify-center font-bold" style="background-color: #6B21A8;">
                            SA
                        </div>
                    </div>
                    <div>
                        <div class="font-bold text-[#6B21A8]">Siti Aminah</div>
                        <div class="text-xs text-gray-500">210103002</div>
                    </div>
                </div>
                <span class="badge bg-green-100 text-green-700 border-none">Disetujui</span>
            </div>
            
            <div class="bg-gray-50 p-3 rounded-lg mb-4 text-sm">
                <p class="text-gray-500 mb-1">Usulan Instansi:</p>
                <p class="font-semibold text-gray-800">Bank Nasional Nusantara</p>
                <p class="text-xs text-gray-500 mt-1 truncate">Posisi: Data Analyst</p>
            </div>

            <button class="btn btn-sm w-full btn-outline border-gray-300 text-gray-500" disabled>Telah Disetujui</button>
        </div>
    </div>
</div>
@endsection
