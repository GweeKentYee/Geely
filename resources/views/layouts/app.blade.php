<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name','Geely') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/usedcarimage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/usedcardetails.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    @yield('css')

    <link rel="stylesheet" type = "text/css" href = "//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
    @if (session('status'))
        <div style="background: red;color: white">{{ session('status') }}</div>
    @endif
    <div id="app">

        {{-- sidebar --}}
        <div class="wrapper">
            <!-- Sidebar  -->
                <nav id="sidebar" class="d-none d-lg-block d-xl-block">

                    <div class="sidebar-header">
                        <h3><a class="sidebar-link" href="/">Geely</a></h3>
                    </div>

                    <ul class="list-unstyled components">
                        @guest
                            <li>
                                <a class="sidebar-link" href="/">Dashboard</a>
                            </li>
                            <li>
                                <a class="sidebar-link" href="/catalogue">Catalogue</a>
                            </li>

                        @else
                            @if (Auth::user()->status == 'Admin')
                                <li>
                                    <a class="sidebar-link" href = "/admin/newsletter">Manage Newsletter</a>
                                </li>
                                <li>
                                    <a class = "sidebar-link" href = "/admin/brand_model_variant">Brand/Model/Variant</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href = "/admin/car">Car</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href = "/admin/inspection">Inspection</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href = "/admin/usedcar">Used Car</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href = "/admin/register">Register New Admin</a>
                                </li>
                                <hr>
                                <li>
                                    <a class="sidebar-link" href="/">Dashboard</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href="/catalogue">Catalogue</a>
                                </li>


                            @else
                                <li>
                                    <a class="sidebar-link" href="/">Dashboard</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href="/catalogue">Catalogue</a>
                                </li>
                                <li>
                                    <a class="sidebar-link" href="/collection">Collection</a>
                                </li>

                            @endif

                        @endguest

                    </ul>

                </nav>
                <!-- Page Content  -->
                <div id="content">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                            <button type="button" id="sidebarCollapse" class="btn d-none d-lg-block d-xl-block">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <button class="btn d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <ul id="login-register-ul" class="navbar-nav ms-auto d-lg-none d-xl-none">
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item" id="login">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item" id="register">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item" id="register">
                                        {{ Auth::user()->name }}
                                    </li>
                                @endguest
                            </ul>


                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="nav navbar-nav ml-auto d-lg-none d-xl-none">
                                    @guest
                                        <li class="nav-item active">
                                            <a class="nav-link dashboard" href="/">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/catalogue">Catalogue</a>
                                        </li>
                                    @else
                                        @if (Auth::user()->status == 'Admin')
                                            <li class="nav-item active">
                                                <a class="nav-link" href = "/admin/inspection">Inspection</a>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href = "/admin/newsletter">Manage Newsletter</a>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href = "/admin/car">Car</a>
                                            </li>
                                            <li class="nav-item active">
                                                <a class="nav-link" href = "/admin/usedcar">Used Car</a>
                                            </li>

                                            <li class="nav-item active">
                                                <a class="nav-link" href = "/admin/brand_model_variant">Brand/Model/Variant</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        @else
                                            <li class="nav-item active">
                                                <a class="nav-link" href="/">Dashboard</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/catalogue">Catalogue</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/collection">Collection</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        @endif

                                    @endguest

                                </ul>


                            </div>


                        </div>

                        <ul id="login-register-ul" class="navbar-nav ms-auto">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item  d-none d-lg-block d-xl-block" id="login">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item  d-none d-lg-block d-xl-block" id="register">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                {{-- <li class="nav-item d-none d-lg-block d-xl-block" id="user-name">
                                    {{ Auth::user()->name }}
                                </li> --}}
                                <li class="nav-item dropdown d-none d-lg-block d-xl-block">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                            @endguest
                        </ul>

                    </nav>

                    @yield('content')

                </div>

        </div>

    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>

    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });

</script>
@yield('footer-scripts')
</html>
