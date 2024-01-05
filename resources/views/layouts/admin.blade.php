<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title')</title>
    {{-- Stylesheet --}}
    @stack('prepend-style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/fh-3.4.0/r-2.5.0/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    @stack('addon-style')

</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar Menu -->
            <div class="border-right" id="sidebar-wrapper" data-aos="fade-right" data-aos-duration="800">
                <div class="sidebar-heading text-center">
                    <img src="/images/admin.png" alt="" class="my-4" style="max-width: 150px" />
                </div>
                <a href="{{ route('admin-dashboard') }}" class="list-group-item list-group-item-action">
                    Dashboard
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Products
                </a>
                <a href="{{ route('category.index') }}"
                    class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">

                    Categories
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Transactions
                </a>
                <a href="{{ route('user.index') }}"
                    class="list-group-item list-group-item-action {{ request()->is('admin/user*') ? 'active' : '' }}">
                    Users
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    Sign Out
                </a>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top " data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo;Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">

                            <!-- Dekstop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        <img src="/images/icon-user.png" alt="icon-user"
                                            class="rounded-circle mr-2 profile-picture" />
                                        Hi, Angga
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="/index.html" class="dropdown-item">Logout</a>
                                    </div>
                                </li>

                            </ul>

                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> Hi, Angga </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link d-inline-block"> Cart </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/fh-3.4.0/r-2.5.0/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $('#menu-toggle').click(function(e) {
            e.preventDefault();
            $('#wrapper').toggleClass('toggled');
            AOS.refresh();
        });
    </script>
    @stack('addon-script')

</body>

</html>
