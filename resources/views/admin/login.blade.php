<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- GOOGLE RECAPTCHA V2 -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #F7F5FA;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px;
        }

        .login-container {
            width: 100%;
            max-width: 1150px;
            min-height: 650px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(53, 16, 63, 0.13);
        }

        /* BAGIAN KIRI */
        .login-brand {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 55px;
            color: #35103F;
            background:
                linear-gradient(
                    135deg,
                    rgba(255,255,255,0.93),
                    rgba(244,238,255,0.84)
                ),
                url("{{ asset('images/dinas arsip.jpg') }}");
            background-size: cover;
            background-position: center;
        }

        .brand-content {
            position: relative;
            z-index: 1;
        }

        .brand-logo {
            display: block;
            width: 95px;
            height: 95px;
            object-fit: contain;
            margin: 0 auto 22px;
        }

        .brand-label {
            display: block;
            width: fit-content;
            padding: 8px 15px;
            background: #F4EEFF;
            color: #8955ED;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .brand-content h1 {
            font-size: 32px;
            line-height: 1.4;
            font-weight: 800;
            color: #35103F;
            margin-bottom: 15px;
        }

        .brand-content p {
            font-size: 14px;
            line-height: 1.9;
            color: #62566A;
            max-width: 430px;
        }

        .brand-footer {
            position: relative;
            z-index: 1;
            font-size: 12px;
            color: #766B7D;
            border-top: 1px solid rgba(53,16,63,0.12);
            padding-top: 20px;
        }

        /* BAGIAN KANAN */
        .login-form-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 55px 60px;
            background: #fff;
        }

        .form-heading {
            margin-bottom: 32px;
        }

        .form-heading .small-title {
            color: #8955ED;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .form-heading h2 {
            color: #35103F;
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-heading p {
            color: #8A8290;
            font-size: 13px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #453B4B;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 9px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #E5DFEA;
            border-radius: 11px;
            font-size: 13px;
            color: #35103F;
            outline: none;
            background: #FCFBFD;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #8955ED;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(137,85,237,0.09);
        }

        .form-group input::placeholder {
            color: #B1A9B8;
        }

        /* GOOGLE RECAPTCHA */
        .captcha-box {
            padding: 15px;
            background: #F7F3FF;
            border: 1px solid #E9DFFF;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .captcha-title {
            font-size: 13px;
            font-weight: 600;
            color: #453B4B;
            margin-bottom: 12px;
        }

        .captcha-widget {
            display: flex;
            justify-content: flex-start;
            overflow-x: auto;
            max-width: 100%;
        }

        .captcha-error {
            color: #B42318;
            font-size: 12px;
            margin-top: 10px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #716879;
            font-size: 12px;
            margin-bottom: 24px;
            cursor: pointer;
        }

        .remember input {
            accent-color: #8955ED;
            width: 15px;
            height: 15px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 11px;
            background: #8955ED;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
            box-shadow: 0 6px 15px rgba(137,85,237,0.2);
        }

        .btn-login:hover {
            background: #7040D0;
            transform: translateY(-1px);
        }

        .error-message {
            padding: 13px 15px;
            background: #FFF0F0;
            color: #B42318;
            border: 1px solid #FFDADA;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .success-message {
            padding: 13px 15px;
            background: #ECFDF3;
            color: #187344;
            border: 1px solid #C8F0D8;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 20px;
        }

        .back-home {
            text-align: center;
            margin-top: 25px;
        }

        .back-home a {
            color: #8955ED;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
        }

        .back-home a:hover {
            text-decoration: underline;
        }

        /* RESPONSIVE */
        @media (max-width: 850px) {
            body {
                padding: 20px;
            }

            .login-container {
                max-width: 550px;
                grid-template-columns: 1fr;
            }

            .login-brand {
                min-height: 300px;
                padding: 35px;
            }

            .brand-logo {
                width: 70px;
                height: 70px;
                margin-bottom: 15px;
            }

            .brand-content h1 {
                font-size: 25px;
            }

            .brand-footer {
                margin-top: 30px;
            }

            .login-form-section {
                padding: 40px 35px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 12px;
            }

            .login-container {
                border-radius: 17px;
            }

            .login-brand {
                min-height: 270px;
                padding: 27px;
            }

            .brand-content h1 {
                font-size: 22px;
            }

            .login-form-section {
                padding: 32px 25px;
            }

            .form-heading h2 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <!-- BAGIAN KIRI: IDENTITAS INSTANSI -->
    <section class="login-brand">

        <div class="brand-content">

            <img
                src="{{ asset('images/logo cirebon.png') }}"
                alt="Logo Kabupaten Cirebon"
                class="brand-logo"
            >

            <div class="brand-label">
                SISTEM INFORMASI PELAYANAN
            </div>

            <h1>
                Buku Tamu Digital
            </h1>

            <p>
                Dinas Kearsipan dan Perpustakaan Kabupaten Cirebon.
                Sistem informasi untuk mendukung pelayanan kunjungan
                yang lebih mudah, tertib, dan efisien.
            </p>

        </div>

        <div class="brand-footer">
            © {{ date('Y') }} Dinas Kearsipan dan Perpustakaan Kabupaten Cirebon
        </div>

    </section>


    <!-- BAGIAN KANAN: FORM LOGIN -->
    <section class="login-form-section">

        <div class="form-heading">

            <div class="small-title">
                ADMINISTRATOR AREA
            </div>

            <h2>Selamat Datang!</h2>

            <p>
                Silakan masuk menggunakan akun administrator
                untuk mengakses halaman pengelolaan sistem.
            </p>

        </div>


        <!-- NOTIFIKASI BERHASIL -->
        @if (session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif


        <!-- NOTIFIKASI ERROR -->
        @if ($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif


        <!-- FORM LOGIN -->
        <form action="{{ route('admin.authenticate') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="email">Email Administrator</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan email admin"
                    value="{{ old('email') }}"
                    autocomplete="username"
                    required
                    autofocus
                >
            </div>


            <div class="form-group">
                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
            </div>


            <!-- GOOGLE RECAPTCHA V2 -->
            <div class="captcha-box">

                <div class="captcha-title">
                    Verifikasi Keamanan
                </div>

                <div class="captcha-widget">
                    <div
                        class="g-recaptcha"
                        data-sitekey="{{ $siteKey }}"
                    ></div>
                </div>

                @error('captcha')
                    <div class="captcha-error">
                        {{ $message }}
                    </div>
                @enderror

                @error('g-recaptcha-response')
                    <div class="captcha-error">
                        {{ $message }}
                    </div>
                @enderror

            </div>


            <!-- INGAT SAYA -->
            <label class="remember">

                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    {{ old('remember') ? 'checked' : '' }}
                >

                Ingat saya

            </label>


            <!-- TOMBOL LOGIN -->
            <button type="submit" class="btn-login">
                MASUK KE DASHBOARD
            </button>

        </form>


        <!-- KEMBALI KE HALAMAN UTAMA -->
        <div class="back-home">

            <a href="{{ route('home') }}">
                ← Kembali ke Halaman Utama
            </a>

        </div>

    </section>

</div>

</body>
</html>