@extends('adminlte::page')

@section('title', 'Liquidaciones')

@section('plugins.Sweetalert2', true)

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

@section('content_header')
    <h1 class="text-secondary h1-responsive text-center">Lista de Liquidaciones</h1>
@stop


@section('content')
  <div id="app">
    <panel-component></panel-component>
  </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop


          
        
        