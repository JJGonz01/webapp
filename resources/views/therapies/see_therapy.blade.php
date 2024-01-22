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
            <form action="{{route('downloadther', ['id' => $therapy -> id], false, true)}}" method="GET">
                    <button class="user-welcome-box-container-button" id="create-patient-button" >GUARDAR TERAPIA</button>
            </form>
            </div>
            <div class="user-welcome-box-container">
                <div class="home-welcome-box" style="margin-right:10px">
                    <button class="home-welcome-box-btn-selected" onclick = "setTabs(0)" id="btn_pom_info">BLOQUES DE TIEMPO</button>
                    <button class="home-welcome-box-btn" onclick = "setTabs(1)" id="btn_app_info">REGLAS CREADAS</button>
                    <button class="home-welcome-box-btn" onclick = "setTabs(2)" id="btn_nos_option">VER DETALLES</button>
                </div>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>

        <input style="display:none;"  value="{{$period->durations}}" id="periods_therapy"></input>
        <input style="display:none;"  value="{{$therapy->rules}}" id="rules_therapy"></input>


        <div id="app_info" style="display:none;">
                
        </div>  

        <div class = "options-items-container"  id="pom_info">
            
            <div id="output" class="text-therapies-info" style="padding-bottom:10px;">
                <h1 style="font-size: 50px;">Bloques de estudio de la terapia</h1>
                <br><br>

            </div>
        </div>

        <div id="app_info" style="display:none;">
                
            </div>  

        <div id="app_option" style="display:none;" class="buttons-container">
                
            
        </div>

</div>

<script src="{{asset('filter.js')}}"></script>
<script>
startFilter();
printElements();
transformarAHTML();
</script>

@endsection