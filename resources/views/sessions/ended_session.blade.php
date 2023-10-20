@extends('main')

@section('patients_section')

<div class= "container w-80 border p-4">
    <div>
        
        <div>

            @if (session('success'))
                <h6 class="alert alert-success"> {{ session('success') }}</h6>
            @endif
            @error('name')
                <h6 class="alert alert-danger"> {{ $message }}</h6>
            @enderror

            <p>FECHA PROGRAMADA: {{$session -> date_start}}  DESCRIPCION: {{$session -> description}}</p>
            <h3>SESSION COMPLETED!</h3>
        </div>

        <div>
            <a href = "{{route('therapy_show', ['id' => $session -> therapy_id])}}">
               SALIR
            </a>
        </div>
            
        
    </div>
</div>
@endsection