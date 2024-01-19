
@yield('session')

@extends('main')
@section('patients_section')
<head>
    <title>EDITAR | {{$patient->name}}</title>
</head>

<div class="general-items-container">
        
        <script src="https://www.pomodoro.ovh/session/sessionClassfication.js"></script>
        <script src="https://www.pomodoro.ovh/therapy_js/period_creations.js"></script>
        <script src="https://www.pomodoro.ovh/therapy_js/rule.js"></script>

        <div class="user-welcome-box">
        @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif
            @if($errors->any())
                <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
            @endif

            @if(auth()->user() !== null)
            <div class="user-welcome-box-container">
                <h4>{{$patient-> surname}}, {{$patient-> name}}</h4>
                <form action="{{route('sessions_create', ['patient_id' => $patient -> id], false, true)}}" method="GET">
                    <button class="user-welcome-box-container-button" id="create-patient-button">AÑADIR SESIÓN</button>
                </form>
            </div>
            <h5>Id del paciente: {{$patient-> id}}</h5>
           
            @if(!empty($patient->description))
                 <h5>Comentario: {{$patient->description}}</h5>
            @endif
            <div class="user-welcome-box-container">
                <div class="home-welcome-box" style="margin-right:10px">
                    <button class="home-welcome-box-btn-selected" onclick = "setTabs(0)" id="btn_pom_info">SESIONES PENDIENTES</button>
                    <button class="home-welcome-box-btn" onclick = "setTabs(1)" id="btn_app_info">SESIONES COMPLETADAS</button>
                </div>
                <div class="left-option">
                    <button class="home-welcome-box-btn" onclick = "setTabs(2)" id="btn_nos_option">EDITAR PACIENTE</button>
                </div>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>

        <div class = "options-items-container" >
            <div class="table-hide-show-container" id="pom_info">
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
            <div class="table-hide-show-container" id="app_info" style="display:none;">
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

            <div class="table-hide-show-container" id="app_option" style="display:none;">
                <form action="{{route('patient_complete_update', [$patient->id], false, true)}}" id= 'form_pat' method="POST">
                    @csrf
                    @if (session('success'))
                        <h6 class="alert alert-success"> {{ session('success') }}</h6>
                    @endif

                    @error('name')
                        <h6 class="alert alert-danger"> Falta nombre: {{ $message }}</h6>
                    @enderror

                    @error('surname')
                        <h6 class="alert alert-danger"> Falta apellido: {{ $message }}</h6>
                    @enderror
                    <div>
                        <h3>Editar Paciente</h3>
                        <p>NOMBRE</p>
                        <input type="text" value="{{$patient->name}}" name = "name" id = "name" class = "create-basic-container-inputs">

                        <p>APELLIDOS</p>
                        <input type="text" value="{{$patient->surname}}" name = "surname" id = "surname" class = "create-basic-container-inputs">

                        <p>COMENTARIO</p>
                        <textarea type="text" value="{{$patient->description}}" name = "description" id="commentary" class = "text-area-container" rown="10">{{$patient->description}}</textarea>
                        <button class="edit-button" id="go_to_patient_create" type="submit"> EDITAR </button>    
                    </form>        
                <div>
                
                     
                    <form action="{{route('patient_destroy', [$patient->id], false, true)}}" id = "eliminar_form" method = "POST">
                        <div>
                            @method('DELETE')
                            @csrf
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
                            <button id="delete_patient_shown_btn" type="submit" class="rm-button">
                                Borrar
                            </button>
                    
                        </div>
                            
                    </form>
                </div>
                </div>
                     
            </div>
        </div>

        
        
</div>

<script src="{{asset('filter.js')}}"></script>
<script>startFilter()</script>
@endsection