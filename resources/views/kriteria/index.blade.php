@extends('layouts.app')

@section('content')

@php
    $kriteriaData = $kriteria ?? [
        [
            'kode' => 'C1',
            'nama_kriteria' => 'Nilai Rata Rata Raport',
            'atribut' => 'benefit',
            'bobot' => 0.30,
            'keterangan' => 'Nilai rata-rata raport siswa. Normalisasi benefit menggunakan rumus nilai raport siswa dibagi nilai raport tertinggi.'
        ],
        [
            'kode' => 'C2',
            'nama_kriteria' => 'Nilai Tes',
            'atribut' => 'benefit',
            'bobot' => 0.50,
            'keterangan' => 'Nilai tes dihitung dari rata-rata tes Matematika, IPA, dan IPS. Normalisasi benefit menggunakan rumus nilai tes siswa dibagi nilai tes tertinggi.'
        ],
        [
            'kode' => 'C3',
            'nama_kriteria' => 'Prestasi Non Akademik',
            'atribut' => 'benefit',
            'bobot' => 0.20,
            'keterangan' => 'Prestasi siswa dikonversi berdasarkan tingkat prestasi. Jika terdapat lebih dari satu data prestasi pada siswa yang sama, maka nilai yang digunakan adalah nilai prestasi tertinggi.'
        ],
    ];

    $totalBobotValue = $totalBobot ?? collect($kriteriaData)->sum('bobot');

    $rumusSawData = $rumusSaw ?? [
        'normalisasi' => 'Rij = Xij / Max(Xj)',
        'nilai_akhir' => 'Vi = (R1 × 0.30) + (R2 × 0.50) + (R3 × 0.20)',
        'keterangan' => 'Semua kriteria bersifat benefit, sehingga semakin tinggi nilai maka semakin baik.'
    ];
@endphp

{{-- ========================= --}}
{{-- STYLE KHUSUS KRITERIA --}}
{{-- ========================= --}}
<style>

    .criteria-hero{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .criteria-icon{
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2563eb, #38bdf8);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.28);
    }

    .criteria-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .criteria-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .info-box{
        border-radius: 20px;
        border: 0;
        background: #e0f2fe;
        color: #075985;
        padding: 18px 20px;
        box-shadow: 0 8px 22px rgba(14, 165, 233, 0.08);
    }

    .summary-card{
        border: 0;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
        padding: 20px;
        height: 100%;
    }

    .summary-icon{
        width: 48px;
        height: 48px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 22px;
        margin-bottom: 14px;
    }

    .summary-blue{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .summary-green{
        background: linear-gradient(135deg, #16a34a, #15803d);
    }

    .summary-purple{
        background: linear-gradient(135deg, #7c3aed, #6d28d9);
    }

    .summary-title{
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .summary-value{
        font-size: 24px;
        font-weight: 800;
        color: #2563eb;
        margin-bottom: 0;
    }

    .criteria-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .criteria-card-header{
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .criteria-table{
        margin-bottom: 0;
    }

    .criteria-table thead th{
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

    .criteria-table tbody td{
        padding: 15px 14px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .criteria-table tbody tr:hover{
        background: #f8fbff;
    }

    .kode-badge{
        background: #eef2ff;
        color: #3730a3;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
    }

    .atribut-badge{
        background: #dcfce7;
        color: #166534;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
    }

    .bobot-badge{
        background: #eff6ff;
        color: #2563eb;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
    }

    .total-row{
        background: #f8fafc;
    }

    .total-bobot{
        background: #dcfce7;
        color: #166534;
        padding: 8px 14px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .desc-card{
        border: 0;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
        background: #ffffff;
    }

    .desc-card-header{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .desc-list{
        margin-bottom: 0;
        padding-left: 0;
        list-style: none;
    }

    .desc-list li{
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid #eef2f7;
    }

    .desc-list li:last-child{
        border-bottom: 0;
    }

    .desc-check{
        width: 28px;
        height: 28px;
        border-radius: 999px;
        background: #dcfce7;
        color: #166534;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 15px;
    }

    .formula-card{
        border: 0;
        border-radius: 22px;
        background: #ffffff;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07);
        overflow: hidden;
    }

    .formula-card-header{
        background: linear-gradient(135deg, #16a34a, #15803d);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .formula-box{
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 18px;
        height: 100%;
    }

    .formula-label{
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 8px;
    }

    .formula-text{
        background: #eff6ff;
        color: #1d4ed8;
        border-radius: 14px;
        padding: 10px 14px;
        font-weight: 800;
        display: inline-block;
        margin-bottom: 10px;
    }

    .formula-desc{
        color: #64748b;
        font-weight: 500;
        margin-bottom: 0;
    }

    .prestasi-box{
        border-radius: 18px;
        padding: 16px;
        background: #ffffff;
        border: 1px solid #eef2f7;
        box-shadow: 0 6px 18px rgba(15, 23, 42, 0.05);
        height: 100%;
    }

    .prestasi-label{
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 5px;
    }

    .prestasi-point{
        color: #2563eb;
        font-weight: 800;
        margin-bottom: 0;
    }

</style>

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="criteria-hero">

    <div class="d-flex align-items-center gap-3">

        <div class="criteria-icon">

            <i class="bi bi-list-check"></i>

        </div>

        <div>

            <h2 class="criteria-title">
                Kriteria Penilaian Metode SAW
            </h2>

            <p class="criteria-subtitle">
                Informasi kriteria, bobot, atribut, dan rumus yang digunakan dalam proses penempatan kelas siswa.
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- INFORMASI --}}
{{-- ========================= --}}
<div class="info-box mb-4">

    <i class="bi bi-info-circle me-2"></i>

    Sistem Pendukung Keputusan ini menggunakan metode
    <b>Simple Additive Weighting (SAW)</b>
    untuk menentukan pembagian kelas siswa berdasarkan
    nilai rata-rata raport, nilai tes, dan prestasi siswa.

</div>

{{-- ========================= --}}
{{-- RINGKASAN --}}
{{-- ========================= --}}
<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="summary-card">

            <div class="summary-icon summary-blue">

                <i class="bi bi-card-checklist"></i>

            </div>

            <h6 class="summary-title">
                Jumlah Kriteria
            </h6>

            <p class="summary-value">
                {{ count($kriteriaData) }}
            </p>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="summary-card">

            <div class="summary-icon summary-green">

                <i class="bi bi-percent"></i>

            </div>

            <h6 class="summary-title">
                Total Bobot
            </h6>

            <p class="summary-value">
                {{ number_format($totalBobotValue, 2) }}
            </p>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="summary-card">

            <div class="summary-icon summary-purple">

                <i class="bi bi-arrow-up-circle"></i>

            </div>

            <h6 class="summary-title">
                Atribut
            </h6>

            <p class="summary-value">
                Benefit
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- RUMUS SAW --}}
{{-- ========================= --}}
<div class="card mb-4 formula-card">

    <div class="card-header formula-card-header">

        <i class="bi bi-calculator"></i>

        Rumus Perhitungan Metode SAW

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <div class="formula-box">

                    <div class="formula-label">
                        Rumus Normalisasi Benefit
                    </div>

                    <div class="formula-text">
                        {{ $rumusSawData['normalisasi'] }}
                    </div>

                    <p class="formula-desc">
                        Nilai setiap siswa pada suatu kriteria dibagi dengan nilai tertinggi pada kriteria tersebut.
                    </p>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <div class="formula-box">

                    <div class="formula-label">
                        Rumus Nilai Akhir
                    </div>

                    <div class="formula-text">
                        {{ $rumusSawData['nilai_akhir'] }}
                    </div>

                    <p class="formula-desc">
                        Nilai akhir diperoleh dari penjumlahan hasil perkalian normalisasi dengan bobot kriteria.
                    </p>

                </div>

            </div>

        </div>

        <div class="alert alert-success mb-0">

            <i class="bi bi-check-circle me-2"></i>

            {{ $rumusSawData['keterangan'] }}

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- TABEL KRITERIA --}}
{{-- ========================= --}}
<div class="card mb-4 criteria-card">

    <div class="card-header criteria-card-header">

        <i class="bi bi-table"></i>

        Data Kriteria Penilaian

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle criteria-table">

            <thead>

                <tr>

                    <th>No</th>

                    <th>Kode</th>

                    <th class="text-start">Nama Kriteria</th>

                    <th>Atribut</th>

                    <th>Bobot</th>

                    <th class="text-start">Keterangan</th>

                </tr>

            </thead>

            <tbody>

                @foreach($kriteriaData as $k)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <span class="kode-badge">
                                {{ $k['kode'] ?? 'C' . $loop->iteration }}
                            </span>
                        </td>

                        <td class="text-start fw-bold">
                            {{ $k['nama_kriteria'] }}
                        </td>

                        <td>
                            <span class="atribut-badge">
                                {{ ucfirst($k['atribut'] ?? 'benefit') }}
                            </span>
                        </td>

                        <td>
                            <span class="bobot-badge">
                                {{ number_format($k['bobot'], 2) }}
                            </span>
                        </td>

                        <td class="text-start text-muted">
                            {{ $k['keterangan'] ?? '-' }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

            <tfoot>

                <tr class="total-row">

                    <th colspan="4">
                        Total Bobot
                    </th>

                    <th colspan="2">

                        <span class="total-bobot">
                            {{ number_format($totalBobotValue, 2) }}
                        </span>

                    </th>

                </tr>

            </tfoot>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- KETERANGAN PEMBOBOTAN --}}
{{-- ========================= --}}
<div class="card mb-4 desc-card">

    <div class="card-header desc-card-header">

        <i class="bi bi-journal-text"></i>

        Keterangan Pembobotan

    </div>

    <div class="card-body">

        <ul class="desc-list">

            <li>

                <div class="desc-check">

                    <i class="bi bi-check-lg"></i>

                </div>

                <div>

                    <b>Nilai Rata-Rata Raport</b>
                    memiliki bobot
                    <b>30%</b>
                    karena digunakan untuk menilai kemampuan akademik siswa berdasarkan nilai raport.

                </div>

            </li>

            <li>

                <div class="desc-check">

                    <i class="bi bi-check-lg"></i>

                </div>

                <div>

                    <b>Nilai Tes</b>
                    memiliki bobot
                    <b>50%</b>
                    karena menjadi faktor utama dalam proses penempatan kelas siswa.

                </div>

            </li>

            <li>

                <div class="desc-check">

                    <i class="bi bi-check-lg"></i>

                </div>

                <div>

                    <b>Prestasi</b>
                    memiliki bobot
                    <b>20%</b>
                    sebagai faktor pendukung tambahan dalam penilaian siswa.

                </div>

            </li>

        </ul>

    </div>

</div>

{{-- ========================= --}}
{{-- SKALA PRESTASI --}}
{{-- ========================= --}}
<div class="card desc-card">

    <div class="card-header desc-card-header">

        <i class="bi bi-trophy"></i>

        Skala Nilai Prestasi

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-3 mb-3">

                <div class="prestasi-box">

                    <div class="prestasi-label">
                        Kabupaten
                    </div>

                    <p class="prestasi-point">
                        30 Poin
                    </p>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="prestasi-box">

                    <div class="prestasi-label">
                        Provinsi
                    </div>

                    <p class="prestasi-point">
                        50 Poin
                    </p>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="prestasi-box">

                    <div class="prestasi-label">
                        Nasional
                    </div>

                    <p class="prestasi-point">
                        80 Poin
                    </p>

                </div>

            </div>

            <div class="col-md-3 mb-3">

                <div class="prestasi-box">

                    <div class="prestasi-label">
                        Internasional
                    </div>

                    <p class="prestasi-point">
                        100 Poin
                    </p>

                </div>

            </div>

        </div>

        <div class="alert alert-info mb-0">

            <i class="bi bi-info-circle me-2"></i>

            Pada perhitungan SAW, nilai prestasi digunakan sebagai kriteria C3.
            Jika terdapat lebih dari satu data prestasi pada siswa yang sama,
            maka sistem menggunakan nilai prestasi tertinggi.

        </div>

    </div>

</div>

@endsection