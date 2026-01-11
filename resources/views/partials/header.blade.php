<header class="page-header row">
    <div class="logo-wrapper d-flex align-items-center col-auto">
        <a href="{{ route('dashboard') }}">
            <img class="light-logo img-fluid" src="{{ asset('assets/images/logo/logo1.png') }}" alt="logo">
            <img class="dark-logo img-fluid" src="{{ asset('assets/images/logo/logo-dark.png') }}" alt="logo">
        </a>
        <a class="close-btn toggle-sidebar" href="javascript:void(0)">
            <svg class="svg-color">
                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Category"></use>
            </svg>
        </a>
    </div>
    <div class="page-main-header col">
        <div class="header-left">
        </div>
        <div class="nav-right">
            <ul class="header-right">
                <li class="search d-lg-none d-flex">
                    <a href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Search"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a class="dark-mode" href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#moondark"></use>
                        </svg>
                    </a>
                </li>
                {{-- <li class="custom-dropdown">
                    <a href="javascript:void(0)">
                        <svg>
                            <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#notification"></use>
                        </svg>
                    </a>
                    <span class="badge rounded-pill badge-primary">4</span>
                    <div class="custom-menu notification-dropdown py-0 overflow-hidden">
                        <h3 class="title bg-primary-light dropdown-title">
                            Notification <span class="font-primary">View all</span>
                        </h3>
                        <ul class="activity-timeline">
                            <li class="d-flex align-items-start">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <h6 class="f-w-600 font-primary">
                                        30-04-2024<span>Today</span>
                                        <span class="circle-dot-primary float-end">
                                            <svg class="circle-color">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle"></use>
                                            </svg>
                                        </span>
                                    </h6>
                                    <h5>Alice Goodwin</h5>
                                    <p class="mb-0">Fashion should be fun. It shouldn't be labelled intellectual.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1">
                                    <h6 class="f-w-600 font-secondary">
                                        28-06-2024<span>1 hour ago</span>
                                        <span class="float-end circle-dot-secondary">
                                            <svg class="circle-color">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle"></use>
                                            </svg>
                                        </span>
                                    </h6>
                                    <h5>Herry Venter</h5>
                                    <p>I am convinced that there can be luxury in simplicity.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <h6 class="f-w-600 font-primary">
                                        04-08-2024<span>Today</span>
                                        <span class="float-end circle-dot-primary">
                                            <svg class="circle-color">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle"></use>
                                            </svg>
                                        </span>
                                    </h6>
                                    <h5>Loain Deo</h5>
                                    <p>I feel that things happen for open new opportunities.</p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1">
                                    <h6 class="f-w-600 font-secondary">
                                        12-11-2024<span>Yesterday</span>
                                        <span class="float-end circle-dot-secondary">
                                            <svg class="circle-color">
                                                <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#circle"></use>
                                            </svg>
                                        </span>
                                    </h6>
                                    <h5>Fenter Jessy</h5>
                                    <p>Sometimes the simplest things are the most profound.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="profile-nav custom-dropdown">
                    <div class="user-wrap">
                        <div class="user-content">
                            <h6>{{ Auth::user()->name }} <i class="fa-solid fa-chevron-down"></i></h6>
                        </div>
                    </div>
                    <div class="custom-menu overflow-hidden">
                        <ul class="profile-body">
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Profile"></use>
                                </svg>
                                <a class="ms-2" href="#">Account</a>
                            </li>
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Message"></use>
                                </svg>
                                <a class="ms-2" href="#">Inbox</a>
                            </li>
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Document"></use>
                                </svg>
                                <a class="ms-2" href="#">Task</a>
                            </li>
                            <li class="d-flex">
                                <svg class="svg-color">
                                    <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Login"></use>
                                </svg>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="ms-2 border-0 bg-transparent">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</header>
