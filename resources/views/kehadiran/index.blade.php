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
            max-width: 860px;
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

        .icon {
            width: 22px; height: 22px; display: block;
            fill: none; stroke: currentColor; stroke-width: 2.6;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .header {
            display: flex; align-items: center; gap: 16px;
            padding: 24px 32px;
            border-bottom: 1px solid var(--line);
        }

        .back-button {
            width: 44px; height: 44px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 6px 16px rgba(0, 0, 0, .22);
            text-decoration: none;
            transition: transform .25s;
        }
        .back-button:hover { transform: translateX(-3px); }
        .back-button:focus-visible { outline: none; box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold); }

        .header h1 { color: var(--navy); font-size: 21px; font-weight: 800; line-height: 1.2; }

        .content { padding: 34px 48px 40px; }

        .step-label {
            display: inline-flex; align-items: center; gap: 12px;
            margin-bottom: 14px;
            color: var(--gold-dark);
            font-size: 11px; font-weight: 800; letter-spacing: 3px; text-transform: uppercase;
        }
        .step-label::before {
            content: ""; width: 34px; height: 2px;
            background: var(--gold); border-radius: 2px;
        }

        .title {
            margin-bottom: 12px;
            color: var(--navy);
            font-family: 'Playfair Display', serif;
            font-size: clamp(30px, 4vw, 42px);
            font-weight: 800; line-height: 1.1; letter-spacing: -1px;
        }

        .description { margin-bottom: 22px; color: var(--muted); font-size: 15px; line-height: 1.8; }

        .jam {
            display: block;
            margin-bottom: 20px;
            padding: 12px 16px;
            border-radius: 14px;
            background: rgba(201, 162, 77, .14);
            border-left: 3px solid var(--gold);
            color: var(--navy);
            font-size: 13px; font-weight: 700; line-height: 1.6;
        }

        /* TAB HARI (slide) */
        .tabs {
            display: flex; gap: 8px;
            overflow-x: auto;
            margin-bottom: 20px;
            padding: 2px 2px 6px;
            scroll-snap-type: x mandatory;
        }

        .tab {
            flex: 1; min-width: 96px;
            padding: 11px 8px;
            text-align: center; text-decoration: none;
            border-radius: 14px;
            background: white;
            border: 1px solid var(--line);
            color: var(--navy);
            font-size: 13px; font-weight: 800;
            scroll-snap-align: start;
            transition: transform .2s, border-color .2s;
        }
        .tab:hover { border-color: var(--gold); transform: translateY(-2px); }
        .tab small { display: block; margin-top: 2px; font-weight: 500; font-size: 11px; color: var(--muted); }
        .tab.active { background: linear-gradient(135deg, var(--navy), var(--navy-dark)); color: #fff; border-color: var(--navy); }
        .tab.active small { color: var(--gold-light); }

        /* DAFTAR PEGAWAI */
        .list {
            display: flex; flex-direction: column; gap: 9px;
            max-height: 380px; overflow-y: auto;
            padding: 2px 4px 2px 2px;
        }

        .row {
            display: flex; align-items: center; gap: 14px;
            padding: 14px 16px;
            border-radius: 16px;
            background: white;
            border: 1px solid var(--line);
        }

        .avatar {
            width: 44px; height: 44px; flex-shrink: 0;
            display: flex; justify-content: center; align-items: center;
            border-radius: 50%;
            background: rgba(18, 41, 74, .07);
            font-size: 22px;
        }

        .info { flex: 1; min-width: 0; }
        .info h3 { color: var(--navy); font-size: 14px; font-weight: 800; margin-bottom: 3px; }
        .info p { color: var(--muted); font-size: 12px; line-height: 1.5; }

        .status { text-align: right; flex-shrink: 0; }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 11px; font-weight: 800; white-space: nowrap;
        }
        .hadir { background: #dcf5e4; color: #14703a; }
        .tidak_hadir { background: #fbe9e9; color: #9b2535; }
        .dinas_luar, .izin, .cuti { background: #fff0d7; color: #8a5a00; }
        .belum { background: #eef1f5; color: #64748b; }

        .waktu { display: block; margin-top: 5px; font-size: 11px; color: var(--muted); }

        .kosong { padding: 30px 10px; text-align: center; color: var(--muted); font-size: 14px; line-height: 1.7; }

        /* TOMBOL */
        .navigation { display: flex; gap: 14px; margin-top: 30px; }

        .btn {
            min-height: 56px;
            display: inline-flex; align-items: center; justify-content: center; gap: 12px;
            border-radius: 999px;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 700; letter-spacing: .3px;
            cursor: pointer;
            transition: transform .25s, box-shadow .25s;
        }
        .btn:hover { transform: translateY(-2px); }

        .btn-back { padding: 0 30px; color: var(--navy); background: white; border: 1.5px solid var(--navy); }
        .btn-back:hover { color: white; background: var(--navy); }

        .btn-next {
            flex: 1;
            padding: 0 7px 0 28px;
            color: white;
            background: linear-gradient(135deg, var(--navy), var(--navy-dark));
            box-shadow: 0 14px 30px rgba(18, 41, 74, .30), inset 0 0 0 1px rgba(255, 255, 255, .06);
        }
        .btn-next .btn-icon {
            width: 42px; height: 42px; margin-left: auto;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%;
            color: var(--navy-dark);
            background: linear-gradient(135deg, var(--gold-light), var(--gold));
            box-shadow: 0 5px 12px rgba(0, 0, 0, .28);
        }
        .btn-next .btn-icon .icon { width: 20px; height: 20px; }

        .btn:focus-visible { outline: none; box-shadow: 0 0 0 3px #fff, 0 0 0 6px var(--gold); }

        .footer {
            padding: 20px; text-align: center;
            color: #7b8799; font-size: 12px; line-height: 1.8;
            background: #f3efe6; border-top: 1px solid var(--line);
        }

        @keyframes muncul {
            from { opacity: 0; transform: scale(.98); }
            to   { opacity: 1; transform: scale(1); }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }

        @media (max-width: 600px) {
            body { padding: 10px; align-items: flex-start; }
            .container { margin: 8px 0; border-radius: 22px; }
            .top-line { height: 6px; }
            .header { padding: 18px; gap: 12px; }
            .back-button { width: 40px; height: 40px; }
            .header h1 { font-size: 17px; }
            .content { padding: 24px 16px 28px; }
            .step-label { font-size: 9px; letter-spacing: 2px; }
            .description { font-size: 13px; }
            .row { padding: 12px; gap: 10px; }
            .avatar { width: 38px; height: 38px; font-size: 18px; }
            .navigation { flex-direction: column-reverse; }
            .btn { width: 100%; min-height: 52px; font-size: 14px; }
            .btn-next { padding-left: 22px; }
            .btn-next .btn-icon { width: 38px; height: 38px; }
            .footer { padding: 16px 12px; font-size: 10px; }
        }
    </style>
</head>

<body>

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

        <span class="step-label">Informasi · Kehadiran Pegawai</span>

        <h2 class="title">Pegawai di Ruangan</h2>

        <p class="description">
            Cek apakah pegawai yang ingin Anda temui sedang berada
            di ruangan pada hari kunjungan.
        </p>

        @if ($jam)
            <div class="jam">
                Jam operasional {{ $tanggal->translatedFormat('l, d F Y') }}:
                {{ $jam['buka'] }} - {{ $jam['tutup'] }} WIB
            </div>
        @endif

        {{-- PILIH HARI (SENIN - JUMAT) --}}
        <div class="tabs">
            @foreach ($hari as $h)
                <a
                    href="{{ route('buku-tamu.kehadiran', ['tanggal' => $h->toDateString()]) }}"
                    class="tab {{ $h->isSameDay($tanggal) ? 'active' : '' }}"
                >
                    {{ $h->translatedFormat('l') }}
                    <small>
                        {{ $h->translatedFormat('d M') }}{{ $h->isSameDay($hariIni) ? ' · hari ini' : '' }}
                    </small>
                </a>
            @endforeach
        </div>

        @if (!$jam)
            <div class="kosong">
                {{ $tanggal->translatedFormat('l') }} adalah hari libur.
                Layanan tidak tersedia.
            </div>
        @else
            <div class="list">
                @forelse ($pegawais as $p)

                    @php $k = $kehadiran->get($p->id); @endphp

                    <div class="row">

                        <div class="avatar">👤</div>

                        <div class="info">
                            <h3>{{ $p->nama_lengkap }}</h3>
                            <p>{{ $p->jabatan ?? '-' }}</p>
                        </div>

                        <div class="status">
                            <span class="badge {{ $k ? $k->status : 'belum' }}">
                                {{ $k ? $k->label_status : 'Belum ada data' }}
                            </span>

                            @if ($k && $k->jam)
                                <span class="waktu">{{ $k->jam }}</span>
                            @endif

                            @if ($k && $k->keterangan)
                                <span class="waktu">{{ $k->keterangan }}</span>
                            @endif
                        </div>

                    </div>

                @empty
                    <div class="kosong">Belum ada data pegawai.</div>
                @endforelse
            </div>
        @endif

        <div class="navigation">

            <a href="{{ route('home') }}" class="btn btn-back">
                Kembali
            </a>

            <a href="{{ route('buku-tamu.lokasi') }}" class="btn btn-next">
                Lanjut ke Lokasi
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

</body>
</html>
