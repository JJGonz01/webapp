@extends('master')

@section('login')


<head>
<meta charset="utf-8">
    <!--Nuevo-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/navbar.css">
    <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/items.css">
     <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/web-right-items.css">
     <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/create-menu.css">
     <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/CSS/therapy-create-menu.css">

    <!--VIEJO-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"rel="stylesheet">

    <!--ICONSÇ-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   

    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
   
    
</head>

<body>
    <script src="https://pomodoroadhdapp.azurewebsites.net/javascript/navbar.js"></script>
    <!-- JS SCRIPTS PARA TODA LA WEB-->
    

    <!-- NAVBAR-->
    <div class="navbar-web">
        <div class="navbar-vertical" id="vertical_nv">
                    <button onClick="navbarButton()" class="material-symbols-outlined" id="navbar_button">menu</button>

                    <form id="form_crear_sesion"  action="{{route('general', [], false, true)}}" method="GET">
                        <button id="nav_bar_home">
                            <span class="material-symbols-outlined">home</span>
                            <div class="hide-text">
                                <p id="navbar-1">GENERAL</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('patients_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_patients">
                            <span class="material-symbols-outlined">group</span>
                            <div class="hide-text">
                                <p id="navbar-2">PACIENTES</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('therapies_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_therapies">
                            <span class="material-symbols-outlined">punch_clock</span>
                            <div class="hide-text">
                                <p  id="navbar-3">TERAPIAS</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('help', [], false, true)}}" method="GET">
                        <button id="nav_bar_info">
                            <span class="material-symbols-outlined">info</span>
                            <div class="hide-text">
                                <p id="navbar-4">AYUDA</p>
                            </div>
                        </button>
                    </form>
        </div>
        
        <div class="navbar-right-items">
            <div class="navbar-horizontal-container">
                <div class="navbar-horizontal">
                    <div class=" button-small-navbar" id ="navbar_button_hor" ><button onClick="navbarButton()" class="material-symbols-outlined" id="navbar_button_horizontal">menu</button></div>
                    <p id="current-tab">General</p>
                    <form action="{{route('home', [], false, true)}}" id= 'form_pat' method="GET">
                    @if(null == (auth()->user()))    
                        <div class="row-items"><button id="navbar_login_text_button">INICIA SESIÓN</button><button id="navbar_login_img_button" class="material-symbols-outlined">account_circle</button></div>
                    @else
                        <div class="row-items"><button id="navbar_login_text_button">{{auth()->user()->name}}</button><button id="navbar_login_img_button" class="material-symbols-outlined">account_circle</button></div>
                    @endif
                    </form>
                </div> 
            </div>

            @if(null !== (auth()->user()))
            <div class="navbar-right-items-container-items">
                @yield('patients_section')
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




