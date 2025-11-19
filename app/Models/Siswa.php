<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'nisn';
    public $incrementing = false; // karena bukan integer
    protected $keyType = 'string';
    protected $table = 'siswas';
    
    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'id_spp',
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp', 'id_spp');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'nisn', 'nisn');
    }
}