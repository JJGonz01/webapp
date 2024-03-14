@extends('/patients/show_patient')
 
@section('session')

<head>
    <title>CREAR SESIÓN</title>
    <!-- Bootstrap JS (jQuery must be included before Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('/JS/dashboards/patients/create-session.js')}}"></script>

    <meta  name="date" id="date-start" content="{{ $session->date_start }}"></meta>
    <meta  name="date" id="objectives" content="{{ $objectives }}"></meta>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/create-session.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
    <link rel="stylesheet" href="{{asset('/css/draws/clock.css')}}">
</head>

</div> 
<!-- Popup -->
<form id="session_form" action="{{route('sessions_create_post',  ['patient_id' => $patient -> id], false, true)}}" method="POST">
    @csrf    
<div id="popup" class="popup">
        @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @if($errors->any())
            <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
        @endif
        <div class="popup-content popup-width-90">
            <div class="row">
                <div class="col">
                    <h2>Crear Sesión para {{$patient->name}}</h2>
                </div>
                <div class="col-md-1 button-close-container">
                    <button onclick="closePopup()" type="button" class="button-close">
                        <span>&#xf00d;</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 container-session-inputs">
                    <div style="margin-left:5px" class="row container-session-gamification">
                            <span>&#xf2db;</span>
                            <p>Datos de la sesión</p> <p class="text-description"></p>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7" id="fecha-div">
                            <input class="input-session form-control" value="{{$session->date_start}}" placeholder="Fecha y hora de la sesión" type="date" id="fecha" name="date_start"></input>
                        </div>
                        <div class="col-md-5" id="hora-div">
                            <input class="input-session form-control" value="{{$session->time_start}}" placeholder="Fecha y hora de la sesión" type="time" id="hora" name="time_start"></input>
                        </div>
                    </div>
                    <input name="name" value="{{$session->name}}" class="input-session  form-control" placeholder="Nombre"></input>
                    <textarea name="description" value="{{$session->description}}" class="form-control" rows="3" placeholder="Descripción"></textarea>
                    <div style="margin-left:5px" class="row container-session-gamification">
                            <span>&#xf073;</span>
                            <p>Seleccionar objetivo e hito</p> <p class="text-description"></p>
                            <span data-toggle="tooltip" data-html="true" 
                                    title="Cual es el objetivo de esta sesión y que hito de este va a querer cumplir, no es necesario asignar una, pero puede motivar al paciente. 
                                    El reloj enviará un mensaje recordando el objetivo al avisar a los 5 minutos antes de empezar y al finalizar"
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text container-icons">
                                <span onclick="openObjectivesPopup()" id="inputGroup-sizing-sm">Seleccionar hito</span>
                            </div>
                        </div>
                        <input id="objective-input" name="objetive_id" style="display:none;"></input>
                        <input id="milestone-input" name="milestone" style="display:none;" ></input>
                        <input id="objective-name" type="text" class="form-control input-session " aria-label="Text input with checkbox" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text  container-icons">
                                <span id="inputGroup-sizing-sm" onclick="removeObjectiveSelected()">X</span>
                            </div>
                        </div>
                    </div>
 
                
                    <div style="margin-left:5px" class="row container-session-gamification">
                            <span>&#xf073;</span>
                            <p>Repetir sesión</p> <p class="text-description"></p>
                            <span data-toggle="tooltip" data-html="true" 
                                    title="Puede elegir si esta sesión de estudio ocurre todas las semanas, o todos los meses (una vez al mes)"
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                    </div>
                    <input name="session_repeat" style="display:none;" id="checkbox-repeat" value="unique" class="form-control" placeholder="Nombre"></input>
                    <div class="checkbox-session row">
                        <div class="col-md-8" id="check-div">
                            <p> No repetir</p>
                        </div>
                        <div class="col-md-2" id="check-div">
                            <input class="input-session form-check-input-sm" checked=true value="unique" type="checkbox" id="fecha" name="checkbox_repeat"></input>
                        </div>
                    </div>

                    <div class="checkbox-session row">
                        
                        <div class="col-md-8" id="check-div">
                            <p> Repetir cada semana</p>
                        </div>
                        <div class="col-md-2" id="check-div">
                            <input class="input-session  form-check-input-sm" value="weekly" type="checkbox" id="fecha" name="checkbox_repeat"></input>
                        </div>
                    </div>

                    <div class="checkbox-session row">
                        
                        <div class="col-md-8" id="check-div">
                            <p> Repetir cada mes</p>
                        </div>
                        <div class="col-md-2" id="check-div">
                            <input class="form-check-input-sm" value="monthly" type="checkbox" id="fecha" name="checkbox_repeat"></input>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="row container-session-gamification">
                            <span>&#xf02d;</span>
                            <p>Plan de estudio</p> <p class="text-description"></p>
                            <span data-toggle="tooltip" data-html="true" 
                                    title="Define la duración de los distintos periodos de descanso y estudio, además de condiciones
                                    basadas en los periodos y valor de los sensores. Cree o seleccione uno de su colección."
                                    style="margin-left:10px; font-size:large">&#xf059;</span>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text  container-icons">
                                <span onclick="openTherapyPopup()" id="inputGroup-sizing-sm">Seleccionar plan de estudio</span>
                            </div>
                        </div>
                        <input id="therapy-input" name="therapy_id" style="display:none;" value="{{$therapy->id}}"></input>
                        <input id="therapy-name" type="text" class="form-control input-session "  value="{{$therapy->name}}" aria-label="Text input with checkbox" readonly>
                        <div class="input-group-prepend">
                            <div class="input-group-text  container-icons">
                                <span id="inputGroup-sizing-sm">X</span>
                            </div>
                        </div>
                    </div>

                    <div class="row container-session-gamification">
                            <span>&#xf2db;</span>
                            <p>Sensores:</p> <p class="text-description">Sensibilidad de los sensores</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <div class="input-group-text  container-icons">
                                        <span >&#xf21e;</span>
                                    </div>
                                </div>
                                <input name="bpm" type="number" placeholder="Sensibilidad Pulsaciones (0-100)" value="{{$session->percentage}}" class="input-session form-control" id="numberInputBPM" min="0" max="100"></input>
                                <span data-toggle="tooltip" data-html="true" 
                                    title="Al iniciar la sesión, se reproducirá un periodo de relajación 
                                    durante el cual se obtiene un valor que determina el punto de transición entre los niveles bajo y alto. 
                                    A este valor se le añade un porcentaje, lo que resulta en un nuevo límite que define la separación entre los niveles bajo y alto."
                                    style="margin-left:10px; font-size:large">&#xf059;</span>
                            </div>    
                        </div>

                        <div class="col-md-6">
                            <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text container-icons">
                                            <span>&#xf256;</span>
                                        </div>
                                    </div>
                                    <input name="movement" type="number" value="{{$session->movement}}" placeholder="Mágnitud del movimiento (0-10)" class="input-session form-control" id="numberInputMove" min="0" max="10"></input>
                                    <span data-toggle="tooltip" data-html="true" 
                                    title=" Marcará cuánta magnitud tiene que tener un movimiento del dispositivo para que se entienda como alto. Cuanto más bajo, más susceptible a movimientos será el sensor
                                    para determinar que hay mucho o poco movimiento"
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                            </div>                     
                        </div>
                    </div>

                    <div class="container-session-gamification">
                        <div class="row">
                            <span>&#xf11b;</span>
                            <p>Puntos durante la sesión:</p>
                            <span data-toggle="tooltip" data-html="true" 
                                    title="Durante la sesión el niño irá ganando puntos, a modo de incentivo, según lo definido en el plan de estudio y lo que seleccione
                                    en esta sección (Puede seleccionar VARIAS OPCIONES)."
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <div class="row container-selection-button">
                            <input style="display:none;" name="gamification" value="bpm" style="display:none;" id="gamification-input"></input>
                            <button class="button-selected" type="button" value="bpm" onclick="selectOption(this, 'button-game','gamification-input')" name="button-game">Pulsación Baja</button>
                            <button class="button-canceled" type="button" value="move" onclick="selectOption(this,  'button-game','gamification-input')" name="button-game">Movimiento Bajo</button>
                            <button class="button-canceled" type="button" value="all" onclick="selectOption(this,  'button-game','gamification-input')" name="button-game">Ambos bajo</button>
                        </div>
                    </div>

                    <div class="container-session-gamification">
                        <div class="row">
                            <span>&#xf017;</span>
                            <p>Visualización de sesión en reloj:</p>
                            <span data-toggle="tooltip" data-html="true" 
                                    title="Cómo se va a ver la pantalla del reloj mientras que se ejecuta la sesión, personalizable según la opción seleccionada"
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <div class="row">
                            <div class="col-md-3 container-clock">
                                <div class="circulos">
                                    <div id="blue-circle" class="circulo text-col">
                                            <p id="reloj-hora">10:10</p>
                                            <p id="reloj-periodo">Estudia</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-9 container-clock-options">
                                <div class="container-session-gamification">
                                    <div class="row">
                                        <span>&#xf110;</span>
                                        <p>Barra temporizadora:</p> <p class="text-description">El circulo azul de la imagen irá creciendo o decreciendo, dependiendo del tiempo que quede de periodo (estudio/descanso) o lleve</p>
                                    </div>
                                    <div class="row container-selection-button">
                                        <input  name="timer_clock" style="display:none;" id="timer-input" value="increase"></input>
                                        <button class="button-selected" type="button" value="increase" name="timer-buttons" onclick="selectOption(this,'timer-buttons','timer-input');setCircle('blue')" >En aumento (t.lleva)</button>
                                        <button class="button-canceled" type="button" value="decrease" name="timer-buttons" onclick="selectOption(this,'timer-buttons','timer-input');setCircle('blue')" >En decremento (t.falta)</button>
                                        <button class="button-canceled" type="button"  value="none" name="timer-buttons" onclick="selectOption(this,'timer-buttons','timer-input');setCircle('none')" >Sin temporizador</button>
                                    </div>
                                </div>

                                <div class="container-session-gamification">
                                    <div class="row">
                                        <span>&#xf0e2;</span>
                                        <p>Cuenta atrás numérica:</p> <p class="text-description">Texto que muestra una cuenta atrás o la hora que es</p>
                                    </div>
                                    <div class="row container-selection-button">
                                        <input name="hour_clock" style="display:none;" id="hour-input" value="time"></input>
                                        <button class="button-selected" type="button" value="time" name="hour-buttons" onclick="selectOption(this,'hour-buttons','hour-input');setHourPeriod('10:10')" >Mostrar hora</button>
                                        <button class="button-canceled" type="button" value="countdown" name="hour-buttons" onclick="selectOption(this,'hour-buttons','hour-input');setHourPeriod('01:40')" >Mostrar cuenta atrás</button>
                                        <button class="button-canceled" type="button" value="conometrer" name="hour-buttons" onclick="selectOption(this,'hour-buttons','hour-input');setHourPeriod('05:30')" >Mostrar tiempo que lleva</button>
                                        <button class="button-canceled" type="button" value="none" name="hour-buttons" onclick="selectOption(this,'hour-buttons','hour-input');setHourPeriod('')" >No mostrar nada</button>
                                    </div>
                                </div>
                                

                                <div class="container-session-gamification">
                                    <div class="row">
                                        <span>&#xf031;</span>
                                        <p>Nombre del periodo:</p> <p class="text-description">Texto que indica si el usuario está en el periodo de estudio o descanso</p>
                                    </div>
                                    <div class="row container-selection-button">
                                        <input name="text_clock" style="display:none;" id="text-input" value="all"></input>
                                        <button class="button-selected" type="button" value="all" name="text-buttons" onclick="selectOption(this,'text-buttons','text-input'); setTextPeriod('Estudia')"> Mostrar en todos los periodos</button>
                                        <button class="button-canceled" type="button" value="study" name="text-buttons" onclick="selectOption(this,'text-buttons','text-input'); setTextPeriod('Estudia')">Mostrar solo en estudio</button>
                                        <button class="button-canceled" type="button" value="rest" name="text-buttons" onclick="selectOption(this,'text-buttons','text-input'); setTextPeriod('Descansa')">Mostrar solo en descanso</button>
                                        <button class="button-canceled" type="button" value="none" name="text-buttons" onclick="selectOption(this,'text-buttons','text-input'); setTextPeriod('')">No mostrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Botón para cerrar el popup -->
            <div class="float-end">
                <button type="submit" class="button-objective-next-step">Guardar</button>
                <button type="button" class="button-objective-cancel-step" onclick="closePopup()">Cancelar</button>
            </div>
        </div>
    </div>
</form>
<div id="popup-on" class="popup" style="display:none;">
    <div class="popup-content popup-width-50">
        <div class="row">
            <div class="col">
                <h2>Selecciona plan de estudio</h2>
            </div>
            <div class="col-md-1 button-close-container">
                <button onclick="closeTherapyPopup()" type="button" class="button-close">
                    <span>&#xf00d;</span>
                </button>
            </div>
        </div>
        <script>
           $(function () {
                $('[data-toggle="tooltip"]').tooltip()}) 
        </script> 
        <div class="row container-inputs-top">
                <div class="col-md-4 container-input-span">
                    <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                    <input placeholder="Buscar plan de estudio"></input>
                </div>
                <div class="col-md-7 d-flex flex-row container-filter-align-end">
                    <button type="button"><span class="fa-regular fa-filter">Filtrar</span></button>
                </div>   
        </div>

        <div class="table-responsive text-center">
            <table class="table">
                <tr class="top-index-container">
                    <th scope="col">Nombre</th>
                    <th scope="col">Duración</th>
                    <th scope="col">Reglas</th>
                    <th scope="col">Selección</th>
                </tr>
                <div id="patient-list" class="table-items-options-overflow">
                    @foreach($therapies->take(5) as $ther)
                    <tr>
                        <td>{{$ther->name}}</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td scope="row"><button class="button-objective-next-step" type="checkbox" onclick="selectTherapy( '{{$ther->id}}', '{{$ther->name}}' )">SELECCIONAR</td>
                    </tr>
                    @endforeach
                </div>
            </table>
        </div>
    </div>
</div>


<div id="popup-objectives" class="popup" style="display:none;">
    <div class="popup-content popup-width-50">
        <div class="row">
            <div class="col">
                <h2>Selecciona hito y objetivo</h2>
            </div>
            <div class="col-md-1 button-close-container">
                    <button onclick="closeObjectivesPopup()" type="button" class="button-close">
                        <span>&#xf00d;</span>
                    </button>
            </div>
        </div>
        <script>
           $(function () {
                $('[data-toggle="tooltip"]').tooltip()}) 
        </script> 
        <div class="row container-inputs-top">
                <div class="col-md-4 container-input-span">
                    <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                    <input placeholder="Buscar plan de estudio"></input>
                </div>
                <div class="col-md-7 d-flex flex-row container-filter-align-end">
                    <button type="button"><span class="fa-regular fa-filter">Filtrar</span></button>
                </div>   
        </div>

        <div class="table-responsive text-center">
            <table class="table">
                <tr class="top-index-container">
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Selección</th>
                </tr>
                <div id="patient-list" class="table-items-options-overflow">
                    @foreach($objectives->take(5) as $obj)
                    <tr>
                        <td>{{$obj->name}}</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td scope="row"><button class="button-objective-next-step" type="checkbox" onclick="openMileStonesPopUp('{{$obj->id}}')">SELECCIONAR</td>
                    </tr>
                    @endforeach
                </div>
            </table>
        </div>
    </div>
</div>


<div id="popup-objectives-milestones" class="popup-on" style="display:none;">
    <div class="popup-content popup-width-50">
        <div class="row">
            <div class="col">
                <h2>Selecciona HITO del objetivo</h2>
            </div>
            <div class="col-md-1 button-close-container">
                <button onclick="closeMileStonePopup()" type="button" class="button-close">
                    <span>&#xf00d;</span>
                </button>
            </div>
        </div>
        <script>
           $(function () {
                $('[data-toggle="tooltip"]').tooltip()}) 
        </script> 
        <div class="row container-inputs-top">
                <div class="col-md-4 container-input-span">
                    <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                    <input placeholder="Buscar plan de estudio"></input>
                </div>
                <div class="col-md-7 d-flex flex-row container-filter-align-end">
                    <button type="button"><span class="fa-regular fa-filter">Filtrar</span></button>
                </div>   
        </div>

        <div class="table-responsive text-center">
            <table class="table" id="table-milestones">
                
            </table>
        </div>
    </div>
</div>

@endsection