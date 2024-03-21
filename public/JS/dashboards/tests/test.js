
var currentStep = 0;//0
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const htmlDicTest = { 

    "0": `
    <img class="col-4" src="http://localhost:8000/images/webdesigner.png">
    <div class="col-8">
        <h2>Vídeo introducción</h2>
        <p>En este video describo como funciona la aplicación, funcionalidades y un poco de información sobre qué vas
        a estar realizando en esta sesión de pruebas</p>
        <video width="640" height="360" controls>
            <source src="http://localhost:8000/images/video/MuestraTestWeb.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Comenzar la primera prueba</button></div>
    </div>        
    `,
    "1": `
    <img class="col-4" src="http://localhost:8000/images/questionare.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">Cuestionario 'USE' ¿Qué te parece la herramienta?</h2>
    </div>
        <p>
           Cuentanos: 
        </p>
        <form action=""http://localhost:8000/nextstep/22" id="form-use" method="GET">
            <div id="use-div-questions" style="overflow-y:auto; height:400px;padding:10px;">
            </div>
            <div class="form-check" style="border-top:1 solid grey; margin-top:20px;">
                <input class="form-check-input" type="checkbox" value="" id="checkboxTestReady">
                <label class="form-check-label" for="flexCheckChecked" type="button">
                    He respondido las preguntas, y he terminado el cuestionario
                </label>
            </div>
        </form>
    
        <div class="text-end" ><button id="button-start-test" onclick="sendUSE();" class="text-end button-next-test-disabled">Terminar test</button></div>
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
                <label for="q0">¿Crees que "pacientes" es el mejor nombre para denominar a los niños?</label>
                <input id = "q0" name = "q0" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            <div class="form-group">
                <label for="q1">¿Qué información mínima y esencial añadirías para hacer el perfil del niño más completo?</label>
                <input id = "q1" name = "q1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="sendQuestions('pacientes', 2)" class="text-end button-next-test">Siguiente prueba</button></div>
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
          La duración de las sesiones de estudio se define con un "Plan de estudio", el cual puede ser asignado a varios "Pacientes" o
          a un "Paciente" en diferentes "sesiones de estudio". Estos "Planes de estudio" se componen de distintos "Bloques".
          Los "Bloques" consisten en "Periodos" de estudio y descanso organizados alternativamente. El primer "Bloque" tiene tres
          periodos: un "Periodo de estudio", un "Periodo de descanso", y un último "Periodo de estudio". El resto de bloques se compone
          únicamente de un "Periodo de descanso" seguido de un "Periodo de estudio".
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
                <label for="q0">¿Crees que es útil que los "Planes de estudio" sean reutilizables?</label>
                <input id = "q0" name = "q0" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q1">¿Es fácil de entender la gestión de "Planes de estudio"?¿Hay algún concepto que no se entiende adecuadamente?</label>
                <input id = "q1" name = "q1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q2">¿Es fácil de manejar la gestión de "Planes de estudio"?</label>
                <input id = "q2" name = "q2" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            <div class="form-group">
                <label for="q3">¿Cambiarias algo en la gestión de los planes de estudio?</label>
                <input id = "q3" name = "q3" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="sendQuestions('planes', 4)" class="text-end button-next-test">Siguiente prueba</button></div>
    </div>        
    `,
    "6": `
    <img class="col-4" src="http://localhost:8000/images/timeman.png">
    <div class="col-8">
        <h2>Comprobar el estado del niño durante la sesión de estudio</h2>
        <p>
        Durante la sesión podrás enviar mensajes al niño, sumar puntos, añadir o restar tiempo al estudio o el descanso 
        dependiendo de distintas condiciones diseñadas de forma específica para cada "Plan de estudio".
        Cada "Bloque" podrá tener asociada una o varias "Condiciones" y de este modo activar diferentes "Acciones". 
        Dentro de las condiciones puedes manejar el nivel de pulsaciones y el movimiento de la mano en la que lleva el reloj.
        La condición ligada a las pulsaciones puede ser "Alta" (tienen que incrementarse mucho las pulsaciones para activar la señal) o "Baja"
        (con pequeños incrementos en las pulsaciones se activará la señal). En cuanto al movimiento, podemos seleccionar si para activar la señal
        tiene que mover mucho o poco la mano que lleva el reloj. Estas condiciones pueden combinarse para crear "Reglas" complejas.
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Comenzar la primera prueba</button></div>
    </div> `,

    "7": `
    <img class="col-4" src="http://localhost:8000/images/clockwatch.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">3º-Un plan de estudio con condiciones</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
          Ahora, crea un plan de estudio que tenga una condición. Este plan de estudio lo comprobaremos más adelante con nuestro
          reloj. Para crear este plan de estudio, sigue los siguientes pasos.
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
                    <p>Añade una CONDICIÓN al bloque (bloque 0), en el que si la MOVIMIENTO es ALTO, envíe un mensaje personalizado</p>
                </div>
            </div>

        </div>
        <div class="text-end"><button id="button-start-test-2" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Terminado</button></div>
    </div>        
    `,
    "8": `
    <img class="col-4" src="http://localhost:8000/images/kidthink.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">Planes de estudio, ¿Qué te parecen?</h2>
    </div>
        <p>
           Cuentanos:
        </p>
        <div>
        
            <div class="form-group">
                <label for="q0">¿Crees que la definición de reglas para activar acciones durante el periodo de estudio es útil?
                </label>
                <input id = "q0"name = "q0" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q1">¿Es fácil entender la gestión de reglas?</label>
                <input id = "q1" name = "q1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            
            <div class="form-group">
                <label for="q2">¿Es fácil de manejar la gestión de "Reglas"?</label>
                <input id = "q2" name = "q2" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q3">¿Crees que las variables (ritmo cardíaco y movimiento) que utilizamos para analizar el estado de ánimo del niño son adecuadas?
                ¿Añadirías alguna otra?
                </label>
                <input id = "q3" name = "q3" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q4">
                    ¿Cambiarias algo en la gestión de reglas?
                </label>
                <input id = "q4" name = "q4" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="sendQuestions('reglas', 5)" class="text-end button-next-test">Siguiente prueba</button></div>
    </div>        
    `, 
    "9": `
    <img class="col-4" src="http://localhost:8000/images/webdesigner.png">
    <div class="col-8">
        <h2>Sesiones de estudio</h2>
        <p>
           Las sesiones de estudio determinan cuándo un plan de estudio se aplicará a un niño. 
           Se plantea una sesión de estudioc como un juego donde, en base a las reglas definidas en el plan de estudio,
           se obtendrán unas determinadas estrellas (puntos) según el comportamiento del estudiante. 
           Estas estrellas se podrán canjear por distintas recompensas que se podrán aplicar en el cuidado de una mascota de la que
           estará a cargo el estudiante.
           En las siguientes pruebas mostraremos como crear una sesión de estudio, como ejecutarla en el reloj, 
           donde ver los resultados obtenidos tras completar la sesión y, finalmente, como acceder y jugar
           con la mascota.
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Ir a las pruebas</button></div>
    </div>        
    `, 
    "10": `
    <img class="col-4" src="http://localhost:8000/images/clockwatch.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">4º-Mi primer objetivo</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
          Un objetivo, una parte fundamental de por qué el niño trabaja, estudia o quiere aprender algo nuevo. Puedes establecer
          objetivos con sus respectivos hitos (pasos para conseguirlo) en la pestaña del paciente (niño que acabamos de crear) .
        </p>

        <div class="">
            <div class="row span-test">
                <span id="span-test-1" style="font-family: Arial, FontAwesome;color:red; padding-right: 3px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div>
                    <p> Ve a la pestaña de <a href="/patients">Pacientes </a>, accede al paciente creado y crea un nuevo
                    OBJETIVO tal que:</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-4" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Selecciona el botón "AÑADIR" y crea un nuevo OBJETIVO</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-2" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Confirma que sea un objetivo escolar, y llámalo EXÁMEN</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-3" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Este exámen tendrá como hitos los distintos temas que estudiar, añade hitos para crear el Tema 1, Tema 2 y Tema 3</p>
                </div>
            </div>

        </div>
        <div class="text-end"><button id="button-start-test-2" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Terminado</button></div>
    </div>        
    `,
    "11": `
    <img class="col-4" src="http://localhost:8000/images/childstudyangry.png">
    <div class="col-8">
        <h2>Lo tenemos todo... ¿Cuándo se ejecuta?</h2>
        <p>
           Una vez hemos hecho nuestro plan de estudios, y (aunque es opcional), hemos definido nuestro objetivo para el niño, podemos proceder a 
           crear una sesión de estudio. Para resumirlo, asignar una sesión de estudio es fijar una fecha y hora para el plan de estudio, donde ajustaremos
           también el juego de los puntos, los sensores del reloj inteligente y qué va a aparecer en el reloj durante el estudio.
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Siguiente</button></div>
    </div>        
    `, 
    "12": `
    <img class="col-4" src="http://localhost:8000/images/sensorimage.png">
    <div class="col-8">
        <h2>Antes de comenzar: Sensores... ¿Está el niño nervioso? ¿Está estudiando?</h2>
        <p>
          Uno de los puntos importantes de esta aplicación es la capacidad de, a través de un reloj inteligente, obtener las pulsaciones y el movimiento que
          está realizando el niño. 
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Siguiente</button></div>
    </div>        
    `, 
    "13": `
    <img class="col-4" src="http://localhost:8000/images/clockwatch.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">5º-Planeando la sesión de estudio</h2>
        <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
    </div>
        <p>
          Para que nuestro plan de estudio se ejecute, es necesario que o asignemos a una sesión, donde declararemos el valor de los sensores,
          el objetivo que perseguimos con esta sesión, y .
        </p>

        <div class="">
            <div class="row span-test">
                <span id="span-test-1" style="font-family: Arial, FontAwesome;color:red; padding-right: 3px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div>
                    <p> Ve a la pestaña de <a href="/patients">Pacientes </a>, accede al paciente creado y crea una sesión nueva:</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-4" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Que la sesión esté configurada para el día de hoy, dentro de cinco minutos</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-3" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Selecciona el plan de estudio que acabamos de crear ("Plan de reglas")</p>
                </div>
            </div>

            <div class="row span-test">
                <span class="col-md-1" id="span-test-5" style="font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;">&#xf057;</span>
                <div class="col-md-11">
                    <p>Configura los sensores de tal manera que la sensibilidad de pulsaciones sea 20 y el de moviemiento 1</p>
                </div>
            </div>

        </div>
        <div class="text-end"><button id="button-start-test-2" onclick="setNextStep()" class="text-end button-next-test-disabled" disabled>Terminado</button></div>
    </div>        
    `, 
    "14": `
    <img class="col-4" src="http://localhost:8000/images/webdesigner.png">
    <div class="col-8">
        <h2>¡Probemoslo en el reloj!</h2>
        <p>
           Has asignado la sesión al estudiante, con sus condiciones y su plan de estudio correspondiente... ¡Toca probar la sesión!
           Entra en el reloj, e introduce la sesión del paciente que acabas de crear (ID DEL PACIENTE: 1), y espera a que llegue la hora asiganda.
           Ve paso a paso por la sesión, y cuando finalice, pulsa el siguiente botón:
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">Ha terminado la sesión en el reloj</button></div>
    </div>        
    `,"15": `
    <img class="col-4" src="http://localhost:8000/images/kidthink.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">La visualización de resultados... ¿Qué te parecen?</h2>
    </div>
        <p>
           Cuentanos:
        </p>
        <div>
            <div class="form-group">
                <label for="q0">¿Crees que los mensajes de comenzar y terminar son adecuados?
                </label>
                <input id = "q0" name = "q0" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q1">¿Crees que un audio de relajación antes de la sesión es necesaria?</label>
                <input id = "q1" name = "q1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            
            <div class="form-group">
                <label for="q2">¿Es fácil de manejar y moverse a través de los distintos periodos?</label>
                <input id = "q2" name = "q2" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="q3">¿Añadirías alguna información a mostrar adicional?
                ¿Añadirías alguna otra?
                </label>
                <input id = "q3" name = "q3" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="sendQuestions('reloj', 4)" class="text-end button-next-test">Siguiente prueba</button></div>
    </div>        
    `, 
    "16": `
    <img class="col-4" src="http://localhost:8000/images/webdesigner.png">
    <div class="col-8">
        <div class="row">
            <h2 class="col-md-10">Observemos los resultados</h2>
            <div class="col-md-1"><button class="button-close-test" onclick="closeTestPopUp()">x</button></div>
        </div>
        <p>
           Busca la sesión en la pestaña del paciente que acabas de crear, y observa los resultados.
        </p>
        <div class="text-end"><button id="button-start-test" onclick="setNextStep()" class="text-end button-next-test">He observado los resultados</button></div>
    </div>        
    `,
    "17": `
    <img class="col-4" src="http://localhost:8000/images/kidthink.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">La visualización de resultados... ¿Qué te parecen?</h2>
    </div>
        <p>
           Cuentanos:
        </p>
        <div>
        
            <div class="form-group">
                <label for="i1">¿Crees que la información recogida durante la sesión es útil?
                </label>
                <input id = "q0" name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="i1">¿Es fácil entender los resultados obtenidos?</label>
                <input id = "q1" name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
            
            <div class="form-group">
                <label for="i1">¿Es fácil de manejar y moverse a través de los distintos periodos?</label>
                <input id = "q2" name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>

            <div class="form-group">
                <label for="i1">¿Añadirías alguna información a mostrar adicional?
                ¿Añadirías alguna otra?
                </label>
                <input id = "q3" name = "i1" class="form-control" placeholder="Tu respuesta aqui"></input>
            </div>
        </div>
        <div class="text-end"><button id="button-start-test-1" onclick="sendQuestions('resultados', 4)" class="text-end button-next-test">Siguiente prueba</button></div>
    </div>        
    `, 
    "18": `
    <img class="col-4" src="http://localhost:8000/images/endimg.png">
    <div class="col-8">
    <div class="row">
        <h2 class="col-md-10">¡Gracias por realizar esta prueba!</h2>
    </div>
        <p>
           ¡Esperamos que le haya satisfecho la aplicación!
        </p>
        <div class="text-end" ><button id="button-start-test" onclick="closeTestPopUp()" class="text-end button-next-test">Terminar test</button></div>
    </div>        
    `, 
}

function startTest(step){
    if(step.includes("{")){
        jsonstep = JSON.parse(step);
        currentStep = (parseInt(jsonstep["step"]));
    }else{
        jsonstep = parseInt(step);
    }
    console.log(step);
    document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep];
    var stepsWithTasks = [2, 4, 7, 10, 13];
    var stepsClosable = [2,3,4,5,7,10,13,16,18];

    if(stepsWithTasks.includes(currentStep))
        checkTest(currentStep);

    if(stepsClosable.includes(currentStep))
        closeTestPopUp();

    if(window.location.pathname.includes("createtherapy") && currentStep == 7){
        checkStepsIn6();
    }

    if(window.location.pathname.includes("createobjective") && currentStep == 10){
        checkStepsIn9();
    }

    if(window.location.pathname.includes("createsession") && currentStep == 13){
        th5Listeners();
        check5thtest();
    }

    if(currentStep == 1){
        setUSEquestionare();
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
    var stepsWithTasks = [2, 4, 7, 10];

    if(stepsWithTasks.includes(currentStep))
        checkTest(currentStep);
    else
        document.getElementById("test-content").innerHTML = htmlDicTest[""+currentStep]; 
    
    if(currentStep == 1){
        setUSEquestionare();
    }

    addStep();

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

function closeTestPopUp(){
    document.getElementById("popup-test-content-container").style = "display:none;";
}

function openTestPopUp(){
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

        if(rsp == "1"){
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

    if(currentStep == 7){
        if(rsp == "3"){
            document.getElementById("span-test-1").innerHTML = "&#xf058;";
            document.getElementById("span-test-1").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        
            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("span-test-3").innerHTML = "&#xf058;";
            document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("span-test-4").innerHTML = "&#xf058;";
            document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("button-start-test-2").disabled = false;
            document.getElementById("button-start-test-2").className = "button-next-test";
        }
    }

    if(currentStep == 10){
        if(rsp == "3"){
            document.getElementById("span-test-1").innerHTML = "&#xf058;";
            document.getElementById("span-test-1").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        
            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("span-test-3").innerHTML = "&#xf058;";
            document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("span-test-4").innerHTML = "&#xf058;";
            document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("button-start-test-2").disabled = false;
            document.getElementById("button-start-test-2").className = "button-next-test";
        }
    }

    if(currentStep == 13){
        if(rsp == "3"){
            document.getElementById("span-test-1").innerHTML = "&#xf058;";
            document.getElementById("span-test-1").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
        
            document.getElementById("span-test-3").innerHTML = "&#xf058;";
            document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("span-test-4").innerHTML = "&#xf058;";
            document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            
            document.getElementById("span-test-5").innerHTML = "&#xf058;";
            document.getElementById("span-test-5").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";

            document.getElementById("button-start-test-2").disabled = false;
            document.getElementById("button-start-test-2").className = "button-next-test";
        }
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

    for(let i = 0; i<numerosPeriodos+1; i++){
        if(mapaReglas[i]){
            for(let j = 0; j<Object.keys(mapaReglas[i]).length;j++){
                let key = Object.keys(mapaReglas[i])[j];
                if(mapaReglas[i][key]["conditions"].includes("sensor_movement") && mapaReglas[i][key]["conditions"].includes("high")
                && mapaReglas[i][key]["actions"].includes("message\":\"{")){
                    document.getElementById("span-test-3").innerHTML = "&#xf058;";
                    document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
             
                }
            }
        }
    }
}
function checkStepsIn9(){
    if(window.location.pathname.includes("createobjective") && document.getElementById("popup").style.display != "none"){
        document.getElementById("span-test-4").innerHTML = "&#xf058;";
        document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";
    }

    document.getElementById("name-input").addEventListener('input', function(event){
        if(event.target.value.toLowerCase() == "examen" || event.target.value.toLowerCase() == "exámen"){
            document.getElementById("span-test-2").innerHTML = "&#xf058;";
            document.getElementById("span-test-2").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";    
        }
    });

    if(milestones == 3){
        let booleano = true;
        for(let i = 1; i<=3; i++){
           if(document.getElementById("input-"+i).value.toLowerCase() != "tema "+i){
            booleano = false;
           }
        }

        if(booleano){
            document.getElementById("span-test-3").innerHTML = "&#xf058;";
            document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";    
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



function setBackToWrong(){
    document.getElementById("span-test-4").innerHTML = "&#xf057;";
    document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;";

}

var booleanoa = false;
var booleanob = false;

var booleanod = false;
var booleanoh = false;

var today = new Date();
var formattedToday = today.toISOString().slice(0, 10);
var currentTime = today.getHours() + ":" + today.getMinutes();
var sixMinutesFromNowBig = new Date(today.getTime() + 6 * 60000);
var sixMinutesFromNow = sixMinutesFromNowBig.getHours() + ":" + sixMinutesFromNowBig.getMinutes();

function th5Listeners(){
    document.getElementById("numberInputBPM").addEventListener('input', function(event){
        if(event.target.value == 20){
            booleanoa = true;
        }
        check5thtest();
    });

    document.getElementById("numberInputMove").addEventListener('input', function(event){
        if(event.target.value == 1){
            booleanob = true;
        }
        check5thtest();
    });

    document.getElementById("fecha").addEventListener('input', function(event){
        if(event.target.value == formattedToday){
            booleanod = true;
        }
        check5thtest();
    });

    document.getElementById("hora").addEventListener('input', function(event){
        if(event.target.value >= currentTime && event.target.value <= sixMinutesFromNow){
            booleanoh = true;
        }
        check5thtest();
    });

}

function check5thtest(){
   
    
    if(booleanob && booleanoa){
        document.getElementById("span-test-5").innerHTML = "&#xf058;";
        document.getElementById("span-test-5").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";    
    }

   if(document.getElementById("therapy-name").value.toLowerCase() == "plan con reglas"){
            document.getElementById("span-test-3").innerHTML = "&#xf058;";
            document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";    
    }else{
        document.getElementById("span-test-3").innerHTML = "&#xf057;";
        document.getElementById("span-test-3").style = "font-family: Arial, FontAwesome;color:red; padding-right: 10px; padding-left: 10px;font-size:x-large;";
    }

    if(booleanoh && booleanod){
        document.getElementById("span-test-4").innerHTML = "&#xf058;";
        document.getElementById("span-test-4").style = "font-family: Arial, FontAwesome;color:green; padding-right: 10px; padding-left: 10px;font-size:x-large;";    
    }
}

function selectButton(div, button, inputid){
    var buttons = div.getElementsByTagName("button");
    document.getElementById(inputid).value = button.value;

    for(let i = 0; i<buttons.length; i++){
        buttons[i].className="rating-button";
    }

    button.className = "rating-button-selected";
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
]

function setUSEquestionare(){
    var divquestions = document.getElementById("use-div-questions");
    let html = ``;
    for(let i = 0; i<useQuestions.length; i++){
        html = `
            <div class="form-group" style="margin-top:30px; font-size:large !important;">
                <label for="i1">${i} - ${useQuestions[i]}</label>
                <div class="rating-buttons" >
                    <input type="hidden" name="q${i}" id="q${i}">
                    <button type="button" onclick="selectButton(this.parentNode, this, 'q${i}')" class="rating-button" value="1">1</button>
                    <button type="button" onclick="selectButton(this.parentNode, this, 'q${i}')" class="rating-button" value="2">2</button>
                    <button type="button" onclick="selectButton(this.parentNode, this, 'q${i}')" class="rating-button" value="3">3</button>
                    <button type="button" onclick="selectButton(this.parentNode, this, 'q${i}')" class="rating-button" value="4">4</button>
                    <button type="button" onclick="selectButton(this.parentNode, this, 'q${i}')" class="rating-button" value="5">5</button>
                </div>
            </div>
        `;
        divquestions.innerHTML += html;
    }
}

function sendUSE(){
    var lrequest = {};
    lrequest["name"] = "USE"
    for (let i = 0; i < 22; i++) {
        lrequest["q" + i] = document.getElementById("q" + i).value;
    }
    
    const request = JSON.stringify(lrequest); // Convertir a JSON
    
    fetch('/teststep/22', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: request
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        setNextStep();
    })
    .then(response => {
        console.log('Response from server:', response);
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });
    
    
    
}


function sendQuestions(namequestions, numberquestions){
    var lrequest = {};
    lrequest["name"] = namequestions
    for (let i = 0; i < numberquestions; i++) {
        lrequest["q" + i] = document.getElementById("q" + i).value;
    }
    
    const request = JSON.stringify(lrequest); // Convertir a JSON
    
    fetch('/teststep/'+numberquestions, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: request
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        setNextStep();
    })
    .then(response => {
        console.log('Response from server:', response);
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });
    
}

function getStep(){
        fetch('/getstep', {
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
            return response.text();
        })
        .then(data => {
            console.log('Response from server:', data);
            startTest(data);
            return data.json();
        })
        .catch(error => {
            console.error('There was an error with the request:', error);
        });
}

function addStep(){
    fetch('/addstep', {
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
    })
    .then(response => {
        console.log('Response from server:', response);
    })
    .catch(error => {
        console.error('There was an error with the request:', error);
    });  
}