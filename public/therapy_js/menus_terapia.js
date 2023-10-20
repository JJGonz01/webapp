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
  console.log("Hola");
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
