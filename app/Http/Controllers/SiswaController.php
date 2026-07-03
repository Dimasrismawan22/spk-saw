<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    // =====================================================
    // HALAMAN DATA SISWA
    // =====================================================
    public function index()
    {
        // DATA TERBARU DI ATAS
        $siswa = Siswa::latest()->get();

        return view('siswa.index', compact('siswa'));
    }

    // =====================================================
    // SIMPAN DATA SISWA
    // =====================================================
    public function store(Request $request)
    {
        // =========================
        // VALIDASI
        // =========================
        $validated = $request->validate([

            // DATA SISWA
            'nama' => 'required|string|max:100',

            // NISN
            'nisn' => 'required|digits:10|unique:siswa,nisn',

            // NILAI RAPORT
            'rata_rata_raport' => 'required|numeric|min:0|max:100',

            // NILAI TES
            'tes_matematika' => 'required|numeric|min:0|max:100',

            'tes_ipa' => 'required|numeric|min:0|max:100',

            'tes_ips' => 'required|numeric|min:0|max:100',

        ], [

            // CUSTOM MESSAGE NISN
            'nisn.required' => 'NISN wajib diisi.',

            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',

            'nisn.unique' => 'NISN sudah digunakan.',

            // CUSTOM MESSAGE TES
            'tes_matematika.required' => 'Nilai tes Matematika wajib diisi.',
            'tes_matematika.numeric' => 'Nilai tes Matematika harus berupa angka.',
            'tes_matematika.min' => 'Nilai tes Matematika minimal 0.',
            'tes_matematika.max' => 'Nilai tes Matematika maksimal 100.',

            'tes_ipa.required' => 'Nilai tes IPA wajib diisi.',
            'tes_ipa.numeric' => 'Nilai tes IPA harus berupa angka.',
            'tes_ipa.min' => 'Nilai tes IPA minimal 0.',
            'tes_ipa.max' => 'Nilai tes IPA maksimal 100.',

            'tes_ips.required' => 'Nilai tes IPS wajib diisi.',
            'tes_ips.numeric' => 'Nilai tes IPS harus berupa angka.',
            'tes_ips.min' => 'Nilai tes IPS minimal 0.',
            'tes_ips.max' => 'Nilai tes IPS maksimal 100.',

        ]);

        // =========================
        // SIMPAN DATA
        // =========================
        Siswa::create($validated);

        // =========================
        // REDIRECT
        // =========================
        return redirect('/siswa')
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    // =====================================================
    // FORM EDIT
    // =====================================================
    public function edit($id)
    {
        // CARI DATA SISWA
        $siswa = Siswa::findOrFail($id);

        // TAMPILKAN VIEW
        return view('siswa.edit', compact('siswa'));
    }

    // =====================================================
    // UPDATE DATA
    // =====================================================
    public function update(Request $request, $id)
    {
        // CARI SISWA
        $siswa = Siswa::findOrFail($id);

        // =========================
        // VALIDASI
        // =========================
        $validated = $request->validate([

            // DATA SISWA
            'nama' => 'required|string|max:100',

            // NISN
            'nisn' => 'required|digits:10|unique:siswa,nisn,' . $id,

            // NILAI RAPORT
            'rata_rata_raport' => 'required|numeric|min:0|max:100',

            // NILAI TES
            'tes_matematika' => 'required|numeric|min:0|max:100',

            'tes_ipa' => 'required|numeric|min:0|max:100',

            'tes_ips' => 'required|numeric|min:0|max:100',

        ], [

            // CUSTOM MESSAGE NISN
            'nisn.required' => 'NISN wajib diisi.',

            'nisn.digits' => 'NISN harus terdiri dari 10 digit angka.',

            'nisn.unique' => 'NISN sudah digunakan.',

            // CUSTOM MESSAGE TES
            'tes_matematika.required' => 'Nilai tes Matematika wajib diisi.',
            'tes_matematika.numeric' => 'Nilai tes Matematika harus berupa angka.',
            'tes_matematika.min' => 'Nilai tes Matematika minimal 0.',
            'tes_matematika.max' => 'Nilai tes Matematika maksimal 100.',

            'tes_ipa.required' => 'Nilai tes IPA wajib diisi.',
            'tes_ipa.numeric' => 'Nilai tes IPA harus berupa angka.',
            'tes_ipa.min' => 'Nilai tes IPA minimal 0.',
            'tes_ipa.max' => 'Nilai tes IPA maksimal 100.',

            'tes_ips.required' => 'Nilai tes IPS wajib diisi.',
            'tes_ips.numeric' => 'Nilai tes IPS harus berupa angka.',
            'tes_ips.min' => 'Nilai tes IPS minimal 0.',
            'tes_ips.max' => 'Nilai tes IPS maksimal 100.',

        ]);

        // =========================
        // UPDATE DATA
        // =========================
        $siswa->update($validated);

        // =========================
        // REDIRECT
        // =========================
        return redirect('/siswa')
            ->with('success', 'Data siswa berhasil diperbarui');
    }

    // =====================================================
    // HAPUS DATA SISWA PER ID
    // =====================================================
    public function destroy($id)
    {
        // CARI SISWA
        $siswa = Siswa::findOrFail($id);

        // HAPUS DATA
        $siswa->delete();

        // REDIRECT
        return redirect('/siswa')
            ->with('success', 'Data siswa berhasil dihapus');
    }

    // =====================================================
    // HAPUS SEMUA DATA SISWA
    // =====================================================
    public function destroyAll()
    {
        // =========================
        // HAPUS SEMUA DATA SISWA
        // =========================
        // Catatan:
        // - Data prestasi milik siswa akan ikut terhapus
        //   karena relasi prestasi menggunakan onDelete cascade.
        //
        // - Data riwayat hasil SAW tetap aman
        //   karena tabel hasil sudah menggunakan nullOnDelete
        //   dan menyimpan nama_siswa secara terpisah.
        Siswa::query()->delete();

        // =========================
        // REDIRECT
        // =========================
        return redirect('/siswa')
            ->with('success', 'Semua data siswa berhasil dihapus.');
    }
}