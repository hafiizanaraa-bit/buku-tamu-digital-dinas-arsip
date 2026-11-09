<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Buku Tamu Digital</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            padding: 25px;
            background: #f5eeea;
            color: #343044;
            font-family: 'DM Sans', sans-serif;
        }

        .container {
            width: 100%;
            max-width: 650px;
            margin: 20px auto;
            background: #fffdfb;
            border: 1px solid #eadedb;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(75, 30, 40, .10);
        }

        .top-bar {
            height: 9px;
            background: linear-gradient(90deg, #4f1020, #9d3349, #d2a36c);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 22px 28px;
            border-bottom: 1px solid #f0e8e5;
        }

        .back {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f8eeee;
            color: #781f2b;
            text-decoration: none;
            font-size: 23px;
        }

        .header h1 {
            color: #4f1020;
            font-size: 20px;
            font-weight: 800;
        }

        .content {
            padding: 25px 28px 30px;
        }

        .employee-card {
            padding: 22px;
            background: #fff;
            border: 1px solid #eee7e4;
            border-radius: 17px;
            box-shadow: 0 4px 15px rgba(70, 40, 40, .04);
            margin-bottom: 18px;
        }

        .employee-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: #f3e9e8;
            color: #781f2b;
            font-size: 28px;
        }

        .employee-name {
            color: #343044;
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .employee-position {
            color: #85818b;
            font-size: 13px;
        }

        .status-badge {
            display: inline-block;
            margin-top: 11px;
            padding: 7px 13px;
            border-radius: 30px;
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
            color: #665b61;
            background: #eee9eb;
        }

        .status-belum {
            color: #75675f;
            background: #f1ece7;
        }

        .employee-description {
            margin-top: 9px;
            color: #88838d;
            font-size: 12px;
            line-height: 1.6;
        }

        .appointment-hint {
            margin-top: 15px;
            padding: 13px;
            background: #edf4fc;
            border-radius: 11px;
            text-align: center;
            color: #647b9b;
            font-size: 12px;
            line-height: 1.7;
        }

        .info-card {
            padding: 22px;
            background: #fff;
            border: 1px solid #eee7e4;
            border-radius: 17px;
            box-shadow: 0 4px 15px rgba(70, 40, 40, .04);
        }

        .section-title {
            margin-bottom: 20px;
            color: #343044;
            font-size: 15px;
            font-weight: 800;
        }

        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            margin-bottom: 20px;
        }

        .info-row:last-child {
            margin-bottom: 0;
        }

        .info-icon {
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #edf2fb;
            color: #5879b6;
            font-size: 16px;
        }

        .info-label {
            margin-bottom: 5px;
            color: #85818b;
            font-size: 12px;
        }

        .info-value {
            color: #4b4655;
            font-size: 13px;
            font-weight: 600;
            line-height: 1.6;
        }

        .visit-status {
            color: #c37a4c;
            font-weight: 800;
        }

        .button-area {
            margin-top: 24px;
        }

        .btn-appointment {
            width: 100%;
            min-height: 49px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid #a94a60;
            border-radius: 11px;
            background: white;
            color: #781f2b;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .btn-appointment:hover {
            background: #781f2b;
            color: white;
        }

        .footer {
            padding: 17px;
            text-align: center;
            color: #99909a;
            background: #faf5f1;
            font-size: 11px;
            line-height: 1.7;
        }

        @media (max-width: 600px) {
            body {
                padding: 9px;
            }

            .container {
                margin: 8px auto;
                border-radius: 18px;
            }

            .header {
                padding: 17px 19px;
            }

            .header h1 {
                font-size: 17px;
            }

            .content {
                padding: 17px 15px 23px;
            }

            .employee-card {
                padding: 17px;
            }

            .avatar {
                width: 53px;
                height: 53px;
                font-size: 24px;
            }

            .employee-name {
                font-size: 14px;
            }

            .employee-position {
                font-size: 12px;
            }

            .info-card {
                padding: 18px;
            }

            .section-title {
                font-size: 14px;
            }
        }

        @media (min-width: 900px) {
            body {
                padding-top: 45px;
                padding-bottom: 45px;
            }

            .container {
                max-width: 700px;
            }

            .content {
                padding: 32px 38px 38px;
            }

            .employee-card,
            .info-card {
                padding: 25px;
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

<div class="container">

    <div class="top-bar"></div>

    <header class="header">
        <a href="{{ route('buku-tamu.tujuan') }}" class="back">‹</a>
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