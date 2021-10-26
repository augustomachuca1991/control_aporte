@extends('adminlte::page')

@section('title', 'Importar')

<!-- @section('plugins.Sweetalert2', true)
 -->
@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

@section('content_header')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}"> <i class="fas fa-home"></i> Panel</a></li>
    <li class="breadcrumb-item active" aria-current="page">Import</li>
  </ol>
</nav>
@stop

 @section('right-sidebar')
  @include('layouts.right_sidebar')
 @stop


@section('content')
  <div id="app">
    <import-component :user="{{$user}}"></import-component>    
  </div>
@stop



@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
      // Pusher.logToConsole = true;
        var pusher = new Pusher('fc71604184ab3f47bf1c', {
          cluster: 'eu'
        });
        //exito
        var channel = pusher.subscribe('canal-import');
        channel.bind('event-import', function(data) {
          
          Swal.fire(
              data.message,
              'Exito!!!',
              'success'
          ).then(function(){
            window.location.reload();
          })
        });
        //fracaso
        var channel = pusher.subscribe('canalfailed-import');
        channel.bind('eventfailed-import', function(data) {
          Swal.fire(
              data.message,
              'error',
              'error'
          ).then(function(){
            window.location.reload();
          })
        });
    </script>
@stop