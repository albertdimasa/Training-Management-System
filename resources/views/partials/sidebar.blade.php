<aside class="page-sidebar show">
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <li class="sidebar-main-title">
                <div>
                    <h6 class="sidebar-title">Menu Utama</h6>
                </div>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Home-dashboard"></use>
                    </svg>
                    <h6 class="f-w-600">Dashboard</h6>
                </a>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('master.*') ? 'active' : '' }}" href="javascript:void(0)">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Document"></use>
                    </svg>
                    <h6 class="f-w-600">Master Data</h6><i class="iconly-Arrow-Right-2 icli"> </i>
                </a>
                <ul class="sidebar-submenu" style="display: {{ request()->routeIs('master.*') ? 'block' : 'none' }};">
                    <li><a class="{{ request()->routeIs('master.instructor') ? 'active' : '' }}"
                            href="{{ route('master.instructor') }}">Instruktor</a></li>
                    <li><a class="{{ request()->routeIs('master.course') ? 'active' : '' }}"
                            href="{{ route('master.course') }}">Course</a></li>
                </ul>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('report') ? 'active' : '' }}"
                    href="{{ route('report') }}">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Chart"></use>
                    </svg>
                    <h6 class="f-w-600">Laporan</h6>
                </a>
            </li>
        </ul>
    </div>
</aside>
