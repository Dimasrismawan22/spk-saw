@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- STYLE KHUSUS HALAMAN RIWAYAT --}}
{{-- ========================= --}}
<style>

    .history-page-header{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .history-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .history-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .history-icon-box{
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2563eb, #38bdf8);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.28);
    }

    .history-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .history-card-header{
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 18px 22px;
    }

    .period-badge{
        background: rgba(255, 255, 255, 0.14);
        color: #ffffff;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .history-summary{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 12px;
    }

    .summary-pill{
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: 13px;
        color: #475569;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .history-action-group{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
    }

    .btn-detail-history{
        background: #ffffff;
        color: #2563eb;
        border-radius: 14px;
        font-weight: 800;
        padding: 9px 15px;
        border: 0;
        box-shadow: 0 8px 18px rgba(255, 255, 255, 0.18);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-detail-history:hover{
        color: #1d4ed8;
        transform: translateY(-1px);
        background: #eff6ff;
    }

    .btn-delete-history{
        border-radius: 14px;
        font-weight: 800;
        padding: 9px 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .history-table{
        margin-bottom: 0;
    }

    .history-table thead th{
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

    .history-table tbody td{
        padding: 15px 14px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .history-table tbody tr:hover{
        background: #f8fbff;
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

    .student-name{
        font-weight: 800;
        color: #0f172a;
    }

    .nilai-saw{
        font-weight: 800;
        color: #2563eb;
        background: #eff6ff;
        padding: 7px 11px;
        border-radius: 999px;
        display: inline-block;
    }

    .kelas-badge{
        background: #dbeafe;
        color: #1d4ed8;
        padding: 8px 12px;
        border-radius: 999px;
        font-weight: 800;
    }

    .date-text{
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
    }

    .empty-state{
        background: #ffffff;
        border-radius: 22px;
        padding: 45px 25px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        text-align: center;
        border: 1px solid #eef2f7;
    }

    .empty-state-icon{
        width: 70px;
        height: 70px;
        border-radius: 22px;
        background: #fef3c7;
        color: #92400e;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 34px;
        margin-bottom: 16px;
    }

    .custom-alert-history{
        border: 0;
        border-radius: 18px;
        padding: 16px 18px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
    }

    .history-search-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
        margin-bottom: 28px;
    }

    .history-search-header{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .history-search-help{
        background: #eff6ff;
        color: #1e40af;
        border: 1px solid #dbeafe;
        border-radius: 18px;
        padding: 14px 16px;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .history-search-actions{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-search-history,
    .btn-reset-history{
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-weight: 800;
        white-space: nowrap;
    }

    .search-result-note{
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        color: #475569;
        border-radius: 16px;
        padding: 12px 15px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    @media(max-width: 768px){

        .history-page-header{
            padding: 22px;
        }

        .history-card-header{
            gap: 14px;
            flex-direction: column;
            align-items: flex-start !important;
        }

        .history-action-group{
            width: 100%;
            justify-content: flex-start;
        }

        .history-action-group .btn,
        .history-action-group form{
            width: 100%;
        }

        .btn-detail-history,
        .btn-delete-history{
            width: 100%;
            text-align: center;
        }

        .history-search-actions{
            width: 100%;
        }

        .history-search-actions .btn{
            width: 100%;
        }

    }

</style>

@php
    $periodeCariValue = $periodeCari ?? '';
@endphp

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="history-page-header">

    <div class="d-flex align-items-center gap-3">

        <div class="history-icon-box">

            <i class="bi bi-clock-history"></i>

        </div>

        <div>

            <h2 class="history-title">
                Riwayat Hasil Pembagian Kelas
            </h2>

            <p class="history-subtitle">
                Hasil perhitungan dan pembagian kelas yang telah disimpan.
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- NOTIFIKASI --}}
{{-- ========================= --}}
@if(session('success'))

    <div class="alert alert-success custom-alert-history">

        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}

    </div>

@endif

@if(session('error'))

    <div class="alert alert-danger custom-alert-history">

        <i class="bi bi-exclamation-triangle me-2"></i>
        {{ session('error') }}

    </div>

@endif

{{-- ========================= --}}
{{-- PENCARIAN PERIODE --}}
{{-- ========================= --}}
<div class="card history-search-card">

    <div class="history-search-header">

        <i class="bi bi-search"></i>

        Pencarian Riwayat

    </div>

    <div class="card-body">

        <div class="history-search-help">

            <i class="bi bi-info-circle me-1"></i>

            Masukkan periode tahun ajaran untuk mencari riwayat yang sudah disimpan.
            Contoh: 2025 atau 2025/2026.

        </div>

        <form action="/hasil"
              method="GET">

            <div class="row align-items-end">

                <div class="col-md-8 mb-3">

                    <label class="form-label">
                        Periode Tahun Ajaran
                    </label>

                    <input type="text"
                           name="periode"
                           class="form-control"
                           value="{{ $periodeCariValue }}"
                           placeholder="Contoh: 2025 atau 2025/2026"
                           maxlength="9"
                           inputmode="numeric"
                           pattern="[0-9]{4}(/[0-9]{4})?"
                           autocomplete="off"
                           title="Masukkan tahun 4 digit atau periode lengkap. Contoh: 2025 atau 2025/2026."
                           oninput="
                                let angka = this.value.replace(/[^0-9]/g, '').slice(0, 8);

                                if (angka.length > 4) {
                                    this.value = angka.slice(0, 4) + '/' + angka.slice(4);
                                } else {
                                    this.value = angka;
                                }
                           ">

                    <small class="text-muted">
                        Masukkan tahun 4 digit atau periode lengkap. Contoh: 2025 atau 2025/2026.
                    </small>

                </div>

                <div class="col-md-4 mb-3">

                    <div class="history-search-actions">

                        <button type="submit"
                                class="btn btn-primary btn-search-history flex-fill">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                        <a href="/hasil"
                           class="btn btn-secondary btn-reset-history flex-fill">

                            <i class="bi bi-arrow-clockwise"></i>

                            Tampilkan Semua

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@if($periodeCariValue !== '')

    <div class="search-result-note">

        <i class="bi bi-filter-circle me-1"></i>

        Menampilkan riwayat berdasarkan pencarian periode:
        <strong>{{ $periodeCariValue }}</strong>

    </div>

@endif

{{-- ========================= --}}
{{-- DATA RIWAYAT --}}
{{-- ========================= --}}
@forelse($hasil as $periode => $data)

<div class="card mb-4 history-card">

    <div class="card-header history-card-header d-flex justify-content-between align-items-center">

        <div>

            <div class="period-badge">

                <i class="bi bi-calendar3"></i>

                Periode Tahun Ajaran: {{ $periode }}

            </div>

            <div class="history-summary">

                <span class="summary-pill">

                    <i class="bi bi-people"></i>

                    {{ $data->count() }} Siswa

                </span>

                <span class="summary-pill">

                    <i class="bi bi-diagram-3"></i>

                    {{ $data->pluck('kelas')->unique()->count() }} Kelas

                </span>

                <span class="summary-pill">

                    <i class="bi bi-trophy"></i>

                    Peringkat Tertinggi: {{ $data->min('ranking') }}

                </span>

            </div>

        </div>

        <div class="history-action-group">

            <a href="{{ url('/hasil/' . rawurlencode($periode)) }}"
               class="btn btn-detail-history">

                <i class="bi bi-eye"></i>

                Detail

            </a>

            <form action="{{ url('/hasil/delete/' . rawurlencode($periode)) }}"
                  method="POST"
                  class="m-0"
                  onsubmit="return confirm('Yakin ingin menghapus riwayat periode {{ $periode }}? Data yang dihapus tidak dapat dikembalikan.')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger btn-delete-history">

                    <i class="bi bi-trash3"></i>

                    Hapus

                </button>

            </form>

        </div>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle history-table">

            <thead>

                <tr>

                    <th>Peringkat</th>

                    <th class="text-start">Nama Siswa</th>

                    <th>Nilai SAW</th>

                    <th>Kelas</th>

                    <th>Tanggal Simpan</th>

                </tr>

            </thead>

            <tbody>

                @foreach($data as $h)

                <tr>

                    <td>

                        @if($h->ranking == 1)

                            <span class="ranking-badge ranking-first">

                                <i class="bi bi-award me-1"></i>
                                1

                            </span>

                        @else

                            <span class="ranking-badge">

                                {{ $h->ranking }}

                            </span>

                        @endif

                    </td>

                    <td class="text-start">

                        <span class="student-name">

                            {{ $h->nama_siswa ?: ($h->siswa->nama ?? '-') }}

                        </span>

                    </td>

                    <td>

                        <span class="nilai-saw">

                            {{ number_format($h->nilai, 4) }}

                        </span>

                    </td>

                    <td>

                        <span class="kelas-badge">

                            Kelas {{ $h->kelas }}

                        </span>

                    </td>

                    <td>

                        <span class="date-text">

                            <i class="bi bi-calendar-check me-1"></i>

                            {{ $h->created_at ? $h->created_at->format('d-m-Y H:i') : '-' }}

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@empty

<div class="empty-state">

    <div class="empty-state-icon">

        <i class="bi bi-folder-x"></i>

    </div>

    @if($periodeCariValue !== '')

        <h4 class="mb-2">
            Riwayat Tidak Ditemukan
        </h4>

        <p class="text-muted mb-0">
            Tidak ada data riwayat untuk periode
            <strong>{{ $periodeCariValue }}</strong>.
            Silakan coba kata kunci periode lain atau tampilkan semua riwayat.
        </p>

    @else

        <h4 class="mb-2">
            Belum Ada Data Riwayat
        </h4>

        <p class="text-muted mb-0">
            Data riwayat hasil pembagian kelas belum tersedia.
            Silakan simpan hasil perhitungan dari halaman Hasil.
        </p>

    @endif

</div>

@endforelse

@endsection