@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- STYLE KHUSUS HALAMAN PRESTASI --}}
{{-- ========================= --}}
<style>

    .prestasi-header{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .prestasi-icon-box{
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: linear-gradient(135deg, #f59e0b, #facc15);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        box-shadow: 0 10px 24px rgba(245, 158, 11, 0.28);
    }

    .prestasi-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .prestasi-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .summary-card-prestasi{
        border: 0;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 8px 22px rgba(15, 23, 42, 0.06);
        padding: 20px;
        height: 100%;
    }

    .summary-icon-prestasi{
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

    .summary-orange{
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .summary-blue{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .summary-green{
        background: linear-gradient(135deg, #16a34a, #15803d);
    }

    .summary-title-prestasi{
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 4px;
    }

    .summary-value-prestasi{
        font-size: 24px;
        font-weight: 800;
        color: #2563eb;
        margin-bottom: 0;
    }

    .prestasi-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .prestasi-card-header-input{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .prestasi-card-header-table{
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .help-box-prestasi{
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

    .prestasi-table{
        margin-bottom: 0;
    }

    .prestasi-table thead th{
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

    .prestasi-table tbody td{
        padding: 15px 14px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .prestasi-table tbody tr:hover{
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

    .student-name-prestasi{
        font-weight: 800;
        color: #0f172a;
    }

    .prestasi-name{
        font-weight: 700;
        color: #334155;
    }

    .nilai-badge{
        background: #dcfce7;
        color: #166534;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .tahun-badge{
        background: #eff6ff;
        color: #2563eb;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .keterangan-text{
        color: #64748b;
        font-weight: 500;
    }

    .btn-action{
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 800;
        padding: 7px 11px;
        border-radius: 12px;
    }

    .btn-delete-all-prestasi{
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 800;
        border-radius: 12px;
        white-space: nowrap;
    }

    .empty-prestasi{
        padding: 45px 25px;
        text-align: center;
    }

    .empty-icon-prestasi{
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

    .custom-alert-prestasi{
        border: 0;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    @media(max-width: 768px){

        .prestasi-header{
            padding: 22px;
        }

        .prestasi-title{
            font-size: 24px;
        }

        .btn-action{
            width: 100%;
            justify-content: center;
            margin-bottom: 6px;
        }

        .btn-delete-all-prestasi{
            width: 100%;
            justify-content: center;
        }

    }

</style>

@php
    $totalPrestasi = $prestasi->count();
    $totalSiswaBerprestasi = $prestasi->pluck('siswa_id')->unique()->count();
    $totalPrestasiTertinggi = $prestasi->whereIn('tingkat', ['nasional', 'internasional'])->count();
@endphp

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="prestasi-header">

    <div class="d-flex align-items-center gap-3">

        <div class="prestasi-icon-box">

            <i class="bi bi-trophy"></i>

        </div>

        <div>

            <h2 class="prestasi-title">
                Data Prestasi Siswa
            </h2>

            <p class="prestasi-subtitle">
                Kelola data prestasi siswa sebagai kriteria non akademik dalam perhitungan SAW.
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- NOTIFIKASI --}}
{{-- ========================= --}}
@if(session('success'))

    <div class="alert alert-success custom-alert-prestasi">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

    </div>

@endif

{{-- ========================= --}}
{{-- ERROR VALIDASI --}}
{{-- ========================= --}}
@if ($errors->any())

    <div class="alert alert-danger custom-alert-prestasi">

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

        <div class="summary-card-prestasi">

            <div class="summary-icon-prestasi summary-orange">

                <i class="bi bi-award"></i>

            </div>

            <h6 class="summary-title-prestasi">
                Total Prestasi
            </h6>

            <p class="summary-value-prestasi">
                {{ $totalPrestasi }}
            </p>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="summary-card-prestasi">

            <div class="summary-icon-prestasi summary-blue">

                <i class="bi bi-people"></i>

            </div>

            <h6 class="summary-title-prestasi">
                Siswa Berprestasi
            </h6>

            <p class="summary-value-prestasi">
                {{ $totalSiswaBerprestasi }}
            </p>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="summary-card-prestasi">

            <div class="summary-icon-prestasi summary-green">

                <i class="bi bi-stars"></i>

            </div>

            <h6 class="summary-title-prestasi">
                Nasional / Internasional
            </h6>

            <p class="summary-value-prestasi">
                {{ $totalPrestasiTertinggi }}
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- FORM TAMBAH --}}
{{-- ========================= --}}
<div class="card mb-4 prestasi-card">

    <div class="card-header prestasi-card-header-input">

        <i class="bi bi-plus-circle"></i>

        Tambah Prestasi

    </div>

    <div class="card-body">

        <div class="help-box-prestasi">

            <i class="bi bi-info-circle me-1"></i>

            Masukkan prestasi siswa sesuai tingkat lomba. Nilai prestasi akan digunakan sebagai kriteria non akademik dalam metode SAW.

        </div>

        <form action="/prestasi/store"
              method="POST">

            @csrf

            <h5 class="form-section-title">

                <i class="bi bi-person-badge"></i>

                Data Siswa

            </h5>

            {{-- NAMA SISWA --}}
            <div class="mb-3">

                <label class="form-label">
                    Nama Siswa
                </label>

                <select name="siswa_id"
                        class="form-control"
                        required>

                    <option value="">
                        -- Pilih Siswa --
                    </option>

                    @foreach($siswa as $s)

                        <option value="{{ $s->id }}"
                            @if(old('siswa_id') == $s->id) selected @endif>

                            {{ $s->nama }}

                        </option>

                    @endforeach

                </select>

            </div>

            <hr class="form-divider">

            <h5 class="form-section-title">

                <i class="bi bi-trophy"></i>

                Data Prestasi

            </h5>

            <div class="row">

                {{-- NAMA PRESTASI --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Prestasi
                    </label>

                    <input type="text"
                           name="nama_prestasi"
                           class="form-control"
                           value="{{ old('nama_prestasi') }}"
                           placeholder="Contoh: Olimpiade IPA"
                           required>

                </div>

                {{-- TINGKAT PRESTASI --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Tingkat Prestasi
                    </label>

                    <select name="tingkat"
                            class="form-control"
                            required>

                        <option value="">
                            -- Pilih Tingkat --
                        </option>

                        <option value="kabupaten"
                            @if(old('tingkat') == 'kabupaten') selected @endif>
                            Kabupaten
                        </option>

                        <option value="provinsi"
                            @if(old('tingkat') == 'provinsi') selected @endif>
                            Provinsi
                        </option>

                        <option value="nasional"
                            @if(old('tingkat') == 'nasional') selected @endif>
                            Nasional
                        </option>

                        <option value="internasional"
                            @if(old('tingkat') == 'internasional') selected @endif>
                            Internasional
                        </option>

                    </select>

                </div>

                {{-- TAHUN PRESTASI --}}
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tahun Prestasi
                    </label>

                    <input type="text"
                           name="tahun_prestasi"
                           class="form-control"
                           value="{{ old('tahun_prestasi') }}"
                           placeholder="Contoh: {{ date('Y') }}"
                           maxlength="4"
                           minlength="4"
                           inputmode="numeric"
                           pattern="[0-9]{4}"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4)">

                    <small class="text-muted">
                        Tahun prestasi hanya boleh angka dari 2020 sampai {{ date('Y') }}.
                    </small>

                </div>

                {{-- KETERANGAN --}}
                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Keterangan
                    </label>

                    <textarea name="keterangan"
                              class="form-control"
                              rows="3"
                              placeholder="Contoh: Juara 1 Olimpiade IPA">{{ old('keterangan') }}</textarea>

                </div>

            </div>

            {{-- BUTTON --}}
            <button class="btn btn-primary">

                <i class="bi bi-save me-1"></i>

                Simpan Prestasi

            </button>

        </form>

    </div>

</div>

{{-- ========================= --}}
{{-- TABEL PRESTASI --}}
{{-- ========================= --}}
<div class="card prestasi-card">

    <div class="card-header prestasi-card-header-table d-flex justify-content-between align-items-center flex-wrap gap-2">

        <div class="d-flex align-items-center gap-2">

            <i class="bi bi-table"></i>

            <span>
                Data Prestasi Siswa
            </span>

        </div>

        @if($prestasi->count() > 0)

            <form action="/prestasi/delete-all"
                  method="POST"
                  class="m-0"
                  onsubmit="return confirm('Yakin ingin menghapus semua data prestasi?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger btn-sm btn-delete-all-prestasi">

                    <i class="bi bi-trash3"></i>

                    Hapus Semua Data Prestasi

                </button>

            </form>

        @endif

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle prestasi-table">

            <thead>

                <tr>

                    <th>No</th>

                    <th class="text-start">Nama Siswa</th>

                    <th class="text-start">Nama Prestasi</th>

                    <th>Tingkat</th>

                    <th>Nilai</th>

                    <th>Tahun</th>

                    <th class="text-start">Keterangan</th>

                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($prestasi as $p)

                <tr>

                    {{-- NO --}}
                    <td>

                        <span class="number-badge">

                            {{ $loop->iteration }}

                        </span>

                    </td>

                    {{-- NAMA SISWA --}}
                    <td class="text-start">

                        <span class="student-name-prestasi">

                            {{ $p->siswa->nama ?? '-' }}

                        </span>

                    </td>

                    {{-- NAMA PRESTASI --}}
                    <td class="text-start">

                        <span class="prestasi-name">

                            {{ $p->nama_prestasi }}

                        </span>

                    </td>

                    {{-- TINGKAT --}}
                    <td>

                        <span class="badge bg-{{ $p->badge_color }} px-3 py-2">

                            {{ $p->label_tingkat }}

                        </span>

                    </td>

                    {{-- NILAI --}}
                    <td>

                        <span class="nilai-badge">

                            {{ $p->nilai }}

                        </span>

                    </td>

                    {{-- TAHUN --}}
                    <td>

                        <span class="tahun-badge">

                            {{ $p->tahun_prestasi ?? '-' }}

                        </span>

                    </td>

                    {{-- KETERANGAN --}}
                    <td class="text-start">

                        <span class="keterangan-text">

                            {{ $p->keterangan ?? '-' }}

                        </span>

                    </td>

                    {{-- AKSI --}}
                    <td>

                        <a href="/prestasi/edit/{{ $p->id }}"
                           class="btn btn-warning btn-sm btn-action">

                            <i class="bi bi-pencil-square"></i>

                            Ubah

                        </a>

                        <a href="/prestasi/delete/{{ $p->id }}"
                           class="btn btn-danger btn-sm btn-action"
                           onclick="return confirm('Yakin ingin menghapus data?')">

                            <i class="bi bi-trash"></i>

                            Hapus

                        </a>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="8">

                        <div class="empty-prestasi">

                            <div class="empty-icon-prestasi">

                                <i class="bi bi-folder-x"></i>

                            </div>

                            <h4 class="mb-2">
                                Data Prestasi Belum Tersedia
                            </h4>

                            <p class="text-muted mb-0">
                                Silakan tambahkan data prestasi siswa melalui form tambah di atas.
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