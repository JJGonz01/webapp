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

    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/create-session.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
</head>

<!-- Popup -->
<div id="popup" class="popup">
    <div class="popup-content">
        <h2>Crear Sesión para {{$patient->name}}</h2>
        <div class="row">
            <div class="col-md-3 container-session-inputs">
                <div style="margin-left:5px" class="row container-session-gamification">
                        <span>&#xf2db;</span>
                        <p>Datos de la sesión</p> <p class="text-description"></p>
                </div>
                <div class="form-row">
                    <div class="col-md-7" id="fecha-div">
                        <input class=" form-control" placeholder="Fecha y hora de la sesión" type="date" id="fecha" name="date_start"></input>
                    </div>
                    <div class="col-md-5" id="hora-div">
                        <input class="form-control" placeholder="Fecha y hora de la sesión" type="time" id="hora" name="time_start"></input>
                    </div>
                </div>
                <input class="form-control" placeholder="Nombre"></input>
                <textarea class="form-control" rows="3" placeholder="Descripción"></textarea>

                <div style="margin-left:5px" class="row container-session-gamification">
                        <span>&#xf073;</span>
                        <p>Repetir sesión</p> <p class="text-description"></p>
                        <span data-toggle="tooltip" data-html="true" 
                                title="Puede elegir si esta sesión de estudio ocurre todas las semanas, o todos los meses (una vez al mes)"
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>

                <div class="checkbox-session">
                    <div class="col-md-1" id="fecha-div">
                        <input class="form-check-input form-check-input-sm" placeholder="Fecha y hora de la sesión" type="checkbox" id="fecha" name="date_start"></input>
                    </div>
                    <div class="col-md-10" id="hora-div">
                        <p> No repetir</p>
                    </div>
                </div>

                <div class="checkbox-session">
                    <div class="col-md-1" id="fecha-div">
                        <input class="form-check-input form-check-input-sm" placeholder="Fecha y hora de la sesión" type="checkbox" id="fecha" name="date_start"></input>
                    </div>
                    <div class="col-md-10" id="hora-div">
                        <p> Repetir cada semana</p>
                    </div>
                </div>

                <div class="checkbox-session">
                    <div class="col-md-1" id="fecha-div">
                        <input class="form-check-input form-check-input-sm" placeholder="Fecha y hora de la sesión" type="checkbox" id="fecha" name="date_start"></input>
                    </div>
                    <div class="col-md-10" id="hora-div">
                        <p> Repetir cada mes</p>
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
                        <div class="input-group-text">
                            <span id="inputGroup-sizing-sm">Seleccionar plan de estudio</span>
                        </div>
                    </div>
                    <input type="text" class="form-control" aria-label="Text input with checkbox" readonly>
                    <div class="input-group-prepend">
                        <div class="input-group-text">
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
                                <div class="input-group-text">
                                    <span >&#xf21e;</span>
                                </div>
                            </div>
                            <input type="number" placeholder="Sensibilidad Pulsaciones (0-100)" class="form-control" id="numberInput" min="0" max="100"></input>
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
                                    <div class="input-group-text">
                                        <span>&#xf256;</span>
                                    </div>
                                </div>
                                <input type="number" placeholder="Mágnitud del movimiento (0-10)" class="form-control" id="numberInput" min="0" max="10"></input>
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
                        <p>Gamificación:</p> <p class="text-description">Cuando se suman puntos</p>
                        <span data-toggle="tooltip" data-html="true" 
                                title="Durante la sesión el niño irá ganando puntos, a modo de incentivo, según lo definido en el plan de estudio y lo que seleccione
                                en esta sección (Puede seleccionar VARIAS OPCIONES)."
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                    </div>
                    <div class="row container-selection-button">
                        <button>Pulsación Baja</button>
                        <button>Movimiento Bajo</button>
                        <button>Cada periodo completado</button>
                    </div>
                </div>

                <div class="container-session-gamification">
                    <div class="row">
                        <span>&#xf017;</span>
                        <p>Reloj:</p> <p class="text-description">Como se verá la sesión en el reloj</p>
                        <span data-toggle="tooltip" data-html="true" 
                                title="Que aparecerá en la pantalla del reloj durante la sesión de estudio."
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                    </div>
                    <div class="row">
                        <div class="col-md-3 container-clock">
                            <div class="circulos">
                                <div class="circulo text-col">
                                        <p id="reloj-hora">10:10</p>
                                        <p id="reloj-periodo">Estudia</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 container-clock-options">
                            <div class="container-session-gamification">
                                <div class="row">
                                    <span>&#xf110;</span>
                                    <p>Barra Temporizador:</p> <p class="text-description">Barra que muestra el tiempo que falta/lleva</p>
                                </div>
                                <div class="row container-selection-button">
                                    <button>En aumento (t.lleva)</button>
                                    <button>En decremento (t.falta)</button>
                                    <button>Sin temporizador</button>
                                </div>
                            </div>

                            <div class="container-session-gamification">
                                <div class="row">
                                    <span>&#xf0e2;</span>
                                    <p>Cuenta atrás:</p> <p class="text-description">Texto que muestra una cuenta atrás o la hora</p>
                                </div>
                                <div class="row container-selection-button">
                                    <button>Mostrar hora</button>
                                    <button>Mostrar cuenta atrás</button>
                                    <button>Mostrar tiempo que lleva</button>
                                    <button>No mostrar nada</button>
                                </div>
                            </div>
                            

                            <div class="container-session-gamification">
                                <div class="row">
                                    <span>&#xf031;</span>
                                    <p>Texto Periodo:</p> <p class="text-description">Texto que indica si esta en estudio o descanso</p>
                                </div>
                                <div class="row container-selection-button">
                                    <button>Mostrar en todos los periodos</button>
                                    <button>Mostrar solo en estudio</button>
                                    <button>Mostrar solo en descanso</button>
                                    <button>No mostrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Botón para cerrar el popup -->
        <div class="float-end">
            <button class="btn btn-primary" onclick="closePopup()">Guardar</button>
            <button class="btn btn-danger" onclick="closePopup()">Cancelar</button>
        </div>
    </div>
</div>

<div id="popup-on" class="popup">
    <div class="popup-content">
        <h2>Selecciona plan de estudio</h2>
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
                    <button type="button"><span class="fa-regular fa-filter"> Filtrar</span></button>
                    <button type="submit"><span class="fa-regular fa-plus"> Añadir</span></button>
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
                    @foreach($therapies->take(5) as $ter)
                    <tr>
                        <td>{{$ther->name}}</td>
                        <td>TBD</td>
                        <td>TBD</td>
                        <td scope="row"><input type="checkbox" value="{{$patient->id}}" id="checkbox1"></td>
                    </tr>
                    @endforeach
                </div>
            </table>
        </div>
    </div>
</div>
<!-- div class="reglas-container-right"  id="contenedor_creador_reglas" style="display:flex;">
                <div class="content-half-image"></div>
                <div class="content-half">
                    <div>
                    <script src="https://www.pomodoro.ovh/sessionCreate.js"></script>
                    <script src="https://www.pomodoro.ovh/therapy_js/rule.js"></script>

                    <script src="https://www.pomodoro.ovh/javascript/unsaved.js"></script>
                    <h6 style="display:none" id="errors_display" class="alert alert-danger"><h6>
                    <form id="session_form" action="{{route('sessions_create',  ['patient_id' => $patient -> id], false, true)}}" method="POST">
                        @if (session('success'))
                            <h6 class="alert alert-success"> {{ session('success') }}</h6>
                        @endif
                        @if($errors->any())
                            <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
                        @endif
                                        
                        
                           <button class="close-button" type="button" onclick="closeRuleCreator();permitir_salida(true)">CERRAR</button> 
                           <div class="rule-creation-steps">
                                
                                <div class="row-steps-container">
                                    <div class="row-steps-item">
                                        <button type="button" id="menu_reglas_btn_one" class="button-popup-reglas" style = "background-color: rgb(33, 145, 215); color:white;" onclick="rule_creation_step(1)">1</button>
                                        <p class="step-font">Fecha</p>
                                    </div>

                                    <div class="row-steps-item">
                                        <button type="button" id="menu_reglas_btn_two" class="button-popup-reglas" onclick="rule_creation_step(2)">2</button>
                                        <p class="step-font">Sensores</p>
                                    </div>

                                    <div class="row-steps-item">
                                        <button type="button" id="menu_reglas_btn_three" class="button-popup-reglas" onclick="rule_creation_step(3)">3</button>
                                        <p class="step-font">Reloj</p>
                                    </div>
                                </div>
                            </div>
                            <div  id = "rule_creation_step_one" class="input-regla-container">
                                @csrf
                                <input id="terapia_seleccion" style="display:none" name="therapy_id"></input>
                                <p class="step-font" for="date_start">Fecha y hora de la sesión</p>
                                <input type="datetime-local" id="fechaHora" class="input-regla-container-input" name="date_start"></input>
                                


                                <div>
                                        <p class="step-font">Elegir terapia para sesión</p>              
                                </div>
                                <div id="terapias_botones" class="therapy-selection-container">
                                        @if(count($therapies) > 0)
                                        @foreach($therapies as $ter)
                                        <button id="button_{{$ter->id}}" class="edit-button" type="button" onclick="selectTerapia( {{$ter->id}} , this )">{{ $ter->name }}</button>
                                        @endforeach
                                        @else
                                            <p class="step-font"> CREA UNA TERAPIA PARA PODER CREAR LA SESIÓN</p>
                                            <a onclick="printClickedId(this)" class= "task-end-btn" href = "{{route('therapies_create', [], false, true)}}">CREAR TERAPIA</a>
                                        @endif
                                </div>

                                <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="closeRuleCreator()" >Salir</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create" onclick="rule_creation_step(2)" type="button">
                                            <span class="material-symbols-outlined">arrow_forward</span>
                                        </button>
                                </div>
                            </div>            
                                <div class="input-regla-container" id = "rule_creation_step_two" style="display:none;">
                                    <p class="step-font">Sensibilidad de los sensores</p>        
                                    <div>

                                        <div>
                                            <div class="inputs-session">
                                                <label for="porcentaje">Sensibilidad (%) BPM</label>
                                                <input id="porcentaje" value = 20 type="number" name="porcentaje" class="form-control" rown="10"></input>
                                            </div>

                                            <div class="inputs-session">
                                                    <label for="movement">Sensibilidad (%) movimiento</label>
                                                    <select name ="movement" >
                                                        <option value="Muy Bajo"> Muy Bajo (2)</option>
                                                        <option value="Bajo"> Bajo (1.5)</option>
                                                        <option value="Medio"> Medio (0.9)</option>
                                                        <option value="Alto"> Alto (0.6)</option>
                                                        <option value="Muy Alto"> Muy Alto (0.4)</option>
                                                    </select>
                                            </div>
                                            <div class="inputs-session">
                                                    <label for="modoJuego">Juego en estudio</label>
                                                    <select name ="modoJuego" id="modoJuego">
                                                        <option value="juegoAmbos">Sumar puntos en función del tiempo que este relajado <strong>(ambos sensores en bajo)</strong></option>
                                                        <option value="juegoCorazon">Sumar puntos en función del tiempo que tenga las <b>pulsaciones en bajo</b></option>
                                                        <option value="juegoMovimiento">Sumar puntos en función del tiempo que el <b>movimiento sea bajo</b></option>
                                                        <option value="JuegoReglas">Solo suma puntos con lo definido en las reglas</option>
                                                    </select>                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="rule_creation_step(1)" >Atrás</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create" onclick="rule_creation_step(3)" type="button">
                                            <span class="material-symbols-outlined">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                            <div  id = "rule_creation_step_three" class="input-regla-container" style="display:none;">
                            <p class="step-font">Reloj durante las sesiones de estudio</p>        
                            <div class="clock-preview">
                                <div class="clock">
                                    <div id="progreso" class="inner-circle"></div>
                                    <div id="minutos" class="time">
                                        10:00
                                    </div>
                                    <div id="periodo" class="day">
                                        Estudia
                                    </div>
                                </div>
                                <div class="options-clock">  
                                    <label><input id="especifico-input" class="options-clock-input" type="checkbox" name="opcion[]" value="Barra" checked> Añadir barra de progreso</input></label>
                                    <label><input id="especifico-input" class="options-clock-input" type="checkbox" name="opcion[]" value="Reloj" checked> Añadir reloj/ conómetro</input></label>
                                    <label><input id="especifico-input" class="options-clock-input" type="checkbox" name="opcion[]" value="Nombre" checked> Añadir nombre periodo</input></label>
                                </div>
                            </div>
                            
                            <div class="inputs-session">
                                <label for="tiempoFalta">Minutos en texto (si seleccionado)</label>
                                <select name ="tiempoFalta" id="tiempoFalta">
                                    <option value="mostrarRestante">Mostrar los minutos que faltan para acabar</option>
                                    <option value="mostrarHora">Mostrar la hora actual</option>
                                </select>                   
                            </div>

                            <div class="inputs-session">
                                <label for="barraFalta">Barra de progreso (si seleccionada)</label>
                                <select name ="barraFalta" id="barraFalta">
                                    <option value="desdeCero">Que la barra aumente según se vaya completando</option>
                                    <option value="desdeTotal">Que la barra se reduzca según se vaya completando</option>
                                </select>                   
                            </div>

                                    <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="rule_creation_step(2)" >Atrás</button>
                                        <button type="button" onclick="check()" class="input-regla-container-button" id="add_action_rule_ther_create">
                                            Guardar sesión
                                        </button>
                                    </div>
                            </div>
                    </form> 
                    </div>                        
            </div>
        </div -->
@endsection