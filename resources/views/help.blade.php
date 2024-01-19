@extends('main')

@section('patients_section') 

<head><title>FORO</title></head>

<div class="general-items-container">
<script src="https://www.pomodoro.ovh/general_page.js"></script>
  
<div class="user-welcome-box">

<h4>Terapias publicadas</h4>
<div class="user-welcome-box-container">
    <div class="home-welcome-box">
        <button class="home-welcome-box-btn-selected" id="btn_pom_info" onclick="sortTable(0)">TODOS</button>
        <button class="home-welcome-box-btn" id="btn_app_info" onclick="sortTable(1)">NOMBRE TERAPIA</button>
        <button class="home-welcome-box-btn" id="btn_nos_option" onclick="sortTable(2)">AUTOR</button>
                
    </div>

    <button class="home-welcome-box-btn" id="btn_pom_info" onclick="filtrarPacientes('')">Limpiar Filtro</button>
    <input class="home-welcome-box-input" id="filter-input" placeholder="Buscar"></input>
</div>

   
<div class = "options-items-container">
            
            <div  class="options-items-container-inner">
                @if(count($therapies)>0)
                <table class="table-items-options">
                    <tr class ="top-index-container">
                        <th>ID</th> 
                        <th>NOMBRE</th> 
                        <th>AUTOR</th>
                        <th>ACCEDER</th> 
                    </tr>
                    <div id="patient-list" class="table-items-options-overflow">
                        
                            @foreach ($therapies as $therapy)
                            <tr> 
                                <td>{{$therapy -> id}}  </td>
                                <td>{{$therapy -> name}} </td>
                                <td>{{$therapy -> author}} </td>
                                
                                
                                <td> 
                                    <form action="{{route('therapy_see', ['id' => $therapy -> id], false, true)}}" method = "GET">
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
                            <h1 style="color: #0E456; font.weight: bold;">No hay terapias publicadas</h2>
                @endif
            </div>

        </div>
        

    <script src="https://www.pomodoro.ovh/filter.js"></script>
    <script>startFilter()</script>
@endsection