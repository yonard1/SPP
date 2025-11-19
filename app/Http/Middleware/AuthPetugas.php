<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthPetugas
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('logged_in') || !in_array(session('role'), ['admin', 'petugas'])) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai Petugas/Admin');
        }
        return $next($request);
    }
}