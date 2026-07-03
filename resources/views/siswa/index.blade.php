@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- STYLE KHUSUS HALAMAN SISWA --}}
{{-- ========================= --}}
<style>

    .siswa-header{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .siswa-icon-box{
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

    .siswa-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .siswa-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .summary-card-siswa{
        border: 0;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
        padding: 20px;
        height: 100%;
    }

    .summary-icon-siswa{
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

    .summary-orange{
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .summary-title-siswa{
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .summary-value-siswa{
        font-size: 24px;
        font-weight: 800;
        color: #2563eb;
        margin-bottom: 0;
    }

    .siswa-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .siswa-card-header-input{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .siswa-card-header-table{
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .help-box-siswa{
        background: #eff6ff;
        border-radius: 18px;
        padding: 16px 18px;
        color: #1e40af;
        font-weight: 500;
        border: 1px solid #dbeafe;
        margin-bottom: 24px;
    }

    .form-section-title{
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-title i{
        color: #2563eb;
    }

    .form-divider{
        margin: 25px 0;
        border: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #cbd5e1, transparent);
    }

    .siswa-table{
        margin-bottom: 0;
    }

    .siswa-table thead th{
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

    .siswa-table tbody td{
        padding: 15px 14px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .siswa-table tbody tr:hover{
        background: #f8fbff;
    }

    .number-badge{
        background: #eef2ff;
        color: #3730a3;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
        min-width: 42px;
    }

    .student-name{
        font-weight: 800;
        color: #0f172a;
    }

    .nisn-badge{
        background: #f8fafc;
        color: #475569;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        border: 1px solid #e2e8f0;
        display: inline-block;
    }

    .nilai-badge{
        background: #eff6ff;
        color: #2563eb;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .tes-badge{
        background: #fef3c7;
        color: #92400e;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .btn-action{
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 800;
        padding: 7px 11px;
        border-radius: 12px;
    }

    .btn-delete-all-siswa{
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 800;
        border-radius: 12px;
        white-space: nowrap;
    }

    .empty-siswa{
        padding: 45px 25px;
        text-align: center;
    }

    .empty-icon-siswa{
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

    .custom-alert-siswa{
        border: 0;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    @media(max-width: 768px){

        .siswa-header{
            padding: 22px;
        }

        .siswa-title{
            font-size: 24px;
        }

        .btn-action{
            width: 100%;
            justify-content: center;
            margin-bottom: 6px;
        }

        .btn-delete-all-siswa{
            width: 100%;
            justify-content: center;
        }

    }

</style>

@php
    $totalSiswa = $siswa->count();

    $rataRaportKeseluruhan =
        $totalSiswa > 0
            ? $siswa->avg('rata_rata_raport')
            : 0;

    $totalRataTes = $siswa->sum(function ($s) {
        return (
            ($s->tes_matematika ?? 0) +
            ($s->tes_ipa ?? 0) +
            ($s->tes_ips ?? 0)
        ) / 3;
    });

    $rataTesKeseluruhan =
        $totalSiswa > 0
            ? $totalRataTes / $totalSiswa
            : 0;
@endphp

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="siswa-header">

    <div class="d-flex align-items-center gap-3">

        <div class="siswa-icon-box">

            <i class="bi bi-people"></i>

        </div>

        <div>

            <h2 class="siswa-title">
                Data Siswa
            </h2>

            <p class="siswa-subtitle">
                Kelola data siswa, nilai raport, dan nilai tes sebagai dasar perhitungan penempatan kelas.
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- NOTIFIKASI --}}
{{-- ========================= --}}
@if(session('success'))

    <div class="alert alert-success custom-alert-siswa">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

    </div>

@endif

{{-- ========================= --}}
{{-- ERROR VALIDASI --}}
{{-- ========================= --}}
@if ($errors->any())

    <div class="alert alert-danger custom-alert-siswa">

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
{{-- RINGKASAN --}}
{{-- ========================= --}}
<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="summary-card-siswa">

            <div class="summary-icon-siswa summary-blue">

                <i class="bi bi-people"></i>

            </div>

            <h6 class="summary-title-siswa">
                Total Siswa
            </h6>

            <p class="summary-value-siswa">
                {{ $totalSiswa }}
            </p>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="summary-card-siswa">

            <div class="summary-icon-siswa summary-green">

                <i class="bi bi-journal-check"></i>

            </div>

            <h6 class="summary-title-siswa">
                Rata Rata Raport
            </h6>

            <p class="summary-value-siswa">
                {{ number_format($rataRaportKeseluruhan, 2) }}
            </p>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="summary-card-siswa">

            <div class="summary-icon-siswa summary-orange">

                <i class="bi bi-clipboard-data"></i>

            </div>

            <h6 class="summary-title-siswa">
                Rata Rata Tes
            </h6>

            <p class="summary-value-siswa">
                {{ number_format($rataTesKeseluruhan, 2) }}
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- FORM TAMBAH --}}
{{-- ========================= --}}
<form action="/siswa/store"
      method="POST">

    @csrf

    <div class="card mb-4 siswa-card">

        {{-- HEADER --}}
        <div class="card-header siswa-card-header-input">

            <i class="bi bi-plus-circle"></i>

            Tambah Data Siswa

        </div>

        <div class="card-body">

            <div class="help-box-siswa">

                <i class="bi bi-info-circle me-1"></i>

                Masukkan data siswa lengkap beserta nilai raport dan nilai tes. Data ini akan digunakan dalam proses perhitungan.

            </div>

            {{-- ========================= --}}
            {{-- DATA SISWA --}}
            {{-- ========================= --}}
            <h5 class="form-section-title">

                <i class="bi bi-person-badge"></i>

                Data Identitas Siswa

            </h5>

            <div class="row">

                {{-- NAMA --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Siswa
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama siswa"
                           required>

                </div>

                {{-- NISN --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        NISN
                    </label>

                    <input type="text"
                           name="nisn"
                           class="form-control"
                           value="{{ old('nisn') }}"
                           placeholder="Masukkan NISN"
                           maxlength="10"
                           pattern="[0-9]{10}"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           required>

                    <small class="text-muted">
                        NISN harus terdiri dari 10 digit angka
                    </small>

                </div>

            </div>

            <hr class="form-divider">

            {{-- ========================= --}}
            {{-- NILAI RAPORT --}}
            {{-- ========================= --}}
            <h5 class="form-section-title">

                <i class="bi bi-journal-check"></i>

                Nilai Akademik

            </h5>

            <div class="mb-3">

                <label class="form-label">
                    Nilai Rata Rata Raport
                </label>

                <input type="number"
                       step="0.01"
                       min="0"
                       max="100"
                       name="rata_rata_raport"
                       class="form-control"
                       value="{{ old('rata_rata_raport') }}"
                       placeholder="Contoh: 88.75"
                       required>

            </div>

            <hr class="form-divider">

            {{-- ========================= --}}
            {{-- NILAI TES --}}
            {{-- ========================= --}}
            <h5 class="form-section-title">

                <i class="bi bi-clipboard-data"></i>

                Nilai Tes

            </h5>

            <div class="row">

                {{-- TES MATEMATIKA --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tes Matematika
                    </label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           max="100"
                           name="tes_matematika"
                           class="form-control"
                           value="{{ old('tes_matematika') }}"
                           placeholder="0 - 100"
                           required>

                </div>

                {{-- TES IPA --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tes IPA
                    </label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           max="100"
                           name="tes_ipa"
                           class="form-control"
                           value="{{ old('tes_ipa') }}"
                           placeholder="0 - 100"
                           required>

                </div>

                {{-- TES IPS --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tes IPS
                    </label>

                    <input type="number"
                           step="0.01"
                           min="0"
                           max="100"
                           name="tes_ips"
                           class="form-control"
                           value="{{ old('tes_ips') }}"
                           placeholder="0 - 100"
                           required>

                </div>

            </div>

            {{-- BUTTON --}}
            <button class="btn btn-primary mt-3">

                <i class="bi bi-save me-1"></i>

                Simpan Data

            </button>

        </div>

    </div>

</form>

{{-- ========================= --}}
{{-- TABEL DATA SISWA --}}
{{-- ========================= --}}
<div class="card siswa-card">

    <div class="card-header siswa-card-header-table d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div class="d-flex align-items-center gap-2">

            <i class="bi bi-table"></i>

            <span>
                Data Siswa
            </span>

        </div>

        @if($siswa->count() > 0)

            <form action="/siswa/delete-all"
                  method="POST"
                  class="m-0"
                  onsubmit="return confirm('Yakin ingin menghapus semua data siswa? Data prestasi siswa juga akan ikut terhapus. Riwayat yang sudah disimpan tetap aman.')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger btn-sm btn-delete-all-siswa">

                    <i class="bi bi-trash3"></i>

                    Hapus Semua Data Siswa

                </button>

            </form>

        @endif

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle siswa-table">

            <thead>

                <tr>

                    <th>No</th>

                    <th class="text-start">Nama</th>

                    <th>NISN</th>

                    <th>Rata Rata Raport</th>

                    <th>Rata Rata Tes</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($siswa as $s)

                @php
                    $rataRataTes = (
                        ($s->tes_matematika ?? 0) +
                        ($s->tes_ipa ?? 0) +
                        ($s->tes_ips ?? 0)
                    ) / 3;
                @endphp

                <tr>

                    {{-- NO --}}
                    <td>

                        <span class="number-badge">

                            {{ $loop->iteration }}

                        </span>

                    </td>

                    {{-- NAMA --}}
                    <td class="text-start">

                        <span class="student-name">

                            {{ $s->nama }}

                        </span>

                    </td>

                    {{-- NISN --}}
                    <td>

                        <span class="nisn-badge">

                            {{ $s->nisn }}

                        </span>

                    </td>

                    {{-- RAPORT --}}
                    <td>

                        <span class="nilai-badge">

                            {{ number_format($s->rata_rata_raport ?? 0, 2) }}

                        </span>

                    </td>

                    {{-- RATA RATA TES --}}
                    <td>

                        <span class="tes-badge">

                            {{ number_format($rataRataTes, 2) }}

                        </span>

                    </td>

                    {{-- AKSI --}}
                    <td>

                        {{-- UBAH --}}
                        <a href="/siswa/edit/{{ $s->id }}"
                           class="btn btn-warning btn-sm btn-action">

                            <i class="bi bi-pencil-square"></i>

                            Ubah

                        </a>

                        {{-- HAPUS --}}
                        <a href="/siswa/delete/{{ $s->id }}"
                           class="btn btn-danger btn-sm btn-action"
                           onclick="return confirm('Yakin ingin menghapus data?')">

                            <i class="bi bi-trash"></i>

                            Hapus

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        <div class="empty-siswa">

                            <div class="empty-icon-siswa">

                                <i class="bi bi-folder-x"></i>

                            </div>

                            <h4 class="mb-2">
                                Data Siswa Belum Tersedia
                            </h4>

                            <p class="text-muted mb-0">
                                Silakan tambahkan data siswa melalui form tambah di atas.
                            </p>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection