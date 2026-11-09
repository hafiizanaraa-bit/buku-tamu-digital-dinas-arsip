<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buku Tamu Digital | Kabupaten Cirebon</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon: #781f2b;
            --maroon-dark: #4f101d;
            --cream: #fffaf4;
            --gold: #c69b55;
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
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at 10% 10%, #ead9d0 0, transparent 28%),
                radial-gradient(circle at 90% 90%, #e8d4c6 0, transparent 30%),
                #f4eee8;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 35px;
        }

        .decoration {
            position: fixed;
            width: 320px;
            height: 320px;
            border: 1px solid rgba(120, 31, 43, 0.12);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .decoration.one {
            top: -130px;
            left: -100px;
        }

        .decoration.two {
            bottom: -150px;
            right: -100px;
            width: 420px;
            height: 420px;
        }

        .welcome-container {
            width: 100%;
            max-width: 1100px;
            min-height: 750px;
            background: var(--cream);
            border-radius: 28px;
            overflow: hidden;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 70px rgba(65, 30, 30, 0.15);
            border: 1px solid rgba(120, 31, 43, 0.12);
        }

        .top-line {
            height: 8px;
            background: linear-gradient(
                90deg,
                var(--maroon-dark),
                var(--gold),
                var(--maroon)
            );
        }

        .content {
            padding: 45px 70px 30px;
            text-align: center;
        }

        .logo-wrapper {
            width: 112px;
            height: 112px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 28px;
            box-shadow: 0 8px 25px rgba(120, 31, 43, 0.12);
            border: 1px solid #eee1d9;
            padding: 10px;
        }

        .logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .agency-name {
            font-size: 19px;
            font-weight: 700;
            line-height: 1.5;
            letter-spacing: 0.2px;
            color: var(--maroon-dark);
            margin-bottom: 30px;
        }

        .agency-label {
            display: inline-block;
            color: var(--gold);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .title {
            font-family: 'Playfair Display', serif;
            color: var(--maroon);
            font-size: clamp(42px, 5vw, 64px);
            font-weight: 800;
            line-height: 1.08;
            letter-spacing: -1.5px;
            margin-bottom: 15px;
        }

        .title span {
            color: var(--gold);
        }

        .tagline {
            font-size: 19px;
            color: var(--muted);
            font-weight: 500;
            line-height: 1.6;
            margin-bottom: 35px;
        }

        .image-wrapper {
            position: relative;
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(54, 24, 24, 0.20);
            border: 5px solid white;
        }

        .office-image {
            display: block;
            width: 100%;
            height: 330px;
            object-fit: cover;
            object-position: center;
            transition: transform 0.6s ease;
        }

        .image-wrapper:hover .office-image {
            transform: scale(1.035);
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(49, 15, 22, 0.55),
                transparent 60%
            );
            pointer-events: none;
        }

        .image-caption {
            position: absolute;
            left: 25px;
            bottom: 22px;
            color: white;
            text-align: left;
            z-index: 2;
        }

        .image-caption small {
            display: block;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: #f3d9aa;
        }

        .image-caption strong {
            font-size: 19px;
            font-weight: 700;
        }

        .start-section {
            margin-top: 35px;
        }

        .start-description {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 16px;
        }

        .start-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            min-width: 290px;
            padding: 19px 32px;
            background: linear-gradient(
                135deg,
                var(--maroon),
                var(--maroon-dark)
            );
            color: white;
            border-radius: 15px;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 0.3px;
            box-shadow: 0 10px 25px rgba(120, 31, 43, 0.25);
            transition: all 0.3s ease;
        }

        .start-button:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(120, 31, 43, 0.35);
            background: linear-gradient(135deg, #91303e, #5a1420);
        }

        .button-arrow {
            font-size: 23px;
            transition: transform 0.3s ease;
        }

        .start-button:hover .button-arrow {
            transform: translateX(6px);
        }

        .swipe-hint {
            margin-top: 13px;
            font-size: 12px;
            color: #948783;
        }

        .footer {
            padding: 22px;
            background: #f5eee7;
            border-top: 1px solid #eaded6;
            text-align: center;
            color: #897a75;
            font-size: 12px;
        }

        .footer span {
            color: var(--maroon);
            font-weight: 700;
        }

        /* LAPTOP */
        @media (min-width: 768px) {
            .content {
                padding-top: 55px;
                padding-bottom: 45px;
            }

            .office-image {
                height: 370px;
            }
        }

        /* TABLET */
        @media (min-width: 481px) and (max-width: 767px) {
            body {
                padding: 20px;
            }

            .welcome-container {
                min-height: auto;
            }

            .content {
                padding: 40px 30px;
            }

            .office-image {
                height: 280px;
            }
        }

        /* HP */
        @media (max-width: 480px) {
            body {
                padding: 12px;
                min-height: 100svh;
                align-items: center;
            }

            .welcome-container {
                width: 100%;
                max-width: 420px;
                min-height: auto;
                border-radius: 23px;
            }

            .top-line {
                height: 6px;
            }

            .content {
                padding: 27px 20px 28px;
            }

            .logo-wrapper {
                width: 82px;
                height: 82px;
                border-radius: 21px;
                margin-bottom: 14px;
            }

            .agency-name {
                font-size: 14px;
                margin-bottom: 25px;
            }

            .agency-label {
                font-size: 9px;
                letter-spacing: 2px;
            }

            .title {
                font-size: 37px;
                letter-spacing: -0.8px;
                margin-bottom: 12px;
            }

            .tagline {
                font-size: 14px;
                margin-bottom: 24px;
            }

            .image-wrapper {
                border-radius: 16px;
                border-width: 4px;
            }

            .office-image {
                height: 235px;
            }

            .image-caption {
                left: 15px;
                bottom: 15px;
            }

            .image-caption small {
                font-size: 9px;
            }

            .image-caption strong {
                font-size: 14px;
            }

            .start-section {
                margin-top: 25px;
            }

            .start-description {
                font-size: 12px;
            }

            .start-button {
                width: 100%;
                min-width: auto;
                padding: 18px;
                border-radius: 13px;
                font-size: 15px;
            }

            .footer {
                padding: 17px 12px;
                font-size: 10px;
            }
        }

        @media (max-height: 780px) and (min-width: 481px) {
            body {
                align-items: flex-start;
            }

            .content {
                padding-top: 30px;
            }
        }
    </style>
</head>

<body>

    <div class="decoration one"></div>
    <div class="decoration two"></div>

    <main class="welcome-container">

        <div class="top-line"></div>

        <section class="content">

            <!-- LOGO KABUPATEN CIREBON -->
            <div class="logo-wrapper">
                <img
                    src="{{ asset('images/logo cirebon.png') }}"
                    alt="Logo Kabupaten Cirebon"
                    class="logo"
                >
            </div>

            <!-- NAMA INSTANSI -->
            <p class="agency-name">
                DINAS ARSIP DAN PERPUSTAKAAN<br>
                KABUPATEN CIREBON
            </p>

            <!-- JUDUL -->
            <span class="agency-label">
                Selamat Datang
            </span>

            <h1 class="title">
                BUKU TAMU<br>
                <span>DIGITAL</span>
            </h1>

            <!-- TAGLINE -->
            <p class="tagline">
                Melayani dengan Mudah<br>
                dan Cepat
            </p>

            <!-- FOTO GEDUNG -->
            <div class="image-wrapper">

                <img
                    src="{{ asset('images/dinas arsip.jpg') }}"
                    alt="Gedung Dinas Arsip dan Perpustakaan Kabupaten Cirebon"
                    class="office-image"
                >

                <div class="image-overlay"></div>

                <div class="image-caption">
                    <small>Selamat Datang di</small>
                    <strong>Dinas Arsip dan Perpustakaan</strong>
                </div>

            </div>

            <!-- TOMBOL MEMULAI -->
            <div class="start-section">

                <p class="start-description">
                    Silakan mulai untuk melakukan kunjungan
                </p>

                <a
                    href="{{ route('buku-tamu.lokasi') }}"
                    class="start-button"
                >
                    <span>Slide untuk Memulai</span>
                    <span class="button-arrow">→</span>
                </a>

                <p class="swipe-hint">
                    Tekan tombol untuk melanjutkan
                </p>

            </div>

        </section>

        <!-- FOOTER -->
        <footer class="footer">
            <span>♥</span>
            Terima kasih telah berkunjung
            <br>
            © 2026 Dinas Arsip dan Perpustakaan Kabupaten Cirebon
        </footer>

    </main>

</body>
</html>