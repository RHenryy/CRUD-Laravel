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
    <script src="{{ asset('js/modal.js') }}" defer></script>
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

<body class="">
    <div id="">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm p-3">
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
                        @guest
                            <li class="nav-item link"><a class="navbar-brand" href="/">Toutes nos locations</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/agencies">Nos agences</a></li>
                            <li class="nav-item link"><a class="navbar-brand" href="/locations">Nos appartments</a></li>
                        @endguest
                        @if (Auth::user() && Auth::user()->role === 1)
                            <li class="nav-item link"><a class="navbar-brand" href="/">Toutes nos locations</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/admin/agencies">Nos agences</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/admin/locations">Nos
                                    appartments</a>
                            </li>
                        @endif
                        @if (Auth::check() && Auth::user()->role === 3)
                            <li class="nav-item link"><a class="navbar-brand" href="/">Toutes nos locations</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/manager/agencies">Votre
                                    agence</a>
                            <li class="nav-item link"><a class="navbar-brand" href="/manager/locations">Vos
                                    annonces</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/manager/agents">Vos
                                    agents</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand"
                                    href="/manager/agency/messages/{{ Auth::user()->id }}">Messages
                                    envoyés à l'agence</a></li>
                        @endif

                        @if (Auth::check() && Auth::user()->role === 2)
                            <li class="nav-item link"><a class="navbar-brand" href="/">Toutes nos locations</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/agent/agencies">Votre
                                    agence</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/agent/locations">Vos
                                    annonces</a></li>
                            <li class="nav-item link"><a class="navbar-brand" href="/agent/messages/"
                                    {{ Auth::user()->id }}>Vos Rendez-Vous</a></li>
                        @endif
                        @if (Auth::user() && Auth::user()->role === 1)
                            <li class="nav-item link"><a class="navbar-brand" href="/admin/members">Les membres</a>
                            </li>
                            <li class="nav-item link"><a class="navbar-brand" href="/admin/orders">Orders</a></li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item link">
                                    <a class="navbar-brand" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item link">
                                    <a class="navbar-brand" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            {{-- <div id="nightmode">
                                <li class="nav-item">
                                    XXXX
                                </li>
                            </div> --}}
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
                                <a class="navbar-brand" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
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
    <footer>
        <div class="navbar navbar-expand-md navbar-light shadow-sm p-3 mt-3">
            <ul class="navbar-nav me-auto">
                <li class="link nav-item navbar-brand">Vous aussi souhaitez être référencé par notre site ? N'hésitez
                    plus
                    ! <a href="mailto:veville@veville.com" class="text-white">Contactez-nous !</a>
                </li>
            </ul>
            <ul class="navbar-nav me-auto">
                <li class="nav-item navbar-brand"><a class="fa-brands fa-instagram fa-2x" href=""></a>
                </li>
                <li class="nav-item navbar-brand"><a class="fa-brands fa-facebook fa-2x" href=""></a>
                </li>
                <li class="nav-item navbar-brand"><a class="fa-brands fa-twitter fa-2x" href=""></a>
                </li>
            </ul>
            <ul class="removeDot me-auto">
                <li><a class="externalLinks navbar-brand" href="">Nos valeurs</a></li>
                <li><a class="externalLinks navbar-brand" href="">Notre parcours</a></li>
                <li><a class="externalLinks navbar-brand" href="">Nos partenaires</a></li>
            </ul>

        </div>
        <div>
            <ul class="navbar-nav m-auto fw-bold">
                <li class="nav-item navbar-brand m-auto">© 2022 Veville. All rights reserved.</li>
            </ul>
        </div>
    </footer>
</body>

</html>
