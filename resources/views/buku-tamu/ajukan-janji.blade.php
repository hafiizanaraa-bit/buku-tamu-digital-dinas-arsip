<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Janji Temu | Buku Tamu Digital</title>

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
            max-width: 640px;
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

        /* IKON */
        .icon {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.6;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 32px;
            border-bottom: 1px solid var(--line);
        }

        .back {
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

        .back:hover {
            transform: translateX(-3px);
        }

        .back:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .header h1 {
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
            line-height: 1.2;
        }

        /* ISI */
        .content {
            padding: 34px 48px 40px;
        }

        .info {
            margin-bottom: 22px;
            padding: 14px 18px;
            color: var(--navy-light);
            font-size: 13px;
            line-height: 1.7;
            background: rgba(201, 162, 77, .12);
            border: 1px dashed var(--gold);
            border-radius: 14px;
        }

        .pegawai {
            margin-bottom: 8px;
            padding: 14px 18px;
            color: var(--muted);
            font-size: 13px;
            background: white;
            border: 1px solid var(--line);
            border-left: 4px solid var(--gold);
            border-radius: 14px;
        }

        .pegawai strong {
            display: block;
            margin-top: 3px;
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
        }

        .success {
            margin-bottom: 18px;
            padding: 13px 16px;
            color: #246b34;
            font-size: 13px;
            background: #e7f5e9;
            border: 1px solid #c3e4c9;
            border-radius: 12px;
        }

        .alert-error {
            margin-bottom: 18px;
            padding: 13px 16px;
            color: #9b2535;
            font-size: 13px;
            background: #fbe9e9;
            border: 1px solid #f1c6c9;
            border-radius: 12px;
        }

        .error {
            margin-top: 7px;
            color: var(--danger);
            font-size: 12px;
        }

        /* FORM */
        .field-label {
            display: block;
            margin: 22px 0 10px;
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

        input[type="date"],
        textarea {
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

        input[type="date"] {
            min-height: 54px;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        textarea::placeholder {
            color: #a3adbb;
        }

        input[type="date"]:focus,
        textarea:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, .22);
        }

        /* PILIHAN WAKTU */
        .waktu {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .waktu-item {
            position: relative;
        }

        /* radio disembunyikan secara visual (tetap bisa divalidasi & diakses papan ketik) */
        .waktu-item input {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            margin: 0;
            opacity: 0;
            cursor: pointer;
        }

        .waktu-item label {
            display: block;
            padding: 14px 8px;
            text-align: center;
            color: var(--navy);
            font-size: 14px;
            font-weight: 600;
            background: white;
            border: 1px solid rgba(18, 41, 74, .15);
            border-radius: 999px;
            transition: .2s;
            pointer-events: none;
        }

        .waktu-item:hover label {
            border-color: var(--gold);
            background: rgba(201, 162, 77, .08);
        }

        .waktu-item input:checked + label {
            color: var(--gold-light);
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            border-color: var(--navy);
            box-shadow: 0 8px 18px rgba(18, 41, 74, .28);
        }

        .waktu-item input:focus-visible + label {
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        /* TOMBOL KIRIM: gaya sama dengan slider di halaman awal */
        .tombol {
            width: 100%;
            min-height: 58px;
            margin-top: 30px;
            padding: 0 8px 0 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border: none;
            border-radius: 999px;
            color: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .3px;
            cursor: pointer;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow:
                0 14px 30px rgba(18, 41, 74, .30),
                inset 0 0 0 1px rgba(255, 255, 255, .06);
            transition: transform .25s;
        }

        .tombol:hover {
            transform: translateY(-2px);
        }

        .tombol:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .tombol .btn-icon {
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

        .tombol .btn-icon .icon {
            width: 20px;
            height: 20px;
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
                max-width: 680px;
            }

            .content {
                padding: 38px 56px 44px;
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

            .back {
                width: 40px;
                height: 40px;
            }

            .header h1 {
                font-size: 17px;
            }

            .content {
                padding: 24px 18px 30px;
            }

            .field-label {
                font-size: 13px;
            }

            .waktu {
                gap: 9px;
            }

            .waktu-item label {
                padding: 13px 4px;
                font-size: 13px;
            }

            .tombol {
                min-height: 54px;
                padding-left: 22px;
                font-size: 14px;
            }

            .tombol .btn-icon {
                width: 40px;
                height: 40px;
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
        <a href="{{ route('buku-tamu.hasil-pencarian') }}" class="back" aria-label="Kembali">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 12H5M11 6l-6 6 6 6"/>
            </svg>
        </a>
        <h1>Ajukan Janji Temu</h1>
    </header>

    <main class="content">

        <div class="info">
            ℹ️ Mohon pilih tanggal dan waktu sesuai dengan
            ketersediaan pegawai.
        </div>

        @if(isset($pegawai) && $pegawai)
            <div class="pegawai">
                Pegawai yang dipilih:
                <strong>{{ $pegawai->nama_lengkap }}</strong>
            </div>
        @endif

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                Mohon periksa kembali tanggal dan waktu yang dipilih.
            </div>
        @endif

        <form action="{{ route('buku-tamu.simpan-janji') }}" method="POST">
            @csrf

            <label class="field-label" for="tanggal">
                Pilih Tanggal <span class="required">*</span>
            </label>

            <input
                type="date"
                id="tanggal"
                name="tanggal"
                min="{{ date('Y-m-d') }}"
                value="{{ old('tanggal') }}"
                required
            >

            @error('tanggal')
                <div class="error">{{ $message }}</div>
            @enderror

            <span class="field-label">
                Pilih Waktu <span class="required">*</span>
            </span>

            <div class="waktu">

                <div class="waktu-item">
                    <input type="radio" id="jam1" name="waktu"
                        value="08:00 - 09:00" {{ old('waktu') == '08:00 - 09:00' ? 'checked' : '' }} required>
                    <label for="jam1">08:00 - 09:00</label>
                </div>

                <div class="waktu-item">
                    <input type="radio" id="jam2" name="waktu"
                        value="09:00 - 10:00" {{ old('waktu') == '09:00 - 10:00' ? 'checked' : '' }}>
                    <label for="jam2">09:00 - 10:00</label>
                </div>

                <div class="waktu-item">
                    <input type="radio" id="jam3" name="waktu"
                        value="10:00 - 11:00" {{ old('waktu') == '10:00 - 11:00' ? 'checked' : '' }}>
                    <label for="jam3">10:00 - 11:00</label>
                </div>

                <div class="waktu-item">
                    <input type="radio" id="jam4" name="waktu"
                        value="11:00 - 12:00" {{ old('waktu') == '11:00 - 12:00' ? 'checked' : '' }}>
                    <label for="jam4">11:00 - 12:00</label>
                </div>

            </div>

            @error('waktu')
                <div class="error">{{ $message }}</div>
            @enderror

            <label class="field-label" for="catatan">
                Catatan <span class="optional">(Opsional)</span>
            </label>

            <textarea
                id="catatan"
                name="catatan"
                placeholder="Tuliskan keperluan tambahan..."
            >{{ old('catatan') }}</textarea>

            <button type="submit" class="tombol">
                Kirim Permohonan
                <span class="btn-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </span>
            </button>

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