@extends('admin.app')
@section('body')
 <!-- Page Heading -->
 <div class="container">
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">Municipalidad de Goya</h5>
          <h6 class="card-subtitle mb-2 text-muted">Goya</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-borderless">
            <caption>Liquidaciones Marzo de 2019</caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td><a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fi-eye"></span></a></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td><a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fi-eye"></span></a></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td >Larry the Bird</td>
                <td>Houston</td>
                <td>@twitter</td>
                <td><a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target=".bd-example-modal-lg"><span class="fi-eye"></span></a></td>
              </tr>
            </tbody>
          </table>
        </div> 
      </div>      
    </div>  
 </div>

<!-- Modal -->
@include('modal.detalle')


@endsection