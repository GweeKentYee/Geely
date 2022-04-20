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
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('css/catalogue.css') }}" rel="stylesheet">
    <link rel="stylesheet" type = "text/css" href = "//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <style>
        #Bonnet path{
            fill:red;
        }
        #Front_Right_Door path{
            fill:aquamarine;
        }
        #Rear_Right_Door path{
            fill:blanchedalmond;
        }
        #Trunk path{
            fill:orange;
        }
        #Front_Right_Wheel_Arc path{
            fill:cornflowerblue;
        }
        #Rear_Right_Wheel_Arc path{
            fill:cyan;
        }
        #Front_Left_Wheel_Arc path{
            fill:darkseagreen;
        }
        #Rear_Left_Wheel_Arc path{
            fill:darkgoldenrod;
        }
        #Right_Center_Pillar path{
            fill:blueviolet;
        }
        #Left_Center_Pillar path{
            fill:rgb(110, 226, 43);
        }
        #Rear_Bumper path{
            fill: yellow;
        }
        #Front_Bumper path{
            fill: green;
        }
        #Roof_Panel path{
            fill: blue;
        }
        #Right_Sill_Plate path{
            fill: purple;
        }
        #Left_Sill_Plate path{
            fill:darkgreen;
        }
        #Front_Left_Door path{
            fill:moccasin;
        }
        #Rear_Left_Door path{
            fill:rebeccapurple;
        }
        #Rear_Quarter_Pillar path{
            fill:darkred;
        }
        #Screen_Pillar path{
            fill:fuchsia;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    @livewireStyles
</head>
<body>
    @if (session('status'))
        <div style="background: red;color: white">{{ session('status') }}</div>
    @endif
    <div id="app">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Geely') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    @if (Auth::user()->status == 'Admin')

                                    <a class = "dropdown-item" href = "/admin/inspection">Inspection</a>
                                    <a class = "dropdown-item" href = "/admin/catalogue">Manage Catalogue</a>
                                    <a class = "dropdown-item" href = "/admin/newsletter">Manage Newsletter</a>
                                    <a class = "dropdown-item" href = "/admin/carmodel">Car Model</a>
                                    <a class = "dropdown-item" href = "/admin/car">Car</a>
                                    <a class = "dropdown-item" href = "/admin/brand_model_variant">Brand/Model/Variant</a>
                                    <a class = "dropdown-item" href = "/admin/carbrand">Car Brand</a>
                                    <a class = "dropdown-item" href = "/admin/carmodel">Car Model</a>
                                    <a class = "dropdown-item" href = "/admin/carvariant">Car Variant</a>

                                    @else

                                    <a class = "dropdown-item" href = "/">Dashboard</a>
                                    <a class = "dropdown-item" href = "/catalogue">Catalogue</a>
                                    <a class = "dropdown-item" href = "/collection">Collection</a>

                                    @endif

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
                </div>
            </div>
        </nav> --}}

        {{-- sidebar --}}
        <div class="wrapper">
            <nav id="sidebar" class="d-none d-lg-block d-xl-block">

                <div class="sidebar-header">
                    <h3>Geely</h3>
                </div>

                <ul class="list-unstyled components">
                    @guest
                        <li>
                            <a href="/">Dashboard</a>
                        </li>
                        <li>
                            <a href="/catalogue">Catalogue</a>
                        </li>
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if (Auth::user()->status == 'Admin')
                            <li>
                                <a href = "/admin/inspection">Inspection</a>
                            </li>
                            <li>
                                <a href = "/admin/catalogue">Manage Catalogue</a>
                            </li>
                            <li>
                                <a href = "/admin/newsletter">Manage Newsletter</a>
                            </li>
                            <li>
                                <a href = "/admin/carmodel">Car Model</a>
                            </li>
                            <li>
                                <a href = "/admin/car">Car</a>
                            </li>
                            <li>
                                <a href = "/admin/brand_model_variant">Brand/Model/Variant</a>
                            </li>
                            <li>
                                <a href = "/admin/carbrand">Car Brand</a>
                            </li>
                            <li>
                                <a href = "/admin/carmodel">Car Model</a>
                            </li>
                            <li>
                                <a href = "/admin/carvariant">Car Variant</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>

                        @else
                            <li>
                                <a href="/">Dashboard</a>
                            </li>
                            <li>
                                <a href="/catalogue">Catalogue</a>
                            </li>
                            <li>
                                <a href="/collection">Collection</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
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

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto d-lg-none d-xl-none">
                                @guest
                                    <li class="nav-item active">
                                        <a class="nav-link" href="/">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/catalogue">Catalogue</a>
                                    </li>
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    @if (Auth::user()->status == 'Admin')
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/inspection">Inspection</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/catalogue">Manage Catalogue</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/newsletter">Manage Newsletter</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/carmodel">Car Model</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/car">Car</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/brand_model_variant">Brand/Model/Variant</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/carbrand">Car Brand</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/carmodel">Car Model</a>
                                        </li>
                                        <li class="nav-item active">
                                            <a class="nav-link" href = "/admin/carvariant">Car Variant</a>
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
                </nav>

                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
</body>

<script>

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

</script>
@yield('footer-scripts')
</html>
