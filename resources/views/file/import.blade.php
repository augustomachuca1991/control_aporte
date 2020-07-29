@extends('admin.app')

@section('body')
<div id="app" class="container-fluid">
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
    	swal.fire(
          data.message,
          'click para continuar',
          'success'
      )
    });
</script>
@endsection