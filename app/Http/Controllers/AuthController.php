<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Petugas;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cek Petugas/Admin
        $petugas = Petugas::where('username', $request->username)->first();
        if ($petugas && Hash::check($request->password, $petugas->password)) {
            session([
                'logged_in' => true,
                'role' => $petugas->level,
                'id' => $petugas->id_petugas,
                'nama' => $petugas->nama_petugas
            ]);
            return redirect()->route($petugas->level . '.dashboard');
        }

        // Cek Siswa
        $siswa = Siswa::where('nisn', $request->username)->orWhere('nis', $request->username)->first();
        if ($siswa && Hash::check($request->password, $siswa->password)) {
            session([
                'logged_in' => true,
                'role' => 'siswa',
                'nisn' => $siswa->nisn,
                'nama' => $siswa->nama
            ]);
            return redirect()->route('siswa.dashboard');
        }

        return back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Berhasil logout');
    }
}