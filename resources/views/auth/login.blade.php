@extends('layouts.app')

@section('content')
<div class="container-logo">
<img id="img-logo" src="{{asset('/images/logorm.png')}}">
</div>
<div class="container-login">
    <div class="container-change-login">
        <h1>Inicia sesión</h1>
        @if (Route::has('register'))
                    <form method="GET" action="{{ route('register', [], false, true) }}">
                        <span id="span-text">¿No  tienes cuenta? </span>
                        <button class="button-no-border" id = "go_to_register_button">
                            {{ __('Pulsa aquí') }}
                        </button>
                    </form>
        @endif
    </div>

  <div class="justify-content-center align-items-center">
    <div class="center-block">
      <div class="container">
        <form method="POST" action="{{ route('userlogin',[], false, true) }}">
          @csrf
          <div class="container-input">
            <span style="font-family: Arial, FontAwesome; padding-right: 10px;">&#xf0e0;</span>
            <input id="email" style="font-family: Arial, FontAwesome" class="input-login" type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus>  
            @error('email')
              <span class="error-text" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <div class="container-input">
          <div class="input-container">
                <span style="font-family: Arial, FontAwesome; padding-right: 10px;">&#xf023;</span>
                <input id="password" type="password" name="password" placeholder="Contraseña" required autocomplete="current-password" class="input-login" >
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="form-check-label" for="remember" style="color: rgb(84, 82, 82); font-size: large;">
                {{ __('Recordarme') }}
              </label>
            </div>
            <div class="input-column-cont">
            </div>
            @if (Route::has('password.request'))
              <a href="{{ route('password.request', [], false, true) }}">
                {{ __('Olvidé mi contraseña') }}
              </a>
            @endif
          </div>

          <div>
            <button id="iniciar-sesion-button" type="submit" name="iniciar_sesion" class="btn btn-primary btn-block" style="border-radius:15px;">
              {{ __('Iniciar Sesión') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>



<!--div class="container-login">
        <div class="container-xll">
            <div class="row justify-content-center">
                <div class="col-md-6 rounded-container">
                    <form method="POST" action="{{ route('userlogin',[], false, true) }}">
                        @csrf
                        @error('email')
                                    <span class="error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                        <h1>¡Hola de nuevo!</h1>
                        <div class="auth-input">
                            <div class="container-login">
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
</div-->
@endsection
