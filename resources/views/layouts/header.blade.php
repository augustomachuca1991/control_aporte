<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @guest
                @else

                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="small">Agentes</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="small">Cargos</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="small">Jurisdicciones</span></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarLiquidacion" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="small">Liquidaciones</span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarLiquidacion">
                     <a class="dropdown-item" href="#"><i class="far fa-id-badge"></i>
                        Ver todas la liquidaciones
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#buscar_por_cuil"><i class="far fa-id-badge"></i>
                        Buscar Por Cuil
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#listar_por_periodo"><i class="fas fa-calendar-alt"></i>
                        Listar Por Periodo de Liquidación
                    </a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="small">Organismos</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#"><span class="small">Periodos</span></a>
                </li>
                @endguest
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>