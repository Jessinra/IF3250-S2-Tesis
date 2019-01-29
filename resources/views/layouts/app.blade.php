<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/DateTimePicker.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Tesis Management
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
                      rel="stylesheet">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link text-color-white" href="{{ route('login') }}">Login</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-color-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdown">
                                    @if(Auth::user()->isManajer())
                                    <a class="dropdown-item text-color-primary" href="/dashboard/manajer">
                                        Dashboard Manajer
                                    </a>
                                    @endif
                                        @if(Auth::user()->isDosen())
                                            <a class="dropdown-item text-color-primary" href="/dashboard/dosen">
                                                Dashboard Dosen
                                            </a>
                                        @endif
                                        @if(Auth::user()->isMahasiswa())
                                            <a class="dropdown-item text-color-primary" href="/dashboard/mahasiswa">
                                                Dashboard Mahasiswa
                                            </a>
                                        @endif
                                        <a class="dropdown-item text-color-primary" href="/user/control/{{Auth::user()->username}}">
                                            Edit User
                                        </a>
                                    <a class="dropdown-item text-color-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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

    <!-- Scripts -->
    <script>
        function backpage() {
            window.history.back();
        }
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(document).ready(function()
        {
            $("#dtbox").DateTimePicker();
        });
    </script>
    @yield('bottomjs')
</body>
</html>
