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

//NEW ..> 
var bpmdataset;
var movedataset;
function startRepresentation(){
    let bpmraw = document.getElementById("bpm_val").content;
    let moveraw = document.getElementById("move_val").content;
    bpmdataset = getDataSets(bpmraw);
    movedataset = getDataSets(moveraw);
}

function getDataSets(dataraw){
    let bpmdata = {}
    let json = JSON.parse(dataraw);
    for(let i = 0; i<json.length; i++){
        bpmdata[i] = JSON.parse(json[i]);
    }
    return bpmdata;
}

function getDataSetsTimeStamped(dataraw){
    let bpmdata = {}
    let json = JSON.parse(dataraw);
    for(let i = 0; i<json.length; i++){
        bpmdata[i] = JSON.parse(json[i]);
    }
    return bpmdata;
}


function setTableWithOne(dataset, color = "blue", tension = 0){
    console.log(dataset);
    const cfg = {
        type: 'scatter',
        data: {
          datasets: [{
            data: dataset[1],
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
                    labels: {
                        font: {
                            size: 24
                        }
                    }
                }
            }
      }
    }
    var ctx = document.getElementById("tablebpm").getContext('2d');
    var myChart = new Chart(ctx, cfg);
}