@extends('layouts.app')

@section('content')



<div class="col-2">
    <img src="image/login-verde.png">
</div>

<div class="col-2">
    <div class="form-container">
      <div class="form-btn">
      <span>{{ __('Login') }}</span>
          <hr id="Indicator">  
      </div>
      <form method="POST" action="{{ route('login') }}">
        @csrf
          <input id="email" type="email" name="email" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="&#xf1fa; email">
          @error('email')
              <i>{{ $message }}</i>
          @enderror
          <input id="password" type="password" name="password" placeholder="&#xf084; password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
          @error('password')
              <i>{{ $message }}</i>
          @enderror

          <button type="submit" class="btn"> {{ __('Login') }}&#8594;</button>
          @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
          @endif
          
      </form>  
    </div>
</div> 

@endsection
