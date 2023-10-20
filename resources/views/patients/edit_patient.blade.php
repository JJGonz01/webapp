@extends('main')

@section('patients_section')


<head>
    <title>EDITAR PACIENTE</title>
</head>


<div class="blue-photo-menu">
    <img class="blue-photo-menu" url="https://cdn-icons-png.flaticon.com/512/3135/3135768.png"></img>        
</div>
<div class= "create-basic-container">

    <form action="{{route('patient_complete_update', [$patient->id])}}" method = "POST">
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
        <p>NOMBRE</p>
        <input type="text" name = "name" id = "name" value = "{{$patient->name}}" class = "create-basic-container-inputs">

        <p>APELLIDOS</p>
        <input type="text" name = "surname" id = "surname" value = "{{$patient->surname}}" class = "create-basic-container-inputs">

        <p>COMENTARIO</p>
        <textarea type="text" name = "description" id="commentary" value = "{{$patient->description}}" class = "form-control" rown="10"></textarea>
        <button id="go_to_patient_create" class = "create-button" type="submit"> EDITAR USUARIO </button>
    </form> <!--FORM PACIENTE-->


</div>
@endsection