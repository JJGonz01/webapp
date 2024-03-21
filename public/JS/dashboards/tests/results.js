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
}