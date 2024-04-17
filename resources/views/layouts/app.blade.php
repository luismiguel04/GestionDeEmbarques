<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GestionDeEmbarques') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('/logo.png') }}">
    <link rel="shortcut icon" sizes="192x192" href="{{ asset('/logo.png') }}">



    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--  data tables  -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />




    <!-- enlace para pwa -->
    @laravelPWA



</head>

<body>
    <div id="app">
        <!--  navbar bg-body-tertiary fixed-top
        navbar navbar-expand-md navbar-light bg-white shadow-sm -->


        <nav class="navbar  navbar-light  bg-white  ">
            <div class="container-fluid">


                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="justify-content-start">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('http://localhost/GestionDeEmbarques/storage/app/public/Logo.png') }}"
                            alt="Logo" width="auto" height="70px" class="d-inline-block align-text-center">

                    </a>

                </div>
                <div class="offcanvas offcanvas-start bg-white" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <img src="{{ asset('http://localhost/GestionDeEmbarques/storage/app/public/Logo.png') }}"
                            alt="Logo" width="auto" height="70px" class="d-inline-block align-text-center">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 list-group">
                            <li class=" list-group-item-luis  list-group-item-action">

                                <a class="nav-link " href="{{ url('index') }}"><i class="fas fa-fw fa-home fa-2x"></i>
                                    {{ __('Home') }}
                                </a>

                            </li>


                            <li class="list-group-item-luis  list-group-item-action">
                                <a class="nav-link group-item-action" href="{{ route('servicios.index') }}"><i
                                        class="fas fa-fw fa-server fa-2x"></i> {{ __('Servicios') }}</a>
                            </li>
                            <li class="list-group-item-luis  list-group-item-action">
                                <a class="nav-link" href="{{ route('actividades-fijas.index') }}"><i
                                        class="fas fa-fw fa-check-square  fa-2x">

                                    </i>

                                    {{ __('Actividades Fijas') }}


                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                                        class='fas fa-fw fa fa-ship fa-2x'></i>
                                    {{ __('Embarques') }}

                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('embarques.index') }}">
                                        {{ __('En Proceso') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('embarques.indexc') }}">
                                        {{ __('Historial') }}
                                    </a>
                                </div>
                            </li>
                            <li class="list-group-item-luis  list-group-item-action ">
                                <a class="nav-link " href="{{ route('pendientes') }}"><i
                                        class="fas fa-fw fa fa-address-card fa-2x"></i>
                                    {{ __('Pendientes') }}</a>
                            </li>

                            <li class="list-group-item-luis  list-group-item-action ">
                                <a class="nav-link " href="{{ route('clientes.index') }}"><i
                                        class="fas fa-fw fa-address-book fa-2x"></i>
                                    {{ __('Clientes') }}</a>

                            </li>
                            <li class="list-group-item-luis  list-group-item-action ">
                                <a class="nav-link " href="{{ route('contactos.index') }}"><i
                                        class="fas fa-fw fa fa-address-card fa-2x"></i>
                                    {{ __('Contactos') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                                        class='fas fa-fw fa fa-cog fa-2x'></i>
                                    {{ __('Lenguage') }}

                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('locale/es') }}">
                                        {{ __('Español') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ url('locale/en') }}">
                                        {{ __('Inglés') }}
                                    </a>
                                </div>
                            </li>



                            @guest
                            @if (Route::has('login'))
                            <li class="list-group-item-luis  list-group-item-action">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @endif

                            @if (Route::has('register'))
                            <li class="list-group-item-luis  list-group-item-action">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                                        class='fas fa-user-circle  fa-2x'> </i>

                                    {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
            </div>
        </nav>






        <main class="p-4">
            @yield('content')
        </main>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>





        @yield('script')
        @stack('js')
    </div>
</body>

</html>