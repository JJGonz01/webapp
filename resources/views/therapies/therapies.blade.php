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
            <p>Bienvendo {{auth()->user()->name}}</p>
            @else
                <p> INICIA SESION PARA CONTINUAR </p>
            @endif
            <p>Sección de las terapias de estudio</p>
        </div>

        <div class = "options-items-container">
            <form action = "{{route('therapies_create')}}" method = "GET">
                <button id="create-therapy-btn" class= "create-button">CREAR TERAPIA</button>
            </form>
            <div class="options-items-container-inner">
                @if(count($therapies)>0)
                <table class="table-items-options">
                    <tr class ="top-index-container">
                        <th>ID</th> 
                        <th>NOMBRE</th> 
                        <th>REGLAS</th>
                        <th>ACCEDER</th> 
                    </tr>
                    <div class="table-items-options-overflow">
                        
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
                                    <form action="{{route('therapy_show', ['id' => $therapy -> id])}}" method = "GET">
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
@endsection
