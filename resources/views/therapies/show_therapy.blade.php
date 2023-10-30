@extends('main')
@section('patients_section')

<head>
    <title>VER TERAPIA | {{$therapy->name}}</title>
</head>


<div class= "general-items-container">

    <div>
        <script src="{{ asset('therapy.js') }}"></script>


       


        <div class="patient-info-box">
            <div>
                    <p> Terapia: {{$therapy -> name}}</p>
                    <p> Terapia de estudiao </p>
            </div>

            <div>
                <form action="{{route('therapy_update', ['id' => $therapy -> id])}}" id = "editar_form" method = "GET">
                    <button id="show_ther_edit_button" class="patient-edit-button">
                        EDITAR
                    </button>
                </form>

                <form action="{{route('therapy_destroy', [$therapy->id])}}" id = "eliminar_form" method = "POST">
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
                        <button id="show_ther_delete_button" type="submit" class="patient-delete-button">
                            BORRAR
                        </button>
                
                    </div>
                        
                </form>
            </div>  
        </div>

        <input style="display:none;"  value="{{$period->durations}}" id="periods_therapy"></input>
        <div class = "options-items-container" >
            
            <div id="output" class="text-therapies-info">
                <h1 style="font-size: 50px;">Bloques de estudio de la terapia</h1>
                <br><br>

            </input>
        </div>

        <script>
            function printElements(){
                var periodos = document.getElementById("periods_therapy").value;
                var outputDiv = document.getElementById("output");
                var jsonObject = JSON.parse(periodos);
                console.log(periodos)
                var per = 0;
                var perMax = 3;
                var bloque = 0;
                var keys = ["Estudio", "Descanso", "Estudio"];
                
                
                jsonObject.forEach(function(item) {
                        console.log("sss")
                        bloque += 1;
                        var div = document.createElement("div");
                        div.classList.add("flex-text-row"); 
                        var h = document.createElement("h2");
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

@endsection