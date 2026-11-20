<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran Pegawai | Buku Tamu Digital</title>

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

        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .decoration {
            position: fixed;
            border: 1px solid rgba(201, 162, 77, .45);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }
        .decoration.one { width: 340px; height: 340px; top: -140px; left: -110px; }
        .decoration.two { width: 440px; height: 440px; bottom: -170px; right: -110px; }

        .container {
            width: 100%;
            max-width: 820px;
            position: relative;
            z-index: 1;
            overflow: hidden;
            border-radius: 28px;
            background: var(--ivory);
            border: 1px solid var(--line);
            box-shadow: 0 30px 80px rgba(11, 27, 51, .20);
            animation: muncul .8s ease both;
        }

        .top-line { height: 8px; background: linear-gradient(90deg, var(--navy-dark), var(--gold), var(--navy-light)); }

        .icon {
            width: 22px; height: 22px; flex-shrink: 0; display: block;
            fill: none; stroke: currentColor; stroke-width: 2.6;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .header { display: flex; align-items: center; gap: 16px; padding: 24px 32px; border-bottom: 1px solid var(--line); }

        .back-button {
            width: 44px; height: 44px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 6px 16px rgba(0, 0, 0, .22);
            text-decoration: none; transition: transform .25s;
        }
        .back-button:hover { transform: translateX(-3px); }
        .back-button:focus-visible { outline: none; box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold); }

        .header h1 { color: var(--navy); font-size: 21px; font-weight: 800; line-height: 1.2; }

        .content { padding: 34px 48px 40px; }

        .step-label {
            display: inline-flex; align-items: center; gap: 12px; margin-bottom: 14px;
            color: var(--gold-dark); font-size: 11px; font-weight: 800;
            letter-spacing: 3px; text-transform: uppercase;
        }
        .step-label::before { content: ""; width: 34px; height: 2px; background: var(--gold); border-radius: 2px; }

        .title {
            margin-bottom: 10px; color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 4vw, 44px); font-weight: 800;
            line-height: 1.1; letter-spacing: -1px;
        }

        .description { margin-bottom: 24px; color: var(--muted); font-size: 15px; line-height: 1.8; }

        /* TAB HARI */
        .days { display: grid; grid-template-columns: repeat(5, 1fr); gap: 8px; margin-bottom: 14px; }

        .day {
            padding: 11px 4px; text-align: center; text-decoration: none;
            color: var(--navy); background: white;
            border: 1px solid rgba(18, 41, 74, .15); border-radius: 16px;
            transition: .2s;
        }
        .day strong { display: block; font-size: 13px; font-weight: 800; }
        .day small { display: block; margin-top: 2px; color: var(--muted); font-size: 11px; }
        .day:hover { border-color: var(--gold); background: rgba(201, 162, 77, .08); }
        .day.active {
            color: var(--gold-light);
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            border-color: var(--navy);
            box-shadow: 0 8px 18px rgba(18, 41, 74, .28);
        }
        .day.active small { color: var(--gold-light); opacity: .85; }
        .day.today:not(.active) { border-color: var(--gold); }

        .date-info {
            display: flex; flex-wrap: wrap; justify-content: space-between; gap: 6px 16px;
            margin-bottom: 18px; padding: 12px 16px;
            color: var(--navy-light); font-size: 13px;
            background: rgba(201, 162, 77, .12);
            border: 1px dashed var(--gold); border-radius: 14px;
        }

        /* RINGKASAN & FILTER */
        .filters { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 16px; }

        .filter {
            padding: 9px 16px; border-radius: 999px; cursor: pointer;
            color: var(--navy); font-family: inherit; font-size: 12px; font-weight: 700;
            background: white; border: 1.5px solid rgba(18, 41, 74, .2); transition: .2s;
        }
        .filter:hover { border-color: var(--navy); }
        .filter.active { color: white; background: var(--navy); border-color: var(--navy); }
        .filter:focus-visible { outline: none; box-shadow: 0 0 0 3px #fff, 0 0 0 5px var(--gold); }

        /* DAFTAR PEGAWAI */
        .list { display: flex; flex-direction: column; gap: 10px; max-height: 420px; overflow-y: auto; padding: 2px 4px 2px 2px; }

        .card {
            display: flex; align-items: center; gap: 14px; padding: 14px 16px;
            background: white; border: 1px solid var(--line); border-radius: 18px;
        }

        .avatar {
            width: 46px; height: 46px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; font-size: 22px;
            background: rgba(18, 41, 74, .07);
        }

        .info { flex: 1; min-width: 0; }
        .info h3 { margin-bottom: 3px; color: var(--navy); font-size: 14px; font-weight: 800; }
        .info p { color: var(--muted); font-size: 12px; line-height: 1.5; }

        .state { flex-shrink: 0; text-align: right; }
        .badge { display: inline-block; padding: 7px 13px; border-radius: 999px; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .time { margin-top: 6px; color: var(--muted); font-size: 11px; }

        .badge-ada    { color: #287343; background: #e2f4e7; }
        .badge-luar   { color: #956016; background: #fff0d7; }
        .badge-tidak  { color: #a43843; background: #fce6e8; }
        .badge-lain   { color: #5b6575; background: #eceff3; }
        .badge-belum  { color: #6b7280; background: #f1f3f5; }

        .empty { display: none; padding: 26px 10px; text-align: center; color: var(--muted); font-size: 13px; }

        .libur { padding: 30px 16px; text-align: center; color: var(--muted); font-size: 14px; line-height: 1.8;
                 background: white; border: 1px solid var(--line); border-radius: 18px; }

        /* TOMBOL */
        .navigation { display: flex; justify-content: space-between; gap: 14px; margin-top: 30px; }

        .btn {
            min-height: 56px; display: inline-flex; align-items: center; justify-content: center; gap: 12px;
            border-radius: 999px; text-decoration: none;
            font-family: inherit; font-size: 15px; font-weight: 700; letter-spacing: .3px;
            transition: transform .25s, box-shadow .25s;
        }
        .btn:hover { transform: translateY(-2px); }
        .btn:focus-visible { outline: none; box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold); }

        .btn-back { padding: 0 30px; color: var(--navy); background: white; border: 1.5px solid var(--navy); }
        .btn-back:hover { color: white; background: var(--navy); }

        .btn-next {
            flex: 1; max-width: 330px; padding: 0 7px 0 28px; color: white;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow: 0 14px 30px rgba(18, 41, 74, .30), inset 0 0 0 1px rgba(255, 255, 255, .06);
        }
        .btn-next .btn-icon {
            width: 42px; height: 42px; margin-left: auto;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 5px 12px rgba(0, 0, 0, .28);
        }
        .btn-next .btn-icon .icon { width: 20px; height: 20px; }

        .footer {
            padding: 20px; text-align: center; color: #7b8799;
            font-size: 12px; line-height: 1.8;
            background: #f3efe6; border-top: 1px solid var(--line);
        }

        @keyframes muncul { from { opacity: 0; transform: scale(.98); } to { opacity: 1; transform: scale(1); } }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }

        @media (max-width: 700px) {
            body { padding: 10px; align-items: flex-start; }
            .container { margin: 8px 0; border-radius: 22px; }
            .top-line { height: 6px; }
            .header { padding: 18px; gap: 12px; }
            .back-button { width: 40px; height: 40px; }
            .header h1 { font-size: 17px; }
            .content { padding: 26px 16px 30px; }
            .step-label { font-size: 9px; letter-spacing: 2px; }
            .description { font-size: 13px; }
            .days { gap: 5px; }
            .day { padding: 9px 2px; border-radius: 12px; }
            .day strong { font-size: 11px; }
            .day small { font-size: 10px; }
            .card { flex-wrap: wrap; padding: 12px; gap: 10px; }
            .state { width: 100%; text-align: left; padding-left: 60px; }
            .navigation { flex-direction: column-reverse; }
            .btn { width: 100%; min-height: 52px; font-size: 14px; }
            .btn-next { max-width: none; padding-left: 22px; }
            .btn-next .btn-icon { width: 38px; height: 38px; }
            .footer { padding: 16px 12px; font-size: 10px; }
        }
    </style>
</head>

<body>

@php
    /*
    | Kelompok status untuk penyaringan:
    |  ada   = hadir di ruangan
    |  tidak = dinas luar, izin, cuti, tidak hadir
    |  belum = belum ada data kehadiran
    */
    $jumlah = ['ada' => 0, 'tidak' => 0, 'belum' => 0];

    $baris = $pegawais->map(function ($pegawai) use ($kehadiran, &$jumlah) {
        $data = $kehadiran->get($pegawai->id);

        if (! $data) {
            $kelompok = 'belum';
            $label    = 'Belum Ada Data';
            $kelas    = 'badge-belum';
            $waktu    = 'Informasi belum diperbarui';
        } else {
            $label = $data->label_status;

            if ($data->status === 'hadir') {
                $kelompok = 'ada';
                $kelas    = 'badge-ada';
                $waktu    = $data->jam ? $data->jam . ' WIB' : 'Hadir hari ini';
            } else {
                $kelompok = 'tidak';
                $kelas    = $data->status === 'dinas_luar'
                    ? 'badge-luar'
                    : ($data->status === 'tidak_hadir' ? 'badge-tidak' : 'badge-lain');
                $waktu    = $data->keterangan ?: 'Tidak berada di ruangan';
            }
        }

        $jumlah[$kelompok]++;

        return [
            'pegawai'  => $pegawai,
            'kelompok' => $kelompok,
            'label'    => $label,
            'kelas'    => $kelas,
            'waktu'    => $waktu,
        ];
    });
@endphp

<div class="decoration one"></div>
<div class="decoration two"></div>

<div class="container">

    <div class="top-line"></div>

    <header class="header">
        <a href="{{ route('home') }}" class="back-button" aria-label="Kembali">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 12H5M11 6l-6 6 6 6"/>
            </svg>
        </a>
        <h1>Kehadiran Pegawai</h1>
    </header>

    <main class="content">

        <span class="step-label">Informasi Kunjungan</span>

        <h2 class="title">Pegawai Hari Ini</h2>

        <p class="description">
            Lihat pegawai yang berada di ruangan dan yang tidak ada,
            sebelum Anda melanjutkan kunjungan.
        </p>

        {{-- TAB HARI SENIN - JUMAT --}}
        <nav class="days" aria-label="Pilih hari">
            @foreach ($hari as $h)
                <a
                    href="{{ route('buku-tamu.kehadiran', ['tanggal' => $h->toDateString()]) }}"
                    class="day {{ $h->isSameDay($tanggal) ? 'active' : '' }} {{ $h->isSameDay($hariIni) ? 'today' : '' }}"
                >
                    <strong>{{ $h->translatedFormat('l') }}</strong>
                    <small>{{ $h->translatedFormat('d/m') }}</small>
                </a>
            @endforeach
        </nav>

        <div class="date-info">
            <span>{{ $tanggal->translatedFormat('l, d F Y') }}</span>
            <span>
                @if ($jam)
                    Jam operasional: {{ $jam['buka'] }} - {{ $jam['tutup'] }} WIB
                @else
                    Hari libur
                @endif
            </span>
        </div>

        @if (! $jam)

            <div class="libur">
                Hari {{ $tanggal->translatedFormat('l') }} adalah hari libur.
                Layanan tidak tersedia.
            </div>

        @else

            {{-- FILTER --}}
            <div class="filters" role="group" aria-label="Saring pegawai">
                <button type="button" class="filter active" data-filter="semua">
                    Semua ({{ $baris->count() }})
                </button>
                <button type="button" class="filter" data-filter="ada">
                    Ada di Ruangan ({{ $jumlah['ada'] }})
                </button>
                <button type="button" class="filter" data-filter="tidak">
                    Tidak Ada ({{ $jumlah['tidak'] }})
                </button>
                <button type="button" class="filter" data-filter="belum">
                    Belum Ada Data ({{ $jumlah['belum'] }})
                </button>
            </div>

            {{-- DAFTAR PEGAWAI --}}
            <div class="list" id="daftar">

                @forelse ($baris as $item)
                    <article class="card" data-group="{{ $item['kelompok'] }}">

                        <div class="avatar">👤</div>

                        <div class="info">
                            <h3>{{ $item['pegawai']->nama_lengkap }}</h3>
                            <p>{{ $item['pegawai']->jabatan ?? 'Jabatan belum diatur' }}</p>
                        </div>

                        <div class="state">
                            <span class="badge {{ $item['kelas'] }}">● {{ $item['label'] }}</span>
                            <p class="time">{{ $item['waktu'] }}</p>
                        </div>

                    </article>
                @empty
                    <div class="empty" style="display:block;">Belum ada data pegawai.</div>
                @endforelse

            </div>

            <div class="empty" id="kosong">Tidak ada pegawai pada kategori ini.</div>

        @endif

        <div class="navigation">

            <a href="{{ route('home') }}" class="btn btn-back">Kembali</a>

            <a href="{{ route('buku-tamu.lokasi') }}" class="btn btn-next">
                Lanjutkan
                <span class="btn-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6"/>
                    </svg>
                </span>
            </a>

        </div>

    </main>

    <footer class="footer">
        © 2026 Dinas Arsip dan Perpustakaan Kabupaten Cirebon
        <br>
        Terima kasih telah berkunjung.
    </footer>

</div>

<script>
    (function () {
        const tombol = document.querySelectorAll('.filter');
        const kartu = document.querySelectorAll('#daftar .card');
        const kosong = document.getElementById('kosong') || { style: {} };

        tombol.forEach(function (btn) {
            btn.addEventListener('click', function () {
                const pilihan = btn.dataset.filter;
                let tampil = 0;

                tombol.forEach(function (b) { b.classList.toggle('active', b === btn); });

                kartu.forEach(function (k) {
                    const cocok = pilihan === 'semua' || k.dataset.group === pilihan;
                    k.style.display = cocok ? 'flex' : 'none';
                    if (cocok) { tampil++; }
                });

                kosong.style.display = (kartu.length > 0 && tampil === 0) ? 'block' : 'none';
            });
        });
    })();
</script>

</body>
</html>