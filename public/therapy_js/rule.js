
var optionsSensor = ["Sensor BPM", "Sensor Magnitud Movimiento"];
var optionPeriodo = ["Cualquiera", "Estudio", "Descanso"];//, "Relajacion"];
var momentoPeriodo = ["Entero", "Primer Tercio", "Segundo Tercio", "Ultimo Tercio",
"Primera Mitad", "Segunda Mitad"];
var optionSensorValues = {
    sensorBPM: ["Bajo", "Alto", "Aumentando", "Disminuyendo"],
    sensorMove: ["Bajo", "Alto", "Aumentando", "Disminuyendo"],
    sensorSound: ["Bajo", "Medio", "Alto"]
    };

var accionesPosiblesReloj = [
  "Preguntar \" ¿Estas estudiando? \"",
  "Preguntar \" ¿Sigues ahi? \"",
  "Avisar \" Animo \"",
  "Avisar \" Sigue asi \" ",
  "Avisar de juego \" Tienes x puntos \"", 
  "Avisar de juego \" A por mas estrellas \"",
  "Avisar de tranquilizarse \" Tranquilo \"",
  "Avisar de tranquilizarse \" Calma, vas bien \"", 
  "Avisar de tiempo que queda \" Quedan x minutos \"",
  "Suma puntos",
  "Nada"
]
var accionesPosiblesSesion = [
  "Nada",
  "Concluir periodo",
  "Concluir Sesion",
  "Añadir tiempo al periodo"
];

var reglasNuevas = [];
var mapaReglasPeriodo = {}; 
var periodoSelect;
var selectMomentoPeriodo;
var selectConjPeriodo;
var selectActionReloj;
var selectActionSesion;
var addExtraTimeInput;
var addPointsInput;
var rulesInput;
var inputConjuntoPeriodo;

var rules_page;

function rulesStart() {
  rules_page = 0;
  var periodosAnteriores = document.getElementById('periods_edit').value;
  mapaReglasPeriodo = {};
  var valorReglasAnteriores = document.getElementById('rules_edit').value;


  //si estoy en la ventana de editar
  if (valorReglasAnteriores != "null" && valorReglasAnteriores != "\"empty\"") {

    const reglasViejas = JSON.parse(valorReglasAnteriores);

    reglasViejas.forEach((regla) => {
      var parsedRegla = JSON.parse(regla);
      if (!mapaReglasPeriodo[parsedRegla.conjPeriodo]) {
        mapaReglasPeriodo[parsedRegla.conjPeriodo] = {};
      }
      mapaReglasPeriodo[parsedRegla.conjPeriodo][parsedRegla.nombreRegla] = parsedRegla;
      reglasNuevas.push(regla); // Agrega la cadena de texto en lugar de parsedRegla
      mostrarReglasRespectoPeriodo(0);
      
    });
  }

  if (periodosAnteriores != "null") {
    const periodos_aux = []; 

    const periodosAnterioresJSON = JSON.parse(periodosAnteriores);
    periodosAnterioresJSON.forEach((periodo) => {
      const objJSON = JSON.parse(periodo);
      var lenghtPeriodos = (Object.keys(objJSON).length);
      for(var i = 0; i<lenghtPeriodos; i++){
        periods.push(objJSON[i]);
        showCreatedPeriods(true); //lamada al scrip otro de periodos
      }
    })

    irAPeriodo(-1);
  }
  

  inputConjuntoPeriodo = document.getElementById('selectConjPeriodo');
  inputConjuntoPeriodo.value = "0";

  periodoSelect = document.getElementById('selectPeriodo');
  selectConjPeriodo  = document.getElementById('selectConjPeriodo');
  selectMomentoPeriodo = document.getElementById('selectMomentoPeriodo');
  selectActionReloj = document.getElementById('AccionSelect');
  selectActionSesion = document.getElementById('AccionSelectSesion');

  addExtraTimeInput = document.getElementById('extraTimeDiv');
  addPointsInput = document.getElementById('sumPuntDiv');
  rulesInput = document.getElementById('input_rules');
  addExtraTimeInput.style.display = "none"; //Aparecera cuando el tutor ponga "puntos sumar"
  addPointsInput.style.display = "none"; //Aparecera cuando el tutor ponga "anadir tiempo extra"
  numeroCondiciones = 0;


  var inputNuevasReglas = document.getElementById('newRuleSet');
  inputNuevasReglas.value = "false";
  showOptionsForCondition();
  //addEventToValuesSensor();
  actionToMake();
  addEventSiSeleccionoMasTiempoPoderPonerlo();
  addEventSiSeleccionoSumarPuntosPoderPonerlo();
  soloLanzarUnaVezListener();
  //addEventJuegoSumrMinutos();
  //cuando carhue la pagina que el checkbox sea false
  var checkbox = document.getElementById("soloLanzarUnaVez");
  checkbox.checked = false;

}

function setReglasEdit(){
  if(valorReglasAnteriores != "null" && valorReglasAnteriores != "\"empty\""){
    irAPeriodo(0);
  }
}


/**
 * Funcion que preprara los valores de las condiciones
 */
function showOptionsForCondition() {
    periodoSelect.innerHTML = '';
    selectMomentoPeriodo.innerHTML = '';

       //Para momento del periodo
     for (var i = 0; i < 6; i++) {
        var option = document.createElement('option');
        option.value = momentoPeriodo[i];
        option.text = momentoPeriodo[i];
        selectMomentoPeriodo.appendChild(option);
      }
 //Para valores del periodo: estudio, descanso y si es todos: estudio2
    for (var i = 0; i < 3; i++) {
        var option = document.createElement('option');
          option.value = optionPeriodo[i];
          option.text = optionPeriodo[i];
          periodoSelect.appendChild(option);   
      }
      /*if(selectConjPeriodo.value == "Todos"|| selectConjPeriodo.value == "1"){
        var option = document.createElement('option');
        option.value = "Estudio_2";
        option.text = "Estudio_2";
        periodoSelect.appendChild(option);
      }*/

  
  }
//ACCIONES (EN LA REGLA: THEN)
function actionToMake(){
  selectActionReloj.innerHTML = '';
  selectActionSesion.innerHTML = '';

    for (var i = 0; i < 11; i++) {
      var option = document.createElement('option');
      option.value = accionesPosiblesReloj[i];
      option.text = accionesPosiblesReloj[i];
      selectActionReloj.appendChild(option);
    }

    for (var i = 0; i < 4; i++) {
      var option = document.createElement('option');
      option.value = accionesPosiblesSesion[i];
      option.text = accionesPosiblesSesion[i];
      selectActionSesion.appendChild(option);
    }
}

function addEventSiSeleccionoMasTiempoPoderPonerlo(){
  selectActionSesion.addEventListener('change', function() {
    var selectedValue = selectActionSesion.value;
    if (selectedValue == "Añadir tiempo al periodo") {
      addExtraTimeInput.style.display = "block";
    }else{
      addExtraTimeInput.style.display = "none";
    } 

  });
}

function addEventSiSeleccionoSumarPuntosPoderPonerlo(){
  selectActionReloj.addEventListener('change', function() {
    var selectedValue = selectActionReloj.value;
     if(selectedValue == "Suma puntos"){
      addPointsInput.style.display = "block";
    }else{
      addPointsInput.style.display = "none";
    } 

  });
}

function addEventJuegoSumrMinutos(){
  var opcionesJuego = document.getElementById("modoJuego");
  var inputMinutos = document.getElementById("juegoTiempo");
     opcionesJuego.addEventListener('change', function() {
    var selectedValue = opcionesJuego.value;
    if (selectedValue == "JuegoMinutos") {
      inputMinutos.style.display = "block";
    } else {
      inputMinutos.style.display = "none";
      inputMinutos.value = 0;
    } 

  });
}

/**
 * HACER QUE LAS CONDICIONES APAREZCAN Y DESAPAREZCAN
 */
var contadorDIV = 1;

    function createDiv() {
      var container = document.getElementById("appear-dissapearDiv");

      var div = document.createElement("div");
      div.className = "elements-conditions-container";
      div.setAttribute("name", "condicionCrear");

      var labelSensor = document.createElement("label");
      labelSensor.textContent = "";

      var _sensorSelect = document.createElement("select");
      _sensorSelect.className = "";
      _sensorSelect.setAttribute("name", "sensorSelect");

      var labelValue = document.createElement("label");
      labelValue.textContent = "";

      var _selectValue = document.createElement("select");
      _selectValue.className = "";
      _selectValue.setAttribute("name", "sensorValue");

      var botonEliminar = document.createElement("button");
      botonEliminar.textContent = "X";
      botonEliminar.className = "delete-button";
      botonEliminar.onclick = function() {
        numeroCondiciones -= 1;
        removeDiv(botonEliminar, div);
      };


      addEventToValuesSensor(_sensorSelect, _selectValue);

      //Crea el div donde va a estar la condicion de valores de sensor
      container.appendChild(div);
      div.appendChild(labelSensor);
      div.appendChild(_sensorSelect);
      div.appendChild(labelValue);
      div.appendChild(_selectValue);
      div.appendChild(botonEliminar);

      contadorDIV++;
    }

    function removeDiv(boton, parentNode) {

      var div = boton.parentNode;
      var papaDiv = div.parentNode;

      papaDiv.removeChild(div);
    }


    function showConditionWellCreated(created){
      const created_message_sucess = document.getElementById('created_condition_alert_period');
      created_message_sucess.style.display = "block";
        setTimeout(function () {
          created_message_sucess.style.display = "none";
        }, 3000);
    }

    function addEventToValuesSensor(sensorSelect, sensorSelectValue){
      
      for (var i = 0; i < 2; i++) {
        var option = document.createElement('option');
        option.value = optionsSensor[i];
        option.text = optionsSensor[i];
        sensorSelect.appendChild(option);
      }

      //Poner valores predeterminados para condicion
      for (var value of optionSensorValues["sensorBPM"]) {
    
        var option = document.createElement('option');
        option.value = value;
        option.text = value;
        sensorSelectValue.appendChild(option);

      }
      //para cambiar las opciones del valor
      sensorSelect.addEventListener('change', function() {
    
        var selectedValue = sensorSelect.value;
        sensorSelectValue.innerHTML = '';
    
        if (selectedValue == "Sensor BPM") {
          for (var value of optionSensorValues["sensorBPM"]) {
    
            var option = document.createElement('option');
            option.value = value;
            option.text = value;
            sensorSelectValue.appendChild(option);
    
          }
             
        } else if (selectedValue == "Sensor Magnitud Movimiento") {
          for (var value of optionSensorValues["sensorMove"]) {
            var option = document.createElement('option');
            option.value = value;
            option.text = value;
            sensorSelectValue.appendChild(option);
          }
        } 
    
      });
    }

/**
 * CREAR MAS ACCIONES THEN (PROBAR)
 */
function setDisactive(){

  var buttonCrear = document.getElementById("buttonAccion");
  buttonCrear.style.display = "none";
}

function crearAccionFinalExtra(){
  setDisactive();
  var container = document.getElementById("condicionPapi");
  var div = document.createElement("div");
  var divReloj = document.createElement("div");
  var divSes = document.createElement("div"); 
  
  
  var divA = document.createElement("div");
  var divB = document.createElement("div");
  var divC = document.createElement("div");
  var divD = document.createElement("div");

  div.className = "elements-conditions-container";
  div.id = "extraAction";
  divReloj.className = "therapy-input-row";
  divSes.className = "therapy-input-row";

  divA.className = "therapy-check-row-text";
  divB.className = "therapy-check-row-text";
  divC.className = "therapy-check-row-text";
  divD.className = "therapy-check-row-text";

  div.setAttribute("name", "accionCrear");

  var labelSensor = document.createElement("label");
  labelSensor.textContent = "Acción en el reloj: ";

  var ac1 = document.createElement("select");
  ac1.className = "appearSelect";
  ac1.setAttribute("name", "ac1");

  var labelValue = document.createElement("label");
  labelValue.textContent = "Acción en la sesión";

  var ac2 = document.createElement("select");
  ac2.className = "appearSelect";
  ac2.setAttribute("name", "ac2");

  var labelPT = document.createElement("label");
  labelPT.textContent = "Puntos a añadir (estrellas):";
  labelPT.style.display = "none";
  labelPT.setAttribute("name", "labelPT");

  var ac3 = document.createElement("input");
  ac3.className = "appearSelect";
  ac3.type = "number";
  ac3.style.display = "none";
  ac3.setAttribute("name", "ac3");

  var labelET = document.createElement("label");
  labelET.textContent = "Tiempo extra:";
  labelET.style.display = "none";
  labelET.setAttribute("name", "labelET");

  var ac4 = document.createElement("input");
  ac4.className = "appearSelect";
  ac4.type = "number";
  ac4.style.display = "none";
  ac4.setAttribute("name", "ac4");

  var botonEliminar = document.createElement("button");
  botonEliminar.textContent = "Eliminar accion extra";
  botonEliminar.className = "delete-button";
  botonEliminar.onclick = function() {
    var buttonCrear = document.getElementById("buttonAccion");
    buttonCrear.style.display = "block";
    removeDiv(botonEliminar, div);
  };

  addOptionsToNewConclusion(ac1, ac2);


  ac1.addEventListener('change', function() {
    
    var selectedValue = ac1.value;

    if (selectedValue == "Suma puntos") {
      ac3.style.display = "block";
      labelPT.style.display = "block";
    } else {
      ac3.style.display = "none";
      labelPT.style.display = "none";
    } 
    
  });

  ac2.addEventListener('change', function() {
    
    var selectedValue = ac2.value;

    if (selectedValue == "Añadir tiempo al periodo") {
      ac4.style.display = "block";
      labelET.style.display = "block";
    } else {
      ac4.style.display = "none";
      labelET.style.display = "none";
    } 
    
  });
  container.appendChild(div);


  divA.appendChild(labelSensor);
  divA.appendChild(ac1);

  divB.appendChild(labelValue);
  divB.appendChild(ac2);

  divC.appendChild(labelPT);
  divC.appendChild(ac3);

  divD.appendChild(labelET);
  divD.appendChild(ac4);

  divReloj.appendChild(divA);
  divReloj.appendChild(divC);

  divSes.appendChild(divB);
  divSes.appendChild(divD);

  div.appendChild(divReloj);
  div.appendChild(divSes);
  div.appendChild(botonEliminar);

}

function addOptionsToNewConclusion(concluR, concluS){
      
    for (var i = 0; i < 11; i++) {
      var option = document.createElement('option');
      option.value = accionesPosiblesReloj[i];
      option.text = accionesPosiblesReloj[i];
      concluR.appendChild(option);
    }

    //Poner valores para condicion
    for (var i = 0; i < 4; i++) {
  
      var option = document.createElement('option');
      option.value = accionesPosiblesSesion[i];
      option.text = accionesPosiblesSesion[i];
      concluS.appendChild(option);

    }
}

/**
 * Para que solo se ejecute una vez, guarda en un input ese valor
 */
function soloLanzarUnaVezListener(){
  var checkboxDefaultNew = document.getElementById('soloLanzarUnaVez');
  var inputDf = document.getElementById('soloLanzarUnaVezReal');

  inputDf.value = "false";
  checkboxDefaultNew.addEventListener('change', function() {
    if (this.checked) {
      inputDf.value = "true";
    } else {
      inputDf.value = "false";
    }
  });
}

/**
 * PA GUARDAR REGLA COMO JSON (TODOO)
 */

function guardarRegla(nombreAnterior){

  var ruleNameInput = document.getElementById("rule_name");
  var nombreRegla = document.getElementById("rule_name").value;
  var conjPeriodo = document.getElementById("selectConjPeriodo").value;
  var periodo = document.getElementById("selectPeriodo").value;
  var momentoPeriodo = document.getElementById("selectMomentoPeriodo").value;
  var isEditing = document.getElementById("isEditing").value;

  //Ahora aqui es donde se comprueba si ESTA EDITANDO UNA REGLA-> SI LO ESTA LA ELIMINAMOS DEL ARRAY Y DEL HASHMAP
  if(isEditing != "0"){
    var indiceEliminar = -1;
    for (var i = 0; i < reglasNuevas.length; i++) { //tengo que ir por todas las reglas comprobando donde esta la regla anterior
        var regla = JSON.parse(reglasNuevas[i]);
        if (regla.nombreRegla === isEditing) {
          indiceEliminar = i;
          break;
        }
    }
    
    if (indiceEliminar != -1) {
      reglasNuevas.splice(indiceEliminar, 1);
      delete mapaReglasPeriodo[conjPeriodo][isEditing]; //lo elimino tambien del mapa!
    }
  }
  else{
    let isEditingint = parseInt(isEditing) + 1;
    isEditing.value = isEditingint.toString();
  }
 
  var divsCondicion = document.getElementsByName("condicionCrear");
  var condiciones = [];

  for (var i = 0; i < divsCondicion.length; i++) {
    var condicion = {};
    var sensorSelect = divsCondicion[i].querySelector("select[name='sensorSelect']");
    var selectValue = divsCondicion[i].querySelector("select[name='sensorValue']");
  
    condicion.sensor = sensorSelect.value;
    condicion.value = selectValue.value;
  
    var existe = condiciones.some(function(elemento) {
      return elemento.sensor === condicion.sensor && elemento.value === condicion.value;
    });
  
    if (!existe) { //Aqui compruebo si una condicion se repite y si se repite pues no la añado
      condiciones.push(condicion);
    }
  }

  var acciones = [];
  var accionReloj = document.getElementById("AccionSelect").value;
  var accionSesion = document.getElementById("AccionSelectSesion").value;
  var extraTimeAcc = document.getElementById("extraTime").value;
  var puntosAcc = document.getElementById("puntosSum").value;
  var acca = {};

  acca.reloj = accionReloj;
  acca.sesion = accionSesion;
  acca.tiempoExtra = extraTimeAcc;
  acca.puntos = puntosAcc;

  acciones.push(acca);


  var divsAccion = document.getElementsByName("accionCrear");

  for (var i = 0; i < divsAccion.length; i++) {
    var acca = {};
    var ac1 = divsAccion[i].querySelector("select[name='ac1']");
    var ac2 = divsAccion[i].querySelector("select[name='ac2']");
    var ac3 = divsAccion[i].querySelector("input[name='ac3']");
    var ac4 = divsAccion[i].querySelector("input[name='ac4']");
    acca.reloj = ac1.value;
    acca.sesion = ac2.value;
    acca.puntos = ac3.value;
    acca.tiempoExtra = ac4.value;
    acciones.push(acca);
  }


  var checkboxDefaultNew = document.getElementById('soloLanzarUnaVezReal');
  var lanzarSoloUnaVez =  checkboxDefaultNew.value;
  var reglaObj = {
    nombreRegla: nombreRegla,
    conjPeriodo: conjPeriodo,
    periodo: periodo,
    momentoPeriodo: momentoPeriodo,
    condiciones: JSON.stringify(condiciones),
    acciones:JSON.stringify(acciones),
    lanzarUnaVez: lanzarSoloUnaVez
  };

  //COMPROBACIONES DE CAMPOS PARA SABER SI ES CORRECTO IMPLEMENTAR DICHA REGLA
  //busco si ya hay una regla identica en el array (TODO FALTA QUE SI LAS CONDICIONES ESTAN SALTEADAS)
  var duplicado = reglasNuevas.find(function(elemento) {
    return JSON.stringify(elemento) === JSON.stringify(reglaObj);
  });

  
  if (duplicado) {
    document.getElementById("errorCreandoRegla").textContent = "ERROR: Regla ya existe";
    document.getElementById("errorCreandoRegla").style.display = "block";
    return;
  }

  if(accionReloj == "Nada" && accionSesion=="Nada"){
    document.getElementById("errorCreandoRegla").textContent = "ERROR: Define al menos una acción a realizar";
    document.getElementById("errorCreandoRegla").style.display = "block";
    return;
  }

  var duplicadoNombreRegla = reglasNuevas.some(function(elemento) {
    var regla = JSON.parse(elemento);
    return regla.nombreRegla === nombreRegla;
  });
  
  if (duplicadoNombreRegla || !(nombreRegla).trim()) {
    rule_creation_step(1);
    document.getElementById("errorCreandoRegla").textContent = "ERROR: El nombre de regla es invalido o ya existe";
    document.getElementById("rule_name").style="border: 1px solid red"
    document.getElementById("errorCreandoRegla").style.display = "block";
    return;
  }
  document.getElementById("rule_name").style="border: 1px solid grey"
  document.getElementById("errorCreandoRegla").style.display = "none";
  closeRuleCreator();
  limpiarInputs();

  if(conjPeriodo == "Todos"){
    var nombreClave_1 = reglaObj.nombreRegla; 
    var reglaAuxiliar = reglaObj;

    for(var i = 0; i<periods.length; i++){
      var cp = i+1; //hay que sumarle uno para que cuadren con los conjuntos periodos correspondientes!!!
      reglaAuxiliar.nombreRegla = nombreClave_1+"_"+cp;
      reglaAuxiliar.conjPeriodo = ""+cp;

      reglasNuevas.push(JSON.stringify(reglaAuxiliar));

      var reglaCopiaOtraVez = JSON.parse(JSON.stringify(reglaAuxiliar)); //porque si no hago esto, el mapa guarda la ultima q saca el for, hay que hacerla indepemndoente

      if (!mapaReglasPeriodo[cp]) {
        mapaReglasPeriodo[cp] = {};
      }
      
      if (!mapaReglasPeriodo[cp][reglaCopiaOtraVez.nombreRegla]) {
        mapaReglasPeriodo[cp][reglaCopiaOtraVez.nombreRegla] = reglaCopiaOtraVez;
      }
      
      rulesInput.value = JSON.stringify(reglasNuevas);
    }
    mostrarReglasRespectoPeriodo("Todos");
  }else{

    reglasNuevas.push(JSON.stringify(reglaObj));
    if (!mapaReglasPeriodo[conjPeriodo]) {
      mapaReglasPeriodo[conjPeriodo] = {};
    }
    
    if (!mapaReglasPeriodo[conjPeriodo][nombreRegla]) {
      mapaReglasPeriodo[conjPeriodo][nombreRegla] = reglaObj;
    }
    rulesInput.value = JSON.stringify(reglasNuevas);
    mostrarReglasRespectoPeriodo(conjPeriodo);
  }

}
/**
 * 
 * Crea contenedor con la infor de la regla
 */function mostrarReglasRespectoPeriodo(ConjuntoPeriodo) {
  
  var container_reglas = document.getElementById("lista_reglas_periodo"); //limpio las reglas del periodo anterior
  container_reglas.innerHTML = '';
  
  //cojo las reglas correspondientes al periodo
  const reglas = mapaReglasPeriodo[ConjuntoPeriodo];
  
  if(ConjuntoPeriodo == "Todos"){
      return;
  }

  if (reglas) {
    const reglasValues = Object.values(reglas);

    if (reglasValues.length > 0) { 
      reglasValues.forEach((reglaObj) => {
        var divTodo = document.createElement("div");

        var divBoton = document.createElement("div");
        var boton = document.createElement("button");
        var eliminar = document.createElement("button");


        boton.type="button";  
        eliminar.type="button";  
        eliminar.className = "session-show-button-delete";
        boton.className = "input-regla-select-button";
        divTodo.className = "reglas-show-container";
        divBoton.className ="input-borrar-regla-container-button";
        var label = document.createElement("label");
        label.textContent = "";
        label.className = "negrita-blanco";

        var labelEliminar = document.createElement("span");
        labelEliminar.textContent = "delete";
        labelEliminar.className = "material-symbols-outlined";

        var value = document.createElement("span");
        value.textContent = reglaObj["nombreRegla"]+""; 
        boton.appendChild(label);
        boton.appendChild(value);
        boton.id = "btn-"+reglaObj["nombreRegla"];
        boton.onclick = function() { 
                  edicionReglaRellenarValores(reglaObj["nombreRegla"]); //para que los inputs sean iguales q los de la regla
                  rule_creation_step(1);
                };
        eliminar.onclick = function(){
          deletRule(reglaObj["nombreRegla"]);
        }
        eliminar.appendChild(labelEliminar);

        divBoton.appendChild(boton);    
        divBoton.appendChild(eliminar);    
        //boton.appendChild(eliminar);
        divTodo.appendChild(divBoton);
        container_reglas.appendChild(divTodo);

    });
  }
  }
}
/**
 * Rellenara los inputs de la regla a editar, hay q pasarle el nombre
 */
function edicionReglaRellenarValores(reglaAEditar)
{
  var regla; 
  var ruleNameInput = document.getElementById("rule_name"); 
  var reglaEncontrada = reglasNuevas.find(function(reglaExistente){
    regla = JSON.parse(reglaExistente);
    return regla.nombreRegla === reglaAEditar;
  });
  openRuleCreator(reglaAEditar);
  if(reglaEncontrada){
    limpiarInputs();
    document.getElementById("rule_name").value = regla.nombreRegla;
    document.getElementById("selectConjPeriodo").value = regla.conjPeriodo;
    document.getElementById("selectPeriodo").value = regla.periodo;
    document.getElementById("selectMomentoPeriodo").value = regla.momentoPeriodo;
    contadorDIV = 0;
    ruleNameInput.value = regla.nombreRegla;
    var condiciones = JSON.parse(regla.condiciones);
    var divsCondicion = document.getElementsByName("condicionCrear");   
    var container = document.getElementById("appear-dissapearDiv");
    for (var i = 0; i < condiciones.length; i++) {
      createDiv();
    }

    for (var i = 0; i < condiciones.length; i++) {
      var condicion = condiciones[i];
        var child = container.children[i];
        var sensorSelect = child.querySelector("select[name='sensorSelect']");
        var selectValue = child.querySelector("select[name='sensorValue']");
        sensorSelect.value = condicion.sensor;
        selectValue.value = condicion.value;
    }

    var acciones = JSON.parse(regla.acciones);
    document.getElementById("AccionSelect").value = acciones[0].reloj;
    document.getElementById("AccionSelectSesion").value = acciones[0].sesion;
    if(acciones[0].reloj == "Suma puntos")
      addPointsInput.style.display = "block";
    else
      addPointsInput.style.display = "none";

    if(acciones[0].sesion == "Añadir tiempo al periodo")
      document.getElementById("extraTimeDiv").style.display = "block";
    else
      document.getElementById("extraTimeDiv").style.display = "none";


    document.getElementById("puntosSum").value = acciones[0].puntos;
    document.getElementById("extraTime").value = acciones[0].tiempoExtra;
   
    var divsAccion = document.getElementsByName("accionCrear");
    for (var i = 0; i < divsAccion.length; i++) {
        var acca = acciones[i + 1];
        var ac1 = divsAccion[i].querySelector("select[name='ac1']");
        var ac2 = divsAccion[i].querySelector("select[name='ac2']");
        var ac3 = divsAccion[i].querySelector("input[name='ac3']");
        var ac4 = divsAccion[i].querySelector("input[name='ac4']");rule_name
        ac1.value = acca.reloj;
        ac2.value = acca.sesion;
        ac3.value = acca.puntos;
        ac4.value = acca.tiempoExtra;
    }

    
    if(acciones.length > 1){
      crearAccionFinalExtra()
    }
    else{
      var buttonCrear = document.getElementById("buttonAccion");
      buttonCrear.style.display = "block";
      buttonCrear.style = "border: 2px solid red;"
    }
    document.getElementById('soloLanzarUnaVezReal').checked = (regla.lanzarUnaVez === "true");
  }
}

function limpiarInputs() {
  document.getElementById("rule_name").value = "";
  document.getElementById("selectPeriodo").value = "";
  document.getElementById("selectMomentoPeriodo").value = "";
  
  if(document.getElementById("extraAction") != null)
    document.getElementById("extraAction").parentNode.removeChild(document.getElementById("extraAction"));

  var divsCondicion = document.getElementById("appear-dissapearDiv");
  divsCondicion.innerHTML = "";
  while (divsCondicion.firstChild) {
    divElement.removeChild(divElement.firstChild);
  }

  document.getElementById("AccionSelect").value = ""; 
  document.getElementById("AccionSelectSesion").value = ""; 
  document.getElementById("puntosSum").value = ""; 
  document.getElementById("extraTime").value = ""; 
  var divsAccion = document.getElementsByName("accionCrear");
  for (var i = 0; i < divsAccion.length; i++) {
    var ac1 = divsAccion[i].querySelector("select[name='ac1']");
    var ac2 = divsAccion[i].querySelector("select[name='ac2']");
    var ac3 = divsAccion[i].querySelector("input[name='ac3']");
    var ac4 = divsAccion[i].querySelector("input[name='ac4']");
    ac1.value = ""; 
    ac2.value = ""; 
    ac3.value = ""; 
    ac4.value = ""; 
  }
  document.getElementById('soloLanzarUnaVezReal').checked = false;
}

function deletRule(nombre){

  var regla;
  var reglaEliminarid = reglasNuevas.find(function(reglaExistente){
    regla = JSON.parse(reglaExistente);
    return regla.nombreRegla === nombre;
  });
  if (reglaEliminarid != -1) { //borrarla del array y del mapa para que no se muestre en la web
    reglasNuevas.splice(reglaEliminarid, 1);

    rulesInput.value = JSON.stringify(reglasNuevas);
    delete mapaReglasPeriodo[regla.conjPeriodo][nombre]; 
  }
  
  mostrarReglasRespectoPeriodo(regla.conjPeriodo)
}

function openRuleCreator(isNew){
  setRuleOpenedContainer(true)
  rule_creation_step(1);

  var btn = document.getElementById("open_rule_creator_ther_create");
  btn.style.display = "none";
  if(isNew == 0) {
    document.getElementById("isEditing").value = "0";
    limpiarInputs();
  }
  else{
    document.getElementById("isEditing").value = isNew;
  }
  showOptionsForCondition();
  //addEventToValuesSensor();
  actionToMake()
  var rc = document.getElementById("contenedor_creador_reglas");
  rc.style.display = "flex";
}

function closeRuleCreator(){  
  console.log("sghdiagskgaskhdghsagjdagsjgdagdgjsghadg")
  setRuleOpenedContainer(false)
  var btn = document.getElementById("open_rule_creator_ther_create");
  if(btn != null) btn.style.display = "block";
  var rc = document.getElementById("contenedor_creador_reglas");
  rc.style.display = "none";
  if(window.location.pathname.includes("session")){
    console.log("hosmkaldh")
    permitir_salida(false)
  }
}

function rule_creation_step(goto){
  var step_one = document.getElementById("rule_creation_step_one");
  var step_two = document.getElementById("rule_creation_step_two");
  var step_three = document.getElementById("rule_creation_step_three");

  rules_page = goto;
  var button_one = document.getElementById("menu_reglas_btn_one");
  var button_two = document.getElementById("menu_reglas_btn_two");
  var button_three = document.getElementById("menu_reglas_btn_three");

  var listabtn = [button_one, button_two, button_three];
  var listastep = [step_one, step_two, step_three];

  for(var i = 0; i<3; i++){
    if(listabtn[i]!=null){
        if(i == (goto-1)){
          listabtn[i].style = "background-color: rgb(33, 145, 215); color:white";
          listastep[i].style.display = "block";
        }else if(i>(goto-1)){
          listabtn[i].style = "background-color: rgb(237, 235, 235); color:black";
          listastep[i].style.display = "none";
        }else{
          listabtn[i].style = "background-color: rgb(237, 235, 235); color:rgb(33, 145, 215)";
          listastep[i].style.display = "none";
        }
    }
  }

}

function openSessionCreator(isNew){
  var rc = document.getElementById("contenedor_creador_reglas");
  rc.style.display = "flex";
}

function getrules_page(){
  return rules_page;
}

function setrulepage(n){
  rules_page = n;
}
