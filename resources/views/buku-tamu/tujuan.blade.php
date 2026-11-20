<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tujuan Kunjungan | Buku Tamu Digital</title>

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
            --danger: #c13a48;
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
            max-width: 780px;
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

        .back-button {
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

        .back-button:hover {
            transform: translateX(-3px);
        }

        .back-button:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
        }

        .icon {
            width: 22px;
            height: 22px;
            display: block;
            fill: none;
            stroke: currentColor;
            stroke-width: 2.6;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .header h1 {
            color: var(--navy);
            font-size: 21px;
            font-weight: 800;
            line-height: 1.2;
        }

        /* ISI */
        .content {
            padding: 38px 48px 42px;
        }

        .step-label {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            color: var(--gold-dark);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .step-label::before {
            content: "";
            width: 34px;
            height: 2px;
            background: var(--gold);
            border-radius: 2px;
        }

        .title {
            margin-bottom: 12px;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 44px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .description {
            margin-bottom: 30px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.8;
        }

        .alert-error {
            margin-bottom: 22px;
            padding: 14px 18px;
            color: #9b2535;
            font-size: 13px;
            line-height: 1.6;
            background: #fbe9e9;
            border: 1px solid #f1c6c9;
            border-radius: 14px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 28px;
        }

        .form-group label {
            display: block;
            margin-bottom: 11px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 700;
        }

        .required {
            color: var(--danger);
        }

        select,
        .search-input,
        .detail-input {
            width: 100%;
            min-height: 54px;
            padding: 13px 18px;
            border: 1px solid rgba(18, 41, 74, .15);
            border-radius: 14px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: .2s;
        }

        select:focus,
        .search-input:focus,
        .detail-input:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 4px rgba(201, 162, 77, .22);
        }

        .search-input::placeholder,
        .detail-input::placeholder {
            color: #a3adbb;
        }

        /* KOLOM RINCIAN TUJUAN */
        .detail-group {
            margin-top: -10px;
            padding: 18px;
            background: rgba(201, 162, 77, .10);
            border: 1px dashed var(--gold);
            border-radius: 16px;
        }

        .detail-group label {
            margin-bottom: 9px;
        }

        .detail-input.is-invalid {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(193, 58, 72, .12);
        }

        .field-hint {
            margin-top: 8px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        .field-error {
            display: none;
            margin-top: 8px;
            color: #9b2535;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.6;
        }

        /* KETERANGAN TUJUAN */
        .tujuan-desc {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-top: 12px;
            padding: 13px 16px;
            background: rgba(18, 41, 74, .05);
            border-left: 3px solid var(--gold);
            border-radius: 12px;
        }

        .tujuan-desc-icon {
            width: 22px;
            height: 22px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--navy-dark);
            font-family: 'Playfair Display', serif;
            font-size: 13px;
            font-weight: 800;
            font-style: italic;
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
        }

        .tujuan-desc p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        /* PENCARIAN PEGAWAI */
        .search-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .search-icon {
            position: absolute;
            left: 17px;
            top: 50%;
            width: 18px;
            height: 18px;
            transform: translateY(-50%);
            fill: none;
            stroke: var(--gold-dark);
            stroke-width: 2.4;
            stroke-linecap: round;
            stroke-linejoin: round;
            pointer-events: none;
        }

        .search-input {
            padding-left: 46px;
        }

        /* DAFTAR PEGAWAI */
        .employee-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
            max-height: 350px;
            overflow-y: auto;
            padding: 2px 4px 2px 2px;
        }

        .employee-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: white;
            cursor: pointer;
            transition: .2s;
        }

        .employee-card:hover {
            background: rgba(201, 162, 77, .08);
            border-color: var(--gold);
        }

        .employee-card.selected {
            background: rgba(201, 162, 77, .15);
            border-color: var(--navy);
            box-shadow: 0 0 0 1px var(--navy);
        }

        .employee-card input {
            accent-color: var(--navy);
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .avatar {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: rgba(18, 41, 74, .07);
            font-size: 22px;
        }

        .employee-info {
            flex: 1;
            min-width: 0;
        }

        .employee-info h3 {
            margin-bottom: 4px;
            color: var(--navy);
            font-size: 14px;
            font-weight: 800;
        }

        .employee-info p {
            color: var(--muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .empty-message {
            display: none;
            padding: 25px 10px;
            text-align: center;
            color: var(--muted);
            font-size: 13px;
        }

        .selected-info {
            display: none;
            margin-top: 14px;
            padding: 13px 16px;
            color: var(--navy);
            font-size: 13px;
            line-height: 1.6;
            background: rgba(18, 41, 74, .06);
            border-left: 3px solid var(--gold);
            border-radius: 10px;
        }

        /* TOMBOL */
        .navigation {
            display: flex;
            gap: 14px;
            margin-top: 32px;
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

        .btn-back {
            padding: 0 30px;
            color: var(--navy);
            background: white;
            border: 1.5px solid var(--navy);
        }

        .btn-back:hover {
            color: white;
            background: var(--navy);
        }

        /* tombol utama: gaya sama dengan slider di halaman awal */
        .btn-check {
            flex: 1;
            padding: 0 7px 0 28px;
            border: none;
            color: white;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow:
                0 14px 30px rgba(18, 41, 74, .30),
                inset 0 0 0 1px rgba(255, 255, 255, .06);
        }

        .btn-check .btn-icon {
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

        .btn-check .btn-icon .icon {
            width: 20px;
            height: 20px;
        }

        .btn-check:focus-visible,
        .btn-back:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold);
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
                max-width: 860px;
            }

            .content {
                padding: 46px 70px 50px;
            }

            .employee-info h3 {
                font-size: 15px;
            }

            .employee-info p {
                font-size: 13px;
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

            .back-button {
                width: 40px;
                height: 40px;
            }

            .header h1 {
                font-size: 17px;
            }

            .content {
                padding: 26px 18px 30px;
            }

            .step-label {
                font-size: 9px;
                letter-spacing: 2px;
            }

            .description {
                font-size: 13px;
            }

            .form-group label {
                font-size: 13px;
            }

            select,
            .search-input,
            .detail-input {
                min-height: 50px;
                font-size: 13px;
            }

            .detail-group {
                padding: 14px;
            }

            .employee-card {
                padding: 11px 10px;
                gap: 10px;
            }

            .avatar {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }

            .employee-info h3 {
                font-size: 13px;
            }

            .employee-info p {
                font-size: 11px;
            }

            .navigation {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                min-height: 52px;
                font-size: 14px;
            }

            .btn-check {
                padding-left: 22px;
            }

            .btn-check .btn-icon {
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
        <a href="{{ route('buku-tamu.formulir') }}" class="back-button" aria-label="Kembali">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 12H5M11 6l-6 6 6 6"/>
            </svg>
        </a>
        <h1>Tujuan Kunjungan</h1>
    </header>

    <main class="content">

        {{-- PESAN ERROR --}}
        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                Mohon periksa kembali pilihan tujuan kunjungan dan pegawai.
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <span class="step-label">Tahap 05 · Tujuan Kunjungan</span>

        <h2 class="title">Keperluan Anda</h2>

        <p class="description">
            Silakan pilih tujuan kunjungan dan pegawai yang ingin
            Anda temui di Dinas Arsip dan Perpustakaan.
        </p>

        @php
            /*
            |--------------------------------------------------------------
            | DAFTAR TUJUAN KUNJUNGAN
            |--------------------------------------------------------------
            | desc        : penjelasan yang tampil di bawah pilihan tujuan
            | label       : pertanyaan rincian yang harus dijawab pengunjung
            | placeholder : contoh jawaban
            | Tujuan disimpan dengan format "Tujuan: rincian",
            | misalnya "Konsultasi: pengelolaan arsip kantor desa".
            */
            $daftarTujuan = [
                'Konsultasi' => [
                    'desc'        => 'Berdiskusi dengan pegawai mengenai pengelolaan arsip, kepustakaan, atau layanan dinas.',
                    'label'       => 'Konsultasi tentang apa?',
                    'placeholder' => 'Contoh: pengelolaan arsip kantor desa, penataan perpustakaan sekolah',
                ],
                'Permohonan Informasi' => [
                    'desc'        => 'Meminta informasi, data, atau layanan publik yang tersedia di Dinas Arsip dan Perpustakaan.',
                    'label'       => 'Informasi apa yang Anda butuhkan?',
                    'placeholder' => 'Contoh: data koleksi arsip daerah, syarat keanggotaan perpustakaan',
                ],
                'Penelitian' => [
                    'desc'        => 'Melakukan penelitian, skripsi, atau tugas akhir dengan memanfaatkan arsip dan koleksi perpustakaan.',
                    'label'       => 'Topik atau judul penelitian Anda?',
                    'placeholder' => 'Contoh: skripsi tentang sejarah perdagangan di Cirebon',
                ],
                'Pengambilan Dokumen' => [
                    'desc'        => 'Mengambil dokumen yang sebelumnya sudah diajukan atau diproses oleh dinas.',
                    'label'       => 'Dokumen apa yang akan diambil?',
                    'placeholder' => 'Contoh: salinan arsip, surat rekomendasi penelitian',
                ],
                'Koordinasi' => [
                    'desc'        => 'Berkoordinasi dengan pegawai terkait pekerjaan, kegiatan, atau kerja sama antarinstansi.',
                    'label'       => 'Koordinasi mengenai apa?',
                    'placeholder' => 'Contoh: jadwal pembinaan arsip, kerja sama kegiatan literasi',
                ],
                'Keperluan Perpustakaan' => [
                    'desc'        => 'Keperluan yang berkaitan dengan layanan perpustakaan, seperti membaca, meminjam, atau mengembalikan buku.',
                    'label'       => 'Keperluan perpustakaan apa?',
                    'placeholder' => 'Contoh: mengembalikan buku, mendaftar anggota, membaca di tempat',
                ],
                'Lainnya' => [
                    'desc'        => 'Pilih ini jika keperluan Anda tidak termasuk dalam pilihan di atas.',
                    'label'       => 'Sebutkan keperluan Anda',
                    'placeholder' => 'Contoh: melihat koleksi arsip, kunjungan studi',
                ],
            ];

            // Pengisian ulang setelah validasi gagal ("Tujuan: rincian")
            $tujuanLama  = trim((string) old('tujuan', ''));
            $tujuanDasar = '';
            $tujuanRinci = '';

            foreach (array_keys($daftarTujuan) as $namaTujuan) {
                if (\Illuminate\Support\Str::startsWith($tujuanLama, $namaTujuan)) {
                    $tujuanDasar = $namaTujuan;
                    $tujuanRinci = trim(ltrim(substr($tujuanLama, strlen($namaTujuan)), ':- '));
                    break;
                }
            }
        @endphp

        {{-- FORM TUJUAN KUNJUNGAN --}}
        <form
            id="tujuanForm"
            action="{{ route('buku-tamu.cek-ketersediaan') }}"
            method="POST"
        >
            @csrf

            {{-- PILIH TUJUAN --}}
            <div class="form-group">

                <label for="tujuan">
                    Pilih Tujuan Kunjungan
                    <span class="required">*</span>
                </label>

                <select id="tujuan" required>

                    <option value="">Pilih tujuan kunjungan</option>

                    @foreach ($daftarTujuan as $namaTujuan => $dataTujuan)
                        <option
                            value="{{ $namaTujuan }}"
                            {{ $tujuanDasar === $namaTujuan ? 'selected' : '' }}
                        >
                            {{ $namaTujuan }}
                        </option>
                    @endforeach

                </select>

                {{-- KETERANGAN TUJUAN YANG DIPILIH --}}
                <div class="tujuan-desc" id="tujuanDesc">
                    <span class="tujuan-desc-icon">i</span>
                    <p id="tujuanDescText">
                        Pilih tujuan kunjungan untuk melihat penjelasannya.
                    </p>
                </div>

            </div>


            {{-- RINCIAN TUJUAN (muncul setelah tujuan dipilih) --}}
            <div
                class="form-group detail-group"
                id="detailGroup"
                style="{{ $tujuanDasar !== '' ? '' : 'display:none;' }}"
            >

                <label for="tujuanDetail">
                    <span id="detailLabelText">Jelaskan keperluan Anda</span>
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="tujuanDetail"
                    class="detail-input"
                    maxlength="150"
                    autocomplete="off"
                    placeholder="Jelaskan keperluan Anda"
                    value="{{ $tujuanRinci }}"
                >

                <p class="field-hint">
                    Tuliskan dengan singkat dan jelas (maksimal 150 karakter)
                    agar pegawai dapat menyiapkan layanan yang sesuai.
                </p>

                <p class="field-error" id="detailError">
                    Mohon isi rincian keperluan Anda terlebih dahulu.
                </p>

            </div>

            {{-- Nilai akhir yang dikirim ke server: "Tujuan: rincian" --}}
            <input type="hidden" name="tujuan" id="tujuanFinal" value="{{ old('tujuan') }}">


            {{-- PILIH PEGAWAI --}}
            <div class="form-group">

                <label>
                    Pilih Pegawai yang Ingin Ditemui
                    <span class="required">*</span>
                </label>

                {{-- PENCARIAN PEGAWAI --}}
                <div class="search-wrapper">

                    <svg class="search-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <circle cx="11" cy="11" r="7"/>
                        <path d="M20 20l-3.5-3.5"/>
                    </svg>

                    <input
                        type="search"
                        id="searchPegawai"
                        class="search-input"
                        placeholder="Cari nama pegawai..."
                        autocomplete="off"
                    >

                </div>


                {{-- DAFTAR PEGAWAI --}}
                <div class="employee-list" id="employeeList">

                    @forelse ($pegawais as $pegawai)

                        <label
                            class="employee-card {{ old('pegawai_id') == $pegawai->id ? 'selected' : '' }}"
                            data-name="{{ strtolower($pegawai->nama_lengkap) }}"
                            data-jabatan="{{ strtolower($pegawai->jabatan ?? '') }}"
                            data-bidang="{{ strtolower($pegawai->bidang ?? '') }}"
                        >

                            <input
                                type="radio"
                                name="pegawai_id"
                                value="{{ $pegawai->id }}"
                                {{ old('pegawai_id') == $pegawai->id ? 'checked' : '' }}
                                required
                            >

                            <div class="avatar">👤</div>

                            <div class="employee-info">

                                <h3>{{ $pegawai->nama_lengkap }}</h3>

                                <p>
                                    {{ $pegawai->jabatan ?? 'Jabatan belum diatur' }}
                                </p>

                                <p>
                                    {{ $pegawai->bidang ?? 'Bidang belum diatur' }}
                                </p>

                            </div>

                        </label>

                    @empty

                        <div class="empty-message" style="display:block;">
                            Belum ada data pegawai.
                            Silakan hubungi petugas.
                        </div>

                    @endforelse

                </div>


                {{-- PESAN JIKA PEGAWAI TIDAK DITEMUKAN --}}
                <div class="empty-message" id="noResult">
                    Pegawai yang dicari tidak ditemukan.
                </div>


                {{-- INFORMASI PEGAWAI TERPILIH --}}
                <div class="selected-info" id="selectedInfo">

                    Pegawai yang dipilih:
                    <strong id="selectedName"></strong>

                </div>

            </div>


            {{-- TOMBOL NAVIGASI --}}
            <div class="navigation">

                <a
                    href="{{ route('buku-tamu.formulir') }}"
                    class="btn btn-back"
                >
                    Kembali
                </a>

                <button type="submit" class="btn btn-check">
                    Cek Ketersediaan
                    <span class="btn-icon">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
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
        Terima kasih telah berkunjung.
    </footer>

</div>


<script>

    // ==========================================
    // FITUR PENCARIAN PEGAWAI
    // ==========================================

    const searchInput = document.getElementById('searchPegawai');

    const employeeCards = document.querySelectorAll('.employee-card');

    const noResult = document.getElementById('noResult');


    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();

        let visibleCount = 0;

        employeeCards.forEach(card => {

            const name = card.dataset.name || '';

            const jabatan = card.dataset.jabatan || '';

            const bidang = card.dataset.bidang || '';

            const cocok =
                name.includes(keyword) ||
                jabatan.includes(keyword) ||
                bidang.includes(keyword);

            card.style.display = cocok ? 'flex' : 'none';

            if (cocok) {
                visibleCount++;
            }

        });

        noResult.style.display =
            visibleCount === 0 ? 'block' : 'none';

    });


    // ==========================================
    // TAMPILAN PEGAWAI YANG DIPILIH
    // ==========================================

    const radios = document.querySelectorAll(
        'input[name="pegawai_id"]'
    );

    const selectedInfo = document.getElementById('selectedInfo');

    const selectedName = document.getElementById('selectedName');


    function tampilkanPegawaiTerpilih(radio) {

        document.querySelectorAll('.employee-card').forEach(card => {
            card.classList.remove('selected');
        });

        const card = radio.closest('.employee-card');

        card.classList.add('selected');

        selectedName.textContent =
            card.querySelector('h3').textContent;

        selectedInfo.style.display = 'block';

    }


    radios.forEach(radio => {

        radio.addEventListener('change', function () {

            tampilkanPegawaiTerpilih(this);

        });

    });


    // Menampilkan kembali pilihan setelah validasi gagal
    const radioTerpilih = document.querySelector(
        'input[name="pegawai_id"]:checked'
    );

    if (radioTerpilih) {
        tampilkanPegawaiTerpilih(radioTerpilih);
    }


    // ==========================================
    // KETERANGAN DAN RINCIAN TUJUAN KUNJUNGAN
    // ==========================================

    const DAFTAR_TUJUAN = @json($daftarTujuan);

    const tujuanForm = document.getElementById('tujuanForm');

    const tujuanSelect = document.getElementById('tujuan');

    const tujuanDescText = document.getElementById('tujuanDescText');

    const detailGroup = document.getElementById('detailGroup');

    const detailLabelText = document.getElementById('detailLabelText');

    const detailInput = document.getElementById('tujuanDetail');

    const detailError = document.getElementById('detailError');

    const tujuanFinal = document.getElementById('tujuanFinal');

    const teksAwal = 'Pilih tujuan kunjungan untuk melihat penjelasannya.';


    function sembunyikanErrorDetail() {
        detailInput.classList.remove('is-invalid');
        detailError.style.display = 'none';
    }


    // Menampilkan penjelasan dan kolom rincian sesuai tujuan
    function perbaruiTujuan(fokus) {

        const data = DAFTAR_TUJUAN[tujuanSelect.value];

        if (!data) {
            tujuanDescText.textContent = teksAwal;
            detailGroup.style.display = 'none';
            sembunyikanErrorDetail();
            return;
        }

        tujuanDescText.textContent = data.desc;
        detailLabelText.textContent = data.label;
        detailInput.placeholder = data.placeholder;
        detailGroup.style.display = 'block';

        if (fokus) {
            detailInput.focus();
        }

    }


    tujuanSelect.addEventListener('change', function () {

        sembunyikanErrorDetail();

        perbaruiTujuan(true);

    });


    detailInput.addEventListener('input', sembunyikanErrorDetail);


    // Saat formulir dikirim: gabungkan menjadi "Tujuan: rincian"
    tujuanForm.addEventListener('submit', function (event) {

        const nama = tujuanSelect.value;

        // Jika belum memilih tujuan, biarkan validasi bawaan browser bekerja
        if (nama === '') {
            return;
        }

        const rincian = detailInput.value.replace(/\s+/g, ' ').trim();

        if (rincian === '') {

            event.preventDefault();

            detailGroup.style.display = 'block';
            detailInput.classList.add('is-invalid');
            detailError.style.display = 'block';
            detailInput.focus();

            return;

        }

        tujuanFinal.value = nama + ': ' + rincian;

    });


    // Tampilkan penjelasan sejak awal jika tujuan sudah terpilih
    // (misalnya setelah validasi gagal atau tombol kembali ditekan)
    perbaruiTujuan(false);

</script>

</body>
</html>