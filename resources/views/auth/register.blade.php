@extends('layouts.app')

@section('content')

<div class="container-logo">
<img id="img-logo" src="{{asset('/images/logorm.png')}}">
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

<!--div class="login-container">
    <div class="left-login-container">
    </div>
    <div class="right-login-container">
        <div>
            <div> 
                

                <div >
                    <form method="POST" action="{{ route('register', [], false, true) }}">
                        @csrf
                        
                        @error('name')
                                    <p class="error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                         @enderror

                          <h1>{{ __('REGISTRARSE') }}</h1>
                        <div  class="auth-input">
                            <div class="input-container">
                                <label for="name" class="auth-input-label">{{ __('Nombre de usuario') }}</label>
                                
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                
                        </div>
                                

                        
                        <div class="auth-input">
                                @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                                <label for="email" class="auth-input-label">{{ __('Correo electrónico') }}</label>
                                <input id="email" type="email" class="auth-input-label"  name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="auth-input">
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <div class="input-container">
                                <label for="password" class="auth-input-label">{{ __('Contraseña') }}</label>
                                <input id="password" type="password" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="auth-input">
                            <div class="input-container">
                                <label for="password-confirm" class="auth-input-label">{{ __('Repitir contraseña') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="auth-input">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button-login">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>

                       
                    </form>
                    <h3>¿YA TIENES CUENTA?</h3>
                    @if (Route::has('login'))
                    <form action =  "{{ route('login', [], false, true) }}">
                        <div class="singup-line">
                            <span style="font-style:oblique">¿Ya  tienes cuenta? </span>
                            <button id = "go_to_register_button">
                                {{ __('Pulsa aquí') }}
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div-->
@endsection
