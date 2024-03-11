window.onload = (event) => {
    console.log("page is fully loaded");
    showDurations();
};

function showDurations(){
    var arrayJSON = document.getElementById("array-values").value;
    var div = document.getElementById("main-div");
    var jsonvalues = JSON.parse(arrayJSON);

    document.getElementById("mb_t1").value = jsonvalues["0"]["duration_t1"];
    document.getElementById("mb_t2").value = jsonvalues["0"]["duration_t2"];
    document.getElementById("mb_rest").value = jsonvalues["0"]["duration_rest"];
    console.log(jsonvalues);
    if(Object.keys(jsonvalues).length > 1){
        for(let i = 1; i<Object.keys(jsonvalues).length; i++){
            console.log(jsonvalues[Object.keys(jsonvalues)[i]]);
            createBlockDiv(
                jsonvalues[Object.keys(jsonvalues)[i]]["duration_t1"],
                jsonvalues[Object.keys(jsonvalues)[i]]["duration_rest"]);
        }
    }

}

function createBlockDiv(t1, rest){
    var mainDiv = document.getElementById("main-div");
    

    var newDiv = document.createElement("div");
    newDiv.className = 'row container-block';
        var icon = document.createElement("div");
        icon.className = "col-md-1";
        icon.innerHTML = "<span>&#xf2f2;</span>";
        
        newDiv.appendChild(icon);

        var innerDiv = document.createElement("div");
        innerDiv.className = 'col-md-8 container-align-end';

            var positionInput = document.createElement("input");
            positionInput.style="display:none;";

            var innerDivInput1 = document.createElement("input");
            innerDivInput1.className="col-4 form-control";
            innerDivInput1.placeholder="Descanso (Minutos)";
            innerDivInput1.value=rest;
            innerDivInput1.disabled=true;
            innerDivInput1.readonly=true;

            var innerDivInput2 = document.createElement("input");
            innerDivInput2.className="col-4 form-control";
            innerDivInput2.placeholder="Estudio (Minutos)";
            innerDivInput2.value=t1;
            innerDivInput2.disabled=true;
            innerDivInput2.readonly=true;

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
            buttonEdit.id = "button-select-period";
            buttonEdit.innerHTML = "<span>&#xf304;</span>";

            buttonDiv.appendChild(buttonEdit);

        newDiv.appendChild(buttonDiv);

    mainDiv.appendChild(newDiv);
}