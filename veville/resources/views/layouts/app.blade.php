<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/night-mode.js') }}" defer></script>
    <script src="{{ asset('js/carousel.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/82b9f37ffc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/carousel.css') }}" rel="stylesheet">
</head>

<body class="mt-3">
    <div id="">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    Retour à nos locations
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="navbar-brand" href="/">Toutes nos locations</a></li>
                        <li class="nav-item"><a class="navbar-brand" href="/agencies">Nos agences</a></li>
                        <li class="nav-item"><a class="navbar-brand" href="/locations">Nos appartments</a></li>
                        @if (Auth::user() && Auth::user()->role == 1)
                            <li class="nav-item"><a class="navbar-brand" href="/admin/members">Les membres</a>
                            </li>
                            <li class="nav-item"><a class="navbar-brand" href="/admin/orders">Orders</a></li>
                        @endif
                        @if (Auth::user() && Auth::user()->role == 2)
                            <li class="nav-item"><a class="navbar-brand" href="/agent/messages/"
                                    {{ Auth::user()->id }}>Vos Rendez-Vous</a></li>
                        @endif



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
                            <div id="nightmode">
                                <li class="nav-item">
                                    XXXX
                                </li>
                            </div>
                        @else
                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                            <li class="nav-item">

                                <a class="navbar-brand" href="/home">Hello <span
                                        style="color: blue">{{ Auth::user()->name }}!</span></a>
                            </li>
                            <li>
                                <a class="navbar-brand" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                    </div>
                    </li>
                @endguest
                </ul>
            </div>
    </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    </div>

</body>

</html>
