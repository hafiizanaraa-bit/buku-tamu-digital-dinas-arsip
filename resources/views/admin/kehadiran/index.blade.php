@extends('layouts.admin')

@section('title', 'Kehadiran Pegawai')

@section('page-heading', 'Kehadiran Pegawai')

@push('styles')
<style>

    :root {
        --primary: #8955ED;
        --accent: #F34F85;
        --ink: #35103F;
        --muted: #89818F;
        --line: #F0ECF5;
    }

    .kh-sub {
        color: var(--muted);
        font-size: 12px;
        margin-bottom: 18px;
        line-height: 1.7;
    }

    .kh-card {
        background: #FFFFFF;
        border: 1px solid var(--line);
        border-radius: 13px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(53,16,63,0.04);
    }

    .kh-card h2 {
        font-size: 15px;
        color: var(--ink);
        margin-bottom: 6px;
        font-weight: 600;
    }

    .kh-card .desc {
        font-size: 12px;
        color: var(--muted);
        line-height: 1.8;
        margin-bottom: 14px;
    }

    .kh-alert {
        padding: 12px 16px;
        border-radius: 10px;
        margin-bottom: 16px;
        font-size: 12px;
        line-height: 1.7;
    }

    .kh-ok { background: #E2F7EC; color: #1F7A4D; }
    .kh-err { background: #FFE6ED; color: #B8325C; }

    .kh-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .kh-table th,
    .kh-table td {
        padding: 9px 8px;
        border-bottom: 1px solid var(--line);
        text-align: left;
        vertical-align: middle;
    }

    .kh-table th {
        color: var(--muted);
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .kh-table tr.terdeteksi td {
        background: #EFFAF2;
    }

    .kh-card select,
    .kh-card input[type=date],
    .kh-card input[type=time],
    .kh-card input[type=text],
    .kh-card input[type=file] {
        padding: 8px 10px;
        border: 1px solid #E4DDF0;
        border-radius: 9px;
        font-size: 12px;
        max-width: 100%;
        background: #FFFFFF;
        color: var(--ink);
    }

    .kh-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 999px;
        background: var(--primary);
        color: #FFFFFF;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s;
    }

    .kh-btn:hover { background: #7440D6; }
    .kh-btn:disabled { opacity: .55; cursor: wait; }

    .kh-btn.accent { background: var(--accent); }
    .kh-btn.accent:hover { background: #D93D71; }

    .kh-btn.light {
        background: #F0E8FF;
        color: var(--primary);
    }
    .kh-btn.light:hover { background: #E3D4FF; }

    .kh-hint {
        font-size: 11px;
        color: var(--muted);
        margin-top: 10px;
        line-height: 1.8;
    }

    .kh-scroll { overflow-x: auto; }

    .kh-bar {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .kh-card code {
        background: #F3EEFB;
        padding: 2px 6px;
        border-radius: 6px;
        font-size: 11px;
    }

    .kh-req { color: #D94170; }

    .ocr-box {
        margin-top: 14px;
        padding: 14px 16px;
        border-radius: 12px;
        border: 1px dashed var(--accent);
        background: rgba(243, 79, 133, .06);
        font-size: 12px;
        line-height: 1.8;
        color: var(--ink);
    }

    .ocr-box[hidden] { display: none; }
    .ocr-box ul { margin: 6px 0 6px 18px; }

    .ocr-box details {
        margin-top: 10px;
        font-size: 11px;
        color: var(--muted);
    }

    .ocr-box details pre {
        white-space: pre-wrap;
        margin-top: 6px;
        max-height: 200px;
        overflow: auto;
    }

</style>
@endpush


@section('content')

    <p class="kh-sub">
        Atur status kehadiran harian yang tampil di halaman pengunjung
        (sebelum informasi lokasi).
    </p>

    @if (session('sukses'))
        <div class="kh-alert kh-ok">{{ session('sukses') }}</div>
    @endif

    @if (session('error'))
        <div class="kh-alert kh-err">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="kh-alert kh-err">
            @foreach ($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    @endif


    {{-- =====================================================
         CARA 1: FOTO / DOKUMEN ABSEN + INPUT PER TANGGAL
         ===================================================== --}}
    <div class="kh-card">

        <h2>Kehadiran Tanggal {{ $tanggal->translatedFormat('l, d F Y') }}</h2>

        <p class="desc">
            <b>Cara cepat:</b> unggah foto lembar absen (atau screenshot daftar hadir),
            klik <b>Deteksi Otomatis</b>, periksa hasilnya di tabel, lalu klik
            <b>Simpan Kehadiran</b>. Foto ikut tersimpan sebagai bukti.
        </p>

        <form method="GET" action="{{ route('admin.kehadiran.index') }}" class="kh-bar">
            <label for="tanggalPilih">Pilih tanggal:</label>
            <input
                type="date"
                id="tanggalPilih"
                name="tanggal"
                value="{{ $tanggal->toDateString() }}"
                onchange="this.form.submit()"
            >
        </form>

        <form action="{{ route('admin.kehadiran.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tanggal" value="{{ $tanggal->toDateString() }}">

            <div class="kh-bar">
                <input type="file" name="bukti_harian" id="buktiHarian" accept=".jpg,.jpeg,.png,.pdf,image/*">

                <button type="button" class="kh-btn accent" id="btnDeteksi">
                    Deteksi Otomatis dari Foto
                </button>

                <button type="button" class="kh-btn light" onclick="isiSemuaHadir()">
                    Tandai semua "Ada di ruangan"
                </button>
            </div>

            <div class="ocr-box" id="ocrBox" hidden>
                <div id="statusOcr"></div>
                <div id="hasilOcr"></div>
            </div>

            <p class="kh-hint">
                Deteksi otomatis membaca <b>nama pegawai</b> yang tertulis di foto (JPG/PNG)
                dan menandainya "Ada di ruangan". Pegawai yang tidak terbaca dibiarkan
                "Belum diisi" supaya bisa Anda periksa. Perlu internet saat mendeteksi,
                dan foto yang tegak, terang, serta tulisan jelas memberi hasil terbaik.
                Untuk PDF, gunakan <b>Cara 2 (CSV)</b> di bawah atau input manual.
            </p>

            <br>

            <div class="kh-scroll">
                <table class="kh-table">
                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Status</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($pegawais as $p)

                        @php $k = $kehadiran->get($p->id); @endphp

                        <tr data-pegawai="{{ $p->id }}">
                            <td>
                                <b>{{ $p->nama_lengkap }}</b><br>
                                <small style="color:#89818F">{{ $p->jabatan }}</small>
                            </td>

                            <td>
                                <select name="data[{{ $p->id }}][status]" class="status-select">
                                    <option value="">Belum diisi</option>
                                    @foreach (\App\Models\KehadiranPegawai::STATUS as $val => $label)
                                        <option
                                            value="{{ $val }}"
                                            {{ ($k->status ?? '') === $val ? 'selected' : '' }}
                                        >{{ $label }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input
                                    type="time"
                                    name="data[{{ $p->id }}][jam_masuk]"
                                    value="{{ $k && $k->jam_masuk ? substr($k->jam_masuk, 0, 5) : '' }}"
                                >
                            </td>

                            <td>
                                <input
                                    type="time"
                                    name="data[{{ $p->id }}][jam_pulang]"
                                    value="{{ $k && $k->jam_pulang ? substr($k->jam_pulang, 0, 5) : '' }}"
                                >
                            </td>

                            <td>
                                <input
                                    type="text"
                                    maxlength="150"
                                    name="data[{{ $p->id }}][keterangan]"
                                    value="{{ $k->keterangan ?? '' }}"
                                    placeholder="opsional"
                                >
                            </td>

                            <td>
                                @if ($k && $k->bukti)
                                    <a href="{{ asset('storage/' . $k->bukti) }}" target="_blank" rel="noopener">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr><td colspan="6">Belum ada data pegawai.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <p class="kh-hint">Baris berstatus "Belum diisi" tidak akan disimpan.</p>

            <br>
            <button class="kh-btn" type="submit">Simpan Kehadiran</button>
        </form>

    </div>


    {{-- =====================================================
         CARA 2: IMPOR CSV (MESIN ABSEN / EXCEL)
         ===================================================== --}}
    <div class="kh-card">

        <h2>Cara 2: Impor File Absen (CSV)</h2>

        <p class="desc">
            Untuk absen satu minggu atau satu bulan sekaligus dari mesin absen atau Excel.
        </p>

        <form action="{{ route('admin.kehadiran.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <p style="margin-bottom:6px;font-size:12px">
                File absen (CSV) <span class="kh-req">*</span>
            </p>
            <input type="file" name="file_absen" accept=".csv,.txt" required>

            <p style="margin:12px 0 6px;font-size:12px">
                Foto/dokumen bukti absen (opsional, JPG/PNG/PDF)
            </p>
            <input type="file" name="bukti" accept=".jpg,.jpeg,.png,.pdf">

            <p class="kh-hint">
                Kolom header wajib: <b>nama, tanggal, jam_masuk, jam_pulang</b>.
                Nama harus sama dengan data pegawai.<br>
                Contoh baris: <code>Budi Santoso;18/11/2026;07.45;15.40</code><br>
                Pegawai yang punya jam masuk otomatis berstatus Ada di ruangan.
                Dari Excel: File → Save As → CSV.
            </p>

            <br>
            <button class="kh-btn" type="submit">Impor Absen</button>
        </form>

    </div>

@endsection


@push('scripts')
@php
    $daftarPegawaiJs = $pegawais->map(function ($p) {
        return ['id' => $p->id, 'nama' => $p->nama_lengkap];
    })->values();
@endphp

<script src="https://cdn.jsdelivr.net/npm/tesseract.js@5.1.1/dist/tesseract.min.js"></script>

<script>
    const PEGAWAI = @json($daftarPegawaiJs);

    const fileInput  = document.getElementById('buktiHarian');
    const btnDeteksi = document.getElementById('btnDeteksi');
    const ocrBox     = document.getElementById('ocrBox');
    const statusOcr  = document.getElementById('statusOcr');
    const hasilOcr   = document.getElementById('hasilOcr');

    // Gelar akademik/singkatan yang diabaikan saat mencocokkan nama
    const GELAR = ['sos','kom','kep','pd','hum','hut','sh','se','st','mt','mm','msi','ir',
                   'drs','dra','hj','spd','skom','ssos','amd','mpd','map','sip'];

    function isiSemuaHadir() {
        document.querySelectorAll('.status-select').forEach(function (el) {
            if (el.value === '') {
                el.value = 'hadir';
            }
        });
    }

    function jarak(a, b) {
        const m = a.length, n = b.length;
        const d = [];
        for (let i = 0; i <= m; i++) { d[i] = [i]; }
        for (let j = 1; j <= n; j++) { d[0][j] = j; }
        for (let i = 1; i <= m; i++) {
            for (let j = 1; j <= n; j++) {
                d[i][j] = Math.min(
                    d[i - 1][j] + 1,
                    d[i][j - 1] + 1,
                    d[i - 1][j - 1] + (a[i - 1] === b[j - 1] ? 0 : 1)
                );
            }
        }
        return d[m][n];
    }

    // Cocokkan teks hasil baca foto dengan daftar nama pegawai
    function cocokkan(teks, daftar) {
        const kata = teks.toLowerCase().replace(/[^a-z\s]/g, ' ')
            .split(/\s+/).filter(function (w) { return w.length >= 2; });

        const cocok = [], tidak = [];

        daftar.forEach(function (p) {
            const token = p.nama.toLowerCase().replace(/[^a-z\s]/g, ' ')
                .split(/\s+/)
                .filter(function (t) { return t.length >= 3 && GELAR.indexOf(t) === -1; });

            if (token.length === 0) { tidak.push(p); return; }

            let ketemu = 0;
            token.forEach(function (t) {
                const ada = kata.some(function (w) {
                    return w === t || (t.length >= 5 && w.length >= 4 && jarak(w, t) <= 1);
                });
                if (ada) { ketemu++; }
            });

            const perlu = token.length >= 2 ? 2 : 1;
            (ketemu >= perlu ? cocok : tidak).push(p);
        });

        return { cocok: cocok, tidak: tidak };
    }

    // Perkecil foto agar cepat dibaca dan tidak melebihi batas unggah server
    function kompres(file) {
        return new Promise(function (resolve) {
            if (!file.type || file.type.indexOf('image/') !== 0) { return resolve(file); }

            const img = new Image();
            const url = URL.createObjectURL(file);

            img.onload = function () {
                const skala = Math.min(1, 1800 / Math.max(img.width, img.height));
                const w = Math.round(img.width * skala);
                const h = Math.round(img.height * skala);
                const c = document.createElement('canvas');
                c.width = w; c.height = h;
                c.getContext('2d').drawImage(img, 0, 0, w, h);

                c.toBlob(function (blob) {
                    URL.revokeObjectURL(url);
                    if (!blob) { return resolve(file); }
                    resolve(new File([blob], file.name.replace(/\.[^.]+$/, '') + '.jpg', { type: 'image/jpeg' }));
                }, 'image/jpeg', 0.85);
            };

            img.onerror = function () { URL.revokeObjectURL(url); resolve(file); };
            img.src = url;
        });
    }

    fileInput.addEventListener('change', async function () {
        const file = fileInput.files[0];
        if (!file) { return; }

        const kecil = await kompres(file);

        if (kecil !== file) {
            try {
                const dt = new DataTransfer();
                dt.items.add(kecil);
                fileInput.files = dt.files;
            } catch (e) { /* biarkan file asli */ }
        }
    });

    btnDeteksi.addEventListener('click', async function () {
        const file = fileInput.files[0];

        ocrBox.hidden = false;
        hasilOcr.innerHTML = '';

        if (!file) {
            statusOcr.textContent = 'Pilih foto absen terlebih dahulu.';
            return;
        }

        if (!file.type || file.type.indexOf('image/') !== 0) {
            statusOcr.textContent = 'PDF tidak dapat dibaca otomatis. Gunakan foto/screenshot (JPG/PNG), impor CSV, atau input manual.';
            return;
        }

        if (typeof Tesseract === 'undefined') {
            statusOcr.textContent = 'Pustaka pembaca foto gagal dimuat. Periksa koneksi internet lalu muat ulang halaman.';
            return;
        }

        btnDeteksi.disabled = true;
        statusOcr.textContent = 'Membaca foto... (pertama kali bisa 30-60 detik)';

        try {
            const hasil = await Tesseract.recognize(file, 'ind', {
                logger: function (m) {
                    if (m.status === 'recognizing text') {
                        statusOcr.textContent = 'Membaca teks: ' + Math.round(m.progress * 100) + '%';
                    }
                }
            });

            const teks = hasil.data.text || '';
            const r = cocokkan(teks, PEGAWAI);

            document.querySelectorAll('tr[data-pegawai]').forEach(function (tr) {
                tr.classList.remove('terdeteksi');
            });

            r.cocok.forEach(function (p) {
                const sel = document.querySelector('select[name="data[' + p.id + '][status]"]');
                if (sel) {
                    sel.value = 'hadir';
                    sel.closest('tr').classList.add('terdeteksi');
                }
            });

            statusOcr.innerHTML = '<b>Selesai.</b> ' + r.cocok.length + ' pegawai terdeteksi hadir (baris hijau). ' +
                'Periksa tabel, lalu klik <b>Simpan Kehadiran</b>.';

            let html = '';
            if (r.cocok.length) {
                html += '<div>Terdeteksi:<ul>' + r.cocok.map(function (p) {
                    return '<li>' + p.nama.replace(/</g, '&lt;') + '</li>';
                }).join('') + '</ul></div>';
            }
            if (r.tidak.length) {
                html += '<div>Tidak terdeteksi di foto (isi manual jika hadir):<ul>' + r.tidak.map(function (p) {
                    return '<li>' + p.nama.replace(/</g, '&lt;') + '</li>';
                }).join('') + '</ul></div>';
            }
            html += '<details><summary>Teks yang terbaca dari foto</summary><pre></pre></details>';
            hasilOcr.innerHTML = html;
            hasilOcr.querySelector('pre').textContent = teks.trim() || '(tidak ada teks terbaca)';

        } catch (e) {
            console.error(e);
            statusOcr.textContent = 'Gagal membaca foto. Pastikan terhubung ke internet, coba foto yang lebih jelas, atau gunakan input manual/CSV.';
        } finally {
            btnDeteksi.disabled = false;
        }
    });
</script>
@endpush