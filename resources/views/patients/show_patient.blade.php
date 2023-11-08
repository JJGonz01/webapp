
@yield('session')

@extends('main')
@section('patients_section')
<head>
    <title>EDITAR | {{$patient->name}}</title>
</head>

<div class="general-items-container">
        
        <script src="https://pomodoroadhdapp.azurewebsites.net/session/sessionClassfication.js"></script>
        <script src="https://pomodoroadhdapp.azurewebsites.net/therapy_js/period_creations.js"></script>
        <script src="https://pomodoroadhdapp.azurewebsites.net/therapy_js/rule.js"></script>

        @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @if($errors->any())
            <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
        @endif

        <div class="patient-info-box">
            <img src="https://pomodoroadhdapp.azurewebsites.net/images/hijo.png" style="color:white;" class="right-login-container-image"></img>
            <div>
                    <p> Paciente: {{$patient -> name}}  {{$patient -> surname}}</p>
                    <p> Comment: {{$patient -> description }}</p>
            </div>

            <div>
                <form action="{{route('patient_update', ['id' => $patient -> id])}}"id = "editar_form" method = "GET">
                    <button id="edit_patient_shown_btn" class="patient-edit-button" href = "{{route('patient_update', ['id' => $patient -> id])}}">
                            Editar
                    </button>
                </form>
                <form action="{{route('patient_destroy', [$patient->id])}}" id = "eliminar_form" method = "POST">
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
                        <button id="delete_patient_shown_btn" type="submit" class="patient-delete-button">
                            Borrar
                        </button>
                
                    </div>
                        
                </form>
            </div>  
        </div>

        <div class = "options-items-container">
        <a class="create-button" onclick="printClickedId(this)" id="create-session-button" href = "{{route('sessions_create', ['patient_id' => $patient -> id], false, true)}}">
                            CREAR SESIÓN
            </a>
            <div class="choice-selection-container">
                    <button id="session_pending_tab_patient" class="session-filter-button" style = "background-color:var(--container-session-selected-color)"  type = "button" onclick="showSessionCompleted(false)">Pendientes</button>     
                    <button id="session_completed_tab_patient" class="session-filter-button" type = "button" onclick="showSessionCompleted(true)" style="background-color: var(--container-session-show-color);">Completadas</button>
            </div>
            <div class="table-hide-show-container" id ="notCompleted_sessions">
                    @if(count($sessions)>0)
                    <table class="table-items-options">
                        <tr class ="top-index-container">
                            <th>ID</th> 
                            <th>Fecha inicio</th> 
                            <th>Editar</th> 
                            <th>Borrar</th>
                        </tr>
                        <div class="table-items-options-overflow">
                            
                                @foreach($sessions as $ses)
                                @if($ses->completed == false)
                                <tr> <!--class="all-patient-button" href = "{{route('patient_show', ['id' => $patient -> id])}}"-->
                                    <td>{{$ses -> id}}  </td>
                                    <td>{{$ses -> date_start}} </td>
                                    <td> <form action = "{{route('session_edit', ['id' => $ses -> id], false, true)}}" method="GET"> <button class="edit-button" id="session-show-button">Editar</button> </form> </td>
                                    <td> 
                                        <form id="session-delete-form" action="{{route('session_destroy', ['id'=> $ses->id, 'patient_id' => $patient->id], false, true)}}" method = "POST">
                                            <div>
                                                @method('DELETE')
                                                @csrf
                                                
                                                <script>
                                                            //SCRIPT QUE HACE QUE SALTE EL POPUP PARA CONFIRMAR (LO PONGO AQUI PARA NO CREAR MAS js)
                                                            document.getElementById('session-delete-form').addEventListener("submit", (e) => {
                                                                e.preventDefault();
                                                                console.log("hola")
                                                                if(window.confirm("Va a eliminar a este paciente ¿está seguro? (no podrá rehacer los cambios)")){
                                                                    document.getElementById('session-delete-form').submit();
                                                                }else{
                                                                return false;
                                                                } 
                                                            });
                                                    </script> 
                                                <button id="delete_session_patient_delete" class="edit-button" style="background-color:#B90000;">
                                                    Borrar
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr> 
                                @endif
                                @endforeach
                        </div>
                    </table>
                    @else
                            <tr><h1>No hay sesiones pendientes</h1></tr>
                    @endif
            </div>
            <div class="table-hide-show-container" id ="completed_sessions" style = "display:none">
                    @if(count($sessions)>0)
                    <table class="table-items-options">
                        <tr class ="top-index-container">
                            <th>ID</th> 
                            <th>Fecha inicio</th> 
                            <th>Editar</th> 
                            <th>Borrar</th>
                        </tr>
                        <div class="table-items-options-overflow">
                            @foreach($sessions as $ses)
                            @if($ses->completed == true)
                            <tr> <!--class="all-patient-button" href = "{{route('patient_show', ['id' => $patient -> id])}}"-->
                                <td>{{$ses -> id}}  </td>
                                <td>{{$ses -> date_start}} </td>
                                <td> <form action = "{{route('session_show', ['id' => $ses -> id], false, true)}}" method="GET"> <button class="edit-button" id="session-show-button">Ver</button> </form> </td>
                                <td> 
                                    <form action="{{route('session_destroy', ['id'=> $ses->id, 'patient_id' => $patient->id], false, true)}}" method = "POST">
                                        <div>
                                            @method('DELETE')
                                            @csrf
                                            <button id="delete_patient_show" class="edit-button" style="background-color:#B90000;">
                                                Borrar
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr> 
                            @endif
                            @endforeach
                        </div>
                    </table>
                    @else
                            <tr><h1>No hay sesiones completadas</h1></tr>
                    @endif
            </div>
        </div>

        
        
</div>
@endsection