
var bpmValores;
var moveValores;
var conjuntoPeriodoMostrar;
var periodoMostrar;
var numeroConjuntos;
var sensorChart;
var barrasReglasChart;
var tituloTabla;

var limiteBPM;
var reglas;
window.onload = function() {

  //consigo los elementos para la tabla
  tituloTabla = document.getElementById("titulo_tabla");
  tituloTabla.innerHTML = "Estudio conjunto periodo 1";

  var InbpmValores = document.getElementById("bpm_val");
  var InmoveValores = document.getElementById("move_val");
  var objreglas = document.getElementById("reglas");
  limiteBPM = document.getElementById("limite_bpm").value;
  
  var divTabla = document.getElementById("prueba");
  var bpmValoresRaw = InbpmValores.value;
  var move_valValoresRaw = InmoveValores.value;
  var reglasRaw = objreglas.value;

  reglasValores = JSON.parse(reglasRaw);
  bpmValores = JSON.parse(bpmValoresRaw);
  moveValores = JSON.parse(move_valValoresRaw);
  numeroConjuntos = Object.keys(bpmValores).length;
  console.log(reglasValores);
  
  // pongo lo primero que quiero mostrar
  conjuntoPeriodoMostrar = "1"; //el primero
  periodoMostrar = "Estudio"; //primero muestro el estudio
  putInfoRelevante();
  setTabla(bpmValores, moveValores, reglasValores);
  
}
  
function moveThrowTables(dir){
  if(periodoMostrar == "Estudio")
  {
    if(dir == -1) //izq
    {
      if(conjuntoPeriodoMostrar == "1") //estamos borde
      {
        periodoMostrar = "Relajacion";
        changeTableToShow(conjuntoPeriodoMostrar, periodoMostrar);
      }
      else{
        
        conjuntoPeriodoMostrar = (parseInt(conjuntoPeriodoMostrar)-1) + ""; //restamos uno
        putInfoRelevante();
        changeTableToShow(conjuntoPeriodoMostrar, periodoMostrar);
      }
    }
    else //derecha
    {
        if(parseInt(numeroConjuntos) != parseInt(conjuntoPeriodoMostrar)){ //si no 
          
          periodoMostrar = "Descanso";
         
          conjuntoPeriodoMostrar = (parseInt(conjuntoPeriodoMostrar)+1)+"";
          putInfoRelevante();
          changeTableToShow(conjuntoPeriodoMostrar, periodoMostrar);
        }
        console.log("Dee studio ha pasao a "+periodoMostrar);
    }

  } 
  else if(periodoMostrar == "Descanso")
  {
    if(dir == 1) //será siempre estudio pero si es izq sera el conjunto anterior!
    {
      
      periodoMostrar = "Estudio";
      putInfoRelevante();
      changeTableToShow(conjuntoPeriodoMostrar, periodoMostrar);
    }
    else{
      conjuntoPeriodoMostrar = (parseInt(conjuntoPeriodoMostrar)-1)+"";
      periodoMostrar = "Estudio";
      putInfoRelevante();
      changeTableToShow(conjuntoPeriodoMostrar, periodoMostrar);
    }

  } else{ // la relajacion

    if(dir == 1) //solo se puede mover a la derecha
    {
      periodoMostrar = "Estudio";
      putInfoRelevante();
      changeTableToShow(conjuntoPeriodoMostrar, periodoMostrar);
    }
  }

}

function putInfoRelevante(){


  var bpmMed = JSON.parse(document.getElementById("bpm_medios").value);
  var pbpm_medios = document.getElementById("pbpm_medios");

  var move_medios = JSON.parse(document.getElementById("move_medios").value);
  var pmove_medios = document.getElementById("pmove_medios");

  pbpm_medios.innerHTML = bpmMed[conjuntoPeriodoMostrar][periodoMostrar].toFixed(2);
  pmove_medios.innerHTML = move_medios[conjuntoPeriodoMostrar][periodoMostrar].toFixed(2);
}

function changeTableToShow(conjPer, periodo){
  conjuntoPeriodoMostrar = conjPer;
  periodoMostrar = periodo;
  setTabla(bpmValores, moveValores, reglasValores);
}

function setTabla(arrayValoresBpm, arrayValoresMove, arrayReglas){
  var ctx = document.getElementById('myChart').getContext('2d');
  var etiquetasBpm = Object.keys(arrayValoresBpm[conjuntoPeriodoMostrar][periodoMostrar]);
  var valoresBpm = Object.values(arrayValoresBpm[conjuntoPeriodoMostrar][periodoMostrar]);

  if(periodoMostrar != "Relajacion"){
  var etiquetasMove = Object.keys(arrayValoresMove[conjuntoPeriodoMostrar][periodoMostrar]);
  var valoresMove = Object.values(arrayValoresMove[conjuntoPeriodoMostrar][periodoMostrar]);
  }
  else{
      etiquetasMove = etiquetasBpm; //si estamos en relajacion q sean estas las etiquetas
      valoresMove = [];
  }

  etiquetas = etiquetasBpm+etiquetasMove;

  etiquetasBpm.sort(function(a, b) { //no llega en orden cronologico, lo cambio aqiu
    return parseInt(a) - parseInt(b);
  });
  etiquetasMove.sort(function(a, b) { 
    return parseInt(a) - parseInt(b);
  });

  tituloTabla.innerHTML = periodoMostrar+ " conjunto periodo "+conjuntoPeriodoMostrar;
  etiquetasBpm = etiquetasBpm.map(passSecondsToMinutes);


  var data = {
    labels: etiquetasBpm,
     datasets: [ 
    {
      label: 'BPM',
      data: valoresBpm,
      backgroundColor: 'rgba(192, 75, 192, 0.2)',
      borderColor: 'rgba(192, 75, 192, 1)',
      borderWidth: 1,
      pointStyle: 'circle',
      pointRadius: 4,
      yAxisID:'y'
    },
    {
      label: 'Movimiento',
      data: valoresMove,
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgba(75, 192, 192, 1)',
      borderWidth: 1,
      pointStyle: 'circle',
      pointRadius: 4,
      yAxisID:'y1'
    },
    {
      label: 'Limite BPM',
      data: Array(valoresBpm.length).fill(limiteBPM), 
      backgroundColor: 'rgba(255, 0, 0, 0.2)',
      borderColor: 'rgba(255, 0, 0, 1)',
      borderWidth: 1,
      borderDash: [5, 5], 
      pointStyle: 'circle',
      pointRadius: 0,
      yAxisID: 'y'
    },
    {
      label: 'Limite Movimiento',
      data: Array(valoresBpm.length).fill(0.4), 
      backgroundColor: 'rgba(0,0,255, 0.2)',
      borderColor: 'rgba(0,0,255, 1)',
      borderWidth: 1,
      borderDash: [5, 5], 
      pointStyle: 'circle',
      pointRadius: 0,
      yAxisID: 'y1'
    }
  ]
};
  
var options = {
  scales: {
    x: {
      title: {
        display: true,
        text: 'Tiempo', 
        font: {
          weight: 'bold', 
          size: 16 
        }
      }
    },
    y: {
      position: 'left', 
      title: {
        display: true,
        text: 'BPM',
        font: {
          weight: 'bold', 
          size: 16
        }
      },
      beginAtZero: false,
      min: 50
    },
    y1: {
      position: 'right',
      title: {
        display: true,
        text: 'Movement', 
        font: {
          weight: 'bold', 
          size: 16 
        }
      },
      beginAtZero: true
    }
  },
  plugins: {
    tooltip: {
      callbacks: {
        labels: function(context) {
          var datasetLabel = context.dataset.label || '';
          var values = context.dataset.data;
          var dataIndex = context.dataIndex;

          if (Array.isArray(values[dataIndex])) {//hago medias con valores que recojo a la vez (mismo seg)
            var additionalValues = values[dataIndex];
            var sum = additionalValues.reduce(function(a, b) {
              return a + b;
            }, 0);
            var average = sum / additionalValues.length;
            
            return datasetLabel + ': ' + average.toFixed(2);
          }
          
          return datasetLabel + ': ' + values[dataIndex];
        }
      }
    }
  }
};

if (sensorChart) {
  sensorChart.data = data;
  sensorChart.options = options;
  sensorChart.update();
} else {
  sensorChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: options
  });
}


  
  if(periodoMostrar != "Relajacion"){
  
  var valoresRawReglas = Object.values(reglasValores[conjuntoPeriodoMostrar][periodoMostrar]);
  var valoresReglas = pasaraValoresBuenos(reglasValores[conjuntoPeriodoMostrar][periodoMostrar]);

  }else{
    barrasReglasChart.data.datasets[0].data = [];
    barrasReglasChart.update();
    return;
  }

  var etiquetasReglas = etiquetasReglasFunction(valoresReglas, Object.keys(arrayValoresBpm[conjuntoPeriodoMostrar][periodoMostrar]));
/**
 * AQUI HAGO EL GRAFICO DE BARRAS QUE SALEN LAS REGLAS :)
 */
  var dataReglas = {
    labels: etiquetasReglas,
    datasets: [{
      label: 'Número de Reglas',
      data: valoresReglas,
      barPercentage: 0.6,
      backgroundColor: '#f7c59f',
      borderColor:'#ffe45e',
      borderWidth: 1
    }]
  };
  

  var optionsReglas = {
    scales: {
      x: {
        title: {
          display: true,
          text: 'Periodo de tiempo', 
          font: {
            weight: 'bold', 
            size: 16 
          }
        }
      },
      y: {
        position: 'left',
        title: {
          display: true,
          text: 'Numero de reglas',
          font: {
            weight: 'bold',
            size: 16
          }
        },
        beginAtZero: false,
        min: 0,
        ticks: {
          stepSize: 1,
          precision: 0
        }
      },
    },
    plugins: {
      tooltip: {
        callbacks: {
          label: function(context) {
            var datasetLabel = context.dataset.label || '';
            var value = context.parsed.y;
            var dataIndex = context.dataIndex;
            return "Reglas Ejecutadas " + ': ' + value + ". Ejecutadas: "+ valoresString[dataIndex].replace('undefined', ''); 
          }
        }
      }
    }
  };
  
  var ctxReglas = document.getElementById('barrasReglas').getContext('2d');
  if(barrasReglasChart){

    barrasReglasChart.data = dataReglas;
    barrasReglasChart.options = optionsReglas;
    barrasReglasChart.update();

  } else{
    barrasReglasChart = new Chart(ctxReglas, {
    type: 'bar',
    data: dataReglas,
    options: optionsReglas
  });}



}



/*

*/
function passSecondsToMinutes(labelSeconds){
var minute = Math.floor(labelSeconds / 60);
var seconds_left = labelSeconds % 60;
var minutoOfSession = minute + ':' + (seconds_left < 10 ? '0' : '') + seconds_left;
return minutoOfSession;
}

var valoresString = [""];
function pasaraValoresBuenos(arrayReglas){
  var val = Object.values(arrayReglas);
  var et = Object.keys(arrayReglas);
  valoresString = [""];
  var contadorReglas = [0];
  var valor = 40;
  var index = 0;
  for(var i = 0; i<et.length;){
    if(et[i] <= valor){
      valoresString[index] += val[i]+"-";
      contadorReglas[index] += 1;
      i+=1;
    }
    else{
      if(valoresString[index] != undefined)
        var nuevaCadena = valoresString[index].replace('undefined', '');
      else nuevaCadena = "";

      valoresString[index] = nuevaCadena;
      valor+=40;
      index += 1
      contadorReglas[index] = 0;
    }
  }
  console.log(contadorReglas);
  return contadorReglas;
  
}
  

function etiquetasReglasFunction(valoresRegla, etiquetasRegla){
  var j = 0;
  etiquetaAuxRegla = [];
  
  var indexValor = 0;
  for (var i = 0; i < valoresRegla.length; i++) {
    
      var textNot = parseInt(indexValor/60)+":"+parseInt(indexValor%60)+"--"+parseInt(((indexValor+40)/60))+":"+parseInt((indexValor+40)%60);
      etiquetaAuxRegla[i] = textNot;
      indexValor += 40;
  }
  etiquetasRegla = etiquetaAuxRegla;
  console.log(etiquetasRegla);
  return etiquetasRegla;
}