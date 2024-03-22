@extends('main')

@section('patients_section')

<head>
    <title>PACIENTES</title>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients/create-patient.css">
    <script src="https://pomodoro.ovh/JS/dashboards/tests/results.js"></script>
    <meta  name="results" id="results" content="{{ $results }}"></meta>
    <meta  name="users" id="users" content="{{ $users }}"></meta>
</head>

<body>
    <h1>Resultados tests</h1>
    <button onclick="changeCurrentUser(1);">Change USER</button>
    <div class="mb-3 mt-10">
        <label for="admin" class="form-label">Introduce contraseña de administrador</label>
        <input class="form-control col-md-5" name="admin" placeholder="Contraseña" type="password" id="password-input"></input>
        <button style="margin-top:20px;" class="button-save-patient" onclick="showResults()">Ver resultados</button>
    </div>

    <div id="show-patient-container">
        
    </div>
</body>
@endsection