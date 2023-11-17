@extends('main')

@section('patients_section')

<head>
    <title>PACIENTES</title>
</head>

<div class="general-items-container">
        
        <div class="user-welcome-box">
            @if(auth()->user() !== null)
            <div class="user-welcome-box-container">
                <h4>Pacientes</h4>
                <form action = "{{route('patients_create', [], false, true)}}" method="GET">
                    <button id="create-patient-button">AÑADIR PACIENTE</button>
                </form>
            </div>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>

        <div class = "options-items-container">
            @if (session('success'))
            <h6 class="alert alert-success"> {{ session('success') }}</h6>
        @endif
        @error('name')
            <h6 class="alert alert-danger"> {{ $message }}</h6>
        @enderror

            <div class="options-items-container-inner">
                @if(count($patients)>0)
                <table class="table-items-options">
                    <tr class ="top-index-container">
                        <th>ID</th> 
                        <th class="hide-if-width-small">NOMBRE</th> 
                        <th >APELLIDOS</th>
                        <th>ACCEDER</th> 
                    </tr>
                    <div class="table-items-options-overflow">
                        @foreach ($patients as $patient)
                        <tr> <!--class="all-patient-button" href = "{{route('patient_show', ['id' => $patient -> id])}}"-->
                            <td>{{$patient -> id}}  </td>
                            <td class="hide-if-width-small">{{$patient -> name}} </td>
                            <td>{{$patient -> surname}} </td>
                            <td> 
                                <form action="{{route('patient_show', [$patient->id], false, true)}}" method = "GET">
                                    <div>
                                    <button id="go_to_patient_btn" type="submit" class="edit-button">
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
                    <h1 style="color: #0E456; font.weight: bold;">No hay pacientes añadidos</h2>
                @endif
            </div>

        </div>
    
</div>
   
@endsection