<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/png" href="{{asset('image/ips.png')}}">
    <title>I.P.S Corrientes</title>

    

    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--fontaweson-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!--custom style-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
     @yield('css')
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{asset('image/logo-ips-header.png')}}" width="250px"></a>
                </div>
                <nav>


                    <ul id="MenuItems">

                        @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            @endif
                        @endguest
                    </ul>
                    
                </nav>
                <img src="{{asset('image/moon.png')}}" id="icon" width="30px" height="30px">
                <img src="{{asset('image/menu.png')}}" id="menu-toggle" class="menu-icon" onclick="menutoggle()">
            </div>

            <div class="account-page">
                <div class="container">
                   <div class="row">

                        @yield('content')
                        
                   </div> 
                </div>
            </div>
            
        </div>
    </div>


    <!--script dark mode-->
    <script src="{{asset('js/script.js')}}" type="text/javascript"></script>
    @yield('js') 
</body>
</html>



