@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- STYLE KHUSUS EDIT PRESTASI --}}
{{-- ========================= --}}
<style>

    .edit-prestasi-header{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .edit-prestasi-icon{
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

    .edit-prestasi-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .edit-prestasi-subtitle{
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

    .help-box{
        background: #eff6ff;
        border-radius: 18px;
        padding: 16px 18px;
        color: #1e40af;
        font-weight: 500;
        border: 1px solid #dbeafe;
        margin-bottom: 24px;
    }

    .action-wrapper{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 28px;
    }

    .btn-update-prestasi{
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-weight: 800;
    }

    .btn-back-prestasi{
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

        .edit-prestasi-header{
            padding: 22px;
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
<div class="edit-prestasi-header">

    <div class="d-flex align-items-center gap-3">

        <div class="edit-prestasi-icon">

            <i class="bi bi-pencil-square"></i>

        </div>

        <div>

            <h2 class="edit-prestasi-title">
                Ubah Prestasi Siswa
            </h2>

            <p class="edit-prestasi-subtitle">
                Perbarui data prestasi siswa apabila terjadi kesalahan input.
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
            Terjadi kesalahan input:

        </div>

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

{{-- ========================= --}}
{{-- FORM EDIT --}}
{{-- ========================= --}}
<form action="/prestasi/update/{{ $prestasi->id }}"
      method="POST">

    @csrf
    @method('PUT')

    <div class="card edit-card">

        {{-- HEADER --}}
        <div class="card-header edit-card-header">

            <i class="bi bi-trophy"></i>

            Form Ubah Prestasi

        </div>

        <div class="card-body">

            {{-- INFO --}}
            <div class="help-box">

                <i class="bi bi-info-circle me-1"></i>

                Pastikan data prestasi yang diubah sudah sesuai dengan dokumen atau bukti prestasi siswa.

            </div>

            {{-- ========================= --}}
            {{-- DATA SISWA --}}
            {{-- ========================= --}}
            <h5 class="form-section-title">

                <i class="bi bi-person-badge"></i>

                Data Siswa

            </h5>

            <div class="mb-3">

                <label class="form-label">
                    Nama Siswa
                </label>

                <select name="siswa_id"
                        class="form-control"
                        required>

                    @foreach($siswa as $s)

                        <option value="{{ $s->id }}"
                            @if(old('siswa_id', $prestasi->siswa_id) == $s->id)
                                selected
                            @endif>

                            {{ $s->nama }}

                        </option>

                    @endforeach

                </select>

            </div>

            <hr class="form-divider">

            {{-- ========================= --}}
            {{-- DATA PRESTASI --}}
            {{-- ========================= --}}
            <h5 class="form-section-title">

                <i class="bi bi-award"></i>

                Data Prestasi

            </h5>

            {{-- NAMA PRESTASI --}}
            <div class="mb-3">

                <label class="form-label">
                    Nama Prestasi
                </label>

                <input type="text"
                       name="nama_prestasi"
                       class="form-control"
                       value="{{ old('nama_prestasi', $prestasi->nama_prestasi) }}"
                       placeholder="Contoh: Olimpiade IPA"
                       required>

            </div>

            {{-- TINGKAT --}}
            <div class="mb-3">

                <label class="form-label">
                    Tingkat Prestasi
                </label>

                <select name="tingkat"
                        class="form-control"
                        required>

                    <option value="kabupaten"
                        @if(old('tingkat', $prestasi->tingkat) == 'kabupaten') selected @endif>

                        Kabupaten

                    </option>

                    <option value="provinsi"
                        @if(old('tingkat', $prestasi->tingkat) == 'provinsi') selected @endif>

                        Provinsi

                    </option>

                    <option value="nasional"
                        @if(old('tingkat', $prestasi->tingkat) == 'nasional') selected @endif>

                        Nasional

                    </option>

                    <option value="internasional"
                        @if(old('tingkat', $prestasi->tingkat) == 'internasional') selected @endif>

                        Internasional

                    </option>

                </select>

            </div>

            {{-- TAHUN PRESTASI --}}
            <div class="mb-3">

                <label class="form-label">
                    Tahun Prestasi
                </label>

                <input type="text"
                       name="tahun_prestasi"
                       class="form-control"
                       value="{{ old('tahun_prestasi', $prestasi->tahun_prestasi) }}"
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
            <div class="mb-3">

                <label class="form-label">
                    Keterangan
                </label>

                <textarea name="keterangan"
                          class="form-control"
                          rows="4"
                          placeholder="Contoh: Juara 1 Olimpiade IPA tingkat Kabupaten">{{ old('keterangan', $prestasi->keterangan) }}</textarea>

            </div>

            {{-- BUTTON --}}
            <div class="action-wrapper">

                <button class="btn btn-warning btn-update-prestasi">

                    <i class="bi bi-save"></i>

                    Perbarui Prestasi

                </button>

                <a href="/prestasi"
                   class="btn btn-secondary btn-back-prestasi">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

</form>

@endsection