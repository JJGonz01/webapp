@extends('master')

@section('login')


<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="{{asset('/css/dashboards/general.css')}}">
    <!--https://themes.getbootstrap.com/preview/?theme_id=107272--> 
    <!--https://fontawesome.com/search?q=lock&o=r--> 
</head>

<body>
<button type="button" class="btn btn-primary d-md-none fixed-top w-100" style="margin-bottom:10px">Nuevo Botón</button>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light navbar">
                <div class="sidebar-sticky">
                    <div>
                        <img id="img-logo" src="{{asset('/images/logorm.png')}}">
                        <button class="button-no-border" style="font-family: Arial, FontAwesome;">&#xf013;</button>
                    </div>
                    <ul class="nav flex-column">
                     
                        <li class="nav-item">
                            <a class="nav-link" href="/general">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/patients">Pacientes</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/therapies">Planes de estudio</a>
                        </li>

                    </ul>
                </div>
                
            <div class="fixed-bottom p-3">
                <form id="form_crear_sesion" action="{{route('home', [], false, true)}}" method="GET">
                    <button id="nav_bar_info">
                        <div>
                            <p id="navbar-4">Perfil</p>
                        </div>
                    </button>
                </form>
            </div>
            </nav>
            
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="containter container-title">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title">
                                <h1>Dashboard</h1>
                                <p>General</p>
                            </div>  
                        </div>

                        <div class="col-md-6">
                            <div class="container-align-end">
                                <div class="container-top-input">
                                    <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                                    <input placeholder="Buscar"></input>
                                </div>
                                <button><span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf0e7;</span></button>
                                <button><span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf0f3;</span></button>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('patients_section')
            </main>
        </div>
    </div>
    <!--div class="navbar-web">
        <button class="navbar-menu-selector" onclick="navbarButton()">Menu</button>
        <div id="vertical_nv">

        <div>
                    <form id="form_crear_sesion"  action="{{route('general', [], false, true)}}" method="GET">
                        <button id="nav_bar_home">
                            <span class="material-symbols-outlined">home</span>
                            <div>
                                <p id="navbar-1">General</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('patients_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_patients">
                            <span class="material-symbols-outlined">group</span>
                            <div>
                                <p id="navbar-2">Pacientes</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('therapies_index', [], false, true)}}" method="GET">
                        <button id="nav_bar_therapies">
                            <span class="material-symbols-outlined">punch_clock</span
                                <p  id="navbar-3">Terapias</p>
                            </div>
                        </button>
                    </form>

                    <form id="form_crear_sesion"  action="{{route('forum', [], false, true)}}" method="GET">
                        <button id="nav_bar_info">
                            <span class="material-symbols-outlined">info</span
                            <div>
                                <p id="navbar-4">Foro</p>
                            </div>
                        </button>
                    </form>

        </div>
        <div class="general-navbar-vertical">     
               
            <form id="form_crear_sesion" action="{{route('home', [], false, true)}}" method="GET">
                <button id="nav_bar_info" class="dissapear_button">
                    -span class="material-symbols-outlined">account_circle</span
                    <div class="hide-text">
                        <p id="navbar-4">Perfil</p>
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
        <script>navbarStart()</script> </div-->
    </div>
</body>