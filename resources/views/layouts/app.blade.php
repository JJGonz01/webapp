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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('/css/auth/auth.css')}}">
    <link rel="stylesheet" href="{{asset('/css/auth/test.css')}}">

</head>
<body>

    <div id="app">
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
                        <div class="container-logo">
                            <img id="img-logo" src="{{asset('/images/logorm.png')}}">
                        </div>
                        <div class="container-login">
                            <div class="container-change-login">

                                <h1>Mi perfil</h1>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <p id="navbarDropdown">
                                    Usuario: {{  Auth::user()->name }}
                                </p>
                                <p>
                                    Correo: {{  Auth::user()->email }}
                                </p>
                            </div>
                                
                            <form action="{{ route('main', [], false, true) }}" method="GET">
                                <button class="btn btn-primary btn-block" style="border-radius:15px;" id="go_to_app">
                                    {{ __('Ir a la aplicación') }}
                                </button>
                            </form>
                        
                            <form id="logout-form" action="{{ route('logout', [], false, true) }}" method="POST">
                                @csrf
                                <button id="cerrar-session-button" class="btn btn-primary btn-block" style="border-radius:15px;margin-top:20px;" href="{{ route('main',[],false, true) }}">
                                    {{ __('Cerrar sesión') }}
                                </button>
                            </form>
                        </div>
                        @endguest 
                    </div>
                </div>
            </div>

    </div>
</body>
</html>
