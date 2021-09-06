<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fecha - {{ now()}}</h5>
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
        <div class="row bg-light"> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                       <small>Jurisdiccion</small>  
                  </div> 
                </div>
                <div class="row">
                  <div class="col">
                      <small>29</small> 
                  </div>
                </div> 

            </div>
            <div class="col">
                <div class="row"> 
                  <div class="col">
                       <small>Organismo</small>  
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <small>2901</small> 
                  </div> 
                </div>

            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col"> 
                         <small>Cargo</small>  
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <small>Personal IPS</small> 
                  </div> 
                </div>

            </div>
            <div class="col"> 
              <div class="row"> 
                  <div class="col">
                       <small>Mes</small>  
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <small>5</small> 
                  </div> 
                </div>
            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                       <small>Año </small>  
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <small>2020</small>
                  </div> 
                </div>
            </div>      
        </div>
        <!--cabecera-->
        <div class="row my-3 bg-light"> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                       <small>Apellido y Nombre</small>  
                  </div>
                </div>    
                <div class="row">
                  <div class="col">
                      <small>Perez Juan</small>
                  </div> 
                </div>
            </div>
            <div class="col">
                <div class="row"> 
                  <div class="col">
                       <small>Documento</small>  
                  </div>
                </div> 
                <div class="row">
                  <div class="col">
                      <small>12345678</small> 
                  </div> 
                </div>
            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col"> 
                         <small>Puesto Laboral</small>  
                  </div>
                </div> 
                <div class="row">
                  <div class="col">
                      <small>12634</small>
                  </div> 
                </div>
            </div>
            <div class="col"> 
              <div class="row"> 
                  <div class="col">
                       <small>Antigüedad</small>  
                  </div> 
                </div>
                <div class="row">
                  <div class="col">
                      <small>12</small> 
                  </div>
                </div>
            </div> 
            <div class="col">
                <div class="row"> 
                  <div class="col">
                       <small>Estado</small>  
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <small>Activo</small>
                  </div> 
                </div>
            </div>      
        </div>
        <!--table-->
        <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
          <table class="table table-borderless table-fixed table-sm">
            <caption class="justify-content-end"><small>Total Neto $ 31070.50</small></caption>
            <thead class="bg-light" >
              <tr>
                <th scope="col" class="text-center"><small>Cod</small></th>
                <th scope="col" class="text-center"><small>Concepto</small></th>
                <th scope="col" class="text-center"><small>Cantidad</small></th>
                <th scope="col" class="text-center"><small>Remunerativo</small></th>
                <th scope="col" class="text-center"><small>No-Remunerativo</small></th>
                <th scope="col" class="text-center"><small>Adicional-Familiar</small></th>
                <th scope="col" class="text-center"><small>Descuento</small></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row"><small>1</small></th>
                <td><small>Basico</small></td>
                <td><small>1</small></td>
                <td><small>7590.72</small></td>
                <td><small>-</small></td>
                <td><small>-</small></td>
                <td><small>-</small></td>
              </tr>
              <tr>
                <th scope="row"><small>2</small></th>
                <td><small>Antigüedad</small></td>
                <td><small>12 años</small></td>
                <td><small>3795.40</small></td>
                <td><small>-</small></td>
                <td><small>-</small></td>
                <td><small>-</small></td>
              </tr>
              <tr>
                <th scope="row"><small>65</small></th>
                <td><small>Funcion Especifica</small></td>
                <td>-</td>
                <td><small>23379.47</small></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
              </tr>
              <tr>
                <th scope="row"><small>3</small></th>
                <td><small>Bonificacion por titulo</small></td>
                <td>-</td>
                <td>-</td>
                <td><small>6695.03</small></td>
                <td>-</td>
                <td>-</td>
              </tr>
              <tr>
                <th scope="row"><small>4</small></th>
                <td><small>Presentismo</small></td>
                <td>-</td>
                <td>-</td>
                <td><small>2277.22</small></td>
                <td>-</td>
                <td>-</td>
              </tr>
              <tr>
                <th scope="row"><small>5</small></th>
                <td><small>Aporte Jubilatorio</small></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><small>9972.16</small></td>
              </tr>
              <tr>
                <th scope="row"><small>6</small></th>
                <td><small>Obra Social</small></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><small>2695.18</small></td>
              </tr>
            </tbody>
            <tfoot class="bg-light">
              <th scope="row" colspan="3"><small>Subtotal</small></th>
              <td><small>$ 34765.59</small></td>
              <td><small>$ 8972.25</small></td>
              <td><small>-</small></td>
              <td><small>$ 12667.34</small></td>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
          
