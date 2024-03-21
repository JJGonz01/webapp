
@yield('session')

@extends('main')
@section('patients_section')

<head>

    <meta id = "bpm_val" content="{{$bpm_valores}}"></meta>
    <meta id = "move_val" content="{{$move_valores}}"></meta>
    <meta id = "limite_bpm" content="{{$limite_bpm}}"></meta>
    <meta id = "limite_move" content="{{$limite_move}}"></meta>
    <meta id = "reglas" content="{{$reglas}}"></meta>
    <meta id = "bpm_medios" content = "{{$bpm_medios}}"></meta>
    <meta id = "move_medios" content = "{{$move_medios}}"></meta>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--para la grafica-->
    <script src="https://pomodoro.ovh/session/sessionCompleted.js"></script>  
    <script src="https://pomodoro.ovh/JS/representation/session-representation.js"></script>  

    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients/patient-menu.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/representation/session-representation.css">
</head>
 
<body>
    <div class="container-padding">
        <button class="button-patient-selected" onclick="changeView('dash'); seleccionarBoton(this)">Resumen</button>
        <button class="button-patient" onclick="changeView('data'); seleccionarBoton(this)">Datos</button>
        <button class="button-patient" onclick="changeView('other'); seleccionarBoton(this)">Comparativa</button>
    </div>
    <div id="dash" name="views" style="display:block;">
        <div class="row">
            <div class="col-md-6 container-patient-slim">
                <h4>Sesión de relajación (bpm)</h4>
                <canvas id="tablebpm"></canvas>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5 container-patient-slim">
                <h4>Sesión de relajación (bpm)</h4>
                <div class="row">
                    <div class="col-md-6 container-information">
                        <div class="container-information">
                            <div class="container-information container-info">
                                <div class="row container-information">
                                    <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                                    <h7>Pulsacion media</h7> 
                                </div>
                                <h3 id="puls-media-rel">60 bpm</h3>
                            </div>
                        
                        </div>
                    
                    </div>
                    <div class="col-md-6 container-information">
                        <div class="container-information">
                            <div class="container-information container-info">
                                <div class="row container-information">
                                    <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                                    <h7>Mov. medio</h7> 
                                </div>
                                <h3 id="puls-media-rel">3.5 u</h3>
                            </div>
                        
                        </div>
                    
                    </div>
                </div>
                <div class="col-md-12 container-information">
                        <div class="container-information">
                            <div class="container-information container-info">
                                <div class="row container-information">
                                    <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                                    <h7>Última sesión de relajación</h7> 
                                </div>
                                <h3 id="puls-media-rel">(Más alto bpm) 65 bpm</h3>
                            </div>
                        
                        </div>
                    
                </div>
            </div>

            <div>
                <div>
                
                </div>
            </div>
        
        </div>
    </div>

    <div id="data"  name="views" style="display:none;">
        <div class="container-patient-slim">
            <button class="button-move-period" onclick="showCurrentPeriod(-1)"><</button>
            <button  class="button-move-period" onclick="showCurrentPeriod(1)">></button>
            <canvas id="sessiontable"></canvas>
        </div>
    </div>

    <div id="other" name="views"  style="display:none;">
        <div class="row">
            <div class="col-md-5 container-patient-slim">
                <div>
                    <select class="container-select" id="table-1">                    
                        <option value=1>Estudio 1</option>
                        <option value=2>Descanso 1</option>
                        <option value=3>Estudio 2</option>
                    </select>
                    <canvas id="graph-left"></canvas>
                </div>
                <div id="left-information"> 
                    <p>Informacion</p>
                    <p>Pulsación media: 63 bpm</p>
                    <p>Movimiento medio 1.4 u<p>

                <select class="container-select">                    
                    <option>Estudio 1</option>
                    <option>Descanso 1</option>
                    <option>Estudio 2</option>
                    <option>Escoger otra sesión</option>
                </select>
                <canvas id="graph-left"></canvas>
            </div>
       
            <div class="col-md-1"></div>
            <div class="col-md-5 container-patient-slim">
                <div class="container-information">
                    <div class="container-information container-info margin-container">
                        <div class="row container-information ">
                            <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                            <h7>Media de pulsaciones</h7> 
                        </div>
                        <h3 id="puls-media-rel">Pulsaciones/minuto: 61.9</h3>
                    </div>
                
                    <div class="container-information container-info margin-top  margin-container">
                        <div class="row container-information">
                            <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                            <h7>Media de movimiento</h7> 
                        </div>
                        <h3 id="puls-media-rel">Unidades movim: 1.4</h3>
                    </div>
                    <div class="container-information container-info">
                        <div class="row container-information">
                            <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                            <h7>Puntos obtenidos:</h7> 
                        </div>
                        <h3 id="puls-media-rel">Estrellas: 21</h3>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 container-patient-slim">
                <div>
                    <select class="container-select" id="table-2">
                        <option value=1>Estudio 1</option>
                        <option value=2>Descanso 1</option>
                        <option value=3>Estudio 2</option>
                    </select>
                    <canvas id="graph-right"></canvas>
                </div>
                <div id="right-information">
                    <p>Informacion</p>
                    <p>Pulsación media: 67 bpm</p>
                    <p>Movimiento medio 3.6 u<p>
                <div class="container-information">
                    <div class="container-information container-info margin-container">
                        <div class="row container-information">
                            <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                            <h7>Media de pulsaciones</h7> 
                        </div>
                        <h3 id="puls-media-rel">Pulsaciones/minuto: 63.7</h3>
                    </div>
                
                    <div class="container-information container-info  margin-container">
                        <div class="row container-information">
                            <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                            <h7>Media de movimiento</h7> 
                        </div>
                        <h3 id="puls-media-rel">Unidades movim: 3.2</h3>
                    </div>

                    <div class="container-information container-info">
                        <div class="row container-information">
                            <span style="font-family: Arial, FontAwesome; font-size:larger">&#xf21e;</span>
                            <h7>Puntos obtenidos:</h7> 
                        </div>
                        <h3 id="puls-media-rel">Estrellas: 13</h3>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>

<script>
    selectOptions("table-1", "graph-left",true);
    selectOptions("table-2", "graph-right",false);
    setTableWithOne(bpmdataset,'red',0.2,0,"tablebpm");    
    setTableWithTwo(bpmdataset, movedataset,'red',0.2, 3, 3);

    setTableWithTwoLeft(bpmdataset, movedataset,'red',0.2,1,1,"graph-left");
    setTableWithTwoRight(bpmdataset,movedataset, 'red',0.2, 3, 3,"graph-right");
</script>
<!--div class="general-items-container">

    <div id="prueba"></div>

  
        <div class="user-welcome-box">
            
            @if(auth()->user() !== null)
            <form action="{{route('patient_show', [$patientId], false, true)}}" method="GET">
                <button style="margin-left:50px;" class="user-welcome-box-container-button" id="create-patient-button">VOLVER A PACIENTE</button>
            </form>
            <h4>General</h4>
            
            <div class="user-welcome-box-container">
                <div class="home-welcome-box">
                    <button class="home-welcome-box-btn-selected" onclick = "setArticles(0)" id="btn_pom_info">DASHBOARD</button>
                    <button class="home-welcome-box-btn" onclick = "setArticles(1)" id="btn_app_info">INFORMACIÓN RELEVANTE</button>
                    <button class="home-welcome-box-btn" onclick = "setArticles(2)" id="btn_nos_option">JUEGO</button>
                </div>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>
    <div class= "create-basic-container-home" id="pom_info">
    <div class="options-items-container" style="padding:5%;">
        <h1>SESION COMPLETADA</h1>
        <div>
            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif
            @error('name')
                <h6 class="alert alert-danger"> {{ $message }}</h6>
            @enderror
            <h4>FECHA PROGRAMADA: {{$session -> date_start}}</h4>
            <h4>TERAPIA ID: {{$session -> therapy_id}}</h4>   
        </div>

        <div class="table-space">
            <div class="button-row">
                <button id="boton_tabla_izquierda" onclick="moveThrowTables(-1)" ><span class="material-symbols-outlined button-circle">arrow_left</span></button>
                <h1 id="titulo_tabla"> TABLA 1 </h1>
                <button id="boton_tabla_derecha" onclick="moveThrowTables(1)" ><span class="material-symbols-outlined button-circle">arrow_right</span></button>
            </div>
        </div>

        <div class="table-space">
            <h3>Sensores</h3>
        </div>
        
        <div>
            <canvas id="myChart"></canvas>
        </div>      
        
        <div id="reglas_div" style="display:block;">
                <div class="table-space">
                    <h3>Reglas ejecutadas</h3>
                </div>
                <canvas id="barrasReglas"></canvas>
        </div>  

    </div>

    <div class="container-tabla" id="app_info" style="display:none;">
            <h3>Información Relevante Periodo</h3>
            <table class="table-data">
                <tr>
                    <th>Pulsacion media</th>
                    <th>Movimiento medio</th>
                </tr>
                <tr>
                    <td id = "pbpm_medios"></td>
                    <td id = "pmove_medios"></td>
                </tr>
            </table>


    </div>
        <div class="margin-info-container" id="app_option" style="display:none;">
        <h3>Juego durante toda la sesión</h3>
        <h5>Durante esta sesión, el paciente {{$patient->name}} ha conseguido {{$puntos}} puntos</h5>
        </div>
        
        
    </div>

          <script>startShowTables()</script>
</div-->

@endsection