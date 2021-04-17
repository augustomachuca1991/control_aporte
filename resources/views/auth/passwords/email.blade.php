@extends('layouts.app')

@section('content')




<!-- <div class="center-box">
  <div class="m-info">
      <span>
          <i class="fa fa-info"></i>
      </span>
      <p>¡Te hemos enviado por correo el enlace para restablecer tu contraseña!</p>
  </div>  
</div>
<div class="center-box">
  <div class="m-success">
      <span>
          <i class="fa fa-check"></i>
      </span>
      <p>¡Te hemos enviado por correo el enlace para restablecer tu contraseña!</p>
  </div>  
</div>

<div class="center-box">
  <div class="m-warning">
      <span>
          <i class="fa fa-exclamation-triangle"></i>
      </span>
      <p>¡Te hemos enviado por correo el enlace para restablecer tu contraseña!</p>
  </div>  
</div>

<div class="center-box">
  <div class="m-danger">
      <span>
          <i class="fa fa-times"></i>
      </span>
      <p>¡Te hemos enviado por correo el enlace para restablecer tu contraseña!</p>
  </div>  
</div> -->


@if (session('status'))
    <div class="center-box">
      <div class="m-success">
          <span>
              <i class="fa fa-check"></i>
          </span>
          <p>{{ session('status') }}</p>
      </div>  
    </div>
@endif
<div class="col-2">
    <img src="{{asset('image/email-5.png')}}">
</div>
<div class="col-2">
    <!-- <div class="alert alert-success">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    </div> -->
    
    
    <div class="form-container">
      <div class="form-btn">
      <span>{{ __('Reset Password') }}</span>
          <hr id="Indicator">  
      </div>
      <form  method="POST" action="{{ route('password.email') }}">
        @csrf
          <input id="email" type="email" class="fontAwesome @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="&#xf1fa; correo electronico">
          @error('email')
              <i>{{ $message }}</i>
          @enderror
          <button type="submit" class="btn"> {{ __('Send Password Reset Link') }} &#8594;</button>
      </form>  
    </div>
</div> 
@endsection
