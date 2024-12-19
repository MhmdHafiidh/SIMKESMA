<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('rekam_medis_v2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('dokter_id')->nullable()->constrained('users');
            $table->text('keluhan');
            $table->text('gejala');
            $table->text('riwayat_penyakit')->nullable();
            $table->string('alergi')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->integer('suhu_badan')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->decimal('berat_badan')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('tindakan')->nullable();
            $table->enum('status', ['menunggu', 'proses', 'selesai'])->default('menunggu');
            $table->datetime('tanggal_periksa')->nullable();
            $table->datetime('tanggal_selesai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('rekam_medis_v2');
    }
};
