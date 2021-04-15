@extends('layouts.app')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="col-2">
    <img src="{{asset('image/email-5.png')}}">
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
      <form  method="POST" action="{{ route('password.email') }}">
        @csrf
          <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="&#xf1fa; email">
          @error('email')
              <i>{{ $message }}</i>
          @enderror
          <button type="submit" class="btn"> {{ __('Send Password Reset Link') }} &#8594;</button>
      </form>  
    </div>
</div> 
@endsection
