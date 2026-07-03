<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Hasil;

class SawController extends Controller
{
    /**
     * =====================================================
     * AMBIL PENGATURAN KELAS DARI REQUEST
     * =====================================================
     */
    private function getPengaturanKelas(Request $request)
    {
        $validated = $request->validate([
            'jumlah_kelas' => 'nullable|integer|min:1|max:100',
            'maksimal_siswa_per_kelas' => 'nullable|integer|min:1|max:100',
        ], [
            'jumlah_kelas.integer' => 'Jumlah kelas harus berupa angka.',
            'jumlah_kelas.min' => 'Jumlah kelas minimal 1.',
            'jumlah_kelas.max' => 'Jumlah kelas maksimal 100.',

            'maksimal_siswa_per_kelas.integer' => 'Maksimal siswa per kelas harus berupa angka.',
            'maksimal_siswa_per_kelas.min' => 'Maksimal siswa per kelas minimal 1.',
            'maksimal_siswa_per_kelas.max' => 'Maksimal siswa per kelas maksimal 100.',
        ]);

        return [
            'jumlah_kelas' => (int) ($validated['jumlah_kelas'] ?? 10),
            'maksimal_siswa_per_kelas' => (int) ($validated['maksimal_siswa_per_kelas'] ?? 32),
        ];
    }

    /**
     * =====================================================
     * GENERATE NAMA KELAS
     * =====================================================
     * Contoh:
     * 1  = A
     * 2  = B
     * 26 = Z
     * 27 = AA
     * 28 = AB
     */
    private function generateKelasList(int $jumlahKelas)
    {
        $kelasList = [];

        for ($i = 1; $i <= $jumlahKelas; $i++) {
            $kelasList[] = $this->numberToClassName($i);
        }

        return $kelasList;
    }

    /**
     * =====================================================
     * KONVERSI ANGKA KE NAMA KELAS
     * =====================================================
     */
    private function numberToClassName(int $number)
    {
        $name = '';

        while ($number > 0) {

            $number--;

            $name = chr(65 + ($number % 26)) . $name;

            $number = intdiv($number, 26);
        }

        return $name;
    }

    /**
     * =====================================================
     * PEMBAGIAN KELAS ZIG-ZAG DINAMIS
     * =====================================================
     */
    private function bagiKelasZigZag(array $ranking, array $kelasList, int $maksimalSiswaPerKelas)
    {
        $kelasCounter = [];

        foreach ($kelasList as $kelas) {
            $kelasCounter[$kelas] = 0;
        }

        $indexRanking = 0;

        $putaran = 0;

        while ($indexRanking < count($ranking)) {

            if ($putaran % 2 == 0) {

                $urutanKelas = $kelasList;

            } else {

                $urutanKelas = array_reverse($kelasList);
            }

            foreach ($urutanKelas as $kelas) {

                if ($indexRanking >= count($ranking)) {
                    break;
                }

                if ($kelasCounter[$kelas] >= $maksimalSiswaPerKelas) {
                    continue;
                }

                $ranking[$indexRanking]['kelas'] = $kelas;

                $kelasCounter[$kelas]++;

                $indexRanking++;
            }

            $putaran++;
        }

        return $ranking;
    }

    /**
     * =====================================================
     * FUNGSI UTAMA HITUNG SAW
     * =====================================================
     */
    private function hitungSaw(
        int $jumlahKelas = 10,
        int $maksimalSiswaPerKelas = 32
    ) {
        // =====================================================
        // AMBIL SEMUA DATA SISWA + PRESTASI
        // =====================================================
        $siswa = Siswa::with('prestasi')
            ->get();

        $matriks = [];

        $kelasList = $this->generateKelasList($jumlahKelas);

        $kapasitasKelas = $jumlahKelas * $maksimalSiswaPerKelas;

        // =====================================================
        // 1. HITUNG NILAI KRITERIA
        // =====================================================
        foreach ($siswa as $s) {

            // =================================================
            // C1 - NILAI AKADEMIK
            // Nilai rata-rata raport
            // Atribut: benefit
            // =================================================
            $raport = $s->rata_rata_raport ?? 0;

            $raport = min(
                max((float) $raport, 0),
                100
            );

            // =================================================
            // C2 - NILAI TES
            // Rata-rata nilai tes:
            // Matematika, IPA, IPS
            // Atribut: benefit
            // =================================================
            $tes = (
                (($s->tes_matematika ?? 0) +
                ($s->tes_ipa ?? 0) +
                ($s->tes_ips ?? 0)) / 3
            );

            $tes = min(
                max((float) $tes, 0),
                100
            );

            // =================================================
            // C3 - PRESTASI
            //
            // User tetap hanya memilih 1 tingkat prestasi
            // pada setiap input data prestasi.
            //
            // Nilai prestasi:
            // Kabupaten     = 30
            // Provinsi      = 50
            // Nasional      = 80
            // Internasional = 100
            //
            // Jika dalam database terdapat lebih dari satu
            // data prestasi untuk siswa yang sama, maka sistem
            // mengambil nilai prestasi tertinggi sebagai C3.
            //
            // Atribut: benefit
            // =================================================
            $prestasiRaw = $s->prestasi->max('nilai') ?? 0;

            $prestasi = min(
                max((float) $prestasiRaw, 0),
                100
            );

            // =================================================
            // SIMPAN KE MATRIKS KEPUTUSAN
            // =================================================
            $matriks[$s->id] = [
                'raport' => $raport,
                'tes' => $tes,
                'prestasi' => $prestasi,
            ];
        }

        // =====================================================
        // JIKA DATA KOSONG
        // =====================================================
        if (empty($matriks)) {
            return [
                'siswa' => $siswa,
                'matriks' => [],
                'normalisasi' => [],
                'ranking' => [],
                'kelasGrouped' => [],

                'jumlahKelas' => $jumlahKelas,
                'maksimalSiswaPerKelas' => $maksimalSiswaPerKelas,
                'kelasList' => $kelasList,
                'totalSiswa' => 0,
                'kapasitasKelas' => $kapasitasKelas,
                'kapasitasCukup' => true,
                'pesanKapasitas' => null,
            ];
        }

        // =====================================================
        // 2. NORMALISASI METODE SAW
        // =====================================================
        // Semua kriteria bersifat benefit.
        //
        // Rumus benefit:
        // Rij = Xij / Max(Xj)
        //
        // C1 = raport / nilai raport tertinggi
        // C2 = tes / nilai tes tertinggi
        // C3 = prestasi / nilai prestasi tertinggi
        // =====================================================
        $maxRaport = max(array_column($matriks, 'raport'));

        $maxTes = max(array_column($matriks, 'tes'));

        $maxPrestasi = max(array_column($matriks, 'prestasi'));

        $normalisasi = [];

        foreach ($matriks as $id => $nilai) {

            $normalisasi[$id] = [

                // C1 - Benefit
                'raport' =>
                    $maxRaport > 0
                        ? $nilai['raport'] / $maxRaport
                        : 0,

                // C2 - Benefit
                'tes' =>
                    $maxTes > 0
                        ? $nilai['tes'] / $maxTes
                        : 0,

                // C3 - Benefit
                'prestasi' =>
                    $maxPrestasi > 0
                        ? $nilai['prestasi'] / $maxPrestasi
                        : 0,
            ];
        }

        // =====================================================
        // 3. BOBOT KRITERIA
        // =====================================================
        $bobot = [

            // C1 - Nilai Akademik / Rata-rata Raport
            'raport' => 0.3,

            // C2 - Nilai Tes
            'tes' => 0.5,

            // C3 - Prestasi Non Akademik
            'prestasi' => 0.2,
        ];

        // =====================================================
        // 4. HITUNG NILAI AKHIR SAW
        // =====================================================
        // Vi = (R1 x W1) + (R2 x W2) + (R3 x W3)
        // =====================================================
        $hasil = [];

        foreach ($normalisasi as $id => $nilai) {

            $hasil[$id] =
                ($nilai['raport'] * $bobot['raport']) +
                ($nilai['tes'] * $bobot['tes']) +
                ($nilai['prestasi'] * $bobot['prestasi']);
        }

        // =====================================================
        // 5. SORTING NILAI TERBESAR
        // =====================================================
        arsort($hasil);

        // =====================================================
        // 6. RANKING
        // =====================================================
        $ranking = [];

        $no = 1;

        foreach ($hasil as $id => $nilai) {

            $dataSiswa = $siswa->find($id);

            if (!$dataSiswa) {
                continue;
            }

            $ranking[] = [
                'siswa_id' => $dataSiswa->id,
                'ranking' => $no++,
                'nama' => $dataSiswa->nama,
                'nilai' => round($nilai, 4),
                'kelas' => '-',
            ];
        }

        // =====================================================
        // 7. CEK KAPASITAS KELAS
        // =====================================================
        $kapasitasCukup = $kapasitasKelas >= count($ranking);

        $pesanKapasitas = null;

        if (!$kapasitasCukup) {

            $pesanKapasitas =
                'Kapasitas kelas tidak mencukupi. ' .
                'Jumlah siswa: ' . count($ranking) . ', ' .
                'kapasitas tersedia: ' . $kapasitasKelas . '. ' .
                'Silakan tambah jumlah kelas atau tambah maksimal siswa per kelas.';

            return [
                'siswa' => $siswa,
                'matriks' => $matriks,
                'normalisasi' => $normalisasi,
                'ranking' => $ranking,
                'kelasGrouped' => [],

                'jumlahKelas' => $jumlahKelas,
                'maksimalSiswaPerKelas' => $maksimalSiswaPerKelas,
                'kelasList' => $kelasList,
                'totalSiswa' => count($ranking),
                'kapasitasKelas' => $kapasitasKelas,
                'kapasitasCukup' => false,
                'pesanKapasitas' => $pesanKapasitas,
            ];
        }

        // =====================================================
        // 8. PEMBAGIAN KELAS ZIG-ZAG DINAMIS
        // =====================================================
        $ranking = $this->bagiKelasZigZag(
            $ranking,
            $kelasList,
            $maksimalSiswaPerKelas
        );

        // =====================================================
        // 9. GROUPING PER KELAS
        // =====================================================
        $kelasGrouped = [];

        foreach ($ranking as $r) {

            if (!isset($kelasGrouped[$r['kelas']])) {
                $kelasGrouped[$r['kelas']] = [];
            }

            $kelasGrouped[$r['kelas']][] = $r;
        }

        return [
            'siswa' => $siswa,
            'matriks' => $matriks,
            'normalisasi' => $normalisasi,
            'ranking' => $ranking,
            'kelasGrouped' => $kelasGrouped,

            'jumlahKelas' => $jumlahKelas,
            'maksimalSiswaPerKelas' => $maksimalSiswaPerKelas,
            'kelasList' => $kelasList,
            'totalSiswa' => count($ranking),
            'kapasitasKelas' => $kapasitasKelas,
            'kapasitasCukup' => true,
            'pesanKapasitas' => null,
        ];
    }

    /**
     * =====================================================
     * HALAMAN HASIL PERHITUNGAN
     * =====================================================
     */
    public function index(Request $request)
    {
        $pengaturan = $this->getPengaturanKelas($request);

        $data = $this->hitungSaw(
            $pengaturan['jumlah_kelas'],
            $pengaturan['maksimal_siswa_per_kelas']
        );

        if (!$data['kapasitasCukup']) {
            session()->flash('error', $data['pesanKapasitas']);
        }

        return view('saw.index', $data);
    }

    /**
     * =====================================================
     * SIMPAN HASIL PERHITUNGAN KE RIWAYAT
     * =====================================================
     */
    public function simpanHasil(Request $request)
    {
        // =====================================================
        // VALIDASI
        // =====================================================
        $validated = $request->validate([
            'periode' => [
                'required',
                'string',
                'max:9',
                'regex:/^[0-9]{4}\/[0-9]{4}$/',
                function ($attribute, $value, $fail) {

                    if (!preg_match('/^[0-9]{4}\/[0-9]{4}$/', $value)) {
                        return;
                    }

                    [$tahunAwal, $tahunAkhir] = explode('/', $value);

                    if ((int) $tahunAkhir !== ((int) $tahunAwal + 1)) {
                        $fail('Periode tahun ajaran harus berurutan. Contoh yang benar: 2025/2026.');
                    }
                },
            ],

            'jumlah_kelas' => 'nullable|integer|min:1|max:100',

            'maksimal_siswa_per_kelas' => 'nullable|integer|min:1|max:100',
        ], [
            'periode.required' => 'Periode tahun ajaran wajib diisi.',
            'periode.max' => 'Periode tahun ajaran maksimal 9 karakter. Contoh: 2025/2026.',
            'periode.regex' => 'Format periode tahun ajaran harus seperti 2025/2026.',

            'jumlah_kelas.integer' => 'Jumlah kelas harus berupa angka.',
            'jumlah_kelas.min' => 'Jumlah kelas minimal 1.',
            'jumlah_kelas.max' => 'Jumlah kelas maksimal 100.',

            'maksimal_siswa_per_kelas.integer' => 'Maksimal siswa per kelas harus berupa angka.',
            'maksimal_siswa_per_kelas.min' => 'Maksimal siswa per kelas minimal 1.',
            'maksimal_siswa_per_kelas.max' => 'Maksimal siswa per kelas maksimal 100.',
        ]);

        $jumlahKelas = (int) ($validated['jumlah_kelas'] ?? 10);

        $maksimalSiswaPerKelas = (int) ($validated['maksimal_siswa_per_kelas'] ?? 32);

        $periode = trim($validated['periode']);

        // =====================================================
        // HITUNG HASIL TERBARU
        // =====================================================
        $data = $this->hitungSaw(
            $jumlahKelas,
            $maksimalSiswaPerKelas
        );

        if (empty($data['ranking'])) {
            return redirect('/saw')
                ->with('error', 'Belum ada data hasil perhitungan yang dapat disimpan.');
        }

        if (!$data['kapasitasCukup']) {

            $query = http_build_query([
                'jumlah_kelas' => $jumlahKelas,
                'maksimal_siswa_per_kelas' => $maksimalSiswaPerKelas,
                'periode' => $periode,
            ]);

            return redirect('/saw?' . $query)
                ->with('error', $data['pesanKapasitas']);
        }

        // =====================================================
        // HAPUS HASIL LAMA PADA PERIODE YANG SAMA
        // SUPAYA TIDAK DOBEL
        // =====================================================
        Hasil::where('periode', $periode)->delete();

        // =====================================================
        // SIMPAN HASIL BARU
        // =====================================================
        foreach ($data['ranking'] as $r) {

            Hasil::create([
                'siswa_id' => $r['siswa_id'],

                // NAMA SISWA DISIMPAN DI RIWAYAT
                // agar tetap tampil walaupun data siswa dihapus
                'nama_siswa' => $r['nama'],

                'nilai' => $r['nilai'],
                'ranking' => $r['ranking'],
                'kelas' => $r['kelas'],
                'periode' => $periode,
            ]);
        }

        return redirect('/hasil')
            ->with('success', 'Hasil pembagian kelas berhasil disimpan ke riwayat.');
    }
}