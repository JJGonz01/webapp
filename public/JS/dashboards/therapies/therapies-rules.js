
var currentBlock = 0;
var rules = [];
var mapaReglas = {};

function printMapaReglas(){
    console.log(mapaReglas);
}
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
    var errorstext = document.getElementById("rule-errors");
    let name = document.getElementById("condition-name").value;

    if(name.trim() == ''){
        errorstext.innerHTML = "ERROR: La regla debe tener un nombre";
        document.getElementById("condition-name").style="border: 1px solid var(--color-primary-red) !important";
        return false;
    }else{
        document.getElementById("condition-name").style="border: 1px solid grey !important";
    }

    let desc = document.getElementById("condition-description").value;
    let repetition = document.getElementById("repetition-condition").value;
    let comprobation = document.getElementById("input-moment-period").value;
    let block = currentBlock; 
    console.log(currentBlock);
    let periodo;

    let estd = document.getElementById("estudio-cond").value;
    let rest = document.getElementById("descanso-cond").value;

    if(estd == 1 && rest == 1)
    {
        periodo = "all";
    }
    else if(estd == 1 && rest == 0)
    {
        periodo = "study";
    }
    else if(estd == 0 && rest == 1)
    {
        periodo = "rest";
    }
    else{
        periodo = "all";
        errorstext.innerHTML = "ERROR: La regla debe tener un periodo de comprobación";
        document.getElementById("period-comprobation-container").style="border: 5px solid var(--color-primary-red) !important";
        return false;
    }
    document.getElementById("period-comprobation-container").style="border: 1px solid grey !important";


    var momentoPeriodo = document.getElementById("input-moment-period").value;
    var condiciones = [];

    if(document.getElementById("checkbox-condition-heart").checked){
            
            
        if(document.getElementById("ch-heart-value").checked){
            var condicionVal = {};
            condicionVal.sensor = "sensor_bpm";
            condicionVal.value = document.getElementById("heart-val-input").value;
            condiciones.push(condicionVal);
        }

        if(document.getElementById("ch-heart-tendency").checked){
            var condicionTen = {};
            condicionTen.sensor = "sensor_bpm";
            condicionTen.value = document.getElementById("heart-tend-input").value;
            condiciones.push(condicionTen);
        }
    }

    if(document.getElementById("checkbox-condition-movement").checked){
        if(document.getElementById("ch-move-value").checked){
            var condicionValMove = {};
            condicionValMove.sensor = "sensor_movement";
            condicionValMove.value = document.getElementById("move-val-input").value;
            condiciones.push(condicionValMove);
        }

        if(document.getElementById("ch-move-tendency").checked){
            var condicionTenMov = {};
            condicionTenMov.sensor = "sensor_movement";
            condicionTenMov.value = document.getElementById("move-tend-input").value;
            condiciones.push(condicionTenMov);
        }
    }

    var acciones = [];
    accionPrincipal = {};
    accionPrincipal.message = document.getElementById("message-primary").value;
    accionPrincipal.session = document.getElementById("accion-sesion-primary").value;
    accionPrincipal.extra_points = document.getElementById("input-points-primary").value;

    if(accionPrincipal.extra_points.trim() == '' || !(/^\d+$/.test(accionPrincipal.extra_points))){
        console.log( typeof accionPrincipal.extra_points);
        errorstext.innerHTML = "ERROR: La acción primaria debe sumar o restar puntos (aunque sea 0)";
        document.getElementById("input-points-primary").style="border: 5px solid var(--color-primary-red) !important";
        return false;
    }else{
        document.getElementById("input-points-primary").style="border: 1px solid grey !important";
    }

    accionPrincipal.extra_time = document.getElementById("input-time-primary").value;

    if(accionPrincipal.extra_time.trim() == '' || !(/^\d+$/.test(accionPrincipal.extra_time))){
        errorstext.innerHTML = "ERROR: La acción primaria debe sumar o restar minutos (aunque sea 0)";
        document.getElementById("input-time-primary").style="border: 5px solid var(--color-primary-red) !important";
        return false;
    }else{
        document.getElementById("input-time-primary").style="border: 1px solid grey !important";
    }

    acciones.push(accionPrincipal);


    if(document.getElementById("checkbox-accion-secundaria").checked){
        accionSecundaria = {};
        
        accionSecundaria.session = document.getElementById("accion-sesion-secondary").value;
        accionSecundaria.message = document.getElementById("message-secondary").value;
        let valsecpunt = document.getElementById("input-points-secondary").value;

        if(valsecpunt.trim() == '' || !(/^\d+$/.test(valsecpunt))){
            errorstext.innerHTML = "ERROR: La acción secundaria debe sumar o restar puntos (aunque sea 0)";
            document.getElementById("input-points-secondary").style="border: 5px solid var(--color-primary-red) !important";
            return false;
        }else{
            document.getElementById("input-points-secondary").style="border: 1px solid grey !important";
        }

        
        let valsectime =  document.getElementById("input-time-secondary").value; 

        if(valsectime.trim() == '' || !(/^\d+$/.test(valsectime))){
            accionSecundaria.extra_points = 0;
            errorstext.innerHTML = "ERROR: La acción secundaria debe sumar o restar minutos (aunque sea 0)";
            document.getElementById("input-time-secondary").style="border: 5px solid var(--color-primary-red) !important";
            return false;
        }else{
            document.getElementById("input-time-secondary").style="border: 1px solid grey !important";
        }

        accionSecundaria.extra_points = valsecpunt;
        accionSecundaria.extra_time = valsectime;
        acciones.push(accionSecundaria);
    }

    var ruleObject = {
        name: name,
        description: desc,
        block: block,
        period: periodo,
        comprobation: comprobation,
        repetition: repetition,
        conditions: JSON.stringify(condiciones),
        actions:JSON.stringify(acciones)
    };
    
    if(!mapaReglas[block]){
        console.log("Nuevo bloque de reglas");
        mapaReglas[block] = {};
    }
    mapaReglas[block][name] = ruleObject;
    console.log(mapaReglas);
    showRule(ruleObject);
    document.getElementById("popup").style="display:none;";
    checkStepsIn6();
}

function showRulesInContainer(blockNumber){
    document.getElementById("condition-div").innerHTML = "";
    if(blockNumber == 0)
        document.getElementById("conditions-title").innerHTML = "Reglas del bloque principal";
    else
        document.getElementById("conditions-title").innerHTML = "Reglas del bloque "+blockNumber;

    currentBlock = blockNumber;
    console.log(currentBlock);
    if(!mapaReglas[blockNumber]) return;
    for(var i = 0; i<Object.keys(mapaReglas[blockNumber]).length; i++){
        showRule(mapaReglas[blockNumber][Object.keys(mapaReglas[blockNumber])[i]]);
    }
}
function showRule(rule){

    var mainDiv = document.getElementById("condition-div");
    var newDiv = document.createElement("div");
    newDiv.className = 'row rule-block';
    newDiv.id = rule.name+"-div";

    let id = rule.name;
    newDiv.className = 'row rule-block';

        var span = document.createElement("span");
        span.innerHTML="&#xf21e;";
        span.className="col-md-1";

        var ruleName = document.createElement("p");
        ruleName.innerHTML= rule.name;
        ruleName.className= "col-md-6";

        var divbuttons = document.createElement("div");
        divbuttons.className="col-md-4 container-align-end";

        var buttonEdit = document.createElement("button");
        buttonEdit.type="button";
        buttonEdit.innerHTML="<span>&#xf304;</span>";
        buttonEdit.id="button-edit";
        buttonEdit.onclick = function() {
            deleteBlock(id);
        };

        var buttonRemove= document.createElement("button");
        buttonRemove.type="button";
        buttonRemove.id="button-delete";
        buttonRemove.innerHTML="<span>&#xf1f8;</span>";;

        divbuttons.appendChild(buttonEdit);
        divbuttons.appendChild(buttonRemove);
            
    newDiv.appendChild(span);
    newDiv.appendChild(ruleName);
    newDiv.appendChild(divbuttons);
    mainDiv.appendChild(newDiv);
}

function deleteRulesOfBlock(blockNumber){
    let length = numerosPeriodos;
    for(var i = blockNumber; i<=length;i++){
        let number = i;
        mapaReglas[i] = mapaReglas[number+1];
    }
    delete mapaReglas[length+1];
}

function saveRulesAndSend(){
    console.log(numerosPeriodos);
    for(let i = 0; i<=numerosPeriodos; i++){
        if(mapaReglas[i]){
            for(let j = 0; j<Object.keys(mapaReglas[i]).length;j++){
                console.log("jsjsj")
                let key = Object.keys(mapaReglas[i])[j];
                rules.push(JSON.stringify(mapaReglas[i][key]));
            }
        }
    }
    console.log(mapaReglas); 
    console.log(rules); 
    return rules;
}
