@extends('layouts.admin')

@section('title', 'Dashboard Admin | Buku Tamu Digital')

@section('page-heading', 'Dashboard')

@push('styles')
<style>

    /* =========================================
       PENGATURAN DASHBOARD
    ========================================= */

    .content {
        flex: 1;
        min-width: 0;
        padding: 30px;
        background: #F7F5FA;
        color: #35103F;
    }

    /* =========================================
       JUDUL DASHBOARD
    ========================================= */

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 28px;
    }

    .dashboard-header h1 {
        color: #35103F;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .welcome {
        color: #89818F;
        font-size: 12px;
        font-weight: 400;
        line-height: 1.7;
    }

    .dashboard-date {
        background: #FFFFFF;
        color: #8955ED;
        padding: 10px 15px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 500;
        box-shadow: 0 3px 12px rgba(53,16,63,0.04);
    }

    /* =========================================
       JUDUL BAGIAN
    ========================================= */

    .section-title {
        color: #35103F;
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    /* =========================================
       KARTU STATISTIK
    ========================================= */

    .cards {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 17px;
        margin-bottom: 28px;
    }

    .card {
        background: #FFFFFF;
        padding: 20px;
        border-radius: 13px;

        box-shadow: 0 4px 15px rgba(53,16,63,0.05);

        border: 1px solid #F0ECF5;

        transition: transform 0.25s ease,
                    box-shadow 0.25s ease;

        min-width: 0;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 7px 20px rgba(53,16,63,0.09);
    }

    /* =========================================
       BAGIAN ATAS KARTU
    ========================================= */

    .card-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        gap: 8px;
    }

    .card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;

        display: flex;
        justify-content: center;
        align-items: center;

        font-size: 20px;
        font-weight: 600;
    }

    .icon-total {
        background: #F0E8FF;
        color: #8955ED;
    }

    .icon-menunggu {
        background: #FFF0D9;
        color: #E99A2D;
    }

    .icon-diterima {
        background: #E2F7EC;
        color: #32A56A;
    }

    .icon-ditolak {
        background: #FFE6ED;
        color: #F34F85;
    }

    .card-label {
        color: #89818F;
        font-size: 11px;
        font-weight: 500;
        line-height: 1.5;
    }

    /* =========================================
       ANGKA STATISTIK
    ========================================= */

    .card p {
        color: #35103F;
        font-size: 29px;
        font-weight: 700;
        line-height: 1.3;
        margin-bottom: 5px;
    }

    .card-description {
        color: #AAA3AF;
        font-size: 10px;
        font-weight: 400;
    }

    /* =========================================
       PANEL INFORMASI DASHBOARD
    ========================================= */

    .dashboard-panel {
        background: #FFFFFF;
        padding: 23px;
        border-radius: 13px;

        border: 1px solid #F0ECF5;

        box-shadow: 0 4px 15px rgba(53,16,63,0.04);
    }

    .panel-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }

    .panel-heading h3 {
        color: #35103F;
        font-size: 14px;
        font-weight: 600;
    }

    .panel-icon {
        width: 34px;
        height: 34px;
        background: #F0E8FF;
        color: #8955ED;
        border-radius: 9px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 17px;
    }

    .dashboard-panel p {
        color: #89818F;
        font-size: 12px;
        line-height: 1.8;
    }

    /* =========================================
       INFORMASI STATUS KUNJUNGAN
    ========================================= */

    .status-information {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        margin-top: 20px;
    }

    .status-item {
        padding: 13px;
        border-radius: 9px;
        font-size: 11px;
        font-weight: 500;
        text-align: center;
    }

    .status-waiting {
        background: #FFF5E5;
        color: #C98725;
    }

    .status-accepted {
        background: #E7F8EE;
        color: #27965B;
    }

    .status-rejected {
        background: #FFEAF0;
        color: #D94170;
    }

    /* =========================================
       TAMPILAN RESPONSIF TABLET
    ========================================= */

    @media (max-width: 1100px) {

        .cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    /* =========================================
       TAMPILAN RESPONSIF HP
    ========================================= */

    @media (max-width: 700px) {

        .content {
            padding: 18px;
        }

        .dashboard-header h1 {
            font-size: 20px;
        }

        .welcome {
            font-size: 11px;
        }

        .dashboard-date {
            font-size: 10px;
        }

        .cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 11px;
        }

        .card {
            padding: 14px;
        }

        .card p {
            font-size: 23px;
        }

        .card-label {
            font-size: 10px;
        }

        .card-icon {
            width: 34px;
            height: 34px;
            font-size: 17px;
        }

        .dashboard-panel {
            padding: 16px;
        }

        .status-information {
            grid-template-columns: 1fr;
        }

    }

    /* =========================================
       TAMPILAN HP KECIL
    ========================================= */

    @media (max-width: 380px) {

        .cards {
            grid-template-columns: 1fr;
        }

        .dashboard-header {
            align-items: flex-start;
        }

    }

</style>
@endpush


@section('content')

    <!-- =========================================
         KONTEN DASHBOARD
    ========================================= -->

    <main class="content">


        <!-- =====================================
             JUDUL DASHBOARD
        ====================================== -->

        <div class="dashboard-header">

            <div>

                <h1>Dashboard Admin</h1>

                <!-- UCAPAN SELAMAT DATANG -->

                <p class="welcome">

                    Selamat datang, {{ Auth::user()->name }}.

                    Silakan kelola data Buku Tamu Digital.

                </p>

            </div>


            <!-- INFORMASI TANGGAL -->

            <div class="dashboard-date">

                <span>✦</span>

                Panel Administrator

            </div>

        </div>


        <!-- =====================================
             KARTU STATISTIK
        ====================================== -->

        <h3 class="section-title">Ringkasan Kunjungan</h3>


        <div class="cards">


            <!-- =================================
                 TOTAL PERMOHONAN
            ================================== -->

            <div class="card">

                <div class="card-top">

                    <div class="card-label">

                        Total Permohonan

                    </div>

                    <div class="card-icon icon-total">

                        ▤

                    </div>

                </div>

                <p>{{ $totalPermohonan }}</p>

                <span class="card-description">

                    Seluruh data permohonan

                </span>

            </div>


            <!-- =================================
                 MENUNGGU KONFIRMASI
            ================================== -->

            <div class="card">

                <div class="card-top">

                    <div class="card-label">

                        Menunggu Konfirmasi

                    </div>

                    <div class="card-icon icon-menunggu">

                        ◷

                    </div>

                </div>

                <p>{{ $menunggu }}</p>

                <span class="card-description">

                    Permohonan belum diproses

                </span>

            </div>


            <!-- =================================
                 KUNJUNGAN DITERIMA
            ================================== -->

            <div class="card">

                <div class="card-top">

                    <div class="card-label">

                        Kunjungan Diterima

                    </div>

                    <div class="card-icon icon-diterima">

                        ✓

                    </div>

                </div>

                <p>{{ $diterima }}</p>

                <span class="card-description">

                    Permohonan telah diterima

                </span>

            </div>


            <!-- =================================
                 KUNJUNGAN DITOLAK
            ================================== -->

            <div class="card">

                <div class="card-top">

                    <div class="card-label">

                        Kunjungan Ditolak

                    </div>

                    <div class="card-icon icon-ditolak">

                        ×

                    </div>

                </div>

                <p>{{ $ditolak }}</p>

                <span class="card-description">

                    Permohonan tidak diterima

                </span>

            </div>


        </div>


        <!-- =====================================
             PANEL INFORMASI DASHBOARD
        ====================================== -->

        <div class="dashboard-panel">


            <div class="panel-heading">

                <div class="panel-icon">

                    ♧

                </div>

                <h3>Informasi Buku Tamu Digital</h3>

            </div>


            <p>

                Halaman dashboard digunakan untuk memantau ringkasan
                permohonan kunjungan tamu pada Dinas Kearsipan dan
                Perpustakaan Kabupaten Cirebon.

                Admin dapat melihat jumlah seluruh permohonan,
                permohonan yang menunggu konfirmasi, kunjungan yang
                diterima, dan kunjungan yang ditolak.

            </p>


            <!-- INFORMASI STATUS -->

            <div class="status-information">


                <div class="status-item status-waiting">

                    Menunggu Konfirmasi

                </div>


                <div class="status-item status-accepted">

                    Diterima

                </div>


                <div class="status-item status-rejected">

                    Ditolak

                </div>


            </div>


        </div>


    </main>

@endsection