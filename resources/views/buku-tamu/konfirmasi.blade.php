<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Kunjungan | Buku Tamu Digital</title>

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
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            padding: 24px;
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

        /* LINGKARAN DEKORASI (di luar area unduhan) */
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
            max-width: 600px;
            margin: 16px auto;
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

        .content {
            padding: 36px 36px 34px;
        }

        /* IKON BERHASIL */
        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--gold-light);
            font-size: 42px;
            font-weight: 700;
            line-height: 1;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            border: 4px solid var(--gold);
            box-shadow: 0 0 0 8px rgba(201, 162, 77, .15);
        }

        /* JUDUL */
        .heading {
            margin-bottom: 12px;
            text-align: center;
        }

        .heading h1 {
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -.5px;
        }

        .heading p {
            margin-top: 14px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        /* STATUS */
        .status-box {
            margin-top: 24px;
            padding: 16px;
            text-align: center;
            background: rgba(201, 162, 77, .14);
            border: 1px dashed var(--gold);
            border-radius: 16px;
        }

        .status-label {
            margin-bottom: 6px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .status-value {
            color: var(--navy);
            font-size: 16px;
            font-weight: 800;
        }

        /* TIKET */
        .ticket {
            margin-top: 22px;
            padding: 24px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(11, 27, 51, .06);
        }

        .ticket-header {
            padding-bottom: 16px;
            text-align: center;
            border-bottom: 1px dashed rgba(18, 41, 74, .25);
        }

        .ticket-header h2 {
            color: var(--navy);
            font-size: 15px;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .ticket-header p {
            margin-top: 5px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: .5px;
        }

        .kode-box {
            margin: 18px 0;
            padding: 16px;
            text-align: center;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            border-radius: 16px;
        }

        .kode-label {
            color: var(--gold-light);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2.5px;
        }

        .kode-value {
            margin-top: 6px;
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1.5px;
            word-break: break-word;
        }

        .detail-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .detail-title::before {
            content: "";
            width: 34px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid var(--line);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            flex: 0 0 38%;
            color: var(--muted);
            font-size: 12px;
        }

        .detail-value {
            flex: 1;
            color: var(--navy);
            font-size: 12px;
            font-weight: 700;
            text-align: right;
            overflow-wrap: anywhere;
        }

        /* PETUNJUK */
        .instruction {
            margin-top: 20px;
            padding: 15px 18px;
            color: var(--navy-light);
            font-size: 12px;
            line-height: 1.8;
            background: rgba(18, 41, 74, .06);
            border-left: 4px solid var(--gold);
            border-radius: 12px;
        }

        /* UNDUHAN */
        .download-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 28px;
            margin-bottom: 14px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .download-title::before {
            content: "";
            width: 34px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .download-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .download-btn {
            min-height: 52px;
            padding: 0 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1.5px solid var(--navy);
            border-radius: 999px;
            background: white;
            color: var(--navy);
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .2px;
            cursor: pointer;
            transition: transform .25s, background .25s, color .25s;
        }

        .download-btn:hover {
            background: var(--navy);
            color: white;
            transform: translateY(-2px);
        }

        .download-btn:disabled {
            opacity: .6;
            cursor: wait;
            transform: none;
        }

        .download-btn:focus-visible,
        .home-btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        a.download-btn {
            text-decoration: none;
        }

        .calendar-btn {
            width: 100%;
            margin-top: 12px;
        }

        /* TOMBOL KEMBALI KE BERANDA: gaya sama dengan slider di halaman awal */
        .home-btn {
            width: 100%;
            min-height: 58px;
            margin-top: 18px;
            padding: 0 8px 0 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            border-radius: 999px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            letter-spacing: .3px;
            text-decoration: none;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow:
                0 14px 30px rgba(18, 41, 74, .30),
                inset 0 0 0 1px rgba(255, 255, 255, .06);
            transition: transform .25s;
        }

        .home-btn:hover {
            transform: translateY(-2px);
        }

        .home-btn .btn-icon {
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

        .home-btn .icon {
            width: 20px;
            height: 20px;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.6;
            stroke-linecap: round;
            stroke-linejoin: round;
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

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                margin: 8px auto;
                border-radius: 22px;
            }

            .top-bar {
                height: 6px;
            }

            .content {
                padding: 26px 18px 26px;
            }

            .success-icon {
                width: 70px;
                height: 70px;
                font-size: 36px;
            }

            .heading h1 {
                font-size: 23px;
            }

            .heading p {
                font-size: 12px;
            }

            .ticket {
                padding: 18px 16px;
            }

            .kode-value {
                font-size: 18px;
            }

            .download-buttons {
                gap: 10px;
            }

            .download-btn {
                padding: 0 8px;
                font-size: 12px;
            }

            .home-btn {
                min-height: 54px;
                padding-left: 22px;
                font-size: 14px;
            }

            .home-btn .btn-icon {
                width: 40px;
                height: 40px;
            }

            .footer {
                padding: 16px 12px;
                font-size: 10px;
            }
        }

        /* PENGATURAN CETAK */
        @media print {
            @page {
                size: A4 portrait;
                margin: 10mm;
            }

            body {
                padding: 0;
                background: white;
            }

            .decoration {
                display: none;
            }

            .container {
                margin: 0 auto;
                box-shadow: none;
                border: 1px solid #ddd;
                animation: none;
            }

            .download-area,
            .home-btn {
                display: none !important;
            }
        }

        /* TAMPILAN KHUSUS SAAT MEMBUAT PDF DAN JPG */
        .pdf-mode {
            width: 760px !important;
            max-width: none !important;
            margin: 0 !important;
            border-radius: 0 !important;
            overflow: visible !important;
            box-shadow: none !important;
            animation: none !important;
            border: 1px solid var(--line) !important;
        }

        .pdf-mode .top-bar {
            height: 6px;
        }

        .pdf-mode .content {
            padding: 17px 24px;
        }

        .pdf-mode .success-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 8px;
            border-width: 3px;
            box-shadow: none;
            font-size: 26px;
        }

        .pdf-mode .heading {
            margin-bottom: 7px;
        }

        .pdf-mode .heading h1 {
            font-size: 19px;
            line-height: 1.35;
        }

        .pdf-mode .heading p {
            margin-top: 6px;
            font-size: 10px;
            line-height: 1.5;
        }

        .pdf-mode .status-box {
            margin-top: 12px;
            padding: 9px;
        }

        .pdf-mode .status-label {
            margin-bottom: 3px;
            font-size: 9px;
        }

        .pdf-mode .status-value {
            font-size: 12px;
        }

        .pdf-mode .ticket {
            margin-top: 12px;
            padding: 14px 18px;
            box-shadow: none;
        }

        .pdf-mode .ticket-header {
            padding-bottom: 9px;
        }

        .pdf-mode .ticket-header h2 {
            font-size: 12px;
        }

        .pdf-mode .ticket-header p {
            margin-top: 3px;
            font-size: 8px;
        }

        .pdf-mode .kode-box {
            margin: 10px 0;
            padding: 9px;
        }

        .pdf-mode .kode-label {
            font-size: 8px;
        }

        .pdf-mode .kode-value {
            margin-top: 3px;
            font-size: 16px;
        }

        .pdf-mode .detail-title {
            margin-bottom: 7px;
            font-size: 9px;
        }

        .pdf-mode .detail-row {
            gap: 12px;
            padding: 6px 0;
        }

        .pdf-mode .detail-label {
            font-size: 9px;
        }

        .pdf-mode .detail-value {
            font-size: 9px;
            line-height: 1.4;
        }

        .pdf-mode .instruction {
            margin-top: 10px;
            padding: 9px 12px;
            font-size: 9px;
            line-height: 1.5;
        }

        .pdf-mode .footer {
            padding: 9px;
            font-size: 8px;
            line-height: 1.5;
        }

        .pdf-mode .download-area,
        .pdf-mode .home-btn {
            display: none !important;
        }
    </style>
</head>

<body>

<div class="decoration one"></div>
<div class="decoration two"></div>

<div class="container" id="buktiKunjungan">

    <div class="top-bar"></div>

    <main class="content">

        <!-- IKON BERHASIL -->
        <div class="success-icon">
            ✓
        </div>

        <!-- JUDUL KONFIRMASI -->
        <div class="heading">
            <h1>Permohonan Janji Temu Berhasil Dikirim</h1>

            <p>
                Terima kasih telah menggunakan layanan Buku Tamu Digital.
                Permohonan janji temu Anda telah kami terima.
                Silakan menunggu konfirmasi dari pihak Dinas Arsip
                dan Perpustakaan Kabupaten Cirebon.
            </p>
        </div>

        <!-- STATUS PERMOHONAN -->
        <div class="status-box">
            <p class="status-label">Status Permohonan</p>

            <p class="status-value">
                {{ $janjiTemu->status }}
            </p>
        </div>

        <!-- BUKTI KUNJUNGAN -->
        <section class="ticket" id="areaUnduhan">

            <div class="ticket-header">
                <h2>BUKTI PERMOHONAN KUNJUNGAN</h2>

                <p>
                    DINAS ARSIP DAN PERPUSTAKAAN
                    KABUPATEN CIREBON
                </p>
            </div>

            <!-- KODE KUNJUNGAN -->
            <div class="kode-box">
                <p class="kode-label">KODE KUNJUNGAN</p>

                <p class="kode-value">
                    {{ $janjiTemu->kode_kunjungan }}
                </p>
            </div>

            <!-- DETAIL PENGUNJUNG -->
            <h3 class="detail-title">Detail Permohonan</h3>

            <div class="detail-row">
                <span class="detail-label">Nama Pengunjung</span>

                <span class="detail-value">
                    {{ $janjiTemu->nama_tamu }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Nomor Telepon</span>

                <span class="detail-value">
                    {{ $janjiTemu->telepon }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Instansi</span>

                <span class="detail-value">
                    {{ $janjiTemu->instansi ?? '-' }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Pegawai Tujuan</span>

                <span class="detail-value">
                    {{ $janjiTemu->pegawai->nama_lengkap ?? '-' }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Tujuan Kunjungan</span>

                <span class="detail-value">
                    {{ $janjiTemu->tujuan }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Tanggal Kunjungan</span>

                <span class="detail-value">
                    {{ $janjiTemu->tanggal_kunjungan->translatedFormat('d F Y') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Waktu Kunjungan</span>

                <span class="detail-value">
                    {{ $janjiTemu->waktu_kunjungan }} WIB
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Catatan</span>

                <span class="detail-value">
                    {{ $janjiTemu->catatan ?? '-' }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Status</span>

                <span class="detail-value">
                    {{ $janjiTemu->status }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">Tanggal Pengajuan</span>

                <span class="detail-value">
                    {{ $janjiTemu->created_at->translatedFormat('d F Y, H:i') }} WIB
                </span>
            </div>

        </section>

        <!-- PETUNJUK -->
        <div class="instruction">
            <strong>Informasi:</strong><br>
            Simpan bukti permohonan ini dan tunjukkan kepada
            petugas saat datang ke kantor Dinas Arsip dan
            Perpustakaan Kabupaten Cirebon.
            Kode kunjungan digunakan untuk memeriksa data permohonan Anda.
        </div>

        <!-- TOMBOL UNDUHAN -->
        <div class="download-area">

            <p class="download-title">
                Unduh Bukti Kunjungan
            </p>

            <div class="download-buttons">

                <button
                    type="button"
                    class="download-btn"
                    onclick="unduhJPG()"
                >
                    🖼 Unduh JPG
                </button>

                <button
                    type="button"
                    class="download-btn"
                    onclick="unduhPDF()"
                >
                    📄 Unduh PDF
                </button>

            </div>

            @php
                /*
                |--------------------------------------------------------------
                | LINK GOOGLE CALENDAR
                |--------------------------------------------------------------
                | Waktu kunjungan dibaca dari format "09:00 - 10:00".
                | Jika format tidak dikenali, acara dibuat sebagai
                | acara sepanjang hari pada tanggal kunjungan.
                */
                $tanggalKalender = $janjiTemu->tanggal_kunjungan->format('Ymd');

                if (preg_match(
                    '/(\d{1,2})[:.](\d{2})\s*-\s*(\d{1,2})[:.](\d{2})/',
                    (string) $janjiTemu->waktu_kunjungan,
                    $waktu
                )) {
                    $mulaiKalender = $tanggalKalender
                        . 'T' . sprintf('%02d%02d00', $waktu[1], $waktu[2]);

                    $selesaiKalender = $tanggalKalender
                        . 'T' . sprintf('%02d%02d00', $waktu[3], $waktu[4]);

                    $rentangKalender = $mulaiKalender . '/' . $selesaiKalender;
                } else {
                    $rentangKalender = $tanggalKalender . '/'
                        . $janjiTemu->tanggal_kunjungan->copy()->addDay()->format('Ymd');
                }

                $urlKalender = 'https://calendar.google.com/calendar/render?' . http_build_query([
                    'action'   => 'TEMPLATE',
                    'text'     => 'Kunjungan ke Dinas Arsip dan Perpustakaan Kabupaten Cirebon',
                    'dates'    => $rentangKalender,
                    'ctz'      => 'Asia/Jakarta',
                    'location' => 'Dinas Arsip dan Perpustakaan Kabupaten Cirebon',
                    'details'  => "Kode Kunjungan: {$janjiTemu->kode_kunjungan}\n"
                        . "Tujuan: {$janjiTemu->tujuan}\n"
                        . 'Pegawai Tujuan: ' . ($janjiTemu->pegawai->nama_lengkap ?? '-') . "\n"
                        . "Status: {$janjiTemu->status}",
                ]);
            @endphp

            <a
                href="{{ $urlKalender }}"
                target="_blank"
                rel="noopener"
                class="download-btn calendar-btn"
            >
                📅 Tambahkan ke Google Calendar
            </a>

        </div>

        <!-- KEMBALI KE BERANDA -->
        <a href="{{ route('home') }}" class="home-btn">
            Kembali ke Beranda
            <span class="btn-icon">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M5 12h14M13 6l6 6-6 6"/>
                </svg>
            </span>
        </a>

    </main>

    <footer class="footer">
        Dinas Arsip dan Perpustakaan Kabupaten Cirebon
        <br>
        © 2026 Buku Tamu Digital
    </footer>

</div>

<!-- LIBRARY UNTUK MEMBUAT JPG DAN PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>

    // FUNGSI MENGAMBIL GAMBAR BUKTI KUNJUNGAN
    // pdfMode = true  -> tampilan rapi tanpa tombol, lebar tetap 760px
    //                    (dipakai untuk PDF dan JPG agar hasilnya sama)
    async function ambilGambarBukti(pdfMode = false, skala = 2) {

        const area = document.getElementById('buktiKunjungan');

        // Tunggu font DM Sans dan Playfair Display selesai dimuat agar teks tidak berubah
        if (document.fonts && document.fonts.ready) {
            await document.fonts.ready;
        }

        return html2canvas(area, {
            scale: skala,
            backgroundColor: '#fbf8f1',
            useCORS: true,
            logging: false,
            scrollX: 0,
            scrollY: 0,

            // Lebar jendela dikunci agar tampilan HP tidak ikut tertangkap
            windowWidth: pdfMode ? 820 : document.documentElement.clientWidth,

            onclone: function(documentClone) {

                if (pdfMode) {

                    const areaClone = documentClone.getElementById('buktiKunjungan');

                    areaClone.classList.add('pdf-mode');

                }
            }
        });
    }


    // FUNGSI UNDUH JPG
    function unduhJPG() {

        const tombol = document.querySelectorAll('.download-btn');

        tombol.forEach(function(button) {
            button.disabled = true;
        });

        // Memakai tampilan yang sama dengan PDF, kualitas lebih tajam
        ambilGambarBukti(true, 3).then(function(canvas) {

            const link = document.createElement('a');

            link.download = 'Bukti-Kunjungan-{{ $janjiTemu->kode_kunjungan }}.jpg';

            link.href = canvas.toDataURL('image/jpeg', 0.95);

            link.click();

        }).catch(function(error) {

            alert('Gagal mengunduh JPG. Silakan coba kembali.');

            console.error(error);

        }).finally(function() {

            tombol.forEach(function(button) {
                button.disabled = false;
            });

        });
    }


    // FUNGSI UNDUH PDF A4 SATU HALAMAN
    function unduhPDF() {

        const tombol = document.querySelectorAll('.download-btn');

        tombol.forEach(function(button) {
            button.disabled = true;
        });

        ambilGambarBukti(true).then(function(canvas) {

            const { jsPDF } = window.jspdf;

            // Membuat PDF A4 portrait
            const pdf = new jsPDF({
                orientation: 'portrait',
                unit: 'mm',
                format: 'a4',
                compress: true
            });

            // Ukuran kertas A4
            const lebarHalaman = 210;
            const tinggiHalaman = 297;

            // Margin kertas
            const margin = 10;

            // Area yang tersedia
            const lebarTersedia = lebarHalaman - (margin * 2);
            const tinggiTersedia = tinggiHalaman - (margin * 2);

            // Menghitung skala agar seluruh gambar masuk
            const skala = Math.min(
                lebarTersedia / canvas.width,
                tinggiTersedia / canvas.height
            );

            // Ukuran gambar setelah disesuaikan
            const lebarGambar = canvas.width * skala;
            const tinggiGambar = canvas.height * skala;

            // Posisi gambar di tengah halaman
            const posisiX = (lebarHalaman - lebarGambar) / 2;
            const posisiY = (tinggiHalaman - tinggiGambar) / 2;

            // Mengubah seluruh isi menjadi gambar
            const imgData = canvas.toDataURL('image/jpeg', 0.95);

            // Memasukkan gambar ke satu halaman PDF
            pdf.addImage(
                imgData,
                'JPEG',
                posisiX,
                posisiY,
                lebarGambar,
                tinggiGambar,
                undefined,
                'FAST'
            );

            // Menyimpan PDF
            pdf.save(
                'Bukti-Kunjungan-{{ $janjiTemu->kode_kunjungan }}.pdf'
            );

        }).catch(function(error) {

            alert('Gagal mengunduh PDF. Silakan coba kembali.');

            console.error(error);

        }).finally(function() {

            tombol.forEach(function(button) {
                button.disabled = false;
            });

        });
    }

</script>

</body>
</html>