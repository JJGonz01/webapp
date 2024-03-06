@extends('main')

@section('patients_section')

<head>
    <title>PACIENTES</title>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
    <script src="{{asset('/JS/dashboards/patients.js')}}"></script>
</head>

<div class="container-general-patients">
    
    <form action="{{route('patients_create', [], false, true)}}" method="GET">
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

    <div class="table-responsive table-patients text-center">
        <table class="table table-patients">
            <tr class="top-index-container">
                <th scope="col">NOMBRE</th>
                <th scope="col">TAGS</th>
                <th scope="col">Próxima sesión</th>
                <th scope="col">ACCIONES</th>
            </tr>
            <div id="patient-list" class="table-items-options-overflow">
                @foreach ($patients->take(10) as $patient)
                <tr>
                    <td>{{$patient->surname}}, {{$patient->name}}</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>
                        <select class="container-select" onchange="patientSelect({{$patient->id}},this.value)">
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