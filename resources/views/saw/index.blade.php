@extends('layouts.app')

@section('content')

@php
    // =========================
    // CEK APAKAH USER SUDAH MENGISI PENGATURAN
    // =========================
    $pengaturanSudahDiisi =
        request()->filled('jumlah_kelas') &&
        request()->filled('maksimal_siswa_per_kelas');

    $jumlahKelasValue =
        old('jumlah_kelas', request('jumlah_kelas'));

    $maksimalSiswaValue =
        old('maksimal_siswa_per_kelas', request('maksimal_siswa_per_kelas'));

    $periodeValue =
        old('periode', request('periode', '2025/2026'));

    $kapasitasCukupValue =
        $kapasitasCukup ?? true;

    $siswaMap = $siswa->keyBy('id');
@endphp

{{-- ========================= --}}
{{-- STYLE KHUSUS HALAMAN SAW --}}
{{-- ========================= --}}
<style>

    .saw-hero{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .saw-hero-icon{
        width: 60px;
        height: 60px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2563eb, #38bdf8);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.28);
    }

    .saw-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .saw-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .saw-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .saw-card-header-primary{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .saw-card-header-dark{
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .saw-card-header-success{
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .help-box-saw{
        background: #eff6ff;
        border-radius: 18px;
        padding: 16px 18px;
        color: #1e40af;
        font-weight: 500;
        border: 1px solid #dbeafe;
        margin-bottom: 20px;
    }

    .form-hint{
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
        margin-top: 6px;
    }

    .action-note{
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
        margin-top: 15px;
        display: block;
    }

    .saw-alert{
        border: 0;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    .bobot-box{
        background: #e0f2fe;
        color: #075985;
        border-radius: 20px;
        padding: 18px 20px;
        box-shadow: 0 8px 22px rgba(14, 165, 233, 0.08);
        border: 1px solid #bae6fd;
        margin-bottom: 24px;
    }

    .bobot-list{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 12px;
    }

    .bobot-pill{
        background: #ffffff;
        color: #075985;
        border-radius: 999px;
        padding: 8px 13px;
        font-weight: 800;
        border: 1px solid #bae6fd;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .saw-table{
        margin-bottom: 0;
    }

    .saw-table thead th{
        background: #f8fafc !important;
        color: #334155;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        font-weight: 800;
        padding: 15px 14px;
        border-bottom: 1px solid #e5e7eb !important;
        white-space: nowrap;
    }

    .saw-table tbody td{
        padding: 15px 14px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .saw-table tbody tr:hover{
        background: #f8fbff;
    }

    .student-name-saw{
        font-weight: 800;
        color: #0f172a;
    }

    .nilai-pill{
        background: #eff6ff;
        color: #2563eb;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .prestasi-pill{
        background: #fef3c7;
        color: #92400e;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .ranking-badge{
        background: #eef2ff;
        color: #3730a3;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
        min-width: 44px;
    }

    .ranking-first{
        background: #dcfce7;
        color: #166534;
    }

    .kelas-badge{
        background: #dbeafe;
        color: #1d4ed8;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .kelas-empty{
        background: #e2e8f0;
        color: #475569;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .kelas-warning{
        background: #fef3c7;
        color: #92400e;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .section-divider{
        margin: 35px 0 25px;
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
    }

    .section-heading{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.4px;
        margin-bottom: 20px;
        text-align: center;
    }

    .kelas-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .kelas-card-header{
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .kelas-title{
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kelas-info-group{
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .kelas-count{
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        padding: 7px 11px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 13px;
    }

    .empty-saw{
        background: #ffffff;
        border-radius: 22px;
        padding: 40px 25px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        text-align: center;
        border: 1px solid #eef2f7;
    }

    .empty-icon-saw{
        width: 68px;
        height: 68px;
        border-radius: 22px;
        background: #fef3c7;
        color: #92400e;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-bottom: 16px;
    }

    .btn-action-saw{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-weight: 800;
    }

    .scroll-target-saw{
        scroll-margin-top: 110px;
    }

    @media(max-width: 768px){

        .saw-hero{
            padding: 22px;
        }

        .saw-title{
            font-size: 24px;
        }

        .kelas-card-header{
            align-items: flex-start;
        }

        .btn-action-saw{
            width: 100%;
        }

    }

</style>

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="saw-hero">

    <div class="d-flex align-items-center gap-3">

        <div class="saw-hero-icon">

            <i class="bi bi-graph-up-arrow"></i>

        </div>

        <div>

            <h2 class="saw-title">
                Hasil Perhitungan
            </h2>

            <p class="saw-subtitle">
                Sistem Pendukung Keputusan Penempatan Kelas Siswa
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- NOTIFIKASI --}}
{{-- ========================= --}}
@if(session('success'))

    <div class="alert alert-success saw-alert">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="alert alert-danger saw-alert">

        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ session('error') }}

    </div>

@endif

{{-- ========================= --}}
{{-- ERROR VALIDASI --}}
{{-- ========================= --}}
@if ($errors->any())

    <div class="alert alert-danger saw-alert">

        <div class="fw-bold mb-2">

            <i class="bi bi-exclamation-triangle me-1"></i>
            Terjadi kesalahan masukan:

        </div>

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

{{-- ========================= --}}
{{-- PENGATURAN KELAS --}}
{{-- ========================= --}}
<div class="card mb-4 saw-card">

    <div class="card-header saw-card-header-primary">

        <i class="bi bi-sliders"></i>

        Pengaturan Pembagian Kelas

    </div>

    <div class="card-body">

        <div class="help-box-saw">

            <i class="bi bi-info-circle me-1"></i>

            Isi jumlah kelas dan maksimal siswa per kelas, lalu klik tombol Terapkan Pengaturan untuk menampilkan pembagian kelas.

        </div>

        <form action="/saw"
              method="GET">

            <input type="hidden"
                   name="scroll_to"
                   value="pembagian-kelas">

            <div class="row">

                {{-- JUMLAH KELAS --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Jumlah Kelas yang Digunakan
                    </label>

                    <input type="number"
                           name="jumlah_kelas"
                           class="form-control"
                           min="1"
                           max="100"
                           value="{{ $jumlahKelasValue }}"
                           placeholder="Contoh: 4"
                           required>

                    <div class="form-hint">
                        Contoh: 4 berarti kelas A, B, C, dan D.
                    </div>

                </div>

                {{-- MAKSIMAL SISWA --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Maksimal Siswa per Kelas
                    </label>

                    <input type="number"
                           name="maksimal_siswa_per_kelas"
                           class="form-control"
                           min="1"
                           max="100"
                           value="{{ $maksimalSiswaValue }}"
                           placeholder="Contoh: 32"
                           required>

                    <div class="form-hint">
                        Digunakan sebagai batas maksimal setiap kelas.
                    </div>

                </div>

                {{-- BUTTON --}}
                <div class="col-md-4 mb-3 d-flex align-items-end">

                    <button type="submit"
                            class="btn btn-primary w-100 btn-action-saw">

                        <i class="bi bi-check2-circle"></i>

                        Terapkan Pengaturan

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

{{-- ========================= --}}
{{-- AKSI HASIL PERHITUNGAN --}}
{{-- ========================= --}}
<div class="card mb-4 saw-card">

    <div class="card-header saw-card-header-dark">

        <i class="bi bi-gear"></i>

        Aksi Hasil Perhitungan

    </div>

    <div class="card-body">

        <form action="/saw/simpan"
              method="POST"
              onsubmit="return confirm('Yakin ingin menyimpan hasil pembagian kelas ke riwayat? Data pada periode yang sama akan diperbarui.')">

            @csrf

            <input type="hidden"
                   name="jumlah_kelas"
                   value="{{ $jumlahKelasValue }}">

            <input type="hidden"
                   name="maksimal_siswa_per_kelas"
                   value="{{ $maksimalSiswaValue }}">

            <div class="row align-items-end">

                <div class="col-md-6 mb-2">

                    <label class="form-label">
                        Periode Tahun Ajaran
                    </label>

                    <input type="text"
                           id="periodeInput"
                           name="periode"
                           class="form-control"
                           value="{{ $periodeValue }}"
                           placeholder="Contoh: 2025/2026"
                           maxlength="9"
                           pattern="[0-9]{4}/[0-9]{4}"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^([0-9]{4})([0-9]+)/, '$1/$2').slice(0, 9)"
                           required>

                    <small class="text-muted">
                        Format wajib: 2025/2026
                    </small>

                </div>

                <div class="col-md-6 mb-2 d-flex align-items-end">

                    <button type="submit"
                            class="btn btn-success btn-action-saw"
                            @if(
                                count($ranking) == 0 ||
                                !$pengaturanSudahDiisi ||
                                !$kapasitasCukupValue
                            )
                                disabled
                            @endif>

                        <i class="bi bi-save"></i>

                        Simpan Hasil

                    </button>

                </div>

            </div>

        </form>

        <small class="action-note">
            Tombol Simpan Hasil aktif setelah pengaturan pembagian kelas diterapkan.
        </small>

    </div>

</div>

{{-- ========================= --}}
{{-- INFORMASI JIKA BELUM ADA PENGATURAN --}}
{{-- ========================= --}}
@if(!$pengaturanSudahDiisi)

    <div class="alert alert-warning saw-alert text-center">

        <i class="bi bi-info-circle me-1"></i>

        Silakan isi jumlah kelas dan maksimal siswa per kelas terlebih dahulu
        untuk menampilkan hasil pembagian kelas.

    </div>

@endif

{{-- ========================= --}}
{{-- INFORMASI BOBOT --}}
{{-- ========================= --}}
<div class="bobot-box">

    <div class="fw-bold">

        <i class="bi bi-percent me-1"></i>

        Pembobotan Kriteria

    </div>

    <div class="bobot-list">

        <span class="bobot-pill">

            <i class="bi bi-journal-check"></i>

            Raport 30%

        </span>

        <span class="bobot-pill">

            <i class="bi bi-clipboard-data"></i>

            Tes 50%

        </span>

        <span class="bobot-pill">

            <i class="bi bi-trophy"></i>

            Prestasi 20%

        </span>

    </div>

</div>

{{-- ========================= --}}
{{-- 1. MATRIKS KEPUTUSAN --}}
{{-- ========================= --}}
<div class="card mb-4 saw-card">

    <div class="card-header saw-card-header-primary">

        <i class="bi bi-table"></i>

        Matriks Keputusan

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle saw-table">

            <thead>

                <tr>

                    <th class="text-start">Nama Siswa</th>

                    <th>Nilai Rata Rata Raport</th>

                    <th>Nilai Tes</th>

                    <th>Prestasi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($matriks as $id => $m)

                    <tr>

                        <td class="text-start">

                            <span class="student-name-saw">

                                {{ $siswaMap[$id]->nama ?? '-' }}

                            </span>

                        </td>

                        <td>

                            <span class="nilai-pill">

                                {{ number_format($m['raport'], 2) }}

                            </span>

                        </td>

                        <td>

                            <span class="nilai-pill">

                                {{ number_format($m['tes'], 2) }}

                            </span>

                        </td>

                        <td>

                            <span class="prestasi-pill">

                                {{ number_format($m['prestasi'], 2) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">

                            Data belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- 2. NORMALISASI --}}
{{-- ========================= --}}
<div class="card mb-4 saw-card">

    <div class="card-header saw-card-header-success">

        <i class="bi bi-bar-chart-line"></i>

        Matriks Normalisasi

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle saw-table">

            <thead>

                <tr>

                    <th class="text-start">Nama Siswa</th>

                    <th>Nilai Rata Rata Raport</th>

                    <th>Nilai Tes</th>

                    <th>Prestasi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($normalisasi as $id => $n)

                    <tr>

                        <td class="text-start">

                            <span class="student-name-saw">

                                {{ $siswaMap[$id]->nama ?? '-' }}

                            </span>

                        </td>

                        <td>

                            <span class="nilai-pill">

                                {{ number_format($n['raport'], 3) }}

                            </span>

                        </td>

                        <td>

                            <span class="nilai-pill">

                                {{ number_format($n['tes'], 3) }}

                            </span>

                        </td>

                        <td>

                            <span class="prestasi-pill">

                                {{ number_format($n['prestasi'], 3) }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">

                            Data belum tersedia

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- 3. HASIL PERINGKAT --}}
{{-- ========================= --}}
<div class="card mb-4 saw-card">

    <div class="card-header saw-card-header-dark">

        <i class="bi bi-trophy"></i>

        Hasil Peringkat

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle saw-table">

            <thead>

                <tr>

                    <th>Peringkat</th>

                    <th class="text-start">Nama Siswa</th>

                    <th>Nilai Akhir</th>

                    <th>Kelas</th>

                </tr>

            </thead>

            <tbody>

                @forelse($ranking as $r)

                    <tr
                        @if($r['ranking'] == 1)
                            class="table-success"
                        @endif
                    >

                        {{-- PERINGKAT --}}
                        <td>

                            @if($r['ranking'] == 1)

                                <span class="ranking-badge ranking-first">

                                    <i class="bi bi-award me-1"></i>

                                    1

                                </span>

                            @else

                                <span class="ranking-badge">

                                    {{ $r['ranking'] }}

                                </span>

                            @endif

                        </td>

                        {{-- NAMA --}}
                        <td class="text-start">

                            <span class="student-name-saw">

                                {{ $r['nama'] }}

                            </span>

                        </td>

                        {{-- NILAI --}}
                        <td>

                            <span class="nilai-pill">

                                {{ number_format($r['nilai'], 4) }}

                            </span>

                        </td>

                        {{-- KELAS --}}
                        <td>

                            @if(!$pengaturanSudahDiisi)

                                <span class="kelas-empty">

                                    Belum Diatur

                                </span>

                            @elseif($r['kelas'] == '-')

                                <span class="kelas-warning">

                                    Belum Dibagi

                                </span>

                            @else

                                <span class="kelas-badge">

                                    Kelas {{ $r['kelas'] }}

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4">

                            Belum ada hasil perhitungan

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- 4. PEMBAGIAN KELAS --}}
{{-- ========================= --}}
<hr class="section-divider">

<h3 id="pembagian-kelas-section"
    class="section-heading scroll-target-saw">
    Pembagian Kelas
</h3>

@if(!$pengaturanSudahDiisi)

    <div class="empty-saw">

        <div class="empty-icon-saw">

            <i class="bi bi-sliders"></i>

        </div>

        <h4 class="mb-2">
            Pembagian Kelas Belum Ditampilkan
        </h4>

        <p class="text-muted mb-0">
            Silakan isi pengaturan pembagian kelas terlebih dahulu.
        </p>

    </div>

@elseif(!$kapasitasCukupValue)

    <div class="alert alert-danger saw-alert text-center">

        <i class="bi bi-exclamation-triangle me-1"></i>

        Kapasitas kelas tidak mencukupi.
        Silakan tambah jumlah kelas atau tambah maksimal siswa per kelas.

    </div>

@else

    @forelse($kelasGrouped as $kelas => $data)

        <div class="card mb-4 kelas-card">

            <div class="card-header kelas-card-header">

                <div class="kelas-title">

                    <i class="bi bi-diagram-3"></i>

                    Kelas {{ $kelas }}

                </div>

                <div class="kelas-info-group">

                    <span class="kelas-count">

                        {{ count($data) }} Siswa

                    </span>

                    <span class="kelas-count">

                        Maksimal {{ $maksimalSiswaValue }} Siswa

                    </span>

                </div>

            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-hover text-center align-middle saw-table">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th class="text-start">Nama Siswa</th>

                            <th>Peringkat</th>

                            <th>Nilai SAW</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($data as $i => $s)

                            <tr>

                                <td>

                                    <span class="ranking-badge">

                                        {{ $i + 1 }}

                                    </span>

                                </td>

                                <td class="text-start">

                                    <span class="student-name-saw">

                                        {{ $s['nama'] }}

                                    </span>

                                </td>

                                <td>

                                    {{ $s['ranking'] }}

                                </td>

                                <td>

                                    <span class="nilai-pill">

                                        {{ number_format($s['nilai'], 4) }}

                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    @empty

        <div class="empty-saw">

            <div class="empty-icon-saw">

                <i class="bi bi-folder-x"></i>

            </div>

            <h4 class="mb-2">
                Belum Ada Pembagian Kelas
            </h4>

            <p class="text-muted mb-0">
                Data pembagian kelas belum tersedia.
            </p>

        </div>

    @endforelse

@endif

{{-- ========================= --}}
{{-- SCRIPT AUTO SCROLL --}}
{{-- ========================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        // =========================
        // CEK APAKAH ADA ERROR VALIDASI
        // =========================
        const hasValidationError =
            @json($errors->any());

        // =========================
        // AUTO SCROLL KE PEMBAGIAN KELAS
        // HANYA SETELAH TERAPKAN PENGATURAN
        // DAN TIDAK ADA ERROR VALIDASI
        // =========================
        const shouldScrollToPembagianKelas =
            @json(request('scroll_to') === 'pembagian-kelas')
            && !hasValidationError;

        if (shouldScrollToPembagianKelas) {

            const targetPembagianKelas =
                document.getElementById('pembagian-kelas-section');

            if (targetPembagianKelas) {

                setTimeout(function () {

                    targetPembagianKelas.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                }, 200);

            }

        }

    });

</script>

@endsection