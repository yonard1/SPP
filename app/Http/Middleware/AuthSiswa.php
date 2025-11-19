<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthSiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('logged_in') || session('role') != 'siswa') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai Siswa');
        }
        return $next($request);
    }
}