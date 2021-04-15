@extends('layouts.app')

@section('content')





<div class="col-2">
    <img src="image/register.png" style="opacity: 0.5;">
</div>
<div class="col-2">
    <!-- <h1>Give Your Workout <br> A New Style!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco</p>

    <form>
        <input type="text" name="" placeholder="e-mail">
        <input type="password" name="" placeholder="password">
        <a href="" class="btn"> LOGIN &#8594;</a>
    </form> -->
    <div class="form-container">
      <div class="form-btn">
      <span>{{ __('Register') }}</span>
          <hr id="Indicator">  
      </div>
      <form method="POST" action="{{ route('register') }}">
        @csrf
          <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="&#xf007; name" >
          @error('name')
              <i>{{ $message }}</i>
          @enderror
          <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="&#xf1fa; email">
          @error('email')
              <i>{{ $message }}</i>
          @enderror
          <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="&#xf084; password">
          @error('password')
              <i>{{ $message }}</i>
          @enderror

          <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="&#xf084; comfirmar password">
          <button type="submit" class="btn"> {{ __('Register') }}&#8594;</button>
          <!-- <a href="">Forgot Password?</a> -->
      </form>  
    </div>
</div> 
@endsection
