@extends('layouts.app')

@section('content')

<div class="col-2">
    <img src="image/register.png" style="opacity: 0.7;">
</div>
<div class="col-2">
    <div class="form-container">
      <div class="form-btn">
      <span>{{ __('Register') }}</span>
          <hr id="Indicator">  
      </div>
      <form method="POST" action="{{ route('register') }}">
        @csrf
          <input id="name" type="text" class="fontAwesome @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="&#xf007; nombre completo" >
          @error('name')
              <i>{{ $message }}</i>
          @enderror
          <input id="email" type="email" class="fontAwesome @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="&#xf1fa; correo electronico">
          @error('email')
              <i>{{ $message }}</i>
          @enderror
          <input id="password" type="password" class="fontAwesome @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="&#xf084; contraseña">
          @error('password')
              <i>{{ $message }}</i>
          @enderror

          <input id="password-confirm" type="password"  name="password_confirmation"  class="fontAwesome" required autocomplete="new-password" placeholder="&#xf084; confirmar contraseña">
          <button type="submit" class="btn"> {{ __('Register') }}&#8594;</button>
          <!-- <a href="">Forgot Password?</a> -->
      </form>  
    </div>
</div> 
@endsection
