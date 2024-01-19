@extends('main')

@section('patients_section') 

<head><title>HOME</title></head>

<div class="general-items-container">
<script src="https://www.pomodoro.ovh/general_page.js"></script>
  
        <div class="user-welcome-box">
            @if(auth()->user() !== null)
            
            <h4>General</h4>
            <div class="user-welcome-box-container">
                <div class="home-welcome-box">
                    <button class="home-welcome-box-btn-selected" onclick = "setArticles(0)" id="btn_pom_info">PRUEBAS</button>
                    <button class="home-welcome-box-btn" onclick = "setArticles(1)" id="btn_app_info">POMODORO</button>
                    <button class="home-welcome-box-btn" onclick = "setArticles(2)" id="btn_nos_option">APLICACIÓN</button>
                </div>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>


    <div class= "create-basic-container-home" id="pom_info">
    <div class="title-div-home">
            <h1> Prueba para rendimiento de la web </h1>
           
        </div>
        <div class="text-div-home"> <h4> ¿Qué se va a realizar en estas pruebas? </h4>
            <p>
                Durante estas pruebas, el usuario deberá realizar distintas tareas que suponen las principales funcionalidades de la página web. Esta plataforma, que
                comunicara con el reloj, debe ser probada para verificar que estamos siguiendo los pasos correctos y comprobamos la información adecuada. Para ello,
                queremos acercar distintas funcionalidades de monitorización y soporte al estudio a alumnos con trastorno por déficit de atención e hiperactividad.
            </p>
            <p>
                Cuando acabe las tareas, rellene el siguiente <a href="https://forms.gle/vZvypwLjoNV8YfAP6">formulario</a>.
            </p><h4> ¿En que consisten las tareas? </h4>
            <p>
                Las tareas a realizar consisten en cumplir el objetivo establecido, no hay limite de tiempo. El botón que encontrará abajo a la izquierda de su monitor le permitirá ir alternando entre
                el menú en el que se detalla la tarea y la aplicación web. Una vez acabado el test, deberá darle al botón "HE TERMINADO LA TAREA" y automáticamente se le descargará un archivo. Una vez lo
                descargue guardelo, y al acabar las tres tareas, envíelo al correo josejesus.gonzalez@uclm.es
            </p>

            <p>
                Cualquier duda o problema para iniciar las tareas contacta con el grupo Louise. Recuerde descargar el archivo JSON que se lanza cada vez que se finaliza una tarea.
            </p>
            
            <p></p><h4> Consejos </h4>
            <p>
                Crea pacientes en la pestaña pacientes, en la barra de tareas "Pacientes". Por cada usuario creado, se añadirá una id y una información adicional, si cree que se podría incluir
                cualquier otra opción o configuración, escribanos sus comentarios.
            </p>
            <p>
                Crea terapias en la pestaña terapias, en la barra de tareas "Terapias". Cada terapia tiene bloques de estudio, donde podrá editar un periodo de estudio y de descanso. Recuerde siempre guardar
                cuando cree o edite un bloque.
            </p>
            <p></p>
        </div>

        
    </div>

    <div class= "create-basic-container-home" id="app_info" style="display:none;">
        <div class="title-div-home">
            <h1> La técnica pomodoro </h1>
            <h4> Productividad al hacer tareas</h4>
        </div>
        <div class="text-div-home">
            <p>
                La técnica POMODORO es una metodología de estudio creada por Franchesco Cirillo en 1980, un experto
                en consultoría y coach de negocios, que cuando cursaba la universidad se repartía los tiempos de 
                estudios siguiendo este método a través de un temporizador con forma de tomate.

                La metodología consiste en repartir el estudio en intervalos de tiempo, denominados pomodoros, de entre
                15 y 30 minutos, en los que se busca que el estudiante se enfoque al completo en la tarea (sin interrupciones ni distracciones), intercalados con
                intervalos de descanso donde se relaje la mente y pueda volver a seguir trabajando evitando "burnouts" y 
                desgaste mental.
            </p>

            <p>
                Esta técnica posee distintas cualidades que permiten al estudiante, o persona que tenga que realizar una o varias tareas, disponer de positivos
                a la hora tanto de organizarse como de concentrarse. El objetivo principal de esta metodología es eliminar tanto la proclastinación como las distracciones que
                pueden surgir de la larga exposición a tareas poco interesantes para el estudiante. Para ello cabe destacar:
            </p>

            <ul>
                <li> <strong>Mejora de productividad</strong>: Al aprovechar más el tiempo empleado en las distintas tareas.</li>
                <li> <strong>Realizar más tareas en menos tiempo</strong>: Aumenta el tiempo efectivo al estar estudiando o realizando distintas tareas.</li>
                <li> <strong>Fijar rutinas</strong>: Permite a quien lo utilice poder organizarse de una manera más efectiva.</li>
                <li> <strong>Más implicación en las tareas</strong>: Al saber que hay descansos incentiva al usuario seguir trabajando hacia un objetivo a corto plazo.</li>
                <li> <strong>Mejora con el tiempo</strong>: Cuanto más se practica, más fácil es para el usuario realizar las distintas tareas y adaptarse al tiempo de estudio.</li>
            </ul>

            <p>
                En esta aplicación se busca implementar esta metododología en la vida diaria de alumnos de primaria que padecen Trastorno por Déficit de Atención e Hiperactividad (TDAH),
                quienes tienen problemas para concentrarse y conseguir finalizar tareas en la escuela. Para ello dispondrán de un dispositivo smartwatch que además de controlar sus tiempos, 
                medirá su estado anímico para poder así disponer de más información sobre estos jovenes y este trastorno de una manera poco invasiva.
            </p>

            <p></p>
        </div>
        
    </div>

    <div class= "create-basic-container-home" id="app_option" style="display:none;">
    <div class="title-div-home">
            <h1> Aplicación TDAH </h1>
            <h4> Organización y monitorización</h4>
        </div>
        <div class="text-div-home">
            <p>
                Esta aplicación web, junto al dispositivo <strong>smartwatch</strong>, busca facilitar tanto a terapeutas como profesores a poder mejorar el aprendizaje
                y organización temporal de alumnos que padecen Trastorno por Déficit de Atención e Hiperactividad (TDAH). Mediante esta plataforma el terapeuta podrá organizar los
                niños a su cargo, mediante un sistema de creación y control de "pacientes" de fácil manejo y uso. Para cada paciente podrá organizarles sesiones de estudio para la hora y fecha
                que mejor les convenga, y que automáticamente será enviado a su correspondiente dispositivo digital. Cuando llegue la hora de su sesión, sin necesidad de interacción, será
                el dispositivo quién avise y vaya organizando dicha sesión automáticamente.
            </p>

            <p>
                Para organizar estas sesiones de estudio el terapeuta podrá crear "terapias", donde se podrán configurar los intervalos de tiempo que tendrán las distintas sesiones asignadas al "paciente".
                En estas terapias se configurarán <strong>bloques</strong>, estos bloques representarán un intervalo de estudio y descanso, a excepción del primero que tendrá un periodo de estudio, otro de 
                descanso, y de nuevo otro de estudio, y a partir de este un descanso, seguido por un estudio y así iterativamente hasta que el terapueta crea conveniente.
            </p>

            
            <img src="{{asset('images/graph_bloques.png')}}" class="imageHome" alt="Grafico funcionamiento aplicacion" height="600">
            <span class="imageHomep">Figura 1: Esquema bloques de estudio</span></img>
            <p>
                En cada bloque el terapeuta podrá ajustar distintas condiciones, a partir de el estado anímico de del joven, para que según como se encuentre pueda realizar distintas acciones, como mensajes de ánimo,
                mensajes de tranquilidad, añadir o quitar tiempo de cada periodo del bloque, entre otros. Además se podrán ajustar para momentos especificos de cada bloque e incluso que no sea necesario que se cumplan ciertas
                condiciones. Estas reglas se configurarán por cada bloque, y serán personalizables para cada "paciente".
            </p>

            <p>
                En las reglas, como se ha comentado anteriormente, se podrán configurar condiciones. Se pueden definir tantas condiciones como condiguraciones pueda detectar el sensor, e incluso no añadir ninguna condición, 
                y se ejecutará en el momento en el que la regla se haya configurado para poder lanzarse. Se podrá elegir en que bloque se ejecutará, dentro de ese bloque, en que periodos (estudio y descanso), y dentro de esos periodos
                en que momento en el tiempo. Cuando se cumplan todas estas condiciones, se ejecutarán las acciones definidas por el terapeuta. Podrá configurar un mensaje que aparezca en el reloj y/o una acción de sesión, donde se puede
                añadir tiempo extra, concluir el periodo o concluir el bloque entero.
            </p>

            <img src="{{asset('images/graph_reglas.png')}}" class="imageHome" alt="Grafico funcionamiento aplicacion" height="600">
            <span class="imageHomep">Figura 2: Esquema reglas de la sesión</span></img>
            <p></p>
        </div>

            
        
    </div>
</div>

@endsection