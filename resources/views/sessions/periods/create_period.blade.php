@extends('main')

@section('patients_section')
<div class= "container w-250 border p-4">

    <form action="{{route('sessionPeriods_create',  ['therapy_id' => $therapy -> id])}}" method="POST">
    @csrf
    @if (session('success'))
        <h6 class="alert alert-success"> {{ session('success') }}</h6>
    @endif

    @if($errors->any())
    <h6 class="alert alert-danger">{{ implode('', $errors->all(':message')) }}</h6>
    @endif

    
    <h7>SESIÓN DE TERAPIA: {{$therapy->name}}</h7>
        <div>
            FECHA INICIO
            <input type="datetime-local" name="date_start" class="form-control">

            DESCRIPCION
            <input type="text" name = "description" class = "form-control">

            
            
            
        </div>
        <button type="submit"> Agregar </button>
    </form>
</div>
@endsection