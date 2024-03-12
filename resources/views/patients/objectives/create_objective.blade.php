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
    <script src="{{asset('/JS/dashboards/patients/objectives/objectives.js')}}"></script>

    <meta  name="date" id="date-start" content="{{ $date_start }}"></meta>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/create-session.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
    <link rel="stylesheet" href="{{asset('/css/draws/clock.css')}}">
</head>

</div>
<!-- Popup -->
<form id="objective_form" action="{{route('objetives_create',  ['patient_id' => $patient -> id], false, true)}}" method="POST">
    @csrf    
<div id="popup" class="popup">
        @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @if($errors->any())
            <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
        @endif
        <div class="popup-content popup-width-50">
            <div class="row">
                <div class="col">
                    <h2>Crear Objetivo para {{$patient->name}}</h2>
                </div>
                <div class="col text-end align-button-right">
                    <button type="button" class="button-close" onclick="closePopup()">                        
                      <span>&#xf00d;</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 container-session-inputs" id="container-objective-one">
                    <input style="display:none;" name="type" id="objective-type-input" value="study"></input>
                    <div class="form-row" id="type-selection-container">
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectType('objective-type-input', this, 'type-selection-container')" type="button" class="image-container-objective-w100" value="study">
                            <img class="rounded-image" src="{{asset('images/bookmedal.jpg')}}"></img>
                            <p>Objetivo de estudio</p>
                            </button>
                        </div>
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectType('objective-type-input', this, 'type-selection-container')"  type="button" class="image-container-objective-w100" value="personal">
                            <img class="rounded-image" src="{{asset('images/personalmedal.jpg')}}"></img>
                            <p>Objetivo personal</p>
                            </button>
                        </div>
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectType('objective-type-input', this, 'type-selection-container')"  type="button" class="image-container-objective-w100" value="scholastic">
                            <img class="rounded-image" src="{{asset('images/schoolmedal.jpg')}}"></img>
                            <p>Objetivo escolar</p>
                            </button>
                        </div>
                    </div>
                    

                    <div style="margin-left:5px" class="row container-session-gamification">
                            <span>&#xf2db;</span>
                            <p>Fecha del objetivo</p> <p class="text-description"></p>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7" id="fecha-div">
                            <input class="input-session form-control" placeholder="Fecha y hora de la sesión" type="date" id="fecha" name="date_end"></input>
                        </div>
                        <div class="col-md-5" id="hora-div">
                            <input class="input-session form-control" placeholder="Fecha y hora de la sesión" type="time" id="hora" name="time_end"></input>
                        </div>
                    </div>

                    <input name="name" id="name-input" class="input-session form-control" placeholder="Nombre del objetivo"></input>
                    <textarea name="description" class="form-control" rows="3" placeholder="Descripción"></textarea>

                    <div class="float-end">
                        <button type="button" onclick="gotonextstep()" class="button-objective-next-step">Siguiente</button>
                        <button type="button" class="button-objective-cancel-step" onclick="closePopup()">Cancelar</button>
                    </div>
                </div>
 
                <div class="col-md-12 container-session-inputs" id="container-objective-two" style="display:none;">
                    <input style="display:none;" id="steps-input" name="steps" value="steps"></input>
                    <button type="button" class="button-objective-next-step" onclick="createMilestone()">Crear Hito</button>
                    <div class="milestones-container-list" id="milestones-list">
                        <div class="row milestone-container">
                            <h1 class="col-md-2">1</h1>
                            <div  class="col-md-4 milestone-container-div"><input class="input-session form-control" id = "input-1"; name="stepname" placeholder="Nombre del hito"></input></div>
                            <div  class="col-md-4 milestone-container-div"><input class="input-session form-control" name="stepcoment" placeholder="Comentario del hito"></input></div>
                        </div>

                    </div>
                    
                    <div class="float-end">
                        <button type="button" onclick = "saveAndSendObjective()" class="button-objective-next-step">Guardar</button>
                        <button type="button" class="button-objective-cancel-step" onclick="gotolaststep()">Ir a paso anterior</button>
                    </div>
                </div>
                
            </div>
            <!-- Botón para cerrar el popup -->
            
        </div>
    </div>
</form>
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