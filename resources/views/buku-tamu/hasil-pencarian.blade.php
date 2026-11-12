<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian | Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

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
            max-width: 700px;
            position: relative;
            z-index: 1;
            overflow: hidden;
            border-radius: 28px;
            background: var(--ivory);
            border: 1px solid var(--line);
            box-shadow: 0 30px 80px rgba(11, 27, 51, .20);
            animation: muncul .8s ease both;
        }

        .top-bar {
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
            padding: 30px 38px 36px;
        }

        .employee-card,
        .info-card {
            padding: 24px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(11, 27, 51, .06);
        }

        .employee-card {
            margin-bottom: 18px;
        }

        .employee-profile {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .avatar {
            width: 64px;
            height: 64px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-size: 28px;
            background: rgba(201, 162, 77, .16);
            border: 1px solid rgba(201, 162, 77, .45);
            box-shadow: 0 0 0 6px rgba(201, 162, 77, .08);
        }

        .employee-name {
            margin-bottom: 5px;
            color: var(--navy);
            font-size: 17px;
            font-weight: 800;
        }

        .employee-position {
            color: var(--muted);
            font-size: 13px;
        }

        .status-badge {
            display: inline-block;
            margin-top: 11px;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .status-tersedia {
            color: #287343;
            background: #e2f4e7;
        }

        .status-bertugas {
            color: #956016;
            background: #fff0d7;
        }

        .status-luar {
            color: #a43843;
            background: #fce6e8;
        }

        .status-tidak {
            color: #5b6575;
            background: #eceff3;
        }

        .status-belum {
            color: #6b7280;
            background: #f1f3f5;
        }

        .employee-description {
            margin-top: 14px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .appointment-hint {
            margin-top: 16px;
            padding: 14px;
            text-align: center;
            color: var(--navy-light);
            font-size: 13px;
            line-height: 1.7;
            background: rgba(201, 162, 77, .12);
            border: 1px dashed var(--gold);
            border-radius: 14px;
        }

        /* INFORMASI LAIN */
        .section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 22px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .section-title::before {
            content: "";
            width: 34px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 20px;
        }

        .info-row:last-of-type {
            margin-bottom: 0;
        }

        .info-icon {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 16px;
            color: var(--navy);
            background: rgba(18, 41, 74, .07);
        }

        .info-label {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .info-value {
            color: var(--navy);
            font-size: 14px;
            font-weight: 700;
            line-height: 1.6;
        }

        .visit-status {
            color: var(--gold-dark);
            font-weight: 800;
        }

        /* TOMBOL */
        .button-area {
            margin-top: 26px;
        }

        .btn-appointment {
            width: 100%;
            min-height: 58px;
            padding: 0 8px 0 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-radius: 999px;
            color: white;
            text-decoration: none;
            font-family: inherit;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .3px;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow:
                0 14px 30px rgba(18, 41, 74, .30),
                inset 0 0 0 1px rgba(255, 255, 255, .06);
            transition: transform .25s;
        }

        .btn-appointment:hover {
            transform: translateY(-2px);
        }

        .btn-appointment:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .btn-appointment .btn-icon {
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

        .btn-appointment .btn-icon .icon {
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
                max-width: 740px;
            }

            .content {
                padding: 36px 46px 42px;
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

            .top-bar {
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
                padding: 20px 14px 26px;
            }

            .employee-card,
            .info-card {
                padding: 18px;
            }

            .avatar {
                width: 54px;
                height: 54px;
                font-size: 24px;
            }

            .employee-name {
                font-size: 15px;
            }

            .employee-position {
                font-size: 12px;
            }

            .btn-appointment {
                min-height: 54px;
                padding-left: 22px;
                font-size: 14px;
            }

            .btn-appointment .btn-icon {
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

@php
    $status = $pegawai->status_ketersediaan;

    $statusInfo = [
        'tersedia' => [
            'label' => 'Ada di Kantor',
            'class' => 'status-tersedia',
            'description' => 'Saat ini pegawai tersedia di kantor.'
        ],
        'sedang_bertugas' => [
            'label' => 'Sedang Bertugas',
            'class' => 'status-bertugas',
            'description' => 'Saat ini sedang bertugas di kantor.'
        ],
        'di_luar_kantor' => [
            'label' => 'Di Luar Kantor',
            'class' => 'status-luar',
            'description' => 'Saat ini pegawai sedang berada di luar kantor.'
        ],
        'tidak_tersedia' => [
            'label' => 'Tidak Tersedia',
            'class' => 'status-tidak',
            'description' => 'Saat ini pegawai tidak tersedia untuk ditemui.'
        ],
        'belum_diatur' => [
            'label' => 'Belum Ada Informasi',
            'class' => 'status-belum',
            'description' => 'Informasi ketersediaan pegawai belum diperbarui.'
        ],
    ];

    $info = $statusInfo[$status] ?? $statusInfo['belum_diatur'];

    $statusJanji = in_array($status, ['tersedia'])
        ? 'Dapat Mengajukan Pertemuan'
        : 'Perlu Janji Temu';
@endphp

<div class="decoration one"></div>
<div class="decoration two"></div>

<div class="container">

    <div class="top-bar"></div>

    <header class="header">
        <a href="{{ route('buku-tamu.tujuan') }}" class="back" aria-label="Kembali">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 12H5M11 6l-6 6 6 6"/>
            </svg>
        </a>
        <h1>Hasil Pencarian</h1>
    </header>

    <main class="content">

        <!-- PROFIL PEGAWAI -->
        <section class="employee-card">

            <div class="employee-profile">

                <div class="avatar">👤</div>

                <div>
                    <h2 class="employee-name">
                        {{ $pegawai->nama_lengkap }}
                    </h2>

                    <p class="employee-position">
                        {{ $pegawai->jabatan ?? 'Jabatan belum diisi' }}
                    </p>

                    <span class="status-badge {{ $info['class'] }}">
                        ● {{ $info['label'] }}
                    </span>
                </div>

            </div>

            <p class="employee-description">
                {{ $info['description'] }}
            </p>

            <div class="appointment-hint">
                Silakan pilih jadwal janji temu<br>
                jika ingin bertemu.
            </div>

        </section>

        <!-- INFORMASI LAIN -->
        <section class="info-card">

            <h3 class="section-title">Informasi Lain</h3>

            <div class="info-row">

                <div class="info-icon">▣</div>

                <div>
                    <p class="info-label">Tujuan Kunjungan</p>

                    <p class="info-value">
                        {{ $tujuan }}
                    </p>
                </div>

            </div>

            <div class="info-row">

                <div class="info-icon">◷</div>

                <div>
                    <p class="info-label">Waktu Kunjungan</p>

                    <p class="info-value">
                        Belum dijadwalkan
                    </p>
                </div>

            </div>

            <div class="info-row">

                <div class="info-icon">▧</div>

                <div>
                    <p class="info-label">Status</p>

                    <p class="info-value visit-status">
                        {{ $statusJanji }}
                    </p>
                </div>

            </div>

            <!-- TOMBOL JANJI TEMU -->
            <div class="button-area">

                <a
                    href="{{ route('buku-tamu.ajukan-janji') }}"
                    class="btn-appointment"
                >
                    Ajukan Janji Temu
                    <span class="btn-icon">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </span>
                </a>

            </div>

        </section>

    </main>

    <footer class="footer">
        Dinas Arsip dan Perpustakaan Kabupaten Cirebon
        <br>
        © 2026 Buku Tamu Digital
    </footer>

</div>

</body>
</html>