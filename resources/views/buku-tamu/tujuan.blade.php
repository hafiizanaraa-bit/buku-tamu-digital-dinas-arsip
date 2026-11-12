<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tujuan Kunjungan - Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            --maroon: #781f2b;
            --dark: #4f101d;
            --cream: #fffaf5;
            --text: #332a29;
            --muted: #827772;
            --border: #e8ddd6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background:
                radial-gradient(circle at top left, #eadbd2, transparent 35%),
                #f4eee8;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
        }

        .container {
            width: 100%;
            max-width: 760px;
            background: var(--cream);
            border: 1px solid var(--border);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(65, 30, 30, .13);
        }

        .top-line {
            height: 7px;
            background: linear-gradient(90deg, var(--dark), #c69b55, var(--maroon));
        }

        .header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 23px 28px;
            border-bottom: 1px solid #eee4dd;
        }

        .back-button {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f5e9e7;
            color: var(--maroon);
            text-decoration: none;
            font-size: 25px;
            font-weight: 700;
        }

        .header h1 {
            font-size: 20px;
            color: var(--dark);
            font-weight: 800;
        }

        .content {
            padding: 35px 40px 40px;
        }

        .step-label {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 30px;
            background: #f5e9e7;
            color: var(--maroon);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .title {
            font-family: 'Playfair Display', serif;
            color: var(--maroon);
            font-size: 34px;
            margin-bottom: 10px;
        }

        .description {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 27px;
        }

        .form-group label {
            display: block;
            margin-bottom: 11px;
            color: #3f3433;
            font-size: 14px;
            font-weight: 800;
        }

        .required {
            color: #c13a48;
        }

        select,
        .search-input,
        .lainnya-input {
            width: 100%;
            min-height: 52px;
            padding: 13px 15px;
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
        }

        select:focus,
        .search-input:focus,
        .lainnya-input:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(120, 31, 43, .08);
        }

        /* KOLOM KETERANGAN "LAINNYA" */
        .lainnya-group {
            margin-top: -10px;
            padding: 16px;
            background: #f8efe9;
            border: 1px dashed #d9c3b8;
            border-radius: 13px;
        }

        .lainnya-group label {
            margin-bottom: 9px;
        }

        .lainnya-input.is-invalid {
            border-color: #c13a48;
            box-shadow: 0 0 0 3px rgba(193, 58, 72, .10);
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

        .search-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .search-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 19px;
        }

        .search-input {
            padding-left: 43px;
        }

        .employee-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            max-height: 350px;
            overflow-y: auto;
            padding-right: 4px;
        }

        .employee-card {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px;
            border: 1px solid transparent;
            border-radius: 13px;
            background: white;
            cursor: pointer;
            transition: .2s;
        }

        .employee-card:hover {
            background: #fff7f4;
            border-color: #e7c8c9;
        }

        .employee-card.selected {
            background: #f8e9e9;
            border-color: var(--maroon);
        }

        .employee-card input {
            accent-color: var(--maroon);
            width: 17px;
            height: 17px;
            cursor: pointer;
        }

        .avatar {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: #f3e5e3;
            font-size: 22px;
        }

        .employee-info {
            flex: 1;
            min-width: 0;
        }

        .employee-info h3 {
            color: #3f3433;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .employee-info p {
            color: var(--muted);
            font-size: 12px;
        }

        .empty-message {
            display: none;
            text-align: center;
            padding: 25px 10px;
            color: var(--muted);
            font-size: 13px;
        }

        .selected-info {
            display: none;
            margin-top: 13px;
            padding: 12px 15px;
            background: #f5eee7;
            color: var(--dark);
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.6;
        }

        .alert-error {
            background: #fbe9e9;
            color: #9b2535;
            padding: 13px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
            line-height: 1.6;
        }

        .navigation {
            display: flex;
            gap: 13px;
            margin-top: 30px;
        }

        .btn {
            min-height: 53px;
            padding: 14px 22px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: .25s;
        }

        .btn-back {
            background: #f0e9e4;
            color: var(--dark);
        }

        .btn-check {
            flex: 1;
            border: none;
            background: linear-gradient(135deg, var(--maroon), var(--dark));
            color: white;
            box-shadow: 0 7px 18px rgba(120, 31, 43, .18);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 22px rgba(80, 20, 30, .15);
        }

        .footer {
            padding: 18px;
            text-align: center;
            background: #f5eee7;
            color: #897a75;
            font-size: 11px;
            line-height: 1.8;
        }

        @media (min-width: 900px) {
            .container {
                max-width: 850px;
            }

            .content {
                padding: 45px 65px 50px;
            }

            .employee-info h3 {
                font-size: 14px;
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
                border-radius: 19px;
            }

            .header {
                padding: 18px;
            }

            .header h1 {
                font-size: 17px;
            }

            .back-button {
                width: 36px;
                height: 36px;
                font-size: 22px;
            }

            .content {
                padding: 25px 18px 30px;
            }

            .title {
                font-size: 28px;
            }

            .description {
                font-size: 13px;
            }

            .form-group label {
                font-size: 13px;
            }

            select,
            .search-input,
            .lainnya-input {
                min-height: 49px;
                font-size: 13px;
            }

            .lainnya-group {
                padding: 13px;
            }

            .employee-card {
                padding: 11px 9px;
                gap: 10px;
            }

            .avatar {
                width: 39px;
                height: 39px;
                font-size: 20px;
            }

            .employee-info h3 {
                font-size: 12px;
            }

            .employee-info p {
                font-size: 11px;
            }

            .navigation {
                flex-direction: column-reverse;
            }

            .btn {
                width: 100%;
                min-height: 50px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top-line"></div>

    <header class="header">
        <a href="{{ route('buku-tamu.formulir') }}" class="back-button">←</a>
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

        <span class="step-label">TAHAP 05 • TUJUAN KUNJUNGAN</span>

        <h2 class="title">Keperluan Anda</h2>

        <p class="description">
            Silakan pilih tujuan kunjungan dan pegawai yang ingin
            Anda temui di Dinas Arsip dan Perpustakaan.
        </p>

        @php
            /*
            |--------------------------------------------------------------
            | PENGISIAN ULANG PILIHAN "LAINNYA"
            |--------------------------------------------------------------
            | Jika tujuan yang tersimpan berbentuk "Lainnya: keterangan",
            | pilihan "Lainnya" dipilih kembali dan keterangannya diisi ulang.
            */
            $tujuanLama   = (string) old('tujuan', '');
            $pakaiLainnya = \Illuminate\Support\Str::startsWith($tujuanLama, 'Lainnya');
            $teksLainnya  = $pakaiLainnya
                ? trim(ltrim(substr($tujuanLama, strlen('Lainnya')), ':- '))
                : '';
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

                <select name="tujuan" id="tujuan" required>

                    <option value="">Pilih tujuan kunjungan</option>

                    <option value="Konsultasi"
                        {{ old('tujuan') == 'Konsultasi' ? 'selected' : '' }}>
                        Konsultasi
                    </option>

                    <option value="Permohonan Informasi"
                        {{ old('tujuan') == 'Permohonan Informasi' ? 'selected' : '' }}>
                        Permohonan Informasi
                    </option>

                    <option value="Penelitian"
                        {{ old('tujuan') == 'Penelitian' ? 'selected' : '' }}>
                        Penelitian
                    </option>

                    <option value="Pengambilan Dokumen"
                        {{ old('tujuan') == 'Pengambilan Dokumen' ? 'selected' : '' }}>
                        Pengambilan Dokumen
                    </option>

                    <option value="Koordinasi"
                        {{ old('tujuan') == 'Koordinasi' ? 'selected' : '' }}>
                        Koordinasi
                    </option>

                    <option value="Keperluan Perpustakaan"
                        {{ old('tujuan') == 'Keperluan Perpustakaan' ? 'selected' : '' }}>
                        Keperluan Perpustakaan
                    </option>

                    <option value="Lainnya"
                        {{ $pakaiLainnya ? 'selected' : '' }}>
                        Lainnya
                    </option>

                </select>

            </div>


            {{-- KETERANGAN JIKA MEMILIH "LAINNYA" --}}
            <div
                class="form-group lainnya-group"
                id="lainnyaGroup"
                style="{{ $pakaiLainnya ? '' : 'display:none;' }}"
            >

                <label for="tujuanLainnya">
                    Sebutkan Keperluan Anda
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="tujuanLainnya"
                    class="lainnya-input"
                    maxlength="150"
                    autocomplete="off"
                    placeholder="Contoh: Penelitian skripsi, melihat koleksi arsip"
                    value="{{ $teksLainnya }}"
                >

                <p class="field-hint">
                    Tuliskan keperluan Anda dengan singkat dan jelas
                    (maksimal 150 karakter).
                </p>

                <p class="field-error" id="lainnyaError">
                    Mohon isi keperluan Anda terlebih dahulu.
                </p>

            </div>


            {{-- PILIH PEGAWAI --}}
            <div class="form-group">

                <label>
                    Pilih Pegawai yang Ingin Ditemui
                    <span class="required">*</span>
                </label>

                {{-- PENCARIAN PEGAWAI --}}
                <div class="search-wrapper">

                    <span class="search-icon">⌕</span>

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
                    Cek Ketersediaan →
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
    // KETERANGAN JIKA MEMILIH "LAINNYA"
    // ==========================================

    const tujuanForm = document.getElementById('tujuanForm');

    const tujuanSelect = document.getElementById('tujuan');

    const lainnyaGroup = document.getElementById('lainnyaGroup');

    const lainnyaInput = document.getElementById('tujuanLainnya');

    const lainnyaError = document.getElementById('lainnyaError');


    // Opsi "Lainnya" di dalam daftar pilihan
    const opsiLainnya = Array.from(tujuanSelect.options).find(function (opsi) {
        return opsi.textContent.trim() === 'Lainnya';
    });


    function sembunyikanErrorLainnya() {
        lainnyaInput.classList.remove('is-invalid');
        lainnyaError.style.display = 'none';
    }


    // Menampilkan atau menyembunyikan kolom keterangan
    function aturKolomLainnya() {

        const memilihLainnya = tujuanSelect.value.indexOf('Lainnya') === 0;

        lainnyaGroup.style.display = memilihLainnya ? 'block' : 'none';

        if (memilihLainnya) {
            lainnyaInput.focus();
        } else {
            sembunyikanErrorLainnya();
        }

    }


    tujuanSelect.addEventListener('change', function () {

        // Kembalikan nilai opsi "Lainnya" seperti semula
        if (opsiLainnya && tujuanSelect.value.indexOf('Lainnya') !== 0) {
            opsiLainnya.value = 'Lainnya';
        }

        aturKolomLainnya();

    });


    lainnyaInput.addEventListener('input', sembunyikanErrorLainnya);


    // Saat formulir dikirim: gabungkan "Lainnya" dengan keterangan
    // sehingga yang tersimpan sebagai tujuan adalah "Lainnya: keterangan".
    tujuanForm.addEventListener('submit', function (event) {

        if (tujuanSelect.value.indexOf('Lainnya') !== 0) {
            return;
        }

        const keterangan = lainnyaInput.value.replace(/\s+/g, ' ').trim();

        if (keterangan === '') {

            event.preventDefault();

            lainnyaGroup.style.display = 'block';
            lainnyaInput.classList.add('is-invalid');
            lainnyaError.style.display = 'block';
            lainnyaInput.focus();

            return;

        }

        opsiLainnya.value = 'Lainnya: ' + keterangan;

    });


    // Tampilkan kolom keterangan jika "Lainnya" sudah terpilih sejak awal
    if (tujuanSelect.value.indexOf('Lainnya') === 0) {
        lainnyaGroup.style.display = 'block';
    }

</script>

</body>
</html>