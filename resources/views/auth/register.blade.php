@extends('layouts.app')

@section('content')
<div class="login-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="header">{{ __('REGISTRARSE') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('register', [], false, true)}}">
                        @csrf
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <p class="error-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo electrónico') }}</label>
                        <div class="auth-input">
                           <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="auth-input">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="auth-input">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Repite contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="auth-input">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="login-create-button">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                       
                    </form>
                    <h3>¿YA TIENES CUENTA?</h3>
                    @if (Route::has('login'))
                        <a onclick="printClickedId(this)" id="ir-a-iniciar-button" class="create-button" href="{{ route('login') }}">
                            {{ __('INICIAR SESIÓN') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
