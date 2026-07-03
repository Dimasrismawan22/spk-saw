<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration
     */
    public function up(): void
    {
        Schema::create('prestasi', function (Blueprint $table) {

            // =========================
            // PRIMARY KEY
            // =========================
            $table->id();

            // =========================
            // RELASI KE SISWA
            // =========================
            $table->foreignId('siswa_id')
                  ->constrained('siswa')
                  ->onDelete('cascade');

            // =========================
            // NAMA PRESTASI
            // =========================
            // contoh:
            // Olimpiade Matematika
            // Lomba Cerdas Cermat
            $table->string('nama_prestasi');

            // =========================
            // TINGKAT PRESTASI
            // =========================
            // kabupaten
            // provinsi
            // nasional
            // internasional
            $table->enum('tingkat', [

                'kabupaten',

                'provinsi',

                'nasional',

                'internasional'

            ])->index();

            // =========================
            // NILAI PRESTASI
            // =========================
            // kabupaten     = 30
            // provinsi      = 50
            // nasional      = 80
            // internasional = 100
            $table->integer('nilai');

            // =========================
            // TAHUN PRESTASI
            // =========================
            // contoh:
            // 2025
            $table->year('tahun_prestasi')
                  ->nullable();

            // =========================
            // KETERANGAN
            // =========================
            // contoh:
            // Juara 1
            // Juara Harapan
            $table->text('keterangan')
                  ->nullable();

            // =========================
            // TIMESTAMP
            // =========================
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasi');
    }
};