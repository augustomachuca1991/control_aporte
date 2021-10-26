@extends('adminlte::page')

@section('title', 'Organismos')

@section('plugins.Sweetalert2', true)

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop


 @section('right-sidebar')
	@include('layouts.right_sidebar')
 @stop

@section('content_header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}"> <i class="fas fa-home"></i> Panel</a></li>
    <li class="breadcrumb-item active" aria-current="page">Organismos</li>
  </ol>
</nav>
@stop


@section('content')
  <div id="app">
    <organismo-component></organismo-component>  
  </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@stop
