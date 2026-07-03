<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    // =========================
    // NAMA TABEL
    // =========================
    protected $table = 'hasil';

    // =========================
    // FIELD YANG BOLEH DIISI
    // =========================
    protected $fillable = [

        // RELASI SISWA
        // nullable karena data siswa bisa dihapus,
        // tetapi riwayat tetap disimpan
        'siswa_id',

        // NAMA SISWA DI RIWAYAT
        // disimpan agar nama siswa tetap tampil
        // meskipun data siswa aslinya sudah dihapus
        'nama_siswa',

        // NILAI AKHIR SAW
        'nilai',

        // RANKING HASIL SAW
        'ranking',

        // KELAS HASIL PEMBAGIAN
        'kelas',

        // PERIODE / TAHUN AJARAN
        'periode',
    ];

    // =========================
    // CAST DATA
    // =========================
    protected $casts = [
        'nilai' => 'decimal:4',
        'ranking' => 'integer',
    ];

    // =========================
    // RELASI KE SISWA
    // =========================
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}