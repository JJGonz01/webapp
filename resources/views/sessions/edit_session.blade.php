@extends('main')
@section('patients_section')


<head>
    <title>EDITAR SESIÓN</title>
</head>


<form action="{{route('session_update',  ['id' => $session -> id])}}" method="POST">
@if (session('success'))
    <h6 class="alert alert-success"> {{ session('success') }}</h6>
@endif
@if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
@endif
<script src="{{ asset('sessionCreate.js') }}"></script>
    <div class="create-basic-container">
        
        @csrf
        <input id="terapia_seleccion" style="display:none;" name="therapy_id" value="{{$session->therapy_id}}"></input>
        <h3>EDITAR SESIÓN</h3>
        <p for="date_start">SELECCIONAR FECHA</p>
        <input type="datetime-local" id="fechaHora" value="{{$session->date_start}}" name="date_start"></input>
        <h3>Elegir terapia para sesión</h3>
        <div id="terapias_botones" class="therapy-selection-container">
            @if(count($therapies) > 0)
            @foreach($therapies as $ter)
                <button name="ther_select" id="button_{{$ter->id}}" class="edit-button" type="button" onclick="selectTerapia( {{$ter->id}})">{{ $ter->name }}</button>
            @endforeach
            @else
                <p>CREA UNA TERAPIA PARA PODER CREAR LA SESIÓN</p>
                <a onclick="printClickedId(this)" class= "edit-button" href = "{{route('therapies_create')}}">CREAR TERAPIA</a>
            @endif
        </div>
        <div class="header-selector">
                <p>Sensibilidad de los sensores</p>
            <div class="back-period-creation">

                <div class="centeder-inputs">
                    <div class="inputs-session">
                        <label for="porcentaje">Sensibilidad (%) BPM</label>
                        <input id="porcentaje" value = 8 type="number" name="porcentaje" class="form-control" rown="10"></input>
                    </div>

                    <div class="inputs-session">
                            <label for="movement" >Sensibilidad (%) movimiento</label>
                            <select name ="movement">
                                <option value="Bajo"> Bajo (0.4)</option>
                                <option value="Medio"> Medio (0.6)</option>
                                <option value="Alto"> Alto (0.9)</option>
                            </select>
                    </div>
                    <div class="inputs-session">
                            <label for="modoJuego" value = "{{$session->modoJuego}}">Juego en estudio</label>
                            <select name ="modoJuego" id="modoJuego">
                                <option value="JuegoReglas">Solo suma puntos con lo definido en las reglas</option>
                                <option value="juegoAmbos">Sumar puntos en función del tiempo que este relajado <strong>(ambos sensores en bajo)</strong></option>
                                <option value="juegoCorazon">Sumar puntos en función del tiempo que tenga las <b>pulsaciones en bajo</b></option>
                                <option value="juegoMovimiento">Sumar puntos en función del tiempo que el <b>movimiento sea bajo</b></option>
                            </select>                   
                    </div>
                </div>
            </div>
        </div>
        <button id="session_save_edit" class="create-button">EDITAR SESIÓN</button>
    </div>

    
</form>
@endsection
