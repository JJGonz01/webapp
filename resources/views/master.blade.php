<!DOCTYPE html>
<html lang="en">
<html>

<head>
        <link rel="stylesheet" href="https://www.pomodoro.ovh/styles/CSS/tests.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <script src="https://www.pomodoro.ovh/tests/tests.js">
    </script>
    @if(null != (auth()->user()))
       <div id="no-task-container" style="display:none;" class="menu-master-container">
               
               <div  class="menu-container">
                    <div class="test-top-menu">
                        <button id="task_start_button" onclick = "startTask()" class="start-button">X</button>
                        <button id="task_go_last" onclick = "goToLastTask()" class="go-back-button">VOLVER A TAREA ANTERIOR</button>
                    </div>
                    <div>
                       <h1 class="test-container-task" style="color:black;" id="task_test"></h1> 
                       <h3 id="h3-final">
                           Realice la tarea, y cuando crea que esté completa (o se vea atascado) pulse "ACABAR TAREA" y DESCARGUE el archivo, cuando acabe
                           todas las tareas, envíelos de vuelta a josejesus.gonzalez@uclm.es
                       </h3>
                        
                   </div>

                   
                   <button id="task-end-btn" onclick="endTask()" class="acabar-tarea-btn">HE TERMINADO LA TAREA</button>
               </div>
       </div>
       
       <div class="sticky-button">
           <button id="nav_bar_info" onclick="showhidetext()" >TAREA
           </button>
       </div>
   @endif
   <div class="slave-test">
       @yield('login')
   </div>

</body>
</html>