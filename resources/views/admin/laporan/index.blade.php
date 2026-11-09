@extends('layouts.admin')

@section('title', 'Laporan Kunjungan')

@push('styles')
<style>
    /* =========================================
       TAMPILAN HALAMAN LAPORAN
    ========================================= */

    .page-title {
        color: #35103F;
        margin-bottom: 10px;
        font-size: 26px;
        font-weight: 700;
    }

    .page-description {
        color: #777;
        margin-bottom: 25px;
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 18px;
        margin-bottom: 25px;
    }

    .summary-card {
        background: white;
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(53, 16, 63, 0.06);
        border-left: 5px solid #8955ED;
    }

    .summary-card h3 {
        color: #777;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .summary-card p {
        color: #35103F;
        font-size: 27px;
        font-weight: bold;
        margin: 0;
    }

    .filter-container,
    .table-container {
        background: white;
        padding: 22px;
        border-radius: 14px;
        box-shadow: 0 3px 12px rgba(53, 16, 63, 0.06);
        margin-bottom: 25px;
    }

    .filter-container h3,
    .table-container h3 {
        color: #35103F;
        margin-bottom: 18px;
        font-size: 17px;
    }

    /* =========================================
       FILTER LAPORAN
    ========================================= */

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: end;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: bold;
        color: #555;
    }

    .filter-group select {
        width: 100%;
        padding: 11px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        outline: none;
    }

    .filter-group select:focus {
        border-color: #8955ED;
        box-shadow: 0 0 0 3px rgba(137, 85, 237, 0.10);
    }

    .btn-filter {
        padding: 12px 20px;
        background: #8955ED;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.2s;
    }

    .btn-filter:hover {
        background: #7040CE;
    }

    /* =========================================
       TOMBOL EXPORT
    ========================================= */

    .export-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
    }

    .btn-export {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 17px;
        border: none;
        border-radius: 8px;
        color: white;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        opacity: 0.9;
    }

    .btn-pdf {
        background: #D93025;
    }

    .btn-excel {
        background: #18864B;
    }

    .btn-word {
        background: #2864C5;
    }

    /* =========================================
       TABEL LAPORAN
    ========================================= */

    .table-container {
        overflow-x: auto;
    }

    .table-laporan {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    .table-laporan th,
    .table-laporan td {
        padding: 13px;
        border-bottom: 1px solid #eee;
        text-align: left;
        font-size: 13px;
    }

    .table-laporan th {
        background: #F3EDF9;
        color: #35103F;
        white-space: nowrap;
    }

    .table-laporan td {
        color: #555;
    }

    .table-laporan tbody tr:hover {
        background: #FAF8FD;
    }

    /* =========================================
       STATUS KUNJUNGAN
    ========================================= */

    .status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        white-space: nowrap;
    }

    .status-diterima {
        background: #E1F5E8;
        color: #217A42;
    }

    .status-ditolak {
        background: #FFE6ED;
        color: #A52A4A;
    }

    .status-menunggu {
        background: #FFF2D6;
        color: #946200;
    }

    .empty-data {
        text-align: center !important;
        color: #888;
        padding: 30px !important;
    }

    /* =========================================
       KOP DAN JUDUL KHUSUS CETAK
    ========================================= */

    .print-header,
    .print-report-title {
        display: none;
    }

    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 700px) {

        .filter-form {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group {
            width: 100%;
        }

        .btn-filter {
            width: 100%;
        }

        .page-title {
            font-size: 22px;
        }

        .export-container {
            flex-direction: column;
        }

        .btn-export {
            width: 100%;
        }
    }

    /* =========================================
       CETAK / EXPORT PDF A4 LANDSCAPE
    ========================================= */

    @media print {

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        html,
        body {
            width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            background: white !important;
            font-family: "Times New Roman", serif !important;
            color: #000 !important;
            font-size: 9pt !important;
        }

        .sidebar,
        .navbar,
        header,
        footer,
        .filter-container,
        .export-container,
        .page-title,
        .page-description,
        button {
            display: none !important;
        }

        /* KOP INSTANSI */

        .print-header {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 15px !important;
            border-bottom: 2px solid #000 !important;
            padding-bottom: 8px !important;
            margin-bottom: 12px !important;
            width: 100% !important;
        }

        .print-header img {
            width: 65px !important;
            height: 65px !important;
            object-fit: contain !important;
        }

        .print-header-text {
            flex: 1 !important;
            text-align: center !important;
        }

        .print-header-text h2 {
            font-size: 13pt !important;
            font-weight: bold !important;
            margin: 3px 0 !important;
            line-height: 1.2 !important;
        }

        .print-header-text p {
            font-size: 10pt !important;
            font-weight: bold !important;
            margin: 3px 0 !important;
        }

        /* JUDUL LAPORAN */

        .print-report-title {
            display: block !important;
            text-align: center !important;
            margin: 12px 0 !important;
        }

        .print-report-title h2 {
            font-size: 13pt !important;
            margin: 0 0 5px !important;
            font-weight: bold !important;
        }

        .print-report-title p {
            font-size: 9pt !important;
            margin: 0 !important;
        }

        /* RINGKASAN */

        .summary-cards {
            display: grid !important;
            grid-template-columns: repeat(4, 1fr) !important;
            gap: 8px !important;
            margin-bottom: 12px !important;
            width: 100% !important;
        }

        .summary-card {
            padding: 7px !important;
            border: 1px solid #777 !important;
            border-left: 3px solid #8955ED !important;
            border-radius: 0 !important;
            box-shadow: none !important;
        }

        .summary-card h3 {
            font-size: 9pt !important;
            margin: 0 0 4px !important;
            color: #000 !important;
        }

        .summary-card p {
            font-size: 12pt !important;
            font-weight: bold !important;
            margin: 0 !important;
            color: #000 !important;
        }

        /* TABEL */

        .table-container {
            padding: 0 !important;
            margin: 0 !important;
            overflow: visible !important;
            box-shadow: none !important;
            width: 100% !important;
        }

        .table-container h3 {
            text-align: center !important;
            font-size: 11pt !important;
            color: #000 !important;
            margin: 8px 0 !important;
        }

        .table-laporan {
            width: 100% !important;
            min-width: 0 !important;
            table-layout: fixed !important;
            border-collapse: collapse !important;
            font-family: "Times New Roman", serif !important;
        }

        /* LEBAR KOLOM */

        .table-laporan th:nth-child(1),
        .table-laporan td:nth-child(1) {
            width: 4% !important;
        }

        .table-laporan th:nth-child(2),
        .table-laporan td:nth-child(2) {
            width: 12% !important;
        }

        .table-laporan th:nth-child(3),
        .table-laporan td:nth-child(3) {
            width: 11% !important;
        }

        .table-laporan th:nth-child(4),
        .table-laporan td:nth-child(4) {
            width: 9% !important;
        }

        .table-laporan th:nth-child(5),
        .table-laporan td:nth-child(5) {
            width: 10% !important;
        }

        .table-laporan th:nth-child(6),
        .table-laporan td:nth-child(6) {
            width: 11% !important;
        }

        .table-laporan th:nth-child(7),
        .table-laporan td:nth-child(7) {
            width: 13% !important;
        }

        .table-laporan th:nth-child(8),
        .table-laporan td:nth-child(8) {
            width: 9% !important;
        }

        .table-laporan th:nth-child(9),
        .table-laporan td:nth-child(9) {
            width: 9% !important;
        }

        .table-laporan th:nth-child(10),
        .table-laporan td:nth-child(10) {
            width: 12% !important;
        }

        .table-laporan th,
        .table-laporan td {
            border: 1px solid #555 !important;
            padding: 5px 3px !important;
            font-family: "Times New Roman", serif !important;
            font-size: 8pt !important;
            line-height: 1.2 !important;
            color: #000 !important;
            overflow-wrap: anywhere !important;
            word-wrap: break-word !important;
            white-space: normal !important;
            vertical-align: middle !important;
        }

        .table-laporan th {
            text-align: center !important;
            font-weight: bold !important;
            background: #E8DDF8 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .table-laporan td {
            text-align: left !important;
        }

        .table-laporan tbody tr {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        .table-laporan thead {
            display: table-header-group !important;
        }

        /* STATUS */

        .status {
            display: inline !important;
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            font-size: 8pt !important;
            font-weight: bold !important;
            color: #000 !important;
            white-space: normal !important;
        }

        .empty-data {
            text-align: center !important;
        }
    }

</style>
@endpush


@section('content')

{{-- =========================================
     KOP LAPORAN UNTUK PDF
========================================= --}}

<div class="print-header">

    <img
        src="{{ asset('images/logo cirebon.png') }}"
        alt="Logo Kabupaten Cirebon"
    >

    <div class="print-header-text">

        <h2>PEMERINTAH KABUPATEN CIREBON</h2>

        <h2>DINAS KEARSIPAN DAN PERPUSTAKAAN</h2>

        <p>KABUPATEN CIREBON</p>

    </div>

</div>


{{-- =========================================
     JUDUL LAPORAN UNTUK PDF
========================================= --}}

<div class="print-report-title">

    <h2>LAPORAN KUNJUNGAN TAMU</h2>

    <p>
        Periode:
        {{ ($jenisLaporan ?? 'bulanan') == 'tahunan'
            ? 'Tahun ' . ($tahun ?? date('Y'))
            : \Carbon\Carbon::create()
                ->month((int) ($bulan ?? date('m')))
                ->translatedFormat('F') . ' ' . ($tahun ?? date('Y'))
        }}
    </p>

</div>


{{-- =========================================
     JUDUL HALAMAN
========================================= --}}

<h1 class="page-title">
    Laporan Kunjungan
</h1>

<p class="page-description">
    Kelola dan lihat laporan data kunjungan tamu Dinas Kearsipan
    dan Perpustakaan Kabupaten Cirebon.
</p>


{{-- =========================================
     FILTER LAPORAN
========================================= --}}

<div class="filter-container">

    <h3>Filter Laporan</h3>

    <form
        action="{{ route('admin.laporan.index') }}"
        method="GET"
        class="filter-form"
    >

        <div class="filter-group">

            <label>Jenis Laporan</label>

            <select name="jenis_laporan">

                <option
                    value="bulanan"
                    {{ ($jenisLaporan ?? 'bulanan') == 'bulanan' ? 'selected' : '' }}
                >
                    Laporan Bulanan
                </option>

                <option
                    value="tahunan"
                    {{ ($jenisLaporan ?? 'bulanan') == 'tahunan' ? 'selected' : '' }}
                >
                    Laporan Tahunan
                </option>

            </select>

        </div>


        <div class="filter-group">

            <label>Bulan</label>

            <select name="bulan">

                @foreach (range(1, 12) as $nomorBulan)

                    <option
                        value="{{ sprintf('%02d', $nomorBulan) }}"
                        {{ (int) ($bulan ?? date('m')) == $nomorBulan ? 'selected' : '' }}
                    >
                        {{ \Carbon\Carbon::create()
                            ->month($nomorBulan)
                            ->translatedFormat('F') }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="filter-group">

            <label>Tahun</label>

            <select name="tahun">

                @foreach (range(date('Y') - 5, date('Y') + 1) as $tahunPilihan)

                    <option
                        value="{{ $tahunPilihan }}"
                        {{ (int) ($tahun ?? date('Y')) == $tahunPilihan ? 'selected' : '' }}
                    >
                        {{ $tahunPilihan }}
                    </option>

                @endforeach

            </select>

        </div>


        <button type="submit" class="btn-filter">
            Tampilkan Laporan
        </button>

    </form>

</div>


{{-- =========================================
     RINGKASAN LAPORAN
========================================= --}}

<div class="summary-cards">

    <div class="summary-card">

        <h3>Total Kunjungan</h3>

        <p>{{ $totalKunjungan }}</p>

    </div>


    <div class="summary-card">

        <h3>Kunjungan Diterima</h3>

        <p>{{ $diterima }}</p>

    </div>


    <div class="summary-card">

        <h3>Kunjungan Ditolak</h3>

        <p>{{ $ditolak }}</p>

    </div>


    <div class="summary-card">

        <h3>Menunggu Konfirmasi</h3>

        <p>{{ $menunggu }}</p>

    </div>

</div>


{{-- =========================================
     TOMBOL EXPORT
========================================= --}}

<div class="export-container">

    <button
        type="button"
        class="btn-export btn-pdf"
        onclick="unduhPDF()"
    >

        <i class="fas fa-file-pdf"></i>

        Unduh PDF

    </button>


    <button
        type="button"
        class="btn-export btn-excel"
        onclick="unduhExcel()"
    >

        <i class="fas fa-file-excel"></i>

        Unduh Excel

    </button>


    <button
        type="button"
        class="btn-export btn-word"
        onclick="unduhWord()"
    >

        <i class="fas fa-file-word"></i>

        Unduh Word

    </button>

</div>


{{-- =========================================
     TABEL DATA LAPORAN
========================================= --}}

<div class="table-container">

    <h3>Data Laporan Kunjungan</h3>

    <table class="table-laporan" id="tabelLaporan">

        <thead>

            <tr>

                <th>No</th>

                <th>Kode Kunjungan</th>

                <th>Nama Tamu</th>

                <th>Telepon</th>

                <th>Instansi</th>

                <th>Pegawai Tujuan</th>

                <th>Tujuan</th>

                <th>Tanggal</th>

                <th>Waktu</th>

                <th>Status</th>

            </tr>

        </thead>


        <tbody>

            @forelse ($laporans as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->kode_kunjungan }}</td>

                    <td>{{ $item->nama_tamu }}</td>

                    <td>{{ $item->telepon }}</td>

                    <td>{{ $item->instansi ?? '-' }}</td>

                    <td>{{ $item->pegawai->nama ?? '-' }}</td>

                    <td>{{ $item->tujuan }}</td>

                    <td>
                        {{ $item->tanggal_kunjungan
                            ? $item->tanggal_kunjungan->format('d-m-Y')
                            : '-'
                        }}
                    </td>

                    <td>{{ $item->waktu_kunjungan }}</td>

                    <td>

                        @if ($item->status == 'Diterima')

                            <span class="status status-diterima">
                                Diterima
                            </span>

                        @elseif ($item->status == 'Ditolak')

                            <span class="status status-ditolak">
                                Ditolak
                            </span>

                        @else

                            <span class="status status-menunggu">
                                Menunggu Konfirmasi
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="10" class="empty-data">
                        Belum ada data kunjungan pada periode ini.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>


{{-- =========================================
     JAVASCRIPT EXPORT EXCEL DAN WORD
========================================= --}}

<script src="https://cdn.jsdelivr.net/npm/exceljs@4.4.0/dist/exceljs.min.js"></script>

<script>

    /* =========================================
       DATA LAPORAN
    ========================================= */

    const logoUrl = @json(asset('images/logo cirebon.png'));

    const totalKunjungan = {{ (int) $totalKunjungan }};

    const diterima = {{ (int) $diterima }};

    const ditolak = {{ (int) $ditolak }};

    const menunggu = {{ (int) $menunggu }};


    /* =========================================
       NAMA PERIODE
    ========================================= */

    function namaPeriode() {

        const jenis = @json($jenisLaporan ?? 'bulanan');

        const bulan = @json($bulan ?? date('m'));

        const tahun = @json($tahun ?? date('Y'));

        const namaBulan = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];

        if (jenis === 'tahunan') {

            return 'Tahun ' + tahun;

        }

        return namaBulan[parseInt(bulan, 10) - 1] + ' ' + tahun;

    }


    /* =========================================
       NAMA FILE
    ========================================= */

    function namaFile() {

        const jenis = @json($jenisLaporan ?? 'bulanan');

        const bulan = @json($bulan ?? date('m'));

        const tahun = @json($tahun ?? date('Y'));

        if (jenis === 'tahunan') {

            return 'Laporan_Kunjungan_' + tahun;

        }

        return 'Laporan_Kunjungan_' + tahun + '_' + bulan;

    }


    /* =========================================
       AMBIL DATA TABEL
    ========================================= */

    function ambilDataTabel() {

        const tabel = document.getElementById('tabelLaporan');

        return Array.from(tabel.querySelectorAll('tr')).map(row => {

            return Array.from(
                row.querySelectorAll('th, td')
            ).map(cell => {

                return cell.innerText.trim().replace(/\s+/g, ' ');

            });

        });

    }


    /* =========================================
       AMBIL LOGO DALAM FORMAT BASE64
    ========================================= */

    async function ambilLogoBase64() {

        const response = await fetch(logoUrl);

        if (!response.ok) {

            throw new Error(
                'Logo Kabupaten Cirebon tidak ditemukan. Periksa folder public/images.'
            );

        }

        const blob = await response.blob();

        return await new Promise((resolve, reject) => {

            const reader = new FileReader();

            reader.onloadend = () => resolve(reader.result);

            reader.onerror = reject;

            reader.readAsDataURL(blob);

        });

    }


    /* =========================================
       ESCAPE HTML
    ========================================= */

    function escapeHtml(value) {

        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');

    }


    /* =========================================
       EXPORT PDF
    ========================================= */

    function unduhPDF() {

        window.print();

    }


    /* =========================================
       EXPORT EXCEL XLSX
    ========================================= */

    async function unduhExcel() {

        try {

            if (typeof ExcelJS === 'undefined') {

                throw new Error(
                    'Library Excel belum berhasil dimuat. Periksa koneksi internet.'
                );

            }

            const workbook = new ExcelJS.Workbook();

            workbook.creator =
                'Dinas Kearsipan dan Perpustakaan Kabupaten Cirebon';

            workbook.subject = 'Laporan Kunjungan Tamu';

            workbook.title = 'Laporan Kunjungan Tamu';

            workbook.created = new Date();


            const sheet = workbook.addWorksheet(
                'Laporan Kunjungan',
                {
                    views: [
                        {
                            state: 'frozen',
                            ySplit: 12
                        }
                    ]
                }
            );


            /* LEBAR KOLOM */

            sheet.columns = [
                { width: 7 },
                { width: 20 },
                { width: 25 },
                { width: 17 },
                { width: 22 },
                { width: 25 },
                { width: 30 },
                { width: 16 },
                { width: 14 },
                { width: 22 }
            ];


            /* KOP INSTANSI */

            sheet.mergeCells('C1:H1');

            sheet.getCell('C1').value =
                'PEMERINTAH KABUPATEN CIREBON';


            sheet.mergeCells('C2:H2');

            sheet.getCell('C2').value =
                'DINAS KEARSIPAN DAN PERPUSTAKAAN';


            sheet.mergeCells('C3:H3');

            sheet.getCell('C3').value =
                'KABUPATEN CIREBON';


            ['C1', 'C2', 'C3'].forEach(cell => {

                sheet.getCell(cell).font = {
                    name: 'Times New Roman',
                    size: 12,
                    bold: true
                };

                sheet.getCell(cell).alignment = {
                    horizontal: 'center',
                    vertical: 'middle'
                };

            });


            sheet.getRow(1).height = 22;
            sheet.getRow(2).height = 22;
            sheet.getRow(3).height = 22;


            /* JUDUL LAPORAN */

            sheet.mergeCells('A5:J5');

            sheet.getCell('A5').value =
                'LAPORAN KUNJUNGAN TAMU';

            sheet.getCell('A5').font = {
                name: 'Times New Roman',
                size: 14,
                bold: true
            };

            sheet.getCell('A5').alignment = {
                horizontal: 'center',
                vertical: 'middle'
            };


            sheet.mergeCells('A6:J6');

            sheet.getCell('A6').value =
                'PERIODE: ' + namaPeriode().toUpperCase();

            sheet.getCell('A6').font = {
                name: 'Times New Roman',
                size: 10,
                bold: true
            };

            sheet.getCell('A6').alignment = {
                horizontal: 'center',
                vertical: 'middle'
            };


            sheet.getRow(5).height = 25;
            sheet.getRow(6).height = 20;


            /* LOGO INSTANSI */

            try {

                const logoBase64 = await ambilLogoBase64();

                const imageId = workbook.addImage({

                    base64: logoBase64,

                    extension: 'png'

                });

                sheet.addImage(imageId, {

                    tl: {
                        col: 0.5,
                        row: 0.3
                    },

                    ext: {
                        width: 65,
                        height: 65
                    }

                });

            } catch (error) {

                console.warn(
                    'Logo tidak dapat dimasukkan:',
                    error.message
                );

            }


            /* RINGKASAN LAPORAN */

            sheet.mergeCells('A8:J8');

            sheet.getCell('A8').value =
                'RINGKASAN LAPORAN';

            sheet.getCell('A8').font = {
                name: 'Times New Roman',
                size: 12,
                bold: true
            };

            sheet.getCell('A8').alignment = {
                horizontal: 'center',
                vertical: 'middle'
            };


            sheet.mergeCells('A9:B9');
            sheet.mergeCells('C9:D9');
            sheet.mergeCells('E9:F9');
            sheet.mergeCells('G9:J9');


            sheet.getCell('A9').value = 'TOTAL KUNJUNGAN';
            sheet.getCell('C9').value = 'DITERIMA';
            sheet.getCell('E9').value = 'DITOLAK';
            sheet.getCell('G9').value = 'MENUNGGU';


            sheet.mergeCells('A10:B10');
            sheet.mergeCells('C10:D10');
            sheet.mergeCells('E10:F10');
            sheet.mergeCells('G10:J10');


            sheet.getCell('A10').value = totalKunjungan;
            sheet.getCell('C10').value = diterima;
            sheet.getCell('E10').value = ditolak;
            sheet.getCell('G10').value = menunggu;


            ['A9', 'C9', 'E9', 'G9'].forEach(cell => {

                sheet.getCell(cell).font = {

                    name: 'Times New Roman',

                    bold: true,

                    size: 10,

                    color: {
                        argb: 'FFFFFFFF'
                    }

                };

                sheet.getCell(cell).fill = {

                    type: 'pattern',

                    pattern: 'solid',

                    fgColor: {
                        argb: 'FF8955ED'
                    }

                };

                sheet.getCell(cell).alignment = {

                    horizontal: 'center',

                    vertical: 'middle',

                    wrapText: true

                };

            });


            ['A10', 'C10', 'E10', 'G10'].forEach(cell => {

                sheet.getCell(cell).font = {

                    name: 'Times New Roman',

                    bold: true,

                    size: 13

                };

                sheet.getCell(cell).alignment = {

                    horizontal: 'center',

                    vertical: 'middle'

                };

            });


            sheet.getRow(9).height = 25;
            sheet.getRow(10).height = 23;


            /* HEADER TABEL */

            const data = ambilDataTabel();

            const header = data[0];

            const headerRow = sheet.addRow([]);

            header.forEach((value, index) => {

                headerRow.getCell(index + 1).value =
                    value.toUpperCase();

            });


            headerRow.height = 30;

            headerRow.eachCell(cell => {

                cell.font = {

                    name: 'Times New Roman',

                    size: 10,

                    bold: true,

                    color: {
                        argb: 'FFFFFFFF'
                    }

                };

                cell.fill = {

                    type: 'pattern',

                    pattern: 'solid',

                    fgColor: {
                        argb: 'FF35103F'
                    }

                };

                cell.alignment = {

                    horizontal: 'center',

                    vertical: 'middle',

                    wrapText: true

                };

                cell.border = {

                    top: {
                        style: 'thin',
                        color: { argb: 'FF777777' }
                    },

                    bottom: {
                        style: 'thin',
                        color: { argb: 'FF777777' }
                    },

                    left: {
                        style: 'thin',
                        color: { argb: 'FF777777' }
                    },

                    right: {
                        style: 'thin',
                        color: { argb: 'FF777777' }
                    }

                };

            });


            /* ISI TABEL */

            data.slice(1).forEach((rowData, index) => {

                if (
                    rowData.length === 1 &&
                    rowData[0] ===
                    'Belum ada data kunjungan pada periode ini.'
                ) {

                    const emptyRow = sheet.addRow([
                        rowData[0]
                    ]);

                    sheet.mergeCells(
                        `A${emptyRow.number}:J${emptyRow.number}`
                    );

                    emptyRow.getCell(1).alignment = {

                        horizontal: 'center',

                        vertical: 'middle'

                    };

                    return;

                }


                const row = sheet.addRow(rowData);

                row.height = 25;

                row.eachCell(cell => {

                    cell.font = {

                        name: 'Times New Roman',

                        size: 10,

                        color: {
                            argb: 'FF333333'
                        }

                    };

                    cell.alignment = {

                        vertical: 'middle',

                        wrapText: true,

                        horizontal: 'left'

                    };

                    cell.border = {

                        top: {
                            style: 'thin',
                            color: { argb: 'FFCCCCCC' }
                        },

                        bottom: {
                            style: 'thin',
                            color: { argb: 'FFCCCCCC' }
                        },

                        left: {
                            style: 'thin',
                            color: { argb: 'FFCCCCCC' }
                        },

                        right: {
                            style: 'thin',
                            color: { argb: 'FFCCCCCC' }
                        }

                    };


                    if (index % 2 === 1) {

                        cell.fill = {

                            type: 'pattern',

                            pattern: 'solid',

                            fgColor: {
                                argb: 'FFF3EDF9'
                            }

                        };

                    }

                });


                [1, 8, 9, 10].forEach(column => {

                    row.getCell(column).alignment = {

                        horizontal: 'center',

                        vertical: 'middle',

                        wrapText: true

                    };

                });

            });


            /* PENGATURAN CETAK EXCEL */

            sheet.pageSetup = {

                paperSize: 9,

                orientation: 'landscape',

                fitToPage: true,

                fitToWidth: 1,

                fitToHeight: 0,

                margins: {

                    left: 0.25,

                    right: 0.25,

                    top: 0.5,

                    bottom: 0.5,

                    header: 0.2,

                    footer: 0.2

                }

            };


            sheet.autoFilter = {

                from: 'A12',

                to: 'J12'

            };


            /* DOWNLOAD EXCEL */

            const buffer = await workbook.xlsx.writeBuffer();

            const blob = new Blob(

                [buffer],

                {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                }

            );

            const url = URL.createObjectURL(blob);

            const link = document.createElement('a');

            link.href = url;

            link.download = namaFile() + '.xlsx';

            document.body.appendChild(link);

            link.click();

            document.body.removeChild(link);

            setTimeout(() => {

                URL.revokeObjectURL(url);

            }, 1000);


        } catch (error) {

            alert('Gagal membuat Excel: ' + error.message);

            console.error(error);

        }

    }


    /* =========================================
       EXPORT WORD
    ========================================= */

    async function unduhWord() {

        try {

            const data = ambilDataTabel();

            const logoBase64 = await ambilLogoBase64();

            const header = data[0];


            /* MEMBUAT BARIS TABEL */

            const barisData = data.slice(1).map(row => {

                if (row.length === 1) {

                    return `
                        <tr>
                            <td colspan="10" style="text-align:center;">
                                ${escapeHtml(row[0])}
                            </td>
                        </tr>
                    `;

                }

                return `
                    <tr>
                        ${row.map(value => `
                            <td>${escapeHtml(value)}</td>
                        `).join('')}
                    </tr>
                `;

            }).join('');


            /* TEMPLATE DOKUMEN WORD */

            const dokumen = `

            <!DOCTYPE html>

            <html>

            <head>

                <meta charset="UTF-8">

                <title>Laporan Kunjungan Tamu</title>

                <style>

                    @page {

                        size: A4 landscape;

                        margin: 1.2cm;

                    }

                    body {

                        font-family: "Times New Roman", serif;

                        font-size: 10pt;

                        color: #000;

                        margin: 0;

                    }


                    /* KOP INSTANSI */

                    .kop {

                        width: 100%;

                        border-collapse: collapse;

                        border-bottom: 2px solid #000;

                        margin-bottom: 12px;

                    }

                    .kop td {

                        border: none;

                        vertical-align: middle;

                        padding: 5px;

                    }

                    .kolom-logo {

                        width: 90px;

                        text-align: center;

                    }

                    .logo {

                        width: 65px;

                        height: 65px;

                    }

                    .identitas {

                        text-align: center;

                    }

                    .identitas h2 {

                        font-size: 12pt;

                        font-weight: bold;

                        margin: 3px 0;

                        line-height: 1.2;

                    }


                    /* JUDUL LAPORAN */

                    .judul {

                        text-align: center;

                        margin: 12px 0;

                    }

                    .judul h2 {

                        font-size: 13pt;

                        font-weight: bold;

                        margin: 0 0 5px;

                    }

                    .judul p {

                        font-size: 10pt;

                        margin: 0;

                    }


                    /* SUBJUDUL */

                    h3 {

                        font-size: 10pt;

                        margin: 12px 0 6px;

                    }


                    /* RINGKASAN */

                    .ringkasan {

                        width: 100%;

                        border-collapse: collapse;

                        margin-bottom: 15px;

                        table-layout: fixed;

                    }

                    .ringkasan th,
                    .ringkasan td {

                        border: 1px solid #777;

                        text-align: center;

                        padding: 7px;

                        font-size: 9pt;

                    }

                    .ringkasan th {

                        background: #8955ED;

                        color: #fff;

                        font-weight: bold;

                    }


                    /* TABEL DATA */

                    table.data {

                        width: 100%;

                        border-collapse: collapse;

                        table-layout: fixed;

                        margin-top: 8px;

                    }

                    table.data th,
                    table.data td {

                        border: 1px solid #777;

                        padding: 5px 3px;

                        font-size: 8pt;

                        line-height: 1.2;

                        vertical-align: middle;

                        overflow-wrap: break-word;

                        word-wrap: break-word;

                    }

                    table.data th {

                        background: #35103F;

                        color: #fff;

                        text-align: center;

                        font-weight: bold;

                    }

                    table.data td {

                        text-align: left;

                    }

                    table.data tr {

                        page-break-inside: avoid;

                    }

                    table.data thead {

                        display: table-header-group;

                    }


                    /* TANGGAL CETAK */

                    .tanggal-cetak {

                        text-align: right;

                        margin-top: 15px;

                        font-size: 9pt;

                    }

                </style>

            </head>


            <body>


                <!-- KOP INSTANSI -->

                <table class="kop">

                    <tr>

                        <td class="kolom-logo">

                            <img
                                class="logo"
                                src="${logoBase64}"
                                width="65"
                                height="65"
                            >

                        </td>


                        <td class="identitas">

                            <h2>PEMERINTAH KABUPATEN CIREBON</h2>

                            <h2>DINAS KEARSIPAN DAN PERPUSTAKAAN</h2>

                            <h2>KABUPATEN CIREBON</h2>

                        </td>


                        <td style="width:90px;"></td>

                    </tr>

                </table>


                <!-- JUDUL LAPORAN -->

                <div class="judul">

                    <h2>LAPORAN KUNJUNGAN TAMU</h2>

                    <p>

                        <b>
                            PERIODE: ${escapeHtml(namaPeriode().toUpperCase())}
                        </b>

                    </p>

                </div>


                <!-- RINGKASAN LAPORAN -->

                <h3>RINGKASAN LAPORAN</h3>

                <table class="ringkasan">

                    <tr>

                        <th>TOTAL KUNJUNGAN</th>

                        <th>DITERIMA</th>

                        <th>DITOLAK</th>

                        <th>MENUNGGU KONFIRMASI</th>

                    </tr>


                    <tr>

                        <td>${totalKunjungan}</td>

                        <td>${diterima}</td>

                        <td>${ditolak}</td>

                        <td>${menunggu}</td>

                    </tr>

                </table>


                <!-- DATA KUNJUNGAN -->

                <h3>DATA KUNJUNGAN</h3>

                <table class="data">

                    <colgroup>

                        <col style="width:4%">

                        <col style="width:12%">

                        <col style="width:11%">

                        <col style="width:9%">

                        <col style="width:10%">

                        <col style="width:11%">

                        <col style="width:13%">

                        <col style="width:9%">

                        <col style="width:9%">

                        <col style="width:12%">

                    </colgroup>


                    <thead>

                        <tr>

                            ${header.map(value => `

                                <th>
                                    ${escapeHtml(value.toUpperCase())}
                                </th>

                            `).join('')}

                        </tr>

                    </thead>


                    <tbody>

                        ${barisData}

                    </tbody>

                </table>


                <!-- TANGGAL CETAK -->

                <p class="tanggal-cetak">

                    Dicetak pada:
                    ${new Date().toLocaleDateString('id-ID')}

                </p>


            </body>

            </html>

            `;


            /* MEMBUAT FILE WORD */

            const blob = new Blob(

                ['\ufeff', dokumen],

                {
                    type: 'application/msword'
                }

            );


            const url = URL.createObjectURL(blob);

            const link = document.createElement('a');

            link.href = url;

            link.download = namaFile() + '.doc';

            document.body.appendChild(link);

            link.click();

            document.body.removeChild(link);


            setTimeout(() => {

                URL.revokeObjectURL(url);

            }, 1000);


        } catch (error) {

            alert('Gagal membuat Word: ' + error.message);

            console.error(error);

        }

    }

</script>

@endsection