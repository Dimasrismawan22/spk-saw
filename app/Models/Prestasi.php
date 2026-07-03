<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    // =========================
    // NAMA TABEL
    // =========================
    protected $table = 'prestasi';

    // =========================
    // FIELD YANG BOLEH DIISI
    // =========================
    protected $fillable = [

        // RELASI SISWA
        'siswa_id',

        // NAMA PRESTASI
        'nama_prestasi',

        // TINGKAT PRESTASI
        'tingkat',

        // NILAI PRESTASI
        'nilai',

        // TAHUN PRESTASI
        'tahun_prestasi',

        // KETERANGAN
        'keterangan',
    ];

    // =========================
    // RELASI KE SISWA
    // =========================
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    // =========================
    // GET LABEL TINGKAT
    // =========================
    public function getLabelTingkatAttribute()
    {
        return ucfirst($this->tingkat);
    }

    // =========================
    // GET WARNA BADGE
    // =========================
    public function getBadgeColorAttribute()
    {
        return match ($this->tingkat) {

            'kabupaten' => 'primary',

            'provinsi' => 'success',

            'nasional' => 'warning',

            'internasional' => 'danger',

            default => 'secondary',
        };
    }
}