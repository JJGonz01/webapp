function openRulesPopUp(){
    document.getElementById("popup").style="display:fixed;";
}

function closeRulesPopUp(){
    document.getElementById("popup").style="display:none;";
}

function saveRule(){
    var ruleName = document.getElementById("condition-name").value;
    var ruleDesc = document.getElementById("condition-description").value;
}

function selectTimesComprobation(button, otherid){
    var other = document.getElementById(otherid);
    if(button.value == 0){
         button.value = 1;
         button.className="button-selected";

         other.value = 0;
         other.className="button-canceled";
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

function conditions(button, otherid){
    var other = document.getElementById(otherid);
    if(button.value == 0){
         button.value = 1;
         button.className="button-selected";

         other.value = 0;
         other.className="button-canceled";
    }
}

function actionOptions(divId, button){
    var buttons = document.getElementById(divId).getElementsByTagName("Button");

    for(var i = 0; i<buttons.length; i++){
        buttons[i].value=0;
        buttons[i].className = "button-canceled";
    }

    button.className = "button-selected"; 
    button.value=1;
}

function openMessagesPopUp(primary){
    document.getElementById("popup-on").style="display:fixed;";
}

function closeMessagesPopUp(){
    document.getElementById("popup-on").style="display:none;";
}

function selectMessage(){
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

function callCreateMessage(){

}

async function callGetIndexedMessage(messages){
   
   console.log(messages);
   var tableMessages =  document.getElementById("messages-list");

   for(var i = 0; i< Object.keys(messages).length; i++){
        console.log(messages[Object.keys(messages)[i]]);
        let tr = 
   }
}