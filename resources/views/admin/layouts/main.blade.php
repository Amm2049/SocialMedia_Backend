<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Media App</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> --}}
    <script src="https://kit.fontawesome.com/5d041c121e.js" crossorigin="anonymous"></script>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4"  style="background-color: black">
            <a href="{{ route('admin#profile') }}" class="brand-link">

                <span class="brand-text font-weight-light">Media Admin Panel </span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('admin#profile') }}" class="nav-link">
                                <i class="fas fa-user-circle"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#list') }}" class="nav-link">
                                <i class="fas fa-list"></i>
                                <p>
                                    Admins List
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#category') }}" class="nav-link">
                                <i class="fas fa-pizza-slice ms-5"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#post') }}" class="nav-link">
                                <i class="fas fa-users"></i>
                                <p>
                                    Posts
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin#trendingPosts') }}" class="nav-link">
                                <i class="fas fa-book"></i>
                                <p>
                                    Trending Posts
                                </p>
                            </a>
                        </li>

                        <li class="nav-item mt-2">

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="col w-100 bg-danger py-1 mb-3 btn text-white"
                                    type="submit">Logout</button>
                            </form>

                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        @yield('content')
                    </div>
                </div>
        </div>
        </section>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
@yield('script')

</html>
