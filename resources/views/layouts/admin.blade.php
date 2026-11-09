<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin') | Buku Tamu Digital</title>

    <!-- FONT POPPINS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        /* =========================================
           PENGATURAN DASAR
        ========================================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        html {
            height: 100%;
        }

        body {
            background: #F8C1C1;
            color: #35103F;
            min-height: 100vh;
            overflow: hidden;
        }

        /* =========================================
           LAYOUT UTAMA
        ========================================= */

        .layout {
            display: flex;
            align-items: flex-start;
            min-height: 100vh;
            height: 100vh;
            padding: 18px;
            gap: 0;
        }

        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            width: 245px;
            min-width: 245px;
            flex: 0 0 245px;

            height: calc(100vh - 36px);

            position: sticky;
            top: 18px;

            background: #8955ED;

            padding: 25px 15px 18px;

            display: flex;
            flex-direction: column;

            border-radius: 17px 0 0 17px;

            box-shadow: 0 5px 20px rgba(65, 25, 120, 0.12);

            overflow-y: auto;
            overflow-x: hidden;
        }

        /* =========================================
           LOGO SIDEBAR
        ========================================= */

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 8px 5px 22px;
            flex-shrink: 0;
        }

        .sidebar-logo img {
            width: 105px;
            height: 105px;

            object-fit: contain;

            background: white;
            border-radius: 50%;

            padding: 9px;

            border: 4px solid rgba(255,255,255,0.35);

            box-shadow: 0 5px 15px rgba(45, 10, 80, 0.20);

            margin-bottom: 13px;
        }

        .sidebar-logo h2 {
            color: white;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .sidebar-logo p {
            color: #F0E7FF;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 1.5px;
            margin-top: 4px;
        }

        /* =========================================
           PEMBATAS SIDEBAR
        ========================================= */

        .sidebar-divider {
            border: none;
            height: 1px;
            background: rgba(255,255,255,0.20);
            margin: 0 5px 22px;
            flex-shrink: 0;
        }

        .sidebar-heading {
            color: #E9D9FF;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            margin: 0 12px 12px;
            flex-shrink: 0;
        }

        /* =========================================
           MENU SIDEBAR
        ========================================= */

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 7px;
            flex-shrink: 0;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;

            text-decoration: none;

            color: #FFFFFF;

            padding: 12px 13px;

            font-size: 12px;
            font-weight: 500;

            border-radius: 9px;

            transition: all 0.25s ease;
        }

        .menu-icon {
            width: 21px;
            min-width: 21px;

            display: flex;
            justify-content: center;
            align-items: center;

            font-size: 17px;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.16);
            color: white;
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: #F34F85;
            color: white;

            font-weight: 600;

            box-shadow: 0 4px 12px rgba(90, 20, 100, 0.18);
        }

        /* =========================================
           FORM LOGOUT
        ========================================= */

        body .layout .sidebar form.logout-form {
            display: block !important;
            position: static !important;

            width: 100% !important;
            height: auto !important;

            min-height: 0 !important;
            max-height: none !important;

            margin: auto 0 0 0 !important;
            padding: 22px 0 0 0 !important;

            flex: 0 0 auto !important;

            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* =========================================
           TOMBOL LOGOUT
        ========================================= */

        body .layout .sidebar form.logout-form button[type="submit"] {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 9px !important;

            position: static !important;

            width: 100% !important;
            min-width: 100% !important;
            max-width: 100% !important;

            height: 43px !important;
            min-height: 43px !important;
            max-height: 43px !important;

            margin: 0 !important;
            padding: 0 13px !important;

            box-sizing: border-box !important;

            border: none !important;
            border-radius: 9px !important;

            background: #FFFFFF !important;
            color: #8955ED !important;

            cursor: pointer !important;

            font-family: 'Poppins', sans-serif !important;
            font-size: 12px !important;
            font-weight: 600 !important;

            line-height: 43px !important;
            text-align: center !important;

            text-transform: none !important;
            letter-spacing: normal !important;

            box-shadow: 0 3px 10px rgba(45,10,80,0.12) !important;
            transform: none !important;

            transition: background 0.2s, color 0.2s !important;
        }

        body .layout .sidebar form.logout-form button[type="submit"]:hover {
            background: #F34F85 !important;
            color: white !important;
        }

        /* =========================================
           AREA KONTEN UTAMA
        ========================================= */

        .main-area {
            flex: 1;
            min-width: 0;

            display: flex;
            flex-direction: column;

            /* Panel utama tetap di tempat */
            position: sticky;
            top: 18px;

            height: calc(100vh - 36px);
            min-height: 0;

            background: #F7F5FA;

            border-radius: 0 17px 17px 0;

            overflow: hidden;

            box-shadow: 0 5px 20px rgba(65,25,120,0.08);
        }

        /* =========================================
           NAVBAR
        ========================================= */

        .navbar {
            height: 72px;
            min-height: 72px;
            flex-shrink: 0;

            background: #FFFFFF;

            color: #35103F;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 0 30px;

            border-bottom: 1px solid #F0ECF5;

            position: relative;
            z-index: 10;
        }

        .navbar-title h2 {
            font-size: 18px;
            font-weight: 700;
            color: #35103F;
        }

        .navbar-title p {
            font-size: 10px;
            color: #89818F;
            margin-top: 2px;
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-avatar {
            width: 37px;
            height: 37px;

            background: #F3E9FF;
            color: #8955ED;

            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 14px;
            font-weight: 700;
        }

        .admin-name {
            font-size: 12px;
            font-weight: 600;
            color: #45364D;
        }

        .admin-role {
            display: block;
            font-size: 10px;
            color: #99909F;
            font-weight: 400;
        }

        /* =========================================
           KONTEN HALAMAN
           SCROLL HANYA DI BAGIAN INI
        ========================================= */

        .content {
            flex: 1;
            min-width: 0;
            min-height: 0;

            padding: 28px;

            background: #F7F5FA;

            overflow-y: auto;
            overflow-x: hidden;

            overscroll-behavior: contain;
        }

        /* Tampilan scrollbar */

        .content::-webkit-scrollbar,
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .content::-webkit-scrollbar-thumb {
            background: #D5C5EC;
            border-radius: 10px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.35);
            border-radius: 10px;
        }

        /* =========================================
           RESPONSIVE / TABLET
        ========================================= */

        @media (max-width: 900px) {

            .sidebar {
                width: 215px;
                min-width: 215px;
                flex: 0 0 215px;
            }

            .sidebar a {
                font-size: 11px;
                padding: 11px 10px;
            }

            .content {
                padding: 22px;
            }

            .navbar {
                padding: 0 22px;
            }
        }

        /* =========================================
           RESPONSIVE / HP
        ========================================= */

        @media (max-width: 700px) {

            body {
                overflow: auto;
            }

            .layout {
                flex-direction: column;
                align-items: stretch;

                height: auto;
                min-height: 100vh;

                padding: 10px;
                gap: 10px;
            }

            .sidebar {
                width: 100%;
                min-width: 100%;
                flex: 0 0 auto;

                height: auto;

                position: relative;
                top: 0;

                border-radius: 14px;

                padding: 15px;

                overflow: visible;
            }

            .sidebar-logo {
                padding: 5px 5px 15px;
            }

            .sidebar-logo img {
                width: 75px;
                height: 75px;
            }

            .sidebar-logo h2 {
                font-size: 14px;
            }

            .sidebar-heading {
                margin-top: 0;
            }

            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 7px;
            }

            .sidebar a {
                padding: 10px 8px;
                font-size: 10px;
                gap: 7px;
            }

            .menu-icon {
                font-size: 15px;
                width: 17px;
                min-width: 17px;
            }

            body .layout .sidebar form.logout-form {
                width: 100% !important;
                margin: 12px 0 0 0 !important;
                padding: 12px 0 0 0 !important;
            }

            .main-area {
                width: 100%;

                height: auto;
                min-height: 100vh;

                position: relative;
                top: 0;

                border-radius: 14px;

                overflow: visible;
            }

            .navbar {
                height: 65px;
                min-height: 65px;
                padding: 0 15px;
            }

            .navbar-title h2 {
                font-size: 15px;
            }

            .navbar-title p {
                font-size: 9px;
            }

            .admin-info {
                gap: 7px;
            }

            .admin-avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .admin-name {
                font-size: 10px;
            }

            .admin-role {
                font-size: 9px;
            }

            .content {
                padding: 16px;
                width: 100%;

                overflow: visible;
            }
        }

        /* =========================================
           RESPONSIVE HP KECIL
        ========================================= */

        @media (max-width: 380px) {

            .sidebar-menu {
                grid-template-columns: 1fr;
            }

            .sidebar a {
                font-size: 11px;
            }

            .navbar {
                padding: 0 10px;
            }

            .content {
                padding: 12px;
            }
        }

    </style>

    @stack('styles')

</head>

<body>

    <!-- =========================================
         LAYOUT UTAMA
    ========================================= -->

    <div class="layout">

        <!-- =====================================
             SIDEBAR / MENU ADMIN
        ====================================== -->

        <aside class="sidebar">

            <!-- LOGO DAN IDENTITAS APLIKASI -->

            <div class="sidebar-logo">

                <img src="{{ asset('images/logo cirebon.png') }}"
                     alt="Logo Cirebon">

                <h2>BUKU TAMU DIGITAL</h2>

                <p>ADMIN PANEL</p>

            </div>

            <hr class="sidebar-divider">

            <p class="sidebar-heading">MENU UTAMA</p>

            <!-- DAFTAR MENU ADMIN -->

            <nav class="sidebar-menu">

                <!-- MENU DASHBOARD -->

                <a href="{{ route('admin.dashboard') }}"
                   class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                    <span class="menu-icon">⌂</span>
                    <span>Dashboard</span>

                </a>

                <!-- MENU DATA PEGAWAI -->

                <a href="{{ route('admin.pegawai.index') }}"
                   class="{{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">

                    <span class="menu-icon">♙</span>
                    <span>Data Pegawai</span>

                </a>

                <!-- MENU PERMOHONAN KUNJUNGAN -->

                <a href="{{ route('admin.permohonan.index') }}"
                   class="{{ request()->routeIs('admin.permohonan.*') ? 'active' : '' }}">

                    <span class="menu-icon">▤</span>
                    <span>Permohonan Kunjungan</span>

                </a>

                <!-- MENU RIWAYAT KUNJUNGAN -->

                <a href="{{ route('admin.riwayat.index') }}"
                   class="{{ request()->routeIs('admin.riwayat.*') ? 'active' : '' }}">

                    <span class="menu-icon">◷</span>
                    <span>Riwayat Kunjungan</span>

                </a>

                <!-- MENU LAPORAN -->

                <a href="{{ route('admin.laporan.index') }}"
                   class="{{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">

                    <span class="menu-icon">▧</span>
                    <span>Laporan</span>

                </a>

            </nav>

            <!-- TOMBOL LOGOUT -->

            <form action="{{ route('admin.logout') }}"
                  method="POST"
                  class="logout-form">

                @csrf

                <button type="submit">
                    <span>⇥</span>
                    Logout
                </button>

            </form>

        </aside>

        <!-- =====================================
             AREA UTAMA ADMIN
        ====================================== -->

        <div class="main-area">

            <!-- NAVBAR -->

            <header class="navbar">

                <div class="navbar-title">

                    <h2>@yield('page-heading', 'Dashboard')</h2>

                    <p>Buku Tamu Digital</p>

                </div>

                <div class="admin-info">

                    <div class="admin-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>

                        <span class="admin-name">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="admin-role">
                            Administrator
                        </span>

                    </div>

                </div>

            </header>

            <!-- ISI HALAMAN -->

            <main class="content">

                @yield('content')

            </main>

        </div>

    </div>

    <!-- JAVASCRIPT TAMBAHAN -->

    @stack('scripts')

</body>
</html>