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
    return redirect()->route('dashboard.redirect');
});

// Protected Routes (Must be Logged In)
Route::get('/seed-dummy', [\App\Http\Controllers\DummyDataController::class, 'seed']);
Route::get('/cleanup-dummy', [\App\Http\Controllers\DummyDataController::class, 'cleanup']);

Route::middleware(['auth'])->group(function () {

    // Landing Dashboard (Universal Redirector)
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'dosen'    => redirect()->route('dosen.dashboard'),
            'operator' => redirect()->route('operator.dashboard'),
            default    => redirect()->route('mahasiswa.home'),
        };
    })->name('dashboard.redirect');

    // Mahasiswa Routes
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.home');
    Route::get('/mahasiswa/pendaftaran', [App\Http\Controllers\MahasiswaController::class, 'pendaftaran'])->name('mahasiswa.pendaftaran');
    Route::post('/mahasiswa/pendaftaran/store', [App\Http\Controllers\MahasiswaController::class, 'storePendaftaran'])->name('mahasiswa.pendaftaran.store');
    Route::get('/mahasiswa/surat-pengantar', [App\Http\Controllers\MahasiswaController::class, 'suratPengantar'])->name('mahasiswa.surat_pengantar');
    Route::get('/mahasiswa/logbook', [App\Http\Controllers\MahasiswaController::class, 'logbook'])->name('mahasiswa.logbook');
    Route::get('/mahasiswa/logbook/pdf', [MahasiswaController::class, 'cetakLogbook'])->name('mahasiswa.logbook.pdf');
    Route::post('/mahasiswa/logbook', [MahasiswaController::class, 'storeLogbook'])->name('mahasiswa.logbook.store');
    Route::get('/mahasiswa/laporan', [MahasiswaController::class, 'laporan'])->name('mahasiswa.laporan');
    Route::get('/mahasiswa/laporan/pdf', [MahasiswaController::class, 'cetakLaporan'])->name('mahasiswa.laporan.pdf');
    Route::post('/mahasiswa/laporan', [MahasiswaController::class, 'storeLaporan'])->name('mahasiswa.laporan.store');
    Route::get('/mahasiswa/profile', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile');
    Route::get('/mahasiswa/settings', [MahasiswaController::class, 'settings'])->name('mahasiswa.settings');

    // Dosen Routes
    Route::get('/dashboard/dosen', [App\Http\Controllers\DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('/dosen/monitoring', [App\Http\Controllers\DosenController::class, 'monitoring'])->name('dosen.monitoring');
    Route::get('/dosen/logbook', [App\Http\Controllers\DosenController::class, 'logbook'])->name('dosen.logbook');
    Route::get('/dosen/laporan', [App\Http\Controllers\DosenController::class, 'laporan'])->name('dosen.laporan');
    Route::post('/dosen/laporan/{magang}/approve', [App\Http\Controllers\DosenController::class, 'approveLaporan'])->name('dosen.laporan.approve');
    Route::get('/dosen/rekomendasi', [App\Http\Controllers\DosenController::class, 'rekomendasi'])->name('dosen.rekomendasi');
    Route::post('/dosen/rekomendasi/{mahasiswa}/approve', [App\Http\Controllers\DosenController::class, 'rekomendasikan'])->name('dosen.rekomendasi.approve');
    Route::post('/dosen/rekomendasi/{mahasiswa}/reject', [App\Http\Controllers\DosenController::class, 'tolakRekomendasi'])->name('dosen.rekomendasi.reject');

    // Operator Routes
    Route::get('/dashboard/operator', [App\Http\Controllers\OperatorController::class, 'dashboard'])->name('operator.dashboard');
    Route::post('/operator/periode/toggle', [App\Http\Controllers\OperatorController::class, 'togglePeriode'])->name('operator.periode.toggle');
    Route::get('/operator/dosen-pembimbing', [App\Http\Controllers\OperatorController::class, 'dosenPembimbing'])->name('operator.dosen_pembimbing');
    Route::post('/operator/dosen-pembimbing/{magang}/assign', [App\Http\Controllers\OperatorController::class, 'assignDosen'])->name('operator.assign_dosen');
    Route::delete('/operator/magang/{magang}', [App\Http\Controllers\OperatorController::class, 'destroy'])->name('operator.magang.destroy');
    Route::get('/operator/monitoring', [App\Http\Controllers\OperatorController::class, 'monitoring'])->name('operator.monitoring');
    Route::get('/operator/laporan', [App\Http\Controllers\OperatorController::class, 'laporan'])->name('operator.laporan');

    // Admin Routes
    Route::get('/dashboard/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [App\Http\Controllers\AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});
