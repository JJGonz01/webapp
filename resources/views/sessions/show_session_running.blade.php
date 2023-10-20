@extends('main')

@section('patients_section')
<div class= "container w-80">

    <div class="show-patient-container">
         
        <div>
            <h1>SESIÓN EN EJECUCIÓN</h1>
            <div>
            <p>FECHA PROGRAMADA: {{$session -> date_start}}</p><br>
            <p>DESCRIPCION: {{$session -> description}}</p><br>
            <p>TERAPIA ID: {{$session -> therapy_id}}</p><br>
            </div>

            <h3>Datos de la sesión</h3>
            <p>Valor de límite (bajo/alto) de pulsaciones por minuto: {{$session->bpm_lim}}</p>
            <p>Valor de límite de movimiento del joven: {{$session->move_lim}}</p>
            
           
        </div>

        <div>
            <a class="session-show-button" href = "{{route('therapy_show', ['id' => $session -> therapy_id])}}">
                VOLVER A PACIENTE
            </a>
        </div>
            
        
    </div>
</div>
@endsection