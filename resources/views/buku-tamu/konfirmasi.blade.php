<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Kunjungan - Buku Tamu Digital</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            padding: 20px;
            background: #f5f1ed;
            color: #29232a;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            width: 100%;
            max-width: 570px;
            margin: 25px auto;
            background: #fff;
            border: 1px solid #eadbdc;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,.07);
        }

        .top-bar {
            height: 8px;
            background: linear-gradient(90deg, #5b172c, #a13d58, #d2a36c);
        }

        .content {
            padding: 30px;
        }

        .success-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #e4f5e9;
            color: #299653;
            font-size: 42px;
            font-weight: 700;
        }

        .heading {
            text-align: center;
            margin-bottom: 12px;
        }

        .heading h1 {
            color: #5b172c;
            font-size: 20px;
            font-weight: 800;
            line-height: 1.5;
        }

        .heading p {
            margin-top: 12px;
            color: #77717a;
            font-size: 12px;
            line-height: 1.8;
        }

        .status-box {
            margin-top: 25px;
            padding: 17px;
            background: #fff8ed;
            border: 1px solid #f1dfbd;
            border-radius: 12px;
            text-align: center;
        }

        .status-label {
            color: #8a755b;
            font-size: 11px;
            margin-bottom: 6px;
        }

        .status-value {
            color: #a46b20;
            font-size: 14px;
            font-weight: 800;
        }

        .ticket {
            margin-top: 22px;
            padding: 22px;
            border: 1px solid #eadfe0;
            border-radius: 14px;
            background: #fffdfc;
        }

        .ticket-header {
            padding-bottom: 16px;
            border-bottom: 1px dashed #d8c5c8;
            text-align: center;
        }

        .ticket-header h2 {
            color: #5b172c;
            font-size: 15px;
            font-weight: 800;
        }

        .ticket-header p {
            margin-top: 5px;
            color: #888;
            font-size: 10px;
        }

        .kode-box {
            margin: 18px 0;
            padding: 13px;
            background: #f8eeee;
            border-radius: 10px;
            text-align: center;
        }

        .kode-label {
            color: #8b7478;
            font-size: 10px;
        }

        .kode-value {
            margin-top: 5px;
            color: #741d39;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: 1px;
            word-break: break-word;
        }

        .detail-title {
            margin-bottom: 15px;
            color: #5b172c;
            font-size: 13px;
            font-weight: 800;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #f0e9e7;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            flex: 0 0 38%;
            color: #88818a;
            font-size: 11px;
        }

        .detail-value {
            flex: 1;
            color: #39323b;
            font-size: 11px;
            font-weight: 600;
            text-align: right;
            overflow-wrap: anywhere;
        }

        .instruction {
            margin-top: 20px;
            padding: 14px;
            background: #edf3fb;
            color: #526b8b;
            border-radius: 10px;
            font-size: 11px;
            line-height: 1.8;
        }

        .download-title {
            margin-top: 25px;
            margin-bottom: 12px;
            color: #5b172c;
            font-size: 13px;
            font-weight: 700;
        }

        .download-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .download-btn {
            min-height: 47px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 1px solid #741d39;
            border-radius: 9px;
            background: white;
            color: #741d39;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s;
        }

        .download-btn:hover {
            background: #741d39;
            color: white;
        }

        .download-btn:disabled {
            opacity: .6;
            cursor: wait;
        }

        .home-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 47px;
            margin-top: 12px;
            border-radius: 9px;
            background: #741d39;
            color: white;
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
        }

        .home-btn:hover {
            background: #531329;
        }

        .footer {
            padding: 17px;
            background: #faf5f1;
            color: #99909a;
            text-align: center;
            font-size: 10px;
            line-height: 1.8;
        }

        @media (max-width: 480px) {
            body {
                padding: 9px;
            }

            .container {
                margin: 8px auto;
                border-radius: 16px;
            }

            .content {
                padding: 21px 17px;
            }

            .heading h1 {
                font-size: 18px;
            }

            .ticket {
                padding: 16px;
            }

            .kode-value {
                font-size: 16px;
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

            .container {
                margin: 0 auto;
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .download-area,
            .home-btn {
                display: none !important;
            }
        }

        /* TAMPILAN KHUSUS SAAT MEMBUAT PDF */
        .pdf-mode {
            width: 760px !important;
            max-width: none !important;
            margin: 0 !important;
            border-radius: 0 !important;
            overflow: visible !important;
            box-shadow: none !important;
            border: 1px solid #eadbdc !important;
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
            font-size: 28px;
        }

        .pdf-mode .heading {
            margin-bottom: 7px;
        }

        .pdf-mode .heading h1 {
            font-size: 17px;
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
            font-size: 9px;
            margin-bottom: 3px;
        }

        .pdf-mode .status-value {
            font-size: 11px;
        }

        .pdf-mode .ticket {
            margin-top: 12px;
            padding: 14px 18px;
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
            padding: 8px;
        }

        .pdf-mode .kode-label {
            font-size: 8px;
        }

        .pdf-mode .kode-value {
            margin-top: 3px;
            font-size: 15px;
        }

        .pdf-mode .detail-title {
            margin-bottom: 7px;
            font-size: 11px;
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
            padding: 9px;
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

        </div>

        <!-- KEMBALI KE BERANDA -->
        <a href="{{ route('home') }}" class="home-btn">
            Kembali ke Beranda
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
    function ambilGambarBukti(pdfMode = false) {

        const area = document.getElementById('buktiKunjungan');

        return html2canvas(area, {
            scale: pdfMode ? 2 : 2,
            backgroundColor: '#ffffff',
            useCORS: true,
            logging: false,
            scrollY: 0,

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

        ambilGambarBukti(false).then(function(canvas) {

            const link = document.createElement('a');

            link.download = 'Bukti-Kunjungan-{{ $janjiTemu->kode_kunjungan }}.jpg';

            link.href = canvas.toDataURL('image/jpeg', 0.95);

            link.click();

        }).catch(function(error) {

            alert('Gagal mengunduh JPG. Silakan coba kembali.');

            console.error(error);

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