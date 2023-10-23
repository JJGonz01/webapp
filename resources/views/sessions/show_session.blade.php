@extends('main')

@section('patients_section')


<head>
    <title>VER SESIÓN</title>
</head>


<div class= "container w-80">

    
    <div class="show-patient-container">
         
        <div>

            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif
            @error('name')
                <h6 class="alert alert-danger"> {{ $message }}</h6>
            @enderror
            <div>
            <p>FECHA PROGRAMADA: {{$session -> date_start}}</p>
            <p> DESCRIPCION: {{$session -> description}}</p>
            <p>TERAPIA ID: {{$session -> therapy_id}}</p>
            </div>
            
           
        </div>
        <div>
            <a class="session-show-button" href = "{{route('session_edit', ['id' => $session -> id], false, true)}}">
                EDITAR SESIÓN
            </a>
        </div>
        
        <div>
            <a class="session-show-button" href = "{{route('therapy_show', ['id' => $session -> therapy_id], false, true)}}">
                VOLVER A PACIENTE
            </a>
        </div>
            
        
    </div>
</div>
@endsection