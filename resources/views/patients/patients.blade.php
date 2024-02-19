@extends('main')

@section('patients_section')

<head>
    <title>PACIENTES</title>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">

</head>
<div class="container container-general-patients">
    <div class="">

    </div>
</div>
<div class="general-items-container">
        
<div class="user-welcome-box">
    
    <div class="user-welcome-box-container">
        <h4>Pacientes</h4>
        <form action="{{route('patients_create', [], false, true)}}" method="GET">
            <button class="user-welcome-box-container-button" id="create-patient-button">AÑADIR PACIENTE</button>
        </form>
    </div>
    <div class="user-welcome-box-container">
        <div class="home-welcome-box">
            <button class="home-welcome-box-btn-selected" id="btn_pom_info" onclick="sortTable(0)">TODOS</button>
            <button class="home-welcome-box-btn" id="btn_app_info" onclick="sortTable(1)">NOMBRE</button>
            <button class="home-welcome-box-btn" id="btn_nos_option" onclick="sortTable(2)">APELLIDOS</button>
            
        </div>
        <button class="home-welcome-box-btn" id="btn_pom_info" onclick="filtrarPacientes('')">Limpiar Filtro</button>
        <input class="home-welcome-box-input" id="filter-input" placeholder="Buscar"></input>
    </div>
</div>

<div class="options-items-container">
    @if (session('success'))
    <h6 class="alert alert-success">{{ session('success') }}</h6>
    @endif
    @error('name')
    <h6 class="alert alert-danger">{{ $message }}</h6>
    @enderror
    <div class="options-items-container-inner">
        @if(count($patients)>0)
        <table class="table-items-options">
            <tr class="top-index-container">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDOS</th>
                <th>ACCEDER</th>
            </tr>
            <div id="patient-list" class="table-items-options-overflow">
                @foreach ($patients as $patient)
                <tr>
                    <td>{{$patient->id}}</td>
                    <td>{{$patient->name}}</td>
                    <td>{{$patient->surname}}</td>
                    <td>
                        <form action="{{route('patient_show', [$patient->id], false, true)}}" method="GET">
                            <div>
                                <button id="go_to_patient_btn" type="submit" class="edit-button">
                                    Acceder
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </div>
        </table>
        @else
        <h1 style="color: #0E456; font.weight: bold;">No hay pacientes añadidos</h1>
        @endif
    </div>
</div>

    
</div>
<script src="https://www.pomodoro.ovh/filter.js"></script>
<script>startFilter()</script>
@endsection