@extends('main')

@section('patients_section')

<head>
    <title>Planes de estudio</title>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients/create-patient.css">
    <script src="https://pomodoro.ovh/JS/dashboards/therapies.js"></script>
</head>

<div class="popup" id="popup-delete" style="display:none;">
    <div class="popup-content" >
        <h2>Se va a eliminar este plan de estudio ¿Está seguro de que quiere continuar?</h2>
        <div class="row popup-delete-container" >
            <button class="col-md-2 button-delete" onclick="finaldelete()">Eliminar</button>
            <div class="col-md-2"></div>
            <button onclick = "closeDeletePopUp()" class="col-md-2 button-cancel-delete">Cancelar</button>
        </div> 
    </div>
</div>

<div class="container-general-patients">
    
    <form action = "{{route('therapies_create', [], false, true)}}" method = "GET">
        <div class="row container-inputs-top">
                <div class="col-md-4 container-input-span">
                    <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                    <input placeholder="Buscar plan de estudio"></input>
                </div>
                <div class="col-md-7 d-flex flex-row container-filter-align-end">
                    <button type="button"><span class="fa-regular fa-filter"> Filtrar</span></button>
                    <button type="submit"><span class="fa-regular fa-plus"> Añadir</span></button>
                </div>
                
        </div>
    </form>

    <div class="table-responsive table-patients text-center table-items-options-overflow">
        <table class="table">
            <tr class="top-index-container">
                <th scope="col">Nombre</th>
                <th scope="col">Tags</th>
                <th scope="col">Reglas</th>
                <th scope="col">Acciones</th>
            </tr>
                @foreach ($therapies->take(10) as $therapy)
                <tr>
                    <td>{{$therapy->name}}</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>
                        <select class="container-select" onchange="therapySelect({{$therapy->id}}, this.value ,this)">
                            <option value="" hidden disabled selected>Acciones</option>
                            <option value="e">Acceder</option>
                            <option value="b">Eliminar</option>
                        </select>
                        <form id="e{{$therapy->id}}" action="{{route('therapy_show', [$therapy->id], false, true)}}" method="GET"></form>
                        <form id="d{{$therapy->id}}" action="{{ route('therapy_destroy', ['id' => $therapy->id]) }}" method="POST">
                            @csrf 
                            @method('DELETE')
                        </form>   
                    </td>
                </tr>
                @endforeach

        </table>
    </div>
</div>


@endsection

