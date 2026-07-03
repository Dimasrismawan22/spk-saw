@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- STYLE KHUSUS UBAH SISWA --}}
{{-- ========================= --}}
<style>

    .edit-siswa-header{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .edit-siswa-icon{
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

    .edit-siswa-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .edit-siswa-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .edit-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .edit-card-header{
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .help-box-edit{
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

    .action-wrapper{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 28px;
    }

    .btn-update-siswa{
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-weight: 800;
    }

    .btn-back-siswa{
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-weight: 800;
    }

    .custom-alert-edit{
        border: 0;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    @media(max-width: 768px){

        .edit-siswa-header{
            padding: 22px;
        }

        .edit-siswa-title{
            font-size: 24px;
        }

        .action-wrapper .btn{
            width: 100%;
            justify-content: center;
        }

    }

</style>

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="edit-siswa-header">

    <div class="d-flex align-items-center gap-3">

        <div class="edit-siswa-icon">

            <i class="bi bi-pencil-square"></i>

        </div>

        <div>

            <h2 class="edit-siswa-title">
                Ubah Data Siswa
            </h2>

            <p class="edit-siswa-subtitle">
                Perbarui data siswa, nilai raport, dan nilai tes.
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- ERROR VALIDASI --}}
{{-- ========================= --}}
@if ($errors->any())

    <div class="alert alert-danger custom-alert-edit">

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
{{-- FORM UBAH --}}
{{-- ========================= --}}
<form action="/siswa/update/{{ $siswa->id }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="card edit-card">

        {{-- HEADER --}}
        <div class="card-header edit-card-header">

            <i class="bi bi-person-lines-fill"></i>

            Form Ubah Data Siswa

        </div>

        <div class="card-body">

            {{-- INFO --}}
            <div class="help-box-edit">

                <i class="bi bi-info-circle me-1"></i>

                Pastikan perubahan data siswa sudah sesuai sebelum menekan tombol Perbarui Data.

            </div>

            {{-- ========================= --}}
            {{-- IDENTITAS SISWA --}}
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
                           value="{{ old('nama', $siswa->nama) }}"
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
                           maxlength="10"
                           pattern="[0-9]{10}"
                           inputmode="numeric"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           value="{{ old('nisn', $siswa->nisn) }}"
                           placeholder="Masukkan NISN"
                           required>

                    <small class="text-muted">
                        NISN harus terdiri dari 10 digit angka
                    </small>

                </div>

            </div>

            <hr class="form-divider">

            {{-- ========================= --}}
            {{-- NILAI AKADEMIK --}}
            {{-- ========================= --}}
            <h5 class="form-section-title">

                <i class="bi bi-journal-check"></i>

                Nilai Akademik

            </h5>

            {{-- RAPORT --}}
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
                       value="{{ old('rata_rata_raport', $siswa->rata_rata_raport) }}"
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
                           value="{{ old('tes_matematika', $siswa->tes_matematika) }}"
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
                           value="{{ old('tes_ipa', $siswa->tes_ipa) }}"
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
                           value="{{ old('tes_ips', $siswa->tes_ips) }}"
                           placeholder="0 - 100"
                           required>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="action-wrapper">

                <button class="btn btn-warning btn-update-siswa">

                    <i class="bi bi-save"></i>

                    Perbarui Data

                </button>

                <a href="/siswa"
                   class="btn btn-secondary btn-back-siswa">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</form>

@endsection