<?php

namespace Database\Seeders;

use App\Models\Panduan;
use Illuminate\Database\Seeder;

class PanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Panduan::create([
            'judul' => 'Panduan Pengguna Baru',
            'konten' => 'Panduan ini berisi langkah-langkah awal yang perlu dilakukan oleh pengguna baru.'
        ]);

        Panduan::create([
            'judul' => 'Panduan Fitur Utama',
            'konten' => 'Panduan ini menjelaskan berbagai fitur utama yang tersedia dalam aplikasi.'
        ]);

        Panduan::create([
            'judul' => 'Panduan Pemecahan Masalah',
            'konten' => 'Panduan ini membantu pengguna menyelesaikan masalah umum yang mungkin terjadi.'
        ]);
    }
}
