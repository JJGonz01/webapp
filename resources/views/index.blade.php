@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="left-login-container">
    </div>
    <div class="right-login-container">
        <div class="row justify-content-center">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <img src="https://www.pomodoro.ovh/images/tomatoclock.jpg" class="right-login-container-image"></img>
        <p id="navbarDropdown" class="nav-link dropdown-toggle">
            Usuario: {{  Auth::user()->name }}
        </p>
        <p>
            Correo: {{  Auth::user()->email }}
        </p>
            <div class="col-md-8">
                <div class="card">
                    <h1 class="card-header">{{ __('Mi Perfil') }}</h1>
                    <h2 class="card-header">{{ __('APLICACIÓN POMODORO') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection