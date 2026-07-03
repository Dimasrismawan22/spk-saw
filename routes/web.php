<?php

use Illuminate\Support\Facades\Route;

// ==========================
// IMPORT CONTROLLER
// ==========================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\HasilController;

// =====================================================
// AUTH / LOGIN
// =====================================================

// HALAMAN LOGIN
Route::get('/login', [
    AuthController::class,
    'showLoginForm'
])->name('login');

// PROSES LOGIN
Route::post('/login', [
    AuthController::class,
    'login'
]);

// LOGOUT
Route::post('/logout', [
    AuthController::class,
    'logout'
])->middleware('auth');

// =====================================================
// ROUTE YANG WAJIB LOGIN
// =====================================================
Route::middleware('auth')->group(function () {

    // ==========================
    // HALAMAN AWAL
    // ==========================
    Route::get('/', function () {
        return redirect('/siswa');
    });

    // =====================================================
    // DATA SISWA
    // =====================================================

    // HALAMAN DATA SISWA
    Route::get('/siswa', [
        SiswaController::class,
        'index'
    ]);

    // SIMPAN DATA SISWA
    Route::post('/siswa/store', [
        SiswaController::class,
        'store'
    ]);

    // FORM EDIT SISWA
    Route::get('/siswa/edit/{id}', [
        SiswaController::class,
        'edit'
    ]);

    // UPDATE SISWA
    Route::put('/siswa/update/{id}', [
        SiswaController::class,
        'update'
    ]);

    // HAPUS SEMUA DATA SISWA
    Route::delete('/siswa/delete-all', [
        SiswaController::class,
        'destroyAll'
    ]);

    // HAPUS SISWA PER ID
    Route::get('/siswa/delete/{id}', [
        SiswaController::class,
        'destroy'
    ]);

    // =====================================================
    // DATA PRESTASI
    // =====================================================

    // HALAMAN PRESTASI
    Route::get('/prestasi', [
        PrestasiController::class,
        'index'
    ]);

    // SIMPAN PRESTASI
    Route::post('/prestasi/store', [
        PrestasiController::class,
        'store'
    ]);

    // FORM EDIT PRESTASI
    Route::get('/prestasi/edit/{id}', [
        PrestasiController::class,
        'edit'
    ]);

    // UPDATE PRESTASI
    Route::put('/prestasi/update/{id}', [
        PrestasiController::class,
        'update'
    ]);

    // HAPUS SEMUA DATA PRESTASI
    Route::delete('/prestasi/delete-all', [
        PrestasiController::class,
        'destroyAll'
    ]);

    // HAPUS PRESTASI PER ID
    Route::get('/prestasi/delete/{id}', [
        PrestasiController::class,
        'destroy'
    ]);

    // =====================================================
    // KRITERIA SAW
    // =====================================================

    // HALAMAN KRITERIA
    Route::get('/kriteria', [
        KriteriaController::class,
        'index'
    ]);

    // =====================================================
    // PERHITUNGAN SAW
    // =====================================================

    // HALAMAN HASIL PERHITUNGAN
    Route::get('/saw', [
        SawController::class,
        'index'
    ]);

    // SIMPAN HASIL PERHITUNGAN KE RIWAYAT
    Route::post('/saw/simpan', [
        SawController::class,
        'simpanHasil'
    ]);

    // =====================================================
    // RIWAYAT HASIL PEMBAGIAN KELAS
    // =====================================================

    // HALAMAN RIWAYAT HASIL
    Route::get('/hasil', [
        HasilController::class,
        'index'
    ]);

    // HAPUS RIWAYAT BERDASARKAN PERIODE
    // contoh:
    // /hasil/delete/2025/2026
    Route::delete('/hasil/delete/{periode}', [
        HasilController::class,
        'destroyByPeriode'
    ])->where('periode', '.*');

    // EKSPOR PDF RIWAYAT BERDASARKAN PERIODE
    // contoh:
    // /hasil/pdf/2025/2026
    Route::get('/hasil/pdf/{periode}', [
        HasilController::class,
        'exportPdf'
    ])->where('periode', '.*');

    // DETAIL RIWAYAT BERDASARKAN PERIODE
    // contoh:
    // /hasil/2025/2026
    Route::get('/hasil/{periode}', [
        HasilController::class,
        'show'
    ])->where('periode', '.*');

    // =====================================================
    // FALLBACK PAGE
    // =====================================================

    // JIKA URL TIDAK DITEMUKAN
    Route::fallback(function () {
        return redirect('/siswa');
    });
});