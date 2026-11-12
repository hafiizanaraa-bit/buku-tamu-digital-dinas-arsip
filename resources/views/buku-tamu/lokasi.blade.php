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
            --maroon: #781f2b;
            --dark: #4f101d;
            --gold: #c69b55;
            --cream: #fffaf4;
            --text: #332a29;
            --muted: #766b68;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            padding: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            background:
                radial-gradient(circle at top left, #eadbd2, transparent 35%),
                #f4eee8;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
        }

        .container {
            width: 100%;
            max-width: 1100px;
            background: var(--cream);
            border-radius: 28px;
            overflow: hidden;
            border: 1px solid #eaded6;
            box-shadow: 0 25px 70px rgba(65, 30, 30, .14);
        }

        .top-line {
            height: 8px;
            background: linear-gradient(
                90deg,
                var(--dark),
                var(--gold),
                var(--maroon)
            );
        }

        /* IKON PANAH (SVG agar tepat di tengah tombol) */

        .arrow {
            width: 1.2em;
            height: 1.2em;
            flex-shrink: 0;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.4;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* HEADER */

        .header {
            text-align: center;
            padding: 35px 25px 25px;
        }

        .logo {
            width: 85px;
            height: 85px;
            object-fit: contain;
            margin-bottom: 12px;
        }

        .agency-name {
            color: var(--dark);
            font-size: 16px;
            font-weight: 800;
            line-height: 1.6;
            letter-spacing: .5px;
        }

        /* CONTENT */

        .content {
            padding: 20px 65px 45px;
        }

        .label {
            display: inline-block;
            color: var(--gold);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 3px;
            margin-bottom: 12px;
        }

        .title {
            font-family: 'Playfair Display', serif;
            font-size: 45px;
            color: var(--maroon);
            margin-bottom: 12px;
        }

        .description {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.8;
            margin-bottom: 30px;
        }

        /* LOCATION CARD */

        .location-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 22px;
            overflow: hidden;
            border: 1px solid #eee3da;
            box-shadow: 0 12px 35px rgba(70, 30, 30, .09);
        }

        .location-info {
            padding: 38px 32px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 17px;
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
            background: #f6e9e8;
            font-size: 23px;
        }

        .info-text h3 {
            color: var(--maroon);
            font-size: 17px;
            margin-bottom: 8px;
        }

        .info-text p {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
        }

        /* MAP AREA */

        .map-area {
            min-height: 390px;
            background:
                linear-gradient(
                    rgba(78, 20, 29, .65),
                    rgba(78, 20, 29, .65)
                ),
                linear-gradient(135deg, #d8c4b0, #a98d7c);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 35px;
        }

        .map-content {
            color: white;
            max-width: 340px;
        }

        .map-icon {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            margin: 0 auto 22px;
            background: rgba(255, 255, 255, .15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 43px;
        }

        .map-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 27px;
            margin-bottom: 13px;
        }

        .map-content p {
            font-size: 14px;
            line-height: 1.8;
            opacity: .92;
        }

        .map-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 25px;
            padding: 16px 25px;
            background: white;
            color: var(--maroon);
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
            line-height: 1;
            border-radius: 13px;
            transition: .3s;
        }

        .map-button:hover {
            background: var(--gold);
            color: white;
            transform: translateY(-3px);
        }

        /* NAVIGATION */

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-width: 190px;
            padding: 17px 25px;
            border-radius: 13px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 800;
            line-height: 1;
            transition: .3s;
        }

        .btn-back {
            background: #eee6df;
            color: var(--text);
        }

        .btn-next {
            background: linear-gradient(135deg, var(--maroon), var(--dark));
            color: white;
            box-shadow: 0 8px 20px rgba(120, 31, 43, .2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(80, 20, 30, .15);
        }

        /* FOOTER */

        .footer {
            padding: 22px;
            text-align: center;
            background: #f5eee7;
            color: #897a75;
            font-size: 12px;
            line-height: 1.8;
        }

        /* MOBILE */

        @media (max-width: 700px) {
            body {
                padding: 12px;
                align-items: flex-start;
            }

            .container {
                margin: 8px 0;
                border-radius: 20px;
            }

            .header {
                padding: 27px 15px 20px;
            }

            .logo {
                width: 72px;
                height: 72px;
            }

            .agency-name {
                font-size: 13px;
            }

            .content {
                padding: 22px 18px 30px;
            }

            .label {
                font-size: 10px;
                letter-spacing: 2px;
            }

            .title {
                font-size: 34px;
            }

            .description {
                font-size: 14px;
                margin-bottom: 23px;
            }

            .location-card {
                grid-template-columns: 1fr;
            }

            .location-info {
                padding: 27px 20px;
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
                padding: 25px 20px;
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
                min-width: auto;
                padding: 16px;
                font-size: 14px;
            }

            .footer {
                font-size: 11px;
                padding: 18px 12px;
            }
        }

        /* LAPTOP */

        @media (min-width: 701px) {
            .content {
                padding-left: 75px;
                padding-right: 75px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top-line"></div>

    <header class="header">

        <img
            src="{{ asset('images/logo cirebon.png') }}"
            alt="Logo Kabupaten Cirebon"
            class="logo"
        >

        <p class="agency-name">
            DINAS ARSIP DAN PERPUSTAKAAN<br>
            KABUPATEN CIREBON
        </p>

    </header>

    <main class="content">

        <span class="label">INFORMASI KUNJUNGAN</span>

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
                <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
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