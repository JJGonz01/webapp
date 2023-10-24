@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="left-login-container">
    </div>
    <div class="right-login-container">
        <div>
            <div>
                <div>
                    <form method="POST" action="{{ route('login',[], false, true) }}">
                        @csrf
                        @error('email')
                                    <span class="error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                            <img src="https://pomodoroadhdapp.azurewebsites.net/images/tomatoclock.jpg" class="right-login-container-image"></img><h1>¡Hola de nuevo!</h1>
                        <div class="auth-input">
                            
                            
                            
                            
                            <div class="input-container">
                                <label for="email" class="auth-input-label">{{ __('Correo') }}</label>
                                
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                
                            </div>
                        </div>

                        <div>
                            
                            
                            <div class="auth-input">
                                <div class="input-container">
                                    <label for="password" class="auth-input-label">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" name="password" required autocomplete="current-password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div class="input-column">
                            
                                <div class="input-column-cont">
                                    <input class="check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <p for="remember" style="color:rgb(84, 82, 82); font-size:small;">
                                        {{ __('Recordarme') }}
                                    </p>
                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request', [], false, true) }}">
                                        {{ __('Olvidé contraseña') }}
                                    </a>
                                @endif
                            </div>
                            </div>
                        </div>


                        <div class="">
                            
                            
                            
                            <button id = "iniciar-sesion-button" type="submit" name="iniciar_sesion" class="button-login">
                                    {{ __('Iniciar Sesión') }}
                            </button>
                        </div>
                    </form>
                    @if (Route::has('register'))
                    <form method="GET" action="{{ route('register', [], false, true) }}" class="singup-line">
                        <span style="font-style:oblique">¿No  tienes cuenta? </span>
                        <button id = "go_to_register_button">
                            {{ __('Pulsa aquí') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
