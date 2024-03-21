@extends('main')
@section('patients_section')

<head>
    <title>VER TERAPIA | {{$therapy->name}}</title>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/therapies/show-therapy.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/therapies/therapies-create.css">
    <meta  name="rules" id="rules" content="{{ $therapy->rules }}"></meta>
    <script src="https://pomodoro.ovh/JS/dashboards/therapies/show-therapy.js"></script>
</head>

<input id="array-values" style="display:none;" value = "{{$period->durations}}" disabled></input>
<div class="container-subtitle">
    <div class="row">
        <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
        <h3>Información principal</h3>
    </div>
</div>

<div class="row  container-therapy">
    <div class="col-md-4">
        <div class="container-therapy-information">
            <h2>Datos</h2>
            <h4>Nombre: {{$therapy->name}}</h4>
            <h4>Comentario: {{$therapy->description}}</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="container-therapy-information">
            <h2>Uso de la terapia</h2>
            <h4>Estudiantes: TBD</h4>
            <h4>Sesiones: TBD</h4>
        </div>
    </div>

    <div class="col-md-4">
        <div class="container-therapy-information">
            <h2>Resultados</h2>
            <h4>Sesiones completadas: TBD</h4>
            <h4>Notas de los estudiantes: TBD</h4>
        </div>
    </div>
</div>

<div class="container-subtitle">
    <div class="row">
        <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
        <h3>Bloques y condiciones</h3>
    </div>
</div>

<div class="row  container-therapy">
    
    <div class="col-md-8 container-therapy">
        <div class="container-therapy-information">
            <h2>Bloques</h2>

            <div class="container-inner-periods" id="main-div">
                <div class="row container-block">
                    <div class="col-md-1" id="button-move">
                        <span data-toggle="tooltip" data-html="true" 
                            title="Este es el bloque principal, siempre se va a ejecutar, no puede eliminarse (pinned)"
                            style="font-size:large">&#xf08d;</span>
                    </div>
                    <div class="col-md-8 container-align-end">
                        <input class="col-4 form-control" id="mb_t1" placeholder="Estudio (min)" disabled readonly></input>
                        <input class="col-4 form-control" id="mb_rest" placeholder="Descanso (min)" disabled readonly></input>
                        <input class="col-4 form-control" id="mb_t2" placeholder="Estudio (min)" disabled readonly></input>
                    </div>
                    <div class="col-md-2 container-align-end">
                        <button type="button" class="button-select-period" onclick="showconditions(0)"><span>&#xf044;</span></button>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="col-md-4 container-therapy" >
        <div class="container-therapy-information padding-container" id="conditions-div">
            <h2>Condiciones</h2>
            <h4>{{$therapy->description}}</h4>
        </div>
    </div>

</div>

@endsection