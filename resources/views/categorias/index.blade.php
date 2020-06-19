@extends('admin.app')
@section('body')
 <!-- Page Heading -->
 <div id="app" class="container">
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Categorías</h5>
          <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-md">Nueva</a>
      </div>
      <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              {{session('success')}}
            </div>
          @endif
          {{--  <table class="table table-borderless table-striped border">
            <caption>Categorías</caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Cod.</th>
                <th scope="col">Categoría</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categorias as $categoria)
              <tr>
                <th scope="row">{{$categoria->cod_categoria}}</th>
                <td>{{$categoria->categoria}}</td>
                <td>
                  <a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target="#edit_categoria"><i class="far fa-edit"></i></a>
                  <a href="{{ url ('delete_categoria').'/'.$categoria->id }}" class="btn btn-primary btn-sm text-white"><i class="far fa-trash-alt"></i></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>   --}}
          <categoria-component></categoria-component>
      </div>      
    </div>  
 </div>

<!-- Modal -->
@include('modal.nueva_categoria')
@include('modal.edit_categoria')


@endsection

