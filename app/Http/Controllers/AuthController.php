<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // LOGIN PETUGAS (username)
        $petugas = Petugas::where('username', $request->identity)->first();
        if ($petugas && Hash::check($request->password, $petugas->password)) {
            Auth::guard('petugas')->login($petugas);

            return $petugas->level === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('petugas.dashboard');
        }

        // LOGIN SISWA (NISN)
        $siswa = Siswa::where('nisn', $request->identity)->first();
        if ($siswa && Hash::check($request->password, $siswa->password)) {
            Auth::guard('siswa')->login($siswa);
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['error' => 'Username/NISN atau password salah!'])->withInput();
    }

    public function logout(Request $request)
    {
        if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
        } elseif (Auth::guard('siswa')->check()) {
            Auth::guard('siswa')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
