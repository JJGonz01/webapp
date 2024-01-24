const testNumber = 5;
var testIds = [];
var currentTestId = "0";
var jsonData
var lasttask = "3";
const testExplanationDictionary = {
    "0": "TAREA 1: Crea una terapia con nombre \"Terapia normal\" y que contenga dos bloques de estudio:"
    + " \n (a) Bloque sin reglas de Estudio: 2 min; Descanso: 2 min; Estudio: 2 min"
    + " \n (b) Otro bloque, sin reglas, con duraciones Descanso: 3 min; Estudio: 5 min; sin reglas",


    "1": "TAREA 2: Crea una terapia de nombre \"Terapia reglas\" "
    +"  \n con un bloque de Estudio: 2 minutos, Descanso: 1 minutos y Estudio:2 mininutos, donde haya una regla: "
    +" \n LA REGLA: \"Regla B1\" que cumpla: "
    +"  \n (a)	Se ejecute solo en periodos de estudio."
    +"  \n (b)	Momento del periodo: entero."
    +"  \n (c)	Compruebe si el movimiento es alto."
    +"  \n (d)	Acción en la reloj: Enviar un mensaje “Tranquilo” "
    +"  \n (e)	Acción en el sesión: Que no haga NADA "
    +"  \n (f)  Añadir una acción extra para cuando vuelva a ocurrir esta situación."
 	+"  \n (g)  En esta segunda acción, que envíe un mensaje “Calma vas bien” en acciones de reloj."
 	+"  \n (h)  En esta segunda acción, en acciones de sesión, que acabe el periodo.",

    
    "2": "TAREA 3: En la pestaña pacientes, crea un usuario que se llame \"Luis\" de apellidos \"Téllez\" "
    + " Una vez creado el paciente, entra en su pestaña y crea una sesión de estudio, tal que: "
    + " \n  (a) Su fecha de comienzo: la fecha en el día de hoy, y la hora en aproximadamente 1 minuto a la realización de esta prueba"
    + " \n (b) Con nuestra terapia \"Terapia reglas\" "
    + " \n (c) Sensibilidad del sensor BPM a 15"
    + "\n (d) Sensibilidad de movimiento: alto"
    + "\n (e) Que sume puntos cuando ambos sensores sean bajos."
    + "\n (e) Y la vista del reloj con todos los elementos añadidos",

    "3": "TAREA 4: Ejecuta la sesión en el reloj, y tras su compleción, examina sus resultados en la pestaña de pacientes:"+
    "\n (a) Creada la sesión, ejecuta la sesión en el reloj en sesiones completadas "+
    "\n (b) Una vez completada la sesión, entra en la pestaña pacientes "+
    "\n (c) Observa los resultados de la sesión ",

    "4": "TAREAS FINALIZADAS."
    +"\n (a) Conteste a las preguntas del siguiente formulario para que podamos"
    + " tener su opinión sobre la herramienta:\n https://forms.gle/naPYFrPVsJ8V2quQ8 \n"
   
}
window.onload = function() {
    
    testIds = [];
    currentTestId = "0";

    var windowpath = window.location.href;
    
    if(!localStorage["test_on"]){ //No se ha comenzado a hacer tests
        localStorage["testId"] = "0";
        localStorage["test_on"] = "true";
        localStorage["test_user"] = "true";
    }

    //if(localStorage["test_user"] != )
    
    if(localStorage["testId"] == "0")
    {
        document.getElementById('task_go_last').style = "display:none;";
        document.getElementById('task-end-btn').style="display:block;";
        document.getElementById('task-end-btn').innerHTML = "HE TERMINADO LA TAREA";
    }
    else if(localStorage["testId"] == "4"){
        document.getElementById('task-end-btn').style="display:none;";
    }else{
        document.getElementById('task-end-btn').style="display:block;";
        document.getElementById('task-end-btn').innerHTML = "HE TERMINADO LA TAREA";
    }

    if(window.location.pathname != "" && window.location.pathname != "/" && window.location.pathname != "/?"){
        setAsInNotStartedTask();
        var date = new Date;
        var clickedTime = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
        var timeDifference = getTimeDifference(clickedTime);
        sendJsonInfo(localStorage["testId"], clickedTime, timeDifference, windowpath ,"url", null, null);
    }
    else{
        localStorage["testId"] == "0";
        document.getElementById('task_go_last').style = "display:none;";
        document.getElementById('task-end-btn').style="display:block;";
        document.getElementById('task-end-btn').innerHTML = "HE TERMINADO LA TAREA";
    }

    for(var i = 0; i<=5; i++){
        testIds[i+""] = "false";
    }

    var buttonList = document.getElementsByTagName('button');
    
    for(var f = 0;f< buttonList.length;f++){
        addFunctionToOnClick(buttonList[f]);
    }

    if(!localStorage["infoOpen"]){
        localStorage["infoOpen"] = "true";
        showhidetextBool(true)
    }
    else{
        if(localStorage["infoOpen"] == "true"){
            showhidetextBool(true)
        }else{
            showhidetextBool(false)
        }
    }

    
    getAllInputs()
} 

 
function getAllInputs() {
    
    if(localStorage["teststart"]){
        const inputElements = document.querySelectorAll('input');
        inputElements.forEach(function(input) {
            if(input.id != "password"){
                setInputListener(input)
            }
        // outputDiv.textContent += input.id + ': ' + input.value + '\n';
        });
    }
}

function setInputListener(inputField){
    var inputValue = inputField.value;
        inputField.addEventListener("blur", function() {
            inputValue = inputField.value;
            var date = new Date;
            var clickedTime = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
            sendJsonInfo(localStorage["testId"],clickedTime,getTimeDifference(clickedTime),inputField.id+"|"+inputValue, "input", null, null)
        });

}
function setAsInTask(){
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    const bottonInfoText = document.getElementById('in-task-text');
    if(bottonInfoText != null){
        bottonInfoText.style.display="none";
        setTestInfoTab(); 
        taskInfoContainer.style.display = "none";
        inTaskContainer.style.display = "block";
    }
}

function setAsInNotStartedTask(){
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    taskInfoContainer.style.display = "block";
    setTestInfoTab();
    inTaskContainer.style.display = "none";
    
}

function setTestInfoTab(){
    var textToShow = testExplanationDictionary[localStorage["testId"]];
    const task_test = document.getElementById('task_test');
    textToShow = textToShow.split("\n");
    task_test.innerHTML = "";
    for(let i = 0; i<textToShow.length; i++){
        if(textToShow[i].includes("https")){
            var paragraph = document.createElement("a");
            paragraph.href = textToShow[i]
            paragraph.textContent = "Pulsa aquí para ir al formulario";
            task_test.appendChild(paragraph);
        }
        else{
            var paragraph = document.createElement("p");
            paragraph.textContent = textToShow[i];
            task_test.appendChild(paragraph);
        }
    }
}

function startTask(){
    var date = new Date;
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    const bottonInfoText = document.getElementById('in-task-text');
    const endButton = document.getElementById('task-end-btn')
    endButton.innerHTML = "HE TERMINADO LA TAREA";
    taskInfoContainer.style.display = "none";
    bottonInfoText.style.display = "none";
    inTaskContainer.style.display = "block";
    localStorage["test_on"] = "true";
    localStorage["infoOpen"] = "false";
    if(!localStorage["teststart"]){
        localStorage["teststart"] = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
    }
    setTestInfo(localStorage["testId"])

}

function setTestInfo(testID){
    
    const testText = document.getElementById('in-task-text')
    if(testText != null)
        testText.style.display="none";
}

function addFunctionToOnClick(button){
    if(button.id != "iniciar-sesion-button" && !button.id.includes("button_bloque_") ){
        var currentOnclick = button.getAttribute('onclick')
        var additionalFunction
        
            if (button.type != 'button'){
                additionalFunction = "event.preventDefault(); printClickedId(this, '" + currentOnclick + "', this.form);";
            }
            else
            {
                additionalFunction = "event.preventDefault(); printClickedId(this, '" + currentOnclick + "', null);";
            }
        
        var newOnclick = additionalFunction
        button.setAttribute('onclick', newOnclick); 
    } 
}

function showhidetext(){
    const testText = document.getElementById('no-task-container');
    const tesButtonShow = document.getElementById('task_start_button')
    const endButton = document.getElementById('task-end-btn')

    if(testText.style.display == "none"){
        testText.style.display ="block";
        localStorage["infoOpen"] = "true";
        tesButtonShow.innerHTML = "X"
        if(localStorage["testId"] == "4"){
            endButton.style="display:none";
            //endButton.innerHTML = "HACER DE NUEVO LAS TAREAS";
        }
        else{
            endButton.style="display:block";
            endButton.innerHTML = "HE TERMINADO LA TAREA";
        }
    }else{
        testText.style.display ="none";
        localStorage["infoOpen"] = "false";
        tesButtonShow.innerHTML = "X"
    }
}


function showhidetextBool(setOpen){
    const taskInfoContainer = document.getElementById('no-task-container');
    if(!setOpen){
        if(taskInfoContainer != null){
            taskInfoContainer.style.display ="none";
        }
    }else{
        if(taskInfoContainer != null){
            taskInfoContainer.style.display ="block";
        }
    }
}
function printClickedId(button, action, form){
       
        var date = new Date;
        var clickedTime = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
        var timeDifference;
        if(localStorage["teststart"]){
            timeDifference = getTimeDifference(clickedTime);
        }
        else{
            timeDifference = "0-0-0-0-0-0";
        }
        sendJsonInfo(localStorage["testId"], clickedTime, timeDifference, button.id,"button", action, form);
}

function endTask(){

    var intId = parseInt(localStorage["testId"])
    
    document.getElementById('task_go_last').style="display:hidden;";
    intId += 1
    var stringId = intId.toString()
    localStorage["testId"] = stringId
    const endButton = document.getElementById('task-end-btn')
    if(localStorage["testId"] == "4"){
        setTestInfo(stringId)
        downloadJson();
        //endButton.innerHTML = "HACER DE NUEVO LAS TAREAS";
        endButton.style = "display:none;"
        setTestInfoTab()
        return;
    }
    else if (localStorage["testId"] == "5"){
        localStorage["testId"] = 0;
        endButton.style = "display:block;"
        document.getElementById('task_go_last').style = "display:none;";
        endButton.innerHTML = "HE TERMINADO LA TAREA";
    }
    setTestInfo(stringId)
    const tesButtonShow = document.getElementById('task_start_button')
    tesButtonShow.innerHTML = "X"
    setAsInNotStartedTask()
}

function goToLastTask(){
    
    if(localStorage["testId"] == "0"){
        
        endButton.innerHTML = "HE TERMINADO LA TAREA";
        return
    }
    var intId = parseInt(localStorage["testId"]);
    intId -= 1;

    if(intId == 0){
        document.getElementById('task_go_last').style="display:none;";
    }
    var stringId = intId.toString()
    localStorage["testId"] = stringId
    const endButton = document.getElementById('task-end-btn')
    if(localStorage["testId"] == "3"){
        setTestInfo(stringId);
        endButton.innerHTML = "HE TERMINADO LA TAREA";
        setTestInfoTab();
        endButton.style = "display:block;"
        return;
    }
    endButton.style = "display:block;"
    setTestInfo(stringId)
    const tesButtonShow = document.getElementById('task_start_button')
    tesButtonShow.innerHTML = "X"
    setAsInNotStartedTask()
}

function sendJsonInfo(testId, dateTime, differenceTime, actionId, type, nextFunctionButton, form){
   
    var postData = {
        "taskId": testId,
        "type": type,
        "dateTime": dateTime,
        "differenceTime": differenceTime,
        "actionId": actionId
    };
    $.ajax({
        url: "/teststep",
        type: "GET",
        data: postData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if (nextFunctionButton != null) {
                try {
                    eval(nextFunctionButton);
                    if(form != null)
                        form.submit();
                } catch (error) {
                    console.error("Error executing nextFunctionButton: " + error);
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error("Error: " + actionId+ ";"+errorThrown +","+textStatus);
        }
    });
}

function downloadJson(){
    var url = window.location.origin +'/download';
    window.open(url, '_blank');
}
function getTimeDifference(dateClick){
    var arrayTimeOriginal = localStorage["teststart"].split("-");
    var arrayTimeClicked = dateClick.split("-");
    var arrayDiferences = [];
    arrayDiferences = ""+Math.abs(arrayTimeOriginal[0] - arrayTimeClicked[0]);
    for(var i = 1; i<6; i++){
        arrayDiferences += "-"+Math.abs(arrayTimeOriginal[i] - arrayTimeClicked[i]);
    }
    return arrayDiferences;
}


