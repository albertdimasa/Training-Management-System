<aside class="page-sidebar show">
    <div class="main-sidebar" id="main-sidebar">
        <ul class="sidebar-menu" id="simple-bar">
            <li class="sidebar-main-title">
                <div>
                    <h6 class="sidebar-title">Menu Utama</h6>
                </div>
            </li>
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Home-dashboard"></use>
                    </svg>
                    <h6 class="f-w-600">Dashboard</h6>
                </a>
            </li>

            <!-- Master Menu -->
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('master.*') ? 'active' : '' }}" href="javascript:void(0)">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Document"></use>
                    </svg>
                    <h6 class="f-w-600">Master</h6><i class="iconly-Arrow-Right-2 icli"> </i>
                </a>
                <ul class="sidebar-submenu" style="display: {{ request()->routeIs('master.*') ? 'block' : 'none' }};">
                    <li><a class="{{ request()->routeIs('master.client') ? 'active' : '' }}"
                            href="{{ route('master.client') }}">Client</a></li>
                    <li><a class="{{ request()->routeIs('master.contact') ? 'active' : '' }}"
                            href="{{ route('master.contact') }}">Contact</a></li>
                    <li><a class="{{ request()->routeIs('master.venue') ? 'active' : '' }}"
                            href="{{ route('master.venue') }}">Venue</a></li>
                </ul>
            </li>

            <!-- Education Menu -->
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('education.*') ? 'active' : '' }}"
                    href="javascript:void(0)">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Paper"></use>
                    </svg>
                    <h6 class="f-w-600">Education</h6><i class="iconly-Arrow-Right-2 icli"> </i>
                </a>
                <ul class="sidebar-submenu"
                    style="display: {{ request()->routeIs('education.*') ? 'block' : 'none' }};">
                    <li><a class="{{ request()->routeIs('education.course') ? 'active' : '' }}"
                            href="{{ route('education.course') }}">Course</a></li>
                    <li><a class="{{ request()->routeIs('education.instructor') ? 'active' : '' }}"
                            href="{{ route('education.instructor') }}">Instruktur</a></li>
                    <li><a class="{{ request()->routeIs('education.batch') ? 'active' : '' }}"
                            href="{{ route('education.batch') }}">Training Batch</a></li>
                    <li><a class="{{ request()->routeIs('education.participant') ? 'active' : '' }}"
                            href="{{ route('education.participant') }}">Peserta</a></li>
                </ul>
            </li>

            <!-- Operation Menu -->
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('operation.*') ? 'active' : '' }}"
                    href="javascript:void(0)">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Work"></use>
                    </svg>
                    <h6 class="f-w-600">Operation</h6><i class="iconly-Arrow-Right-2 icli"> </i>
                </a>
                <ul class="sidebar-submenu"
                    style="display: {{ request()->routeIs('operation.*') ? 'block' : 'none' }};">
                    <li><a class="{{ request()->routeIs('operation.order') ? 'active' : '' }}"
                            href="{{ route('operation.order') }}">Order</a></li>
                    <li><a class="{{ request()->routeIs('operation.invoice') ? 'active' : '' }}"
                            href="{{ route('operation.invoice') }}">Invoice</a></li>
                    <li><a class="{{ request()->routeIs('operation.payment') ? 'active' : '' }}"
                            href="{{ route('operation.payment') }}">Payment</a></li>
                </ul>
            </li>

            <!-- Financial Menu -->
            <li class="sidebar-list"> <i class="fa-solid fa-thumbtack"></i><a
                    class="sidebar-link {{ request()->routeIs('financial.*') ? 'active' : '' }}"
                    href="javascript:void(0)">
                    <svg class="stroke-icon">
                        <use href="{{ asset('assets/svg/iconly-sprite.svg') }}#Wallet"></use>
                    </svg>
                    <h6 class="f-w-600">Financial</h6><i class="iconly-Arrow-Right-2 icli"> </i>
                </a>
                <ul class="sidebar-submenu"
                    style="display: {{ request()->routeIs('financial.*') ? 'block' : 'none' }};">
                    <li>
                        <a class="{{ request()->routeIs('financial.account') ? 'active' : '' }}"
                            href="{{ route('financial.account') }}">Chart of Account</a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('financial.trial-balance') ? 'active' : '' }}"
                            href="{{ route('financial.trial-balance') }}">Trial Balance</a>
                    </li>
                    <li>
                        <a class="{{ request()->routeIs('financial.balance-sheet*') ? 'active' : '' }}"
                            href="{{ route('financial.balance-sheet') }}">Balance Sheet</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside>
