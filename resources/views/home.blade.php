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
        <home-component></home-component>
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
