@extends('adminlte::page')

@section('title', 'Declaracion Jurada')

<!-- @section('plugins.Sweetalert2', true) -->

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <style>
        .hr-sect {
            display: flex;
            flex-basis: 100%;
            align-items: center;
            color: rgba(0, 0, 0, 0.35);
            margin: 8px 0px;
        }

        .hr-sect:before,
        .hr-sect:after {
            content: "";
            flex-grow: 1;
            background: rgba(0, 0, 0, 0.35);
            height: 1px;
            font-size: 0px;
            line-height: 0px;
            margin: 0px 8px;
        }

    </style>
@stop

@section('right-sidebar')
    @include('layouts.right_sidebar')
@stop

@section('content_header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="fas fa-home"></i> Panel</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ddjj') }}"> <i class="fas fa-file-contract"></i> DDJJ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Declaracion Jurada</li>
        </ol>
    </nav>
@stop


@section('content')
    <div id="app">

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="hr-sect capitalize">{{ $lines->first()->declaracionjurada->organismo->organismo }} -
                        {{ $lines->first()->declaracionjurada->periodo->periodo }}</div>

                </div>
            </div>
            <div class="row mb-2">

                @foreach ($lines as $item)
                    <div class="col-12 col-md-6 col-lg-4">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <span class="text-muted">Nombre</span>
                                    </div>
                                    <div class="col">
                                        <p class="text-right">{{ $item->nombre }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <span class="text-muted">Cuil</span>
                                    </div>
                                    <div class="col">
                                        <p class="text-right">{{ $item->cuil }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <span class="text-muted">Fecha Nacimiento</span>
                                    </div>
                                    <div class="col">
                                        <p class="text-right">{{ $item->fecha_nac }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <span class="text-muted">Puesto Laboral</span>
                                    </div>
                                    <div class="col">
                                        <p class="text-right">{{ $item->puesto_laboral }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <span class="text-muted">Categoria</span>
                                    </div>
                                    <div class="col">
                                        <p class="text-right">{{ $item->categoria }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <span class="text-muted">Clase</span>
                                    </div>
                                    <div class="col">
                                        <p class="text-right">{{ $item->clase }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">

                                    @foreach (json_decode($item->detalle, true) as $detalle)
                                        <p class="text-justify">{{ $detalle['cod'] }}
                                            {{ $detalle['concepto'] }}
                                            {{ $detalle['unidad'] }}
                                            {{ $detalle['subtipo'] }}
                                            {{ $detalle['importe'] }}</p>
                                        <hr>
                                    @endforeach
                                </div>

                            </li>
                            <br>
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col">
                    {{ $lines->links() }}
                </div>
                <div class="col">
                    Total Registros: {{ $lines->total() }}
                </div>
            </div>
        </div>

    </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@stop
