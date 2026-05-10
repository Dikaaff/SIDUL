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
