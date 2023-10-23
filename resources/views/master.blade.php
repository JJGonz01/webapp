<!DOCTYPE html>
<html lang="en">
<html>

<head>
        <link rel="stylesheet" href="{{ asset('styles/CSS/tests.css') }}">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <script src="https://pomodoroadhdapp.azurewebsites.net/tests/tests.js">
    </script>
    @if(null != (auth()->user()))
        <div id="no-task-container" style="display:none;" class="menu-master-container">
                <div  class="menu-container" >
                    <div>
                        <h1 style="color:white;" id="task_test"></h1> 
                        <h3 style="color:white; font-style:oblique">Realice la tarea, y cuando esté completa (o se vea atascado) pulse "ACABAR TAREA" y DESCARGUE el archivo, cuando acabe
                            todas las tareas, envíelos de vuelta a josejesus.gonzalez@uclm.es
                        </h3>
                         
                    </div>

                    <button id="task_start_button" onclick = "startTask()" class="start-button">COMENZAR TAREA</button>
                </div>
        </div>


        <div class="master-test">
       
            <div id="in-task-container" class="in-row-container" style="display:block;">
                <button id="task-show-btn" onclick="showhidetext()" class="acabar-tarea-btn">OCULTAR TAREA</button>
                <p id="in-task-text" style="style:block;"></p>
                <button id="task-end-btn" onclick="endTask()" class="acabar-tarea-btn">ACABAR TAREA</button>
            </div>
        </div>
    @endif
    <div class="slave-test">
        @yield('login')
    </div>

</body>
</html>