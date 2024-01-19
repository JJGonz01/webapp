@extends('main')

@section('patients_section')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--para la grafica-->

<script src="https://www.pomodoro.ovh/session/sessionCompleted.js"></script>  

<div class="general-items-container">
    <input id = "bpm_val" value="{{$bpm_valores}}" style="display:none;"></input>
    <input id = "move_val" value="{{$move_valores}}" style="display:none;"></input>
    <input id = "limite_bpm" value="{{$limite_bpm}}" style="display:none;"></input>
    <input id = "limite_move" value="{{$limite_move}}" style="display:none;"></input>
    <input id = "reglas" value="{{$reglas}}" style="display:none;"></input>

    <input style="display:none;" id = "bpm_medios" value = "{{$bpm_medios}}"></input>
    <input style="display:none;" id = "move_medios" value = "{{$move_medios}}"></input>
    <div id="prueba"></div>

    <script src="{{asset('general_page.js')}}"></script>
  
        <div class="user-welcome-box">
            
            @if(auth()->user() !== null)
            <form action="{{route('patient_show', [$patientId], false, true)}}" method="GET">
                <button style="margin-left:50px;" class="user-welcome-box-container-button" id="create-patient-button">VOLVER A PACIENTE</button>
            </form>
            <h4>General</h4>
            
            <div class="user-welcome-box-container">
                <div class="home-welcome-box">
                    <button class="home-welcome-box-btn-selected" onclick = "setArticles(0)" id="btn_pom_info">SENSORES</button>
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
</div>

@endsection