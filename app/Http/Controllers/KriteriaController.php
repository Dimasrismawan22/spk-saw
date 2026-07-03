<?php

namespace App\Http\Controllers;

class KriteriaController extends Controller
{
    public function index()
    {
        // =========================
        // KRITERIA SAW
        // =========================
        $kriteria = [

            [
                'kode' => 'C1',

                'nama_kriteria' =>
                    'Nilai Akademik (Rata-Rata Raport)',

                'atribut' => 'benefit',

                'bobot' => 0.30,

                'keterangan' =>
                    'Nilai rata-rata raport siswa. Normalisasi benefit menggunakan rumus nilai raport siswa dibagi nilai raport tertinggi.',
            ],

            [
                'kode' => 'C2',

                'nama_kriteria' =>
                    'Nilai Tes',

                'atribut' => 'benefit',

                'bobot' => 0.50,

                'keterangan' =>
                    'Nilai tes dihitung dari rata-rata tes Matematika, IPA, dan IPS. Normalisasi benefit menggunakan rumus nilai tes siswa dibagi nilai tes tertinggi.',
            ],

            [
                'kode' => 'C3',

                'nama_kriteria' =>
                    'Prestasi Non Akademik',

                'atribut' => 'benefit',

                'bobot' => 0.20,

                'keterangan' =>
                    'Prestasi siswa dikonversi berdasarkan tingkat prestasi: kabupaten 30, provinsi 50, nasional 80, dan internasional 100. Jika terdapat lebih dari satu data prestasi pada siswa yang sama, maka nilai yang digunakan adalah nilai prestasi tertinggi.',
            ],
        ];

        // =========================
        // RUMUS SAW
        // =========================
        $rumusSaw = [

            'normalisasi' =>
                'Rij = Xij / Max(Xj)',

            'nilai_akhir' =>
                'Vi = (R1 x 0.30) + (R2 x 0.50) + (R3 x 0.20)',

            'keterangan' =>
                'Semua kriteria bersifat benefit, sehingga semakin tinggi nilai maka semakin baik.',
        ];

        // =========================
        // TOTAL BOBOT
        // =========================
        $totalBobot = collect($kriteria)->sum('bobot');

        return view('kriteria.index', compact(
            'kriteria',
            'totalBobot',
            'rumusSaw'
        ));
    }
}