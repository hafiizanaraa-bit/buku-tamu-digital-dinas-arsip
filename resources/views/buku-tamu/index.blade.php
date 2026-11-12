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
        }

        /* LINGKARAN DEKORASI */
        .decoration {
            position: fixed;
            border: 1px solid rgba(201, 162, 77, .45);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .decoration.one {
            width: 340px;
            height: 340px;
            top: -140px;
            left: -110px;
        }

        .decoration.two {
            width: 440px;
            height: 440px;
            bottom: -170px;
            right: -110px;
        }

        /* KARTU UTAMA */
        .welcome-container {
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
            background: linear-gradient(
                90deg,
                var(--navy-dark),
                var(--gold),
                var(--navy-light)
            );
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-areas:
                "intro visual"
                "start visual";
            grid-template-rows: auto auto;
            align-content: center;
            column-gap: 52px;
            padding: 44px 56px 40px;
        }

        /* BAGIAN KIRI : IDENTITAS */
        .intro {
            grid-area: intro;
            align-self: end;
            text-align: left;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 26px;
            animation: naik .8s .10s ease both;
        }

        .logo-wrapper {
            width: 76px;
            height: 76px;
            flex-shrink: 0;
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
            line-height: 1.55;
            letter-spacing: .6px;
        }

        .agency-label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
            animation: naik .8s .20s ease both;
        }

        .agency-label::before {
            content: "";
            width: 34px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .title {
            margin-bottom: 14px;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(40px, 4.6vw, 62px);
            font-weight: 800;
            line-height: 1.06;
            letter-spacing: -1.5px;
            animation: naik .8s .30s ease both;
        }

        .title span {
            color: var(--gold);
            background: linear-gradient(90deg, var(--gold-dark), #e3c477 55%, var(--gold-dark));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tagline {
            color: var(--muted);
            font-size: 18px;
            font-weight: 500;
            line-height: 1.6;
            animation: naik .8s .40s ease both;
        }

        /* BAGIAN KANAN : FOTO */
        .visual {
            grid-area: visual;
            position: relative;
            min-height: 440px;
            margin: 6px 14px 14px 0;
            animation: naik .9s .25s ease both;
        }

        /* bingkai emas di belakang foto */
        .visual::before {
            content: "";
            position: absolute;
            inset: 0;
            transform: translate(14px, 14px);
            border: 2px solid var(--gold);
            border-radius: 26px;
            z-index: 0;
        }

        .image-wrapper {
            position: absolute;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            border-radius: 26px;
            border: 5px solid white;
            box-shadow: 0 20px 45px rgba(11, 27, 51, .30);
        }

        .office-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            transition: transform .8s ease;
        }

        .image-wrapper:hover .office-image {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to top,
                rgba(11, 27, 51, .80),
                rgba(11, 27, 51, .10) 55%,
                transparent
            );
            pointer-events: none;
        }

        .image-caption {
            position: absolute;
            left: 26px;
            bottom: 24px;
            z-index: 2;
            color: white;
            text-align: left;
        }

        .image-caption small {
            display: block;
            margin-bottom: 6px;
            color: var(--gold-light);
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .image-caption strong {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.35;
        }

        /* LENCANA JAM PELAYANAN */
        .hours-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 10px 15px;
            color: white;
            font-size: 12px;
            font-weight: 600;
            background: rgba(11, 27, 51, .55);
            border: 1px solid rgba(255, 255, 255, .25);
            border-radius: 999px;
            -webkit-backdrop-filter: blur(8px);
            backdrop-filter: blur(8px);
        }

        .hours-badge svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            fill: none;
            stroke: var(--gold-light);
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        /* BAGIAN KIRI : TOMBOL MEMULAI */
        .start-section {
            grid-area: start;
            align-self: start;
            margin-top: 30px;
            text-align: left;
            animation: naik .8s .50s ease both;
        }

        .start-description {
            margin-bottom: 14px;
            color: var(--muted);
            font-size: 14px;
        }

        /* SLIDER GESER UNTUK MEMULAI */
        .slider {
            position: relative;
            width: 100%;
            max-width: 390px;
            height: 66px;
            padding: 7px;
            overflow: hidden;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow:
                0 14px 30px rgba(18, 41, 74, .30),
                inset 0 0 0 1px rgba(255, 255, 255, .06);
            user-select: none;
            -webkit-user-select: none;
        }

        .slider-fill {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 0;
            border-radius: 999px;
            background: linear-gradient(90deg, rgba(201, 162, 77, 0), rgba(201, 162, 77, .60));
            pointer-events: none;
        }

        .slider-text {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 54px;
            pointer-events: none;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .slider-text span {
            background: linear-gradient(90deg, rgba(255,255,255,.50) 0%, #fff 50%, rgba(255,255,255,.50) 100%);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: kilau 2.6s linear infinite;
        }

        .slider-handle {
            position: relative;
            z-index: 2;
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 6px 16px rgba(0, 0, 0, .30);
            cursor: grab;
            touch-action: none;
            outline: none;
            transition: transform .45s cubic-bezier(.2, .8, .2, 1);
        }

        .slider-handle:focus-visible {
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .slider-handle svg {
            width: 24px;
            height: 24px;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.6;
            stroke-linecap: round;
            stroke-linejoin: round;
            animation: dorong 1.6s ease-in-out infinite;
        }

        .slider.dragging .slider-handle {
            transition: none;
            cursor: grabbing;
        }

        .slider.dragging .slider-handle svg,
        .slider.done .slider-handle svg {
            animation: none;
        }

        .slider.done .slider-fill {
            transition: width .3s ease;
        }

        .swipe-hint {
            margin-top: 14px;
            color: #94a3b8;
            font-size: 12px;
        }

        .footer {
            padding: 20px;
            text-align: center;
            color: #7b8799;
            font-size: 12px;
            line-height: 1.8;
            background: #f3efe6;
            border-top: 1px solid var(--line);
        }

        .footer span {
            color: var(--gold-dark);
            font-weight: 700;
        }

        /* ANIMASI */
        @keyframes muncul {
            from { opacity: 0; transform: scale(.98); }
            to   { opacity: 1; transform: scale(1); }
        }

        @keyframes naik {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes kilau {
            from { background-position: 200% 0; }
            to   { background-position: -200% 0; }
        }

        @keyframes dorong {
            0%, 100% { transform: translateX(-2px); }
            50%      { transform: translateX(4px); }
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

            .content {
                padding-top: 30px;
                padding-bottom: 28px;
            }

            .brand {
                margin-bottom: 18px;
            }

            .logo-wrapper {
                width: 66px;
                height: 66px;
            }

            .title {
                font-size: clamp(38px, 4vw, 54px);
            }

            .tagline {
                font-size: 16px;
            }

            .start-section {
                margin-top: 22px;
            }

            .visual {
                min-height: 380px;
            }
        }

        /* TABLET DAN HP : SUSUNAN MEMANJANG */
        @media (max-width: 900px) {
            body {
                align-items: flex-start;
                padding: 14px;
            }

            .welcome-container {
                max-width: 560px;
            }

            .content {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "intro"
                    "visual"
                    "start";
                padding: 30px 26px 30px;
            }

            .intro {
                align-self: auto;
                text-align: center;
            }

            .brand {
                flex-direction: column;
                gap: 12px;
                margin-bottom: 22px;
            }

            .agency-label {
                justify-content: center;
            }

            .agency-label::after {
                content: "";
                width: 34px;
                height: 2px;
                background: var(--gold);
                border-radius: 2px;
            }

            .tagline {
                margin-bottom: 26px;
            }

            .visual {
                min-height: 0;
                height: 250px;
                margin: 0 12px 12px 0;
            }

            .start-section {
                align-self: auto;
                margin-top: 34px;
                text-align: center;
            }

            .slider {
                margin: 0 auto;
                max-width: 100%;
            }
        }

        /* HP KECIL */
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .welcome-container {
                border-radius: 22px;
            }

            .top-line {
                height: 6px;
            }

            .content {
                padding: 24px 18px 26px;
            }

            .logo-wrapper {
                width: 70px;
                height: 70px;
                border-radius: 19px;
            }

            .agency-name {
                font-size: 13px;
            }

            .agency-label {
                font-size: 9px;
                letter-spacing: 2px;
            }

            .title {
                font-size: 38px;
                letter-spacing: -.8px;
            }

            .tagline {
                font-size: 14px;
            }

            .visual {
                height: 215px;
            }

            .image-wrapper {
                border-radius: 20px;
                border-width: 4px;
            }

            .visual::before {
                border-radius: 20px;
            }

            .image-caption {
                left: 16px;
                bottom: 15px;
            }

            .image-caption small {
                font-size: 9px;
            }

            .image-caption strong {
                font-size: 14px;
            }

            .hours-badge {
                top: 12px;
                left: 12px;
                padding: 8px 12px;
                font-size: 10px;
            }

            .slider {
                height: 62px;
            }

            .slider-handle {
                width: 48px;
                height: 48px;
            }

            .slider-text {
                font-size: 14px;
                padding-left: 48px;
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

    <main class="welcome-container">

        <div class="top-line"></div>

        <section class="content">

            <!-- IDENTITAS -->
            <div class="intro">

                <!-- LOGO KABUPATEN CIREBON -->
                <div class="brand">

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

                </div>

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

            </div>

            <!-- FOTO GEDUNG -->
            <div class="visual">

                <div class="image-wrapper">

                    <img
                        src="{{ asset('images/dinas arsip.jpg') }}"
                        alt="Gedung Dinas Arsip dan Perpustakaan Kabupaten Cirebon"
                        class="office-image"
                    >

                    <div class="image-overlay"></div>

                    <div class="hours-badge">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 2"/>
                        </svg>
                        Senin - Jumat · 08.00 - 16.00 WIB
                    </div>

                    <div class="image-caption">
                        <small>Selamat Datang di</small>
                        <strong>Dinas Arsip dan Perpustakaan</strong>
                    </div>

                </div>

            </div>

            <!-- TOMBOL MEMULAI -->
            <div class="start-section">

                <p class="start-description">
                    Silakan mulai untuk melakukan kunjungan
                </p>

                <!-- SLIDER GESER UNTUK MEMULAI -->
                <div class="slider" id="slider">

                    <div class="slider-fill" id="sliderFill"></div>

                    <div class="slider-text" id="sliderText">
                        <span>Slide untuk Memulai</span>
                    </div>

                    <div
                        class="slider-handle"
                        id="sliderHandle"
                        role="button"
                        tabindex="0"
                        aria-label="Geser ke kanan untuk memulai"
                    >
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </div>

                </div>

                <noscript>
                    <p class="swipe-hint">
                        <a href="{{ route('buku-tamu.lokasi') }}">Klik di sini untuk memulai</a>
                    </p>
                </noscript>

                <p class="swipe-hint">
                    Geser tombol ke kanan untuk melanjutkan
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

    <script>
        (function () {

            const tujuan = "{{ route('buku-tamu.lokasi') }}";

            const slider = document.getElementById('slider');
            const handle = document.getElementById('sliderHandle');
            const fill   = document.getElementById('sliderFill');
            const text   = document.getElementById('sliderText');

            const PADDING = 7;       // jarak dalam slider (sama dengan CSS)
            const AMBANG  = 0.85;    // geser minimal 85% agar dianggap selesai

            let posisi    = 0;
            let batas     = 0;
            let menggeser = false;
            let selesai   = false;
            let awalX     = 0;

            function ukur() {
                batas = slider.clientWidth - handle.offsetWidth - (PADDING * 2);
            }

            function terapkan(nilai) {
                posisi = Math.max(0, Math.min(nilai, batas));

                handle.style.transform = 'translateX(' + posisi + 'px)';
                fill.style.width = (posisi + handle.offsetWidth + PADDING) + 'px';

                const rasio = batas > 0 ? posisi / batas : 0;
                text.style.opacity = String(Math.max(0, 1 - rasio * 1.3));
            }

            function reset() {
                selesai = false;
                slider.classList.remove('done', 'dragging');
                ukur();
                terapkan(0);
                fill.style.width = '0px';
            }

            function mulai() {
                if (selesai) {
                    return;
                }

                selesai = true;
                ukur();
                slider.classList.add('done');
                terapkan(batas);

                setTimeout(function () {
                    window.location.href = tujuan;
                }, 280);
            }

            handle.addEventListener('pointerdown', function (event) {
                if (selesai) {
                    return;
                }

                ukur();
                menggeser = true;
                awalX = event.clientX - posisi;

                slider.classList.add('dragging');
                handle.setPointerCapture(event.pointerId);
            });

            handle.addEventListener('pointermove', function (event) {
                if (!menggeser) {
                    return;
                }

                terapkan(event.clientX - awalX);
            });

            function lepas() {
                if (!menggeser) {
                    return;
                }

                menggeser = false;
                slider.classList.remove('dragging');

                if (batas > 0 && posisi >= batas * AMBANG) {
                    mulai();
                } else {
                    terapkan(0);
                }
            }

            handle.addEventListener('pointerup', lepas);
            handle.addEventListener('pointercancel', lepas);

            // Akses papan ketik: Enter, Spasi, atau panah kanan
            handle.addEventListener('keydown', function (event) {
                if (event.key === 'Enter' || event.key === ' ' || event.key === 'ArrowRight') {
                    event.preventDefault();
                    mulai();
                }
            });

            window.addEventListener('resize', function () {
                if (!selesai) {
                    ukur();
                    terapkan(0);
                }
            });

            // Jika pengunjung menekan tombol "kembali" di browser
            window.addEventListener('pageshow', reset);

            ukur();

        })();
    </script>

</body>
</html>