@extends('main')

@section('patients_section') 


<head>
    <title>CREAR TERAPIA</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    
    <script src="{{asset('JS/dashboards/therapies/therapies-blocks.js')}}"></script>
    <script src="{{asset('JS/dashboards/therapies/therapies-rules.js')}}"></script>

    <link rel="stylesheet" href="{{asset('/css/dashboards/therapies/therapies-create.css')}}">
</head> 

<div id="popup" class="popup">
    <div class="popup-content container-condition">
        <h2>Crear una condición</h2>
        <div class="row container-condition-creator">
            
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Datos de la condición</p>
                    <span data-toggle="tooltip" data-html="true" 
                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>
                
                <input placeholder ="Nombre de la condición" class="form-control"></input>
                <textarea placeholder ="Comentario" class="form-control"></textarea>

                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Numero de ejecuciones</p>
                    <span data-toggle="tooltip" data-html="true" 
                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>

                <div class="input-group">
                        
                        <div class="input-group-prepend">
                            <button>Una única vez</button>
                            <button>Siempre que se cumpla</button>
                        </div>
                </div>

                <div class="input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Periodos de comprobación</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <div class="input-group-prepend">
                            <button>Estudio</button>
                            <button>Descanso</button>
                        </div>
                </div>

                <div class="input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Momento en periodo de comprobación</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <div class="input-group-prepend">
                            <select class="form-control input-group">
                                <option>Todo el periodo</option>
                                <option>1ª mitad</option>
                                <option>2º mitad</option>
                                <option>1º tercio</option>
                                <option>2º tercio</option>
                                <option>Ult. tercio</option>
                            </select>
                        </div>
                    </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Condiciones</p>
                    <span data-toggle="tooltip" data-html="true" 
                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>

                <div class="container-condition-inner" id="div-bpm-general">
                    <div class="row rule-block container-buttons container-deselected" id="container-condition-heart">
                        <div class="col-md-12">
                            <div class="input-group mb-2">
                                <input class="rule-block-checkbox" type="checkbox" id="checkbox-condition-heart"></input>
                                <span>&#xf21e;</span>
                                <p style="margin-left:10px; font-weight: bolder;">Sensor de pulsacion</p>
                                <span data-toggle="tooltip" data-html="true" 
                                title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                            </div>
                            
                            <div class="span-subsection">Valor del sensores</div>

                            <div class="row">
                                <div class="col-md-6" class="input-group-prepend">
                                    
                                    <div class="input-group-prepend">
                                    <button class="button-selected">Ninguno</button>
                                        <button class="button-canceled">Alto</button>
                                        <button class="button-canceled">Bajo</button>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                        title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                        sus condiciones, y luego no volver a comprobarse"
                                        style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>
                                </div>
                            </div>

                            <div class="span-subsection">Tendencia del sensores</div>
                            <div class="row">
                                
                                <div class="col-md-6" class="input-group-prepend">
                                    
                                    <div class="input-group-prepend">
                                        <button class="button-selected">Ninguno</button>
                                        <button class="button-canceled">Aumentando</button>
                                        <button class="button-canceled">Disminuyendo</button>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                        title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                        sus condiciones, y luego no volver a comprobarse"
                                        style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-condition-inner" id="div-mov-general">
                    
                    <div class="row rule-block container-deselected" id="div-container-movement">
                        <div class="col-md-12">
                                <div class="input-group mb-2">
                                    <input class="rule-block-checkbox" id="checkbox-condition-movement" type="checkbox"></input>
                                    <span>&#xf21e;</span>
                                    <p style="margin-left:10px; font-weight: bolder;">Sensor de movimiento</p>
                                    <span data-toggle="tooltip" data-html="true" 
                                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>
                                <div>
                                    <div class="span-subsection">Valor del sensor</div>

                                    <div class="row">
                                        <div class="col-md-6" class="input-group-prepend">
                                            
                                            <div class="input-group-prepend">
                                            <button class="button-canceled" disabled>Ninguno</button>
                                                <button class="button-canceled" disabled>Alto</button>
                                                <button class="button-canceled" disabled>Bajo</button>
                                                <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span-subsection">Tendencia del sensor</div>
                                    <div class="row">
                                        
                                        <div class="col-md-6" class="input-group-prepend">
                                            
                                            <div class="input-group-prepend">
                                                <button class="button-canceled" disabled>Ninguno</button>
                                                <button class="button-canceled" disabled>Aumentando</button>
                                                <button class="button-canceled" disabled>Disminuyendo</button>
                                                <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Acciones</p>
                    <span data-toggle="tooltip" data-html="true" 
                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>
                <div class="container-condition-inner" id="div-action-general">
                    <div class="row rule-block">
                        <div class="col-md-12">
                                <div class="input-group mb-2">
                                    <span>&#xf21e;</span>
                                    <p style="margin-left:10px; font-weight: bolder;">Acción principal</p>
                                    <span data-toggle="tooltip" data-html="true" 
                                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>
                                <div class="row">
                                    <p class="col-md-3">Acción en el reloj</p>
                                    <div class="col-md-6 mb-2" class="input-group-prepend">
                                        <select class="form-control-sm input-group">
                                            <option>Nada</option>
                                            <option>1ª mitad</option>
                                            <option>2º mitad</option>
                                            <option>1º tercio</option>
                                            <option>2º tercio</option>
                                            <option>Ult. tercio</option>
                                        </select>
                                    </div>
                                    <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>

                                <div class="row">
                                    <p class="col-md-3">Acción en la sesión</p>
                                    <div class="col-md-6 mb-3" class="input-group-prepend">
                                        <select class="form-control-sm input-group">
                                            <option>Nada</option>
                                            <option>1ª mitad</option>
                                            <option>2º mitad</option>
                                            <option>1º tercio</option>
                                            <option>2º tercio</option>
                                            <option>Ult. tercio</option>
                                        </select>
                                    </div>
                                    <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>

                                <div class="row">
                                    <p class="col-md-3">Sumar o restar puntos</p>
                                    <div class="col-md-6" class="input-group-prepend">
                                        <input class="form-control-sm"></input>
                                    </div>
                                    <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>

                                <div class="row">
                                    <p class="col-md-3">Modificar duración</p>
                                    <div class="col-md-6" class="input-group-prepend">
                                        <input class="form-control-sm" placeholder=""></input>
                                    </div>
                                    <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>
                            </div>
                        </div>

                        <div class="row rule-block container-deselected" id="div-secondary-action">
                                <div class="col-md-12">
                                    <div class="input-group mb-2">
                                        <input class="rule-block-checkbox" type="checkbox" id="checkbox-accion-secundaria"></input>
                                        <span>&#xf21e;</span>
                                        <p style="margin-left:10px; font-weight: bolder;">Acción secundaria</p>
                                        <span data-toggle="tooltip" data-html="true" 
                                        title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                                        style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-3">Acción en el reloj</p>
                                        <div class="col-md-6 mb-2" class="input-group-prepend">
                                            <select class="form-control-sm input-group">
                                                <option>Nada</option>
                                                <option>1ª mitad</option>
                                                <option>2º mitad</option>
                                                <option>1º tercio</option>
                                                <option>2º tercio</option>
                                                <option>Ult. tercio</option>
                                            </select>
                                        </div>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>

                                    <div class="row">
                                        <p class="col-md-3">Acción en la sesión</p>
                                        <div class="col-md-6 mb-3" class="input-group-prepend">
                                            <select class="form-control-sm input-group">
                                                <option>Nada</option>
                                                <option>1ª mitad</option>
                                                <option>2º mitad</option>
                                                <option>1º tercio</option>
                                                <option>2º tercio</option>
                                                <option>Ult. tercio</option>
                                            </select>
                                        </div>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>

                                    <div class="row">
                                        <p class="col-md-3">Sumar o restar puntos</p>
                                        <div class="col-md-6" class="input-group-prepend">
                                            <input class="form-control-sm"></input>
                                        </div>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>

                                    <div class="row">
                                        <p class="col-md-3">Modificar duración</p>
                                        <div class="col-md-6" class="input-group-prepend">
                                            <input class="form-control-sm"></input>
                                        </div>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="row">
    <div class="col-md-5">
        <div class="input-group mb-4 container-inputs">
            <span>&#xf02d;</span>
            <p style="margin-left:10px;">Datos del plan de estudio</p> <p class="text-description"></p>
        </div>
        <div class="input-group mb-4 container-inputs">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>&#xf5b7;</span>
                    </div>
                </div>
                <input placeholder="Nombre del plan de estudio" class="form-control"></input>
        </div>
        
        <div class="input-group mb-4 container-inputs">
                
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>&#xf573;</span>
                    </div>
                </div>
                <textarea class="form-control" rows="3" placeholder="Descripción"></textarea>
        </div> 
    </div>
    <div class="col-md-6">
        <div class="input-group mb-4 container-inputs">
            <span>&#xf004;</span>
            <p style="margin-left:10px;">Sesión de relajación:</p> <p class="text-description">Periodo de relajación que ocurrirá al principio de la sesión</p>
        </div>
        <div class="input-group mb-4 container-inputs">
                
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>&#xf031;</span>
                    </div>
                </div>
                <input maxlength="14" placeholder="Relajación" class="form-control"></input>
                <span data-toggle="tooltip" data-html="true" 
                title="Texto que aparecerá en la pantalla durante la relajación, puede ser vacío y no aparecerá nada"
                style="margin-left:10px; font-size:large" >&#xf059;</span>
        </div>

        <div class="input-group mb-4 container-inputs">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <span>&#xf025;</span>
                    </div>
                </div>
                <select placeholder="Relajación" class="form-control">
                    <option>Audio Mindfullness (6 minutos) - guiainfantil</option>
                    <option disabled>(Deshabilitado) **Subir audio (A futuro)**</option>
                </select>
                <span data-toggle="tooltip" data-html="true" 
                title="Audio que sonará durante el periodo de relajación, debería contener ejercicios de respiración, musculares, etc..."
                style="margin-left:10px; font-size:large" >&#xf059;</span>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-md-7 h-100 container-periods">
        <div class="input-group-prepend d-flex">
            <div class="row mr-auto container-padding">
                <h2 >Bloques de estudio</h2>
                <span data-toggle="tooltip" data-html="true" 
                        title="Un bloque es un conjunto de periodos, compuesto por un periodo de descanso y su posterior estudio, para que todo periodo de estudio venga
                        acompañado de su correspondiente descanso."
                        style="margin-left:10px; font-size:large" >&#xf059;</span>
            </div>

            <button class="ml-auto" onclick="addBlock()">Añadir</button>
        </div>

        <div class="container-inner-periods" id="main-div">
            <div class="row container-block">
                <div class="col-md-1" id="button-move">
                    <span data-toggle="tooltip" data-html="true" 
                        title="Este es el bloque principal, siempre se va a ejecutar, no puede eliminarse (pinned)"
                        style="font-size:large">&#xf08d;</span>
                </div>
                <div class="col-md-8 container-align-end">
                    <input class="col-4 form-control" id="mb_t1" placeholder="Estudio (min)"></input>
                    <input class="col-4 form-control" id="mb_rest" placeholder="Descanso (min)"></input>
                    <input class="col-4 form-control" id="mb_t2" placeholder="Estudio (min)"></input>
                </div>
                <div class="col-md-2 container-align-end">
                    <button id="button-edit"><span>&#xf304;</span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 container-conditions">
        <div class="input-group-prepend d-flex">
            <div class="row mr-auto container-padding">
                <h2 >Condiciones del bloque</h2>
                <span data-toggle="tooltip" data-html="true" 
                        title="Aqui se definen las distintas condiciones y acciones que tendrá el bloque"
                        style="margin-left:10px; font-size:large" >&#xf059;</span>
            </div>

            <button class="ml-auto">Añadir</button>
        </div>
        <div class="container-inner-periods" id="main-div">
            <div class="row rule-block">
                    <div class="col-md-1" id="button-move">
                        <span>&#xf21e;</span>
                    </div>
                    <div class="col-md-6">
                        <p>Nombre de la condición</p>
                        <p>Descripción</p>
                    </div>
                    <div class="col-md-4 container-align-end">
                        <button id="button-edit"><span>&#xf304;</span></button>
                        <button id="button-delete"><span>&#xf1f8;</span></button>
                    </div>
            </div>
        </div>
    </div>
</div>


<script>
           $(function () {
                $('[data-toggle="tooltip"]').tooltip()}) 

                setEventListenerCheckbox("div-secondary-action","checkbox-accion-secundaria");
                setEventListenerCheckbox("div-container-movement","checkbox-condition-movement");
                setEventListenerCheckbox("container-condition-heart","checkbox-condition-heart");
</script>

<!-- form id="form_crear_sesion" action="{{route('therapies_create',[], false, true)}}" method="POST">
    <script src="{{asset('therapy_js/period_creations.js')}}"></script>
    <script src="{{asset('therapy_js/menus_terapia.js')}}"></script>

    <script src="{{asset('therapy_js/rule.js')}}"></script>

    <script src="{{asset('terapies_creator.js')}}"></script>
    <script src="{{asset('therapy_js/period_creations.js')}}"></script>
    <script src="{{asset('javascript/unsaved.js')}}"></script>

   
    <input name="rules_edit" id="rules_edit" value = "null" style="display: none;"/>
    <input name="periods_edit" id="periods_edit" value = "null" style="display: none;"/>
    <input name="periods[]" id="input_period" style="display: none;"/>
    <input name="rules" id="input_rules" style="display: none;"/>
    <input name="newRuleSet" id="newRuleSet" style="display: none;" />
    <input name="defaultNewRuleSet" id="defaultNewRuleSet" style="display: none;"/>
    <input id="selectConjPeriodo" style="display:none;"></input>
    <div id="created_periods_container" style="display:none"></div>
    <input id="soloLanzarUnaVezReal" name="defaultRuleset" style="display:none;"/> 
    <input id="ruleNameEditing" name="ruleNameEditing" style="display:none;"/> 
    <div id="juegoTiempo" style= "display:none;">
                            <input  value = 0 type="number" name="juegoPuntos" class="form-control" rown="10"> puntos</input>
    </div>
           
    <input name="isEditing" id="isEditing" value = "0" style="display: none;"/>
   
    @csrf
    @if (session('success'))
    <h6 class="alert alert-success"> {{ session('success') }}</h6>
    @endif
    @if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
    @endif
    


    <div class="user-welcome-box">
            <div class="user-welcome-box-container">
                <input type="text" id="name_therapy" name="name" class="name-therapy-input" placeholder="Introducir nombre de la terapia"></input>
                <button class="user-welcome-box-container-button" onclick="permitir_salida(true)" type="submit" id="save_therapy_btn">GUARDAR NUEVA TERAPIA</button>
                
            </div>
            <div class="user-welcome-box-container">
            <div class="home-welcome-box">
                </div>
            </div>
    </div>



    <div class="therapy-creation-container">
            
        


        <div class="flex-header-selector">
            <div class="header-selector-small">
                <div class="row-text-button">
                    <p style="font-size:x-large;">Bloques de estudio</p>
                    <div id="boton_der_periodos">
                    <button id="period_creation_btn" onclick="showHidePeriodCreation()" type="button" class="llamative-button"><span class="material-symbols-outlined">add</span></button></div>
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

           
            <div class="header-selector-big">
            <div style="display:none;" id="period_creation_container">
                <h6 style="display:none;" class="alert alert-success" id="created_alert_period">
                     Periodos del bloque creados correctamente
                </h6>

                <h6 style="display:none;" class="alert alert-success" id="edited_alert_period">
                    Periodos del bloque editados correctamente
                </h6>

                <h6 style="display:none;" class="alert alert-danger" id="error_period">
                                Tipo de comportamiento NO DECLARADO
                </h6>
                <h6 style="display:none;" class="alert alert-danger" id="error_period_extra">
                                Tipo de comportamiento NO DECLARADO
                </h6>
                <div class="row-text-button">
                    <p style="font-size:x-large;" id="periodo_estancia">CREAR BLOQUE DE ESTUDIO</p>
                    <div id="boton_der_periodos"></div>
                </div>
                <div class="back-period-creation">
                    <div id="periodo_principal">
                        <div class="therapy-input-row">
                            <div>
                                <label for="t1">Periodo Estudio (Minutos)</label>
                                <input id="t1" min="1" type="number" name="t1" class="form-control mb-3">
                            </div>

                            <div>
                                <label for="descanso">Periodo Descanso (Minutos)</label>
                                <input id="descanso" min="1" type="number" name="descanso" class="form-control mb-3">
                            </div>

                            <div>
                                <label for="t2">Periodo Estudio (Minutos)</label>
                                <input id="t2" min="1" type="number" name="t2" class="form-control mb-3">
                            </div>

                            <div>
                            <button id="save_first_period_ther_create" type="button" class="create-medium-button-save" onclick="saveTemporalPeriod(this)"> <span class="material-symbols-outlined">save</span></button>
                            </div>
                        </div>
                    </div>

                    <div style="display:none;" id="periodo_secundario">
                        <div class="therapy-input-row">
                            <div class="periodos">
                                <label for="descanso_extra">Periodo Descanso (Minutos)</label>
                                <input id="descanso_extra" min="1" type="number" name="descanso" class="form-control" rown="10">
                            </div>
                            
                            <div class="periodos">
                                <label for="t1_extra">Periodo Estudio (Minutos)</label>
                                <input id="t1_extra" type="number" name="t2" min="1" class="form-control" rown="10">
                            </div>
                            <button id="save_extra_period_ther_create" type="button" onclick="savePeriodExtra(this)" class="create-medium-button-save"> <span class="material-symbols-outlined">save</span></button>
                        </div>
                    </div>

                    <div class="header-selector">
                        <div id ="rule-creator-btn" class="row-text-button"><p id="texto_regla_periodo">Guarda los periodos para añadirle reglas</p> 
                        <button id="open_rule_creator_ther_create" type="button" class="llamative-button" onclick="openRuleCreator(0)" id="boton_crear_regla"> <span class="material-symbols-outlined">add</span></button></div>
                        
                        
                        <div class="reglas-show-container-flow" id="lista_reglas_periodo">
                        </div>

                        <div class="reglas-container-right"  id="contenedor_creador_reglas" style="display:none;">
                            <div class="content-half-image"></div>
                            <div class="content-half">
                           
                                <button class="close-button" type="button" onclick="closeRuleCreator()">CERRAR</button>
                                <h4 style="display:none;" class="alert alert-danger" id="errorCreandoRegla"></h4>
                                <h4 style="display:none;" class="alert alert-success" id="sucessCreandoRegla">Regla creada con exito</h4>
                                <div class="rule-creation-steps">
                                    <div class="row-steps-container">
                                        <div class="row-steps-item">
                                            <button type="button" id="menu_reglas_btn_one" class="button-popup-reglas" style = "background-color: rgb(33, 145, 215); color:white;" onclick="rule_creation_step(1)">1</button>
                                            <p>Momento</p>
                                        </div>

                                        <div class="row-steps-item">
                                       
                                        <button type="button" id="menu_reglas_btn_two" class="button-popup-reglas" onclick="rule_creation_step(2)">2</button>
                                        <p>Condiciones</p>
                                        </div>

                                        <div class="row-steps-item">
                                            <button type="button" id="menu_reglas_btn_three" class="button-popup-reglas" onclick="rule_creation_step(3)">3</button>
                                            <p>Acciones</p>
                                        </div>


                                    </div>
                                </div>

                                <div id = "rule_creation_step_one" class="input-regla-container">
                                    <div>
                                        <label for="selectPeriodo">Nombre de la regla</label>
                                        <input type="text" id="rule_name" name="ruleName"></input>
                                    </div> 
                            
                                    <div>
                                        <label for="selectPeriodo">Periodo Periodo de comprobación</label>
                                        <select id="selectPeriodo"></select>
                                    </div> 
                                    <div>
                                        <label for="selectMomentoPeriodo">Momento de comprobación en el periodo</label>
                                        <select id="selectMomentoPeriodo"></select>
                                    </div> 

                                    <div class="rules-check-row">
                                        <div class="rules-check-row-column">
                                            <input type="checkbox" id="soloLanzarUnaVez" name="defaultRuleset" />
                                        </div>
                                        
                                        <div class="rules-check-row-column">
                                            <label for="defaultRuleset">
                                                Ejecutar regla una única vez en el periodo
                                            </label>
                                        </div>

                                    </div>
                                    <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="closeRuleCreator()">Salir</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create" onclick="rule_creation_step(2)" type="button">
                                            <span class="material-symbols-outlined">arrow_forward</span>
                                        </button>
                                    </div>

                                    
                                </div>
                                <input id="soloLanzarUnaVezReal" name="defaultRuleset" style="display:none;" />
                                
                                    
                                    
                                <div class="input-regla-container" id = "rule_creation_step_two" style="display:none;">
                                        <h6 style="display:none;" class="alert alert-success mb-0.1" id="created_condition_alert_period">
                                            Condición creada correctamente
                                        </h6>
                                        <div class="two-divs-row-container">
                                    
                                    <button id="add_action_rule_ther_create" onclick="createDiv();showConditionWellCreated(true)" class="button_reglas_action"  type="button">Añadir condición</button>
                                    
                                    </div>
                                    <div class="elements-conditions" id="appear-dissapearDiv"> </div>
                                
                                    <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="rule_creation_step(1)" >Atrás</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create" onclick="rule_creation_step(3)" type="button">
                                            <span class="material-symbols-outlined">arrow_forward</span>
                                        </button>
                                    </div>
                                </div>
                                
                                
                                <div  id = "rule_creation_step_three" style="display:none;">
                                    <button id="buttonAccion" class="button_reglas_action"  onclick="crearAccionFinalExtra()" type="button">Añadir Acción Extra</button>    

                                    <div id="condicionPapi" class="actions-container">
                                        
                                        <div class="elements-conditions-container">
                                            <div class="therapy-input-row">
                                                <div class="therapy-check-row-text">
                                                    <label for="AccionSelect">Acción en el reloj</label>
                                                    <select id="AccionSelect"></select>
                                                </div>

                                                <div class="therapy-check-row-text" id="sumPuntDiv">
                                                    <p for="puntosSum">Puntos a añadir:</p>
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
                                    <div class="button-centered-container">
                                        <button class="button_reglas_back" type="button" onclick="rule_creation_step(2)" >Atrás</button>
                                        <button class="input-regla-container-button" id="add_action_rule_ther_create" onclick="guardarRegla(null);" type="button">
                                            Guardar regla
                                        </button>
                                    </div>

                                </div>
                                

                            </div>
                        </div>
                        
                    </div>
                    
                </div>

            
            </div>
            </div>
        </div>
    </div>
    <script>rulesStart()</script>
</form -->

@endsection