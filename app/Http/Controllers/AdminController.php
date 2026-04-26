<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Magang;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Global Stats
        $totalMahasiswa = Mahasiswa::count();
        $totalMagangAktif = Magang::where('status_magang', 'Aktif')->count();
        $totalDosen = Dosen::count();
        $totalOperator = User::where('role', 'operator')->count();

        return view('admin.dashboard', compact('totalMahasiswa', 'totalMagangAktif', 'totalDosen', 'totalOperator'));
    }

    public function users()
    {
        // Mengambil daftar Dosen dan Operator
        $users = User::whereIn('role', ['dosen', 'operator'])->orderBy('role')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'role' => 'required|in:dosen,operator',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Use the submitted password
            'role' => $request->role,
        ]);

        // Jika dia Dosen, otomatis buat profil Dosennya
        if ($request->role === 'dosen') {
            Dosen::create([
                'user_id' => $user->id_user,
                'nik' => $request->username, // Anggap username dosen adalah NIK
                'nama' => $request->name,
            ]);
        }

        return back()->with('success', 'Akun ' . ucfirst($request->role) . ' berhasil ditambahkan!');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'dosen') {
            // Hapus relasi dosen jika ada
            Dosen::where('user_id', $user->id_user)->delete();
        }

        $user->delete();

        return back()->with('success', 'Akun berhasil dihapus secara permanen.');
    }
}
