<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="شهریار بیات">

    <title>پنل مدیریت سایت رسمی سروش کوشان</title>

    <!-- Custom fonts for this template-->
{{--    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kaushan+Script|Poppins:300i,400,600"/>
{{--    <link rel="stylesheet" href="{{ asset('assets/admin/font-awesome/css/font-awesome.min.css') }}" type="text/css">--}}

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
    {{--    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-iconpicker.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('assets/admin/css/sweetalert2.min.css') }}">
    @stack('css')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('upcadmin.dashboard') }}">
            <img class="img-fluid" src="{{ asset('assets/admin/img/logo.png') }}" alt="logo">
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        <!-- Nav Item - Dashboard -->
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                @include('layouts.admin.includes.sidebar')
            </div>
        </div>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search mr-right-->
                <form class="d-none d-sm-inline-block form-inline  ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="بدنبال ..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Topbar Navbar ml-auto -->
                <ul class="navbar-nav mr-auto">

                    @include('layouts.admin.includes.header')

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('bread')

                <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                    <div class="mr-4 mb-3 mb-sm-0">
                        <h1 class="mb-0">@yield('title', 'داشبورد مدیریت')</h1>
                    </div>

                    <div class="">
                        <a class="btn btn-white btn-sm font-weight-500 line-height-normal p-3" href="#" role="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar text-primary mr-2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span class="font-weight-500 text-primary">
                                {{ now()->setTimezone('Asia/tehran')->format('l') }}
                            </span> · {{ now()->setTimezone('Asia/tehran')->format('d F Y') }} · {{ now()->setTimezone('Asia/Tehran')->format('H:m:s a') }}
                        </a>
                    </div>

                </div>

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
    @include('layouts.admin.includes.footer')
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/admin/js/fontawesome5-3-1.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap-iconpicker.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/admin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/sweetalert2.min.js') }}"></script>

@stack('js')

</body>

</html>
