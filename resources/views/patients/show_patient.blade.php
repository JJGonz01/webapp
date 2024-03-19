@yield('session')

@extends('main')
@section('patients_section')
<head>
    <title>Estudiante {{$patient->name}}</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('/JS/dashboards/patients/calendar.js')}}"></script>
    <script src="{{asset('/JS/dashboards/patients/patient-menu.js')}}"></script>
    <meta  name="sessions" id="sessions-value" content="{{ $sessions }}"></meta>
    <meta  name="patients" id="patient-value" content="{{ $patient -> id }}"></meta>
    <meta  name="patients" id="objectives" content="{{ $objectives }}"></meta>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/patient-menu.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/create-patient.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/calendar.css')}}">
</head>
<form id="create-session-form" action="{{route('sessions_create', ['patient_id' => $patient -> id], false, true)}}" method="GET"></form>
<form id="create-objetive-form" action="{{route('objetives_create', ['patient_id' => $patient -> id], false, true)}}" method="GET"></form>
@if (session('success'))
    <h6 class="alert alert-success"> {{ session('success') }}</h6>
@endif
@if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
@endif

<div class="popup" id="popup-guide" style="display:none;">
    <div class="popup-content">
        <div class="row">
                <h1 class="col-md-11">Como conectar el reloj</h1>
                <div class="col-md-1 button-close-container">
                    <button onclick="closePopUpGuide()" class="button-close">
                        <span>&#xf00d;</span>
                    </button>
                </div>
        </div>

        <div class="popup-guide-steps">
            <h3>1 - Abre la aplicación en tu reloj inteligente ('Pomodoro')</h3>
            <h3>2 - Introduce la ID del estudiante </h3>
            <h3>3 - Pulsa aceptar, el reloj ya estará configurado </h3>
            <h3>* - La id del estudiante actual es {{$patient->id}} --</h3>
            <img src="{{asset('/images/watchstep.png')}}" style="width:300px;height:250px;"></img>
        </div>
        
    </div>
</div>


<div class="popup" id="eventCreatepopup" style="display:none;">
    <div class="popup-content">
        <div class="row">
                <h3 class="col-md-11">Selecciona que añadir al calendario</h3>
                <div class="col-md-1 button-close-container">
                    <button onclick="closePopUpEvent()" class="button-close">
                        <span>&#xf00d;</span>
                    </button>
                </div>
        </div>
        <div class="flex-container-options">
            <div>
                <button  onclick="sendFormSession('create-session-form')" type="button" class="image-container-objective">
                <img class="rounded-image-objective" src="{{asset('images/clockpom.jpg')}}"></img>
                <p>Crear sesión de estudio</p>
                </button>
            </div>
            <div>
                <button onclick="sendFormSession('create-objetive-form')" type="button" class="image-container-objective">
                <img class="rounded-image-objective" src="{{asset('images/goaltarget.jpg')}}"></img>
                <p>Crear Objetivo de paciente</p>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12 container-patient-slim">
        <div class="row align-items-center container-padding container-fluid">
            <div class="row container-padding">
                <img class="col-md-3 container-patient-slim-image" src="{{asset('images/perfil.png')}}"></img>
                <div class="col-md-5 container-content-patient">
                    <h3>{{$patient-> surname}}, {{$patient-> name}}</h3>
                    <h6>{{$patient->description}}</h6>
                    <h6>La ID del estudiante es: {{$patient->id}}</h6>
                    <h6>El estudiante tiene 120 estrellas</h6>
                </div>

                <div class="col-md-2 row container-content-patient float-right">
                <form action="{{route('patient_update', ['id' => $patient->id], false, true)}}" id= 'form_pat' method="GET">
                    <div class="col-md-6"><button class="button-patient-edit">Editar</button></div>
                </form>
                    <div class="col-md-6"><button class="button-patient-edit" onclick="openPopUpGuide()">Conectar al reloj</button></div>
                </div>
            </div>
        </div> 
        <div class="container-padding">
            <button class="button-patient-selected" onclick="seleccionarBoton(this); changeviewpatient(0)">Calendario</button>
            <button class="button-patient" onclick="seleccionarBoton(this); changeviewpatient(2)">Sesiones</button>
            <button class="button-patient" onclick="seleccionarBoton(this); changeviewpatient(1)">Objetivos</button>
            <button class="button-patient" onclick="seleccionarBoton(this); changeviewpatient(3)">Avatar</button>
        </div>
    </div>
    <div id="calendar-view" style="display:block;">
        <div class="row" id="calendar-container">
            <div class="col-md-9">
                <div class="container-fluid container-patient-slim">
                    <div class="container-padding">
                        <div class="calendar" id="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container-sesiones container-patient-slim">
                    <p class="text-title-two" id="session-title">Sesiones programadas</p>
                    <div>
                        <div class="table" id="sessions-table">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="objectives-view" style="display:none;">
        <div class="row" id="calendar-container">
            <div class="col-md-9">
                <div class="container-fluid container-patient-slim">
                    <div class="container-padding">
                        <p class="text-title-two"> Objetivos</p>
                        <div class="row">
                            <button class="button-patient-selected" onclick="seleccionarBoton(this);restoreObjectivesFilter()">Todos</button>
                            <button class="button-patient" onclick="seleccionarBoton(this);filterObjectiveByType('Estudio')">Estudios</button>
                            <button class="button-patient" onclick="seleccionarBoton(this);filterObjectiveByType('Escolar')">Escolares</button>
                            <button class="button-patient" onclick="seleccionarBoton(this);filterObjectiveByType('Personal')">Personales</button>
                        </div>
                        <table class="table" id="objectives-table">
                            <tr class="top-index-container">
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha objetivo</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Selección</th>
                            </tr>
                            <div id="patient-list" class="table-items-options-overflow">
                                @foreach($objectives->take(5) as $obj)
                                <tr>
                                    <td>{{$obj->name}}</td>
                                    <td>{{$obj->date_end}}</td>
                                    <td>
                                        @if($obj->type == 'scholastic')
                                            Escolar
                                        @elseif($obj->type == 'personal')
                                            Personal
                                        @else
                                            Estudios
                                        @endif
                                    </td>
                                    <td scope="row"><button class="button-objective-next-step" type="checkbox" onclick="showMilestones('{{$obj->id}}')">Acceder</td>
                                </tr>
                                @endforeach
                            </div>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container-sesiones container-patient-slim">
                    <p class="text-title-two" id="session-title">Hitos del objetivo</p>
                    <div id="steps-container" class="container-padding">
                        <div class="row">
                            <p>Selecciona un objetivo para ver sus hitos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="avatar-view" style="display:none;">
        <div class="row" id="calendar-container">
            <div class="col-md-12">
                <div class="container-fluid container-patient-slim">
                    <div class="container-padding">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-title-two">Sesiones</p>
                            </div>

                            <div class="col-md-6">
                                <div class="row text-end flex-row-reverse">
                                    <button class="button-date-filter" onclick="filterbydateToday(this)">Hoy</button>
                                    <button class="button-date-filter" onclick="filterbydateMonth(this)">Mes</button>
                                    <button class="button-date-filter-selected" onclick="restoreFilter(); setColorAsSelected(this)">Todas</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <button class="button-patient-selected" onclick="seleccionarBoton(this);restoreFilter()">Todas</button>
                            <button class="button-patient" onclick="seleccionarBoton(this);filterbystate('Sin completar')">Pendientes</button>
                            <button class="button-patient" onclick="seleccionarBoton(this);filterbystate('Completada')">Realizadas</button>
                            <button class="button-patient" onclick="seleccionarBoton(this);filterbystate('Sin completar')">No completadas</button>
                        </div>
                        <table class="table" id="session-table">
                            <tr class="top-index-container">
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Completada</th>
                                <th scope="col">Selección</th>
                            </tr>
                            <div id="patient-list" class="table-items-options-overflow">
                                @foreach($sessions->take(5) as $ses)
                                <tr>
                                    <td>{{$ses->name}}</td>
                                    <td>{{$ses->date_start}}</td>
                                    <td>{{$ses->time_start}}</td>
                                    <td>@if($ses->completed == 0)
                                            Sin completar
                                        @else
                                            Completada
                                        @endif
                                    </td>
                                    <td scope="row"><button class="button-objective-next-step" type="checkbox" onclick="showMilestones('{{$ses->id}}')">Acceder</td>
                                </tr>
                                @endforeach
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="game-view" style="display:none;margin-bottom:100px;">
        <div class="row">
            <div class="col-md-10">
                <img style="width:1200px; height:600px; matgin-bottom:50px;margin-top:20px;" src="{{asset('/images/avatar-preview.png')}}"></img>
            </div>
        </div>
    </div>

</div>
@endsection