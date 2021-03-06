@guest

@yield('content')

@else

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('public/assets/logo.png') }}" rel="icon" type="image/x-icon">
    <title>{{ config('app.name', 'HO') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/font-google/font-google.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('public/themes/plugins/sweetalert2/sweetalert2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/themes/dist/css/adminlte.min.css') }}">

    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed skin-blue">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="{{ asset('public/assets/logo.png') }}" alt="logo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                            <i class="fa fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a
                            class="dropdown-item"
                            href="{{ route('profile.index') }}">
                                <i class="fa fa-id-card px-2"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item"
                            href="{{ route('change_password.index') }}">
                                <i class="fa fa-lock-open px-2"></i> Ubah Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a
                            class="dropdown-item"
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt px-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('public/assets/logo.png') }}" alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-light">Biro Jasa</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::user()->masterKaryawan)
                            <img src="{{ asset('public/image/' . Auth::user()->masterKaryawan->foto) }}" class="img-circle elevation-2" alt="User Image">
                        @else
                            <img src="{{ asset('public/themes/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        @if (Auth::user()->role == "administrator")
                            <li class="nav-item">
                                <a href="#" class="nav-link {{ request()->is(['home', 'home/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt text-center mr-2" style="width: 30px;"></i><p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item {{ request()->is('master/*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ request()->is('master/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-lock text-center mr-2" style="width: 30px;"></i><p>Master<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('nav.index') }}" class="nav-link {{ request()->is('master/nav') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Navigasi</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('master/user') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jabatan.index') }}" class="nav-link {{ request()->is('master/jabatan') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Jabatan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('master/kategori') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Kategori</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('estimasi_biaya.index') }}" class="nav-link {{ request()->is('master/estimasi_biaya') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Estimas Biaya</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kota.index') }}" class="nav-link {{ request()->is('master/kota') ? 'active' : '' }}">
                                            <i class="fas fa-angle-right nav-icon"></i><p>Kota</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('karyawan.index') }}" class="nav-link {{ request()->is(['karyawan', 'karyawan/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-tie text-center mr-2" style="width: 30px;"></i><p>Karyawan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pelanggan.index') }}" class="nav-link {{ request()->is(['pelanggan', 'pelanggan/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user text-center mr-2" style="width: 30px;"></i><p>Pelanggan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pesanan.index') }}" class="nav-link {{ request()->is(['pesanan', 'pesanan/*']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-credit-card text-center mr-2" style="width: 30px;"></i><p>Pesanan</p>
                                </a>
                            </li>
                        @else
                            @foreach ($current_nav_mains as $item)
                                @if ($item->link == '#')
                                    <li class="nav-item {{ request()->is(''.$item->set_active.'/*') ? 'menu-open' : '' }}">
                                        <a href="#" class="nav-link {{ request()->is(''.$item->set_active.'/*') ? 'active' : '' }}">
                                            <i class="nav-icon {{ $item->icon }} text-center mr-2" style="width: 30px;"></i> <p>{{ $item->title }}<i class="right fas fa-angle-left"></i></p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @foreach ($current_menus as $item_menu)
                                                @if ($item_menu->main_id == $item->id)
                                                    <li class="nav-item">
                                                        <a href="{{ route($item_menu->navSub->link) }}" class="nav-link {{ request()->is([''.$item_menu->navSub->set_active.'', ''.$item_menu->navSub->set_active.'/*']) ? 'active' : '' }}">
                                                            <i class="fas fa-angle-right nav-icon"></i> <p>{{ $item_menu->navSub->title }}</p>
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route($item->link) }}" class="nav-link {{ request()->is([''.$item->set_active.'', ''.$item->set_active.'/*']) ? 'active' : '' }}">
                                            <i class="nav-icon {{ $item->icon }} text-center mr-2" style="width: 30px;"></i> <p>{{ $item->title }}</p>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">BiroJasa</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('public/themes/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/themes/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('public/themes/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('public/themes/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/themes/dist/js/adminlte.js') }}"></script>

    <script>
        function format_rupiah(bilangan) {
            var	number_string = bilangan.toString(),
                split	= number_string.split(','),
                sisa 	= split[0].length % 3,
                rupiah 	= split[0].substr(0, sisa),
                ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            return rupiah;
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
            }

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
        }

        function tanggalIndo(date) {
            var date = new Date(date);
            var tahun = date.getFullYear();
            var bulan = date.getMonth();
            var tanggal = date.getDate();
            var hari = date.getDay();
            var jam = date.getHours();
            var menit = date.getMinutes();
            var detik = date.getSeconds();
            switch(hari) {
            case 0: hari = "Minggu"; break;
            case 1: hari = "Senin"; break;
            case 2: hari = "Selasa"; break;
            case 3: hari = "Rabu"; break;
            case 4: hari = "Kamis"; break;
            case 5: hari = "Jum'at"; break;
            case 6: hari = "Sabtu"; break;
            }
            switch(bulan) {
            case 0: bulan = "Januari"; break;
            case 1: bulan = "Februari"; break;
            case 2: bulan = "Maret"; break;
            case 3: bulan = "April"; break;
            case 4: bulan = "Mei"; break;
            case 5: bulan = "Juni"; break;
            case 6: bulan = "Juli"; break;
            case 7: bulan = "Agustus"; break;
            case 8: bulan = "September"; break;
            case 9: bulan = "Oktober"; break;
            case 10: bulan = "November"; break;
            case 11: bulan = "Desember"; break;
            }
            var tampilTanggal = hari + ", " + tanggal + " " + bulan + " " + tahun + " " + jam + ":" + menit + ":" + detik;
            var tampilWaktu = "Jam: " + jam + ":" + menit + ":" + detik;

            return tampilTanggal;
        }
    </script>

    @yield('script')
</body>
</html>

@endguest
