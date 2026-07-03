<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    // =========================
    // NAMA TABEL
    // =========================
    protected $table = 'kriteria';

    // =========================
    // FIELD YANG BOLEH DIISI
    // =========================
    protected $fillable = [

        // KODE KRITERIA
        'kode_kriteria',

        // NAMA KRITERIA
        'nama_kriteria',

        // benefit / cost
        'atribut',

        // BOBOT SAW
        'bobot',

        // KETERANGAN
        'keterangan',
    ];
}