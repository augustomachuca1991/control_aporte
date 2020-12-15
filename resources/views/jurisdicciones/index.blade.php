@extends('admin.app')
@section('body')
	<div class="container">
		
		<h3 class="text-center">Lista de Jurisdiccion</h3>
		<div class="row">
			<div class="col-md-12 col-lg-4 my-2">
				<button class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#jurisdiccion_new"><i class="fa fa-plus"></i>&nbsp;Nueva Jurisdicción</button>
			</div>
			<div class="col-md-12 col-lg-4 offset-lg-4 my-2 ">
				<form class="form-inline justify-content-end">
				      <input id="buscador" class="form-control mr-sm-2 w-100 w-lg-80" type="search" placeholder="Buscar..." aria-label="Search">
				      <label for="buscador" class="mx-1 sr-only"><i class="fa fa-search"></i></label>
				</form>
			</div>
		</div>
		<jurisdiccion-component></jurisdiccion-component>
	</div>
@endsection

