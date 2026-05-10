<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input kosong
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'NIM/NIK atau Password tidak boleh kosong!',
            'password.required' => 'NIM/NIK atau Password tidak boleh kosong!',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->to($this->redirectBasedOnRole(Auth::user()->role))->with('success', 'Selamat datang kembali!');
        }

        // Jika salah kredensial
        return back()->withErrors([
            'error' => 'NIM/NIK atau Password salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    /**
     * Redirect to the correct dashboard based on role.
     */
    private function redirectBasedOnRole(string $role): string
    {
        return match($role) {
            'admin'    => '/dashboard/admin',
            'dosen'    => '/dashboard/dosen',
            'operator' => '/dashboard/operator',
            default    => '/mahasiswa/dashboard',
        };
    }
}
