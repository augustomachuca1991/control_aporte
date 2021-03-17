@extends('adminlte::page')

@section('title', 'Tablero')

@section('plugins.Sweetalert2', true)

@section('css')
    <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
@stop

@section('content_header')
    <h1 class="text-secondary h1-responsive">Importar Archivo</h1>
@stop


@section('content')
  <div id="app">
    <import-component></import-component>    
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
          let load = false;
          Swal.fire(
              data.message,
              'ok',
              'success'
          )
        });
        //fracaso
        var channel = pusher.subscribe('canalfailed-import');
        channel.bind('eventfailed-import', function(data) {
          let load = false;
          Swal.fire(
              'Error durante la importación',
              'error',
              'error'
          )
        });
    </script>
@stop