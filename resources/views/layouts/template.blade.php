<!DOCTYPE html>
<html lang="en" data-bs-theme="white">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Keterlambatan</title>
    {{-- link Css & Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.7.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Main wrapper -->
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <!-- Sidebar logo -->
                <div class="sidebar-logo" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <a class="fs-5" href="#">Rekap Keterlambatan</a>
                </div>
                <!-- Sidebar navigation -->
                <ul class="sidebar-nav">
                    <!-- Dashboard link -->
                    <li class="sidebar-item">
                        <a href="{{ Auth::user()->role === 'admin' ? route('home') : route('homePs') }}" class="sidebar-link">
                            <i class="ri-dashboard-line"></i> Dashboard
                        </a>
                    </li>

                    <!-- Data Master section -->
                    @if (Auth::check() && Auth::user()->role == "admin")
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="ri-bubble-chart-line"></i> Data Master
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- Data Rayon link -->
                            <li class="sidebar-item">
                                <a href="{{ route('rayons.index') }}" class="sidebar-link">
                                    Data Rayon
                                </a>
                            </li>
                            <!-- Data Rombel link -->
                            <li class="sidebar-item">
                                <a href="{{ route('rombels.index') }}" class="sidebar-link">
                                    Data Rombel
                                </a>
                            </li>
                            <!-- Data Siswa link -->
                            <li class="sidebar-item">
                                <a href="{{ route('students.index') }}" class="sidebar-link">
                                    Data Siswa
                                </a>
                            </li>
                            <!-- Data User link -->
                            <li class="sidebar-item">
                                <a href="{{ route('users.index') }}" class="sidebar-link">
                                    Data User
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <!-- Data Keterlambatan link -->
                    @if (Auth::check())
                    @if (Auth::check() && Auth::user()->role == "ps")
                    <li class="sidebar-item">
                        <a href="{{ Auth::user()->role == 'ps' ? route('ps.student.indexPs') : '#' }}" class="sidebar-link">
                            <i class="ri-dashboard-line"></i>
                            Data Siswa
                        </a>
                    </li>
                    @endif
                    <li class="sidebar-item">
                        <a href="{{ Auth::user()->role == 'admin' ? route('admin.lates.data') : route('ps.lates.data') }}"
                            class="sidebar-link">
                            <i class="ri-dashboard-line"></i>
                            Data Keterlambatan
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </aside>

        <!-- Main content -->
        <div class="main">
            <!-- Navbar -->
            <nav class="navbar navbar-expand px-3 border-bottom bg-white" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.418);">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <!-- User dropdown menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i> @if(Auth::check())
                                {{ Auth::user()->name }}
                                @else
                                User not authenticated
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content container -->
            <div class="container mt-5">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Script includes -->
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/nav.js') }}"></script>

    <!-- Feather icons replacement -->
    <script>
        feather.replace();
    </script>

    <!-- Conditional script inclusion -->
    @if(isset($script) && $script)
    @else
</body>

</html>
@endif