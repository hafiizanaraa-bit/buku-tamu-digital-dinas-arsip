<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Janji Temu</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f1ed;
            color: #29232a;
            padding: 20px;
        }

        .container {
            max-width: 520px;
            margin: 20px auto;
            background: #fff;
            border: 2px solid #5b172c;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 5px 18px rgba(0,0,0,.08);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 20px;
        }

        .back {
            color: #5b172c;
            text-decoration: none;
            font-size: 25px;
            font-weight: bold;
        }

        h2 {
            font-size: 19px;
            color: #29232a;
        }

        .info {
            background: #edf3fb;
            color: #405b80;
            padding: 14px;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 22px;
        }

        .pegawai {
            font-size: 12px;
            color: #666;
            margin-bottom: 18px;
        }

        .pegawai strong {
            color: #5b172c;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin: 17px 0 9px;
        }

        input[type="date"],
        textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #ddd;
            border-radius: 9px;
            font-family: inherit;
            font-size: 13px;
            background: white;
        }

        .waktu {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .waktu input {
            display: none;
        }

        .waktu label {
            margin: 0;
            padding: 12px 5px;
            border: 1px solid #ddd;
            border-radius: 9px;
            text-align: center;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: .2s;
        }

        .waktu input:checked + label {
            background: #741d39;
            border-color: #741d39;
            color: white;
        }

        textarea {
            resize: vertical;
            min-height: 85px;
        }

        .tombol {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: #741d39;
            color: white;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .tombol:hover {
            background: #531329;
        }

        .error {
            color: #c62828;
            font-size: 12px;
            margin-top: 6px;
        }

        .success {
            background: #e7f5e9;
            color: #246b34;
            padding: 12px;
            border-radius: 9px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                margin: 8px auto;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <a href="{{ route('buku-tamu.hasil-pencarian') }}" class="back">‹</a>
        <h2>Ajukan Janji Temu</h2>
    </div>

    <div class="info">
        ℹ️ Mohon pilih tanggal dan waktu sesuai dengan
        ketersediaan pegawai.
    </div>

    @if(isset($pegawai) && $pegawai)
        <div class="pegawai">
            Pegawai yang dipilih:
            <strong>{{ $pegawai->nama_lengkap }}</strong>
        </div>
    @endif

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            Mohon periksa kembali tanggal dan waktu yang dipilih.
        </div>
    @endif

    <form action="{{ route('buku-tamu.simpan-janji') }}" method="POST">
        @csrf

        <label for="tanggal">Pilih Tanggal <span style="color:red">*</span></label>

        <input
            type="date"
            id="tanggal"
            name="tanggal"
            min="{{ date('Y-m-d') }}"
            value="{{ old('tanggal') }}"
            required
        >

        @error('tanggal')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Pilih Waktu <span style="color:red">*</span></label>

        <div class="waktu">
            <div>
                <input type="radio" id="jam1" name="waktu"
                    value="08:00 - 09:00" {{ old('waktu') == '08:00 - 09:00' ? 'checked' : '' }} required>
                <label for="jam1">08:00 - 09:00</label>
            </div>

            <div>
                <input type="radio" id="jam2" name="waktu"
                    value="09:00 - 10:00" {{ old('waktu') == '09:00 - 10:00' ? 'checked' : '' }}>
                <label for="jam2">09:00 - 10:00</label>
            </div>

            <div>
                <input type="radio" id="jam3" name="waktu"
                    value="10:00 - 11:00" {{ old('waktu') == '10:00 - 11:00' ? 'checked' : '' }}>
                <label for="jam3">10:00 - 11:00</label>
            </div>

            <div>
                <input type="radio" id="jam4" name="waktu"
                    value="11:00 - 12:00" {{ old('waktu') == '11:00 - 12:00' ? 'checked' : '' }}>
                <label for="jam4">11:00 - 12:00</label>
            </div>
        </div>

        @error('waktu')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="catatan">Catatan (opsional)</label>

        <textarea
            id="catatan"
            name="catatan"
            placeholder="Tuliskan keperluan tambahan..."
        >{{ old('catatan') }}</textarea>

        <button type="submit" class="tombol">
            Kirim Permohonan
        </button>

    </form>

</div>

</body>
</html>