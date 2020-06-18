@extends('admin.app')
@section('body')
 <!-- Page Heading -->
 <div id="app" class="container">

    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Categorías</h5>
          <a href="#" class="btn btn-primary btn-sm text-white">Nueva Categoría</a>
      </div>
      <div class="card-body">
        
        
          <table class="table table-borderless table-striped border">
            <caption>Categorías</caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Cod. Categoría</th>
                <th scope="col">Categoría</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Docentes</td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm text-white"><i class="far fa-edit"></i></a>
                    <a href="#" class="btn btn-primary btn-sm text-white"><i class="far fa-trash-alt"></i></i></a>
                </td>
               
            </tr>
            </tbody>
          </table>
         
      </div>      
    </div>  
 </div>

<!-- Modal -->
@include('modal.detalle')


@endsection