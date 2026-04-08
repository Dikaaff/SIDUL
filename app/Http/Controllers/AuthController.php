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
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // 1. Cek apakah input adalah Email
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['email' => $login, 'password' => $password], $request->filled('remember'))) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali!');
            }
        } 
        
        // 2. Cek apakah input adalah NIM (Cek tabel mahasiswa)
        $mahasiswa = Mahasiswa::where('nim', $login)->first();
        if ($mahasiswa) {
            $user = $mahasiswa->user;
            if ($user && Hash::check($password, $user->password)) {
                Auth::login($user, $request->filled('remember'));
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali!');
            }
        }

        // Jika gagal
        return back()->withErrors([
            'login' => 'Kredensial yang Anda berikan tidak cocok dengan data kami.',
        ])->onlyInput('login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswas,nim',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        try {
            // 1. Create User
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'mahasiswa',
            ]);

            // 2. Create Mahasiswa Profile
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => $request->nim,
                // field lainnya default null
            ]);

            Auth::login($user);

            return redirect()->route('mahasiswa.dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang di SIDUL.');
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
}
