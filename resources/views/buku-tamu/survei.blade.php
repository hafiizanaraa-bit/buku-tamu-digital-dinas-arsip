<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Pelayanan - Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            padding: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            background:
                radial-gradient(circle at top left, #eadbd2, transparent 35%),
                #f4eee8;
            font-family: 'DM Sans', sans-serif;
            color: #332a29;
        }

        .container {
            width: 100%;
            max-width: 650px;
            background: #fffaf4;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 18px 50px rgba(65, 30, 30, .14);
            border: 1px solid #eaded6;
        }

        .top-line {
            height: 7px;
            background: linear-gradient(90deg, #4f101d, #c69b55, #781f2b);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 25px 30px;
            border-bottom: 1px solid #eee3da;
        }

        /* TOMBOL PANAH KEMBALI (ikon SVG agar tepat di tengah) */
        .back {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f5e9e7;
            color: #781f2b;
            text-decoration: none;
            transition: .2s;
        }

        .back:hover {
            background: #efdcd9;
        }

        /* IKON PANAH */
        .arrow {
            width: 1.15em;
            height: 1.15em;
            flex-shrink: 0;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.4;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .back .arrow {
            width: 22px;
            height: 22px;
        }

        .header h2 {
            color: #4f101d;
            font-size: 20px;
            font-weight: 800;
            line-height: 1.2;
        }

        .content {
            padding: 35px 45px 40px;
            text-align: center;
        }

        .illustration {
            width: 115px;
            height: 115px;
            margin: 0 auto 25px;
            border-radius: 50%;
            background: #f7e9e5;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 65px;
        }

        .title {
            color: #781f2b;
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            margin-bottom: 12px;
        }

        .description {
            color: #665b58;
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 25px;
        }

        .rating-label {
            font-weight: 700;
            color: #4f101d;
            margin-bottom: 12px;
        }

        .stars {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 12px;
        }

        .star {
            border: none;
            background: transparent;
            font-size: 39px;
            color: #d8d0c8;
            cursor: pointer;
            transition: .2s;
        }

        .star.active {
            color: #f5a623;
            transform: scale(1.12);
        }

        .star:hover {
            transform: scale(1.18);
        }

        .rating-help {
            color: #827772;
            font-size: 13px;
            margin-bottom: 30px;
        }

        .suggestion {
            text-align: left;
            margin-bottom: 25px;
        }

        .suggestion label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #4f101d;
            margin-bottom: 10px;
        }

        .suggestion textarea {
            width: 100%;
            min-height: 120px;
            resize: vertical;
            padding: 15px;
            border: 1px solid #e3d8d1;
            border-radius: 12px;
            background: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
        }

        .suggestion textarea:focus {
            border-color: #781f2b;
            box-shadow: 0 0 0 3px rgba(120, 31, 43, .08);
        }

        .navigation {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 16px;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 800;
            line-height: 1;
            text-decoration: none;
            cursor: pointer;
            transition: .3s;
        }

        .btn-skip {
            background: white;
            color: #781f2b;
            border: 1px solid #781f2b;
        }

        .btn-next {
            background: linear-gradient(135deg, #781f2b, #4f101d);
            color: white;
            border: none;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(80, 20, 30, .13);
        }

        .footer {
            background: #f5eee7;
            padding: 18px;
            text-align: center;
            font-size: 12px;
            color: #897a75;
            border-top: 1px solid #eaded6;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
                align-items: flex-start;
            }

            .container {
                margin: 10px 0;
                border-radius: 19px;
            }

            .header {
                padding: 20px;
            }

            .back {
                width: 38px;
                height: 38px;
            }

            .back .arrow {
                width: 20px;
                height: 20px;
            }

            .header h2 {
                font-size: 17px;
            }

            .content {
                padding: 30px 20px;
            }

            .illustration {
                width: 95px;
                height: 95px;
                font-size: 53px;
            }

            .title {
                font-size: 28px;
            }

            .description {
                font-size: 14px;
            }

            .stars {
                gap: 9px;
            }

            .star {
                font-size: 35px;
            }

            .navigation {
                gap: 10px;
            }

            .btn {
                padding: 14px 8px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

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
                    <svg class="arrow" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
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