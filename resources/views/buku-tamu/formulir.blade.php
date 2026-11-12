<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Tamu | Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #12294a;
            --navy-dark: #0b1b33;
            --navy-light: #1f4172;
            --gold: #c9a24d;
            --gold-light: #e8d5a3;
            --gold-dark: #a9822f;
            --ivory: #fbf8f1;
            --text: #1e293b;
            --muted: #64748b;
            --line: rgba(18, 41, 74, 0.10);
            --danger: #c13a48;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            padding: 24px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 8% 12%, rgba(31, 65, 114, .16) 0, transparent 30%),
                radial-gradient(circle at 92% 88%, rgba(201, 162, 77, .22) 0, transparent 32%),
                radial-gradient(rgba(18, 41, 74, .07) 1px, transparent 1px),
                #f1ede4;
            background-size: auto, auto, 22px 22px, auto;
            background-attachment: fixed;
        }

        /* LINGKARAN DEKORASI */
        .decoration {
            position: fixed;
            border: 1px solid rgba(201, 162, 77, .45);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .decoration.one { width: 340px; height: 340px; top: -140px; left: -110px; }
        .decoration.two { width: 440px; height: 440px; bottom: -170px; right: -110px; }

        /* KARTU UTAMA */
        .container {
            width: 100%;
            max-width: 760px;
            position: relative;
            z-index: 1;
            overflow: hidden;
            border-radius: 28px;
            background: var(--ivory);
            border: 1px solid var(--line);
            box-shadow: 0 30px 80px rgba(11, 27, 51, .20);
            animation: muncul .8s ease both;
        }

        .top-line {
            height: 8px;
            background: linear-gradient(90deg, var(--navy-dark), var(--gold), var(--navy-light));
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 32px;
            border-bottom: 1px solid var(--line);
        }

        .back-button {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 6px 16px rgba(0, 0, 0, .22);
            text-decoration: none;
            transition: transform .25s;
        }

        .back-button:hover {
            transform: translateX(-3px);
        }

        .back-button:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .icon {
            width: 22px;
            height: 22px;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.6;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .header h1 {
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
            line-height: 1.2;
        }

        .header p {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        /* ISI */
        .content {
            padding: 38px 56px 42px;
        }

        .step-label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .step-label::before {
            content: "";
            width: 34px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .title {
            margin-bottom: 12px;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 44px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .description {
            margin-bottom: 30px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.8;
        }

        /* FORM */
        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 700;
        }

        .required {
            color: var(--danger);
        }

        .optional {
            color: #94a3b8;
            font-size: 12px;
            font-weight: 500;
        }

        .input-wrapper input,
        .input-wrapper textarea {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid rgba(18, 41, 74, .15);
            border-radius: 14px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: .2s;
        }

        .input-wrapper input {
            min-height: 52px;
        }

        .input-wrapper textarea {
            min-height: 110px;
            resize: vertical;
        }

        .input-wrapper input::placeholder,
        .input-wrapper textarea::placeholder {
            color: #a3adbb;
        }

        .input-wrapper input:focus,
        .input-wrapper textarea:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, .22);
        }

        .helper {
            margin-top: 7px;
            color: #94a3b8;
            font-size: 12px;
        }

        .error {
            margin-top: 6px;
            color: var(--danger);
            font-size: 12px;
        }

        .error-box {
            margin-bottom: 24px;
            padding: 14px 18px;
            color: #9b2535;
            font-size: 13px;
            line-height: 1.6;
            background: #fbe9e9;
            border: 1px solid #f1c6c9;
            border-radius: 14px;
        }

        .error-box ul {
            margin-top: 8px;
            padding-left: 20px;
        }

        /* TOMBOL */
        .navigation {
            display: flex;
            gap: 14px;
            margin-top: 34px;
        }

        .btn {
            min-height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-radius: 999px;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .3px;
            cursor: pointer;
            transition: transform .25s, box-shadow .25s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-back {
            padding: 0 30px;
            color: var(--navy);
            background: white;
            border: 1.5px solid var(--navy);
        }

        .btn-back:hover {
            color: white;
            background: var(--navy);
        }

        /* tombol utama: gaya sama dengan slider di halaman awal */
        .btn-next {
            flex: 1;
            padding: 0 7px 0 28px;
            border: none;
            color: white;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow:
                0 14px 30px rgba(18, 41, 74, .30),
                inset 0 0 0 1px rgba(255, 255, 255, .06);
        }

        .btn-next .btn-icon {
            width: 42px;
            height: 42px;
            margin-left: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 5px 12px rgba(0, 0, 0, .28);
        }

        .btn-next .btn-icon .icon {
            width: 20px;
            height: 20px;
        }

        .btn-next:focus-visible,
        .btn-back:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        /* FOOTER */
        .footer {
            padding: 20px;
            text-align: center;
            color: #7b8799;
            font-size: 12px;
            line-height: 1.8;
            background: #f3efe6;
            border-top: 1px solid var(--line);
        }

        @keyframes muncul {
            from { opacity: 0; transform: scale(.98); }
            to   { opacity: 1; transform: scale(1); }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
            }
        }

        @media (min-width: 900px) {
            .container {
                max-width: 850px;
            }

            .content {
                padding: 46px 85px 50px;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
                align-items: flex-start;
            }

            .container {
                margin: 8px 0;
                border-radius: 22px;
            }

            .top-line {
                height: 6px;
            }

            .header {
                padding: 18px;
                gap: 12px;
            }

            .back-button {
                width: 40px;
                height: 40px;
            }

            .header h1 {
                font-size: 17px;
            }

            .content {
                padding: 26px 18px 30px;
            }

            .step-label {
                font-size: 9px;
                letter-spacing: 2px;
            }

            .description {
                font-size: 13px;
            }

            .form-group label {
                font-size: 13px;
            }

            .input-wrapper input,
            .input-wrapper textarea {
                font-size: 13px;
            }

            .btn {
                min-height: 52px;
                font-size: 14px;
            }

            .btn-back {
                padding: 0 20px;
            }

            .btn-next {
                padding-left: 20px;
            }

            .btn-next .btn-icon {
                width: 38px;
                height: 38px;
            }

            .footer {
                padding: 16px 12px;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>

<div class="decoration one"></div>
<div class="decoration two"></div>

<div class="container">

    <div class="top-line"></div>

    <header class="header">
        <a href="{{ route('buku-tamu.survei') }}" class="back-button" aria-label="Kembali">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 12H5M11 6l-6 6 6 6"/>
            </svg>
        </a>

        <div>
            <h1>Identitas Tamu</h1>
            <p>Formulir pengisian data pengunjung</p>
        </div>
    </header>

    <main class="content">

        <span class="step-label">Tahap 04 · Identitas Pengunjung</span>

        <h2 class="title">Data Diri Anda</h2>

        <p class="description">
            Silakan lengkapi identitas diri Anda dengan benar
            untuk keperluan administrasi kunjungan.
        </p>

        @if ($errors->any())
            <div class="error-box">
                <strong>Periksa kembali data yang dimasukkan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku-tamu.identitas.simpan') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">
                    Nama Lengkap <span class="required">*</span>
                </label>

                <div class="input-wrapper">
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        required
                    >
                </div>

                @error('nama')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="telepon">
                    Nomor Telepon <span class="required">*</span>
                </label>

                <div class="input-wrapper">
                    <input
                        type="tel"
                        id="telepon"
                        name="telepon"
                        value="{{ old('telepon') }}"
                        placeholder="Contoh: 08123456789"
                        autocomplete="tel"
                        pattern="[0-9+() -]{8,20}"
                        required
                    >
                </div>

                <p class="helper">
                    Masukkan nomor telepon yang dapat dihubungi.
                </p>

                @error('telepon')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">
                    Alamat <span class="required">*</span>
                </label>

                <div class="input-wrapper">
                    <textarea
                        id="alamat"
                        name="alamat"
                        placeholder="Masukkan alamat lengkap"
                        autocomplete="street-address"
                        required
                    >{{ old('alamat') }}</textarea>
                </div>

                @error('alamat')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="instansi">
                    Instansi / Lembaga
                    <span class="optional">(Opsional)</span>
                </label>

                <div class="input-wrapper">
                    <input
                        type="text"
                        id="instansi"
                        name="instansi"
                        value="{{ old('instansi') }}"
                        placeholder="Contoh: Mahasiswa, Instansi, dll."
                    >
                </div>

                @error('instansi')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="navigation">

                <a href="{{ route('buku-tamu.survei') }}" class="btn btn-back">
                    Kembali
                </a>

                <button type="submit" class="btn btn-next">
                    Lanjutkan
                    <span class="btn-icon">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </span>
                </button>

            </div>

        </form>

    </main>

    <footer class="footer">
        © 2026 Dinas Arsip dan Perpustakaan Kabupaten Cirebon
        <br>
        Terima kasih telah berkunjung.
    </footer>

</div>

</body>
</html>