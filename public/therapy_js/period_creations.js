var periods =  [];
var changed = {};
var numerosPeriodos = 0;
var posicionadoEn = 0;
var periodContainerOpen = false;
var rulesOpen = false;

function editWindowTherapy(){

  const texto_reglas_titulo = document.getElementById('input_period');
  var jsonString = texto_reglas_titulo.value;
  
  var cadenaJSON = JSON.stringify(jsonString);
  if(cadenaJSON.substring(0, 5) == "\"[\\\"["){
    var cadenaSinBarras = cadenaJSON.replace(/\\/g, '');
    cadenaSinBarras = cadenaSinBarras.replace('/', '');
    var cadenaModificada = cadenaSinBarras.slice(3, -2);
    cadenaModificada = cadenaModificada.slice(0, -1);
    texto_reglas_titulo.value = cadenaModificada;
  }
  posicionadoEn = 0; 
  numerosPeriodos = jsonString.length-1;
  closePeriodCreation();
}

function saveTemporalPeriod(button) {
  const texto_reglas_titulo = document.getElementById('texto_regla_periodo');
  var boton_primer_periodo = document.getElementById('save_first_period_ther_create');
  const errorMessage = document.getElementById("error_period");
  const periodInput = document.getElementById('input_period');
  var t1 = document.getElementById('t1');
  var t2 = document.getElementById('t2');
  var descanso = document.getElementById('descanso');


  const period = {
    duration_t1: t1.value,
    duration_t2: t2.value,
    duration_rest: descanso.value
  };

  if (!period.duration_t1.trim()||!period.duration_t2.trim()||!period.duration_rest.trim()) {
    errorMessage.style.display = "block";
    t1.style="border:1px solid red;"
    t2.style="border:1px solid red;"
    descanso.style="border:1px solid red;"
    errorMessage.innerHTML = "ERROR: Rellena todos los valores";
  } else if (parseFloat(period.duration_t1) <= 0) { 
    t1.style="border:1px solid red;"
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor estudio debe ser mayor que cero";
    t1.value = '';
  }else if (parseFloat(period.duration_t2) <= 0) {
    t2.style="border:1px solid red;"
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor estudio 2 debe ser mayor que cero";
    t2.value = '';}
  else if (parseFloat(period.duration_rest) <= 0) {
    descanso.style="border:1px solid red;"
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor descanso debe ser mayor que cero";
    descanso.value = '';
  } else {
    t1.style="border:1px solid #ced4da;"
    t2.style="border:1px solid #ced4da;"
    descanso.style="border:1px solid #ced4da;"
    var boton_reglas_titulo = document.getElementById('open_rule_creator_ther_create');
    boton_reglas_titulo.style.display="block";
    var esNuevo = false;
    if(periods.length == posicionadoEn) esNuevo = true;
    periods[posicionadoEn] = period;
    errorMessage.style.display = "none";
    var periodoSelect = document.getElementById('selectConjPeriodo');
    periodoSelect.value = "1";
    t1.value = '';
    t2.value = '';
    descanso.value = '';
    texto_reglas_titulo.innerHTML = "Regla para bloque";
    value = JSON.stringify(periods);
    periodInput.value = value;
    addPeriodsIdToSeleccion(button);
    showCreatedPeriods(esNuevo);
    showmessage(esNuevo);
    agregarListeners() 
    setSelectedButton(1);
  }
}

function showHidePeriodCreation(){
    openPeriodCreation();
    irACrearNuevo();
    setSelectedButton(1)
}

function showButtonFromCreatePeriod(){
  const period_creation_button = document.getElementById('period_creation_btn');
  period_creation_button.style = "display:block;";
  periodContainerOpen = false;
}
function closePeriodCreation(){
  periodContainerOpen = false;
  const period_creation_container = document.getElementById('period_creation_container');
  const period_creation_button = document.getElementById('period_creation_btn');
  period_creation_container.style = "display:none;";
  period_creation_button.style = "display:block;";
  
}

function openPeriodCreation(){
  periodContainerOpen = true;
  const period_creation_container = document.getElementById('period_creation_container');
  period_creation_container.style = "display:block;";
}
/**
 * Cuando se crea un periodo esto lo añade a la lista (y configura los botones)
 */
function showCreatedPeriods(esNuevo) {

  const texto_periodo_nombre = document.getElementById('periodo_estancia');
  const container = document.getElementById('created_periods_container');
  const botonDerechaPeriodos = document.getElementById('boton_der_periodos');
  const contenedor_de_reglas = document.getElementById('contenedor_creador_reglas');
  const texto_reglas_titulo = document.getElementById('texto_regla_periodo');
  const treglas_crear_btn = document.getElementById('boton_crear_regla');
  container.innerHTML = '';
  texto_periodo_nombre.innerHTML = 'Editar bloque '+ (posicionadoEn+1);
  takeChangeWithoutResolving();
  if(esNuevo == true){  
      const listaBtts = document.getElementById('lista_periodo');
      var botonPer = document.createElement('button');
      botonPer.classList.add('all-period-button');
      botonPer.textContent = 'Bloque '+(periods.length);
      botonPer.type =  "button";
      botonPer.id =  "button_bloque_"+(periods.length - 1);
      const p = periods.length-1;
      
      botonPer.setAttribute('onclick', "irAPeriodo("+p+")"); 
      var currentOnclick = botonPer.getAttribute('onclick');
      additionalFunction = "event.preventDefault(); printClickedId(this, '" + currentOnclick + "', null);";
      var newOnclick = additionalFunction
      botonPer.setAttribute('onclick', newOnclick); 
      listaBtts.appendChild(botonPer);
  }

 
  //contenedor_de_reglas.style.display = "block";
  //texto_reglas_titulo.innerHTML = "Regla para periodo "+(posicionadoEn+1);

  for(var i = 0; i< periods.length; i++){
    const div = document.createElement('div');
    div.id =  "Periodo_" + i;
    if(i == 0){

      div.innerHTML = `PERIODO PRINCIPAL: ESTUDIO: <strong>${periods[i].duration_t1}</strong> min`;
      botonDerechaPeriodos.style.display="block";

    }else{
      div.innerHTML = `PERIODO ` + i+`: DESCANSO: <strong>${periods[i].duration_rest}</strong> min ESTUDIO: <strong>${periods[i].duration_t1}</strong> min `;
      botonDerechaPeriodos.style.display="block";
      

    }
    container.appendChild(div);
  }
  
}


/**
 * Edita si es crear periodo o editar periodo
 */
function addPeriodsIdToSeleccion(button) {
 // button.innerHTML = "GUARDAR CAMBIOS";
  showButtonFromCreatePeriod();
  selectConjPeriodo = document.getElementById('selectConjPeriodo');
  selectConjPeriodo.innerHTML = '';
  cargarValoresEnCuadraditos();
}


/**
 * Cuando se crea un periodo a parte del principal
 */
function savePeriodExtra(button){
 
  const texto_reglas_titulo = document.getElementById('texto_regla_periodo');
  const errorMessage = document.getElementById("error_period_extra");
  const periodInput = document.getElementById('input_period');
  var t1 = document.getElementById('t1_extra');
  var descanso = document.getElementById('descanso_extra');
  const period = {
    duration_t1: t1.value,
    duration_rest: descanso.value
  };

  if (!period.duration_t1.trim() || !period.duration_rest.trim()) {
    errorMessage.style.display = "block";
    t1.style="border:1px solid red;"
    descanso.style="border:1px solid red;"
    errorMessage.innerHTML = "ERROR: Valor no rellenado";
  } else if (parseFloat(period.duration_t1) <= 0) {
    errorMessage.style.display = "block";
    t1.style="border:1px solid red;"
    errorMessage.innerHTML = "ERROR: Valor de estudio debe ser mayor que cero";
    t1.value = '';
  } else if (parseFloat(period.duration_rest) <= 0) {
    errorMessage.style.display = "block";
    descanso.style="border:1px solid red;"
    errorMessage.innerHTML = "ERROR: Valor de descanso debe ser mayor que cero";
    descanso.value = '';
  } else {
    if (!period.duration_rest.trim()) {
      period.duration_rest = "";
    }
    t1.style="border:1px solid #ced4da;"
    descanso.style="border:1px solid #ced4da;"
    var boton_reglas_titulo = document.getElementById('open_rule_creator_ther_create');
    boton_reglas_titulo.style.display="block";
    var esNuevo = false;
    if(periods.length == posicionadoEn) esNuevo = true;
    periods[posicionadoEn] = period;
    takeChangeWithoutResolving();
    errorMessage.style.display = "none";
    var periodoSelect = document.getElementById('selectConjPeriodo');
    periodoSelect.value = ""+periods.length;
    texto_reglas_titulo.innerHTML = "Regla para bloque";
    
    t1.value = '';
    descanso.value = '';

    value = JSON.stringify(periods);
    periodInput.value = value;
    addPeriodsIdToSeleccion(button);
    showCreatedPeriods(esNuevo);
    showmessage(esNuevo);
    agregarListeners();
    setSelectedButton(1);
  }
}

  
/**
 * Cuando se presiona un boton, izq o derecha para moverse entre periodos
 */
function cambiarPeriodo(direccion){
  var boolEsUltimo = true;
  var periodosPrincipal = document.getElementById('periodo_principal');
  var texto_periodo_nombre = document.getElementById('periodo_estancia');
  var periodosOtros = document.getElementById('periodo_secundario');
  var input_de_conjuntoperiodoregla = document.getElementById('selectConjPeriodo');
  var period_creation_button = document.getElementById('period_creation_btn');
  var boton_actualizar_periodo = document.getElementById('save_extra_period_ther_create');
 
  //reglas 
  var texto_reglas_titulo = document.getElementById('texto_regla_periodo');
  var boton_reglas_titulo = document.getElementById('open_rule_creator_ther_create');
  if(direccion == -1){
      posicionadoEn--;
      boolEsUltimo = false;
      texto_periodo_nombre.innerHTML="Editar bloque "+(posicionadoEn+1);
      // save_extra_period_ther_create = "GUARDAR CAMBIOS";
  }
  else{ //cuando sea 1 es que vamos al de crear uno nuevo
      boolEsUltimo = true;
      posicionadoEn = periods.length;
      texto_periodo_nombre.innerHTML="Crear nuevo bloque";
      texto_periodo_nombre.classList.add('animation-text');

      texto_periodo_nombre.addEventListener('animationend', () => {
        texto_periodo_nombre.classList.remove('animation-text');
      });
      texto_reglas_titulo.innerHTML = "Guarda los periodos para añadirle reglas";
      period_creation_button.style="display:none;";
      boton_reglas_titulo.style.display="none";
  }



  if(posicionadoEn == 0) { //es el periodo principal
    periodosPrincipal.style.display = "block";
    periodosOtros.style.display = "none";
    if(periods.length > 0){
      texto_reglas_titulo.innerHTML = "Regla para bloque";
      boton_reglas_titulo.style.display="block";
    }
    else{
      boton_reglas_titulo.style.display="none";
    }
    input_de_conjuntoperiodoregla.value = ""+(posicionadoEn+1);
  }
  else if(posicionadoEn > 0){
    periodosPrincipal.style = "display:none;";
    periodosOtros.style = "display:block;";

    if(boolEsUltimo == true) {
      // boton_actualizar_periodo.innerHTML = "AGREGAR NUEVO BLOQUE";
      texto_periodo_nombre.innerHTML="Crear nuevo bloque";
      period_creation_button.style="display:none;";
      texto_periodo_nombre.addEventListener('animationend', () => {
        texto_periodo_nombre.classList.remove('animation-text');
    });
      input_de_conjuntoperiodoregla.value = "none";
    }else { 
      period_creation_button.style="display:block;";
      // boton_actualizar_periodo.innerHTML = "GUARDAR CAMBIOS";
      texto_periodo_nombre.innerHTML="Editar bloque "+(posicionadoEn+1);
      
      input_de_conjuntoperiodoregla.value = ""+(posicionadoEn+1);
    }
  }
    mostrarReglasRespectoPeriodo(""+(posicionadoEn+1)); 
    cargarValoresEnCuadraditos();
}

function showmessage(isNew){
  const created_message_sucess = document.getElementById('created_alert_period');
  const edited_message_sucess = document.getElementById('edited_alert_period');
  if(isNew){
        created_message_sucess.style.display = "block";

        setTimeout(function() {
          created_message_sucess.style.display = "none";
        }, 3000); 
    
  }else{
    edited_message_sucess.style.display = "block";
      setTimeout(function() {
        edited_message_sucess.style.display = "none";
      }, 3000); 
  }
}

/*
 * SI es un periodo ya creado, carga los valores correspondientes a cada cuadradito
 */
function cargarValoresEnCuadraditos(){
  if(posicionadoEn < periods.length){
    if(posicionadoEn <= 0){
      posicionadoEn = 0;
      var t1 = document.getElementById('t1');
      var t2 = document.getElementById('t2');
      var descanso = document.getElementById('descanso');
      t1.value = periods[posicionadoEn].duration_t1;
      t2.value = periods[posicionadoEn].duration_t2;
      descanso.value = periods[posicionadoEn].duration_rest;

    }else{

      var t1 = document.getElementById('t1_extra');
      var descanso = document.getElementById('descanso_extra');

      t1.value = periods[posicionadoEn].duration_t1;
      descanso.value = periods[posicionadoEn].duration_rest;
    }
  }
  else{

    var t1 = document.getElementById('t1_extra');
    var descanso = document.getElementById('descanso_extra');

    t1.value = '';
    descanso.value = '';
  }
}

function irAPeriodo(periodo){
    posicionadoEn = (periodo+1);
    showButtonFromCreatePeriod();
    openPeriodCreation();
    setSelectedButton(0);
    cambiarPeriodo(-1);
}

function irACrearNuevo(){
  posicionadoEn = periods.length-1;
  cambiarPeriodo(+1);
}

function setSelectedButton(sum){
    var ul = document.getElementById("lista_periodo");
    var pos_en = (posicionadoEn-1) + sum;
    if (ul) {
        var buttons = ul.querySelectorAll("button"); 
        for(var i = 0; i<buttons.length; i++){
          if(i == pos_en)
           buttons[i].style="background-color: #E4E5FF;border-right:4px solid rgb(57, 93, 162);";
          else{
            buttons[i].style="background-color: #FFF;border-right: 3px solid #8f9af3;";
          }
        }
    }
}


function validarFormulario(){
  if (true) {
    // Mostrar el mensaje de confirmación
    var confirmacion = confirm("¿Estás seguro que quieres enviar el formulario?");
    return confirmacion; // Devuelve true o false dependiendo de la respuesta del usuario
  } else {
    return true; // Si no se cumple la condición, enviar el formulario sin confirmación
  }
}
function checkChanges(){
  var chg = false;
  for(var i = 0; i<changed.length; i++){
    chg = chg && changed[i];
  }
  
  return chg;
}
function agregarListeners() {
  // Obtener todos los elementos input del documento
  var inputs = document.querySelectorAll('input, select, textarea');

  // Recorrer todos los inputs y agregar un event listener para el cambio
  inputs.forEach(function(input) {
    input.addEventListener('change', function(event) {
      addChangeWithoutResolving();
    });
  });
}

function addChangeWithoutResolving(){
  changed[posicionadoEn] = false;
}

function takeChangeWithoutResolving(){
  changed[posicionadoEn] = true;
}

window.addEventListener('keydown', function (e) {
  if (e.key === 'Enter') {
    e.preventDefault();

    var currentPath = window.location.pathname;
    if(!ejecutarFuncion()) return false;

    if(currentPath.includes("therapy")){
        if(rulesOpen){
          
          if(getrules_page() == 3)
            guardarRegla(null);
          else
            rule_creation_step(getrules_page()+1)
        }else{
          if(posicionadoEn == 0)
            saveTemporalPeriod(this.document.getElementById("save_first_period_ther_create"))
          else
            savePeriodExtra(this.document.getElementById("save_extra_period_ther_create"))
        }
      }else if(currentPath.includes("session")){
        
          if(getrules_page() == 3)
            this.document.getElementById("session_form").submit();
          else
            rule_creation_step(getrules_page()+1)
      }
    }
}, false);

function setRuleOpenedContainer(open){
  rulesOpen = open;
}

var ultimaEjecucion = 0;
function ejecutarFuncion() {
  const tiempoActual = Date.now();
  if (tiempoActual - ultimaEjecucion >= 100) {
    ultimaEjecucion = tiempoActual;
    return true;
  } else {
    return false;
  }
}

/**
 * 
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

 */