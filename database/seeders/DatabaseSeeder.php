<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Spp;
use App\Models\Kelas;
use App\Models\Petugas;
use App\Models\Siswa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // SPP
        Spp::create(['tahun' => 2024, 'nominal' => 300000]);
        Spp::create(['tahun' => 2025, 'nominal' => 350000]);

        // Kelas
        Kelas::create(['nama_kelas' => 'XII RPL 1', 'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak']);
        Kelas::create(['nama_kelas' => 'XII RPL 2', 'kompetensi_keahlian' => 'Rekayasa Perangkat Lunak']);

        // Petugas
        Petugas::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_petugas' => 'Administrator',
            'level' => 'admin'
        ]);

        Petugas::create([
            'username' => 'petugas1',
            'password' => Hash::make('petugas123'),
            'nama_petugas' => 'Petugas Satu',
            'level' => 'petugas'
        ]);

        // Siswa
        Siswa::create([
            'nisn' => '1234567890',
            'nis' => '12345678',
            'nama' => 'Budi Santoso',
            'id_kelas' => 1,
            'alamat' => 'Jl. Merdeka No. 10',
            'no_telp' => '08123456789',
            'id_spp' => 1,
            'password' => Hash::make('siswa123')
        ]);

        Siswa::create([
            'nisn' => '0987654321',
            'nis' => '87654321',
            'nama' => 'Siti Aminah',
            'id_kelas' => 2,
            'alamat' => 'Jl. Sudirman No. 20',
            'no_telp' => '08198765432',
            'id_spp' => 1,
            'password' => Hash::make('siswa123')
        ]);
    }
}   