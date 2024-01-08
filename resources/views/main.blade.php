@extends('master')

@section('login')


<head>
<meta charset="utf-8">
    <!--Nuevo-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="{{asset('styles/main.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/navbar.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/reglas.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/items.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/web-right-items.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/create-menu.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/therapy-create-menu.css')}}">
     <link rel="stylesheet" href="{{asset('styles/CSS/edition-clock.css')}}">
    <!--VIEJO-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"rel="stylesheet">

    <!--ICONS-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   

    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
   
    
</head>

<body>
    <script src="{{asset('javascript/navbar.js')}}"></script>
    <div class="navbar-web">
        <button class="navbar-menu-selector" onclick="navbarButton()">Menu</button>
        <div class="navbar-vertical" id="vertical_nv">
            
        <div class="general-navbar-vertical">
                    <form id="form_crear_sesion"  action="{{route('general', [], false, true)}}" method="GET">
                        <button id="nav_bar_home">
                            <!--span class="material-symbols-outlined">home</span-->
                            <div>
                                <p id="navbar-1">General</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('patients_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_patients">
                            <!--span class="material-symbols-outlined">group</span-->
                            <div>
                                <p id="navbar-2">Pacientes</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('therapies_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_therapies">
                            <!--span class="material-symbols-outlined">punch_clock</span-->
                            <div>
                                <p  id="navbar-3">Terapias</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('help', [], false, true)}}" method="GET">
                        <button id="nav_bar_info">
                            <!--span class="material-symbols-outlined">info</span-->
                            <div>
                                <p id="navbar-4">Ayuda</p>
                            </div>
                        </button>
                    </form>

        </div>
        <div class="general-navbar-vertical">     
               
            <form id="form_crear_sesion" action="{{route('home', [], false, true)}}" method="GET">
                <button id="nav_bar_info" class="dissapear_button">
                    <!--span class="material-symbols-outlined">account_circle</span-->
                    <div class="hide-text">
                        <p id="navbar-4">Perfil</p>
                    </div>
                </button>
            </form>
        </div>
        </div>
        
        <div class="navbar-right-items">
            @if(null !== (auth()->user()))
                <div class="navbar-right-items-container-items">
                    @yield('patients_section')
                </div>
                <div class="master-test">
                    <div id="in-task-container" style="display:block;">
                        <p id="in-task-text" style="style:block;"></p>
                    </div>
                </div>
            @else
                <div class="navbar-right-items-container-items">
                    <div class = "session-necessary-contaner">
                            <form action="{{route('login', [], false, true)}}" id= 'form_pat' method="GET">
                                <p>Es necesario iniciar sesión</p>
                                <p>para utilizar la plataforma</p>
                                <button id="home_gotologin_btn">IR A INICIAR SESIÓN</button>
                            </form>
                    </div>  
                </div>
            @endif
        </div>
        <script>navbarStart()</script>
    </div>
</body>