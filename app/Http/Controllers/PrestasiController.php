<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Prestasi;
use App\Models\Siswa;

class PrestasiController extends Controller
{
    // =====================================================
    // HALAMAN PRESTASI
    // =====================================================
    public function index()
    {
        // Ambil ID siswa yang sudah memiliki data prestasi
        // agar tidak muncul lagi di dropdown tambah prestasi
        $siswaSudahMemilikiPrestasi = Prestasi::whereNotNull('siswa_id')
            ->pluck('siswa_id')
            ->unique();

        return view('prestasi.index', [

            // DATA SISWA YANG BELUM MEMILIKI PRESTASI
            'siswa' => Siswa::whereNotIn('id', $siswaSudahMemilikiPrestasi)
                ->latest()
                ->get(),

            // DATA PRESTASI
            'prestasi' => Prestasi::with('siswa')
                ->latest()
                ->get(),
        ]);
    }

    // =====================================================
    // SIMPAN PRESTASI
    // =====================================================
    public function store(Request $request)
    {
        // =========================
        // BATAS TAHUN PRESTASI
        // =========================
        $tahunSekarang = date('Y');

        // =========================
        // VALIDASI
        // =========================
        $validated = $request->validate([

            // SISWA
            // Satu siswa hanya boleh memiliki satu data prestasi
            'siswa_id' => [
                'required',
                'exists:siswa,id',
                Rule::unique('prestasi', 'siswa_id'),
            ],

            // NAMA PRESTASI
            'nama_prestasi' => 'required|string|max:255',

            // TINGKAT PRESTASI
            'tingkat' => 'required|in:kabupaten,provinsi,nasional,internasional',

            // TAHUN PRESTASI
            // hanya angka, minimal 2020, maksimal tahun berjalan
            'tahun_prestasi' => 'nullable|integer|min:2020|max:' . $tahunSekarang,

            // KETERANGAN
            'keterangan' => 'nullable|string',

        ], [

            // SISWA
            'siswa_id.required' => 'Nama siswa wajib dipilih.',
            'siswa_id.exists' => 'Data siswa tidak ditemukan.',
            'siswa_id.unique' => 'Siswa ini sudah memiliki data prestasi. Silakan ubah data prestasi yang sudah ada.',

            // NAMA PRESTASI
            'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
            'nama_prestasi.max' => 'Nama prestasi maksimal 255 karakter.',

            // TINGKAT PRESTASI
            'tingkat.required' => 'Tingkat prestasi wajib dipilih.',
            'tingkat.in' => 'Tingkat prestasi tidak valid.',

            // TAHUN PRESTASI
            'tahun_prestasi.integer' => 'Tahun prestasi hanya boleh berisi angka.',
            'tahun_prestasi.min' => 'Tahun prestasi minimal tahun 2020.',
            'tahun_prestasi.max' => 'Tahun prestasi tidak boleh melebihi tahun berjalan.',
        ]);

        // =========================
        // KONVERSI NILAI PRESTASI
        // =========================
        $nilaiPrestasi = match ($validated['tingkat']) {

            'kabupaten' => 30,

            'provinsi' => 50,

            'nasional' => 80,

            'internasional' => 100,
        };

        // =========================
        // SIMPAN DATA
        // =========================
        Prestasi::create([

            'siswa_id' => $validated['siswa_id'],

            'nama_prestasi' => $validated['nama_prestasi'],

            'tingkat' => $validated['tingkat'],

            // NILAI OTOMATIS
            'nilai' => $nilaiPrestasi,

            'tahun_prestasi' =>
                isset($validated['tahun_prestasi'])
                    ? (int) $validated['tahun_prestasi']
                    : null,

            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        // =========================
        // REDIRECT
        // =========================
        return redirect('/prestasi')
            ->with('success', 'Prestasi berhasil ditambahkan');
    }

    // =====================================================
    // FORM UBAH PRESTASI
    // =====================================================
    public function edit($id)
    {
        // CARI DATA PRESTASI
        $prestasi = Prestasi::findOrFail($id);

        // Ambil ID siswa yang sudah dipakai oleh data prestasi lain
        // agar saat ubah data, siswa lain yang sudah punya prestasi
        // tidak bisa dipilih lagi.
        //
        // Catatan:
        // siswa pada data prestasi yang sedang diubah tetap ditampilkan.
        $siswaYangDipakaiPrestasiLain = Prestasi::where('id', '!=', $prestasi->id)
            ->whereNotNull('siswa_id')
            ->pluck('siswa_id')
            ->unique();

        // DATA SISWA
        $siswa = Siswa::whereNotIn('id', $siswaYangDipakaiPrestasiLain)
            ->latest()
            ->get();

        // TAMPILKAN VIEW
        return view('prestasi.edit', compact(
            'prestasi',
            'siswa'
        ));
    }

    // =====================================================
    // PERBARUI PRESTASI
    // =====================================================
    public function update(Request $request, $id)
    {
        // CARI PRESTASI
        $prestasi = Prestasi::findOrFail($id);

        // =========================
        // BATAS TAHUN PRESTASI
        // =========================
        $tahunSekarang = date('Y');

        // =========================
        // VALIDASI
        // =========================
        $validated = $request->validate([

            // SISWA
            // Boleh tetap memakai siswa pada data prestasi yang sedang diubah,
            // tetapi tidak boleh memilih siswa yang sudah dipakai data prestasi lain.
            'siswa_id' => [
                'required',
                'exists:siswa,id',
                Rule::unique('prestasi', 'siswa_id')->ignore($prestasi->id),
            ],

            // NAMA PRESTASI
            'nama_prestasi' => 'required|string|max:255',

            // TINGKAT PRESTASI
            'tingkat' => 'required|in:kabupaten,provinsi,nasional,internasional',

            // TAHUN PRESTASI
            // hanya angka, minimal 2020, maksimal tahun berjalan
            'tahun_prestasi' => 'nullable|integer|min:2020|max:' . $tahunSekarang,

            // KETERANGAN
            'keterangan' => 'nullable|string',

        ], [

            // SISWA
            'siswa_id.required' => 'Nama siswa wajib dipilih.',
            'siswa_id.exists' => 'Data siswa tidak ditemukan.',
            'siswa_id.unique' => 'Siswa ini sudah memiliki data prestasi. Silakan pilih siswa lain.',

            // NAMA PRESTASI
            'nama_prestasi.required' => 'Nama prestasi wajib diisi.',
            'nama_prestasi.max' => 'Nama prestasi maksimal 255 karakter.',

            // TINGKAT PRESTASI
            'tingkat.required' => 'Tingkat prestasi wajib dipilih.',
            'tingkat.in' => 'Tingkat prestasi tidak valid.',

            // TAHUN PRESTASI
            'tahun_prestasi.integer' => 'Tahun prestasi hanya boleh berisi angka.',
            'tahun_prestasi.min' => 'Tahun prestasi minimal tahun 2020.',
            'tahun_prestasi.max' => 'Tahun prestasi tidak boleh melebihi tahun berjalan.',
        ]);

        // =========================
        // KONVERSI NILAI PRESTASI
        // =========================
        $nilaiPrestasi = match ($validated['tingkat']) {

            'kabupaten' => 30,

            'provinsi' => 50,

            'nasional' => 80,

            'internasional' => 100,
        };

        // =========================
        // PERBARUI DATA
        // =========================
        $prestasi->update([

            'siswa_id' => $validated['siswa_id'],

            'nama_prestasi' => $validated['nama_prestasi'],

            'tingkat' => $validated['tingkat'],

            // PERBARUI NILAI OTOMATIS
            'nilai' => $nilaiPrestasi,

            'tahun_prestasi' =>
                isset($validated['tahun_prestasi'])
                    ? (int) $validated['tahun_prestasi']
                    : null,

            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        // =========================
        // REDIRECT
        // =========================
        return redirect('/prestasi')
            ->with('success', 'Prestasi berhasil diperbarui');
    }

    // =====================================================
    // HAPUS PRESTASI PER ID
    // =====================================================
    public function destroy($id)
    {
        // CARI DATA
        $prestasi = Prestasi::findOrFail($id);

        // HAPUS DATA
        $prestasi->delete();

        // REDIRECT
        return redirect('/prestasi')
            ->with('success', 'Prestasi berhasil dihapus');
    }

    // =====================================================
    // HAPUS SEMUA DATA PRESTASI
    // =====================================================
    public function destroyAll()
    {
        // HAPUS SEMUA DATA PRESTASI
        Prestasi::query()->delete();

        // REDIRECT
        return redirect('/prestasi')
            ->with('success', 'Semua data prestasi berhasil dihapus.');
    }
}