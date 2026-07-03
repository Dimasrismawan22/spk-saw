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
        Schema::create('siswa', function (Blueprint $table) {

            // =========================
            // PRIMARY KEY
            // =========================
            $table->id();

            // =========================
            // IDENTITAS SISWA
            // =========================

            // NAMA SISWA
            $table->string('nama');

            // NISN 10 DIGIT & UNIK
            $table->string('nisn', 10)
                  ->unique();

            // =========================
            // NILAI AKADEMIK
            // =========================

            // NILAI RATA-RATA RAPORT
            $table->decimal('rata_rata_raport', 5, 2);

            // =========================
            // NILAI TES
            // =========================

            // TES MATEMATIKA
            $table->decimal('tes_matematika', 5, 2);

            // TES IPA
            $table->decimal('tes_ipa', 5, 2);

            // TES IPS
            $table->decimal('tes_ips', 5, 2);

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
        Schema::dropIfExists('siswa');
    }
};