<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    public function index()
    {
        $spp = Spp::withCount('siswa')->paginate(10);
        return view('admin.spp.index', compact('spp'));
    }

    public function create()
    {
        return view('admin.spp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer',
            'nominal' => 'required|integer'
        ]);

        $spp = Spp::create($request->all());

        return redirect()->route('admin.spp.index', $spp->id_spp)->with('success', 'Data SPP berhasil ditambahkan');
    }

    public function edit($id_spp)
    {
        $spp = Spp::findOrFail($id_spp);
        return view('admin.spp.edit', compact('spp'));
    }

    public function update(Request $request, $id_spp)
    {
        $spp = Spp::findOrFail($id_spp);

        $request->validate([
            'tahun' => 'required|integer',
            'nominal' => 'required|integer'
        ]);

        $spp->update($request->all());

        return redirect()->route('admin.spp.index')->with('success', 'Data SPP berhasil diupdate');
    }

    public function destroy($id_spp)
    {
        $spp = Spp::findOrFail($id_spp);
        $spp->delete();

        return redirect()->route('admin.spp.index')->with('success', 'Data SPP berhasil dihapus');
    }
}
