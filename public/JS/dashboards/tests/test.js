
var currentStep = 6;//0
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const htmlDicTest = { 
    "0": ` 
                    <img class="col-4" src="http://localhost:8000/images/kidtest.png">
                    <div class="col-8">
                        <h2>Bienvenido a la aplicación "Pomodoro"</h2>
                        <p>
                            Durante esta sesión de pruebas, queremos comprobar las distintas funcionalidades
                            de esta aplicación. Queremos saber tu opinión para conseguir un sistema que permita
                            facilmente organizar sesiones de estudio con descansos, y en estas poder monitorizar las 
                            constantes del niño para poder interpretar sus distintas constantes, y mediante la iteración 
                            y el entendimiento, conseguir que mejore en sus estudios.
                        </p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkboxTestReady">
                            <label class="form-check-label" for="flexCheckChecked">
                                Estoy preparado para comenzar
                            </label>
                        </div>
                        
                        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Siguiente</button></div>
                    </div>
        `,
    "1": `
    <img class="col-4" src="http://localhost:8000/images/webdesigner.png">
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
    <img class="col-4" src="http://localhost:8000/images/childream.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">1º-¿Para quien van las sesiones de estudio?</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
           Vamos a definir al niño que va a estar estudiando con la técnica pomodoro. Este niño es a quien vamos
           a medir las constantes, va a llevar el reloj, y va a tener las sesiones de estudio asignadas. 
           Crea un nuevo "Paciente", con el nombre y apellidos que quieras, para posteriormente poder asignarle
           terapias y sesiones.
        </p>

        <div class="">
            <div class="row span-test">
            <span id="span-test-1" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="text-center">
                    <p> Ve a la pestaña de <a href="/patients">Pacientes</a> y crea un nuevo paciente</p>
                </div>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Terminado</button></div>
    </div>        
    `,

    "3": `
    <img class="col-4" src="http://localhost:8000/images/kidthink.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">Ahora... tu opinión sobre los pacientes</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
           Cuentanos:
        </p>
        <div>
            <div class="form-group">
                <label for="i1">¿Crees que "pacientes" es el mejor nombre para denominar a los niños?</label>
                <input name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            <div class="form-group">
                <label for="i1">¿Qué información añadirías para hacer el perfil del niño más completo?</label>
                <input name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="setNextStep()" class="text-end button-next-test">Siguiente prueba</button></div>
    </div>        
    `,
    "4": `
    <img class="col-4" src="http://localhost:8000/images/tomato.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">2º-¿Cómo organizamos el tiempo de la sesión?</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
          La duración de las sesiones de estudio se define con un "Plan de estudio", estos planes de estudio se componen de distintos bloques.
          Los bloques consisten en periodos de unos minutos de descanso y otros de estudio (a excepción del primero que tendrá
            unos minutos de estudio, un descanso, y otros minutos de estudio). Cada bloque posee condiciones: según las constantes
            del niño durante la sesión, tú puedes configurar mensajes que le envíe al reloj, sumarle puntos en el juego, añadirle 
            más minutos o menos... 
        </p>

        <div class="">
            <div class="row span-test">
                <span id="span-test-1" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="text-center">
                    <p> Ve a la pestaña de <a href="/therapies">Planes de estudio </a> y crea un nuevo plan de estudio</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-2" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Asegurate de que ese plan de estudio tenga DOS BLOQUES, sin condiciones, y que cada estudio dure 5 minutos, y cada descanso 3 minutos</p>
                </div>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-2" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Terminado</button></div>
    </div>        
    `,
    "5": `
    <img class="col-4" src="http://localhost:8000/images/kidthink.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">Primera impresión de los planes de estudio</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
           Cuentanos:
        </p>
        <div>
            <div class="form-group">
                <label for="i1">¿Es fácil gestionar los diferentes periodos de una terapia?¿Que mejorarias?</label>
                <input name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            <div class="form-group">
                <label for="i1">¿Cambiarias algo?¿Lo has visto fácil de entender?</label>
                <input name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="setNextStep()" class="text-end button-next-test">Siguiente prueba</button></div>
    </div>        
    `,
    "6": `
    <img class="col-4" src="http://localhost:8000/images/clockwatch.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">3º-Un plan de estudio con condiciones</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
          Durante la sesión podremos enviar mensajes al niño, sumar puntos, añadir o restar tiempo al estudio o el descanso 
          dependiendo de distintas condiciones. Desde las condiciones de los bloques, puedes elegir cuando realizar una acción,
          y que acción realizar. Puedes decidir desde si tanto como su pulsación es alta o baja, se mueve mucho o poco y/o está en
          un momento específico de la sesión. 
        </p>

        <div class="">
            <div class="row span-test">
                <span id="span-test-1" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="text-center">
                    <p> Ve a la pestaña de <a href="/therapies">Planes de estudio </a> y crea un nuevo plan de estudio</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-4" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Crea el plan de estudio con el nombre de PLAN CON REGLAS</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-2" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Asegurate de que ese plan de estudio tenga UN BLOQUE: con los estudios y el descanso de 2 minutos</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-3" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Añade una CONDICIÓN al bloque (bloque 0), en el que si la PULSACIÓN es ALTA, envíe un mensaje personalizado</p>
                </div>
            </div>

        </div>
        <div class="text-end"><button id="button-start-test-2" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Terminado</button></div>
    </div>        
    `,
}

function startTest(){
    console.log(window.location.pathname);
    openTestPopUp();
    document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep];
    //borrar lo de arriba
   
    var stepsWithTasks = [2, 4];
    if(stepsWithTasks.includes(currentStep))
        checkTest(currentStep);
    else
        document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep];
    
    if(window.location.pathname.includes("createtherapy")){
        
        checkStepsIn6();
    }
    
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
    var stepsWithTasks = [2, 4];
    if(stepsWithTasks.includes(currentStep))
        checkTest(currentStep);
    else
        document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep];
}

function closeTestPopUp(){
    document.getElementById("popup-test-content-container").style = "display:none;";
}

function openTestPopUp(){
    console.log("eing");
    document.getElementById("popup-test-content-container").style = "display:fixed;";
}

function checkTest(idtest){
    fetch('/checkstep/'+idtest, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        checkStep(response);
        return response.json();
    })
    .then(response => {
        console.log('Response from server:', response);
        checkStep(response);
        return response;
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });
}

function checkStep(rsp){
    document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep];
    if(currentStep == 2 && rsp == "1"){ //primera prueba
        document.getElementById("button-start-test-1").disabled = false;
        document.getElementById("button-start-test-1").className = "button-next-test";
        document.getElementById("span-test-1").innerHTML = "&#xf058;";
        document.getElementById("span-test-1").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
    }

    if(currentStep == 4){

        if(rsp == "1")
            document.getElementById("span-test-1").innerHTML = "&#xf058;";
            document.getElementById("span-test-1").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        }

        if(rsp == "2"){

            document.getElementById("span-test-1").innerHTML = "&#xf058;";
            document.getElementById("span-test-1").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
            
            document.getElementById("button-start-test-2").disabled = false;
            document.getElementById("button-start-test-2").className = "button-next-test";

            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        }
}

function checkStepsIn6(){
    document.getElementById("therapy-name").addEventListener('input',function(event){
        if(event.target.value.toLowerCase() == "plan con reglas"){
            document.getElementById("span-test-4").innerHTML = "&#xf058;";
            document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        }
      });

    document.getElementById("mb_t1").addEventListener('input',function(event){
        if(checkValues()){
            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
     
        }
      });
    document.getElementById("mb_t2").addEventListener('input',function(event){
        if(checkValues()){
            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
     
        }
      });
    document.getElementById("mb_rest").addEventListener('input',function(event){
        if(checkValues()){
            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        }
      });

      console.log("a comprobar las reglas")

    for(let i = 0; i<numerosPeriodos+1; i++){
        if(mapaReglas[i]){
            for(let j = 0; j<Object.keys(mapaReglas[i]).length;j++){
                let key = Object.keys(mapaReglas[i])[j];
                console.log(mapaReglas[i]);
                console.log(key);
                console.log(mapaReglas[i][key]);
                console.log(mapaReglas[i][key]["conditions"]);
                console.log(mapaReglas[i][key]["actions"]);
                console.log(mapaReglas[i][key]["conditions"].includes("sensor_movement"));
                if(mapaReglas[i][key]["conditions"].includes("sensor_movement") && mapaReglas[i][key]["conditions"].includes("high")
                && mapaReglas[i][key]["actions"].includes("message\":\"{")){
                    console.log("shakldhjads");
                    document.getElementById("span-test-3").innerHTML = "&#xf058;";
                    document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
             
                }
            }
        }
    }
}

function checkValues(){
    var input =  document.getElementById("mb_t1").value;
    var input2 =  document.getElementById("mb_t2").value;
    var input3 =  document.getElementById("mb_rest").value;

    if(input == 2 && input2 == 2 && input3 == 2){
        return true;
    }else{
        return false;
    }
}