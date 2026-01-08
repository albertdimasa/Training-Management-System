<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Admiro admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Admiro admin template, best javascript admin, dashboard template, bootstrap admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>{{ config('app.name') }} | @yield('title', 'Home')</title>
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
        <!-- Page header start -->
        <header class="page-header row">
            <div class="logo-wrapper d-flex align-items-center col-auto"><a href="index.html"><img
                        class="light-logo img-fluid" src="{{ asset('assets/images/logo/logo1.png') }}"
                        alt="logo"><img class="dark-logo img-fluid"
                        src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo"></a><a
                    class="close-btn toggle-sidebar" href="javascript:void(0)">
                    <svg class="svg-color">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Category"></use>
                    </svg></a></div>
            <div class="page-main-header col">
                <div class="header-left">
                    <form class="form-inline search-full col" action="#" method="get">
                        <div class="form-group w-100">
                            <div class="Typeahead Typeahead--twitterUsers">
                                <div class="u-posRelative">
                                    <input class="demo-input Typeahead-input form-control-plaintext w-100"
                                        type="text" placeholder="Search Admiro .." name="q" title=""
                                        autofocus>
                                    <div class="spinner-border Typeahead-spinner" role="status"><span
                                            class="sr-only">Loading...</span></div><i class="close-search"
                                        data-feather="x"></i>
                                </div>
                                <div class="Typeahead-menu"></div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group-header d-lg-block d-none">
                        <div class="Typeahead Typeahead--twitterUsers">
                            <div class="u-posRelative d-flex align-items-center">
                                <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                                    type="text" placeholder="Type to Search..." name="q" title=""><i
                                    class="search-bg iconly-Search icli"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="header-right">
                        <li class="search d-lg-none d-flex"> <a href="javascript:void(0)">
                                <svg>
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Search"></use>
                                </svg></a></li>
                        <li>
                            <a class="dark-mode" href="javascript:void(0)">
                                <svg>
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#moondark"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="custom-dropdown"><a href="javascript:void(0)">
                                <svg>
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#notification"></use>
                                </svg></a><span class="badge rounded-pill badge-primary">4</span>
                            <div class="custom-menu notification-dropdown py-0 overflow-hidden">
                                <h3 class="title bg-primary-light dropdown-title">Notification <span
                                        class="font-primary">View all</span></h3>
                                <ul class="activity-timeline">
                                    <li class="d-flex align-items-start">
                                        <div class="activity-line"></div>
                                        <div class="activity-dot-primary"></div>
                                        <div class="flex-grow-1">
                                            <h6 class="f-w-600 font-primary">30-04-2024<span>Today</span><span
                                                    class="circle-dot-primary float-end">
                                                    <svg class="circle-color">
                                                        <use
                                                            href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle">
                                                        </use>
                                                    </svg></span></h6>
                                            <h5>Alice Goodwin</h5>
                                            <p class="mb-0">Fashion should be fun. It shouldn't be labelled
                                                intellectual.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <div class="activity-dot-secondary"></div>
                                        <div class="flex-grow-1">
                                            <h6 class="f-w-600 font-secondary">28-06-2024<span>1 hour ago</span><span
                                                    class="float-end circle-dot-secondary">
                                                    <svg class="circle-color">
                                                        <use
                                                            href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle">
                                                        </use>
                                                    </svg></span></h6>
                                            <h5>Herry Venter</h5>
                                            <p>I am convinced that there can be luxury in simplicity.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <div class="activity-dot-primary"></div>
                                        <div class="flex-grow-1">
                                            <h6 class="f-w-600 font-primary">04-08-2024<span>Today</span><span
                                                    class="float-end circle-dot-primary">
                                                    <svg class="circle-color">
                                                        <use
                                                            href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle">
                                                        </use>
                                                    </svg></span></h6>
                                            <h5>Loain Deo</h5>
                                            <p>I feel that things happen for open new opportunities.</p>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-start">
                                        <div class="activity-dot-secondary"></div>
                                        <div class="flex-grow-1">
                                            <h6 class="f-w-600 font-secondary">12-11-2024<span>Yesterday</span><span
                                                    class="float-end circle-dot-secondary">
                                                    <svg class="circle-color">
                                                        <use
                                                            href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle">
                                                        </use>
                                                    </svg></span></h6>
                                            <h5>Fenter Jessy</h5>
                                            <p>Sometimes the simplest things are the most profound.</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="custom-dropdown"><a href="javascript:void(0)">
                                <svg>
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#bookmark"></use>
                                </svg></a>
                            <div class="custom-menu bookmark-dropdown py-0 overflow-hidden">
                                <h3 class="title bg-primary-light dropdown-title">Bookmark</h3>
                                <ul>
                                    <li>
                                        <form class="mb-0">
                                            <div class="input-group">
                                                <input class="form-control" type="text"
                                                    placeholder="Search Bookmark..."><span class="input-group-text">
                                                    <svg class="svg-color">
                                                        <use
                                                            href="{{ asset('assets/svg/iconly-sprite.svg') }}#Search">
                                                        </use>
                                                    </svg></span>
                                            </div>
                                        </form>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2 btn-activity-primary"><a
                                                href="../template/index.html">
                                                <svg class="svg-color">
                                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#cube">
                                                    </use>
                                                </svg></a></div>
                                        <div class="d-flex justify-content-between align-items-center w-100"><a
                                                href="../template/index.html">Dashboard</a>
                                            <svg class="svg-color icon-star">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#star"></use>
                                            </svg>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2 btn-activity-secondary"><a
                                                href="../template/to-do.html">
                                                <svg class="svg-color">
                                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#check">
                                                    </use>
                                                </svg></a></div>
                                        <div class="d-flex justify-content-between align-items-center w-100"><a
                                                href="../template/to-do.html">To-do</a>
                                            <svg class="svg-color icon-star">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#star"></use>
                                            </svg>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2 btn-activity-danger"><a
                                                href="../template/apex_chart.html">
                                                <svg class="svg-color">
                                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#pie"></use>
                                                </svg></a></div>
                                        <div class="d-flex justify-content-between align-items-center w-100"><a
                                                href="../template/apex_chart.html">Chart</a>
                                            <svg class="svg-color icon-star">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#star"></use>
                                            </svg>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="profile-nav custom-dropdown">
                            <div class="user-wrap">
                                <div class="user-img"><img src="{{ asset('assets/images/profile.png') }}"
                                        alt="user"></div>
                                <div class="user-content">
                                    <h6>Ava Davis</h6>
                                    <p class="mb-0">Admin<i class="fa-solid fa-chevron-down"></i></p>
                                </div>
                            </div>
                            <div class="custom-menu overflow-hidden">
                                <ul class="profile-body">
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Profile"></use>
                                        </svg><a class="ms-2" href="../template/user-profile.html">Account</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Message"></use>
                                        </svg><a class="ms-2" href="../template/letter-box.html">Inbox</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Document"></use>
                                        </svg><a class="ms-2" href="../template/to-do.html">Task</a>
                                    </li>
                                    <li class="d-flex">
                                        <svg class="svg-color">
                                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Login"></use>
                                        </svg><a class="ms-2" href="../template/login.html">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- Page header end-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page sidebar start-->
            @include('partials.sidebar')
            <!-- Page sidebar end-->
            <div class="page-body">
                <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <h2>@yield('title', 'Dashboard')</h2>
                            </div>
                            <div class="col-sm-6 col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                                class="iconly-Home icli svg-color"></i></a></li>
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
            @include('partials.footer')
        </div>
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
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
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
