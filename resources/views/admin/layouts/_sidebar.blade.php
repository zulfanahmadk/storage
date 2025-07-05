<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->is_role == 2)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'dashboard') @else collapsed @endif"
                    href="{{ url(Auth::user()->is_role == 2 ? 'manager/dashboard' : 'admin/manager/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'invoice') @else collapsed @endif"
                    href="{{ url(Auth::user()->is_role == 2 ? 'manager/invoice' : 'admin/manager/invoice') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Invoice</span>
                </a>
            </li>
        @elseif(Auth::user()->is_role == 1)
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'dashboard') @else collapsed @endif"
                    href="{{ url(Auth::user()->is_role == 2 ? 'manager/dashboard' : 'admin/dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <!-- Menu ini hanya untuk ADMIN -->
            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'invoice') @else collapsed @endif"
                    href="{{ url('admin/invoice') }}">
                    <i class="bi bi-journal-text"></i>
                    <span>Invoice</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'customers') @else collapsed @endif"
                    href="{{ url('admin/customers') }}">
                    <i class="bi bi-person"></i>
                    <span>Customers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if (in_array(Request::segment(2), ['item', 'item_unit'])) @else collapsed @endif"
                    data-bs-target="#barang-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-box-seam"></i><span>Manajemen Barang</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="barang-nav" class="nav-content collapse @if (in_array(Request::segment(2), ['item', 'item_unit'])) show @endif"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin/item') }}" class="@if (Request::segment(2) == 'item') active @endif">
                            <i class="bi bi-circle"></i><span>Barang Consumable</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/item_unit') }}" class="@if (Request::segment(2) == 'item_unit') active @endif">
                            <i class="bi bi-circle"></i><span>Unit Sewa</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link @if (Request::segment(2) == 'suppliers') @else collapsed @endif"
                    href="{{ url('admin/suppliers') }}">
                    <i class="bi bi-person-lines-fill"></i>
                    <span>Suppliers</span>
                </a>
            </li>
        @endif

    </ul>

</aside><!-- End Sidebar-->
