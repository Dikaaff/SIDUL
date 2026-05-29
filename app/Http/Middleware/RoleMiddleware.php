<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    # fungsi untuk memvalidasi role user
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        if ($user->role !== $role) {
            return match($user->role) {
                'admin'    => redirect()->route('admin.dashboard'),
                'dosen'    => redirect()->route('dosen.dashboard'),
                'operator' => redirect()->route('operator.dashboard'),
                default    => redirect()->route('mahasiswa.dashboard'),
            };
        }

        return $next($request);
    }
}
