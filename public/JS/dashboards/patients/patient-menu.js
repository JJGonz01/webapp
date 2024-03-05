function sendFormSession(formid){
    document.getElementById(formid).submit();
}

function openPopUpEvent(){
    document.getElementById("eventCreatepopup").style.display="fixed";
}
function closePopUpEvent(){
    document.getElementById("eventCreatepopup").style.display="none";
}

function changeviewpatient(view){
    document.getElementById("calendar-view").style.display = "none";
    document.getElementById("objectives-view").style.display = "none";
    document.getElementById("avatar-view").style.display = "none";

    if(view == 0){
        document.getElementById("calendar-view").style.display = "block";
    }else if(view == 1){
        document.getElementById("objectives-view").style.display = "block";
    }else{
        document.getElementById("avatar-view").style.display = "block";
    }
}

function showMilestones(objetivesid){
    var objetives = JSON.parse(document.getElementById("objectives").content);
    var steps = JSON.parse(objetives[objetivesid-1]["steps"]);
    var container = document.getElementById("steps-container");
    container.innerHTML = `<h3>Objetivo: ${objetives[objetivesid-1]["name"]}</h3>`;
    let i = 0;
    steps.forEach(step => {
        let desc = 'Sin descripción';
        i++;
        console.log(step)
        if(typeof step["comentary"] !== "undefined"){
            desc = `${step["comentary"]}`;
        }
        let html = `
        <div class="row">
            <p class="p-milestone">#${i}</p>
            <p class="p-milestone">${step["name"]}</p>
            <p class="p-milestone">${desc}</p>
        </div>
        `
        container.innerHTML += html;
    });
    
}