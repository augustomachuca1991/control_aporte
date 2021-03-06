@extends('adminlte::page')

@section('title', 'Conceptos')

<!-- @section('plugins.Sweetalert2', true) -->

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

 @section('right-sidebar')
	@include('layouts.right_sidebar')
 @stop

@section('content_header')
    <h1 class="text-secondary h1-responsive text-center">Lista de Conceptos de Liquidacion</h1>
@stop


@section('content')
  <div id="app">
    <concepto-component></concepto-component> 
  </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop


