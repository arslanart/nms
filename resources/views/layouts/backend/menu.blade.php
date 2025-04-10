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

                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('dashboard') }}">
                        <i class="fas fa-fw fa-home text-dark"></i>
                        <span>Home</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('group') }}">
                        <i class="fas fa-fw fa-table text-dark"></i>
                        <span>Group</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('inventory') }}">
                        <i class="fas fa-fw fa-box text-dark"></i>
                        <span>Inventory</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('alarm') }}">
                        <i class="fas fa-fw fa-bell text-dark"></i>
                        <span>Alarm</span></a>
                </li>

                @can('admin-menu')
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{ route('admin-view') }}">
                        <i class="fas fa-fw fa-male text-dark"></i>
                        <span>Administrator</span></a>
                </li>
                @endcan
                {{-- <!-- Nav Item - Dashboard -->
                {{-- <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin-dashboard') }}">
                        <i class="fas fa-fw fa-home"></i>
                        <span>หน้าหลัก</span></a>
                </li> --}}

                <!-- Divider -->
                <hr class="sidebar-divider">



                <!-- Nav Item - Pages Collapse Menu -->
                {{-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-table"></i>
                        <span>ข้อมูลงาน</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="{{ route('projects') }}">ข้อมูลตารางงาน</a>
                            <a class="collapse-item" href="{{ route('add-task') }}">เพิ่มข้อมูลงาน</a> --}}
                {{-- <a class="collapse-item" href="{{ route('summary-schedule') }}">สรุปตารางงาน</a> --}}
                {{-- <a class="collapse-item"
                                href="{{ route('projects', ['statusFilter' => 1]) }}">งานที่เสร็จแล้ว</a>
                            <a class="collapse-item"
                                href="{{ route('projects', ['statusFilter' => 2]) }}">งานที่ยังไม่เสร็จ</a>
                        </div>
                    </div>
                </li> --}}

                <!-- Nav Item - Utilities Collapse Menu -->
                {{-- @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                            aria-expanded="true" aria-controls="collapseUtilities">
                            <i class="fas fa-fw fa-user"></i>
                            <span>ข้อมูลบุคลากร</span>
                        </a>
                        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="{{ route('personal') }}">บุคลากร</a>
                                <a class="collapse-item" href="{{ route('addpersonal') }}">เพิ่มบุคลากร</a>
                            </div>
                        </div>
                    </li>
                @endcan --}}


                <!-- Nav Item - Charts -->
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('account_setting') }}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>บัญชีผู้ใช้</span></a>
                </li> --}}

                {{-- @can('can-manage-type')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('type-management') }}">
                            <i class="fas fa-fw fa-wrench"></i>
                            <span>จัดการประเภทงาน</span>
                        </a>
                    </li>
                @endcan

                @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restore') }}">
                            <i class="fas fa-fw fa-trash"></i>
                            <span>กู้คืนบัญชี</span></a>
                    </li>
                @endcan
                @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('restore-task') }}">
                            <i class="fas fa-fw fa-trash"></i>
                            <span>กู้คืนข้อมูลงาน</span></a>
                    </li>
                @endcan --}}

                <!-- Nav Item - Tables -->
                {{-- @can('can-view-function')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('send-email-tasks') }}">
                            <i class="fas fa-fw fa-envelope"></i>
                            <span>ส่งเมล</span>
                        </a>
                    </li>
                @endcan --}}
            </ul>
    </nav>

</aside>
