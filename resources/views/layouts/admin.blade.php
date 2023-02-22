<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Word Reward</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    @yield('styles')


    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <form method="POST" class="nav-link" action="{{ route('logout') }}">
                    @csrf
                    <a onclick="this.closest('form').submit();">Logout</a>
                </form>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="  background-color: #060128; box-shadow: 0 14px 28px rgb(71, 106, 196),0 10px 10px rgb(71, 106, 196) !important;">
        <!-- Brand Logo -->
        <a href="{{route('dashboard')}}" class="brand-link">
            <img src="{{ asset('assets/dist/img/logo.png') }}"
                 class="brand-image " style="opacity: .8; max-height: 44px; width: 51px;">
            <span class="brand-text font-weight-light" style="color: white;">Admin Panel</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block ultra-sidebar">{{ auth()->guard('admin')->user()->name }}</a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <form method="GET" action="{{ route('search') }}">
                    <div class="input-group">
                        <input class="form-control form-control-sidebar ultra-search" placeholder="Search" name="q"
                               aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link ultra-sidebar">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="/user" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>All users</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="user/create" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>Create user</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('group.index') }}" class="nav-link ultra-sidebar">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                UserGroups
                                {{--                                <i class="right fas fa-angle-left"></i>--}}
                            </p>
                        </a>
                        {{--                        <ul class="nav nav-treeview">--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('group.index')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>All UserGroups</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a href="{{route('group.create')}}" class="nav-link">--}}
                        {{--                                    <i class="far fa-circle nav-icon"></i>--}}
                        {{--                                    <p>Create UserGroup</p>--}}
                        {{--                                </a>--}}
                        {{--                            </li>--}}
                        {{--                        </ul>--}}
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link ultra-sidebar">
                            <i class="nav-icon fas fa-ellipsis-h"></i>
                            <p>
                                Notifications
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('notify.user') }}" class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Send User Notification</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('notify.group') }}" class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Send Group Notification</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('notify.all') }}" class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Send All Notification</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header ultra-sidebar">Operations</li>
                    <li class="nav-item">
                        <a class="nav-link ultra-sidebar">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>
                                Transactions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('transactions.index')}}" class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All</p>
                                    <span class="badge badge-info right">{{ $transactionCount }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transactions.index',['transaction_type_id' => TRANSACTION_CHECKIN,'status' => TRANSACTION_PENDING])}}"
                                class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Check-ins</p>
                                    <span class="badge badge-info right">{{ $checkInsCounts }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transactions.index',['transaction_type_id' => TRANSACTION_PAYMENT,'status' => TRANSACTION_PENDING])}}"
                                class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payment</p>
                                    <span class="badge badge-info right">{{ $paymentCounts }}</span>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transactions.index',['transaction_type_id' => TRANSACTION_GOOGLE_REVIEW,'status' => TRANSACTION_PENDING])}}"
                                class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Google Reviews</p>
                                    <span class="badge badge-info right">{{ $googleCounts }}</span>

                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('transactions.index',['transaction_type_id' => TRANSACTION_FACEBOOK_REVIEW,'status' => TRANSACTION_PENDING])}}"
                                class="nav-link ultra-sidebar">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Facebook Reviews</p>
                                    <span class="badge badge-info right">{{ $facebookCounts }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(auth()->guard('admin')->user()->role == 0)
                    <li class="nav-header ultra-sidebar">Settings</li>
                    <li class="nav-item">
                        <a class="nav-link ultra-sidebar">
                            <i class="nav-icon  fa fa-cog"></i>
                            <p>
                            Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('register.admin')}}" class="nav-link ultra-sidebar">
                                    <p>Create Admin Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('register.reseptionist') }}"
                                class="nav-link ultra-sidebar">
                                    <p>Create Receptionist Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('show.admin')}}"
                                class="nav-link ultra-sidebar">
                                    <p>Show Admin Accounts</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('show.reseptionist')}}"
                                class="nav-link ultra-sidebar">
                                    <p>Show Receptionist Accounts</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">@yield('header')</h3>
                </div>
                @if(session()->has('msg'))
                    <div class="info-msg dark:bg-gray-800 bg-blue m-2 p-2">
                        <i class="fa fa-info-circle"></i>
                        {{ session('msg') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @yield('content')
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer">
                  Footer
                </div> -->
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <!-- <b>Version</b> 3.2.0 -->
        </div>
        <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@yield('scripts')
</body>
</html>

<style>
.ultra-sidebar{
    color: #fff !important;
}
.ultra-search{
    background-color: #266caa29 !important;
    border: 1px solid #fff !important;
    color: white !important;
}
</style>