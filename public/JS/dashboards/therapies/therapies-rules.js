
var currentBlock = 1;

function setEventListenerCheckbox(divId, checkboxId){
    var checkbox = document.getElementById(checkboxId);
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            selectCondition(divId);
        } else {
            deselectCondition(divId);
        }
    });

    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var ids = [];
    for(var i = 1; i < checkboxes.length; i++) {
        if(checkboxes[i].id.includes("ch-") || checkboxes[i].id == "checkbox-accion-secundaria"){
            var checkboxid = checkboxes[i].id;
            checkboxes[i].addEventListener('change', function(index) {
                return function() {
                    if (this.checked) {
                        selectCheckOptions(checkboxes[index].id);
                    } else {
                        deselectCheckOptions(checkboxes[index].id);
                    }
                };
            }(i));
        }
    }
}
function selectCondition(divId) {
    let div = document.getElementById(divId);
    div.className = "row rule-block container-selected";
    var checkboxes = div.querySelectorAll('input[type="checkbox"]');

    for(var i = 1; i < checkboxes.length; i++) {
        checkboxes[i].disabled = false;
        if(checkboxes[i].checked)
            selectCheckOptions(checkboxes[i].id);
        else
            deselectCheckOptions(checkboxes[i].id);
    }
}
function deselectCondition(divId) {
    let div = document.getElementById(divId);
    div.className = "row rule-block container-deselected";
    var checkboxes = div.querySelectorAll('input[type="checkbox"]');

    for(var i = 1; i < checkboxes.length; i++) {
        checkboxes[i].disabled = true;
        deselectCheckOptions(checkboxes[i].id);
    }

}
function deselectCheckOptions(checkid){
    let div = document.getElementById(checkid+"-div");
    var inputs = div.getElementsByTagName('input');
    var selects = div.getElementsByTagName('select');
    var buttons = div.getElementsByTagName('button');

    buttons[0].className = "button-selected";
    for(var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
        buttons[i].className = "button-disabled";
    }

    
    for(var i = 0; i < inputs.length; i++) {
        if(!inputs[i].id.includes("checkbox")) {
            inputs[i].disabled = true;
        }
    }

    for(var i = 0; i < selects.length; i++) {
        selects[i].disabled = true;
    }
}
function selectCheckOptions(checkid){
    let div = document.getElementById(checkid+"-div");
    var inputs = div.getElementsByTagName('input');
    var selects = div.getElementsByTagName('select');
    var buttons = div.getElementsByTagName('button');

    
    for(var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = false;
        if(buttons[i].value == 1)
            buttons[i].className = "button-selected";
        else
            buttons[i].className = "button-canceled";
    }

    
    for(var i = 0; i < inputs.length; i++) {
        if(!inputs[i].id.includes("checkbox")) {
            inputs[i].disabled = false;
        }
    }

    for(var i = 0; i < selects.length; i++) {
        selects[i].disabled = false;
    }
}

function saveNewRule(){

    var name = document.getElementById("rule-name").value;
    var desc = document.getElementById("rule-description").value;
    var repetition = document.getElementById("repetition-condition").value;

    var block = currentBlock; 
    var periodo;

    let estd = document.getElementById("estudio-cond").value;
    let rest = document.getElementById("descanso-cond").value;

    if(estd == 1 && rest == 1)
    {
        periodo = "Cualquiera";
    }
    else if(estd == 1 && rest == 0)
    {
        periodo = "Estudio";
    }
    else if(estd == 0 && rest == 1)
    {
        periodo = "Descanso";
    }
    else{
        periodo = "Cualquiera";
        console.log("ERROR NO HAY NINGUNO SELECCIONADO");
        //return; TODO
    }

    var momentoPeriodo = document.getElementById("input-moment-period").value;
    var condiciones = [];

    if(document.getElementById("checkbox-condition-heart").checked){
            
            
        if(document.getElementById("ch-heart-value").checked){
            var condicionVal = {};
            condicionVal.sensor = "Sensor BPM";
            condicionVal.value = document.getElementById("heart-val-input").value;
            condiciones.push(condicionVal);
        }

        if(document.getElementById("ch-heart-tendency").checked){
            var condicionTen = {};
            condicionTen.sensor = "Sensor BPM";
            condicionTen.value = document.getElementById("heart-tend-input").value;
            condiciones.push(condicionTen);
        }
    }

    if(document.getElementById("checkbox-condition-movement").checked){
        if(document.getElementById("ch-move-value").checked){
            var condicionValMove = {};
            condicionValMove.sensor = "Sensor Magnitud Movimiento";
            condicionValMove.value = document.getElementById("move-val-input").value;
            condiciones.push(condicionValMove);
        }

        if(document.getElementById("ch-move-tendency").checked){
            var condicionTenMov = {};
            condicionTenMov.sensor = "Sensor Magnitud Movimiento";
            condicionTenMov.value = document.getElementById("move-tend-input").value;
            condiciones.push(condicionTenMov);
        }
    }

    var acciones = [];

    accionPrincipal = {};
    accionPrincipal.accionReloj = document.getElementById("message-primary").value;
    accionPrincipal.accionSesion = document.getElementById("accion-sesion-primary").value;
    accionPrincipal.puntosExtra = document.getElementById("input-points-primary").value;
    accionPrincipal.tiempoExtra = document.getElementById("input-time-primary").value;
    acciones.push(accionPrincipal);
    if(document.getElementById("input-time-primary").checked){
        accionSecundaria = {};
        accionSecundaria.accionReloj = document.getElementById("message-secondary").value;
        accionSecundaria.accionSesion = document.getElementById("accion-sesion-secondary").value;
        accionSecundaria.puntosExtra = document.getElementById("input-points-secondary").value;
        accionSecundaria.tiempoExtra = document.getElementById("input-time-secondary").value; 
        
        acciones.push(accionSecundaria);
    }

    var reglaObj = {
        name: name,
        description: name,
        block: block,
        period: periodo,
        repetition: repetition,
        condicions: JSON.stringify(condiciones),
        accions:JSON.stringify(acciones)
    };
    console.log(reglaObj);
}