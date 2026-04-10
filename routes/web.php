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
    Route::get('/mahasiswa/bimbingan', function () { return view('mahasiswa.bimbingan'); })->name('mahasiswa.bimbingan');
    Route::get('/mahasiswa/laporan', function () { return view('mahasiswa.laporan'); })->name('mahasiswa.laporan');
    Route::get('/mahasiswa/profile', function () { return view('mahasiswa.profile'); })->name('mahasiswa.profile');
    Route::get('/mahasiswa/settings', function () { return view('mahasiswa.settings'); })->name('mahasiswa.settings');

    // Dosen Routes
    Route::get('/dashboard/dosen', function () { return view('dosen.dashboard'); })->name('dosen.dashboard');
    Route::get('/dosen/monitoring', function () { return view('dosen.monitoring'); })->name('dosen.monitoring');
    Route::get('/dosen/bimbingan', function () { return view('dosen.bimbingan'); })->name('dosen.bimbingan');
    Route::get('/dosen/logbook', function () { return view('dosen.logbook'); })->name('dosen.logbook');
    Route::get('/dosen/laporan', function () { return view('dosen.laporan'); })->name('dosen.laporan');
    Route::get('/dosen/rekomendasi', function () { return view('dosen.rekomendasi'); })->name('dosen.rekomendasi');

    // Operator Routes
    Route::get('/dashboard/operator', function () { return view('operator.dashboard'); })->name('operator.dashboard');
    Route::get('/operator/verifikasi', function () { return view('operator.verifikasi'); })->name('operator.verifikasi');
    Route::get('/operator/id-magang', function () { return view('operator.id_magang'); })->name('operator.id_magang');
    Route::get('/operator/surat-pengantar', function () { return view('operator.surat_pengantar'); })->name('operator.surat_pengantar');
    Route::get('/operator/dosen-pembimbing', function () { return view('operator.dosen_pembimbing'); })->name('operator.dosen_pembimbing');
    Route::get('/operator/monitoring', function () { return view('operator.monitoring'); })->name('operator.monitoring');
    Route::get('/operator/laporan', function () { return view('operator.laporan'); })->name('operator.laporan');
    Route::get('/operator/arsip', function () { return view('operator.arsip'); })->name('operator.arsip');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});

