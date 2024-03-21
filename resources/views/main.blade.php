@extends('master')

@section('login')


<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://pomodoro.ovh/JS/dashboards/tests/test.js"></script>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/general.css">
    <!--https://themes.getbootstrap.com/preview/?theme_id=107272--> 
    <!--https://fontawesome.com/search?q=lock&o=r--> 
</head>

<body>

<div class="test-icon-container" id="">
    <button onclick="openTestPopUp()">    
        <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf03a;</span>
    </button>
</div>

<div class="test-icon-container-help hidden" id="notification-test">
    <div class="row">
        <span class="col-md-2" style="font-family: Arial, FontAwesome; font-size:larger; color:green;">&#xf058;</span>
        <p class="col-md-10" id="test-notification-text">Has completado un hito ("Terminar")</p>
    </div>
</div>

<div class="test-container" id="popup-test-content-container" style="display:none;">
    <div class="test-container-content">
        <div class="row" id="test-content">
            <img class="col-4" src="https://pomodoro.ovh/images/kidtest.png">
            <div class="col-8">
                <h2>Bienvenido a la aplicación "Pomodoro"</h2>
                <p>
                    Durante esta sesión de pruebas, queremos comprobar las distintas funcionalidades
                    de esta aplicación. Queremos saber tu opinión para conseguir un sistema que permita
                    facilmente organizar sesiones de estudio con descansos, y en estas poder monitorizar las 
                    constantes del niño para poder interpretar sus distintas constantes, y mediante la iteración 
                    y el entendimiento, conseguir que mejore en sus estudios.
                </p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="checkboxTestReady">
                    <label class="form-check-label" for="flexCheckChecked">
                        Estoy preparado para comenzar
                    </label>
                </div>
                
                <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Siguiente</button></div>
            </div>
        </div>
    </div>
</div>


<button type="button" class="btn btn-primary d-md-none fixed-top w-100" style="margin-bottom:10px">Nuevo Botón</button>
    <div class="container-fluid">
        <div class="row">
            <nav class="sidebar-sticky col-md-2 d-none d-md-block navbar">
                <div>
                    <div>
                        <img id="img-logo" src="https://pomodoro.ovh/images/logorm.png">
                        <button class="button-no-border" style="font-family: Arial, FontAwesome;">&#xf013;</button>
                    </div>
                    <ul class="nav flex-column">
                     
                        <li class="nav-item nav-superitem">
                            <span class="span-navbar">&#xf015;</span>
                            <a class="nav-option" href="/general">Dashboard</a>
                        </li>

                        <li class="nav-item nav-superitem">
                            <span class="span-navbar">&#xf0c0;</span>
                            <a class="nav-option" href="/patients">Estudiantes</a>
                        </li>

                        <li class="nav-item nav-superitem">
                            <span class="span-navbar">&#xf02d;</span>
                            <a class="nav-option" href="/therapies">Planes de estudio</a>
                        </li>

                        <li class="nav-item nav-superitem">
                            <span class="span-navbar">&#xf007;</span>
                            <a class="nav-option" href="/">Mi perfil</a>
                        </li>

                        <li class="nav-item nav-superitem">
                            <span class="span-navbar">&#xf06e;</span>
                            <a class="nav-option" href="/admin">Administrador</a>
                        </li>

                    </ul>
                </div>
            </nav>
            
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="containter container-title">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="title" id="title-web">
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
    <script>getStep();</script>
</body>