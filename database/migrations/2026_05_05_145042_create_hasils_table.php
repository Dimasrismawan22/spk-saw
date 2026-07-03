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
        Schema::create('hasil', function (Blueprint $table) {

            // =========================
            // PRIMARY KEY
            // =========================
            $table->id();

            // =========================
            // RELASI SISWA
            // =========================
            // Dibuat nullable agar riwayat tetap tersimpan
            // meskipun data siswa sudah dihapus.
            $table->foreignId('siswa_id')
                  ->nullable()
                  ->constrained('siswa')
                  ->nullOnDelete();

            // =========================
            // NAMA SISWA DI RIWAYAT
            // =========================
            // Disimpan agar nama siswa tetap tampil di riwayat
            // walaupun data siswa aslinya sudah dihapus.
            $table->string('nama_siswa');

            // =========================
            // NILAI AKHIR SAW
            // =========================
            $table->decimal('nilai', 8, 4);

            // =========================
            // RANKING
            // =========================
            $table->integer('ranking');

            // =========================
            // KELAS
            // =========================
            // contoh:
            // A, B, C
            $table->string('kelas', 5);

            // =========================
            // PERIODE AJARAN
            // =========================
            // contoh:
            // 2025/2026
            $table->string('periode');

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
        Schema::dropIfExists('hasil');
    }
};