<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Move POS</title>

    <link rel="stylesheet" href="{{asset('css/main/app.css')}}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('images/logo/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('images/logo/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('images/logo/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('images/logo/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('images/logo/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('images/logo/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('images/logo/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/logo/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/logo/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('images/logo/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/logo/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('images/logo/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/logo/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/logo/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#435EBE">
    <meta name="msapplication-TileImage" content="{{asset('images/logo/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#435EBE">

    <link rel="stylesheet" href="{{asset('css/shared/iconly.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/simple-datatables.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/toastify.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/sweetalert2.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/form-element-select.css')}}">
    @livewireStyles()

    <style>
        .scroll{
            max-height: 760px;
            max-width: 100%;
            overflow-y:auto;
        }

        /* ===== Scrollbar CSS ===== */
        /* Firefox */
        .scroll {
            scrollbar-width: thin;
            scrollbar-color: #435beb #ffffff;
        }

        /* Chrome, Edge, and Safari */
        .scroll::-webkit-scrollbar {
            width: 11px;
        }

        /* *::-webkit-scrollbar-track {
            background: #ffffff;
        } */

        .scroll::-webkit-scrollbar-thumb {
            background-color: #435beb;
            border-radius: 7px;
            border: 2px solid #ffffff;
        }

        .ribbon.ribbon-end .ribbon-label{
            border-top-left-radius: .475rem;
            border-bottom-left-radius: .475rem;
        }

        .ribbon .ribbon-label{
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 5px 10px;
            position: absolute;
            z-index: 1;
            background-color: rgba(0, 162, 255, 0.533);
            box-shadow: 0 -1px 5px 0 rgb(0, 0, 0 / 10%);
            color: #fff;
            top: 50%;
            right: 0;
            transform: translateX(5px) translateY(-450%);
        }


        .btn-cart{
            border-top-left-radius: 0px !important;
            border-top-right-radius: 0px !important;
        }
    </style>

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            {{-- <div class="logo"> --}}
                <a href="#">
                    <p class="fs-4 mt-4">Move POS</p>
                </a>
            {{-- </div> --}}
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                    <label class="form-check-label" ></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
            </div>
            <div class="sidebar-toggler x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            {{-- <li class="sidebar-title">Menu</li> --}}

            <li class="sidebar-item @yield('home')">
                <a href="index.html" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="sidebar-item @yield('transaksi')">
                <a href="{{URL::to('/transaksi')}}" class='sidebar-link'>
                    <i class="bi bi-basket3-fill"></i>
                    <span>Transaksi</span>
                </a>
            </li>

            <li class="sidebar-item has-sub @yield('produk')">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-bag-fill"></i>
                    <span>Produk</span>
                </a>
                <ul class="submenu @yield('produk')">
                    <li class="submenu-item @yield('kategori-produk')">
                        <a href="{{URL::to('/produk/kategori-produk')}}">Kategori Produk</a>
                    </li>
                    <li class="submenu-item @yield('data-produk')">
                        <a href="{{URL::to('/produk/data-produk')}}">Data Produk</a>
                    </li>
                    <li class="submenu-item @yield('pembelian-produk')">
                        <a href="component-badge.html">Pembelian Produk</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub @yield('laporan')">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-bar-chart-line-fill"></i>
                    <span>Laporan</span>
                </a>
                <ul class="submenu @yield('laporan')">
                    <li class="submenu-item @yield('laporan-pemasukan')">
                        <a href="{{URL::to('/laporan/keuangan')}}">Keuangan</a>
                    </li>
                    <li class="submenu-item @yield('laporan-pengeluaran')">
                        <a href="{{URL::to('/laporan/produk')}}">Produk</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item @yield('diskon')">
                <a href="{{URL::to('/diskon')}}" class='sidebar-link'>
                    <i class="bi bi-percent"></i>
                    <span>Voucher Diskon</span>
                </a>
            </li>

            <li class="sidebar-item has-sub @yield('pegawai')">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-people-fill"></i>
                    <span>Pegawai</span>
                </a>
                <ul class="submenu @yield('pegawai')">
                    <li class="submenu-item @yield('data-pegawai')">
                        <a href="component-alert.html">Data Pegawai</a>
                    </li>
                    <li class="submenu-item @yield('akun-pegawai')">
                        <a href="component-badge.html">Akun Pegawai</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub @yield('pengaturan')">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-gear-fill"></i>
                    <span>Pengaturan</span>
                </a>
                <ul class="submenu @yield('pengaturan')">
                    <li class="submenu-item @yield('pengaturan-akun')">
                        <a href="{{URL::to('/pengaturan/pengaturan-akun')}}">Pengaturan Akun</a>
                    </li>
                    <li class="submenu-item @yield('pengaturan-aplikasi')">
                        <a href="{{URL::to('/pengaturan/pengaturan-aplikasi')}}">Pengaturan Aplikasi</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            {{-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bi bi-bell bi-sub fs-4'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Notifications</h6>
                                        </li>
                                        <li><a class="dropdown-item">No notification available</a></li>
                                    </ul>
                                </li>
                            </ul> --}}
                            <div class="dropdown navbar-nav ms-auto mb-2 mb-lg-0">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{Auth::user()->name}}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{Auth::user()->user_roles->role_name}}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{asset('images/faces/1.jpg')}}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{Auth::user()->name}}!</h6>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                        <i class="icon-mid bi bi-person me-2"></i> My
                                            Profile</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('logout')}}">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                            Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

<div class="page-heading">

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>@yield('page-title')</h3>
                <p class="text-subtitle text-muted">@yield('page-subtitle')</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ucfirst(Request::segment(1))}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section container-fluid">
        @yield('content')
    </section>
</div>

            <footer>
                <div class="footer clearfix mt-5 mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Move POS</p>
                    </div>
                    <div class="float-end">
                        <p>Created by <a href="https://instagram.com/movetech.id">MoveTech ID</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>

{{-- <script src="{{asset('js/pages/dashboard.js')}}"></script> --}}
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/extensions/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/extensions/simple-datatables.js')}}"></script>
<script src="{{asset('js/extensions/toastify-js.js')}}"></script>
<script src="{{asset('js/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('js/extensions/form-element-select.js')}}"></script>
<script src="{{asset('js/extensions/jquery.mask.js')}}"></script>
@livewireScripts()
@stack('script')
</body>

</html>
