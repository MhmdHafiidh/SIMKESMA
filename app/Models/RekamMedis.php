<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekam_medis_v2'; // Sesuaikan dengan nama tabel
    protected $fillable = [
        'mahasiswa_id',
        'dokter_id',
        'keluhan',
        'gejala',
        'riwayat_penyakit',
        'alergi',
        'tekanan_darah',
        'suhu_badan',
        'tinggi_badan',
        'berat_badan',
        'diagnosis',
        'tindakan',
        'resep_obat',
        'status',
        'tanggal_periksa',
        'tanggal_selesai',
    ];

    /**
     * Relasi dengan model User sebagai mahasiswa.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    /**
     * Relasi dengan model User sebagai dokter.
     */
    public function dokter()
    {
        return $this->belongsTo(User::class, 'dokter_id');
    }

    /**
     * Scope untuk mendapatkan rekam medis dengan status tertentu.
     */
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk mendapatkan rekam medis mahasiswa tertentu.
     */
    public function scopeForMahasiswa($query, $mahasiswaId)
    {
        return $query->where('mahasiswa_id', $mahasiswaId);
    }
}
