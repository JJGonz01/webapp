/*
  Para cambiar entre contenedor de reglas y de periodos :)
*/

function changeContenedorVisible(contenedor){
  /*
    const contenedor_reglas = document.getElementById("contenedor_reglas");
    const contenedor_periodos = document.getElementById("contenedor_periodos");
    const contenedor_reglas_creador = document.getElementById("creador_reglas_popup");
    const boton_periodo_tiempo = document.getElementById("boton_periodos");
    const boton_periodo_reglas = document.getElementById("boton_reglas");
    switch(contenedor){
        case "reglas":
            contenedor_periodos.style.display = "none";
            boton_periodo_tiempo.className = "therapy-option-button";
            boton_periodo_reglas.className = "therapy-option-button-selected";
            contenedor_reglas.style.display = "block";
            //mostrarReglasRespectoPeriodo(selectConjPeriodo); --> esto lo rompe, pq? TODO
            break;
        case "periodos":
            contenedor_reglas.style.display = "none";
            contenedor_periodos.style.display = "block";
            contenedor_reglas_creador.style.display = "none";

            boton_periodo_tiempo.className = "therapy-option-button-selected";
            boton_periodo_reglas.className = "therapy-option-button"; 
            break;
    }
    */
}

/**
 * Abre el creador de reglas, si es una nueva se le pasa un valor de nombre null (no existe), si es para editar una regla,
 * se llama junto al nombre de la regla a editar!
 */

function openPopup(nombreRegla){
  const boton_crear_regla = document.getElementById("boton_guardar_regla"); //segun sea editar o no, el boton de guardar llamara al nombre de la regla o no
  if(nombreRegla == null)
  {
    boton_crear_regla.onclick = function(){
        guardarRegla(null);
    };
  }
  else{
    boton_crear_regla.onclick = function(){
        guardarRegla(nombreRegla);
    };
  }
}

            
const claves = ["Nombre", "Bloque", "Periodo", "Condiciones", "Acciones", "Condiciones","Ejecutar una única vez"];

function transformarAHTML() {
    let html = '<ul>';
    var div = document.createElement("div");
    div.classList.add("flex-rule-row"); 
    var datos = document.getElementById("rules_therapy").value;
    datos = JSON.parse(datos)
    var outputDiv = document.getElementById("app_info");
    //var datos = JSON.parse(reglas);
    datos.forEach(dato => {
    const regla = JSON.parse(dato);

    var i = 0;
    html += '<li>';
    Object.entries(regla).forEach(([clave, valor]) => {
        html += `<strong>${claves[i]}:</strong> ${valor}<br>`;
        i++;
    });
    html += '</li>';
    i = 0;
    });

    html += '</ul>';
    div.innerHTML = html;
    outputDiv.appendChild(div);
}

function printElements(){
  var periodos = document.getElementById("periods_therapy").value;
  var outputDiv = document.getElementById("output");
  var jsonObject = JSON.parse(periodos);
  var per = 0;
  var perMax = 3;
  var bloque = 0;
  var keys = ["Estudio", "Descanso", "Estudio"];
  jsonObject.forEach(function(item){
          bloque += 1;
          var div = document.createElement("div");
          div.classList.add("flex-text-row"); 
          var h = document.createElement("p");
          h.style.color = "black";
          h.style.fontWeight  = "bold";
          h.textContent = "Bloque "+bloque+":";
          div.appendChild(h);
          per = 0;

          const keys = Object.keys(item);
          var p1Element = document.createElement("p");
          p1Element.style.color = "black";
          p1Element.textContent = "Estudio" + ": " + item["duration_t1"]+" minutos";
          div.appendChild(p1Element);


          var p2Element = document.createElement("p");
          p2Element.style.color = "black";
          p2Element.textContent = "Descanso" + ": " + item["duration_rest"]+" minutos";
          div.appendChild(p2Element);

          if(keys.length >= 3){

            var p3Element = document.createElement("p");
            p3Element.style.color = "black";
            p3Element.textContent = "Descanso" + ": " + item["duration_t2"]+" minutos";
            div.appendChild(p3Element);

          }
        
          outputDiv.appendChild(div);
      });
  }