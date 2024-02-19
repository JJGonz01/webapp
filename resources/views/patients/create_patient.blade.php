@extends('main')

@section('patients_section')


<head>
    <title>CREAR PACIENTE</title>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/create-patient.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
</head>

<!-- Popup -->

<div id="popup" class="popup">
    <div class="popup-content">
        <form action="{{route('patients_create', [], false, true)}}" id= 'form_pat' method="POST">
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
            <h2>Añadir paciente</h2>
            <p>Imagen</p>
            <img id="profile-image" src="{{asset('images/perfil.png')}}"></img>

            <input placeholder = "Nombre del paciente" type="text" name = "name" id = "name" class = "form-control">

            <input type="text" placeholder = "Apellidos" name = "surname" id = "surname" class = "form-control">

            <textarea type="text" placeholder = "Comentario/Descripción" name = "description" id="commentary" class = "form-control" rown="10"></textarea>
            <button id="go_to_patient_create" type="submit"> CREAR PACIENTE </button>
        </form>
    </div>
</div>
<!--div>

    <form action="{{route('patients_create', [], false, true)}}" id= 'form_pat' method="POST">
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

    <div class="img-container">
    <div class="left-img-container">
    </div>
    <div class="right-img-container">
        <h3>Crear Paciente</h3>
        <p>NOMBRE</p>
        <input type="text" name = "name" id = "name" class = "create-basic-container-inputs">

        <p>APELLIDOS</p>
        <input type="text" name = "surname" id = "surname" class = "create-basic-container-inputs">

        <p>COMENTARIO</p>
        <textarea type="text" name = "description" id="commentary" class = "form-control" rown="10"></textarea>
        <button id="go_to_patient_create" type="submit"> CREAR PACIENTE </button>
    </form>
    </div>
    </div>
</div -->
@endsection