<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">

        <i class="bi bi-list toggle-sidebar-btn me-1"></i>
        <a href="{{ Auth::check() ? (Auth::user()->is_role == 1 ? url('admin/dashboard') : url('manager/dashboard')) : url('/') }}"
            class="logo d-flex align-items-center">
            <img src="{{ asset('img/logo.png') }}" alt="">
            <span class="d-none d-lg-block">Storage DAU</span>
        </a>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                    data-bs-toggle="dropdown"><img
                        src="{{ Auth::user()->is_role == 1 ? asset('img/admin-profile.jpg') : asset('img/manager-profile.jpg') }}"
                        alt="Profile" class="rounded-circle">

                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile shadow-sm rounded-3 px-2 py-2"
                    style="min-width: 200px;">
                    <li class="dropdown-header px-2 pb-1">
                        <div class="fw-semibold">{{ Auth::user()->name }}</div>
                        <div class="small text-muted">{{ Auth::user()->email }}</div>
                    </li>
                    <li>
                        <hr class="dropdown-divider my-2">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
