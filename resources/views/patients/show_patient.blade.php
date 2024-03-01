
@yield('session')

@extends('main')
@section('patients_section')
<head>
    <title>EDITAR | {{$patient->name}}</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{asset('/JS/dashboards/patients/calendar.js')}}"></script>
    <meta  name="sessions" id="sessions-value" content="{{ $sessions }}"></meta>
    <meta  name="patients" id="patient-value" content="{{ $patient -> id }}"></meta>
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/patient-menu.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dashboards/patients/calendar.css')}}">
</head>

@if (session('success'))
    <h6 class="alert alert-success"> {{ session('success') }}</h6>
@endif
@if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 container-patient-slim">
            <div class="row align-items-center container-fluid">
                <div class="col-md-5">
                    <img id="profile-image" src="{{asset('images/perfil.png')}}"></img>
                </div>
                <div class="col-md-7">
                    <h5 class="text-center">{{$patient-> surname}}, {{$patient-> name}}</h5>
                </div>
            </div>

            <div class="container-content-patient">
                <p class="text-title-two">Comentario</p>
                <p>{{$patient->description}}</p>
            </div>

            <div class="container-content-patient">
                <p class="text-title-two">Detalles</p>
                <div class="content-subtitle">
                    <p class="text-subtitle">Tags</p>
                    <p>TBD</p>
                </div>
                <div class="content-subtitle">
                    <p class="text-subtitle">Número de contacto</p>
                    <p>222 22 22 22 </p>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <div class="container-fluid container-patient-slim">
                <div class="container-padding">
                    <div class="row container-margin-bottom">
                        <div class="col-md-10">
                            <p class="text-title-one">Cronograma</p>
                        </div>

                        <div class="col-md-2">
                            <div class="row" id="btn-add-session">
                                <form action="{{route('sessions_create', ['patient_id' => $patient -> id], false, true)}}" method="GET">
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" class="button-add"><span class="fa-regular fa-plus"> Añadir</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="calendar" id="calendar"></div>
                    <div style="display:none;" class="row container-calendar-row">
                        <button class="col-mg-12"><span id="monday">21</span><span>Lun</span></button>
                        <button class="col-mg-12"><span id="tuesday">22</span><span>Mar</span></button>
                        <button class="col-mg-12"><span id="wendsday">23</span><span>Mie</span></button>
                        <button class="col-mg-12"><span id="thrusday">24</span><span>Jue</span></button>
                        <button class="col-mg-12"><span id="friday">25</span><span>Vie</span></button>
                        <button class="col-mg-12"><span id="saturday">26</span><span>Sab</span></button>
                        <button class="col-mg-12"><span id="sunday">27</span><span>Dom</span></button>
                    </div>
                        
                    <div class="container-sesiones">
                        <p class="text-title-two">Sesiones programadas</p>
                        <div>
                            <table class="table">
                                <tr class ="top-index-container">
                                    <th scope="col"><input type="checkbox" value="-1" id="checkbox1"></th> 
                                    <th scope="col">Título</th> 
                                    <th scope="col">Fecha inicio</th> 
                                    <th scope="col">Acciones</th>
                                    <th scope="col">Acciones</th>
                                </tr>

                                @foreach($sessions->take(15) as $ses)
                                @if($ses->completed == true)
                                <tr>
                                    <td scope="row"><input type="checkbox" value="{{$ses->id}}" id="checkbox1"></td>
                                    <td scope="row">{{$ses -> name}}</td>
                                    <td>{{$ses -> date_start}} {{$ses -> time_start}}</td>
                                    <td> <form action = "{{route('session_edit', ['id' => $ses -> id], false, true)}}" method="GET"> <button class="edit-button" id="session-show-button">Editar</button> </form> </td>
                                    <td> <form action = "{{route('session_show', ['id' => $ses -> id], false, true)}}" method="GET"> <button class="edit-button" id="session-show-button">Ver</button> </form> </td>
                                </tr> 
                                @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- div class="general-items-container">
        
        <script src="https://www.pomodoro.ovh/session/sessionClassfication.js"></script>
        <script src="https://www.pomodoro.ovh/therapy_js/period_creations.js"></script>
        <script src="https://www.pomodoro.ovh/therapy_js/rule.js"></script>

        <div class="user-welcome-box">
        

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
                            <th>Fecha inicio</th> 
                            <th>Editar</th> 
                            <th>Borrar</th>
                        </tr>
                        <div class="table-items-options-overflow">
                            
                                @foreach($sessions as $ses)
                                @if($ses->completed == false)
                                <tr> class="all-patient-button" href = "{{route('patient_show', ['id' => $patient -> id])}}">
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
                            <tr> class="all-patient-button" href = "{{route('patient_show', ['id' => $patient -> id])}}"
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

        
        
                        </div-->
@endsection