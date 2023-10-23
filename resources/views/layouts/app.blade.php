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
    <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/auth.css">
    <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/items.css">

    <!-- Scripts -->
    <script src="https://pomodoroadhdapp.azurewebsites.net/resources/js/app.js"></script>


</head>
<body>
    <script>
        function eraseCookies(){
            var xhr = new XMLHttpRequest();

            xhr.open('GET', 'clear_cookies.php', true);

            xhr.onreadystatechange = function(){
                if(xhr.readyState === 4 && xhr.status === 200){
                    alert('cookies borradas');
                }
            }

            xhr.send();
        }
    
    </script>
    <div id="app" class="bg-text">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <h1>POMODORO WEB</h1>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>
                    <main class="py-4">
                       @yield('content')
                    </main>
                    <!-- Right Side Of Navbar -->
                    <div class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                           

                           
                        @else
                            <div class="button-column">
                                <p id="navbarDropdown" class="nav-link dropdown-toggle">
                                    Usuario: {{  Auth::user()->name }}
                                </p>
                                <p>
                                    Correo: {{  Auth::user()->email }}
                                </p>
                                <div class="button-column" id="ir-app-button" aria-labelledby="navbarDropdown">
                                    <form action="{{route('main', [], false, true)}}" method="GET">
                                        <button class="login-create-button" id="go_to_app">
                                            {{ __('Ir a la aplicación') }}
                                        </button>
                                    </form>
                                    <div>
                                        
                                    </div>
                                    <form id="logout-form" action="{{route('logout', [], false, true)}}" method="POST" class="d-none">
                                        @csrf
                                        <button type="submit" id="cerrar-session-button" class="close-create-button" href="{{route('main', [], false, true)}}">
                                            {{ __('Cerrar sesión') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </div>
</body>
</html>
