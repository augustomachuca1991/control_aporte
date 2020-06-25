@extends('admin.app')
@section('body')
 <!-- Page Heading -->
 <div id="app" class="container">
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Categorías</h5>
          <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#nueva_categoria">Nueva</a>
      </div>
      <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              {{session('success')}}
            </div>
          @endif
          <categoria-component></categoria-component>
      </div>      
    </div>  
 </div>


@endsection

