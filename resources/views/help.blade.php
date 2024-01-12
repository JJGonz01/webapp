@extends('main')

@section('patients_section') 

<head><title>HOME</title></head>

<div class="general-items-container">
<script src="{{asset('general_page.js')}}"></script>
  
        <div class="user-welcome-box">
            @if(auth()->user() !== null)
            <h4>Terapias globales</h4>
            @else
            <p> INICIA SESION PARA CONTINUAR </p>
            @endif
        </div>

        

   

@endsection