<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Pelayanan | Buku Tamu Digital</title>

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
            max-width: 680px;
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

        .header h2 {
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
            line-height: 1.2;
        }

        /* ISI */
        .content {
            padding: 38px 52px 42px;
            text-align: center;
        }

        .illustration {
            width: 112px;
            height: 112px;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 58px;
            background: rgba(201, 162, 77, .16);
            border: 1px solid rgba(201, 162, 77, .45);
            box-shadow: 0 0 0 10px rgba(201, 162, 77, .08);
        }

        .title {
            margin-bottom: 12px;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 42px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .description {
            margin-bottom: 28px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.8;
        }

        /* BINTANG */
        .rating-label {
            margin-bottom: 12px;
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
        }

        .stars {
            display: flex;
            justify-content: center;
            gap: 14px;
            margin-bottom: 12px;
        }

        .star {
            border: none;
            background: transparent;
            font-size: 42px;
            line-height: 1;
            color: #d9dde5;
            cursor: pointer;
            transition: transform .2s, color .2s;
        }

        .star.active {
            color: var(--gold);
            transform: scale(1.12);
            text-shadow: 0 4px 12px rgba(201, 162, 77, .45);
        }

        .star:hover {
            transform: scale(1.2);
        }

        .star:focus-visible {
            outline: none;
            border-radius: 10px;
            box-shadow: 0 0 0 3px var(--gold);
        }

        .rating-help {
            margin-bottom: 30px;
            color: #94a3b8;
            font-size: 13px;
        }

        .rating-help.terpilih {
            color: var(--gold-dark);
            font-weight: 700;
        }

        /* SARAN */
        .suggestion {
            margin-bottom: 28px;
            text-align: left;
        }

        .suggestion label {
            display: block;
            margin-bottom: 10px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 700;
        }

        .suggestion textarea {
            width: 100%;
            min-height: 120px;
            padding: 15px 18px;
            resize: vertical;
            border: 1px solid rgba(18, 41, 74, .15);
            border-radius: 14px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: .2s;
        }

        .suggestion textarea::placeholder {
            color: #a3adbb;
        }

        .suggestion textarea:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, .22);
        }

        /* TOMBOL */
        .navigation {
            display: flex;
            gap: 14px;
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

        .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .btn-skip {
            padding: 0 34px;
            color: var(--navy);
            background: white;
            border: 1.5px solid var(--navy);
        }

        .btn-skip:hover {
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

        .btn-next .btn-icon .arrow {
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

            .header h2 {
                font-size: 17px;
            }

            .content {
                padding: 28px 20px 30px;
            }

            .illustration {
                width: 92px;
                height: 92px;
                font-size: 48px;
            }

            .description {
                font-size: 14px;
            }

            .stars {
                gap: 8px;
            }

            .star {
                font-size: 36px;
            }

            .navigation {
                gap: 10px;
            }

            .btn {
                min-height: 52px;
                font-size: 14px;
            }

            .btn-skip {
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
        <a href="{{ url('/lokasi') }}" class="back" aria-label="Kembali">
            <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 12H5M11 6l-6 6 6 6"/>
            </svg>
        </a>
        <h2>Survei Pelayanan</h2>
    </header>

    <main class="content">

        <div class="illustration">📋</div>

        <h1 class="title">Survei Kepuasan</h1>

        <p class="description">
            Bagaimana penilaian Anda terhadap pelayanan kami?
            Masukan Anda sangat berarti untuk meningkatkan
            kualitas pelayanan.
        </p>

        <form action="{{ route('buku-tamu.formulir') }}" method="GET" id="surveyForm">

            <p class="rating-label">Berikan Penilaian Anda</p>

            <div class="stars">
                <button type="button" class="star" data-value="1" aria-label="Bintang 1">★</button>
                <button type="button" class="star" data-value="2" aria-label="Bintang 2">★</button>
                <button type="button" class="star" data-value="3" aria-label="Bintang 3">★</button>
                <button type="button" class="star" data-value="4" aria-label="Bintang 4">★</button>
                <button type="button" class="star" data-value="5" aria-label="Bintang 5">★</button>
            </div>

            <input type="hidden" name="rating" id="rating">

            <p class="rating-help" id="ratingHelp">
                Pilih bintang 1 - 5
            </p>

            <div class="suggestion">
                <label for="saran">Masukan / Saran (Opsional)</label>
                <textarea
                    name="saran"
                    id="saran"
                    placeholder="Tuliskan masukan atau saran Anda di sini..."
                ></textarea>
            </div>

            <div class="navigation">

                <button
                    type="button"
                    class="btn btn-skip"
                    onclick="lewatiSurvei()"
                >
                    Lewati
                </button>

                <button type="submit" class="btn btn-next">
                    Lanjut
                    <span class="btn-icon">
                        <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
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
        Terima kasih atas penilaian Anda.
    </footer>

</div>

<script>
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('rating');
    const ratingHelp = document.getElementById('ratingHelp');

    const descriptions = {
        1: 'Sangat Tidak Puas',
        2: 'Tidak Puas',
        3: 'Cukup Puas',
        4: 'Puas',
        5: 'Sangat Puas'
    };

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const value = Number(this.dataset.value);

            ratingInput.value = value;

            stars.forEach(item => {
                item.classList.toggle(
                    'active',
                    Number(item.dataset.value) <= value
                );
            });

            ratingHelp.classList.add('terpilih');

            ratingHelp.textContent =
                value + ' dari 5 - ' + descriptions[value];
        });
    });

    function lewatiSurvei() {
        window.location.href = "{{ route('buku-tamu.formulir') }}";
    }
</script>

</body>
</html>