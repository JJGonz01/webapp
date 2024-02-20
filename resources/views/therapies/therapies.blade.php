@extends('main')

@section('patients_section')

<head>
    <title>Planes de estudio</title>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
    <script src="{{asset('/JS/dashboards/patients.js')}}"></script>
</head>

<div class="container-general-patients">
    
    <form action = "{{route('therapies_create', [], false, true)}}" method = "GET">
        <div class="row container-inputs-top">
                <div class="col-md-4 container-input-span">
                    <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                    <input placeholder="Buscar paciente"></input>
                </div>
                <div class="col-md-7 d-flex flex-row container-filter-align-end">
                    <button type="button"><span class="fa-regular fa-filter"> Filtrar</span></button>
                    <button type="submit"><span class="fa-regular fa-plus"> Añadir</span></button>
                </div>
                
        </div>
    </form>

    <div class="table-responsive text-center">
        <table class="table">
            <tr class="top-index-container">
                <th scope="col"><input type="checkbox" value="-1" id="checkbox1"></th>
                <th scope="col">Nombre</th>
                <th scope="col">Tags</th>
                <th scope="col">Reglas</th>
                <th scope="col">Acciones</th>
            </tr>
            <div id="patient-list" class="table-items-options-overflow">
                @foreach ($therapies->take(10) as $therapy)
                <tr>
                    <td scope="row"><input type="checkbox" value="{{$patient->id}}" id="checkbox1"></td>
                    <td>{{$therapy->name}}</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>
                        <select class="form-select" onchange="patientSelect({{$patient->id}},this.value)">
                            <option value="" hidden disabled selected>Acciones</option>
                            <option value="e">Acceder</option>
                            <option value="b">Eliminar</option>
                        </select>
                        <form id="e{{$patient->id}}" action="{{route('patient_show', [$patient->id], false, true)}}" method="GET"></form>
                        <form id="b-{{$patient->id}}" action="{{route('sessions_create', ['patient_id' => $patient -> id], false, true)}}" method="GET"></form>
                    </td>

                </tr>
                @endforeach
            </div>
        </table>
    </div>
</div>


@endsection

<!-- @extends('main')

@section('patients_section')

<head>
    <title>TERAPIAS</title>
</head>


<div class="general-items-container">

        @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @error('name')
            <h6 class="alert alert-danger"> {{ $message }}</h6>
        @enderror

        <div class="user-welcome-box">
            <div class="user-welcome-box-container">
                <h4>Terapias</h4>
                <form action = "{{route('therapies_create', [], false, true)}}" method = "GET">
                    <button class="user-welcome-box-container-button" id="create-therapy-btn">CREAR TERAPIA</button>
                </form>
            </div>
            <div class="user-welcome-box-container">
            <div class="home-welcome-box">
                <button class="home-welcome-box-btn-selected" id="btn_pom_info" onclick="sortTable(0)">TODOS</button>
                <button class="home-welcome-box-btn" id="btn_app_info" onclick="sortTable(1)">NOMBRE</button>
                <button class="home-welcome-box-btn" id="btn_nos_option" onclick="sortTable(2)">REGLAS</button>
                
                </div>
                <button class="home-welcome-box-btn" id="btn_pom_info" onclick="filtrarPacientes('')">Limpiar Filtro</button>
                <input class="home-welcome-box-input" id="filter-input" placeholder="Buscar"></input>
            </div>
        </div>

        <div class = "options-items-container">
            
            <div class="options-items-container-inner">
                @if(count($therapies)>0)
                <table class="table-items-options">
                    <tr class ="top-index-container">
                        <th>ID</th> 
                        <th>NOMBRE</th> 
                        <th>REGLAS</th>
                        <th>ACCEDER</th> 
                    </tr>
                    <div id="patient-list" class="table-items-options-overflow">
                        
                            @foreach ($therapies as $therapy)
                            <tr> 
                                <td>{{$therapy -> id}}  </td>
                                <td>{{$therapy -> name}} </td>
                                
                                <td>
                                @if($therapy->rules != "\"empty\"")
                                    Con reglas
                                @else
                                    Sin reglas
                                @endif
                                </td>
                                <td> 
                                    <form action="{{route('therapy_show', ['id' => $therapy -> id], false, true)}}" method = "GET">
                                        <div>
                                        <button id="ther_index_edit_button" type="submit" class="edit-button">
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
                            <h1 style="color: #0E456; font.weight: bold;">No hay terapias creadas</h2>
                @endif
            </div>

        </div>
    
</div> 
<script src="https://www.pomodoro.ovh/filter.js"></script>
<script>startFilter()</script>
@endsection
