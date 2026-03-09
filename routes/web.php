<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/pendaftaran', function () {
    return view('mahasiswa.pendaftaran');
});

Route::get('/bimbingan', function () {
    return view('mahasiswa.bimbingan');
});

Route::get('/dosen', function () {
    return view('dosen.dashboard');
});

Route::get('/dosen/mahasiswa', function () {
    return view('dosen.mahasiswa');
});

Route::get('/dosen/rekomendasi', function () {
    return view('dosen.rekomendasi');
});

Route::get('/dosen/prasurvey', function () {
    return view('dosen.prasurvey');
});

Route::get('/dosen/laporan', function () {
    return view('dosen.laporan');
});

Route::get('/dosen/penilaian', function () {
    return view('dosen.penilaian');
});

Route::get('/operator', function () {
    return view('operator.dashboard');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});
