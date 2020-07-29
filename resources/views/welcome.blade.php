<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="{{asset('image/ips.png')}}">
        <title>I.P.S Corrientes</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color:#92bf56; 
                font-family: 'Cairo', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                color: #FFFFFF;

            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #FFFFFF;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
   <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{route('home') }}"><i class="fas fa-home"></i> Home</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesión</a>

                        @if (Route::has('register'))
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
        </div>
    </body>
</html>
