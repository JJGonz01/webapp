@extends('main')

@section('patients_section') 


<head>
    <title>CREAR TERAPIA</title>
</head>


<form id="form_crear_sesion" action="{{route('therapies_create')}}" method="POST">
    <script src="{{ asset('therapy_js/period_creations.js') }}"></script>
    <script src="{{ asset('therapy_js/menus_terapia.js') }}"></script>
    <script src="{{ asset('therapy_js/rule.js') }}"></script>
    <script src="{{ asset('terapies_creator.js') }}"></script>

    <!-- INPUTS FANTASMA PARA LOS DATOS-->
    <input name="rules_edit" id="rules_edit" value = "null" style="display: none;" />
    <input name="periods_edit" id="periods_edit" value = "null" style="display: none;" />
    <input name="periods[]" id="input_period" style="display: none;" />
    <input name="rules" id="input_rules" style="display: none;" />
    <input name="newRuleSet" id="newRuleSet" style="display: none;" />
    <input name="defaultNewRuleSet" id="defaultNewRuleSet" style="display: none;" />
    <input id="selectConjPeriodo" style="display:none;"></input>
    <div id="created_periods_container" style="display:none"></div>
    <input id="soloLanzarUnaVezReal" name="defaultRuleset" style="display:none;" /> 
    <input id="ruleNameEditing" name="ruleNameEditing" style="display:none;" /> 
    <div id="juegoTiempo" style= "display:none;">
                            <input  value = 0 type="number" name="juegoPuntos" class="form-control" rown="10"> puntos</input>
    </div>
           
    <input name="isEditing" id="isEditing" value = "0" style="display: none;" />
   
    @csrf
    @if (session('success'))
    <h6 class="alert alert-success"> {{ session('success') }}</h6>
    @endif
    @if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
    @endif
    
    <div class="therapy-creation-container">
            
                
        <div class="therapy-input-row">
            <div>
                <p>NOMBRE</p>
                <input type="text" id="name_therapy" name="name" class="name-therapy-input" placeholder="Nombre de la terapia"></input>
            </div>
            <button id="save_therapy_btn" type="submit" class="create-big-button">GUARDAR TERAPIA</button>
            
        </div>
           

        <div>
            <div class="header-selector">
                <div class="row-text-button">
                    <p>Bloques de estudio</p>
                    <div id="boton_der_periodos">
                    <button id="period_creation_btn" onclick="showHidePeriodCreation()" type="button" class="llamative-button">CREAR BLOQUE</button></div>
                </div>
                <div class="row-option-selector">
                            <div id="listas">
                            </div>

                            <div id="contenedor">
                                <ul id="lista_periodo" class="row-bloque">
                                </ul>
                            </div>
                </div>
            </div>

            <h6 style="display:none;" class="alert alert-danger" id="create_alert_period">
                            Bloque creado correctamente
            </h6>

            <h6 style="display:none;" class="alert alert-danger" id="edited_alert_period">
                            Bloque editado correctamente
            </h6>
            <h6 style="display:none;" class="alert alert-danger" id="error_period">
                            Tipo de comportamiento NO DECLARADO
            </h6>
            <h6 style="display:none;" class="alert alert-danger" id="error_period_extra">
                            Tipo de comportamiento NO DECLARADO
            </h6>
            <div class="header-selector" style="display:none;" id="period_creation_container">
                <div class="row-text-button">
                    <p id="periodo_estancia">CREAR BLOQUE DE ESTUDIO</p>
                    <div id="boton_der_periodos">
                    <button id="close_period_creator_container_btn" onclick="closePeriodCreation()" type="button" class="delete-button">CERRAR BLOQUE</button></div>
                </div>
                <div class="back-period-creation">
                    <div id="periodo_principal">
                        <div class="therapy-input-row">
                            <div>
                                <label for="t1">Estudio (Minutos)</label>
                                <input id="t1" type="number" name="t1" class="form-control mb-3">
                            </div>

                            <div>
                                <label for="descanso">Descanso (Minutos)</label>
                                <input id="descanso" type="number" name="descanso" class="form-control mb-3">
                            </div>

                            <div>
                                <label for="t2">Estudio (Minutos)</label>
                                <input id="t2" type="number" name="t2" class="form-control mb-3">
                            </div>

                            <div>
                            <button id="save_first_period_ther_create" type="button" class="create-medium-button" onclick="saveTemporalPeriod(this)"> Agregar nuevo bloque</button>
                            </div>
                        </div>
                    </div>

                    <div style="display:none;" id="periodo_secundario">
                        <div class="therapy-input-row">
                            <div class="periodos">
                                <label for="descanso_extra">Descanso (Minutos)</label>
                                <input id="descanso_extra" type="number" name="descanso" class="form-control" rown="10">
                            </div>
                            
                            <div class="periodos">
                                <label for="t1_extra">Estudio (Minutos)</label>
                                <input id="t1_extra" type="number" name="t2" class="form-control" rown="10">
                            </div>
                            <button id="save_extra_period_ther_create" type="button" onclick="savePeriodExtra(this)" class="create-medium-button"> Agregar Periodo</button>
                        </div>
                    </div>

                    <h4 style="display:none;" class="alert alert-danger" id="errorCreandoRegla"></h4>
                    

                    
                    <div class="header-selector">
                        <div id ="rule-creator-btn" class="row-text-button"><p>REGLAS</p> 
                        <button id="open_rule_creator_ther_create" type="button" class="llamative-button" onclick="openRuleCreator(0)" id="boton_crear_regla"> CREAR REGLA </button></div>
                        <h4 id="texto_regla_periodo">Crea el bloque para añadirle reglas</h4>
                        
                        <div id="lista_reglas_periodo" class="row-option-selector">
                        </div>

                        <div class="back-period-creation"  id="contenedor_creador_reglas" style="display:none;">
                            
                            <button id="close_rule_creator_ther_create" class="delete-button" type="button" onclick="closeRuleCreator()">X</button>
                            <div class="therapy-input-row">
                                <div>
                                    <label for="selectPeriodo">Nombre de la regla</label>
                                    <input class = "rule-form-space-input" type="text" id="rule_name" name="ruleName"></input>
                                </div> 
                        
                                <div>
                                    <label for="selectPeriodo">Periodo</label>
                                    <select id="selectPeriodo"></select>
                                </div> 
                                <div>
                                    <label for="selectMomentoPeriodo">Momento Periodo</label>
                                    <select id="selectMomentoPeriodo"></select>
                                </div> 

                                <button id="save_action_rule_ther_create" onclick="guardarRegla(null);" id="boton_guardar_regla" class="create-button" type="button"> Guardar Regla </button>
                            </div>
                            <input id="soloLanzarUnaVezReal" name="defaultRuleset" style="display:none;" />
                            <div class="two-divs-row-container">
                                
                                
                                <div class="conditions-container">
                                    <label>Condiciones</label>
                                    <div class="elements-conditions" id="appear-dissapearDiv"> </div>
                                    <button id="add_action_rule_ther_create" onclick="createDiv()" class="create-button"  type="button">Añadir condición</button>
                                </div>
                                
                                
                                <div class="actions-container">
                                    <label>Acciones</label>
                                    <div class="therapy-check-row">
                                        <input type="checkbox" id="soloLanzarUnaVez" name="defaultRuleset" />
                                        <label for="defaultRuleset">
                                            Ejecutar regla una única vez
                                        </label>
                                    </div>

                                    <div id="condicionPapi">
                                        <div class="elements-conditions-container">
                                            <div class="therapy-input-row">
                                                <div class="therapy-check-row-text">
                                                    <label for="AccionSelect">Acción en el reloj</label>
                                                    <select id="AccionSelect"></select>
                                                </div>

                                                <div class="therapy-check-row-text" id="sumPuntDiv">
                                                    <p for="puntosSum">Puntos a añadir (estrellas):</p>
                                                    <input type="number" id="puntosSum" />
                                                </div>
                                            </div>

                                            <div class="therapy-input-row">
                                                <div class="therapy-check-row-text">
                                                    <label for="AccionSelectSesion">Acción en la sesión</label>
                                                    <select id="AccionSelectSesion"></select>
                                                </div>
                                                <div class="therapy-check-row-text" id="extraTimeDiv">
                                                    <p for="extraTime">Tiempo a añadir (minutos):</p>
                                                    <input type="number" id="extraTime" />
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <button id="buttonAccion" class="create-button"  onclick="crearAccionFinalExtra()" type="button">Añadir Acción Extra</button>    
                                </div>
                            </div>


                        
                        </div>
                        
                    </div>
                    
                </div>

                
            </div>
        </div>
    </div>
    <script>rulesStart()</script>
</form>

@endsection