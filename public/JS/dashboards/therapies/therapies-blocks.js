var periods =  [];
var changed = {};
var numerosPeriodos = 1;
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

    var mainDiv = document.getElementById("main-div");
    

    var newDiv = document.createElement("div");
    newDiv.className = 'row container-block';
    newDiv.id = "c"+numerosPeriodos;
    let id = "c"+numerosPeriodos;

        var buttonMove = document.createElement("button");
        buttonMove.className = "col-md-1";
        buttonMove.id = "button-move";
        buttonMove.innerHTML = "<span>&#xf0b2;</span>";
        
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
            innerDivInput2.placeholder="Estudio (Minutos)";

            var spacerDiv = document.createElement("div");
            spacerDiv.className="col-4";

            
            innerDiv.appendChild(positionInput);
            innerDiv.appendChild(innerDivInput1);
            innerDiv.appendChild(innerDivInput2);
            innerDiv.appendChild(spacerDiv);

        newDiv.appendChild(innerDiv);

        var buttonDiv = document.createElement("div");
        buttonDiv.className = 'col-md-2 container-align-end';

            var buttonEdit = document.createElement("button");
            buttonEdit.id = "button-edit";
            buttonEdit.innerHTML = "<span>&#xf304;</span>";

            var buttonDelete = document.createElement("button");
            buttonDelete.id="button-delete";
            buttonDelete.innerHTML="<span>&#xf1f8;</span>";
            buttonDelete.onclick = function() {
                deleteBlock(id);
            };

            buttonDiv.appendChild(buttonEdit);
            buttonDiv.appendChild(buttonDelete);

        newDiv.appendChild(buttonDiv);

    mainDiv.appendChild(newDiv);
}

function deleteBlock(idDiv){
    numerosPeriodos -= 1;
    document.getElementById(idDiv).remove();
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
    if(numerosPeriodos > 1){
        for(var i = 2; i<numerosPeriodos+1; i++){
            let id = "c"+numerosPeriodos;
            let valt1 = document.getElementById(id+"-t1").value;
            let rest = document.getElementById(id+"-rest").value;
            var period = {
                duration_t1: valt1,
                duration_rest: rest
            };

            periods[i-1] = period;
        }
    }
}

function saveAndSend(){
   var form = document.getElementById("form_crear_therapy");
   var period_input = document.getElementById("input_period");
   saveAllPeriods();
   period_input.value=  JSON.stringify(periods);
   console.log(period_input.value);
   form.submit();
}
 