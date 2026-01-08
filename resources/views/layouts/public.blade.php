<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Training Management System">
    <meta name="author" content="pixelstrap">
    <title>{{ config('app.name') }} | @yield('title', 'Public')</title>
    <!-- Favicon icon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&amp;display=swap"
        rel="stylesheet">
    <!-- Flag icon css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/flag-icon.css') }}">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ asset('assets/css/iconly-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bulk-style.css') }}">
    <!-- iconly-icon-->
    <link rel="stylesheet" href="{{ asset('assets/css/themify.css') }}">
    <!--fontawesome-->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-min.css') }}">
    <!-- Whether Icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/weather-icons/weather-icons.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/prism.css') }}">
    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/css/color-1.css') }}" media="screen">
</head>

<body>
    <!-- tap on top starts-->
    <div class="tap-top"><i class="iconly-Arrow-Up icli"></i></div>
    <!-- tap on tap ends-->
    <!-- loader-->
    <div class="loader-wrapper">
        <div class="loader"><span></span><span></span><span></span><span></span><span></span></div>
    </div>
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Body Start-->
        <div class="page-body-wrapper horizontal-menu">
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <h2>@yield('title', 'Schedule')</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('login') }}">
                                            Login
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ url('/') }}">
                                            Home
                                        </a>
                                    </li>
                                    @yield('breadcrumb')
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- Container-fluid Ends-->
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 footer-copyright">
                        <p class="mb-0">Copyright {{ date('Y') }} © {{ config('app.name') }} All rights
                            reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- jquery-->
    <script src="{{ asset('assets/js/vendors/jquery/jquery.min.js') }}"></script>
    <!-- bootstrap js-->
    <script src="{{ asset('assets/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}" defer=""></script>
    <script src="{{ asset('assets/js/vendors/bootstrap/dist/js/popper.min.js') }}" defer=""></script>
    <!--fontawesome-->
    <script src="{{ asset('assets/js/vendors/font-awesome/fontawesome-min.js') }}"></script>
    <!-- feather-->
    <script src="{{ asset('assets/js/vendors/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/feather-icon/custom-script.js') }}"></script>
    <!-- sidebar -->
    {{-- <script src="{{ asset('assets/js/sidebar.js') }}"></script> --}}
    <!-- scrollbar-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- theme_customizer-->
    <script src="{{ asset('assets/js/theme-customizer/customizer.js') }}"></script>
    <!-- prism-->
    <script src="{{ asset('assets/js/prism/prism.min.js') }}"></script>
    <!-- clipboard-->
    <script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
    <!-- customcard-->
    <script src="{{ asset('assets/js/custom-card/custom-card.js') }}"></script>
    <!-- Sweetalert js-->
    <script src="{{ asset('assets/js/sweetalert/sweetalert2.min.js') }}"></script>
    <!-- custom script -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    @stack('scripts')
</body>

</html>
