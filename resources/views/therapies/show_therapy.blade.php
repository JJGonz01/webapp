@extends('main')
@section('patients_section')

<head>
    <title>VER TERAPIA | {{$therapy->name}}</title>
</head>


<div class= "general-items-container">

    <div>
        <script src="{{ asset('therapy.js') }}"></script>
        <script src="{{ asset('interactions/buttons.js') }}">
            
            init('esta terapia')
        </script>


        <div class="patient-info-box">
            <div>
                    <p> Terapia: {{$therapy -> name}}</p>
                    <p> Terapia de estudio </p>
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

        <div class = "options-items-container">
                        
        </div>


</div>

@endsection