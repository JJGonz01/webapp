@extends('layouts.app')

@section('content')
<div class="container-centered-height">
  <div class="container-logo">
  <img id="img-logo" src="https://www.pomodoro.ovh/images/logorm.png">
  </div>
    <div class=" container-login">
        
        <div class="container-change-login">
            <h1>Registrate</h1>
            @if (Route::has('login'))
            <form action =  "{{ route('login', [], false, true) }}">
                <div class="singup-line">
                    <span id="span-text">¿Ya tienes cuenta? </span>
                    <button class="button-no-border" id = "go_to_register_button">
                        {{ __('Pulsa aquí') }}
                    </button>
                </div>
            </form>
            @endif
        </div>
            
        <div class="justify-content-center align-items-center">
            <div class="center-block">
                <div class="container">
                    <form method="POST" action="{{ route('register', [], false, true) }}">
                        @csrf
                        <div class="container-input">
                            <span style="font-family: Arial, FontAwesome; padding-right: 10px;">&#xf0e0;</span>
                            <input id="name" type="text" class="input-login" placeholder="Nombre" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <p class="error-text" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                            @enderror
                        </div>

                        <div class="container-input">
                            <span style="font-family: Arial, FontAwesome; padding-right: 10px;">&#xf0e0;</span>
                            <input id="email" type="email" class="input-login" placeholder="Correo electronico" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="container-input">
                            <span style="font-family: Arial, FontAwesome; padding-right: 10px;">&#xf0e0;</span>
                            <input id="password" class="input-login" type="password" placeholder="Contraseña" name="password" required autocomplete="new-password">
                            @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror
                        </div>

                        <div class="container-input">
                            <span style="font-family: Arial, FontAwesome; padding-right: 10px;">&#xf0e0;</span>
                            <input id="password-confirm" class="input-login" type="password"  placeholder="Confirmar contraseña" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div>
                            <button id="registrarte-button" type="submit" name="register" class="btn btn-primary btn-block" style="border-radius:15px;">
                            {{ __('Iniciar Sesión') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
    @endsection
