window.onload = function(){
    selectOneRepeat();

    if(document.getElementById("date-start").content != "none");
        document.getElementById("fecha").value = document.getElementById("date-start").content;
}

function closePopup(){
    document.getElementById("popup").style="display:none;";
}

function openObjectivesPopup(){
    document.getElementById("popup-objectives").style="display:fixed;";
}

function closeObjectivesPopup(){
    document.getElementById("popup-objectives").style="display:none;";
}

function selectOneRepeat(){
    var checkboxes = document.getElementsByName("checkbox_repeat");

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function(){
            if(this.checked){
                checkboxes.forEach(function(cb){
                    if(cb !== checkbox){
                        cb.checked = false;
                    }
                });
            }
        });
        document.getElementById("checkbox-repeat").value=checkbox.value;
    });

    
}

function selectOption(selectedButton, buttonsName, inputId){
    var buttons = document.getElementsByName(buttonsName);
    buttons.forEach(button => {
            if(button !== selectedButton){
                button.className = "button-canceled";
            }
    });
    selectedButton.className = "button-selected";
    document.getElementById(inputId).value=selectedButton.value;
}

function closeTherapyPopup(){
    document.getElementById("popup-on").style="display:none;";
}

function openTherapyPopup(){
    document.getElementById("popup-on").style="display:fixed;";
}

function selectTherapy(id, tname){
    console.log(tname);
    document.getElementById("therapy-input").value=id;
    document.getElementById("therapy-name").value=tname;
    closeTherapyPopup();
}

function setCircle(option){
    if(option=="none")
        document.getElementById("blue-circle").className="circulo-negro text-col";
    else
        document.getElementById("blue-circle").className="circulo text-col";

}

function setHourPeriod(option){
    document.getElementById("reloj-hora").innerHTML = option;
}

function setTextPeriod(option){
    document.getElementById("reloj-periodo").innerHTML = option;
}

function openMileStonesPopUp(objectiveID){
    document.getElementById("popup-objectives-milestones").style="display:fixed;";
    var objectives = JSON.parse(document.getElementById("objectives").content);
    
    var stepsObj = JSON.parse(objectives[objectiveID-1]["steps"]);
    console.log(stepsObj);
    var table = document.getElementById("table-milestones");
    table.innerHTML ="";
    let mtr = document.createElement("tr");
    mtr.className = "top-index-container";
        let mtd1 = document.createElement("td");
        mtd1.innerHTML = "Nombre";

        let mtd2 = document.createElement("td");
        mtd2.innerHTML = "Descripción";

        let mtd3 = document.createElement("td");
        mtd3.innerHTML = "Seleccion";

        mtr.appendChild(mtd1);
        mtr.appendChild(mtd2);
        mtr.appendChild(mtd3);
        
        table.appendChild(mtr);

    stepsObj.forEach(step => {
        let tr = document.createElement("tr");
        let td1 = document.createElement("td");
        td1.innerHTML = step["name"];
        let td2 = document.createElement("td");
        td2.innerHTML = "TBD";
        let td3 = document.createElement("td");
            let btn = document.createElement("btn");
            btn.className = "button-objective-next-step";
            btn.onclick = function(){
                selectObjectiveAndMilestone(objectiveID, objectives[objectiveID-1]["name"], step["name"]);
            }
            btn.innerHTML = "SELECCIONAR";
        td3.appendChild(btn);


        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        table.appendChild(tr);
    });
    
}

function selectObjectiveAndMilestone(objid,objname, milestone){
    document.getElementById("objective-input").value = objid;
    document.getElementById("milestone-input").value = milestone;
    document.getElementById("objective-name").value = objname + ": "+ milestone;
    closeObjectiveMileStonePopup();
}
function closeMileStonePopup(){
    document.getElementById("popup-objectives-milestones").style="display:none;"
}

function closeObjectiveMileStonePopup(){
    document.getElementById("popup-objectives-milestones").style="display:none;"
    document.getElementById("popup-objectives").style="display:none;"
}

function removeObjectiveSelected(){
    document.getElementById("objective-input").value = "";
    document.getElementById("milestone-input").value = "";
    document.getElementById("objective-name").value = "";
}