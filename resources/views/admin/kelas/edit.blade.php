@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Edit Kelas</h3>

    <form action="{{ route('admin.kelas.update', $kelas->id_kelas) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="{{ $kelas->nama_kelas }}">
        </div>

        <div class="mb-3">
            <label>Kompetensi Keahlian</label>
            <select name="kompetensi_keahlian" class="form-control">

                <option value="">-- Pilih Kompetensi Keahlian --</option>

                <option value="Rekayasa Perangkat Lunak"
                    @selected(old('kompetensi_keahlian', $kelas->kompetensi_keahlian ?? '') == 'Rekayasa Perangkat Lunak')>
                    Rekayasa Perangkat Lunak
                </option>

                <option value="Teknik Komputer Jaringan"
                    @selected(old('kompetensi_keahlian', $kelas->kompetensi_keahlian ?? '') == 'Teknik Komputer Jaringan')>
                    Teknik Komputer dan Jaringan
                </option>

                <option value="Teknik Elektronika Industri"
                    @selected(old('kompetensi_keahlian', $kelas->kompetensi_keahlian ?? '') == 'Teknik Elektronika Industri')>
                    Teknik Elektronika Industri
                </option>

                <option value="Teknik Pendingin Tata Udara"
                    @selected(old('kompetensi_keahlian', $kelas->kompetensi_keahlian ?? '') == 'Teknik Pendingin Tata Udara')>
                    Teknik Pendingin Dan Tata Udara
                </option>

            </select>
        </div>

        <button class="btn btn-success" href="{{ route('admin.kelas.index') }}">Update</button>
    </form>
</div>
@endsection
