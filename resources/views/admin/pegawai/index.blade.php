@extends('layouts.admin')

@section('title', 'Data Pegawai')

@section('page-heading', 'Data Pegawai')

@push('styles')
<style>

    /* =========================================
       KONTEN DATA PEGAWAI
    ========================================= */

    .container {
        width: 100%;
        max-width: 1200px;
        margin: auto;
    }

    /* =========================================
       JUDUL HALAMAN
    ========================================= */

    .page-title {
        color: #35103F;
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 700;
    }

    .page-description {
        color: #89818F;
        margin: 0 0 22px;
        font-size: 12px;
        line-height: 1.8;
    }

    /* =========================================
       KARTU TABEL
    ========================================= */

    .card {
        background: #FFFFFF;
        padding: 25px;
        border-radius: 14px;

        box-shadow: 0 4px 15px rgba(53,16,63,0.05);

        border: 1px solid #F0ECF5;

        overflow-x: auto;
    }

    /* =========================================
       BAGIAN ATAS TABEL
    ========================================= */

    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }

    .table-header-info {
        color: #89818F;
        font-size: 11px;
    }

    /* =========================================
       TOMBOL
    ========================================= */

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;

        border: none;
        padding: 9px 13px;

        border-radius: 8px;

        text-decoration: none;

        font-size: 11px;
        font-weight: 600;

        cursor: pointer;

        margin: 2px;

        font-family: 'Poppins', sans-serif;

        transition: all 0.2s ease;
    }

    .btn-tambah {
        background: #8955ED;
        color: white;

        margin-bottom: 0;

        font-size: 12px;

        box-shadow: 0 3px 10px rgba(137,85,237,0.18);
    }

    .btn-tambah:hover {
        background: #7540D4;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #FFF0D9;
        color: #C98725;
    }

    .btn-edit:hover {
        background: #FFE4B9;
    }

    .btn-status {
        background: #FFE6ED;
        color: #D94170;
    }

    .btn-status:hover {
        background: #F34F85;
        color: white;
    }

    /* =========================================
       PESAN BERHASIL
    ========================================= */

    .success {
        background: #E7F8EE;
        color: #27965B;

        padding: 13px 15px;

        border-radius: 9px;

        margin-bottom: 18px;

        font-size: 12px;
        border: 1px solid #C9EED8;
    }

    /* =========================================
       PESAN ERROR
    ========================================= */

    .error {
        background: #FFEAF0;
        color: #D94170;

        padding: 13px 15px;

        border-radius: 9px;

        margin-bottom: 18px;

        font-size: 12px;
        border: 1px solid #F8D0DC;
    }

    /* =========================================
       TABEL
    ========================================= */

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    th, td {
        padding: 14px 13px;

        border-bottom: 1px solid #F0ECF5;

        text-align: left;
        vertical-align: middle;

        font-size: 11px;
    }

    th {
        background: #F4EEFF;
        color: #7540D4;

        font-weight: 600;

        white-space: nowrap;
    }

    th:first-child {
        border-radius: 8px 0 0 8px;
    }

    th:last-child {
        border-radius: 0 8px 8px 0;
    }

    td {
        color: #554B5D;
    }

    tbody tr {
        transition: background 0.2s ease;
    }

    tbody tr:hover {
        background: #FAF7FF;
    }

    /* =========================================
       KOLOM AKSI
    ========================================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 4px;
        flex-wrap: wrap;
    }

    .action-buttons form {
        display: inline;
        margin: 0;
    }

    /* =========================================
       DATA KOSONG
    ========================================= */

    .empty {
        text-align: center;
        padding: 35px 20px;

        color: #89818F;

        line-height: 1.8;
        font-size: 12px;
    }

    /* =========================================
       LABEL STATUS
    ========================================= */

    .status {
        display: inline-block;

        padding: 6px 10px;

        border-radius: 20px;

        background: #F0E8FF;
        color: #8955ED;

        font-size: 10px;
        font-weight: 600;

        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-tersedia {
        background: #E7F8EE;
        color: #27965B;
    }

    .status-tidak {
        background: #FFEAF0;
        color: #D94170;
    }

    /* =========================================
       INFORMASI / CATATAN
    ========================================= */

    .info {
        color: #89818F;

        font-size: 11px;
        line-height: 1.8;

        margin-top: 18px;

        padding: 13px 15px;

        background: #F8F4FF;

        border-radius: 9px;

        border-left: 3px solid #8955ED;
    }

    /* =========================================
       TAMPILAN TABLET
    ========================================= */

    @media (max-width: 900px) {

        .card {
            padding: 20px;
        }

    }

    /* =========================================
       TAMPILAN HP
    ========================================= */

    @media (max-width: 600px) {

        .card {
            padding: 16px;
        }

        .page-title {
            font-size: 21px;
        }

        .page-description {
            font-size: 11px;
        }

        .table-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-tambah {
            width: 100%;
        }

    }

</style>
@endpush


@section('content')

<div class="container">

    <!-- =========================================
         KONTEN DATA PEGAWAI
    ========================================= -->

    <div class="card">


        <!-- =====================================
             JUDUL HALAMAN
        ====================================== -->

        <h2 class="page-title">Data Pegawai</h2>

        <p class="page-description">

            Kelola data pegawai dan informasi ketersediaan
            untuk pelayanan tamu.

        </p>


        <!-- =====================================
             PESAN BERHASIL
        ====================================== -->

        @if (session('success'))

            <div class="success">

                ✓ {{ session('success') }}

            </div>

        @endif


        <!-- =====================================
             PESAN ERROR
        ====================================== -->

        @if (session('error'))

            <div class="error">

                {{ session('error') }}

            </div>

        @endif


        <!-- =====================================
             PESAN VALIDASI
        ====================================== -->

        @if ($errors->any())

            <div class="error">

                <strong>Terjadi kesalahan:</strong>

                <ul style="margin: 8px 0 0 20px;">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <!-- =====================================
             BAGIAN ATAS TABEL
        ====================================== -->

        <div class="table-header">


            <div class="table-header-info">

                Berikut merupakan daftar pegawai yang terdaftar
                dalam sistem.

            </div>


            <!-- TOMBOL TAMBAH -->

            <a
                href="{{ route('admin.pegawai.create') }}"
                class="btn btn-tambah"
            >

                <span>+</span>

                Tambah Pegawai

            </a>


        </div>


        <!-- =====================================
             TABEL PEGAWAI
        ====================================== -->

        <table>

            <thead>

                <tr>

                    <th>No.</th>

                    <th>Nama Lengkap</th>

                    <th>Jabatan</th>

                    <th>Bidang/Unit Kerja</th>

                    <th>Status Kepegawaian</th>

                    <th>Status Ketersediaan</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse ($pegawais as $pegawai)

                    <tr>

                        <td>

                            {{ $loop->iteration }}

                        </td>


                        <td>

                            <strong style="color: #35103F;">

                                {{ $pegawai->nama_lengkap }}

                            </strong>

                        </td>


                        <td>

                            {{ $pegawai->jabatan ?? '-' }}

                        </td>


                        <td>

                            {{ $pegawai->bidang }}

                        </td>


                        <td>

                            {{ $pegawai->status_kepegawaian ?? '-' }}

                        </td>


                        <td>

                            @php

                                $statusPegawai = $pegawai->status_ketersediaan ?? 'belum_diatur';

                            @endphp


                            <span class="status
                                {{ $statusPegawai === 'tersedia' ? 'status-tersedia' : '' }}
                                {{ $statusPegawai === 'tidak_tersedia' ? 'status-tidak' : '' }}">

                                {{ str_replace('_', ' ', $statusPegawai) }}

                            </span>

                        </td>


                        <td>

                            <div class="action-buttons">


                                <!-- TOMBOL EDIT -->

                                <a
                                    href="{{ route('admin.pegawai.edit', $pegawai->id) }}"
                                    class="btn btn-edit"
                                >

                                    Edit

                                </a>


                                <!-- TOMBOL UBAH STATUS -->

                                @if ($pegawai->status_ketersediaan !== 'tidak_tersedia')

                                    <form
                                        action="{{ route('admin.pegawai.destroy', $pegawai->id) }}"
                                        method="POST"

                                        onsubmit="return confirm('Apakah kamu yakin ingin mengubah status pegawai ini menjadi tidak tersedia?')"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="btn btn-status"
                                        >

                                            Ubah Status

                                        </button>

                                    </form>

                                @endif


                            </div>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="7" class="empty">

                            Belum ada data pegawai.

                            <br>

                            Silakan klik tombol

                            <strong>Tambah Pegawai</strong>

                            untuk memasukkan data.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>


        <!-- =====================================
             CATATAN DATA PEGAWAI
        ====================================== -->

        <p class="info">

            <strong>Informasi:</strong>

            Tombol Ubah Status mengubah ketersediaan pegawai
            menjadi tidak tersedia.

            Data pegawai tidak dihapus dari database.

        </p>


    </div>

</div>

@endsection