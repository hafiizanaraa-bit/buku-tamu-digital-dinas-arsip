@extends('layouts.admin')

@section('title', 'Permohonan Kunjungan | Buku Tamu Digital')

@section('page-heading', 'Permohonan Kunjungan')

@push('styles')
<style>
    .permohonan-page {
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

    /* RINGKASAN PERMOHONAN */
    .summary-cards {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 25px;
    }

    .summary-card {
        position: relative;
        background: #FFFFFF;
        padding: 22px;
        border-radius: 16px;
        border: 1px solid #EEE7F5;
        box-shadow: 0 4px 15px rgba(53, 16, 63, 0.05);
        overflow: hidden;
    }

    .summary-card h3 {
        font-size: 13px;
        font-weight: 500;
        color: #897E91;
        margin: 0 0 13px;
    }

    .summary-card p {
        font-size: 28px;
        font-weight: 700;
        color: #35103F;
        margin: 0;
    }

    .summary-card::after {
        content: '';
        position: absolute;
        width: 5px;
        height: 100%;
        top: 0;
        left: 0;
        background: #8955ED;
    }

    .summary-card.menunggu::after {
        background: #E5A52D;
    }

    .summary-card.diterima::after {
        background: #35A477;
    }

    .summary-card.ditolak::after {
        background: #E05275;
    }

    /* NOTIFIKASI */
    .alert-success {
        background: #E8F8F0;
        color: #247A50;
        padding: 14px 17px;
        border-radius: 11px;
        margin-bottom: 20px;
        border-left: 4px solid #35A477;
        font-size: 13px;
    }

    .alert-error {
        background: #FFF0F0;
        color: #A12626;
        padding: 14px 17px;
        border-radius: 11px;
        margin-bottom: 20px;
        border-left: 4px solid #E05275;
        font-size: 13px;
    }

    .alert-error ul {
        margin: 8px 0 0 20px;
        padding: 0;
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

    .table-permohonan {
        width: 100%;
        border-collapse: collapse;
        min-width: 1100px;
    }

    .table-permohonan th {
        background: #F3EDF9;
        color: #594565;
        padding: 15px 13px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        border-bottom: 1px solid #E9DFF1;
    }

    .table-permohonan td {
        padding: 14px 13px;
        border-bottom: 1px solid #F0EAF5;
        font-size: 12px;
        color: #594F60;
        vertical-align: middle;
        line-height: 1.5;
    }

    .table-permohonan tbody tr {
        transition: background .2s;
    }

    .table-permohonan tbody tr:hover {
        background: #FCFAFE;
    }

    .table-permohonan tbody tr:last-child td {
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

    .status-menunggu {
        background: #FFF4D9;
        color: #946200;
    }

    .status-diterima {
        background: #E3F7EC;
        color: #24723B;
    }

    .status-ditolak {
        background: #FFE8EC;
        color: #A12645;
    }

    /* TOMBOL AKSI */
    .aksi-container {
        display: flex;
        flex-direction: column;
        gap: 7px;
        min-width: 110px;
    }

    .aksi-container form {
        margin: 0;
    }

    .btn-aksi {
        display: inline-block;
        width: 100%;
        padding: 9px 10px;
        border: none;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: .2s;
        box-sizing: border-box;
    }

    .btn-detail {
        background: #F0E8FF;
        color: #7040CF;
    }

    .btn-detail:hover {
        background: #E2D3FF;
        color: #5930B0;
    }

    .btn-terima {
        background: #35A477;
        color: #FFFFFF;
    }

    .btn-terima:hover {
        background: #27845F;
    }

    .btn-tolak {
        background: #E05275;
        color: #FFFFFF;
    }

    .btn-tolak:hover {
        background: #C83B60;
    }

    .btn-ubah {
        background: #8955ED;
        color: #FFFFFF;
    }

    .btn-ubah:hover {
        background: #7040CF;
    }

    .empty-data {
        text-align: center;
        padding: 35px !important;
        color: #94899B !important;
        font-size: 13px !important;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .summary-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .summary-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .summary-card {
            padding: 17px 15px;
        }

        .summary-card h3 {
            font-size: 11px;
        }

        .summary-card p {
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

<div class="permohonan-page">

    <h1 class="page-title">Permohonan Kunjungan</h1>

    <p class="page-description">
        Kelola dan pantau permohonan kunjungan tamu
        pada Dinas Kearsipan dan Perpustakaan Kabupaten Cirebon.
    </p>

    <!-- NOTIFIKASI BERHASIL -->
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- NOTIFIKASI ERROR -->
    @if ($errors->any())
        <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- RINGKASAN PERMOHONAN -->
    <div class="summary-cards">

        <div class="summary-card">
            <h3>Total Permohonan</h3>
            <p>{{ $totalPermohonan }}</p>
        </div>

        <div class="summary-card menunggu">
            <h3>Menunggu Konfirmasi</h3>
            <p>{{ $menunggu }}</p>
        </div>

        <div class="summary-card diterima">
            <h3>Kunjungan Diterima</h3>
            <p>{{ $diterima }}</p>
        </div>

        <div class="summary-card ditolak">
            <h3>Kunjungan Ditolak</h3>
            <p>{{ $ditolak }}</p>
        </div>

    </div>

    <!-- TABEL PERMOHONAN -->
    <div class="table-container">

        <div class="table-header">
            <h2>Daftar Permohonan Kunjungan</h2>
            <p>Data permohonan kunjungan yang masuk dari buku tamu digital.</p>
        </div>

        <div class="table-responsive">

            <table class="table-permohonan">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Kunjungan</th>
                        <th>Nama Tamu</th>
                        <th>Telepon</th>
                        <th>Instansi</th>
                        <th>Pegawai Tujuan</th>
                        <th>Tujuan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($permohonans as $permohonan)

                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="kode-kunjungan">
                                    {{ $permohonan->kode_kunjungan }}
                                </span>
                            </td>

                            <td>
                                <span class="nama-tamu">
                                    {{ $permohonan->nama_tamu }}
                                </span>
                            </td>

                            <td>{{ $permohonan->telepon }}</td>

                            <td>{{ $permohonan->instansi ?? '-' }}</td>

                            <td>
                                {{ $permohonan->pegawai->nama_lengkap ?? '-' }}
                            </td>

                            <td>{{ $permohonan->tujuan }}</td>

                            <td>
                                {{ $permohonan->tanggal_kunjungan
                                    ? $permohonan->tanggal_kunjungan->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>{{ $permohonan->waktu_kunjungan }}</td>

                            <!-- KOLOM STATUS -->
                            <td>
                                @if ($permohonan->status == 'Menunggu Konfirmasi')
                                    <span class="status status-menunggu">
                                        Menunggu Konfirmasi
                                    </span>

                                @elseif ($permohonan->status == 'Diterima')
                                    <span class="status status-diterima">
                                        Diterima
                                    </span>

                                @elseif ($permohonan->status == 'Ditolak')
                                    <span class="status status-ditolak">
                                        Ditolak
                                    </span>

                                @else
                                    <span class="status">
                                        {{ $permohonan->status }}
                                    </span>
                                @endif
                            </td>

                            <!-- KOLOM AKSI -->
                            <td>
                                <div class="aksi-container">

                                    <!-- TOMBOL DETAIL -->
                                    <a
                                        href="{{ route('admin.permohonan.show', $permohonan->id) }}"
                                        class="btn-aksi btn-detail"
                                    >
                                        Lihat Detail
                                    </a>

                                    @if ($permohonan->status == 'Menunggu Konfirmasi')

                                        <!-- TOMBOL TERIMA -->
                                        <form
                                            action="{{ route('admin.permohonan.update-status', $permohonan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menerima permohonan kunjungan ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Diterima"
                                            >

                                            <button
                                                type="submit"
                                                class="btn-aksi btn-terima"
                                            >
                                                Terima
                                            </button>
                                        </form>

                                        <!-- TOMBOL TOLAK -->
                                        <form
                                            action="{{ route('admin.permohonan.update-status', $permohonan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin menolak permohonan kunjungan ini?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Ditolak"
                                            >

                                            <button
                                                type="submit"
                                                class="btn-aksi btn-tolak"
                                            >
                                                Tolak
                                            </button>
                                        </form>

                                    @elseif ($permohonan->status == 'Diterima')

                                        <!-- UBAH STATUS DITERIMA MENJADI DITOLAK -->
                                        <form
                                            action="{{ route('admin.permohonan.update-status', $permohonan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin mengubah status menjadi Ditolak?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Ditolak"
                                            >

                                            <button
                                                type="submit"
                                                class="btn-aksi btn-tolak"
                                            >
                                                Ubah ke Tolak
                                            </button>
                                        </form>

                                    @elseif ($permohonan->status == 'Ditolak')

                                        <!-- UBAH STATUS DITOLAK MENJADI DITERIMA -->
                                        <form
                                            action="{{ route('admin.permohonan.update-status', $permohonan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah kamu yakin ingin mengubah status menjadi Diterima?')"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <input
                                                type="hidden"
                                                name="status"
                                                value="Diterima"
                                            >

                                            <button
                                                type="submit"
                                                class="btn-aksi btn-terima"
                                            >
                                                Ubah ke Terima
                                            </button>
                                        </form>

                                    @else

                                        <span>-</span>

                                    @endif

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="11" class="empty-data">
                                Belum ada permohonan kunjungan.
                            </td>
                        </tr>

                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection