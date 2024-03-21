var periods =  [];
var containersDiv = {};
var numerosPeriodos = 0;
var idContainers = 1;
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
    numerosPeriodos = jsonString.length-1;
}

function addBlock(){
    numerosPeriodos += 1;
    idContainers += 1;
    var mainDiv = document.getElementById("main-div");
    var newDiv = document.createElement("div");
    newDiv.className = 'row container-block';
    newDiv.id = "c"+numerosPeriodos;
    let id = "c"+numerosPeriodos;
    let blocknid = numerosPeriodos;
    let rulesid = numerosPeriodos; 

        var buttonMove = document.createElement("h3");
        buttonMove.className = "col-md-1";
        buttonMove.id = "button-move";
        //buttonMove.innerHTML = "<span>&#xf0b2;</span>";
        buttonMove.innerHTML = "#"+numerosPeriodos;
        
        newDiv.appendChild(buttonMove);

        var innerDiv = document.createElement("div");
        innerDiv.className = 'col-md-8 container-align-end';

            var positionInput = document.createElement("input");
            positionInput.style="display:none;";
            positionInput.id= id+"-pos";

            var innerDivInput1 = document.createElement("input");
            innerDivInput1.className="col-4 form-control";
            innerDivInput1.id= id+"-rest";
            innerDivInput1.placeholder="Descanso (Minutos)";

            var innerDivInput2 = document.createElement("input");
            innerDivInput2.className="col-4 form-control";
            innerDivInput2.id= id+"-t1";
            innerDivInput2.placeholder="Estudio (Min)";

            var spacerDiv = document.createElement("div");
            spacerDiv.className="col-4";

            
            innerDiv.appendChild(positionInput);
            innerDiv.appendChild(innerDivInput1);
            innerDiv.appendChild(innerDivInput2);
            innerDiv.appendChild(spacerDiv);

        newDiv.appendChild(innerDiv);

        var buttonDiv = document.createElement("div");
        buttonDiv.className = 'col-md-2 container-align-end';
        buttonDiv.id = "button-condition-"+blocknid;

            var buttonEdit = document.createElement("button");
            buttonEdit.id = "button-edit-"+rulesid;
            buttonEdit.type = "button";
            buttonEdit.innerHTML = "<span>&#xf044;</span>";
            buttonEdit.onclick = function() {
                showRulesInContainer(rulesid);
            };
            buttonEdit.className = "button-select-period";
            var buttonDelete = document.createElement("button");
            buttonDelete.id="button-delete-"+blocknid;
            buttonDelete.type = "button";
            buttonDelete.className = "button-delete-period";
            buttonDelete.innerHTML="<span>&#xf1f8;</span>";
            buttonDelete.onclick = function() {
                deleteBlock(id, blocknid);
            };

            buttonDiv.appendChild(buttonEdit);
            buttonDiv.appendChild(buttonDelete);

        newDiv.appendChild(buttonDiv);

    mainDiv.appendChild(newDiv);
    containersDiv[blocknid] = mainDiv;

    testlistenersin4();
}

function deleteBlock(idDiv, blockid){
    numerosPeriodos -= 1;
    if(numerosPeriodos == 0){
        delete containersDiv[blockid];
        deleteRulesOfBlock(blockid);
        document.getElementById("c"+(1)).remove();
        return;
    }

    for(var i = blockid; i<containersDiv.length; i++){
        var number = i;
        console.log(number);
            containersDiv[number].id = "c"+(number-1);
            let buttonedit = containersDiv[number].getElementById("button-edit-"+(number));
            let buttondelete = containersDiv[number].getElementById("button-delete-"+(number));
            buttonedit.onclick = function(){  
                showRulesInContainer(number-1);
            };

            buttondelete.onclick = function(){  
                deleteBlock("c"+(number-1), (number-1));
            };
    } 

    delete containersDiv[blockid];
    document.getElementById("c"+(numerosPeriodos+1)).remove();
    deleteRulesOfBlock(blockid);
    

}

function saveMainBlock(){
    var t1 = document.getElementById('mb_t1');
    var t2 = document.getElementById('mb_t2');
    var rest = document.getElementById('mb_rest');
    const period = {
        duration_t1: t1.value,
        duration_t2: t2.value,
        duration_rest: rest.value
    };

    return period;
}

function saveAllPeriods(){
    periods = [];
    var mainPeriod = saveMainBlock();
    periods[0] = mainPeriod;
    if(numerosPeriodos > 0){
        for(let i = 1; i<numerosPeriodos+1; i++){
            let id = "c"+i;
            let locali = i;
            let valt1 = document.getElementById(id+"-t1").value;
            let rest = document.getElementById(id+"-rest").value;
            var period = {
                duration_t1: valt1,
                duration_rest: rest
            };
            periods[locali] = period;
        }
    }
}

function saveAndSend(){
   if(checkIfInputsCompleted()){
   var form = document.getElementById("form_crear_therapy");
   var period_input = document.getElementById("input_period");
   var rule_input = document.getElementById("rule_period");
   saveAllPeriods();
   rule_input.value = JSON.stringify(saveRulesAndSend());
   period_input.value = JSON.stringify(periods);
   console.log(rule_input.value);
   form.submit();
   }
}

function checkIfInputsCompleted(){
    var containererror = document.getElementById("therapy-errors");
    let namevalue = document.getElementById("therapy-name").value;
    if(namevalue.trim() == ''){
        document.getElementById("therapy-name").style="border:1px solid var(--color-primary-red) !important;";
        document.getElementById("title-web").scrollIntoView({ behavior: 'smooth', block: 'start' });
        containererror.innerHTML = "ERROR: No has puesto un nombre al plan de estudio";
        containererror.style="display:block;"
        return false;
    }else{
        document.getElementById("therapy-name").style="border:1px solid grey !important;";
    }

    let t1 = document.getElementById("mb_t1");
    let t2 = document.getElementById("mb_t2");
    let rest = document.getElementById("mb_rest");

    if(t1.value.trim() == ''){
        t1.style="border:1px solid var(--color-primary-red) !important;";
        document.getElementById("title-web").scrollIntoView({ behavior: 'smooth', block: 'start' });
        containererror.innerHTML = "ERROR: Bloque principal, ESTUDIO no se ha configurado";
        containererror.style="display:block;"
        return false;  
    }else{
        t1.style="border:1px solid grey !important;";
    }


    if(rest.value.trim() == ''){
        rest.style="border:1px solid var(--color-primary-red) !important;";
        document.getElementById("title-web").scrollIntoView({ behavior: 'smooth', block: 'start' });
        containererror.innerHTML = "ERROR: Bloque principal, ESTUDIO no se ha configurado";
        containererror.style="display:block;"
        return false;  
    }else{
        rest.style="border:1px solid grey !important;";
    }

    if(t2.value.trim() == ''){
        t2.style="border:1px solid var(--color-primary-red) !important;";
        document.getElementById("title-web").scrollIntoView({ behavior: 'smooth', block: 'start' });
        containererror.innerHTML = "ERROR: Bloque principal, ESTUDIO no se ha configurado";
        containererror.style="display:block;"
        return false;  
    }else{
        t2.style="border:1px solid grey !important;";
    }

    var mt1, mrest;
    for(let i = 1; i<=numerosPeriodos;i++){
        mt1 = document.getElementById("c"+i+"-t1");
        mrest = document.getElementById("c"+i+"-rest");

        if(mrest.value.trim() == ''){
            mrest.style="border:1px solid var(--color-primary-red) !important;";
            document.getElementById("title-web").scrollIntoView({ behavior: 'smooth', block: 'start' });
            containererror.innerHTML = "ERROR: Bloque "+i+", DESCANSO no se ha configurado";
            containererror.style="display:block;"
            return false;  
        }else{
            mrest.style="border:1px solid grey !important;";
        }

        if(mt1.value.trim() == ''){
            mt1.style="border:1px solid var(--color-primary-red) !important;";
            document.getElementById("title-web").scrollIntoView({ behavior: 'smooth', block: 'start' });
            containererror.innerHTML = "ERROR: Bloque "+i+", ESTUDIO no se ha configurado";
            containererror.style="display:block;"
            return false;  
        }else{
            mt1.style="border:1px solid grey !important;";
        }
    
    }
    return true;
}
