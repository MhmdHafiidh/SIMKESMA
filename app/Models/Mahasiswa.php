<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash; 

class Mahasiswa extends Model
{
    protected $table = 'mahas_table_v2'; // Pastikan nama tabel sesuai
    protected $fillable = [
        'nama_lengkap',
        'nim',
        'email',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'prodi',
        'angkatan',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value); // Enkripsi password sebelum disimpan
    }
}

