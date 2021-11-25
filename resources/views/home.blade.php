@extends('adminlte::page')

@section('title', 'Tablero')
<!-- @section('plugins.Sweetalert2', true) -->
@section('plugins.Chartjs', true)



@section('right-sidebar')
    @include('layouts.right_sidebar')
@stop

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    <section id="app" class="content">
        <div class="container-fluid">
            
            @can('btn_dashboard')
            <div class="row">
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <a href="/home">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-home"></i>
                                </h1>
                                <h6 class="text-white">Dashboard</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-4 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-olive text-center">
                            <a href="/import">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-file-csv"></i>
                                </h1>
                                <h6 class="text-white">Excel / CSV</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-orange text-center">
                            <a href="/declaraciones_juradas">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-book"></i>
                                </h1>
                                <h6 class="text-white">Declaraciones Juradas</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <a href="/users">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-users"></i>
                                </h1>
                                <h6 class="text-white">Usuarios</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-info text-center">
                            <a href="/computos">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-calculator"></i>
                                </h1>
                                <h6 class="text-white">Computos</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-md-6 col-lg-4 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <a href="/liquidacion">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </h1>
                                <h6 class="text-white">Liquidaciones</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-info text-center">
                            <a href="/hlaborales">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-stream"></i>
                                </h1>
                                <h6 class="text-white">Historias Laborales</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <a href="/conceptos">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-cogs"></i>
                                </h1>
                                <h6 class="text-white">Configuraciones</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-olive text-center">
                            <h1 class="font-light text-white">
                                <i class="fas fa-building"></i>
                            </h1>
                            <h6 class="text-white">Departamentos</h6>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6 col-lg-2 col-xlg-3">
                    <div class="card card-hover">
                        <div class="box bg-orange text-center">
                            <a href="/subtipo-codigos">
                                <h1 class="font-light text-white">
                                    <i class="fas fa-list"></i>
                                </h1>
                                <h6 class="text-white">Codigos</h6>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            @endcan
                
            <home-component></home-component>
        </div>
    </section>

@stop


@section('css')
    <style>
        .card:hover {
            box-shadow: 1px 1px 1px gray;
            transform: scale(1.05);
        }

        .card {
            transition: 0.3s;
        }

    </style>

@stop

@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
