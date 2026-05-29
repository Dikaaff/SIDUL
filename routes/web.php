<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\AdminController;

// Public Routes (Guests only)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/', function () {
    return redirect()->route('dashboard.redirect');
});

// Protected Routes (Must be Logged In)

Route::middleware(['auth'])->group(function () {

    // Landing Dashboard (Universal Redirector)
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        return match($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'dosen'    => redirect()->route('dosen.dashboard'),
            'operator' => redirect()->route('operator.dashboard'),
            default    => redirect()->route('mahasiswa.dashboard'),
        };
    })->name('dashboard.redirect');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', [AuthController::class, 'logout']);
});

// Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/pendaftaran', [MahasiswaController::class, 'pendaftaran'])->name('mahasiswa.pendaftaran');
    Route::post('/mahasiswa/pendaftaran/store', [MahasiswaController::class, 'storePendaftaran'])->name('mahasiswa.pendaftaran.store');
    Route::get('/mahasiswa/surat-pengantar', [MahasiswaController::class, 'suratPengantar'])->name('mahasiswa.surat_pengantar');
    Route::get('/mahasiswa/logbook', [MahasiswaController::class, 'logbook'])->name('mahasiswa.logbook');
    Route::get('/mahasiswa/logbook/pdf', [MahasiswaController::class, 'cetakLogbook'])->name('mahasiswa.logbook.pdf');
    Route::post('/mahasiswa/logbook', [MahasiswaController::class, 'storeLogbook'])->name('mahasiswa.logbook.store');
    Route::get('/mahasiswa/laporan', [MahasiswaController::class, 'laporan'])->name('mahasiswa.laporan');
    Route::get('/mahasiswa/laporan/pdf', [MahasiswaController::class, 'cetakLaporan'])->name('mahasiswa.laporan.pdf');
    Route::post('/mahasiswa/laporan', [MahasiswaController::class, 'storeLaporan'])->name('mahasiswa.laporan.store');
});

// Dosen Routes
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dashboard/dosen', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
    Route::get('/dosen/monitoring', [DosenController::class, 'monitoring'])->name('dosen.monitoring');
    Route::get('/dosen/logbook', [DosenController::class, 'logbook'])->name('dosen.logbook');
    Route::get('/dosen/laporan', [DosenController::class, 'laporan'])->name('dosen.laporan');
    Route::post('/dosen/laporan/{magang}/approve', [DosenController::class, 'approveLaporan'])->name('dosen.laporan.approve');
    Route::get('/dosen/rekomendasi', [DosenController::class, 'rekomendasi'])->name('dosen.rekomendasi');
    Route::post('/dosen/rekomendasi/{mahasiswa}/approve', [DosenController::class, 'rekomendasikan'])->name('dosen.rekomendasi.approve');
    Route::post('/dosen/rekomendasi/{mahasiswa}/reject', [DosenController::class, 'tolakRekomendasi'])->name('dosen.rekomendasi.reject');
});

// Operator Routes
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/dashboard/operator', [OperatorController::class, 'dashboard'])->name('operator.dashboard');
    Route::post('/operator/periode/toggle', [OperatorController::class, 'togglePeriode'])->name('operator.periode.toggle');
    Route::get('/operator/dosen-pembimbing', [OperatorController::class, 'dosenPembimbing'])->name('operator.dosen_pembimbing');
    Route::post('/operator/dosen-pembimbing/{magang}/assign', [OperatorController::class, 'assignDosen'])->name('operator.assign_dosen');
    Route::delete('/operator/magang/{magang}', [OperatorController::class, 'destroy'])->name('operator.magang.destroy');
    Route::get('/operator/monitoring', [OperatorController::class, 'monitoring'])->name('operator.monitoring');
    Route::get('/operator/laporan', [OperatorController::class, 'laporan'])->name('operator.laporan');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
});

// Helper Route khusus untuk Reset Data Testing di Lokal
if (app()->environment('local')) {
    // 1. Reset ke Pending (Gunakan sebelum test Rekomendasi Dosen)
    Route::get('/dev/reset-to-pending', function () {
        \App\Models\Mahasiswa::query()->update(['status_magang' => 'Pending']);
        
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\PesertaMagang::truncate();
        \App\Models\Magang::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        
        return response()->json(['message' => 'Seluruh data mahasiswa berhasil di-reset ke PENDING (Siap di-Approve Dosen)!']);
    });

    // 2. Reset ke Approve (Gunakan sebelum test Pendaftaran Mahasiswa)
    Route::get('/dev/reset-to-approved', function () {
        \App\Models\Mahasiswa::query()->update(['status_magang' => 'Approve']);
        
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\PesertaMagang::truncate();
        \App\Models\Magang::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        
        return response()->json(['message' => 'Seluruh data mahasiswa berhasil di-reset ke APPROVE (Siap daftar magang)!']);
    });

    // Alias untuk kecocokan ke belakang
    Route::get('/dev/reset-test-data', function () {
        return redirect('/dev/reset-to-approved');
    });

    // 3. Reset data untuk test Plotting Dosen Pembimbing (Operator)
    Route::get('/dev/reset-plotting-data', function () {
        // Kosongkan tabel terkait dulu
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\PesertaMagang::truncate();
        \App\Models\Magang::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // Cari satu mahasiswa yang ada (prioritas Dika Afif)
        $mhs = \App\Models\Mahasiswa::where('nim', '23.01.5029')->first()
            ?? \App\Models\Mahasiswa::first();

        if (! $mhs) {
            return response()->json(['error' => 'Tidak ada mahasiswa di database. Jalankan: php artisan migrate:fresh --seed'], 404);
        }

        // Pastikan status Approve
        $mhs->update(['status_magang' => 'Approve']);

        // Buat record magang TANPA dosen_pembimbing_id agar masuk kolom "Perlu Penugasan"
        $kode = 'PLOT-TEST-' . now()->format('HisU');
        $magang = \App\Models\Magang::create([
            'kode_magang'         => $kode,
            'dosen_pembimbing_id' => null,
            'status_magang'       => 'Pending',
            'perusahaan'          => 'PT Test Selenium',
            'alamat'              => 'Jl. Testing No. 1',
            'tipe_magang'         => 'Mandiri',
            'konsentrasi'         => $mhs->konsentrasi ?? 'Web Development',
            'tanggal_mulai'       => now()->toDateString(),
            'tanggal_selesai'     => now()->addMonths(3)->toDateString(),
        ]);

        // Hubungkan mahasiswa ke magang
        \App\Models\PesertaMagang::create([
            'magang_id'   => $magang->id,
            'mahasiswa_id'=> $mhs->id,
            'is_ketua'    => true,
        ]);

        return response()->json([
            'message'      => 'Berhasil! 1 magang Pending siap di-plotting. Buka /operator/dosen-pembimbing.',
            'kode_magang'  => $magang->kode_magang,
            'mahasiswa'    => $mhs->nama . ' (' . $mhs->nim . ')',
        ]);
    });
}

