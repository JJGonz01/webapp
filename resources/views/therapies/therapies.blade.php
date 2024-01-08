@extends('main')

@section('patients_section')

<head>
    <title>TERAPIAS</title>
</head>

<div class="general-items-container">

        <script></script>
        @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @error('name')
            <h6 class="alert alert-danger"> {{ $message }}</h6>
        @enderror

        <div class="user-welcome-box">
            @if(auth()->user() !== null)
            <div class="user-welcome-box-container">
                <h4>Terapias</h4>
                <form action = "{{route('therapies_create', [], false, true)}}" method = "GET">
                    <button class="user-welcome-box-container-button" id="create-therapy-btn">CREAR TERAPIA</button>
                </form>
            </div>
            <div class="user-welcome-box-container">
            <div class="home-welcome-box">
                <button class="home-welcome-box-btn-selected" id="btn_pom_info" onclick="sortTable(0)">TODOS</button>
                <button class="home-welcome-box-btn" id="btn_app_info" onclick="sortTable(1)">NOMBRE</button>
                <button class="home-welcome-box-btn" id="btn_nos_option" onclick="sortTable(2)">REGLAS</button>
                
                </div>
                <button class="home-welcome-box-btn" id="btn_pom_info" onclick="filtrarPacientes('')">Limpiar Filtro</button>
                <input class="home-welcome-box-input" id="filter-input" placeholder="Buscar"></input>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>

        <div class = "options-items-container">
            
            <div  class="options-items-container-inner">
                @if(count($therapies)>0)
                <table class="table-items-options">
                    <tr class ="top-index-container">
                        <th>ID</th> 
                        <th>NOMBRE</th> 
                        <th>REGLAS</th>
                        <th>ACCEDER</th> 
                    </tr>
                    <div id="patient-list" class="table-items-options-overflow">
                        
                            @foreach ($therapies as $therapy)
                            <tr> 
                                <td>{{$therapy -> id}}  </td>
                                <td>{{$therapy -> name}} </td>
                                
                                <td>
                                @if($therapy->rules != "\"empty\"")
                                    Con reglas
                                @else
                                    Sin reglas
                                @endif
                                </td>
                                <td> 
                                    <form action="{{route('therapy_show', ['id' => $therapy -> id], false, true)}}" method = "GET">
                                        <div>
                                        <button id="ther_index_edit_button" type="submit" class="edit-button">
                                            Acceder
                                        </button>
                                        </div>
                                    </form>
                                </td>
                            </tr> 
                            @endforeach

                    </div>
                </table>
                @else
                            <h1 style="color: #0E456; font.weight: bold;">No hay terapias creadas</h2>
                @endif
            </div>

        </div>
    
</div> 
<script src="{{asset('filter.js')}}"></script>
<script>startFilter()</script>
@endsection
