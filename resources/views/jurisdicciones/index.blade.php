@extends('adminlte::page')

@section('title', 'Jurisdicciones')

@section('plugins.Sweetalert2', true)

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

@section('content_header')
    <h1 class="text-secondary h1-responsive text-center">Lista de Jurisdicciones</h1>
@stop


@section('content')
  <div id="app">
    <jurisdiccion-component></jurisdiccion-component>   
  </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop


		