<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    // =========================
    // NAMA TABEL
    // =========================
    protected $table = 'siswa';

    // =========================
    // FIELD YANG BOLEH DIISI
    // =========================
    protected $fillable = [

        // IDENTITAS SISWA
        'nama',
        'nisn',

        // =========================
        // NILAI AKADEMIK
        // =========================
        'rata_rata_raport',

        // =========================
        // NILAI TES
        // =========================
        'tes_matematika',
        'tes_ipa',
        'tes_ips',
    ];

    // =========================
    // RELASI KE PRESTASI
    // =========================
    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    // =========================
    // RELASI KE HASIL SAW
    // =========================
    public function hasil()
    {
        return $this->hasMany(Hasil::class);
    }
}