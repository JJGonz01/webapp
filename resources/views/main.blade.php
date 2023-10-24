@extends('master')

@section('login')


<head>
<meta charset="utf-8">
    <!--Nuevo-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://pomodoroadhdapp.azurewebsites.net/styles/main.css">
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
                        <button id="nav_bar_home" class="dissapear_button">
                            <span class="material-symbols-outlined">home</span>
                            <div class="hide-text">
                                <p id="navbar-1">GENERAL</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('patients_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_patients" class="dissapear_button">
                            <span class="material-symbols-outlined">group</span>
                            <div class="hide-text">
                                <p id="navbar-2">PACIENTES</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('therapies_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_therapies" class="dissapear_button">
                            <span class="material-symbols-outlined">punch_clock</span>
                            <div class="hide-text">
                                <p  id="navbar-3">TERAPIAS</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('help', [], false, true)}}" method="GET">
                        <button id="nav_bar_info" class="dissapear_button">
                            <span class="material-symbols-outlined">info</span>
                            <div class="hide-text">
                                <p id="navbar-4">AYUDA</p>
                            </div>
                        </button>
                    </form>

                    
                    <form id="form_crear_sesion" action="{{route('home', [], false, true)}}" method="GET">
                        <button id="nav_bar_info" class="dissapear_button">
                            <span class="material-symbols-outlined">account_circle</span>
                            <div class="hide-text">
                                <p id="navbar-4">MI PERFIL</p>
                            </div>
                        </button>
                    </form>
        </div>
        
        <div class="navbar-right-items">
            
            @if(null !== (auth()->user()))
            <div class="navbar-right-items-container-items">
                @yield('patients_section')
            </div>
            <div class="master-test">
                <div id="in-task-container" class="in-row-container" style="display:block;">
                    <button id="task-show-btn" onclick="showhidetext()" class="acabar-tarea-btn">OCULTAR TAREA</button>
                    <p id="in-task-text" style="style:block;"></p>
                    <button id="task-end-btn" onclick="endTask()" class="acabar-tarea-btn">ACABAR TAREA</button>
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