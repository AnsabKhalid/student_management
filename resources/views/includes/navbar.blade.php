<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <a href="{{ URL::to('/logout') }}" class="btn btn-danger font-weight-bold ml-auto mr-3">
        <i class="nav-icon fa fa-power-off pr-3"></i>
        Logout
    </a>

</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #ff9900;">

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-2 mb-3 d-flex">
            <div class="image">
                <img src="{{URL::to('public/assets/uploads/staffImages')}}/{{ Auth::user()->image }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{URL::to('/')}}" class="d-block mt-2 text-white">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- <div class="mt-3 pb-2 mb-3 d-flex">
            <div class="image h-10">
                <img src="{{URL::to('public/assets/uploads/logo_CMS_light.jpeg')}}" class="elevation-2 image_logo"
                    alt="Logo Image">
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{URL::to('/')}}" class="nav-link active my-2">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/todo')}}" class="nav-link active my-2">
                        <i class="nav-icon fa fa-bullhorn"></i>
                        <p>
                            Todo List
                        </p>
                    </a>
                </li>
                <li class="nav-item my-2">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Students
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/addStudent')}}" class="nav-link">
                                <i class="fa fa-database nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/allStudents')}}" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>All Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/register')}}" class="nav-link">
                                <i class="fa fa-registered nav-icon"></i>
                                <p>Register</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{URL::to('/studentsMonthlyReport')}}" class="nav-link">
                                <i class="fa fa-adjust nav-icon"></i>
                                <p>Students Monthly Report</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item my-2">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Teachers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/addTeacher')}}" class="nav-link">
                                <i class="fa fa-database nav-icon"></i>
                                <p>Add Teacher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/allTeachers')}}" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>All Teachers</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{URL::to('/teachersReport')}}" class="nav-link">
                                <i class="fa fa-adjust nav-icon"></i>
                                <p>Teachers Monthly Report</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item my-2">
                    <a href="" class="nav-link active">
                        <i class="nav-icon fa fa-folder"></i>
                        <p>
                            Extras
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/Subjects')}}" class="nav-link">
                                <i class="nav-icon fa fa-book"></i>
                                <p>
                                    Subjects
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/classLevels')}}" class="nav-link">
                                <i class="nav-icon fa fa-anchor"></i>
                                <p>
                                    Class Levels
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/cities')}}" class="nav-link">
                                <i class="nav-icon fa fa-cogs"></i>
                                <p>
                                    Cities
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/reviews')}}" class="nav-link">
                                <i class="nav-icon fa fa-star"></i>
                                <p>
                                    Reviews
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item my-2">
                    <a href="" class="nav-link active">
                        <i class="nav-icon fa fa-graduation-cap"></i>
                        <p>
                            Schedule and Billing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/studentBilling')}}" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/teacherBilling')}}" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Teachers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (Auth::user()->role_id == 1)
                <li class="nav-item my-2">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>
                            Manage Staff
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/addStaff')}}" class="nav-link">
                                <i class="fa fa-database nav-icon"></i>
                                <p>Add Staff</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/allStaff')}}" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>All Staff</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @endif
                <li class="nav-item my-2">
                    <a href="#" class="nav-link active">
                        <i class="fa fa-paper-plane nav-icon" aria-hidden="true"></i>
                        <p>
                            Send Email
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item my-2">
                            <a href="{{URL::to('/studentEmail')}}" class="nav-link">
                                <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                                <p>
                                    Send Email Student
                                </p>
                            </a>
                        </li>
                        <li class="nav-item my-2">
                            <a href="{{URL::to('/teacherEmail')}}" class="nav-link">
                                <i class="fa fa-users nav-icon" aria-hidden="true"></i>
                                <p>
                                    Send Email Teacher
                                </p>
                            </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>

<!-- Content Wrapper. Contains page content   -->
<div class="content-wrapper custom-bg">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <style>
    .nav-pills .nav-link {
        color: white;
    }

    .nav-pills .nav-link:hover {
        background-color: #ffc266;
        color: #fff !important;
    }

    .nav-pills .nav-link.active {
        background-color: #e68a00 !important;
    }

    .nav-pills .nav-link.active:hover {
        background-color: #ffb84d !important;
    }

    .image_logo {
        width: 120px;
        height: 40px;
        margin-left: 20px;
    }
    </style>