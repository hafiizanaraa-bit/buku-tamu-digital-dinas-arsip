<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Dinas | Buku Tamu Digital</title>

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
            max-width: 1100px;
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

        /* IKON PANAH */
        .arrow {
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
            padding: 34px 25px 22px;
            text-align: center;
        }

        .logo-wrapper {
            width: 82px;
            height: 82px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            background: white;
            border-radius: 22px;
            border: 1px solid var(--line);
            box-shadow: 0 8px 22px rgba(18, 41, 74, .12);
        }

        .logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .agency-name {
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
            line-height: 1.6;
            letter-spacing: .6px;
        }

        /* ISI */
        .content {
            padding: 18px 70px 46px;
        }

        .label {
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

        .label::before {
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
            font-size: clamp(36px, 4.4vw, 52px);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -1.2px;
        }

        .description {
            margin-bottom: 30px;
            color: var(--muted);
            font-size: 16px;
            line-height: 1.8;
        }

        /* KARTU LOKASI */
        .location-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            background: white;
            border-radius: 24px;
            border: 1px solid var(--line);
            box-shadow: 0 14px 38px rgba(11, 27, 51, .10);
        }

        .location-info {
            padding: 38px 34px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 30px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: rgba(201, 162, 77, .16);
            border: 1px solid rgba(201, 162, 77, .35);
            font-size: 22px;
        }

        .info-text h3 {
            margin-bottom: 8px;
            color: var(--navy);
            font-size: 17px;
            font-weight: 800;
        }

        .info-text p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        /* AREA PETA */
        .map-area {
            min-height: 390px;
            padding: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background:
                radial-gradient(circle at 85% 12%, rgba(201, 162, 77, .30) 0, transparent 40%),
                linear-gradient(135deg, var(--navy-light), var(--navy-dark));
        }

        .map-content {
            max-width: 340px;
            color: white;
        }

        .map-icon {
            width: 84px;
            height: 84px;
            margin: 0 auto 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 40px;
            background: rgba(255, 255, 255, .10);
            border: 1px solid rgba(232, 213, 163, .55);
        }

        .map-content h3 {
            margin-bottom: 13px;
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
        }

        .map-content p {
            font-size: 14px;
            line-height: 1.8;
            opacity: .9;
        }

        .map-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 26px;
            padding: 16px 28px;
            border-radius: 999px;
            color: var(--navy-dark);
            font-size: 14px;
            font-weight: 800;
            line-height: 1;
            text-decoration: none;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 8px 20px rgba(0, 0, 0, .30);
            transition: transform .25s, box-shadow .25s;
        }

        .map-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 26px rgba(0, 0, 0, .35);
        }

        .map-button .arrow {
            width: 18px;
            height: 18px;
        }

        .map-button:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px var(--navy-dark), 0 0 0 6px var(--gold-light);
        }

        /* TOMBOL NAVIGASI */
        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-top: 36px;
        }

        .btn {
            min-height: 58px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .3px;
            transition: transform .25s, box-shadow .25s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .btn-back {
            min-width: 190px;
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
            min-width: 290px;
            padding: 0 8px 0 30px;
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

        .btn-next .btn-icon .arrow {
            width: 20px;
            height: 20px;
        }

        /* FOOTER */
        .footer {
            padding: 22px;
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

        /* LAYAR LAPTOP PENDEK */
        @media (min-width: 901px) and (max-height: 720px) {
            body {
                padding: 14px;
            }

            .header {
                padding-top: 24px;
                padding-bottom: 14px;
            }

            .logo-wrapper {
                width: 68px;
                height: 68px;
            }

            .map-area {
                min-height: 340px;
            }
        }

        /* TABLET */
        @media (max-width: 900px) {
            .content {
                padding: 18px 36px 40px;
            }
        }

        /* HP */
        @media (max-width: 700px) {
            body {
                padding: 12px;
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
                padding: 26px 15px 18px;
            }

            .logo-wrapper {
                width: 72px;
                height: 72px;
                border-radius: 19px;
            }

            .agency-name {
                font-size: 13px;
            }

            .content {
                padding: 20px 18px 30px;
                text-align: center;
            }

            .label {
                font-size: 9px;
                letter-spacing: 2px;
            }

            .label::after {
                content: "";
                width: 34px;
                height: 2px;
                background: var(--gold);
                border-radius: 2px;
            }

            .title {
                font-size: 36px;
            }

            .description {
                margin-bottom: 24px;
                font-size: 14px;
            }

            .location-card {
                grid-template-columns: 1fr;
                text-align: left;
            }

            .location-info {
                padding: 26px 20px;
            }

            .info-item {
                gap: 13px;
                margin-bottom: 25px;
            }

            .info-text h3 {
                font-size: 15px;
            }

            .info-text p {
                font-size: 13px;
            }

            .map-area {
                min-height: 280px;
                padding: 26px 20px;
            }

            .map-content h3 {
                font-size: 24px;
            }

            .navigation {
                flex-direction: column-reverse;
                gap: 12px;
            }

            .btn {
                width: 100%;
                min-width: 0;
                min-height: 54px;
                font-size: 14px;
            }

            .btn-next {
                padding-left: 22px;
            }

            .btn-next .btn-icon {
                width: 40px;
                height: 40px;
            }

            .footer {
                padding: 16px 12px;
                font-size: 11px;
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

        <div class="logo-wrapper">
            <img
                src="{{ asset('images/logo cirebon.png') }}"
                alt="Logo Kabupaten Cirebon"
                class="logo"
            >
        </div>

        <p class="agency-name">
            DINAS ARSIP DAN PERPUSTAKAAN<br>
            KABUPATEN CIREBON
        </p>

    </header>

    <main class="content">

        <span class="label">Informasi Kunjungan</span>

        <h1 class="title">Lokasi Dinas</h1>

        <p class="description">
            Silakan perhatikan informasi alamat dan jam pelayanan
            sebelum memulai kunjungan Anda.
        </p>

        <div class="location-card">

            <!-- INFORMASI KANTOR -->
            <div class="location-info">

                <div class="info-item">

                    <div class="icon">📍</div>

                    <div class="info-text">
                        <h3>Alamat Kantor</h3>
                        <p>
                            Jl. Sunan Kalijaga, Sumber, Kec. Sumber,
                            Kabupaten Cirebon, Jawa Barat 45611.
                        </p>
                    </div>

                </div>

                <div class="info-item">

                    <div class="icon">🕒</div>

                    <div class="info-text">
                        <h3>Jam Pelayanan</h3>
                        <p>
                            Senin - Jumat<br>
                            08.00 - 16.00 WIB
                        </p>
                    </div>

                </div>

                <div class="info-item">

                    <div class="icon">🏢</div>

                    <div class="info-text">
                        <h3>Pelayanan Pengunjung</h3>
                        <p>
                            Selamat datang di Dinas Arsip dan Perpustakaan
                            Kabupaten Cirebon. Silakan lanjutkan proses
                            pengisian buku tamu digital.
                        </p>
                    </div>

                </div>

            </div>

            <!-- GOOGLE MAPS -->
            <div class="map-area">

                <div class="map-content">

                    <div class="map-icon">📍</div>

                    <h3>Temukan Lokasi Kami</h3>

                    <p>
                        Lihat petunjuk arah menuju Dinas Arsip dan
                        Perpustakaan Kabupaten Cirebon melalui Google Maps.
                    </p>

                    <a
                        href="https://www.google.com/maps/search/?api=1&query=Dinas+Arsip+dan+Perpustakaan+Kabupaten+Cirebon"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="map-button"
                    >
                        Buka di Google Maps
                        <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M7 17L17 7M8 7h9v9"/>
                        </svg>
                    </a>

                </div>

            </div>

        </div>

        <!-- TOMBOL NAVIGASI -->
        <div class="navigation">

            <a href="{{ route('home') }}" class="btn btn-back">
                <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M19 12H5M11 6l-6 6 6 6"/>
                </svg>
                Kembali
            </a>

            <a href="{{ route('buku-tamu.survei') }}" class="btn btn-next">
                Lanjutkan ke Survei
                <span class="btn-icon">
                    <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </span>
            </a>

        </div>

    </main>

    <footer class="footer">
        © 2026 Dinas Arsip dan Perpustakaan Kabupaten Cirebon
        <br>
        Terima kasih telah berkunjung.
    </footer>

</div>

</body>
</html>