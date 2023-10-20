@extends('main')

@section('patients_section') 

<head><title>HOME</title></head>

<div class="general-items-container">
<script src="{{ asset('general_page.js') }}"></script>
  
    <div class="home-welcome-box">
        <button class="home-welcome-box-btn-selected" onclick = "setArticles(0)" id="btn_pom_info">TAREAS</button>
        <button class="home-welcome-box-btn" onclick = "setArticles(1)" id="btn_app_info">AYUDA APLICACIÓN</button>
        <button class="home-welcome-box-btn" onclick = "setArticles(2)" id="btn_nos_option">SUGERENIAS</button>
    </div>

    <div class= "create-basic-container-home" id="pom_info">
        <div class="title-div-home">
            <h1> TAREAS </h1>
            <h4> Ayuda y soporte</h4>
        </div>
        <div class="text-div-home">
            <p>
                Cuando acabe las tareas, rellene el siguiente <a href="https://forms.gle/vZvypwLjoNV8YfAP6">formulario</a>.
            </p>
            <p>
                Las tareas a realizar consisten en cumplir el objetivo establecido, no hay limite de tiempo. Cuando crea que la ha completado o se queda atascado en algún paso, 
                seleccione el botón "ACABAR TAREA" que aparecerá en la parte inferior de la web. Para más comodidad se puede mostrar y ocultar la tarea a realizar.
            </p>

            <p>
                Cualquier duda o problema para iniciar las tareas contacta con el grupo Louise. Recuerde descargar el archivo JSON que se lanza cada vez que se finaliza una tarea.
            </p>
            
            <p></p>
        </div>
    </div>

    <div class= "create-basic-container-home" id="app_info" style="display:none;">
        <div class="title-div-home">
            <h1> Aplicación </h1>
            <h4> Ayuda y consejos</h4>
        </div>
        <div class="text-div-home">
            <p>
                Crea pacientes en la pestaña pacientes, junto al icono de dos usuarios en la barra de tareas. Por cada usuario creado, se añadirá una id y una información adicional, si cree que puede
                haber cualquier otra opción o configuración, escribanos sus comentarios.
            </p>
            <p></p>
        </div>
    </div>

    <div class= "create-basic-container-home" id="app_option" style="display:none;">
        <div class="title-div-home">
            <h1> SUGERENCIAS </h1>
            <h4> Deja tu sugerencia</h4>
        </div>
        <div class="text-div-home">
            <p>
                Deje aqui sus sugerencias o problemas que haya podido tener. En el <a href="https://forms.gle/vZvypwLjoNV8YfAP6">formulario</a> también podrá dejar reseñas y comentarios. Muchas gracias.
            </p>
            <textarea name="sugerencia" cols="80" style="width:100%;height:300px; margin-left:5%; margin-top:1%;" placeholder="Deje aqui sus sugerencias y/o comentarios"></textarea>
            <div style="justify-content:center; text-align:center;"><button class="create-button">Subir comentario</button></div>
            <p></p>
        </div>
    </div>
</div>

@endsection