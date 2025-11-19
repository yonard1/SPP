<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('petugas')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama_petugas' => 'Administrator',
                'level' => 'admin',
                'created_at' => now(),
            ],
            [
                'username' => 'petugas1',
                'password' => Hash::make('petugas123'),
                'nama_petugas' => 'Petugas Utama',
                'level' => 'petugas',
                'created_at' => now(),
            ],
        ]);
    }
}
