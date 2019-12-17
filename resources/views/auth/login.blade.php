@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row justify-content-center" style="opacity: .7; vertical-align: middle">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4" style="background-color: #000">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-muted">Inicia Session</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                      <input class="form-control" type="text" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
                    </div>
                    <div class="input-group mb-4">
                      <input class="form-control" type="password" placeholder="{{ __('Password') }}" name="password" required>
                    </div>
                    <div class="row">
                      <div class="col-6">
                          <button class="btn btn-primary px-4" type="submit">{{ __('Login') }}</button>
                      </div>
                </form>
                <div class="col-6 text-right">
                    <a href="{{ route('password.request') }}" class="btn btn-link px-0">{{ __('Forgot Your Password?') }}</a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>UMSS</h2>
                <p>Universidad Mayor de San Simon <hr> Este sistema realiza la simulacion de pedidos de un producto</p>
                @if (Route::has('password.request'))
                  <a href="{{ route('register') }}" class="btn btn-primary active mt-3">{{ __('Register') }}</a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('javascript')

@endsection