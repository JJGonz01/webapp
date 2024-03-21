@extends('/patients/show_patient')
 
@section('session')

<head>
    <title>CREAR SESIÓN</title>
    <!-- Bootstrap JS (jQuery must be included before Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://pomodoro.ovh/JS/dashboards/patients/create-session.js"></script>
    <script src="https://pomodoro.ovh/JS/dashboards/patients/objectives/objectives.js"></script>

    <meta  name="date" id="date-start" content="{{ $date_start }}"></meta>
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients/create-session.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/dashboards/patients.css">
    <link rel="stylesheet" href="https://pomodoro.ovh/css/draws/clock.css">
</head>

</div>
<!-- Popup -->
<form id="objective_form" action="{{route('objetives_create',  ['patient_id' => $patient -> id], false, true)}}" method="POST">
    @csrf    
<div id="popup" class="popup">
        @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @if($errors->any())
            <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
        @endif
        <div class="popup-content popup-width-50">
            <div class="row">
                <div class="col-md-9">
                    <h2>Crear Objetivo para {{$patient->name}}</h2>
                </div>
                <div class="col-md-3 text-end align-button-right">
                    <button type="button" class="button-close" onclick="closePopup()">                        
                      <span>&#xf00d;</span>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 container-session-inputs" id="container-objective-one" style="display:block;">
                    <input style="display:none;" name="type" id="objective-type-input" value="study"></input>
                    <div class="form-row" id="type-selection-container">
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectType('objective-type-input', this, 'type-selection-container')" type="button" class="image-container-objective-w100" value="study">
                            <img class="rounded-image" src="https://pomodoro.ovh/images/bookmedal.jpg"></img>
                            <p>Objetivo de estudio</p>
                            </button>
                        </div>
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectType('objective-type-input', this, 'type-selection-container')"  type="button" class="image-container-objective-w100" value="personal">
                            <img class="rounded-image" src="https://pomodoro.ovh/images/personalmedal.jpg"></img>
                            <p>Objetivo personal</p>
                            </button>
                        </div>
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectType('objective-type-input', this, 'type-selection-container')"  type="button" class="image-container-objective-w100" value="scholastic">
                            <img class="rounded-image" src="https://pomodoro.ovh/images/schoolmedal.jpg"></img>
                            <p>Objetivo escolar</p>
                            </button>
                        </div>
                    </div>
                    

                    <div style="margin-left:5px" class="row container-session-gamification">
                            <span>&#xf2db;</span>
                            <p>Fecha del objetivo</p> <p class="text-description"></p>
                    </div>
                    <div class="form-row">
                        <div class="col-md-7" id="fecha-div">
                            <input class="input-session form-control" placeholder="Fecha y hora de la sesión" type="date" id="fecha" name="date_end"></input>
                        </div>
                        <div class="col-md-5" id="hora-div">
                            <input class="input-session form-control" placeholder="Fecha y hora de la sesión" type="time" id="hora" name="time_end"></input>
                        </div>
                    </div>

                    <input name="name" id="name-input" class="input-session form-control" placeholder="Nombre del objetivo"></input>
                    <textarea name="description" class="form-control" rows="3" placeholder="Descripción"></textarea>

                    <div class="float-end">
                        <button type="button" onclick="gotonextstep(0)" class="button-objective-next-step">Siguiente</button>
                        <button type="button" class="button-objective-cancel-step" onclick="closePopup()">Cancelar</button>
                    </div>
                </div>
 
                <div class="col-md-12 container-session-inputs" id="container-objective-two" style="display:none;">
                    <input style="display:none;" id="steps-input" name="steps" value="steps"></input>
                    <button type="button" class="button-objective-next-step" onclick="createMilestone()">Crear Hito</button>
                    <div class="milestones-container-list" id="milestones-list">
                        <div class="row milestone-container">
                            <h1 class="col-md-2">1</h1>
                            <div  class="col-md-4 milestone-container-div"><input class="input-session form-control" id = "input-1"; name="stepname" placeholder="Nombre del hito"></input></div>
                            <div  class="col-md-4 milestone-container-div"><input class="input-session form-control" name="stepcoment" placeholder="Comentario del hito"></input></div>
                        </div>

                    </div>
                    
                    <div class="float-end">
                        <button type="button" onclick="gotonextstep(1)" class="button-objective-next-step">Siguiente</button>
                        <button type="button" class="button-objective-cancel-step" onclick="gotolaststep(0)">Ir a paso anterior</button>
                    </div>
                </div>

                <div class="col-md-12 container-session-inputs" id="container-objective-three" style="display:none;">
                    <input style="display:none;" name="reward_type" id="reward-type-input" value="travel"></input>
                    <h3>Establece que recompensa se obtiene al conseguir el objetivo<h3>

                    <div  class="col-md-12 milestone-container-div">
                        <h4>Nombre de la recompensa</h4>
                        <input class="input-session form-control" id ="input-recompensa" name="reward_name" placeholder="Nombre de la recompensa">
                        </input>
                    </div> 
                    <div class="form-row" id="reward-selection-container">
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectRewardType('reward-type-input', this, 'reward-selection-container')" type="button" class="image-container-objective-w100" value="travel">
                            <img class="rounded-image" src="https://pomodoro.ovh/images/travel.png"></img>
                            <p>VIAJE</p>
                            </button>
                        </div>
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectRewardType('reward-type-input', this, 'reward-selection-container')"  type="button" class="image-container-objective-w100" value="present">
                            <img class="rounded-image" src="https://pomodoro.ovh/images/present.jpg"></img>
                            <p>REGALO</p>
                            </button>
                        </div>
                        <div class="col-md-4 container-objective-type">
                            <button onclick = "selectRewardType('reward-type-input', this, 'reward-selection-container')"  type="button" class="image-container-objective-w100" value="activity">
                            <img class="rounded-image" src="https://pomodoro.ovh/images/activity.jpg"></img>
                            <p>ACTIVIDAD</p>
                            </button>
                        </div>
                    </div>

                    <div class="float-end">
                        <button type="button" onclick = "saveAndSendObjective()" class="button-objective-next-step">Guardar</button>
                        <button type="button" class="button-objective-cancel-step" onclick="gotolaststep(1)">Ir a paso anterior</button>
                    </div>
                </div>
                
            </div>
            <!-- Botón para cerrar el popup -->
            
        </div>
    </div>
</form>

@endsection