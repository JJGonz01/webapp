var periods =  [];
var changed = {};
var numerosPeriodos = 0;
var posicionadoEn = 0;
var periodContainerOpen = false;

function editWindowTherapy(){

  const texto_reglas_titulo = document.getElementById('input_period');
  var jsonString = texto_reglas_titulo.value;
  
  var cadenaJSON = JSON.stringify(jsonString);
  console.log(cadenaJSON.substring(0, 5) + "  \"[\"[")
  if(cadenaJSON.substring(0, 5) == "\"[\\\"["){
    var cadenaSinBarras = cadenaJSON.replace(/\\/g, '');
    cadenaSinBarras = cadenaSinBarras.replace('/', '');
    var cadenaModificada = cadenaSinBarras.slice(3, -2);
    cadenaModificada = cadenaModificada.slice(0, -1);
    console.log(cadenaJSON);
    texto_reglas_titulo.value = cadenaModificada;
    
  }
  console.log(jsonString);
  posicionadoEn = 0;
  numerosPeriodos = jsonString.length-1;
  showCreatedPeriods(false);
  irAPeriodo(0);
  closePeriodCreation();
}

/**
 * Esto crea el periodo principal
 */
function saveTemporalPeriod(button) {
  const texto_reglas_titulo = document.getElementById('texto_regla_periodo');
  var boton_primer_periodo = document.getElementById('save_first_period_ther_create');
  // boton_primer_periodo.innerHTML = "GUARDAR CAMBIOS";
  const errorMessage = document.getElementById("error_period");
  const periodInput = document.getElementById('input_period');
  // button.innerHTML = "GUARDAR CAMBIOS";
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
    errorMessage.innerHTML = "ERROR: Valor no rellenado";
  } else if (parseFloat(period.duration_t1) <= 0) { 
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor estudio 1debe ser mayor que cero";
    t1.value = '';
  }else if (parseFloat(period.duration_t2) <= 0) {
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor estudio 2 debe ser mayor que cero";
    t2.value = '';}
  else if (parseFloat(period.duration_rest) <= 0) {
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor descanso debe ser mayor que cero";
    descanso.value = '';
  } else {
    
    var boton_reglas_titulo = document.getElementById('open_rule_creator_ther_create');
    boton_reglas_titulo.style.display="block";
    console.log(periods.length);
    var esNuevo = false;
    if(periods.length == posicionadoEn) esNuevo = true;
    periods[posicionadoEn] = period;
    errorMessage.style.display = "none";
    console.log(periods);
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
    errorMessage.innerHTML = "ERROR: Valor no rellenado";
  } else if (parseFloat(period.duration_t1) <= 0) {
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor debe ser mayor que cero >> t1";
    t1.value = '';
  } else if (parseFloat(period.duration_rest) <= 0) {
    errorMessage.style.display = "block";
    errorMessage.innerHTML = "ERROR: Valor debe ser mayor que cero >> descanso";
    descanso.value = '';
  } else {
    if (!period.duration_rest.trim()) {
      period.duration_rest = "";
    }
    var boton_reglas_titulo = document.getElementById('open_rule_creator_ther_create');
    boton_reglas_titulo.style.display="block";
    console.log(posicionadoEn);
    var esNuevo = false;
    if(periods.length == posicionadoEn) esNuevo = true;
    periods[posicionadoEn] = period;
    takeChangeWithoutResolving();
    errorMessage.style.display = "none";
    console.log(periods);
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
  console.log("POSICIONADO EN "+posicionadoEn);
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
  console.log("LEEENGTH "+periods[posicionadoEn] +"<>"+posicionadoEn)
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
    var ul = document.getElementById("lista_periodo");console.log("saddas"+posicionadoEn)
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
  console.log("eing"+posicionadoEn)
  changed[posicionadoEn] = false;
  console.log("hola" + checkChanges())
}

function takeChangeWithoutResolving(){
  changed[posicionadoEn] = true;
  console.log("adios" + checkChanges())

}
