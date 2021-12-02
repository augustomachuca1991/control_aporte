<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('image/ips.png') }}">


    <title>I.P.S Corrientes</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


    <!--fontaweson-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <!--custom style-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('image/logo-ips-header.png') }}"
                            width="250px"></a>
                </div>
                <nav>
                    @if (Route::has('login'))
                        <ul id="MenuItems">
                            @auth
                                <li><a href="{{ route('home') }}">HOME</a></li>
                            @else
                                <li><a href="{{ route('login') }}">INGRESAR</a></li>
                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}">REGISTRAR</a></li>
                                @endif
                            @endauth
                        </ul>
                    @endif


                    <!-- @if (Route::has('login'))
                        <ul>
                            <li><a href="">ABOUT</a></li>
                            <li><a href="">PORTFOLIO</a></li>
                            <li><a href="">CONCTAC</a></li>
                            <li><a href="">READ ME</a></li>
                            @auth
                                                                                        <li><a href="{{ route('home') }}">HOME</a></li>
                            @else
                                                                                        <li><a href="{{ route('login') }}">INGRESAR</a></li>
                                                                                        @if (Route::has('register'))
                                                                                            <li><a href="{{ route('register') }}">REGISTRAR</a></li>
                                                                                        @endif
                            @endauth
                        </ul>
                        @endif -->

                </nav>
                <img src="{{ asset('image/moon.png') }}" id="icon" width="30px" height="30px">
                <img src="{{ asset('image/menu.png') }}" id="menu-toggle" class="menu-icon"
                    onclick="menutoggle()">
            </div>

            <div class="account-page">
                <div class="container">
                    <div class="row">
                        <div class="col-2">
                            <div class="info">
                                <h1> Sistema de <span>Control</span> de Aporte</h1>
                                <p>Esta pagina esta creada para dar a conocer una alternativa con la que se puede
                                    mantener un buen manejo de los registros de haberes, en especial enfocando el eje
                                    central del
                                    trabajo, en una herramienta para mejorar la coordinación en las personas.</p>
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ route('home') }}">Volver</a>
                                    @else
                                        <a href="{{ route('login') }}">Ingresar</a>
                                    @endauth
                                @endif
                            </div>
                            <div class="social-links">
                                <a href="https://twitter.com/IPSCorrientes" target="_blank"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/ipsoficialcorrientes" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="https://www.instagram.com/ipscorrientes/" target="_blank"><i
                                        class="fab fa-instagram"></i></a>
                                <a href="https://www.youtube.com/channel/UCX4s0DI_uOhAlwPvKLVno9A" target="_blank"><i
                                        class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="img-box">

                                <img class="main-img" src="{{ asset('image/apple2.png') }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <!--script dark mode-->
    <script src="{{ asset('js/script.js') }}" type="text/javascript"></script>
</body>

</html>
