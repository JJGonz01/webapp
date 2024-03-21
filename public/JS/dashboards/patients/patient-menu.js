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
    document.getElementById("game-view").style.display = "none";

    if(view == 0){
        document.getElementById("calendar-view").style.display = "block";
    }else if(view == 1){
        document.getElementById("objectives-view").style.display = "block";
    }else if(view==2){
        document.getElementById("avatar-view").style.display = "block";
    }else{
      document.getElementById("game-view").style.display = "block";
    }
}
 
function showMilestones(objetivesid){
    var objetives = JSON.parse(document.getElementById("objectives").content);
    var objetivesidlc = 0;
    console.log(objetives);

    for(let i = 0; i<objetives.length; i++){
        if(objetives[i]["id"] == objetivesid){
            objetivesidlc = i;
            break;
        }
    }
    var steps = JSON.parse(objetives[objetivesidlc]["steps"]);
    var container = document.getElementById("steps-container");
    container.innerHTML = `<h3>Objetivo: ${objetives[objetivesidlc]["name"]}</h3>`;
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


function seleccionarBoton(botonSeleccionado, div) {
    var botones = botonSeleccionado.parentNode.querySelectorAll('button');
    botones.forEach(function(boton) {
        boton.className = 'button-patient';
    });

    botonSeleccionado.className = 'button-patient-selected';
}

function filterObjectiveByType(state){
    var tabla = document.getElementById('objectives-table');
    var filas = tabla.getElementsByTagName('tr');
    
    for (var i = 0; i < filas.length; i++) {
      var celdaEstado = filas[i].getElementsByTagName('td')[2];
      if (celdaEstado) {
        var textoraw = celdaEstado.textContent || celdaEstado.innerText;
        var estadoTexto = textoraw.replace(/\s/g, ''); 
        var statenospace = state.replace(/\s/g, ''); 
        console.log(statenospace);
        if (estadoTexto === statenospace) {
          filas[i].style.display = '';
        } else {
          filas[i].style.display = 'none';
        }
      }       
    }
}

function restoreObjectivesFilter(){
    var tabla = document.getElementById('objectives-table');
    var filas = tabla.getElementsByTagName('tr');
    
    for (var i = 0; i < filas.length; i++) {
      filas[i].style.display = '';
    }
  }
function filterbystate(state) {
    var tabla = document.getElementById('session-table');
    var filas = tabla.getElementsByTagName('tr');
    
    for (var i = 0; i < filas.length; i++) {
      var celdaEstado = filas[i].getElementsByTagName('td')[3];
      
      if (celdaEstado) {
       
        var textoraw = celdaEstado.textContent || celdaEstado.innerText;
        var estadoTexto = textoraw.replace(/\s/g, ''); 
        var statenospace = state.replace(/\s/g, ''); 
        console.log(statenospace);
        if (estadoTexto === statenospace) {
          filas[i].style.display = '';
        } else {
          filas[i].style.display = 'none';
        }
      }       
    }
  }

  function filterbydateToday(button){
    var tabla = document.getElementById('session-table');
    setColorAsSelected(button);
    var filas = tabla.getElementsByTagName('tr');
    var hoy = new Date();
    let state = hoy.getFullYear() +"-"+hoy.getMonth() +"-"+hoy.getDate();
    for (var i = 0; i < filas.length; i++) {
      var celdaEstado = filas[i].getElementsByTagName('td')[3];
      
      if (celdaEstado) {
       
        var textoraw = celdaEstado.textContent || celdaEstado.innerText;
        var estadoTexto = textoraw.replace(/\s/g, ''); 
        var statenospace = state.replace(/\s/g, ''); 
        console.log(statenospace);
        if (estadoTexto === statenospace) {
          filas[i].style.display = '';
        } else {
          filas[i].style.display = 'none';
        }
      }       
    }
  }

  function setColorAsSelected(button){
    let buttons = button.parentNode.getElementsByTagName("button");
    for(let i = 0; i<buttons.length; i++){
      buttons[i].className= "button-date-filter";
    }    
    button.className = "button-date-filter-selected";
  }

  function filterbydateMonth(button){
    setColorAsSelected(button);
    let date = new Date();
    mesSeleccionado = date.getMonth();
    var tabla = document.getElementById('session-table');
    var filas = tabla.getElementsByTagName('tr');
    
    for (var i = 1; i < filas.length; i++) {
      var celdaFecha = filas[i].getElementsByTagName('td')[0];
      if (celdaFecha) {
        console.log(celdaFecha.textContent);
        var fecha = new Date(celdaFecha.textContent);
        var mes = fecha.getMonth();
        console.log(mes);
        console.log(mesSeleccionado);
        if (mes === mesSeleccionado) {
          filas[i].style.display = '';
        } else {
          filas[i].style.display = 'none';
        }
      }       
    }
  }
  function restoreFilter(){
    var tabla = document.getElementById('session-table');
    var filas = tabla.getElementsByTagName('tr');
    
    for (var i = 0; i < filas.length; i++) {
      filas[i].style.display = '';
    }
  }

  function closePopUpGuide(){
    document.getElementById("popup-guide").style = "display:none;";
  }

  function openPopUpGuide(){
    document.getElementById("popup-guide").style = "display:fixed;";
  }

  function openObjectivePopUp(){
    document.getElementById("popup-objective").style = "display:fixed;";

  }
  function closeObjectivePopUp(){
    document.getElementById("popup-objective").style = "display:none;";
  }

  function objectiveMenu(objetivesid){
    openObjectivePopUp();
    var objetives = JSON.parse(document.getElementById("objectives").content);
    var objetivesidlc = 0;
    console.log(objetives);

    for(let i = 0; i<objetives.length; i++){
        if(objetives[i]["id"] == objetivesid){
            objetivesidlc = i;
            break;
        }
    }
    document.getElementById("objective-name").innerHTML = objetives[objetivesidlc]["name"];
    document.getElementById("objective-date").innerHTML = "Fecha objetivo: " +objetives[objetivesidlc]["date_end"];
    var steps = JSON.parse(objetives[objetivesidlc]["steps"]);
    var container = document.getElementById("milestones-container-popup");

    container.innerHTML = `<h3>Recompensa: ${objetives[objetivesidlc]["reward_name"]}</h3>`;
    let i = 0;
    steps.forEach(step => {
        let desc = 'Sin descripción';
        i++;
        console.log(step)
        if(typeof step["comentary"] !== "undefined"){
            desc = `${step["comentary"]}`;
        }
        let html = `
        <div class="row" style="margin-top:20px;">
            <p class="col-md-2">#${i}</p>
            <p class="col-md-2">${step["name"]}</p>
            <p class="col-md-2">${desc}</p>
            <button onclick = "changesState(this)" class="button-objective-next-step">Completar</button>
        </div>
        `
        container.innerHTML += html;
    });

    container.innerHTML += `
      <button class="button-objective-next-step" onclick="closeObjectivePopUp()">Guardar</button>
      <button class="button-objective-cancel-step" onclick="closeObjectivePopUp()">Cancelar</button>
    `
  }


  function changesState(button) {
    if (button.className == "button-objective-next-step") {
        button.className = "button-objective-completed-step";
        button.innerHTML = "Completado";
        button.addEventListener('mouseenter', mouseEnterHandler);
        button.addEventListener('mouseleave', mouseLeaveHandler);
    } else {
        button.removeEventListener('mouseenter', mouseEnterHandler);
        button.removeEventListener('mouseleave', mouseLeaveHandler);

        button.style.background = "var(--color-primary-light-blue)";
        button.className = "button-objective-next-step";
        button.innerHTML = "Completar";
    }
}

function mouseEnterHandler() {
    changeButtonInnerHTML(this, "CANCELAR", "var(--color-primary-red)");
}

function mouseLeaveHandler() {
    changeButtonInnerHTML(this, "Completado", "var(--color-primary-green)");
}

function changeButtonInnerHTML(button, text, color) {
    button.innerHTML = text;
    button.style.background = color;
}
