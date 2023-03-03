<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Data tables-->
    <link rel="stylesheet"
        href="{{ asset('adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet"
        href="{{ asset('adminlte/bower_components/datatables.net-bs/css/buttons.bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte\bower_components\font-awesome-4\css\font-awesome.min.css')}}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css')}}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-black.min.css')}}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .select2-container--default .select2-results__option[aria-disabled=true] {
            display: none;
        }

    </style>
    <title>{{ config('app.name') }}</title>
</head>

<body class="hold-transition skin-black sidebar-mini fixed">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="./dashboard" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">TMS</span>
                <!-- logo for regular state and mobile devices -->
                <!-- <span class="logo-lg"><h3>Torop Sumber Makmur</h3></span> -->
                <span class="logo-lg">TMS</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('adminlte/img/avatar5.png')}}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ StrtoUpper(Auth::user()->nama) }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('adminlte/img/avatar5.png')}}" class="img-circle"
                                        alt="User Image">

                                    <p>
                                        {{ Auth::user()->nama }}
                                        <small>{{ Auth::user()->roles }}</small>
                                    </p>
                                </li>
                                <!-- Menu cs_nama -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ url('user/'.Auth::user()->id.'/profile') }}"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" class="dropdown-item"
                                            href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                            <i class="dropdown-icon fe fe-log-out"></i> {{ __('Sign out') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.index') }}">
                            <i class="fa fa-tachometer"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('customer*') || Request::is('product*') ? 'active' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-tasks"></i>
                            <span>Master</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('customer*') ? 'active' : '' }}">
                                <a href="{{ route('customer.index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Customer</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('product*') ? 'active' : '' }}">
                                <a href="{{ route('product.index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Product</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Request::is('project*') || Request::is('order*') ? 'active' : '' }} treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Input</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('project*') || Request::is('progress*') ? 'active' : '' }}">
                                <a href="{{ route('project.index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Project</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('order*') ? 'active' : '' }}">
                                <a href="{{ route('order.all') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="header">EXTRAS</li>
                    <li class="{{ Request::is('user*') ? 'active' : '' }} treeview">
                        <a href="#">
                            @can('isAdministrator') <i class="fa fa-cogs"></i> <span>Admin Menu</span> @endcan
                            @can('isOperator') <i class="fa fa-cogs"></i> <span>User Menu</span> @endcan
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Request::is('user/*/profile') ? 'active' : '' }}">
                                <a href="{{ route('user.profile', Auth::user()->id) }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Profile</span>
                                </a>
                            </li>
                            <li class="{{ Request::is('user/changepassword') ? 'active' : '' }}">
                                <a href="{{ route('user.changepassword') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Ubah Password</span>
                                </a>
                            </li>
                            @can ('isAdministrator')
                            <li class="{{ Request::is('user/manageuser') ? 'active' : '' }}">
                                <a href="{{ route('user.manageuser') }}">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Manage Users</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Full Width Column -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @if (\Request::is('dashboard*') || \Request::is('/'))
                    Dashboard
                    @elseif (\Request::is('customer'))
                    Daftar Customer
                    @elseif (\Request::is('customer/create'))
                    Tambah Data Customer
                    @elseif (\Request::is('customer/*/edit'))
                    Ubah Data Customer
                    @elseif (\Request::is('product'))
                    Daftar Product
                    @elseif (\Request::is('product/create'))
                    Tambah Data Product
                    @elseif (\Request::is('product/*/edit'))
                    Ubah Data Product
                    @elseif (\Request::is('project'))
                    Daftar Project
                    @elseif (\Request::is('project/create'))
                    Tambah Data Project
                    @elseif (\Request::is('project/*/edit'))
                    Ubah Data Project
                    @elseif (\Request::is('progress/*'))
                    Daftar Progress
                    @elseif (\Request::is('item'))
                    <a role="button" class="btn btn-default btn-flat" href="{{ url()->previous() }}"><i
                            class="fa fa-arrow-circle-left"></i> Kembali</a> Daftar Item
                    @elseif (\Request::is('order/all'))
                    Daftar Order
                    @elseif (\Request::is('order/create'))
                    <a role="button" class="btn btn-default btn-flat" href="{{ url()->previous() }}"><i
                            class="fa fa-arrow-circle-left"></i> Kembali</a> Tambah Data Order
                    @elseif (\Request::is('order/*/edit'))
                    <a role="button" class="btn btn-default btn-flat" href="{{ route('order.all') }}"><i
                            class="fa fa-arrow-circle-left"></i> Kembali</a> Ubah Data Order
                    {{ request('kd_project') }}
                    @elseif (\Request::is('progress'))
                    <a role="button" class="btn btn-default btn-flat" href="{{ route('project.index') }}"><i
                            class="fa fa-arrow-circle-left"></i> Kembali</a> Daftar Progress
                    {{ request('kd_project') }}
                    @elseif (\Request::is('user/manageuser'))
                    Daftar Users
                    @elseif (\Request::is('user/*/profile'))
                    Profile
                    @elseif (\Request::is('user/changepassword'))
                    Ubah Password
                    @elseif (\Request::is('test'))
                    Test
                    @elseif (\Request::is('customer/caesar'))
                    Caesar
                    @elseif (\Request::is('customer/vigenere'))
                    Vigenere
                    @endif
                    @yield('h1.order')
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Layout</a></li>
                    @if (\Request::is('dashboard') || \Request::is('/'))
                    <li class="active">Dashboard</li>
                    @elseif (\Request::is('customer') || \Request::is('customer/*'))
                    <li class="active">Customer</li>
                    @elseif (\Request::is('product') || \Request::is('product/*'))
                    <li class="active">Product</li>
                    @elseif (\Request::is('project') || \Request::is('project/*'))
                    <li class="active">Project</li>
                    @elseif (\Request::is('order/all' || \Request::is('order/*')))
                    <li class="active">Order</li>
                    @elseif (\Request::is('item') || \Request::is('item/*'))
                    <li class="active">Item</li>
                    @elseif (\Request::is('progress') || \Request::is('progress/*'))
                    <li class="active">Progress</li>
                    @elseif (\Request::is('user') || \Request::is('user/*'))
                    <li class="active">User</li>
                     @elseif (\Request::is('test') || \Request::is('/test'))
                    <li class="active">Test</li>
                    @endif
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs" id="made">
                    <span>Made By <i class="fa fa-heart" style="color: #ff6458; "></i> Dadan Romadhan</span>
                </div>
                <strong>Copyright &copy; 2022 <a href="http://toropsumbermakmur.com">PT. Torop Sumber Makmur</a>.</strong>
            </div>
            <!-- /.container -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>

    {{--<script src="{{ asset('adminlte\bower_components\Highcharts\code\highcharts.js') }}"></script>
    <script src="{{ asset('adminlte\bower_components\Highcharts\code\highcharts-3d.js') }}"></script>
    <script src="{{ asset('adminlte\bower_components\Highcharts\code\modules\exporting.js') }}"></script> --}}


    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/jszip.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/datatables.net/js/vfs_fonts.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('adminlte\bower_components\inputmask\dist\min\inputmask\jquery.maskMoney.min.js') }}">
    </script>
    <!-- date-range-picker -->
    <script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- SlimScroll -->
    <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
    <!-- page script -->
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="{{ asset('js/customer.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>
    <script src="{{ asset('js/project.js') }}"></script>
    <script src="{{ asset('js/order.js') }}"></script>
    <script src="{{ asset('js/item.js') }}"></script>
    <script src="{{ asset('js/progress.js') }}"></script>
    @yield('item.edit.script')
    @yield('item.create.script')
    @yield('script')
    <script src="{{ asset('js/user.js') }}"></script>
    <!-- Page script -->
    @yield('progress_script')
    <script type="text/javascript">
        var chart1;
        $(document).ready(function () {

            $('.select2').select2({
                width: '100%'
            });

            $('.select2-sorter').select2({
                sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)),
                width: '100%'
            });

            $(".datepicker").datepicker({
                language: 'id',
                format: 'd/M/yyyy',
                orientation: "top left",
                autoclose: true,
            }).on('show.bs.modal', function (event) {
                event.stopPropagation();
            });

            $(".datepicker_bot").datepicker({
                language: 'id',
                format: 'd/M/yyyy',
                orientation: "bottom left",
                autoclose: true,
            }).on('show.bs.modal', function (event) {
                event.stopPropagation();
            });

            // Initialize InputMask
            $(":input").inputmask();

            $('#money').maskMoney({
                prefix: 'Rp. ',
                thousands: '.',
                decimal: ',',
                precision: 0
            });
        });

    </script>
</body>

</html>
