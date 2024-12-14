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
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('1'),
        ]);
    }

    // Cek apakah email mahasiswa sudah ada
    if (!\App\Models\User::where('email', 'mahasiswa@example.com')->exists()) {
        \App\Models\User::factory()->create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@example.com',
            'role' => 'mahasiswa',
            'password' => bcrypt('password'),
        ]);
}

    if (!\App\Models\User::where('email', 'dokter@example.com')->exists()) {
        \App\Models\User::factory()->create([
            'name' => 'Dokter',
            'email' => 'dokter@example.com',
            'role' => 'dokter',
            'password' => bcrypt('dokter123'),
        ]);
}
}
}

