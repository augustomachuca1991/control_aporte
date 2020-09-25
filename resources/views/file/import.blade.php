@extends('admin.app')

@section('body')
<div id="app">
  <h3 class="h3-responsive">Importar Archivo</h3>
	<import-component></import-component> 
</div>
@endsection


@section('js')
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>
<script type="module">
  //Pusher.logToConsole = true;
    var pusher = new Pusher('fc71604184ab3f47bf1c', {
      cluster: 'eu'
    });
    //exito
    var channel = pusher.subscribe('canal-import');
    channel.bind('event-import', function(data) {
    	swal.fire(
          data.message,
          'click para continuar',
          'success'
      )
    });
    //fracaso
    var channel = pusher.subscribe('canalfailed-import');
    channel.bind('eventfailed-import', function(data) {
      swal.fire(
          data.message,
          'click para continuar',
          'error'
      )
    });
</script>
@endsection