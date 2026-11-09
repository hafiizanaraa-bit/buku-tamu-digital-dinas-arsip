@extends('layouts.admin')

@section('title', 'Detail Permohonan | Buku Tamu Digital')

@section('content')

<style>
    .detail-page {
        font-family: 'Poppins', sans-serif;
        color: #35103F;
    }

    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .detail-header h2 {
        font-size: 23px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .detail-header p {
        color: #82758A;
        font-size: 13px;
        margin: 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 17px;
        border-radius: 10px;
        background: #F3EDF9;
        color: #60336F;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-back:hover {
        background: #E9DDF5;
        color: #35103F;
    }

    .detail-card {
        background: #FFFFFF;
        border: 1px solid #EEE7F3;
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 4px 18px rgba(53, 16, 63, .04);
    }

    .card-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid #F0EAF4;
    }

    .heading-icon {
        width: 38px;
        height: 38px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F3EDF9;
        color: #8955ED;
        font-size: 17px;
    }

    .card-heading h3 {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px 30px;
    }

    .detail-item {
        min-width: 0;
    }

    .detail-label {
        display: block;
        font-size: 12px;
        color: #91869A;
        margin-bottom: 7px;
    }

    .detail-value {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #35103F;
        overflow-wrap: anywhere;
    }

    .detail-value.muted {
        color: #A49AAA;
        font-weight: 400;
    }

    .detail-full {
        grid-column: 1 / -1;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-menunggu {
        background: #FFF3D9;
        color: #A66B00;
    }

    .status-diterima {
        background: #E1F7EA;
        color: #18834A;
    }

    .status-ditolak {
        background: #FFE5E8;
        color: #C33B50;
    }

    .status-lainnya {
        background: #F0EAF4;
        color: #60336F;
    }

    .note-box {
        background: #F8F5FC;
        border: 1px solid #EEE7F3;
        border-radius: 10px;
        padding: 14px;
        font-size: 13px;
        line-height: 1.7;
        color: #5E5066;
        white-space: pre-line;
    }

    .action-area {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 22px;
    }

    .btn-action {
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-accept {
        background: #E1F7EA;
        color: #18834A;
    }

    .btn-reject {
        background: #FFE5E8;
        color: #C33B50;
    }

    .btn-action:hover {
        filter: brightness(.96);
    }

    @media (max-width: 600px) {
        .detail-card {
            padding: 18px;
        }

        .detail-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .detail-full {
            grid-column: auto;
        }

        .detail-header h2 {
            font-size: 20px;
        }

        .btn-action {
            flex: 1;
        }
    }
</style>

@php
    $statusClass = match($permohonan->status) {
        'Menunggu Konfirmasi' => 'status-menunggu',
        'Diterima' => 'status-diterima',
        'Ditolak' => 'status-ditolak',
        default => 'status-lainnya',
    };
@endphp

<div class="detail-page">

    {{-- HEADER --}}
    <div class="detail-header">
        <div>
            <h2>Detail Permohonan</h2>
            <p>Informasi lengkap permohonan kunjungan tamu.</p>
        </div>

        <a href="{{ route('admin.permohonan.index') }}" class="btn-back">
            ← Kembali
        </a>
    </div>


    {{-- INFORMASI PERMOHONAN --}}
    <div class="detail-card">

        <div class="card-heading">
            <div class="heading-icon">📋</div>
            <h3>Informasi Permohonan</h3>
        </div>

        <div class="detail-grid">

            <div class="detail-item">
                <span class="detail-label">Kode Kunjungan</span>
                <span class="detail-value">
                    {{ $permohonan->kode_kunjungan }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Status Permohonan</span>
                <span class="status-badge {{ $statusClass }}">
                    {{ $permohonan->status }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Tanggal Kunjungan</span>
                <span class="detail-value">
                    {{ $permohonan->tanggal_kunjungan
                        ? $permohonan->tanggal_kunjungan->format('d-m-Y')
                        : '-' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Waktu Kunjungan</span>
                <span class="detail-value">
                    {{ $permohonan->waktu_kunjungan ?: '-' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Tanggal Permohonan Dibuat</span>
                <span class="detail-value">
                    {{ $permohonan->created_at
                        ? $permohonan->created_at->format('d-m-Y H:i')
                        : '-' }}
                </span>
            </div>

        </div>
    </div>


    {{-- IDENTITAS TAMU --}}
    <div class="detail-card">

        <div class="card-heading">
            <div class="heading-icon">👤</div>
            <h3>Identitas Tamu</h3>
        </div>

        <div class="detail-grid">

            <div class="detail-item">
                <span class="detail-label">Nama Lengkap</span>
                <span class="detail-value">
                    {{ $permohonan->nama_tamu }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Nomor Telepon</span>
                <span class="detail-value">
                    {{ $permohonan->telepon }}
                </span>
            </div>

            <div class="detail-item detail-full">
                <span class="detail-label">Alamat</span>
                <span class="detail-value">
                    {{ $permohonan->alamat }}
                </span>
            </div>

            <div class="detail-item detail-full">
                <span class="detail-label">Instansi / Asal Lembaga</span>
                <span class="detail-value">
                    {{ $permohonan->instansi ?: 'Tidak dicantumkan' }}
                </span>
            </div>

        </div>
    </div>


    {{-- TUJUAN KUNJUNGAN --}}
    <div class="detail-card">

        <div class="card-heading">
            <div class="heading-icon">🏢</div>
            <h3>Tujuan Kunjungan</h3>
        </div>

        <div class="detail-grid">

            <div class="detail-item">
                <span class="detail-label">Pegawai yang Dituju</span>
                <span class="detail-value">
                    {{ $permohonan->pegawai->nama_lengkap ?? 'Data pegawai tidak tersedia' }}
                </span>
            </div>

            <div class="detail-item">
                <span class="detail-label">Jabatan Pegawai</span>
                <span class="detail-value">
                    {{ $permohonan->pegawai->jabatan ?? '-' }}
                </span>
            </div>

            <div class="detail-item detail-full">
                <span class="detail-label">Keperluan / Tujuan</span>
                <span class="detail-value">
                    {{ $permohonan->tujuan }}
                </span>
            </div>

            <div class="detail-item detail-full">
                <span class="detail-label">Catatan Tambahan</span>

                <div class="note-box">
                    {{ $permohonan->catatan ?: 'Tidak ada catatan tambahan.' }}
                </div>
            </div>

        </div>


        {{-- TOMBOL UBAH STATUS --}}
        @if($permohonan->status === 'Menunggu Konfirmasi')

            <div class="action-area">

                <form action="{{ route('admin.permohonan.update-status', $permohonan->id) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah kamu yakin ingin menerima permohonan ini?')">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="Diterima">

                    <button type="submit" class="btn-action btn-accept">
                        ✓ Terima Permohonan
                    </button>
                </form>

                <form action="{{ route('admin.permohonan.update-status', $permohonan->id) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah kamu yakin ingin menolak permohonan ini?')">
                    @csrf
                    @method('PATCH')

                    <input type="hidden" name="status" value="Ditolak">

                    <button type="submit" class="btn-action btn-reject">
                        ✕ Tolak Permohonan
                    </button>
                </form>

            </div>

        @endif

    </div>

</div>

@endsection