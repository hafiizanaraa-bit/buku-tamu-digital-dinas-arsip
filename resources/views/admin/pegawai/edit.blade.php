@extends('layouts.admin')

@section('title', 'Edit Pegawai | Buku Tamu Digital')
@section('page-heading', 'Edit Pegawai')

@push('styles')
<style>
    .pegawai-edit {
        max-width: 850px;
        margin: 0 auto;
        color: #35103F;
    }

    .page-intro {
        margin-bottom: 22px;
    }

    .page-title {
        margin: 0 0 7px;
        font-size: 25px;
        font-weight: 700;
        color: #35103F;
    }

    .page-description {
        margin: 0;
        color: #81758A;
        font-size: 14px;
        line-height: 1.6;
    }

    .form-card {
        background: #FFFFFF;
        padding: 30px;
        border-radius: 18px;
        border: 1px solid #EEE7F5;
        box-shadow: 0 5px 20px rgba(53, 16, 63, 0.06);
    }

    .form-card-header {
        padding-bottom: 20px;
        margin-bottom: 25px;
        border-bottom: 1px solid #F0EAF5;
    }

    .form-card-header h3 {
        margin: 0 0 6px;
        font-size: 18px;
        color: #35103F;
    }

    .form-card-header p {
        margin: 0;
        color: #897E91;
        font-size: 13px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 9px;
        font-size: 13px;
        font-weight: 600;
        color: #493451;
    }

    .required {
        color: #E05275;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #E5DCEC;
        border-radius: 10px;
        background: #FCFAFE;
        color: #35103F;
        font-size: 14px;
        outline: none;
        transition: border-color .2s, box-shadow .2s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #8955ED;
        box-shadow: 0 0 0 3px rgba(137, 85, 237, 0.12);
        background: #FFFFFF;
    }

    .form-group input::placeholder {
        color: #B3A9BB;
    }

    .field-help {
        display: block;
        margin-top: 6px;
        color: #9A90A1;
        font-size: 12px;
    }

    .error {
        color: #B42318;
        font-size: 12px;
        margin-top: 7px;
    }

    .error-box {
        background: #FFF0F0;
        border: 1px solid #F5CCCC;
        color: #9F2525;
        padding: 15px 18px;
        margin-bottom: 22px;
        border-radius: 11px;
        font-size: 13px;
    }

    .error-box ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 22px;
        margin-top: 10px;
        border-top: 1px solid #F0EAF5;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s;
    }

    .btn-primary {
        background: #8955ED;
        color: #FFFFFF;
    }

    .btn-primary:hover {
        background: #7040CF;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #F1ECF7;
        color: #594565;
    }

    .btn-secondary:hover {
        background: #E6DDF0;
    }

    @media (max-width: 600px) {
        .form-card {
            padding: 20px 16px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-group.full-width {
            grid-column: auto;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions .btn {
            width: 100%;
        }

        .page-title {
            font-size: 21px;
        }
    }
</style>
@endpush

@section('content')
<div class="pegawai-edit">

    <div class="page-intro">
        <h2 class="page-title">Edit Data Pegawai</h2>
        <p class="page-description">
            Perbarui informasi pegawai Dinas Kearsipan dan Perpustakaan Kabupaten Cirebon.
        </p>
    </div>

    <div class="form-card">

        <div class="form-card-header">
            <h3>Formulir Data Pegawai</h3>
            <p>Silakan periksa dan ubah informasi pegawai pada kolom berikut.</p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <strong>Periksa kembali data yang kamu masukkan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.pegawai.update', $pegawai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                <div class="form-group full-width">
                    <label for="nama_lengkap">
                        Nama Lengkap <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}"
                        placeholder="Masukkan nama lengkap pegawai"
                        required
                    >
                    @error('nama_lengkap')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nip">NIP (Opsional)</label>
                    <input
                        type="text"
                        id="nip"
                        name="nip"
                        value="{{ old('nip', $pegawai->nip) }}"
                        placeholder="Masukkan NIP pegawai"
                    >
                    @error('nip')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input
                        type="text"
                        id="jabatan"
                        name="jabatan"
                        value="{{ old('jabatan', $pegawai->jabatan) }}"
                        placeholder="Masukkan jabatan pegawai"
                    >
                    @error('jabatan')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group full-width">
                    <label for="bidang">
                        Bidang/Unit Kerja <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="bidang"
                        name="bidang"
                        value="{{ old('bidang', $pegawai->bidang) }}"
                        placeholder="Contoh: Sekretariat"
                        required
                    >
                    @error('bidang')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_kepegawaian">Status Kepegawaian</label>

                    <select id="status_kepegawaian" name="status_kepegawaian">
                        <option value="">-- Pilih Status --</option>

                        @foreach (['PNS', 'PPPK', 'Non-ASN', 'Lainnya'] as $status)
                            <option value="{{ $status }}"
                                {{ old('status_kepegawaian', $pegawai->status_kepegawaian) == $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                        @endforeach
                    </select>

                    @error('status_kepegawaian')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status_ketersediaan">Status Ketersediaan Pegawai</label>

                    <select id="status_ketersediaan" name="status_ketersediaan" required>
                        <option value="belum_diatur"
                            {{ old('status_ketersediaan', $pegawai->status_ketersediaan) == 'belum_diatur' ? 'selected' : '' }}>
                            Belum Diatur
                        </option>

                        <option value="tersedia"
                            {{ old('status_ketersediaan', $pegawai->status_ketersediaan) == 'tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>

                        <option value="sedang_bertugas"
                            {{ old('status_ketersediaan', $pegawai->status_ketersediaan) == 'sedang_bertugas' ? 'selected' : '' }}>
                            Sedang Bertugas
                        </option>

                        <option value="di_luar_kantor"
                            {{ old('status_ketersediaan', $pegawai->status_ketersediaan) == 'di_luar_kantor' ? 'selected' : '' }}>
                            Di Luar Kantor
                        </option>

                        <option value="tidak_tersedia"
                            {{ old('status_ketersediaan', $pegawai->status_ketersediaan) == 'tidak_tersedia' ? 'selected' : '' }}>
                            Tidak Tersedia
                        </option>
                    </select>

                    @error('status_ketersediaan')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection