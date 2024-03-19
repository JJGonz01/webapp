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

startRepresentation(); 
var currentPeriod = 1;
var nPeriods;
//setTableWithTwo(bpmdataset, movedataset,'red',0.2, 3, 3);
//setTableWithTwoLeft(bpmdataset, movedataset,'red',0.2,1,1,"graph-left");
//setTableWithTwoRight(bpmdataset,movedataset, 'red',0.2, 2, 2,"graph-right");

var bpmdataset;
var movedataset;

function changeView(divid){
    var divs = document.getElementsByName("views");
    for(let i = 0; i<divs.length; i++){
        divs[i].style="display:none;";
    }
    document.getElementById(divid).style = "display:block;";
}

function seleccionarBoton(botonSeleccionado) {
    var botones = botonSeleccionado.parentNode.querySelectorAll('button');
    botones.forEach(function(boton) {
        boton.className = 'button-patient';
    });

    botonSeleccionado.className = 'button-patient-selected';
}


function startRepresentation(){
    let bpmraw = document.getElementById("bpm_val").content;
    let moveraw = document.getElementById("move_val").content;
    bpmdataset = getDataSets(bpmraw);
    movedataset = getMoveDataSets(JSON.parse(moveraw));
}

function showCurrentPeriod(dir){
    currentPeriod += dir;
    let maxnum = bpmdataset.length;
    console.log(nPeriods);

    if(currentPeriod <= 0) currentPeriod = 1;
    else if (currentPeriod >= (nPeriods)) currentPeriod = (nPeriods-1);

    myChart2.data.datasets[1].data = bpmdataset[currentPeriod];
    myChart2.data.datasets[0].data = movedataset[currentPeriod];
    myChart2.update;

    setTableWithTwo(bpmdataset, movedataset,'red',0.2, currentPeriod);

    console.log(currentPeriod);
}

function getDataSets(dataraw, start=0){
    let bpmdata = {}
    let json = JSON.parse(dataraw);
    nPeriods = json.length;
    console.log(nPeriods);
    for(let i = start; i<json.length; i++){
        bpmdata[i] = JSON.parse(json[i]);
    }
    console.log(bpmdata[0]);
    return bpmdata;
}

function getMoveDataSets(obj){
    const result = {};
    for (const key in obj) {
        if (Object.hasOwnProperty.call(obj, key)) {
            result[key] = JSON.parse(obj[key]);
        }
    }
    console.log(result);
    return result;
}

function getDataSetsTimeStamped(dataraw){
    let bpmdata = {}
    let json = JSON.parse(dataraw);
    for(let i = 0; i<json.length; i++){
        bpmdata[i] = JSON.parse(json[i]);
    }
    return bpmdata;
}


function setTableWithOne(dataset, color = "blue", tension = 0, datasetindex = 1, id="tablebpm"){
    console.log(dataset);
    const cfg = {
        type: 'scatter',
        data: {
          datasets: [{
            data: dataset[datasetindex],
            showLine: true,
            pointRadius: 5,
            pointHoverRadius: 5,
            pointStyle: "rectRounded",
            tension: tension,
            borderCapStyle: 'round'
          }]
        },
        options: {
            parsing: {
                xAxisKey: 'timestamp',
                yAxisKey: 'value'
            },
            scales: {
                x: {
                    type: 'linear', // Assuming x-axis is linear
                    position: 'bottom',
                    grid: {
                        display: false
                    },
                    ticks: {
                        fontSize: 20
                    },
                    gridLines: {
                        drawBorder: false,
                      },
                },
                y: {
                    type: 'linear',
                    position: 'left',
                    grid: {
                        display: false
                    },
                    ticks: {
                        fontColor: "red",
                        fontSize: 20
                    }
                }
            },
            plugins: {
                legend: {
                        display:false
                }
            }
      }
    }
    var ctx = document.getElementById(id).getContext('2d');
    var myChart = new Chart(ctx, cfg);
}
var myChart2;
var myChartLeft;
var myChartRight;

function setTableWithTwo(dataset, dataset2, color = "blue", tension = 0, datasetindex = 1, dataindex2 = 1,  id="sessiontable"){
    const cfg2 = {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Movimiento',
                    data: dataset2[dataindex2],
                    yAxisID: 'y-axis-1', // Asigna el eje Y correspondiente
                    showLine: true,
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointStyle: "rectRounded",
                    tension: tension,
                    borderCapStyle: 'round'
                },
                {
                    label: 'Pulsaciones',
                    data: dataset[datasetindex],
                    yAxisID: 'y-axis-2', // Asigna el eje Y correspondiente
                    showLine: true,
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointStyle: "rectRounded",
                    tension: tension,
                    borderCapStyle: 'round'
                }
            ]
        },
        options: {
            parsing: {
                xAxisKey: 'timestamp',
                yAxisKey: 'value'
            },
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    grid: {
                        display: false
                    },
                    ticks: {
                        fontSize: 20
                    },
                    gridLines: {
                        drawBorder: false,
                    },
                },
                yAxes: [{
                    id: 'y-axis-1',
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        fontColor: "red",
                        fontSize: 20
                    }
                }, {
                    id: 'y-axis-2',
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        fontColor: "blue",
                        fontSize: 20
                    }
                }]
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    };
    
    var ctx2 = document.getElementById("sessiontable").getContext('2d');
    if(!myChart2)
        myChart2 = new Chart(ctx2, cfg2);
    else{
        myChart2.data.datasets[0].data = dataset2[datasetindex];
        myChart2.update();
    }
    
}


function setTableWithTwoLeft(dataset, dataset2, color = "blue", tension = 0, datasetindex = 1, dataindex2 = 1,  id="sessiontable"){
    const cfg3 = {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Movimiento',
                    data: dataset2[dataindex2],
                    yAxisID: 'y-axis-1', // Asigna el eje Y correspondiente
                    showLine: true,
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointStyle: "rectRounded",
                    tension: tension,
                    borderCapStyle: 'round'
                },
                {
                    label: 'Pulsaciones',
                    data: dataset[datasetindex],
                    yAxisID: 'y-axis-2', // Asigna el eje Y correspondiente
                    showLine: true,
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointStyle: "rectRounded",
                    tension: tension,
                    borderCapStyle: 'round'
                }
            ]
        },
        options: {
            parsing: {
                xAxisKey: 'timestamp',
                yAxisKey: 'value'
            },
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    grid: {
                        display: false
                    },
                    ticks: {
                        fontSize: 20
                    },
                    gridLines: {
                        drawBorder: false,
                    },
                },
                yAxes: [{
                    id: 'y-axis-1',
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        fontColor: "red",
                        fontSize: 20
                    }
                }, {
                    id: 'y-axis-2',
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        fontColor: "blue",
                        fontSize: 20
                    }
                }]
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    };
    
    var ctx3= document.getElementById(id).getContext('2d');
    if(!myChartLeft)
        myChartLeft = new Chart(ctx3, cfg3);
    else{
        myChartLeft.data.datasets[0].data = dataset2[dataindex2];
        myChartLeft.data.datasets[1].data = dataset[datasetindex];
        myChartLeft.update();
    }
    
}


function setTableWithTwoRight(dataset, dataset2, color = "blue", tension = 0, datasetindex, dataindex2,  id="sessiontable"){
    const cfg4 = {
        type: 'scatter',
        data: {
            datasets: [
                {
                    label: 'Movimiento',
                    data: dataset2[dataindex2],
                    yAxisID: 'y-axis-1', // Asigna el eje Y correspondiente
                    showLine: true,
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointStyle: "rectRounded",
                    tension: tension,
                    borderCapStyle: 'round'
                },
                {
                    label: 'Pulsaciones',
                    data: dataset[datasetindex],
                    yAxisID: 'y-axis-2', // Asigna el eje Y correspondiente
                    showLine: true,
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointStyle: "rectRounded",
                    tension: tension,
                    borderCapStyle: 'round'
                }
            ]
        },
        options: {
            parsing: {
                xAxisKey: 'timestamp',
                yAxisKey: 'value'
            },
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom',
                    grid: {
                        display: false
                    },
                    ticks: {
                        fontSize: 20
                    },
                    gridLines: {
                        drawBorder: false,
                    },
                },
                yAxes: [{
                    id: 'y-axis-1',
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        fontColor: "red",
                        fontSize: 20
                    }
                }, {
                    id: 'y-axis-2',
                    type: 'linear',
                    position: 'right',
                    ticks: {
                        fontColor: "blue",
                        fontSize: 20
                    }
                }]
            },
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    };
    
    var ctx4 = document.getElementById(id).getContext('2d');
    if(!myChartRight)
        myChartRight = new Chart(ctx4, cfg4);
    else{
        myChartRight.data.datasets[0].data = dataset2[dataindex2];
        myChartRight.data.datasets[1].data = dataset[datasetindex];
        myChartRight.update();
    }
}

function selectOptions(selectid, canvasid, isLeft){
    var selectElement = document.getElementById(selectid);

    selectElement.addEventListener('change', (event) => {
        const selectedLanguage = event.target.value;
        if(isLeft)
            setTableWithTwoLeft(bpmdataset, movedataset,'red',0.2,event.target.value,event.target.value,canvasid);
        else
            setTableWithTwoRight(bpmdataset, movedataset,'red',0.2,event.target.value,event.target.value,canvasid);
    });
}


