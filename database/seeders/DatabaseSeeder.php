<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      if (!\App\Models\User::where('email', 'admin@admin.com')->exists()) {
        \App\Models\User::factory()->create([
            'name' => 'Tifur',
            'email' => 'tifur@admin.com',
            'role' => 'tifur123',
            'password' => bcrypt('tifur123'),
        ]);
    }

    // Cek apakah email mahasiswa sudah ada
    if (!\App\Models\User::where('email', 'mahasiswa@example.com')->exists()) {
        \App\Models\User::factory()->create([
            'name' => 'Agung W',
            'email' => 'agung@example.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('agung123'),
        ]);
}

    if (!\App\Models\User::where('email', 'dokter@example.com')->exists()) {
        \App\Models\User::factory()->create([
            'name' => 'Hafidh',
            'email' => 'hafidh@example.com',
            'role' => 'dokter',
            'password' => bcrypt('hafidh123'),
        ]);
}
}
}

