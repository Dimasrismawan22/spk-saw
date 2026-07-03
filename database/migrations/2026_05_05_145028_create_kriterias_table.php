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
        Schema::create('kriteria', function (Blueprint $table) {

            // =========================
            // PRIMARY KEY
            // =========================
            $table->id();

            // =========================
            // KODE KRITERIA
            // =========================
            // contoh:
            // C1, C2, C3
            $table->string('kode_kriteria')
                  ->unique();

            // =========================
            // NAMA KRITERIA
            // =========================
            $table->string('nama_kriteria');

            // =========================
            // ATRIBUT
            // benefit / cost
            // =========================
            $table->enum('atribut', [
                'benefit',
                'cost'
            ]);

            // =========================
            // BOBOT KRITERIA
            // =========================
            // contoh:
            // 0.30
            // 0.50
            // 0.20
            $table->decimal('bobot', 5, 2);

            // =========================
            // KETERANGAN
            // =========================
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
        Schema::dropIfExists('kriteria');
    }
};