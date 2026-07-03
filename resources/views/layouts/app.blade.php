<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        SPK Penempatan Kelas - Metode SAW
    </title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- GOOGLE FONT --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- CUSTOM STYLE --}}
    <style>

        :root{
            --primary: #2563eb;
            --primary-dark: #1e40af;
            --primary-soft: #dbeafe;

            --dark: #0f172a;
            --dark-soft: #1e293b;

            --text: #1f2937;
            --muted: #64748b;

            --bg: #f4f7fb;
            --card: #ffffff;

            --success-soft: #dcfce7;
            --danger-soft: #fee2e2;
            --warning-soft: #fef3c7;
            --info-soft: #e0f2fe;

            --radius: 18px;
            --shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            --shadow-sm: 0 6px 18px rgba(15, 23, 42, 0.06);
        }

        html,
        body{
            min-height: 100%;
        }

        body{
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.10), transparent 32%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.10), transparent 32%),
                var(--bg);
            color: var(--text);
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        a{
            text-decoration: none;
        }

        /* ========================= */
        /* NAVBAR */
        /* ========================= */
        .navbar{
            background: rgba(15, 23, 42, 0.94) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding-top: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .navbar-brand{
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -0.4px;
            color: #ffffff !important;
        }

        .brand-logo-wrap{
            width: 48px;
            height: 48px;
            border-radius: 16px;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.25);
            flex-shrink: 0;
        }

        .brand-logo{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-text{
            color: #ffffff;
            font-weight: 800;
            line-height: 1.2;
            white-space: nowrap;
        }

        .navbar-nav{
            gap: 6px;
        }

        .navbar-nav .nav-link{
            color: rgba(255, 255, 255, 0.72) !important;
            font-weight: 600;
            padding: 10px 15px !important;
            border-radius: 14px;
            transition: all 0.22s ease;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .navbar-nav .nav-link i{
            font-size: 15px;
        }

        .navbar-nav .nav-link:hover{
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-1px);
        }

        .navbar-nav .nav-link.active-menu{
            color: #ffffff !important;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 10px 24px rgba(37, 99, 235, 0.35);
        }

        .navbar-toggler{
            border: 0;
            box-shadow: none !important;
        }

        /* ========================= */
        /* TOMBOL KELUAR */
        /* ========================= */
        .logout-form{
            margin: 0;
            padding: 0;
        }

        .logout-button{
            background: transparent !important;
            border: 0 !important;
            box-shadow: none !important;
            outline: none !important;
            width: 100%;
            color: rgba(255, 255, 255, 0.72) !important;
        }

        .logout-button:hover{
            color: #ffffff !important;
            background: rgba(220, 38, 38, 0.18) !important;
            transform: translateY(-1px);
        }

        /* ========================= */
        /* MAIN CONTENT */
        /* ========================= */
        .main-content{
            flex: 1;
            padding-top: 34px;
            padding-bottom: 50px;
        }

        .page-container{
            animation: fadeIn 0.25s ease-in-out;
        }

        @keyframes fadeIn{
            from{
                opacity: 0;
                transform: translateY(8px);
            }
            to{
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================= */
        /* TYPOGRAPHY */
        /* ========================= */
        h1, h2, h3, h4, h5{
            color: var(--dark);
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .text-muted{
            color: var(--muted) !important;
        }

        /* ========================= */
        /* CARD */
        /* ========================= */
        .card{
            border: 0;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            background: var(--card);
        }

        .card.shadow-sm{
            box-shadow: var(--shadow-sm) !important;
        }

        .card-header{
            border-bottom: 0;
            padding: 16px 20px;
            font-weight: 700;
        }

        .card-body{
            padding: 22px;
        }

        .bg-primary{
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
        }

        .bg-success{
            background: linear-gradient(135deg, #16a34a, #15803d) !important;
        }

        .bg-dark{
            background: linear-gradient(135deg, #0f172a, #1e293b) !important;
        }

        .bg-info{
            background: linear-gradient(135deg, #0284c7, #0369a1) !important;
        }

        /* ========================= */
        /* FORM */
        /* ========================= */
        .form-label{
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select{
            border-radius: 14px;
            border: 1px solid #dbe3ef;
            padding: 11px 14px;
            color: var(--text);
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus{
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        small{
            color: var(--muted);
        }

        /* ========================= */
        /* BUTTON */
        /* ========================= */
        .btn{
            border-radius: 14px;
            font-weight: 700;
            padding: 10px 16px;
            border: 0;
            transition: all 0.2s ease;
        }

        .btn:hover{
            transform: translateY(-1px);
        }

        .btn-primary{
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            box-shadow: 0 8px 18px rgba(37, 99, 235, 0.24);
        }

        .btn-success{
            background: linear-gradient(135deg, #16a34a, #15803d);
            box-shadow: 0 8px 18px rgba(22, 163, 74, 0.22);
        }

        .btn-danger{
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            box-shadow: 0 8px 18px rgba(220, 38, 38, 0.22);
        }

        .btn-warning{
            color: #111827;
            background: linear-gradient(135deg, #facc15, #f59e0b);
        }

        .btn-secondary{
            background: linear-gradient(135deg, #64748b, #475569);
        }

        .btn-light{
            color: var(--dark);
            background: #ffffff;
            border: 1px solid #e5e7eb;
        }

        .btn.disabled,
        .btn:disabled{
            opacity: 0.55;
            transform: none;
            box-shadow: none;
        }

        /* ========================= */
        /* TABLE */
        /* ========================= */
        .table{
            margin-bottom: 0;
            color: var(--text);
        }

        .table thead th{
            background: #f8fafc !important;
            color: #334155;
            font-weight: 800;
            border-bottom: 1px solid #e5e7eb;
            padding: 14px;
            white-space: nowrap;
        }

        .table tbody td{
            padding: 13px 14px;
            vertical-align: middle;
            border-color: #eef2f7;
        }

        .table-bordered{
            border-color: #eef2f7;
        }

        .table-hover tbody tr:hover{
            background-color: #f8fbff;
        }

        .table-success{
            --bs-table-bg: #dcfce7;
        }

        /* ========================= */
        /* ALERT */
        /* ========================= */
        .alert{
            border: 0;
            border-radius: 16px;
            padding: 16px 18px;
            font-weight: 500;
        }

        .alert-info{
            background: var(--info-soft);
            color: #075985;
        }

        .alert-success{
            background: var(--success-soft);
            color: #166534;
        }

        .alert-danger{
            background: var(--danger-soft);
            color: #991b1b;
        }

        .alert-warning{
            background: var(--warning-soft);
            color: #92400e;
        }

        .alert-secondary{
            background: #e2e8f0;
            color: #334155;
        }

        /* ========================= */
        /* BADGE */
        /* ========================= */
        .badge{
            border-radius: 999px;
            padding: 7px 10px;
            font-weight: 700;
        }

        /* ========================= */
        /* SWEETALERT CUSTOM */
        /* ========================= */
        .swal-spk-popup{
            border-radius: 26px !important;
            padding: 30px !important;
            font-family: 'Inter', sans-serif !important;
            box-shadow: 0 25px 70px rgba(15, 23, 42, 0.30) !important;
        }

        .swal-spk-title{
            font-weight: 800 !important;
            color: #0f172a !important;
            letter-spacing: -0.4px !important;
        }

        .swal-spk-text{
            color: #64748b !important;
            font-weight: 500 !important;
        }

        .swal-spk-confirm{
            border-radius: 14px !important;
            padding: 10px 22px !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            border: 0 !important;
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25) !important;
        }

        .swal-spk-confirm-danger{
            border-radius: 14px !important;
            padding: 10px 22px !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            border: 0 !important;
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.25) !important;
        }

        .swal-spk-cancel{
            border-radius: 14px !important;
            padding: 10px 22px !important;
            font-weight: 800 !important;
            color: #ffffff !important;
            border: 0 !important;
            background: linear-gradient(135deg, #64748b, #475569) !important;
            box-shadow: 0 8px 20px rgba(100, 116, 139, 0.20) !important;
        }

        .swal2-actions{
            gap: 10px !important;
        }

        /* ========================= */
        /* FOOTER */
        /* ========================= */
        footer{
            background: rgba(15, 23, 42, 0.96);
            color: rgba(255, 255, 255, 0.75);
            padding: 22px 0;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        footer small{
            color: rgba(255, 255, 255, 0.75);
            font-weight: 500;
        }

        /* ========================= */
        /* RESPONSIVE */
        /* ========================= */
        @media (max-width: 991px){

            .brand-text{
                font-size: 16px;
                white-space: normal;
            }

            .brand-logo-wrap{
                width: 42px;
                height: 42px;
            }

            .navbar-nav{
                padding-top: 14px;
            }

            .navbar-nav .nav-link{
                margin-bottom: 6px;
            }

            .main-content{
                padding-top: 24px;
            }

            .card-body{
                padding: 18px;
            }
        }

    </style>

</head>

<body>

{{-- ========================= --}}
{{-- NAVBAR --}}
{{-- ========================= --}}
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">

    <div class="container">

        {{-- LOGO --}}
        <a class="navbar-brand"
           href="/siswa">

            <span class="brand-logo-wrap">

                <img src="{{ asset('images/logo-smpn1-pamekasan.png') }}"
                     alt="Logo SMPN 1 Pamekasan"
                     class="brand-logo">

            </span>

            <span class="brand-text">
                SMPN 1 Pamekasan
            </span>

        </a>

        {{-- TOGGLER MOBILE --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>

        {{-- MENU --}}
        <div class="collapse navbar-collapse"
             id="navbarNav">

            <ul class="navbar-nav ms-auto">

                {{-- DATA SISWA --}}
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('siswa*') ? 'active-menu' : '' }}"
                       href="/siswa">

                        <i class="bi bi-people"></i>
                        Data Siswa

                    </a>

                </li>

                {{-- PRESTASI --}}
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('prestasi*') ? 'active-menu' : '' }}"
                       href="/prestasi">

                        <i class="bi bi-trophy"></i>
                        Prestasi

                    </a>

                </li>

                {{-- KRITERIA --}}
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('kriteria*') ? 'active-menu' : '' }}"
                       href="/kriteria">

                        <i class="bi bi-list-check"></i>
                        Kriteria

                    </a>

                </li>

                {{-- HASIL SAW --}}
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('saw*') ? 'active-menu' : '' }}"
                       href="/saw">

                        <i class="bi bi-graph-up-arrow"></i>
                        Hasil

                    </a>

                </li>

                {{-- RIWAYAT --}}
                <li class="nav-item">

                    <a class="nav-link {{ request()->is('hasil*') ? 'active-menu' : '' }}"
                       href="/hasil">

                        <i class="bi bi-clock-history"></i>
                        Riwayat

                    </a>

                </li>

                {{-- KELUAR --}}
                @auth

                    <li class="nav-item">

                        <form action="/logout"
                              method="POST"
                              class="logout-form">

                            @csrf

                            <button type="submit"
                                    class="nav-link logout-button"
                                    onclick="return confirm('Yakin ingin keluar dari sistem?')">

                                <i class="bi bi-box-arrow-right"></i>

                                Keluar

                            </button>

                        </form>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

{{-- ========================= --}}
{{-- CONTENT --}}
{{-- ========================= --}}
<main class="main-content">

    <div class="container page-container">

        @yield('content')

    </div>

</main>

{{-- ========================= --}}
{{-- FOOTER --}}
{{-- ========================= --}}
<footer class="text-center">

    <div class="container">

        <small>
            &copy; {{ date('Y') }}
            Sistem Pendukung Keputusan Penempatan Kelas
            SMPN 1 Pamekasan
        </small>

    </div>

</footer>

{{-- ========================= --}}
{{-- BOOTSTRAP JS --}}
{{-- ========================= --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- ========================= --}}
{{-- SWEETALERT2 --}}
{{-- ========================= --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- ========================= --}}
{{-- KONFIRMASI MODERN SWEETALERT --}}
{{-- ========================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        // =========================
        // AMBIL PESAN DARI confirm('...')
        // =========================
        function extractConfirmMessage(attributeValue) {

            if (!attributeValue) {
                return 'Yakin ingin melanjutkan proses ini?';
            }

            const match = attributeValue.match(/confirm\((['"`])([\s\S]*?)\1\)/);

            if (match && match[2]) {

                return match[2]
                    .replace(/\\'/g, "'")
                    .replace(/\\"/g, '"');

            }

            return 'Yakin ingin melanjutkan proses ini?';
        }

        // =========================
        // TAMPILKAN SWEETALERT
        // =========================
        function showConfirmation(message, onConfirmed) {

            const lowerMessage = message.toLowerCase();

            const isDanger =
                lowerMessage.includes('hapus') ||
                lowerMessage.includes('menghapus') ||
                lowerMessage.includes('delete');

            const isKeluar =
                lowerMessage.includes('keluar');

            Swal.fire({

                title: isDanger
                    ? 'Konfirmasi Hapus Data'
                    : (isKeluar ? 'Konfirmasi Keluar' : 'Konfirmasi'),

                text: message,

                icon: isDanger ? 'warning' : 'question',

                showCancelButton: true,

                confirmButtonText: isDanger
                    ? 'Ya, Hapus'
                    : (isKeluar ? 'Ya, Keluar' : 'Ya, Lanjutkan'),

                cancelButtonText: 'Batal',

                reverseButtons: true,

                focusCancel: true,

                buttonsStyling: false,

                customClass: {

                    popup: 'swal-spk-popup',

                    title: 'swal-spk-title',

                    htmlContainer: 'swal-spk-text',

                    confirmButton: isDanger
                        ? 'swal-spk-confirm-danger'
                        : 'swal-spk-confirm',

                    cancelButton: 'swal-spk-cancel',
                },

            }).then(function (result) {

                if (result.isConfirmed) {
                    onConfirmed();
                }

            });
        }

        // =========================
        // HANDLE onclick="return confirm(...)"
        // UNTUK LINK DAN BUTTON
        // =========================
        document.addEventListener('click', function (event) {

            const target =
                event.target.closest('a, button, input[type="submit"]');

            if (!target) {
                return;
            }

            const onclickValue =
                target.getAttribute('onclick');

            if (!onclickValue || !onclickValue.includes('confirm(')) {
                return;
            }

            event.preventDefault();
            event.stopImmediatePropagation();

            const message =
                extractConfirmMessage(onclickValue);

            showConfirmation(message, function () {

                // JIKA LINK
                if (target.tagName.toLowerCase() === 'a') {

                    const href = target.getAttribute('href');

                    if (href && href !== '#') {
                        window.location.href = href;
                    }

                    return;
                }

                // JIKA BUTTON DALAM FORM
                const form = target.closest('form');

                if (form) {
                    HTMLFormElement.prototype.submit.call(form);
                }

            });

        }, true);

        // =========================
        // HANDLE onsubmit="return confirm(...)"
        // UNTUK FORM
        // =========================
        document.addEventListener('submit', function (event) {

            const form = event.target;

            const onsubmitValue =
                form.getAttribute('onsubmit');

            if (!onsubmitValue || !onsubmitValue.includes('confirm(')) {
                return;
            }

            event.preventDefault();
            event.stopImmediatePropagation();

            const message =
                extractConfirmMessage(onsubmitValue);

            showConfirmation(message, function () {

                HTMLFormElement.prototype.submit.call(form);

            });

        }, true);

    });

</script>

{{-- ========================= --}}
{{-- VALIDASI FORM BAHASA INDONESIA --}}
{{-- ========================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        // =========================
        // LABEL FIELD
        // =========================
        const fieldLabels = {

            // MASUK
            email: 'Email',
            password: 'Kata sandi',

            // SISWA
            nama: 'Nama siswa',
            nisn: 'NISN',
            rata_rata_raport: 'Nilai rata-rata raport',
            tes_matematika: 'Nilai tes Matematika',
            tes_ipa: 'Nilai tes IPA',
            tes_ips: 'Nilai tes IPS',

            // PRESTASI
            siswa_id: 'Nama siswa',
            nama_prestasi: 'Nama prestasi',
            tingkat: 'Tingkat prestasi',
            tahun_prestasi: 'Tahun prestasi',
            keterangan: 'Keterangan',

            // SAW
            jumlah_kelas: 'Jumlah kelas',
            maksimal_siswa_per_kelas: 'Maksimal siswa per kelas',
            periode: 'Periode tahun ajaran',
        };

        // =========================
        // AMBIL LABEL FIELD
        // =========================
        function getFieldLabel(input) {

            const name = input.getAttribute('name');

            if (name && fieldLabels[name]) {
                return fieldLabels[name];
            }

            const wrapper = input.closest('.mb-3, .col-md-3, .col-md-4, .col-md-6, .col-md-8, .form-group');

            if (wrapper) {

                const label = wrapper.querySelector('label');

                if (label) {
                    return label.textContent.trim();
                }

            }

            return 'Field ini';
        }

        // =========================
        // PESAN VALIDASI INDONESIA
        // =========================
        function getValidationMessage(input) {

            const label = getFieldLabel(input);

            const validity = input.validity;

            if (validity.valueMissing) {
                return label + ' wajib diisi.';
            }

            if (validity.patternMismatch) {

                if (input.name === 'nisn') {
                    return 'NISN harus terdiri dari 10 digit angka.';
                }

                if (input.name === 'periode') {
                    return 'Format periode tahun ajaran harus seperti 2025/2026.';
                }

                if (input.name === 'tahun_prestasi') {
                    return 'Tahun prestasi harus terdiri dari 4 digit angka.';
                }

                return 'Format ' + label.toLowerCase() + ' tidak sesuai.';
            }

            if (validity.rangeUnderflow) {
                return label + ' minimal ' + input.min + '.';
            }

            if (validity.rangeOverflow) {
                return label + ' maksimal ' + input.max + '.';
            }

            if (validity.tooShort) {
                return label + ' minimal ' + input.minLength + ' karakter.';
            }

            if (validity.tooLong) {
                return label + ' maksimal ' + input.maxLength + ' karakter.';
            }

            if (validity.typeMismatch) {

                if (input.type === 'email') {
                    return 'Format email tidak valid.';
                }

                return 'Format ' + label.toLowerCase() + ' tidak valid.';
            }

            if (validity.badInput) {
                return label + ' harus berupa angka yang valid.';
            }

            if (validity.stepMismatch) {
                return label + ' tidak sesuai dengan format angka yang diperbolehkan.';
            }

            return 'Input ' + label.toLowerCase() + ' tidak valid.';
        }

        // =========================
        // TERAPKAN KE SEMUA INPUT
        // =========================
        document.querySelectorAll('input, select, textarea').forEach(function (input) {

            input.addEventListener('invalid', function () {

                input.setCustomValidity('');

                if (!input.validity.valid) {
                    input.setCustomValidity(getValidationMessage(input));
                }

            });

            input.addEventListener('input', function () {
                input.setCustomValidity('');
            });

            input.addEventListener('change', function () {
                input.setCustomValidity('');
            });

        });

    });

</script>

</body>
</html>