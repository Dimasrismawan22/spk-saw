@extends('layouts.app')

@section('content')

{{-- ========================= --}}
{{-- STYLE KHUSUS DETAIL RIWAYAT --}}
{{-- ========================= --}}
<style>

    .detail-header{
        background: linear-gradient(135deg, #ffffff, #f8fbff);
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        margin-bottom: 28px;
    }

    .detail-icon-box{
        width: 58px;
        height: 58px;
        border-radius: 18px;
        background: linear-gradient(135deg, #2563eb, #38bdf8);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.28);
    }

    .detail-title{
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.6px;
        margin-bottom: 6px;
    }

    .detail-subtitle{
        color: #64748b;
        margin-bottom: 0;
        font-weight: 500;
    }

    .period-highlight{
        color: #2563eb;
        font-weight: 800;
    }

    .detail-action-wrapper{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .btn-back-history,
    .btn-export-history{
        border-radius: 14px;
        padding: 10px 16px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .detail-card{
        border: 0 !important;
        border-radius: 22px !important;
        overflow: hidden;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.07) !important;
        background: #ffffff;
    }

    .detail-card-header-dark{
        background: linear-gradient(135deg, #0f172a, #1e293b);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-card-header-info{
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: #ffffff;
        padding: 18px 22px;
        font-weight: 800;
    }

    .detail-table{
        margin-bottom: 0;
    }

    .detail-table thead th{
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

    .detail-table tbody td{
        padding: 15px 14px;
        color: #334155;
        border-color: #eef2f7;
        vertical-align: middle;
    }

    .detail-table tbody tr:hover{
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

    .kelas-title{
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .kelas-count{
        background: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        padding: 7px 11px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 13px;
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

    .empty-detail{
        background: #ffffff;
        border-radius: 22px;
        padding: 40px 25px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.06);
        text-align: center;
        border: 1px solid #eef2f7;
    }

    .empty-icon{
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

    @media(max-width: 768px){

        .detail-header{
            padding: 22px;
        }

        .detail-header .d-flex{
            align-items: flex-start !important;
        }

        .detail-title{
            font-size: 24px;
        }

        .detail-action-wrapper .btn{
            width: 100%;
            justify-content: center;
        }

    }

</style>

{{-- ========================= --}}
{{-- HEADER HALAMAN --}}
{{-- ========================= --}}
<div class="detail-header">

    <div class="d-flex align-items-center gap-3">

        <div class="detail-icon-box">

            <i class="bi bi-journal-text"></i>

        </div>

        <div>

            <h2 class="detail-title">
                Detail Riwayat Pembagian Kelas
            </h2>

            <p class="detail-subtitle">
                Periode Tahun Ajaran:
                <span class="period-highlight">
                    {{ $periode }}
                </span>
            </p>

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- TOMBOL AKSI --}}
{{-- ========================= --}}
<div class="detail-action-wrapper">

    <a href="/hasil"
       class="btn btn-secondary btn-back-history">

        <i class="bi bi-arrow-left"></i>

        Kembali ke Riwayat

    </a>

    <a href="{{ url('/hasil/pdf/' . urlencode($periode)) }}"
       class="btn btn-danger btn-export-history">

        <i class="bi bi-file-earmark-pdf"></i>

        Ekspor PDF

    </a>

</div>

{{-- ========================= --}}
{{-- PERINGKAT RIWAYAT --}}
{{-- ========================= --}}
<div class="card mb-4 detail-card">

    <div class="card-header detail-card-header-dark">

        <i class="bi bi-trophy"></i>

        Hasil Peringkat

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle detail-table">

            <thead>

                <tr>

                    <th>Peringkat</th>

                    <th class="text-start">Nama Siswa</th>

                    <th>Nilai SAW</th>

                    <th>Kelas</th>

                </tr>

            </thead>

            <tbody>

                @forelse($hasil as $h)

                <tr
                    @if($h->ranking == 1)
                        class="table-success"
                    @endif
                >

                    {{-- PERINGKAT --}}
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

                    {{-- NAMA --}}
                    <td class="text-start">

                        <span class="student-name">

                            {{ $h->nama_siswa ?: ($h->siswa->nama ?? '-') }}

                        </span>

                    </td>

                    {{-- NILAI --}}
                    <td>

                        <span class="nilai-saw">

                            {{ number_format($h->nilai, 4) }}

                        </span>

                    </td>

                    {{-- KELAS --}}
                    <td>

                        <span class="kelas-badge">

                            Kelas {{ $h->kelas }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4">

                        Data riwayat belum tersedia.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

{{-- ========================= --}}
{{-- PEMBAGIAN KELAS --}}
{{-- ========================= --}}
<hr class="section-divider">

<h3 class="section-heading">
    Pembagian Kelas
</h3>

@forelse($kelasGrouped as $kelas => $data)

<div class="card mb-4 detail-card">

    <div class="card-header detail-card-header-info d-flex justify-content-between align-items-center">

        <div class="kelas-title">

            <i class="bi bi-diagram-3"></i>

            Kelas {{ $kelas }}

        </div>

        <span class="kelas-count">

            {{ count($data) }} Siswa

        </span>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-center align-middle detail-table">

            <thead>

                <tr>

                    <th>No</th>

                    <th class="text-start">Nama Siswa</th>

                    <th>Peringkat</th>

                    <th>Nilai SAW</th>

                </tr>

            </thead>

            <tbody>

                @foreach($data as $i => $h)

                <tr>

                    <td>

                        <span class="ranking-badge">

                            {{ $i + 1 }}

                        </span>

                    </td>

                    <td class="text-start">

                        <span class="student-name">

                            {{ $h->nama_siswa ?: ($h->siswa->nama ?? '-') }}

                        </span>

                    </td>

                    <td>

                        {{ $h->ranking }}

                    </td>

                    <td>

                        <span class="nilai-saw">

                            {{ number_format($h->nilai, 4) }}

                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@empty

<div class="empty-detail">

    <div class="empty-icon">

        <i class="bi bi-folder-x"></i>

    </div>

    <h4 class="mb-2">
        Data Pembagian Kelas Belum Tersedia
    </h4>

    <p class="text-muted mb-0">
        Belum ada data pembagian kelas untuk periode ini.
    </p>

</div>

@endforelse

@endsection