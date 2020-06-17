@extends('admin.app')
@section('body')
 <!-- Page Heading -->
 <div id="app" class="container">
    <filter-component></filter-component>
    <div class="card shadow"> 
      <div class="card-header">
          <h5 class="card-title">SISPER</h5>
          
      </div>
      <div class="card-body">
        
        
          <table class="table table-borderless table-striped border">
            <caption>Liquidaciones Mayo de 2020</caption>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Agente</th>
                <th scope="col">Cuil</th>
                <th scope="col">Puesto Laboral</th>
                <th scope="col">Estado</th>
                <th scope="col">Antigüedad</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Gallardo Marcelo</td>
                <td>20123456789</td>
                <td>
                  <div class="row p-1">
                    <div class="col">1215</div>
                  </div>
                  <div class="row p-1">
                    <div class="col">9984</div>
                  </div>
                  <div class="row p-1">
                    <div class="col">55421</div>
                  </div>
                </td>
                <td>
                  <div class="row py-1">
                    <div class="col">Activo</div>
                  </div>
                  <div class="row py-1">
                    <div class="col">Activo</div>
                  </div>
                  <div class="row py-1">
                    <div class="col">Suplencia</div>
                  </div>
                </td>
                <td>
                  <div class="row py-1">
                    <div class="col">12</div>
                  </div>
                  <div class="row py-1">
                    <div class="col">9</div>
                  </div>
                  <div class="row py-1">
                    <div class="col">2</div>
                  </div>
                </td>
                <td>
                  <div class="row py-1">
                    <div class="col"><a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></div>
                  </div>
                  <div class="row py-1">
                    <div class="col"><a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></div>
                  </div>
                  <div class="row py-1">
                    <div class="col"><a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Moralez Maximiliano</td>
                <td>20123456789</td>
                <td>5876</td>
                <td>Activo</td>
                <td>5</td>
                <td><a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Perez Juan</td>
                <td>20123456789</td>
                <td>5688</td>
                <td>Activo</td>
                <td>11</td>
                <td><a href="#" class="btn btn-primary btn-sm text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></td>
              </tr>
            </tbody>
          </table>
         
      </div>      
    </div>  
 </div>

<!-- Modal -->
@include('modal.detalle')


@endsection