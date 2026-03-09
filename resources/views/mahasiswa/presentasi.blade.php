@extends('layouts.app')

@section('title', 'Upload Presentasi')

@section('header')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-[#6B21A8] p-6 rounded-2xl shadow-lg mt-2">
    <div>
        <h2 class="text-2xl font-bold text-white">
            Upload Presentasi 📹
        </h2>
        <p class="text-white/80 mt-1 text-sm md:text-base">Upload video presentasi magang Anda.</p>
    </div>
</div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card bg-white shadow-sm border border-base-200 overflow-hidden">
        <div class="card-body p-8">
            <h3 class="font-bold text-lg text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" /></svg>
                Upload Video Presentasi
            </h3>
            
            <form action="#" class="space-y-6">
                <div class="form-control">
                    <label class="label"><span class="label-text font-bold text-gray-700">File Video</span></label>
                    <div class="border-2 border-dashed border-gray-200 rounded-3xl p-12 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100/80 hover:border-primary/40 transition-all cursor-pointer group">
                        <div class="p-4 bg-purple-50 rounded-full group-hover:scale-110 transition-transform mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                        </div>
                        <p class="text-sm font-bold text-gray-700">Pilih file video presentasi</p>
                        <p class="text-xs text-gray-400 mt-2 font-medium">Format yang didukung: MP4, MOV (Max. 100MB)</p>
                        <input type="file" class="hidden" />
                    </div>
                </div>

                <div class="bg-[#F49E0A]/5 p-5 rounded-2xl border border-[#F49E0A]/20 flex items-start gap-3">
                    <div class="p-1 bg-[#F49E0A]/10 text-[#F49E0A] rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-[#F49E0A] mb-1">Ketentuan Presentasi</h4>
                        <p class="text-xs text-gray-600 leading-relaxed italic">
                            Video presentasi harus mencakup poin-poin utama kegiatan magang, pencapaian, serta demo pekerjaan yang telah dilakukan. Durasi maksimal 10 menit.
                        </p>
                    </div>
                </div>

                <button type="submit" class="btn bg-[#F49E0A] hover:bg-orange-500 text-white border-none w-full h-12 shadow-lg shadow-orange-100 font-bold tracking-wide">SUBMIT PRESENTASI</button>
            </form>
        </div>
    </div>
</div>
@endsection
