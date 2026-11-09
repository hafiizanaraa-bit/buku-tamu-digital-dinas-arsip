@extends('layouts.admin')

@section('title', 'Riwayat Kunjungan | Buku Tamu Digital')

@section('page-heading', 'Riwayat Kunjungan')

@push('styles')
<style>
    .riwayat-page {
        color: #35103F;
    }

    .page-title {
        color: #35103F;
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 8px;
    }

    .page-description {
        color: #81758A;
        font-size: 14px;
        line-height: 1.6;
        margin: 0 0 25px;
    }

    /* RINGKASAN RIWAYAT */
    .riwayat-summary {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 25px;
    }

    .riwayat-summary-card {
        position: relative;
        background: #FFFFFF;
        padding: 22px;
        border-radius: 16px;
        border: 1px solid #EEE7F5;
        box-shadow: 0 4px 15px rgba(53, 16, 63, 0.05);
        overflow: hidden;
    }

    .riwayat-summary-card h3 {
        font-size: 13px;
        font-weight: 500;
        color: #897E91;
        margin: 0 0 13px;
    }

    .riwayat-summary-card p {
        font-size: 28px;
        font-weight: 700;
        color: #35103F;
        margin: 0;
    }

    .riwayat-summary-card::after {
        content: '';
        position: absolute;
        width: 5px;
        height: 100%;
        top: 0;
        left: 0;
        background: #35A477;
    }

    .riwayat-summary-card.ditolak::after {
        background: #E05275;
    }

    /* TABEL */
    .table-container {
        background: #FFFFFF;
        padding: 24px;
        border-radius: 17px;
        border: 1px solid #EEE7F5;
        box-shadow: 0 4px 15px rgba(53, 16, 63, 0.05);
        overflow: hidden;
    }

    .table-header {
        margin-bottom: 20px;
    }

    .table-header h2 {
        color: #35103F;
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 6px;
    }

    .table-header p {
        color: #94899B;
        font-size: 12px;
        margin: 0;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .table-riwayat {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .table-riwayat th {
        background: #F3EDF9;
        color: #594565;
        padding: 15px 13px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #E9DFF1;
    }

    .table-riwayat td {
        padding: 14px 13px;
        border-bottom: 1px solid #F0EAF5;
        font-size: 12px;
        color: #594F60;
        vertical-align: middle;
        line-height: 1.5;
    }

    .table-riwayat tbody tr {
        transition: background .2s;
    }

    .table-riwayat tbody tr:hover {
        background: #FCFAFE;
    }

    .table-riwayat tbody tr:last-child td {
        border-bottom: none;
    }

    .kode-kunjungan {
        color: #7040CF;
        font-weight: 700;
        white-space: nowrap;
    }

    .nama-tamu {
        color: #35103F;
        font-weight: 600;
        min-width: 120px;
    }

    /* STATUS */
    .status {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-diterima {
        background: #E3F7EC;
        color: #24723B;
    }

    .status-ditolak {
        background: #FFE8EC;
        color: #A12645;
    }

    /* DATA KOSONG */
    .empty-data {
        text-align: center !important;
        color: #94899B !important;
        padding: 35px !important;
        font-size: 13px !important;
    }

    /* RESPONSIVE */
    @media (max-width: 700px) {
        .riwayat-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .riwayat-summary-card {
            padding: 17px 15px;
        }

        .riwayat-summary-card h3 {
            font-size: 11px;
        }

        .riwayat-summary-card p {
            font-size: 23px;
        }

        .page-title {
            font-size: 21px;
        }

        .table-container {
            padding: 17px 13px;
        }
    }
</style>
@endpush

@section('content')

<div class="riwayat-page">

    <!-- JUDUL HALAMAN -->
    <h1 class="page-title">Riwayat Kunjungan</h1>

    <p class="page-description">
        Daftar permohonan kunjungan yang telah diterima atau ditolak oleh admin.
    </p>

    <!-- RINGKASAN RIWAYAT -->
    <div class="riwayat-summary">

        <div class="riwayat-summary-card">
            <h3>Kunjungan Diterima</h3>
            <p>
                {{ $riwayat->where('status', 'Diterima')->count() }}
            </p>
        </div>

        <div class="riwayat-summary-card ditolak">
            <h3>Kunjungan Ditolak</h3>
            <p>
                {{ $riwayat->where('status', 'Ditolak')->count() }}
            </p>
        </div>

    </div>

    <!-- TABEL RIWAYAT -->
    <div class="table-container">

        <div class="table-header">
            <h2>Daftar Riwayat Kunjungan</h2>
            <p>
                Data kunjungan yang sudah mendapatkan keputusan dari admin.
            </p>
        </div>

        <div class="table-responsive">

            <table class="table-riwayat">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kunjungan</th>
                        <th>Nama Tamu</th>
                        <th>Telepon</th>
                        <th>Pegawai Tujuan</th>
                        <th>Tujuan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($riwayat as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="kode-kunjungan">
                                    {{ $item->kode_kunjungan }}
                                </span>
                            </td>

                            <td>
                                <span class="nama-tamu">
                                    {{ $item->nama_tamu }}
                                </span>
                            </td>

                            <td>{{ $item->telepon }}</td>

                            <td>
                                {{ $item->pegawai->nama_lengkap ?? '-' }}
                            </td>

                            <td>{{ $item->tujuan }}</td>

                            <td>
                                {{ $item->tanggal_kunjungan
                                    ? $item->tanggal_kunjungan->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>{{ $item->waktu_kunjungan }}</td>

                            <td>
                                @if ($item->status == 'Diterima')
                                    <span class="status status-diterima">
                                        Diterima
                                    </span>
                                @else
                                    <span class="status status-ditolak">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="empty-data">
                                Belum ada riwayat kunjungan.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection