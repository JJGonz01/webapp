function openRulesPopUp(){
    document.getElementById("popup").style="display:fixed;";
}

function closeRulesPopUp(){
    document.getElementById("popup").style="display:none;";
}

function selectTimesComprobation(button, otherid, inputid){
    var other = document.getElementById(otherid);
    if(button.value == 0){
         button.value = 1;
         button.className="button-selected";

         other.value = 0;
         other.className="button-canceled";

         document.getElementById(inputid).value = button.name;
    }
}   

function selectPeriodComprobation(button){
   if(button.value == 0){
        button.value = 1;
        button.className="button-selected";
   }
   else{
        button.value = 0;
        button.className="button-canceled";
   }
}   

function conditions(button, otherid, inputid){
    var other = document.getElementById(otherid);
    var input = document.getElementById(inputid);
    if(button.value == 0){
         button.value = 1;
         button.className="button-selected";

         other.value = 0;
         other.className="button-canceled";

         input.value = button.name;
    }
}

function actionOptions(divId, button, primary){
    var buttons = document.getElementById(divId).getElementsByTagName("Button");
    let p = "primary";
    if(!primary) p = "secondary"
    for(var i = 0; i<buttons.length; i++){
        buttons[i].value=0;
        buttons[i].className = "button-canceled";
        document.getElementById("accion-sesion-"+p).value = buttons[i].name;
    }

    button.className = "button-selected"; 
    button.value=1;
}

function openMessagesPopUp(primary, request){
    document.getElementById("popup-on").style="display:fixed;";
    callGetIndexedMessage(request, primary);
}

function closeMessagesPopUp(){
    document.getElementById("popup-on").style="display:none;";
}

function selectMessage(primary, name){
    document.getElementById("popup-on").style="display:none;";
}


function openCreateMessage(){
    document.getElementById("popup-on-on").style="display:fixed;";
}

function createMessage(){
    document.getElementById("popup-on-on").style="display:none;";
}

function cancelCreateMessage(){
    document.getElementById("popup-on-on").style="display:none;";
}

function callCreateMessage(primary){
    var name =  document.getElementById("input-message-name").value;
    var title =  document.getElementById("input-message-title").value;
    var subtitle =  document.getElementById("input-message-subtitle").value;
    var type =  1;//document.getElementById("messages-list");
    var image =  0; //document.getElementById("messages-list");
    var btnone =  document.getElementById("input-btn1").value;
    var btntwo =  document.getElementById("input-btn2").value;

    createMessage(name, title, subtitle, btnone, btntwo,type, image);
    getMessages(primary);

    document.getElementById("popup-on-on").style="display:none;";

}

async function callGetIndexedMessage(messages, primary){
   var tableMessages =  document.getElementById("messages-list");
   tableMessages.innerHTML = "";
   createTableTop(tableMessages);
   for(var i = 0; i< Object.keys(messages).length; i++){
        console.log(messages[Object.keys(messages)[i]]["name"]);
        let tr = document.createElement("tr");
            let tdcheckbox = document.createElement("td");
                let checkbox = document.createElement("input");
                checkbox.type="checkbox";
                checkbox.value=messages[Object.keys(messages)[i]]["id"];
                checkbox.name = Object.keys(messages)[i];
                tdcheckbox.appendChild(checkbox);

            let tdname = document.createElement("td");
            tdname.innerHTML=messages[Object.keys(messages)[i]]["name"];
            let tdmsg = document.createElement("td");
            tdmsg.innerHTML=messages[Object.keys(messages)[i]]["title"];
            let tdbtns = document.createElement("td");
            tdbtns.innerHTML=messages[Object.keys(messages)[i]]["type"];

            tr.appendChild(tdcheckbox);
            tr.appendChild(tdname);
            tr.appendChild(tdmsg);
            tr.appendChild(tdbtns);
        tableMessages.appendChild(tr);
        
    }
    checkEventListenerCheckbox(tableMessages, messages, primary);

}

function checkEventListenerCheckbox(table, messages, primary){
    var checkboxes = table.querySelectorAll('input[type="checkbox"]');
    var p = "primary";
    if(!primary) p="secondary";

    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
      if (this.checked) {
            console.log("p-message-"+p+"-selected");
            document.getElementById("title-clock-select").innerHTML = messages[checkbox.name]["title"];
            document.getElementById("subtitle-clock-select").innerHTML = messages[checkbox.name]["subtitle"];
            document.getElementById("message-"+p).value= messages[checkbox.name]["id"];
            document.getElementById("p-message-"+p+"-selected").innerHTML= "Mensaje seleccionado: "+ messages[checkbox.name]["name"];

            checkboxes.forEach(function(otherCheckbox) {
            if (otherCheckbox !== checkbox) {
                otherCheckbox.checked = false;
            }
        });
      }
    });
  });
}

function createTableTop(tableMessages){
    let tr = document.createElement("tr");
            let tdcheckbox = document.createElement("td");
            tdcheckbox.innerHTML="Seleccionar";

            let tdname = document.createElement("td");
            tdname.innerHTML="Nombre";
            let tdmsg = document.createElement("td");
            tdmsg.innerHTML="Mensaje";
            let tdbtns = document.createElement("td");
            tdbtns.innerHTML="Botones";

            tr.appendChild(tdcheckbox);
            tr.appendChild(tdname);
            tr.appendChild(tdmsg);
            tr.appendChild(tdbtns);
        tableMessages.appendChild(tr);
}
