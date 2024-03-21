@extends('main')

@section('patients_section')


<head>
    <title>EDITAR ESTUDIANTE</title>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients/create-patient.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients.css">
</head>

<div id="popup" class="popup">
    <div class="popup-content">
        <form action="{{route('patient_complete_update', ['id' => $patient->id], false, true)}}" id= 'form_pat' method="POST">
            @csrf
            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif

            @error('name')
                <h6 class="alert alert-danger"> Falta nombre: {{ $message }}</h6>
            @enderror

            @error('surname')
                <h6 class="alert alert-danger"> Falta apellido: {{ $message }}</h6>
            @enderror
            <h2>Añadir estudiante</h2>
            <p>Imagen</p>
            <img id="profile-image" src="https://pomodoro.ovh/images/perfil.png"></img>

            <div class="input-group mb-2 patient-title">
                <span>&#xf21e;</span>
                <div style="">Nombre</div>
            </div>
            <input placeholder = "Nombre del estudiante" value = "{{$patient->name}}" type="text" name = "name" id = "name" class = "form-control">

            <div class="input-group mb-2 patient-title">
                <span>&#xf21e;</span>
                <div>Apellidos</div>
            </div>
            <input type="text" placeholder = "Apellidos" value = "{{$patient->surname}}" name = "surname" id = "surname" class = "form-control">
            
            <div class="input-group mb-2 patient-title">
                <span>&#xf21e;</span>
                <div>Comentario sobre el estudiante</div>
            </div>
            <textarea style="margin-bottom:10px;" type="text" value = "{{$patient->description}}"  placeholder = "Comentario/Descripción" name = "description" id="commentary" class = "form-control" rown="10"></textarea>
            <button id="go_to_patient_create" class="button-save-patient" type="submit"> GUARDAR CAMBIOS DE ESTUDIANTE </button>
        </form>
    </div>
</div>
@endsection