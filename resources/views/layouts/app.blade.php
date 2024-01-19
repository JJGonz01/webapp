@extends('master')

@section('login')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>USUARIO</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="https://www.pomodoro.ovh/styles/CSS/auth.css">
    <link rel="stylesheet" href="https://www.pomodoro.ovh/styles/CSS/items.css">

    <!-- Scripts -->
    <script src="https://www.pomodoro.ovh/resources/js/app.js"></script>


</head>
<body>

    <div id="app" class="auth-general-container" style="z-index:20;">
            <div>
                
                <div id="navbarSupportedContent">

                    <main class="py-4">
                       @yield('content')
                    </main>
                    <!-- Right Side Of Navbar -->
                    <div >
                        <!-- Authentication Links -->
                        @guest
                           

                           
                        @else
                            <div class="right-login-container" style="margin-top:1%; color: grey;">
                                
                                <div class="button-column" onclick="printClickedId(this)" id="ir-app-button" aria-labelledby="navbarDropdown">
                                    <form action="{{ route('main', [], false, true) }}" method="GET">
                                        <button class="login-create-button" id="go_to_app">
                                            {{ __('Ir a la aplicación') }}
                                        </button>
                                    </form>
                                    <div>
                                        
                                    </div>
                                    <form id="logout-form" action="{{ route('logout', [], false, true) }}" method="POST" class="d-none">
                                        @csrf
                                        <button id="cerrar-session-button" class="close-create-button" href="{{ route('main',[],false, true) }}">
                                            {{ __('Cerrar sesión') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest 
                    </div>
                </div>
            </div>

    </div>
</body>
</html>
