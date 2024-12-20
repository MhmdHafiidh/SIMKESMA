<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('obat', function (Blueprint $table) {
            $table->dropColumn(['harga_jual', 'harga_beli']); // Menghapus kolom harga_jual dan harga_beli
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('obat', function (Blueprint $table) {
            $table->integer('harga_jual')->nullable(); // Tambahkan kembali kolom harga_jual
            $table->integer('harga_beli')->nullable(); // Tambahkan kembali kolom harga_beli
        });
    }
};
