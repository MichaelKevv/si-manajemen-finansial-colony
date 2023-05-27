<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('assets/img/favicon.png') }}">
    <title>
        SI Manajemen Finansial Colony
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('assets/css/nucleo-icons.css" rel="stylesheet') }} " />
    <link href="{{ url('assets/css/nucleo-svg.css" rel="stylesheet') }} " />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ url('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-100">
    {{-- role 1 : Admin
    role 2 : Kasir
    role 3 : Kurir --}}
    <?php if(Session::get('pegawai')->role == 1): ?>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ url('dashboard') }}">
                <img src="{{ url('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">SI Manajemen Colony</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Main</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-dashboard {{ request()->is('dashboard') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}" href="{{ url('pegawai') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user {{ request()->is('pegawai*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pegawai</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengguna*') ? 'active' : '' }}" href="{{ url('pengguna') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-users {{ request()->is('pengguna*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples"
                        class="nav-link {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? 'active' : '' }}"
                        aria-controls="pagesExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-box {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Barang</span>
                    </a>
                    <div class="collapse {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? 'show' : '' }}"
                        id="pagesExamples">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}"
                                    href="{{ url('barang') }}">
                                    <span class="nav-link-text ms-1">Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}"
                                    href="{{ url('kategori') }}">
                                    <span class="nav-link-text ms-1">Kategori Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('stok*') ? 'active' : '' }}"
                                    href="{{ url('stok') }}">
                                    <span class="nav-link-text ms-1">Stok Barang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('gudang*') ? 'active' : '' }}" href="{{ url('gudang') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-warehouse {{ request()->is('gudang*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gudang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('outlet*') ? 'active' : '' }}" href="{{ url('outlet') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-store {{ request()->is('outlet*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Outlet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mutasi*') ? 'active' : '' }}" href="{{ url('mutasi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck-loading {{ request()->is('mutasi*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mutasi Stok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}"
                        href="{{ url('pengiriman') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck-moving {{ request()->is('pengiriman*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengiriman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}"
                        href="{{ url('supplier') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-parachute-box {{ request()->is('supplier*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Supplier</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}"
                        href="{{ url('transaksi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-exchange-alt {{ request()->is('transaksi*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Transaksi</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ url('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-id-card {{ request()->is('profile*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('password*') ? 'active' : '' }}"
                        href="{{ url('password') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-key {{ request()->is('password*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ganti Password</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    <?php elseif(Session::get('pegawai')->role == 2): ?>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ url('dashboard') }}">
                <img src="{{ url('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">SI Manajemen Colony</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Main</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ url('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-dashboard {{ request()->is('dashboard') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples"
                        class="nav-link {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? 'active' : '' }}"
                        aria-controls="pagesExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-box {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Barang</span>
                    </a>
                    <div class="collapse {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? 'show' : '' }}"
                        id="pagesExamples">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}"
                                    href="{{ url('barang') }}">
                                    <span class="nav-link-text ms-1">Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}"
                                    href="{{ url('kategori') }}">
                                    <span class="nav-link-text ms-1">Kategori Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('stok*') ? 'active' : '' }}"
                                    href="{{ url('stok') }}">
                                    <span class="nav-link-text ms-1">Stok Barang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('gudang*') ? 'active' : '' }}" href="{{ url('gudang') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-warehouse {{ request()->is('gudang*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gudang</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('outlet*') ? 'active' : '' }}" href="{{ url('outlet') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-store {{ request()->is('outlet*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Outlet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mutasi*') ? 'active' : '' }}" href="{{ url('mutasi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck-loading {{ request()->is('mutasi*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mutasi Stok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}"
                        href="{{ url('pengiriman') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck-moving {{ request()->is('pengiriman*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengiriman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}"
                        href="{{ url('transaksi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-exchange-alt {{ request()->is('transaksi*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Transaksi</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}" href="{{ url('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-id-card {{ request()->is('profile*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('password*') ? 'active' : '' }}"
                        href="{{ url('password') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-key {{ request()->is('password*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ganti Password</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    <?php elseif(Session::get('pegawai')->role == 3): ?>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{ url('dashboard') }}">
                <img src="{{ url('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">SI Manajemen Colony</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Main</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ url('dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-dashboard {{ request()->is('dashboard') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples"
                        class="nav-link {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? 'active' : '' }}"
                        aria-controls="pagesExamples" role="button" aria-expanded="false">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-box {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Barang</span>
                    </a>
                    <div class="collapse {{ request()->is('kategori*') || request()->is('barang*') || request()->is('stok*') ? 'show' : '' }}"
                        id="pagesExamples">
                        <ul class="nav ms-4 ps-3">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('barang*') ? 'active' : '' }}"
                                    href="{{ url('barang') }}">
                                    <span class="nav-link-text ms-1">Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}"
                                    href="{{ url('kategori') }}">
                                    <span class="nav-link-text ms-1">Kategori Barang</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('stok*') ? 'active' : '' }}"
                                    href="{{ url('stok') }}">
                                    <span class="nav-link-text ms-1">Stok Barang</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->is('gudang*') ? 'active' : '' }}" href="{{ url('gudang') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-warehouse {{ request()->is('gudang*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Gudang</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('outlet*') ? 'active' : '' }}" href="{{ url('outlet') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-store {{ request()->is('outlet*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Outlet</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('mutasi*') ? 'active' : '' }}" href="{{ url('mutasi') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck-loading {{ request()->is('mutasi*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mutasi Stok</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengiriman*') ? 'active' : '' }}"
                        href="{{ url('pengiriman') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-truck-moving {{ request()->is('pengiriman*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pengiriman</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('supplier*') ? 'active' : '' }}"
                        href="{{ url('supplier') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-parachute-box {{ request()->is('supplier*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Supplier</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('profile*') ? 'active' : '' }}"
                        href="{{ url('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-id-card {{ request()->is('profile*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('password*') ? 'active' : '' }}"
                        href="{{ url('password') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-key {{ request()->is('password*') ? '' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Ganti Password</span>
                    </a>
                </li>
            </ul>
        </div>

    </aside>
    <?php endif?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky"
            id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="{{ url('dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" style="text-transform: capitalize"
                            aria-current="page">
                            <?php if(count(request()->segments()) > 1) : ?>
                            <a class="opacity-5 text-dark" href="{{ url()->previous() }}">
                                {{ request()->is('dashboard') ? '' : request()->segment(1) }}
                            </a>
                            <?php else: ?>
                            {{ request()->is('dashboard') ? '' : request()->segment(1) }}
                            <?php endif ?>

                        </li>
                        <?php if(count(request()->segments()) > 1): ?>
                        <li class="breadcrumb-item text-sm text-dark active" style="text-transform: capitalize"
                            aria-current="page">
                            {{ request()->is('dashboard') ? '' : request()->segment(2) }}
                        </li>
                        <?php endif ?>
                    </ol>
                    <h6 class="font-weight-bolder mb-0" style="text-transform: capitalize">
                        {{ last(request()->segments()) }}</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        {{-- <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div> --}}
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">{{ Session::get('pegawai')->nama }}</span>
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="{{ url('/logout') }}">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <i class="fas fa-sign-out-alt cursor-pointer me-3"></i>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="text-sm font-weight-normal mb-1">
                                                    <span class="font-weight-bold">Logout</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @yield('content')
            <footer class="footer pt-3">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="copyright text-center text-sm text-muted text-lg-start">
                                © 2023,
                                made with <i class="fa fa-heart"></i> by Michael Kevin Adinata
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                        target="_blank">Creative Tim</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                        target="_blank">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                        target="_blank">Blog</a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                        target="_blank">License</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!--   Core JS Files   -->
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    @stack('custom-scripts')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ url('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
</body>

</html>
