<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MockAuthMiddleware
{
    # fungsi untuk memvalidasi session login mock
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('mock_user')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu (Mock Auth).');
        }

        return $next($request);
    }
}
