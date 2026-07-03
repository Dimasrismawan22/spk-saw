<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Hasil Riwayat Pembagian Kelas
    </title>

    <style>

        @page{
            margin: 28px;
        }

        body{
            font-family: "Times New Roman", Times, serif;
            font-size: 13px;
            color: #1f2937;
            line-height: 1.55;
        }

        h1, h2, h3, h4{
            margin: 0;
        }

        /* ========================= */
        /* HEADER */
        /* ========================= */
        .header{
            text-align: center;
            padding-bottom: 14px;
            border-bottom: 4px solid #1F3A5F;
            margin-bottom: 18px;
        }

        .header-title{
            font-size: 24px;
            font-weight: bold;
            color: #1F3A5F;
            margin-bottom: 8px;
        }

        .school-name{
            font-size: 16px;
            font-weight: bold;
            color: #374151;
            margin-top: 6px;
        }

        /* ========================= */
        /* INFO */
        /* ========================= */
        .info-wrapper{
            width: 100%;
            margin-bottom: 18px;
        }

        .info-table{
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td{
            border: none;
            padding: 4px 0;
            font-size: 13px;
        }

        .info-label{
            width: 130px;
            color: #4b5563;
        }

        .info-value{
            font-weight: bold;
            color: #111827;
        }

        .print-date{
            text-align: right;
            color: #4b5563;
            font-size: 13px;
        }

        /* ========================= */
        /* SECTION */
        /* ========================= */
        .section-title{
            background-color: #1F3A5F;
            color: #ffffff;
            padding: 9px 11px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 18px;
            margin-bottom: 10px;
            border-radius: 4px;
            letter-spacing: 0.3px;
        }

        /* ========================= */
        /* TABLE */
        /* ========================= */
        table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        th{
            background-color: #DCE6F1;
            color: #111827;
            border: 1px solid #9ca3af;
            padding: 8px;
            font-weight: bold;
            text-align: center;
        }

        td{
            border: 1px solid #d1d5db;
            padding: 8px;
            vertical-align: middle;
        }

        tr:nth-child(even){
            background-color: #F8FAFC;
        }

        .text-left{
            text-align: left;
        }

        .text-center{
            text-align: center;
        }

        .nilai{
            font-weight: bold;
            color: #1F3A5F;
        }

        .kelas-badge{
            display: inline-block;
            padding: 4px 10px;
            background-color: #DCE6F1;
            color: #1F3A5F;
            border-radius: 12px;
            font-weight: bold;
        }

        .peringkat-satu{
            font-weight: bold;
            color: #166534;
        }

        /* ========================= */
        /* KELAS */
        /* ========================= */
        .kelas-title{
            font-size: 15px;
            font-weight: bold;
            color: #1F3A5F;
            margin-top: 14px;
            margin-bottom: 8px;
            padding-left: 6px;
            border-left: 4px solid #1F3A5F;
        }

        .page-break-avoid{
            page-break-inside: avoid;
        }

        /* ========================= */
        /* FOOTER */
        /* ========================= */
        .footer{
            margin-top: 55px;
            text-align: right;
        }

        .footer p{
            margin: 4px 0;
        }

        .signature-space{
            height: 70px;
        }

        .signature-line{
            width: 220px;
            border-top: 1px solid #111827;
            margin-left: auto;
            margin-bottom: 5px;
        }

    </style>

</head>

<body>

@php
    $periodePdf = $periode ?? '-';
@endphp

{{-- ========================= --}}
{{-- HEADER --}}
{{-- ========================= --}}
<div class="header">

    <div class="header-title">
        LAPORAN HASIL RIWAYAT PEMBAGIAN KELAS
    </div>

    <div class="school-name">
        SMPN 1 PAMEKASAN
    </div>

</div>

{{-- ========================= --}}
{{-- INFORMASI LAPORAN --}}
{{-- ========================= --}}
<div class="info-wrapper">

    <table class="info-table">

        <tr>

            <td>

                <table class="info-table">

                    <tr>
                        <td class="info-label">
                            Tahun Ajaran
                        </td>

                        <td class="info-value">
                            : {{ $periodePdf }}
                        </td>
                    </tr>

                    <tr>
                        <td class="info-label">
                            Total Siswa
                        </td>

                        <td class="info-value">
                            : {{ $totalSiswa ?? 0 }} Siswa
                        </td>
                    </tr>

                    <tr>
                        <td class="info-label">
                            Jumlah Kelas
                        </td>

                        <td class="info-value">
                            : {{ $jumlahKelas ?? 0 }} Kelas
                        </td>
                    </tr>

                </table>

            </td>

            <td class="print-date">

                Dicetak pada:
                <b>{{ date('d-m-Y') }}</b>

            </td>

        </tr>

    </table>

</div>

{{-- ========================= --}}
{{-- HASIL PERINGKAT --}}
{{-- ========================= --}}
<div class="section-title">
    HASIL PERINGKAT
</div>

<table>

    <thead>

        <tr>

            <th width="13%">
                Peringkat
            </th>

            <th width="42%">
                Nama Siswa
            </th>

            <th width="22%">
                Nilai SAW
            </th>

            <th width="23%">
                Kelas
            </th>

        </tr>

    </thead>

    <tbody>

        @forelse($ranking as $r)

            <tr>

                <td class="text-center">

                    @if($r['ranking'] == 1)

                        <span class="peringkat-satu">
                            {{ $r['ranking'] }}
                        </span>

                    @else

                        {{ $r['ranking'] }}

                    @endif

                </td>

                <td class="text-left">
                    {{ $r['nama'] }}
                </td>

                <td class="text-center nilai">
                    {{ number_format($r['nilai'], 4) }}
                </td>

                <td class="text-center">

                    <span class="kelas-badge">
                        Kelas {{ $r['kelas'] }}
                    </span>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="text-center">
                    Data peringkat belum tersedia.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>

{{-- ========================= --}}
{{-- PEMBAGIAN KELAS --}}
{{-- ========================= --}}
<div class="section-title">
    PEMBAGIAN KELAS
</div>

@forelse($kelasGrouped as $kelas => $data)

    <div class="page-break-avoid">

        <div class="kelas-title">
            Kelas {{ $kelas }}
        </div>

        <table>

            <thead>

                <tr>

                    <th width="12%">
                        No
                    </th>

                    <th width="48%">
                        Nama Siswa
                    </th>

                    <th width="20%">
                        Peringkat
                    </th>

                    <th width="20%">
                        Nilai SAW
                    </th>

                </tr>

            </thead>

            <tbody>

                @foreach($data as $i => $s)

                    <tr>

                        <td class="text-center">
                            {{ $i + 1 }}
                        </td>

                        <td class="text-left">
                            {{ $s['nama'] }}
                        </td>

                        <td class="text-center">
                            {{ $s['ranking'] ?? '-' }}
                        </td>

                        <td class="text-center nilai">
                            {{ number_format($s['nilai'], 4) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@empty

    <p>
        Data pembagian kelas belum tersedia.
    </p>

@endforelse

{{-- ========================= --}}
{{-- FOOTER --}}
{{-- ========================= --}}
<div class="footer">

    <p>
        Pamekasan, {{ date('d-m-Y') }}
    </p>

    <p>
        Mengetahui,
    </p>

    <div class="signature-space"></div>

    <div class="signature-line"></div>

    <p>
        Wakil Kesiswaan
    </p>

</div>

</body>
</html>