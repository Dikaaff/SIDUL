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
    
    // Mahasiswa Roll
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/pendaftaran', [MahasiswaController::class, 'pendaftaran'])->name('mahasiswa.pendaftaran');
    Route::post('/mahasiswa/pendaftaran', [MahasiswaController::class, 'storePendaftaran'])->name('mahasiswa.pendaftaran.store');
    Route::get('/mahasiswa/progress', [MahasiswaController::class, 'progress'])->name('mahasiswa.progress');
    Route::get('/mahasiswa/logbook', function () { return view('mahasiswa.logbook'); })->name('mahasiswa.logbook');
    Route::get('/mahasiswa/bimbingan', function () { return view('mahasiswa.bimbingan'); })->name('mahasiswa.bimbingan');
    Route::get('/mahasiswa/laporan', function () { return view('mahasiswa.laporan'); })->name('mahasiswa.laporan');
    Route::get('/mahasiswa/profile', function () { return view('mahasiswa.profile'); })->name('mahasiswa.profile');
    Route::get('/mahasiswa/settings', function () { return view('mahasiswa.settings'); })->name('mahasiswa.settings');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Legacy/Compatibility Redirects
Route::get('/logout', [AuthController::class, 'logout']); 

// Dosen Routes (Future)
Route::get('/login/dosen', function () { return view('auth.login_dosen'); });
Route::get('/dashboard/dosen', function () { return view('dosen.dashboard'); });

// Operator Routes (Future)
Route::get('/login/operator', function () { return view('auth.login_operator'); });
Route::get('/dashboard/operator', function () { return view('operator.dashboard'); });

