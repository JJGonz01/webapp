var milestones = 1;
var milestonesids = 1;
function createMilestone(){
    milestones++;
    milestonesids ++;

    let msid = milestonesids;
    let ms = milestones;
    var div = document.createElement("div");
    div.className = "row milestone-container";
    div.id = msid+"-ms";
    console.log(ms);
    var h1 = document.createElement("h1");
    h1.className = "col-md-2";
    h1.innerHTML = ms+"";

    var div1 = document.createElement("div");
    div1.className  = "col-md-4 milestone-container-div";
    div1.id = "";

        var input1 = document.createElement("input");
        input1.className = "input-session form-control";
        input1.name = "stepname";
        input1.placeholder = "Nombre del hito";
        input1.id = "input-"+ms;
        input1.addEventListener('input', function(){
            checkStepsIn9();
        });
        div1.appendChild(input1);

    var div2 = document.createElement("div");
    div2.className  = "col-md-4 milestone-container-div";
    div2.id = "";

        var input2 = document.createElement("input");
        input2.className = " input-session form-control";
        input2.placeholder = "Comentario del hito";
        input2.name = "stepcoment";
        input2.id = "";
        div2.appendChild(input2);

    var div3 = document.createElement("div");
    div3.className  = "col-md-2 milestone-container-div";
    div3.id = "";

        var input3 = document.createElement("button");
        input3.type="button";
        input3.onclick = function(){
            deleteMilestone(msid+"-ms");
        };
        input3.innerHTML = "X";
        input3.id = "";
        input3.className = "calendar-button-add";
        div3.appendChild(input3);

    div.appendChild(h1);
    div.appendChild(div1);
    div.appendChild(div2);
    div.appendChild(div3);
    document.getElementById("milestones-list").appendChild(div);
}

function deleteMilestone(milestoneidloc){
    
    var divlist = document.getElementById("milestones-list").getElementsByClassName("row milestone-container");
    var hasdeleted = false;
    for(let i = 0; i<divlist.length; i++){
        if(divlist[i].id.includes('-ms') && typeof divlist[i] != undefined){
            
            if(divlist[i].id == milestoneidloc){
                hasdeleted = true;
                divlist[i].remove();
                if(i == (divlist.length) || divlist.length <= 1){
                    break;
                }
            }
            let h1 = parseInt(divlist[i].getElementsByTagName("h1")[0].innerHTML);
            if(hasdeleted){
                divlist[i].getElementsByTagName("h1")[0].innerHTML = (h1-1);
               
            }

        }
    }
    milestones--;
}

function gotonextstep(page){
    if(page == 0){
        document.getElementById("container-objective-one").style.display="none";
        document.getElementById("container-objective-two").style.display="block";
    }
   
    else if(page == 1){
        document.getElementById("container-objective-two").style.display="none";
        document.getElementById("container-objective-three").style.display="block";
    }
}

function gotolaststep(page){
    if(page == 0){
        document.getElementById("container-objective-one").style.display="block";
        document.getElementById("container-objective-two").style.display="none";
    }
   
    else if(page == 1){
        document.getElementById("container-objective-two").style.display="block";
        document.getElementById("container-objective-three").style.display="none";
    }
}

function selectType(inputid, button, divId){
    document.getElementById(inputid).value = button.value;
    var buttons = document.getElementById(divId).getElementsByTagName("button");
    for(let i = 0; i<buttons.length; i++){
        buttons[i].className = "image-container-objective-w100";
    }
    button.className = "image-container-objective-w100-selected";
}

function selectRewardType(inputid, button, divId){
    document.getElementById(inputid).value = button.value;
    var buttons = document.getElementById(divId).getElementsByTagName("button");
    for(let i = 0; i<buttons.length; i++){
        buttons[i].className = "image-container-objective-w100";
    }
    button.className = "image-container-objective-w100-selected";
}

function saveAndSendObjective(){
    var steps = [];
    var divlist = document.getElementById("milestones-list").getElementsByClassName("row milestone-container");

    for(let i = 0; i<divlist.length; i++){
        let step = {}
        let inputs = divlist[i].getElementsByClassName("form-control");
        for(let i = 0; i<inputs.length; i++){
            let input = inputs[i];
            if(input.name == "stepname"){
                step.name = input.value;
            }else{
                step.comentary = input.value;
            }
        }
        steps[i] = step;
    }
    console.log(steps);
    document.getElementById("steps-input").value =  JSON.stringify(steps);
    document.getElementById("objective_form").submit();
}