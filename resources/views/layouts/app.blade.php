<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/all.min.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha512-ANkGm5vSmtDaoFA/NB1nVJzOKOiI4a/9GipFtkpMG8Rg2Bz8R1GFf5kfL0+z0lcv2X/KZRugwrAlVTAgmxgvIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css" integrity="sha512-wtjMa8AnvUyCbLxFg1jLR88gSACq81IiYgtIVdeNo3k+M8rdo4JdfScn7WxbZDsxZxFyDOEpMqOvYCzpSM6hnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.19/sweetalert2.all.js" integrity="sha512-/vz9zuhaRh2nY4tgFy//B52ghWGt9+iOCYKr1OOmjYpCb68khSixntYopw1vgEdO3620Pmq3gi4WmwTQhv7Zrg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.19/sweetalert2.js" integrity="sha512-aHnB3LFndNLgXg5fdpZgrpi/EAv1rQvWdb49E/PbcbPfcx6tCLcxkd4wd0kNglIv6m4m5+V8iz2FUS8jpyzPAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <style>
        .toggle-handle{
            background-color:rgba(255,255,255,0.8) !important;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('home')) active @endif" href="{{ route('home') }}">Main</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('city')) active @endif" href="{{ route('city') }}">Villes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('country'))  active @endif" href="{{ route('country') }}">Pays</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('devise'))  active @endif" href="{{ route('devise') }}">Divisé</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('trailer'))  active  @endif" href="{{ route('trailer') }}">Remoque</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(request()->is('trailertype')) active @endif" href="{{ route('trailertype') }}">Type de remoque</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/main.js') }}" defer></script>
    <script>
        $('.datatable').DataTable();
    </script>
</body>
</html>
