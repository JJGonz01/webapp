@extends('main')
@section('patients_section')

<head>
    <title>VER TERAPIA | {{$therapy->name}}</title>
</head>


<div class= "general-items-container">

    <div>
        <script src="https://www.pomodoro.ovh/therapy_js/menus_terapia.js"></script>

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
            @if($therapy->uploaded)
            <form action="{{route('removether', ['id' => $therapy -> id], false, true)}}" method="GET">
                    <button class="user-welcome-box-container-button" id="create-patient-button" >QUITAR TERAPIA DE LA RED</button>
            </form>
            @else
            <form action="{{route('uploadther', ['id' => $therapy -> id], false, true)}}" method="GET">
                    <button class="user-welcome-box-container-button" id="create-patient-button" >PUBLICAR TERAPIA</button>
            </form>
            @endif
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
        <input style="display:none;"  value="{{$therapy->rules}}" id="rules_therapy"></input>

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
                    <button style="background-color:#fff;" id="show_ther_edit_button">
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
                        <button style="background-color:#c23c3c;font-weight:bold;"  id="show_ther_delete_button" type="submit">
                            Borrar terapia
                        </button>
                
                    </div>
                        
                </form>
            </div>

</div>

<script src="https://www.pomodoro.ovh/filter.js"></script>
<script>
startFilter();
printElements();
transformarAHTML();
</script>

@endsection