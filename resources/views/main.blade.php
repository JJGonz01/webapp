@extends('master')

@section('login')


<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
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
</body>