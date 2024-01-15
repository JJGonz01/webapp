/*window.addEventListener('DOMContentLoaded', function() {
    const therapyContainer = document.querySelector('.therapy-container');
    booleanButtonClicked = false;
    therapyContainer.addEventListener('wheel', function(event) {
        event.preventDefault();
        therapyContainer.scrollBy(0, event.deltaY);
    });
});*/
var lastClickedButton;
var booleanButtonClicked;
var idSelection;

function selectTerapia(id){
   
    var inputTerapiaId=document.getElementById("terapia_seleccion");
    inputTerapiaId.value = id;
    var buttonstr = "button_"+id;
    setButtonAsSelected(buttonstr); 
    //console.log("hola"+button_id)
}

function setButtonAsSelected(buttonid){
    var div = document.getElementsByName('ther_select');
    var buttonClicked = document.getElementById(buttonid);
    if(booleanButtonClicked){
            lastClickedButton.style = "background-color: #4361ee; border:0;";    
    }else{
        booleanButtonClicked = true;
    }
    lastClickedButton = buttonClicked;
    buttonClicked.style = "background-color: #0224b2; border: 2px solid black;";
}

function setOpciones(){
    rules_page = 1;
    const opciones = document.querySelectorAll('input[type="checkbox"]');
    opciones.forEach(opcion => {
        opcion.addEventListener('change', () => manejarCambio(opcion));
      });
}

function listenerFecha(){
    document.getElementById('fechaHora').addEventListener('input', function(event) {
        var selectedDateTime = event.target.value;
        console.log('Fecha y hora seleccionadas:', selectedDateTime);
        // Puedes realizar acciones adicionales aquí con la fecha y hora seleccionadas
      });
}
    
function manejarCambio(opcion){
    var elem;
    if(opcion.value == "Barra"){
        elem = document.getElementById("progreso");
    }else if(opcion.value == "Reloj"){
        elem = document.getElementById("minutos");
    }else{
        elem = document.getElementById("periodo");
    }

    if (opcion.checked) {
        elem.style.display = "block";
      } else {
        elem.style.display = "none";
      }
}


function getEditClockOptions(){
    selectTerapia(document.getElementById("terapia_seleccion").value);
    var input = document.getElementById("valoresReloj");
    setOptionsInEdit();
    const opciones = document.querySelectorAll('input[type="checkbox"]');
    var elem;
    var string;
    opciones.forEach(opcion => {
        if(opcion.value == "Barra"){
            elem = document.getElementById("progreso");
            string = "barra";
        }else if(opcion.value == "Reloj"){
            elem = document.getElementById("minutos");
            string = "minuto";
        }else{
            elem = document.getElementById("periodo");            
            string = "periodo";
        }
    
    if (JSON.parse(input.value)[string]) {
        elem.style.display = "block";
      } else {
        elem.style.display = "none";
        opcion.checked = false;
      }
    });
}


function setOptionsInEdit(){
    var input = document.getElementById("modoJuegoInput");
    var selectedInput = document.getElementById("sensibilidadInput");


    var selinput = document.getElementById("selectModoJuego");
    var movementInput = document.getElementById("movementInput");
    console.log(selectedInput.value);
    selinput.value = input.value;

    if(selectedInput.value == "0.4"){
        movementInput.value = "Muy Bajo"
    }else if(selectedInput.value == "0.6"){
        movementInput.value = "Bajo"

    }else if(selectedInput.value == "0.9"){
        movementInput.value = "Medio"

    }else if(selectedInput.value == "1.5"){
        movementInput.value = "Alto"

    }else {
        movementInput.value = "Muy Alto"
    }


    selinput.value = input.value;
}


function check(){
    var errors = document.getElementById("errors_display")
    var currentDate = new Date();
    var dateInput = new Date(document.getElementById("fechaHora").value);
    console.log(dateInput.value)

    if(dateInput < currentDate ){
        document.getElementById("fechaHora").style = "border:1px solid red;";
        errors.style.display = "block";
        rule_creation_step(1);
        errors.innerHTML = "ERROR: La fecha debe ser en el futuro";
        return;
    }

    if(isNaN(dateInput)){
        document.getElementById("fechaHora").style = "border:1px solid red;";
        errors.style.display = "block";
        rule_creation_step(1);
        errors.innerHTML = "ERROR: Selecciona una fecha";
        return;
    }

    document.getElementById("fechaHora").style = "border:1px solid grey;"

    var therayId = document.getElementById("terapia_seleccion").value
    if(!therayId){
        document.getElementById("terapias_botones").style="border: 2px solid red;"
        errors.style.display = "block";
        rule_creation_step(1);
        errors.innerHTML = "ERROR: Se necesita seleccionar una terapia";
        return;
    }
    document.getElementById("terapias_botones").style = "border:0;"

    var porcen = document.getElementById("porcentaje").value
    if(!porcen || porcen < 0){
        document.getElementById("porcentaje").style="border: 2px solid red;"
        errors.style.display = "block";
        rule_creation_step(2);
        errors.innerHTML = "ERROR: El valor de la sensibilidad debe ser un número positivo";
        return;
    }
    document.getElementById("porcentaje").style="border: 1px solid grey;"

    document.getElementById("session_form").submit();
}