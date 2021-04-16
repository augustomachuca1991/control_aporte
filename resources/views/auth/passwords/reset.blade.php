@extends('layouts.app')

@section('content')




<div class="col-2">

    @if (session('status'))
        <div>
            {{ session('status') }}
        </div>
    @endif
    <div class="form-container">
      <div class="form-btn">
      <span>{{ __('Reset Password') }}</span>
          <hr id="Indicator">  
      </div>
      <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

          <input id="email" type="email" class="fontAwesome @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="&#xf1fa; correo electronico">
          @error('email')
              <i>{{ $message }}</i>
          @enderror

          <input id="password" type="password" class="fontAwesome @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="&#xf084; nueva contraseña">
          @error('password')
                  <i>{{ $message }}</i>
          @enderror

          <input id="password-confirm" type="password" class="fontAwesome" name="password_confirmation" required autocomplete="new-password" placeholder="&#xf084;  confirmar contraseña">


          <button type="submit" class="btn"> {{ __('Reset Password') }} &#8594;</button>
      </form>  
    </div>
</div>

<div class="col-2">
    <img src="{{asset('image/new_password.png')}}">
</div> 
@endsection
