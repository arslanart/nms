<aside class="main-sidebar sidebar-white-primary elevation-4 table-responsive">
    <nav class="mt-2 table-responsive">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-white sidebar sidebar-white accordion table-responsive" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center">
                    <div class="sidebar-brand-icon">
                        <img src="asset/frontend/images/egatlogo.png" alt="logo" class="img-fluid"
                            style="width: 200px; height: auto;">
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-3"> <!-- ปรับระยะห่างของเส้นแบ่ง -->
                <span style="font-size: 10px; font-weight: bold;">MENU</span>

                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('dashboard') ? 'active' : '' }} hover-effect" href="{{ route('dashboard') }}">
                        <i class="fas fa-fw fa-home text-dark"></i>
                        <span>Home</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('view-group') ? 'active' : '' }} hover-effect" href="{{ route('view-group') }}">
                        <i class="fas fa-fw fa-table text-dark"></i>
                        <span>Group</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('inventory') ? 'active' : '' }} hover-effect" href="{{ route('inventory') }}">
                        <i class="fas fa-fw fa-box text-dark"></i>
                        <span>Inventory</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('alarm') ? 'active' : '' }} hover-effect" href="{{ route('alarm') }}">
                        <i class="fas fa-fw fa-bell text-dark"></i>
                        <span>Alarm</span>
                    </a>
                </li>

                @can('admin-menu')
                <li class="nav-item">
                    <a class="nav-link text-dark {{ request()->routeIs('admin-view') ? 'active' : '' }} hover-effect" href="{{ route('admin-view') }}">
                        <i class="fas fa-fw fa-male text-dark"></i>
                        <span>Administrator</span>
                    </a>
                </li>
                @endcan

                <hr class="sidebar-divider">

                <span style="font-size: 10px; font-weight: bold;">GROUP</span>


            </ul>
    </nav>

</aside>
