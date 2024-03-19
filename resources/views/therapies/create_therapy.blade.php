@extends('main')

@section('patients_section') 


<head>
    <title>CREAR TERAPIA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    
    <script src="{{asset('JS/dashboards/therapies/therapies-blocks.js')}}"></script>
    <script src="{{asset('JS/dashboards/therapies/therapies-rules.js')}}"></script>
    <script src="{{asset('JS/dashboards/therapies/therapies-create-rules.js')}}"></script>
    <script src="{{asset('JS/dashboards/messages/messages.js')}}"></script>

    <link rel="stylesheet" href="{{asset('/css/dashboards/therapies/therapies-create.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients.css')}}">
    <link rel="stylesheet" href="{{asset('/css/draws/clock.css')}}">
</head> 
@if (session('success'))
    <h6 class="alert alert-success"> {{ session('success') }}</h6>
    @endif
    @if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
    @endif
<div id="popup-on-on" class="popup-on-on" style="display:none;">
    <div class="popup-on-content-on container-condition">
        <h2>Crear mensaje</h2>
                
        <div class="row">
            <div class="col-md-3">
                <div>
                    <div class="circulos container-clock">
                        <div class="text-col container-text-message">
                                <p style="text-align:center;"  id="title-clock-create" class="text-title">¡Vamos a estudiar!</p>
                                <div style="padding-left:20px;"  class="row text-row">
                                    <img class="col-5" src="/images/hijo.png"></img>
                                    <p id="subtitle-clock-create" class="col-6 text-message-container">¡A por el estudio!</p>
                                </div>
                        </div>
                    </div>
                    <div class="clock-message">
                        <div class="row">
                            <span class="col-md-1">&#xf21e;</span>
                            <p class="col-md-9" style="margin-left:10px; font-weight: bolder;">Imagen del mensaje</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <div id="carouselExample" class="carousel slide">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                <img src="/images/estrella.png" class="d-block w-100" alt="/images/estrella.png">
                                </div>
                                <div class="carousel-item"> 
                                <img src="/images/estrella.png" class="d-block w-100" alt="/images/estrella.png">
                                </div>
                                <div class="carousel-item TEXT-CENTER">
                                    <button>AÑADIR</button>
                                </div>
                            </div>
                            <button class="carousel-control-prev btn-primary" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden"><</span>
                            </button>
                            <button class="carousel-control-next btn-primary" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9" class="table-responsive text-center">
                <div class="input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Nombre del mensaje</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <input id="input-message-name" class="form-control"></input>
                </div>

                <div style="margin-bottom:30px;" class="input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Tipo de mensaje</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <div class="input-group-prepend" id="message-type-container">
                            <input id="message-type-input" value=0 style="display:none;"></input>
                            <button onclick="messageSelect('message-type-container',this,0)" class="button-selected">Sin botón</button>
                            <button onclick="messageSelect('message-type-container',this,1)" class="button-canceled">Un botón</button>
                            <button onclick="messageSelect('message-type-container',this,2)" class="button-canceled">Dos botones</button>
                        </div>
                </div>
                <div class="input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Mensaje principal</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <input id="input-message-title"  class="form-control"></input>
                </div>

                <div class="input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Mensaje secundario</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <input id="input-message-subtitle" class="form-control"></input>
                </div>

                <div class="row">
                    <div class="col-5 input-group input-group-conditions">
                            <div class="input-group mb-2">
                                <span>&#xf21e;</span>
                                <p style="margin-left:10px; font-weight: bolder;">Botón 1</p>
                                <span data-toggle="tooltip" data-html="true" 
                                title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                            </div>
                            <input id="input-btn1"  class="form-control"></input>
                    </div>

                    <div class="col-5 input-group input-group-conditions">
                        <div class="input-group mb-2">
                            <span>&#xf21e;</span>
                            <p style="margin-left:10px; font-weight: bolder;">Botón 2</p>
                            <span data-toggle="tooltip" data-html="true" 
                            title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                        </div>
                        <input id="input-btn2" class="form-control"></input>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="float-end clock-message">
            <button class="btn btn-primary" onclick="callCreateMessage(true)">Crear</button>
            <button class="btn btn-danger" onclick="cancelCreateMessage()">Cancelar</button>
        </div>
    </div>
    
</div>

<div id="popup-on" class="popup-on" style="display:none;">
    <div class="popup-on-content container-condition">
        <h2>Elige mensaje</h2>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9" class="table-responsive text-center">
                <div class="row container-inputs-top">
                        <div class="col-md-5 container-input-span">
                            <span style="font-family: Arial, FontAwesome; padding-right: 4px;">&#xf002;</span>
                            <input placeholder="Buscar mensajes"></input>
                        </div>
                        <div class="col-md-6 d-flex flex-row container-filter-align-end">
                            <button type="button"><span class="fa-regular fa-filter"> Filtrar</span></button>
                            <button type="submit" onclick="openCreateMessage()"><span class="fa-regular fa-plus"> Añadir</span></button>
                        </div>   
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="col-md-3 container-clock">
                    <div class="circulos">
                        <div class="text-col container-text-message">
                                <p style="text-align:center;"  id="title-clock-select" class="text-title">¡Vamos a estudiar!</p>
                                <div style="padding-left:20px;"  class="row text-row">
                                    <img class="col-5" src="/images/hijo.png"></img>
                                    <p id="subtitle-clock-select" class="col-6 text-message-container">¡A por el estudio!</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9" class="table-responsive text-center">
                <table class="table" id="messages-list" >
                    <tr class="top-index-container">
                        <th scope="col">Seleccionar</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Botón</th>
                    </tr>
                    <div class="table-items-options-overflow">
                         
                    </div>
                </table>
            </div>
        </div>
        <div class="float-end">
            <button class="btn btn-primary" onclick="selectMessage()">Seleccionar</button>
            <button class="btn btn-danger" onclick="closeMessagesPopUp()">Cancelar</button>
        </div>
    </div>
    
</div>
<div id="popup" class="popup" style="display:none;">
    <div class="popup-content container-condition">
        <h2>Crear una regla</h2>
        <div class="row container-condition-creator">
            
            <div class="col-md-4">
                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Datos de la regla</p>
                    <span data-toggle="tooltip" data-html="true" 
                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>
                
                <input id="condition-name" placeholder ="Nombre de la condición" class="form-control"></input>
                <textarea id="condition-description" placeholder ="Comentario" class="form-control"></textarea>

                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Numero de ejecuciones</p>
                    <span data-toggle="tooltip" data-html="true" 
                    title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                    style="margin-left:10px; font-size:large" >&#xf059;</span>
                </div>

                <div class="input-group">
                        
                        <div class="input-group-prepend">
                            <input value="always" id="repetition-condition" style="display:none;"></input>                           
                            <button value="1" class="button-selected" id="variasveces-c" name="always" onclick="selectTimesComprobation(this, 'unavez-c','repetition-condition')">Siempre que se cumpla</button>
                            <button value="0"  class="button-canceled" id="unavez-c"  name="one" onclick="selectTimesComprobation(this, 'variasveces-c', 'repetition-condition')">Una única vez</button>
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
                            <button class="button-selected" id="estudio-cond" onclick="selectPeriodComprobation(this)" value=1>Estudio</button>
                            <button class="button-selected" id="descanso-cond" onclick="selectPeriodComprobation(this)" value=1>Descanso</button>
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
                            <select class="form-control input-group" id="input-moment-period">
                                <option value="all">Todo el periodo</option>
                                <option value="first_half">1ª mitad</option>
                                <option value="second_half">2º mitad</option>
                                <option value="first_third">1º tercio</option>
                                <option value="second_third">2º tercio</option>
                                <option value="last_third">Ult. tercio</option>
                            </select>
                        </div>
                    </div>
                    <div class="float-end" style="margin-top:30%;">
                        <button class="button-save" onclick="saveNewRule()">Guardar</button>
                        <button class="button-cancel" onclick="closeRulesPopUp()">Cancelar</button>
                    </div>
            </div>

            <div class="col-md-4">
                <div class="input-group mb-2">
                    <span>&#xf21e;</span>
                    <p style="margin-left:10px; font-weight: bolder;">Reglas creadas</p>
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
                            
                            <div class="">
                                <input class="rule-block-checkbox" id="ch-heart-value" type="checkbox" disabled></input>
                                <i style="margin-left:10px; font-weight: bolder;">Valor del sensor</i>
                            </div>

                            <div class="row" id="ch-heart-value-div">
                                <div class="col-md-6 title-options" class="input-group-prepend">
                                    <div class="input-group-prepend">
                                        <input id="heart-val-input" style="display:none;"></input>
                                        <button id="heart-value-high" name="high" value=1 onclick="conditions(this, 'heart-value-low', 'heart-val-input')" class="button-disabled" disabled>Alto</button>
                                        <button id="heart-value-low" name="low" value=0 onclick="conditions(this, 'heart-value-high', 'heart-val-input')" class="button-disabled" disabled>Bajo</button>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                        title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                        sus condiciones, y luego no volver a comprobarse"
                                        style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <input class="rule-block-checkbox" id="ch-heart-tendency" type="checkbox" disabled></input>
                                <i style="margin-left:10px; font-weight: bolder;">Valor del sensor</i>
                            </div>

                            <div class="row" id="ch-heart-tendency-div">
                                <div class="col-md-6" class="input-group-prepend">
                                    <div class="input-group-prepend">
                                        <input id="heart-tend-input" style="display:none;"></input>
                                        <button id="heart-tend-high" name="increasing" onclick="conditions(this, 'heart-tend-low', 'heart-tend-input')" class="button-disabled" disabled>Aumentando</button>
                                        <button id="heart-tend-low" name="decreasing" onclick="conditions(this, 'heart-tend-high', 'heart-tend-input')" class="button-disabled" disabled>Disminuyendo</button>
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
                                    <div class="">
                                        <input class="rule-block-checkbox" id="ch-move-value" type="checkbox" disabled></input>
                                        <i style="margin-left:10px; font-weight: bolder;">Valor del sensor</i>
                                    </div>
                                    <div class="row" id="ch-move-value-div">
                                        <div class="col-md-6 title-options" class="input-group-prepend">
                                            <div class="input-group-prepend">
                                                <input id="move-val-input" style="display:none;"></input>
                                                <button id="move-val-high" name="high" onclick="conditions(this, 'move-val-low', 'move-val-input')" class="button-disabled" disabled>Alto</button>
                                                <button id="move-val-low" name="low" onclick="conditions(this, 'move-val-high', 'move-val-input')" class="button-disabled" disabled>Bajo</button>
                                                <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="title-subsection">
                                        <input class="rule-block-checkbox" id="ch-move-tendency" type="checkbox" disabled></input>
                                        <i style="margin-left:10px; font-weight: bolder;">Valor del sensor</i>
                                    </div>                              

                                    <div class="row" id="ch-move-tendency-div">
                                        
                                        <div class="col-md-6" class="input-group-prepend">
                                            
                                            <div class="input-group-prepend">
                                               <input id="move-tend-input" style="display:none;"></input>
                                                <button id="move-tend-high" name="increasing" onclick="conditions(this, 'move-tend-low','move-tend-input')"  class="button-disabled" disabled>Aumentando</button>
                                                <button id="move-tend-low" name="decreasing" onclick="conditions(this, 'move-tend-high','move-tend-input')"  class="button-disabled" disabled>Disminuyendo</button>
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

                                <div class="title-subsection">
                                        <i style="margin-left:10px; font-weight: bolder;">Lanzar mensaje</i>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>                              

                                <div style="margin-bottom:-10px;" class="row">
                                    <div class="col-md-3">
                                        <button onclick ="getMessages(true)" class="button-open-selection">Seleccionar</button>
                                    </div>
                                    <input style="display:none;" id="message-primary"></input>
                                    <p class="col-md-8" id="p-message-primary-selected">Sin mensaje seleccionado</p>
                                </div>

                                <div class="title-subsection">
                                        <i style="margin-left:10px; font-weight: bolder;">Valor del sensor</i>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                </div>                              

                                <div class="row">
                                    
                                    <div class="col-md-12" class="input-group-prepend">
                                        
                                        <div class="input-group-prepend" id="div-session-action-main">
                                            <input id="accion-sesion-primary" value = "none" style="display:none;"></input>
                                            <button name="none" value = 1 onclick="actionOptions('div-session-action-main', this)" class="button-selected">Nada</button>
                                            <button name="end_period" value = 0 onclick="actionOptions('div-session-action-main', this)" class="button-canceled">Concluir periodo</button>
                                            <button name="end_session" value = 0 onclick="actionOptions('div-session-action-main', this)" class="button-canceled">Concluir sesión</button>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row title-subsection">
                                    <div class="col-md-6 row">
                                        <i class="col-md-8" style="margin-left:10px; font-weight: bolder;">Sumar/restar puntos</i>
                                        <span class="col-md-1" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                     </div>        
                                     
                                     <div class="col-md-6 row">
                                        <i class="col-md-8" style="margin-left:10px; font-weight: bolder;">Añadir/Reducir duración</i>
                                        <span class="col-md-1" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                     </div>  
                                </div>                              

                                <div class="row">
                                    
                                    <div class="col-md-5 input-group-prepend">
                                        <input id="input-points-primary" class="form-control form-control-sm" value = 0></input>
                                    </div>
                                    
                                    <div class="col-md-5 input-group-prepend">
                                        <input id="input-time-primary" class="form-control form-control-sm" value = 0></input>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row rule-block container-deselected" id="div-secondary-action">
                                <div class="col-md-12" id="checkbox-accion-secundaria-div">
                                    <div class="input-group mb-2">
                                        <input class="rule-block-checkbox" type="checkbox" id="checkbox-accion-secundaria"></input>
                                        <span>&#xf21e;</span>
                                        <p style="margin-left:10px; font-weight: bolder;">Acción secundaria</p>
                                        <span data-toggle="tooltip" data-html="true" 
                                        title="Establece los valores que tienen que cumplirse para que se ejecuten las acciones"
                                        style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>
                                    <div class="title-subsection">
                                        <i style="margin-left:10px; font-weight: bolder;">Lanzar mensaje</i>
                                        <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                            title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                            sus condiciones, y luego no volver a comprobarse"
                                            style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>                              

                                    <div style="margin-bottom:-10px;" class="row">
                                        <div class="col-md-4">
                                            <button disabled onclick ="getMessages(false)" class="button-open-selection">Seleccionar</button>
                                        </div>
                                        <input id="input-time-primary" style="display:none;" id="message-secondary"></input>
                                        <p id="p-message-secondary-selected" class="col-md-7">Sin mensaje seleccionado</p>
                                    </div>

                                    <div class="title-subsection">
                                            <i style="margin-left:10px; font-weight: bolder;">Modificar sesión completa</i>
                                            <span class="col-md-2" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                    </div>                              

                                    <div class="row">
                                        
                                        <div class="col-md-12" class="input-group-prepend">
                                            
                                            <div class="input-group-prepend" id="div-session-action-sec">
                                                <input id="accion-sesion-secondary" value = "none" style="display:none;"></input>
                                                <button disabled name="none" value = 1 onclick="actionOptions('div-session-action-sec', this)" class="button-disabled">Nada</button>
                                                <button disabled name ="end_period" value = 0 onclick="actionOptions('div-session-action-sec', this)" class="button-disabled">Concluir periodo</button>
                                                <button disabled name ="end_session" value = 0 onclick="actionOptions('div-session-action-sec', this)" class="button-disabled">Concluir sesión</button>
                                                
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row title-subsection">
                                        <div class="col-md-6 row">
                                            <i class="col-md-8" style="margin-left:10px; font-weight: bolder;">Sumar/restar puntos</i>
                                            <span class="col-md-1" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                        </div>        
                                        
                                        <div class="col-md-6 row">
                                            <i class="col-md-8" style="margin-left:10px; font-weight: bolder;">Añadir/Reducir duración</i>
                                            <span class="col-md-1" data-toggle="tooltip" data-html="true" 
                                                title="Una condición puede lanzarse todas las veces que se cumpla, o solo una unica vez, cuando se cumplan
                                                sus condiciones, y luego no volver a comprobarse"
                                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                                        </div>  
                                    </div>                              

                                    <div class="row">
                                        
                                        <div class="col-md-5 input-group-prepend">
                                            <input id="input-points-secondary" class="form-control form-control-sm" value = 0></input>
                                        </div>
                                        
                                        <div class="col-md-5 input-group-prepend">
                                            <input id="input-time-secondary" class="form-control form-control-sm" value = 0></input>
                                        </div>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </div>
        
    </div>
</div> 

<form id="form_crear_therapy" action="{{route('therapies_create')}}" method="POST">
    @csrf
    <input name="periods[]" id="input_period" style="display: none;"/>
    <input name="rules" id="rule_period" style="display: none;"/>
    <div class="container-main">
        <div class="row container-therapy">
            <div class="col-md-5">
                <div class="input-group mb-4 container-inputs">
                    <span>&#xf02d;</span>
                    <p style="margin-left:10px;">Datos del plan de estudio</p> <p class="text-description"></p>
                </div>
                <div class="input-group mb-4 container-inputs">
                        <div class="input-group-prepend">
                            <div class="input-group-text span-container">
                                <span>&#xf5b7;</span>
                            </div>
                        </div>
                        <input placeholder="Nombre del plan de estudio" name = "name" id="therapy-name" class="form-control"></input>
                </div>
                
                <div class="input-group mb-4 container-inputs">
                        
                        <div class="input-group-prepend">
                            <div class="input-group-text span-container">
                                <span>&#xf573;</span>
                            </div>
                        </div>
                        <textarea class="form-control" name="description" rows="3" id="therapy-description" placeholder="Descripción"></textarea>
                </div> 
            </div>
            <div class="col-md-6">
                <div class="input-group mb-4 container-inputs">
                    <span>&#xf004;</span>
                    <p style="margin-left:10px;">Sesión de relajación:</p> <p class="text-description"></p>
                </div>

                <div class="input-group mb-4 container-inputs">
                        <div class="input-group-prepend ">
                            <div class="input-group-text span-container">
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
    </div>

    <div class="container-main">
        <div class="row container-therapy">
            <div class="col-md-7 h-100 container-periods">
                <div class="input-group-prepend d-flex">
                    <div class="row mr-auto container-padding">
                        <h2 >Bloques de estudio</h2>
                        <span data-toggle="tooltip" data-html="true" 
                                title="Un bloque es un conjunto de periodos, compuesto por un periodo de descanso y su posterior estudio, para que todo periodo de estudio venga
                                acompañado de su correspondiente descanso."
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                    </div>

                    <button type="button"  class="button-add" onclick="addBlock()"><span>&#x2b;</span></button>
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
                            <button type="button" id="button-edit-0" class="button-select-period" onclick="showRulesInContainer(0)"><span>&#xf044;</span></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 container-conditions">
                <div class="input-group-prepend d-flex">
                    <div class="row mr-auto container-padding">
                        <h2 id="conditions-title">Reglas del bloque 0</h2>
                        <span data-toggle="tooltip" data-html="true" 
                                title="Aqui se definen las distintas condiciones y acciones que tendrá el bloque"
                                style="margin-left:10px; font-size:large" >&#xf059;</span>
                    </div>

                    <button type="button"  class="button-add" onclick="openRulesPopUp()"><span>&#x2b;</span></button>
                </div>
                <div class="container-inner-periods" id="condition-div">
                    
                </div>
            </div>
            <div class="float-end" style="margin-top:3%;">
                <button type="button" class="button-save" onclick="saveAndSend();">Guardar</button>
                <button type="button" class="button-cancel" onclick="printMapaReglas()">Cancelar</button>
            </div>
        </div>
    </div>
</form>

<script>
           $(function () {
                $('[data-toggle="tooltip"]').tooltip()}) 

                setEventListenerCheckbox("div-secondary-action","checkbox-accion-secundaria");
                setEventListenerCheckbox("div-container-movement","checkbox-condition-movement");
                setEventListenerCheckbox("container-condition-heart","checkbox-condition-heart");
</script>

@endsection