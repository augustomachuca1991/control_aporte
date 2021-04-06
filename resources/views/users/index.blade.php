 @extends('adminlte::page')

 @section('title', 'Perfiles de Usuarios')
 



 @section('right-sidebar')
	<div class="container">
		<h5>Personalizar Panel</h5>
		<hr class="mb-2">
		<div class="mb-4">
			<input type="checkbox" value="1" class="mr-1">
			<span>Modo Nocturno</span>
		</div>	
	</div>
 @stop

 
 @section('css')
     <!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
     <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
 @stop

 @section('content_header')
     <h1>Usuarios</h1>
 @stop


 @section('content')
 <div id="app">
        <users-component></users-component>

  </div>
 @stop



 @section('js')
     <script src="{{ asset('js/app.js') }}" defer></script>
 @stop 
