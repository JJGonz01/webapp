function openTest(){
    
}
var currentStep = 0;

const htmlDicTest = {
    "0": `
        `,
    "1": `
    <img class="col-4" src="{{asset('/images/kidtest.png')}}">
    <div class="col-8">
        <h2>Pruebas</h2>
        <p>
           Queremos medir como de fácil, entendible y usable es esta aplicación, y por eso 
           te pedimos que intentes realizar distintas tareas que van a definir el día a día
           de esta aplicación, y nos comentes mediante una serie de preguntas y comentarios
           como crees de fácil es usar la aplicación y qué mejorarías.
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Comenzar la primera prueba</button></div>
    </div>        
    `,

    "2": `
    <img class="col-4" src="{{asset('/images/kidtest.png')}}">
    <div class="col-8">
        <h2>¿Para quien van las sesiones de estudio?</h2>
        <p>
           Vamos a definir al niño que va a estar estudiando con la técnica pomodoro. Este niño es a quien vamos
           a medir las constantes, va a llevar el reloj, y va a tener las sesiones de estudio asignadas. 
           Crea un nuevo "Paciente", con el nombre y apellidos que quieras, para posteriormente poder asignarleç
           terapias y sesiones.
        </p>

        <div class="">
            <div class="row span-test">
            <span style="font-family: Arial, FontAwesome; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf0e0;</span>
                <div class="span-test">
                    <p> Ve a la pestaña de <a href="/patients">Pacientes</a> y crea un nuevo paciente</p>
                </div>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Comenzar la primera prueba</button></div>
    </div>        
    `
}
function startTest(){
    var checkbox = document.getElementById("checkboxTestReady");
    var button = document.getElementById("button-start-test");
    checkbox.addEventListener('change', function(){
        if(this.checked){
            button.disabled = false;
            button.className = "button-next-test";
        }else{
            button.disabled = true;
            button.className = "button-next-test-disabled";
        }
    });
}

function setNextStep(){
    currentStep += 1;
    document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep];
}