
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
                <h3 class="col-md-11">Selecciona que añadir</h3>
                <button onclick="closePopUpEvent()" class="text-end col-md-1">X</button>
        </div>

        <button onclick="sendFormSession('create-session-form')" class="button-select-event">Sesión de estudio</button>
        <button onclick="sendFormSession('create-objetive-form')" class="button-select-event">Evento</button>
        <button onclick="sendFormSession('create-objetive-form')" class="button-select-event">Objetivo</button>
    </div>
</div>
<div class="container-fluid">
    <div class="col-md-12 container-patient-slim">
        <div class="row align-items-center container-fluid">
            <div class="row">
                <img class="col-md-3" id="profile-image" src="{{asset('images/perfil.png')}}"></img>
                <div class="col-md-8">
                    <h5>{{$patient-> surname}}, {{$patient-> name}}</h5>
                    <p>{{$patient->description}}</p>
                    
                </div>
            </div>
        </div>
        <div>
                <button>Calendario</button>
                <button>Objetivos</button>
                <button>Planes de estudio</button>
        </div>
    </div>
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

    <div class="row" style="display:none;">
        <div class="col-md-9">
            <div class="container-fluid container-patient-slim">
                <div class="container-padding">
                    <div class="calendar" id="week-calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="container-sesiones container-patient-slim">
                <p class="text-title-two" id="session-title">Sesiones programadas</p>
                <div>
                    <table class="table" id="sessions-table-week">
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection