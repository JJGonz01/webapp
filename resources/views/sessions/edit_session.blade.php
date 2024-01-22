@extends('/patients/show_patient')
 
@section('session')

<head>
    <title>EDITAR SESIÓN</title>
</head>



<div class="reglas-container-right"  id="contenedor_creador_reglas" style="display:flex;">
                <div class="content-half-image"></div>
                <div class="content-half">
                    <div>
                    <form id="session_form" action="{{route('session_update',  ['id' => $session -> id], false, true)}}" method="POST">
                       
                    <input id="valoresReloj" style="display:none;" value="{{$session->time_show}}">
                    <input id="modoJuegoInput" style="display:none;" value="{{$session->modoJuego}}">
                        <script src="https://www.pomodoro.ovh/therapy_js/rule.js"></script>
                        <script src="https://www.pomodoro.ovh/sessionCreate.js"></script>
                        <script src="https://www.pomodoro.ovh/javascript/unsaved.js"></script>
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
                                <input id="terapia_seleccion" style="display:none" name="therapy_id" value="{{$session->therapy_id}}"></input>
                                <p class="step-font" for="date_start">Fecha y hora de la sesión</p>
                                <input type="datetime-local" id="fechaHora" value="{{$session->date_start}}" class="input-regla-container-input" name="date_start"></input>
                                


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
                                            <a onclick="printClickedId(this)" class= "edit-button" href = "{{route('therapies_create', [], false, true)}}">CREAR TERAPIA</a>
                                        @endif
                                </div>

                                <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="closeRuleCreator();permitir_salida(true)" >Salir</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create" onclick="rule_creation_step(2)" type="button">
                                            <span class="material-symbols-outlined">arrow_forward</span>
                                        </button>
                                </div>
                            </div>            
                                <div class="input-regla-container" id = "rule_creation_step_two" style="display:none;">
                                        <p>Sensibilidad de los sensores</p>
                                    <div>
                                        
                                        <div>
                                            <div class="inputs-session">
                                                <label for="porcentaje">Sensibilidad (%) BPM</label>
                                                <input id="porcentaje" value="{{$session->percentage}}" type="number" name="porcentaje" class="form-control" rown="10"></input>
                                            </div>

                                            <div class="inputs-session">
                                                    <label for="movement">Sensibilidad (%) movimiento</label>
                                                    <select name ="movement" id="movementInput">
                                                        <option value="Muy Bajo"> Muy Bajo (0.4)</option>
                                                        <option value="Bajo"> Bajo (0.6)</option>
                                                        <option value="Medio"> Medio (0.9)</option>
                                                        <option value="Alto"> Alto (1.5)</option>
                                                        <option value="Muy Alto"> Muy Alto (2)</option>
                                                    </select>
                                            </div>
                                            <div class="inputs-session">
                                                    <label for="modoJuego">Juego en estudio</label>
                                                    <select name ="modoJuego" id="selectModoJuego">
                                                        <option value="JuegoReglas">Solo suma puntos con lo definido en las reglas</option>
                                                        <option value="juegoAmbos">Sumar puntos en función del tiempo que este relajado <strong>(ambos sensores en bajo)</strong></option>
                                                        <option value="juegoCorazon">Sumar puntos en función del tiempo que tenga las <b>pulsaciones en bajo</b></option>
                                                        <option value="juegoMovimiento">Sumar puntos en función del tiempo que el <b>movimiento sea bajo</b></option>
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
                                        <button class="input-regla-container-button" onclick = "check();permitir_salida()" id="add_action_rule_ther_create">
                                            Guardar sesión
                                        </button>
                                    </div>
                            </div>
                    </form> 
                    </div>                        
            </div>
        </div>
        <script>setOpciones(); getEditClockOptions();</script>
@endsection