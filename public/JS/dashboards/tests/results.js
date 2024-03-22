var currentUser = 0;
var json;
var numberUsers;
function showResults(){

    if(document.getElementById("password-input").value != "Milouise")
    console.log(2222);    
    //return;
    var resuts = document.getElementById("results").content;
    json = JSON.parse(resuts);
    numberUsers = Object.keys(json).length;
    console.log(numberUsers);

    showUser();
    showUSE();
}


useQuestions = [ //22 preguntas
    "La herramienta me parece eficaz para conseguir los objetivos definidos",
    "La herramienta haría más productiva la gestión de una sesión de estudio",
    "La herramienta me parece útil para  gestionar una sesión de estudio",
    "La herramienta posee una organización que facilita la gestión del estudio",
    "La herramienta cubriría todas mis necesidades",
    "La herramienta realiza todo lo que me esperaba",
    "La herramienta me ha parecido fácil de usar",
    "La herramienta es amigable",
    "Requiere el menor número de pasos para logar gestionar el estudio",
    "La herramienta es flexible",
    "No requiere esfuerzo utilizarla",
    "La navegación es intuitiva y no requiere de instrucciones escritas",
    "Podría ser usada tanto por personas no expertas como por usuarios ocasionales",
    "Podría aprender a utilizarla rápidamente",
    "Sería fácil recordar como utilizarla",
    "No necesito experiencia previa con la herramienta para entenderla",
    "Me ha satisfecho la herramienta",
    "Recomendaría esta herramienta",
    "Es agradable de utilizar",
    "Funciona tal y como me esperaba",
    "Podría necesitar esta herramienta",
    "Es cómoda de usar"
];

function changeCurrentUser(userdir){
    currentUser += userdir;
    if(currentUser<0) currentUser = numberUsers;
    else if(currentUser >= numberUsers) currentUser = 0;
}

function showUser(){
    var container = document.getElementById("show-patient-container");
    var finish = false;
    if(json[currentUser]["currentstep"] == 18){
        finish = true;
    }
    let htmlUser = `
        <h3>Usuario #${currentUser}</h3>
        <h6>Ha terminado: ${finish};<h6>
        <h6> Comenzó la prueba a las : ${json[currentUser]["created_at"]}</h6>
        <h6> Último paso completado a las : ${json[currentUser]["updated_at"]}</h6>
        <div class="row">
            <button onclick="showUSE()">USE</button>
            <button>Preguntas web</button>
            <button>Preguntas Reloj</button>
            <button>Preguntas Resultados</button>
        </div>
        <div id="results-container">
        </div>
    `;
    container.innerHTML = htmlUser;
}

function showUSE(){
    var container = document.getElementById("results-container");
    var use = JSON.parse(json[currentUser]["actions"])["USE"];
    console.log(use);
    let htmluse = `
        <h3>Cuestionario USE</h3>
    `;

    for(let i = 0; i<22;i++){
        let response = use["USE"+i];
        if(response == null){
            response = "Sin responder";
        }
        htmluse += `
        <h6>${i}) ${useQuestions[i]}</h6>
        `;

        htmluse += `
        <p style="margin-left:30px;">RESPUESTA: ${response}</p>
        `;
    }

    container.innerHTML = htmluse;

    showQuestions(questionsdicPacientes, 2, "pacientes");
    showQuestions(questionsPlanes, 4, "planes");
    showQuestions(questionsReglas, 5, "reglas");
    showQuestions(questionsReloj, 4, "reloj");
    showQuestions(questionsResultados, 2, "resultados");
}

function showQuestions(questions, numberofquestions, indextext){
    var container = document.getElementById("results-container");
    var use = JSON.parse(json[currentUser]["actions"])[indextext];
    console.log(use);
    let htmluse = `
        <h3>${indextext}</h3>
    `;

    for(let i = 0; i<numberofquestions;i++){
        let response = use[indextext+i];
        if(response == null){
            response = "Sin responder";
        }
        htmluse += `
        <h6>${i}) ${questions[i]}</h6>
        `;

        htmluse += `
        <p style="margin-left:30px;">RESPUESTA: ${response}</p>
        `;
    }

    container.innerHTML += htmluse;
}

questionsdicPacientes = [ //pacientes
    '¿Crees que "estudiantes" es el mejor nombre para denominar a los niños?',
    '¿Qué información mínima y esencial añadirías para hacer el perfil del niño más completo?'
];

questionsPlanes = [ //planes
    '¿Crees que es útil que los "Planes de estudio" sean reutilizables?',
    '¿Es fácil de entender la gestión de "Planes de estudio"?¿Hay algún concepto que no se entiende adecuadamente?',
    '¿Es fácil de manejar la gestión de "Planes de estudio"?',
    '¿Cambiarias algo en la gestión de los planes de estudio?'
];

questionsReglas = [ //reglas
    '¿Crees que la definición de reglas para activar acciones durante el periodo de estudio es útil?',
    '¿Es fácil entender la gestión de reglas?',
    '¿Es fácil de manejar la gestión de "Reglas"?',
    '¿Crees que las variables (ritmo cardíaco y movimiento) que utilizamos para analizar el estado de ánimo del niño son adecuadas?¿Añadirías alguna otra?',
    '¿Cambiarias algo en la gestión de reglas?'
];

questionsReloj = [ //reloj
    '¿Crees que los mensajes de comenzar y terminar cada periodo son adecuados?',
    '¿Crees que el de relajación antes de la sesión beneficiaría al estudiante para estar más tranquilo durante el estudio?',
    '¿Crees que el estudiante podría beneficiarse de tener una sesión de estudio con tiempos marcados y con descansos intercalados?',
    '¿Opinas que los mensajes que envía el reloj al estudiante podrían motivarlo, ayudarle y/o apoyarlo durante el estudio?'
];

questionsResultados = [ //resultados
    '¿Crees que la información recogida durante la sesión es útil?',
    '¿Es fácil entender los resultados obtenidos?',
    '¿Es fácil de manejar y moverse a través de los distintos periodos?',
    '¿Añadirías alguna información a mostrar adicional?'
];
