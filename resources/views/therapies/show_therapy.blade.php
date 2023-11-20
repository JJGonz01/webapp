@extends('main')
@section('patients_section')

<head>
    <title>VER TERAPIA | {{$therapy->name}}</title>
</head>


<div class= "general-items-container">

    <div>
        <script src="{{ asset('therapy.js') }}"></script>

        <div class="user-welcome-box">
        @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif
            @if($errors->any())
                <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
            @endif

            @if(auth()->user() !== null)
            <div class="user-welcome-box-container">
            <h4>{{$therapy-> name}}</h4>
            
            </div>
            <div class="user-welcome-box-container">
                <div class="home-welcome-box" style="margin-right:10px">
                    <button class="home-welcome-box-btn-selected" onclick = "setTabs(0)" id="btn_pom_info">BLOQUES DE TIEMPO</button>
                    <button class="home-welcome-box-btn" onclick = "setTabs(1)" id="btn_app_info">REGLAS CREADAS</button>
                </div>
                <div class="left-option">
                    <button class="home-welcome-box-btn" onclick = "setTabs(2)" id="btn_nos_option">EDITAR TERAPIA</button>
                </div>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>

        <input style="display:none;"  value="{{$period->durations}}" id="periods_therapy"></input>
        <div class = "options-items-container"  id="pom_info">
            
            <div id="output" class="text-therapies-info" style="padding-bottom:10px;">
                <h1 style="font-size: 50px;">Bloques de estudio de la terapia</h1>
                <br><br>

            </div>
        </div>

        <div id="app_info" style="display:none;">
                
            </div>  

            <div id="app_option" style="display:none;" class="buttons-container">
                <form action="{{route('therapy_update', ['id' => $therapy -> id], false, true)}}" id = "editar_form" method = "GET">
                    <button style="background-color:#b5dada;" id="show_ther_edit_button">
                        Ir a editar terapia
                    </button>
                </form>

                <form action="{{route('therapy_destroy', [$therapy->id], false, true)}}" id = "eliminar_form" method = "POST">
                <script>
                        //SCRIPT QUE HACE QUE SALTE EL POPUP PARA CONFIRMAR (LO PONGO AQUI PARA NO CREAR MAS js)
                        document.getElementById('eliminar_form').addEventListener("submit", (e) => {
                            e.preventDefault();
                            console.log("hola")
                            if(window.confirm("Va a eliminar a este paciente ¿está seguro? (no podrá rehacer los cambios)")){
                                document.getElementById('eliminar_form').submit();
                            }else{
                            return false;
                            }
                        });
                </script>  
                    <div>
                        @method('DELETE')
                        @csrf
                        <button style="background-color:red;"  id="show_ther_delete_button" type="submit">
                            Borrar terapia
                        </button>
                
                    </div>
                        
                </form>
            </div>
        <script>
            function printElements(){
                var periodos = document.getElementById("periods_therapy").value;
                var outputDiv = document.getElementById("output");
                var jsonObject = JSON.parse(periodos);
                var per = 0;
                var perMax = 3;
                var bloque = 0;
                var keys = ["Estudio", "Descanso", "Estudio"];
                jsonObject.forEach(function(item){
                        bloque += 1;
                        var div = document.createElement("div");
                        div.classList.add("flex-text-row"); 
                        var h = document.createElement("p");
                        h.style.color = "black";
                        h.style.fontWeight  = "bold";
                        h.textContent = "Bloque "+bloque+":";
                        div.appendChild(h);
                        per = 0;
                        for (var key in item) { 
                            var pElement = document.createElement("p");
                            pElement.style.color = "black";
                            pElement.textContent = keys[per] + ": " + item[key]+" minutos";
                            div.appendChild(pElement);
                            per += 1;
                        }
                        outputDiv.appendChild(div);
                    });
                }
            printElements();
        </script>
</div>

<script src="https://pomodoroadhdapp.azurewebsites.net/filter.js"></script>
<script>startFilter()</script>

@endsection