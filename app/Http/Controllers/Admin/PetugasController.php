<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = Petugas::paginate(10);
        return view('admin.petugas.index', compact('petugas'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:petugas,username',
            'password' => 'required|min:6',
            'nama_petugas' => 'required',
            'level' => 'required|in:admin,petugas'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        Petugas::create($data);

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);
        return view('admin.petugas.edit', compact('petugas'));
    }

    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:petugas,username,' . $id . ',id_petugas',
            'nama_petugas' => 'required',
            'level' => 'required|in:admin,petugas'
        ]);
        $data = $request->except('password');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $petugas->update($data);

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diupdate');
    }

    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil dihapus');
    }
}
