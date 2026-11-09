<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identitas Tamu - Buku Tamu Digital</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
            background: radial-gradient(circle at top left, #eadbd2, transparent 35%), #f4eee8;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
        }

        .container {
            width: 100%;
            max-width: 720px;
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
            gap: 16px;
            padding: 25px 30px;
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
            font-size: 21px;
            color: var(--dark);
            font-weight: 800;
        }

        .header p {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px;
        }

        .content {
            padding: 35px 55px 40px;
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
            margin-bottom: 23px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            color: #3f3433;
            font-size: 14px;
            font-weight: 700;
        }

        .required {
            color: #c13a48;
        }

        .optional {
            color: #918580;
            font-size: 12px;
            font-weight: 500;
        }

        .input-wrapper input,
        .input-wrapper textarea {
            width: 100%;
            padding: 15px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            background: white;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            transition: .2s;
        }

        .input-wrapper input {
            min-height: 51px;
        }

        .input-wrapper textarea {
            min-height: 105px;
            resize: vertical;
        }

        .input-wrapper input:focus,
        .input-wrapper textarea:focus {
            border-color: var(--maroon);
            box-shadow: 0 0 0 3px rgba(120, 31, 43, .08);
        }

        .helper {
            margin-top: 7px;
            color: #968a84;
            font-size: 11px;
        }

        .error {
            color: #c13a48;
            font-size: 12px;
            margin-top: 6px;
        }

        .navigation {
            display: flex;
            gap: 13px;
            margin-top: 32px;
        }

        .btn {
            min-height: 52px;
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

        .btn-next {
            flex: 1;
            border: none;
            background: linear-gradient(135deg, var(--maroon), var(--dark));
            color: white;
            box-shadow: 0 7px 18px rgba(120, 31, 43, .18);
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .footer {
            padding: 19px;
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
                padding: 45px 85px 50px;
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
                padding: 18px 17px;
                gap: 12px;
            }

            .back-button {
                width: 36px;
                height: 36px;
                font-size: 22px;
            }

            .header h1 {
                font-size: 17px;
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

            .input-wrapper input,
            .input-wrapper textarea {
                font-size: 13px;
            }

            .btn {
                min-height: 49px;
                font-size: 13px;
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="top-line"></div>

    <header class="header">
        <a href="{{ route('buku-tamu.survei') }}" class="back-button">←</a>

        <div>
            <h1>Identitas Tamu</h1>
            <p>Formulir pengisian data pengunjung</p>
        </div>
    </header>

    <main class="content">

        <span class="step-label">TAHAP 04 • IDENTITAS PENGUNJUNG</span>

        <h2 class="title">Data Diri Anda</h2>

        <p class="description">
            Silakan lengkapi identitas diri Anda dengan benar
            untuk keperluan administrasi kunjungan.
        </p>

        @if ($errors->any())
            <div class="error" style="margin-bottom:20px;">
                <strong>Periksa kembali data yang dimasukkan:</strong>
                <ul style="padding-left:20px; margin-top:8px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku-tamu.identitas.simpan') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">
                    Nama Lengkap <span class="required">*</span>
                </label>

                <div class="input-wrapper">
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap"
                        autocomplete="name"
                        required
                    >
                </div>

                @error('nama')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="telepon">
                    Nomor Telepon <span class="required">*</span>
                </label>

                <div class="input-wrapper">
                    <input
                        type="tel"
                        id="telepon"
                        name="telepon"
                        value="{{ old('telepon') }}"
                        placeholder="Contoh: 08123456789"
                        autocomplete="tel"
                        pattern="[0-9+() -]{8,20}"
                        required
                    >
                </div>

                <p class="helper">
                    Masukkan nomor telepon yang dapat dihubungi.
                </p>

                @error('telepon')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">
                    Alamat <span class="required">*</span>
                </label>

                <div class="input-wrapper">
                    <textarea
                        id="alamat"
                        name="alamat"
                        placeholder="Masukkan alamat lengkap"
                        autocomplete="street-address"
                        required
                    >{{ old('alamat') }}</textarea>
                </div>

                @error('alamat')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="instansi">
                    Instansi / Lembaga
                    <span class="optional">(Opsional)</span>
                </label>

                <div class="input-wrapper">
                    <input
                        type="text"
                        id="instansi"
                        name="instansi"
                        value="{{ old('instansi') }}"
                        placeholder="Contoh: Mahasiswa, Instansi, dll."
                    >
                </div>

                @error('instansi')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="navigation">

                <a href="{{ route('buku-tamu.survei') }}" class="btn btn-back">
                    Kembali
                </a>

                <button type="submit" class="btn btn-next">
                    Lanjutkan →
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

</body>
</html>