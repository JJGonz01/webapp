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
            lastClickedButton.style = "background-color: #4361ee";    
    }else{
        booleanButtonClicked = true;
    }
    lastClickedButton = buttonClicked;
    buttonClicked.style = "background-color: #0224b2";
}

function setOpciones(){
    const opciones = document.querySelectorAll('input[type="checkbox"]');
    opciones.forEach(opcion => {
        opcion.addEventListener('change', () => manejarCambio(opcion));
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