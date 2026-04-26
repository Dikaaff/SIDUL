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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->to($this->redirectBasedOnRole(Auth::user()->role))->with('success', 'Selamat datang kembali!');
        }

        // Jika gagal
        return back()->withErrors([
            'username' => 'Kredensial yang Anda berikan tidak cocok dengan data kami.',
        ])->onlyInput('username');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        try {
            // 1. Create User
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);

            // 2. Create Mahasiswa Profile
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->username,
                'nama' => $request->name,
                'prodi' => 'Informatika', // Default value
                // dosen_wali_id akan diisi oleh operator/admin nanti
            ]);

            Auth::login($user);

            return redirect()->to($this->redirectBasedOnRole('mahasiswa'))->with('success', 'Akun berhasil dibuat! Selamat datang di SIDUL.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mendaftarkan akun. Silakan coba lagi.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
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
            default    => '/dashboard',
        };
    }
}
