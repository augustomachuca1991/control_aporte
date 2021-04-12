<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{asset('image/ips.png')}}">
        <title>I.P.S Corrientes</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--fontawesome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
        <style>
            
        </style>
    </head>
   <body>
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{route('home') }}"><i class="fas fa-home"></i> Home</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesión</a>

                        @if (Route::has('register'))apo
                            <a href="{{ route('register') }}">Registrar</a>
                        @endif
                    @endauth
                </div>
            @endif
            
            <div class="content">
                <div class="title m-b-md">
                    <div class="media">
                        <img src="{{asset('image/logo-ips.png')}}" alt="Generic placeholder image">
                    <div>
                    <p class="lead" style="font-size: 24px; font-family: 'Oswald', sans-serif;">SISTEMA DE CONTROL DE APORTE</p>
                </div>

                <div class="links">
                    <a href="http://www.corrienteshoy.com/">principales</a>
                    <a href="http://www.ipscorrientes.gov.ar/">Noticias</a>
                    <a href="https://www.google.com/maps/place/Instituto+de+Previsi%C3%B3n+Social+de+Corrientes/@-27.4619399,-58.8355979,16.5z/data=!4m5!3m4!1s0x94456ca51f341343:0x9b9b2924e2fe2761!8m2!3d-27.4656224!4d-58.838876">Ubicación</a>
                    <a href="https://www.youtube.com/channel/UC8abYCbPeDt47657K8hNS6A">Youtube</a>
                    <a href="https://twitter.com/ipscorrientes">Twitter</a>
                    <a href="https://www.facebook.com/ips.corrientes/">Facebook</a>
                </div>
            </div>
        </div> -->

        <div class="hero">
            <nav>
                <a href="{{ url('/') }}"><img src="image/logo-ips-header.png" class="logo"></a>
                @if (Route::has('login'))
                <ul>
                    <!-- <li><a href="">ABOUT</a></li>
                    <li><a href="">PORTFOLIO</a></li>
                    <li><a href="">CONCTAC</a></li>
                    <li><a href="">READ ME</a></li> -->
                    @auth
                        <li><a href="{{route('home') }}">HOME</a></li>
                    @else
                        <li><a href="{{ route('login') }}">INGRESAR</a></li>

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}">REGISTRAR</a></li>
                        @endif
                    @endauth
                </ul>
                @endif
                <img src="image/moon.png" id="icon">
            </nav>

            <div class="info">
                <h1> Sistema de <span>Control</span> de Aporte</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod <br>   
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, <br>
                quis nostrud exercitation</p>
                <a href="">Ingresar</a>
            </div>

            <div class="img-box">
                <img src="image/pattern-ips1.png" class="back-img" >
                <img src="image/apple.png" class="main-img">
            </div>


            <div class="social-links">
                <a href="https://twitter.com/ipscorrientes"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.facebook.com/ips.corrientes/"><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>





        <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    </body>
</html>
