const testNumber = 5;
var testIds = [];
var currentTestId = "0";
var jsonData
var lasttask = "5";
const testExplanationDictionary = {
    
    "0": "TAREA 1: En la pestaña pacientes, crea un usuario que se llame \"Luis\" de apellidos \"Téllez\" ",
    "1": "TAREA 2: Edita el paciente \"Editame González\" en pestaña pacientes para que se llame \"Juan González\" ",
    "2": "TAREA 3: Crea una terapia con nombre \"Terapia normal\" y que contenga dos bloques de estudio:"
    + " \n (a) Bloque sin reglas de Estudio:10 min; Descanso:5 min; Estudio:10 min"
    + " \n (b) Bloque 2 con duraciones Descanso: 3 min; Estudio: 5 min; sin reglas",

    "3": "TAREA 4: Crea una terapia de nombre \"Terapia reglas\" "
    +"  \n con un bloque:[Estudio: 10 min Descanso:5 min Estudio:10 min], donde haya una regla: "
    +" \n LA REGLA: \"Regla B1\" que cumpla: "
    +"  \n (a)	Se ejecute en estudios y descansos."
    +"  \n (b)	Momento del periodo: entero."
    +"  \n (c)	Compruebe si el movimiento es bajo."
    +"  \n (d)	Acción en la reloj: Enviar un mensaje “¿Estás estudiando?” "
    +"  \n (e)	Acción en el sesión: Que no haga NADA "
    +"  \n (f)  Añadir una acción extra para cuando vuelva a ocurrir esta situación."
 	+"  \n (g)  En esta segunda acción, que envíe un mensaje “Calma vas bien” en acciones de reloj."
 	+"  \n (h)  En esta segunda acción, en acciones de sesión, que acabe el periodo.",

    "4": "TAREA 5: Crea una sesión de estudio, dentro del paciente \"Luis Tellez\", tal que: "+
    " \n  (a) Su fecha de comienzo: las 12:00 del día de la prueba"
    +" \n (b) Con nuestra terapia \"Terapia normal\" "
    +" \n (c) Sensibilidad del sensor BPM a 10%"
    + "\n (d) Sensibilidad de movimiento: bajo "
    + "\n (e) Que sume puntos cuando ambos sensores sean bajos."
   
}
window.onload = function() {
    
    testIds = [];
    currentTestId = "0";
    

    if(!localStorage["test_on"]){ 
        localStorage["testId"] = "0";
        setAsInNotStartedTask();
        
    }
    else if(localStorage["test_on"] == "false")
    {
        if(localStorage["testId"] && localStorage["testId"] != lasttask)
            setAsInNotStartedTask();
        else 
            endAllTasks();
            return;
    }
    else{
        
        if(!localStorage["testId"]){
            console.log("started test on")
            setTestInfo("0");
            localStorage["testId"] = "0";
        }
        else{
           
            if(localStorage["testId"] == lasttask){
                return; 
            }
            console.log("contiuing test on")
            setTestInfo(localStorage["testId"]);
        }
        setAsInTask(); 
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
    console.log("La id es: "+localStorage["testId"])
} 

function getAllInputs() {
    
    if(localStorage["teststart"]){
        const inputElements = document.querySelectorAll('input');
        inputElements.forEach(function(input) {
            setInputListener(input)
            console.log(input.id);
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
        bottonInfoText.innerHTML = testExplanationDictionary[localStorage["testId"]];
        taskInfoContainer.style.display = "none";
        inTaskContainer.style.display = "block";
    }
}

function setAsInNotStartedTask(){
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    taskInfoContainer.style.display = "block";
    setTestInfoTab(); //TODO
    inTaskContainer.style.display = "none";
    
}

function startTask(){
    var date = new Date;
    const taskInfoContainer = document.getElementById('no-task-container');
    const inTaskContainer = document.getElementById('in-task-container');
    const bottonInfoText = document.getElementById('in-task-text');
    bottonInfoText.innerHTML = testExplanationDictionary[localStorage["testId"]];

    taskInfoContainer.style.display = "none"
    inTaskContainer.style.display = "block"
    localStorage["test_on"] = "true"

    console.log("si, me meto aqui")
    localStorage["teststart"] = (""+date.getDate()+"-"+date.getMonth()+"-"+date.getHours()+"-"+date.getMinutes()+"-"+date.getSeconds()+"-"+date.getMilliseconds());
    setTestInfo(localStorage["testId"])

}

function setTestInfo(testID){
    console.log("aqui es donde falla? "+testID)
    const testText = document.getElementById('in-task-text')
    if(testText != null)
        testText.innerHTML = testExplanationDictionary[testID]
}

function addFunctionToOnClick(button){
    if(button.id != "task_start_button" && button.id != "iniciar-sesion-button"){
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
    const testText = document.getElementById('in-task-text')
    const tesButtonShow = document.getElementById('task-show-btn')
    if(testText.style.display == "none"){
        testText.style.display ="block";
        tesButtonShow.innerHTML = "OCULTAR TAREA"
        localStorage["infoOpen"] = "false";
    }else{
        testText.style.display ="none";
        tesButtonShow.innerHTML = "MOSTRAR TAREA"
        localStorage["infoOpen"] = "true";
    }
}


function showhidetextBool(setOpen){
    const testText = document.getElementById('in-task-text')
    const tesButtonShow = document.getElementById('task-show-btn')
    if(!setOpen){
        testText.style.display ="block";
        tesButtonShow.innerHTML = "OCULTAR TAREA"
    }else{
        if(testText != null){
            testText.style.display ="none";
            tesButtonShow.innerHTML = "MOSTRAR TAREA"
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
    downloadJson();
    localStorage["test_on"] = "false";
    
    var intId = parseInt(localStorage["testId"])

    if(localStorage["testId"] == lasttask){
        endAllTasks();
        return;
    }

    console.log(intId+"id")

    intId += 1
    var stringId = intId.toString()
    localStorage["testId"] = stringId
    setTestInfo(stringId)
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

    // Abre una nueva pestaña con la URL especificada
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

//criterios de exclusion
