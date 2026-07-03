<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hasil;
use Barryvdh\DomPDF\Facade\Pdf;

class HasilController extends Controller
{
    // =====================================================
    // HALAMAN RIWAYAT HASIL PEMBAGIAN KELAS
    // =====================================================
    public function index(Request $request)
    {
        // =========================
        // AMBIL INPUT PENCARIAN
        // =========================
        $periodeInput = trim($request->input('periode', ''));

        // =========================
        // BERSIHKAN INPUT
        // HANYA ANGKA
        // =========================
        $periodeAngka = preg_replace('/[^0-9]/', '', $periodeInput);

        // BATASI MAKSIMAL 8 DIGIT ANGKA
        $periodeAngka = substr($periodeAngka, 0, 8);

        // =========================
        // FORMAT OTOMATIS
        // =========================
        if (strlen($periodeAngka) === 8) {

            $periodeCari =
                substr($periodeAngka, 0, 4) .
                '/' .
                substr($periodeAngka, 4, 4);

        } elseif (strlen($periodeAngka) === 4) {

            $periodeCari = $periodeAngka;

        } else {

            $periodeCari = '';
        }

        // =========================
        // QUERY DATA RIWAYAT
        // =========================
        $query = Hasil::with('siswa');

        // =========================
        // FILTER BERDASARKAN PERIODE
        // =========================
        if ($periodeCari !== '') {
            $query->where('periode', 'like', '%' . $periodeCari . '%');
        }

        // =========================
        // AMBIL DAN KELOMPOKKAN DATA
        // =========================
        $hasil = $query
            ->orderBy('periode', 'desc')
            ->orderBy('ranking', 'asc')
            ->get()
            ->groupBy('periode');

        return view('hasil.index', compact(
            'hasil',
            'periodeCari'
        ));
    }

    // =====================================================
    // DETAIL RIWAYAT BERDASARKAN PERIODE
    // =====================================================
    public function show($periode)
    {
        $periode = urldecode($periode);

        $hasil = Hasil::with('siswa')
            ->where('periode', $periode)
            ->orderBy('ranking', 'asc')
            ->get();

        $kelasGrouped = $hasil->groupBy('kelas');

        return view('hasil.show', compact(
            'hasil',
            'periode',
            'kelasGrouped'
        ));
    }

    // =====================================================
    // EKSPOR PDF RIWAYAT BERDASARKAN PERIODE
    // =====================================================
    public function exportPdf($periode)
    {
        $periode = urldecode($periode);

        $hasil = Hasil::with('siswa')
            ->where('periode', $periode)
            ->orderBy('ranking', 'asc')
            ->get();

        if ($hasil->isEmpty()) {
            return redirect('/hasil')
                ->with('error', 'Data riwayat periode ' . $periode . ' tidak ditemukan.');
        }

        // =========================
        // DATA PERINGKAT UNTUK PDF
        // =========================
        $ranking = $hasil->map(function ($h) {

            return [

                'nama' =>
                    $h->nama_siswa
                    ?? optional($h->siswa)->nama
                    ?? '-',

                'nilai' => (float) $h->nilai,

                'ranking' => (int) $h->ranking,

                'kelas' => $h->kelas,
            ];

        });

        // =========================
        // KELOMPOKKAN BERDASARKAN KELAS
        // =========================
        $kelasGrouped = $ranking
            ->groupBy('kelas')
            ->sortKeys();

        // =========================
        // INFORMASI TAMBAHAN PDF
        // =========================
        $totalSiswa = $ranking->count();

        $jumlahKelas = $kelasGrouped->count();

        // =========================
        // GENERATE PDF
        // =========================
        $pdf = Pdf::loadView('hasil.pdf', compact(
            'periode',
            'ranking',
            'kelasGrouped',
            'totalSiswa',
            'jumlahKelas'
        ))->setPaper('a4', 'portrait');

        // Nama file PDF
        // Contoh: laporan Hasil Riwayat 2022-2023.pdf
        $namaFile = 'laporan Hasil Riwayat ' . str_replace('/', '-', $periode) . '.pdf';

        return $pdf->download($namaFile);
    }

    // =====================================================
    // HAPUS RIWAYAT BERDASARKAN PERIODE
    // =====================================================
    public function destroyByPeriode($periode)
    {
        $periode = urldecode($periode);

        Hasil::where('periode', $periode)->delete();

        return redirect('/hasil')
            ->with('success', 'Riwayat periode ' . $periode . ' berhasil dihapus.');
    }
}