@extends('main')

@section('patients_section') 

<head>
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients/create-patient.css">
</head>

<body>
<div style="overflow-y:auto; padding:20px;">
    <h1>¿Qué hemos construido? Descubre nuestra aplicación</h1>
    <div class="row container-general-patients" style="margin-bottom:30px;">
        <img class="col-3" src="https://pomodoro.ovh/images/eventcalendar.jpg"></img>
        <div class="col-md-9">
            <h3 style="margin-bottom:30px;">¿Qué es la técnica pomodoro?</h3>
            <p>
                La técnica Pomodoro es un método de gestión del tiempo que se centra en mejorar la productividad y la concentración al dividir el trabajo en intervalos de tiempo cortos, 
                llamados "pomodoros", seguidos de breves pausas. Esta técnica fue desarrollada por Francesco Cirillo a finales de la década de 1980 y toma su nombre de un temporizador de 
                cocina en forma de tomate (pomodoro en italiano) Esta técnica consiste en:
            </p>
            <ul>
                    <li>
                        <strong>Elegir una tarea a realizar:</strong> Selecciona una tarea específica que deseas completar.
                    </li>
                    <li>
                        <strong>Establecer el temporizador:</strong> Establecer la duración de los estudios, y de los descansos que se harán.
                    </li>
                    <li>
                        <strong>Trabajar en la tarea:</strong> Comenzar tarea, con el periodo de trabajo, se ha de concentrar en trabajar en la tarea seleccionada hasta que suene el temporizador.
                    </li>
                    <li>
                        <strong>Tomar un descanso corto:</strong> Una vez completado el periodo de trabajo,tomar ese descanso corto.
                    </li>
                    <li>
                        <strong>Repetir el proceso:</strong> Una vez completado el periodo de descanso,tomar ese descanso corto.
                    </li>
                    <li>
                        <strong>Repetir:</strong> La idea es repetir este proceso, tal vez con descansos más largos, hasta que se acabe la tarea o se haya estudiado mucho.
                    </li>
            </ul>
            <p>
                La técnica Pomodoro se basa en varios principios psicológicos y de gestión del tiempo, incluyendo la idea de que trabajar en intervalos cortos de tiempo puede ayudar a mantener
                 la concentración y a evitar la fatiga mental. También se enfoca en la importancia de tomar descansos regulares para mantener la energía y la motivación.
                Además de mejorar la productividad y la concentración, la técnica Pomodoro también puede ayudar a reducir la procrastinación y el estrés al dividir las tareas en segmentos más 
                manejables y al proporcionar un marco de tiempo claro para el trabajo y el descanso.
            </p>
            <p>
                En resumen, la técnica Pomodoro es una herramienta simple pero efectiva para mejorar la gestión del tiempo, aumentar la productividad y reducir el estrés, al dividir el trabajo
                en intervalos de tiempo definidos y tomar descansos regulares.
            </p>
        </div>
    </div>

    <div class="row container-general-patients" style="margin-bottom:40px;" >
        <div class="col-md-9">
            <h3 style="margin-bottom:30px;">¿Y por qué esta técnica? ¿En que puede beneficiar a niños con problemas de concentración, hiperactividad u otras?</h3>
            <p>La tecnica pomodoro, aunque simple, ayuda al estudiante a centrarse más en la tarea, gestionar mejor en tiempo y descansar la cabeza para evitar "burnouts.
                Algunas de las características que posee para ayudar a estudiantes que sufran de problemas de concentración, TDAH u otras son:
            </p>        
            <li>
                        <strong>Estructura y organización:</strong>  La técnica Pomodoro proporciona una estructura clara y 
                         organizada para el trabajo, lo que puede ayudar a los niños con TDAH a mantenerse enfocados y orientados
                         hacia una tarea específica durante un período de tiempo definido.
                    </li>
                    <li>
                        <strong>Gestión del tiempo:</strong>  La división del trabajo en intervalos de tiempo cortos facilita 
                         la gestión del tiempo y evita la sensación abrumadora que puede experimentar un niño con TDAH al enfrentarse a una tarea extensa.
                         Saber que solo tienen que trabajar durante un período corto de tiempo antes de tomar un descanso puede hacer que la tarea parezca más manejable.
                    </li>
                    <li>
                        <strong>Descansos regulares:</strong>  Los descansos cortos entre cada pomodoro permiten a los niños con TDAH recargar energías y 
                        mantener su nivel de concentración. Estos descansos proporcionan oportunidades para moverse, estirarse y tomar aire fresco, 
                        lo que puede ayudar a reducir la impulsividad y la inquietud asociadas con el TDAH.
                    </li>
                    <li>
                        <strong>Sensación de logro:</strong>  Completar cada pomodoro y marcar el progreso realizado puede proporcionar una 
                        sensación de logro y motivación adicional para los niños con TDAH, lo que les ayuda a mantenerse comprometidos con la tarea a largo plazo.
                    </li>
                </ul>
                <p>
                    Y por eso, la técnica Pomodoro puede ser beneficiosa para niños con TDAH ya que proporciona una estructura clara, 
                    gestionar el tiempo de manera efectiva, permite descansos regulares y fomenta una sensación de logro gradual a medida que completan cada intervalo de trabajo.
                </p>
        </div>
        <img class="col-3" src="https://pomodoro.ovh/images/timeman.png"></img>
    </div>

    <div class="row container-general-patients" style="margin-bottom:40px;" >
        <img class="col-3" src="https://pomodoro.ovh/images/childream.png"></img>
        <div class="col-md-9">
            <h3 style="margin-bottom:30px;">¿Y cómo damos ese extra de motivación?</h3>

                <p>
                    Mediante un sistema de puntos (llamados estrellas), canjeables en un avatar virtual al que tendrá que cuidar el estudiante.
                    Cuidar de un avatar virtual que se alimenta con los puntos que ganas mientras estudias puede ser beneficioso por varias razones, 
                    especialmente para niños con TDAH u otros desafíos de atención
                </p>
                <p>¿Y en que puede beneficiar a estudiantes con problemas de concentración, hiperactividad u otras?</p>
                <ul>
                    <li>
                        <strong>Motivación adicional:</strong>  Tener un avatar virtual que necesita 
                        ser alimentado proporciona una motivación adicional para estudiar y completar tareas.
                        Los niños pueden sentirse más comprometidos con su trabajo sabiendo que también están cuidando de su avatar.
                    </li>
                    <li>
                        <strong>Responsabilidad y rutina:</strong>  
                        Cuidar de un avatar virtual puede ayudar a los niños a desarrollar un sentido de responsabilidad al mantener una rutina diaria para estudiar 
                        y alimentar al avatar.
                        Esto puede ser especialmente útil para establecer hábitos de estudio consistentes.
                    </li>
                    <li>
                        <strong>Refuerzo positivo:</strong>  Al alimentar al avatar virtual como una recompensa por estudiar, 
                        se establece un refuerzo positivo para el comportamiento académico deseado. 
                        Esto puede ayudar a mejorar la autoestima y la autoeficacia de los niños, ya que experimentan el éxito al completar tareas y cuidar de su avatar.
                    </li>
                    <li>
                        <strong>Sensación de logro:</strong>  Ver el avatar virtual crecer y prosperar a medida que se alimenta puede proporcionar 
                        una forma visual y tangible de seguir el progreso en el estudio. Esto puede ayudar a los niños a mantenerse enfocados en sus metas académicas a largo plazo.
                     </li>

                     <li>
                        <strong>Reducción del estrés y ansiedad:</strong>  Cuidar de un avatar virtual puede ser una actividad relajante y divertida para los niños,
                         lo que puede ayudar a reducir el estrés y la ansiedad relacionados con el estudio.
                         Proporciona una pausa mental entre sesiones de estudio intensivas y puede ayudar a mantener un equilibrio saludable entre el trabajo y el juego.
                     </li>
                </ul>
                <p>
                    Y por eso, la técnica Pomodoro puede ser beneficiosa para niños con TDAH ya que proporciona una estructura clara, gestionar el tiempo de manera efectiva, permite descansos regulares y fomenta una sensación de logro gradual a medida que completan cada intervalo de trabajo.
                </p>
        </div>
       
    </div>
</div>
</body>

@endsection