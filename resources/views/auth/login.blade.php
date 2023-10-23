@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('login', [], false, true)}}">
                        @csrf
                        
                        <div class="row mb-3">
                            @error('email')
                                    <span class="error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                            
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="auth-input">
                                
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="auth-input">
                               
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="input-row">
                                    <input class="check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <p class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <button id = "iniciar-sesion-button" type="submit" name="iniciar_sesion" class="login-create-button">
                                    {{ __('Iniciar Sesión') }}
                            </button>
                            <div class="input-column">
                                

                                @if (Route::has('password.request'))
                                    <a class="forgot-password-text" href="{{ route('password.request') }}">
                                        {{ __('¿Has olvidado tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    
                    <h3>¿NO TIENES CUENTA?</h3>
                    @if (Route::has('register'))
                    <form method="GET" action="{{route('register', [], false, true)}}">
                        <button id = "go_to_register_button" class="create-button">
                            {{ __('CREAR CUENTA') }}
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
