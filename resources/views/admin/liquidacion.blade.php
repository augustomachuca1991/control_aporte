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
                <td><a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td><a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td >Larry the Bird</td>
                <td>Houston</td>
                <td>@twitter</td>
                <td><a href="#" class="btn btn-primary text-white" data-toggle="modal" data-target=".bd-example-modal-lg">ver</a></td>
              </tr>
            </tbody>
          </table>
        </div> 
      </div>      
    </div>  
 </div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ now()}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="btn btn-danger" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--cabecera-->
        <div class="row"> 
          <div class="col">
              <p class="text-center">LIQUIDACIONES</p> 
          </div>
        </div> 
        <!--cabecera -->
        <div class="row"> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                      <strong> JURISDICCION  </strong>
                  </div>
                  <div class="col">
                      29 
                  </div> 
                </div>    

            </div>
            <div class="col">
                <div class="row"> 
                  <div class="col">
                      <strong> ORGANISMO  </strong>
                  </div>
                  <div class="col">
                      2901 
                  </div> 
                </div> 

            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col"> 
                        <strong> CARGO  </strong>
                  </div>
                  <div class="col">
                      Personal IPS 
                  </div> 
                </div> 

            </div>
            <div class="col"> 
              <div class="row"> 
                  <div class="col">
                      <strong> MES  </strong>
                  </div>
                  <div class="col">
                      5 
                  </div> 
                </div>
            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                      <strong> AÑO  </strong> 
                  </div>
                  <div class="col">
                      2020
                  </div> 
                </div>
            </div>      
        </div>
        <!--cabecera-->
        <div class="row"> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                      <strong> Apellido y Nombre </strong> 
                  </div>
                  <div class="col">
                      Juan Perez
                  </div> 
                </div>    

            </div>
            <div class="col">
                <div class="row"> 
                  <div class="col">
                      <strong> Documento  </strong>
                  </div>
                  <div class="col">
                      12345678 
                  </div> 
                </div> 

            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col"> 
                        <strong> Puesto Laboral  </strong>
                  </div>
                  <div class="col">
                      12634
                  </div> 
                </div> 

            </div>
            <div class="col"> 
              <div class="row"> 
                  <div class="col">
                      <strong> Antigüedad  </strong>
                  </div>
                  <div class="col">
                      25 
                  </div> 
                </div>
            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                      <strong> Estado  </strong>
                  </div>
                  <div class="col">
                      Activo
                  </div> 
                </div>
            </div>      
        </div>

      </div>
    </div>
  </div>
</div>


@endsection