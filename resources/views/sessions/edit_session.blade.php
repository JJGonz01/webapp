@extends('/patients/show_patient')
 
@section('session')

<head>
    <title>EDITAR SESIÓN</title>
</head>



<div class="reglas-container-right"  id="contenedor_creador_reglas" style="display:flex;">
                <div class="content-half-image" onclick="closeRuleCreator()"></div>
                <div class="content-half">
                    <div>
                    <form action="{{route('session_update',  ['id' => $session -> id], false, true)}}" method="POST">
                       
                                    
                        <script src="https://pomodoroadhdapp.azurewebsites.net/sessionCreate.js"></script>
                           <button class="close-button" type="button" onclick="closeRuleCreator()">CERRAR</button> 
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
                                </div>
                            </div>
                            <div  id = "rule_creation_step_one" class="input-regla-container">
                                @csrf
                                <input id="terapia_seleccion" style="display:none" name="therapy_id"></input>
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
                                        <button class="button_reglas_back" type="button" onclick="closeRuleCreator()" >Salir</button>
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
                                                <input id="porcentaje" value="{{$session->movement}}" type="number" name="porcentaje" class="form-control" rown="10"></input>
                                            </div>

                                            <div class="inputs-session">
                                                    <label for="movement">Sensibilidad (%) movimiento</label>
                                                    <select name ="movement" >
                                                        <option value="Bajo"> Bajo (0.4)</option>
                                                        <option value="Medio"> Medio (0.6)</option>
                                                        <option value="Alto"> Alto (0.9)</option>
                                                    </select>
                                            </div>
                                            <div class="inputs-session">
                                                    <label for="modoJuego">Juego en estudio</label>
                                                    <select name ="modoJuego" id="modoJuego">
                                                        <option value="JuegoReglas">Solo suma puntos con lo definido en las reglas</option>
                                                        <option value="juegoAmbos">Sumar puntos en función del tiempo que este relajado <strong>(ambos sensores en bajo)</strong></option>
                                                        <option value="juegoCorazon">Sumar puntos en función del tiempo que tenga las <b>pulsaciones en bajo</b></option>
                                                        <option value="juegoMovimiento">Sumar puntos en función del tiempo que el <b>movimiento sea bajo</b></option>
                                                    </select>                   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="rule_creation_step(2)" >Atrás</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create">
                                            Guardar sesión
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                    </form> 
                    </div>                        
            </div>
        </div>
@endsection