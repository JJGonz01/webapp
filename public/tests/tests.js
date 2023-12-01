const testNumber = 5;
var testIds = [];
var currentTestId = "0";
var jsonData
var lasttask = "3";
const testExplanationDictionary = {
    "0": "TAREA 1: Crea una terapia con nombre \"Terapia normal\" y que contenga dos bloques de estudio:"
    + " \n (a) Bloque sin reglas de Estudio: 5 min; Descanso: 3 min; Estudio: 5 min"
    + " \n (b) Otro bloque, sin reglas, con duraciones Descanso: 3 min; Estudio: 5 min; sin reglas",


    "1": "TAREA 2: Crea una terapia de nombre \"Terapia reglas\" "
    +"  \n con un bloque de Estudio: 5 minutos, Descanso: 3 minutos y Estudio:10 mininutos, donde haya una regla: "
    +" \n LA REGLA: \"Regla B1\" que cumpla: "
    +"  \n (a)	Se ejecute en estudios y descansos."
    +"  \n (b)	Momento del periodo: entero."
    +"  \n (c)	Compruebe si el movimiento es bajo."
    +"  \n (d)	Acción en la reloj: Enviar un mensaje “¿Estás estudiando?” "
    +"  \n (e)	Acción en el sesión: Que no haga NADA "
    +"  \n (f)  Añadir una acción extra para cuando vuelva a ocurrir esta situación."
 	+"  \n (g)  En esta segunda acción, que envíe un mensaje “Calma vas bien” en acciones de reloj."
 	+"  \n (h)  En esta segunda acción, en acciones de sesión, que acabe el periodo.",

    
    "2": "TAREA 3: En la pestaña pacientes, crea un usuario que se llame \"Luis\" de apellidos \"Téllez\" "
    +" Una vez en el paciente, crea una sesión de estudio, dentro del paciente \"Luis Tellez\", tal que: "
    +" \n  (a) Su fecha de comienzo: la fecha en la que se vaya a comprobar en el día de la prueba"
    +" \n (b) Con nuestra terapia \"Terapia reglas\" "
    +" \n (c) Sensibilidad del sensor BPM a 15"
    + "\n (d) Sensibilidad de movimiento: alto "
    + "\n (e) Que sume puntos cuando ambos sensores sean bajos."
   
}
window.onload = function() {
    
    testIds = [];
    currentTestId = "0";

    var windowpath = window.location.href;
    startTask();
    var date = new Date;
    var clickedTime = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
    var timeDifference = getTimeDifference(clickedTime);

    if(!localStorage["test_on"]){ 
        localStorage["testId"] = "0";
        console.log("pth: "+window.location.pathname)
        if(window.location.pathname != "" && window.location.pathname != "/" && window.location.pathname != "/home"  && window.location.pathname != "home")
            setAsInNotStartedTask();
        else{
            sendJsonInfo(localStorage["testId"], clickedTime, timeDifference, windowpath ,"url", null, null);
        }
        
    }
    else if(localStorage["test_on"] == "false")
    {
        if(localStorage["testId"] && localStorage["testId"] != lasttask && window.location.pathname != "" && window.location.pathname != "/" && window.location.pathname != "/home"  && window.location.pathname != "home")
        {
            setAsInNotStartedTask();
            sendJsonInfo(localStorage["testId"], clickedTime, timeDifference, windowpath ,"url", null, null);
        }

        else 
            endAllTasks();
            return;
    }
    else{
        
        if(!localStorage["testId"]){
            setTestInfo("0");
            localStorage["testId"] = "0";
        }
        else{
           
            if(localStorage["testId"] == lasttask){
                return; 
            }
            setTestInfo(localStorage["testId"]);
        }
        setAsInTask(); 

        sendJsonInfo(localStorage["testId"], clickedTime, timeDifference, windowpath ,"url", null, null);

    }
    for(var i = 0; i<=5; i++){
        testIds[i+""] = "false";
    }
    //setTestInfo(currentTestId);
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
                console.log(input.id);
            }
        // outputDiv.textContent += input.id + ': ' + input.value + '\n';
        });
    }
}

function setInputListener(inputField){
    var inputValue = inputField.value;
        inputField.addEventListener("blur", function() {
            inputValue = inputField.value;
            console.log(inputValue);
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

function startTask(){
    var date = new Date;
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    const bottonInfoText = document.getElementById('in-task-text');
    taskInfoContainer.style.display = "none";
    bottonInfoText.style.display = "none";

    
    inTaskContainer.style.display = "block";
    localStorage["test_on"] = "true";
    localStorage["teststart"] = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
    setTestInfo(localStorage["testId"])

}

function setTestInfo(testID){
    console.log("aqui es donde falla? "+testID)
    const testText = document.getElementById('in-task-text')
    if(testText != null)
        testText.style.display="none";
}

function addFunctionToOnClick(button){
    if(button.id != "task_start_button" && button.id != "iniciar-sesion-button" && !button.id.includes("button_bloque_") ){
        var currentOnclick = button.getAttribute('onclick')
        var additionalFunction
        
            if (button.type != 'button'){
                additionalFunction = "event.preventDefault(); printClickedId(this, '" + currentOnclick + "', this.form);";
            }
            else
            {
                additionalFunction = "event.preventDefault(); printClickedId(this, '" + currentOnclick + "', null);";
            }
        
        console.log(additionalFunction + "--"+button.id)
        var newOnclick = additionalFunction
        button.setAttribute('onclick', newOnclick); 
    } 
}

function showhidetext(){
    const testText = document.getElementById('no-task-container');
    const tesButtonShow = document.getElementById('task_start_button')
    if(testText.style.display == "none"){
        testText.style.display ="block";
        tesButtonShow.innerHTML = "CONTINUAR TAREA"
        if(localStorage["testId"] == "REINICIO"){
            tesButtonShow.innerHTML = "HACER DE NUEVO";
        }
        localStorage["infoOpen"] = "false";
    }else{
        testText.style.display ="none";
        tesButtonShow.innerHTML = "COMENZAR TAREA"
        localStorage["infoOpen"] = "true";
    }
}


function showhidetextBool(setOpen){
    const testText = document.getElementById('in-task-text')
    const tesButtonShow = document.getElementById('task-show-btn')
    if(!setOpen){
        if(testText != null){
            testText.style.display ="none";
        }
    }else{
        if(testText != null){
            testText.style.display ="none";
        }
    }
}
function printClickedId(button, action, form){
       
        var date = new Date;
        var clickedTime = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
        console.log(button.id);
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

    console.log("hola");
    
    localStorage["test_on"] = "false";

    if(localStorage["testId"] == lasttask){
        downloadJson();
        endAllTasks();
        localStorage["testId"] = "REINICIO";
        return;
    }

    if(localStorage["testId"] == "REINICIO"){
        localStorage["testId"] = 0; 
        setTestInfo(stringId)
        const tesButtonShow = document.getElementById('task_start_button')
        tesButtonShow.innerHTML = "COMENZAR TAREA"
        setAsInNotStartedTask()
        return;
    }

    var intId = parseInt(localStorage["testId"])
    downloadJson();
    console.log(intId+"id")
    intId += 1
    var stringId = intId.toString()
    localStorage["testId"] = stringId
    setTestInfo(stringId)
    const tesButtonShow = document.getElementById('task_start_button')
    tesButtonShow.innerHTML = "COMENZAR TAREA"
    setAsInNotStartedTask()
}

function endAllTasks(){
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    const bottonInfoText = document.getElementById('in-task-text');

    taskInfoContainer.style.display = "none"
    inTaskContainer.style.display = "block"
    inTaskContainer.innerHTML = "Tareas acabadas, envíe los archivos descargados a josejesus.gonzalez@uclm.es, muchas gracias"
    bottonInfoText.style.display = "none"
}

function sendJsonInfo(testId, dateTime, differenceTime, actionId, type, nextFunctionButton, form){
   
    var postData = {
        "taskId": testId,
        "type": type,
        "dateTime": dateTime,
        "differenceTime": differenceTime,
        "actionId": actionId
    };
    console.log("Enviando: "+actionId)
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
                    console.log("Data: " + data);
                } catch (error) {
                    console.error("Error executing nextFunctionButton: " + error);
                }
            }
            else{
                console.log("Data: " + data);
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
    console.log(arrayDiferences);
    return arrayDiferences;
}

function setTestInfoTab(){
    var textToShow = testExplanationDictionary[localStorage["testId"]];
    const task_test = document.getElementById('task_test');
    textToShow = textToShow.split("\n");
    task_test.innerHTML = "";
    for(let i = 0; i<textToShow.length; i++){
        var paragraph = document.createElement("p");
        paragraph.textContent = textToShow[i];
        task_test.appendChild(paragraph);
        console.log(textToShow[i]);
    }
    console.log(textToShow[0])
}
