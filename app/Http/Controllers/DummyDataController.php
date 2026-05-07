<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Magang;
use App\Models\PesertaMagang;
use App\Models\Dosen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DummyDataController extends Controller
{
    // public function seed()
    // {
    //     try {
    //         DB::beginTransaction();

    //         // 1. Pastikan ada Dosen untuk pilihan plotting
    //         for ($i = 1; $i <= 3; $i++) {
    //             $nik = "NIK00$i";
    //             $u = User::firstOrCreate(
    //                 ['username' => $nik],
    //                 [
    //                     'name' => "Dosen Dummy $i",
    //                     'password' => Hash::make('password'),
    //                     'role' => 'dosen'
    //                 ]
    //             );
                
    //             Dosen::firstOrCreate(
    //                 ['nik' => $nik],
    //                 [
    //                     'user_id' => $u->id,
    //                     'nama' => $u->name,
    //                 ]
    //             );
    //         }

    //         $dosens = Dosen::all();

    //         // 2. Mahasiswa yang butuh di-plot oleh Operator (Sudah Daftar)
    //         for ($i = 1; $i <= 3; $i++) {
    //             $nim = "220100" . rand(10, 99);
    //             $u = User::create([
    //                 'name' => "MHS Plotting $i",
    //                 'username' => $nim,
    //                 'password' => Hash::make('password'),
    //                 'role' => 'mahasiswa'
    //             ]);
    //             $m = Mahasiswa::create([
    //                 'user_id' => $u->id,
    //                 'nim' => $nim,
    //                 'nama' => $u->name,
    //                 'prodi' => 'Informatika',
    //                 'status_magang' => 'Approve' // Sudah approve wali
    //             ]);

    //             $magang = Magang::create([
    //                 'kode_magang' => 'PEND-' . $nim,
    //                 'dosen_pembimbing_id' => $dosens->random()->id,
    //                 'status_magang' => 'Pending',
    //             ]);

    //             PesertaMagang::create([
    //                 'magang_id' => $magang->id,
    //                 'mahasiswa_id' => $m->id,
    //                 'is_ketua' => true,
    //             ]);
    //         }

    //         // 3. Mahasiswa yang butuh Daftar (Sudah Approve Wali tapi belum isi form magang)
    //         for ($i = 1; $i <= 2; $i++) {
    //              $nim = "220200" . rand(10, 99);
    //              $u = User::create([
    //                 'name' => "MHS Daftar $i",
    //                 'username' => $nim,
    //                 'password' => Hash::make('password'),
    //                 'role' => 'mahasiswa'
    //             ]);
    //             Mahasiswa::create([
    //                 'user_id' => $u->id,
    //                 'nim' => $nim,
    //                 'nama' => $u->name,
    //                 'prodi' => 'Informatika',
    //                 'status_magang' => 'Approve'
    //             ]);
    //         }

    //         DB::commit();
    //         return back()->with('success', '✨ Sukses! 5 Data Mahasiswa Dummy berhasil dibuat untuk pengujian.');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return "Error: " . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine();
    //     }
    // }

    // public function cleanup()
    // {
    //     try {
    //         $codes = ['MGN-20210001-PEND', 'MGN-20210002-VERIF'];
    //         $deleted = Magang::whereIn('kode_magang', $codes)->delete();
            
    //         return back()->with('success', "🗑️ Berhasil menghapus $deleted data magang yang dipilih.");
    //     } catch (\Exception $e) {
    //         return "Error: " . $e->getMessage();
    //     }
    }
}
