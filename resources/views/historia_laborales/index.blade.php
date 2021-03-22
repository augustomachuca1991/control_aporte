@extends('adminlte::page')

@section('title', 'Historia Laboral')

<!-- @section('plugins.Sweetalert2', true) -->

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

@section('content_header')
    <h1 class="text-secondary h1-responsive">Panel de Historia Laboral</h1>
@stop


@section('content')
  <div id="app">
    <panel-historialaboral></panel-historialaboral>   
  </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@stop
