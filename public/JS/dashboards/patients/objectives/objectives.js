var milestones = 1;
var milestonesids = 1;
function createMilestone(){
    milestones++;
    milestonesids ++;
    var milestonehtml = `
    <div id="${milestonesids}-ms" class="row milestone-container">
        <h1 class="col-md-2">${milestones}</h1>
        <div id="" class="col-md-4 milestone-container-div"><input class="form-control " placeholder="Nombre del hito"></input></div>
        <div id="" class="col-md-4 milestone-container-div"><input class="form-control " placeholder="Comentario del hito"></input></div>
        <div id="" class="col-md-2 milestone-container-div"><button type="button" onclick="deleteMilestone('${milestonesids}-ms')">ELIMINAR</button></div>
    </div>
                        `

    document.getElementById("milestones-list").innerHTML += milestonehtml;
}

function deleteMilestone(milestoneid){
    var divlist = document.getElementById("milestones-list").getElementsByClassName("row milestone-container");
    var hasdeleted = false;
    for(let i = 0; i<divlist.length; i++){
        console.log(divlist[i]);
        if(divlist[i].id.includes('-ms')){
         
            if(divlist[i].id == milestoneid){
                hasdeleted = true;
                divlist[i].remove();
            }
            if(hasdeleted){
                divlist[i].getElementsByTagName("h1")[0].innerHTML = parseInt(divlist[i].getElementsByTagName("h1")[0].innerHTML)-1;
            }

        }
    }
    milestones--;

}

function gotonextstep(){
    document.getElementById("container-objective-one").style.display="none";
    document.getElementById("container-objective-two").style.display="block";
}

function gotolaststep(){
    document.getElementById("container-objective-one").style.display="block";
    document.getElementById("container-objective-two").style.display="none";
}