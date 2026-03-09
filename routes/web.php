<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

// Mahasiswa Routes
Route::get('/login/mahasiswa', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/konsultasi', function () {
    return view('mahasiswa.konsultasi');
});

Route::get('/id-magang', function () {
    return view('mahasiswa.id_magang');
});

Route::get('/surat-pengantar', function () {
    return view('mahasiswa.surat_pengantar');
});

Route::get('/dosen-pembimbing', function () {
    return view('mahasiswa.dosen_pembimbing');
});

Route::get('/logbook', function () {
    return view('mahasiswa.logbook');
});

Route::get('/laporan', function () {
    return view('mahasiswa.laporan');
});

Route::get('/presentasi', function () {
    return view('mahasiswa.presentasi');
});


// Dosen Routes
Route::get('/login/dosen', function () {
    return view('auth.login_dosen');
});

Route::get('/dashboard/dosen', function () {
    return view('dosen.dashboard');
});

Route::get('/dosen/rekomendasi', function () {
    return view('dosen.rekomendasi');
});

Route::get('/dosen/monitoring', function () {
    return view('dosen.monitoring');
});

Route::get('/dosen/logbook', function () {
    return view('dosen.logbook');
});

Route::get('/dosen/bimbingan', function () {
    return view('dosen.bimbingan');
});

Route::get('/dosen/penilaian', function () {
    return view('dosen.penilaian');
});

// Operator Routes
Route::get('/login/operator', function () {
    return view('auth.login_operator');
});

Route::get('/dashboard/operator', function () {
    return view('operator.dashboard');
});

Route::get('/operator/verifikasi', function () {
    return view('operator.verifikasi');
});

Route::get('/operator/id-magang', function () {
    return view('operator.id_magang');
});

Route::get('/operator/surat-pengantar', function () {
    return view('operator.surat_pengantar');
});

Route::get('/operator/dosen-pembimbing', function () {
    return view('operator.dosen_pembimbing');
});

Route::get('/operator/monitoring', function () {
    return view('operator.monitoring');
});

Route::get('/operator/laporan', function () {
    return view('operator.laporan');
});

Route::get('/operator/arsip', function () {
    return view('operator.arsip');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

