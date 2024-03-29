
var bpmValores;
var moveValores;
var conjuntoPeriodoMostrar;
var periodoMostrar;
var numeroConjuntos; 
var sensorChart;
var barrasReglasChart;
var tituloTabla;

var limiteBPM;
var limiteMove;
var reglas;
function startShowTables() {
  //consigo los elementos para la tabla
  tituloTabla = document.getElementById("titulo_tabla");
  tituloTabla.innerHTML = "Estudio conjunto periodo 1";

  var InbpmValores = document.getElementById("bpm_val");
  var InmoveValores = document.getElementById("move_val");
  var objreglas = document.getElementById("reglas");
  var barrasReglasChart = document.getElementById("barrasReglas");
  limiteBPM = document.getElementById("limite_bpm").value;
  limiteMove = document.getElementById("limite_move").value;
  
  var divTabla = document.getElementById("prueba");
  var bpmValoresRaw = InbpmValores.value;
  var move_valValoresRaw = InmoveValores.value;
  var reglasRaw = objreglas.value;

  reglasValores = JSON.parse(reglasRaw);
  bpmValores = JSON.parse(bpmValoresRaw);
  moveValores = JSON.parse(move_valValoresRaw);
  numeroConjuntos = Object.keys(bpmValores).length;
  periodoMostrar = 1; //primero muestro el estudio
  putInfoRelevante();
  setTabla(periodoMostrar);
  
}
  
function moveThrowTables(dir){
    if(dir == -1) //izq
    {
      if(periodoMostrar > 0){
          periodoMostrar -= 1;
          putInfoRelevante();
          changeTableToShow(periodoMostrar);
      }
    }
    else //derecha
    {
      if(periodoMostrar < (numeroConjuntos-1)){
        periodoMostrar += 1;
        putInfoRelevante();
        changeTableToShow(periodoMostrar);
      }
    }

    if(periodoMostrar == 0)
    {
      document.getElementById('reglas_div').style.display = "none"; 
    }
    else
    {
      document.getElementById('reglas_div').style="display:block;";
    }
}

function putInfoRelevante(){
  var bpmMed = JSON.parse(document.getElementById("bpm_medios").value);
  var pbpm_medios = document.getElementById("pbpm_medios");
  bpmMed = JSON.parse(bpmMed)

  var move_medios = JSON.parse(document.getElementById("move_medios").value);
  var pmove_medios = document.getElementById("pmove_medios");
  move_medios = JSON.parse(move_medios)

  if(periodoMostrar > 0){
    pbpm_medios.innerHTML = bpmMed[periodoMostrar-1].toFixed(2);
    pmove_medios.innerHTML = move_medios[periodoMostrar-1].toFixed(2);
  }
}

function changeTableToShow(periodo){
  setTabla(periodo);
}

function setTimeValueForPeriodBPM(array_valores){

  dictionary = {};
  var val, newval;
  dictionary["0"] = 0;
  for(let i = 0; i<array_valores.length; i++){

    if(dictionary[array_valores[i.toString()]["timestamp"]] == null)
      dictionary[array_valores[i.toString()]["timestamp"]] = array_valores[i.toString()]["value"];
    else{
      val = dictionary[array_valores[i.toString()]["timestamp"]];
      newval = (array_valores[i.toString()]["value"] + val) / 2;
      dictionary[array_valores[i.toString()]["timestamp"]] = newval;
    }
  }
  
  return dictionary;
}



function setTimeValueForPeriod(array_valores){

  dictionary = {};
  var val, newval;
  dictionary["0"] = 0;
  for(let i = 0; i<array_valores.length; i++){

    if(array_valores[i.toString()]["value"] < 45 && i != 0 && i != array_valores.length-1){
      array_valores[i.toString()]["value"] = linearInterpolation(array_valores, i)
    }

    if(dictionary[array_valores[i.toString()]["timestamp"]] == null)
      dictionary[array_valores[i.toString()]["timestamp"]] = array_valores[i.toString()]["value"];
    else{
      val = dictionary[array_valores[i.toString()]["timestamp"]];
      newval = (array_valores[i.toString()]["value"] + val) / 2;
      dictionary[array_valores[i.toString()]["timestamp"]] = newval;
    }
  }
  
  return dictionary;
}

function linearInterpolation(valores, index){
  var xizq = valores[index-1]["timestamp"];
  var yizq = valores[index-1]["value"];
  
  var yder = valores[index+1]["value"];
  if(valores[index+1]["value"] < 45){
    return valores[index+1]["value"];
  }
  var xder = valores[index+1]["timestamp"];
  

  var xcon = valores[index]["timestamp"];

  var pendiente = (yder-yizq) / (xder-xizq);

  var yInter = yizq + pendiente * (xcon - xizq);
  return yInter;
}

function setTabla(periodo){
    var ctx = document.getElementById('myChart').getContext('2d');
    var dictBPM = setTimeValueForPeriod(JSON.parse(bpmValores[periodo]));
    var etiquetasBpm = Object.keys(dictBPM);
    var valoresBpm = Object.values(dictBPM);
    if(periodo != 0){
      var dictMove = setTimeValueForPeriod(JSON.parse(moveValores[periodo]));
      var etiquetasMove = Object.keys(dictMove);
      var valoresMove = Object.values(dictMove);
    }
    else{
        etiquetasMove = etiquetasBpm; //si estamos en relajacion q sean estas las etiquetas
        valoresMove = [];
    }
    etiquetas = etiquetasBpm+etiquetasMove;

    if(periodoMostrar == 0)
      tituloTabla.innerHTML = "Periodo de Relajación";
    else if(periodoMostrar % 2 != 0)
      tituloTabla.innerHTML = "Periodo de estudio (nº "+periodoMostrar+")";
    else
      tituloTabla.innerHTML = "Periodo de descanso (nº "+periodoMostrar+")";
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
        data: Array(valoresBpm.length).fill(limiteMove), 
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
        min: 40
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

    if(periodoMostrar != 0){
      var dictReglas = setTimeValueForPeriodReglas(JSON.parse(Object.values(reglasValores)[periodoMostrar-1]));
      var etiquetasReglas = Object.keys(dictReglas);
      var valoresReglas = Object.values(dictReglas);
    }else{
      barrasReglasChart.data.datasets[0].data = [];
      barrasReglasChart.update();
      return;
    }
    //var etiquetasReglas = etiquetasReglasFunction(valoresReglas, Object.keys(arrayValoresBpm[conjuntoPeriodoMostrar][periodoMostrar]));
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
              var valueY = context.parsed.y; // Valor de Y
              var valueX = context.parsed.x; // Valor de X
              var label = context.label || '';
              var dataIndex = context.dataIndex;
              return "Reglas Ejecutadas " + ': ' + valueY +". Ejecutadas: "+ valoresString[stringIndexes[dataIndex]].replace('undefined', '');
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
    } 
    else{
      barrasReglasChart = new Chart(ctxReglas, {
      type: 'bar',
      data: dataReglas,
      options: optionsReglas
    });
  }
}

var valoresString = {};
var stringIndexes = [];
function setTimeValueForPeriodReglas(array_valores){
  valoresString = {};
  stringIndexes = [];
  dictionary = {};
  var val, newval;
  

  var tag = passSecondsToMinutes(parseInt(array_valores[0]["timestamp"]));
  var lastTag = passSecondsToMinutes(0);

  for(let i = 0; i<array_valores.length; i++){
    tag = passSecondsToMinutes(parseInt(array_valores[i.toString()]["timestamp"]));
    tag = lastTag + "-" + tag;
    if(dictionary[tag] == null){
      dictionary[tag] = 1;
      stringIndexes.push(tag);
      valoresString[tag] = array_valores[i.toString()]["rulename"];
    }
    else{
      newval = (dictionary[tag] + 1);
      dictionary[tag] = newval;
      valoresString[tag] = valoresString[tag] + ", " +array_valores[i.toString()]["rulename"];
    }
    lastTag = passSecondsToMinutes(parseInt(array_valores[i.toString()]["timestamp"]));
  }
  
  return dictionary;
}

function passSecondsToMinutes(labelSeconds){
  var minute = Math.floor(labelSeconds / 60);
  var seconds_left = labelSeconds % 60;
  var minutoOfSession = minute + ':' + (seconds_left < 10 ? '0' : '') + seconds_left;
  return minutoOfSession;
}

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
  return etiquetasRegla;
}