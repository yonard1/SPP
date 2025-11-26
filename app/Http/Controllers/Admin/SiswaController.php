<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with(['kelas', 'spp'])->paginate(10);
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('admin.siswa.create', compact('kelas', 'spp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|unique:siswas,nisn',
            'nis' => 'required|unique:siswas,nis',
            'nama' => 'required',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required|exists:spps,id_spp',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Siswa::create($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view('admin.siswa.edit', compact('siswa', 'kelas', 'spp'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nisn' => 'required|unique:siswas,nisn,' . $id . ',nisn',
            'nis' => 'required|unique:siswas,nis,' . $id . ',nisn',
            'nama' => 'required',
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required|exists:spps,id_spp'
        ]);

        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}
