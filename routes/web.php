<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/', function () {
    return redirect()->route('mahasiswa.dashboard');
});

// Protected Routes (Must be Logged In)
Route::middleware(['auth'])->group(function () {

    // Mahasiswa Routes
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/pendaftaran', [MahasiswaController::class, 'pendaftaran'])->name('mahasiswa.pendaftaran');
    Route::post('/mahasiswa/pendaftaran', [MahasiswaController::class, 'storePendaftaran'])->name('mahasiswa.pendaftaran.store');
    Route::get('/mahasiswa/progress', [MahasiswaController::class, 'progress'])->name('mahasiswa.progress');
    Route::get('/mahasiswa/logbook', function () { return view('mahasiswa.logbook'); })->name('mahasiswa.logbook');

    Route::get('/mahasiswa/laporan', function () { return view('mahasiswa.laporan'); })->name('mahasiswa.laporan');
    Route::get('/mahasiswa/profile', function () { return view('mahasiswa.profile'); })->name('mahasiswa.profile');
    Route::get('/mahasiswa/settings', function () { return view('mahasiswa.settings'); })->name('mahasiswa.settings');

    // Dosen Routes
    Route::get('/dashboard/dosen', [App\Http\Controllers\DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('/dosen/monitoring', [App\Http\Controllers\DosenController::class, 'monitoring'])->name('dosen.monitoring');
    Route::get('/dosen/logbook', [App\Http\Controllers\DosenController::class, 'logbook'])->name('dosen.logbook');
    Route::get('/dosen/laporan', [App\Http\Controllers\DosenController::class, 'laporan'])->name('dosen.laporan');
    Route::get('/dosen/rekomendasi', [App\Http\Controllers\DosenController::class, 'rekomendasi'])->name('dosen.rekomendasi');
    Route::post('/dosen/rekomendasi/{mahasiswa}/approve', [App\Http\Controllers\DosenController::class, 'rekomendasikan'])->name('dosen.rekomendasi.approve');

    // Operator Routes
    Route::get('/dashboard/operator', [App\Http\Controllers\OperatorController::class, 'dashboard'])->name('operator.dashboard');
    Route::get('/operator/verifikasi', [App\Http\Controllers\OperatorController::class, 'verifikasi'])->name('operator.verifikasi');
    Route::post('/operator/verifikasi/{magang}/approve', [App\Http\Controllers\OperatorController::class, 'verifikasiApprove'])->name('operator.verifikasi.approve');
    Route::post('/operator/verifikasi/{magang}/tolak', [App\Http\Controllers\OperatorController::class, 'verifikasiTolak'])->name('operator.verifikasi.tolak');
    Route::get('/operator/dosen-pembimbing', [App\Http\Controllers\OperatorController::class, 'dosenPembimbing'])->name('operator.dosen_pembimbing');
    Route::post('/operator/dosen-pembimbing/{magang}/assign', [App\Http\Controllers\OperatorController::class, 'assignDosen'])->name('operator.assign_dosen');
    Route::get('/operator/id-magang', [App\Http\Controllers\OperatorController::class, 'idMagang'])->name('operator.id_magang');
    Route::post('/operator/id-magang/{magang}/generate', [App\Http\Controllers\OperatorController::class, 'generateId'])->name('operator.generate_id');
    Route::get('/operator/monitoring', [App\Http\Controllers\OperatorController::class, 'monitoring'])->name('operator.monitoring');
    Route::get('/operator/laporan', [App\Http\Controllers\OperatorController::class, 'laporan'])->name('operator.laporan');
    Route::get('/operator/surat-pengantar', function () { return view('operator.surat_pengantar'); })->name('operator.surat_pengantar');
    Route::get('/operator/arsip', function () { return view('operator.arsip'); })->name('operator.arsip');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});

