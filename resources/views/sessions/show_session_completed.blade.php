@extends('main')

@section('patients_section')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--para la grafica-->
<script src="https://pomodoroadhdapp.azurewebsites.net/session/sessionCompleted.js"></script>  
<div class= "container w-80 border p-4">
    
    <h1>SESION COMPLETADA</h1>
    <input id = "bpm_val" value="{{$bpm_valores}}" style="display:none;"></input>
    <input id = "move_val" value="{{$move_valores}}" style="display:none;"></input>
    <input id = "limite_bpm" value="{{$limite_bpm}}" style="display:none;"></input>
    <input id = "reglas" value="{{$reglas}}" style="display:none;"></input>

    <input style="display:none;" id = "bpm_medios" value = "{{$bpm_medios}}"></input>
    <input style="display:none;" id = "move_medios" value = "{{$move_medios}}"></input>
    <div id="prueba"></div>
    <div>
    
        <div> 
            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif
            @error('name')
                <h6 class="alert alert-danger"> {{ $message }}</h6>
            @enderror
            <p>FECHA PROGRAMADA: {{$session -> date_start}}  DESCRIPCION: {{$session -> description}}</p>
            <p>TERAPIA ID: {{$session -> therapy_id}}</p>
        </div>
        <div class="table-space">
            <button id="boton_tabla_izquierda" onclick="moveThrowTables(-1)"><<</button>
            <spam id="titulo_tabla"> TABLA 1 </spam>
            <button id="boton_tabla_derecha" onclick="moveThrowTables(1)">>></button>
        </div>
        <div class="table-space">
            <h4>Sensores</h4>
        </div>
                <canvas id="myChart"></canvas>

        <div class="table-space">
            <h4>Reglas ejecutadas</h4>
        </div>
                <canvas id="barrasReglas"></canvas>
                
        <div class="margin-info-container">
            <h4>Información Relevante Periodo</h4>
            <table>
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
        <div class="margin-info-container">
        <h3>Juego durante toda la sesión</h3>
        <h5>Durante esta sesión, el paciente Luis ha conseguido {{$puntos}}</h5>
        </div>
        
        
    </div>
    <div class="table-space">
            <a class="all-patient-button-create" href = "{{route('patient_show', ['id' => $session -> patient_id])}}">
                VOLVER A PACIENTE
            </a>
        </div>
          <script>startShowTables()</script>
</div>

@endsection