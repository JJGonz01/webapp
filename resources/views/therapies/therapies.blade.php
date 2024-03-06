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
                    <input placeholder="Buscar plan de estudio"></input>
                </div>
                <div class="col-md-7 d-flex flex-row container-filter-align-end">
                    <button type="button"><span class="fa-regular fa-filter"> Filtrar</span></button>
                    <button type="submit"><span class="fa-regular fa-plus"> Añadir</span></button>
                </div>
                
        </div>
    </form>

    <div class="table-responsive table-patients text-center">
        <table class="table">
            <tr class="top-index-container">
                <th scope="col">Nombre</th>
                <th scope="col">Tags</th>
                <th scope="col">Reglas</th>
                <th scope="col">Acciones</th>
            </tr>
            <div id="patient-list" class="table-items-options-overflow">
                @foreach ($therapies->take(10) as $therapy)
                <tr>
                    <td>{{$therapy->name}}</td>
                    <td>TBD</td>
                    <td>TBD</td>
                    <td>
                        <select class="container-select">
                            <option value="" hidden disabled selected>Acciones</option>
                            <option value="e">Acceder</option>
                            <option value="b">Eliminar</option>
                        </select>
                    </td>

                </tr>
                @endforeach
            </div>
        </table>
    </div>
</div>


@endsection

