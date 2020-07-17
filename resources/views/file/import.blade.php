@extends('admin.app')

@section('body')
<div id="app">
	<h1>Importar Archivos de Liquidaciones</h1>
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
  var channel = pusher.subscribe('canal-import');
    channel.bind('event-import', function(data) {
    	//const swal = require('sweetalert2')
    	alert(JSON.stringify(data.message));
    });
</script>
@endsection