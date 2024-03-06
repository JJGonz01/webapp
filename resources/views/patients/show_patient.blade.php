
@yield('session')

@extends('main')
@section('patients_section')
<head>
    <title>EDITAR | {{$patient->name}}</title>
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
                <div class="col-md-8 container-content-patient">
                    <h3>{{$patient-> surname}}, {{$patient-> name}}</h3>
                    <h6>{{$patient->description}}</h6>
                    
                </div>
            </div>
        </div>
        <div class="container-padding">
                <button onclick="changeviewpatient(0)">Calendario</button>
                <button onclick="changeviewpatient(1)">Objetivos</button>
                <button onclick="changeviewpatient(2)">Datos del paciente</button>
                <button onclick="changeviewpatient(3)">Mi Avatar</button>
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
                        <table class="table" id="sessions-table">
                            
                        </table>
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
                            <button>Todos</button>
                            <button>Estudio</button>
                            <button>Personales</button>
                            <button>Escolares</button>
                        </div>
                        <table class="table">
                            <tr class="top-index-container">
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha objetivo</th>
                                <th scope="col">Selección</th>
                            </tr>
                            <div id="patient-list" class="table-items-options-overflow">
                                @foreach($objectives->take(5) as $obj)
                                <tr>
                                    <td>{{$obj->name}}</td>
                                    <td>{{$obj->date_end}}</td>
                                    <td scope="row"><button class="btn btn-primary" type="checkbox" onclick="showMilestones('{{$obj->id}}')">SELECCIONAR</td>
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
            <div class="col-md-9">
                <div class="container-fluid container-patient-slim">
                    <div class="container-padding">
                        <p class="text-title-two">Datos</p>
                        
                        <div style="text-align:center; align-content:center">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="container-sesiones container-patient-slim">
                    <p class="text-title-two" id="session-title">Tienda</p>
                    <div id="steps-container" class="container-padding">
                        <div class="row">
                            <button><img></img></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection