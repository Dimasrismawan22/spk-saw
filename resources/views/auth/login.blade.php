<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Masuk - SPK SMPN 1 Pamekasan
    </title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- BOOTSTRAP ICONS --}}
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <style>

        body{
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(37, 99, 235, 0.16), transparent 35%),
                radial-gradient(circle at bottom right, rgba(14, 165, 233, 0.16), transparent 35%),
                #f4f7fb;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .login-card{
            width: 100%;
            max-width: 430px;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12);
            overflow: hidden;
            border: 1px solid #eef2f7;
        }

        .login-header{
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #ffffff;
            padding: 34px 30px;
            text-align: center;
        }

        .login-logo-wrap{
            width: 92px;
            height: 92px;
            border-radius: 26px;
            background: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            margin-bottom: 18px;
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.35);
        }

        .login-logo{
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .login-title{
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-subtitle{
            color: rgba(255, 255, 255, 0.78);
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 500;
        }

        .login-body{
            padding: 30px;
        }

        .form-label{
            font-weight: 700;
            color: #0f172a;
        }

        .form-control{
            border-radius: 14px;
            padding: 12px 14px;
            border: 1px solid #dbe3ef;
        }

        .form-control:focus{
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .btn-login{
            width: 100%;
            border-radius: 14px;
            padding: 12px;
            font-weight: 800;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border: 0;
            color: #ffffff;
            transition: all 0.2s ease;
        }

        .btn-login:hover{
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(37, 99, 235, 0.25);
        }

        .alert{
            border: 0;
            border-radius: 16px;
            padding: 14px 16px;
            font-weight: 500;
        }

        .alert-success{
            background: #dcfce7;
            color: #166534;
        }

        .alert-danger{
            background: #fee2e2;
            color: #991b1b;
        }

        .footer-text{
            text-align: center;
            color: #64748b;
            font-size: 13px;
            margin-top: 18px;
            font-weight: 500;
        }

        @media(max-width: 576px){

            .login-card{
                max-width: 100%;
            }

            .login-header{
                padding: 30px 24px;
            }

            .login-body{
                padding: 26px 22px;
            }

            .login-logo-wrap{
                width: 82px;
                height: 82px;
            }

        }

    </style>

</head>

<body>

<div class="login-card">

    {{-- HEADER --}}
    <div class="login-header">

        <div class="login-logo-wrap">

            <img src="{{ asset('images/logo-smpn1-pamekasan.png') }}"
                 alt="Logo SMPN 1 Pamekasan"
                 class="login-logo">

        </div>

        <h3 class="login-title">
            Masuk
        </h3>

        <p class="login-subtitle">
            Penempatan Kelas SMPN 1 Pamekasan
        </p>

    </div>

    {{-- BODY --}}
    <div class="login-body">

        {{-- NOTIFIKASI BERHASIL --}}
        @if(session('success'))

            <div class="alert alert-success">

                <i class="bi bi-check-circle me-1"></i>

                {{ session('success') }}

            </div>

        @endif

        {{-- KESALAHAN MASUK --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <i class="bi bi-exclamation-triangle me-1"></i>

                {{ $errors->first() }}

            </div>

        @endif

        {{-- FORM MASUK --}}
        <form action="/login"
              method="POST"
              autocomplete="off">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email"
                       autocomplete="username"
                       required
                       autofocus>

            </div>

            <div class="mb-4">

                <label class="form-label">
                    Kata Sandi
                </label>

                <input type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan kata sandi"
                       autocomplete="current-password"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-login">

                <i class="bi bi-box-arrow-in-right me-1"></i>

                Masuk

            </button>

        </form>

        <div class="footer-text">

            Akses hanya untuk Wakil Kesiswaan

        </div>

    </div>

</div>

{{-- ========================= --}}
{{-- VALIDASI FORM BAHASA INDONESIA --}}
{{-- ========================= --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const fieldLabels = {
            email: 'Email',
            password: 'Kata sandi',
        };

        function getFieldLabel(input) {

            const name = input.getAttribute('name');

            if (name && fieldLabels[name]) {
                return fieldLabels[name];
            }

            return 'Field ini';
        }

        function getValidationMessage(input) {

            const label = getFieldLabel(input);

            const validity = input.validity;

            if (validity.valueMissing) {
                return label + ' wajib diisi.';
            }

            if (validity.typeMismatch) {

                if (input.type === 'email') {
                    return 'Format email tidak valid.';
                }

                return 'Format ' + label.toLowerCase() + ' tidak valid.';
            }

            return 'Input ' + label.toLowerCase() + ' tidak valid.';
        }

        document.querySelectorAll('input').forEach(function (input) {

            input.addEventListener('invalid', function () {

                input.setCustomValidity('');

                if (!input.validity.valid) {
                    input.setCustomValidity(getValidationMessage(input));
                }

            });

            input.addEventListener('input', function () {
                input.setCustomValidity('');
            });

        });

    });

</script>

</body>
</html>